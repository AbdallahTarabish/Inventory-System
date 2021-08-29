<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Requests\UserRequest;
use App\Models\MainStore;
use App\Models\Role;
use App\Models\SubStore;
use App\Models\User;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;

class UserController extends Controller
{

    use SoftDeletes;

    public function __construct()
    {
        $this->middleware('permission:users_read')->only(['index']);
        $this->middleware('permission:users_update')->only(['update', 'edit']);
        $this->middleware('permission:users_create')->only(['create', 'store']);
        $this->middleware('permission:users_delete')->only(['destroy']);
    }


    public function index()
    {

        //whereRoleNot('company_manager')
        $roles = Role::whereRoleNot('company_manager')->get();
        if (empty(auth()->user()->main_store_id) && empty(auth()->user()->sub_store_id)) {
            $users = User::whereRoleNot('company_manager')->
            whenSearch(request()->search)
                ->whenRole(\request()->role_id)
                ->with('roles')
                ->paginate(5);

        } elseif (!empty(auth()->user()->main_store_id) && empty(auth()->user()->sub_store_id)) {

            $users = User::where('sub_store_id', auth()->user()->sub_store_id)->
            whereRoleNot('store_manager')->
            whenSearch(request()->search)
                ->whereRoleNot('company_manager')
                ->whenRole(\request()->role_id)
                ->with('roles')
                ->paginate(5);
        } elseif (!empty(auth()->user()->main_store_id) && !empty(auth()->user()->sub_store_id)) {
            $users = User::where('sub_store_id', auth()->user()->sub_store_id)->
            whereRoleNot('store_manager')->
            whenSearch(request()->search)
                ->whereRoleNot('company_manager')
                ->whenRole(\request()->role_id)
                ->with('roles')
                ->paginate(5);

        }
        return view('Dashboard.users.index', compact('users', 'roles'));
    }

    public function create()
    {
        if (auth()->user()->hasRole('store_manager')) {
            $roles = Role::whereRoleNot(['company_manager', 'store_manager'])->select('id', 'name')->get();
        } else {
            $roles = Role::whereRoleNot(['company_manager'])->select('id', 'name')->get();

        }
        $sub_stores = SubStore::select('id', 'name')->get();
        $main_stores = MainStore::select('id', 'name')->get();
        return view('Dashboard.users.create', compact('roles', 'sub_stores', 'main_stores'));
    }

    public function store(UserRequest $request)
    {
        $data =
            [
                'name' => $request->name,
                'mobile' => $request->mobile,
                'email' => $request->email,
                'password' => bcrypt($request->password),

            ];
        if (empty(auth()->user()->main_store_id) && empty(auth()->user()->sub_store_id)) {
            $request->request->add(['password' => bcrypt($request->password)]);
            $user = User::create($request->all());
            $user->attachRole($request->role_id);

        } elseif (!empty(auth()->user()->main_store_id) && empty(auth()->user()->sub_store_id)) {
            $data['main_store_id'] = auth()->user()->main_store->id;
            $user = User::create($data);
            $user->attachRole($request->role_id);

        } elseif (!empty(auth()->user()->main_store_id) && !empty(auth()->user()->sub_store_id)) {
            $data['sub_store_id'] = auth()->user()->sub_store->id;
            $data['main_store_id'] = auth()->user()->main_store->id;
            $user = User::create($data);
            $user->attachRole($request->role_id);


        }


        session()->flash('success', 'تمت الاضافة بنجاح');


        return redirect()->route('users.index');

    }

    public function edit(User $user)
    {
        if (auth()->user()->hasRole('store_manager')) {
            $roles = Role::whereRoleNot(['company_manager', 'store_manager'])->select('id', 'name')->get();
        } else {
            $roles = Role::whereRoleNot(['company_manager'])->select('id', 'name')->get();

        }
        $sub_stores = SubStore::select('id', 'name')->get();
        $main_stores = MainStore::select('id', 'name')->get();
        return view('Dashboard.users.edit', compact(['user', 'roles', 'sub_stores', 'main_stores']));
    }

    public function update(UserRequest $request, User $user)
    {

        $data =
            [
                'name' => $request->name,
                'mobile' => $request->mobile,
                'email' => $request->email,
                'password' => bcrypt($request->password),

            ];
        if (empty(auth()->user()->main_store_id) && empty(auth()->user()->sub_store_id)) {
            if (!empty($request->password)) {
                $request->request->add(['password' => bcrypt($request->password)]);
            } else {
                $request->request->add(['password' => $user->password]);

            }
            $user->update($request->all());
            $user->syncRoles([$request->role_id]);

        } elseif (!empty(auth()->user()->main_store_id) && empty(auth()->user()->sub_store_id)) {
            $data['main_store_id'] = auth()->user()->main_store->id;
            $user->update($data);;
            $user->syncRoles([$request->role_id]);

        } elseif (!empty(auth()->user()->main_store_id) && !empty(auth()->user()->sub_store_id)) {
            $data['main_store_id'] = auth()->user()->main_store->id;
            $data['sub_store_id'] = auth()->user()->sub_store->id;
            $user->update($data);;
            $user->syncRoles([$request->role_id]);

        }


        session()->flash('success', 'تم التعديل بنجاح');
        return redirect()->route('users.index');
    }

    public function destroy(User $user)
    {
        $user->delete();
        session()->flash('success', 'تم الحذف بنجاح');
        return redirect()->route('users.index');

    }
}

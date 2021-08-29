<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Requests\RoleRequest;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function __construct()
    {


        $this->middleware('permission:roles_read')->only(['index']);
        $this->middleware('permission:roles_update')->only(['update', 'edit']);
        $this->middleware('permission:roles_create')->only(['create', 'store']);
        $this->middleware('permission:roles_delete')->only(['destroy']);

    }
    public function index(){
        $roles = Role::whenSearch(request()->search)
            ->with('permissions')
            ->withCount('users')
            ->get();
        return view('Dashboard.roles.index', compact('roles'));
    }

    public function create(){
        return view('Dashboard.roles.create');
    }

    public function store(RoleRequest $request){

        $role = Role::create(['name'=>$request->name]);

        $role->attachPermissions($request->permissions);
        session()->flash('success','تمت الإضافة بنجاح');
        return redirect()->route('roles.index');

    }

    public  function edit(Role $role){

        return view('Dashboard.roles.edit',compact('role'));
    }

    public function update(Request $request,Role $role){

        $role->update(['name'=>$request->name]);
        $role->syncPermissions($request->permissions);
        session()->flash('success','تم التعديل بنجاح');
        return redirect()->route('roles.index');
    }

    public function destroy(Role $role){
        $role->delete();
        $role->users()->sync([]); // Delete relationship data
        $role->permissions()->sync([]); // Delete relationship data

        $role->forceDelete();
        session()->flash('success','تم الحذف بنجاح');
        return redirect()->route('roles.index');

    }
}

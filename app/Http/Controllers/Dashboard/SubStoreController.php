<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Requests\SubStoreRequest;
use App\Models\MainStore;
use App\Models\SubStore;
use Illuminate\Http\Request;

class SubStoreController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:sub_stores_read')->only(['index']);
        $this->middleware('permission:sub_stores_update')->only(['update', 'edit']);
        $this->middleware('permission:sub_stores_create')->only(['create', 'store']);
        $this->middleware('permission:sub_stores_delete')->only(['destroy']);
    }

    public function index()
    {
        return view('Dashboard.SubStore.index');
    }

    public function getMain()
    {
        $main_stores = MainStore::all();
        return response()->json($main_stores);
    }

    public function getSub()
    {
        $sub_stores = SubStore::
        searchName(\request()->name)
            ->searchStatus(\request()->status)
            ->orderby('id', 'desc')
            ->with('mainstore')
            ->paginate(5);
        return response()->json($sub_stores);
    }


    public function store(SubStoreRequest $request)
    {

        $sub_store = SubStore::create([
            'name' => $request->name,
            'location_url' => $request->location_url,
            'main_store_id' => $request->main_store_id,
            'created_by' => auth()->user()->name

        ]);

    }


    public function update(SubStoreRequest $request, $sub_store_id)
    {

        $sub_store = SubStore::find($sub_store_id);
        $sub_store->name = $request->name;
        $sub_store->location_url = $request->location_url;
        $sub_store->main_store_id = $request->main_store_id;
        $sub_store->updated_by = auth()->user()->name;

        $sub_store->save();

    }


    public function destroy($id)
    {
        $sub_store = SubStore::find($id);
        $sub_store->delete();

    }

    public function disabled($id)
    {
        $sub_store = SubStore::find($id);
        $sub_store->update([
            'status' => -1
        ]);

    }

    public function activate($id)
    {
        $sub_store = SubStore::find($id);
        $sub_store->update([
            'status' => 1
        ]);
    }
}

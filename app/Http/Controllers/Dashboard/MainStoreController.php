<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Requests\MainStoreRequest;
use App\Models\MainStore;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;

class MainStoreController extends Controller
{
    use SoftDeletes;


    public function __construct()
    {

        $this->middleware('permission:main_stores_read')->only(['index']);
        $this->middleware('permission:main_stores_update')->only(['update', 'edit']);
        $this->middleware('permission:main_stores_create')->only(['create', 'store']);
        $this->middleware('permission:main_stores_delete')->only(['destroy']);

    }


    public function index()
    {
        return view('Dashboard.MainStore.index');
    }

    public function getMain()
    {
        $main_stores = MainStore::with('substores')
            ->searchName(\request()->name)
            ->searchStatus(\request()->status)
            ->orderby('id', 'desc')
            ->paginate(5);
        return response()->json($main_stores);
    }


    public function store(MainStoreRequest $request)
    {
        $main_store = new MainStore();
        $main_store->name = $request->name;
        $main_store->location_url = $request->location_url;
        $main_store->updated_by = 'omar AboRass';
        $main_store->save();
    }


    public function update(MainStoreRequest $request, $main_store_id)
    {
        $main_store = MainStore::find($main_store_id);
        $main_store->name = $request->name;
        $main_store->location_url = $request->location_url;
        $main_store->save();

    }


    public function destroy($id)
    {
        $main_store = MainStore::find($id);

        $main_store->delete();

    }

    public function disabled($id)
    {
        $main_store = MainStore::find($id);
        $main_store->update([
            'status' => -1
        ]);
        $main_store->substores()->update([
            'status' => -1

        ]);
    }

    public function activate($id)
    {
        $main_store = MainStore::find($id);
        $main_store->update([
            'status' => 1
        ]);
    }
}

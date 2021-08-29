<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Requests\ShelfRequest;
use App\Models\Sector;
use App\Models\Shelf;
use App\Models\SubSector;
use Illuminate\Http\Request;

class ShelfController extends Controller
{
    public function __construct()
    {


        $this->middleware('permission:sort_stores_read')->only(['index']);
        $this->middleware('permission:sort_stores_update')->only(['update', 'edit']);
        $this->middleware('permission:sort_stores_create')->only(['create', 'store']);
        $this->middleware('permission:sort_stores_delete')->only(['destroy']);

    }

    public function index()
    {
        return view('Dashboard.SortStore.shelfs');
    }

    public function store(ShelfRequest $request)
    {
        Shelf::create([
            'name' => $request->name,
            'sector_id' => $request->sector_id,

            'sub_sector_id' => $request->sub_sector_id,
            'isFilled'=>$request->isFilled

        ]);
    }

    public function get_shelfs()
    {
        if (!empty(auth()->user()->main_store_id) && empty(auth()->user()->sub_store_id)) {
            $sector_ids = Sector::where('main_store_id', auth()->user()->main_store->id)
                ->whereNull('store_id')
                ->pluck('id');
        } else {
            $sector_ids = Sector::where('store_id', auth()->user()->sub_store->id)->pluck('id');

        }
        $shelfs = Shelf::with(['sub_sector', 'sector'])
            ->searchName(\request()->name)
            ->searchSector(\request()->sector_id)
            ->searchSubSector(\request()->sub_sector_id)
            ->searchisFilled(\request()->isFilled)
            ->orderby('id', 'desc')
            ->whereIn('sector_id', $sector_ids)
            ->with('sub_sector')
            ->paginate(5);


        return \response()->json($shelfs);
    }

    public function get_sectors_shelves()
    {
        if (!empty(auth()->user()->main_store_id) && empty(auth()->user()->sub_store_id)) {
            $sectors = Sector::where('main_store_id', auth()->user()->main_store->id)
                ->whereNull('store_id')
                ->get();
        } else {
            $sectors = Sector::where('store_id', auth()->user()->sub_store->id)->get();

        }


        return \response()->json($sectors);
    }

    public function get_sub_sector_in_special_Sector()
    {
        $sector = Sector::find(\request()->sector_id);
        return \response()->json($sector->sub_sectors);

    }

    public function update(ShelfRequest $request, $id)
    {
        $shelf = Shelf::find($id);

        $shelf->update([
            'name' => $request->name,
            'sector_id' => $request->sector_id,
            'sub_sector_id' => $request->sub_sector_id,
            'isFilled'=>$request->isFilled


        ]);

    }

    public function destroy($id)
    {
        $shelfs = Shelf::find($id);

        $shelfs->delete();

    }

    public function get_all_sub_sectors()
    {
        $sub_sectors = SubSector::all();
        return \response()->json($sub_sectors);

    }

    public function get_sectors()
    {
        $sectors = Sector::all();


        return \response()->json($sectors);

    }

}

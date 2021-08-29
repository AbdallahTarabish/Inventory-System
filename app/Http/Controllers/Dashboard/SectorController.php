<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Requests\SectorRequest;
use App\Models\MainStore;
use App\Models\Sector;
use App\Models\Shelf;
use App\Models\SubSector;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class SectorController extends Controller
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
        return view('Dashboard.SortStore.sector');
    }

    public function store(SectorRequest $request)
    {

        $store_id = '';
        if (!empty(auth()->user()->main_store_id) && empty(auth()->user()->sub_store_id)) {

            Sector::create([
                'name' => $request->name,
                'main_store_id' => auth()->user()->main_store->id,
                'isFilled' => $request->isFilled

            ]);
        } else {
            Sector::create([
                'name' => $request->name,
                'main_store_id' => MainStore::query()->first()->id,
                'store_id' => auth()->user()->sub_store->id,
                'isFilled' => $request->isFilled
            ]);
        }


    }

    public function update(SectorRequest $request, $id)
    {
        $sector = Sector::find($id);

        $sector->update([
            'name' => $request->name,
            'isFilled' => $request->isFilled

        ]);

        $sector->sub_sectors()->update([
            'isFilled' => $request->isFilled
        ]);

        foreach ($sector->sub_sectors as $sub_sector) {
            $sub_sector->shelfs()->update([
                'isFilled' => $request->isFilled
            ]);
        }
    }

    public function destroy($id)
    {
        $sector = Sector::find($id);

        $sector->delete();

    }

    public function get_all_sectors(Request $request)
    {

        if (!empty(auth()->user()->main_store_id) && empty(auth()->user()->sub_store_id)) {
            $sectors = Sector::searchName($request->name)->searchisFilled($request->isFilled)
                ->orderby('id', 'desc')
                ->where('main_store_id', auth()->user()->main_store->id)
                ->whereNull('store_id')
                ->paginate(5);
        } else {
            $sectors = Sector::searchName($request->name)->searchisFilled($request->isFilled)
                ->orderby('id', 'desc')
                ->where('store_id', auth()->user()->sub_store->id)
                ->paginate(5);


        }


        return \response()->json($sectors);

    }

}

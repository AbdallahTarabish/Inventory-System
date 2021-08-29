<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Requests\SubSectorRequest;
use App\Models\Sector;
use App\Models\SubSector;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;

class SubSectorController extends Controller
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
        return view('Dashboard.SortStore.sub_sectors');
    }

    public function store(SubSectorRequest $request)
    {

        SubSector::create([
            'name' => $request->name,
            'sector_id' => $request->sector_id,
            'isFilled'=>$request->isFilled

        ]);
    }

    public function update(SubSectorRequest $request, $id)
    {
        $sub_sector = SubSector::find($id);

        $sub_sector->update([
            'name' => $request->name,
            'sector_id' => $request->sector_id,
            'isFilled'=>$request->isFilled


        ]);
        $sub_sector->shelfs()->update([
            'isFilled'=>$request->isFilled
        ]);

    }

    public function destroy($id)
    {
        $sub_sector = SubSector::find($id);

        $sub_sector->delete();

    }

    public function get_sub_sectors()
    {
        if(!empty(auth()->user()->main_store_id) && empty(auth()->user()->sub_store_id)){
           $sector_ids= Sector::where('main_store_id',auth()->user()->main_store->id)
        ->whereNull('store_id')

		->with('sector')

               ->pluck('id');
        }else{
            $sector_ids= Sector::where('store_id',auth()->user()->sub_store->id)->pluck('id');

        }

            $sub_sectors = SubSector::with('sector')
                ->searchName(\request()->name)->searchSector(\request()->sector_id)
                ->searchisFilled(\request()->isFilled)
           ->whereIn('sector_id',$sector_ids)
            ->orderby('id', 'desc')
			->with('sector')
            ->paginate(5);


        return \response()->json($sub_sectors);

    }

    public function get_sectors()
    {
        if(!empty(auth()->user()->main_store_id) && empty(auth()->user()->sub_store_id)){

            $sectors = Sector::where('main_store_id',auth()->user()->main_store->id)
                ->whereNull('store_id')
                ->get();

        }else{
            $sectors = Sector::where('store_id',auth()->user()->sub_store->id)->get();

        }


        return \response()->json($sectors);

    }


}

<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Requests\AutoSortRequest;
use App\Jobs\AutoSortStore;
use App\Models\MainStore;
use App\Models\Sector;
use App\Models\Shelf;
use App\Models\SubSector;
use Illuminate\Http\Request;

class AutoSortController extends Controller
{
    public function __construct()
    {


        $this->middleware('permission:auto_sort_stores_create')->only(['store']);


    }

    public function index()
    {
        return view("Dashboard.SortStore.auto_sort");
    }

    public function store(AutoSortRequest $request)
    {
        if (!empty(auth()->user()->main_store_id) && empty(auth()->user()->sub_store_id)) {
            $main_store_id = auth()->user()->main_store->id;
            $sub_store_id = null;
            Sector::where('main_store_id', $main_store_id)->whereNull('store_id')->delete();
        } else if (!empty(auth()->user()->main_store_id) && !empty(auth()->user()->sub_store_id)) {
            $main_store_id = MainStore::query()->first()->id;
            $sub_store_id = auth()->user()->sub_store->id;
            Sector::where('main_store_id', $main_store_id)->where('store_id', $sub_store_id)->delete();

        }

        $this->dispatch(new AutoSortStore($request->sector_count, $request->sub_sector_count, $request->shelf_count, $main_store_id, $sub_store_id));
        return redirect()->back();
    }

}

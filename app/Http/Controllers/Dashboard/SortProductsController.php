<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\MainStore;
use App\Models\Sector;
use App\Models\StoreProduct;
use Illuminate\Http\Request;

class SortProductsController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:sort_stores_create')->only(['create']);

    }

    public function index()
    {
        return view('Dashboard.SortProducts.index');
    }

    public function create()
    {
        $products = collect([]);
        $sectors = collect([]);
        $main_store_id = auth()->user()->main_store_id;
        $sub_store_id = auth()->user()->sub_store_id;

        if (!empty($sub_store_id)) {

            $products = StoreProduct::where('store_id', $sub_store_id)->get();
            $sectors = Sector::where('store_id', $sub_store_id)->get();

        } else if (!empty($main_store_id) && empty($sub_store_id)) {

            $products = StoreProduct::where('main_store_id', $main_store_id)->get();
            $sectors = Sector::where('main_store_id', $main_store_id)->get();

        } else if (empty($main_store_id) && empty($sub_store_id)) {

            $products = StoreProduct::where('main_store_id', MainStore::query()->first()->id)->get();
            $sectors = Sector::where('main_store_id', MainStore::query()->first()->id)->get();

        }


        return view('Dashboard.SortProducts.create', [
            'products' => $products,
            'sectors' => $sectors,
            'main_store_id' => $main_store_id,
            'store_id' => $sub_store_id,
            'user_id' => auth()->id(),
        ]);
    }
}

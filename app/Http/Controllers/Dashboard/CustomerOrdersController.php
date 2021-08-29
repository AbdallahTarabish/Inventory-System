<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\CustomerOrder;
use App\Models\Export;
use App\Models\MainStore;
use App\Models\StoreProduct;
use Illuminate\Http\Request;

class CustomerOrdersController extends Controller
{
    public function create()
    {

        $products = collect([]);
        $main_store_id = auth()->user()->main_store_id;
        $sub_store_id = auth()->user()->sub_store_id;

        if (!empty($sub_store_id)) {

            $products = StoreProduct::where('store_id', $sub_store_id)->get();

        } else if (!empty($main_store_id) && empty($sub_store_id)) {

            $products = StoreProduct::where('main_store_id', $main_store_id)->get();

        } else if (empty($main_store_id) && empty($sub_store_id)) {

            $products = StoreProduct::where('main_store_id', MainStore::query()->first()->id)->get();

        }

        $last_order = CustomerOrder::query()->orderBy('id', 'desc')->limit(1)->first();


        return view('Dashboard.CustomerOrders.create', [
            'products' => $products,
            'order_code' => $last_order ? $last_order->order_code + 1 : 1,
            'main_store_id' => $main_store_id,
            'store_id' => $sub_store_id,
            'user_id' => auth()->id()
        ]);
    }
}

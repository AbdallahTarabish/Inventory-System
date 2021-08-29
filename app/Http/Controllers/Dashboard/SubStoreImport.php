<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\MainStore;
use App\Models\StoreImport;
use App\Models\Product;
use App\Models\SubStore;
use App\Order;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class SubStoreImport extends Controller
{
    public function index()
    {
        if (\request()->ajax()) {
            $products = Product::with(["storeProducts" => function ($q) {
                return $q->where("store_id", \request()->store_id)->get();
            }])->get();
            return view("Dashboard.ImportToStore.subStore_table_imports", compact("products"));
        }
        $stores = SubStore::all();
        return view("Dashboard.ImportToStore.subStoreImport", compact("stores"));
    }

    public function store(Request $request)
    {

    }

    public function indexOrder()
    {
        return view("Dashboard.ImportToStore.index");
    }

    public function showOrder()
    {
        return view("Dashboard.ImportToStore.index");
    }

    public function show($id)
    {
        $order=Order::query()->with("orderDetails")->where("id" , $id)->get();
        return view("Dashboard.ImportToStore.show" , compact("order"));

    }

    public function order(Request $request)
    {
        if ($request->ajax()) {
            if (!$request->product_code) {
                session()->flash("error", "لا يوجد منتج لديه الرقم المرجعي المدخل");
            }
            $product = Product::where("reference_number", $request->product_code)->first();
            return view("Dashboard.ImportToStore.product_table", compact("product"));
        }
        return view("Dashboard.ImportToStore.order");
    }

    public function orderQuantity(Request $request)
    {
        $request_data = $request->except(["_token", "store_id", "product_code", "order_code"]);
        $order = Order::query()->create([
            "store_id" => $request->store_id,
            "date" => now(),
            "order_code" => $request->order_code,
            "status" => 1,
            "user_id" => auth()->user()->id,
        ]);
        $order->orderDetails()->createMany($request_data);
        return redirect()->back();
    }


    public function updateOrder($id)
    {
        $order = Order::query()->find($id);
        $order->update([
            "status" => "2"
        ]);
        return redirect()->back();
    }
}

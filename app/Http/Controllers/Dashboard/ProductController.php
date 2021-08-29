<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Dashboard\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Cost;
use App\Models\Product;
use App\Models\Quantity;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()){
            return Product::query()->select("id","name")->get();
        }
        $suppliers=Supplier::all();
        $categories=Category::all();
        $products = Product::whenSearchReferenceNumber($request->reference_number)
                             ->whenSearchName($request->name)
                             ->whenSearchCategory($request->category_id)
                             ->whenSearchSupplier($request->supplier_id)
                             ->get();
        return view("Dashboard.all-product.index", compact("products","categories" , "suppliers"));
    }

    public function create()
    {
        $suppliers=Supplier::all();
        if (\request()->ajax()) {
            if (\request()->has("query_reference")) {
                $reference_number = Product::query()->select(DB::raw("LEFT(reference_number, LENGTH(reference_number) - LOCATE('.', REVERSE(reference_number)))"))->get();
                return generate_unique_string(10, $reference_number);
            }
            if (\request()->has("query_container_barcode")) {
                $query_container_barcode = Product::query()->with(["costsAndprices" => function ($q) {
                    return $q->select(DB::raw("LEFT(container_barcode, LENGTH(container_barcode) - LOCATE('.', REVERSE(container_barcode)))"))->get();
                }])->get();
                return generate_unique_string(10, $query_container_barcode);
            }
            if (\request()->has("query_package_barcode")) {
                $query_package_barcode = Product::query()->with(["costsAndprices" => function ($q) {
                    return $q->select(DB::raw("LEFT(package_barcode, LENGTH(package_barcode) - LOCATE('.', REVERSE(package_barcode)))"))->get();
                }])->get();
                return generate_unique_string(10, $query_package_barcode);
            }
            if (\request()->has("query_unit_barcode")) {
                $query_unit_barcode = Product::query()->with(["costsAndprices" => function ($q) {
                    return $q->select(DB::raw("LEFT(unit_barcode, LENGTH(unit_barcode) - LOCATE('.', REVERSE(unit_barcode)))"))->get();
                }])->get();
                return generate_unique_string(10, $query_unit_barcode);
            }
            if (\request()->has("supplier_id")) {
                $supplier_id=\request()->supplier_id;
                 return Category::query()->whereHas("suppliers" , function($q) use($supplier_id)  {
                   return $q->where("suppliers.id" , $supplier_id);
               })->get();
            }
        }
        return view("Dashboard.all-product.create", compact(  "suppliers"));
    }

    public function store(ProductRequest $request)
    {
        $product_info_request = $request["product_information"];
        $quantity_info_request = $request["product_quantity"];
        $costAndPrice_info_request = $request["product_cost"];
        $product_id = Product::query()->insertGetId($product_info_request);
        $quantity_info_request["product_id"] = $product_id;
        $costAndPrice_info_request["product_id"] = $product_id;
        Quantity::query()->insertGetId($quantity_info_request);
        Cost::query()->insertGetId($costAndPrice_info_request);
        return redirect()->route("product.index");
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}

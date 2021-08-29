<?php


namespace App\Http\Controllers\Dashboard;

use App\Http\Requests\ImportRequest;
use App\Models\MainStore;
use App\Models\Quantity;
use App\Models\StoreImport;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Session\Store;
use Illuminate\Support\Arr;
use App\Models\StoreProduct;

class MainStoreImportController extends Controller
{
    public function index(Request $request)
    {
        return view("Dashboard.ImportToStore.import_2");
    }

    public function getProductAjax()
    {
        if (\request()->ajax()) {
            return Product::with("quantity")->with("category")->where("id", \request()->id)->get();
        }
    }

    public function store(ImportRequest $request)
    {

        if ( ! $request->has("product") || count($request->product) < 1){

            session()->flash("error" , "يجب اضافة منتج واحد على الاقل");
            return redirect()->back();
        }
            $request_data = array();
        if ($request->has("product")) {
            foreach ($request->product as $k => $v) {
                $request_data[$v["product_id"]] = $v;
            }
        }
        $store_import = StoreImport::query()->create([
            "import_code" => $request->code,
            "time" => now(),
            "main_store_id" => $request->store == 0 ? MainStore::query()->first()->id : null,
            "store_id" => $request->store != 0 ? $request->store : null,
            "user_id" => auth()->user()->id,
            "type" => 1,
        ]);

        foreach ($request->product as $k => $v) {
            $store_import->transaction()->create($v);
        }

        if ($request->store == 0) {
            foreach ($request_data as $k => $v) {
                if (StoreProduct::getpProductInMainStore($k)->count() > 0) {
                    $all_products_in_store = StoreProduct::getpProductInMainStore($k);
                    foreach ($all_products_in_store as $kk => $vv) {
                        $vv->update([
                            "actual_container" => $vv->actual_container + $v["imported_container"],
                        ]);
                    }
                    session()->flash("success", "تم توريد الكميات بنجاح");

                } else {
                    StoreProduct::query()->create([
                        "product_id" => $v["product_id"],
                        "actual_container" => $v["imported_container"],
                        "expected_package" => $v["expected_package"],
                        "expected_container" => $v["expected_container"],
                        "expected_unit" => $v["expected_unit"],
                        "main_store_id" => MainStore::query()->first()->id,
                    ]);
                    session()->flash("success", "تم توريد الكميات بنجاح");

                    continue;
                }
            }
        } else {

            foreach ($request_data as $k => $v) {
                $all_products_in_store = StoreProduct::getpProductInMainStore($k);
                $all_products_in_sub_store = StoreProduct::getpProductInSubStore($k, $request->store);
                if (StoreProduct::getpProductInSubStore($k, $request->store)->count() > 0) {
                    foreach ($all_products_in_store as $kk => $vv) {
                        if ($vv->actual_container > $v["imported_container"]) {
                            $vv->update([
                                "actual_container" => $vv->actual_container - $v["imported_container"],
                            ]);
                            foreach ($all_products_in_sub_store as $item) {
                                $item->update([
                                    "actual_container" => $item->actual_container + $v["imported_container"],
                                ]);
                            }
                            session()->flash("success", "تم توريد الكميات بنجاح");

                        } else {
                            $store_import->delete();
                            session()->flash("error", "نأسف ! لا يوجد كميات متوفرة");
                            return redirect()->back();
                        }
                    }
                } else {

                    foreach ($all_products_in_store as $kk => $vv) {
                        if ($vv->actual_container > $v["imported_container"] && $vv["product_id"] == $v["product_id"]) {
                            StoreProduct::query()->create([
                                "product_id" => $v["product_id"],
                                "actual_container" => $v["imported_container"],
                                "expected_package" => $v["expected_package"],
                                "expected_container" => $v["expected_container"],
                                "expected_unit" => $v["expected_unit"],
                                "store_id" => $request->store,
                            ]);
                            $vv->update([
                                "actual_container" => $vv->actual_container - $v["imported_container"],
                            ]);
                            session()->flash("success", "تم توريد الكميات بنجاح");
                        } else {
                            $store_import->delete();
                            session()->flash("error", "نأسف ! لا يوجد كميات متوفرة");
                            return redirect()->back();
                        }
                    }

                }
            }

        }
        return redirect()->back();
    }

    public function show($id)
    {

    }

}





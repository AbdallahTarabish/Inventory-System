<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\MainStore;
use App\Models\StoreImport;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{

    public function store_report_index()
    {
        return view("Dashboard.report.store_report");
    }

    public function store_report()
    {
        if (\request()->ajax()) {
            $from_date = Carbon::parse(\request()->from)->format('Y-m-d');
            $to_date = Carbon::parse(\request()->to)->format('Y-m-d');
            $main_store_id = MainStore::query()->first()->id;
            $store_column = isset(auth()->user()->sub_store) ? "store_id" : (\request()->store_id == 0 ? "main_store_id" : "store_id");
            $store_id = isset(auth()->user()->sub_store) ? auth()->user()->sub_store->id : (\request()->store_id == 0 ? $main_store_id : request()->store_id);
            $store_import = $this->get_imported_product($store_column, $store_id, $from_date, $to_date)
                ->newQuery()
                ->whereHas("transaction", function ($q) use ($from_date, $to_date) {
                    return $this->get_imported_product_subQuery($q, $from_date, $to_date);
                })->get();

            $products = Transaction::query()
                ->select([
                    'transactions.product_id',
                    DB::raw('sum(transactions.imported_container) AS imported_container'),
                ])
                ->join('store_imports', function ($join) use ($from_date, $to_date) {
                    if (request()->has("store_id")) {
                        if (\request()->store_id == 0) {
                            $join->on('store_imports.id', '=', 'transactions.store_imports_id')
                                ->where("main_store_id", MainStore::query()->first()->id)
                                ->whereBetween(DB::raw('DATE(store_imports.created_at)'), [$from_date, $to_date]);
                        } else {

                            $join->on('store_imports.id', '=', 'transactions.store_imports_id')
                                ->whereBetween(DB::raw('DATE(store_imports.created_at)'), [$from_date, $to_date])
                                ->where("store_id", \request()->store_id);
                        }
                    } else {
                        $join->on('store_imports.id', '=', 'transactions.store_imports_id')
                            ->whereBetween(DB::raw('DATE(store_imports.created_at)'), [$from_date, $to_date])
                            ->where("store_id", auth()->user()->sub_store_id);

                    }
                })
                ->groupBy("transactions.product_id")
                ->get();
            return view("Dashboard.report.store_report_table", compact('store_import', "products"));
        }
    }

    public function product_report_index()
    {

        return view("Dashboard.report.product_report");
    }

    public function product_report()
    {
        if (\request()->ajax()) {
            $from_date = Carbon::parse(\request()->from)->format('Y-m-d');
            $to_date = Carbon::parse(\request()->to)->format('Y-m-d');
            $main_store_id = MainStore::query()->first()->id;
            $store_column = isset(auth()->user()->sub_store) ? "store_id" : (\request()->store_id == 0 ? "main_store_id" : "store_id");
            $store_id = isset(auth()->user()->sub_store) ? auth()->user()->sub_store->id : (\request()->store_id == 0 ? $main_store_id : request()->store_id);
            $product_report = $this->get_imported_product($store_column, $store_id, $from_date, $to_date)
                ->newQuery()
                ->with(["transaction" => function ($q) use ($from_date, $to_date) {
                    return $this->get_imported_product_subQuery($q, $from_date, $to_date, request()->product_id);
                }])->get();

            return view("Dashboard.report.product_report_table", compact("product_report"));
        }
    }

    public function get_imported_product($store_column, $store_id, $from_date, $to_date)
    {
        return StoreImport::query()->with(["transaction" => function ($q) use ($from_date, $to_date) {
            return $q->whereBetween(DB::raw('DATE(created_at)'), [$from_date, $to_date])->get();
        }])->where($store_column, $store_id);
    }

    public function get_imported_product_subQuery($query, $from_date, $to_date, $product_id = null)
    {
        if (is_null($product_id)) {
            return $query->whereBetween(DB::raw('DATE(created_at)'), [$from_date, $to_date]);
        } else {
            return $query->where("product_id", $product_id)->whereBetween(DB::raw('DATE(created_at)'), [$from_date, $to_date]);
        }
    }

}

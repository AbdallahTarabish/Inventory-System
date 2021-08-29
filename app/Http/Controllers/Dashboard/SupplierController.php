<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Requests\CategoryRequest;
use App\Http\Requests\SupplierRequest;
use App\Models\Category;
use App\Models\Supplier;
use App\Models\SupplierSubCategory;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:suppliers_read')->only(['index']);
        $this->middleware('permission:suppliers_update')->only(['update', 'edit']);
        $this->middleware('permission:suppliers_create')->only(['create', 'store']);
        $this->middleware('permission:suppliers_delete')->only(['destroy']);
    }

    public function index()
    {
        return view('Dashboard.Supplier.index');
    }

    public function get_suppliers()
    {
        $suppliers = Supplier::with('categories')->searchName(\request()->name)
            ->orderBy('id', 'desc')
            ->paginate(2);
        return response()->json($suppliers);

    }

    public function get_sub_categories_of_supplier($id)
    {
        $supplier = Supplier::find($id);
        return response()->json($supplier->categories->pluck('id'));
    }

    public function destroy($id)
    {
        $suppliers = Supplier::find($id);
        $suppliers->delete();


    }

    public function store(SupplierRequest $request)
    {

        $supplier = Supplier::create([
            'name' => $request->name,
            'created_by' => auth()->user()->name,
            'email' => $request->email

        ]);
        $supplier->categories()->attach($request->sub_category_id);
    }

    public function update(SupplierRequest $request, $id)
    {
        $supplier = Supplier::find($id);
        $supplier->update([
            'name' => $request->name,
            'email' => $request->email
        ]);
        $supplier->categories()->sync($request->sub_category_id);
    }


}

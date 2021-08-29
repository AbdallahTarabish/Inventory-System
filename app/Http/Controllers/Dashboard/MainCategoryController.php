<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Requests\MainCategoryRequest;
use App\Models\Category;
use App\Models\MainCategory;
use Illuminate\Http\Request;

class MainCategoryController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:main_categories_read')->only(['index']);
        $this->middleware('permission:main_categories_update')->only(['update', 'edit']);
        $this->middleware('permission:main_categories_create')->only(['create', 'store']);
        $this->middleware('permission:main_categories_delete')->only(['destroy']);
    }

    public function index()
    {
        return view('Dashboard.MainCategory.index');
    }

    public function get_main_categories()
    {
        $main_categories = MainCategory::withCount('categories')->searchName(\request()->name)->searchStatus(\request()->status)
            ->orderby('id', 'desc')
            ->paginate(5);
        return response()->json($main_categories);
    }

    public function get_all_main_categories()
    {
        $main_categories = MainCategory::all();
        return response()->json($main_categories);
    }

    public function store(MainCategoryRequest $request)
    {
        $main_categories = MainCategory::create([
            'name' => $request->name,
            'description' => $request->description,
            'created_by' => auth()->user()->name
        ]);
    }

    public function update(MainCategoryRequest $request, $id)
    {

        $main_category = MainCategory::find($id);
        $main_category = $main_category->update([
            'name' => $request->name,
            'description' => $request->description,
            'updated_by' => auth()->user()->name

        ]);


    }

    public function destroy($id)
    {
        $main_category = MainCategory::find($id);
        $main_category->update([
            'deleted_by' => 'Omar AboRass'

        ]);
        //     $main_category->categories()->delete();
        $main_category->delete();
    }

    public function disabled($id)
    {
        $main_category = MainCategory::find($id);
        $main_category->update([
            'status' => -1
        ]);
        $main_category->categories()->update([
            'status' => -1

        ]);
    }

    public function activate($id)
    {
        $main_category = MainCategory::find($id);
        $main_category->update([
            'status' => 1
        ]);

    }


}

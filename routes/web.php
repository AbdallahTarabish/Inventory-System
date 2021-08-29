<?php

use App\Http\Controllers\Dashboard\CustomerOrdersController;
use App\Http\Controllers\Dashboard\ExportsController;
use App\Http\Controllers\Dashboard\SortProductsController;
use Illuminate\Support\Facades\Route;

Route::get('/', 'InvoiceController@index');
Route::get("test", function () {
    return view("Dashboard.ImportToStore.import_2");
});
Route::get('product-2', function () {
    return view("Dashboard.ImportToStore.import");
});

Auth::routes();
Route::get('logout', 'Auth\LoginController@logout');

Route::group(['middleware' => 'auth:web'], function () {
    Route::resources([
        "product" => ProductController::class,
        "import-main-store" => MainStoreImportController::class,
        "import-sub-store" => SubStoreImport::class
    ]);

    Route::get("sub-store/index", "SubStoreImport@index");
    Route::get('import-product/order', 'SubStoreImport@order');
    Route::get('import-product/order/show', 'SubStoreImport@showOrder');
    Route::get('import-product/order/show/{id}', 'SubStoreImport@show');
    Route::get('import-product/order/index', 'SubStoreImport@indexOrder');
    Route::put('import-product/order/update/{id}', 'SubStoreImport@updateOrder');
    Route::post('import-product/orderQuantity', 'SubStoreImport@orderQuantity');

    Route::get('get-product', 'MainStoreImportController@getProductAjax');

    Route::get("store/report", "ReportController@store_report");
    Route::get("store/report/index", "ReportController@store_report_index");
    Route::get("product/report/index", "ReportController@product_report_index");
    Route::get("show/product/report", "ReportController@product_report");

    /******************** Begin Main Category Route*********************/

    Route::post('main-categories/disable/{id}', 'MainCategoryController@disabled');
    Route::post('main-categories/active/{id}', 'MainCategoryController@activate');
    Route::get('get-main-categories', 'MainCategoryController@get_main_categories');
    Route::get('get-all-main-categories', 'MainCategoryController@get_all_main_categories');
    Route::post('main-categories/{id}', 'MainCategoryController@update');
    Route::resource('main-categories', 'MainCategoryController');

    /******************** End Main Category Route*********************/

    /******************** Begin  Category Route*********************/

    Route::get('get-categories', 'CategoryController@get_categories');
    Route::resource('categories', 'CategoryController');
    Route::post('categories/disable/{id}', 'CategoryController@disabled');
    Route::post('categories/active/{id}', 'CategoryController@activate');
    Route::post('categories/{id}', 'CategoryController@update');
    Route::get('get-all-sub-categories', 'MainCategoryController@get_all_sub_categories');
    /******************** End Category Route*********************/

    /*  Start Store Routes */

    Route::resource('main-stores', 'MainStoreController');
    Route::post('main-stores/update/{main_store_id}', 'MainStoreController@update');
    Route::get('get-main-store', 'MainStoreController@getMain');
    Route::post('main-stores/disable/{id}', 'MainStoreController@disabled');
    Route::post('main-stores/active/{id}', 'MainStoreController@activate');

    Route::resource('sub-stores', 'SubStoreController');
    Route::post('sub-stores/update/{sub_store_id}', 'SubStoreController@update');
    Route::get('get-sub-stores', 'SubStoreController@getSub');
    Route::get('get-main-in-sub', 'SubStoreController@getMain');
    Route::post('sub-stores/disable/{id}', 'SubStoreController@disabled');
    Route::post('sub-stores/active/{id}', 'SubStoreController@activate');


    /******************** Begin  Suppliers Route*********************/

    Route::resource('suppliers', 'SupplierController');
    Route::get('get-suppliers', 'SupplierController@get_suppliers');
    Route::get('get-all-categories', 'CategoryController@get_all_categories');
    Route::get('get-sub-category-suppliers/{id}', 'SupplierController@get_sub_categories_of_supplier');


    Route::post('suppliers/update/{id}', 'SupplierController@update');

    /******************** End Suppliers Route*********************/

    /*  Start roles Routes */
    Route::resource('roles', 'RoleController');
    /*  End roles Routes */

    /*  Start roles Routes */
    Route::resource('users', 'UserController');
    /*  End roles Routes */

    Route::resource('sectors', 'SectorController');
    Route::get('get-sectors', 'SectorController@get_all_sectors');
    Route::get('get-sub_sectors', 'SubSectorController@get_sub_sectors');
    Route::get(' get-sectors_sub_sectors', 'SubSectorController@get_sectors');
    Route::get('get_shelfs', 'ShelfController@get_shelfs');
    Route::get('get_sectors_shelves', 'ShelfController@get_sectors_shelves');
    Route::get('get_sub_sector_in_special_Sector', 'ShelfController@get_sub_sector_in_special_Sector');

    Route::get('get_all_sub_sectors', 'ShelfController@get_all_sub_sectors');

    Route::post('shelfs/{id}', 'ShelfController@update');


    Route::post('sectors/{id}', 'SectorController@update');
    Route::post('sub_sectors/{id}', 'SubSectorController@update');


    Route::resource('sub_sectors', 'SubSectorController');
    Route::resource('shelfs', 'ShelfController');
    Route::resource('auto_sort', 'AutoSortController');

    // Exports Routes
    Route::get('/exports', [ExportsController::class, 'index'])->name('exports.index');
    Route::get('/exports/create', [ExportsController::class, 'create'])->name('exports.create');

    Route::get('store_products', [SortProductsController::class, 'index'])->name('product_sort.index');

    // Sort Products in Store
    Route::get('product_sort/create', [SortProductsController::class, 'create'])->name('product_sort.create');

    Route::get('customer_order/create',[CustomerOrdersController::class,'create'])->name('customer_order.create');
});


Route::get('/home', 'HomeController@index')->name('home');


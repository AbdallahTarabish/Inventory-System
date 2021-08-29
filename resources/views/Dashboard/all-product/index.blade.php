@extends('Dashboard.index')
@section('content')
<?php
  breadCrumb(config("breadcrumb.show_product"));
   ?>


    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid ">
        <div class="kt-portlet kt-portlet--mobile">
            <div class="kt-portlet__head kt-portlet__head--lg">
                <div class="kt-portlet__head-label">
										<span class="kt-portlet__head-icon">
											<i class="kt-font-brand flaticon2-line-chart"></i>
										</span>
                    <h3 class="kt-portlet__head-title ">
                        معلومات المنتجات
                    </h3>
                </div>
                <div class="kt-portlet__head-toolbar">
                    <div class="kt-portlet__head-wrapper">
                        <div class="kt-portlet__head-actions">
                            <div class="dropdown dropdown-inline">
                                <button type="button" class="btn btn-default btn-icon-sm dropdown-toggle"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="la la-download"></i> تصدير
                                </button>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <ul class="kt-nav">
                                        <li class="kt-nav__section kt-nav__section--first">
                                            <span class="kt-nav__section-text">اختر</span>
                                        </li>
                                        <li class="kt-nav__item">
                                            <a href="#" class="kt-nav__link">
                                                <i class="kt-nav__link-icon la la-print"></i>
                                                <span class="kt-nav__link-text">طباعة</span>
                                            </a>
                                        </li>
                                        <li class="kt-nav__item">
                                            <a href="#" class="kt-nav__link">
                                                <i class="kt-nav__link-icon la la-copy"></i>
                                                <span class="kt-nav__link-text">نسخ</span>
                                            </a>
                                        </li>
                                        <li class="kt-nav__item">
                                            <a href="#" class="kt-nav__link">
                                                <i class="kt-nav__link-icon la la-file-excel-o"></i>
                                                <span class="kt-nav__link-text">Excel</span>
                                            </a>
                                        </li>
                                        <li class="kt-nav__item">
                                            <a href="#" class="kt-nav__link">
                                                <i class="kt-nav__link-icon la la-file-text-o"></i>
                                                <span class="kt-nav__link-text">CSV</span>
                                            </a>
                                        </li>
                                        <li class="kt-nav__item">
                                            <a href="#" class="kt-nav__link">
                                                <i class="kt-nav__link-icon la la-file-pdf-o"></i>
                                                <span class="kt-nav__link-text">PDF</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            &nbsp;
                            <a href="{{ route("product.create") }}" class="btn btn-brand btn-elevate btn-icon-sm ">
                                <i class="fa fa-plus-circle"></i>
                                منتج جديد
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="kt-padding-25" style="background-color: #F8F8F8">
                <form action="" method="get">
                    <div class="form-group row align-items-end">
                        <div class="col-md-3">
                            <label> أبحث بواسطة الرقم المرجعي</label>
                            <input type="text" name="reference_number" class="form-control" placeholder="أبحث بواسطة الرقم المرجعي">
                        </div>
                        <div class="col-md-2">
                            <label> أبحث بواسطة الاسم</label>
                            <input type="text" name="name" class="form-control" placeholder="أبحث بواسطة الاسم">
                        </div>

                        <div class="col-md-3">
                            <label> التصينف</label>
                            <select type="text" name="category_id" class="form-control select_2">
                                <option value="">الكل</option>
                                @foreach($categories as $category)
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-2">
                            <label> المورد</label>
                            <select type="text" name="supplier_id" class="form-control select_2">
                                <option value="">الكل</option>
                                @foreach($suppliers as $supplier)
                                    <option value="{{$supplier->id}}">{{$supplier->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-2">
                            &nbsp; <button type="submit"  class="btn btn-info btn-elevate btn-icon-sm">
                                <i class="fa fa-search"></i>
                                جلب
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="kt-portlet__body">

                <!--begin: Datatable -->
                <table class="table table-striped- table-bordered table-hover table-checkable text-center"
                       id="kt_table_1">
                    <thead>
                    <tr>
                        <th colspan="6">المعلومات العامة للمنتج</th>
                        <th colspan="3">معلومات التخزين و الكميات</th>
                        <th colspan="7">اسعار البيع و التكلفة</th>
                    </tr>
                    <tr>
                        <th>#</th>
                        <th>الرقم المرجعي</th>
                        <th>الاسم</th>
                        <th>الصنف</th>
                        <th>المورد</th>
                        <th>المصنوعية</th>
                        <th> الحاويات المتوقعة</th>
                        <th> الزرم المتوقعة</th>
                        <th> القطع المتوقعة</th>
                        <th>تكلفة الحاوية</th>
                        <th>بيع الحاوية</th>
                        <th>تكلفة الرزمة</th>
                        <th>بيع الرزمة</th>
                        <th>تكلفة الحبة</th>
                        <th>بيع الحبة</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($products as $product)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{$product->reference_number}}</td>
                        <td>{{$product->name}}</td>
                        @if(isset($product->category))
                            <td>{{$product->category->name}}</td>
                        @else
                            <td style="color: red">غير مدخل</td>
                        @endif
                        <td>{{$product->supplier->name}}</td>
                        <td>{{$product->manufacturer}}</td>
                        @if(isset($product->quantity))
                        <td>{{ $product->quantity ->max_container }} </td>
                        <td>{{ $product->quantity ->max_package }} </td>
                        <td>{{ $product->quantity ->max_unit }} </td>
                        @else
                            <td style="color: red">غير مدخل</td>
                            <td style="color: red">غير مدخل</td>
                            <td style="color: red">غير مدخل</td>
                        @endif

                        @if(isset($product->costsAndprices))
                            <td>{{ $product->costsAndprices ->cost_of_one_container }}</td>
                            <td>{{ $product->costsAndprices ->price_of_one_container }} </td>
                            <td>{{ isset($product->costsAndprices ->cost_of_one_package) ?$product->costsAndprices ->cost_of_one_package :"غير مدخل" }}  </td>
                            <td>{{ isset($product->costsAndprices ->price_of_one_package) ?$product->costsAndprices ->price_of_one_package :"غير مدخل" }}  </td>
                            <td>{{ isset($product->costsAndprices ->cost_of_one_unit)?$product->costsAndprices ->cost_of_one_unit:"غير مدخل" }} </td>
                            <td>{{ isset($product->costsAndprices ->price_of_one_unit) ?$product->costsAndprices ->price_of_one_unit:"غير مدخل" }}  </td>

                        @else
                            <td style="color: red">غير مدخل</td>
                            <td style="color: red">غير مدخل</td>
                            <td style="color: red">غير مدخل</td>
                            <td style="color: red">غير مدخل</td>
                            <td style="color: red">غير مدخل</td>
                            <td style="color: red">غير مدخل</td>

                        @endif

                    </tr>
                    @endforeach
                    </tbody>
                </table>

                <!--end: Datatable -->
            </div>
        </div>
    </div>

@endsection

@extends('Dashboard.index')
@section('content')
    @php
        breadCrumb(config("breadcrumb.create_store"));
    @endphp

    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid ">
        <div class="kt-portlet kt-portlet--mobile">
            <div class="kt-portlet__head kt-portlet__head--lg">
                <div class="kt-portlet__head-label">
										<span class="kt-portlet__head-icon">
											<i class="kt-font-brand flaticon2-line-chart"></i>
										</span>
                    <h3 class="kt-portlet__head-title ">
                        معلومات الطلبيات
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
                            <a href="#" class="btn btn-brand btn-elevate btn-icon-sm ">
                                <i class="la la-plus"></i>
                                حقل جديد
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="kt-portlet__body">

                <!--begin: Datatable -->
                <table class="table table-striped- table-bordered table-hover table-checkable" id="kt_table_1">
                    <thead>
                    <tr>
                        <th colspan="2">معلومات الطلب</th>
                        <th colspan="3">معلومات التسوق</th>
                        <th colspan="3">معلومات الشركة</th>
                        <th colspan="3">الحالة</th>
                    </tr>
                    <tr>
                        <th>#</th>
                        <th>رقم الطلب</th>
                        <th>الدولة</th>
                        <th>المدينة</th>
                        <th>العنوان</th>
                        <th>الشركة</th>
                        <th>اسم الشركة</th>
                        <th>التاريخ</th>
                        <th>الحالة</th>
                        <th>النوع</th>
                        <th>الاجراءات</th>
                    </tr>
                    </thead>
                    <tbody>
                    @for($i=1; $i<15; $i++)
                        <tr>
                            <td>{{ $i }}</td>
                            <td>{{ $i*1500 }}</td>
                            <td>فلسطين</td>
                            <td>القدس</td>
                            <td>الشارع الثالث</td>
                            <td>شركة شركة</td>
                            <td>الطابق الثالث</td>
                            <td>8/5/2016</td>
                            <td>معلق</td>
                            <td>{{ $i*100 }}</td>
                            <td nowrap></td>
                        </tr>
                    @endfor

                    </tbody>
                </table>

                <!--end: Datatable -->
            </div>
        </div>
    </div>

@endsection

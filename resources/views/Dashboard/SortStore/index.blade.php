@extends('Dashboard.index')
@section('content')
    <?php
    breadCrumb(config("breadcrumb.main_stores"));
    ?>

    <div class="modal fade" id="kt_modal_4" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">اضافة صنف جديد</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <form method="post" type="{{route('sort_stores.store')}}"
                >
                    @csrf

                    <div class="modal-body">
                        <div class="form-group">
                            <label class="form-control-label"> عدد القطاعات الرئيسية :</label>
                            <input type="number" class="form-control" name="count_sector">
                        </div>
                        <div class="form-group">
                            <label class="form-control-label">عدد القطاعات الفرعية:</label>
                            <input type="number" class="form-control" name="count_sub_sector">
                        </div>
                        <div class="form-group">
                            <label class="form-control-label">عدد الرفوف في القطاعات الفرعية :</label>
                            <input type="number" class="form-control" name="count_shelf">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
                            <button type="submit" class="btn btn-primary">حفظ</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="kt_modal_5" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">اضافة صنف جديد</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <form method="post" type="{{route('sort_stores.store')}}"
                >
                    @csrf

                    <div class="modal-body">
                        <div class="form-group">
                            <label class="form-control-label">القطاع الرئيسي :</label>
                            <input type="number" class="form-control" name="count_sector">
                        </div>
                        <div class="form-group">
                            <label class="form-control-label"> القطاع الفرعي:</label>
                            <input type="number" class="form-control" name="count_sub_sector">
                        </div>
                        <div class="form-group">
                            <label class="form-control-label">الرف:</label>
                            <input type="number" class="form-control" name="count_shelf">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
                            <button type="submit" class="btn btn-primary">حفظ</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="kt-container kt-container--fluid kt-grid__item kt-grid__item--fluid">
        <!--begin::Portlet-->
        <div class="kt-portlet kt-portlet--mobile h-100">
            <div class="kt-portlet__head kt-portlet__head--lg">
                <div class="kt-portlet__head-label">
                              <span class="kt-portlet__head-icon">
                                 <i class="kt-font-brand flaticon2-line-chart"></i>
                              </span>
                    <h3 class="kt-portlet__head-title">
                        ترتيب المخزن
                    </h3>
                </div>
                <div class="kt-portlet__head-toolbar">
                    <div class="kt-portlet__head-wrapper">
                        <div class="kt-portlet__head-actions">
                            <div class="dropdown dropdown-inline">
                                <button type="button" class="btn btn-default btn-icon-sm dropdown-toggle"
                                        data-toggle="dropdown-menu" aria-haspopup="true" aria-expanded="false">
                                    <i class="la la-download"></i> Export
                                </button>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <ul class="kt-nav">
                                        <li class="kt-nav__section kt-nav__section--first">
                                            <span class="kt-nav__section-text">Choose an option</span>
                                        </li>
                                        <li class="kt-nav__item">
                                            <a href="#" class="kt-nav__link">
                                                <i class="kt-nav__link-icon la la-print"></i>
                                                <span class="kt-nav__link-text">Print</span>
                                            </a>
                                        </li>
                                        <li class="kt-nav__item">
                                            <a href="#" class="kt-nav__link">
                                                <i class="kt-nav__link-icon la la-copy"></i>
                                                <span class="kt-nav__link-text">Copy</span>
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
                            <button v-show="this.CheckPremission('main_categories_create')" type="button"
                                    class="btn btn-brand btn-elevate btn-icon-sm"
                                    data-toggle="modal" data-target="#kt_modal_4"><i
                                    class="fa fa-plus-circle"></i>
                                الترتيب بشكل تلقائي
                            </button>
                            <button v-show="this.CheckPremission('main_categories_create')" type="button"
                                    class="btn btn-brand btn-elevate btn-icon-sm"
                                    data-toggle="modal" data-target="#kt_modal_5"><i
                                    class="fa fa-plus-circle"></i>
                                الترتيب بشكل يدوي
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="kt-padding-25" style="background-color: #F8F8F8">
                <form id="search_form">
                    <div class="form-group row align-items-end">
                        <div class="col-md-4">
                            <label>الاسم</label>
                            <div class="input-group ">
                                <input type="text" name="name"
                                       class="form-control " placeholder="ادخل الاسم"/>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label> الحالة</label>
                            <select class=" form-control ">
                                <option value="">الكل</option>
                                <option value="1">مفعل</option>
                                <option value="-1">معطل</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <button type="button" href=""
                                    class="btn btn-info btn-elevate btn-icon-sm">
                                <i class="fa fa-search"></i>
                                بحث
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="kt-portlet__body">
                <h3 class="mb-4"></h3>
                <div class="table-responsive">
                    <table class="table table-bordered products-table">
                        <thead>
                        <tr class="text-center">
                            <th class="font-weight-bold "> العمود الرئيسي</th>
                            <th class="font-weight-bold ">العمود الفرعي</th>
                            <th class="font-weight-bold ">الرف</th>
                            <th class="font-weight-bold ">المكان</th>

                            <th class="font-weight-bold ">الاجراءات</th>
                        </tr>
                        </thead>
                        <tbody>


                        </tbody>
                    </table>
                </div>

            </div>
        </div>
        <!--end::Portlet-->
    </div>

@endsection


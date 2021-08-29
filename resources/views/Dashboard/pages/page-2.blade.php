@extends('Dashboard.index')
@section('content')

    @php
        breadCrumb(config("breadcrumb.create_store"));
    @endphp

    <div class="kt-container kt-container--fluid kt-grid__item kt-grid__item--fluid">
        <div class="row">

            <div class="col-xl-6 mx-auto">
                <!--begin::Portlet-->
                <div class="kt-portlet kt-portlet--mobile">
                    <div class="kt-portlet__head">
                        <div class="kt-portlet__head-label">
                            <h3 class="kt-portlet__head-title">
                                طباعة Barcode
                            </h3>
                        </div>
                    </div>
                    <div class="kt-portlet__body">

                        <div class="col-lg-6">
                            <label>رقم المنتج</label>
                            <div class="input-group inputId">
                                <input type="text" class="form-control" placeholder="أدخل رقم المنتج">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="button">جلب</button>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 my-4">
                            <h3 class="mb-4">المنتجات</h3>
                            <div class="table-responsive">
                                <table class="table table-bordered products-table">
                                    <thead>
                                    <tr>
                                        <th>رقم المنتج</th>
                                        <th>اسم المنتج</th>
                                        <th>الكمية</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>طباعة</label>
                            <div class="kt-checkbox-inline">
                                <label class="kt-checkbox kt-checkbox--bold kt-checkbox--brand">
                                    <input type="checkbox"> اسم الشركة
                                    <span></span>
                                </label>
                                <label class="kt-checkbox kt-checkbox--bold kt-checkbox--brand">
                                    <input type="checkbox"> اسم المنتج
                                    <span></span>
                                </label>
                                <label class="kt-checkbox kt-checkbox--bold kt-checkbox--brand">
                                    <input type="checkbox"> السعر
                                    <span></span>
                                </label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="exampleSelect1">نوع الباركود</label>
                            <select class="form-control">
                                <option>باركود 1</option>
                                <option>باركود 2</option>
                                <option>باركود 3</option>
                                <option>باركود 4</option>
                                <option>باركود 5</option>
                            </select>
                        </div>

                    </div>

                    <div class="kt-portlet__foot">
                        <div class="kt-form__actions">
                            <button type="reset" class="btn btn-primary">تحديث</button>
                        </div>
                    </div>
                </div>
                <!--end::Portlet-->
            </div>

        </div>
    </div>
    <script id="product-template" type="text/x-custom-template">
        <tr>
            <th scope="row" class="productId"></th>
            <td>منتج #1</td>
            <td><input type="text" class="form-control"></td>
        </tr>
    </script>
@endsection


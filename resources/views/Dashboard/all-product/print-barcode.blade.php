@extends('Dashboard.index')
@section('content')

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
                        <div class="kt-portlet__head-label">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-barcode"></i>طباعة </button>
                        </div>

                    </div>
                    <div class="kt-portlet__body">

                        <div class="col-lg-6">
                            <label>الرقم المرجعي للمنتج</label>
                            <div class="input-group inputId">
                                <input type="text" class="form-control" placeholder="الرقم المرجعي للمنتج">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="button">  جلب</button>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 my-4">
                            <h3 class="mb-4">المنتجات</h3>
                            <div class="table-responsive">
                                <table class="table table-bordered products-table">
                                    <thead>
                                    <tr>
                                        <th class="text-center">الرقم المرجعي للمنتج</th>
                                        <th>اسم المنتج</th>
                                        <th> الحاويات</th>
                                        <th> الرزم</th>
                                        <th> القطع</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <th scope="row" class="text-center">461564484623</th>
                                        <td>منتج #1</td>
                                        <td>منتج #1</td>
                                        <td>منتج #1</td>
                                        <td>منتج #1</td>
                                    </tr>

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
                            <label>طباعة</label>
                            <div class="kt-checkbox-inline">
                                <label class="kt-checkbox kt-checkbox--bold kt-checkbox--brand">
                                    <input type="checkbox"> باكود للقطع
                                    <span></span>
                                </label>
                                <label class="kt-checkbox kt-checkbox--bold kt-checkbox--brand">
                                    <input type="checkbox"> باركود للحاوية
                                    <span></span>
                                </label>
                                <label class="kt-checkbox kt-checkbox--bold kt-checkbox--brand">
                                    <input type="checkbox"> باركود للرزم
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
                </div>
                <!--end::Portlet-->
            </div>

        </div>
    </div>
@endsection


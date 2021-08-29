@extends('Dashboard.index')


@section('content')
    <div class="kt-container kt-container--fluid kt-grid__item kt-grid__item--fluid">

        <!--begin::Portlet-->
        <div class="kt-portlet kt-portlet--mobile h-100">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title">
                        فواتير عمليات التوريد
                    </h3>
                </div>
            </div>
            <div class="kt-portlet__body">
                <div class="row">

                    {{--                    <div class="col-md-4">--}}
                    {{--                        <div class="form-group">--}}
                    {{--                            <label>التاريخ</label>--}}
                    {{--                            <div class="input-group date">--}}
                    {{--                                <input type="text" class="form-control datepicker-date" placeholder="اختر التاريخ"/>--}}
                    {{--                                <div class="input-group-append">--}}
                    {{--                                    <span class="input-group-text"><i class="la la-calendar glyphicon-th"></i></span>--}}
                    {{--                                </div>--}}
                    {{--                            </div>--}}
                    {{--                        </div>--}}
                    {{--                    </div>--}}

                    {{--                    <div class="col-md-4">--}}
                    {{--                        <div class="form-group">--}}
                    {{--                            <label>الرقم المرجعي</label>--}}
                    {{--                            <input type="text" class="form-control">--}}
                    {{--                        </div>--}}
                    {{--                    </div>--}}

                    {{--                    <div class="col-md-4">--}}
                    {{--                        <div class="form-group">--}}
                    {{--                            <label>المخزن</label>--}}
                    {{--                            <select class="form-control stores">--}}
                    {{--                                <option value="1">مخزن 1</option>--}}
                    {{--                                <option value="2">مخزن 2</option>--}}
                    {{--                                <option value="3">مخزن 3</option>--}}
                    {{--                            </select>--}}
                    {{--                        </div>--}}
                    {{--                    </div>--}}

                    {{--                    <div class="col-lg-4 mr-auto">--}}
                    {{--                        <label>رقم المنتج</label>--}}
                    {{--                        <div class="input-group inputId">--}}
                    {{--                            <input type="text" class="form-control" placeholder="أدخل رقم المنتج">--}}
                    {{--                            <div class="input-group-append">--}}
                    {{--                                <button class="btn btn-primary" type="button">جلب</button>--}}
                    {{--                            </div>--}}
                    {{--                        </div>--}}
                    {{--                    </div>--}}

                    <div class="col-12 my-4">
                        <h3 class="mb-4">الفواتير</h3>
                        <div class="table-responsive">
                            <table class="table table-bordered products-table">
                                <thead>
                                <tr>
                                    <th>رقم العملية</th>
                                    <th>رقم المنتج</th>
                                    <th>اسم المنتج</th>
                                    <th>المخزن</th>
                                    <th>التاريخ</th>
                                    <th>الحاويات</th>
                                    <th>الرزم</th>
                                    <th>الوحدات</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($transactions as $transaction)
                                    <tr>
                                        <td>{{$transaction->store_import->import_code}}</td>
                                        <td>{{$transaction->product->reference_number}}</td>
                                        <td>{{$transaction->product->name}}</td>
                                        <td>{{$transaction->store_import->MainStore ? $transaction->store_import->MainStore->name : $transaction->store_import->SubStore->name}}</td>
                                        <td>{{$transaction->store_import->time}}</td>
                                        <td>{{$transaction->imported_container}}</td>
                                        <td>{{$transaction->imported_package}}</td>
                                        <td>{{$transaction->imported_unit}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="col-12">
                        <h3 class="mb-4">الملاحظات</h3>
                        <div id="kt_quil_1" style="height: 325px">
                            أدرج ملاحظاتك هنا
                        </div>
                    </div>
                    <div class="col-12 mt-4">
                        <h3 class="mb-4">المرفقات</h3>
                        <div class="dropzone dropzone-default dropzone-brand" id="kt_dropzone_2">
                            <div class="dropzone-msg dz-message needsclick">
                                <h3 class="dropzone-msg-title">قم بإسقاط الملفات هنا.</h3>
                                <span class="dropzone-msg-desc">تحميل ما يصل إلى 10 ملفات</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end::Portlet-->

    </div>
    {{--    <script id="product-template" type="text/x-custom-template">--}}
    {{--        <tr>--}}
    {{--            <th scope="row" class="productId"></th>--}}
    {{--            <td>منتج #1</td>--}}
    {{--            <td>--}}
    {{--                <select class="form-control">--}}
    {{--                    <option>موقع منتج 1</option>--}}
    {{--                    <option>موقع منتج 2</option>--}}
    {{--                    <option>موقع منتج 3</option>--}}
    {{--                    <option>موقع منتج 4</option>--}}
    {{--                    <option>موقع منتج 5</option>--}}
    {{--                </select>--}}
    {{--            </td>--}}
    {{--            <td>--}}
    {{--                <select class="form-control">--}}
    {{--                    <option>إضافة</option>--}}
    {{--                    <option>إزالة</option>--}}
    {{--                </select>--}}
    {{--            </td>--}}
    {{--            <td><input type="text" class="form-control"></td>--}}
    {{--        </tr>--}}
    {{--    </script>--}}
@endsection

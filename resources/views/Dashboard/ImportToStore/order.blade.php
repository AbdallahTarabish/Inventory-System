
@extends('Dashboard.index')
@section('content')
    <?php
    breadCrumb(config("breadcrumb.order_quantity"));
    ?>
    <div class="kt-container kt-container--fluid kt-grid__item kt-grid__item--fluid">
        <form action="{{url("import-product/orderQuantity")}}" method="POST">

            <!--begin::Portlet-->
            <div class="kt-portlet kt-portlet--mobile h-100">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">
                            طلب كميات منتجات
                        </h3>
                    </div>
                    <div class="kt-portlet__head-toolbar">
                        <div class="kt-portlet__head-wrapper">
                            <div class="kt-portlet__head-actions">&nbsp;
                                <button class="btn btn-brand btn-elevate btn-icon-sm import_btn ">
                                    <i class="flaticon-refresh"></i>
                                    طلب
                                </button>
                            </div>
                        </div>
                    </div>

                </div>
                @csrf
                <div class="kt-portlet__body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>التاريخ</label>
                                <div class="input-group date">
                                    <input type="text" value="{{now()}}" disabled class="form-control datepicker-date"
                                           placeholder="اختر التاريخ"/>
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i
                                                class="la la-calendar glyphicon-th"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>رقم الطلبية</label>
                                    <input type="text"  class="form-control" name="order_code" value="{{ generate_unique_string(9 , \App\Order::query()->select(\Illuminate\Support\Facades\DB::raw("LEFT(order_code, LENGTH(order_code) - LOCATE('.', REVERSE(order_code)))"))->get()) }}">
                            </div>
                        </div>


                        <div class="col-lg-4 mr-auto">
                            <label>الرقم المرجعي للمنتج</label>
                            <div class="input-group inputId">
                                <input type="text" class="form-control product_code" name="product_code" placeholder="أدخل الرقم  المرجعي للمنتج">
                                <div class="input-group-append">
                                    <button class="btn btn-primary get_product" type="button">جلب</button>
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
                                        <th>التصنيف</th>
                                        <th>الوحدة</th>
                                        <th>الرزم المتوقعة في كل حاوية</th>
                                        <th>القطع المتوقعة في كل رزمة</th>
                                        <th>الحاويات المطلوبة</th>
                                    </tr>
                                    </thead>
                                    <tbody class="tbody-product ">
                                    @if(isset($product))
                                        @include("Dashboard.ImportToStore.product_table" , ["product" =>$product])
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <!--end::Portlet-->
        </form>

    </div>

    @push("script")
        <script>
            $(document).ready(function () {
                $(".get_product").on("click", function () {

                    let product_code = $(".product_code").val();
                    $.ajax({
                        type: "GET",
                        url: window.location.href,
                        data: {
                            product_code: product_code
                        },
                        success: function (data) {
                            $(".tbody-product").append(data)
                        }
                    })
                })
            })
        </script>

    @endpush
@endsection

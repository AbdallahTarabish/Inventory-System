@extends('Dashboard.index')
@section('content')
    <?php
    breadCrumb(config("breadcrumb.order_quantity"));
    ?>
    <div class="kt-container kt-container--fluid kt-grid__item kt-grid__item--fluid">

            <!--begin::Portlet-->
            <div class="kt-portlet kt-portlet--mobile h-100">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">
                            تفاصيل الطلبية
                        </h3>
                    </div>

                </div>
                <div class="kt-portlet__body">
                    <div class="row">

                        <div class="col-12 my-4">
                            <h3 class="mb-4">التفاصيل العامة</h3>
                            <div class="table-responsive">
                                <table class="table table-bordered products-table">
                                    <thead>
                                    <tr>
                                        <th>رقم الطلبية</th>
                                        <th>تاريخ الطلبية</th>
                                        <th>المخزن</th>
                                        <th>الحالة</th>
                                    </tr>
                                    </thead>
                                    <tbody class="tbody-product ">
                                    @foreach($order as $result)
                                            <tr>
                                                <td>{{ $result->order_code }}</td>
                                                <td>{{ $result->date }}</td>
                                                <td>{{$result->store?$result->store->name:\App\Models\MainStore::query()->first()->name}}</td>
                                                <td>{{ $result->status }}</td>
                                            </tr>

                                    @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="row">

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
                                        <th>الحاويات المطلوبة</th>
                                    </tr>
                                    </thead>
                                    <tbody class="tbody-product ">
                                    @foreach($order as $result)
                                        @foreach($result->orderDetails as $result_2)

                                        <tr>
                                            <td>{{ $result_2->product->reference_number }}</td>
                                            <td>{{ $result_2->product->name }}</td>
                                            <td>{{ $result_2->product->category->name }}</td>
                                            <td>{{ $result_2->product->unit }}</td>
                                            <td>{{ $result_2->ordered_container }}</td>
                                    </tr>
                                        @endforeach

                                    @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <!--end::Portlet-->

    </div>

@endsection

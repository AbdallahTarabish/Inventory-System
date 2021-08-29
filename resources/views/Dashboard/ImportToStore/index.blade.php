@extends('Dashboard.index')
@section('content')
    <?php
    breadCrumb(config("breadcrumb.order_quantity"));
    ?>
    <!-- begin:: Content -->
    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">

        <div class="row">
            <div class="col-xl-12">

                <!--Begin:: Portlet-->
                <div class="kt-portlet kt-portlet--tabs">
                    <div class="kt-portlet__head">
                        <div class="kt-portlet__head-toolbar">
                            <ul class="nav nav-tabs nav-tabs-space-lg nav-tabs-line nav-tabs-bold nav-tabs-line-3x nav-tabs-line-brand" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#kt_apps_contacts_view_tab_2" role="tab">
                                        <i class="fa fa-pause-circle"></i> الطلبيات المعلقة
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link " data-toggle="tab" href="#kt_apps_contacts_view_tab_1" role="tab">
                                        <i class="fa fa-check-circle"></i> الطلبيات المكتملة
                                    </a>
                                </li>

                            </ul>
                        </div>
                    </div>
                    <div class="kt-portlet__body">
                        <div class="tab-content kt-margin-t-20">
                            <!--Begin:: Tab Content-->
                            <div class="tab-pane active" id="kt_apps_contacts_view_tab_2" role="tabpanel">
                                <table class="table table-bordered products-table">
                                    <thead>
                                    <tr class="text-center">
                                        <th>رقم الطلبية</th>
                                        <th>المخزن</th>
                                        <th>المستخدم</th>
                                        <th>التاريخ</th>
                                        <th>الحالة</th>
                                        <th>الاجراء</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach(\App\Order::query()->where("status" , 1)->get() as $item)
                                        <tr class="text-center">
                                            <td>{{$item->order_code}}</td>
                                            <td>{{$item->store?$item->store->name:\App\Models\MainStore::query()->first()->name}}</td>
                                            <td>{{$item->user->name}}</td>
                                            <td>{{$item->date}}</td>
                                            <td>{{$item->status}}</td>
                                            <td>
                                                <form action="{{url("import-product/order/update" , $item->id)}}" method="POST" style="display: inline-block" >
                                                    @csrf @method("PUT")
                                                    <button type="submit"  class="btn  btn-info btn-sm " style="color: white"><i class="fa fa-play-circle" style="color: white"></i>تم التنفيذ</button>
                                                </form>

                                                <a href="{{url("import-product/order/show" , $item->id)}}" class="btn btn-info btn-sm"><i class="fa fa-eye"> </i>عرض</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!--End:: Tab Content-->

                            <!--Begin:: Tab Content-->
                            <div class="tab-pane" id="kt_apps_contacts_view_tab_1" role="tabpanel">
                                <table class="table table-bordered products-table">
                                    <thead>
                                    <tr class="text-center">
                                        <th>رقم الطلبية</th>
                                        <th>المخزن</th>
                                        <th>عدد المنتجات</th>
                                        <th>المستخدم</th>
                                        <th>التاريخ</th>
                                        <th>الحالة</th>
                                        <th>الاجراءات</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach(\App\Order::query()->where("status" , 2)->get() as $item)
                                    <tr class="text-center">
                                        <td>{{$item->order_code}}</td>
                                        <td>{{$item->store?$item->store->name:\App\Models\MainStore::query()->first()->name}}</td>
                                        <td>{{$item->orderDetails->count()}}</td>
                                        <td>{{$item->user->name}}</td>
                                        <td>{{$item->date}}</td>
                                        <td>{{$item->status}}</td>
                                        <td>
                                            <a href="{{url("import-product/order/show" , $item->id)}}" class="btn btn-info btn-sm"><i class="fa fa-eye"> </i>عرض</a>

                                        </td>
                                    </tr>
                                    @endforeach

                                    </tbody>
                                </table>

                            </div>
                            <!--End:: Tab Content-->

                        </div>
                    </div>
                </div>
                <!--End:: Portlet-->
            </div>
        </div>
    </div>
    <!-- end:: Content -->
@endsection

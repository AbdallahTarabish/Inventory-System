@extends('Dashboard.index')
@section('content')
    @push("style")
    <style>
        .overlay{
            display: none;
            position: fixed;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            z-index: 999;
            background: rgba(255,255,255,0.8) url("{{asset("assets/media/loader.gif")}}") center no-repeat;
        }
        /* Turn off scrollbar when body element has the loading class */
        body.loading{
            overflow: hidden;
        }
        /* Make spinner image visible when body element has the loading class */
        body.loading .overlay{
            display: block;
        }

    </style>
    @endpush
    <?php
    breadCrumb(config("breadcrumb.order_quantity"));
    ?>
    <div class="overlay"></div>

    <div class="kt-container kt-container--fluid kt-grid__item kt-grid__item--fluid">
        <!--begin::Portlet-->
        <div class="kt-portlet kt-portlet--mobile h-100">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title">
                        تقارير المخازن
                    </h3>
                </div>

            </div>
            <div class="kt-portlet__body">

                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>التاريخ من </label>
                            <div class="input-group date">
                                <input type="text" id="from-date"  class="form-control datepicker-date" autocomplete="off"
                                       placeholder="اختر التاريخ"/>
                                <div class="input-group-append">
                                        <span class="input-group-text"><i
                                                class="la la-calendar glyphicon-th"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label>التاريخ الى </label>
                            <div class="input-group date">
                                <input type="text" id="to-date" autocomplete="off"  class="form-control datepicker-date"
                                       placeholder="اختر التاريخ"/>
                                <div class="input-group-append">
                                        <span class="input-group-text"><i
                                                class="la la-calendar glyphicon-th"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if(! isset(auth()->user()->sub_store))
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>اختر المخزن </label>
                                <select name="store_id" class="form-control select_2 store_id" >
                                    <option value="">اختر</option>
                                    <option value=0"">{{ \App\Models\MainStore::query()->first()->name }}</option>
                                    @foreach(\App\Models\SubStore::all() as $store )
                                        <option value="{{$store->id}}">{{$store->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    @endif

                    <div class="my-auto">
                        <button class="btn btn-primary  create_report" type="button"><i class="fa fa-plus-circle"></i>انشاء</button>
                    </div>


                    <div class="row col-md-12 product_table">
                        @if(isset($store_import))
                            @include("Dashboard.report.store_report_table" , ["store_import"  => $store_import])
                        @endif

                    </div>
                </div>


            </div>

        </div>
        <!--end::Portlet-->

    </div>
@push("script")
<script>
    $(document).ready(function () {
        $(document).on({
            ajaxStart: function(){
                $("body").addClass("loading");
            },
            ajaxStop: function(){
                $("body").removeClass("loading");
            }
        });

        var arrows;
        if (KTUtil.isRTL()) {
            arrows = {
                leftArrow: '<i class="la la-angle-right"></i>',
                rightArrow: '<i class="la la-angle-left"></i>'
            }
        } else {
            arrows = {
                leftArrow: '<i class="la la-angle-left"></i>',
                rightArrow: '<i class="la la-angle-right"></i>'
            }
        }

        $('.datepicker-date').datepicker({
            rtl: KTUtil.isRTL(),
            todayHighlight: true,
            orientation: "bottom left",
            templates: arrows ,
            dateFormat:'YYYY-MM-DD'
        });

        $(".create_report").on("click" ,  function () {
            $from= $("#from-date").val()
            $to= $("#to-date").val()
            $store_value=$(".store_id").val()
            $store_id= $store_value ? $store_value :0;
            $.ajax({
                type:"GET" ,
                url:"{{url("store/report")}}" ,
                data:{
                    "from" : $from ,
                    "to" :$to ,
                    "store_id" : $store_id ,
                },
                success:function (data) {
                    $(".product_table").html(data)
                }
            })
        })

    })
</script>
@endpush
@endsection

@extends('Dashboard.index')
@section('content')
    <?php
    breadCrumb(config("breadcrumb.creat_product"));
    ?>
    @push("style")
        <style>

            .custom-input {
                border-top: none;
                border-left: none;
                border-left: none;
                border-right: none;
            }
        </style>
    @endpush
    <div class="kt-container kt-container--fluid kt-grid__item kt-grid__item--fluid">
        <form action="{{route("import-main-store.store")}}" method="POST">

            <!--begin::Portlet-->
            <div class="kt-portlet kt-portlet--mobile h-100">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">
                            صرف الطلبيات للمخازن الفرعية
                        </h3>
                    </div>
                    <div class="kt-portlet__head-toolbar">
                        <div class="kt-portlet__head-wrapper">
                            <div class="kt-portlet__head-actions">&nbsp;
                                <button type="submit" >

                                    توريد
                                </button>
                            </div>
                        </div>
                    </div>

                </div>
                @csrf
                <div class="kt-portlet__body">
                    <div class="row">
                        <div class="col-lg-4 mr-auto">
                            <label>اختر المخزن</label>
                                <select name="store_id" class="form-control stores select_2" id="stores">
                                    <option value="">الكل</option>
                                    @foreach($stores as $store)
                                        <option value="{{$store->id}}">{{$store->name}}</option>
                                    @endforeach
                                </select>
                        </div>

                        @php

                         $code =  \App\Models\StoreImport::query()->select(DB::raw("LEFT(import_code, LENGTH(import_code) - LOCATE('.', REVERSE(import_code)))"))->get();
                            @endphp
                        <input type="hidden" name="import_code" value="{{generate_unique_string(10 , $code)}}">
                        <input type="hidden" name="time" value="{{now()}}">
                        <div class="col-12 my-4">
                            <h3 class="mb-4">المنتجات</h3>
                            <div class="table-responsive">
                                <table class="table table-bordered products-table">
                                    <thead>
                                    <tr>
                                        <th>الرقم المرجعي</th>
                                        <th>الاسم</th>
                                        <th>الصنف</th>
                                        <th>المورد</th>
                                        <th>المصنوعية</th>
                                        <th>الوحدة</th>
                                        <th> الحاويات </th>
                                        <th> الزرم </th>
                                        <th> القطع </th>
                                    </tr>
                                    </thead>
                                    <tbody class="tbody-product ">
                                    <input type="hidden" name="store_id" class="store_id">
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
                $("#check_all").on("click", function () {
                    $(this).closest('table').find('td input:checkbox').prop('checked', this.checked);
                })

                $(".stores").on("change", function () {

                    let store_id = $(this).val();
                    $(".store_id").val(store_id)
                    $.ajax({
                        type: "GET",
                        url: window.location.href,
                        data: {
                            store_id: store_id
                        },
                        success: function (data) {
                            $(".tbody-product").html(data)
                        }
                    })
                })

                $(document).on('click', '.import_btn', function (e) {
                    e.preventDefault();
                    $item_count = $('.item_checkbox:checked').length;
                    if ($item_count > 0) {
                        $("#formdata").submit()
                    } else {
                        swal.fire({
                            "title": "",
                            "text": "يجب أختيار نوع المنتج المراد توريده",
                            "type": "error",
                            "confirmButtonText": "تم"
                        });

                    }
                })
            })
        </script>
    @endpush
@endsection

@extends('Dashboard.index')
@section('content')
    <?php
    breadCrumb(config("breadcrumb.creat_product"));
    ?>
    <!--begin::Portlet-->
    <div class="kt-portlet">

        <!--begin::Form-->
        <form class="kt-form" method="POST" id="form-add" action="{{route("import-main-store.store")}}">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-label">
										<span class="kt-portlet__head-icon kt-hidden">
											<i class="la la-gear"></i>
										</span>
                    <h3 class="kt-portlet__head-title">
                        توريد منتجات للمخازن
                    </h3>
                </div>
                <div class="kt-portlet__head-toolbar">
                    <div class="kt-portlet__head-wrapper">
                        <div class="kt-portlet__head-actions">&nbsp;
                            <button class="btn btn-brand btn-elevate btn-icon-sm import_btn ">
                                <i class="fa fa-plus-circle"></i>
                                توريد
                            </button>
                        </div>
                    </div>
                </div>

            </div>

            @csrf
            <div class="kt-portlet__body">
                <div class="kt-form__section kt-form__section--first">
                    <div class="form-group row">
                        <table class="table table-bordered">
                            <thead>
                            <th>التاريخ و الساعة</th>
                            <th>المخزن</th>

                            <th>كود عملية التوريد</th>
                            <th> المستخدم المستلم</th>
                            </thead>

                            <tbody>
                            <tr>
                                <td>
                                    <input type="text" readonly name="time" value="{{now()}}" class="form-control"
                                           placeholder="التاريخ و الساعة">
                                </td>
                                <td style="width: 25%">
                                    <select required name="store" class="form-control select_2" style="width: 100%">
                                        <option value="">اختر</option>
                                        <option value="0">{{\App\Models\MainStore::query()->first()->name}}</option>
                                        @foreach( \App\Models\SubStore::all() as $store)
                                            <option value="{{$store->id}}">{{$store->name}}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <input type="text" readonly name="code" class="form-control"
                                           value="@php echo get_import_code() @endphp" placeholder="كود عملية التوريد">
                                </td>
                                <td>
                                    <input type="text" readonly value="{{auth()->user()->name}}"
                                           class="form-control" placeholder="أمين المخزن">
                                </td>

                            </tr>
                            </tbody>
                        </table>

                    </div>
                    <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg"></div>

                    <div class="d-flex justify-content-end mb-2 ">
                        <button type="button" id="add_row" class="btn btn-info mb-2">اضافة</button>

                    </div>
                    <table class="table table-bordered product_table">
                        <thead>
                        <tr>
                            <th>الاسم</th>
                            <th>الصنف</th>
                            <th>الوحدة</th>
                            <th> الحاويات المتوقعة</th>
                            <th> الزرم المتوقعة في الحاوية</th>
                            <th> القطع المتوقعة في الرزمة</th>
                            <th> عدد الحاويات الموردة</th>
                            <th> المجموع</th>
                            <th> ازالة</th>
                        </tr>
                        </thead>

                        <tbody class="product_tbody">
                        </tbody>
                    </table>

                </div>
            </div>
        </form>

        <!--end::Form-->
    </div>

    <!--end::Portlet-->
    @push("script")
        <script>
            $(document).ready(function () {

                let product_name = "", i = 0;
                $("#add_row").on("click", function (e) {
                    e.preventDefault();
                    i++;
                    $.ajax({
                        type: "GET",
                        url: "{{route("product.index")}}",
                        success: function (data) {
                            product_name = "";
                            console.log(data)
                            if (data.length < 1){
                                Swal.fire('لا يوجد منتجات عامة' ,'يرجى ادخال منتجات عامة','error');
                            }
                            $.each(data, function ($k, $v) {
                                product_name += `<option value="${$v["id"]}">${$v["name"]}</option>`;
                            })
                            if (product_name.length > 0) {
                                $('.product_tbody').append(`
                                <tr class="product_tr">
                                    <td>
                                        <select required name="product[${i}][product_id]" id="product_id" class="form-control select_product">"><option>اختر</option> ${product_name}</select>
                                    </td>
                       <td class="category"></td>
                            <td class="unit"></td>
                            <td><input readonly type="text" required name="product[${i}][expected_container]" class="form-control  expected_container">
                            </td>
                            <td><input readonly type="text" required name="product[${i}][expected_package]" class="form-control expected_package">
                            </td>
                            <td><input readonly type="text" required name="product[${i}][expected_unit]" class="form-control expected_unit">
                            </td>
                            <td>
                                <input type="text" required name="product[${i}][imported_container]" class="form-control imported_container">
                            </td>
                            <td class="count">0</td>

                            <td>
                                <button type="button"   class="btn btn-danger btn-sm delete_btn"><i class="fa fa-trash"></i></button>
                            </td>

</tr>
                            `);

                            }
                        }
                    })
                    // console.log(product_name);

                })
                $(document).on("change", ".select_product", function () {
                    let $this = $(this);
                    $.ajax({
                        type: "GET",
                        url: "{{url("get-product")}}",
                        data: {
                            id: $this.val()
                        },
                        success: function (data) {
                            $.each(data, function ($k, $v) {
                                $this.closest(".product_tr").find($(".category")).html($v["category"]["name"])
                                $this.closest(".product_tr").find($(".expected_container")).val($v["quantity"]["max_container"])
                                $this.closest(".product_tr").find($(".expected_package")).val($v["quantity"]["max_package"])
                                $this.closest(".product_tr").find($(".expected_unit")).val($v["quantity"]["max_unit"])
                                $this.closest(".product_tr").find($(".unit")).html($v["unit"])

                            })
                        }
                    })
                })
                $(document).on("change", ".imported_container", function () {
                    let $this = $(this);

                    $this.closest(".product_tr").find($(".count")).html(
                        parseInt($this.val()) * (
                            parseInt($this.closest(".product_tr").find($(".expected_package")).val()) *
                            parseInt($this.closest(".product_tr").find($(".expected_unit")).val())
                        )
                    );
                })

                $(document).on("click", ".delete_btn", function () {
                    let $this = $(this);
                    $this.closest(".product_tr").remove();
                })

            })

        </script>
    @endpush
@endsection

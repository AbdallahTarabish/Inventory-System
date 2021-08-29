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
    <form action="{{ route("import-main-store.store") }}" id="formdata" method="post">
        @csrf
        <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid ">
            <div class="kt-portlet kt-portlet--mobile">
                <div class="kt-portlet__head kt-portlet__head--lg">
                    <div class="kt-portlet__head-label">
										<span class="kt-portlet__head-icon">
											<i class="kt-font-brand flaticon2-line-chart"></i>
										</span>
                        <h3 class="kt-portlet__head-title ">
                            توريد منتجات للمخزن الرئيسي
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
                <div class="kt-padding-25" style="background-color: #F8F8F8">
                    <div class="row align-items-end">
                        <div class="col-md-2"></div>
                        <div class="col-md-3">

                            <span class="kt-menu__link-icon">

                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                     width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24"/>
                                            <path
                                                d="M12,22 C7.02943725,22 3,17.9705627 3,13 C3,8.02943725 7.02943725,4 12,4 C16.9705627,4 21,8.02943725 21,13 C21,17.9705627 16.9705627,22 12,22 Z"
                                                fill="#000000" opacity="0.3"/>
                                            <path
                                                d="M11.9630156,7.5 L12.0475062,7.5 C12.3043819,7.5 12.5194647,7.69464724 12.5450248,7.95024814 L13,12.5 L16.2480695,14.3560397 C16.403857,14.4450611 16.5,14.6107328 16.5,14.7901613 L16.5,15 C16.5,15.2109164 16.3290185,15.3818979 16.1181021,15.3818979 C16.0841582,15.3818979 16.0503659,15.3773725 16.0176181,15.3684413 L11.3986612,14.1087258 C11.1672824,14.0456225 11.0132986,13.8271186 11.0316926,13.5879956 L11.4644883,7.96165175 C11.4845267,7.70115317 11.7017474,7.5 11.9630156,7.5 Z"
                                                fill="#000000"/>
                                        </g>
                                    </svg>

                            </span>
                            <span class="kt-menu__link-text">التاريخ و الساعة :</span><i></i>
                            <span class="kt-menu__link-text date_time">{{ now() }} </span><i></i>
                        </div>

                        <div class="col-md-3">

                            <span class="kt-menu__link-icon">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                     height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <rect x="0" y="0" width="24" height="24"/>
                        <path
                            d="M8,3 L8,3.5 C8,4.32842712 8.67157288,5 9.5,5 L14.5,5 C15.3284271,5 16,4.32842712 16,3.5 L16,3 L18,3 C19.1045695,3 20,3.8954305 20,5 L20,21 C20,22.1045695 19.1045695,23 18,23 L6,23 C4.8954305,23 4,22.1045695 4,21 L4,5 C4,3.8954305 4.8954305,3 6,3 L8,3 Z"
                            fill="#000000" opacity="0.3"/>
                        <path
                            d="M11,2 C11,1.44771525 11.4477153,1 12,1 C12.5522847,1 13,1.44771525 13,2 L14.5,2 C14.7761424,2 15,2.22385763 15,2.5 L15,3.5 C15,3.77614237 14.7761424,4 14.5,4 L9.5,4 C9.22385763,4 9,3.77614237 9,3.5 L9,2.5 C9,2.22385763 9.22385763,2 9.5,2 L11,2 Z"
                            fill="#000000"/>
                        <rect fill="#000000" opacity="0.3" x="10" y="9" width="7" height="2" rx="1"/>
                        <rect fill="#000000" opacity="0.3" x="7" y="9" width="2" height="2" rx="1"/>
                        <rect fill="#000000" opacity="0.3" x="7" y="13" width="2" height="2" rx="1"/>
                        <rect fill="#000000" opacity="0.3" x="10" y="13" width="7" height="2" rx="1"/>
                        <rect fill="#000000" opacity="0.3" x="7" y="17" width="2" height="2" rx="1"/>
                        <rect fill="#000000" opacity="0.3" x="10" y="17" width="7" height="2" rx="1"/>
                    </g>
                </svg>

                            </span>
                            <span class="kt-menu__link-text">رقم التوريد :</span><i></i>
                            <span class="kt-menu__link-text import_code">
                            @php
                                $import_code= \App\Models\StoreImport::query()->select(DB::raw("LEFT(import_code, LENGTH(import_code) - LOCATE('.', REVERSE(import_code)))"))->get();
                                 echo generate_unique_string(10 , $import_code)
                            @endphp
                            </span><i></i>
                            <input type="hidden" name="import_code" id="import_code">
                            <input type="hidden" name="time" id="date_time">
                            <input type="hidden" name="user_id" value="{{auth()->user()->id}}">


                        </div>
                        <div class="col-md-3">

                            <span class="kt-menu__link-icon">
<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
     viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <polygon points="0 0 24 0 24 24 0 24"/>
        <path
            d="M18,8 L16,8 C15.4477153,8 15,7.55228475 15,7 C15,6.44771525 15.4477153,6 16,6 L18,6 L18,4 C18,3.44771525 18.4477153,3 19,3 C19.5522847,3 20,3.44771525 20,4 L20,6 L22,6 C22.5522847,6 23,6.44771525 23,7 C23,7.55228475 22.5522847,8 22,8 L20,8 L20,10 C20,10.5522847 19.5522847,11 19,11 C18.4477153,11 18,10.5522847 18,10 L18,8 Z M9,11 C6.790861,11 5,9.209139 5,7 C5,4.790861 6.790861,3 9,3 C11.209139,3 13,4.790861 13,7 C13,9.209139 11.209139,11 9,11 Z"
            fill="#000000" fill-rule="nonzero" opacity="0.3"/>
        <path
            d="M0.00065168429,20.1992055 C0.388258525,15.4265159 4.26191235,13 8.98334134,13 C13.7712164,13 17.7048837,15.2931929 17.9979143,20.2 C18.0095879,20.3954741 17.9979143,21 17.2466999,21 C13.541124,21 8.03472472,21 0.727502227,21 C0.476712155,21 -0.0204617505,20.45918 0.00065168429,20.1992055 Z"
            fill="#000000" fill-rule="nonzero"/>
    </g>
</svg>

                            </span>
                            <span class="kt-menu__link-text">المستلم :</span><i></i>
                            <span class="kt-menu__link-text">{{auth()->user()->name}} </span><i></i>


                        </div>
                    </div>
                </div>

                <div class="kt-portlet__body">

                    <!--begin: Datatable -->
                    <table class="table  table-bordered  text-center"
                           id="kt_table_1">
                        <thead>
                        <tr>
                            <th colspan="7">المعلومات العامة للمنتج</th>
                            <th colspan="7">معلومات التخزين و الكميات</th>
                        </tr>
                        <tr>
                            <th>
                                <label class="kt-checkbox kt-checkbox--brand ">

                                    <input type="checkbox" id="check_all">
                                    <span></span>
                                </label>

                            </th>
                            <th>الرقم المرجعي</th>
                            <th>الاسم</th>
                            <th>الصنف</th>
                            <th>المورد</th>
                            <th>المصنوعية</th>
                            <th>الوحدة</th>
                            <th> الحاويات المتوقعة</th>
                            <th> الزرم المتوقعة</th>
                            <th> القطع المتوقعة</th>
                            <th> الحاويات المتوفرة</th>
                            <th> الزرم المتوفرة</th>
                            <th> القطع المتوفرة</th>
                        </tr>

                        </thead>
                        <tbody>

                        @foreach($products as $product)
                            <tr class="product_tr">
                                <td>
                                    <label class="kt-checkbox kt-checkbox--brand item_checkbox">
                                        <input type="checkbox" value="{{$product->id}}"
                                               class="item_checkbox"
                                               name="checked_product[]">
                                        <span></span>
                                    </label>
                                </td>
                                <td style="width: 120px">{{ $product->reference_number }}</td>
                                <td style="width: 120px">{{ $product->name }}</td>
                                <td style="width: 120px">
                                    {{ $product->category->name }}
                                </td>
                                <td style="width: 120px"> {{ $product->supplier->name }}</td>
                                <td style="width: 120px">
                                    {{ $product->manufacturer }}

                                </td>
                                <td>
                                    {{ $product->unit }}
                                </td>
                                <td>
                                    <input type="text" name="{{$product->id}}[actual_container]"
                                           value="{{ calc_mean_value($product->quantity->max_container , $product->quantity->min_container)  }}"
                                           class="form-control text-center custom-input expected_container aa">
                                </td>
                                <td>
                                    <input type="text"
                                           name="{{$product->id}}[actual_package]"
                                           value="{{ calc_mean_value($product->quantity->max_package , $product->quantity->min_package)  }}"
                                           class="form-control text-center custom-input expected_package">
                                    <input type="hidden" name="{{$product->id}}[product_id]"
                                           value="{{$product->id}}"
                                           class="form-control text-center custom-input expected_package">
                                </td>
                                <input type="hidden" name="@if(! isset(auth()->user()->main_store)) {{$product->id}}[main_store_id]@else {{$product->id}}[store_id] @endif" value="@if(! isset(auth()->user()->main_store)){{\App\Models\MainStore::first()->id}} @else {{auth()->user()->sub_store->id}}@endif">

                                <td>
                                    <input type="text"
                                           name="{{$product->id}}[actual_unit]"
                                           value="{{ calc_mean_value($product->quantity->max_unit , $product->quantity->min_unit)  }}"
                                           class="form-control text-center custom-input expected_unit">
                                </td>
                                <input type="hidden" name="{{$product->id}}[imported_container]"
                                       class="imported_container">
                                <input type="hidden" name="{{$product->id}}[imported_package]" class="imported_package">
                                <input type="hidden" name="{{$product->id}}[imported_unit]" class="imported_unit">


                                @if(isset($product->storeProducts) && $product->storeProducts->count() > 0)
                                    <td><input type="text"
                                               value="{{$product->storeProducts->actual_container}}"
                                               class="form-control text-center custom-input actual_container">
                                    </td>
                                    <td><input type="text"

                                               value="{{$product->storeProducts->actual_package}}"
                                               class="form-control text-center custom-input actual_package">
                                    </td>
                                    <td>
                                        <input type="text" value="{{$product->storeProducts->actual_unit}}"
                                               class="form-control text-center custom-input actual_unit">
                                    </td>


                                @else
                                    <td><input type="text"
                                               value="0"
                                               class="form-control text-center custom-input actual_container">
                                    </td>
                                    <td><input type="text"

                                               value="0"
                                               class="form-control text-center custom-input actual_package">
                                    </td>
                                    <td>
                                        <input type="text" value="0"
                                               class="form-control text-center custom-input actual_unit">
                                    </td>
                                @endif

                                @endforeach
                            </tr>
                        </tbody>
                    </table>

                    <!--end: Datatable -->

                    <label class="kt-checkbox kt-checkbox--bold">
                        <input type="checkbox">ارسال رسالة للمورد عند استلام الطلبية
                        <span></span>
                    </label>
                    <label class="kt-checkbox kt-checkbox--bold">
                        <input type="checkbox">تحميل نسخة مطبوعة من عملية التوريد
                        <span></span>
                    </label>

                    <!--end: Datatable -->
                </div>
            </div>
        </div>

    </form>
    @push("script")
        <script>
            $(document).ready(function () {
                $("#check_all").on("click", function () {
                    $(this).closest('table').find('td input:checkbox').prop('checked', this.checked);
                })
                $import_code = $(".import_code").text()
                $date_time = $(".date_time").text()
                $("#import_code").val($import_code)
                $("#date_time").val($date_time)

                changeTheInputValue(".expected_container", ".actual_container")
                changeTheInputValue(".expected_package", ".actual_package")
                changeTheInputValue(".expected_unit", ".actual_unit")
                $(".imported_container").val($(".expected_container").val())
                $(".imported_package").val($(".expected_package").val())
                $(".imported_unit").val($(".expected_unit").val())
                setValueOfInput(".expected_container" , ".imported_container")
                setValueOfInput(".expected_package" , ".imported_package")
                setValueOfInput(".expected_unit" , ".imported_unit")


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

            function setValueOfInput($class_of_get_value, $class_of_set_value) {
                $($class_of_get_value).on("change", function () {
                    var parent = $(this).closest(".product_tr"),
                        value_1 = parseInt($(this).val());
                    parent.find($class_of_set_value).val(value_1)
                });
            }
            function changeTheInputValue($expected, $actual) {

                $($expected).on('change', function () {
                    var parent = $(this).closest(".product_tr"),
                        value_1 = parseInt($(this).val());
                    parent.find($actual).val(parseInt(parent.find($actual).val()) + value_1)
                })
            }
        </script>
    @endpush
@endsection

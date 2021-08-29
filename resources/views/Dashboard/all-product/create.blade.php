@extends('Dashboard.index')
@section('content')
    <?php
    breadCrumb(config("breadcrumb.creat_product"));
    ?>
    @push("style")
        <link href="{{ asset("assets/css/pages/wizard/wizard-4.css") }}" rel="stylesheet" type="text/css"/>
    @endpush

    <!-- begin:: Content -->
    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
        <div class="kt-wizard-v4" id="kt_wizard_v4" data-ktwizard-state="step-first">

            <!--begin: Form Wizard Nav -->
            <div class="kt-wizard-v4__nav">
                <div class="kt-wizard-v4__nav-items">

                    <!--doc: Replace A tag with SPAN tag to disable the step link click -->
                    <div class="kt-wizard-v4__nav-item" data-ktwizard-type="step" data-ktwizard-state="current">
                        <div class="kt-wizard-v4__nav-body">
                            <div class="kt-wizard-v4__nav-number mr-2">
                                1
                            </div>
                            <div class="kt-wizard-v4__nav-label">
                                <div class="kt-wizard-v4__nav-label-title">
                                    المعلومات العامة للمنتج
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="kt-wizard-v4__nav-item" data-ktwizard-type="step">
                        <div class="kt-wizard-v4__nav-body">
                            <div class="kt-wizard-v4__nav-number mr-2">
                                2
                            </div>
                            <div class="kt-wizard-v4__nav-label">
                                <div class="kt-wizard-v4__nav-label-title">
                                    معلومات الكميات
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="kt-wizard-v4__nav-item" data-ktwizard-type="step">
                        <div class="kt-wizard-v4__nav-body">
                            <div class="kt-wizard-v4__nav-number mr-2">
                                3
                            </div>
                            <div class="kt-wizard-v4__nav-label">
                                <div class="kt-wizard-v4__nav-label-title">
                                    معلومات البيع و التكلفة

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="kt-wizard-v4__nav-item" data-ktwizard-type="step">
                        <div class="kt-wizard-v4__nav-body">
                            <div class="kt-wizard-v4__nav-number mr-2">
                                4
                            </div>
                            <div class="kt-wizard-v4__nav-label">
                                <div class="kt-wizard-v4__nav-label-title">
                                    المرفقات
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!--end: Form Wizard Nav -->
            <div class="kt-portlet">
                <div class="kt-portlet__body kt-portlet__body--fit">
                    <div class="kt-grid">
                        <div class="kt-grid__item kt-grid__item--fluid kt-wizard-v4__wrapper">

                            <!--begin: Form Wizard Form-->
                            <form class="kt-form" id="kt_form" action="{{ route("product.store") }}" method="POST">
                            @csrf
                            <!--begin: Form Wizard Step 1-->
                                <div class="kt-wizard-v4__content" data-ktwizard-type="step-content"
                                     data-ktwizard-state="current">
                                    <div class="kt-heading kt-heading--md">أدخل المعلومات العامة للمنتج</div>
                                    <div class="kt-form__section kt-form__section--first">
                                        <div class="kt-wizard-v4__form">

                                            <div class="form-group">
                                                <label>اسم المنتج </label>
                                                <input type="text" class="form-control" name="product_information[name]"
                                                       placeholder="مثال : لابتوب تشويبا الجيل الخامس">
                                                <span
                                                    style="color:  red">{{ $errors->first('product_information.name') }}</span>

                                            </div>
                                            <div class="row">
                                                <div class="form-group col-6">
                                                    <label>الماركة</label>
                                                    <input type="text" class="form-control"
                                                           name="product_information[brand]"
                                                           placeholder="مثال : ماركة صينية">
                                                    <span
                                                        style="color:  red">{{ $errors->first('product_information.brand') }}</span>

                                                </div>

                                                <div class="col-lg-6 mr-auto">
                                                    <label>الرقم المرجعي للمنتج</label>
                                                    <div class="input-group inputId">
                                                        <input type="text" class="form-control"
                                                               id="reference_number"
                                                               name="product_information[reference_number]"
                                                               readonly
                                                               placeholder="الرقم المرجعي للمنتج">

                                                        <div class="input-group-append">
                                                            <button class="btn btn-primary " id="generate_number"
                                                                    type="button"><i
                                                                    class="text-white flaticon-refresh"></i>انشاء
                                                            </button>
                                                        </div>
                                                    </div>
                                                    <span
                                                        style="color:  red">{{ $errors->first('product_information.reference_number') }}</span>

                                                </div>

                                                <div class="col-xl-6">
                                                    <div class="form-group">
                                                        <label>المورد</label>
                                                        <select name="product_information[supplier_id]"
                                                                class="form-control select_2 supplier_id">
                                                            <option value="">اختر</option>
                                                            @foreach($suppliers as $supplier)
                                                                <option
                                                                    value="{{ $supplier->id }}">{{$supplier->name}}</option>

                                                            @endforeach
                                                        </select>
                                                        <span
                                                            style="color:  red">{{ $errors->first('product_information.supplier_id') }}</span>

                                                    </div>
                                                </div>

                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label>اختر التصنيف</label>
                                                        <select name="product_information[category_id]"
                                                                class="form-control select_2 supplier_category">
                                                            <option value="">اختر</option>
                                                        </select>
                                                        <span
                                                            style="color:  red">{{ $errors->first('product_information.category_id') }}</span>

                                                    </div>
                                                </div>

                                            </div>

                                            <div class="row">
                                                <div class="col-xl-6">
                                                    <div class="form-group">
                                                        <label>الوحدة</label>
                                                        <input type="text" class="form-control"
                                                               placeholder="مثال : بالقطعة"
                                                               name="product_information[unit]">
                                                        <span
                                                            style="color:  red">{{ $errors->first('product_information.unit') }}</span>

                                                    </div>
                                                </div>

                                                <div class="form-group col-6">
                                                    <label>المصنوعية </label>
                                                    <input type="text" class="form-control"
                                                           placeholder="مثال : صنع في الصين"
                                                           name="product_information[manufacturer]">
                                                    <span
                                                        style="color:  red">{{ $errors->first('product_information.manufacturer') }}</span>

                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!--end: Form Wizard Step 1-->

                                <!--begin: Form Wizard Step 2-->
                                <div class="kt-wizard-v4__content" data-ktwizard-type="step-content">
                                    <div class="kt-heading kt-heading--md">أدخل معلومات الكميات</div>
                                    <div class="kt-form__section kt-form__section--first">
                                        <div class="kt-wizard-v4__form">
                                            <div class="form-group row">
                                                <label class="col-form-label col-4">عدد الحاويات</label>
                                                <div class="col-6">
                                                    <input  type="text" class="form-control kt_touchspin_2"
                                                           value="0" name="product_quantity[max_container]"
                                                           placeholder="Select time" type="text">
                                                    <span
                                                        style="color:  red">{{ $errors->first('product_quantity.max_container') }}</span>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-form-label col-4">عدد الرزم داخل الحاوية</label>
                                                <div class="col-6">
                                                    <input  type="text" class="form-control kt_touchspin_2"
                                                           value="0" name="product_quantity[max_package]"
                                                           placeholder="Select time" type="text">
                                                    <span
                                                        style="color:  red">{{ $errors->first('product_quantity.max_container') }}</span>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-form-label col-4">عدد الوحدات داخل الرزم</label>
                                                <div class="col-6">
                                                    <input  type="text" class="form-control kt_touchspin_2"
                                                            value="0" name="product_quantity[max_unit]"
                                                            placeholder="Select time" type="text">
                                                    <span
                                                        style="color:  red">{{ $errors->first('product_quantity.max_container') }}</span>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <!--end: Form Wizard Step 2-->

                                <!--begin: Form Wizard Step 3-->
                                <div class="kt-wizard-v4__content" data-ktwizard-type="step-content">
                                    <div class="kt-heading kt-heading--md">أدخل معلومات البيع و التكلفة</div>
                                    <div class="kt-form__section kt-form__section--first">
                                        <div class="kt-wizard-v4__form">
                                            <div class="form-group row">
                                                <div class="col-4">
                                                    <label class="col-12">تكلفة الحاوية الواحدة</label>
                                                    <input type="text" class="form-control"
                                                           placeholder="أدخل تكلفة الحاوية الواحدة"
                                                           name="product_cost[cost_of_one_container]">
                                                    <span
                                                        style="color:  red">{{ $errors->first('product_cost.cost_of_one_container') }}</span>

                                                </div>

                                                <div class="col-4">
                                                    <label class="col-12">سعر بيع الحاوية الواحدة</label>
                                                    <input type="text" class="form-control"
                                                           placeholder="أدخل سعر بيع الحاوية الواحدة "
                                                           name="product_cost[price_of_one_container]">
                                                    <span
                                                        style="color:  red">{{ $errors->first('product_cost.price_of_one_container') }}</span>

                                                </div>
                                                <div class="col-lg-4">
                                                    <label>باركود</label>
                                                    <div class="input-group inputId">
                                                        <input type="text" class="form-control"
                                                               id="container_barcode_input"
                                                               placeholder="أدخل رقم للباركود"
                                                               readonly
                                                               name="product_cost[container_barcode]">

                                                        <div class="input-group-append">
                                                            <button class="btn btn-primary" id="container_barcode"
                                                                    type="button"><i
                                                                    class="fa fa-barcode text-white"></i>انشاء
                                                            </button>
                                                        </div>
                                                    </div>
                                                    <span
                                                        style="color:  red">{{ $errors->first('product_cost.container_barcode') }}</span>
                                                </div>

                                            </div>
                                            <div class="form-group row">
                                                <div class="col-4">
                                                    <label class="col-12">تكلفة الرزمة الواحدة</label>
                                                    <input type="text" class="form-control"
                                                           placeholder="أدخل تكلفة الرزمة الواحدة"
                                                           name="product_cost[cost_of_one_package]">
                                                    <span
                                                        style="color:  red">{{ $errors->first('product_cost.cost_of_one_package') }}</span>

                                                </div>

                                                <div class="col-4">
                                                    <label class="col-12">سعر بيع الرزمة الواحدة</label>
                                                    <input type="text" class="form-control"
                                                           placeholder="أدخل سعر بيع الرزمة الواحدة "
                                                           name="product_cost[price_of_one_package]">
                                                    <span
                                                        style="color:  red">{{ $errors->first('product_cost.price_of_one_package') }}</span>

                                                </div>
                                                <div class="col-lg-4">
                                                    <label>باركود</label>
                                                    <div class="input-group inputId">
                                                        <input type="text" class="form-control"
                                                               placeholder="أدخل رقم للباركود"
                                                               id="package_barcode_input"
                                                               readonly
                                                               name="product_cost[package_barcode]">

                                                        <div class="input-group-append">
                                                            <button class="btn btn-primary" id="package_barcode"
                                                                    type="button"><i
                                                                    class="fa fa-barcode text-white"></i>انشاء
                                                            </button>
                                                        </div>

                                                    </div>
                                                    <span
                                                        style="color:  red">{{ $errors->first('product_cost.package_barcode') }}</span>
                                                </div>

                                            </div>
                                            <div class="form-group row">
                                                <div class="col-4">
                                                    <label class="col-12">تكلفة القطعة الواحدة</label>
                                                    <input type="text" class="form-control"
                                                           placeholder="أدخل تكلفة القطعة الواحدة"
                                                           name="product_cost[cost_of_one_unit]">
                                                    <span
                                                        style="color:  red">{{ $errors->first('product_cost.cost_of_one_unit') }}</span>

                                                </div>

                                                <div class="col-4">
                                                    <label class="col-12">سعر بيع القطعة الواحدة</label>
                                                    <input type="text" class="form-control"
                                                           placeholder="أدخل سعر بيع القطعة الواحدة "
                                                           name="product_cost[price_of_one_unit]">
                                                    <span
                                                        style="color:  red">{{ $errors->first('product_cost.price_of_one_unit') }}</span>

                                                </div>
                                                <div class="col-lg-4">
                                                    <label>باركود</label>
                                                    <div class="input-group inputId">
                                                        <input type="text" class="form-control"
                                                               placeholder="أدخل رقم للباركود"
                                                               id="unit_barcode_input"
                                                               readonly
                                                               name="product_cost[unit_barcode]">

                                                        <div class="input-group-append">
                                                            <button class="btn btn-primary" id="unit_barcode"
                                                                    type="button">
                                                                <i
                                                                    class="fa fa-barcode text-white"></i>انشاء
                                                            </button>
                                                        </div>
                                                    </div>
                                                    <span
                                                        style="color:  red">{{ $errors->first('product_cost.unit_barcode') }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!--end: Form Wizard Step 3-->

                                <!--begin: Form Wizard Step 4-->
                                <div class="kt-wizard-v4__content" data-ktwizard-type="step-content">
                                    <div class="kt-heading kt-heading--md">رفع المرفقات</div>
                                    <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg"></div>
                                    <div class="kt-form__section kt-form__section--first">
                                        <div class="kt-wizard-v2__form">
                                            <div class="form-group row">
                                                <div class="col-12 mt-4">
                                                    <h3 class="mb-4">المرفقات</h3>
                                                    <div class="dropzone dropzone-default dropzone-brand"
                                                         id="kt_dropzone_2">
                                                        <div class="dropzone-msg dz-message">
                                                            <h3 class="dropzone-msg-title">قم باسقاط المرفقات المتعلقة
                                                                بالمنتج هنا.</h3>
                                                            <span
                                                                class="dropzone-msg-desc">تحميل ما يصل إلى 10 ملفات</span>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <!--end: Form Wizard Step 4-->

                                <!--begin: Form Actions -->
                                <div class="kt-form__actions">
                                    <button
                                        class="btn btn-secondary btn-md btn-tall btn-wide kt-font-bold kt-font-transform-u"
                                        data-ktwizard-type="action-prev">
                                        السابق
                                    </button>
                                    <button
                                        type="submit"
                                        class="btn btn-success btn-md btn-tall btn-wide kt-font-bold kt-font-transform-u"
                                        data-ktwizard-type="action-submit">
                                        اضافة
                                    </button>
                                    <button

                                        class="btn btn-brand btn-md btn-tall btn-wide kt-font-bold kt-font-transform-u"
                                        data-ktwizard-type="action-next">
                                        التالي
                                    </button>
                                </div>
                                <!--end: Form Actions -->
                            </form>

                            <!--end: Form Wizard Form-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push("script")
        <script src="{{asset("assets/js/pages/custom/wizard/wizard-4.js")}}" type="text/javascript"></script>

        <script>
            $(document).ready(function () {

                $('.kt_touchspin_2, #kt_touchspin_2_2').TouchSpin({
                    buttondown_class: 'btn btn-secondary',
                    buttonup_class: 'btn btn-secondary',
                    min: 1,
                    max: 1000000000,
                    stepinterval: 50,
                    maxboostedstep: 10000000,
                });

                $(".supplier_id").on("change", function () {
                    $id = $(this).val()
                    $(".supplier_category").html("<option>الكل</option>");
                    $.ajax({
                        type: "GET",
                        url: window.location.href,
                        data: {
                            supplier_id: $id
                        },
                        success: function (data) {
                            $.each(data, function ($k, $v) {
                                $(".supplier_category").append("<option value=" + $v["id"] + ">" + $v["name"] + "</option>");
                            })
                        }
                    })
                })

                // counter("input_1_1", "input_1_2", "slider_1")
                // counter("input_2_1", "input_2_2", "slider_2")
                // counter("input_3_1", "input_3_2", "slider_3")

                var $btn = $("#generate_number")
                var $btn_2 = $("#container_barcode")
                var $btn_3 = $("#package_barcode")
                var $btn_4 = $("#unit_barcode")
                ajax_generate_unique_number($btn, "query_reference", "#reference_number")
                ajax_generate_unique_number($btn_2, "query_container_barcode", "#container_barcode_input")
                ajax_generate_unique_number($btn_3, "query_package_barcode", "#package_barcode_input")
                ajax_generate_unique_number($btn_4, "query_unit_barcode", "#unit_barcode_input")

                $("#kt_dropzone_2").dropzone({
                    url: "{{route("product.index")}}",
                    paramName: "product_attachment", // The name that will be used to transfer the file
                    maxFiles: 1,
                    maxFilesize: 10, // MB
                    addRemoveLinks: true,
                    sending: function (file, xhr, formData) {
                        formData.append("_token", "{{ csrf_token() }}");
                    },

                    accept: function (file, done) {
                        done();
                    },

                });
            })

            function ajax_generate_unique_number($btn, $query, $input) {
                $($btn).on("click", function () {
                    KTApp.progress($btn);
                    $.ajax({
                        type: "GET",
                        url: "{{url("product/create")}}?" + $query,
                        success: function (data) {
                            KTApp.unprogress($btn);
                            $($input).val(data)
                        }
                    })
                })
            }

        </script>
    @endpush
@endsection

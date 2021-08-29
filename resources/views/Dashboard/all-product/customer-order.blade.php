@extends('Dashboard.index')
@section('content')
    <?php
    breadCrumb(config("breadcrumb.create_categories"));
    ?>

    <div class="kt-container kt-container--fluid kt-grid__item kt-grid__item--fluid">
        <div class="kt-portlet kt-portlet--mobile">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title">
                        طلبيات الزبائن
                    </h3>
                </div>
            </div>
            <div class="kt-portlet__body">
                <form class="kt-form">
                    <div class="kt-portlet__body">
                        <div class="kt-form__section kt-form__section--first">
                            <div class="form-group row">
                                <div class="col-lg-6">
                                    <label>رقم الطلبية</label>
                                    <div class="input-group inputId">
                                        <input type="text" class="form-control" disabled value="SR-1213-121">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button"><i class="fa fa-cart-plus text-white"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <label>تاريخ الطلبية</label>
                                    <div class="input-group date">
                                        <input type="text" class="form-control datepicker-date" disabled placeholder="اختر التاريخ"/>
                                        <div class="input-group-append">
                                            <span class="input-group-text"><i class="la la-calendar glyphicon-th"></i></span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-lg-4">
                                    <label>اسم الزبون</label>
                                    <div class="input-group inputId">
                                        <input type="text" class="form-control" placeholder="أدخل اسم الزبون">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button"><i class="fa fa-user-friends text-white"></i></button>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <label> البريد الالكتروني</label>
                                    <div class="input-group inputId">
                                        <input type="text" class="form-control" placeholder="أدخل البريد الالكتروني">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button"><i class="fa fa-mail-bulk text-white"></i></button>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <label> رقم الهاتف</label>
                                    <div class="input-group inputId">
                                        <input type="text" class="form-control" placeholder="أدخل رقم الهاتف">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button"><i class="fa fa-phone text-white"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-4">
                                    <label>العنوان</label>
                                    <div class="input-group inputId">
                                        <input type="text" class="form-control" placeholder="أدخل معلومات العنوان">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button"><i class="fa fa-address-card text-white"></i></button>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <label class="kt-checkbox kt-checkbox--bold kt-checkbox--brand mt-5">
                                        <input type="checkbox"> ارسال اشعار بريدي بمعلومات الطلبية
                                        <span></span>
                                    </label>
                                </div>
                                <div class="col-lg-4">
                                    <label class="kt-checkbox kt-checkbox--bold kt-checkbox--brand mt-5">
                                        <input type="checkbox"> انشاء QR للطلبية
                                        <span></span>
                                    </label>
                                </div>

                            </div>

                            <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg"></div>

                            <div id="kt_repeater_1">
                                <div class="form-group form-group-last row" id="kt_repeater_1">
                                    <label class="col-lg-2 col-form-label">معلومات الطلبية</label>
                                    <div data-repeater-list="" class="col-lg-10">
                                        <div data-repeater-item class="form-group row align-items-center">
                                            <div class="col-md-2">
                                                <div class="kt-form__group--inline">
                                                    <div class="kt-form__label">
                                                        <label>الرقم المرجعي</label>
                                                    </div>
                                                    <div class="kt-form__control">
                                                        <input type="email" class="form-control"
                                                               placeholder="أدخل الرقم المرجعي">
                                                    </div>
                                                </div>
                                                <div class="d-md-none kt-margin-b-10"></div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="kt-form__group--inline">
                                                    <div class="kt-form__label">
                                                        <label>اسم المنتج</label>
                                                    </div>
                                                    <div class="kt-form__control">
                                                        <input type="email" class="form-control"
                                                               placeholder=" اسم المنتج">
                                                    </div>
                                                </div>
                                                <div class="d-md-none kt-margin-b-10"></div>
                                            </div>
                                            <div class="col-md-1">
                                                <div class="kt-form__group--inline">
                                                    <div class="kt-form__label">
                                                        <label>الوحدة</label>
                                                    </div>
                                                    <div class="kt-form__control">
                                                        <select name="" class="form-control">
                                                            <option value="">قطعة</option>
                                                            <option value="">رزمة</option>
                                                            <option value="">حاوية</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="d-md-none kt-margin-b-10"></div>
                                            </div>
                                            <div class="col-md-1">
                                                <div class="kt-form__label">
                                                    <label>الكمية</label>
                                                </div>
                                                <div class="kt-form__control">
                                                    <input type="email" class="form-control"
                                                           placeholder=" الكمية">
                                                </div>
                                                <div class="d-md-none kt-margin-b-10"></div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="kt-form__label">
                                                    <label>الاجمالي</label>
                                                </div>
                                                <div class="kt-form__control">
                                                    <input type="email" class="form-control"
                                                           placeholder=" الاجمالي">
                                                </div>
                                                <div class="d-md-none kt-margin-b-10"></div>
                                            </div>

                                            <div class="col-md-4">
                                                <a href="javascript:;" data-repeater-delete=""
                                                   class="btn-sm btn btn-label-danger btn-bold">
                                                    <i class="la la-trash-o"></i>
                                                    حذف
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group form-group-last row">
                                    <label class="col-lg-2 col-form-label"></label>
                                    <div class="col-lg-4">
                                        <a href="javascript:;" data-repeater-create=""
                                           class="btn btn-bold btn-sm btn-label-brand">
                                            <i class="la la-plus"></i> المزيد
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="kt-portlet__foot">
                        <div class="kt-form__actions">
                            <div class="row">
                                <div class="col-lg-2"></div>
                                <div class="col-lg-2">
                                    <button type="reset" class="btn btn-success">اضافة</button>
                                    <button type="reset" class="btn btn-secondary">الغاء</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @push("script")
        <script>
            $('#kt_repeater_1').repeater({
                initEmpty: false,

                defaultValues: {
                    'text-input': 'foo'
                },

                show: function () {
                    $(this).slideDown();
                },

                hide: function (deleteElement) {
                    $(this).slideUp(deleteElement);
                }
            });

        </script>
    @endpush
@endsection

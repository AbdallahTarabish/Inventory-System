@extends('Dashboard.index')
@section('content')

    @php
        breadCrumb(config("breadcrumb.create_store"));
    @endphp

    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
        <div class="kt-portlet">
            <div class="kt-portlet__body kt-portlet__body--fit">
                <div class="kt-grid  kt-wizard-v2 kt-wizard-v2--white" id="kt_wizard_v2" data-ktwizard-state="first">
                    <div class="kt-grid__item kt-wizard-v2__aside">
                        <!--begin: Form Wizard Nav -->
                        <div class="kt-wizard-v2__nav">
                            <div class="kt-wizard-v2__nav-items">
                                <!--doc: Replace A tag with SPAN tag to disable the step link click -->
                                <div class="kt-wizard-v2__nav-item" data-ktwizard-type="step"
                                     data-ktwizard-state="current">
                                    <div class="kt-wizard-v2__nav-body">
                                        <div class="kt-wizard-v2__nav-icon">
                                            <i class="flaticon-users"></i>
                                        </div>
                                        <div class="kt-wizard-v2__nav-label">
                                            <div class="kt-wizard-v2__nav-label-title">
                                                المعلومات الشخصية
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="kt-wizard-v2__nav-item" data-ktwizard-type="step"
                                     data-ktwizard-state="pending">
                                    <div class="kt-wizard-v2__nav-body">
                                        <div class="kt-wizard-v2__nav-icon">
                                            <i class="flaticon-book"></i>
                                        </div>
                                        <div class="kt-wizard-v2__nav-label">
                                            <div class="kt-wizard-v2__nav-label-title">
                                                الدراسة الاكاديمية
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="kt-wizard-v2__nav-item" data-ktwizard-type="step"
                                     data-ktwizard-state="pending">
                                    <div class="kt-wizard-v2__nav-body">
                                        <div class="kt-wizard-v2__nav-icon">
                                            <i class="flaticon2-paper"></i>
                                        </div>
                                        <div class="kt-wizard-v2__nav-label">
                                            <div class="kt-wizard-v2__nav-label-title">
                                                الأوراق البحثية
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="kt-wizard-v2__nav-item" data-ktwizard-type="step"
                                     data-ktwizard-state="pending">
                                    <div class="kt-wizard-v2__nav-body">
                                        <div class="kt-wizard-v2__nav-icon">
                                            <i class="flaticon2-file-2"></i>
                                        </div>
                                        <div class="kt-wizard-v2__nav-label">
                                            <div class="kt-wizard-v2__nav-label-title">
                                                الشهادات العلمية
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end: Form Wizard Nav -->
                    </div>
                    <div class="kt-grid__item kt-grid__item--fluid kt-wizard-v2__wrapper">
                        <!--begin: Form Wizard Form-->
                        <form class="kt-form" id="kt_form" novalidate="novalidate">
                            <!--begin: Form Wizard Step 1-->
                            <div class="kt-wizard-v2__content" data-ktwizard-type="step-content"
                                 data-ktwizard-state="current">
                                <div class="kt-heading kt-heading--md">أدخل المعلومات الشخصية</div>
                                <div class="kt-form__section kt-form__section--first">
                                    <div class="kt-wizard-v2__form">
                                        <div class="form-group">
                                            <label>الاسم الأول</label>
                                            <input type="text" class="form-control" name="fname"
                                                   placeholder="مثال : أحمد">
                                        </div>
                                        <div class="form-group">
                                            <label>الاسم الاخير</label>
                                            <input type="text" class="form-control" name="lname"
                                                   placeholder="مثال : محمد">
                                        </div>
                                        <div class="row">
                                            <div class="col-xl-6">
                                                <div class="form-group">
                                                    <label>رقم الهاتف</label>
                                                    <input type="tel" class="form-control" name="phone"
                                                           placeholder="مثال :+97059211707">
                                                </div>
                                            </div>
                                            <div class="col-xl-6">
                                                <div class="form-group">
                                                    <label>البريد الالكتروني</label>
                                                    <input type="email" class="form-control" name="email"
                                                           placeholder="البريد الالكتروني">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end: Form Wizard Step 1-->

                            <!--begin: Form Wizard Step 2-->
                            <div class="kt-wizard-v2__content" data-ktwizard-type="step-content"
                                 data-ktwizard-state="current">
                                <div class="kt-heading kt-heading--md">أدخل معلومات الدراسة الاكاديمية</div>
                                <div class="kt-form__section kt-form__section--first">
                                    <div class="kt-wizard-v2__form">
                                        <div class="row">
                                            <div class="col-xl-6">
                                                <div class="form-group">
                                                    <label>المستوى</label>
                                                    <select name="study" class="form-control">
                                                        <option value="1">الدبلوم</option>
                                                        <option value="1">البكالوريوس</option>
                                                        <option value="1">الماجستير</option>
                                                        <option value="1">الدكتوراة</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-xl-6">
                                                <div class="form-group">
                                                    <label>الدولة</label>
                                                    <select name="country" class="form-control">
                                                        <option value="1">فلسطين</option>
                                                        <option value="1">مصر</option>
                                                        <option value="1">الأردن</option>
                                                        <option value="1">قطر</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xl-4">
                                                <div class="form-group">
                                                    <label>نهاية الدراسة</label>
                                                    <input type="text" class="form-control datepicker-date"
                                                           name="start-date" placeholder="اختر التاريخ"/>
                                                </div>
                                            </div>
                                            <div class="col-xl-4">
                                                <div class="form-group">
                                                    <label>نهاية الدراسة</label>
                                                    <input type="text" class="form-control datepicker-date"
                                                           name="end-date" placeholder="اختر التاريخ"/>
                                                </div>
                                            </div>
                                            <div class="col-xl-4">
                                                <div class="form-group">
                                                    <label>المرفقات</label>
                                                    <input type="file" class="form-control datepicker-date"
                                                           name="start-date" placeholder=" المرفقات"/>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end: Form Wizard Step 2-->

                            <!--start: Form Wizard Step 3-->
                            <div class="kt-wizard-v2__content" data-ktwizard-type="step-content"
                                 data-ktwizard-state="current">
                                <div class="kt-heading kt-heading--md">أدخل معلومات الأوراق البحثية</div>
                                <div class="kt-form__section kt-form__section--first">
                                    <div class="kt-wizard-v2__form">
                                        <div class="row">
                                            <div class="col-xl-12">
                                                <div class="form-group">
                                                    <label>اسم الورقة البحثية</label>
                                                    <input type="text" class="form-control" name="paper"
                                                           placeholder="مثال : ورقة بحثية بعنوان">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12 mt-4 my-4">
                                                <h3 class="mb-4">المرفقات</h3>
                                                <div class="dropzone dropzone-default dropzone-brand"
                                                     id="kt_dropzone_2">
                                                    <div class="dropzone-msg dz-message needsclick">
                                                        <h3 class="dropzone-msg-title">قم بإسقاط الملفات هنا.</h3>
                                                        <span class="dropzone-msg-desc">تحميل ما يصل إلى 10 ملفات</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end: Form Wizard Step 3-->

                            <!--start: Form Wizard Step 4-->
                            <div class="kt-wizard-v2__content" data-ktwizard-type="step-content"
                                 data-ktwizard-state="current">
                                <div class="kt-heading kt-heading--md">أدخل مرفقات الشهادات العلمية</div>
                                <div class="kt-form__section kt-form__section--first">
                                    <div class="kt-wizard-v2__form">
                                        <div class="row">
                                            <div class="col-12 mt-4 my-4">
                                                <h3 class="mb-4">المرفقات</h3>
                                                <div class="dropzone dropzone-default dropzone-brand"
                                                     id="kt_dropzone_2">
                                                    <div class="dropzone-msg dz-message needsclick">
                                                        <h3 class="dropzone-msg-title">قم بإسقاط الملفات هنا.</h3>
                                                        <span class="dropzone-msg-desc">تحميل ما يصل إلى 10 ملفات</span>
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
                                    class="btn btn-success btn-md btn-tall btn-wide kt-font-bold kt-font-transform-u mx-lg-5"
                                    data-ktwizard-type="action-submit">
                                    حفظ
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
@endsection

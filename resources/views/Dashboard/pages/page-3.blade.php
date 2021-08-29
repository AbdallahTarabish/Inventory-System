@extends('Dashboard.index')
@section('content')
    @php
        breadCrumb(config("breadcrumb.create_store"));
    @endphp

    <div class="kt-container kt-container--fluid kt-grid__item kt-grid__item--fluid">
        <div class="row">

            <div class="col-xl-6 mx-auto">
                <!--begin::Portlet-->
                <form action="">
                    <div class="kt-portlet kt-portlet--mobile">
                        <div class="kt-portlet__head">
                            <div class="kt-portlet__head-label">
                                <h3 class="kt-portlet__head-title">
                                    استيراد منتج
                                </h3>
                            </div>
                        </div>
                        <div class="kt-portlet__body">

                            <div class="bg-light p-4 mb-4">
                                <h3 class="mb-4">تعليمات استيراد منتج</h3>
                                <div class="kt-list-timeline">
                                    <div class="kt-list-timeline__items">
                                        <div class="kt-list-timeline__item">
                                            <span class="kt-list-timeline__badge"></span>
                                            <span class="kt-list-timeline__text">هنا نص التعليمات</span>
                                        </div>
                                        <div class="kt-list-timeline__item">
                                            <span class="kt-list-timeline__badge"></span>
                                            <span class="kt-list-timeline__text">هنا نص التعليمات</span>
                                        </div>
                                        <div class="kt-list-timeline__item">
                                            <span class="kt-list-timeline__badge"></span>
                                            <span class="kt-list-timeline__text">هنا نص التعليمات</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <button type="reset" class="btn btn-outline-primary">تنزيل الملف</button>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>رفع الملف</label>
                                <div></div>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input">
                                    <label class="custom-file-label" for="customFile">اختر الملف</label>
                                </div>
                            </div>

                        </div>

                        <div class="kt-portlet__foot">
                            <div class="kt-form__actions">
                                <button type="submit" class="btn btn-primary">استيراد</button>
                            </div>
                        </div>
                    </div>
                </form>
                <!--end::Portlet-->
            </div>

        </div>
    </div>
@endsection

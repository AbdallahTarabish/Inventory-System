@extends('Dashboard.index')
@section('content')
    <?php
    breadCrumb(config("breadcrumb.auto_sort"));
    ?>


    <form id="auto_sort_form" type="{{route('auto_sort.store')}}" method="post">
        @csrf


        <div class="kt-container kt-container--fluid kt-grid__item kt-grid__item--fluid">
            <!--begin::Portlet-->
            <div class="kt-portlet kt-portlet--mobile h-100">
                <div class="kt-portlet__head kt-portlet__head--lg">
                    <div class="kt-portlet__head-label">
                              <span class="kt-portlet__head-icon">
                                 <i class="kt-font-brand flaticon2-line-chart"></i>
                              </span>
                        <h3 class="kt-portlet__head-title">
                            ترتيب المخزن
                        </h3>
                    </div>
                    <div class="kt-portlet__head-toolbar">
                        <div class="kt-portlet__head-wrapper">
                            <div class="kt-portlet__head-actions">
                                <div class="dropdown dropdown-inline">
                                    <button type="button" class="btn btn-default btn-icon-sm dropdown-toggle"
                                            data-toggle="dropdown-menu" aria-haspopup="true" aria-expanded="false">
                                        <i class="la la-download"></i> Export
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <ul class="kt-nav">
                                            <li class="kt-nav__section kt-nav__section--first">
                                                <span class="kt-nav__section-text">Choose an option</span>
                                            </li>
                                            <li class="kt-nav__item">
                                                <a href="#" class="kt-nav__link">
                                                    <i class="kt-nav__link-icon la la-print"></i>
                                                    <span class="kt-nav__link-text">Print</span>
                                                </a>
                                            </li>
                                            <li class="kt-nav__item">
                                                <a href="#" class="kt-nav__link">
                                                    <i class="kt-nav__link-icon la la-copy"></i>
                                                    <span class="kt-nav__link-text">Copy</span>
                                                </a>
                                            </li>
                                            <li class="kt-nav__item">
                                                <a href="#" class="kt-nav__link">
                                                    <i class="kt-nav__link-icon la la-file-excel-o"></i>
                                                    <span class="kt-nav__link-text">Excel</span>
                                                </a>
                                            </li>
                                            <li class="kt-nav__item">
                                                <a href="#" class="kt-nav__link">
                                                    <i class="kt-nav__link-icon la la-file-text-o"></i>
                                                    <span class="kt-nav__link-text">CSV</span>
                                                </a>
                                            </li>
                                            <li class="kt-nav__item">
                                                <a href="#" class="kt-nav__link">
                                                    <i class="kt-nav__link-icon la la-file-pdf-o"></i>
                                                    <span class="kt-nav__link-text">PDF</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                                <button type="button" onclick="confirm_sort()"
                                        class="btn btn-brand btn-elevate btn-icon-sm"
                                ><i
                                        class="fa fa-plus-circle"></i>
                                    الترتيب بشكل تلقائي
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="kt-padding-25" style="background-color: #F8F8F8">
                    <div class="form-group row align-items-end">
                        <div class="col-md-4">
                            <label>عدد القطاعات الرئيسية </label>
                            <div class="input-group ">
                                <input type="number" name="sector_count"
                                       class="form-control " placeholder="ادخل عدد القطاعات الرئيسية "/>

                            </div>
                            <span id="sector_count" class="text-danger"></span>

                        </div>
                        <div class="col-md-4">
                            <label>عدد القطاعات الفرعية </label>
                            <div class="input-group ">
                                <input type="number" name="sub_sector_count"
                                       class="form-control " placeholder="ادخل عدد القطاعات الفرعية "/>

                            </div>
                            <span id="sub_sector_count" class="text-danger"></span>

                        </div>
                        <div class="col-md-4">
                            <label>عدد الرفوف في القطاعات الفرعية </label>
                            <div class="input-group ">
                                <input type="number" name="shelf_count"
                                       class="form-control " placeholder="ادخل عدد الرفوف في القطاعات الفرعية"/>

                            </div>
                            <span id="shelf_count" class="text-danger"></span>

                        </div>

                    </div>

                </div>
            </div>
            <!--end::Portlet-->
        </div>
    </form>
@endsection
@section('script')
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function confirm_sort(event) {
            var form = new FormData($('#auto_sort_form')[0]);

            $('#sector_count').text('');
            $('#sub_sector_count').text("");
            $('#shelf_count').text('');

            swal({
                title: "هل انت متاكد من عملية الترتيب التلقائي",
                text: "سيؤدي ذلك الى حذف جميع القطاعات والرفوف السابقة",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {
                        $.ajax({
                            url: "{{route('auto_sort.store')}}",
                            type: 'POST',
                            data: form,
                            processData: false,
                            contentType: false,
                            cache: false,

                            success: function (response) {

                                swal("تم الترتيب بنجاح", "تم الترتيب بنجاح", "success");


                            },
                            error: function (reject) {
                                var response = $.parseJSON(reject.responseText);
                                $.each(response.errors, function (key, value) {

                                    $('#sector_count').text(value[0]);
                                    $('#sub_sector_count').text(value[0]);
                                    $('#shelf_count').text(value[0]);


                                });
                            }
                        });


                    }
                });
        }

    </script>
@endsection

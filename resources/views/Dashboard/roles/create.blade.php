@extends('Dashboard.index')
@section('content')
    <?php
    breadCrumb(config("breadcrumb.create_roles"));
    ?>
    <form action="{{route('roles.store')}}" method="post">
        @csrf
        @method('post')
    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid ">
        <div class="kt-portlet kt-portlet--mobile">
            <div class="kt-portlet__head kt-portlet__head--lg">
                <div class="kt-portlet__head-label">
                              <span class="kt-portlet__head-icon">
                                 <i class="kt-font-brand fa fa-plus"></i>
                              </span>
                    <h3 class="kt-portlet__head-title ">
                      إضافة دور
                    </h3>
                </div>
                <div class="kt-portlet__head-toolbar">
                    <div class="kt-portlet__head-wrapper">
                        <div class="kt-portlet__head-actions">
                            <div class="dropdown dropdown-inline">
                                <button type="button" class="btn btn-default btn-icon-sm dropdown-toggle"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="la la-download"></i> تصدير
                                </button>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <ul class="kt-nav">
                                        <li class="kt-nav__section kt-nav__section--first">
                                            <span class="kt-nav__section-text">اختر</span>
                                        </li>
                                        <li class="kt-nav__item">
                                            <a href="#" class="kt-nav__link">
                                                <i class="kt-nav__link-icon la la-print"></i>
                                                <span class="kt-nav__link-text">طباعة</span>
                                            </a>
                                        </li>
                                        <li class="kt-nav__item">
                                            <a href="#" class="kt-nav__link">
                                                <i class="kt-nav__link-icon la la-copy"></i>
                                                <span class="kt-nav__link-text">نسخ</span>
                                            </a>
                                        </li>
                                        <li class="kt-nav__item">
                                            <a href="#" class="kt-nav__link">
                                                <i class="kt-nav__link-icon la la-file-excel-o"></i>
                                                <span class="kt-nav__link-text">Excel</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <button  type="submit"
                                     class="btn btn-brand btn-elevate btn-icon-sm">
                                <i class="fa fa-plus-circle"></i>
                                أضـف
                            </button>

                        </div>
                    </div>
                </div>
            </div>

            <div class="kt-portlet__body">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>اسم الدور</label>
                                <div class="input-group">
                                    <input type="text" name="name" class="form-control" placeholder="ادخل الاسم"/>
                                </div>
                                @error('name')
                                <small id="emailHelp" class="form-text text-danger">{{$message}}</small>
                                @enderror
                            </div>
                        </div>

                    </div>
                    <div class="row">

                        <div class="col-md-12">
                            <div class="form-group">
                                <h4>الصلاحيات</h4>
                                @error('permissions')
                                <small id="emailHelp" class="form-text text-danger">{{$message}}</small>
                                @enderror
                                <table class="table table-bordered table-hover" >
                                    <thead>
                                    <tr>

                                        <th style="width: 5%">#</th>
                                        <th style="width: 22%">اسم الدور</th>
                                        <th>الصلاحية</th>
                                    </tr>
                                    </thead>
                                    <tbody>
{{--                                   $permission_maps = array('create'=>'إضافة','read'=>'عرض',"update"=>"تعديل","delete"=>"حذف");  $models= ['roles'=>'الأدوار','users'=>'الموظفين','main_stores'=>'المخازن الرئيسية','sub_stores'=>'المخازن الفرعية','categories'=>' الأقسام الفرعية','suppliers'=>'الموردين',];--}}

                                    @php
                                        $models= array('roles'=>'الأدوار','users'=>'الموظفين','main_stores'=>'المخازن الرئيسية','sub_stores'=>'المخازن الفرعية','categories'=>' الأقسام الفرعية','suppliers'=>'الموردين',);
                                         $counter = 1;
                                    @endphp


                                    @foreach($models as $key_model=>$model)

                                        <tr>
                                            <td>{{$counter++}}</td>
                                            <td class="text-capitalize">{{$model}}</td>
                                            <td>
                                                @php
                                                    $permission_maps = array('create'=>'إضافة','read'=>'عرض',"update"=>"تعديل","delete"=>"حذف");
                                                @endphp

                                                <select name="permissions[]" class="form-control select_2" multiple>
                                                    @foreach($permission_maps as $key_map=>$permission_map)
                                                        <option value="{{$key_model.'_'.$key_map}}">{{$permission_map}}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>

                            </div>

                        </div>

                    </div>

            </div>
        </div>
    </div>
    </form>
@endsection

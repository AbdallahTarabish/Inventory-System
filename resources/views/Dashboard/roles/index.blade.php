@extends('Dashboard.index')
@section('content')
    <?php
    breadCrumb(config("breadcrumb.read_roles"));
    ?>
    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid ">
        <div class="kt-portlet kt-portlet--mobile">
            <div class="kt-portlet__head kt-portlet__head--lg">
                <div class="kt-portlet__head-label">
                              <span class="kt-portlet__head-icon">
                                 <i class="kt-font-brand fa fa-eye"></i>
                              </span>
                    <h3 class="kt-portlet__head-title ">
                        عرض معلومات الأدوار
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
                            @if(auth()->user()->hasPermission('roles_create'))

                            <a href="{{route('roles.create')}}"
                               class="btn btn-brand btn-elevate btn-icon-sm " >
                                <i class="fa fa-plus-circle"></i>اضف دور
                            </a>
                            @endif
                            <!-- begin modal Add or Update-->
                            <!-- End modal Add or Update-->
                        </div>
                    </div>
                </div>
            </div>
            <div class="kt-padding-25" style="background-color: #F8F8F8">
                <form >
                    <div class="form-group row align-items-end">
                        <div class="col-md-3">
                            <label> البحث</label>
                            <input type="text" name="search" value="{{request()->search}}" class="form-control"  placeholder="أبحث بواسطة الاسم">
                        </div>


                        <div class="col-md-3">
                            &nbsp;
                            <button type="submit" class="btn btn-info btn-elevate btn-icon-sm" @click.prevent="getMainStore">
                                <i class="fa fa-search" ></i>
                                بحث
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="kt-portlet__body">

                <!--begin: Datatable -->
                <table class="table table-striped- table-bordered table-hover table-checkable text-center"
                       id="kt_table_1">
                    <thead>
                    <tr class="text-center">
                        <th style="width: 3%">#</th>
                        <th style="width: 10%">الاسم</th>
                        <td style="width: 50%">الصلاحيات</td>
                        <td  style="width: 8%">عدد المستخدمين</td>
                        <th style="width: 15%">الاجراءات</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($roles as $index=>$role)
                        <tr>
                            <td>{{$index+1}}</td>
                            <td>{{$role->name}}</td>
                            <td>
                                @foreach($role->permissions as $permission)
                                    <h6 style="display: inline-block"><span class="badge badge-primary">{{$permission->name}}</span> </h6>
                                @endforeach
                            </td>
                            <td>{{$role->users_count}}</td>
                            <td>
                                @if(auth()->user()->hasPermission('roles_update'))

                                    <a href="{{route('roles.edit',$role->id)}}" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
@endif
                                    @if(auth()->user()->hasPermission('roles_delete'))

                                    <form action="{{route('roles.destroy',$role->id)}}" method="post" style="display: inline-block">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="delete btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>

                                    </form>
                                        @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <!--end: Datatable -->
            </div>
        </div>
    </div>

@endsection

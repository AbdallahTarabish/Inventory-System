@extends('Dashboard.index')
@section('content')
    <?php
    breadCrumb(config("breadcrumb.edit_users"));
    ?>
    <form action="{{route('users.update',['user'=>$user->id,'type'=> 'update'])}}" method="post">
        @csrf
        @method('put')
        <input type="hidden" name="id" value="{{$user->id}}">
    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid ">
        <div class="kt-portlet kt-portlet--mobile">
            <div class="kt-portlet__head kt-portlet__head--lg">
                <div class="kt-portlet__head-label">
                              <span class="kt-portlet__head-icon">
                                 <i class="kt-font-brand fa fa-user-edit"></i>
                              </span>
                    <h3 class="kt-portlet__head-title ">
                        تعديل موظف
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
                                تحديث
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="kt-portlet__body">

                    <input type="text" name="id" value="{{old('id',$user->id)}}" hidden/>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>اسم الموظف</label>
                                <div class="input-group">
                                    <input type="text" name="name" class="form-control" placeholder="ادخل الاسم" value="{{old('name',$user->name)}}"/>
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
                                <label>رقم الجوال</label>
                                <div class="input-group">
                                    <input type="text" name="mobile" class="form-control" placeholder="ادخل رقم الجوال" value="{{old('mobile',$user->mobile)}}"/>
                                </div>
                                @error('mobile')
                                <small id="emailHelp" class="form-text text-danger">{{$message}}</small>
                                @enderror
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>البريد الإلكتروني</label>
                                <div class="input-group">
                                    <input type="email" name="email" class="form-control" placeholder="ادخل البريد الالكتروني" value="{{old('email',$user->email)}}"/>
                                </div>
                                @error('email')
                                <small id="emailHelp" class="form-text text-danger">{{$message}}</small>
                                @enderror
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>  كلمة المرور الجديدة</label>
                                <div class="input-group">
                                    <input type="password" name="password" class="form-control" placeholder="ادخل كلة المرور" />
                                </div>
                                @error('password')
                                <small id="emailHelp" class="form-text text-danger">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>تأكيد كلمة المرور</label>
                                <div class="input-group">
                                    <input type="password" name="password_confirmation" class="form-control"/>
                                </div>
                                @error('password_confirmation')
                                <small id="emailHelp" class="form-text text-danger">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                @if(auth()->user()->hasRole('store_manager'))
                @else
                <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>المخزن الرئيسي التابع له</label>
                                <select name="main_store_id" class="form-control select_2">
                                    <option value="">المخازن الفرعية</option>
                                    @foreach($main_stores as $main_store)
                                        <option value="{{$main_store->id}}"
                                            {{in_array($main_store->id,$user->main_store->pluck('id')->toArray()) ? 'selected' :''}}


                                        >{{$main_store->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>المخزن الفرعي التابع له</label>
                                <select name="sub_store_id" class="form-control select_2">
                                    <option value="">المخازن الفرعية</option>
                                    @foreach($sub_stores as $sub_store)
                                        <option value="{{$sub_store->id}}"
                                        @if(!empty($user->sub_store))
                                            {{in_array($sub_store->id,$user->sub_store->pluck('id')->toArray()) ? 'selected' :''}}
                                            @endif
                                            >{{$sub_store->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                @endif
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>الدور</label>
                                <select name="role_id" class="form-control ">
                                    <option value="">الأدوار</option>
                                    @foreach($roles as $role)
                                        <option value="{{$role->id}}" {{ $user->hasRole($role->name) ? 'selected': '' }}>{{$role->name}}</option>
                                    @endforeach
                                </select>
                                @error('role_id')
                                <small id="emailHelp" class="form-text text-danger">{{$message}}</small>
                                @enderror
                            </div>

                        </div>
                    </div>




            </div>
        </div>
    </div>
    </form>
@endsection

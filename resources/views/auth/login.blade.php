@extends('layouts.app')

@section('content')



    <div class="kt-login__signin">
        <div class="kt-login__head">
            <h3 class="kt-login__title">تسجيل الدخول للوحة التحكم</h3>
        </div>
        <form class="kt-form" action="{{route('login')}}" method="post">
            @csrf
            <div class="input-group">
                <input class="form-control" type="text" placeholder="رقم الجوال" name="mobile" autocomplete="off">
            </div>
            <div class="input-group">
                <input class="form-control" type="password" placeholder="كلمة السر" name="password">
            </div>
            @if($errors->has('mobile') |$errors->has('password'))
            <span class="text-danger d-flex justify-content-end mt-3"> البيانات المدخلة غير صحيحة</span>
            @endif
            <div class="row kt-login__extra">
                <div class="col">
                    <label class="kt-checkbox">
                        <input type="checkbox" name="remember"> تذكرني
                        <span></span>
                    </label>
                </div>
                <div class="col kt-align-right">
                    <a href="javascript:;" id="kt_login_forgot" class="kt-login__link">نسيت كلمة السر ؟</a>
                </div>
            </div>
            <div class="kt-login__actions">
                <button   class=" submit btn btn-brand btn-pill kt-login__btn-primary">تسجيل الدخول</button>
            </div>
        </form>
    </div>
@endsection

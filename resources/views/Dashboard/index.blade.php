<!DOCTYPE html>
<html lang="en" direction="rtl" dir="rtl" style="direction: rtl">

<!-- begin::Head -->
@include("Dashboard.partials.resources.header-resources")
<!-- end::Head -->
@yield('style')
<!-- begin::Body -->
<body
    class="kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed kt-subheader--enabled kt-subheader--fixed kt-subheader--solid kt-aside--enabled kt-aside--fixed">

kt-dialog kt-dialog--shown kt-dialog--default kt-dialog--loader kt-dialog--top-center

<!-- begin:: Page -->
@include('Dashboard.partials._header.base-mobile')
<div class="kt-grid kt-grid--hor kt-grid--root">
    <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-page">

        @include('Dashboard.partials._aside.base')
        <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-wrapper" id="kt_wrapper">
            @include('Dashboard.partials._header.base')
            <div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
                @yield('content')
            </div>
            @include('Dashboard.partials._footer.base')
        </div>
    </div>
</div>
<script>
    window.App = {!! json_encode([
            'csrfToken' => csrf_token(),
            'user' => auth()->user(),
            'permissions' =>auth('web')->user()->getAllPermissions()
        ]) !!};
</script>
<!-- end:: Page -->
<script src="{{ asset('js/app.js') }}"></script>

@include("Dashboard.partials.resources.footer-resources")


@yield('script')

<!--end::Page Scripts -->
</body>


<!-- end::Body -->
</html>

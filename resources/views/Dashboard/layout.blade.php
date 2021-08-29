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
<!-- end:: Page -->

@extends('Dashboard.index')
@section('content')
    <?php
    breadCrumb(config("breadcrumb.sub_stores"));
    ?>
    <div id="app">

        <sub-store></sub-store>

    </div>
@endsection

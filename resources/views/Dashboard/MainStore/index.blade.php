@extends('Dashboard.index')
@section('content')
    <?php
    breadCrumb(config("breadcrumb.main_stores"));
    ?>
    <div id="app">

        <main-store></main-store>

    </div>
@endsection

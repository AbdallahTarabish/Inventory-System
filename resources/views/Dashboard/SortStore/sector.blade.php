@extends('Dashboard.index')
@section('content')
    <?php
    breadCrumb(config("breadcrumb.sector"));
    ?>
    <div id="app">
        <Sector></Sector>
    </div>

@endsection


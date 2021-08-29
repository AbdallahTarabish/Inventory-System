@extends('Dashboard.index')
@section('content')
    <?php
    breadCrumb(config("breadcrumb.sub_sector"));
    ?>
    <div id="app">
        <sub-sector></sub-sector>
    </div>

@endsection


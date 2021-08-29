@extends('Dashboard.index')
@section('content')
    <?php
    breadCrumb(config("breadcrumb.categories"));
    ?>
    <div id="app">
        <category-component></category-component>

    </div>
@endsection



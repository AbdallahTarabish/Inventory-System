@extends('Dashboard.index')
@section('content')
    <?php
    breadCrumb(config("breadcrumb.create_categories"));
    ?>
    <div id="app">
        <create-category-component></create-category-component>

    </div>
@endsection



@extends('Dashboard.index')
@section('content')
    <?php
    breadCrumb(config("breadcrumb.edit_categories"));
    ?>
    <div id="app">
        <edit-category-component  :category="{{$category}}"   :main="{{$category->main}}">
        </edit-category-component>
    </div>
@endsection



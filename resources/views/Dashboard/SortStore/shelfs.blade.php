@extends('Dashboard.index')
@section('content')
    <?php
    breadCrumb(config("breadcrumb.shelf"));
    ?>
    <div id="app">
        <Shelf></Shelf>
    </div>

@endsection


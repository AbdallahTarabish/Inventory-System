@extends('Dashboard.index')
@section('content')
    <?php
    breadCrumb(config("breadcrumb.supplier"));
    ?>
    <div id="app">
   <supplier></supplier>

    </div>
@endsection



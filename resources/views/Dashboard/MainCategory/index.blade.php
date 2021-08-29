@extends('Dashboard.index')
@section('content')
    <?php
    breadCrumb(config("breadcrumb.main_stores"));
    ?>
    <div id="app">
        <main-category-component></main-category-component>

    </div>
@endsection
<!--
    <script>
        $(".select_2").select2({

        }).on('change', function (e) {
            document.getElementById("status").value =$('.select_2').val();

        });
    </script>
-->

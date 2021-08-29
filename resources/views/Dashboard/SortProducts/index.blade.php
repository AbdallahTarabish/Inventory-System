@extends('Dashboard.index')

@section('style')
    <link rel="stylesheet" href="{{asset('assets/plugins/custom/datatables/datatables.bundle.rtl.css')}}">
    @livewireStyles
@endsection

@section('content')
    @livewire('store-product.index')
@endsection


@section('script')
    @livewireScripts
@endsection

@extends('Dashboard.index')

@section('style')
    @livewireStyles
@endsection

@section('content')
    @livewire('sort-products.create', [
    'main_store_id' => $main_store_id,
    'store_id' => $store_id,
    'user_id' => $user_id,
    'sectors' => $sectors,
    'products' => $products
    ])
@endsection


@section('script')
    @livewireScripts
@endsection

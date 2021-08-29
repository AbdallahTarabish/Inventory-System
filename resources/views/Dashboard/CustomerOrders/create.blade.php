@extends('Dashboard.index')

@section('style')
    @livewireStyles
@endsection

@section('content')
    @livewire('customer-orders.create', [
    'products' => $products,
    'order_code' => $order_code,
    'main_store_id' => $main_store_id,
    'store_id' => $store_id,
    'user_id' => $user_id
    ])
@endsection


@section('script')
    @livewireScripts
@endsection

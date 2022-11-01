@extends('layouts.master')
@push('css')
@endpush
@section('content')
    @livewire('shop.detail-product', ['product_id' => $id])
@endsection

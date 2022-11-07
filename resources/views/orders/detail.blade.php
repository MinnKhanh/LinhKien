@extends('layouts.master')
@section('content')
    @livewire('orders.detail', ['idorder' => $idorder])
@endsection

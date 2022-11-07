@extends('layouts.layoutprint')
@section('content')
    @livewire('orders.printorder', ['idorder' => $idorder])
@endsection

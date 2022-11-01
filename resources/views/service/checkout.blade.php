@extends('layouts.master')
@section('content')
    @livewire('service.checkout', isset($discount) ? ['discount' => $discount] : [])
@endsection

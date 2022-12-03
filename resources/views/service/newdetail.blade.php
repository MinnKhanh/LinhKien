@extends('layouts.master')
@section('content')
    @livewire('service.newdetail', ['new' => $new])
@endsection

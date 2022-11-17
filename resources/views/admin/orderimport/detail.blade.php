@extends('layouts.masteradmin')
@section('content')
    @livewire('admin.order-import.detail', ['idorder' => $id])
@endsection

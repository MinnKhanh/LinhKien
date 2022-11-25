@extends('layouts.masteradmin')
@section('content')
    @livewire('admin.customers.edit', ['isedit' => $id])
@endsection

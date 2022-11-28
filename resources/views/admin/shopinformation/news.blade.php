@extends('layouts.masteradmin')
@section('content')
    @livewire('admin.shopinformation.news', isset($id) ? ['isedit' => $id] : [])
@endsection

@extends('layouts.masteradmin')
@section('content')
    @livewire('admin.discount.createorupdate', isset($id) ? ['isedit' => $id] : [])
@endsection

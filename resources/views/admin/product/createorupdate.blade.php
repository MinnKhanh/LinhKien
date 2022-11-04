@extends('layouts.masteradmin')
@section('content')
    @livewire('admin.product.createorupdate', isset($isedit) ? ['isedit' => $isedit] : [])
@endsection

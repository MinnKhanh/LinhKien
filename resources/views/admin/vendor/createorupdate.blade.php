@extends('layouts.masteradmin')
@section('content')
    @livewire('admin.vendor.createorupdate', isset($isedit) ? ['isedit' => $isedit] : [])
@endsection

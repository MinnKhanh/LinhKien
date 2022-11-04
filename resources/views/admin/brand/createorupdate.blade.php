@extends('layouts.masteradmin')
@section('content')
    @livewire('admin.brand.createorupdate', isset($isedit) ? ['isedit' => $isedit] : [])
@endsection

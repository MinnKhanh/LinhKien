@extends('layouts.masteradmin')
@section('content')
    @livewire('admin.category.createorupdate', isset($isedit) ? ['isedit' => $isedit] : [])
@endsection

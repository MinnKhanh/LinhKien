@extends('layouts.masteradmin')
@section('content')
    @livewire('admin.introduce.editintrodiscount', isset($id) ? ['isedit' => $id] : [])
@endsection

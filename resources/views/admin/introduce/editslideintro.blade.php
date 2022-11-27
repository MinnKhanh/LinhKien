@extends('layouts.masteradmin')
@section('content')
    @livewire('admin.introduce.edislideintro', isset($id) ? ['isedit' => $id] : [])
@endsection

@extends('layouts.layoutprint')
@section('content')
    @livewire('admin.order-import.printorder', ['idorder' => $id])
@endsection

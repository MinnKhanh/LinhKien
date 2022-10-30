@extends('layouts.master')
@push('css')
    <style>
        .pagination {
            padding-top: 25px;
            text-align: center !important;
            justify-content: center;
        }

        .pagination li {
            text-align: center !important;
            margin: 0px .2rem;
        }

        .page-item.active .page-link {
            border-color: #111111;
            color: black !important;
            background: transparent;
        }

        .pagination .page-link {
            display: inline-block !important;
            font-size: 16px;
            font-weight: 700;
            color: #111111;
            height: 30px;
            width: 30px;
            border-radius: 50% !important;
            line-height: 30px;
            text-align: center;
            align-items: center;
            padding: 0;

        }

        .pagination li.active {
            border-color: #111111;
        }

        .pagination li:hover {
            border-color: #111111;
        }

        .category {
            color: gray !important;
        }

        .category:hover,
        .category:focus {
            text-decoration: none;
            outline: none;
            color: black !important;
        }
    </style>
@endpush
@push('js')
    <script src="{{ asset('js/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('js/jquery.nicescroll.min.js') }}"></script>
    <script src="{{ asset('js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('js/jquery.countdown.min.js') }}"></script>
    <script src="{{ asset('js/jquery.slicknav.js') }}"></script>
    <script src="{{ asset('js/mixitup.min.js') }}"></script>
    <script src="{{ asset('js/owl.carousel.min.js') }}"></script>
@endpush
@push('css')
    <link rel="stylesheet" href="{{ asset('css/magnific-popup.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/nice-select.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/slicknav.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" type="text/css">
@endpush
@section('content')
    @livewire('shop.list-product')
@endsection

@extends('layouts.master')
@push('css')
@endpush
@section('content')
    {{-- <script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script> --}}



    <div class="row">
        <div class="col-12 col-md-6" style="font-size: 2em;">
            <h5>With data attributes</h5>
            <div id="dataReview" data-rating-stars="5" data-rating-input="#dataInput"></div>
        </div>
        <div class="col-12 col-md-6">
            <label for="dataInput">Stars</label>
            <input type="text" readonly id="dataInput" class="form-control form-control-sm">
        </div>
    </div>
@endsection
@push('js')
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
    </script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
    </script>

    <script src="{{ asset('js/rating-star-icons/dist/rating.js') }}"></script>
@endpush

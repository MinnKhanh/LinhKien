@extends('layouts.master')

@section('content')
    <div class=" flex justify-between">
        <video controls
            class="w-full h-full absolute top-0 left-0 hidden aspect-video shadow-md object-cover border-solid border-grays-300"
            style="background-color: #7F7F7F;">
            <source src="{{ URL::asset('images/default.PNG') }}" id="video">
            Your browser does not support HTML5 video.
        </video>
        <form action="{{ route('video.create') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="text-green-500 flex items-center mt-2">add video</div>
            <input type="file" id="file_video" name="phim" class="file_video hidden"
                accept=".mp4, .ogx, .oga, .ogv, .ogg, .mov, .wmv, .avi, .avchd, .flv, .f4v, .swf, .mkv, .mpg, .mp2, .moeg, .mpe, .mpv, .m4p, .m4v, .qt">
            <button type="submit">submit</button>
        </form>
    </div>
@endsection
@push('js')
    <script>
        $(document).ready(function() {
            $('#file_video').on('change', async function(event) {
                var source = $('#video');
                console.log($('#file_video'));
                source[0].src = URL.createObjectURL(this.files[0]);
                source.parent()[0].load();
            })
        })
    </script>
@endpush

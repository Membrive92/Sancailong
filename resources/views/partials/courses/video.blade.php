

@push('styles')
    <link href="{{asset('https://vjs.zencdn.net/7.5.5/video-js.css')}}" rel="stylesheet" />

@endpush

<div class="col-12 pt-0 mt-4 mb-4">

    <video
        id="my-video"
        class="text-warning shadow-lg video-js vjs-16-9 vjs-big-play-centered"
        controls
        preload="auto"
        data-setup="{fluid}"
    >
        <source src="{{ $course->Video_pathAttachment() }}" type="video/mp4" />
    </video>
</div>


@push('scripts')
    <script src="{{ asset('https://vjs.zencdn.net/7.5.5/video.js')}}"></script>
@endpush

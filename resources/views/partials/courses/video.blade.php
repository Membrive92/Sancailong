<div class="col-12 pt-0 mt-4 mb-4">
    <h2> {{ $course->video_name }}</h2>
    <video width="100%" height="100%" controls src="{{ $course->Video_pathAttachment() }}" controlslist="nodownload" type="video/mp4"></video>
</div>
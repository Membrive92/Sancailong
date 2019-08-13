<form action="{{ route('courses.destroy', ['slug' => $course->slug]) }}" method="POST">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-dark text-warning">
        <i class="fa fa-trash"></i> {{ __("Eliminar curso") }}
    </button>
</form>
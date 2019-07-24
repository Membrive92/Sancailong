<div class="col-12 pt-0 mt-0">
    <h2 class="text-muted ">{{ __("Requisitos Para el curso") }}</h2>
    <hr>
</div>
@forelse( $requirements as $requirement)
    <div class="col-6">
        <div class="card bg-dark p-3">
            <p class="mb-0 text-warning">
                {{ $requirement->requirement }}
            </p>
        </div>
    </div>
@empty
    <div class="alert alert-dark">
        <i class="fa fa-into-circle"></i>
        {{__("No hay requisitos para el curso")}}
    </div>
@endforelse
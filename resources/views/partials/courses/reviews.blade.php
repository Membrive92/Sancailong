<div class="align-content-center ">
    <div class="col-12 pt-0 mt-4 ">
        <h2 class="text-dark" style="font-size: 35px; font-weight: 600">{{ __("Valoraciones") }}</h2>
        <hr>
    </div>
    <div class="container-fluid">
        <div class="row">
            @forelse($course->reviews as $review)
              <div class="col-md-8 offset-2 listing-block">
                  <div class="media">
                      <img style="width: 20%; height: 20%" class="img-rounded" src="{{ $review->user->pathAttachment() }}" alt="{{ $review->user->name }}">
                      <div class="media-body pl-3">
                          @if($review->comment)
                          <div class="price"><h4>{{ $review->comment }}</h4></div>
                              @endif
                          <div class="stats">
                              {{$review->created_at->format('d/m/Y')}}
                              @include('partials.courses.rating', ['rating' => $review->rating])
                          </div>
                      </div>
                  </div>
              </div>
            @empty
                <div class="alert alert-dark"><i class="fa fa-info-circle"></i> {{ __("Sin valoraciones todavia") }}
                </div>
            @endforelse
        </div>
    </div>
</div>

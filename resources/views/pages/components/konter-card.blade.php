<div class="col-lg-4 col-md-6">
    <div class="team-member">
        <img loading="lazy" src="{{ $thumbnail ? url(Storage::url($thumbnail)) : asset('/img/toko.jpg') }}" alt="leptop"
            class="img-fluid p-3">
        <div class="contents text-center">
            <h4>{{ $name }}</h4>
            <div class="ratings">
                @if ($rating > 0)
                    @for ($i = 1; $i <= 5; $i++)
                        @if ($i <= $rating)
                            <i class="fa fa-star text-warning"></i>
                        @else
                            <i class="fa fa-star text-muted"></i>
                        @endif
                    @endfor
                @else
                    @for ($i = 1; $i <= 5; $i++)
                        <i class="fa fa-star text-muted"></i>
                    @endfor
                @endif
            </div>
            <small>{{ $reviewCount }} Ulasan</small>
            <div class="mt-3">
                <button type="button" class="btn btn-main" data-toggle="modal" data-target="{{ $modalTarget }}">
                    Detail Konter
                </button>
            </div>
        </div>
    </div>
</div>

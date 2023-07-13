@extends('layouts.frontend.app')
@section('content')
    <section class="team-section section">
        <div class="container text-center">
            <div class="section-title ">
                <h3>{{ $title }}</h3>

            </div>
            <div class="row justify-content-center">
                @foreach ($konter as $item)
                    <div class="col-lg-4 col-md-6">
                        <div class="team-member">
                            <img loading="lazy"
                                src="{{ $item->thumbnail == null || $item->thumbnail == '' ? asset('/img/toko.jpg') : url(Storage::url($item->thumbnail)) }}"
                                alt="leptop" class="img-fluid p-3">
                            <div class="contents text-center">
                                <h4>{{ $item->name }}</h4>
                                <div class="ratings">
                                    @php $rating = App\Models\ReviewRating::getKonterRating($item->id) @endphp
                                    @for ($i = 1; $i <= $rating; $i++)
                                        <i class="fa fa-star text-warning"></i>
                                    @endfor
                                </div>
                                <small>{{ App\Models\ReviewRating::getKonterCount($item->id) }} Ulasan</small>
                                <div class="mt-3">

                                    <button type="button" class="btn btn-main" data-toggle="modal"
                                        data-target="#toko-{{ $item->slug }}">
                                        Detail Konter
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
            <div class="mt-3">
                {!! $konter->links() !!}
            </div>
        </div>
    </section>
    <!--End team section-->
    @include('pages.modal_toko')
@endsection
@section('script')
    <script type="text/javascript">
        $("#konter").addClass("active");
    </script>
@endsection

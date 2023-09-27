@extends('layouts.frontend.app')
@section('content')
    <section class="team-section section">
        <div class="container text-center">
            <div class="section-title ">
                <h3>{{ $title }}</h3>

            </div>
            <div class="row justify-content-center">
                @foreach ($konter as $item)
                    @component('pages.components.konter-card', [
                        'thumbnail' => $item->thumbnail,
                        'name' => $item->name,
                        'rating' => App\Models\ReviewRating::getKonterRating($item->id),
                        'reviewCount' => App\Models\ReviewRating::getKonterCount($item->id),
                        'modalTarget' => '#toko-' . $item->slug,
                        'url_detail' => url('/konter_detail', $item->slug),
                    ])
                    @endcomponent
                @endforeach

            </div>
            <div class="mt-3">
                {!! $konter->links() !!}
            </div>
        </div>
    </section>
    <!--End team section-->
    @foreach ($konter as $item)
        @include('pages.components.konter-modal', ['konter' => $item])
    @endforeach
@endsection
@section('script')
    <script type="text/javascript">
        $("#konter").addClass("active");
    </script>
@endsection

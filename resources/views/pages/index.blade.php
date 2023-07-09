@extends('layouts.frontend.app')
@section('content')
    @include('layouts.frontend.slider')

    <!--team section-->
    <section class="team-section section">
        <div class="container text-center">
            <div class="section-title ">
                <h3>Daftar Produk</h3>
            </div>
            <div class="row justify-content-center ">
                @foreach ($produk as $item)
                    <div class="col-lg-4 col-md-6">
                        <div class="team-member">
                            <img loading="lazy" src="{{ asset('/') }}img/leptop.png" alt="leptop" class="img-fluid p-3">
                            <div class="contents ">
                                <b
                                    class="p-2  text-white {{ $item->status == 'Tersedia' ? 'bg-info' : 'bg-danger' }}">{{ $item->status }}</b>
                                <div class="text-center mt-2">
                                    <h4 class="text-danger">Rp {{ number_format($item->price) }}</h4>

                                    <h5 style="color:black;" class="pb-3">{{ $item->name }}</h5>
                                    <button type="button" class="btn btn-main" data-toggle="modal"
                                        data-target="#produk-{{ $item->slug }}">
                                        Detail Produk
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
            <a href="{{ url('/produk_list') }}" class="btn btn-style-one mt-4">Lihat Lebih Banyak Produk</a>
        </div>
    </section>
    <!--End team section-->
    <!--team section-->
    <section class="team-section section">
        <div class="container text-center">
            <div class="section-title ">
                <h3>Daftar Konter</h3>

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
                                    <i class="fa fa-star text-warning"></i>
                                    <i class="fa fa-star text-warning"></i>
                                    <i class="fa fa-star text-warning"></i>
                                    <i class="fa fa-star text-warning"></i>
                                    <i class="fa fa-star"></i>
                                </div>
                                <small>12 Reviews</small>
                                <div class="mt-3">

                                    <button type="button" class="btn btn-main" data-toggle="modal"
                                        data-target="#toko-{{ $item->slug }}">
                                        Detail Toko
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
            <a href="{{ url('/konter_list') }}" class="btn btn-style-one mt-4">Lihat Semua Toko</a>
        </div>
    </section>
    <!--End team section-->
    @include('pages.modal_produk')
    @include('pages.modal_toko')
@endsection
@section('script')
    <script type="text/javascript">
        $("#beranda").addClass("active");
    </script>
@endsection

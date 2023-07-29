@extends('layouts.frontend.app')
@section('content')
    @include('layouts.frontend.slider')
    <div class="container" style="margin-top: 100px">
        <div class=" text-center justify-content-center p-3 border border-secondary " style="border-radius:20px;">
            <form action="{{ url('/service') }}" method="POST">
                @csrf
                <div class="row ">
                    <div class="col-9">
                        <input type="text" class="form-control @if ($errors->has('keyword')) is-invalid @endif"
                            name="keyword" style="border-radius:10px;" placeholder="Tulis Kode service anda di sini">
                        @if ($errors->has('keyword'))
                            <small class="text-danger">*Kode service salah, mohon cek kembali kode service anda</small>
                        @endif
                    </div>
                    <div class="col-3 ">
                        <button type="submit" class="btn btn-info"><i class="fa fa-search"></i> Cek Code Service</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!--team section-->
    <section class="team-section section">
        <div class="container text-center">
            <div class="section-title ">
                <h3>Daftar Produk</h3>
            </div>
            <div class="row justify-content-center ">
                @foreach ($produk as $item)
                    @php
                        $total_stok = App\Models\ProdukStok::getTotalStokProduk($item->id);
                    @endphp
                    <div class="col-lg-4 col-md-6">
                        <div class="team-member">
                            <img loading="lazy"
                                src="{{ $item->thumbnail == null || $item->thumbnail == '' ? asset('/img/toko.jpg') : url(Storage::url($item->thumbnail)) }}"
                                alt="leptop" class="img-fluid p-3">
                            <div class="contents ">
                                <b
                                    class="p-2  text-white {{ $total_stok > 0 ? 'bg-info' : 'bg-danger' }}">{{ $total_stok > 0 ? 'Tersedia' : 'Habis' }}</b>
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
                                        Detail Konter
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
            <a href="{{ url('/konter_list') }}" class="btn btn-style-one mt-4">Lihat Semua Konter</a>
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

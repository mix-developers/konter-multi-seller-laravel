@extends('layouts.frontend.app')

@section('content')
    @include('layouts.frontend.slider')
    <div class="container" style="margin-top: 100px">
        <div class=" text-center justify-content-center p-3 border border-secondary " style="border-radius:20px;">
            <form action="{{ url('/service') }}" method="GET">
                {{-- @csrf --}}
                <div class="row ">
                    <div class="col-9">
                        <input type="text" class="form-control @if ($errors->has('code')) is-invalid @endif"
                            name="code" style="border-radius:10px;" placeholder="Tulis Kode service anda di sini">
                        @if ($errors->has('code'))
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

    <!-- Team section for Products -->
    <section class="team-section section">
        <div class="container text-center">
            <div class="section-title">
                <h3>Daftar Produk</h3>
            </div>
            <div class="row justify-content-center">
                @foreach ($produk as $item)
                    @php
                        $total_stok = App\Models\ProdukStok::getTotalStokProduk($item->id);
                    @endphp
                    @component('pages.components.product-card', [
                        'thumbnail' => $item->thumbnail,
                        'total_stok' => $total_stok,
                        'price' => $item->price,
                        'name' => $item->name,
                        'modalTarget' => '#produk-' . $item->slug,
                        'namaKonter' => $item->konter->name,
                    ])
                    @endcomponent
                @endforeach
            </div>
            <a href="{{ url('/produk_list') }}" class="btn btn-style-one mt-4">Lihat Lebih Banyak Produk</a>
        </div>
    </section>
    <!-- End team section for Products -->

    <!-- Team section for Konter -->
    <section class="team-section section">
        <div class="container text-center">
            <div class="section-title">
                <h3>Daftar Konter</h3>
            </div>
            <div class="row justify-content-center">
                @foreach ($konter as $item)
                    @component('pages.components.konter-card', [
                        'thumbnail' => $item->thumbnail,
                        'name' => $item->name,
                        'rating' => App\Models\ReviewRating::getKonterRating($item->id),
                        'reviewCount' => App\Models\ReviewRating::getKonterCount($item->id),
                        'modalTarget' => '#toko-' . $item->slug,
                    ])
                    @endcomponent
                @endforeach
            </div>
            <a href="{{ url('/konter_list') }}" class="btn btn-style-one mt-4">Lihat Semua Konter</a>
        </div>
    </section>
    <!-- End team section for Konter -->

    @foreach ($produk as $item)
        @php
            $total_stok = App\Models\ProdukStok::getTotalStokProduk($item->id);
        @endphp
        @include('pages.components.product-modal', ['product' => $item, 'total_stok' => $total_stok])
    @endforeach

    @foreach ($konter as $item)
        @include('pages.components.konter-modal', ['konter' => $item])
    @endforeach
@endsection

@section('script')
    <script type="text/javascript">
        $("#beranda").addClass("active");
    </script>
@endsection

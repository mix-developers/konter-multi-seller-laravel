@extends('layouts.frontend.app')
@section('content')
    <!--team section-->
    <section class="team-section section">
        <div class="container ">
            <div class="section-title text-center">
                <h3>{{ $title }}</h3>

            </div>
            <div class="row">
                <div class="col-lg-9">
                    <div class="row justify-content-center ">
                        @foreach ($produk as $item)
                            @php
                                $total_stok = App\Models\ProdukStok::getTotalStokProduk($item->id);
                            @endphp
                            <div class="col-lg-6 col-md-6">
                                <div class="team-member">
                                    <img loading="lazy"
                                        src="{{ $item->thumbnail == '' ? asset('img/no-image.jpg') : url(Storage::url($item->thumbnail)) }}"
                                        alt="leptop" class="img-fluid p-3" style="height: 90%;">
                                    <div class="contents ">
                                        <b
                                            class="p-2  text-white {{ $total_stok > 0 ? 'bg-info' : 'bg-danger' }}">{{ $total_stok > 0 ? 'Tersedia' : 'Habis' }}</b>
                                        <div class="text-center mt-2">
                                            <h4 class="text-danger">Rp {{ number_format($item->price) }}</h4>
                                            <h5 style="color:black;" class="pb-3">{{ $item->name }}</h5>
                                            <span>Counter : {{ $item->konter->name }}</span><br>
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
                </div>
                <div class="col-lg-3">
                    <div class="right-side">
                        <div class="text-title">
                            <h6>Cari Produk</h6>
                        </div>
                        <div class="search-box">
                            <form method="post" action="index.html">
                                <div class="input-group">
                                    <input class="form-control" type="search" name="search"
                                        placeholder="Tulis untuk mencari" required="" autocomplete="off">
                                </div>
                            </form>
                        </div>
                        <div class="categorise-menu">
                            <div class="text-title">
                                <h6>Kategori Produk</h6>
                            </div>
                            <ul class="categorise-list">
                                @foreach ($kategori as $list)
                                    <li><a href="{{ url('/') }}">{{ $list->kategori }}
                                            <span>({{ App\Models\Produk::getCountKategori($list->id) }})</span></a></li>
                                @endforeach
                            </ul>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </section>
    <!--End team section-->

    @foreach ($produk as $item)
        @php
            $total_stok = App\Models\ProdukStok::getTotalStokProduk($item->id);
        @endphp
        @include('pages.components.product-modal', ['product' => $item, 'total_stok' => $total_stok])
    @endforeach
@endsection
@section('script')
    <script type="text/javascript">
        $("#produk").addClass("active");
    </script>
@endsection

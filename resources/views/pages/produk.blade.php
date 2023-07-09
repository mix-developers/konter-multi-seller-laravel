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
                            <div class="col-lg-6 col-md-6">
                                <div class="team-member">
                                    <img loading="lazy" src="{{ asset('/') }}img/leptop.png" alt="leptop"
                                        class="img-fluid p-3">
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
                                    <li><a href="blog.html">{{ $list->kategori }} <span>(20)</span></a></li>
                                @endforeach
                            </ul>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </section>
    <!--End team section-->

    @include('pages.modal_produk')
@endsection
@section('script')
    <script type="text/javascript">
        $("#produk").addClass("active");
    </script>
@endsection

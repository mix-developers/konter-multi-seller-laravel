@extends('layouts.frontend.app')
@section('content')
    <!--team section-->
    <section class="team-section section">
        <div class="container">
            <div class="section-title ">
                <h3 class="text-center">{{ $title }}
                    @if (date('h:i') > $konter->time_close || date('h:i') < $konter->time_open)
                        <span class="badge badge-danger text-white">TUTUP</span>
                    @else
                        <span class="badge badge-success text-white">BUKA</span>
                    @endif

                </h3>
                <div class="row">
                    <div class="col-md-9">
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
                    <div class="col-md-3">
                        <div class="right-side">

                            <div class="categorise-menu">
                                <div class="text-title">
                                    <h6 class="text-info">Informasi Konter</h6>
                                </div>
                                <ul class="categorise-list">
                                    <li><a href="#"><strong>Nama Konter : </strong>{{ $konter->name }} </a></li>
                                    <li><a href="#"><strong>Pemilik Konter : </strong>{{ $konter->pemilik->name }}
                                        </a>
                                    </li>
                                    <li><a href="#"><strong>Alamat Konter : </strong>{{ $konter->address }} </a>
                                    </li>
                                    <li><a href="#"><strong>Jam Buka : </strong>{{ $konter->time_open }} -
                                            {{ $konter->time_close }} WIT</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="categorise-menu">
                                <div class="text-title">
                                    <h6 class="text-info">Layanan</h6>
                                </div>
                                <ul class="categorise-list">
                                    @foreach ($layanan as $list)
                                        <li> <a href="#"><i class="fa fa-angle-right text-info"></i>
                                                {{ $list->layanan->layanan }}</a></li>
                                    @endforeach
                                </ul>
                            </div>

                        </div>

                    </div>
                </div>
            </div>

        </div>
    </section>
    <!--End team section-->
    @include('pages.modal_produk')
@endsection

@section('css')
    <style>
        .rate {
            float: left;
        }

        .rate:not(:checked)>input {
            position: absolute;
            display: none;
        }

        .rate:not(:checked)>label {
            float: right;
            width: 1em;
            overflow: hidden;
            white-space: nowrap;
            cursor: pointer;
            font-size: 30px;
            color: #ccc;
        }

        .rated:not(:checked)>label {
            float: right;
            width: 1em;
            overflow: hidden;
            white-space: nowrap;
            cursor: pointer;
            font-size: 30px;
            color: #ccc;
        }

        .rate:not(:checked)>label:before {
            content: '★ ';
        }

        .rate>input:checked~label {
            color: #ffc700;
        }

        .rate:not(:checked)>label:hover,
        .rate:not(:checked)>label:hover~label {
            color: #deb217;
        }

        .rate>input:checked+label:hover,
        .rate>input:checked+label:hover~label,
        .rate>input:checked~label:hover,
        .rate>input:checked~label:hover~label,
        .rate>label:hover~input:checked~label {
            color: #c59b08;
        }

        .star-rating-complete {
            color: #c59b08;
        }

        .rating-container .form-control:hover,
        .rating-container .form-control:focus {
            background: #fff;
            border: 1px solid #ced4da;
        }

        .rating-container textarea:focus,
        .rating-container input:focus {
            color: #000;
        }

        .rated {
            float: left;

        }

        .rated:not(:checked)>input {
            position: absolute;
            display: none;
        }

        .rated:not(:checked)>label {
            float: right;
            width: 1em;
            overflow: hidden;
            white-space: nowrap;
            cursor: pointer;
            font-size: 30px;
            color: #ffc700;
        }

        .rated:not(:checked)>label:before {
            content: '★ ';
        }

        .rated>input:checked~label {
            color: #ffc700;
        }

        .rated:not(:checked)>label:hover,
        .rated:not(:checked)>label:hover~label {
            color: #deb217;
        }

        .rated>input:checked+label:hover,
        .rated>input:checked+label:hover~label,
        .rated>input:checked~label:hover,
        .rated>input:checked~label:hover~label,
        .rated>label:hover~input:checked~label {
            color: #c59b08;
        }
    </style>
@endsection
@extends('layouts.frontend.app')
@section('content')
    @php
        use Carbon\Carbon;
    @endphp
    <!--team section-->
    <section class="team-section section">
        <div class="container">
            <div class="section-title ">
                <h3 class="text-center">{{ $title }}
                    @if (Carbon::now()->between(Carbon::parse($konter->time_close), Carbon::parse($konter->time_open)))
                        <span class="badge badge-danger text-white">TUTUP</span>
                    @else
                        <span class="badge badge-success text-white">BUKA</span>
                    @endif

                </h3>
                <div class="row">
                    <div class="col-md-9">
                        <div class="row justify-content-center ">
                            @forelse ($produk as $item)
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
                                                class="p-2  text-white {{ $item->total_stok > 0 ? 'bg-info' : 'bg-danger' }}">{{ $total_stok > 0 ? 'Tersedia' : 'Habis' }}</b>
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
                            @empty
                                <div class="text-center" style="height: 300px;">
                                    <p class="text-muted">Belum ada produk pada konter ini</p>
                                </div>
                            @endforelse


                        </div>
                        <div class="mt-4">
                            <hr>
                            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="pills-rating-tab" data-toggle="pill" href="#pills-rating"
                                        role="tab" aria-controls="pills-rating" aria-selected="true">Rating dan
                                        Ulasan</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="pills-chat-tab" data-toggle="pill" href="#pills-chat"
                                        role="tab" aria-controls="pills-chat" aria-selected="false">Chat Konter</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="pills-tabContent">
                                <div class="tab-pane fade show active" id="pills-rating" role="tabpanel"
                                    aria-labelledby="pills-rating-tab">
                                    @include('pages.tab-toko.toko-rating')
                                </div>
                                <div class="tab-pane fade" id="pills-chat" role="tabpanel" aria-labelledby="pills-chat-tab">
                                    @include('pages.tab-toko.toko-chat')
                                </div>
                            </div>
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
                                    <li><a href="#"><strong>Nomor Konter : </strong>{{ $konter->pemilik->phone }}
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
                                                {{ $list->layanan->layanan }}</a>
                                        </li>
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
    @foreach ($produk as $item)
        @php
            $total_stok = App\Models\ProdukStok::getTotalStokProduk($item->id);
        @endphp
        @include('pages.components.product-modal', ['product' => $item, 'total_stok' => $total_stok])
    @endforeach
@endsection

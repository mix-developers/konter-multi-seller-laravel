@section('css')
    <style>
        .rate {
            float: left;
            height: 46px;
            padding: 0 10px;
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
            height: 46px;
            padding: 0 10px;
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
    <!--team section-->
    <section class="team-section section">
        <div class="container ">
            <div class="section-title text-center">
                @if (Auth::user()->role == 'user')
                    <h3><a href="{{ url('/member/status_service') }}" class="btn btn-secondary mr-4">Kembali</a>
                        {{ $title }}</h3>
                @endif
                <hr>
                @if (App\Models\ServiceFinished::where('id_service', $service->id)->count() != 0)
                    <div class="alert alert-success" role="alert">
                        Service <b>{{ $service->code }}</b> telah selesai
                    </div>
                @endif
            </div>
            @if ($service != null)
                <div class="row">
                    <div class="col-lg-4">
                        <div class="card ">
                            <div class="card-header bg-info text-white">
                                Informasi Service
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered">
                                    <tr>
                                        <td>Foto Service</td>
                                        <td><img src="{{ $service->thumbnail == '' ? asset('img/user.png') : url(Storage::url($service->thumbnail)) }}"
                                                alt="{{ $service->name }}" class="img-fluid img-avatar" width="100"></td>
                                    </tr>
                                    <tr>
                                        <td>Nama Pelanggan</td>
                                        <td>{{ $service->pelanggan->name }}</td>
                                    </tr>
                                    <tr>
                                        <td>Layanan</td>
                                        <td>{{ $service->layanan->layanan }}</td>
                                    </tr>
                                    <tr>
                                        <td>Tanggal Service</td>
                                        <td>{{ $service->date }}</td>
                                    </tr>
                                </table>

                            </div>
                        </div>
                        @if (App\Models\ServiceFinished::where('id_service', $service->id)->count() == 0)
                            <div class="card my-3 text-center">
                                <div class="card-body">
                                    <h5 class="mb-2">Service selesai</h5>
                                    <form action="{{ url('/member/service/storeFinish') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="id_service" value="{{ $service->id }}">
                                        <button type="submit" class="btn btn-success btn-block">Klaim</button>
                                    </form>
                                </div>
                            </div>
                        @else
                            @if (App\Models\ReviewRating::where('id_service', $service->id)->count() == 0)
                                <div class="card my-3 text-center">
                                    <div class="card-body">
                                        <h5 class="mb-2">Beri rating dan ulasan</h5>
                                        <hr>
                                        <form class="py-2 px-4" action="{{ url('/member/service/storeRating') }}"
                                            method="POST" autocomplete="off">
                                            @csrf
                                            <div class="form-group row justify-content-center">
                                                <input type="hidden" name="id_service" value="{{ $service->id }}">
                                                <input type="hidden" name="id_konter" value="{{ $service->konter->id }}">
                                                <input type="hidden" name="id_user" value="{{ Auth::user()->id }}">
                                                <div class="col">
                                                    <div class="rate">
                                                        <input type="radio" id="star5" class="rate"
                                                            name="star_rating" value="5" />
                                                        <label for="star5" title="text">5 stars</label>
                                                        <input type="radio" checked id="star4" class="rate"
                                                            name="star_rating" value="4" />
                                                        <label for="star4" title="text">4 stars</label>
                                                        <input type="radio" id="star3" class="rate"
                                                            name="star_rating" value="3" />
                                                        <label for="star3" title="text">3 stars</label>
                                                        <input type="radio" id="star2" class="rate"
                                                            name="star_rating" value="2">
                                                        <label for="star2" title="text">2 stars</label>
                                                        <input type="radio" id="star1" class="rate"
                                                            name="star_rating" value="1" />
                                                        <label for="star1" title="text">1 star</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row mt-4">
                                                <div class="col">
                                                    <textarea class="form-control" name="comments" rows="6 " placeholder="Ulasan anda" maxlength="200"></textarea>
                                                </div>
                                            </div>
                                            <div class="mt-3 text-right">
                                                <button class="btn btn-sm py-2 px-3 btn-info">Kirim
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            @else
                                @foreach (App\Models\ReviewRating::where('id_service', $service->id)->where('id_user', Auth::user()->id)->get() as $rating)
                                    <div class="card my-3 text-center">
                                        <div class="card-body">
                                            <h5 class="mb-2">Rating dan Ulasan Anda</h5>
                                            <hr>
                                            <div class="row">
                                                <div class="col mt-4">
                                                    <div class="form-group ">
                                                        <div class="ratings text-center">
                                                            @for ($i = 1; $i <= $rating->star_rating; $i++)
                                                                <i class="fa fa-star text-warning h1"></i>
                                                            @endfor
                                                        </div>
                                                    </div>
                                                    <div class="form-group row mt-4">
                                                        <div class="col">
                                                            <p>" {{ $rating->comments }} "</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        @endif
                    </div>
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-header bg-info text-white">
                                Informasi Status Service
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Status</th>
                                            <th>Tanggal</th>
                                        </tr>
                                    </thead>
                                    <thead>
                                        @foreach ($status as $item)
                                            <tr>
                                                <td>
                                                    {{ $loop->iteration }}
                                                </td>
                                                <td>
                                                    {{ $item->status->status }}<br>
                                                    @if ($item->thumbnail != null || $item->thumbanil != '')
                                                        <img src="{{ $item->thumbnail == '' ? asset('img/no-image.jpg') : url(Storage::url($item->thumbnail)) }}"
                                                            alt="{{ $item->name }}" class="img-fluid img-avatar"
                                                            width="100">
                                                    @endif
                                                </td>
                                                <td>{{ $item->date }}</td>
                                            </tr>
                                        @endforeach
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="text-center">
                    <p class="text-danger"><i class="fa fa-exclamation-triangle"></i> service tidak tersedia, mohon cek
                        kembali kode anda
                    </p>
                </div>
            @endif


        </div>
    </section>
    <!--End team section-->
@endsection

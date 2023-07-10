@extends('layouts.frontend.app')
@section('content')
    <!--team section-->
    <section class="team-section section">
        <div class="container ">
            <div class="section-title text-center">
                <h3>{{ $title }}</h3>

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

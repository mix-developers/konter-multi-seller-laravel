@extends('layouts.backand.admin')

@section('content')
    <section class="pc-container">

        <div class="pcoded-content">
            <!-- [ breadcrumb ] start -->
            @include('layouts.backand.title')
            <!-- [ breadcrumb ] end -->
            <!-- [ Main Content ] start -->
            <div class="row">
                <div class="col-12 mb-3">
                    <a href="{{ url('/konter/service') }}" class="btn btn-secondary">Kembali</a>
                </div>
                <!-- subscribe start -->
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>{{ $title }}</h5>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <tr>
                                    <td>Foto Service</td>
                                    <td><img src="{{ $service->thumbnail == '' ? asset('img/no-image.jpg') : url(Storage::url($service->thumbnail)) }}"
                                            alt="{{ $service->name }}" class="img-fluid img-avatar" width="100"></td>
                                </tr>
                                <tr>
                                    <td>Nama Pelanggan</td>
                                    <td>{{ $service->pelanggan->name }}<br>
                                        <small class="text-muted">{{ $service->pelanggan->email }}</small>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Kode Service</td>
                                    <td>{{ $service->code }}</td>
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
                    <div class="card">
                        <div class="card-header">
                            <div class="row align-items-center ">
                                <div class="col-sm-6">
                                    <h5>Status</h5>
                                </div>
                                <div class="col-sm-6 text-right">

                                    <button type="button" class="btn btn-success btn-md mb-3 btn-round" data-toggle="modal"
                                        data-target=".tambah-status"><i class="feather f-16 icon-plus"></i>
                                        Tambah</button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped mb-0 lara-dataTable">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Thumbnail</th>
                                            <th>Status</th>
                                            <th>Tanggal</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($status_service as $item)
                                            <tr>
                                                <td width="10">{{ $loop->iteration }}</td>
                                                <td width="150">
                                                    <div class="thumbnail">
                                                        <div class="thumb">
                                                            <a href="{{ $item->thumbnail == '' ? asset('img/no-image.jpg') : url(Storage::url($item->thumbnail)) }}"
                                                                data-lightbox="1" data-title="{{ $item->judul }}"
                                                                data-toggle="lightbox">
                                                                <img src="{{ $item->thumbnail == '' ? asset('img/no-image.jpg') : url(Storage::url($item->thumbnail)) }}"
                                                                    alt="{{ $item->name }}" class="img-fluid img-avatar"
                                                                    width="100">
                                                            </a>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    {{ $item->status->status }}
                                                </td>
                                                <td>
                                                    {{ $item->date }}
                                                </td>
                                                <td width="50">

                                                    <form method="POST"
                                                        action="{{ url('/konter/service/destroyStatus', $item->id) }}"
                                                        class="d-inline-block">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="btn btn-light-danger btn-md delete-button"><i
                                                                class="feather icon-trash-2  f-16 "></i> Delete
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('konter.service.modal_status')
@endsection

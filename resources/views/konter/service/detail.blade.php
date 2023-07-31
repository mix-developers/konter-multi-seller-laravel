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
                    @if ($service->deleted_at != null)
                        <div class="alert alert-danger" role="alert">
                            Service telah dibatalkan
                        </div>
                    @endif
                    <div class="card">
                        <div class="card-header">
                            <h5>{{ $title }}</h5>
                        </div>
                        <div class="card-body">

                            <div class="row">
                                <div class="col-md-4 p-2">
                                    <table class="table table-bordered">
                                        <tr>
                                            <td>Foto Service</td>
                                            <td>
                                                <img src="{{ $service->thumbnail == '' ? asset('img/no-image.jpg') : url(Storage::url($service->thumbnail)) }}"
                                                    alt="{{ $service->name }}" class="img-fluid img-avatar" width="100">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Kode Service</td>
                                            <td>
                                                {{ $service->code }}
                                                <a href="{{ url('status', $service->code) }}" class="text-primary">
                                                    <i class="fas fa-external-link-alt"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Layanan</td>
                                            <td>
                                                <span class="badge badge-light-primary" style="font-size: 16px;">
                                                    {{ $service->layanan->layanan }}
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Tanggal Service</td>
                                            <td>{{ $service->date }}</td>
                                        </tr>
                                    </table>
                                </div>

                                <div class="col-md-4 p-2">
                                    <table class="table table-bordered">
                                        <tr>
                                            <td>Nama Pelanggan</td>
                                            <td>
                                                {{ $service->pelanggan->name }}<br>
                                                <small class="text-muted">{{ $service->pelanggan->email }}</small>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Nomor Pelanggan</td>
                                            <td>{{ $service->pelanggan->phone }}</td>
                                        </tr>
                                    </table>
                                    <div class="mt-2">
                                        <a href="" class="btn btn-light-success btn-md" target="__blank">
                                            <i class="fab fa-whatsapp"></i> Hubungi Pelanggan
                                        </a>
                                        @if ($service->deleted_at == null)
                                            <form method="POST"
                                                action="{{ url('/konter/service/destroy', $service->id) }}"
                                                class="d-inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-light-danger btn-md delete-button">
                                                    <i class="fas fa-times-circle"></i> Batalkan Service
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-4 p-2">
                                    <button type="button" class="btn btn-success btn-md mb-3 btn-block" data-toggle="modal"
                                        data-target=".tambah-price">
                                        <i class="feather f-16 icon-plus"></i> Tambah Harga
                                    </button>
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Items</th>
                                                <th>Price</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($service_price as $item)
                                                <tr>
                                                    <td>{{ $item->name }}</td>
                                                    <td>Rp {{ number_format($item->price) }}</td>
                                                    <td width="50">
                                                        <a href="https://api.whatsapp.com/send?phone={{ $user->phone }}&text=Hai%20*{{ $user->name }}!*%0A__________________________________________________%0A*Informasi%20Tambahan%20Layanan*%0AKode%20service%20:%20{{ $service->code }}%0ATambahan%20Layanan%20:%20{{ $item->name }}%0ABiaya%20Layanan%20:%20Rp.{{ number_format($item->price) }}%0ATotal%20Biaya%20Service%20:%20Rp.{{ number_format($total_price) }}%0ACek%20di%20sini%20:%20{{ url('/status', $service->code) }}%0A___________________________________________________%0A*Informasi%20Konter*%0AKonter%20:%20*{{ $konter->name }}*%0AAlamat%20:%20*{{ $konter->address }}*%0A%0A_Balas IYA untuk melanjutkan dan Balas TIDAK untuk tidak melanjutkan, dan ajukan pertanyaan pada nomor ini jika ada yang ingin ditanyakan_"
                                                            class="btn btn-light-success btn-sm" target="__blank"
                                                            data-toggle="tooltip" data-placement="top" title=""
                                                            data-original-title="Klik untuk mengirim pesan whatsapp terkait penambahan layanan">
                                                            <i class="fab fa-whatsapp"></i>
                                                        </a>
                                                        <form method="POST"
                                                            action="{{ url('/konter/service/destroyPrice', $service->id) }}"
                                                            class="d-inline-block">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="btn btn-light-danger btn-sm delete-button"
                                                                data-toggle="tooltip" data-placement="top" title=""
                                                                data-original-title="Klik untuk menghapus">
                                                                <i class="fas fa-times-circle"></i>
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            <tr>
                                                <td><strong>Total</strong></td>
                                                <td><strong>Rp {{ number_format($total_price) }}</strong></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col-sm-6">
                                    <h5>Status</h5>
                                </div>
                                <div class="col-sm-6 text-right">
                                    @if ($service->deleted_at == null)
                                        <button type="button" class="btn btn-success btn-md mb-3 btn-round"
                                            data-toggle="modal" data-target=".tambah-status">
                                            <i class="feather f-16 icon-plus"></i> Tambah Status
                                        </button>
                                    @endif
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
                                    <tbody class="{{ $service->deleted_at != null ? 'table-danger' : '' }}">
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
                                                    @if ($service->deleted_at == null)
                                                        <a href="https://api.whatsapp.com/send?phone={{ $user->phone }}&text=Hai%20*{{ $user->name }}!*%0A__________________________________________________%0A*Informasi%20Service*%0AKode%20service%20:%20{{ $item->service->code }}%0ATotal%20Biaya%20:%20Rp.{{ number_format($total_price) }}%0AStatus%20service%20anda%20:%20*{{ $item->status->status }}*%0ACek%20di%20sini%20:%20{{ url('/status', $item->service->code) }}%0A___________________________________________________%0A*Informasi%20Konter*%0AKonter%20:%20*{{ $konter->name }}*%0AAlamat%20:%20*{{ $konter->address }}*"
                                                            class="btn btn-light-success btn-md" target="__blank"
                                                            data-toggle="tooltip" data-placement="top" title=""
                                                            data-original-title="Klik untuk mengirim pesan whatsapp terkait status service">
                                                            <i class="fab fa-whatsapp"></i>
                                                        </a>
                                                        <form method="POST"
                                                            action="{{ url('/konter/service/destroyStatus', $item->id) }}"
                                                            class="d-inline-block">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="btn btn-light-danger btn-md delete-button"
                                                                data-toggle="tooltip" data-placement="top" title=""
                                                                data-original-title="Klik untuk menghapus status">
                                                                <i class="feather icon-trash-2 f-16"></i> Delete
                                                            </button>
                                                        </form>
                                                    @endif
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

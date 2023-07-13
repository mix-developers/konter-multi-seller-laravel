@extends('layouts.backand.admin')

@section('content')
    <section class="pc-container">

        <div class="pcoded-content">
            <!-- [ breadcrumb ] start -->
            @include('layouts.backand.title')
            <!-- [ breadcrumb ] end -->
            <!-- [ Main Content ] start -->
            <div class="row">
                <!-- subscribe start -->
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>{{ $title }}</h5>
                        </div>
                        <div class="card-body">
                            <div class="row align-items-center m-l-0">
                                <div class="col-sm-6">
                                </div>
                                <div class="col-sm-6 text-right">

                                    <button type="button" class="btn btn-success btn-md mb-3 btn-round" data-toggle="modal"
                                        data-target=".tambah"><i class="feather f-16 icon-plus"></i>
                                        Tambah</button>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped mb-0 lara-dataTable">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Thumbnail</th>
                                            <th>Code</th>
                                            <th>Pelanggan</th>
                                            <th>Layanan</th>
                                            <th>Tanggal</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($service as $item)
                                            <tr class="@if ($item->deleted_at != null) table-warning @endif">
                                                <td width="10">{{ $loop->iteration }}</td>
                                                <td width="150">
                                                    <div class="thumbnail">
                                                        <div class="thumb">
                                                            <a href="{{ $item->thumbnail == '' ? asset('img/no-image.jpg') : url(Storage::url($item->thumbnail)) }}"
                                                                data-lightbox="1" data-title="{{ $item->name }}"
                                                                data-toggle="lightbox">
                                                                <img src="{{ $item->thumbnail == '' ? asset('img/no-image.jpg') : url(Storage::url($item->thumbnail)) }}"
                                                                    alt="{{ $item->name }}" class="img-fluid img-avatar"
                                                                    width="100">
                                                            </a>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <a href="" class="text-link">{{ $item->code }} <small><i
                                                                data-feather="external-link"></i></small></a>
                                                </td>
                                                <td>
                                                    {{ $item->pelanggan->name }}<br>
                                                    <small class="text-muted">{{ $item->pelanggan->email }}</small>
                                                </td>
                                                <td>
                                                    {{ $item->layanan->layanan }}
                                                </td>
                                                <td>
                                                    {{ $item->date }}
                                                </td>
                                                <td width="200">
                                                    <a href="{{ url('/konter/service/detail', $item->id) }}"
                                                        class="btn btn-light-success btn-md"><i
                                                            class="icon feather icon-eye f-16"></i> Status</a>
                                                    @if ($item->deleted_at == null)
                                                        <button type="button" class="btn btn-light-warning btn-md"
                                                            data-toggle="modal" data-target=".edit-{{ $item->id }}"><i
                                                                class="icon feather icon-edit f-16"></i>
                                                            Edit</button>
                                                        @include('konter.service.modal_edit')
                                                    @endif
                                                    {{-- <form method="POST"
                                                        action="{{ url('/konter/service/destroy', $item->id) }}"
                                                        class="d-inline-block">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="btn btn-light-danger btn-md delete-button"><i
                                                                class="feather icon-trash-2  f-16 "></i> Delete
                                                        </button>
                                                    </form> --}}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- subscribe end -->
            </div>
            <!-- [ Main Content ] end -->
        </div>
    </section>
    @include('konter.service.modal_create')
@endsection

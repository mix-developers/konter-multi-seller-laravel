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
                                            <th>Nama Produk</th>
                                            <th>Stok</th>
                                            <th>Jenis</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($stok as $item)
                                            <tr>
                                                <td width="10">{{ $loop->iteration }}</td>
                                                <td width="150">
                                                    <div class="thumbnail">
                                                        <div class="thumb">
                                                            <a href="{{ $item->produk->thumbnail == '' ? asset('img/user.png') : url(Storage::url($item->produk->thumbnail)) }}"
                                                                data-lightbox="1" data-title="{{ $item->produk->name }}"
                                                                data-toggle="lightbox">
                                                                <img src="{{ $item->produk->thumbnail == '' ? asset('img/user.png') : url(Storage::url($item->produk->thumbnail)) }}"
                                                                    alt="{{ $item->produk->name }}"
                                                                    class="img-fluid img-avatar" width="100">
                                                            </a>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    {{ $item->produk->name }}</p>
                                                </td>
                                                <td>
                                                    <span
                                                        class="{{ $item->type == 1 ? 'text-success' : 'text-danger' }}">{{ $item->stok }}</span>
                                                </td>
                                                <td>
                                                    <span
                                                        class="badge  {{ $item->type == 1 ? 'badge-success' : 'badge-danger' }}">{{ $item->type == 1 ? 'Pemasukkan' : 'Pengeluaran' }}</span>
                                                </td>
                                                <td width="200">
                                                    <button type="button" class="btn btn-light-warning btn-md"
                                                        data-toggle="modal" data-target=".edit-{{ $item->id }}"><i
                                                            class="icon feather icon-edit f-16"></i>
                                                        Edit</button>
                                                    @include('konter.stok.modal_edit')
                                                    <form method="POST"
                                                        action="{{ url('/konter/stok/destroy', $item->id) }}"
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
                <!-- subscribe end -->
            </div>
            <!-- [ Main Content ] end -->
        </div>
    </section>
    @include('konter.stok.modal_create')
@endsection

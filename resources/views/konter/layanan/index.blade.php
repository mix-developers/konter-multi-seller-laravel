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
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-header">
                            <h5>Tambah Layanan</h5>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ url('/konter/layanan/store') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="layanan">Layanan</label>
                                    <select name="id_layanan" id="id_layanan" class="form-control">
                                        <option value="">--Pilih Layanan --</option>
                                        @foreach ($layanan_list as $list)
                                            <option value="{{ $list->id }}">
                                                {{ $list->layanan }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <button type="submit" class="btn  btn-primary">Simpan</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header">
                            <h5>{{ $title }} </h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped mb-0 lara-dataTable">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>layanan</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($layanan as $item)
                                            {{-- @php
                                                $total_digunakan = App\File::where('id_kategori_file', $item->id)->count();
                                            @endphp --}}
                                            <tr>
                                                <td width="10">{{ $loop->iteration }}</td>
                                                <td>
                                                    {{ $item->layanan->layanan }}<br>
                                                    {{-- <span
                                                        class="badge badge-{{ $total_digunakan > 0 ? 'primary' : 'danger' }}">{{ $total_digunakan > 0 ? $total_digunakan . ' Files' : 'Belum Ada File' }}
                                                    </span> --}}
                                                </td>
                                                <td width="200">
                                                    <button type="button" class="btn btn-light-warning btn-md"
                                                        data-toggle="modal" data-target=".edit-{{ $item->id }}"><i
                                                            class="icon feather icon-edit f-16"></i>
                                                        Edit</button>
                                                    @include('konter.layanan.modal_edit')
                                                    <form method="POST"
                                                        action="{{ url('/konter/layanan/destroy', $item->id) }}"
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
@endsection

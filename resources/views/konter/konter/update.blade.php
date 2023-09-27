@extends('layouts.backand.admin')

@section('content')
    <section class="pc-container">

        <div class="pcoded-content">
            <!-- [ breadcrumb ] start -->
            @include('layouts.backand.title')
            <!-- [ breadcrumb ] end -->
            <!-- [ Main Content ] start -->
            <div class="row">
                <div class="col-md-12">
                    @if ($errors->any())
                        @foreach ($errors->all() as $item)
                            <div class="alert alert-danger" role="alert">
                                {{ $item }}
                            </div>
                        @endforeach
                    @endif
                </div>
                <!-- subscribe start -->
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            Update Counter
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ url('/konter/konter/update', $konter->id) }}"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="text-center mb-4">
                                    <img src="{{ $konter->thumbnail == '' ? asset('img/user.png') : url(Storage::url($konter->thumbnail)) }}"
                                        alt="{{ $konter->name }}" class="img-fluid img-avatar" width="300">
                                </div>
                                <div class="form-group">
                                    <label for="name">Foto Counter</label>
                                    <input type="file" class="form-control @error('thumbanil') is-invalid @enderror"
                                        name="thumbnail">
                                </div>
                                <div class="form-group">
                                    <label for="name">Nama Counter</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        name="name" value="{{ $konter->name }}">
                                </div>
                                <div class="form-group">
                                    <label for="address">Alamat Counter</label>
                                    <input type="text" class="form-control @error('address') is-invalid @enderror"
                                        name="address" value="{{ $konter->address }}">
                                </div>
                                <div class="form-group">
                                    <label for="id_pemilik">Pemilik Counter</label>
                                    <select name="id_pemilik" id="id_pemilik" class="form-control" disabled>
                                        <option value="">--Pilih Pemilik --</option>
                                        @foreach ($pemilik as $list)
                                            <option value="{{ $list->id }}"
                                                {{ $list->id == $konter->id_pemilik ? 'selected' : '' }}>
                                                {{ $list->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="time_open">Jam Buka (WIT)</label>
                                            <input type="time"
                                                class="form-control @error('time_open') is-invalid @enderror"
                                                name="time_open" value="{{ $konter->time_open }}">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="time_close">Jam Tutup (WIT)</label>
                                            <input type="time"
                                                class="form-control @error('time_close') is-invalid @enderror"
                                                name="time_close" value="{{ $konter->time_close }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <label>Deskripsi Counter</label>
                                    <textarea class="ckeditor" name="description" id="description" cols="30" rows="4">{!! $konter->description !!}</textarea>
                                </div>
                                <button type="submit" class="btn  btn-primary">Simpan</button>
                            </form>
                        </div>
                    </div>

                    <!-- subscribe end -->
                </div>
                <!-- [ Main Content ] end -->
            </div>
    </section>
@endsection
@push('js')
    <!-- CKEditor -->
    <script src="{{ asset('backand_theme') }}/assets/plugins/ckeditor/ckeditor.js"></script>
@endpush

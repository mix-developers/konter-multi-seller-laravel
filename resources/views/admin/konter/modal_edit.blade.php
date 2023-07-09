<div class="modal fade edit-{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title h4" id="myLargeModalLabel">Edit Konter</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">

                <form method="POST" action="{{ url('/admin/konter/update', $item->id) }}"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="name">Foto Konter</label>
                        <input type="file" class="form-control @error('thumbanil') is-invalid @enderror"
                            name="thumbnail">
                    </div>
                    <div class="form-group">
                        <label for="name">Nama Konter</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                            value="{{ $item->name }}">
                    </div>
                    <div class="form-group">
                        <label for="address">Alamat Konter</label>
                        <input type="text" class="form-control @error('address') is-invalid @enderror" name="address"
                            value="{{ $item->address }}">
                    </div>
                    <div class="form-group">
                        <label for="id_pemilik">Pemilik Konter</label>
                        <select name="id_pemilik" id="id_pemilik" class="form-control">
                            <option value="">--Pilih Pemilik --</option>
                            @foreach ($pemilik as $list)
                                <option value="{{ $list->id }}"
                                    {{ $list->id == $item->id_pemilik ? 'selected' : '' }}>
                                    {{ $list->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="time_open">Jam Buka (WIT)</label>
                                <input type="time" class="form-control @error('time_open') is-invalid @enderror"
                                    name="time_open" value="{{ $item->time_open }}">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="time_close">Jam Tutup (WIT)</label>
                                <input type="time" class="form-control @error('time_close') is-invalid @enderror"
                                    name="time_close" value="{{ $item->time_close }}">
                            </div>
                        </div>
                    </div>
                    <div class="form-group ">
                        <label>Deskripsi Konter</label>
                        <textarea class="ckeditor" name="description" id="description" cols="30" rows="4">{!! $item->description !!}"</textarea>
                    </div>
                    <button type="submit" class="btn  btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
@push('js')
    <!-- CKEditor -->
    <script src="{{ asset('backand_theme') }}/assets/plugins/ckeditor/ckeditor.js"></script>
@endpush

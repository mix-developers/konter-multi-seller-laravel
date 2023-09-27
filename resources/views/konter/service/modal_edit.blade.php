<div class="modal fade edit-{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title h4" id="myLargeModalLabel">Edit Service</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">

                <form method="POST" action="{{ url('/konter/service/update', $item->id) }}"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id_konter" value="{{ $konter->id }}">

                    <div class="form-group">
                        <label for="name">Foto Device</label>
                        <input type="file" class="form-control @error('thumbanil') is-invalid @enderror"
                            name="thumbnail">
                    </div>
                    <div class="form-group">
                        <label for="layanan">Layanan</label>
                        <select name="id_layanan" id="id_layanan" class="form-control">
                            <option value="">--Pilih Layanan --</option>
                            @foreach ($layanan_list as $list)
                                <option value="{{ $list->id_layanan }}"
                                    {{ $list->id_layanan == $item->id_layanan ? 'selected' : '' }}>
                                    {{ $list->layanan->layanan }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="layanan">Pelanggan</label>
                        <select name="id_user" id="id_user" class="form-control">
                            <option value="">--Pilih Pelanggan --</option>
                            @foreach ($pelanggan as $list)
                                <option value="{{ $list->id }}" {{ $list->id == $item->id_user ? 'selected' : '' }}>
                                    {{ $list->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group ">
                        <label>Deskripsi Produk</label>
                        <textarea class="ckeditor" name="description" id="description" cols="30" rows="4">{!! $item->description !!}</textarea>
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

<div class="modal fade edit-{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title h4" id="myLargeModalLabel">Edit Produk</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">

                <form method="POST" action="{{ url('/konter/produk/update', $item->id) }}"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id_konter" value="{{ $konter->id }}">
                    <div class="form-group">
                        <label for="name">Foto Produk</label>
                        <input type="file" class="form-control @error('thumbanil') is-invalid @enderror"
                            name="thumbnail">
                    </div>
                    <div class="row">
                        <div class="col-9">
                            <div class="form-group">
                                <label for="name">Nama Produk</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    name="name" value="{{ $item->name }}">
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="Tersedia" {{ $item->status == 'Tersedia' ? 'selected' : '' }}>
                                        Tersedia
                                    </option>
                                    <option value="Habis" {{ $item->status == 'Habis' ? 'selected' : '' }}>Habis
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="price">Harga Produk</label>
                                <input type="number" class="form-control @error('price') is-invalid @enderror"
                                    name="price" value="{{ $item->price }}">
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="stok">Stok Produk</label>
                                <input type="text" class="form-control @error('stok') is-invalid @enderror"
                                    name="stok" value="{{ $item->stok }}">
                            </div>
                        </div>
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

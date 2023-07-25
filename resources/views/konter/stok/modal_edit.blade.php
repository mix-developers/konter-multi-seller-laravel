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

                <form method="POST" action="{{ url('/konter/produk/update', $item->id) }}"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id_konter" value="{{ $konter->id }}">
                    <div class="row">
                        <div class="col-3">
                            <div class="form-group">
                                <label for="stok">Total Stok</label>
                                <input type="number" class="form-control @error('stok') is-invalid @enderror"
                                    name="stok" value="{{ $item->stok }}">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="id_produk">Produk</label>
                                <select name="id_produk" id="id_produk" class="form-control">
                                    @foreach (App\Models\Produk::getProdukKonter($konter->id) as $produk)
                                        <option value="{{ $produk->id }}"
                                            @if ($produk->id == $item->id_produk) selected @endif>{{ $produk->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="type">Jenis</label>
                                <select name="type" id="type" class="form-control">
                                    <option value="1" @if ($item->type == 1) selected @endif>Pemasukan
                                    </option>
                                    <option value="0" @if ($item->type == 0) selected @endif>Pengeluaran
                                    </option>
                                </select>
                            </div>
                        </div>
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

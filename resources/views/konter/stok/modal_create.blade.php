<div class="modal fade tambah" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title h4" id="myLargeModalLabel">Tambah Konter</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">

                <form method="POST" action="{{ url('/konter/stok/store') }}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id_konter" value="{{ $konter->id }}">

                    <div class="row">
                        <div class="col-3">
                            <div class="form-group">
                                <label for="stok">Total Stok</label>
                                <input type="text" class="form-control @error('stok') is-invalid @enderror"
                                    name="stok">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="id_produk">Produk</label>
                                <select name="id_produk" id="id_produk" class="form-control">
                                    @foreach (App\Models\Produk::getProdukKonter($konter->id) as $produk)
                                        <option value="{{ $produk->id }}">{{ $produk->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="type">Jenis</label>
                                <select name="type" id="type" class="form-control">
                                    <option value="1">Pemasukan</option>
                                    <option value="0">Pengeluaran</option>
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

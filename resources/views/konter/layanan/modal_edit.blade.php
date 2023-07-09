<div class="modal fade edit-{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title h4" id="myLargeModalLabel">Edit</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">

                <form method="POST" action="{{ url('/konter/layanan/update', $item->id) }}"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="layanan">Layanan</label>
                        <select name="id_layanan" id="id_layanan" class="form-control">
                            <option value="">--Pilih Layanan --</option>
                            @foreach ($layanan_list as $list)
                                <option value="{{ $list->id }}"
                                    {{ $list->id == $item->id_layanan ? 'selected' : '' }}>
                                    {{ $list->layanan }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn  btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
@push('js')
    <script src="{{ asset('admin_theme') }}/assets/plugins/ckeditor/ckeditor.js"></script>
    <!-- CKEditor -->
    <script src="{{ asset('admin_theme') }}/assets/plugins/ckeditor/ckeditor.js"></script>
@endpush

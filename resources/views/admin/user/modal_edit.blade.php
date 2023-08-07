<div class="modal fade edit-{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title h4" id="myLargeModalLabel">Tambah Konter</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">

                <div class="row">
                    <div class="col-12">
                        <div class="tab-content" id="user-set-tabContent">
                            <div class="tab-pane fade show active" id="user-set-profile" role="tabpanel"
                                aria-labelledby="user-set-profile-tab">

                                <form method="POST" action="{{ url('/admin/user/update', $item->id) }}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-row">
                                        <div class="form-group col-md-12">
                                            <img src="{{ $item->avatar == '' ? asset('img/default.png') : url(Storage::url($item->avatar)) }}"
                                                alt="" width="200">
                                            <br>
                                            <label>Avatar</label>
                                            <input type="file" class="form-control" name="avatar">
                                            <small>Upload gambar jika ingin perbarui</small>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label>Email</label>
                                            <input type="email" class="form-control" name="email"
                                                placeholder="email" value="{{ $item->email }}" required>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Password</label>
                                            <input type="password" class="form-control" name="password"
                                                placeholder="Password">
                                            <small>Kosongkan jika tidak dirubah</small>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Nama Lengkap</label>
                                            <input type="text" class="form-control" name="name"
                                                placeholder="Nama Lengkap" value="{{ $item->name }}" required>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Nomor Handphone</label>
                                            <input type="number" class="form-control" name="phone"
                                                placeholder="Nomor Handphone" value="{{ $item->phone }}" required>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn  btn-primary">Simpan</button>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('js')
    <!-- CKEditor -->
    <script src="{{ asset('backand_theme') }}/assets/plugins/ckeditor/ckeditor.js"></script>
@endpush

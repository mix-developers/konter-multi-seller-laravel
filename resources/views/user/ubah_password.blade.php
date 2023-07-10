@extends('layouts.frontend.app')
@section('content')
    <!--team section-->
    <section class=" " style="margin-top:50px; margin-bottom:50px;">
        <div class="container ">
            <div class="section-title text-center">
                <h3>{{ $title }}</h3>

            </div>

        </div>
    </section>
    <!--End team section-->
    <section style="margin-top:50px; margin-bottom:100px;">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-4">
                    @include('user.menu_user')
                </div>
                <div class="col-lg-9 col-md-8">
                    <div class="card shadow shadow-sm rounded">
                        <div class="card-header">
                            <strong>Ubah Password akun</strong>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control " name="password" required>
                                <small>*kosongkan jika tidak ingin mengganti password anda</small>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-info">Simpan Password</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('script')
    <script type="text/javascript">
        $("#produk").addClass("active");
    </script>
@endsection

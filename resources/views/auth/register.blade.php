@extends('layouts.auth_theme.app')

@section('content')
    <!-- [ auth-signup ] start -->
    <div class="auth-wrapper" style="background: #48bdc5;">
        <div class="auth-content">
            <div class="card">
                <div class="row align-items-center text-center">
                    <div class="col-md-12">
                        <div class="card-body">
                            <form method="POST" action="{{ route('register') }}">
                                @csrf
                                {{-- <img src="assets/images/logo-dark.svg" alt="" class="img-fluid mb-4"> --}}
                                <h1><a href="{{ url('/') }}" class="text-primary">SimVice</a></h1>
                                <h4 class="mb-3 f-w-400 ">Sign up</h4>

                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i data-feather="user"></i></span>
                                    </div>
                                    <input type="text" name="name" class="form-control" placeholder="name">
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i data-feather="phone"></i>
                                        </span>
                                    </div>
                                    <input type="text" name="phone" class="form-control" placeholder="Nomor HP aktif">
                                    @error('phone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i data-feather="mail"></i></span>
                                    </div>
                                    <input type="email" name="email" class="form-control" placeholder="Email address">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="input-group mb-4">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i data-feather="lock"></i></span>
                                    </div>
                                    <input type="password" name="password" class="form-control" placeholder="Password">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="input-group mb-4">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i data-feather="lock"></i></span>
                                    </div>
                                    <input type="password" name="password_confirmation" required autocomplete="new-password"
                                        class="form-control" placeholder="Konfirmasi Password">
                                </div>

                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <label class="input-group-text" for="inputGroupSelect01">Akun</label>
                                    </div>
                                    <select class="custom-select" id="role" name="role">
                                        <option value="user">Pelanggan</option>
                                        <option value="konter">Konter</option>
                                    </select>
                                    @error('role')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <button class="btn btn-info btn-block mb-4" type="submit">Sign up</button>
                                <p class="mb-2">Sudah memiliki akun? <a href="{{ url('/login') }}"
                                        class="f-w-400">Masuk</a>
                                </p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

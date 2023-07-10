<!--header top-->
<div class="header-top">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="top-left text-center text-md-left">
                    <h1>SimVice</h1>
                </div>
            </div>
            <div class="col-md-6">
                <div class="top-right text-center text-md-right">
                    <ul class="social-links my-3">
                        @guest
                            @if (Route::has('login'))
                                <li class="">
                                    <a class="btn btn-info" href="{{ route('login') }}">{{ __('Masuk') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="">
                                    <a class="btn btn-outline-info" href="{{ route('register') }}">{{ __('Daftar') }}</a>
                                </li>
                            @endif
                        @else
                            @if (Auth::user()->role == 'admin' || Auth::user()->role == 'super_admin')
                                <li class="">
                                    <a class="btn btn-outline-warning" href="{{ url('/admin') }}">{{ __('Dashboard') }}</a>
                                </li>
                            @elseif (Auth::user()->role == 'konter')
                                <li class="">
                                    <a class="btn btn-outline-warning" href="{{ url('/konter') }}">{{ __('Dashboard') }}</a>
                                </li>
                            @else
                                <li>
                                    <button type="button" class="btn " data-toggle="modal" data-target="#notif">
                                        <i class="fa fa-bell text-info"></i>
                                    </button>
                                </li>
                                <li class="">
                                    <a class="btn btn-outline-info" href="{{ url('/member') }}">
                                        Akun saya</a>
                                </li>
                            @endif
                            <li class="">
                                <a class="btn btn-danger" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">{{ __('Keluar') }}</a>
                            </li>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        @endguest
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!--header top-->



<!--Main Header-->
<nav class="navbar navbar-expand-lg navbar-dark ">
    <div class="container">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarLinks"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarLinks">
            <ul class="navbar-nav">
                <li class="nav-item " id="beranda">
                    <a class="nav-link" href="{{ url('/') }}">Beranda</a>
                </li>
                <li class="nav-item " id="konter">
                    <a class="nav-link" href="{{ url('/konter_list') }}">Konter</a>
                </li>
                <li class="nav-item " id="produk">
                    <a class="nav-link" href="{{ url('/produk_list') }}">Produk</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<!--End Main Header -->

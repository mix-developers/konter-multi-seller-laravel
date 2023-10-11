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
                                    @php
                                        $notifikasi = App\Models\Notifikasi::where('id_user', Auth::user()->id)->count();
                                        $service = App\Models\Service::getNotif()->count();

                                        if ($notifikasi > 0 && $service > 0) {
                                            $jumlah_notif = $notifikasi + $service;
                                        } elseif ($notifikasi > 0 && $service == 0) {
                                            $jumlah_notif = $notifikasi;
                                        } elseif ($service > 0 && $notifikasi == 0) {
                                            $jumlah_notif = $service;
                                        } else {
                                            $jumlah_notif = null;
                                        }
                                    @endphp
                                    <a href="#" class="" data-toggle="modal" data-target="#notif">
                                        <i class="fa fa-bell text-info" style="border:0px;">
                                            <span
                                                class="badge badge-danger position-absolute top-0 end-0  rounded-circle">{{ $jumlah_notif }}</span>
                                        </i>
                                    </a>
                                </li>
                                <li>
                                    @php
                                        $id_room = App\Models\Chat::where('user_id', Auth::user()->id)->get();
                                        $idRoom = $id_room->pluck('chat_room_id')->toArray();
                                        $chatNotRead = App\Models\Chat::where('chat_room_id', $idRoom)
                                            ->where('is_read', 0)
                                            ->where('user_id', '!=', Auth::user()->id)
                                            ->count();
                                    @endphp
                                    <a href="#" class=" mr-3" data-toggle="modal" data-target="#message">
                                        <i class="fa fa-comment text-info" style="border:0px;">
                                            <span
                                                class="badge badge-danger position-absolute top-0 end-0  rounded-circle">{{ $chatNotRead != 0 ? $chatNotRead : null }}</span>
                                        </i>
                                    </a>
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
                    <a class="nav-link" href="{{ url('/konter_list') }}">Counter</a>
                </li>
                <li class="nav-item " id="produk">
                    <a class="nav-link" href="{{ url('/produk_list') }}">Produk</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<!--End Main Header -->

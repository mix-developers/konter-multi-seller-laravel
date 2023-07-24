<ul class="pc-navbar">
    <li class="pc-item pc-caption">
        <label>E-KONTER</label>
    </li>
    @if (Auth::user()->role == 'super_admin' || Auth::user()->role == 'admin')
        <li class="pc-item"><a href="{{ url('/admin') }}" class="pc-link "><span class="pc-micon"><i
                        data-feather="layout"></i></span><span class="pc-mtext">Dashboard</span></a></li>

        <li class="pc-item pc-caption">
            <label>Master Data</label>
        </li>
        <li class="pc-item"><a href="{{ url('/admin/kategori') }}" class="pc-link "><span class="pc-micon"><i
                        data-feather="life-buoy"></i></span><span class="pc-mtext">Kategori Produk</span></a>
        </li>
        <li class="pc-item"><a href="{{ url('/admin/status') }}" class="pc-link "><span class="pc-micon"><i
                        data-feather="life-buoy"></i></span><span class="pc-mtext">Status Service</span></a>
        </li>
        <li class="pc-item pc-hasmenu">
            <a href="javascript:void(0)" class="pc-link"><span class="pc-micon"><i data-feather="home"></i></span><span
                    class="pc-mtext">Modul Konter</span><span class="pc-arrow"><i
                        data-feather="chevron-right"></i></span></a>
            <ul class="pc-submenu">
                <li class="pc-item"><a href="{{ url('/admin/konter') }}" class="pc-link ">Konter</a></li>
                <li class="pc-item"><a href="{{ url('/admin/layanan') }}" class="pc-link ">Layanan</a></li>
                <li class="pc-item"><a href="{{ url('/admin/produk') }}" class="pc-link ">Produk</a></li>
            </ul>
        </li>
        <li class="pc-item pc-hasmenu">
            <a href="javascript:void(0)" class="pc-link"><span class="pc-micon"><i data-feather="users"></i></span><span
                    class="pc-mtext">Modul User</span><span class="pc-arrow"><i
                        data-feather="chevron-right"></i></span></a>
            <ul class="pc-submenu">
                <li class="pc-item"><a href="{{ url('admin/akun/admin') }}" class="pc-link ">Akun Admin</a></li>
                <li class="pc-item"><a href="{{ url('admin/akun/konter') }}" class="pc-link ">Akun Konter</a></li>
            </ul>
        </li>
        <li class="pc-item pc-caption">
            <label>Laporan</label>
        </li>
        <li class="pc-item"><a href="{{ url('/admin/laporan') }}" class="pc-link "><span class="pc-micon"><i
                        data-feather="inbox"></i></span><span class="pc-mtext">laporan
                </span></a></li>
    @else
        <li class="pc-item"><a href="{{ url('/konter') }}" class="pc-link "><span class="pc-micon"><i
                        data-feather="layout"></i></span><span class="pc-mtext">Dashboard</span></a></li>

        <li class="pc-item pc-caption">
            <label>Master Data</label>
        </li>
        <li class="pc-item"><a href="{{ url('/konter/layanan') }}" class="pc-link "><span class="pc-micon"><i
                        data-feather="life-buoy"></i></span><span class="pc-mtext">Layanan Konter</span></a>
        </li>
        <li class="pc-item"><a href="{{ url('/konter/produk') }}" class="pc-link "><span class="pc-micon"><i
                        data-feather="life-buoy"></i></span><span class="pc-mtext">Produk Konter</span></a>
        </li>
        <li class="pc-item"><a href="{{ url('/konter/service') }}" class="pc-link "><span class="pc-micon"><i
                        data-feather="life-buoy"></i></span><span class="pc-mtext">Service</span></a>
        </li>
        <li class="pc-item"><a href="{{ url('/konter/ulasan') }}" class="pc-link "><span class="pc-micon"><i
                        data-feather="star"></i></span><span class="pc-mtext">Rating dan Ulasan</span></a>
        </li>
        <li class="pc-item"><a href="{{ url('/konter/chat') }}" class="pc-link "><span class="pc-micon"><i
                        data-feather="message-circle"></i></span><span class="pc-mtext">Chat Pelanggan</span></a>
        </li>
        <li class="pc-item pc-caption">
            <label>Laporan</label>
        </li>
        <li class="pc-item"><a href="{{ url('/konter/laporan') }}" class="pc-link "><span class="pc-micon"><i
                        data-feather="inbox"></i></span><span class="pc-mtext">laporan
                </span></a></li>
    @endif

</ul>

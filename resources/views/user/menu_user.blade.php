<div class="list-group">
    <a href="#" class="list-group-item list-group-item-action active text-center">
        <strong> Akun : {{ Auth::user()->name }}</strong>
    </a>
    <a href="{{ url('/member') }}" class="list-group-item list-group-item-action">Informasi Akun</a>
    <a href="{{ url('/member/status_service') }}" class="list-group-item list-group-item-action">Cek Status Service</a>
    <a href="{{ url('/member/ulasan') }}" class="list-group-item list-group-item-action">Ulasan</a>
    <a href="{{ url('/member/ubah_password') }}" class="list-group-item list-group-item-action">Ubah Password</a>
</div>

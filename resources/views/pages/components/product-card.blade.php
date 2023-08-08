<div class="col-lg-4 col-md-6">
    <div class="team-member">
        <img loading="lazy" src="{{ $thumbnail ? url(Storage::url($thumbnail)) : asset('/img/toko.jpg') }}" alt="leptop"
            class="img-fluid p-3">
        <div class="contents">
            <b class="p-2 text-white {{ $total_stok > 0 ? 'bg-info' : 'bg-danger' }}">
                {{ $total_stok > 0 ? 'Tersedia' : 'Habis' }}</b>
            <div class="text-center mt-2">
                <h4 class="text-danger">Rp {{ number_format($price) }}</h4>
                <h5 style="color: black;" class="pb-3">{{ $name }}</h5>
                <span>Konter : {{ $namaKonter }}</span><br>
                <button type="button" class="btn btn-main" data-toggle="modal" data-target="{{ $modalTarget }}">
                    Detail Produk
                </button>
            </div>
        </div>
    </div>
</div>

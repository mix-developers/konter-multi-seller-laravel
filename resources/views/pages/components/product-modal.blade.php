<div class="modal fade" id="produk-{{ $product->slug }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ $product->name }}<span class="badge badge-warning">Rp
                        {{ number_format($product->price) }}</span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="p-2 border border-secondary shadow-sm rounded"><strong class="text-info">Nama Produk
                        :</strong>
                    {{ $product->name }}</p>
                <p class="p-2 border border-secondary shadow-sm rounded"><strong class="text-info">Stok Produk
                        :</strong>
                    {{ $total_stok }}</p>
                <p class="p-2 border border-secondary shadow-sm rounded"><strong class="text-info">Counter :</strong>
                    {{ $product->konter->name }}</p>
                <div class="p-2 border border-secondary shadow-sm rounded mb-3"><strong class="text-info">Deskripsi
                        :</strong>
                    {!! $product->description !!}</div>
                <a href="{{ url('/konter_detail', $product->konter->slug) }}" class="btn btn-info">Kunjungi Counter</a>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

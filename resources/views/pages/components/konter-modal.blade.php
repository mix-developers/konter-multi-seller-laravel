<!-- Modal -->
<div class="modal fade" id="toko-{{ $item->slug }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ $item->name }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body ">
                <p class="p-2 border border-secondary shadow-sm rounded"><strong class="text-info">Nama Counter :
                    </strong>
                    {{ $item->name }}
                </p>
                <p class="p-2 border border-secondary shadow-sm rounded "><strong class="text-info">Nama Pemilik
                        :
                    </strong>
                    {{ $item->pemilik->name }}
                </p>
                <div class="p-2 border border-secondary shadow-sm rounded mb-2"><strong class="text-info">Deskripsi
                        :
                    </strong>
                    {!! $item->description !!}</div>
                <a href="{{ url('/konter_detail', $item->slug) }}" class="btn btn-info">Kunjungi Counter</a>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

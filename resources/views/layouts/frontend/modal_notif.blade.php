<!-- Modal -->
<div class="modal fade" id="notif" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="exampleModalLabel">Notifikasi Service</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body ">
                @foreach (App\Models\Service::getNotif() as $notif)
                    <div class="px-2 border border-secondary shadow-sm rounded mb-2">
                        <small class="text-muted">Service oleh : {{ $notif->konter->name }}</small><br>
                        <span><strong class="text-info">{{ $notif->code }} : </strong>
                            {{ App\Models\ServiceStatus::getNotifStatus($notif->id)->status->status }}</span>
                    </div>
                @endforeach
                @if (App\Models\Service::getNotif() == null)
                    <div class="text-center text-muted">
                        Belum ada service
                    </div>
                @endif
            </div>
            <div class="modal-footer">
                <a href="{{ url('/member/status_service') }}" class="btn btn-info">Lihat
                    Semua Service</a>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

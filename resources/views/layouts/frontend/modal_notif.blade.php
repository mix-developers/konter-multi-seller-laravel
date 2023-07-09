<!-- Modal -->
<div class="modal fade" id="notif" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="exampleModalLabel">Service Anda</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body ">
                <p class="p-2 border border-secondary shadow-sm rounded"><strong class="text-info">Konter Irma :
                    </strong>
                    Dalam Pengerjaan
                </p>
            </div>
            <div class="modal-footer">
                <a href="{{ url('/member/status_service') }}" class="btn btn-info">Lihat
                    Semua Service</a>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

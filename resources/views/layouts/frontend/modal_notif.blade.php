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
                @if (App\Models\Notifikasi::where('id_user', Auth::user()->id)->where('is_read', 0) != null)
                    @foreach (App\Models\Notifikasi::where('id_user', Auth::user()->id)->where('is_read', 0)->get() as $item)
                        <div class="border-{{ $item->type == 'success' ? 'info' : 'danger' }} border my-2"
                            style="border-radius:10px;">
                            <div class="p-2">
                                <form action="{{ route('read_notifikasi', $item->id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" style="font-size: 14px; text-align:left;"
                                        class="btn btn-light-{{ $item->type == 'success' ? 'info' : 'danger' }} text-{{ $item->type == 'success' ? 'info' : 'danger' }}">
                                        <span>
                                            {{ Str::limit($item->content, 100) }}
                                        </span>
                                    </button>
                                </form>
                                <small>{{ $item->created_at->diffForHumans() }}</small>
                            </div>
                        </div>
                    @endforeach
                @endif
                @if (App\Models\Service::getNotif()->count() > 0)
                    <hr>
                    <strong class="text-black">Service anda</strong>
                    @foreach (App\Models\Service::getNotif() as $notif)
                        <div class="px-2 border border-secondary shadow-sm rounded mb-2">
                            <small class="text-muted">Service oleh : {{ $notif->konter->name }}</small><br>
                            <span><strong class="text-info">{{ $notif->code }} : </strong>
                                {{ App\Models\ServiceStatus::getNotifStatus($notif->id)->status->status }}</span>
                        </div>
                    @endforeach
                    <a href="{{ url('/member/status_service') }}" class="btn btn-info">Lihat
                        Semua Service</a>
                @endif
            </div>
            {{-- <div class="modal-footer">

                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div> --}}
        </div>
    </div>
</div>

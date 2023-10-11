<!-- Modal -->
<div class="modal fade" id="message" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center text-info" id="exampleModalLabel">Notifikasi Chat Oleh Konter</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body ">
                @php
                    $id_room = App\Models\Chat::where('user_id', Auth::user()->id)->get();
                    $idRoom = $id_room->pluck('chat_room_id')->toArray();
                    $chatNotRead = App\Models\Chat::where('chat_room_id', $idRoom)
                        ->where('is_read', 0)
                        ->where('user_id', '!=', Auth::user()->id)
                        ->get();
                @endphp
                {{-- {{ dd($chatNotRead) }} --}}
                @forelse ($chatNotRead as $item)
                    <div class="border-info border my-2" style="border-radius:10px;">
                        <div class="p-2">
                            <a href="{{ url('/chat/room', $item->chat_room_id) }}">
                                <strong>
                                    Konter {{ $item->user->name }}
                                </strong></a><br>
                            <small class="text-primary">{{ Str::limit($item->message, 50) }}</small>
                            <small class="float-right">{{ $item->created_at->diffForHumans() }}</small>
                        </div>
                    </div>
                @empty
                    <center>
                        <strong class="text-muted">Belum ada notifikasi chat masuk</strong>
                    </center>
                @endforelse
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

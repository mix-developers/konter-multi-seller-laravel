<div class="border border-secondary p-3" style="border-radius: 20px;">
    <h5 class="text-info">Chat ke konter</h5>
    <hr>
    @guest
        <div class="text-center">
            <a href="{{ '/login' }}" class="btn btn-info">Login</a><br>
            <small class="text-muted">Silahkan login terlebih dahulu untuk melakukan chat ke konter</small>
        </div>
    @else
        <div class="overflow-auto" style="min-height:200px; max-height: 250px; width:100%">
            @foreach ($chat as $item)
                @if ($item->from_user == Auth::user()->id)
                    <br>
                    <div class="float-left py-1 px-2 bg-success text-white" style="border-radius:10px; ">
                        <strong>{{ $item->content }} </strong>
                    </div>
                    <br>
                    <br>
                @else
                    <br>
                    <div class="float-right py-1 px-2 bg-info text-white mt-2" style="border-radius:10px;">
                        <strong>{{ $item->content }} </strong>
                    </div>
                    <br>
                    <br>
                @endif
            @endforeach
        </div>
        <hr>
        <div class="mt-2">
            <form action="{{ url('/member/sendChat') }}" method="POST">
                <div class="form-group d-flex px-3">
                    @csrf
                    <div class="p-2 flex-grow-1">
                        <textarea class="form-control" name="content" rows="3" placeholder="Pesan..." maxlength="200"
                            style="border-radius: 20px;"></textarea>
                        <input type="hidden" name="id_konter" value="{{ $konter->id }}">
                        <input type="hidden" name="to_user" value="{{ $konter->id_pemilik }}">
                        <input type="hidden" name="from_user" value="{{ Auth::user()->id }}">
                    </div>
                    <div class="p-2">
                        <button type="submit" class="btn-info btn" style="border-radius: 20px;"><i
                                class="fa fa-paper-plane"></i></button>
                    </div>
                </div>
            </form>
        </div>
    @endguest
</div>

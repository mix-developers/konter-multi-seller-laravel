<div class="border border-secondary p-3" style="border-radius: 20px;">
    <h5 class="text-info">Rating dan Ulasan Pengunjung</h5>
    <hr>
    <table style="height: 100px;">
        <tbody>
            @if ($rating->count() != 0)
                @foreach ($rating as $item)
                    <tr>
                        <td width="100" class="text-center">
                            <img src="{{ $item->user->avatar == '' || $item->user->avatar == null ? asset('img/user.png') : url(Storage::url($item->user->avatar)) }}"
                                alt="{{ $item->user->name }}" class="img-fluid img-avatar" width="50"><br>
                            <span>{{ $item->user->name }}</span>
                        </td>
                        <td>
                            @if ($item->thumbnail != '')
                                <div class="mb-4">
                                    <img src="{{ url(Storage::url($item->thumbnail)) }}" height="100px"
                                        alt="gambar reviewer">
                                </div>
                            @endif
                            <div class="ratings">
                                @for ($i = 1; $i <= $item->star_rating; $i++)
                                    <i class="fa fa-star text-warning"></i>
                                @endfor
                            </div>
                            " {{ $item->comments }} "
                            <br>
                            <small class="text-info">{{ \Carbon\Carbon::parse($item->date)->diffForhumans() }}</small>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td class="text-center">Belum ada rating dan ulasan...</td>
                </tr>
            @endif
        </tbody>
    </table>
</div>

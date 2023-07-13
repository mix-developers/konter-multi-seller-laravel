<div class="table-responsive">
    <table class="table table-bordered table-striped mb-0 lara-dataTable">
        <thead>
            <tr>
                <th>#</th>
                <th>Thumbnail</th>
                <th>Kode service</th>
                <th>Layanan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($service as $item)
                <tr>
                    <td width="10">{{ $loop->iteration }}</td>
                    <td width="150">
                        <div class="thumbnail">
                            <div class="thumb">
                                <a href="{{ $item->thumbnail == '' ? asset('img/user.png') : url(Storage::url($item->thumbnail)) }}"
                                    data-lightbox="1" data-title="{{ $item->code }}" data-toggle="lightbox">
                                    <img src="{{ $item->thumbnail == '' ? asset('img/user.png') : url(Storage::url($item->thumbnail)) }}"
                                        alt="{{ $item->code }}" class="img-fluid img-thumbnail" width="50">
                                </a>
                            </div>
                        </div>
                    </td>
                    <td>
                        {{ $item->code }}
                    </td>
                    <td>
                        {{ $item->layanan->layanan }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

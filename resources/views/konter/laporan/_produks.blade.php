<div class="table-responsive">
    <table class="table table-bordered table-striped mb-0 lara-dataTable">
        <thead>
            <tr>
                <th>#</th>
                <th>Thumbnail</th>
                <th>Nama Produk</th>
                <th>Konter</th>
                <th>Stok</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($produk as $item)
                <tr>
                    <td width="10">{{ $loop->iteration }}</td>
                    <td width="150">
                        <div class="thumbnail">
                            <div class="thumb">
                                <a href="{{ $item->thumbnail == '' ? asset('img/no-image.jpg') : url(Storage::url($item->thumbnail)) }}"
                                    data-lightbox="1" data-title="{{ $item->judul }}" data-toggle="lightbox">
                                    <img src="{{ $item->thumbnail == '' ? asset('img/no-image.jpg') : url(Storage::url($item->thumbnail)) }}"
                                        alt="{{ $item->name }}" class="img-fluid img-thumbnail" width="50">
                                </a>
                            </div>
                        </div>
                    </td>
                    <td>
                        {{ $item->name }}<br>
                        <p class="text-muted">{{ $item->price }}</p>
                    </td>
                    <td>
                        {{ $item->konter->name }}
                    </td>
                    <td>
                        {{ App\Models\ProdukStok::getTotalStokProduk($item->id) }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

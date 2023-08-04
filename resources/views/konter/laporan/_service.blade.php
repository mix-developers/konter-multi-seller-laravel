<div class="table-responsive">
    <table class="table table-bordered table-striped mb-0 lara-dataTable">
        <thead>
            <tr>
                <th rowspan="2" class="align-middle">#</th>
                <th rowspan="2" class="align-middle">Thumbnail</th>
                <th rowspan="2" class="align-middle">Tanggal</th>
                <th rowspan="2" class="align-middle">Kode service</th>
                <th rowspan="2" class="align-middle">Layanan</th>
                <th rowspan="2" class="align-middle">Total Harga</th>
                <th colspan="2" class="text-center">Harga</th>
            </tr>
            <tr>
                <th scope="col">Item</th>
                <th scope="col">Harga</th>
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
                    <td>{{ $item->date }}</td>
                    <td>
                        <strong>{{ $item->code }}</strong><br>
                        <span class="text-muted">{{ $item->pelanggan->name }}</span>
                    </td>
                    <td>
                        {{ $item->layanan->layanan }}
                    </td>
                    <td class="text-danger">Rp {{ number_format(App\Models\ServicePrice::getTotalService($item->id)) }}
                    </td>
                    <td>
                        <ol>
                            @foreach (App\Models\ServicePrice::getPriceService($item->id) as $price)
                                <li>{{ $price->name }}</li>
                            @endforeach
                        </ol>
                    </td>
                    <td>
                        <ol>
                            @foreach (App\Models\ServicePrice::getPriceService($item->id) as $price)
                                <li>Rp {{ number_format($price->price) }}</li>
                            @endforeach
                        </ol>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

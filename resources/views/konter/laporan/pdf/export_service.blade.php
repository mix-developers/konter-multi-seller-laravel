<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Laporan | SimVice</title>
    <link rel="stylesheet" href="{{ public_path('backand_theme') }}/assets/pdf/style.css" media="all" />
</head>

<body>
    {{-- {{dd(storage_path())}} --}}
    <header class="clearfix">
        <div id="logo">
            {{-- <img src="{{ public_path('img/logo_merauke.png') }}"> --}}
        </div>
        <div id="company">
            <h1>Aplikasi SimVice</h1>
        </div>
        </div>
    </header>
    <main>
        <div id="details" class="clearfix">
            <div id="client">
                <h1>Data Service </h1>
                <div class="date">Dari tanggal {{ \Carbon\Carbon::parse($from_date)->format('d-m-Y') }}</div>
                <div class="date">Sampai tanggal {{ \Carbon\Carbon::parse($to_date)->format('d-m-Y') }}</div>
            </div>
        </div>

        <table border="0" cellspacing="0" cellpadding="0">
            <thead>
                <tr>
                    <th rowspan="2" class="no">#</th>
                    <th rowspan="2" class="no">Tanggal</th>
                    <th rowspan="2" class="no">Kode service</th>
                    <th rowspan="2" class="no">Layanan</th>
                    <th rowspan="2" class="no">Total Harga</th>
                    <th colspan="2" class="no">Harga</th>
                </tr>
                <tr>
                    <th scope="col" class="no">Item</th>
                    <th scope="col" class="no">Harga</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $item)
                    <tr>
                        <td width="10">{{ $loop->iteration }}</td>
                        <td>{{ $item->date }}</td>
                        <td>
                            <strong>{{ $item->code }}</strong><br>
                            <span class="text-muted">{{ $item->pelanggan->name }}</span>
                        </td>
                        <td>
                            {{ $item->layanan->layanan }}
                        </td>
                        <td style="color:red;">Rp
                            {{ number_format(App\Models\ServicePrice::getTotalService($item->id)) }}
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

    </main>
</body>

</html>

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
                    <th class="no">#</th>
                    <th class="no">Kode service</th>
                    <th class="no">Tanggal Service</th>
                    <th class="no">Layanan Service</th>
                    <th class="no">Nama Customer</th>
                    <th class="no">HP Customer</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $item)
                    <tr>
                        <td width="10">{{ $loop->iteration }}</td>
                        <td class="unit">
                            {{ $item->code }}
                        </td>
                        <td class="unit">
                            {{ $item->date }}
                        </td>
                        <td class="unit">
                            {{ $item->layanan->layanan }}
                        </td>
                        <td class="unit">
                            {{ $item->pelanggan->name }}
                        </td>
                        <td class="unit">
                            {{ $item->pelanggan->phone }}
                        </td>

                    </tr>
                @endforeach
            </tbody>

        </table>

    </main>
</body>

</html>

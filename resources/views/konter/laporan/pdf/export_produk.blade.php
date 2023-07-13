<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Laporan Produk | SimVice</title>
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
                <h1>Data Produk </h1>
                <div class="date">Tanggal Export : {{ date('d-m-Y') }}</div>

            </div>
        </div>

        <table border="0" cellspacing="0" cellpadding="0">
            <thead>
                <tr>
                    <th class="no">#</th>
                    <th class="no">Foto Produk</th>
                    <th class="no">Nama Produk</th>
                    <th class="no">Harga</th>
                    <th class="no">Stok </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $item)
                    <tr>
                        <td width="10">{{ $loop->iteration }}</td>
                        <td class="unit">
                            <img src="{{ $item->thumbnail == '' ? public_path('img/no-image.jpg') : storage_path($item->thumbnail) }}"
                                alt="{{ $item->name }}" class="img-fluid img-avatar" width="100">
                        </td>
                        <td class="unit">
                            {{ $item->name }}
                        </td>
                        <td class="unit">
                            Rp {{ number_format($item->price) }}
                        </td>
                        <td class="unit">
                            {{ $item->stok }}
                        </td>
                    </tr>
                @endforeach
            </tbody>

        </table>

    </main>
</body>

</html>

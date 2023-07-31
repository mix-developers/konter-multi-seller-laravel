<div class="card">
    <div class="card-header bg-info text-white">
        Informasi Service
    </div>
    <div class="card-body">
        <table class="table table-bordered">
            <tr>
                <td>Foto Service</td>
                <td>
                    <img src="{{ $service->thumbnail == '' ? asset('img/user.png') : url(Storage::url($service->thumbnail)) }}"
                        alt="{{ $service->name }}" class="img-fluid img-avatar" width="100">
                </td>
            </tr>
            <tr>
                <td>Nama Pelanggan</td>
                <td>{{ $service->pelanggan->name }}</td>
            </tr>
            <tr>
                <td>Layanan</td>
                <td>{{ $service->layanan->layanan }}</td>
            </tr>
            <tr>
                <td>Tanggal Service</td>
                <td>{{ $service->date }}</td>
            </tr>
        </table>
    </div>
</div>

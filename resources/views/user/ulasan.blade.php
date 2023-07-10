@extends('layouts.frontend.app')
@section('content')
    <!--team section-->
    <section class=" " style="margin-top:50px; margin-bottom:50px;">
        <div class="container ">
            <div class="section-title text-center">
                <h3>{{ $title }}</h3>

            </div>

        </div>
    </section>
    <!--End team section-->
    <section style="margin-top:50px; margin-bottom:100px;">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-4">
                    @include('user.menu_user')
                </div>
                <div class="col-lg-9 col-md-8">
                    <div class="card shadow shadow-sm rounded">
                        <div class="card-header">
                            <strong>Ulasan Anda</strong>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Kode Service</th>
                                        <th>Tanggal Klaim</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($service as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->code }}</td>
                                            @php $finish = App\Models\ServiceFinished::where('id_service', $item->id); @endphp
                                            @if ($finish->count() != 0)
                                                <td>{{ $finish->date }}</td>
                                                <td>
                                                    @if ($finish->count() != 0)
                                                        klaim
                                                    @else
                                                        <i class="fa fa-check text-success"></i>
                                                    @endif
                                                </td>
                                            @else
                                                <td colspan="2" class="text-center text-danger">Belum Selesai Pengerjaan
                                                </td>
                                            @endif
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('script')
    <script type="text/javascript">
        $("#produk").addClass("active");
    </script>
@endsection

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
                            <strong>Status Service</strong>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <th>#</th>
                                    <th>Kode Service</th>
                                    <th>Tanggal Service</th>
                                    <th>Status Service</th>
                                    <th>Cek</th>
                                    <th>Selesai</th>
                                </thead>
                                <tbody>
                                    @foreach ($service as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                <strong class="text-danger">Rp
                                                    {{ number_format(App\Models\ServicePrice::getTotalService($item->id)) }}</strong>
                                                <br><small>{{ $item->code }}</small>
                                            </td>
                                            <td>{{ $item->date }}</td>
                                            <td>{{ App\Models\ServiceStatus::getNotifStatus($item->id)->status->status }}
                                            </td>
                                            <td><a href="{{ url('/member/status', $item->code) }}"
                                                    class="btn btn-info btn-sm">Cek</a></td>
                                            </td>
                                            <td class="text-center">
                                                @if (App\Models\ServiceFinished::where('id_service', $item->id)->count() == 0)
                                                    <form action="{{ url('/member/service/storeFinish') }}" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="id_service" value="{{ $item->id }}">
                                                        <button type="submit" class="btn btn-success btn-sm">Klaim</button>
                                                    </form>
                                                @else
                                                    <i class="fa fa-check text-success"></i>
                                                @endif
                                            </td>
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

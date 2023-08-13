@extends('layouts.backand.admin')

@section('content')
    <section class="pc-container">

        <div class="pcoded-content">
            <!-- [ breadcrumb ] start -->
            @include('layouts.backand.title')
            <!-- [ breadcrumb ] end -->
            <!-- [ Main Content ] start -->
            <div class="row">
                <!-- subscribe start -->
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>{{ $title }}</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped mb-0 lara-dataTable">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Code Service</th>
                                            <th>Foto</th>
                                            <th>Rating</th>
                                            <th>Ulasan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($ulasan as $item)
                                            <tr>
                                                <td width="10">{{ $loop->iteration }}</td>
                                                <td>
                                                    <a href="{{ url('konter/service/detail', $item->service->id) }}"
                                                        class="text-link">{{ $item->service->code }}</a>
                                                </td>
                                                <td width="150">
                                                    <div class="thumbnail">
                                                        <div class="thumb">
                                                            <a href="{{ $item->thumbnail == '' ? asset('img/user.png') : url(Storage::url($item->thumbnail)) }}"
                                                                data-lightbox="1" data-title="{{ $item->judul }}"
                                                                data-toggle="lightbox" target="__blank">
                                                                <img src="{{ $item->thumbnail == '' ? asset('img/user.png') : url(Storage::url($item->thumbnail)) }}"
                                                                    alt="{{ $item->name }}"
                                                                    class="img-fluid img-thumbnail" width="50">
                                                            </a>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    @for ($i = 1; $i <= $item->star_rating; $i++)
                                                        <i class="fas fa-star text-warning"></i>
                                                    @endfor
                                                </td>
                                                <td>
                                                    {{ $item->comments }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- subscribe end -->
            </div>
            <!-- [ Main Content ] end -->
        </div>
    </section>
@endsection

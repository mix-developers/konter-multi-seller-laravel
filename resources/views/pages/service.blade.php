@extends('layouts.frontend.app')

@section('content')
    <!-- Team section -->
    <section class="team-section section">
        <div class="container">
            <div class="section-title text-center">
                <h3>{{ $title }}</h3>
            </div>
            @if ($service != null)
                <div class="row">
                    <div class="col-lg-4">
                        @component('pages.components.service-card', ['service' => $service])
                        @endcomponent
                    </div>
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-header bg-info text-white">
                                Informasi Status Service
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Status</th>
                                            <th>Tanggal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($status as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>
                                                    {{ $item->status->status }}<br>
                                                    @if ($item->thumbnail)
                                                        <img src="{{ url(Storage::url($item->thumbnail)) }}"
                                                            alt="{{ $item->name }}" class="img-fluid img-avatar"
                                                            width="100">
                                                    @endif
                                                </td>
                                                <td>{{ $item->date }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="text-center">
                    <p class="text-danger"><i class="fa fa-exclamation-triangle"></i> Service tidak tersedia, mohon cek
                        kembali kode anda</p>
                </div>
            @endif
        </div>
    </section>
    <!-- End team section -->
@endsection

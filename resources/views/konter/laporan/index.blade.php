@push('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endpush
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
                            <ul class="nav nav-tabs mb-3" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link text-uppercase active" id="service-tab" data-toggle="tab"
                                        href="#service" role="tab" aria-controls="service"
                                        aria-selected="true">service</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-uppercase" id="produk-tab" data-toggle="tab" href="#produk"
                                        role="tab" aria-controls="produk" aria-selected="false">produk</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade active show" id="service" role="tabpanel"
                                    aria-labelledby="service-tab">

                                    @include('konter.laporan._range_service')
                                    @include('konter.laporan._service')
                                </div>
                                <div class="tab-pane fade" id="produk" role="tabpanel" aria-labelledby="produk-tab">
                                    @include('konter.laporan._range_produk')
                                    @include('konter.laporan._produks')
                                </div>
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
@push('js')
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        flatpickr("input[type=date]");
    </script>
@endpush

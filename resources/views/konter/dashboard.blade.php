@extends('layouts.backand.admin')

@section('content')

    @if ($konter != null)
        <div class="pc-container">
            <div class="pcoded-content">
                @include('layouts.backand.title')

                <div class="row">
                    @if (App\Models\ServicePrice::getIncomeMonthlyBeforeKonter() <= $income)
                        <div class="col-12">
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>Hi, {{ Auth::user()->name }}!</strong> Pendapatan service counter anda bulan ini
                                naik
                                sebesar
                                <strong>{{ App\Models\ServicePrice::getIncomeMonthlyPercentKonter() }}%</strong>.
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                        aria-hidden="true">×</span></button>
                            </div>
                        </div>
                    @else
                        <div class="col-12">
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>Hi, {{ Auth::user()->name }}!</strong> Pendapatan service counter anda bulan ini
                                turun
                                sebesar
                                <strong>{{ App\Models\ServicePrice::getIncomeMonthlyPercentKonter() }}%</strong>.
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                        aria-hidden="true">×</span></button>
                            </div>
                        </div>
                    @endif
                    @include('konter.dashboard_component._information_konter')
                    @include('konter.dashboard_component._income_service')
                </div>
            </div>
        </div>
    @else
        <div class="pc-container">
            <div class="pcoded-content">
                <div class="text-center mt-4">
                    <button type="button" class="btn btn-success btn-md mb-3 btn-round" data-toggle="modal"
                        data-target=".tambah"><i class="feather f-16 icon-plus"></i>
                        Buat Counter Anda</button>
                </div>
                @component('konter.dashboard_component._modal_create_konter')
                @endcomponent
            </div>
        </div>
    @endif
@endsection

@push('js')
    <script src="{{ asset('admin_theme/assets/plugins/amchart/core.js') }}"></script>
    <script src="{{ asset('admin_theme/assets/plugins/amchart/charts.js') }}"></script>
    <script src="{{ asset('admin_theme/assets/plugins/amchart/themes/animated.js') }}"></script>
@endpush

@extends('layouts.backand.admin')

@section('content')
    <div class="pc-container">
        <div class="pcoded-content">
            @include('layouts.backand.title')

            <div class="row">
                @if (App\Models\ServicePrice::getIncomeMonthlyBefore() <= $income)
                    <div class="col-12">
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Hi, {{ Auth::user()->name }}!</strong> Pendapatan service bulan ini naik sebesar
                            <strong>{{ App\Models\ServicePrice::getIncomeMonthlyPercent() }}%</strong>.
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                    aria-hidden="true">×</span></button>
                        </div>
                    </div>
                @else
                    <div class="col-12">
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Hi, {{ Auth::user()->name }}!</strong> Pendapatan service bulan ini turun sebesar
                            <strong>{{ App\Models\ServicePrice::getIncomeMonthlyPercent() }}%</strong>.
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                    aria-hidden="true">×</span></button>
                        </div>
                    </div>
                @endif
                @include('admin.dashboard_component._income_service')
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="{{ asset('admin_theme/assets/plugins/amchart/core.js') }}"></script>
    <script src="{{ asset('admin_theme/assets/plugins/amchart/charts.js') }}"></script>
    <script src="{{ asset('admin_theme/assets/plugins/amchart/themes/animated.js') }}"></script>
@endpush

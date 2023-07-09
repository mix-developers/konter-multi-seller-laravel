@extends('layouts.backand.admin')

@section('content')
    <div class="pc-container">
        <div class="pcoded-content">
            @include('layouts.backand.title')
            <div class="row">

                <div class="col-12">

                    <div class="card">
                        <div class="card-header">{{ __('Dashboard') }} Admin</div>
                        <div class="card-body">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif

                            {{ __('You are logged in!') }}

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="{{ asset('admin_theme/assets/plugins/amchart/core.js') }}"></script>
    <script src="{{ asset('admin_theme/assets/plugins/amchart/charts.js') }}"></script>
    <script src="{{ asset('admin_theme/assets/plugins/amchart/themes/animated.js') }}"></script>
@endpush

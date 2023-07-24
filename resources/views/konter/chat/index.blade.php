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
                        <div class="card-body">
                            <h5 class="mb-3">{{ $title }}</h5>
                            <div class="row">
                                <div class="col-md-3 col-sm-12">
                                    <ul class="nav flex-column nav-pills" id="v-pills-tab" role="tablist"
                                        aria-orientation="vertical">
                                        @foreach ($chat as $item)
                                            <li>
                                                <a class="nav-link text-left " id="v-pills-{{ $item->id }}-tab"
                                                    data-toggle="pill" href="#v-pills-{{ $item->id }}" role="tab"
                                                    aria-controls="v-pills-{{ $item->id }}" aria-selected="false">
                                                    <img src="{{ $item->user_from->avatar == '' ? asset('img/user.png') : url(Storage::url($item->user_from->avatar)) }}"
                                                        alt="user-image" class="img-fluid avtar avtar-l"
                                                        style="height:20px; width:auto;">
                                                    {{ $item->user_from->name }}
                                                </a>
                                            </li>
                                        @endforeach

                                    </ul>
                                </div>
                                <div class="col-md-9 col-sm-12">
                                    <div class="tab-content" id="v-pills-tabContent">
                                        @include('konter.chat.isi_chat')
                                    </div>
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

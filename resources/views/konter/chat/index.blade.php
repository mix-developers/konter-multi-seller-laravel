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
                                    @if (App\Models\Chat::getNotif(Auth::user()->id)->is_read == 0)
                                        <div class="my-3">
                                            <form action="{{ route('chat.readAll', Auth::user()->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" class="btn btn-primary btn-sm"><i
                                                        class="fa fa-check"></i> Tandai telah dibaca
                                                </button>
                                            </form>
                                        </div>
                                        <hr>
                                    @endif
                                    <ul class="nav flex-column nav-pills" id="v-pills-tab" role="tablist"
                                        aria-orientation="vertical">
                                        @foreach ($room_user as $item)
                                            <li>
                                                @php
                                                    $chat_user = App\Models\ChatRoomUser::where('chat_room_id', $item->chat_room_id)
                                                        ->where('user_id', '!=', Auth::user()->id)
                                                        ->first();
                                                @endphp
                                                <a class="nav-link text-left " id="v-pills-{{ $item->chat_room_id }}-tab"
                                                    data-toggle="pill" href="#v-pills-{{ $item->chat_room_id }}"
                                                    role="tab" aria-controls="v-pills-{{ $item->id }}"
                                                    aria-selected="false">
                                                    <img src="{{ $chat_user->user->avatar == '' ? asset('img/user.png') : url(Storage::url($chat_user->user->avatar)) }}"
                                                        alt="user-image" class="img-fluid avtar avtar-l"
                                                        style="height:20px; width:auto;">
                                                    {{ Str::limit($chat_user->user->name, 15) }}<br><small
                                                        style="margin-left: 20px;">{{ App\Models\Chat::where('chat_room_id', $item->chat_room_id)->latest()->first()->created_at->diffForhumans() }}</small>
                                                </a>
                                            </li>
                                        @endforeach

                                    </ul>
                                </div>
                                <div class="col-md-9 col-sm-12">
                                    <div class="tab-content" id="v-pills-tabContent">
                                        @include('konter.chat.chat')
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

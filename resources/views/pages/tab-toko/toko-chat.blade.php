@push('css')
    <meta name="csrf-token" content="{{ csrf_token() }}" />
@endpush
<div class="border border-secondary p-3" style="border-radius: 20px;">
    <h5 class="text-info">Chat ke konter</h5>
    <div class="alert alert-danger print-error-msg" style="display:none">
        <ul></ul>
    </div>
    <hr>
    @guest
        <div class="text-center">
            <a href="{{ '/login' }}" class="btn btn-info">Login</a><br>
            <small class="text-muted">Silahkan login terlebih dahulu untuk melakukan chat ke konter</small>
        </div>
    @else
        @if (Auth::user()->role == 'user')
            <div class="overflow-auto" style="min-height:200px; max-height: 250px; width:100%">
                @foreach ($chat as $item)
                    @if ($item->from_user == Auth::user()->id)
                        <br>
                        <div class="float-left py-1 px-2 bg-success text-white" style="border-radius:10px; ">
                            <strong>{{ $item->content }} </strong>
                        </div>
                        <br>
                        <br>
                    @else
                        <br>
                        <div class="float-right py-1 px-2 bg-info text-white mt-2" style="border-radius:10px;">
                            <strong>{{ $item->content }} </strong>
                        </div>
                        <br>
                        <br>
                    @endif
                @endforeach
            </div>
            <hr>
            <div class="mt-2">
                <form>
                    <div class="form-group d-flex px-3">
                        <div class="p-2 flex-grow-1">
                            <textarea class="form-control" name="content" rows="3" placeholder="Pesan..." maxlength="200"
                                style="border-radius: 20px;" id="content"></textarea>
                            <input type="hidden" name="id_konter" value="{{ $konter->id }}" id="id_konter">
                            <input type="hidden" name="to_user" value="{{ $konter->id_pemilik }}" id="to_user">
                            <input type="hidden" name="from_user" value="{{ Auth::user()->id }}" id="from_user">
                        </div>
                        <div class="p-2">
                            <button class="btn-info btn btn-submit" style="border-radius: 20px;"><i
                                    class="fa fa-paper-plane"></i></button>
                        </div>
                    </div>
                </form>
            </div>
        @else
            <div class="text-center">
                {{-- <a href="{{ '/login' }}" class="btn btn-info">Login</a><br> --}}
                <small class="text-muted">Hanya Pelanggan yang dapat melakukan chat ke konter</small>
            </div>
        @endif
    @endguest
</div>
@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/laravel-echo/1.11.0/echo.min.js"></script>
    <script>
        window.chatChannel = 'chat.{{ $konter->id_pemilik }}';
    </script>
    <script>
        import Echo from 'laravel-echo';

        window.Pusher = require('pusher-js');

        // Initialize Echo
        window.Echo = new Echo({
            broadcaster: 'pusher',
            key: '{{ config('broadcasting.connections.pusher.key') }}',
            cluster: '{{ config('broadcasting.connections.pusher.options.cluster') }}',
            encrypted: true,
            authEndpoint: '/broadcasting/auth', // Adjust this to your broadcasting route
            auth: {
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            }
        });

        // Listen for chat events
        if (typeof window.chatChannel !== 'undefined') {
            window.Echo.private(window.chatChannel)
                .listen('ChatEvent', function(event) {
                    var message = event.message;
                    var messageType = (event.from_user === {{ Auth::user()->id }}) ?
                        'bg-success text-white float-left' : 'bg-info text-white float-right';

                    var messageDiv = '<div class="' + messageType + ' py-1 px-2" style="border-radius:10px;">' +
                        '<strong>' + message + '</strong>' +
                        '</div><br><br>';

                    $('.overflow-auto').append(messageDiv);
                });
        }
    </script>
@endsection

@include('layouts.frontend.header')
@include('layouts.frontend.navbar')
@yield('content')
@include('layouts.frontend.footer')
@guest
@else
    @if (Auth::user()->role == 'user')
        @include('layouts.frontend.modal_notif')
        @include('layouts.frontend.modal_message')
    @endif
@endguest

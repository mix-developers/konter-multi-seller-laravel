<!DOCTYPE html>
<html lang="en">

<head>
    {{-- <meta name="google-site-verification" content="6jNOWiRzFMuuJFQ6w3XHfUgQddz7uIVo3w4A9TnsI7s" /> --}}
    <title>{{ $title ?? env('APP_NAME') }} | SimVice</title>
    <!-- HTML5 Shim and Respond.js IE11 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 11]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- Meta -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="" />
    <meta name="keywords" content="">
    <meta name="author" content="MIX Developer - " />

    <!-- Favicon icon -->
    <link rel="icon" href="{{ asset('/img/icon.png') }}" type="image/x-icon">

    <link rel="stylesheet" href="{{ asset('backand_theme') }}/assets/css/plugins/animate.min.css">
    <link rel="stylesheet" href="{{ asset('backand_theme') }}/assets/css/plugins/dataTables.bootstrap4.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    @stack('css')

    <!-- font css -->
    <link rel="stylesheet" href="{{ asset('backand_theme') }}/assets/fonts/font-awsome-pro/css/pro.min.css">
    <link rel="stylesheet" href="{{ asset('backand_theme') }}/assets/fonts/feather.css">
    <link rel="stylesheet" href="{{ asset('backand_theme') }}/assets/fonts/fontawesome.css">

    <!-- vendor css -->
    <link rel="stylesheet" href="{{ asset('backand_theme') }}/assets/css/style.css">
    <link rel="stylesheet" href="{{ asset('backand_theme') }}/assets/css/customizer.css">

    {{-- select2  --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />


    <style>
        .centerMarker {
            position: absolute;
            /*url of the marker*/
            background: url(http://maps.gstatic.com/mapfiles/markers2/marker.png) no-repeat;
            /*center the marker*/
            top: 50%;
            left: 50%;
            z-index: 1;
            /*fix offset when needed*/
            margin-left: -10px;
            margin-top: -34px;
            /*size of the image*/
            height: 34px;
            width: 20px;
            cursor: pointer;
            color: black;
        }
    </style>

</head>

<body class="">
    <!-- [ Pre-loader ] start -->
    <div class="loader-bg">
        <div class="loader-track">
            <div class="loader-fill"></div>
        </div>
    </div>
    <!-- [ Pre-loader ] End -->
    <!-- [ Mobile header ] start -->
    <div class="pc-mob-header pc-header">
        <div class="pcm-logo">
            <img src="{{ asset('/') }}img/favicon.png" alt="" class="logo logo-sm" style="max-width: 30px;">
        </div>
        <div class="pcm-toolbar">
            <a href="#!" class="pc-head-link" id="mobile-collapse">
                <div class="hamburger hamburger--arrowturn">
                    <div class="hamburger-box">
                        <div class="hamburger-inner"></div>
                    </div>
                </div>
                <!-- <i data-feather="menu"></i> -->
            </a>
            <a href="#!" class="pc-head-link" id="header-collapse">
                <i data-feather="more-vertical"></i>
            </a>
        </div>
    </div>
    <!-- [ Mobile header ] End -->

    <!-- [ navigation menu ] start -->
    <nav class="pc-sidebar ">
        <div class="navbar-wrapper">
            <div class="m-header">
                <a href="{{ url('/dashboard') }}" class="b-brand">
                    <!-- ========   change your logo hear   ============ -->
                    {{-- <img src="{{ asset('/') }}img/favicon-3.png" alt="" class="logo logo-lg"
                        style="max-width:150px;">
                    <img src="{{ asset('backand_theme') }}/assets/images/logo-sm.svg" alt=""
                        class="logo logo-sm"> --}}
                    <h2 class="text-white logo logo-lg">SimVice</h2>
                    <h2 class="text-white logo logo-sm">SimVice</h2>
                </a>
            </div>
            <div class="navbar-content">
                @include('layouts.backand.sidebar_menu.menu_admin')
            </div>
        </div>
    </nav>
    <!-- [ navigation menu ] end -->
    <!-- [ Header ] start -->
    <header class="pc-header ">
        <div class="header-wrapper">
            <div class="mr-auto pc-mob-drp">
                <ul class="list-unstyled">
                    <li class="dropdown pc-h-item">
                        <a class="pc-head-link active dropdown-toggle arrow-none mr-0" href="{{ url('/') }}">
                            Homepage
                        </a>

                    </li>

                </ul>
            </div>
            <div class="mr-auto pc-mob-drp">
                <ul class="list-unstyled">

                </ul>
            </div>
            <div class="ml-auto">
                <ul class="list-unstyled">
                    <li class="pc-h-item">
                        <a class="pc-head-link mr-0" href="#" data-toggle="modal"
                            data-target="#notification-modal">
                            <i data-feather="message-circle" class="text-primary"></i>
                            <span class="badge badge-danger pc-h-badge dots"><span class="sr-only"></span></span>
                        </a>
                    </li>
                    <li class="dropdown pc-h-item">
                        <a class="pc-head-link dropdown-toggle arrow-none mr-0" data-toggle="dropdown" href="#"
                            role="button" aria-haspopup="false" aria-expanded="false">
                            <img src="{{ Auth::user()->avatar == '' ? asset('img/user.png') : url(Storage::url(Auth::user()->avatar)) }}"
                                alt="user-image" class="user-avtar">
                            <span>
                                <span class="user-name">{{ Auth::user()->name }}</span>
                                <span class="user-desc">{{ Auth::user()->role }}</span>
                            </span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right pc-h-dropdown">
                            <div class=" dropdown-header">
                                <h6 class="text-overflow m-0">Welcome !</h6>
                            </div>
                            @if (Auth::user()->role == 'admin' || Auth::user()->role == 'super_admin')
                                <a href="{{ url('admin/user/akun') }}" class="dropdown-item">
                                    <i data-feather="user"></i>
                                    <span>Akun</span>
                                </a>
                            @elseif(Auth::user()->role == 'konter')
                                <a href="{{ url('konter/update_konter') }}" class="dropdown-item">
                                    <i data-feather="home"></i>
                                    <span>Konter</span>
                                </a>
                                <a href="{{ url('konter/user/akun') }}" class="dropdown-item">
                                    <i data-feather="user"></i>
                                    <span>Akun</span>
                                </a>
                            @endif
                            <a href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                          document.getElementById('logout-form').submit();"
                                class="dropdown-item">
                                <i data-feather="power"></i>
                                <span>Logout</span>
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                </ul>
            </div>

        </div>
    </header>

    <!-- Modal -->

    {{-- <div class="modal notification-modal fade " id="notification-modal" tabindex="-1" role="dialog"
        aria-modal="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <ul class="nav nav-pill tabs-light mb-3" id="pc-noti-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="pc-noti-home-tab" data-toggle="pill" href="#pc-noti-home"
                                role="tab" aria-controls="pc-noti-home" aria-selected="true">Chat Pelanggan</a>

                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/konter/chat') }}" class="nav-link">Lihat Chat</a>
                        </li>
                    </ul>
                    <div class="tab-content pt-4" id="pc-noti-tabContent">
                        <div class="tab-pane fade show active" id="pc-noti-home" role="tabpanel"
                            aria-labelledby="pc-noti-home-tab">
                            @foreach (App\Models\Chat::getNotification(Auth::user()->id) as $item)
                                <div class="media">
                                    <img src="{{ $item->user_from->avatar == '' ? asset('img/user.png') : url(Storage::url($item->user_from->avatar)) }}"
                                        alt="user-image" class="img-fluid avtar avtar-l">
                                    <div class="media-body ml-3 align-self-center">
                                        <h6 class="mb-0 d-inline-block">{{ $item->user_from->name }}</h6>
                                        <p class="mb-0 d-inline-block f-12 text-muted"> • {{ $item->created_at }} </p>
                                        <p class="my-3">{{ $item->content }}</p>

                                    </div>
                                </div>
                                <hr class="mb-4">
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}

    <!-- [ Header ] end -->

    <!-- [ Main Content ] start -->
    @yield('content')

    <!-- Required Js -->
    <script src="{{ asset('backand_theme') }}/assets/js/vendor-all.min.js"></script>
    <script src="{{ asset('backand_theme') }}/assets/js/plugins/bootstrap.min.js"></script>
    <script src="{{ asset('backand_theme') }}/assets/js/plugins/feather.min.js"></script>
    <script src="{{ asset('backand_theme') }}/assets/js/pcoded.min.js"></script>
    <script src="{{ asset('backand_theme') }}/assets/js/highlight.min.js"></script>
    <script src="{{ asset('backand_theme') }}/assets/js/plugins/clipboard.min.js"></script>
    <script src="{{ asset('backand_theme') }}/assets/js/uikit.min.js"></script>

    <script src="{{ asset('backand_theme') }}/assets/js/plugins/jquery.dataTables.min.js"></script>
    <script src="{{ asset('backand_theme') }}/assets/js/plugins/dataTables.bootstrap4.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <!-- notification Js -->
    <script src="{{ asset('backand_theme') }}/assets/js/plugins/bootstrap-notify.min.js"></script>
    {{-- <script src="{{ asset('backand_theme') }}/assets/js/pages/ac-notification.js"></script> --}}

    <!-- select2 Js -->
    <script src="{{ asset('backand_theme') }}/assets/js/plugins/select2.full.min.js"></script>
    <!-- form-select-custom Js -->
    <script src="{{ asset('backand_theme') }}/assets/js/pages/form-select-custom.js"></script>

    <!-- datatable Js -->
    {{-- <script src="{{ asset('backand_theme') }}/assets/js/plugins/buttons.colVis.min.js"></script>
    <script src="{{ asset('backand_theme') }}/assets/js/plugins/buttons.print.min.js"></script>
    <script src="{{ asset('backand_theme') }}/assets/js/plugins/pdfmake.min.js"></script>
    <script src="{{ asset('backand_theme') }}/assets/js/plugins/jszip.min.js"></script>
    <script src="{{ asset('backand_theme') }}/assets/js/plugins/dataTables.buttons.min.js"></script>
    <script src="{{ asset('backand_theme') }}/assets/js/plugins/buttons.html5.min.js"></script>
    <script src="{{ asset('backand_theme') }}/assets/js/plugins/buttons.bootstrap4.min.js"></script>
    <script src="{{ asset('backand_theme') }}/assets/js/pages/data-export-custom.js"></script> --}}

    @stack('js')

    <script>
        // DataTable start
        $('.lara-dataTable').DataTable();
        // DataTable end
    </script>


    @if (Session::has('danger'))
        <script>
            function notify(title, message, from, align, icon, type, animIn, animOut) {
                $.notify({
                    icon: icon,
                    title: title,
                    message: message,
                    url: ''
                }, {
                    element: 'body',
                    type: type,
                    allow_dismiss: true,
                    placement: {
                        from: from,
                        align: align
                    },
                    offset: {
                        x: 30,
                        y: 30
                    },
                    spacing: 10,
                    z_index: 999999,
                    delay: 2500,
                    timer: 1000,
                    url_target: '_blank',
                    mouse_over: false,
                    animate: {
                        enter: animIn,
                        exit: animOut
                    },
                    icon_type: 'class',
                    template: '<div data-notify="container" class="col-xs-11 col-sm-3 alert alert-{0}" role="alert">' +
                        '<button type="button" aria-hidden="true" class="close" data-notify="dismiss">×</button>' +
                        '<span data-notify="icon"></span> ' +
                        '<div data-notify="title"><b>{1}</b></div> ' +
                        '<span data-notify="message">{2}</span>' +
                        '<div class="progress" data-notify="progressbar">' +
                        '<div class="progress-bar progress-bar-{0}" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>' +
                        '</div>' +
                        '<a href="{3}" target="{4}" data-notify="url"></a>' +
                        '</div>'
                });
            };

            var title = 'Gagal';
            var message = "{{ Session::get('danger') }}";
            var nFrom = $(this).attr('data-from');
            var nAlign = $(this).attr('data-align');
            var nIcons = $(this).attr('data-notify-icon');
            var nType = 'danger';
            var nAnimIn = 'animated bounceInRight';
            var nAnimOut = 'animated bounceOutRight';
            notify(title, message, nFrom, nAlign, nIcons, nType, nAnimIn, nAnimOut);
        </script>
    @endif

    @if (Session::has('success'))
        <script>
            function notify(title, message, from, align, icon, type, animIn, animOut) {
                $.notify({
                    icon: icon,
                    title: title,
                    message: message,
                    url: ''
                }, {
                    element: 'body',
                    type: type,
                    allow_dismiss: true,
                    placement: {
                        from: from,
                        align: align
                    },
                    offset: {
                        x: 30,
                        y: 30
                    },
                    spacing: 10,
                    z_index: 999999,
                    delay: 2500,
                    timer: 1000,
                    url_target: '_blank',
                    mouse_over: false,
                    animate: {
                        enter: animIn,
                        exit: animOut
                    },
                    icon_type: 'class',
                    template: '<div data-notify="container" class="col-xs-11 col-sm-3 alert alert-{0}" role="alert">' +
                        '<button type="button" aria-hidden="true" class="close" data-notify="dismiss">×</button>' +
                        '<span data-notify="icon"></span> ' +
                        '<div data-notify="title"><b>{1}</b></div> ' +
                        '<span data-notify="message">{2}</span>' +
                        '<div class="progress" data-notify="progressbar">' +
                        '<div class="progress-bar progress-bar-{0}" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>' +
                        '</div>' +
                        '<a href="{3}" target="{4}" data-notify="url"></a>' +
                        '</div>'
                });
            };

            var title = 'Sukses';
            var message = "{{ Session::get('success') }}";
            var nFrom = $(this).attr('data-from');
            var nAlign = $(this).attr('data-align');
            var nIcons = $(this).attr('data-notify-icon');
            var nType = 'success';
            var nAnimIn = 'animated bounceInRight';
            var nAnimOut = 'animated bounceOutRight';
            notify(title, message, nFrom, nAlign, nIcons, nType, nAnimIn, nAnimOut);
        </script>
    @endif

    {{-- <div class="pct-customizer">
    <div href="#!" class="pct-c-btn">
        <button class="btn btn-light-danger" id="pct-toggler">
            <i data-feather="settings"></i>
        </button>
        <button class="btn btn-light-primary" data-toggle="tooltip" title="Document" data-placement="left">
            <i data-feather="book"></i>
        </button>
        <button class="btn btn-light-success" data-toggle="tooltip" title="Buy Now" data-placement="left">
            <i data-feather="shopping-bag"></i>
        </button>
        <button class="btn btn-light-info" data-toggle="tooltip" title="Support" data-placement="left">
            <i data-feather="headphones"></i>
        </button>
    </div>
    <div class="pct-c-content ">
        <div class="pct-header bg-primary">
            <h5 class="mb-0 text-white f-w-500">Nextro Customizer</h5>
        </div>
        <div class="pct-body">
            <h6 class="mt-2"><i data-feather="credit-card" class="mr-2"></i>Header settings</h6>
            <hr class="my-2">
            <div class="theme-color header-color">
                <a href="#!" class="" data-value="bg-default"><span></span><span></span></a>
                <a href="#!" class="" data-value="bg-primary"><span></span><span></span></a>
                <a href="#!" class="" data-value="bg-danger"><span></span><span></span></a>
                <a href="#!" class="" data-value="bg-warning"><span></span><span></span></a>
                <a href="#!" class="" data-value="bg-info"><span></span><span></span></a>
                <a href="#!" class="" data-value="bg-success"><span></span><span></span></a>
                <a href="#!" class="" data-value="bg-dark"><span></span><span></span></a>
            </div>
            <h6 class="mt-4"><i data-feather="layout" class="mr-2"></i>Sidebar settings</h6>
            <hr class="my-2">
            <div class="custom-control custom-switch">
                <input type="checkbox" class="custom-control-input" id="cust-sidebar">
                <label class="custom-control-label f-w-600 pl-1" for="cust-sidebar">Light Sidebar</label>
            </div>
            <div class="custom-control custom-switch mt-2">
                <input type="checkbox" class="custom-control-input" id="cust-sidebrand">
                <label class="custom-control-label f-w-600 pl-1" for="cust-sidebrand">Color Brand</label>
            </div>
            <div class="theme-color brand-color d-none">
                <a href="#!" class="active" data-value="bg-primary"><span></span><span></span></a>
                <a href="#!" class="" data-value="bg-danger"><span></span><span></span></a>
                <a href="#!" class="" data-value="bg-warning"><span></span><span></span></a>
                <a href="#!" class="" data-value="bg-info"><span></span><span></span></a>
                <a href="#!" class="" data-value="bg-success"><span></span><span></span></a>
                <a href="#!" class="" data-value="bg-dark"><span></span><span></span></a>
            </div>
        </div>
    </div>
</div> --}}

    {{-- select2  --}}
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.select2').select2({})
        })
    </script>
    <script>
        // header option
        $('#pct-toggler').on('click', function() {
            $('.pct-customizer').toggleClass('active');

        });
        // header option
        $('#cust-sidebrand').change(function() {
            if ($(this).is(":checked")) {
                $('.theme-color.brand-color').removeClass('d-none');
                $('.m-header').addClass('bg-dark');
            } else {
                $('.m-header').removeClassPrefix('bg-');
                $('.m-header > .b-brand > .logo-lg').attr('src', 'assets/images/logo-dark.svg');
                $('.theme-color.brand-color').addClass('d-none');
            }
        });
        // Header Color
        $('.brand-color > a').on('click', function() {
            var temp = $(this).attr('data-value');
            // $('.header-color > a').removeClass('active');
            // $('.pcoded-header').removeClassPrefix('brand-');
            // $(this).addClass('active');
            if (temp == "bg-default") {
                $('.m-header').removeClassPrefix('bg-');
            } else {
                $('.m-header').removeClassPrefix('bg-');
                $('.m-header > .b-brand > .logo-lg').attr('src', 'assets/images/logo.svg');
                $('.m-header').addClass(temp);
            }
        });
        // Header Color
        $('.header-color > a').on('click', function() {
            var temp = $(this).attr('data-value');
            // $('.header-color > a').removeClass('active');
            // $('.pcoded-header').removeClassPrefix('brand-');
            // $(this).addClass('active');
            if (temp == "bg-default") {
                $('.pc-header').removeClassPrefix('bg-');
            } else {
                $('.pc-header').removeClassPrefix('bg-');
                $('.pc-header').addClass(temp);
            }
        });
        // sidebar option
        $('#cust-sidebar').change(function() {
            if ($(this).is(":checked")) {
                $('.pc-sidebar').addClass('light-sidebar');
                $('.pc-horizontal .topbar').addClass('light-sidebar');
                // $('.m-header > .b-brand > .logo-lg').attr('src', 'assets/images/logo-dark.svg');
            } else {
                $('.pc-sidebar').removeClass('light-sidebar');
                $('.pc-horizontal .topbar').removeClass('light-sidebar');
                // $('.m-header > .b-brand > .logo-lg').attr('src', 'assets/images/logo.svg');
            }
        });
        $.fn.removeClassPrefix = function(prefix) {
            this.each(function(i, it) {
                var classes = it.className.split(" ").map(function(item) {
                    return item.indexOf(prefix) === 0 ? "" : item;
                });
                it.className = classes.join(" ");
            });
            return this;
        };

        $(".delete-button").on('click', function(e) {
            e.preventDefault();
            let form = $(this).parents('form');

            swal.fire({
                title: 'Apakah Anda yakin ingin menghapus data ini?',
                text: 'Data yang dihapus tidak bisa dikembalikan',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Hapus',
                cancelButtonText: 'Batalkan'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit()

                    swal.fire(
                        'Dikonfirmasi!',
                        'Data akan dihapus.',
                        'success'
                    )
                }
            })
        })
    </script>

</html>

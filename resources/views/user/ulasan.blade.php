@section('css')
    <style>
        .rate {
            float: left;
            height: 46px;
            padding: 0 10px;
        }

        .rate:not(:checked)>input {
            position: absolute;
            display: none;
        }

        .rate:not(:checked)>label {
            float: right;
            width: 1em;
            overflow: hidden;
            white-space: nowrap;
            cursor: pointer;
            font-size: 30px;
            color: #ccc;
        }

        .rated:not(:checked)>label {
            float: right;
            width: 1em;
            overflow: hidden;
            white-space: nowrap;
            cursor: pointer;
            font-size: 30px;
            color: #ccc;
        }

        .rate:not(:checked)>label:before {
            content: '★ ';
        }

        .rate>input:checked~label {
            color: #ffc700;
        }

        .rate:not(:checked)>label:hover,
        .rate:not(:checked)>label:hover~label {
            color: #deb217;
        }

        .rate>input:checked+label:hover,
        .rate>input:checked+label:hover~label,
        .rate>input:checked~label:hover,
        .rate>input:checked~label:hover~label,
        .rate>label:hover~input:checked~label {
            color: #c59b08;
        }

        .star-rating-complete {
            color: #c59b08;
        }

        .rating-container .form-control:hover,
        .rating-container .form-control:focus {
            background: #fff;
            border: 1px solid #ced4da;
        }

        .rating-container textarea:focus,
        .rating-container input:focus {
            color: #000;
        }

        .rated {
            float: left;
            height: 46px;
            padding: 0 10px;
        }

        .rated:not(:checked)>input {
            position: absolute;
            display: none;
        }

        .rated:not(:checked)>label {
            float: right;
            width: 1em;
            overflow: hidden;
            white-space: nowrap;
            cursor: pointer;
            font-size: 30px;
            color: #ffc700;
        }

        .rated:not(:checked)>label:before {
            content: '★ ';
        }

        .rated>input:checked~label {
            color: #ffc700;
        }

        .rated:not(:checked)>label:hover,
        .rated:not(:checked)>label:hover~label {
            color: #deb217;
        }

        .rated>input:checked+label:hover,
        .rated>input:checked+label:hover~label,
        .rated>input:checked~label:hover,
        .rated>input:checked~label:hover~label,
        .rated>label:hover~input:checked~label {
            color: #c59b08;
        }
    </style>
@endsection
@extends('layouts.frontend.app')
@section('content')
    <!--team section-->
    <section class=" " style="margin-top:50px; margin-bottom:50px;">
        <div class="container ">
            <div class="section-title text-center">
                <h3>{{ $title }}</h3>

            </div>

        </div>
    </section>
    <!--End team section-->
    <section style="margin-top:50px; margin-bottom:100px;">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-4">
                    @include('user.menu_user')
                </div>
                <div class="col-lg-9 col-md-8">
                    <div class="card shadow shadow-sm rounded">
                        <div class="card-header">
                            <strong>Ulasan Anda</strong>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Kode Service</th>
                                        <th>Rating</th>
                                        <th>Ulasan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($rating as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td><strong>{{ $item->service->code }}</strong><br><small
                                                    class="text-muted">{{ $item->konter->name }}</small>
                                            </td>
                                            <td>
                                                <div class="form-group row">
                                                    <div class="col">
                                                        <div class="rated">
                                                            @for ($i = 1; $i <= $item->star_rating; $i++)
                                                                <label class="star-rating-complete"
                                                                    title="text">{{ $i }}
                                                                    stars</label>
                                                            @endfor
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>{!! $item->comments !!}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('script')
    <script type="text/javascript">
        $("#produk").addClass("active");
    </script>
@endsection

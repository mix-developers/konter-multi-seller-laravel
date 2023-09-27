<div class="col-md-4">
    <div class="card">
        <div class="card-body">
            <h6>Akun User</h6>
            <div class="row d-flex align-items-center">
                <div class="col-9">
                    <h3 class="f-w-300 d-flex align-items-center text-danger">
                        <i data-feather="users" class="mr-3"></i>
                        {{ App\Models\User::where('role', 'user')->count() }}
                    </h3>
                </div>

            </div>
            <div class="progress m-t-30" style="height: 7px;">
                <div class="progress-bar bg-theme" role="progressbar" style="width: 100%;" aria-valuenow="100"
                    aria-valuemin="0" aria-valuemax="100"></div>
            </div>
        </div>
    </div>
</div>
<div class="col-md-4">
    <div class="card">
        <div class="card-body">
            <h6>Akun Counter</h6>
            <div class="row d-flex align-items-center">
                <div class="col-9">
                    <h3 class="f-w-300 d-flex align-items-center text-danger">
                        <i data-feather="users"
                            class="mr-3"></i>{{ App\Models\User::where('role', 'konter')->count() }}
                    </h3>
                </div>

            </div>
            <div class="progress m-t-30" style="height: 7px;">
                <div class="progress-bar bg-theme" role="progressbar" style="width: 100%;" aria-valuenow="100"
                    aria-valuemin="0" aria-valuemax="100"></div>
            </div>
        </div>
    </div>
</div>
<div class="col-md-4">
    <div class="card">
        <div class="card-body">
            <h6>Akun Admin</h6>
            <div class="row d-flex align-items-center">
                <div class="col-9">
                    <h3 class="f-w-300 d-flex align-items-center text-danger">
                        <i data-feather="users" class="mr-3"></i>
                        {{ App\Models\User::where('role', 'admin')->count() }}
                    </h3>
                </div>

            </div>
            <div class="progress m-t-30" style="height: 7px;">
                <div class="progress-bar bg-theme" role="progressbar" style="width: 100%;" aria-valuenow="100"
                    aria-valuemin="0" aria-valuemax="100"></div>
            </div>
        </div>
    </div>
</div>

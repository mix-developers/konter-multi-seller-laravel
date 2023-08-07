<div class="col-12">
    <div class="card bg-primary  text-center">
        <div class="card-body">
            <h4 class="text-white">Dashboard pendapatan service oleh konter</h4>
        </div>
    </div>
</div>
<div class="col-md-4">
    <div class="card">
        <div class="card-body">
            <h6>persentase Pendapatan Semua Konter ({{ date('F') }})</h6>
            <div class="row d-flex align-items-center">
                <div class="col-9">
                    <h3 class="f-w-300 d-flex align-items-center ">
                        @if (App\Models\ServicePrice::getIncomeMonthlyBefore() < $income)
                            <i class="feather icon-arrow-up text-success f-30 m-r-10"></i>
                        @elseif (App\Models\ServicePrice::getIncomeMonthlyBefore() == $income)
                            <i class="feather icon-activity text-success f-30 m-r-10"></i>
                        @else
                            <i class="feather icon-arrow-down text-danger f-30 m-r-10"></i>
                        @endif
                        Rp {{ number_format($income) }}
                    </h3>
                </div>
                <div class="col-3 text-right">
                    <p class="">{{ App\Models\ServicePrice::getIncomeMonthlyPercent() }}%</p>
                </div>
            </div>
            <div class="progress m-t-30" style="height: 7px;">
                <div class="progress-bar bg-theme" role="progressbar"
                    style="width: {{ App\Models\ServicePrice::getIncomeMonthlyPercent() }}%;"
                    aria-valuenow="{{ App\Models\ServicePrice::getIncomeMonthlyPercent() }}" aria-valuemin="0"
                    aria-valuemax="100"></div>
            </div>
        </div>
    </div>
</div>
<div class="col-md-4">
    <div class="card">
        <div class="card-body">
            <h6>Pendapatan Semua Konter bulan lalu</h6>
            <div class="row d-flex align-items-center">

                <div class="col-9">
                    <h3 class="f-w-300 d-flex align-items-center ">
                        Rp {{ number_format(App\Models\ServicePrice::getIncomeMonthlyBefore()) }}
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
            <h6>Pendapatan Semua Konter bulan ini</h6>
            <div class="row d-flex align-items-center">

                <div class="col-9">
                    <h3 class="f-w-300 d-flex align-items-center ">
                        Rp {{ number_format(App\Models\ServicePrice::getIncomeMonthlyNow()) }}
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

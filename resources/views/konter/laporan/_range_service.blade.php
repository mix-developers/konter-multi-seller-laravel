<div class="my-4">
    <form action="{{ url('konter/laporan/exportService') }}" method="POST">
        @csrf
        <div class="form-group row mx-3">
            <label class="col-form-label coltext-lg-right">Tanggal </label>
            <div class="col">
                <div class="input-daterange input-group">
                    <input type="date" class="form-control" name="from_date">
                    <div class="input-group-append">
                        <span class="input-group-text"><i>sampai</i></span>
                    </div>
                    <input type="date" class="form-control" name="to_date">
                </div>
            </div>
            <div class="col">
                <button type="submit" class="btn btn-md btn-light-primary">
                    <i class="icon feather icon-printer f-16"> </i> Export
                </button>
            </div>

        </div>
    </form>
</div>

<div class="row">
    <div class="col-12 col-sm-12">
        <div class="card card-secondary card-tabs">
            <div class="card-header p-0 pt-1">
                <h4 class=" ml-5">Laporan Pendapatan Berdasarkan Tanggal </h4>
            </div>
            <div class="card-body">
                <div class="form-row form-inline">
                    <form method="POST" class="d-flex" action="{{ route('management.report_in') }}">
                        @csrf
                        <x-adminlte-date-range name="drBasic" />
                        <button class="btn btn-outline-success" type="submit"> &nbsp;<i
                                class="fa fa-search"></i></button>
                    </form>
                </div>

            </div>
            <!-- /.card -->
        </div>
    </div>
</div>
<section class="content-income-report-here">

</section>
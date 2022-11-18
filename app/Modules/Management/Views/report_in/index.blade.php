@extends('adminlte::page')
@section('content')
    <div id="container">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Laporan Pendapatan Masjid</h1>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <section class="content-header">
            <div class="container-fluid">
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
            </div><!-- /.container-fluid -->
        </section>
        <section class="content-income-report-here">
            
        </section>
    </div>
@endsection

@extends('adminlte::page')
@section('content')
    <div id="container">
        <div class="card-body">
            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Daftar Pengurus Masjid</h3>
                                    {!!create(['url'=> route('staff.create', $staff->structure_id), 'title'=> 'Tambah Staff', 'style'=> "float: right;"]) !!}
                                     
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="staff" class="table table-bordered table-hover display standard"
                                        style="width: 100%" data-route="{{ route('staff.getListAjaxPeoples') }}">
                                        <thead>
                                            <tr>
                                                <th data-name="id">No</th>
                                                <th data-name="full_name">Nama</th>
                                                <th data-name="phone">No Handphone</th>
                                                {{-- <th data-name="staff.position.name">Posisi / Struktur Organisasi</th> --}}
                                                <th data-name="action" nowrap="nowrap">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->


                            <!-- /.card -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
    </div>
@stop

@extends('adminlte::page')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Daftar Pengurus Masjid Sebagai Seksi {{ $position->name }}</h3>
                    {!! create(['url' => route('position.create'), 'title' => 'Tambah Seksi', 'style' => 'float: right;']) !!}
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="position" class="table table-bordered table-hover display standard" style="width: 100%"
                        data-route="{{ route('position.getListAjaxEmployees', ['position_id' => $position->id]) }}">
                        <thead>
                            <tr>
                                <th data-name="id">No</th>
                                <th data-name="first_name">Nama Depan</th>
                                <th data-name="last_name">Nama Belakang</th>
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
@stop

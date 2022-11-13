
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">List Akses</h3>
                        {!!create(['url'=> route('menu_user.create'), 'title'=> 'Tambah Akses', 'style'=> "float: right;"]) !!}
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="menu_user" class="table table-bordered table-hover display" style="width: 100%"
                            data-route="{{ route('menu_user.getListAjax') }}">
                            <thead>
                                <tr>
                                    <th data-name="id">No</th>
                                    <th data-name="name">Modul</th>
                                    <th data-name="index">List</th>
                                    <th data-name="create">Create</th>
                                    <th data-name="edit">Edit</th>
                                    <th data-name="show">Detail</th>
                                    <th data-name="print">Cetak</th>
                                    <th data-name="destroy">Hapus</th>
                                    {{-- <th>Action</th> --}}
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

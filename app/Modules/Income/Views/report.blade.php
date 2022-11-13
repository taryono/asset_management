<section class="content-header"></section>
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Laporan Pendapatan</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="income" class="table table-bordered table-hover display standard"
                            style="width: 100%"
                            data-route="{{ route('income.getListAjax', ['date_range' => $date_range]) }}">
                            <thead>
                                <tr>
                                    <th data-name="id">No</th>
                                    <th data-name="name" nowrap="nowrap">Nama</th>
                                    <th data-name="amount" nowrap="nowrap">Nominal Uang (Diuangkan)</th>
                                    <th data-name="date" data-format="date" nowrap="nowrap">Tanggal</th>
                                    <th data-name="type" nowrap="nowrap">Tipe</th>
                                    <th data-name="category" nowrap="nowrap">Kategori</th>
                                    <th data-name="material" nowrap="nowrap">Uang/Barang</th>
                                    <th data-name="from" nowrap="nowrap">Atas Nama</th>
                                    <th data-name="description" nowrap="nowrap">Keterangan</th>
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

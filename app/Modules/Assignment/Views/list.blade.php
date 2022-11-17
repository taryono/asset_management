     <!-- Main content -->
     <section class="content">
         <div class="container-fluid">
             <div class="row">
                 <div class="col-12">
                     <div class="card">
                         <div class="card-header">
                             <h3 class="card-title">Daftar SK Kepengurusan Masjid Mujahiddin</h3>
                             {!! create(['url' => route('assignment.create'), 'title' => 'Tambah SK', 'style' => 'float: right;', 'type' => 'inline']) !!}
                         </div>
                         <!-- /.card-header -->
                         <div class="card-body">
                             <table id="assignment" class="table table-bordered table-hover display standard"
                                 style="width: 100%" data-route="{{ route('assignment.getListAjax') }}">
                                 <thead>
                                     <tr>
                                         <th data-name="id">No</th>
                                         <th data-name="code">Nomor SK</th>
                                         <th data-name="name">Nama</th>
                                         <th data-name="structure.name">Kepengurusan</th>
                                         <th data-name="position.name">Seksi/Bagian</th>
                                         <th data-name="employee.name">Nama Pejabat</th>
                                         <th data-name="sign_by">Ditandatangani Oleh</th>
                                         <th data-name="date">Tanggal Pembuatan SK</th>
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

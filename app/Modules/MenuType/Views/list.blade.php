
  <!-- Main content -->
  <section class="content">
      <div class="container-fluid">
          <div class="row">
              <div class="col-lg-12">
                  <div class="card">
                      <div class="card-header">
                          <h3 class="card-title">Daftar Tipe Menu</h3>
                              {!!create(['url'=> route('menu_type.create'), 'title'=> 'Tambah Tipe Menu', 'style'=> "float: right;"]) !!}
                      </div>
                      <!-- /.card-header -->
                      <div class="card-body">
                          <table id="menu_type" class="table table-bordered table-hover display standard" style="width: 100%" data-route="{{ route('menu_type.getListAjax') }}">
                              <thead>
                                  <tr>
                                    <th data-name="id">No</th> 
                                    <th data-name="name">Nama</th>  
                                    <th data-name="bg_color">Warna Background</th> 
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
  
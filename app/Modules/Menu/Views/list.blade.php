  <!-- Content Header (Page header) -->
  <section class="content-header"> 
  </section>  
  <!-- Main content -->
  <section class="content">
      <div class="container-fluid">
          <div class="row">
              <div class="col-12">
                  <div class="card">
                      <div class="card-header">
                          <h3 class="card-title">Daftar Menu</h3>
                          {!!create(['url'=> route('menu.create'), 'title'=> 'Tambah Menu', 'style'=> "float: right;"]) !!}
                          
                      </div>
                      
                      <!-- /.card-header -->
                      <div class="card-body"> 
                        <a class="toggle-vis" data-column="1">Name</a><a class="toggle-vis" data-column="2">Tipe Menu</a><a class="toggle-vis" data-column="3">Parent</a><a class="toggle-vis" data-column="4">Urutan</a><a class="toggle-vis" data-column="5">Status</a><a class="toggle-vis" data-column="6">Action</a>
                        <br><br>
                          <table id="menu" class="table table-bordered table-hover display standard" style="width: 100%" data-route="{{ route('menu.getListAjax') }}">
                              <thead>
                                  <tr>
                                      <th data-name="id">No</th>
                                      <th data-name="name">Nama</th>
                                      <th nowrap="nowrap" data-name="menu_type.name">Tipe Menu</th> 
                                      <th data-name="parent.name">Parent</th>
                                      <th data-name="sequence">Urutan</th>
                                      <th data-name="is_active">Status</th> 
                                      <th data-name="is_private">Status</th> 
                                      <th class="action" data-priority="2">Action</th>
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
  
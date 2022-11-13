
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Daftar Negara</h3>
                {!!create(['url'=> route('country.create'), 'title'=> 'Tambah Negara', 'style'=> "float: right;"]) !!}
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="country" class="table table-bordered table-hover display standard" style="width: 100%" data-route="{{ route('country.getListAjax') }}">
                  <thead> 
                  <tr>
                    <th data-name="id">No</th> 
                    <th data-name="name">Nama</th>  
                    <th data-name="code">ISO</th>
                    <th data-name="action">Action</th> 
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
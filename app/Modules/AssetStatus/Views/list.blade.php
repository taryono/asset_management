

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header"> 
                 {!! create(['url'=> route('asset_status.create'), 'title'=> 'Tambah Kategori', 'style'=> "float: right;"])!!}
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="asset_status" class="table table-bordered table-hover display standard" style="width: 100%" data-route="{{ route('asset_status.getListAjax') }}">
                  <thead>
                    <tr>
                      <th data-name="id">No</th> 
                      <th data-name="name">Nama</th>   
                      <th data-name="bg_color">Warna Background</th>   
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
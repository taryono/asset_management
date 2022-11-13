
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Daftar Post</h3> 
                {!!create(['url'=> route('post.create'), 'title'=> 'Tambah Post', 'style'=> "float: right;", 'type'=> 'inline']) !!}
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="post" class="table table-bordered table-hover display standard" style="width: 100%" data-route="{{ route('post.getListAjax') }}">
                  <thead>
                  <tr>
                    <th data-name="id">No</th> 
                    <th data-name="title">Judul</th> 
                    <th data-name="publish_date" nowrap="nowrap" data-format="date_time">Tanggal Publish</th>
                    <th data-name="author">Pengarang</th> 
                    <th data-name="category.name">Kategori</th> 
                    <th data-name="status">Status</th> 
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
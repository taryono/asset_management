
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Daftar Kecamatan</h3>
                <?php 
                if(isset($parent)){
                  $city = $parent;
                }
                $url = ($city)?route('district.create',['city_id'=> $city->id]):route('district.create');
                $ajax_url = ($city)?route('district.getListAjax',['city_id'=> $city->id]):route('district.getListAjax');
                ?>
                {!!create(['url'=> $url, 'title'=> 'Tambah Kecamatan', 'style'=> "float: right;"]) !!} 
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="district" class="table table-bordered table-hover display standard" style="width: 100%" data-route="{{$ajax_url}}">
                  <thead> 
                  <tr>
                    <th data-name="id">No</th> 
                    <th data-name="name">Nama</th>  
                    <th data-name="city.name">Kota/Kabupaten</th>
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
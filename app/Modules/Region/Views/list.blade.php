<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Daftar Provinsi</h3> 
        <?php 
        if(isset($parent)){
          $country = $parent;
        }
        $url = ($country)?route('region.create',['country_id'=> $country->id]):route('region.create');
        $ajax_url = ($country)?route('region.getListAjax',['country_id'=> $country->id]):route('city.getListAjax');
        ?>
        {!!create(['url'=> $url, 'title'=> 'Tambah Provinsi', 'style'=> "float: right;"]) !!}
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <table id="region" class="table table-bordered table-hover display standard" style="width: 100%" data-route="{{$ajax_url}}">
          <thead>
          <tr>
            <th data-name="id">No</th> 
            <th data-name="name">Nama</th>   
            <th data-name="country.name">Negara</th>
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
  </div>
  <!-- /.col -->
</div>
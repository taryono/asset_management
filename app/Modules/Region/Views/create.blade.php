{{ Form::open(['method' => 'POST','route'=> ['region.store'], 'class'=> 'form-horizontal', 'enctype'=> 'multipart/form-data']) }}
    <div class="card-body"> 
        <div class="form-group">
            <label for="name">Nama Provinsi</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}"
                placeholder="Nama Provinsi">
        </div>
        <div class="form-group">
          <label for="parent">Negara</label> 
            {{Form::select('country_id', \Models\Country::pluck('name', 'id')->all(),$country?$country->id:null, ["class" => "form-control selectpicker", "id"=> "country_id", "data-live-search"=> "true", 'data-style'=> 'btn-success'])}}
        </div>  
    </div>
    <!-- /.card-body -->
{{Form::close()}}
@push('js')
    <script>
      $(function(){
        $('#reservationdatetime').datetimepicker({ icons: { time: 'far fa-clock' } });
      })
      </script>
@endpush
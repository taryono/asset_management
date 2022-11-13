{{ Form::open(['method' => 'POST','route'=> ['country.store'], 'class'=> 'form-horizontal', 'enctype'=> 'multipart/form-data']) }}
    <div class="card-body">
        
        <div class="form-group">
            <label for="name">Nama Negara</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}"
                placeholder="Nama Negara">
        </div> 
        <div class="form-group">
          <label for="name">Kode Negara</label>
          {{Form::text('code', null, ["class"=>"form-control", "id"=>"name"])}}
      </div> 
    </div>
    <!-- /.card-body -->
{{Form::close()}} 
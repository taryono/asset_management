{{ Form::open(['method' => 'POST','route'=> ['attribute.store'], 'class'=> 'form-horizontal', 'enctype'=> 'multipart/form-data']) }}
{{Form::hidden('menu_id', $menu_id)}}                
    <div class="card-body"> 
      <div class="form-group">
        <label for="name">Key</label>
        <input type="key" class="form-control" id="key" name="key" value="{{ old('key') }}" placeholder="Key">
      </div> 
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" placeholder="name">
        </div> 
        <div class="form-group">
          <label for="is_active">Status</label>
          {{Form::select('is_active', [0=> 'Tidak Aktif', 1=> 'Aktif'],null, ["class" => "form-control", "placeholder"=> "Pilih Status"])}}    
        </div> 
    </div> 
{{Form::close()}} 
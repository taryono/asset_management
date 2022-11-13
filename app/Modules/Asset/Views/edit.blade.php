  {{ Form::model($asset, ['method' => 'PUT', 'route' => ['asset.update', $asset->id], 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data']) }}
  <div class="card-body">
    <div class="form-group"> 
        {{Form::text('name', null, ['class'=> 'form-control', 'placeholder'=> "Nama Asset", 'required'])}}        
    </div>
    <div class="form-group"> 
        {{Form::select('asset_type_id', \Models\AssetType::pluck('name', 'id')->all(),null, ["class" => "form-control selectpicker", "id"=> "asset_type_id", "placeholder"=>"Pilih Tipe Asset", 'required'])}}         
    </div>
    <div class="form-group"> 
        {{Form::select('asset_status_id', \Models\AssetStatus::pluck('name', 'id')->all(),null, ["class" => "form-control selectpicker", "id"=> "asset_status_id", "placeholder"=>"Pilih Status Asset", 'required'])}}         
    </div>
    <div class="form-group"> 
        {{Form::select('asset_category_id', \Models\AssetCategory::pluck('name', 'id')->all(),null, ["class" => "form-control selectpicker", "id"=> "asset_category_id", "placeholder"=>"Pilih kategori Asset", 'required'])}}                  
    </div>
    <div class="form-group"> 
        {{Form::number('amount', old('amount'), ['class'=> 'form-control', 'placeholder'=> "Jumlah Asset", 'required'])}}        
    </div>
    <div class="form-group">  
        {{Form::number('price', null, ['class'=> 'form-control', 'placeholder'=> "harga Asset", 'required'])}}        
    </div>
    <div class="form-group">
        <label for="preview"></label>
        <div class="post-review">
            <img src="{{url('/assets',$asset->photo)}}" class="img-responsive" onerror="this.src='{{ asset('assets/images/mosque.png') }}'"
                width="100px">
        </div>
    </div>
    <div class="form-group">
        <label for="file">Gambar Asset</label>
        <input type="file" class="form-control post-input" id="photo" name="photo" value="{{ old('photo') }}"
            placeholder="Upload Photo" data-target="post-review2">
    </div>
    <div class="form-group"> 
        {{Form::textarea('description', null, ['class'=> 'form-control', 'placeholder'=> "keterangan", "rows"=> 3, 'required'])}}        
         
    </div>
</div>
  {{ Form::close() }}

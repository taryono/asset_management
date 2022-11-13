{{ Form::open(['method' => 'POST', 'route' => ['admin.store'], 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data']) }}
<div class="card-body">
    <div class="form-group">
        <label for="name">Nama</label>
        {{Form::text('name', old('name'), ['class'=> 'form-control', 'placeholder'=> "Nama", "id"=> "name"])}}                
    </div>
    <div class="form-group"> 
        {{Form::select('asset_type_id', \Models\AssetType::pluck('name', 'id')->all(),null, ["class" => "form-control selectpicker", "id"=> "asset_type_id", "placeholder"=>"--Pilih Tipe Admin--"])}}                  
    </div>
    <div class="form-group">
        <label for="company_id">Tipe Admin</label> 
        {{Form::select('asset_status_id', \Models\AssetStatus::pluck('name', 'id')->all(),null, ["class" => "form-control selectpicker", "id"=> "asset_status_id", "placeholder"=>"--Pilih Status Asset--"])}}                  
    </div>
    <div class="form-group">
        <label for="company_id">Tipe Admin</label>
        {{Form::select('asset_status_id', \Models\AssetStatus::pluck('name', 'id')->all(),null, ["class" => "form-control selectpicker", "id"=> "asset_status_id", "placeholder"=>"--Pilih Status Asset--"])}}                  
    </div>
    <div class="form-group">
        {{Form::text('amount', old('amount'), ['class'=> 'form-control', 'placeholder'=> "Jumlah", "id"=> "amount"])}}                
    </div>
    <div class="form-group">
        <label for="price">Harga/pcs</label>
        {{Form::text('price', old('price'), ['class'=> 'form-control', 'placeholder'=> "Harga", "id"=> "price"])}}                
    </div>
    <div class="form-group">
        <label for="description">Keterangan</label>
        <textarea class="form-control" id="description" name="description" value="{{ old('description') }}"
            placeholder="Keterangan">
  </div>
</div>
{{ Form::close() }}

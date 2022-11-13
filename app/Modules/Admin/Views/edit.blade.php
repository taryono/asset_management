 {{ Form::model($admin, ['method' => 'PUT', 'route' => ['admin.update', $admin->id], 'class' => 'form-horizontal']) }}
 
 <div class="card-body">
     <div class="form-group">
         <label for="name">Nama</label>
         <input type="text" class="form-control" id="name" name="name" value="{{ $admin->name }}" placeholder="Nama">
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
         <label for="company_id">Tipe Admin</label>
         {{Form::select('asset_status_id', \Models\AssetStatus::pluck('name', 'id')->all(),null, ["class" => "form-control selectpicker", "id"=> "asset_status_id", "placeholder"=>"--Pilih Status Asset--"])}}                  
     </div>
     <div class="form-group">
         <label for="amount">Jumlah</label>
         <input type="amount" class="form-control" id="amount" name="amount" value="{{ $admin->amount }}"
             placeholder="Jumlah">
     </div>
     <div class="form-group">
         <label for="price">Harga/pcs</label>
         <input type="price" class="form-control" id="price" name="price" value="{{ $admin->price }}"
             placeholder="Harga">
     </div>
     <div class="form-group">
         <label for="description">Keterangan</label>
         <textarea class="form-control" id="description" name="description"
             placeholder="Keterangan">{{ $admin->description }}</textarea>
     </div>
 </div> 
 {{ Form::close() }}

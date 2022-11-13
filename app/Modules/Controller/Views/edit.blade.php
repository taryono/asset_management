 {{ Form::model($controller, ['method' => 'PUT', 'route' => ['controller.update', $controller->id], 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data']) }}
 <div class="card-body">
     <div class="form-group">
         <label for="name">Nama</label>
         <input type="text" class="form-control" id="name" name="name" value="{{ $controller->name }}"
             placeholder="Nama">
     </div>
     <div class="form-group">
         <label for="url">Url</label>
         <input type="url" class="form-control" id="url" name="url" value="{{ $controller->url }}"
             placeholder="Nama">
     </div>
     <div class="form-group">
        {{Form::select('group_menu_id', \Models\GroupMenu::pluck('name', 'id')->all(),null, ["class" => "form-control selectpicker", "id"=> "group_menu_id", "placeholder"=>"--Pilih Group Menu--"])}}                  
     </div>
 </div>
 {{ Form::close() }}

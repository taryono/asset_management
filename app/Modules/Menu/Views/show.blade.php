 {{ Form::model($menu, ['method' => 'PUT', 'route' => ['menu.update', $menu->id, 'class' => 'form-horizontal']]) }}
 <div class="card-body">
     <div class="form-group">
         <label for="name">Nama Modul</label>
         {{ Form::text('name', null, ['class' => 'form-control', 'id' => 'name']) }}
     </div>
     <div class="form-group">
         <label for="sequence">Urutan</label>
         {{ Form::number('sequence', null, ['class' => 'form-control', 'id' => 'sequence']) }}
     </div>
     <div class="form-group">
         <label for="model">Model</label>
         {{ Form::text('model', null, ['class' => 'form-control', 'id' => 'model']) }}
     </div>
     <div class="form-group">
         <label for="is_active">Status</label>
         {{ Form::select('is_active', [0 => 'Tidak Aktif', 1 => 'Aktif'], null, ['class' => 'form-control', 'id' => 'status', 'placeholder' => 'Pilih Status']) }}

     </div>
     <div class="form-group">
         <label for="parent">Parent</label>
         {{ Form::select('parent_id', Models\Menu::pluck('name', 'id')->all(), null, ['class' => 'form-control', 'id' => 'parent_id', 'placeholder' => 'Pilih Parent']) }}
     </div>
 </div>
 {{ Form::close() }}

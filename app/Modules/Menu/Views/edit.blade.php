 {{ Form::model($menu, ['method' => 'PUT', 'route' => ['menu.update', $menu->id], 'class' => 'form-horizontal']) }}
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
         <label for="is_active">Status</label>
         {{ Form::select('is_active', [0 => 'Tidak Aktif', 1 => 'Aktif'], null, ['class' => 'form-control', 'id' => 'status', 'placeholder' => 'Pilih Status']) }}

     </div>
     <div class="form-group">
        <label for="is_private">Private/Public</label>
        {{ Form::select('is_private', [0 => 'Public', 1 => 'Private'], null, ['class' => 'form-control', 'id' => 'status', 'placeholder' => 'Pilih Status']) }}

    </div>
     <div class="form-group">
         <label for="type">Tipe</label>
         {{ Form::select('type', ['label' => 'Label', 'link' => 'Link', 'header' => 'Header', 'submenu' => 'Submenu', 'multilevel' => 'Multi level'], null, ['class' => 'form-control selectpicker', 'id' => 'type', 'data-live-search' => 'true', 'data-style' => 'btn-success']) }}
     </div>
     <div class="form-group">
         <label for="parent">Parent</label>
         {{ Form::select('parent_id', $menus, null, ['class' => 'form-control selectpicker', 'id' => 'parent_id', 'placeholder' => 'Pilih Parent', 'data-style' => 'btn-success']) }}
     </div>
     <div class="form-group">
         <label for="parent">Role</label>
         {{ Form::select('role_id[]', Models\Role::pluck('name', 'id')->all(), $menu->role->pluck('id', 'name')->all(), ['class' => 'form-control selectpicker', 'multiple' => 'true', 'data-live-search' => 'true', 'data-style' => 'btn-primary']) }}
     </div>
 </div>
 {{ Form::close() }}
 @section('js')
     <script type="text/javascript">
         $(function() {
             $(".selectpicker").select2();
         });
     </script>
 @endsection

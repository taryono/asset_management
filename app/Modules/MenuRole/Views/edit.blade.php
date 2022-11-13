{{ Form::model($menu_role, ['method' => 'PUT', 'route' => ['menu_role.update', $menu_role->id], 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data']) }}
<div class="card-body"> 
    <div class="form-group">
        <label for="menu_id">Modul</label>
        {{ Form::select('menu_id', \Models\Menu::pluck('name', 'id')->all(),null, ['class' => 'form-control selectpicker', 'id' => 'menu_id']) }}
    </div>
    <div class="form-group">
        <label for="role_id">Roles</label>
        {{ Form::select('role_id[]', \Models\Role::pluck('name', 'id')->all(),null, ['class' => 'form-control selectpicker','multiple']) }}
    </div> 
    <div class="form-group"> 
        {{ Form::checkbox('index',null, $menu_role->index, ['id' => 'index']) }} Daftar        
        {{ Form::checkbox('create',null,  $menu_role->create, [ 'id' => 'create']) }} Create
        {{ Form::checkbox('edit', null, $menu_role->edit, [ 'id' => 'edit']) }} Edit        
        {{ Form::checkbox('show', null, $menu_role->show, [ 'id' => 'show']) }} Detail
        {{ Form::checkbox('print',null,  $menu_role->print, [ 'id' => 'print']) }} Cetak
        {{ Form::checkbox('destroy', null, $menu_role->destroy, [ 'id' => 'destroy']) }} Delete

    </div>
</div> 
{{ Form::close() }}

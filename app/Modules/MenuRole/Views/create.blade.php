{{ Form::open(['method' => 'POST', 'route' => ['menu_role.store'], 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data']) }}
<div class="card-body"> 
    <div class="form-group">
        <label for="menu_id">Menu</label>
        {{ Form::select('menu_id', $menus,null, ['class' => 'form-control selectpicker', 'id' => 'menu_id']) }}
    </div>
    <div class="form-group">
        <label for="role_id">Roles</label>
        {{ Form::select('role_id[]', \Models\Role::where('name', '<>', 'superuser')->pluck('name', 'id')->all(),$role?$role->id:null, ['class' => 'form-control selectpicker','multiple']) }}
    </div> 
</div> 
{{ Form::close() }} 
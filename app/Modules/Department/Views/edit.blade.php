{{ Form::model($department, ['method' => 'PUT', 'route' => ['department.update', $department->id], 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data']) }}
<div class="card-body">
    <div class="form-group">
        <label for="name">Nama</label>
        <input type="text" class="form-control" id="name" name="name" value="{{ $department->name }}"
            placeholder="Nama">
    </div>
</div> 
{{ Form::close() }}

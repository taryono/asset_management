{{ Form::open(['method' => 'POST', 'route' => ['menu.store'], 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data']) }}
<div class="card-body">
    <div class="form-group">
        <label for="name">Nama Menu</label>
        <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" placeholder="Nama">
    </div>
    <div class="form-group">
        <label for="sequence">Urutan</label>
        <input type="sequence" class="form-control" id="sequence" name="sequence" value="{{ old('sequence') }}"
            placeholder="Urutan Menu">
    </div>
    <div class="form-group">
        <label for="is_active">Status</label>
        {{ Form::select('is_active', [0 => 'Tidak Aktif', 1 => 'Aktif'], null, ['class' => 'form-control', 'id' => 'status', 'placeholder' => 'Pilih Status']) }}
    </div>
    <div class="form-group">
        <label for="type">Tipe</label>
        {{ Form::select('type', ['label' => 'Label', 'link' => 'Link', 'header' => 'Header', 'submenu' => 'Submenu', 'multilevel' => 'Multi level'], null, ['class' => 'form-control selectpicker', 'id' => 'type', 'data-live-search' => 'true', 'data-style' => 'btn-success']) }}
    </div>
    <div class="form-group">
        <label for="parent">Parents</label>
        {{ Form::select('parent_id', Models\Menu::pluck('name', 'id')->all(), null, ['class' => 'form-control selectpicker', 'id' => 'parent_id', 'placeholder' => 'Pilih Parent', 'data-style' => 'btn-success']) }}
    </div>
    <div class="form-group">
        <label for="parent">Role</label>
        {{ Form::select('role_id[]', Models\Role::pluck('name', 'id')->all(), null, ['class' => 'form-control selectpicker', 'multiple' => true, 'data-live-search' => 'true', 'data-style' => 'btn-primary']) }}
    </div>
</div>
<!-- /.card-body -->
{{ Form::close() }}
@section('js')
    <script type="text/javascript">
        $(function() {
            $(".selectpicker").select2();
        });
    </script>
@endsection

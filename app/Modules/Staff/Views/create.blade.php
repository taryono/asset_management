{{ Form::open(['method' => 'POST', 'route' => ['staff.store'], 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data']) }}
 
<div class="card-body">
    @if($structure)
        {{ Form::hidden('structure_id', $structure->id) }}
    @else 
    <div class="form-group">
        <label for="name">Kepengurusan</label>
        {{ Form::select('structure_id', \Models\Structure::pluck('name', 'id')->all(),null, ['class' => 'form-control selectpicker', 'id' => 'structure_id',"placeholder"=>"Pilih Periode Kepengurusan"]) }}  
    </div>
    @endif
    <div class="form-group">
        <label for="position_id">Seksi</label>
        {{ Form::select('position_id', \Models\Position::where('type',2)->pluck('name', 'id')->all(),null, ['class' => 'form-control selectpicker', 'id' => 'position_id',"placeholder"=>"Seksi"]) }}  
    </div>
    <div class="form-group">
        <label for="employee_id">Dijabat Oleh</label>
        {{ Form::select('employee_id', \Models\Employee::pluck('first_name', 'id')->all(),null, ['class' => 'form-control selectpicker', "placeholder"=>"Pilih Nama Orang"]) }}  
    </div>
</div>
{{ Form::close() }}

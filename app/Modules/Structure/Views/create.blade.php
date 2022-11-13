{{ Form::open(['method' => 'POST', 'route' => ['structure.store'], 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data']) }}
<div class="card-body">
    <div class="form-group">
        <label for="name">Struktur Organisasi</label>
        {{ Form::text('name', old('name'), ['class' => 'form-control', 'id' => 'name',"placeholder"=>"Nama "]) }}  
    </div>
    <div class="form-group">
        <label for="start_date">Tanggal Mulai</label>
        {{ Form::date('start_date', old('start_date'), ['class' => 'form-control', 'id' => 'start_date',"placeholder"=>"Tanggal Mulai"]) }}  
    </div>
    <div class="form-group">
        <label for="end_date">Tanggal Akhir</label>
        {{ Form::date('end_date', old('end_date'), ['class' => 'form-control', 'id' => 'end_date',"placeholder"=>"Tanggal Mulai"]) }}  
    </div>
</div>
{{ Form::close() }}

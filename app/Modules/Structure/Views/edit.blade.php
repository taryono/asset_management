 {{ Form::model($structure, ['method' => 'PUT', 'route' => ['structure.update', $structure->id], 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data']) }}
 
 <div class="card-body">
     <div class="form-group">
         <label for="name">Nama</label> 
             {{ Form::text('name', null, ['class' => 'form-control', 'id' => 'name',"placeholder"=>"Nama"]) }}  
     </div>
     <div class="form-group">
        <label for="start_date">Tanggal Mulai</label>
        {{ Form::date('start_date', null, ['class' => 'form-control', 'id' => 'start_date',"placeholder"=>"Tanggal Mulai"]) }}  
    </div>
    <div class="form-group">
        <label for="end_date">Tanggal Akhir</label>
        {{ Form::date('end_date', null, ['class' => 'form-control', 'id' => 'end_date',"placeholder"=>"Tanggal Mulai"]) }}  
    </div>
 </div>

 {{ Form::close() }}

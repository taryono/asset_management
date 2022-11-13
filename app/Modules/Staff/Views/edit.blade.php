 {{ Form::model($staff, ['method' => 'PUT', 'route' => ['staff.update', $staff->id], 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data']) }}
 
 {{Form::hidden('structure_id')}}
 <div class="card-body">
     <div class="form-group">
         <label for="name">Struktur Organisasi</label>
         {{ Form::text('structure_name', $staff->structure->name, ['class' => 'form-control', 'id' => 'name',"placeholder"=>"Nama Struktur Kepengurusan", "disabled"=> "disabled"]) }}  
     </div>
     <div class="form-group">
         <label for="position_id">Seksi</label>
         {{ Form::select('position_id', \Models\Position::where('type',2)->pluck('name', 'id')->all(),null, ['class' => 'form-control selectpicker', 'id' => 'position_id',"placeholder"=>"Seksi"]) }}  
     </div>
     <div class="form-group">
         <label for="people_id">Dijabat Oleh</label>
         {{ Form::select('people_id', \Models\People::pluck('first_name', 'id')->all(),null, ['class' => 'form-control selectpicker', "placeholder"=>"Nama Orang"]) }}  
     </div>
 </div>
 {{ Form::close() }}

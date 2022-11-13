 {{ Form::model($position, ['method' => 'PUT', 'route' => ['position.update', $position->id], 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data']) }}
 <div class="card-body">
     <div class="form-group">
         <label for="name">Nama Seksi</label>
         {{ Form::text('name', old('name'), ['class' => 'form-control', 'id' => 'name', 'placeholder' => 'Nama Seksi', 'rows' => 3]) }}
     </div>
     <div class="form-group">
         <label for="name">Tugas dan Fungsi Seksi</label>
         {{ Form::textarea('description', old('description'), ['class' => 'form-control', 'id' => 'description', 'placeholder' => 'Tugas dan Fungsi Seksi', 'rows' => 3]) }}
     </div>
     <div class="form-group">
         <label for="bg_color">Warna Background</label>
         {{ Form::color('bg_color', old('bg_color'), ['class' => 'form-control', 'id' => 'bg_color', 'placeholder' => 'Background Color','required']) }}
     </div>
 </div>

 {{ Form::close() }}

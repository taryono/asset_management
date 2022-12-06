 {{ Form::model($location, ['method' => 'PUT', 'route' => ['location.update', $location->id], 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data']) }}
 <div class="card-body">
    <div class="row">
        {!! text_div('name', ['class' => 'form-control', 'id' => 'name', 'placeholder' => 'Nama', 'required']) !!}
        {!! select_div('parent_id', ['class' => 'form-control', 'id' => 'parent_id', 'placeholder' => 'Sub Lokasi', 'required'],$location->parent_id, \Models\Location::pluck('name', 'id')->all(), $location->parent_id) !!} 
    </div>
 </div>
 {{ Form::close() }}

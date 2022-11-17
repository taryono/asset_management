 {{ Form::model($location, ['method' => 'PUT', 'route' => ['location.update', $location->id], 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data']) }}
 <div class="card-body">
    <div class="row">
        {!! text_div('name', ['class' => 'form-control', 'id' => 'name', 'placeholder' => 'Nama', 'required']) !!}
    </div>
 </div>
 {{ Form::close() }}

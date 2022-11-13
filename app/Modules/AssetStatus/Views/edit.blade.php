{{ Form::model($asset_status, ['method' => 'PUT', 'route' => ['asset_status.update', $asset_status->id], 'class' => 'form-horizontal']) }}
<div class="card-body">
    <div class="row">
        {!! text_div('name', ['class' => 'form-control', 'placeholder' => 'Nama', 'required']) !!}
        {!! color_div('bg_color', [
            'class' => 'form-control',
            'id' => 'bg_color',
            'placeholder' => 'Background Color',
            'required',
        ]) !!}
    </div>
    {{ Form::close() }}

{{ Form::open(['method' => 'POST', 'route' => ['post_status.store'], 'class' => 'form-horizontal inline', 'enctype' => 'multipart/form-data']) }}
<div class="card-body">
    <div class="row">
        {!! text_div('code', ['class' => 'form-control', 'placeholder' => 'Kode', 'required']) !!}
        <div class="col-lg-12">
            <div class="form-group">
                <label for="name">Status</label>
                {{ Form::text('name', old('name'), ['class' => 'form-control', 'id' => 'name', 'placeholder' => 'Nama Status', 'required']) }}
            </div>
        </div>
        {!! color_div('bg_color', [
            'class' => 'form-control',
            'id' => 'bg_color',
            'placeholder' => 'Background Color',
            'required',
        ]) !!}
    </div>
</div>
{{ Form::close() }}

{{ Form::model($asset_distribution, ['method' => 'PUT', 'route' => ['asset_distribution.update', $asset_distribution->id], 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data']) }}
<div class="card-body">
    <div class="row">
        {!! text_div('name', ['class' => 'form-control', 'placeholder' => 'Nama', 'required', 'id'=> 'name']) !!}
        {!! select_div('user_id', ['class' => 'form-control', 'placeholder' => 'Pilih Nama User', 'required', 'id'=> 'name'], null,App\Models\User::pluck('name', 'id')->all()) !!}
        {!! select_div('asset_id', ['class' => 'form-control', 'placeholder' => 'Pilih Nama Aset', 'required', 'id'=> 'name'], null, Models\Asset::pluck('name', 'id')->all()) !!}
        {!! select_div('location_id', ['class' => 'form-control', 'placeholder' => 'Pilih Lokasi Aset', 'required', 'id'=> 'name'], null, Models\Asset::pluck('name', 'id')->all()) !!}
         
    </div>
</div>
{{ Form::close() }}

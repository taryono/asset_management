{{ Form::model($asset_maintenance, ['method' => 'PUT', 'route' => ['asset_maintenance.update', $asset_maintenance->id], 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data']) }}
<div class="card-body">
    <div class="row">
        {!! select_div(
            'asset_id',
            ['class' => 'form-control selectpicker', 'placeholder' => 'Nama Asset', 'required', 'id' => 'name'],
            null,
            \Models\Asset::pluck('name', 'id')->all(),
        ) !!}
        {!! date_div('start', [
            'class' => 'form-control',
            'id' => 'start',
            'placeholder' => 'Tanggal Servis',
            'required',
        ]) !!}
        {!! date_div('end', [
            'class' => 'form-control',
            'id' => 'end',
            'placeholder' => 'Tanggal Pengambilan',
            'required',
        ]) !!}
        {!! textarea_div('actions', [
            'class' => 'form-control',
            'id' => 'actions',
            'placeholder' => 'Tindakan',
            'required',
            'rows'=> '3'
        ]) !!}
        {!! text_div('cost', [
            'class' => 'form-control amount',
            'id' => 'cost',
            'placeholder' => 'Biaya Servis',
            'required',
        ]) !!}
        {!! select_div(
            'supplier_id',
            ['class' => 'form-control', 'placeholder' => 'Suplier', 'required', 'id' => 'name'],
            null,
            \Models\Supplier::pluck('name', 'id')->all(),
        ) !!}
         {!! textarea_div('description', [
            'class' => 'form-control',
            'id' => 'description',
            'placeholder' => 'Keterangan',
            'required',
            'rows'=> '3'
        ]) !!}
    </div>
</div>
{{ Form::close() }}

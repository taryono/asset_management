{{ Form::open(['method' => 'POST', 'route' => ['asset_purchase.store'], 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data']) }}
<div class="card-body">
    <div class="row">
        {!! text_div('name', ['class' => 'form-control', 'placeholder' => 'Nama', 'required', 'id' => 'name']) !!}
        {!! text_div('price', [
            'class' => 'form-control amount',
            'id' => 'price',
            'placeholder' => 'Harga Asset',
            'required',
        ]) !!}
        {!! select_div(
            'supplier_id',
            [
                'class' => 'form-control selectpicker',
                'id' => 'supplier_id',
                'placeholder' => 'Supplier',
                'required',
            ],
            null,
            \Models\Supplier::pluck('name', 'id')->all(),
        ) !!}
        {!! text_div('qty', [
            'class' => 'form-control amount',
            'id' => 'qty',
            'placeholder' => 'Jumlah',
            'required',
        ]) !!}
    </div>
</div>
{{ Form::close() }}

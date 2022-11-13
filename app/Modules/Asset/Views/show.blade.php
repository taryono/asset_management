<div class="card-body">
    <div class="form-group">
        <div class="col-md-12">
            <label>Nama: </label>
            <label>{{ $asset->name }}</label>
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-12">
            <label>Tipe Asset: </label>
            <label>{{ $asset->asset_type->name }} </label>
        </div>
    </div>
    <div class="form-group">
        {{ $asset->asset_status->name }}
    </div>
    <div class="form-group">
        {{ $asset->asset_category->name }}
    </div>
    <div class="form-group">
        {{ $asset->amount }}
    </div>
    <div class="form-group">
        {{ $asset->price }}
    </div>
    <div class="form-group">
        {{ $asset->description }}
    </div>
</div>

<div class="card card-widget widget-asset_maintenance col-md-4" style="margin: auto;padding-top: 7.5px;">
    <!-- Add the bg color to the header using any of the bg-* classes -->
    <div class="widget-asset_maintenance-header bg-info">
        <h3 class="widget-asset_maintenance-asset_maintenancename">{{ $asset_maintenance->name }}</h3>
        <h5 class="widget-asset_maintenance-desc">Founder &amp; CEO</h5>
    </div>
    <div class="widget-asset_maintenance-image">
        <img src="{{ $asset_maintenance->photo ? $asset_maintenance->photo : asset('assets/images/company.png') }}"
            class="profile-asset_maintenance-img img-fluid img-circle img-responsive image-logo" data-title="{{ $asset_maintenance->name }}"
            onerror="this.src='{{asset('assets/images/company.png') }}'">
    </div>
    <div class="card-footer">
        <div class="row">
            <div class="col-sm-12 border">
                <div class="description-block">
                    <h5 class="description-header">3,200</h5>
                    <span class="description-text">SALES</span>
                </div>
                <!-- /.description-block -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
</div> 
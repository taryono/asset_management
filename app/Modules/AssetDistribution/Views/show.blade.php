<div class="card card-widget widget-asset_distribution col-md-4" style="margin: auto;padding-top: 7.5px;">
    <!-- Add the bg color to the header using any of the bg-* classes -->
    <div class="widget-asset_distribution-header bg-info">
        <h3 class="widget-asset_distribution-asset_distributionname">{{ $asset_distribution->name }}</h3>
        <h5 class="widget-asset_distribution-desc">Founder &amp; CEO</h5>
    </div>
    <div class="widget-asset_distribution-image">
        <img src="{{ $asset_distribution->photo ? $asset_distribution->photo : asset('assets/images/company.png') }}"
            class="profile-asset_distribution-img img-fluid img-circle img-responsive image-logo" data-title="{{ $asset_distribution->name }}"
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
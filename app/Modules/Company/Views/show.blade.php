<div class="card card-widget widget-company col-md-4" style="margin: auto;padding-top: 7.5px;">
    <!-- Add the bg color to the header using any of the bg-* classes -->
    <div class="widget-company-header bg-info">
        <h3 class="widget-company-companyname">{{ $company->name }}</h3>
        <h5 class="widget-company-desc">Founder &amp; CEO</h5>
    </div>
    <div class="widget-company-image">
        <img src="{{ $company->photo ? $company->photo : asset('assets/images/company.png') }}"
            class="profile-company-img img-fluid img-circle img-responsive image-logo" data-title="{{ $company->name }}"
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
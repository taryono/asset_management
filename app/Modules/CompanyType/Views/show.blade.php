<div class="card card-widget widget-company_type col-md-4" style="margin: auto;padding-top: 7.5px;">
    <!-- Add the bg color to the header using any of the bg-* classes -->
    <div class="widget-company_type-header bg-info">
        <h3 class="widget-company_type-company_typename">{{ $company_type->name }}</h3>
        <h5 class="widget-company_type-desc">Founder &amp; CEO</h5>
    </div>
    <div class="widget-company_type-image">
        <img src="{{ $company_type->photo ? $company_type->photo : asset('assets/images/company_type.png') }}"
            class="profile-company_type-img img-fluid img-circle img-responsive image-logo" data-title="{{ $company_type->name }}"
            onerror="this.src='{{asset('assets/images/company_type.png') }}'">
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
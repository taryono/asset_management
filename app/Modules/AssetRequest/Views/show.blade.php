<br>
  <div class="card card-widget widget-asset_request col-md-12" style="margin: auto;padding-top: 7.5px;">
      <!-- Add the bg color to the header using any of the bg-* classes -->
      <div class="widget-asset_request-header bg-info">
          <h3 class="widget-asset_request-asset_typename">{{ $asset_request->name }}</h3>
          <h5 class="widget-asset_request-desc">Founder &amp; CEO</h5>
      </div>
      <div class="widget-asset_request-image">
          <img src="{{ $asset_request->photo ? $asset_request->photo : asset('assets/images/company.png') }}"
              class="profile-asset_request-img img-fluid img-circle img-responsive image-logo" data-title="{{ $asset_request->name }}"
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
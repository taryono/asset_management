<br>
  <div class="card card-widget widget-asset_category col-md-12" style="margin: auto;padding-top: 7.5px;">
      <!-- Add the bg color to the header using any of the bg-* classes -->
      <div class="widget-asset_category-header bg-info">
          <h3 class="widget-asset_category-asset_typename">{{ $asset_category->name }}</h3>
          <h5 class="widget-asset_category-desc">Founder &amp; CEO</h5>
      </div>
      <div class="widget-asset_category-image">
          <img src="{{ $asset_category->photo ? $asset_category->photo : asset('assets/images/company.png') }}"
              class="profile-asset_category-img img-fluid img-circle img-responsive image-logo" data-title="{{ $asset_category->name }}"
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
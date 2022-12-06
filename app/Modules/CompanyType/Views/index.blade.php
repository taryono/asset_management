<div class="row">
    <div class="col-12 col-sm-12">
        <div class="card card-secondary card-tabs">
            <div class="card-header p-0 pt-1">
                <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="custom-tabs-one-company_type-tab" data-toggle="pill"
                            href="#custom-tabs-one-company_type" role="tab" aria-controls="custom-tabs-one-company_type"
                            aria-selected="true">Perusahaan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="custom-tabs-one-company_type-tab" data-toggle="pill"
                            href="#custom-tabs-one-company_type" role="tab" aria-controls="custom-tabs-one-company_type"
                            aria-selected="true">Status Perusahaan</a>
                    </li>  
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content" id="custom-tabs-one-tabContent">
                    <div class="tab-pane fade show active" id="custom-tabs-one-company_type" role="tabpanel"
                        aria-labelledby="custom-tabs-one-company_type-tab"> 
                        @include('CompanyType::list')
                    </div> 
                    <div class="tab-pane fade show" id="custom-tabs-one-company_type" role="tabpanel"
                        aria-labelledby="custom-tabs-one-company_type-tab"> 
                        @include('CompanyType::list')
                    </div> 
                </div>
            </div>
            <!-- /.card -->
        </div>
    </div>
</div> 
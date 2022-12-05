<div class="row">
    <div class="col-12 col-sm-12">
        <div class="card card-secondary card-tabs">
            <div class="card-header p-0 pt-1">
                <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="custom-tabs-one-acl-tab" data-toggle="pill"
                            href="#acl" role="tab" aria-controls="acl" aria-selected="true">ACL</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="custom-tabs-one-menu-tab" data-toggle="pill"
                            href="#custom-tabs-one-menu" role="tab" aria-controls="custom-tabs-one-menu"
                            aria-selected="true">Modul</a>
                    </li>
                    {{-- <li class="nav-item">
                        <a class="nav-link" id="custom-tabs-one-menu_type-tab" data-toggle="pill"
                            href="#custom-tabs-one-menu_type" role="tab"
                            aria-controls="custom-tabs-one-menu_type" aria-selected="true">Tipe Menu</a>
                    </li> --}}
                    <li class="nav-item">
                        <a class="nav-link" id="custom-tabs-one-role-tab" data-toggle="pill"
                            href="#custom-tabs-one-role" role="tab"
                            aria-controls="custom-tabs-one-role" aria-selected="true">Role</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="custom-tabs-one-users-tab" data-toggle="pill"
                            href="#custom-tabs-one-users" role="tab"
                            aria-controls="custom-tabs-one-users" aria-selected="true">User</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="custom-tabs-one-employee-users-tab" data-toggle="pill"
                            href="#custom-tabs-one-employee-users" role="tab"
                            aria-controls="custom-tabs-one-employee-users" aria-selected="true">User employee</a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content" id="custom-tabs-one-tabContent">
                    <div class="tab-pane fade show active" id="acl" role="tabpanel"
                        aria-labelledby="custom-tabs-one-acl-tab">
                        @include('Management::admin.menu_role')
                    </div>
                    <div class="tab-pane fade show" id="custom-tabs-one-menu" role="tabpanel"
                        aria-labelledby="custom-tabs-one-menu-tab">
                        @include('Management::admin.menu')
                    </div>
                    <div class="tab-pane fade show" id="custom-tabs-one-menu_type" role="tabpanel"
                        aria-labelledby="custom-tabs-one-menu_type-tab">
                        @include('Management::admin.menu_type')
                    </div>
                    <div class="tab-pane fade show" id="custom-tabs-one-role" role="tabpanel"
                        aria-labelledby="custom-tabs-one-role-tab">
                        @include('Management::admin.role')
                    </div>
                    <div class="tab-pane fade show" id="custom-tabs-one-users" role="tabpanel"
                        aria-labelledby="custom-tabs-one-users-tab">
                        @include('Management::admin.user')
                    </div>
                    <div class="tab-pane fade show" id="custom-tabs-one-employee-users" role="tabpanel"
                        aria-labelledby="custom-tabs-one-employee-users-tab">
                        @include('Management::admin.user_employee')
                    </div>
                </div>
            </div>
            <!-- /.card -->
        </div>
    </div>
</div>
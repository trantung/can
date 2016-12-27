{{-- <aside class="main-sidebar"> --}}
  <aside class="control-sidebar control-sidebar-light">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ol class="sidebar-menu">

            @if(Admin::isAdmin())
            <li>
                <a href="{{ action('ManagerController@index') }}">
                    <i class="fa fa-users"></i> <span>Quản lý thành viên</span>
                </a>
               {{--  <ul>
                    <li>
                        <a href="{{ action('ManagerController@index') }}">
                            <i class="fa fa-users"></i> <span>Quản lý  thành viên</span>
                        </a>
                    </li>
                </ul> --}}
            </li>
            @endif
            <li>
                <a href="{{ action('HumanResourcesController@index') }}">
                    <i class="fa fa-users"></i> <span>Quản lý nhân sự</span>
                </a>
            </li>
            <li>
                <a href="{{ action('CompanyCategoryController@index') }}">
                    <span>Danh sách Công ty</span>
                </a>
            </li>
            <li>
                <a href="{{ action('BranchCategoryController@index') }}">
                    <span>Danh sách Chi nhánh</span>
                </a>
            </li>
            <li>
                <a href="{{ action('PositionCategoryController@index') }}">
                    <span>Danh sách Vị trí công tác</span>
                </a>
            </li>
            <li>
                <a href="{{ action('ContractCategoryController@index') }}">
                    <span>Danh sách Hợp đồng lao động</span>
                </a>
            </li>
            <li>
                <a href="{{ action('ReligionCategoryController@index') }}">
                    <span>Danh sách Tôn giáo</span>
                </a>
            </li>
            <li>
                <a href="{{ action('EthnicCategoryController@index') }}">
                    <span>Danh sách Dân tộc</span>
                </a>
            </li>
            <li>
                <a href="{{ action('NationalityCategoryController@index') }}">
                    <span>Danh sách Quốc gia vùng lãnh thổ</span>
                </a>
            </li>
            <li>
                <a href="{{ action('IndustryCategoryController@index') }}">
                    <span>Danh sách Ngành nghề</span>
                </a>
            </li>
            <li>
                <a href="{{ action('CertificateCategoryController@index') }}">
                    <span>Danh sách Bằng cấp & chứng chỉ</span>
                </a>
            </li>
        </ol>
    </section>
    <!-- /.sidebar -->
</aside>
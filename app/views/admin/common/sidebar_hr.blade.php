{{-- <aside class="main-sidebar"> --}}
  <aside class="control-sidebar control-sidebar-light">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ol class="sidebar-menu child-menu" id="child-hr">
            <li>
                <a href="{{ action('CompanyCategoryController@index') }}">
                    <span>Cơ cấu tổ chức</span>
                </a>
            </li>
            <li>
                <a href="{{ action('PositionCategoryController@index') }}">
                    <span>Chức danh</span>
                </a>
            </li>
             <li>
                <a href="{{ action('OfficerCategoryController@index') }}">
                    <span>Chức vụ</span>
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
                <a href="{{ action('JobIndustryCategoryController@index') }}">
                    <span>Danh sách Nghành nghề</span>
                </a>
            </li>
            <li>
                <a href="{{ action('IndustryCategoryController@index') }}">
                    <span>Danh sách Quốc gia</span>
                </a>
            </li>
            <li>
                <a href="{{ action('CertificateCategoryController@index') }}">
                    <span>Danh sách Bằng cấp & chứng chỉ</span>
                </a>
            </li>

            <li>
                <a href="{{ action('BonusCategoryController@index') }}">
                    <span>Danh sách kiểu khen thưởng kỷ luật</span>
                </a>
            </li>
            <li>
                <a href="{{ action('BankCategoryController@index') }}">
                    <span>Danh sách Ngân hàng</span>
                </a>
            </li>
            <li>
                <a href="{{ action('CurrencyCategoryController@index') }}">
                    <span>Danh sách tiền tệ</span>
                </a>
            </li>
           {{--  <li>
                <a href="{{ action('SalariesController@index') }}">
                    <span>Lương nhân viên</span>
                </a>
            </li>
            <li>
                <a href="{{ action('InsuranceController@index') }}">
                    <span>Bảo hiểm nhân viên</span>
                </a>
            </li> --}}
        </ol>
        <ol class="child-menu sidebar-menu" id="child-system" style="display: none">
            @if(Admin::isAdmin())
           {{--  <li>
                <a href="{{ action('ManagerController@index') }}">
                    <i class="fa fa-users"></i> <span>Quản lý thành viên</span>
                </a>
                <ul>
                    <li>
                        <a href="{{ action('ManagerController@index') }}">
                            <i class="fa fa-users"></i> <span>Quản lý  thành viên</span>
                        </a>
                    </li>
                </ul>
            </li> --}}
            @endif
             <li>
                <a href="{{ action('PermissionController@index') }}">
                    <span>Cài đặt quyền</span>
                </a>
            </li>
            <li>
                <a href="{{ action('PermissionController@indexUser') }}">
                    <span>Cài đặt quyền cho user</span>
                </a>
            </li>
            <li>
                <a href="{{ action('ConfigUserController@index') }}">
                    <span>Cài đặt user với hồ sơ</span>
                </a>
            </li>
        </ol>

        <ol class="child-menu sidebar-menu" id="child-salary"  style="display: none">
            {{-- <li>
                <a href="{{ action('SalariesController@index') }}" >
                    <span>Lương nhân viên</span>
                </a>
            </li> --}}
            <li>
                <a href="{{ action('SalariesCategoryController@index') }}">
                    <span>Danh sách Kiểu lương</span>
                </a>
            </li>
        </ol>
        <ol class="child-menu sidebar-menu" id="child-insuance"  style="display: none">
            {{-- <li>
                <a href="{{ action('InsuranceController@index') }}" >
                    <span>Bảo hiểm nhân viên</span>
                </a>
            </li> --}}
        </ol>

         <ol class="child-menu sidebar-menu" id="child-statistic"  style="display: none">
            <li>
                <a href="{{ action('InsuranceController@statistics') }}" >
                    <span>Thống kê Bảo hiểm nhân viên</span>
                </a>
            </li>
            <li>
                <a href="{{ action('HumanResourcesController@birthdaySearch') }}" >
                    <span>Danh sách sinh nhật nhân viên</span>
                </a>
            </li>
        </ol>
    </section>
    <!-- /.sidebar -->
</aside>

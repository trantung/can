 <ol class="sidebar-menu child-menu" id="child-hr">

    <li>
        <a href="{{ action('HumanResourcesController@index') }}">
            <i class="fa fa-users"></i> <span>Danh sách nhân viên</span>
        </a>
    </li>
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
    {{-- <li>
        <a href="{{ action('NationalityCategoryController@index') }}">
            <span>Danh sách Quốc gia vùng lãnh thổ</span>
        </a>
    </li> --}}
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

    <li>
        <a href="{{ action('BonusCategoryController@index') }}">
            <span>Danh sách kiểu khen thưởng kỷ luật</span>
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
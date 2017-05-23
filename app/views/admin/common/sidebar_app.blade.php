  <aside class="control-sidebar control-sidebar-light">
    <section class="sidebar">
        <ol class="sidebar-menu child-menu" id="child-hr">
            <li>
                <a href="{{ action('ProductManagerController@index') }}">
                    <span>Cấu hình sản phẩm</span>
                </a>
            </li>
            <li>
                <a href="{{ action('WarehouseController@index') }}">
                    <span>Danh sách kho</span>
                </a>
            </li>
            <li>
                <a href="{{ action('ProductionAutoController@index') }}">
                    <span>Tự sản xuất</span>
                </a>
            </li>
            <li>
                <a href="{{ action('ProductCategoryController@index') }}">
                    <span>Danh sách nguyên liệu</span>
                </a>
            </li>
            <li>
                <a href="{{ action('ProductController@index') }}">
                    <span>Danh sách thành phẩm</span>
                </a>
            </li>
            <li>
                <a href="{{ action('ProductionLossController@index') }}">
                    <span>Hao hụt sản xuất</span>
                </a>
            </li>
            <li>
                <a href="{{ action('StorageLossController@index') }}">
                    <span>Hao hụt lưu kho</span>
                </a>
            </li>
            <li>
                <a href="{{ action('ScaleStationController@index') }}">
                    <span>Quản lý trạm cân</span>
                </a>
            </li>
        </ol>
    </section>
</aside>

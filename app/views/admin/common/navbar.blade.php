<header class="main-header">
  <!-- Logo -->
  <a href="#" class="logo">
    <!-- mini logo for sidebar mini 50x50 pixels -->
    <span class="logo-mini">HR</span>
    <!-- logo for regular state and mobile devices -->
    <span class="logo-lg">HR-Pro</span>
  </a>
  <!-- Header Navbar: style can be found in header.less -->
  <nav class="navbar navbar-static-top" role="navigation">
    <!-- Sidebar toggle button-->
      @if ( Common::hasRoleNhansu() )
        <ul class="nav navbar-nav">
          <li>
              <a href="javascript: void(0)" id="hr-menu">
                  <i class="fa fa-users"></i> <span>Quản lý nhân sự</span>
              </a>
          </li>
          <li>
              <a href="javascript: void(0)" id="salary-menu">
                  <span>Lương </span>
              </a>
          </li>
          <li>
              <a href="javascript: void(0)" id="insuance-menu">
                  <span>Bảo hiểm</span>
              </a>
          </li>
          <li>
              <a href="javascript: void(0)" id="system-menu">
                  <span>Cài đặt hệ thống</span>
              </a>
          </li>
          <li>
              <a href="javascript: void(0)" id="system-statistic" data-toggle="control-sidebar">
                  <span>Thống kê</span>
              </a>
          </li>
        </ul>
      @endif
      

    <div class="navbar-custom-menu">
      <ul class="nav navbar-nav">

        <li class="user">
          <a href="#"><i class="fa fa-user"></i>{{ Auth::admin()->get()->username }}</a>
        </li>

        <li class="user">
        	<a href="{{ action('ManagerController@edit', Auth::admin()->get()->id) }}"><i class="fa fa-user"></i>Tài khoản</a>
        </li>

        <li class="user">
        	<a href="{{ action('AdminController@logout') }}"><i class="fa fa-power-off"></i>Đăng xuất</a>
        </li>
        <li><a href="#" data-toggle="control-sidebar"> <span class="sr-only">Menu</span> </a></li>
        <li>
            <a href="#" class="sidebar-toggle" data-toggle="control-sidebar" role="button">
              <span class="sr-only">Menu</span>
            </a>
        </li>

      </ul>
    </div>
  </nav>
</header>
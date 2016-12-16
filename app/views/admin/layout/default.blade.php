<!DOCTYPE html>
<html>
@include('admin.common.header')
<body class="hold-transition skin-green-light sidebar-mini">
<div class="wrapper">

  @include('admin.common.navbar')

  <!-- Left side column. contains the logo and sidebar -->
  {{-- @include('admin.common.sidebar') --}}

  <!-- Content Wrapper. Contains page content -->
  <div class="container-fluid">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
		  @yield('title')
        {{-- <small>Control panel</small> --}}
      </h1>
      <!-- <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol> -->
    </section>

    <!-- Main content -->
    <section class="container-fluid">
    	<!-- Notifications: message/alert/waring -->
    	@include('admin.common.message')
    	<!-- ./ notifications: message/alert/waring -->
		<!-- Content -->
    	@yield('content')
    	<!-- ./ content -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="container-fluid">
    <div class="col-xs-12">
        <div class="pull-right hidden-xs">
          <b>Version</b> 1.0.0
        </div>
        <strong>Copyright &copy; 2016</strong>

    </div>
  </footer>

</div>
<!-- ./wrapper -->

  <!-- Left side column. contains the logo and sidebar -->
  @include('admin.common.sidebar')
{{-- @include('admin.common.footer') --}}
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</body>
</html>
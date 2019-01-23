<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Projects</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="{{asset('dashboard/bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
  <link rel="stylesheet" href="{{asset('dashboard/bower_components/font-awesome/css/font-awesome.min.css')}}">
  <link rel="stylesheet" href="{{asset('dashboard/bower_components/Ionicons/css/ionicons.min.css')}}">
  <link rel="stylesheet" href="{{asset('dashboard/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
  <link rel="stylesheet" href="{{asset('dashboard/dist/css/AdminLTE.min.css')}}">
  <link rel="stylesheet" href="{{asset('dashboard/dist/css/skins/_all-skins.min.css')}}">
  <link rel="stylesheet" href="{{asset('dashboard/bower_components/morris.js/morris.css')}}">
  <link rel="stylesheet" href="{{asset('dashboard/bower_components/jvectormap/jquery-jvectormap.css')}}">
  <link rel="stylesheet" href="{{asset('dashboard/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}">
  <link rel="stylesheet" href="{{asset('dashboard/bower_components/bootstrap-daterangepicker/daterangepicker.css')}}">
  <link rel="stylesheet" href="{{asset('dashboard/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')}}">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-purple sidebar-mini">
<div class="wrapper">

  <header class="main-header" >
    <!-- Logo -->
  <a href="{{url('')}}" class="logo"> 
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>ITV</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>ITVME</b>LLC</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <?php
      use Carbon\Carbon;
      $user                 = Auth::user();
      $date                 = Carbon::parse("$user->created_at", 'UTC');
      $user->membershipDate = $date->format('d M o @ h:m:s a'); 
      ?>
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
         
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="{{asset('dashboard/dist/img/default.png')}}" class="user-image" alt="User Image">
            <span class="hidden-xs">{{$user->name}}</span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="{{asset('dashboard/dist/img/defaultx.png')}}" class="img-circle" alt="User Image">
                <p>
                  {{$user->name}}
                <small>Member since {{$user->membershipDate}}</small>
                </p>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                <a href="{{url('admin/profile')}}" class="btn btn-success btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                <a href="{{url('logout')}}" class="btn btn-success btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>
 <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel">
            <div class="pull-left image">
              <img src="{{asset('dashboard/dist/img/defaultx.png')}}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
              <p>{{ $user->name }}</p>
              <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
          </div>
          <!-- /.search form -->
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu" data-widget="tree">
          @if($user->role == 'developer' || $user->role == 'admin')
          <li class="header"><b>System Control</b></li>
          @endif
            @if($user->role == 'developer')
            <li><a href="{{url('admin/admins')}}"><i class="fa fa-users fa-lg"></i> <span>System users</span></a></li>
            @endif
            @if($user->role == 'developer' || $user->role == 'admin')
            <li><a href="{{url('admin/customers')}}"><i class="fa fa-list fa-lg"></i> <span>Customers</span></a></li>
            <li><a href="{{url('admin/projects')}}"><i class="fa fa-building fa-lg"></i> <span>Projects</span></a></li>
            <li><a href="{{url('admin/emails')}}"><i class="fa fa-warning fa-lg"></i> <span>Alert List</span></a></li>
            @endif
            <li class="header">System Data</li>
            @if($user->role=='engineer')
            <li><a href="{{url('admin/my_reports')}}"><i class="fa fa-list fa-lg"></i> <span>My Reports</span></a></li>
            @endif

            @if($user->role == 'developer' || $user->role == 'admin')
            <li><a href="{{url('admin/engineer_reports')}}"><i class="fa fa-file fa-lg"></i> <span>Engineer Reports</span></a></li>
            <li><a href="{{url('admin/generate_report')}}"><i class="fa fa-plus fa-lg"></i> <span>Create Report</span></a></li>
            @endif
          </ul>
        </section>
        <!-- /.sidebar -->
</aside>
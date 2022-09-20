<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>IMS - @yield('pageTitle')</title>

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/chart.js/Chart.min.css') }}">
    
    <!-- Tempusdominus Bbootstrap 4 -->
    <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <!-- Bootstrap4 Duallistbox -->
    <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css') }}">
    {{-- Timepicker --}}
    <link href="{{ asset('css/bootstrap-timepicker.min.css') }}" rel="stylesheet" media="all">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('AdminLTE/dist/css/adminlte.min.css') }}">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet"> 

    <!-- Jquery JS-->
    <script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
    {{-- Timepicker --}}
    <script src="{{ asset('js/bootstrap-timepicker.min.js') }}"></script>
    <!-- Select2 -->
    <script src="{{ asset('AdminLTE/plugins/select2/js/select2.full.min.js') }}"></script>
    {{-- Jquery validate --}}
    <script src="{{ asset('js/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('js/additional-methods.min.js') }}"></script>
</head>
 
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">

    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-dark navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="#" class="nav-link">Home</a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="#" class="nav-link">Contact</a>
                </li>

            </ul>


            <!-- SEARCH FORM -->
            <form class="form-inline ml-3">
                <div class="input-group input-group-sm">
                    <input class="form-control form-control-navbar" type="search" placeholder="Search"
                        aria-label="Search">
                    <div class="input-group-append">
                        <button class="btn btn-navbar" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </form>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                    @endif

                    {{-- @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif --}}
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                            <a class="dropdown-item" href="{{ route('users.changePassword', [Auth::user()->id]) }}">
                                Change Password
                            </a>
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>
                        </div>
                    </li>
                @endguest
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="#" class="brand-link">
                <img src="{{ asset('AdminLTE/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
                    class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">UKICSEL</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="true">
                        <!-- Add icons to the links using the .nav-icon class
                        with font-awesome or any other icon font library -->
                        <li class="nav-item has-treeview">
                            <a href="/dashboard" class="nav-link {{ (request()->is('dashboard*')) ? 'active' : '' }}">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Dashboard
                                    <i class="right fas fa-angle-right"></i>
                                </p>
                            </a>

                        </li>

                        {{-- Management menu --}}
                        <li class="nav-item has-treeview {{ (request()->is('courses*')) || (request()->is('courseNames*')) || (request()->is('shifts*'))
                            || (request()->is('employees*')) || (request()->is('designations*')) || (request()->is('exams*')) || (request()->is('examTypes*'))
                            || (request()->is('fees*')) || request()->is('fee_types*') || (request()->is('batches*'))
                            || (request()->is('salaries*')) ? 'active menu-open' : '' }}">
                            <a href="#" class="nav-link {{ (request()->is('courses*')) || (request()->is('courseNames*')) || (request()->is('shifts*'))
                                || (request()->is('employees*')) || (request()->is('designations*')) || (request()->is('exams*')) || (request()->is('examTypes*'))
                                || (request()->is('fees*')) || request()->is('fee_types*') || (request()->is('batches*'))
                                || (request()->is('salaries*')) ? 'active menu-open' : '' }}">
                                <i class="nav-icon fas fa-wrench"></i>
                                <p>
                                    Management
                                    <i class="right fas fa-angle-right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">                                

                                {{-- Courses menu --}}
                                <li class="nav-item has-treeview {{ (request()->is('courseNames*')) ? 'active' : '' }}">
                                    <a href="{{ route('courseNames.index') }}" class="nav-link {{ (request()->is('courseNames*'))  ? 'active menu-open' : '' }}">
                                        <i class="nav-icon fas "></i>
                                        <p>
                                            Courses
                                            <i class="right fas fa-angle-right"></i>
                                        </p>
                                    </a>
                                    
                                </li>

                                {{-- Sessions menu --}}
                                <li class="nav-item has-treeview {{ (request()->is('courses*')) ? 'active' : '' }}">
                                    <a href="{{ route('courses.index') }}" class="nav-link {{ (request()->is('courses*')) ? 'active menu-open' : '' }}">
                                        <i class="nav-icon fas "></i>
                                        <p>
                                            Sessions
                                            <i class="right fas fa-angle-right"></i>
                                        </p>
                                    </a>
                                    
                                </li>

                                {{-- Batches menu --}}
                                <li class="nav-item has-treeview {{ (request()->is('batches*')) ? 'active' : '' }}">
                                    <a href="{{ route('batches.index') }}" class="nav-link {{ (request()->is('batches*')) ? 'active menu-open' : '' }}">
                                        <i class="nav-icon fas "></i>
                                        <p>
                                            Batches
                                            <i class="right fas fa-angle-right"></i>
                                        </p>
                                    </a>
                                    
                                </li>

                                {{-- Shifts menu --}}
                                <li class="nav-item has-treeview {{ (request()->is('shifts*')) ? 'active' : '' }}">
                                    <a href="{{ route('shifts.index') }}" class="nav-link {{ (request()->is('shifts*')) ? 'active menu-open' : '' }}">
                                        <i class="nav-icon fas "></i>
                                        <p>
                                            Shifts
                                            <i class="right fas fa-angle-right"></i>
                                        </p>
                                    </a>
                                    
                                </li>

                                {{-- Staff menu --}}
                                <li class="nav-item has-treeview {{ (request()->is('employees*')) || (request()->is('designations*')) ? 'active menu-open' : '' }}">
                                    <a href="#" class="nav-link {{ (request()->is('employees*')) || (request()->is('designations*')) ? 'active menu-open' : '' }}">
                                        <i class="nav-icon fas"></i>
                                        <p>
                                            Staff
                                            <i class="right fas fa-angle-right"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="{{ route('designations.index') }}" class="nav-link" style="margin-left: 25px;">
                                                <i class="fas fa-angle-right nav-icon"></i>
                                                {{-- <p>Designations List</p> --}}
                                                <p>Add Designation</p>
                                            </a>
                                        </li>
                                        
                                        <li class="nav-item">
                                            <a href="{{ route('employees.index') }}" class="nav-link" style="margin-left: 25px;">
                                                <i class="fas fa-angle-right nav-icon"></i>
                                                {{-- <p>Staff List</p> --}}
                                                <p>Add New Staff</p>
                                            </a>
                                        </li>
                                        
        
                                    </ul>
                                </li>

                                {{-- Fee menu --}}
                                <li class="nav-item has-treeview {{ (request()->is('fees*')) || (request()->is('fee_types*')) ? 'active menu-open' : '' }}">
                                    <a href="#" class="nav-link {{ (request()->is('fees*')) || (request()->is('fee_types*')) ? 'active menu-open' : '' }}">
                                        <i class="nav-icon fas "></i>
                                        <p>
                                            Fee
                                            <i class="right fas fa-angle-right"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="{{ route('fee_types.index') }}" class="nav-link" style="margin-left: 25px;">
                                                <i class="fas fa-angle-right nav-icon"></i>
                                                <p>Add New FeeType</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{ route('feetypes.addfee') }}" class="nav-link" style="margin-left: 25px;">
                                                <i class="fas fa-angle-right nav-icon"></i>
                                                <p>Add New Fee</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{ route('fees.create') }}" class="nav-link" style="margin-left: 25px;">
                                                <i class="fas fa-angle-right nav-icon"></i>
                                                <p>Collect Fee</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{ route('fees.index') }}" class="nav-link" style="margin-left: 25px;">
                                                <i class="fas fa-angle-right nav-icon"></i>
                                                <p>Fee List</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>

                                {{-- Exam menu --}}
                                <li class="nav-item has-treeview {{ (request()->is('exams*')) || (request()->is('examTypes*')) ? 'active menu-open' : '' }}">
                                    <a href="#" class="nav-link {{ (request()->is('exams*')) || (request()->is('examTypes*')) ? 'active menu-open' : '' }}">
                                        <i class="nav-icon fas "></i>
                                        <p>
                                            Exam
                                            <i class="right fas fa-angle-right"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="{{ route('examTypes.index') }}" class="nav-link" style="margin-left: 25px;">
                                                <i class="fas fa-angle-right nav-icon"></i>
                                                <p>Add New Exam Type</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{ route('exams.create') }}" class="nav-link" style="margin-left: 25px;">
                                                <i class="fas fa-angle-right nav-icon"></i>
                                                <p>Add New Exam</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{ route('exams.index') }}" class="nav-link" style="margin-left: 25px;">
                                                <i class="fas fa-angle-right nav-icon"></i>
                                                <p>Exams List</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>

                                {{-- Certificates menu --}}
                                <li class="nav-item has-treeview">
                                    <a href="#" class="nav-link">
                                        <i class="nav-icon fas "></i>
                                        <p>
                                            Certificates
                                            <i class="right fas fa-angle-right"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="{{ route('certTypes.index') }}" class="nav-link" style="margin-left: 25px;">
                                                <i class="fas fa-angle-right nav-icon"></i>
                                                <p>Add Certificate Type</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{ route('certificates.create') }}" class="nav-link" style="margin-left: 25px;">
                                                <i class="fas fa-angle-right nav-icon"></i>
                                                <p>Issue Certificate</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{ route('certificates.index') }}" class="nav-link" style="margin-left: 25px;">
                                                <i class="fas fa-angle-right nav-icon"></i>
                                                <p>Certificates List</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>

                                {{-- ID Card menu --}}
                                <li class="nav-item has-treeview">
                                    <a href="#" class="nav-link">
                                        <i class="nav-icon fas "></i>
                                        <p>
                                            ID Card
                                            <i class="right fas fa-angle-right"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="#" class="nav-link" style="margin-left: 25px;">
                                                <i class="fas fa-angle-right nav-icon"></i>
                                                <p>ID Card Templates</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#" class="nav-link" style="margin-left: 25px;">
                                                <i class="fas fa-angle-right nav-icon"></i>
                                                <p>Students ID Card</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#" class="nav-link" style="margin-left: 25px;">
                                                <i class="fas fa-angle-right nav-icon"></i>
                                                <p>Employees ID Card</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                
                                {{-- Salary menu --}}
                                <li class="nav-item has-treeview {{ (request()->is('salaries*'))  ? 'active menu-open' : '' }}">
                                    <a href="#" class="nav-link {{ (request()->is('salaries*'))  ? 'active menu-open' : '' }}">
                                        <i class="nav-icon fas "></i>
                                        <p>
                                            Salary
                                            <i class="right fas fa-angle-right"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="{{ route('salaries.index') }}" class="nav-link" style="margin-left: 25px;">
                                                <i class="fas fa-angle-right nav-icon"></i>
                                                <p>Add Salary</p>
                                            </a>
                                        </li>
                                        
                                    </ul>
                                </li>
                            </ul>
                        </li>

                        {{-- Admissions menu --}}
                        <li class="nav-item has-treeview {{ (request()->is('students/create*')) || (request()->is('cities/create*')) || (request()->is('education/create*')) ? 'active menu-open' : '' }}">
                            <a href="#" class="nav-link {{ (request()->is('students/create*')) || (request()->is('cities/create*')) || (request()->is('education/create*')) ? 'active menu-open' : '' }}">
                                <i class="nav-icon fas fa-graduation-cap"></i>
                                <p>
                                    Admission
                                    <i class="right fas fa-angle-right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('students.create') }}" class="nav-link {{ (request()->is('students/create*')) ? 'active' : '' }}">
                                        <i class="fas fa-angle-right nav-icon"></i>
                                        <p>New Admission</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('cities.create') }}" class="nav-link {{ (request()->is('cities/create*')) ? 'active' : '' }}">
                                        <i class="fas fa-angle-right nav-icon"></i>
                                        <p>Add City</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('education.create') }}" class="nav-link {{ (request()->is('education/create*')) ? 'active' : '' }}">
                                        <i class="fas fa-angle-right nav-icon"></i>
                                        <p>Add Education</p>
                                    </a>
                                </li>

                            </ul>

                        </li>                     

                        {{-- Students menu --}}
                        <li class="nav-item has-treeview {{ (request()->is('students')) ? 'active menu-open' : '' }}">
                            <a href="#" class="nav-link {{ (request()->is('students')) ? 'active menu-open' : '' }}">
                                <i class="nav-icon fas fa-graduation-cap"></i>
                                <p>
                                    Students
                                    <i class="right fas fa-angle-right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('students.index') }}" class="nav-link {{ (request()->is('students')) ? 'active' : '' }}">
                                        <i class="fas fa-angle-right nav-icon"></i>
                                        <p>Students List</p>
                                    </a>
                                </li>
                            </ul>

                        </li>

                        {{-- Students Signup menu --}}
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-circle"></i>
                                <p>
                                    Students Signup
                                    <i class="right fas fa-angle-right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="fas fa-angle-right nav-icon"></i>
                                        <p>Add Student Name</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="fas fa-angle-right nav-icon"></i>
                                        <p>Students Login List</p>
                                    </a>
                                </li>
                                
                            </ul>
                        </li>

                        {{-- Events menu --}}
                        <li class="nav-item has-treeview {{ (request()->is('events')) ? 'active menu-open' : '' }}">
                            <a href="#" class="nav-link {{ (request()->is('events')) ? 'active menu-open' : '' }}">
                                <i class="nav-icon fas fa-circle"></i>
                                <p>
                                    Events
                                    <i class="right fas fa-angle-right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('events.index') }}" class="nav-link {{ (request()->is('events')) ? 'active' : '' }}">
                                        <i class="fas fa-angle-right nav-icon"></i>
                                        <p>Add Event</p>
                                    </a>
                                </li>                                
                            </ul>
                        </li>

                        {{-- Messages menu --}}
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-circle"></i>
                                <p>
                                    Messages
                                    <i class="right fas fa-angle-right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="fas fa-angle-right nav-icon"></i>
                                        <p>Employee Message</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="fas fa-angle-right nav-icon"></i>
                                        <p>Students Message</p>
                                    </a>
                                </li>
                                
                            </ul>
                        </li>

                        {{-- Reports menu --}}
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-circle"></i>
                                <p>
                                    Reports
                                    <i class="right fas fa-angle-right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="fas fa-angle-right nav-icon"></i>
                                        <p>Fee Reports</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="fas fa-angle-right nav-icon"></i>
                                        <p>Attendance Reports</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="fas fa-angle-right nav-icon"></i>
                                        <p>Financial Reports</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="fas fa-angle-right nav-icon"></i>
                                        <p>Salary Reports</p>
                                    </a>
                                </li>

                            </ul>
                        </li>

                        {{-- Expenses menu --}}
                        <li class="nav-item has-treeview {{ (request()->is('expenses')) || (request()->is('expense_types')) ? 'active menu-open' : '' }}">
                            <a href="#" class="nav-link {{ (request()->is('expenses')) || (request()->is('expense_types')) ? 'active menu-open' : '' }}">
                                <i class="nav-icon fas fa-circle"></i>
                                <p>
                                    Expenses
                                    <i class="right fas fa-angle-right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('expense_types.index') }}" class="nav-link {{ (request()->is('expense_types')) ? 'active' : '' }}">
                                        <i class="fas fa-angle-right nav-icon"></i>
                                        <p>Add Expenses Heading</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('expenses.index') }}" class="nav-link {{ (request()->is('expenses')) ? 'active' : '' }}">
                                        <i class="fas fa-angle-right nav-icon"></i>
                                        <p>Add Expenses</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>

                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0 text-dark">@yield('pageTitle')</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            {{-- <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">@yield('pageTitle2')</li>
                            </ol> --}}
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    @yield('content')
                </div>
                <!--/. container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->

        <!-- Main Footer -->
        <footer class="main-footer">
            <strong>Copyright &copy; 2021 <a href="#">UKICSEL</a>.</strong>
            All rights reserved.
            {{-- <div class="float-right d-none d-sm-inline-block">
    </div> --}}
        </footer>
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->
    <!-- jQuery -->
    {{-- <script src="{{ asset('AdminLTE/plugins/jquery/jquery.min.js') }}"></script> --}}
    <!-- Bootstrap -->
    <script src="{{ asset('AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>


    <!-- overlayScrollbars -->
    <script src="{{ asset('AdminLTE/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
    <!-- DataTables -->
    <script src="{{ asset('AdminLTE/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('AdminLTE/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('AdminLTE/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('AdminLTE/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>

    <!-- Bootstrap4 Duallistbox -->
    <script src="{{ asset('AdminLTE/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js') }}"></script>
    <!-- InputMask -->
    <script src="{{ asset('AdminLTE/plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('AdminLTE/plugins/inputmask/min/jquery.inputmask.bundle.min.js') }}"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{ asset('AdminLTE/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
    {{-- Sweet Alert JS --}}
    <script src="{{ asset('js/sweetalert.min.js') }}"></script>

    <!-- AdminLTE App -->
    <script src="{{ asset('AdminLTE/dist/js/adminlte.js') }}"></script>

    <!-- OPTIONAL SCRIPTS -->
    <script src="{{ asset('AdminLTE/dist/js/demo.js') }}"></script>

    <!-- PAGE PLUGINS -->
    <!-- jQuery Mapael -->
    <script src="{{ asset('AdminLTE/plugins/jquery-mousewheel/jquery.mousewheel.js') }}"></script>
    <script src="{{ asset('AdminLTE/plugins/raphael/raphael.min.js') }}"></script>
    <script src="{{ asset('AdminLTE/plugins/jquery-mapael/jquery.mapael.min.js') }}"></script>
    <script src="{{ asset('AdminLTE/plugins/jquery-mapael/maps/usa_states.min.js') }}"></script>
    <!-- ChartJS -->
    <script src="{{ asset('AdminLTE/plugins/chart.js/Chart.min.js') }}"></script>

    <!-- PAGE SCRIPTS -->
    {{-- <script src="{{ asset('AdminLTE/dist/js/pages/dashboard2.js') }}"></script> --}}
    <script>
        $(document).ready(function() {

            // jquery data table
            $(function() {
                $("#example1").DataTable({
                    "responsive": true,
                    "autoWidth": false,
                });
            });

            // for post method
            $('.delete-confirm').click(function(event) {
                var form = $(this).closest("form");
                var name = $(this).data("name");
                event.preventDefault();
                swal({
                        title: `Are you sure to delete this record?`,
                        text: "This record and its related data will be permanantly deleted!",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) {
                            form.submit();
                        }
                    });
            });

            //Initialize Select2 Elements
            $('.select2').select2({
                width: '100%'
            })

            //Initialize Select2 Elements
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            })

        });
    </script>
    @if (Session::has('success'))
        <script>
            swal("Great Job!", "{!! Session::pull('success') !!}", "success", {
                button: "OK",
                closeOnClickOutside: true,
            });
        </script>
    @endif

    @if (Session::has('error'))
        <script>
            swal("Sorry!", "{!! Session::pull('error') !!}", "error", {
                button: "OK",
                closeOnClickOutside: true,
            });
        </script>
    @endif
</body>

</html>

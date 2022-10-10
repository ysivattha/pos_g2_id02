<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title', config('app.name')) | CMS System</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css')}}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('css/adminlte.min.css')}}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
   
    <link rel="stylesheet" href="{{asset('css/custom.css')}}">
    @yield('css')
</head>
<body class="hold-transition sidebar-mini layout-fixed layout-footer-fixed">
    <div class="wrapper">
         <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-primary">
            <a class="nav-link text-light" data-widget="pushmenu" href="#" role="button">
                <i class="fas fa-bars"></i>
            </a>
            <strong class="text-light">
                @yield('header', config('app.name'))
            </strong>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
            <!-- Notifications Dropdown Menu -->
            <li class="nav-item dropdown">
                <a class="nav-link text-light" data-toggle="dropdown" href="#">
                    <img src="{{asset(@Auth::user()->photo)}}" alt="" width="27" height="25"
                        class="brand-image img-circle elevation-3 mr-2">
                    {{@Auth::user()->username}} <i class="right fas fa-caret-down"></i>
                </a>
                
                <div class="dropdown-menu dropdown-menu-right">
                    <a href="{{url('lang/km')}}" class="dropdown-item">
                        <img src="{{asset('img/khmer.png')}}" alt="" width="20"> ភាសាខ្មែរ
                    </a>
                    <a href="{{url('lang/en')}}" class="dropdown-item">
                        <img src="{{asset('img/english.png')}}" alt="" width="20"> English
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="{{route('user.profile')}}" class="dropdown-item">
                        <i class="fas fa-id-card mr-2 text-success"></i> {{__('lb.profile')}}
                    </a>
                    <a href="{{route('user.logout')}}" class="dropdown-item">
                        <i class="fas fa-sign-out-alt mr-2 text-danger"></i> {{__('lb.logout')}}
                    </a>
                </div>
            </li>
            
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="{{url('/')}}" class="brand-link">
            <img src="{{asset('img/logo.png')}}" alt="" class="brand-image img-circle elevation-3">
            <span class="brand-text font-weight-bold">{{__('lb.cms_system')}}</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" id="sidebar"
                        role="menu" data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
                        with font-awesome or any other icon font library -->
                        <li class="nav-item" >
                            <a href="#" class="nav-link" id="menu_home">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                {{__('lb.dashboard')}}
                            </p>
                            </a>
                        </li>

                        <li class="nav-item has-treeview" id='menu_stock'>
                            <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-warehouse"></i>
                            <p>
                                {{__('lb.leftmenu_stock')}}
                                <i class="fas fa-angle-left right"></i>
                            </p>
                            </a>
                            <ul class="nav nav-treeview" id='stock_collapse'>
                                
                                <li class="nav-item">
                                    <a href="{{ route('product.index') }}" class="nav-link" id="menu_item">
                                        <i class="fas fa-angle-double-right nav-icon ml-3"></i> 
                                       Item {{-- {{__('lb.users')}} --}}
                                    </a>
                                </li>
                              
                                <li class="nav-item">
                                    <a href="{{ route('stockin.index') }}" class="nav-link" id='menu_stockin'>
                                        <i class="fas fa-angle-double-right nav-icon ml-3"></i> 
                                       Stock In {{-- {{__('lb.roles')}} --}}
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="{{ route('stockout.index') }}" class="nav-link" id='menu_stockout'>
                                        <i class="fas fa-angle-double-right nav-icon ml-3"></i> 
                                       Stock Out {{-- {{__('lb.roles')}} --}}
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('stock_balance.index') }}" class="nav-link" id='menu_stockbalance'>
                                        <i class="fas fa-angle-double-right nav-icon ml-3"></i> 
                                       Stock Balance {{-- {{__('lb.roles')}} --}}
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="{{ route('cat.index') }}" class="nav-link" id='menu_cat'>
                                        <i class="fas fa-angle-double-right nav-icon ml-3"></i> 
                                      Category {{-- {{__('lb.roles')}} --}}
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="{{ route('unit.index') }}" class="nav-link" id='menu_unit'>
                                        <i class="fas fa-angle-double-right nav-icon ml-3"></i> 
                                       Unit {{-- {{__('lb.roles')}} --}}
                                    </a>
                                </li>
                          
                            </ul>
                        </li>

                        <li class="nav-item has-treeview" id='menu_customer'>
                            <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-users"></i>
                            <p>
                                {{__('lb.leftmenu_customer')}}
                                <i class="fas fa-angle-left right"></i>
                            </p>
                            </a>
                            <ul class="nav nav-treeview" id='security_collapse'>
                                
                                <li class="nav-item">
                                    <a href="{{ route('customer.index') }}" class="nav-link" id="menu_sub_customer">
                                        <i class="fas fa-angle-double-right nav-icon ml-3"></i> 
                                       Customer {{-- {{__('lb.users')}} --}}
                                    </a>
                                </li>
                              
                                <li class="nav-item">
                                    <a href="{{ route('type.index') }}" class="nav-link" id='menu_type_customer'>
                                        <i class="fas fa-angle-double-right nav-icon ml-3"></i> 
                                       Type Customer {{-- {{__('lb.roles')}} --}}
                                    </a>
                                </li>

         

                          
                            </ul>
                        </li>

                        <li class="nav-item" >
                            <a href="#" class="nav-link" id="menu_sale">
                            <i class="nav-icon fas fa-angle-double-right "></i>
                            <p>
                                {{__('lb.leftmenu_sale')}}
                            </p>
                            </a>
                        </li>

                        <li class="nav-item has-treeview" id='menu_supplier'>
                            <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-user-friends"></i>
                            <p>
                                {{__('lb.leftmenu_supplier')}}
                                <i class="fas fa-angle-left right"></i>
                            </p>
                            </a>
                            <ul class="nav nav-treeview" id='supplier_collapse'>
                                
                                <li class="nav-item">
                                    <a href="{{ route('supplier.index') }}" class="nav-link" id="menu_sub_supplier">
                                        <i class="fas fa-angle-double-right nav-icon ml-3"></i> 
                                       Supplier
                                    </a>
                                </li>
                              
                                <li class="nav-item">
                                    <a href="{{ route('supplier-type.index') }}" class="nav-link" id='menu_type_supplier'>
                                        <i class="fas fa-angle-double-right nav-icon ml-3"></i> 
                                       Type Supplier
                                    </a>
                                </li>

         

                          
                            </ul>
                        </li>

                        <li class="nav-item" >
                            <a href="#" class="nav-link" id="menu_stock_in">
                            <i class="nav-icon fas fa-angle-double-right "></i>
                            <p>
                                {{__('lb.leftmenu_purchase')}}
                            </p>
                            </a>
                        </li>

                        <li class="nav-item has-treeview" id='menu_account'>
                            <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-dollar-sign"></i>
                            <p>
                                {{__('lb.leftmenu_account')}}
                                <i class="fas fa-angle-left right"></i>
                            </p>
                            </a>
                            <ul class="nav nav-treeview" id='account_collapse'>
                                <li class="nav-item">
                                    <a href="#" class="nav-link" id="menu_income">
                                        <i class="fas fa-angle-double-right nav-icon ml-3"></i> 
                                       Income {{-- {{__('lb.users')}} --}}
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="#" class="nav-link" id="menu_cost">
                                        <i class="fas fa-angle-double-right nav-icon ml-3"></i> 
                                       Cost of goods sold {{-- {{__('lb.users')}} --}}
                                    </a>
                                </li>
                              
                                <li class="nav-item">
                                    <a href="#" class="nav-link" id='menu_expense'>
                                        <i class="fas fa-angle-double-right nav-icon ml-3"></i> 
                                       Expense {{-- {{__('lb.roles')}} --}}
                                    </a>
                                </li>
                             

                                <li class="nav-item">
                                    <a href="#" class="nav-link" id="menu_ap">
                                        <i class="fas fa-angle-double-right nav-icon ml-3"></i> 
                                      AP - Account Payable
                                    </a>
                                </li>
                              
                                <li class="nav-item">
                                    <a href="#" class="nav-link" id='menu_ar'>
                                        <i class="fas fa-angle-double-right nav-icon ml-3"></i> 
                                       AR - Account Receivable     {{-- {{__('lb.roles')}} --}}
                                    </a>
                                </li>
                             

                                <li class="nav-item">
                                    <a href="#" class="nav-link" id='menu_type_expense'>
                                        <i class="fas fa-angle-double-right nav-icon ml-3"></i> 
                                       Type Expense {{-- {{__('lb.roles')}} --}}
                                    </a>
                                </li>
                                

                                <li class="nav-item">
                                    <a href="#" class="nav-link" id="menu_type_method">
                                        <i class="fas fa-angle-double-right nav-icon ml-3"></i> 
                                      Type Method
                                    </a>
                                </li>
                              
                                <li class="nav-item">
                                    <a href="#" class="nav-link" id='menu_asset'>
                                        <i class="fas fa-angle-double-right nav-icon ml-3"></i> 
                                       Asset List     {{-- {{__('lb.roles')}} --}}
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item has-treeview" id='menu_hr'>
                            <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-angle-double-right"></i>
                            <p>
                                {{__('lb.leftmenu_hr')}}
                                <i class="fas fa-angle-left right"></i>
                            </p>
                            </a>
                            <ul class="nav nav-treeview" id='security_collapse'>
                                <li class="nav-item">
                                    <a href="#" class="nav-link" id="menu_employee">
                                        <i class="fas fa-angle-double-right nav-icon ml-3"></i> 
                                       Employee List {{-- {{__('lb.users')}} --}}
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="#" class="nav-link" id="menu_payroll">
                                        <i class="fas fa-angle-double-right nav-icon ml-3"></i> 
                                       Payroll {{-- {{__('lb.users')}} --}}
                                    </a>
                                </li>
                              
                                <li class="nav-item">
                                    <a href="#" class="nav-link" id='menu_sex'>
                                        <i class="fas fa-angle-double-right nav-icon ml-3"></i> 
                                       Sex {{-- {{__('lb.roles')}} --}}
                                    </a>
                                </li>
                             

                                <li class="nav-item">
                                    <a href="#" class="nav-link" id="menu_position">
                                        <i class="fas fa-angle-double-right nav-icon ml-3"></i> 
                                      Position
                                    </a>
                                </li>
                              
                                <li class="nav-item">
                                    <a href="#" class="nav-link" id='menu_department'>
                                        <i class="fas fa-angle-double-right nav-icon ml-3"></i> 
                                       Department    {{-- {{__('lb.roles')}} --}}
                                    </a>
                                </li>
                                

                                <li class="nav-item">
                                    <a href="#" class="nav-link" id='menu_training'>
                                        <i class="fas fa-angle-double-right nav-icon ml-3"></i> 
                                       Training {{-- {{__('lb.roles')}} --}}
                                    </a>
                                </li>
                                

                                <li class="nav-item">
                                    <a href="#" class="nav-link" id="menu_course">
                                        <i class="fas fa-angle-double-right nav-icon ml-3"></i> 
                                      Training Course
                                    </a>
                                </li>
                              
                                <li class="nav-item">
                                    <a href="#" class="nav-link" id='menu_absent'>
                                        <i class="fas fa-angle-double-right nav-icon ml-3"></i> 
                                       Absent    {{-- {{__('lb.roles')}} --}}
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="#" class="nav-link" id='menu_figure'>
                                        <i class="fas fa-angle-double-right nav-icon ml-3"></i> 
                                       Figure Scan    {{-- {{__('lb.roles')}} --}}
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="#" class="nav-link" id='menu_attach'>
                                        <i class="fas fa-angle-double-right nav-icon ml-3"></i> 
                                       Attach File    {{-- {{__('lb.roles')}} --}}
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="#" class="nav-link" id='menu_type_attach'>
                                        <i class="fas fa-angle-double-right nav-icon ml-3"></i> 
                                       Type Attach    {{-- {{__('lb.roles')}} --}}
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="#" class="nav-link" id='menu_status'>
                                        <i class="fas fa-angle-double-right nav-icon ml-3"></i> 
                                       Status    {{-- {{__('lb.roles')}} --}}
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link" id='menu_type_pay'>
                                        <i class="fas fa-angle-double-right nav-icon ml-3"></i> 
                                       Type Pay    {{-- {{__('lb.roles')}} --}}
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="#" class="nav-link" id='menu_type_absent'>
                                        <i class="fas fa-angle-double-right nav-icon ml-3"></i> 
                                       Type Absent    {{-- {{__('lb.roles')}} --}}
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item" >
                            <a href="#" class="nav-link" id="menu_home">
                            <i class="nav-icon fas fa-angle-double-right "></i>
                            <p>
                               {{__('lb.leftmenu_report')}}
                            </p>
                            </a>
                        </li>

                        <li class="nav-item" >
                            <a href="#" class="nav-link" id="menu_home">
                            <i class="nav-icon fas fa-cog "></i>
                            <p>
                                {{__('lb.leftmenu_setting')}}
                            </p>
                            </a>
                        </li>

                        <li class="nav-item has-treeview" id='menu_security'>
                            <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-shield-alt"></i>
                            <p>
                                {{__('lb.security')}}
                                <i class="fas fa-angle-left right"></i>
                            </p>
                            </a>
                            <ul class="nav nav-treeview" id='security_collapse'>
                                <li class="nav-item">
                                    <a href="{{ route('user.index') }}" class="nav-link" id="menu_user">
                                        <i class="fas fa-angle-double-right nav-icon ml-3"></i> 
                                        {{__('lb.users')}}
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('role.index') }}" class="nav-link" id='menu_role'>
                                        <i class="fas fa-angle-double-right nav-icon ml-3"></i> 
                                        {{__('lb.roles')}}
                                    </a>
                                </li>
                            
                            </ul>
                        </li>


                        
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                   @yield('content')
                </div>
                <!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        <footer class="main-footer">
            Copyright &copy; {{date('Y')}} <a href="#">CMS System</a>
            <div class="float-right d-none d-sm-inline-block">
                Version 1.0.0
            </div>
        </footer> 
    </div>
    @yield('modal')
    <!-- jQuery -->
    <script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{asset('plugins/jquery-ui/jquery-ui.min.js')}}"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
    $.widget.bridge('uibutton', $.ui.button)
    var burl = "{{url('/')}}";
    </script>
    <!-- Bootstrap 4 -->
    <script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <!-- overlayScrollbars -->
    <script src="{{asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
    <!-- DataTables -->
    <script src="{{asset('plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('js/adminlte.js')}}"></script>
    <script src="{{asset('js/custom.js')}}"></script>
    
    @yield('js')
</body>
</html>
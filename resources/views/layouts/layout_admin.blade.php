<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <script src="{{asset('./bootstrap/js/jquery-3.4.1.js')}}"></script>
    <link rel="stylesheet" href="{{asset('bootstrap/css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('DataTables/datatables.css')}}">
    <script src="{{asset('./DataTables/datatables.js')}}"></script>
    <script src="js/jquery-3.4.1.slim.js"></script>

    <title>ERP | @yield('title', 'Home')</title>

    <!-- Custom fonts for this template-->
    <link href="{{asset('./Mytheme/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <!-- Page level plugin CSS-->
    <link href="{{asset('./Mytheme/vendor/datatables/dataTables.bootstrap4.css')}}" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{asset('./Mytheme/css/sb-admin.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">

</head>

<body id="page-top">
    <nav class="navbar sticky-top navbar-dark bg-dark navbar-expand"><a href="/home"
            class="navbar-brand mr-5 pr-5">ERP</a>
        <ul class="navbar-nav mx-5 pr-5"></ul>
        <ul class="navbar-nav ml-5 pl-5">
            <li class="nav-item"><a href="/home" class="nav-link">Home</a></li>
            <li class="nav-item"><a href="/stock/" class="nav-link">Categories</a></li>
            <li class="nav-item"><a href="/accounting" class="nav-link">Acounting</a></li>
            <li class="nav-item"><a href="/payroll" class="nav-link">Payroll</a></li>
        </ul>
        <svg aria-labelledby="svg-inline--fa-title-LnktQZrb6Zs1" data-prefix="fas" data-icon="sign-out-alt" role="img"
            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" style="height: 20px;"
            class="ml-auto mr-3 text-white svg-inline--fa fa-sign-out-alt fa-w-16 fa-lg" style="cursor: pointer;">
            <title id="svg-inline--fa-title-LnktQZrb6Zs1" class="">logout</title>
            <path fill="currentColor"
                d="M497 273L329 441c-15 15-41 4.5-41-17v-96H152c-13.3 0-24-10.7-24-24v-96c0-13.3 10.7-24 24-24h136V88c0-21.4 25.9-32 41-17l168 168c9.3 9.4 9.3 24.6 0 34zM192 436v-40c0-6.6-5.4-12-12-12H96c-17.7 0-32-14.3-32-32V160c0-17.7 14.3-32 32-32h84c6.6 0 12-5.4 12-12V76c0-6.6-5.4-12-12-12H96c-53 0-96 43-96 96v192c0 53 43 96 96 96h84c6.6 0 12-5.4 12-12z"
                class=""></path>
        </svg>
    </nav>

    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="sidebar navbar-nav">
            <li class="nav-item active">
                <a class="nav-link" href="/dashboard_admin">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/payroll/posts">
                    <i class="fas fa-landmark"></i>
                    <span>Postes</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/payroll/departments">
                    <i class="fas fa-building"></i>
                    <span>Départements</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/payroll/workers">
                    <i class="fas fa-user"></i>
                    <span>Workers</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/payroll/paie">
                    <i class="fas fa-file-invoice-dollar"></i>
                    <span>Bulletin de paie</span></a>
            </li>
            <!--

      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-portrait"></i>
          <span>Agents</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="pagesDropdown">
          <a class="dropdown-item" href="/register">Nouvel agent</a>
          <a class="dropdown-item" href="/liste_agents">liste des agents</a>
        </div>
      </li>
     -->
        </ul>

        <div id="content-wrapper">

            <!-- /.container-fluid -->
            <div class="container-fluid" style="background-color:rgb(246, 246, 246)">
                @if(isset($message))
                <div class="alert alert-success alert-dismissible show" role="alert">
                    {{$message}}
                </div>
                @endif
                @yield('contenu')
            </div>
            <br><br>
            <!-- Sticky Footer -->
            <footer class="sticky-footer">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright © Your Website 2019</span>
                    </div>
                </div>
            </footer>

        </div>
        <!-- /.content-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{asset('./Mytheme/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('./Mytheme/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{asset('./Mytheme/vendor/jquery-easing/jquery.easing.min.js')}}"></script>

    <!-- Page level plugin JavaScript-->
    <script src="{{asset('./Mytheme/vendor/chart.js/Chart.min.js')}}"></script>
    <script src="{{asset('./Mytheme/vendor/datatables/jquery.dataTables.js')}}"></script>
    <script src="{{asset('./Mytheme/vendor/datatables/dataTables.bootstrap4.js')}}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{asset('./Mytheme/js/sb-admin.min.js')}}"></script>

    <!-- Demo scripts for this page-->
    <script src="{{asset('./Mytheme/js/demo/datatables-demo.js')}}"></script>
    <script src="{{asset('./Mytheme/js/demo/chart-area-demo.js')}}"></script>

</body>

</html>

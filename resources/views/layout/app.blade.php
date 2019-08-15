<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Alif FAQ</title>
	
    <!-- Custom fonts for this template-->
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <!-- Custom styles for this template-->
    <link href="{{ asset('css/sb-admin.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>

<body id="page-top" class="sidebar-toggled">

<nav class="navbar navbar-expand navbar-dark bg-dark static-top">

    <a class="navbar-brand mr-1" href="">
        <img class="logo_img" src="image/alif_logo.png"">Alif FAQ
    </a>

    <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
        <i class="fas fa-bars"></i>
    </button>

    <!-- Navbar Search -->
    <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
    </form>

     <ul class="navbar-nav ml-auto ml-md-0">
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-user-circle fa-fw"></i> 
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="">Profile</a>
                <div class="dropdown-divider"></div>



                <a class="dropdown-item" href="" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fa fa-sign-out"></i> Logout
                </a>
                <form id="logout-form" action="" method="POST" style="display: none;">@csrf</form>

            </div>
        </li>
    </ul>

</nav>

<div id="wrapper">
	<ul class="sidebar navbar-nav toggled">
        <li class="nav-item @yield('menu-question')">
            <a class="nav-link" href="/admin">
                <i class="fas fa-fw fa-question"></i>
                <span><font size="4">Question and Answers</font>	</span>
            </a>
        </li>
        <li class="nav-item @yield('menu-category')">
            <a class="nav-link" href="/admin/category">
                <i class="fas fa-fw fa-tags"></i>
                <span><font size="4">Category</font></span></a>
        </li>
        <li class="nav-item @yield('menu-user')">
            <a class="nav-link" href="">
                <i class="fas fa-fw fa-users"></i>
                </a>
        </li>
    </ul>

    <div id="content-wrapper">

        <div class="container-fluid">

            <!-- Breadcrumbs-->
            @yield("breadcrumbs")

         

            <!-- Page Content -->
            @yield("content")
            {{--<h1 class="display-1">Welcome Administrator</h1>--}}
            {{--<p></p>--}}



        </div>
        <!-- /.container-fluid -->

        <!-- Sticky Footer -->
        {{--<footer class="sticky-footer">--}}
            {{--<div class="container my-auto">--}}
                {{--<div class="copyright text-center my-auto">--}}
                    {{--<span>Copyright © Your Website 2019</span>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</footer>--}}

    </div>
    <!-- /.content-wrapper -->

</div>
<!-- /#wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
<script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

<!-- Core plugin JavaScript-->
<script src="{{ asset("vendor/jquery-easing/jquery.easing.min.js") }}"></script>

<!-- Custom scripts for all pages-->
<script src="{{ asset("js/sb-admin.min.js") }}"></script>

  <!-- Page level plugin JavaScript-->
  <script src="vendor/datatables/jquery.dataTables.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin.min.js"></script>

  <!-- Demo scripts for this page-->
  <script src="js/demo/datatables-demo.js"></script>
</body>

</html>

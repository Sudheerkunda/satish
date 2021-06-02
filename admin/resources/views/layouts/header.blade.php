<?php   
    $admin_name = session()->get('Admin_Name');
    if($admin_name ='' && empty($admin_name))
    {
        return view('index');
    }
?> 
<!doctype html>
<html lang="en"> 
	<head>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="csrf-token" content="{{ csrf_token() }}">
		<link rel="icon" href="{{env('APP_URL')}}/public/images/logo.jpg" type="image/ico" />
		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="{{env('APP_URL')}}/public/assets/vendor/bootstrap/css/bootstrap.min.css">
		<link href="{{env('APP_URL')}}/public/assets/vendor/fonts/circular-std/style.css" rel="stylesheet">
		<link rel="stylesheet" href="{{env('APP_URL')}}/public/assets/libs/css/style.css">
		<link rel="stylesheet" href="{{env('APP_URL')}}/public/assets/vendor/fonts/fontawesome/css/fontawesome-all.css">
		<link rel="stylesheet" href="{{env('APP_URL')}}/public/assets/vendor/charts/chartist-bundle/chartist.css">
		<link rel="stylesheet" href="{{env('APP_URL')}}/public/assets/vendor/charts/morris-bundle/morris.css">
		<link rel="stylesheet" href="{{env('APP_URL')}}/public/assets/vendor/fonts/material-design-iconic-font/css/materialdesignicons.min.css">
		<link rel="stylesheet" href="{{env('APP_URL')}}/public/assets/vendor/charts/c3charts/c3.css">
		<link rel="stylesheet" href="{{env('APP_URL')}}/public/assets/vendor/fonts/flag-icon-css/flag-icon.min.css">
		<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
		<link rel="stylesheet" type="text/css" href="{{env('APP_URL')}}/public/assets/vendor/datatables/css/dataTables.bootstrap4.css">
		<link rel="stylesheet" type="text/css" href="{{env('APP_URL')}}/public/assets/vendor/datatables/css/buttons.bootstrap4.css">
		<link rel="stylesheet" type="text/css" href="{{env('APP_URL')}}/public/assets/vendor/datatables/css/select.bootstrap4.css">
		<link rel="stylesheet" type="text/css" href="{{env('APP_URL')}}/public/assets/vendor/datatables/css/fixedHeader.bootstrap4.css">
		<title>Yumi Restaurant</title>
		<style>
		    .sidebar-dark.nav-left-sidebar .navbar-nav .nav-link:focus, .sidebar-dark.nav-left-sidebar .navbar-nav .nav-link.active {
				background-color: #254182;
				color: #fff;
				border-radius: 3px;
				margin-top:1px;
			}
			.sidebar-dark.nav-left-sidebar .submenu .nav .nav-item .nav-link:hover {
				color: white;
				margin-top:1px;
				margin-bottom:1px;
				border-radius: 20px;
				background-color: #254182;
			}
			.sidebar-dark.nav-left-sidebar .navbar-nav .nav-link:focus, .sidebar-dark.nav-left-sidebar .navbar-nav .nav-link.active i{
				color: white;
			}
			.sidebar-dark.nav-left-sidebar .navbar-nav .nav-link:hover{
                color:white;
				background:#254182;
			}
			.sidebar-dark.nav-left-sidebar .navbar-nav .nav-link:hover i{
                color:white;
			}
			.sidebar-dark.nav-left-sidebar .navbar-nav .nav-link {
                color: #254182;
			}
			.sidebar-dark.nav-left-sidebar .navbar-nav .nav-link i{
                color: #254182;
			}
			.nav-left-sidebar .submenu {
				background:white;
			}
		</style>
	</head>
<body>
    <div class="dashboard-main-wrapper">
        <!-- navbar -->
        <div class="dashboard-header" >
            <nav class="navbar navbar-expand-lg fixed-top" style="background-color:#254182">
                <img src="{{env('APP_URL')}}/public/images/logo.jpg" alt="Logo" style="width:57px;height:57px;margin-left:30px;border:3px solid white;border-radius:50%"/>
                <div class="collapse navbar-collapse " id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto navbar-right-top">                     
                        <li class="nav-item dropdown nav-user">
                            <a class="nav-link nav-user-img" href="#" id="navbarDropdownMenuLink2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-sign-out" aria-hidden="true" style="color:white"></i></a>
                            <div class="dropdown-menu dropdown-menu-right nav-user-dropdown" aria-labelledby="navbarDropdownMenuLink2">
                                <a class="dropdown-item" href="{{env('APP_URL')}}/logout"><i class="fas fa-power-off mr-2"></i>Logout</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
        <!-- end navbar -->
        <!-- ============================================================== -->
        <!-- left sidebar -->
        <!-- ============================================================== -->
        <div class="nav-left-sidebar sidebar-dark" style="background-color:#9fc23f;">
            <div class="menu-list">
                <nav class="navbar navbar-expand-lg navbar-light foo"  id="scr">
                    <a class="d-xl-none d-lg-none" href="#">Dashboard</a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav" style="margin-bottom:100px">
                        <ul class="navbar-nav flex-column">
							<li class="nav-item">
                                <a class="nav-link" href="{{env('APP_URL')}}/pending" id="general"><i class="fa fa-list" aria-hidden="true"></i> Pending Orders</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{env('APP_URL')}}/completed" id="completed"><i class="fa fa-thumbs-up" aria-hidden="true"></i></i> Completed Orders</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{env('APP_URL')}}/ProductsList" id="products"><i class="fa fa-cutlery" aria-hidden="true"></i></i>Products List</a>
                            </li>                        
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- end left sidebar -->
        <!-- ============================================================== -->

    </div>
    <!-- ============================================================== -->
    <!-- end main wrapper  -->
    <!-- ============================================================== -->
    <!-- Optional JavaScript -->
    <!-- jquery 3.3.1 -->
    <script src="js/Chart.min.js"></script>
	<script src="{{env('APP_URL')}}/public/assets/vendor/jquery/jquery-3.3.1.min.js"></script>
    <!-- bootstap bundle js -->
    <script src="{{env('APP_URL')}}/public/assets/vendor/bootstrap/js/bootstrap.bundle.js"></script>
    <!-- slimscroll js -->
    <script src="{{env('APP_URL')}}/public/assets/vendor/slimscroll/jquery.slimscroll.js"></script>
    <!-- main js -->
    <script src="{{env('APP_URL')}}/public/assets/libs/js/main-js.js"></script>
    <!-- chart chartist js -->
    <script src="{{env('APP_URL')}}/public/assets/vendor/charts/chartist-bundle/chartist.min.js"></script>
    <!-- sparkline js -->
    <script src="{{env('APP_URL')}}/public/assets/vendor/charts/sparkline/jquery.sparkline.js"></script>
    <!-- morris js -->
    <script src="{{env('APP_URL')}}/public/assets/vendor/charts/morris-bundle/raphael.min.js"></script>
    <script src="{{env('APP_URL')}}/public/assets/vendor/charts/morris-bundle/morris.js"></script>
    <!-- chart c3 js -->
    <script src="{{env('APP_URL')}}/public/assets/vendor/charts/c3charts/c3.min.js"></script>
    <script src="{{env('APP_URL')}}/public/assets/vendor/charts/c3charts/d3-5.4.0.min.js"></script>
    <script src="{{env('APP_URL')}}/public/assets/vendor/charts/c3charts/C3chartjs.js"></script>
    <script src="{{env('APP_URL')}}/public/assets/libs/js/dashboard-ecommerce.js"></script>
    <!-- Canvas JS  -->
    <script src="https://canvasjs.com/assets/script/jquery.canvasjs.min.js"></script>
	
	<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="{{env('APP_URL')}}/public/assets/vendor/datatables/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
	<script src="https://cdn.datatables.net/rowgroup/1.0.4/js/dataTables.rowGroup.min.js"></script>
    <script src="https://cdn.datatables.net/select/1.2.7/js/dataTables.select.min.js"></script>
    <script src="https://cdn.datatables.net/fixedheader/3.1.5/js/dataTables.fixedHeader.min.js"></script>	
	<script src="{{env('APP_URL')}}/public/assets/vendor/datatables/js/buttons.bootstrap4.min.js"></script>
    <script src="{{env('APP_URL')}}/public/assets/vendor/datatables/js/data-table.js"></script>
</body>
 
</html>
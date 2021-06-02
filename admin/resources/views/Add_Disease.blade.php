@include('layouts.header')
<?php
	date_default_timezone_set("Asia/Dubai");
	date_default_timezone_get();
	$today       = date('Y-m-d',time());
	$today_plus  = date('Y-m-d', strtotime(' + 1 days'));
?>
    <style>
		#general{
			background-color:#254182;
			color:white;
		}
		#general i{
			color:white;
		}
		.form_val{
			color:black;
		}
		.input{
			border-radius:10px;
		}
		input[type=number]::-webkit-inner-spin-button, 
		input[type=number]::-webkit-outer-spin-button { 
		    -webkit-appearance: none; 
		    margin: 0; 
		}
	</style>
		<div class="dashboard-wrapper">
            <div class="container-fluid  dashboard-content">
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="page-header">
                            <h2 class="pageheader-title">Add Disease</h2>
                            <div class="page-breadcrumb">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">ItSmartarr Health</a></li>
                                        <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Disease</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Add Disease</li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- end pageheader -->
                <!-- ============================================================== -->
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="card">
                                <h5 class="card-header" style="text-align:center">Add Disease</h5>
                                 @if(session('msg'))
		                            <h5 style="text-align:center;color: green;">{{session('msg')}}</h5>
		                         @endif
                                <form action="{{env('APP_URL')}}/adddisease" method="POST" enctype="multipart/form-data" >
                                	@csrf
									<div class="card-body">
										<div class="row">
											<div class="col-md-4">
											</div>
											<div class="form-group col-md-4">
                                                <label for="disease_name" class="form_val">Disease Name :</label>
												<input type="text" class="form-control input" id="disease_name" name="disease_name" required>
											</div>
											<div class="col-md-4">
											</div>
										</div>
										<div class="row">
											<div class="col-md-4">
											</div>
											<div class="form-group col-md-4">
                                                <label for="pdf" class="form_val">Select PDF (format pdf) 
                                                	<span style="color:red;"><span> :</label>
												<input type="file" class="form-control input" id="pdf" name="pdf[]" multiple='true' required>
											</div>
											<div class="col-md-4">
											</div>
										</div>										
										<div class="form-group" style="text-align:center">
											<button type="submit" name="submit" class="btn btn-primary btn-sm" style="width:150px;border-radius:25px">Add Disease</button>
										</div>									
									</div>
								</form>
                            </div>
                        </div>
                    </div>          
            </div>
        </div>
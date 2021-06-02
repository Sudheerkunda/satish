@include('layouts.header')
<?php
	date_default_timezone_set("Asia/Dubai");
	date_default_timezone_get();
	$today       = date('Y-m-d',time());
	$today_plus  = date('Y-m-d', strtotime(' + 1 days'));
?>
    <style>
		#products{
			background-color:#254182;
			color:white;
		}
		#products i{
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
                            <h2 class="pageheader-title">Add Products</h2>
                            <div class="page-breadcrumb">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Yumi</a></li>
                                        <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Products</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Add Product</li>
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
                                <h5 class="card-header" style="text-align:center">Add Product</h5>
                                 @if(session('msg'))
		                            <h5 style="text-align:center;color: green;">{{session('msg')}}</h5>
		                         @endif
                                <form action="{{env('APP_URL')}}/addproduct" method="POST" enctype="multipart/form-data" >
                                	@csrf
									<div class="card-body">
		                                <div class="row">
		                                    <div class="col-md-3"></div>
		                                    <div class="form-group col-md-6">
		                                        <label for="state" class="form_val">Select Disease :</label>
		                                        @php 
		                                          $cate = DB::table('y_categories')->where('Status',1)->get();
		                                        @endphp
		                                        <select class="form-control input" id="category_id" name="category_id" required style="border-radius:10px" required>
		                                          <option value="">--Select--</option>
		                                          @foreach($cate as $des)
		                                            <option value="{{$des->Category_Id}}">{{$des->Category_Name}}</option>
		                                          @endforeach  
		                                        </select>
		                                      </div>
		                                    <div class="col-md-3"></div>
		                                </div>
										<div class="row">
											<div class="col-md-3">
											</div>
											<div class="form-group col-md-6">
                                                <label for="product_name" class="form_val">Product Name :</label>
												<input type="text" class="form-control input" id="product_name" name="product_name" required>
											</div>
											<div class="col-md-3">
											</div>
										</div>
										<div class="row">
											<div class="col-md-3">
											</div>
											<div class="form-group col-md-6">
                                                <label for="price" class="form_val">Price :</label>
												<input type="number" class="form-control input" id="price" name="price" required>
											</div>
											<div class="col-md-3">
											</div>
										</div>
										<div class="row">
											<div class="col-md-3">
											</div>
											<div class="form-group col-md-6">
                                                <label for="image" class="form_val">Product Image 
                                                	<span style="color:red;"><span> :</label>
												<input type="file" class="form-control input" id="image" name="image" multiple='true' required>
											</div>
											<div class="col-md-3">
											</div>
										</div>										
										<div class="form-group" style="text-align:center">
											<button type="submit" name="submit" class="btn btn-primary btn-sm" style="width:150px;border-radius:25px">Add Product</button>
										</div>									
									</div>
								</form>
                            </div>
                        </div>
                    </div>          
            </div>
        </div>
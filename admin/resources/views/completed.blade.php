@include('layouts.header')
<?php
	date_default_timezone_set("Asia/Kolkata");
	date_default_timezone_get();
	$today   = date('Y-m-d',time());

?>
    <style>
		.loader {
			border: 3px solid #f3f3f3;
			border-radius: 50%;
			border-top: 3px solid  #63e0ff;
			border-bottom: 3px solid  #254182;
			margin-left:30px;
			width: 32px;
			height: 32px;
			-webkit-animation: spin 3s linear infinite;
			animation: spin 3s linear infinite;
		}
		@-webkit-keyframes spin {
			0% { -webkit-transform: rotate(0deg); }
			100% { -webkit-transform: rotate(360deg); }
		}

		@keyframes spin {
			0% { transform: rotate(0deg); }
			100% { transform: rotate(360deg); }
		}
    </style>
    <style>
		#completed{
			background:#254182;
		    color:white;
		}
		#completed i{
		    color:white;
		}
		.page-item.active .page-link {
			background:#254182;
			border-color:#254182;
		}
    </style>	
	 <div class="dashboard-wrapper">
            <div class="container-fluid  dashboard-content">
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="page-header">
							<h2 class="pageheader-title"></h2>
                            <div class="page-breadcrumb">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Yumi Restaurant</a></li>
                                        <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Orders</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Completed Orders</li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="card">
                            <h5 class="card-header" style="text-align:center">Completed Orders List</h5>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered first">
                                        @php 
                                          $orders = DB::table('y_orders')->where('Status',1)->where('Order_Status','Completed')->orderby('Update_Date','desc')->get();
                                        @endphp
                                        <thead>
                                            <tr>
                                                <th>S No</th>
                                                <th>Order Code</th>
                                                <th>Table No</th>
												<th>Product</th>
												<th>Quantity</th>
												<th>Selling Price</th>
												<th>Total Price</th>
												<th>Order Type</th>
												<th>Order Status</th>
												<th>Completed Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
										   <?php $i=1; ?>
										    @foreach($orders as $item)
                                               <tr>
                                               	    <td> <?php echo $i++; ?></td>
                                               	    <td> {{ $item->Order_Code }} </td>
                                               	    <td> {{ $item->Table_Number }} </td>
                                               	    <td> {{ $item->Product_Name }} </td>
                                               	    <td> {{ $item->Quantity }} </td>
                                               	    <td> {{ $item->Selling_Price }} </td>
                                               	    <td> {{ $item->Total_Price }} </td>
                                               	    <td> {{ $item->Order_Type }} </td>
                                               	    <td> {{ $item->Order_Status }} </td>
                                               	    <td> {{ $item->Update_Date }} </td>
                                               </tr>                                 
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
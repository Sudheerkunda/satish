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
		#general{
			background:#254182;
		    color:white;
		}
		#general i{
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
                                        <li class="breadcrumb-item active" aria-current="page">Pending Orders</li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="card">
                            <h5 class="card-header" style="text-align:center">Pending Orders List</h5>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered first">
                                        @php 
                                          $orders = DB::table('y_orders')->where('Status',1)->where('Order_Status','Pending')->orderby('Reg_Date','desc')->get();
                                        @endphp
                                        <thead>
                                            <tr>
                                                <th>S No</th>
                                                <th>Order Code</th>
                                                <th>Table No</th>
												<th>Product</th>
												<th>Quantity</th>
												<th>Instruction</th>
												<th>Selling Price</th>
												<th>Total Price</th>
												<th>Order Type</th>
												<th>Order Status</th>
												<th>View Details</th>
												<th>Completed</th>
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
													<td> {{ $item->Instruction }} </td>
                                               	    <td> {{ $item->Selling_Price }} </td>
                                               	    <td> {{ $item->Total_Price }} </td>
                                               	    <td> {{ $item->Order_Type }} </td>
                                               	    <td> {{ $item->Order_Status }} </td>
                                               	    <td>
                                               	    <div id="{{ $item->Order_Code }}_expand"></div>
													<input type="button" value="View Details" onclick="view_details('{{ $item->Order_Code }}')" class="btn btn-success btn-xs" id="{{ $item->Order_Code }}" style="background-image: linear-gradient(to right,#254182,#254182);border-color:white;border-radius:10px"/></td>
                                               	    <td><a href="completed/{{ $item->Order_Code }}" class="btn btn-success btn-xs" style="border-radius:5px">Completed</a></td>
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
	<script>
		function view_details(ord_code)
		{			
			//alert(ord_code);
			$('#'+ord_code+'_expand').addClass('loader');
			$('#'+ord_code).hide();
			$.ajax({
				url    : "http://programmingly.com/yumi/admin/view_detail",
				type   : 'POST',
				data   : {order_id:ord_code,_token:"{{csrf_token()}}"},                    
				success: function(data)
				{
					//alert(data.length);
					let ord    = '';
					let prod   = '';
					let bill   = '';
					let modal  = '';

					ord += "<div>";
						ord += "<h4> Order Id : #"+data[0].Order_Code+"</h4>";
						ord += "<hr>";
					ord += "</div>"; 
                    $('#order_title').empty().append(ord);

					for(var i=0; i<data.length; i++)
					{
						//alert(data[i].Order_Code);
						prod += "<div class='row' style='min-height:130px;border:1px solid #DCDCDC;border-radius:10px;margin-bottom:10px'>";
							prod += "<div class='col-md-5 col-sm-5 col-xs-5'>";
								prod += "<img src='"+data[i].Image+"' alt='No Image' style='height:130px;width:100%;border-radius:5px'>";
								prod += "</div>";
								
							prod += "<div class='col-md-7 col-sm-7 col-xs-7'>";
								prod += "<div style='color:black;margin-top:5px;margin-bottom:5px'><b>Product Name : "+data[i].Product_Name+" <br>Quantity : "+data[i].Quantity+"</b></div>";
							    prod += "<div style='color:black;font-size:12px'><br>Product Price : <b>AED "+data[i].Selling_Price+"</b></div>";
							prod += "</div>";
						prod += "</div>"
					}						
	                    $("#product_data").empty().append(prod);

	                    bill += "<div class='row'>";
							bill += "<div class='col-md-12'>";
								    bill += "<h4 style='background-color:#DCDCDC;border-radius:15px;text-align:center'>Bill Payments</h4>";
								    bill += "<table style='color:black'>";
									    bill += "<tr>";
										    bill += "<td>Products Price ( "+data.length+" items )</td>";
											bill += "<td>:</td>";
											bill += "<td>AED "+data[0].Total_Price+"</td>";
										bill += "</tr>";
										bill += "<tr>";
										    bill += "<td><b>Total Price</b></td>";
											bill += "<td>:</td>";
											bill += "<td><b>AED "+data[0].Total_Price+"</b></td>";
										bill += "</tr>";
	                                bill += "</table>";									
							bill += "</div>";
						bill += "</div>"; 
						$("#bill_payment").empty().append(bill);
						
						$("#myModal").modal('show');
						$('#'+ord_code+'_expand').removeClass('loader');
				        $('#'+ord_code).show();
				},
				error: function(xhr, textStatus, errorThrown){
					alert("Failed Try Again...!");
				}
			}); 
			return false;
		}          
	</script>
	<div class="modal fade" id="myModal" role="dialog">
		<div class="modal-dialog">				 
			<div class="modal-content">
				<div class="modal-body">
				    <div class="container-fluid">
					    <div id="order_title"></div>
						<div id="product_data"></div>
						<div id="bill_payment"></div>
					</div>
				</div>
				<div class="modal-footer">
				    <button type="button" class="btn btn-default" data-dismiss="modal" style="background-color:#0e3d9f;border:1px solid #0e3d9f;border-radius:5px;color:white">Close</button>
				</div>
			</div>		  
		</div>
	</div>
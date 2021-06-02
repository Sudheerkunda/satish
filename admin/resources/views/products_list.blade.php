@include('layouts.header')
<?php
	date_default_timezone_set("Asia/kolkata");
	date_default_timezone_get();
	$today   = date('Y-m-d',time());
?>
    <style>
		#products{
			background:#254182;
		    color:white;
		}
		#products i{
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
                            <div style="float:right">
							    <a href="{{env('APP_URL')}}/add_product"><button class="btn btn-primary btn-sm" style="border-radius:25px;border-color:white;background-image:linear-gradient(to right,#9fc23f,#254182)"><i class="fa fa-plus" aria-hidden="true">&nbsp;</i> Add Product</button></a>
							</div>
							<h2 class="pageheader-title"></h2>
                            <div class="page-breadcrumb">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="#" class="breadcrumb-link"> Yumi</a></li>
                                        <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Products</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Products List</li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="card">
                            <h5 class="card-header" style="text-align:center">Products List</h5>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered first">
                                        @php
                                            $products  = DB::table('y_products as pro')->join('y_categories as cate','cate.Category_Id','=','pro.Category_Id') ->select('cate.Category_Name','pro.Product_Id','pro.Product_Name', 'pro.Price','pro.Image')->where('pro.Status',1)->get();
                                        @endphp
                                        <thead>
                                            <tr>
                                                <th>S No</th>
                                                <th>Category Name</th>
                                                <th>Product Name</th>
												<th>Price</th>
												<th>Image</th>
												<th>Remove</th>
                                            </tr>
                                        </thead>
                                        <tbody>
										   <?php $i=1; ?>
										    @foreach($products as $item)
                                               <tr>
                                               	    <td> <?php echo $i++; ?></td>
                                               	    <td> {{ $item->Category_Name }} </td>
                                               	    <td> {{ $item->Product_Name }} </td>
                                               	    <td> {{ $item->Price }} </td>
                                               	    <td><img src="{{ $item->Image }}" alt='No Image' style='height:70px;width:100px;border-radius:5px'></td>
                                               	    <td><a href="remove/{{ $item->Product_Id }}" class="btn btn-danger btn-xs" style="border-radius:5px">Remove</a></td>
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
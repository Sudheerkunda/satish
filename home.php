<?php
    include 'database/conn.php';
	$Connection = new Connection();
	$connect    = $Connection->db_connect();
	
	session_start();
	require 'session.php';
	$device_id    = Session::get(device_id);
	$cart_count   = "SELECT count(Product_Id) as cou FROM `y_cart` WHERE Device_Id='$device_id'";
	$cart_res     = mysqli_query($connect,$cart_count);
	$count_row    = mysqli_fetch_assoc($cart_res);
	$cou          = $count_row['cou'];
	
	
	$order_type = $_GET['order_type'];
    $tab_query  = "SELECT * FROM y_categories ORDER BY Category_Id ASC";
    $tab_result = mysqli_query($connect, $tab_query);
    $tab_menu   = '';
    $tab_content = '';
    $i = 0;
	while($row = mysqli_fetch_array($tab_result))
	{
		$cat_id=$row["Category_Id"];
		if($i == 0){
		    $tab_menu .= '<li class="nav-item active"><a class="nav-link" onclick="getCategoryData('.$cat_id.');" data-toggle="tab"><img src="'.$row["Category_Image"].'" alt="Yumi burger" style="width:40px;height:40px;"><div>'.$row["Category_Name"].'</div></a></li>'; 
		}else{
	        $tab_menu .= '<li class="nav-item"><a class="nav-link" onclick="getCategoryData('.$cat_id.');" data-toggle="tab"><img src="'.$row["Category_Image"].'" alt="Yumi burger" style="width:40px;height:40px;"><div>'.$row["Category_Name"].'</div></a></li>';	  
	    }
	}
 
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>YUMI APP</title>
        <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" />
        <link rel="stylesheet" href="fontawesome/fontawesome.css" />
        <link rel="stylesheet" type="text/css" href="css/style.css" />
		<style>
		.nav-tabs .nav-item.show .nav-link, .nav-tabs .nav-link.active img{
			background-color:#4c3de6;
			padding:10px;
			border-radius:5px;
		}
		.instruct , .instruct:focus{
			width:100%;
			border-bottom:1px solid black;
			font-size:10px;
		}
		</style>
    </head>
    <body>
        <div class="yumi_home">
        <!-- page-2 -->
        <div class="box_container">
		<div class="yumi_logo_appinner">
			<div class="yumi_logo_appinner_1">
                <img src="img/yumi_logo.png" alt="Yumi logo">
                <h6>Yumi</h6>
            </div>
            <div class="plate_logo">
                <img src="img/tray.svg" alt="Yumi burger">
                <span id="cart_count"><?php echo $cou; ?></span>
            </div>
        </div>
            <div class="container-fluid">
               <div class="row">
                  <div class="col-md-12">
                     <div class="tabs_block">
                        <div class="tabel_select">
                           <span>Select Table</span>
                           <select id="table_no">
                              <option>1</option>
                              <option>2</option>
                              <option>3</option>
                              <option>4</option>
                              <option>5</option>
                              <option>6</option>
                              <option>7</option>
                              <option>8</option>
                           </select>
                        </div>
                      
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
			<div class="container-fluid">
				<div class="row">
					<ul class="nav nav-tabs" list-unstyled justify-content-center scroll-menu" id="coachprofiletab" role="tablist">
				   <?php
				   echo $tab_menu;
				   ?>
				   </ul>								   
					<div id="tabcontent"></div>
								
				</div>
				<div class="row">
					<button onclick="showCart();" class="btn btn-primary">Show Cart</button>
				</div>
			
			</div>
         </div>
      </div>
	  
      <script src="js/jquery.min.js"></script>
      <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
      <script type="text/javascript">
         
			window.getCategoryData('All');
			function getCategoryData(catg)
			{	   
			   var categ = catg;	
				//alert(categ);
				$.ajax({
					enctype:'multipart/form-data', 
					url: "getCategoryData.php",
					type: 'POST',
					data: { 
							requestname : 'Category_Filter',
							category_id : categ
						},
					success: function(data){					
						var json = JSON.parse(data);
							//alert(data);
						let tab_content = '';
						    tab_content += '<div class="tab-content" id="skillstabContent">All Menu Items<ul class="scroll-box">';
						for(var i=0; i<json.length; i++)
						{
							var dataid='data'+i;
							var pricid='price'+i;
							var fpricid='fprice'+i;
							var instrid='instruction'+i;
							tab_content +=  '<li><div class="order_list_inner"><img src="'+json[i].Image+'" alt="no image" class="img-responsive img-thumbnail" style="width:140px;height:120px" /><div class="order_list_inner_add"><span>'+json[i].Product_Name+'</span><strong>Rs.<span id="'+fpricid+'">'+json[i].Price+'</span></strong><input id="'+pricid+'" type="hidden" value="'+json[i].Price+'" /><input type="text" id="'+instrid+'" class="instruct" placeholder="Enter special instruction here" name="instruct"></div><div class="numbers-row"><div><button onclick="increaseItem('+i+');" class="btn-circle"><i class="fas fa-plus"></i></button><input id="'+dataid+'" data-value type="text" value="1" /><button onclick="decreaseItem('+i+');" class="btn-circle"><i class="fas fa-minus"></i></button></div><button class="btn btn-primary btn-sm" onclick="addItem('+i+','+json[i].Category_Id+','+json[i].Product_Id+');">Add</button> </div></div></li>';
						}
						tab_content += '</ul></div>';
						$("#tabcontent").empty().append(tab_content);
					}
				});
			}
         function increaseItem(i){
			 
			var cnt=document.getElementById('data'+i).value;
			var prc=document.getElementById('price'+i).value;
			cnt1=Number(cnt)+1;
			var fprc=Number(cnt1) * Number(prc);
			document.getElementById('data'+i).value=cnt1;
			document.getElementById('fprice'+i).innerHTML=fprc;
		 }
		 function decreaseItem(i){
			 
			var cnt=document.getElementById('data'+i).value;
			var prc=document.getElementById('price'+i).value;
			if(cnt > 1){
				cnt1=Number(cnt)-1;
				var fprc=Number(cnt1) * Number(prc);
				document.getElementById('data'+i).value=cnt1;
				document.getElementById('fprice'+i).innerHTML=fprc;
			}else{
				alert('Minimum Selection Required');	
			}
		 }
         function addItem(id,cid,pid){
			var n       =id;
			var cat     =cid;
			var prod    =pid;
			var order   =<?php echo $order_type; ?>;
			var table   = document.getElementById('table_no').value;
			var item_q  =document.getElementById('data'+n).value;
			var comment =document.getElementById('instruction'+n).value;
			if(item_q >0)
			{
				var item_req=document.getElementById('data'+n).value;
			}else{
				var item_req= 1;
			}
			//alert(item_req);
			var item_prc=document.getElementById('fprice'+n).value;
			//alert(order);
			$.ajax({
					enctype:'multipart/form-data', 
					url: "response.php",
					type: 'POST',
					data: { 
							requestname : 'Add_Item',
							category_id : cat,
							product_id  : prod,
							table_number: table,
							item_qty    : item_req,
							items_prc   : item_prc,
							instruction : comment,
							order_type  : order
						},
					success: function(data){					
						//var json = JSON.parse(data);
						alert(data);
						window.location.reload();
					}
					
			});
			
		 }
		 function showCart(){
			var order      =<?php echo $order_type; ?>;
			
			var table_no   =document.getElementById('table_no').value;
			window.location.href='y_cart.php?table='+table_no+'&order_type='+order; 
		 }
         function valueChange() {
         var value = $(this).val();
         if(value == undefined || isNaN(value) == true || value <= 0) {
         $(this).val(1);
         } else if(value >= 101) {
         $(this).val(100);
         }
         }
      </script>
   </body>
</html>
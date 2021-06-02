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
		
	$table_no   = $_GET['table'];
	$order_type = $_GET['order_type'];

    $sql="SELECT cart.`Cart_Id`,cart.`Category_Id`,cart.`Product_Id`,cart.`Quantity`,pro.Product_Name,pro.Price,pro.Image FROM `y_cart` as cart inner join y_products as pro on pro.Product_Id=cart.`Product_Id` WHERE cart.`Status`='Active' and Device_Id='$device_id'";
    $res = mysqli_query($connect,$sql);

	if(isset($_POST['request']))
	{
		$table   = $_REQUEST['table_no'];
		$order   = $_REQUEST['order_type'];
		if($order == 1){
			$ordertype='Eat In Restaurant';
		}else if($order == 2){
			$ordertype='Get Delivered';
		}
		date_default_timezone_set("Asia/Kolkata");
		date_default_timezone_get(); 
		$reg_date          = date('Y-m-d H:i:s', time ());
		$today             = date('Y-m-d', time ());
		$rand_num          = rand(100,10000);
		$randum_char       = substr(str_shuffle(str_repeat('ABCDEFGHIJKLMNOPQRSTUVWXYZ', mt_rand(1,2))),1,2);
		$randum            = substr(str_shuffle(str_repeat('1234567890', mt_rand(1,3))),1,3);
		$order_code        = $randum.$randum_char.$rand_num;
		$sql_cart = "SELECT cart.`Cart_Id`,cart.`Category_Id`,cart.Instruction,cart.`Product_Id`,cart.`Quantity`,pro.Product_Name,pro.Price,pro.Image FROM `y_cart` as cart inner join y_products as pro on pro.Product_Id=cart.`Product_Id` WHERE cart.`Status`='Active' and cart.Table_No='$table_no' and cart.Device_Id='$device_id'";
		$res_cart = mysqli_query($connect,$sql_cart);
		while($row_cart=mysqli_fetch_assoc($res_cart))
		{
			$category_id     = $row_cart['Category_Id'];
			$Instruction     = $row_cart['Instruction'];
			$product_id      = $row_cart['Product_Id'];
			$product_name    = $row_cart['Product_Name'];
			$quantity        = $row_cart['Quantity'];
			$unit_price      = $row_cart['Price'];
			$selling_price   = $row_cart['Quantity'] * $row_cart['Price'];
			$total_price     = $row_cart['Quantity'] * $row_cart['Price'];
			$sql_ins = "INSERT INTO `y_orders`(`Order_Code`,Device_Id,`Table_Number`, `Category_Id`, `Product_Id`, `Product_Name`, `Quantity`,Instruction, `Unit_Price`, `Selling_Price`, `Total_Price`, `Order_Type`, `Order_Status`, `Status`, `Reg_Date`, `Update_Date`) VALUES ('$order_code','$device_id','$table_no','$category_id','$product_id','$product_name','$quantity','$Instruction','$unit_price','$selling_price','$total_price','$ordertype','Pending','1','$reg_date','$reg_date')";
			$res_ins    = mysqli_query($connect,$sql_ins);
			$row_affect = mysqli_affected_rows($connect);
            
            $up_cart    = "update y_cart set Status='Ordered' where Status='Active' and Table_No='$table_no' and Device_Id='$device_id'";
            $up_re      = mysqli_query($connect,$up_cart);			
		}
		if($row_affect > 0)
		{
			echo "<script> alert('Order Placed'); </script>";
		}else{
			echo "<script> alert('Order Failed'); </script>";
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
      <link rel="stylesheet" type="text/css"
         href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" />
      <link rel="stylesheet" href="fontawesome/fontawesome.css" />
      <link rel="stylesheet" type="text/css" href="css/style.css" />
   </head>
   <body>
      <div class="yumi_home">
         <!-- page-3 -->
         <div class="container-fluid food_item">
            <div class="yumi_logo_appinner">
			   <div class="yumi_logo_appinner_1">
                  <img src="img/yumi_logo.png" alt="Yumi logo">
                  <h6>Yumi</h6>
               </div>
               <div class="plate_logo">
                  <img src="img/tray.svg" alt="Yumi burger">
                  <span><?php echo $cou; ?></span>
               </div>
            </div>
            <div class="ordered_itemlist">
               <span>Your Orders</span>
               <ul class="scroll-box">
			   <?php
			   $i=0;
				while($row=mysqli_fetch_assoc($res)){
					$i=$i+1;
					$dataid='data'.$i;
					$hpricid='hprice'.$i;
					$pricid='price'.$i;
					$fpricid='fprice'.$i;
			   ?>
                  <li>
                     <div class="order_list_inner">
                        <img src="img/food1.png" alt="Yumi burger">
                        <div class="order_list_inner_add">
                           <span><?php echo $row['Product_Name']; ?></span>
                           <strong>Rs.<span id="<?php echo $fpricid; ?>"><?php echo ($row['Quantity'] * $row['Price']); ?></span></strong>
						   <input class="prodprice" id="<?php echo $hpricid; ?>" type="hidden" value="<?php echo ($row['Quantity'] * $row['Price']); ?>" />
						   <input id="<?php echo $pricid; ?>" type="hidden" value="<?php echo $row['Price']; ?>" />
                        </div>
                        <div class="numbers-row">
                           <div><button class="btn-circle" onclick="increaseItem(<?php echo $i; ?>);"> + </button> <input id="<?php echo $dataid; ?>" data-value type="text" value="<?php echo $row['Quantity']; ?>" /><button class="btn-circle" onclick="decreaseItem(<?php echo $i; ?>);"><i class="fas fa-minus"></i></button></div>
						   <button class="btn btn-primary btn-sm" onclick="addItem(<?php echo $i; ?>,<?php echo $row['Cart_Id']; ?>)">Add</button>
                        </div>
                     </div>
                  </li>
				<?php } ?>
                     
               </ul>
               <div class="btn-block">
                  <button class="btn btn-primary" onclick="placeOrder();">Total bill: Rs.<span id="total_price"></span><strong>Order</strong></button>
               </div>
			   
			   <form method="POST" id="orderform">
				 <input type="hidden" name="table_no" id="table_no" value="<?php echo $table_no; ?>">
				 <input type="hidden" name="order_type" id="order_type" value="<?php echo $order_type; ?>">
				 <input type="hidden" name="request" value="Place_Order">
				 
				</form>
            </div>
         </div>
      </div>
	  <script src="js/jquery.min.js"></script>
      <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
      
   </body>
   <script type="text/javascript">
	function placeOrder(){
		var cart_form = document.getElementById('orderform');
        cart_form.submit();
	}
       function increaseItem(i){
			var cou2=0;
			var sum2=0;
			var sum12=0;
			var cnt=document.getElementById('data'+i).value;
			var prc=document.getElementById('price'+i).value;
			cnt1=Number(cnt)+1;
			var fprc=Number(cnt1) * Number(prc);
			document.getElementById('data'+i).value=cnt1;
			document.getElementById('fprice'+i).innerHTML=fprc;
			document.getElementById('hprice'+i).innerHTML=fprc;
			
				$('.prodprice').each(function(){
					cou2=cou2+1;
					sum2  += parseFloat(this.value);
					sum12 =sum2.toFixed(2);
					//alert(fsum1);
					$('#total_price').html(sum12);
				});
		 }
		function decreaseItem(i){
			var cou2=0;
			var sum2=0;
			var sum12=0;
			var cnt=document.getElementById('data'+i).value;
			var prc=document.getElementById('price'+i).value;
			if(cnt > 1){
				cnt1=Number(cnt)-1;
				var fprc=Number(cnt1) * Number(prc);
				document.getElementById('data'+i).value=cnt1;
				document.getElementById('fprice'+i).innerHTML=fprc;
				document.getElementById('hprice'+i).innerHTML=fprc;
				
				 $('.prodprice').each(function(){
					cou2=cou2+1;
					sum2  += parseFloat(this.value);
					sum12 =sum2.toFixed(2);
					//alert(fsum1);
					$('#total_price').html(sum12);
				});
			}else{
				alert('Minimum Selection Required');	
			}
		 }
         function addItem(id,cartid){
			var n       =id;
			var cart     =cartid;
			var order   =<?php echo $order_type; ?>;
			var item_req=document.getElementById('data'+n).value;
			//alert(order);
			$.ajax({
					enctype:'multipart/form-data', 
					url: "response.php",
					type: 'POST',
					data: { 
							requestname : 'Update_Item',
							cart_id     : cart,
							item_qty    : item_req,
							order_type  : order
						},
					success: function(data){					
						//var json = JSON.parse(data);
						alert(data);
						window.location.reload();
					}
					
			});
			
		 } 
		 var cou=0;
		 var sum=0;
		 var sum1=0;
		 $('.prodprice').each(function(){
			cou=cou+1;
			sum  += parseFloat(this.value);
			sum1 =sum.toFixed(2);
			//alert(fsum1);
			$('#total_price').html(sum1);
		});
      </script>
</html>
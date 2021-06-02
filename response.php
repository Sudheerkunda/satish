<?php
    include 'database/conn.php';
	$Connection = new Connection();
	$connect    = $Connection->db_connect();
	
	session_start();
	require 'session.php';
	$device_id    = Session::get(device_id);
	
	if($_POST['requestname']=='Add_Item')
	{
		$category_id     = $_POST["category_id"];
		$product_id      = $_POST["product_id"];
		$table           = $_POST["table_number"];
		$prod_qty        = $_POST["item_qty"];
		$comment         = mysqli_real_escape_string($connect,$_POST["instruction"]);
		if($prod_qty >0)
		{
			$prod_req_qty = $_POST["item_qty"];
		}else{
			$prod_req_qty = 1;
		}
		$tot_prc         = $_POST["items_prc"];
		$order           = $_POST["order_type"];
		if($order == 1)
		{
			$order_type='Eat In Restaurant';
		}else if($order == 2)
		{
			$order_type='Get Delivered';
		}
		
		date_default_timezone_set("Asia/Kolkata");
		date_default_timezone_get(); 
		$reg_date          = date('Y-m-d H:i:s', time ());
		$today             = date('Y-m-d', time ());			
		$sql_chk = "select Cart_Id,Quantity from y_cart where Device_Id='$device_id' and Product_Id='$product_id' and Table_No='$table' and Order_Type='$order_type' and Status='Active'";
		$res_chk  = mysqli_query($connect,$sql_chk);
		$row_chk  = mysqli_fetch_assoc($res_chk);
		$cart_id  = $row_chk['Cart_Id'];
		$quantity = $row_chk['Quantity'];
		if($cart_id > 0)
		{
			$req = $quantity + $prod_req_qty;
			$sql_upd = "Update y_cart set Quantity='$req',Instruction='$comment' where Cart_Id='$cart_id'";
			$res_upd = mysqli_query($connect,$sql_upd);
			$row_upd = mysqli_affected_rows($connect);
			if($row_upd > 0){
				$msg='Success';
			}else{
				$msg="Failed";
			}
		}else{
			$sql_ins="INSERT INTO `y_cart`(Device_Id,`Category_Id`, `Product_Id`, `Table_No`, `Quantity`,Instruction, Order_Type,`Status`, `Reg_Date`) VALUES ('$device_id','$category_id','$product_id','$table','$prod_req_qty','$comment','$order_type','Active','$reg_date')";
			$res_ins=mysqli_query($connect,$sql_ins);
			if($res_ins){
				$msg='Success';
			}else{
				$msg="Failed";
			}
		}
		$json_en    = json_encode($msg);  
		echo $json_en;
	}
	if($_POST['requestname']=='Update_Item')
	{
		$cart_id         = $_POST["cart_id"];
		$prod_req_qty    = $_POST["item_qty"];
		$order           = $_POST["order_type"];
		if($order == 1){
			$order_type='Eat In Restaurant';
		}else if($order == 2){
			$order_type='Get Delivered';
		}
			$sql_upd = "Update y_cart set Quantity='$prod_req_qty' where Cart_Id='$cart_id'";
			$res_upd = mysqli_query($connect,$sql_upd);
			$row_upd = mysqli_affected_rows($connect);
			if($row_upd > 0){
				$msg='Success';
			}else{
				$msg="Failed";
			}
			$json_en    = json_encode($msg);  
			echo $json_en;
	}	
?>
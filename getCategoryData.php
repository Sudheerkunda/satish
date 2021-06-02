<?php
    include 'database/conn.php';
	$Connection = new Connection();
	$connect    = $Connection->db_connect();
	if($_POST['requestname']=='Category_Filter')
	{
		$category_id     = $_POST["category_id"];		
		if($category_id == 'All'){
			$sql="SELECT * FROM y_products where Status='1'";			
		}else{
			$sql="SELECT * FROM y_products WHERE Category_Id = '$category_id' and Status='1'";
		}
		$result   = mysqli_query($connect,$sql);
		$products = array(); 
		while($row = mysqli_fetch_assoc($result)){
			$products[] =$row;
		}

		$json_en    = json_encode($products);  
		echo $json_en;
	}
 
?>
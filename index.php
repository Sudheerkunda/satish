<?php
    session_start();
	require 'session.php';
	$device_id = uniqid();		
	Session::set(device_id,$device_id);
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
         <!-- page-1 -->
         <div class="yumi_inner">
            <div class="yumi_inner_bg" style="height:700px">
               <div class="yumi_inner_bgout">
                  <img src="img/yumi_logo.png" alt="Yumi logo">
                  <h2>Yumi</h2>
               </div>
               <div class="btn-block">
                  <button onclick="window.location.href='home.php?order_type=1'" class="btn btn-primary">Eat in Restaurant</button>
                  <button onclick="window.location.href='home.php?order_type=2'" class="btn">Get Delivered</button>
               </div>
            </div>
         </div>
      </div>
      <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>     
   </body>
</html>
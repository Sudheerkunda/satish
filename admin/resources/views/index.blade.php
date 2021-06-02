<!DOCTYPE html>
<html lang="en">
    <head>
         <title>Yumi Restaurant</title>
         <meta charset="utf-8">
         <link rel="icon" href="{{env('APP_URL')}}/public/images/logo.jpg" type="image/ico" />
         <meta name="csrf-token" content="{{ csrf_token() }}">
         <meta name="viewport" content="width=device-width, initial-scale=1">
         <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
         <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
         <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    </head> 
    <body style="background-color:#9fc23f">
         <div class="container">
              <div class="col-md-3"></div>
              <div class="col-md-6" style="border:1px solid white;border-radius:10px;background-color:white;margin-top:180px;">
                   <div style="text-align:center">
                        <!--<img src="images/logo.png" alt="" style="width:100px;height:60px;margin-top:5px" /> -->
                        <h2 style="color: #254182;"><b>Yumi Restaurant</b></h2>
                        @if(session('msg'))
                          <p style="color:red">{{session('msg')}}</p>
                        @endif
                   </div>                              
                   <form action="login" method="post" style="margin:10px;">
                   @csrf
                       <div class="form-group">
                             <label for="usr">Username:</label>
                             <input type="text" class="form-control" id="usr" name="username" placeholder="Username">
                       </div>
                       <div class="form-group">
                             <label for="pwd">Password:</label>
                             <input type="password" class="form-control" id="pwd" name="password" placeholder="Password">
                       </div>
                       <div style="text-align:center">
                             <button type="submit" class="btn" style="background-color:#254182;color:white;">Login</button>
                       </div>
                       <div style="text-align:center;margin:5px">
                          <!--<p style=""><b>Forgot Password <a href="/forgot"> click here </a></b></p>-->
                       </div>
                    </form>
              </div>
              <div class="col-md-3"></div>            
         </div>
    </body>
</html>
<?php

class Session
{

  public static function set($key, $value)
	{
	
	$_SESSION[$key]=$value;
	
	}
	
  public static function get($key)
  {
  
  //echo "in get";
  	 if(isset($_SESSION[$key]))
	 {
	 return $_SESSION[$key];
	 }
  	 {
	  return false;
	 }
  
  
  }	


}


?>
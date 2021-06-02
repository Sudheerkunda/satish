<?php 
    class Connection
	{    
	    function db_connect()
		{        
		    static $connection;        
			    if(!isset($connection)) 
				{            
			        $config = parse_ini_file('config.ini');             
			        $connection = mysqli_connect('localhost',$config['username'],$config['password'],$config['dbname']);        
			    }         
			    if($connection === false) 
				{            
			        return mysqli_connect_error();         
			    }        
			    return $connection;    
		}    
		    public function closeConnection()    
			{        
			    if($this->mysqliConnection!=NULL)        
			    {            
					$this->mysqliConnection->close();            
					$this->mysqliConnection=null;            
					echo "connection closed";        
				}        
				else{            
					echo "connection already closed";	
				}
			}		
    }
	

	
?>
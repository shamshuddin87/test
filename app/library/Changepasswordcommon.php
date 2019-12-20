<?php
use Phalcon\Mvc\User\Component;

class Changepasswordcommon extends Component
{
	
	public function pwdchange($salt, $password, $getuserid)
    {        
        //echo $getuserid; exit;
        $connection = $this->db;
        $connectiontrd = $this->dbtrd;
        
        $time = time();
        $getcurtime = date("Y-m-d H:i:s");
                
        $ingeo = "UPDATE `web_register_user` SET 
                `date_modified` ='".$getcurtime."', `password` = '".$password."',  `salt`='".$salt."' 
                WHERE  user_id='".$getuserid."' ";
        //echo $ingeo;
        //exit;

        try 
        {
            $sqlpwdup = $connection->query($ingeo);
            $getnum   = trim($sqlpwdup->numRows());
            if($sqlpwdup)
            {
                
                // ---------- BoardApp Update End ----------
                
                return true;
            }
            else
            {
                return false;
            }
            $connection->close();
        }
        catch (Exception $e) {
            return false;
            $connection->close();
        }
    }
    
    
  
    
   
    
    
   
   
   
   
     
    
    
}



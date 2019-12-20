<?php
use Phalcon\Mvc\User\Component;
use Phalcon\Filter;
class Termsandconditionscommon extends Component
{
	
	public function uploadtermsandconditions($getuserid,$user_group_id,$target_file,$filetitle)
	{
       try
       {


       	  $connection = $this->dbtrd;
          $time = time();
          $today = date("d-m-Y");  
       	  $queryinsert = "INSERT INTO `terms_and_conditions`
                        (`user_id`,`user_group_id`,`filetitle`,`file`,`date_of_added`, `date_of_modified`,`timeago`)
                        VALUES ('".$getuserid."','".$user_group_id."','".$filetitle."','".$target_file."',NOW(),NOW(),'".$time."')";
          // print_r($queryinsert);exit;
          

          $exeget = $connection->query($queryinsert);

          if($exeget)
          {
             return true;
          }
          else
          {
             return false;
          }
           
       }
       catch(Exception $e)
       {
         return false;
       }
	}


	public function getallfile($getuserid,$user_group_id)
	{
      $getmasterid = $this->tradingrequestcommon->getmasterid($getuserid);
 
       $connection = $this->dbtrd;
       if($user_group_id==2)
       {
         $sqlquery = "SELECT * FROM `terms_and_conditions` WHERE user_id='".$getuserid."'"; 
       }
       else
       {
          $sqlquery = "SELECT * FROM `terms_and_conditions` WHERE user_id='".$getmasterid['user_id']."'"; 
       }
  
        
      // echo $sqlquery; exit;
       try{
            $exeget = $connection->query($sqlquery);
            $getnum = trim($exeget->numRows());
            if($getnum>0)
            {
                while($row = $exeget->fetch())
                {
                    
                       $getlist[] = $row;                     
                    
                }
                // echo '<pre>';print_r($getlist);exit;
            }
            else
            {   $getlist = array(); }
        }
        catch (Exception $e)
        {   $getlist = array(); }
        //echo '<pre>';print_r($getlist);exit;
        return $getlist;
	}

 // public function deletecompany($reqid){
	  
 //    $connection = $this->dbtrd;
 //    $sqlquery="DELETE FROM `terms_and_conditions` WHERE id='".$reqid."'";
 //    // print_r($sqlquery);exit;
 //   try
 //        {
 //            $exesql = $connection->query($sqlquery);
 //            if($exesql)
 //            {   return true;    }
 //            else
 //            {   return false;    }
 //        }
 //        catch (Exception $e)
 //        {   return false; }
   
 //  }


  public function getalluserfiles($getuserid)
  {
       
        $getmasterid = $this->tradingrequestcommon->getmasterid($getuserid);
        $connection = $this->dbtrd;
         // print_r($getmasterid['user_id']);
        if(isset($getmasterid))
        {
	        $sqlquery = "SELECT * FROM `terms_and_conditions` WHERE user_id='".$getmasterid['user_id']."'"; 
	      
	        
	      // echo $sqlquery; exit;
	       try{
	            $exeget = $connection->query($sqlquery);
	            $getnum = trim($exeget->numRows());
	            if($getnum>0)
	            {
	                while($row = $exeget->fetch())
	                {
	                    
	                       $getlist[] = $row;                     
	                    
	                }
	                // echo '<pre>';print_r($getlist);exit;
	            }
	            else
	            {   $getlist = array(); }
	        }
	        catch (Exception $e)
	        {   $getlist = array(); }
	        // echo '<pre>';print_r($getlist);exit;
	        return $getlist;
       }
  }


        public function deleteresource($reqid)
        {
            $connection = $this->dbtrd;
            $myarr=array();
            $time = time();
            try
            {
                $query="DELETE FROM terms_and_conditions WHERE id='".$reqid."'";
                //  print_r($query);exit;
                $exessa= $connection->query($query);

                if($exessa)
                {
                    return true;
                }
                else
                {
                    return false;
                }

            }
            catch(Exception $e)
            {
                return false;
            }
        }




}

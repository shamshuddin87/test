<?php
use Phalcon\Mvc\User\Component;
class Portfoliocommon extends Component
{
   public function storeaccno($uid,$usergroup,$accnodata)
   {

      
        $connection = $this->dbtrd;
        $myarr=array();
        $time = time();
        
         try{
	          for($i=0;$i<sizeof($accnodata);$i++)
	         {

           

	           $query="INSERT INTO user_demat_accounts (user_id, user_group_id, accountno,depository_participient,clearing_house, date_added,date_modified,timeago)
	           VALUES ('".$uid."', '".$usergroup."', '".$accnodata[$i]['accno']."','".$accnodata[$i]['dp']."','".$accnodata[$i]['clhouse']."', NOW(),NOW(),
             '".$time."');";
	           $exessa= $connection->query($query);

	           if($exessa)
	          {
	          	$myarr['msg']="Data Inserted Successfully";
	         	$myarr['status']=true;
	         	continue;
	          }
	         else
	         {
	         	$myarr['msg']="Data Not Inserted For".$accnodata[$i]['accno']."This And For Futher";
	         	$myarr['status']=false;
	         	break;
	         	
	          }

	         }
          }catch(Exception $e){
          	$myarr['msg']="Data Not Inserted Successfully";
	        $myarr['status']=false;

          }
     return $myarr;
   }

 public function getaccnoinfo($uid,$usergroup)
 {
 	     $connection = $this->dbtrd;
        $myarr=array();
        $time = time();
        

        $query="SELECT * FROM user_demat_accounts WHERE user_id='".$uid."'";
        //print_r($query);exit;

         try{
            $exeget = $connection->query($query);
            $getnum = trim($exeget->numRows());
            if($getnum>0)
            {
                while($row = $exeget->fetch())
                {
                    
                       $getlist[] = $row;                     
                    
                }
                 //echo '<pre>';print_r($getlist);exit;
            }
            else
            {   $getlist = array(); }
        }
        catch (Exception $e)
        {   $getlist = array(); }
        //echo '<pre>';print_r($getlist);exit;
        return $getlist;
       

 }
  public function delaccount($uid,$sergroup,$delid)
  {
    $connection = $this->dbtrd;
    $myarr=array();
    $time = time();
    
      try{
            $query="DELETE FROM user_demat_accounts WHERE id='".$delid."'";
            $exessa= $connection->query($query);

            if($exessa)
            {
              return true;
            }
           else
           {
             return false;
            }


        }catch(Exception $e){
           return false;
        }
     } 

     //#########################################UPDATE ACCOUNT NO START HERE############################
     public function updateaccount($uid,$usergroup,$accno,$editid,$hc,$dp)
     {
        $connection = $this->dbtrd;
        $myarr=array();
        $time = time();
        
        try{
          $query="UPDATE user_demat_accounts SET accountno ='".$accno."',depository_participient='".$dp."',clearing_house='".$hc."',date_modified= NOW(),timeago='".$time."' WHERE id ='".$editid."'";
           $exessa= $connection->query($query);

            if($exessa)
            {
              return true;
            }
           else
           {
             return false;
           }
        }catch(Exception $e){
            return false;
        }
     } 


     public function storerelativeacc($uid,$usergroup,$accno,$relitiveid)
     {
        $connection = $this->dbtrd;
        $myarr=array();
        $time = time();
        
       // print_r(sizeof($accno));exit;
       
         try{
            for($i=0;$i<sizeof($accno);$i++)
           {

             $query="INSERT INTO relative_demat_accounts (parent_user_id, parent_user_group_id,rel_user_id, accountno,depository_participient,clearing_house,date_added,date_modified,timeago)
             VALUES ('".$uid."', '".$usergroup."', '".$relitiveid."', '".$accno[$i]['relativeacc']."','".$accno[$i]['dp']."','".$accno[$i]['ch']."',NOW(),NOW(),'".$time."');";
           // print_r($query);exit;
             $exessa= $connection->query($query);



             if($exessa)
            {
                $myarr['msg']="Data Inserted Successfully";
                $myarr['status']=true;
                continue;
            }
           else
           {
               $myarr['msg']="Data Not Inserted For".$accno[$i]['accno']."This And For Futher";
               $myarr['status']=false;
               break;
            
            }

           }
          }catch(Exception $e){
            
            $myarr['msg']="Data Not Inserted Successfully";
            $myarr['status']=false;

          }
        return $myarr;
     }

    // #################################################GET RELATIVE INFO##############################

      public function getrelinfo($uid,$usergroup)
    {
       $connection = $this->dbtrd;
        $myarr=array();
        $time = time();
        

        $query="SELECT relative_info.`name` ,relative_demat_accounts.`id`,relative_demat_accounts.`*`  FROM relative_info INNER JOIN
                relative_demat_accounts ON relative_info.`id` = relative_demat_accounts.`rel_user_id` 
                AND relative_demat_accounts.`parent_user_id`='".$uid."'";
        

         try{
            $exeget = $connection->query($query);
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
  //########################################DELETE RELATIVE ACCOUNT#############################

    public function reldelaccount($uid,$sergroup,$delid)
  {
    $connection = $this->dbtrd;
    $myarr=array();
    $time = time();
    
      try{
            $query="DELETE FROM relative_demat_accounts WHERE id='".$delid."'";
            $exessa= $connection->query($query);

            if($exessa)
            {
              return true;
            }
           else
           {
             return false;
            }


        }catch(Exception $e){
           return false;
        }
     } 

     //###############################UPDATE RELATIVE INFO#########################


     public function updaterelacc($uid,$usergroup,$reledit,$accno,$dp,$ch)
     {
        
        $connection = $this->dbtrd;
        $myarr=array();
        $time = time();
        
        try{
          $query="UPDATE relative_demat_accounts SET accountno ='".$accno."',depository_participient='".$dp."',clearing_house='".$ch."',date_modified= NOW(),timeago='".$time."' WHERE id ='".$reledit."'";
           $exessa= $connection->query($query);

            if($exessa)
            {
              return true;
            }
           else
           {
             return false;
           }
        }catch(Exception $e){
            return false;
        }
     }

    public function getdematsstatus($uid,$usergroup)
    {
        try
       {   
            $connection = $this->dbtrd;
            $result=array();
            $query="SELECT * FROM `demat_status` WHERE user_id='".$uid."'";
            // print_r($query);exit;
            $exe= $connection->query($query);
            $getnum = trim($exe->numRows());
            if($getnum>0)
            {
                while($row = $exe->fetch())
                {
                    
                       $getlist[] = $row;                     
                    
                }
            }
            else
            {
               $getlist=array();

            }

       }
       catch(Exception $e)
       {
           $getlist=array();
       }

       return $getlist;
     }


     
     public function zerodematacc($uid,$usergroup,$status)
     {
       try
       {   
            $connection = $this->dbtrd;
            $result=array();
            $query="SELECT * FROM `user_demat_accounts` WHERE user_id='".$uid."'";
            $exe= $connection->query($query);
            $getnum = trim($exe->numRows());
            if($getnum>0)
            {
               $result=array("status"=>false,"message"=>"You Have Allready Inserted Demat Account");
            }
            else
            {
                $chkdata="SELECT * FROM demat_status WHERE user_id='".$uid."'";
                $exedata= $connection->query($chkdata);
                $noofrows = trim($exedata->numRows());
                if($noofrows>0)
                { 
                    $query2="UPDATE demat_status SET status='".$status."' WHERE user_id='".$uid."'";

                }
                else
                {
                    
                  $query2="INSERT INTO demat_status (user_id, status)
                    VALUES ('".$uid."','".$status."')";
                   
                }
               
                    $exe2= $connection->query($query2);
                    if($exe2)
                    {
                       $result=array("status"=>true,"message"=>"Data Saved Successfully");
                    }
                    else
                    {
                       $result=array("status"=>false,"message"=>"Something Went To Wrong");
                    }

                 
            }

       }
       catch(Exception $e)
       {
           $result=array("status"=>false,"message"=>"Exception");
       }

       return $result;
       
     }

  }





<?php
use Phalcon\Mvc\User\Component;

class Adminmodulecommon extends Component
{
  
  public function inserttradingdays($getuserid,$tdays,$newdate,$mydate)
  {
    try
       {
           $connection = $this->dbtrd;
           $queryget = "SELECT * FROM  `trading_days` WHERE user_id='".$getuserid."'";
           $exe = $connection->query($queryget);
           $getnum = trim($exe->numRows());
           $time=time();
            if($getnum>0)
            {

                    $getlist['status']=false;  
                     $getlist['msg']="Data Already Inserted Please Delete It"; 
            }
            else{


                  $getlist=array();
                 
                   $sqlquery = "INSERT INTO `trading_days`(`user_id`,`dateadded`,`expectedtrading`,`noofdays`,`date_added`,`date_modified`,`timeago`)
                   VALUES ('".$getuserid."','".$mydate."','".$newdate."','".$tdays."',NOW(),NOW(),'".$time."')"; 
              
                
                    $exesql = $connection->query($sqlquery);
                    if($exesql)
                    {  

                     $getlist['status']=true;  
                     $getlist['msg']="Data Inserted Successfully"; 

                   }
                    else
                    {   
                       $getlist['status']=false; 
                       $getlist['msg']="Something Went To Wrong";  

                     }
              } 
      
         }
        catch (Exception $e)
        {  
           $getlist['status']=false; 
           $getlist['msg']="Exception";  
          }

  return $getlist;
 

  }

  public function gettradingdays($getuserid)
  {
      $connection = $this->dbtrd;
      $queryget = "SELECT * FROM  `trading_days` WHERE user_id='".$getuserid."'";
      $getlist=array();

         try{
                $exeget = $connection->query($queryget);
                $getnum = trim($exeget->numRows());

                if($getnum>0)
                {
                    while($row = $exeget->fetch())
                    {
                        $getlist[] = $row;
                    }
              }
             }catch(Exception $e)
              {
                 $getlist=array();
              }

       return $getlist;
  }
   

    public function fetchautoapproveshares($getuserid,$usergroup)
  {
      $connection = $this->dbtrd;
      $queryget = "SELECT * FROM  `autoapprove` WHERE user_id='".$getuserid."'";
      $getlist=array();

     // print_r($queryget);exit;

         try{
                $exeget = $connection->query($queryget);
                $getnum = trim($exeget->numRows());

                if($getnum>0)
                {
                    while($row = $exeget->fetch())
                    {
                        $getlist[] = $row;
                    }
              }
             }catch(Exception $e)
              {
                 $getlist=array();
              }
    //  print_r($getlist);exit;
       return $getlist;
  }
   

   public function delautoapproveshares($reqid)
   {
       $connection = $this->dbtrd;
        $sqlquery="DELETE FROM `autoapprove` WHERE srno='".$reqid."'";
        // print_r($sqlquery);exit;
       try
            {
                $exesql = $connection->query($sqlquery);
                if($exesql)
                {   return true;    }
                else
                {   return false;    }
            }
            catch (Exception $e)
            {   return false; }
   
  }
  public function deletetradedays($reqid){
  $connection = $this->dbtrd;
    $sqlquery="DELETE FROM `trading_days` WHERE srno='".$reqid."'";
    // print_r($sqlquery);exit;
   try
        {
            $exesql = $connection->query($sqlquery);
            if($exesql)
            {   return true;    }
            else
            {   return false;    }
        }
        catch (Exception $e)
        {   return false; }
   
  }
     public function updatetradingdays($reqid,$mdtdays)
       {
            $connection = $this->dbtrd;
            $time = time();
            try{
      
                 $query = "UPDATE `trading_days` SET  `noofdays`='".$mdtdays."',`date_modified`=NOW(),
                 `timeago`='".$time."' WHERE srno='".$reqid."'";   
                 $exeget = $connection->query($query);
                  if($exeget)
                  {
                     return true;
                  }
                  else
                  {
                     return false;
                  }

              }catch(Exception $e)
              {
                return false;
              }
       }

  public function updateautoapprovel($reqid,$mdtdays)
       {
            $connection = $this->dbtrd;
            $time = time();
            try{
      
                 $query = "UPDATE `autoapprove` SET  `noofshares`='".$mdtdays."',`date_modified`=NOW(),`timeago`='".$time."' WHERE srno='".$reqid."'";   
                 $exeget = $connection->query($query);
                  if($exeget)
                  {
                     return true;
                  }
                  else
                  {
                     return false;
                  }

              }catch(Exception $e)
              {
                return false;
              }
       }
   
      public function insertapprovershares($getuserid,$appshares,$mydate)
      {
            try
               {
                   $time=time();
                   $connection = $this->dbtrd;
                   $queryget = "SELECT * FROM  `autoapprove` WHERE user_id='".$getuserid."'";
                 //  print_r($queryget);exit;
                   $exe = $connection->query($queryget);
                   $getnum = trim($exe->numRows());
                    if($getnum>0)
                    {

                            $getlist['status']=false;  
                             $getlist['msg']="Data Already Inserted Please Delete It"; 
                    }
                    else{


                          $getlist=array();
                         
                           $sqlquery = "INSERT INTO `autoapprove`(`user_id`,`date_added`,`noofshares`,`date_modified`,`timeago`)
                           VALUES ('".$getuserid."','".$mydate."','".$appshares."','".$mydate."','".$time."')"; 
                      
                            // print_r($sqlquery);exit;
                            $exesql = $connection->query($sqlquery);
                            if($exesql)
                            {  

                             $getlist['status']=true;  
                             $getlist['msg']="Data Inserted Successfully"; 

                           }
                            else
                            {   
                               $getlist['status']=false; 
                               $getlist['msg']="Something Went To Wrong";  

                             }
                      } 
              
                 }
                catch (Exception $e)
                {  
                   $getlist['status']=false; 
                   $getlist['msg']="Exception";  
                  }

       return $getlist;
 

     }



     //------------------------------------FETCH ALL USERS--------------------------------------------------//


      public function userdetails($getuserid,$usergroup,$mainqry)
    {
        $connection = $this->dbtrd;
        $sqlquery = "SELECT * FROM `it_memberlist` WHERE `user_id`='".$getuserid."'".$mainqry; 

        // echo $sqlquery; exit;
        try
        {
            $exeget = $connection->query($sqlquery);
            $getnum = trim($exeget->numRows());
            if($getnum>0)
            {
                while($row = $exeget->fetch())
                {
                    
                       $getlist[] = $row;                     
                    
                }
                 //----------------------fetch company---------------------//
                foreach ($getlist as $k => $val) {
                        $cmpnm=array();
                        $querygett = "SELECT `companyname`
                        FROM companylist WHERE `id` IN (".$val['cmpaccess'].") ";

                        $exegett = $connection->query($querygett);
                        $getnumx = trim($exegett->numRows());
                      
                        if($getnumx>0)
                        {
                            while($rowz = $exegett->fetch())
                            {
                                // echo $k.'---> ';echo '<pre>';print_r($rowz);
                                $cmpnm[] = $rowz['companyname'];
                            }
                            $getlist[$k]['companyname'] = implode(',', $cmpnm);
                        }
                    }
                //--------------------------------------------------------//
              //------------------fetch department----------------------------//
                     foreach ($getlist as $k => $val) {
                        $dept=array();
                        $querygett = "SELECT `deptname`
                        FROM con_dept WHERE `id` IN (".$val['deptaccess'].") ";

                        $exegett = $connection->query($querygett);
                        $getnumx = trim($exegett->numRows());
                      
                        if($getnumx>0)
                        {   
                            while($rowz = $exegett->fetch())
                            {
                                 // echo $k.'---> ';echo '<pre>';print_r($rowz);
                                $dept[] = $rowz['deptname'];

                            }
                            $getlist[$k]['department'] = implode(',', $dept);
                        
                        }
                    }
                    //----------------------------------------------------//
            }
            else
            {   $getlist = array(); }
        }
        catch (Exception $e)
        {   $getlist = array(); }
        //echo '<pre>';print_r($getlist);exit;
        return $getlist;  
        }

     public function gatallaccessdetails($userid)
     {
          $connection = $this->dbtrd;
          $queryget = "SELECT * FROM  `adminmodule` WHERE user_id='".$userid."'";
          $getlist=array();

             // print_r($queryget);exit;

         try{
                $exeget = $connection->query($queryget);
                $getnum = trim($exeget->numRows());

                if($getnum>0)
                {
                    while($row = $exeget->fetch())
                    {
                        $getlist[] = $row;
                    }
              }
             }catch(Exception $e)
              {
                 $getlist=array();
              }
    //  print_r($getlist);exit;
       return $getlist;
     }

//-----------------------------------ADMIN MODULE--------------------------------------------------------------------------------------------------
  
  // public function updateaaccess($getalldata)
  // {
  //         $connection = $this->dbtrd;
  //         $queryget =  "UPDATE `adminmodule` SET  `upsi_conn_per_add`='".$getalldata['add_p']."', `upsi_conn_per_view`='".$getalldata['view_p']."',
  //          `upsi_conn_per_edit`='".$getalldata['edit_p']."' , `upsi_conn_per_delete`='".$getalldata['del_p']."' WHERE `user_id`='".$getalldata['userid']."' ";
  //          $getlist=array();

  //        try{
  //               $exeget = $connection->query($queryget);
              
  //               if($exeget)
  //               {
  //                  return true;
  //               }
  //               else
  //               {
  //                  return false;
  //               }
  //            }
  //            catch(Exception $e)
  //            {
  //               return false;
  //            }
  
  // }


//--------------------------------------------------------------------------------------------------------------------------------------------------------


}
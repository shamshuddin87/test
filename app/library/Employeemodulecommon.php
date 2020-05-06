<?php
use Phalcon\Mvc\User\Component;

class Employeemodulecommon extends Component
{
    
     public function insmydetail($userid,$user_group_id,$personal,$filepath)
    {
       $connection = $this->dbtrd;
       $myarr=array();
       $time = time();
       //print_r($personal);exit;
       try{
             $query="SELECT * FROM `personal_info` WHERE userid='".$userid."'";
            // print_r($query);exit;
             $exeget = $connection->query($query);
             $getnum = trim($exeget->numRows());
           if($getnum>0)
           {
              $myarr['message']='Information Already Exist Please Edit Information';
              $myarr['status']=false;
              return $myarr;
            }
           else
           {
              
               $originalDate = $personal['dob'];
               $newDate = date("d-m-Y", strtotime($originalDate));
               $queryinsertml = "INSERT INTO `personal_info`(`userid`,`user_group_id`,`name`,`pan`,`legal_identifier`,`legal_identification_no`,`aadhar`,`dob`,`sex`,`address`,`education`,`institute`,`mobileno`,`sharehldng`,`adrshldng`,`filepath`,`nationality`,`date_added`,`date_modified`,`timeago`)
                VALUES ('".$userid."','".$user_group_id."','".$personal['fname']."','".$personal['pan']."','".$personal['legal_idntfr']."','".$personal['legal_idntfctn_no']."','".$personal['aadhar']."','".$newDate."','".$personal['sex']."','".$personal['address']."','".$personal['eduqulfcn']."','".$personal['institute']."','".$personal['mobno']."','".$personal['shareholdng']."', '".$personal['adrsholdng']."','".$filepath."','".$personal['per_nation']."',NOW(),NOW(),'".$time."')";
                  //print_r($queryinsertml);exit;
                $exeml = $connection->query($queryinsertml);
           
                    if($exeml)
                    {
                       $myarr['message']='Data Inserted Successfully';
                       $myarr['status']=true;
                       return $myarr;
                    }
                    else
                    {
                       $myarr['message']='something went to wrong';
                       $myarr['status']=false;
                       return $myarr;
                    }
            }
    }catch(Exceptioon $e)
    {
      $myarr['message']='something went to wrong';
      $myarr['status']=false;
      return $myarr;
    }
 }
 
 public function getmydetails($uid,$usergroup)
    {

        $connection = $this->dbtrd;

        $queryget = "SELECT pr.`*` ,it.`dpdate` FROM personal_info pr INNER JOIN
        it_memberlist it ON it.`wr_id`=pr.`userid`
        WHERE `userid` = '".$uid."' ";
       // print_r($queryget);exit;
        $getlist=array();

         try{
                $exeget = $connection->query($queryget);
                $getnum = trim($exeget->numRows());
                // $getlist=array();
                if($getnum>0)
                {
                    $getlist=$exeget->fetch();
                    return $getlist;
                }
                else{
                       
                    return $getlist;
                  }     
            
            }catch(Exceptioon $e)
             {
                return $getlist;  
             }
}
  public function updatemydetails($uid,$id,$usergroup,$data,$filepath){
  
       $connection = $this->dbtrd;
       // print_r($filepath);exit;
       $time = time();
       try
       {
              $originalDate = $data['dob'];
              $newDate = date("d-m-Y", strtotime($originalDate));

             $qry = "UPDATE personal_info SET pan ='".$data['pan']."',legal_identifier ='".$data['legal_idntfr']."',legal_identification_no ='".$data['legal_idntfctn_no']."',aadhar ='".$data['aadhar']."',dob ='".$newDate."',sex ='".$data['sex']."',address ='".$data['address']."',mobileno='".$data['mobno']."',education ='".$data['eduqulfcn']."',institute ='".$data['institute']."',filepath ='".$filepath."',sharehldng ='".$data['shareholdng']."',adrshldng ='".$data['adrsholdng']."',adrshldng ='".$data['adrsholdng']."',nationality = '".$data['per_nation']."',date_modified=NOW(),`timeago`='".$time."' WHERE id='".$id."' ";
             //print_r($qry);exit;
             $exeget = $connection->query($qry);
           
             if($exeget)
             {
                $myarr['message']='Data Updated Successfully';
                $myarr['status']=true;
                return $myarr;    
             }
             else
             {
                $myarr['message']='something went to wrong';
                $myarr['status']=false;
                return $myarr;
             }
             
      
       }catch(Exception $e)
       {
         return false;
       }

  }
  public function delmydetails($uid,$usergroup,$delid)
  {
    
       $connection = $this->dbtrd;
       $time = time();
        try
        {
          $sql = "DELETE FROM personal_info WHERE id='".$delid."'";
          $exeget = $connection->query($sql);
               // print_r($sql);exit;
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
  //--------------------------insert relationship details-------------------------------------

   public function relativeinfo($userid,$user_group_id,$data,$filepath)
    {
        //print_r($filepath);exit;
       $connection = $this->dbtrd;
       $myarr=array();
       $time = time();
      try
      {
           
            $originalDate = $data['dob'];
            $newDate = date("d-m-Y", strtotime($originalDate));
            $depdntnature = implode(',',$data['depnature']);
           // print_r($data);exit;
             $query='INSERT INTO `relative_info`
             (`user_id`,`user_group_id`,`name`,`pan`,`legal_identifier`,`legal_identification_no`,`aadhar`,`relationship`,`dependency_nature`,`dob`,`sex`,`address`,`education`,`institute`,`mobile`,`filepath`,`sharehldng`,`adrshldng`,`occupation`,`company`,`nationality`,`date_added`,`date_modified`,`timeago`)
                VALUES 
                ("'.$userid.'","'.$user_group_id.'","'.$data['fname'].'","'.$data['pan'].'","'.$data['legal_idntfr'].'","'.$data['legal_idntfctn_no'].'","'.$data['aadhar'].'","'.$data['relationship'].'","'.$depdntnature.'","'.$newDate.'","'.$data['sex'].'","'.$data['address'].'","'.$data['eduqulfcn'].'","'.$data['relinstitute'].'","'.$data['relmobno'].'","'.$filepath.'","'.$data['shareholdng'].'","'.$data['adrsholdng'].'","'.$data['reloccupation'].'","'.$data['relcompany'].'","'.$data['rel_nation'].'",NOW(),NOW(),"'.$time.'")';

              // echo $query;exit;
               $exeget = $connection->query($query);

              
               if($exeget)
               {
                 $msg['status']=true;
                 $msg['message']="DATA INSERTED SUCCESSFULLY";
               }
               else
               {
                 $msg['status']=false;
                 $msg['message']="SOMETHING WENT TO WRONG";
               }
                    
      }
      catch(Exceptioon $e)
      {
                 $msg['status']=false;
                 $msg['message']="SOMETHING WENT TO WRONG";
      }
      return $msg;
    }
   public function getrelativedata($userid,$user_group_id){
       $connection = $this->dbtrd;
       $time = time();
       try{
             $query="SELECT rinfo.*,rel.`relationshipname` FROM `relative_info` rinfo 
             LEFT JOIN `relationship` rel ON rel.`id` = rinfo.`relationship`
             WHERE rinfo.`user_id`='".$userid."'";
             //print_r($query);exit;
             $exeget = $connection->query($query);
             $getnum = trim($exeget->numRows());
             if($getnum>0)
              {
                while($row = $exeget->fetch())
                    {
                        $getlist[] = $row;
                    }
              }
             else{
                   $getlist=array();
               }

           }
           catch(Exception $e)
           {
              $getlist=array();
           }
    return $getlist;
 }
    //#################Method usE to Delete Relation##########################
    public function delrelinfo($uid,$usergroup,$delid)
    {
      $connection = $this->dbtrd;
       $myarr=array();
       $time = time();
       try{
            $query="DELETE FROM relative_info WHERE id='".$delid."'";
            // print_r($query);exit;
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
         {  return false;  }  
  
  }
  public function singlerelative($uid,$usergroup,$releditid)
  {
      $connection = $this->dbtrd;
      
       $time = time();
       try{
             $query="SELECT * FROM `relative_info` WHERE id='".$releditid."'";
              // print_r($query);exit;
             $exeget = $connection->query($query);
             $getnum = trim($exeget->numRows());
             if($getnum>0)
              {
                while($row = $exeget->fetch())
                    {
                        $getlist= $row;
                    }
               
              }
             else{
                
                   $getlist=array();
               }

           }
           catch(Exception $e)
           {
              $getlist=array();
           }
     return $getlist;
  }
  

   public function updaterelative($uid,$usergroup,$data,$releditid,$filepath)
   {
       $connection = $this->dbtrd;
       $time = time();
       try
       {
              $originalDate = $data['dob'];
              $newDate = date("d-m-Y", strtotime($originalDate));
              $depdntnature = implode(',',$data['depnature']);
              //print_r($data);exit;
           
             $qry = 'UPDATE relative_info SET name ="'.$data['name'].'",pan ="'.$data['pan'].'",legal_identifier ="'.$data['legal_idntfr'].'",aadhar ="'.$data['aadhar'].'",dob ="'.$newDate.'",sex ="'.$data['sex'].'",address ="'.$data['address'].'",relationship ="'.$data['relationship'].'",dependency_nature ="'.$depdntnature.'",education ="'.$data['eduqulfcn'].'",institute ="'.$data['relinstituteup'].'",mobile ="'.$data['relmobnoup'].'",filepath ="'.$filepath.'",sharehldng ="'.$data['shareholdng'].'",adrshldng ="'.$data['adrsholdng'].'",occupation ="'.$data['reloccupationup'].'",company ="'.$data['relcompanyup'].'",nationality ="'.$data['rel_nation_update'].'",date_modified=NOW(),timeago="'.$time.'" WHERE id="'.$releditid.'" ';
             // echo $qry;exit;
             $exeget = $connection->query($qry);
             
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
      public function aadharvalidation($uid,$usergroup,$aadhar)
      {
        $connection = $this->dbtrd;
      
       $time = time();
       try{
             $query="SELECT * FROM `relative_info` WHERE aadhar='".$aadhar."' AND user_id='".$uid."'";
              // print_r($query);exit;
             $exeget = $connection->query($query);
             $getnum = trim($exeget->numRows());
             if($getnum>0)
              {
                return true;
               }
               else
               {
                return false;
               }
          }
          catch(Exception $exeget)
          {
              return true;
          }
      }
      
    public function panvalidation($uid,$usergroup,$pan)
      {
       $connection = $this->dbtrd;
      
       $time = time();
       try{
             $query="SELECT * FROM `relative_info` WHERE pan='".$pan."' AND user_id='".$uid."'";
              // print_r($query);exit;
             $exeget = $connection->query($query);
             $getnum = trim($exeget->numRows());
             if($getnum>0)
              {
                return true;
               }
               else
               {
                return false;
               }
          }
          catch(Exception $exeget)
          {
              return true;
          }   
      }
    
    public function insertpastemp($getuserid,$user_group_id,$empname,$designtn,$startdate,$enddate)
    {
        $connection = $this->dbtrd;
        $time = time();
        $queryinsert = "INSERT INTO `pastemployer`
        (`user_id`,`user_group_id`,`emp_name`, `emp_desigtn`,`startdate`,`enddate`,`date_added`, `date_modified`,`timeago`)
         VALUES ('".$getuserid."','".$user_group_id."','".$empname."','".$designtn."','".$startdate."','".$enddate."',NOW(),NOW(),'".$time."')"; 
        
        //print_r($queryinsert);exit;
        try
        {
            $exeprev = $connection->query($queryinsert);
            return true;
        }
        catch (Exception $e) 
        {
            //echo "checkng Exception";print_r($e);exit;
            return false;
        }
    }
    
    public function fetchpastemployer($getuserid,$user_group_id,$query)
    {
        $connection = $this->dbtrd;
        try
        {
            $queryselect = "SELECT * FROM `pastemployer` WHERE `user_id` = '".$getuserid."'".$query;
            // echo $query;exit;
            $exeget = $connection->query($queryselect);
            $getnum = trim($exeget->numRows());
            if($getnum>0)
                {
                    while($row = $exeget->fetch())
                    {
                        $getlist[] = $row;
                    }
                     //echo 'out';exit; 

                    //echo '<pre>';print_r($getlist);exit;

                }else{
                    $getlist = array();
                }
        }
        catch (Exception $e)
        {
            $getlist = array();
            //$connection->close();
        }
        
        return $getlist;
    }


   public function check_dateoverlap($getuserid,$user_group_id,$startdate,$enddate)
    {
        $connection = $this->dbtrd;
        //print_r($enddate);exit;
        try
        {
         $queryselect = "SELECT * FROM `pastemployer` WHERE `user_id` = '".$getuserid."'";
            // echo $query;exit;
            $exeget = $connection->query($queryselect);
            $getnum = trim($exeget->numRows());
            if($getnum>0)
                {
                    while($row = $exeget->fetch())
                    {
                        $getlist[] = $row;
                    }
                    //print_r($getlist);exit;
                    
                    for($i=0;$i<count($getlist);$i++)
                    {


                    if((strtotime($startdate) >= strtotime($getlist[$i]['startdate'])) && (strtotime($startdate) <= strtotime($getlist[$i]['enddate'])) || (strtotime($enddate) >= strtotime($getlist[$i]['startdate'])) && (strtotime($enddate) <= strtotime($getlist[$i]['enddate']))  )
                      {
                        
                           return true;
                      }
                      else
                      {
                        return false;
                      }
                    }

                }
        }
        catch (Exception $e)
        {
            return false;
            //$connection->close();
        }
        
        
    }
   
  
    public function fetchempedit($getuserid,$user_group_id,$id)
    {
        $connection = $this->dbtrd;
        try
        {
            $queryselect = "SELECT * FROM `pastemployer` WHERE `id` = '".$id."'";
            //echo $queryselect;exit;
            $exeget = $connection->query($queryselect);
            $getnum = trim($exeget->numRows());
            if($getnum>0)
                {
                    while($row = $exeget->fetch())
                    {
                        $getlist[] = $row;
                    } 

                    //echo '<pre>';print_r($getlist);exit;

                }else{
                    $getlist = array();
                }
        }
        catch (Exception $e)
        {
            $getlist = array();
            //$connection->close();
        }
        
        return $getlist;
    }
    
    public function updateemp($getuserid,$user_group_id,$empname,$designtn,$startdate,$enddate,$id)
    {
        $connection = $this->dbtrd;
        $time = time();
        $insertml =  "UPDATE `pastemployer` SET  `emp_name`='".$empname."' ,`emp_desigtn`='".$designtn."' ,
                    `startdate`='".$startdate."' , `enddate`='".$enddate."',`date_modified`=NOW(),`timeago`='".$time."' WHERE `id`='".$id."' ";
        
        //echo $insertml; exit;
        try
        { 
            $exeml = $connection->query($insertml);
            
            //$lastid    = $connectiondbloreal->lastInsertId();
            if($exeml)
            {
                
                    $returndta = array('status'=>true,'msg'=>'Updated Successfully !! '); 
        //        
            }
            else
            { $returndta = array('status'=>false,'msg'=>'Record Not updated !! ');   }
            
        }
        catch (Exception $e)
        {
            $returndta = array('status'=>false,'msg'=>'Record Not updated !! ');
        }
              
          
        return $returndta; 
    }
    
    /**************************** delete cmp in blackout period start *****************************/
    public function deleteempdetail($id)
    {
       $connection = $this->dbtrd;
        $queryget = "DELETE FROM `pastemployer` WHERE `id`= '".$id."'"; 
            
           try
           { 
                $exeml = $connection->query($queryget);

                //$lastid    = $connectiondbloreal->lastInsertId();
                if($exeml)
                {

                        $returndta = array('status'=>true,'msg'=>'Deleted Successfully !! '); 

                }
                else
                { $returndta = array('status'=>false,'msg'=>'Record Not Deleted !! ');   }
            
         }
        catch (Exception $e)
        {
            //print_r($e);exit;
            $returndta = array('status'=>false,'msg'=>'Record Not Deleted !! ');
        }
              
          
        return $returndta; 
    }
    /**************************** delete cmp in blackout period end *****************************/
     public function deletemfr($uid,$usergroup,$delid)
    {
       $connection = $this->dbtrd;
        $queryget = "DELETE FROM `mfr` WHERE `id`= '".$delid."'"; 
            
           try
           { 
                $exeml = $connection->query($queryget);

                //$lastid    = $connectiondbloreal->lastInsertId();
                if($exeml)
                {

                       return true;

                }
                else
                { return false;   }
            
         }
        catch (Exception $e)
        {
            //print_r($e);exit;
            return false;
        }
              
          
      
    }
    public function updatemfrindb($getuserid,$user_group_id,$mfrname,$mfrrelation,$mfreditid,$panup,$addressup,$transaction,$clientid,$mobile)
    {
       $time=time();
       $connection = $this->dbtrd;
       $queryupdate="UPDATE `mfr` SET `related_party`='".$mfrname."',`relationship`='".$mfrrelation."',`pan`='".$panup."',`address`='".$addressup."',`transaction`='".$transaction."',`clientid`='".$clientid."',`mobile`='".$mobile."',`date_modified`=NOW(),`timeago`='".$time."' WHERE id='".$mfreditid."'";
       //print_r($queryupdate);exit;
     
            try
        {
            $exeprev = $connection->query($queryupdate);
            if($exeprev)
            {
               return true;
            }
            else
            {
              return false;
            }
           
        }
        catch (Exception $e) 
        {
            //echo "checkng Exception";print_r($e);exit;
            return false;
        }
    }
    public function insertmfrindb($getuserid,$user_group_id,$mfrname,$mfrrelation,$pan,$address,$transaction,$clientid,$mobile)
    {
        $connection = $this->dbtrd;
        $time=time();
        $queryinsert = "INSERT INTO `mfr`
        (`user_id`,`user_group_id`,`related_party`,`relationship`,`pan`,`address`,`transaction`,`clientid`,`mobile`,`date_added`,`date_modified`,`timeago`)
         VALUES ('".$getuserid."','".$user_group_id."','".$mfrname."','".$mfrrelation."','".$pan."','".$address."','".$transaction."','".$clientid."','".$mobile."',NOW(),NOW(),'".$time."')"; 
        
        // print_r($queryinsert);exit;
        try
        {
            $exeprev = $connection->query($queryinsert);
            if($exeprev)
            {
               return true;
            }
            else
            {
              return false;
            }
           
        }
        catch (Exception $e) 
        {
            //echo "checkng Exception";print_r($e);exit;
            return false;
        }
    }

       public function  getmfrdata($uid,$usergroup)
    {
        $connection = $this->dbtrd;
        try
        {
            $queryselect = "SELECT * FROM `mfr` WHERE `user_id` = '".$uid."'";
            //echo $queryselect;exit;
            $exeget = $connection->query($queryselect);
            $getnum = trim($exeget->numRows());
            if($getnum>0)
                {
                    while($row = $exeget->fetch())
                    {
                        $getlist[] = $row;
                    } 

                    //echo '<pre>';print_r($getlist);exit;

                }else{
                    $getlist = array();
                }
        }
        catch (Exception $e)
        {
            $getlist = array();
            //$connection->close();
        }
        
        return $getlist;
    }
    
     public function  fetchmfrdataedit($uid,$usergroup,$id)
    {
        $connection = $this->dbtrd;
        try
        {
            $queryselect = "SELECT * FROM `mfr` WHERE `id` = '".$id."'";
            //echo $queryselect;exit;
            $exeget = $connection->query($queryselect);
            $getnum = trim($exeget->numRows());
            if($getnum>0)
                {
                    while($row = $exeget->fetch())
                    {
                        $getlist[] = $row;
                    } 

                    //echo '<pre>';print_r($getlist);exit;

                }else{
                    $getlist = array();
                }
        }
        catch (Exception $e)
        {
            $getlist = array();
            //$connection->close();
        }
        
        return $getlist;
    }
    
    public function fetchrelatedparty($uid,$usergroup)
    {
        $connection = $this->dbtrd;
        try
        {
            $queryselect = "SELECT * FROM `mfr` WHERE `user_id` = '".$uid."'";
            //echo $queryselect;exit;
            $exeget = $connection->query($queryselect);
            $getnum = trim($exeget->numRows());
            if($getnum>0)
                {
                    while($row = $exeget->fetch())
                    {
                        $getlist[] = $row;
                    } 

                    //echo '<pre>';print_r($getlist);exit;

                }else{
                    $getlist = array();
                }
        }
        catch (Exception $e)
        {
            $getlist = array();
        }
        return $getlist;
    }
    
    public function cmpdetails($getsearchkywo)
    {
        $connection = $this->dbtrd;
        try
         {
             $queryget = "SELECT *  FROM `listedcmpmodule` WHERE `company_name` LIKE '%{$getsearchkywo}%'";
            
            $exeget = $connection->query($queryget);
            $getnum = trim($exeget->numRows());

            if($getnum>0)
            {
                while($row = $exeget->fetch())
                {
                    $getlist[] = $row;
                }
                  
                    
                //echo '<pre>';print_r($getlist);exit;
                
            }else{
                $getlist = array();
            }
        }
        catch (Exception $e)
        {
            $getlist = array();
            //$connection->close();
        }
        
        return $getlist;
    }
    
    public function trnsctntypes()
    {
        $connection = $this->dbtrd;
        try
         {
             $queryget = "SELECT *  FROM `trade_transaction`";
            
            $exeget = $connection->query($queryget);
            $getnum = trim($exeget->numRows());

            if($getnum>0)
            {
                while($row = $exeget->fetch())
                {
                    $getlist[] = $row;
                }
                  
                    
                //echo '<pre>';print_r($getlist);exit;
                
            }else{
                $getlist = array();
            }
        }
        catch (Exception $e)
        {
            $getlist = array();
            //$connection->close();
        }
        
        return $getlist;
    }
    
    public function inserttrdintimtn($getuserid,$user_group_id,$nameofcomp,$relatedparty,$secutype,$trnscntype,$noofshares,$transdate)
    {
        $connection = $this->dbtrd;
        $time = time();
        if($trnscntype == 5)
        {
           $queryinsert = "INSERT INTO `trade_intimation` (`user_id`,`user_group_id`,`cmp_id`,`related_party`,`transctn_type`,`noofshares`,`security_type`,`transaction_date`,`date_added`,`date_modified`,`timeago`)
         VALUES ('".$getuserid."','".$user_group_id."','".$nameofcomp."','".$relatedparty."','".$trnscntype."','".$noofshares."','".$secutype."',NULL,NOW(),NOW(),'".$time."')";  
        }
        else
        {
          $queryinsert = "INSERT INTO `trade_intimation` (`user_id`,`user_group_id`,`cmp_id`,`related_party`,`transctn_type`,`noofshares`,`security_type`,`transaction_date`,`date_added`,`date_modified`,`timeago`)
         VALUES ('".$getuserid."','".$user_group_id."','".$nameofcomp."','".$relatedparty."','".$trnscntype."','".$noofshares."','".$secutype."','".$transdate."',NOW(),NOW(),'".$time."')";   
        }
        
        
        //print_r($queryinsert);exit;
        try
        {
            $exeprev = $connection->query($queryinsert);
            if($exeprev)
            {
               return true;
            }
            else
            {
              return false;
            }
           
        }
        catch (Exception $e) 
        {
            //echo "checkng Exception";print_r($e);exit;
            return false;
        }
    }
    
    public function fetchtradeeintimtn($uid,$usergroup)
    {
        $connection = $this->dbtrd;
        try
         {
            $queryget = "SELECT trd.*,cmp.`company_name`,secu.`security_type`,trans.`transaction`,materl.`related_party` 
                FROM `trade_intimation`  trd
                LEFT JOIN `listedcmpmodule` cmp ON cmp.`id` = trd.`cmp_id`
                LEFT JOIN `req_securitytype` secu ON secu.`id` = trd.`security_type`
                LEFT JOIN `trade_transaction` trans ON trans.`id` = trd.`transctn_type`
                LEFT JOIN `mfr` materl ON materl.`id` = trd.`related_party`
                WHERE trd.`user_id`='".$uid."'";
            //echo $queryget;exit;
            $exeget = $connection->query($queryget);
            $getnum = trim($exeget->numRows());

            if($getnum>0)
            {
                while($row = $exeget->fetch())
                {
                    $getlist[] = $row;
                }
                  
                    
                //echo '<pre>';print_r($getlist);exit;
                
            }else{
                $getlist = array();
            }
        }
        catch (Exception $e)
        {
            $getlist = array();
            //$connection->close();
        }
        
        return $getlist;
    }
    
     public function fetchtradeeintimtnedit($uid,$usergroup,$editid)
     {
        $connection = $this->dbtrd;
        try
         {
            $queryget = "SELECT trd.*,cmp.`company_name`,secu.`security_type` as secutype,trans.`transaction`,materl.`related_party` as partyname 
                FROM `trade_intimation`  trd
                LEFT JOIN `listedcmpmodule` cmp ON cmp.`id` = trd.`cmp_id`
                LEFT JOIN `req_securitytype` secu ON secu.`id` = trd.`security_type`
                LEFT JOIN `trade_transaction` trans ON trans.`id` = trd.`transctn_type`
                LEFT JOIN `mfr` materl ON materl.`id` = trd.`related_party`
                WHERE trd.`id`='".$editid."'";
            //echo $queryget;exit;
            $exeget = $connection->query($queryget);
            $getnum = trim($exeget->numRows());

            if($getnum>0)
            {
                while($row = $exeget->fetch())
                {
                    $getlist[] = $row;
                }
                  
                    
                //echo '<pre>';print_r($getlist);exit;
                
            }else{
                $getlist = array();
            }
        }
        catch (Exception $e)
        {
            $getlist = array();
            //$connection->close();
        }
        
        return $getlist;
    }
    
    public function updatetrdintimtn($getuserid,$user_group_id,$nameofcomp,$relatedparty,$secutype,$trnscntype,$noofshares,$transdate,$updateid)
    {
        $connection = $this->dbtrd;
        $time = time();
        if($trnscntype == 5)
        {
           $queryinsert = "UPDATE `trade_intimation` SET `cmp_id`='".$nameofcomp."',`related_party`='".$relatedparty."',`transctn_type`='".$trnscntype."',`security_type`='".$secutype."',`noofshares`='".$noofshares."',`transaction_date`=NULL,`date_modified`=NOW(),`timeago`='".$time."' WHERE `id`='".$updateid."'";  
        }
        else
        {
          $queryinsert = "UPDATE `trade_intimation` SET  `cmp_id`='".$nameofcomp."',`related_party`='".$relatedparty."',`transctn_type`='".$trnscntype."',`security_type`='".$secutype."',`noofshares`='".$noofshares."',`transaction_date`='".$transdate."',`date_modified`=NOW(),`timeago`='".$time."' WHERE `id`='".$updateid."'";  
        }
        
        
        //print_r($queryinsert);exit;
        try
        {
            $exeprev = $connection->query($queryinsert);
            if($exeprev)
            {
               return true;
            }
            else
            {
              return false;
            }
           
        }
        catch (Exception $e) 
        {
            //echo "checkng Exception";print_r($e);exit;
            return false;
        }
    }
    
      public function trdintimtndelete($uid,$usergroup,$delid)
      {

           $connection = $this->dbtrd;
           $time = time();
            try
            {
              $sql = "DELETE FROM `trade_intimation` WHERE id='".$delid."'";
              $exeget = $connection->query($sql);
                   // print_r($sql);exit;
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



          public function sendrequest($getuser)
          {
              $connection = $this->dbtrd;
              $time = time();
               try{
                      $queryup = "UPDATE `personal_info` SET `send_status`='1',`approved_status`='',`date_modified`=NOW() WHERE userid='".$getuser."'";  //echo 
                      $exegetqry = $connection->query($queryup);
                      // print_r($queryup);exit;
                           
                    
                       
                         if($exegetqry)
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


  public function sendmailforaprovel($uid,$fullname)
  {
        $connection = $this->dbtrd;
        try
         {
             $queryget = "SELECT approvid FROM it_memberlist WHERE  wr_id='".$uid."'";
             $getmasterid = $this->tradingrequestcommon->getmasterid($uid);
             // print_r($getmasterid);exit;
            
            $exeget = $connection->query($queryget);
            $getnum = trim($exeget->numRows());

            if($getnum>0)
            {
                while($row = $exeget->fetch())
                {
                    $getlist[] = $row;
                }
                  
                $allid=$getlist[0]['approvid'].",".$getmasterid['user_id'];
                $queryget2 = "SELECT email FROM it_memberlist WHERE  wr_id IN($allid)";
                // print_r($queryget2);exit;             
                $exeget2 = $connection->query($queryget2);
                $getnum2 = trim($exeget2->numRows());


              if($getnum2>0)
              {
                while($row = $exeget2->fetch())
                {
                    $mailids[] = $row;
                }
                    
                  for($i=0;$i<count($mailids);$i++)
                  {
                     $result = $this->emailer->sendmailforpersinfo($mailids[$i]['email'],$fullname); 
                  }
              }
                
            }

            else
            {
               return false;
            }
        }
        catch (Exception $e)
        {
            return false;
            //$connection->close();
        }
        
        
  }
    
  public function checkpersonalinfo($uid,$usergroup)
  {
    $connection = $this->dbtrd;
    $queryget = "SELECT * FROM `personal_info`  WHERE `userid` = '".$uid."' ";
    $getlist=array();
    try
    {
        $exeget = $connection->query($queryget);
        $getnum = trim($exeget->numRows());
        // $getlist=array();
        if($getnum>0)
        {
            return true;
        }
        else
        {
            return false;
        }     
    }
    catch(Exceptioon $e)
    {
        return false;
    }
  }

    public function updatepastemp($getuserid,$user_group_id,$empname,$designtn,$startdate,$enddate,$id)
    {
        $connection = $this->dbtrd;
        $time = time();
       
         $queryupdate =  "UPDATE `pastemployer` SET `emp_name` = '".$empname."' , `emp_desigtn` = '".$designtn."' ,`enddate` = '".$enddate."',`startdate` = '".$startdate."' ,`date_added` = NOW() ,`date_modified` = NOW(),`timeago` = '".$time."' WHERE id = '".$id."' ";
        
       // print_r($queryupdate);exit;
        try
        {
            $exeprev = $connection->query($queryupdate);
            return true;
        }
        catch (Exception $e) 
        {
            //echo "checkng Exception";print_r($e);exit;
            return false;
        }
    }


  }



<?php
use Phalcon\Mvc\User\Component;

class Exceptionreqcommon extends Component
{


     public function getaccdetails($getuserid,$usergroup)
    {
        $connection = $this->dbtrd;
        //echo "wait here ";exit;
        $queryget = "SELECT * FROM `user_demat_accounts` WHERE user_id = '".$getuserid."'";

        //echo $queryget;  exit;

         try{
                $exeget = $connection->query($queryget);
                $getnum = trim($exeget->numRows());

                if($getnum>0)
                {
                    while($row = $exeget->fetch())
                    {
                        $getlist[] = $row;
                    }
                    //echo '<pre>';print_r($getlist);exi//
                }
                else{
                    $getlist = array();
                }
            }
            catch (Exception $e)
            {
                $getlist = array();
                //$connection->close();
            }
        //echo '<pre>';print_r($getlist);exit;
        return $getlist;
    }
    public function getuseracc($getuserid,$usergroup,$reqid,$typeofreq)
    {
        $connection = $this->dbtrd;
        //echo "wait here ";exit;
        // print_r($typeofreq);exit;
        if($typeofreq==1)
        {
            $queryget = "SELECT * FROM `user_demat_accounts` WHERE user_id = '".$getuserid."'";
        }
        elseif ($typeofreq==2) {
           $qry = "SELECT relative_id FROM `personal_request` WHERE id = '".$reqid."'";
           $exeget = $connection->query($qry);
           $getnum = trim($exeget->numRows());
           if($getnum>0)
           {
             $row = $exeget->fetch();
             $queryget = "SELECT * FROM `relative_demat_accounts` WHERE rel_user_id = '".$row['relative_id']."'";
           }
           
        }
      

        // echo $queryget;  exit;

         try{
                $exeget = $connection->query($queryget);
                $getnum = trim($exeget->numRows());

                if($getnum>0)
                {
                    while($row = $exeget->fetch())
                    {
                        $getlist[] = $row;
                    }
                    //echo '<pre>';print_r($getlist);exi//
                }
                else{
                    $getlist = array();
                }
            }
            catch (Exception $e)
            {
                $getlist = array();
                //$connection->close();
            }
        // echo '<pre>';print_r($getlist);exit;
        return $getlist;
    }
  public function getusercmp($getuserid,$usergroup,$search)
    {

        // print_r($getuserid);exit;
        $connection = $this->dbtrd;
        $mydate=date('d-m-Y');
        $queryget = "SELECT listed_company FROM `companytrading_period`  WHERE restriction_to >'".$mydate."' OR restriction_to IS  NULL";
        $querygetnxt = "SELECT listedcompany FROM `employeerestriction` WHERE FIND_IN_SET('".$getuserid."',`employee`) AND restriction_to > '$mydate' OR restriction_to IS  NULL";
         // print_r($queryget);exit;

         try{
                $exeget = $connection->query($queryget);
                $exegetnxt = $connection->query($querygetnxt);
                $getnum = trim($exeget->numRows());
                $getnumnxt = trim($exegetnxt->numRows());
                $getlist=array();
                $getlistnxt=array();
                if($getnum>0)
                {
                    while($row = $exeget->fetch())
                    {$getlist[] = $row;}
                }
                else
                {
                    $getlist = array();
                 }

                if($getnumnxt>0)
                {
                    while($row = $exegetnxt->fetch())
                    {
                        $getlistnxt[] = $row;
                    }
                }

                else
                {
                   
                    $getlistnxt = array();
                }
           
                  // print_r($getlistnxt);exit;   
                $newarray=array_merge($getlist,$getlistnxt);
                 // print_r($newarray);exit;
                 if(!empty($newarray))
                    {
                
                            for($i=0;$i<sizeof($newarray);$i++){

                               $myarr[]=$newarray[$i][0];
                            }
                             $restrcmp= implode(",",$myarr);

                           $query="SELECT id,company_name FROM listedcmpmodule WHERE id NOT IN ($restrcmp) AND company_name LIKE '%".$search."%'";
                         
                     }
     
                 else{
     

                            $query="SELECT id,company_name FROM listedcmpmodule WHERE company_name LIKE '%".$search."%'";
                    }
          
                      // print_r($query);exit;
          //################################GET ALL COMPANIES EXCEPT RESTRICTED##############################################//
                          $exeget = $connection->query($query);
                          $getcount = trim($exeget->numRows());
                          if($getcount>0)
                          {
                            while($row = $exeget->fetch())
                            {
                                $companys[] = $row;
                            }
                           
                          }
                        else
                           {
                                $companys = array();
                            } 

              }catch (Exception $e)
               {
                  $companys = array();
               }
     return $companys;
    }
//############################################################GET APPROVER ID###############################################


    public function userdetails($uid,$usergroup)
    {

        $connection = $this->dbtrd;
        //echo "wait here ";exit;
        $queryget = "SELECT * FROM `it_memberlist` WHERE wr_id = '".$uid."'";

        //echo $queryget;  exit;

         try{
                $exeget = $connection->query($queryget);
                $getnum = trim($exeget->numRows());

                if($getnum>0)
                {
                  
                        $getlist =$exeget->fetch();
                   
                }
                else{
                    $getlist = array();
                }
            }
            catch (Exception $e)
            {
                $getlist = array();
                //$connection->close();
            }
        //echo '<pre>';print_r($getlist);exit;
        return $getlist;

    }

    public function exccreaterequest($uid,$usergroup,$data,$send_status)
    {
        //print_r($data);exit;
        $connection = $this->dbtrd;
        $time = time();
        
        if($data['typeofrequest']==2)
        {
            $reetiveid=$data['selrelative'];
        }
        else
        {
            $reetiveid='';
        }

       $query = "INSERT INTO `personal_request`
            (`user_id`,`user_group`,`type_of_request`,`relative_id`,`name_of_requester`,`sectype`,`id_of_company`,`no_of_shares`,
            `type_of_transaction`,`approver_id`,`send_status`,`approved_status`,
            `date_added`,`date_modified`,`timeago`)
             VALUES ('".$uid."','".$usergroup."','".$data['typeofrequest']."','".$reetiveid."','".$data['reqname']."','".$data['sectype']."','".$data['idofcmp']."','".$data['noofshare']."','".$data['typeoftrans']."','".$data['approverid']."','".$send_status."','0',NOW(),NOW(),'".$time."')";  
       //echo $query;exit;
        
        try
        {
            $exeget = $connection->query($query);
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
    
    
    public function excgettradingrequest($uid,$usergroup,$mainqry)
    {
        $connection = $this->dbtrd;
        //echo "wait here ";exit;

                        
        $queryget = "SELECT pr.*, cmpdl.`company_name` as `mycompany`, 
            `newrp`.relationshipname as relationship, relative.`name`, 
            rt.`request_type`, 
            ts.`id` as `myid`, ts.`file`, ts.`date_of_transaction`, ts.`excepapp_status`, 
            ts.`id` as `tradeid`, ts.`rej_message` as `rejmessage`,
            obj.`transaction`, sec.`security_type`
            FROM `personal_request` pr 
            LEFT JOIN `listedcmpmodule` cmpdl ON cmpdl.`id` = pr.`id_of_company` 
            LEFT JOIN `relative_info` relative ON relative.`id` = pr.`relative_id` 
            LEFT JOIN `request_type` rt ON rt.`id` = pr.`type_of_request` 
            LEFT JOIN `trading_status` ts ON ts.`req_id` = pr.`id` 
            LEFT JOIN `type_of_transaction` obj ON obj.`id`=pr.`type_of_transaction`
            LEFT JOIN relationship newrp ON `newrp`.id=`relative`.relationship
            JOIN `req_securitytype` sec ON sec.`id` = pr.`sectype`
            WHERE (ts.`excep_approv`='1' OR pr.`sent_contraexeaprvl`='1') AND pr.`user_id`='".$uid."' ORDER BY pr.`id` DESC ".$mainqry;
            //echo '<pre>';print_r($queryget); exit;     

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
                else
                {
                    $getlist = array();
                }
            }
            catch (Exception $e)
            {
                $getlist = array();
                //$connection->close();
            }
            //echo '<pre>';print_r($getlist);exit;
            return $getlist;
    }

    public function subuserreqapproval($uid,$usergroup,$mainqry)
    {
        $connection = $this->dbtrd;
        //echo "wait here ";exit;
        if($usergroup!=2)
        {
            $queryget = "SELECT pr.*, 
                obj.`date_of_transaction`, obj.`file`, obj.`excepapp_status`, obj.`id` as `tradeid`, obj.`rej_message` as `rejmsg`,
                cmpdl.`company_name` as `mycompany`, 
                `newrp`.relationshipname as relationship, relative.`name`, rt.`request_type`, ts.`transaction`,
                sec.`security_type`, 
                memb.`deptaccess` AS `department` 
                FROM `personal_request` pr
                LEFT JOIN `trading_status` obj ON obj.`req_id`=pr.`id`
                LEFT JOIN `listedcmpmodule` cmpdl ON cmpdl.`id` = pr.`id_of_company` 
                LEFT JOIN `relative_info` relative ON relative.`id` = pr.`relative_id` 
                LEFT JOIN `request_type` rt ON rt.`id` = pr.`type_of_request` 
                LEFT JOIN `type_of_transaction` ts ON ts.`id`=pr.`type_of_transaction`
                LEFT JOIN `req_securitytype` sec ON sec.`id` = pr.`sectype`
                LEFT JOIN `it_memberlist` memb ON memb.`wr_id` =  pr.`user_id`
                LEFT JOIN `con_dept` dpt ON memb.`deptaccess` = dpt.`id`
                LEFT JOIN relationship newrp ON `newrp`.id=`relative`.relationship
                WHERE (obj.`excep_approv`='1' OR pr.`sent_contraexeaprvl`='1') AND FIND_IN_SET('".$uid."',pr.`approver_id`) ORDER BY pr.`id` DESC ".$mainqry;
            //echo $queryget;exit;
        }
        else
        {
            $allusers=$this->tradingrequestcommon->getalluserformain($uid);
            $alluserid= implode(",",$allusers);
         
            $queryget = "SELECT pr.*, ts.`transaction`, cmpdl.`company_name` as `mycompany`, 
                `newrp`.relationshipname as relationship, relative.`name`, rt.`request_type`, 
                obj.`date_of_transaction`, obj.`file`, sec.`security_type`, obj.`excepapp_status`, 
                obj.`id` as `tradeid`, obj.`rej_message` as `rejmsg`,
                memb.`deptaccess` AS `department`
                FROM `personal_request` pr
                LEFT JOIN `type_of_transaction` ts ON ts.`id`=pr.`type_of_transaction`
                LEFT JOIN `listedcmpmodule` cmpdl ON cmpdl.`id` = pr.`id_of_company` 
                LEFT JOIN `relative_info` relative ON relative.`id` = pr.`relative_id`
                LEFT JOIN `request_type` rt ON rt.`id` = pr.`type_of_request` 
                LEFT JOIN `trading_status` obj ON obj.`req_id`=pr.`id`
                LEFT JOIN `req_securitytype` sec ON sec.`id` = pr.`sectype`
                LEFT JOIN `it_memberlist` memb ON memb.`wr_id` =  pr.`user_id`
                LEFT JOIN `con_dept` dpt ON memb.`deptaccess` = dpt.`id`
                LEFT JOIN relationship newrp ON `newrp`.id=`relative`.relationship
                WHERE (obj.`excep_approv`='1' OR pr.`sent_contraexeaprvl`='1') AND pr.`user_id` IN (".$alluserid.") ORDER BY pr.`id` DESC ".$mainqry;
            //echo $queryget;exit;
        }
        //echo $queryget;exit;

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
                else{
                    $getlist = array();
                }
             
            }
            catch (Exception $e)
            {
                $getlist = array();
                //$connection->close();
            }
            //echo '<pre>';print_r($getlist);exit;
            return $getlist;
      }

      public function excdelpersonalreq($uid,$usergroup,$delid,$reqtype)

      {
           $connection = $this->dbtrd;
           $myarr=array();
           $time = time();
          try{
            if($reqtype == 'trade')
            {
                $query="DELETE FROM trading_status WHERE id='".$delid."'";
            }
            else if($reqtype == 'personal')
            {
                $query="DELETE FROM `personal_request` WHERE id='".$delid."'";
            }
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

         }catch(Exception $e){
           return false;
        }
      }

      public function excgetsinglereq($uid,$usergroup,$editid)
      {
           $connection = $this->dbtrd;
        //echo "wait here ";exit;
          $queryget = "SELECT * FROM `personal_request` WHERE id = '".$editid."'";

        //echo $queryget;  exit;

         try{
                $exeget = $connection->query($queryget);
                $getnum = trim($exeget->numRows());

                if($getnum>0)
                {
                  
                   $getlist = $exeget->fetch();
                 
                   
                }
                else{
                    $getlist = array();
                }
            }
            catch (Exception $e)
            {
                $getlist = array();
                //$connection->close();
            }
        //echo '<pre>';print_r($getlist);exit;
        return $getlist;
        }


        public function updaterequest($uid,$usergroup,$editid,$data)
        {
            $connection = $this->dbtrd;
            $time = time();
            if($data['typeofrequest']==2)
            {
                $relativeid=$data['selrelative'];
            }
            else
            {
               $relativeid='';
            }

            $query = "UPDATE `personal_request` SET  `sectype`='".$data['sectype']."',`type_of_request`='".$data['typeofrequest']."',`relative_id`='".$relativeid."',
            `id_of_company`='".$data['idofcmp']."',`no_of_shares`='".$data['noofshare']."',`type_of_transaction`='".$data['typeoftrans']."',
            `date_modified`=NOW() WHERE id='".$editid."'";
                   
             try{
                   $exeget = $connection->query($query);
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

        public function sendmultiplereq($uid,$usergroup,$selctedid)
       {
            $connection = $this->dbtrd;
            $time = time();
            $msg=array();
            $selctedid = explode(',',$selctedid);
              //print_r($selctedid);exit;
            try{

                  for($i=0;$i<sizeof($selctedid);$i++)
                  {
                       $query = "UPDATE `personal_request` SET  `send_status`='1',`approved_status`=NULL WHERE id='".$selctedid[$i]."'";   
                            //print_r($query);exit;
                         $exeget = $connection->query($query);
                      
                       if($exeget)
                       {
                          $msg['status']=true;
                          $msg['message']="Record Sent Successfully";
                          continue;

                        }
                      else
                      {
                         $msg['status']=false;
                         $msg['message']="Something Went to Wrong";
                         break;
                       } 
                   }
                }
              catch(Exception $e)
              {
                
                 $msg['status']=false;
                $msg['message']="Something Went to Wrong";
              }

              return $msg;
       }

        public function acceptapprovel($uid,$usergroup,$selctedid,$myid)
       {
            $connection = $this->dbtrd;
            $time = time();
            $msg=array();
          //  $selctedid = explode(',',$selctedid);
            try{

                  for($i=0;$i<sizeof($selctedid);$i++)
                  {
                      
                      if($selctedid[$i] == 'null')
                      {
                        $getmasterid = $this->tradingrequestcommon->getmasterid($uid);
                        $queryget = "SELECT * FROM  `trading_days` WHERE `user_id`='".$getmasterid['user_id']."'";
                        $exeget = $connection->query($queryget);
                        $getnum = trim($exeget->numRows());

                        if($getnum>0)
                        {
                            $row = $exeget->fetch();
                            $mydate=date('d-m-Y');
                            $tradedate=date('d-m-Y', strtotime($mydate. ' + '.$row['noofdays'].' days'));
                            $year = date('Y');
                            if($myid<10)
                            {
                               $myid1 = '0'.$myid;
                            }
                            $approverno = 'PCT-'.$myid1.'/'.$year;
                        }
                        else
                        {
                            $tradedate = '';
                        }
                         $querychk = "UPDATE `personal_request` SET  `contraexcapvsts`='1',`contraexcapvdte`=NOW(),`trading_date`='".$tradedate."'  WHERE id='".$myid."'";
                          //echo $querychk;exit;
                         $exeget = $connection->query($querychk);
                      }
                      else
                      {
                      
                         $query = "UPDATE `trading_status` SET  `excepapp_status`='1',`excepapprv_date`=NOW()  WHERE id='".$selctedid[$i]."'";   
                          $querychk = "UPDATE `personal_request` SET  `exception_approve`='0'  WHERE id='".$myid."'";
                          $exeget = $connection->query($query);
                          $exeget1 = $connection->query($querychk);
                       }
                       
                       //print_r($query);exit;
                       if($exeget)
                       {
                          $msg['status']=true;
                          $msg['message']="Record Approved Successfully";
                          continue;

                        }
                      else
                      {
                         $msg['status']=false;
                         $msg['message']="Something Went to Wrong";
                         break;
                       } 
                   }
                }
              catch(Exception $e)
              {
                
                 $msg['status']=false;
                 $msg['message']="Something Went to Wrong";
              }

              return $msg;
       }



      public function uploadtradingfile($uid,$usergroup,$reqid,$target_file,$data)
       {
           //print_r($data);exit;
            $connection = $this->dbtrd;
            $time = time();
            
            try{

                 $queryget = "SELECT * FROM `trading_status` WHERE req_id = '".$reqid."'";
                 
                 $exeget = $connection->query($queryget);
                 $getnum = trim($exeget->numRows());
                  $getlist= array();
                if($getnum>0)
                { 
	                   $link='<a href="'.$target_file.'"><i class="fa fa-download" style="font-size:15px;color:black;"></i></a>';

	                  $query="UPDATE trading_status SET `id_of_company` = '".$data['compid']."' ,`sectype` = '".$data['sectype']."',no_of_share = '".$data['noofshare']."', price_per_share ='".$data['priceofshare']."',total_amount='".$data['total']."',demat_acc_no='".$data['dmatacc']."',trading_status='1',file='".$link."',date_of_transaction='".$data['transdate']."' WHERE req_id='".$reqid."'";
	                  //  $getlist['status']=false;
	                  //  $getlist['message']="you Have Already uploaded File"; 
	                  // return $getlist;
	                  // print_r($query);exit;

                 }
                  else
                  {

	                     $link='<a href="'.$target_file.'"><i class="fa fa-download" style="font-size:15px;color:black;"></i></a>';
	                     $query = "INSERT INTO  `trading_status` (req_id, user_id, user_group_id,`id_of_company`,`sectype`,no_of_share,price_per_share,trading_status,total_amount,demat_acc_no,file,date_of_transaction,date_added,date_modified,timeago) VALUES ('".$reqid."','".$uid."','".$usergroup."','".$data['compid']."','".$data['sectype']."','".$data['noofshare']."','".$data['priceofshare']."','1','".$data['total']."','".$data['dmatacc']."','".$link."','".$data['transdate']."',NOW(),NOW(),'".$time."')";  
                  }
                    // print_r($query);exit;
                   $exeget = $connection->query($query);
                
               
                  if($exeget)
                  {
	                    $link='<a href="'.$target_file.'"><i class="fa fa-download" style="font-size:15px;color:black;"></i></a>';
	  
	                     $queryup = "UPDATE `personal_request` SET `exception_approve`='".$data['exceptinappr']."',`date_modified`='".$time."' WHERE id='".$reqid."'";  
	                     $exeget = $connection->query($queryup);
	                     // print_r($queryup);exit;
	                    
	                      $queryselectreltv = "SELECT * FROM `personal_request` WHERE id='".$reqid."' AND relative_id = ''";
	                      $exegetselectretv = $connection->query($queryselectreltv);
	                      $getnumselectretv = trim($exegetselectretv->numRows());
                      if($getnumselectretv != 0)
                      {
	                         $queryselect = "SELECT * FROM `opening_balance` WHERE id_of_company = '".$data['compid']."'";
	                     
	                         $exegetselect = $connection->query($queryselect);
	                         $getnumselect = trim($exegetselect->numRows());
                         if($getnumselect == 0)
                         {
                             $queryinsert = "INSERT INTO `opening_balance`
                             (`user_id`,`user_group_id`,`id_of_company`,`equityshare`,`prefershare`,`debntrshare`,`sectype`,`from`,`date_added`, `date_modified`,`timeago`)
                             VALUES ('".$uid."','".$usergroup."','".$data['compid']."','0','0','0','".$data['sectype']."','request',NOW(),NOW(),'".$time."')";
                             $exegetinsrt = $connection->query($queryinsert);
                         }
                      }
                      
                   
                     // $exegetinsrt = $connection->query($queryinsert);
                     if($exeget){
                       // print_r($queryinsert);exit;

                          return true;
                     }
                     else
                     {
                           return false;
                     }
                    
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
       public function rejectreq($uid,$usergroup,$rejectid,$message)
       {
            $connection = $this->dbtrd;
            $time = time();
            try{
      
                 $query = "UPDATE `trading_status` SET  `excepapp_status`='2',`rej_message`='".$message."' WHERE id='".$rejectid."'";

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

       public function checktradestatus($uid,$usergroup,$reqid)
       {
            $connection = $this->dbtrd;
            $time = time();
            $getlist= array();
            try{

	                 $queryget = "SELECT * FROM `trading_status` WHERE req_id = '".$reqid."' AND user_id='".$uid."' ";
	                 $exeget = $connection->query($queryget);
	                 $getnum = trim($exeget->numRows());

	                if($getnum>0)
	                { 
	                    $getlist['status']=true;
	                    $getlist['data'] = $exeget->fetch();
	                 }
	                 else{

	                     $getlist['status']=false;
	                     $getlist['data'] ='';

	                 }
               }
               catch(Exception $e)
               {
                    $getlist['status']=false;
                     $getlist['data'] ='';
               }

            return $getlist;
       }
       public function notdonetrade($uid,$usergroup,$reqid)
       { 
               $connection = $this->dbtrd;
               $time = time();
                try{


                     
                       
                           $queryup = "INSERT INTO  `trading_status` (req_id, user_id, user_group_id,trading_status,date_added,date_modified,timeago) 
                                       VALUES   ('".$reqid."','".$uid."','".$usergroup."','0',NOW(),NOW(),'".$time."')";  

                      
                           $queryupnxt = "UPDATE `personal_request` SET `trading_status`='0' WHERE id='".$reqid."'";  
                           // $queryup2 = "UPDATE `trading_status` SET `file`=''  WHERE id='".$reqid."'";  
                       
                       

                     
                             $exegetqry = $connection->query($queryup);
                             $exegetqrynxt = $connection->query($queryupnxt);

                         // $exegetqry2 = $connection->query($queryup2);
                       
                         if($exegetqry and $exegetqrynxt)
                         {
  
                           return true;
                         }
                         else
                         {
                             return false;
                         }
                     
                    }
                    catch(Exception $e){
                        return false;
                    }
            }

     public function excsuccessstatus($uid,$usergroup,$reqid)
     { 
        $connection = $this->dbtrd;
        //echo "wait here ";exit;
        $getlist = array();
        $queryget = "SELECT * FROM `trading_status` WHERE id = '".$reqid."'";

        //echo $queryget;  exit;

         try{
                $exeget = $connection->query($queryget);
                $getnum = trim($exeget->numRows());

                if($getnum>0)
                {
                    while($row = $exeget->fetch())
                    {
                        $getlist = $row;
                    }
                    //echo '<pre>';print_r($getlist);exi//
                }
                else{
                    $getlist = array();
                }
            }
            catch (Exception $e)
            {
                $getlist = array();
                //$connection->close();
            }
        //echo '<pre>';print_r($getlist);exit;
        return $getlist;
    }
         
     public function securitytype()
     { 
        $connection = $this->dbtrd;
        //echo "wait here ";exit;
        $getlist = array();
        $queryget = "SELECT * FROM `req_securitytype`";

        //echo $queryget;  exit;

         try{
                $exeget = $connection->query($queryget);
                $getnum = trim($exeget->numRows());

                if($getnum>0)
                {
                    while($row = $exeget->fetch())
                    {
                        $getlist[] = $row;
                    }
                    //echo '<pre>';print_r($getlist);exi//
                }
                else{
                    $getlist[] = array();
                }
            }
            catch (Exception $e)
            {
                $getlist = array();
                //$connection->close();
            }
        //echo '<pre>';print_r($getlist);exit;
        return $getlist;
    }

     public function  getrelativeinfo($uid,$usergroup)
      { 
        $connection = $this->dbtrd;
        //echo "wait here ";exit;
        $getlist = array();
        $queryget = "SELECT * FROM `relative_info` WHERE user_id='".$uid."'";

        //echo $queryget;  exit;

         try{
                $exeget = $connection->query($queryget);
                $getnum = trim($exeget->numRows());

                if($getnum>0)
                {
                    while($row = $exeget->fetch())
                    {
                        $getlist[] = $row;
                    }
                    //echo '<pre>';print_r($getlist);exi//
                }
                else{
                    $getlist[] = array();
                }
            }
            catch (Exception $e)
            {
                $getlist = array();
                //$connection->close();
            }
        //echo '<pre>';print_r($getlist);exit;
        return $getlist;
    }
    
    public function getblackoutperiod($uid,$usergroup)
    {
        $connection = $this->dbtrd;
        $getlist = array();
        $queryget = "SELECT * FROM `it_memberlist` WHERE wr_id='".$uid."'";

        //echo $queryget;  exit;

         try{
                $exeget = $connection->query($queryget);
                $getnum = trim($exeget->numRows());

                if($getnum>0)
                {
                    while($row = $exeget->fetch())
                    {
                        $cmpid = explode(',',$row['cmpaccess']);
                        foreach ($cmpid as $kid => $vid)
                        {
                            //echo "cheking value";echo '<pre>';print_r($vbp);exit;
                            $querysql = "SELECT * FROM `blackoutperiod_cmp` 
                            WHERE `companyid`='".$vid."' "; 
                            
                            $execompinfo = $connection->query($querysql);
                            $execmp = $execompinfo->fetch();
                            $getlist[] = $execmp;
                            
                        }
                        //$getlist[] = $row;
                    }
                    //echo '<pre>';print_r($getlist);exi//
                }
                else{
                    $getlist[] = array();
                }
            }
            catch (Exception $e)
            {
                $getlist = array();
                //$connection->close();
            }
        //echo '<pre>';print_r($getlist);exit;
        return $getlist;
    }
    
    public function fetchexcereqtrail($getuserid,$user_group_id,$id)
    { 
        $connection = $this->dbtrd;
        //echo "wait here ";exit;
        $getlist = array();
        $queryget = "SELECT * FROM `trading_status` WHERE `id` = '".$id."'";

        //echo $queryget;  exit;

         try{
                $exeget = $connection->query($queryget);
                $getnum = trim($exeget->numRows());

                if($getnum>0)
                {
                    while($row = $exeget->fetch())
                    {
                        $getlist[] = $row;
                    }
                    //echo '<pre>';print_r($getlist);exit;
                }
                else{
                    $getlist[] = array();
                }
            }
            catch (Exception $e)
            {
                $getlist = array();
                //$connection->close();
            }
        //echo '<pre>';print_r($getlist);exit;
        return $getlist;
    }
    
    public function fetchconfmtrdeexcetrail($getuserid,$user_group_id,$reqstid)
    { 
        $connection = $this->dbtrd;
        //echo "wait here ";exit;
        $getlist = array();
        $queryget = "SELECT * FROM `personal_request` WHERE `id` = '".$reqstid."'";

        //echo $queryget;  exit;

         try{
                $exeget = $connection->query($queryget);
                $getnum = trim($exeget->numRows());

                if($getnum>0)
                {
                    while($row = $exeget->fetch())
                    {
                        $getlist[] = $row;
                    }
                    //echo '<pre>';print_r($getlist);exit;
                }
                else{
                    $getlist[] = array();
                }
            }
            catch (Exception $e)
            {
                $getlist = array();
                //$connection->close();
            }
        //echo '<pre>';print_r($getlist);exit;
        return $getlist;
    }
    
    public function sendexcrqstmail($rqstid,$type,$add_filepath)
    {
        $server_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";            
                $baseuri = $this->url->getBaseUri();
                $baseurl = $server_link.$baseuri;
        
        $excnrqstmaildetail = $this->exceptionreqcommon->getexcrqstdata($rqstid,$type);
        //print_r($excnrqstmaildetail);exit;
         $excnrqstapprvmail = array(
                                 'id'=>$excnrqstmaildetail['maildata'][0]['id'],
                                 //'rqstid'=>$excnrqstmaildetail['maildata'][0]['req_id'],
                                 'requester_name'=>$excnrqstmaildetail['maildata'][0]['fullname'],  
                                 'company_name'=>$excnrqstmaildetail['maildata'][0]['company_name'],  
                                 'type_trnscn'=>$excnrqstmaildetail['maildata'][0]['transaction'],  
                                 'securty_type'=>$excnrqstmaildetail['maildata'][0]['security_type'],
                                 'noofshres'=>$excnrqstmaildetail['maildata'][0]['noofsecurity'],
                                 'url'=>$baseurl);
           if($type == 'contratrd')
           {
               $excnrqstapprvmail['pdfpath']= $excnrqstmaildetail['maildata'][0]['pdffilepath'];
           }
            for($i = 0;$i<sizeof($excnrqstmaildetail['emailid']);$i++)
            {

                $result = $this->emailer->sendmailexcbrqstapprvl($excnrqstapprvmail,$excnrqstmaildetail['emailid'][$i],$type,$add_filepath);
            }
            //print_r($result);exit;
            if($result['logged']==true)
            {
                $results = array('status'=>true, 'mg'=>'Send Successfully');
            }
            else
            {   
                $results = array('status'=>false, 'mg'=>'Request not Sent');  

            }

            return $results; 
        
    }
    
  
    public function getexcrqstdata($rqstid,$type)
   {
        $connection = $this->dbtrd;
        if($type == 'contratrd')
        {
             $queryget = "SELECT pr.*,memb.`fullname`,cmp.`company_name`,secu.`security_type`,pr.`type_of_transaction` ,trans.`transaction`,pr.`approver_id`,pr.`no_of_shares` AS noofsecurity,pr.`pdffilepath` 
            FROM `personal_request` pr 
            LEFT JOIN `it_memberlist` memb ON memb.`wr_id` = pr.`user_id` 
            LEFT JOIN `listedcmpmodule` cmp ON cmp.`id` = pr.`id_of_company` 
            LEFT JOIN `req_securitytype` secu ON secu.`id` = pr.`sectype`
            LEFT JOIN `type_of_transaction` trans ON trans.`id` = pr.`type_of_transaction` WHERE pr.`id` = '".$rqstid."' ";
        }
        else if($type == 'trade')
        {
            $queryget = "SELECT ts.*,memb.`fullname`,cmp.`company_name`,secu.`security_type`,pr.`type_of_transaction`        ,trans.`transaction`,pr.`approver_id`,pr.`no_of_shares` as noofsecurity FROM `trading_status` ts
                        LEFT JOIN `it_memberlist` memb ON memb.`wr_id` = ts.`user_id` 
                        LEFT JOIN `listedcmpmodule` cmp ON cmp.`id` = ts.`id_of_company` 
                        LEFT JOIN `req_securitytype` secu ON secu.`id` = ts.`sectype`
                        LEFT JOIN `personal_request` pr ON pr.`id` = ts.`req_id` 
                        LEFT JOIN `type_of_transaction` trans ON trans.`id` = pr.`type_of_transaction`
                        WHERE ts.`req_id` = '".$rqstid."'";
        }
        try
        {
                $exeget = $connection->query($queryget);
                $getnum = trim($exeget->numRows());

                if($getnum>0)
                {
                    while($row = $exeget->fetch())
                    {
                         $approverid = explode(",",$row['approver_id']);

                            $getemaildata[] = $row;
                    }
                    for($i = 0;$i<sizeof($approverid);$i++)
                    {
                        $querygetemail = "SELECT email FROM `it_memberlist` WHERE `wr_id` = '".$approverid[$i]."' ";
                        $exegetemail = $connection->query($querygetemail);
                        $getnumemail = trim($exegetemail->numRows());
                        if($getnumemail>0)
                        {
                            while($rowemail = $exegetemail->fetch())
                            {
                                $getapproveremail[] = $rowemail['email'];
                            }
                        }
                    }

                    $getadminemail = $this->tradingplancommon->getadminmailid($approverid[0]);
                    array_push($getapproveremail,$getadminemail);
                    $approveremailnew = array_unique($getapproveremail);
                    $getlist = array('maildata'=>$getemaildata,'emailid'=>$approveremailnew);
                }
                else{
                    $getlist[] = array();
                }
            }
            catch (Exception $e)
            {
                $getlist = array();
            }
        return $getlist;
   }
    
    public function fetchreasonofexe($getuserid,$user_group_id,$reqstid,$trdid,$type)
    {
        $connection = $this->dbtrd;
        if($type == 'contra')
        {
             $queryget = "SELECT pr.*
             FROM `personal_request` pr 
             WHERE pr.`id` = '".$reqstid."' ";
        }
        else if($type == 'trade')
        {
            $queryget = "SELECT ts.*
            FROM `trading_status` ts
            WHERE ts.`id` = '".$trdid."'";
        }
        //echo $queryget;exit;
        try
        {
                $exeget = $connection->query($queryget);
                $getnum = trim($exeget->numRows());

                if($getnum>0)
                {
                    while($row = $exeget->fetch())
                    {
                        $getlist = $row;
                    }
                   
                }
                else{
                    $getlist = array();
                }
            }
            catch (Exception $e)
            {
                $getlist = array();
            }
        //print_r($getlist);exit;
        return $getlist;
    }
    
  }
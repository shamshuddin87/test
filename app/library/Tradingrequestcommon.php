<?php
use Phalcon\Mvc\User\Component;

class Tradingrequestcommon extends Component
{
        public function getaccdetails($getuserid,$usergroup)
        {
            $connection = $this->dbtrd;
            $queryget = "SELECT * FROM `user_demat_accounts` WHERE user_id = '".$getuserid."'";

            try
            {
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
                else
                {
                    $getlist = array();
                }
            }
            catch (Exception $e)
            {
                $getlist = array();
            }
            //echo '<pre>';print_r($getlist);exit;
            return $getlist;
        }
    
        public function getuseracc($getuserid,$usergroup,$reqid,$typeofreq)
        {
            $connection = $this->dbtrd;
            if($typeofreq==1)
            {
                $queryget = "SELECT * FROM `user_demat_accounts` WHERE user_id = '".$getuserid."'";
            }
            elseif ($typeofreq==2) 
            {
                $qry = "SELECT relative_id FROM `personal_request` WHERE id = '".$reqid."'";
                $exeget = $connection->query($qry);
                $getnum = trim($exeget->numRows());
                if($getnum>0)
                {
                    $row = $exeget->fetch();
                    $queryget = "SELECT * FROM `relative_demat_accounts` WHERE rel_user_id = '".$row['relative_id']."'";
                }
            }
            try
            {
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
            }
            return $getlist;
        }
    
        public function getusercmp($getuserid,$usergroup,$search)
        {
            $connection = $this->dbtrd;
            $mydate=date('d-m-Y');
            $getmasterid = $this->tradingrequestcommon->getmasterid($getuserid);
           // print_r($getmasterid['user_id']);exit;
          

            $queryget = "SELECT listed_company FROM `companytrading_period`  WHERE (restriction_to > $mydate OR restriction_to IS  NULL) AND user_id='".$getmasterid['user_id']."' ";
            
            $querygetnxt = "SELECT listedcompany FROM `employeerestriction` WHERE FIND_IN_SET('".$getuserid."',`employee`) AND (restriction_to > $mydate OR restriction_to IS  NULL) AND user_id='".$getmasterid['user_id']."' ";
            //print_r($querygetnxt);exit;

            try
            {
                $exeget = $connection->query($queryget);
                $exegetnxt = $connection->query($querygetnxt);
                $getnum = trim($exeget->numRows());
                $getnumnxt = trim($exegetnxt->numRows());
                $getlist=array();
                $getlistnxt=array();
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
                $newarray=array_merge($getlist,$getlistnxt);
                // print_r($newarray);exit;
                if(!empty($newarray))
                {
                    for($i=0;$i<sizeof($newarray);$i++)
                    {
                        $myarr[]=$newarray[$i][0];
                    }
                    $restrcmp= implode(",",$myarr);
                    $query="SELECT id,company_name FROM listedcmpmodule WHERE id NOT IN ($restrcmp) AND added_by='".$getmasterid['user_id']."' AND company_name LIKE '%".$search."%' ";
                }
                else
                {
                    $query="SELECT id,company_name FROM listedcmpmodule WHERE added_by='".$getmasterid['user_id']."' AND  company_name LIKE '%".$search."%'";
                }

                //############# GET ALL COMPANIES EXCEPT RESTRICTED #############//
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

            }
            catch (Exception $e)
            {
                $companys = array();
            }
            return $companys;
        }
    
        //################## GET APPROVER ID #########
public function userdetails($uid)
{
            $connection = $this->dbtrd;
            $queryget = "SELECT * FROM `it_memberlist` WHERE wr_id = '".$uid."'";

            try
            {
                $exeget = $connection->query($queryget);
                $getnum = trim($exeget->numRows());

                if($getnum>0)
                {
                    $getlist =$exeget->fetch();
                }
                else
                {
                    $getlist = array();
                }
            }
            catch (Exception $e)
            {
                $getlist = array();
            }
            return $getlist;

}

public function userdemat($id)
{
            $connection = $this->dbtrd;
            $queryget = "SELECT * FROM `user_demat_accounts` WHERE id = '".$id."'";

            try
            {
                $exeget = $connection->query($queryget);
                $getnum = trim($exeget->numRows());

                if($getnum>0)
                {
                    $getlist =$exeget->fetch();
                }
                else
                {
                    $getlist = array();
                }
            }
            catch (Exception $e)
            {
                $getlist = array();
            }
            return $getlist;

}
public function relativedemat($id)
{
            $connection = $this->dbtrd;
            $queryget = "SELECT * FROM `relative_demat_accounts` WHERE id = '".$id."'";
           

            try
            {
                $exeget = $connection->query($queryget);
                $getnum = trim($exeget->numRows());

                if($getnum>0)
                {
                    $getlist =$exeget->fetch();
                }
                else
                {
                    $getlist = array();
                }
            }
            catch (Exception $e)
            {
                $getlist = array();
            }
            return $getlist;

}

function checktypeofreq($uid,$usergroup,$data)
{
        	//print_r($data);exit;
             if($data['typeoftrans']==2)
            { 
                $result=$this->tradingrequestcommon->savesellrequest($uid,$usergroup,$data);
                if($result==1)
                {   
                    $flag=0;
                    $msg['status']=true;
                    $msg['message']="Date Should Not Less Than Transaction Date Of This Company";
                    return $msg;
                }
                else
                {
                    $msg['status']=false;
                    $msg['message']="You Can Create Request";
                }
            }
}

        public function createrequest($uid,$usergroup,$data,$send_status,$pdfpath)
        { 
            $connection = $this->dbtrd;
            
            // -------- Start CHECK TRANSACTION DATE VALIDATION OF NEXT 6 MONTHS --------
                $time = time();

                if($data['typeofrequest']==2)
                {
                    $reetiveid=$data['selrelative'];
                }
                else
                {
                    $reetiveid='';
                }
            // -------- End CHECK TRANSACTION DATE VALIDATION OF NEXT 6 MONTHS --------

            
            // --------  Start GET AUTO APPROVE STATUS --------
                $res=$this->tradingrequestcommon->getautoapprovestatus($uid,$usergroup,$data,$send_status);
              
                if($res>=$data['noofshare'] && $send_status==1)
                {
                    $tradingdate=$this->tradingrequestcommon->gettradingdate($uid,$usergroup,$data,$send_status);

                    if($tradingdate!='')
                    {
                        $autoapst=1;
                        $tradingdate=$tradingdate;
                    }
                    else
                    {
                        $autoapst=0;
                        $tradingdate='';
                    }
                }
                else
                {
                    $autoapst='(NULL)';
                    $tradingdate='';
                }
            // --------  End GET AUTO APPROVE STATUS --------
            
            //print_r($data);exit;
            
            // -------- Start GET AUTO APPROVE STATUS --------
                $query = "INSERT INTO `personal_request`(`user_id`,`user_group`,
                    `type_of_request`,`relative_id`,`name_of_requester`,
                    `sectype`,`id_of_company`,`no_of_shares`,
                    `type_of_transaction`,`pdffilepath`,`approver_id`,`send_status`,
                    `sendaprvl_date`,`approved_status`,`trading_date`,`sent_contraexeaprvl`,`ex_approve_status`,approxprice,broker,demat,place,dateoftransaction,trans,shares,
                    `date_added`,`date_modified`,`timeago`) VALUES('".$uid."','".$usergroup."',
                    '".$data['typeofrequest']."','".$reetiveid."','".$data['reqname']."',
                    '".$data['sectype']."','".$data['idofcmp']."','".$data['noofshare']."',
                    '".$data['typeoftrans']."','".$pdfpath."','".$data['approverid']."','".$send_status."',
                    NOW(),'".$autoapst."','".$tradingdate."','0','0','".$data['approxprice']."','".$data['broker']."','".$data['demataccount']."','".$data['place']."','".$data['datetrans']."','".$data['transaction']."','".$data['sharestrans']."',
                    NOW(),NOW(),'".$time."')";
                //echo $query; exit;
            
                try
                {
                    $exeget = $connection->query($query);
                    if($exeget)
                    {
                        if($send_status == 1)
                          {   
                            $lastid = $connection->lastInsertId();
                            $notific=$this->notificationcommon->insertfornotify($lastid,$data['reqname'],$data['approverid'],"1");
                            $sendmailtoapprover = $this->tradingrequestcommon->sendmailapppv($lastid);
                        }
                        $msg['status']=true;
                        $msg['message']="Request Saved Successfully";
                        return $msg;
                    }
                 

                }
                catch(Exception $e)
                {
                    $msg['status']=false;
                    $msg['message']="Exception Occured";
                    return $msg;
                }              
            // -------- Start GET AUTO APPROVE STATUS --------
        }

        public function savesellrequest($uid,$usergroup,$data)
        {
            $connection = $this->dbtrd;
            $queryget = "SELECT * FROM `personal_request` WHERE id_of_company = '".$data['idofcmp']."' AND user_id='".$uid."' AND type_of_transaction!='2'";
            $date=date('d-m-Y');
            // echo $queryget;  exit;

            try
            {
                $exeget = $connection->query($queryget);
                $getnum = trim($exeget->numRows());

                if($getnum>0)
                {

                    while($row = $exeget->fetch())
                    {
                        $getlist[] = $row;
                    }
                    // print_r($getlist);exit;
                    if(!empty($getlist))
                    {
                        for($i=0;$i<sizeof($getlist);$i++)
                        {
                            $query = "SELECT * FROM `trading_status` WHERE req_id = '".$getlist[$i]['id']."'";
                            $exeget = $connection->query($query);
                            $getnum = trim($exeget->numRows());
                            if($getnum>0)
                            {
                                while($row = $exeget->fetch())
                                {
                                    $list= $row;
                                    $start_date = strtotime($list['date_of_transaction']); 

                                    $end_date = strtotime($date); 
                                    $diffdays=($end_date - $start_date)/60/60/24; 
                                    //   print_r($diffdays);
                                    if($diffdays<=182)
                                    {
                                        return true;
                                    }
                                }
                                return false;
                            }
                        }
                        
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
            }
            catch (Exception $e)
            {
                $getlist = array();
            }

        }

        public function  gettradingdate($uid,$usergroup,$data,$send_status)
        {
            $connection = $this->dbtrd;
            $queryget = "SELECT * FROM `it_memberlist` WHERE wr_id = '".$uid."'";

            try
            {
                $exeget = $connection->query($queryget);
                $getnum = trim($exeget->numRows());

                if($getnum>0)
                {
                    $getlist = $exeget->fetch();
                    $masteruser=$getlist['user_id'];
                    $query = "SELECT * FROM `trading_days` WHERE user_id = '".$masteruser."'";
                    $exeget = $connection->query($query);
                    $getnm = trim($exeget->numRows());
                    if($getnm>0)
                    {
                        $getlst= $exeget->fetch();
                        $mydate=date('d-m-Y');
                        $tradedate=date('d-m-Y', strtotime($mydate. ' + '.$getlst['noofdays'].' days'));
                    }
                    else
                    {
                        $tradedate='';
                    }
                }
            }
            catch(Exception $e)
            {
                
            }
            return $tradedate;
        }

        public function  getautoapprovestatus($uid,$usergroup,$data,$send_status)
        {
            $connection = $this->dbtrd;
            //echo "wait here ";exit;
            $queryget = "SELECT * FROM `it_memberlist` WHERE wr_id = '".$uid."'";
            $noofappshares=0;
            
            try
            {
                $exeget = $connection->query($queryget);
                $getnum = trim($exeget->numRows());

                if($getnum>0)
                {
                    $getlist = $exeget->fetch();
                    $masteruser=$getlist['user_id'];

                    $query = "SELECT * FROM `autoapprove` WHERE user_id = '".$masteruser."'";
                    $exeget = $connection->query($query);
                    $getnm = trim($exeget->numRows());
                    if($getnm>0)
                    {
                        $getlst= $exeget->fetch();
                        $noofappshares=$getlst['noofshares'];
                    }
                    else
                    {
                        $noofappshares=0;
                    }
                }
                else
                {
                    $noofappshares=0;
                }
            }
            catch (Exception $e)
            {
                $noofappshares=0;                
            }

            return $noofappshares;
        }

        public function gettradingrequest($uid,$usergroup,$extqry)
        {
            $connection = $this->dbtrd;
            $queryget= "SELECT pr.*, `cmpdl`.company_name as mycompany,
              `newrp`.relationshipname as relationship, `relative`.name ,
                `rt`.request_type, `obj`.transaction, `sec`.security_type 
                FROM `personal_request` pr 
                LEFT JOIN listedcmpmodule cmpdl ON `cmpdl`.id = `pr`.id_of_company 
                LEFT JOIN relative_info relative ON `relative`.id = `pr`.relative_id 
                LEFT JOIN request_type rt ON `rt`.id = `pr`.type_of_request     
                LEFT JOIN type_of_transaction obj ON `obj`.id=`pr`.type_of_transaction
                LEFT JOIN relationship newrp ON `newrp`.id=`relative`.relationship  
                JOIN `req_securitytype` sec ON `sec`.id = `pr`.sectype
                WHERE `pr`.user_id = '".$uid."' AND pr.`sent_contraexeaprvl`= '0'  ".$extqry;
            //print_r($queryget);die;

            try
            {
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
            }
            return $getlist;
        }

        public function subuserreqapproval($uid,$usergroup,$extqry)
        {
            $connection = $this->dbtrd;
            if($usergroup!=2)
            {
                $queryget = "SELECT memb.`deptaccess` AS department,`cmpdl`.company_name as mycompany,`newrp`.relationshipname as relationship,`relative`.name ,`rt`.request_type,ts.`transaction`,pr.*,sec.`security_type`
                FROM `personal_request` pr
                LEFT JOIN listedcmpmodule cmpdl ON `cmpdl`.id = `pr`.id_of_company 
                LEFT JOIN relative_info relative ON `relative`.id = `pr`.relative_id 
                LEFT JOIN request_type rt ON `rt`.id = `pr`.type_of_request 
                LEFT JOIN type_of_transaction ts ON `ts`.id=`pr`.type_of_transaction
                LEFT JOIN `req_securitytype` sec ON `sec`.id = `pr`.sectype
                LEFT JOIN `it_memberlist` memb ON memb.`wr_id` =  pr.`user_id`
                LEFT JOIN `con_dept` dpt ON memb.`deptaccess` = dpt.`id`
                LEFT JOIN relationship newrp ON `newrp`.id=`relative`.relationship  
                WHERE (pr.`send_status`='1' or pr.`approved_status`='2')  AND FIND_IN_SET('".$uid."',pr.`approver_id`)".$extqry;
            }
            else
            {

                // $query="SELECT wr_id FROM it_memberlist WHERE user_id='".$uid."'";
                $allusers=$this->tradingrequestcommon->getalluserformain($uid);
                $allusers= implode(",",$allusers);
                //print_r($allusers);exit;

                $queryget = "SELECT memb.`deptaccess` AS department,`cmpdl`.company_name as mycompany,`newrp`.relationshipname as relationship,`relative`.name  ,`rt`.request_type, ts.`transaction`, pr.*,`sec`.security_type 
                FROM `personal_request` pr
                LEFT JOIN type_of_transaction ts ON `ts`.id=`pr`.type_of_transaction

                LEFT JOIN listedcmpmodule cmpdl ON `cmpdl`.id = `pr`.id_of_company 
                LEFT JOIN relative_info relative ON `relative`.id = `pr`.relative_id 
                LEFT JOIN request_type rt ON `rt`.id = `pr`.type_of_request 
                LEFT JOIN `req_securitytype` sec ON `sec`.id = `pr`.sectype
                LEFT JOIN `it_memberlist` memb ON memb.`wr_id` =  pr.`user_id`
                LEFT JOIN `con_dept` dpt ON memb.`deptaccess` = dpt.`id`
                LEFT JOIN relationship newrp ON `newrp`.id=`relative`.relationship
                WHERE (pr.`send_status`='1' or pr.`approved_status`='2') AND pr.`user_id` IN(".$allusers.")".$extqry;
            }

              // echo $queryget;  exit;

            try
            {
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
            }
            return $getlist;
        }

        public function delpersonalreq($uid,$usergroup,$delid)
        {
            $connection = $this->dbtrd;
            $myarr=array();
            $time = time();
            try
            {
                $query="DELETE FROM personal_request WHERE id='".$delid."'";
                $query2="DELETE FROM trading_status WHERE req_id='".$delid."'";
                //  print_r($query);exit;
                $exessa= $connection->query($query);
                $exessa2= $connection->query($query2);


                if($exessa && $exessa2)
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

        public function getalluserformain($uid)
        {

            $connection = $this->dbtrd;
            //echo "wait here ";exit;
            $query="SELECT wr_id FROM it_memberlist WHERE user_id='".$uid."'";

            // echo $query;  exit;

            try
            {
                $exeget = $connection->query($query);
                $getnum = trim($exeget->numRows());

                if($getnum>0)
                {
                    while($row = $exeget->fetch())
                    {
                        $getlist[] = $row['wr_id'];
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
    
        public function deltrade($uid,$usergroup,$delid)
        {
            $connection = $this->dbtrd;
            $myarr=array();
            $time = time();
            try
            {
                $query="DELETE FROM trading_status WHERE id='".$delid."'";
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

        public function getsinglereq($uid,$usergroup,$editid)
        {
            $connection = $this->dbtrd;
            //echo "wait here ";exit;
            $queryget = "SELECT * FROM `personal_request` WHERE id = '".$editid."'";

            //echo $queryget;  exit;

            try
            {
                $exeget = $connection->query($queryget);
                $getnum = trim($exeget->numRows());

                if($getnum>0)
                {
                    $getlist = $exeget->fetch();
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

         public function getpersonalinfo($uid,$usergroup)
        {
            $connection = $this->dbtrd;
            //echo "wait here ";exit;
            $queryget = "SELECT * FROM `personal_info` WHERE userid = '".$uid."'";

            //echo $queryget;  exit;

            try
            {
                $exeget = $connection->query($queryget);
                $getnum = trim($exeget->numRows());

                if($getnum>0)
                {
                    $getlist = $exeget->fetch();
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

           $query = "UPDATE `personal_request` SET  `sectype`='".$data['sectype']."',`type_of_request`='".$data['typeofrequest']."',`relative_id`='".$relativeid."', `id_of_company`='".$data['idofcmp']."',`no_of_shares`='".$data['noofshare']."',`type_of_transaction`='".$data['typeoftrans']."', `date_modified`=NOW(),`timeago`='".$time."' WHERE id='".$editid."'";
                   
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
            try
            {
                for($i=0;$i<sizeof($selctedid);$i++)
                {
                    $query = "UPDATE `personal_request` SET  `send_status`='1',`sendaprvl_date`=NOW(),`approved_status`= (NULL) WHERE id='".$selctedid[$i]."'";   
                    //print_r($query);exit;
                    $exeget = $connection->query($query);

                    if($exeget)
                    {
                        $sendmailtoapprover = $this->tradingrequestcommon->sendmailapppv($selctedid[$i]);
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

        public function acceptapprovel($uid,$usergroup,$selctedid)
        {
            $connection = $this->dbtrd;
            $time = time();
            $msg=array();
            $selctedid = explode(',',$selctedid);
            try{
            	  $queryget = "SELECT * FROM  `trading_days`";
            	  $exeget = $connection->query($queryget);
                  $getnum = trim($exeget->numRows());

                if($getnum>0)
                {
                   $row = $exeget->fetch();
                   $mydate=date('d-m-Y');
                   $tradedate=date('d-m-Y', strtotime($mydate. ' + '.$row['noofdays'].' days'));

                 
                 // print_r($tradedate);exit;
             

                  for($i=0;$i<sizeof($selctedid);$i++)
                  {
                     $query = "UPDATE `personal_request` SET  `approved_status`='1',`approved_date`=NOW(),`trading_date`='".$tradedate."',`date_modified`=NOW(),`timeago`='".$time."'
                           WHERE id='".$selctedid[$i]."'";   
                         $exeget = $connection->query($query);

                      $notific=$this->notificationcommon->insertnotification($selctedid[$i],"2");
                    
                       if($exeget)
                       {
                           $getackwmaildetl = $this->randomrequestcommon->mailacknwtoapprvr($selctedid[$i]); 
                           if($getackwmaildetl)
                           {
                              $ackapprvmail = array( 
                                 'company_name'=>$getackwmaildetl[0]['company_name'],  
                                 'type_trnscn'=>$getackwmaildetl[0]['transaction'],  
                                 'securty_type'=>$getackwmaildetl[0]['security_type'],
                                 'noofshres'=>$getackwmaildetl[0]['no_of_shares'],
                                 'email'=>$getackwmaildetl[0]['email']
                            );
                            $result = $this->emailer->sendmailackapprvl($ackapprvmail); 
                           }
                            
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
                 else

                 {
                          $msg['status']=false;
                          $msg['message']="Please Insert No Of Trading Days in Admin Module";
                 }
                }
              catch(Exception $e)
              {
                
                 $msg['status']=false;
                 $msg['message']="Something Went to Wrong";
              }

              return $msg;
       }

    public function uploadtradingfile($uid,$usergroup,$reqid,$target_file,$data,$typeofbutton)
    {
        //print_r($data);exit;
        $connection = $this->dbtrd;
        $time = time();

        try
        {
            if($data['exceptinappr']==1)
            {
                $tsstatus=1;
            }
            else
            {
                $tsstatus='';
            }

            if($target_file!='')
            {
                $link='<a href="'.$target_file.'" target="_blank"><i class="fa fa-download" style="font-size:15px;color:black;"></i></a>';
            }
            else
            {
                $link='';
            }
            
//            if(!isset($data['reasonexe']))
//            {
//                $data['reasonexe']='';
//            }
            $query = "INSERT INTO  `trading_status` (req_id, user_id, user_group_id,`id_of_company`,`sectype`,no_of_share,price_per_share,trading_status,total_amount,demat_acc_no,excep_approv,excepsendaprv_date,file,date_of_transaction,date_added,date_modified,`type_of_request`,`timeago`) VALUES ('".$reqid."','".$uid."','".$usergroup."','".$data['compid']."','".$data['sectype']."','".$data['noofshare']."','".$data['priceofshare']."','1','".$data['total']."','".$data['dmatacc']."','".$data['exceptinappr']."',NOW() ,'".$link."','".$data['transdate']."',NOW(),NOW(),'".$data['typetrans']."','".$time."')";  
            //print_r($query);exit;
            $exeget = $connection->query($query);
                  
            if($exeget)
            {
                if($typeofbutton == 'Exception Request')
                {
                    $getsendexcrqstmail = $this->exceptionreqcommon->sendexcrqstmail($reqid,'trade');
                }

                $link='<a href="'.$target_file.'"><i class="fa fa-download" style="font-size:15px;color:black;"></i></a>';

                 $queryup = "UPDATE `personal_request` SET `ex_approve_status`='0',`exception_approve`='".$data['exceptinappr']."' WHERE id='".$reqid."'"; 

                 $exeget = $connection->query($queryup);


                $queryselectreltv = "SELECT * FROM `personal_request` WHERE id='".$reqid."' AND relative_id = ''";

                $exegetselectretv = $connection->query($queryselectreltv);
                $getnumselectretv = trim($exegetselectretv->numRows());

                if($getnumselectretv != 0)
                {

                   $queryselect = "SELECT * FROM `opening_balance` WHERE id_of_company = '".$data['compid']."' AND `user_id`='".$uid."' ";

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

               if($exeget)
               {
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
        }
        catch(Exception $e)
        {
            return false;
        }           
    }
    
        public function rejectreq($uid,$usergroup,$rejectid,$message)
        {
            $connection = $this->dbtrd;
            $time = time();
            try{
      
                 $query = "UPDATE `personal_request` SET  `approved_status`='2',send_status='0',rejected_message='".$message."',date_modified=NOW(),`timeago`='".$time."' WHERE id='".$rejectid."'";   
                
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
              //   print_r($queryget);exit;

                if($getnum>0)
                { 
                      while($row = $exeget->fetch())
                    {
                       $getlist[] = $row;
                    }
                   
                 }
                 else{

                         return $getlist;

                 }
               }
               catch(Exception $e)
               {
                        return $getlist;
               }


            // print_r($getlist);exit;
             return $getlist;
       }
    
        public function donetrade($uid,$usergroup,$reqid)
        { 
               $connection = $this->dbtrd;
               $time = time();
                try{


                     
                       
                           $queryup = "UPDATE `personal_request` SET `trading_status`='1',`tradestatus_date`= NOW() WHERE id='".$reqid."'";   

                      
                           $queryupnxt = "UPDATE `trading_status` SET `trading_status`='1' WHERE req_id='".$reqid."'";  
                           // $queryup2 = "UPDATE `trading_status` SET `file`=''  WHERE id='".$reqid."'";  
                       
                       
                            //echo $queryup;exit;
                     
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

        public function notdonetrade($uid,$usergroup,$reqid)
        { 
            $connection = $this->dbtrd;
            $time = time();
            try
            {
                $queryup = "INSERT INTO `trading_status` (req_id, user_id, user_group_id,trading_status,date_added,date_modified,timeago) 
                VALUES   ('".$reqid."','".$uid."','".$usergroup."','0',NOW(),NOW(),'".$time."')";  
                //echo $queryup; exit;
                
                $queryupnxt = "UPDATE `personal_request` SET `trading_status`='0' WHERE id='".$reqid."'";  //echo 
                $exegetqry = $connection->query($queryup);
                $exegetqrynxt = $connection->query($queryupnxt);

                if($exegetqry && $exegetqrynxt)
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
                //echo 'in catch';
                return false;
            }
        }

        public function successstatus($uid,$usergroup,$reqid)
        { 
            $connection = $this->dbtrd;
            //echo "wait here ";exit;
            $getlist = array();
            $queryget = "SELECT * FROM `trading_status` WHERE req_id = '".$reqid."' AND (excepapp_status='1' || excepapp_status IS NULL)";

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
                       // echo '<pre>';print_r($getlist);              
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
        
          public function  getrelativesingle($uid)
        { 
            $connection = $this->dbtrd;
            //echo "wait here ";exit;
            $getlist = array();
            $queryget = "SELECT * FROM `relative_info` WHERE id='".$uid."'";

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

            try
            {
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
                            //$execmp = $execompinfo->fetch();
                            while($row = $execompinfo->fetch())
                            {
                                $getlist[] = $row;
                            }

                        }
                        //$getlist[] = $row;
                    }
                    //echo '<pre>';print_r($getlist);exi//
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
    
        public function getupsitradingblock($uid,$usergroup)
        {
            $connection = $this->dbtrd;
            $todate = date('d-m-Y');
            $getlist = array();
            $queryget = "SELECT * FROM `upsimaster` 
                WHERE (STR_TO_DATE('".$todate."','%d-%m-%Y') BETWEEN STR_TO_DATE(`projstartdate`,'%d-%m-%Y') AND STR_TO_DATE(`enddate`,'%d-%m-%Y')
                OR (STR_TO_DATE(`projstartdate`,'%d-%m-%Y') < STR_TO_DATE('".$todate."','%d-%m-%Y')   AND (`enddate` IS NULL OR `enddate`=''))) AND (FIND_IN_SET('".$uid."',`projectowner`) OR FIND_IN_SET('".$uid."',`connecteddps`)) ";
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

        //######### VALIDATION OF REQUEST ################

//        public function checkvalrequest($uid,$usergroup,$idofcmp,$typeoftrans)
//        {
//            $connection = $this->dbtrd;
//            //echo "wait here ";exit;
//            $mydate=date('d-m-Y');
//            $getlist = array();
//            $queryget = "SELECT * FROM `personal_request` WHERE user_id='".$uid."' AND id_of_company='".$idofcmp."' order by id desc limit 1";
//            //echo $queryget;exit;
//            try
//            {
//                $exeget = $connection->query($queryget);
//                $getnum = trim($exeget->numRows());
//
//                if($getnum>0)
//                {
//                    $row = $exeget->fetch();
//                    // $queryget = "SELECT * FROM `trading_status` WHERE req_id = '".$row['id']."'  order by id desc limit 1";
//                    $queryget = "SELECT ts.* FROM `trading_status` ts LEFT JOIN `personal_request` pr ON pr.`id`=ts.`req_id` WHERE ts.`req_id` = '".$row['id']."' AND pr.`trading_status` IS NOT NULL order by id desc limit 1";
//                    //echo $queryget;exit;
//                    $exege = $connection->query($queryget);
//                    $getm= trim($exege->numRows());
//                    if($getm>0)
//                    {
//                        $row2 = $exege->fetch();
//                        $start_date = strtotime($row2['date_of_transaction']); 
//
//                        $end_date = strtotime($mydate); 
//                        $diff = abs($start_date - $end_date);
//
//                        $years = floor($diff / (365*60*60*24));
//                        $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
//                        $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
//
//
//                        if($days<=182 && $row['type_of_transaction']!=$typeoftrans)
//                        {
//
//                            $results = array('status'=>'false', 'mg'=>'You Are Doing Different Trade Before Six Months Transaction');
//                        }
//                        else
//                        {
//                             $results = array('status'=>'true', 'mg'=>'You can create request');
//                        }
//
//                    }
//                    else
//                    {
//                        $results = array('status'=>'false', 'mg'=>'Please Complete Your Latest Transaction');
//                    }
//
//                }
//                else
//                {
//                    $results = array('status'=>'true', 'mg'=>'You can create request');
//                }
//            }
//            catch (Exception $e)
//            {
//                $results = array('status'=>'false', 'mg'=>'Exception');
//            //$connection->close();
//            }
//            //echo '<pre>';print_r($results);exit;
//            return $results;
//
//        }
    
        public function checkvalrequest($uid,$usergroup,$idofcmp,$typeoftrans)
        {

            $connection = $this->dbtrd;
            //echo "wait here ";exit;
            $mydate=date('d-m-Y');
            $getlist = array();
            $queryget = "SELECT * FROM `personal_request` WHERE user_id='".$uid."' AND id_of_company='".$idofcmp."' AND `sent_contraexeaprvl`='0'  order by id desc limit 1";
            //echo $queryget;exit;
            try
            {
                $exeget = $connection->query($queryget);
                $getnum = trim($exeget->numRows());

                if($getnum>0)
                {
                    $row = $exeget->fetch();

                    $queryget = "SELECT * FROM `trading_status` WHERE req_id = '".$row['id']."' order by id desc limit 1";
                    $exege = $connection->query($queryget);
                    $getm= trim($exege->numRows());
                    if($getm>0)
                    {
                        $row2 = $exege->fetch();

                        $start_date = strtotime($row2['date_of_transaction']); 

                        $end_date = strtotime($mydate); 
                        $diff = abs($start_date - $end_date);
                        $years = floor($diff / (365*60*60*24));
                        $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
                        $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
                        if($days<=182 && $row['type_of_transaction']!=$typeoftrans)
                        {
                            $result = array('status'=>true,'message'=>'');
                        }
                        else
                        {
                            $result = array('status'=>false,'message'=>'');
                        }

                    }
                    else
                    {
                        $result = array('status'=>true,'message'=>'Please Complete Your Latest Trade..!!');
                    }

                }
                else
                {
                    $result = array('status'=>false,'message'=>'');
                }
            }
            catch (Exception $e)
            {
                $result = array();
            //$connection->close();
            }
            //Secho '<pre>';print_r($getlist);exit;
            return $result;

        }
        public function fetchreqtrail($getuserid,$user_group_id,$rqstid)
        { 
            $connection = $this->dbtrd;
            //echo "wait here ";exit;
            $getlist = array();
            $queryget = "SELECT * FROM `personal_request` WHERE `id` = '".$rqstid."'";

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
    
        public function fetchreqtransdte($getuserid,$user_group_id,$rqstid)
        {
            $connection = $this->dbtrd;
            $queryget = "SELECT * FROM `trading_status` WHERE `req_id` = '".$rqstid."'";

            //echo $queryget;  exit;

            try
            {
                $exeget = $connection->query($queryget);
                $getnum = trim($exeget->numRows());

                if($getnum>0)
                {
                    while($row = $exeget->fetch())
                    {
                        $getdate[] = $row['date_of_transaction'];
                    }
                    $latestdate = max($getdate);
                }
                else
                {
                    $latestdate[] = array();
                }
            }
            catch (Exception $e)
            {
                $latestdate = array();
            //$connection->close();
            }
            return $latestdate;
        }
    
        /******* send mail to approver after creating rqst start ******/
        public function sendmailapppv($rqstid)
        {
                $server_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";            
                $baseuri = $this->url->getBaseUri();
                $baseurl = $server_link.$baseuri;

                $rqstmaildetail = $this->tradingrequestcommon->getrqstdata($rqstid);
                //print_r($rqstmaildetail);exit;
                $rqstapprvmail = array(
                                 'rqst_id'=>$rqstmaildetail['maildata'][0]['id'],
                                 'requester_name'=>$rqstmaildetail['maildata'][0]['fullname'],  
                                 'company_name'=>$rqstmaildetail['maildata'][0]['company_name'],  
                                 'type_trnscn'=>$rqstmaildetail['maildata'][0]['transaction'],  
                                 'securty_type'=>$rqstmaildetail['maildata'][0]['security_type'],
                                 'noofshres'=>$rqstmaildetail['maildata'][0]['no_of_shares'],
                                 'pdfpath'=>$rqstmaildetail['maildata'][0]['pdffilepath'],
                                 'url'=>$baseurl);

                for($i = 0;$i<sizeof($rqstmaildetail['emailid']);$i++)
                {
                    $result = $this->emailer->sendmailrqstapprvl($rqstapprvmail,$rqstmaildetail['emailid'][$i]);
                }
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
        /******* send mail to approver after creating rqst end ******/
    
        /*********  get all detail of request ***********/
        public function getrqstdata($rqstid)
        {
            $connection = $this->dbtrd;
            $queryget = "SELECT pr.*,memb.`fullname`,cmp.`company_name`,trans.`transaction`,secu.`security_type` FROM `personal_request` pr
                        LEFT JOIN `it_memberlist` memb ON memb.`wr_id` = pr.`user_id`
                        LEFT JOIN `listedcmpmodule` cmp ON cmp.`id` = pr.`id_of_company`
                        LEFT JOIN `type_of_transaction` trans ON trans.`id` = pr.`type_of_transaction`
                        LEFT JOIN `req_securitytype` secu ON secu.`id` = pr.`sectype`
                        WHERE pr.`id` = '".$rqstid."'";

            //echo $queryget;  exit;

             try{
                    $exeget = $connection->query($queryget);
                    $getnum = trim($exeget->numRows());

                    if($getnum>0)
                    {
                        while($row = $exeget->fetch())
                        {
                            $approverid = explode(",",$row['approver_id']);
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
                            $getemaildata[] = $row;
                        }
                        //print_r($getemaildata);exit;
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
                    //$connection->close();
                }
            //echo '<pre>';print_r($getlist);exit;
            return $getlist;
       }
    
    public function mailaftrfinalsub($reqid)
    {
        
        $finlsubmaildetail = $this->tradingrequestcommon->detailaftrfinalsub($reqid);
        $finlsubmail = array(
                                 'requester_name'=>$finlsubmaildetail['maildata'][0]['fullname'],  
                                 'company_name'=>$finlsubmaildetail['maildata'][0]['company_name'],  
                                 'securty_type'=>$finlsubmaildetail['maildata'][0]['security_type'],
                                 'transaction'=>$finlsubmaildetail['maildata'][0]['transaction'],
                                 'noofshres'=>$finlsubmaildetail['noofshr'],
                                 'tradedate'=>$finlsubmaildetail['tradedate']);
            for($i = 0;$i<sizeof($finlsubmaildetail['emailid']);$i++)
            {
                $result = $this->emailer->sendmailaftrfinlsub($finlsubmail,$finlsubmaildetail['emailid'][$i]);
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
    
    public function detailaftrfinalsub($rqstid)
    {
        $shares = 0;
        $connection = $this->dbtrd;
        $queryget = "SELECT ts.*,memb.`fullname`,cmp.`company_name`,secu.`security_type`,memb.`approvid`,trans.`transaction` FROM `trading_status` ts
                        LEFT JOIN `it_memberlist` memb ON memb.`wr_id` = ts.`user_id`
                        LEFT JOIN `listedcmpmodule` cmp ON cmp.`id` = ts.`id_of_company`
                        LEFT JOIN `req_securitytype` secu ON secu.`id` = ts.`sectype`
                        LEFT JOIN `personal_request` pr ON pr.`id` = ts.`req_id` 
			            LEFT JOIN `type_of_transaction` trans ON trans.`id` = pr.`type_of_transaction`
                        WHERE ts.`req_id` = '".$rqstid."'";

        //echo $queryget;  exit;

             try{
                    $exeget = $connection->query($queryget);
                    $getnum = trim($exeget->numRows());

                    if($getnum>0)
                    {
                        while($row = $exeget->fetch())
                        {
                            $approverid = explode(",",$row['approvid']);
                         
                            $getdate[] = $row['date_of_transaction'];
                            $shares = $shares + $row['no_of_share'];
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
                        $latestdate = max($getdate);
                        $getlist = array('maildata'=>$getemaildata,'emailid'=>$getapproveremail,'noofshr'=>$shares,'tradedate'=>$latestdate);
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
    
    /********* get ackwldg mail data start *********/
    public function mailacknwtoapprvr($rqstid)
    {
        $connection = $this->dbtrd;
        $querygetdetail = "SELECT pr.*,cmp.`company_name`,trans.`transaction`,memb.`email`,secu.`security_type` FROM `personal_request` pr 
                            LEFT JOIN `listedcmpmodule` cmp ON cmp.`id` = pr.`id_of_company`
                            LEFT JOIN `type_of_transaction` trans ON trans.`id` = pr.`type_of_transaction`
                            LEFT JOIN `it_memberlist` memb ON memb.`wr_id` = pr.`user_id`
                            LEFT JOIN `req_securitytype` secu ON secu.`id` = pr.`sectype`
                            WHERE pr.id='".$rqstid."'";
        //echo $querygetdetail;exit;
        try
        {
                $exegetdetail = $connection->query($querygetdetail);
                $getnum = trim($exegetdetail->numRows());

                if($getnum>0)
                {
                    while($row = $exegetdetail->fetch())
                    {
                        $getlist[] = $row;
                    }
                }
                else
                {
                    $getlist[] = array();
                }
        }
        catch (Exception $e)
        {
            $getlist = array();
        //$connection->close();
        }
        return $getlist;
    }
    /********* get ackwldg mail data end **********/


    public function getmasterid($getuserid)
    {

       $connection = $this->dbtrd;
        $query= "SELECT user_id FROM it_memberlist WHERE wr_id='".$getuserid."'";
        // echo $query;exit;
        try
        {
                $exegetdetail = $connection->query($query);
                $getnum = trim($exegetdetail->numRows());

                if($getnum>0)
                {
                   
                        $getlist = $exegetdetail->fetch();
                    
                }
                else
                {
                    $getlist[] = array();
                }
        }
        catch (Exception $e)
        {
            $getlist = array();
        //$connection->close();
        }
        return $getlist;
    }
    
    public function getmastergroupid($getuserid)
    {

       $connection = $this->dbtrd;
        $query= "SELECT master_group_id FROM it_memberlist WHERE wr_id='".$getuserid."'";
      //  echo $query;exit;
        try
        {
                $exegetdetail = $connection->query($query);
                $getnum = trim($exegetdetail->numRows());

                if($getnum>0)
                {
                   
                        $getlist = $exegetdetail->fetch();
                    
                }
                else
                {
                    $getlist[] = array();
                }
        }
        catch (Exception $e)
        {
            $getlist = array();
        //$connection->close();
        }
        return $getlist;
    }
    
    
    
    public function checkdematacc($getuserid,$user_group_id,$relativeid)
    {
        $connection = $this->dbtrd;
        if(empty($relativeid))
        {
            $querygetdetail = "SELECT * FROM `user_demat_accounts` WHERE user_id='".$getuserid."'";  
        }
        else
        {
            $querygetdetail = "SELECT * FROM `relative_demat_accounts` WHERE rel_user_id = '".$relativeid."'";
        }
        
        //echo $querygetdetail;exit;
        try
        {
                $exegetdetail = $connection->query($querygetdetail);
                $getnum = trim($exegetdetail->numRows());

                if($getnum>0)
                {
                    while($row = $exegetdetail->fetch())
                    {
                        $getlist = $row;
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
        return $getlist;
    }


    public function checkopeningbalance($uid,$usergroup,$idofcmp,$typeoftrans,$sectype,$noofshare)
    {
         
        $connection = $this->dbtrd;
        
        $querygetdetail = "SELECT * FROM `opening_balance` 
            WHERE user_id='".$uid."' AND id_of_company='".$idofcmp."' AND sectype='".$sectype."' ";  
        //echo $querygetdetail; exit;
        
        try
        {
            $exegetdetail = $connection->query($querygetdetail);
            $getnum = trim($exegetdetail->numRows());
            $msg=array();

            if($getnum>0)
            {
                $row = $exegetdetail->fetch();
                if($sectype==1)
                {
                    $openingbal=$row['equityshare'];
                }
                else if($sectype==2)
                {
                    $openingbal=$row['prefershare'];
                }
                else
                {
                    $openingbal=$row['debntrshare'];
                }

                $checkval = $this->tradingrequestcommon->getdatafromtdstatus($uid,$usergroup,$idofcmp,$typeoftrans,$openingbal,$sectype);

                if($checkval['closebal'])
                {
                    if($noofshare<=$checkval['closebal'])
                    {
                        $msg['status']=true;
                        $msg['msg']="You Can Add Request Now..";
                        return $msg;
                    }
                    else
                    {
                        $msg['status']=false;
                        $msg['msg']="You cannot sell more shares than you already hold.";
                        return $msg;
                    }
                }
                else
                {
                    $msg['status']=false;
                    $msg['msg']="Something Went To Wrong..!!!";
                    return $msg;
                }
            }
            else
            {
                $msg['status']=false;
                $msg['msg']="This company does not exist in your holding summary. Please update opening balance if not done before.";
                return $msg;
            }
        }
        catch (Exception $e)
        {
            $getlist = array();
            //$connection->close();
        }
    }

    public function getdatafromtdstatus($uid,$usergroup,$idofcmp,$typeoftrans,$openingbal,$sectype)
    {
        $connection = $this->dbtrd;
       
        // $arr=array();
        $querygetdetail = "SELECT ts.`*`, pr.`type_of_transaction` 
            FROM `trading_status` ts LEFT JOIN `personal_request` pr ON pr.`id`=ts.`req_id`
            WHERE ts.`user_id`='".$uid."' AND ts.`id_of_company`='".$idofcmp."' 
            AND ts.`sectype`='".$sectype."' AND pr.`type_of_request`='1'" ;
        //echo $querygetdetail; exit;
        
        try
        {
            $exegetdetail = $connection->query($querygetdetail);
            $getnum = trim($exegetdetail->numRows());
            $buy=0;
            $sell=0;
            $msg=array();

            if($getnum>0)
            {
                while($row = $exegetdetail->fetch())
                {
                    $getlist = $row;
                    if($getlist['type_of_transaction']==1 || $getlist['type_of_transaction']==3 ||
                    $getlist['type_of_transaction']==4)
                    {
                        $buy+=$getlist['no_of_share'];
                        // $buy+=
                    }
                    else
                    {
                        $sell+=$getlist['no_of_share'];
                    }
                }
                
                $msg['status']=true;
                $msg['closebal']=($buy-$sell)+$openingbal;
            }
            else
            {
                $msg['status']=false;
                $msg['closebal']=($buy-$sell)+$openingbal;
            }
        }
        catch (Exception $e)
        {
            $msg = array();
            //$connection->close();
        }
        //print_r($msg);exit;
        return $msg;
    }
    
    public function savecontratrdexceptn($uid,$usergroup,$data,$send_status)
    {
        $connection = $this->dbtrd;

        // $usergroup = $this->session->loginauthspuserfront['user_group_id'];
        // -------- Start CHECK TRANSACTION DATE VALIDATION OF NEXT 6 MONTHS --------
            $time = time();

            if($data['typeofrequest']==2)
            {
                $reetiveid=$data['selrelative'];
            }
            else
            {
                $reetiveid='';
            }

            if($data['typeofrequest']==3)
            {
                $reqtype=1;
            }
            else
            {
               $reqtype=$data['typeofrequest'];
            }
        // -------- End CHECK TRANSACTION DATE VALIDATION OF NEXT 6 MONTHS --------


        // --------  Start GET AUTO APPROVE STATUS --------
            $res=$this->tradingrequestcommon->getautoapprovestatus($uid,$usergroup,$data,$send_status);
            if(($res>=$data['noofshare'] && $send_status==1) || ($data['typeofrequest']==3 && $send_status==1))
            {
                $tradingdate=$this->tradingrequestcommon->gettradingdate($uid,$usergroup,$data,$send_status);
                if($tradingdate!='')
                {
                    $autoapst=1;
                    $tradingdate=$tradingdate;
                }
                else
                {
                    $autoapst=0;
                    $tradingdate='';
                }
            }
            else
            {
                $autoapst='';
                $tradingdate='';
            }
        // --------  End GET AUTO APPROVE STATUS --------
        $userdata = $this->tradingrequestcommon->userdetails($uid,$usergroup);
        $userPersonaldata = $this->tradingrequestcommon->userPersonaldetails($uid,$usergroup);
        $pdf_content = $this->htmlelements->Reqform2content($userdata,$data,$userPersonaldata);
        //print_r($pdf_content);exit;
        $pdfpath = $this->dompdfgen->getpdf($pdf_content,'check','Form II','FormII');
        
            //$pdfpath = $this->tradingrequestcommon->generatepdfreq($uid,$usergroup,$reetiveid,$data['idofcmp'],$data['sectype'],$data['noofshare'],$data['typeoftrans']);
            // -------- Start GET AUTO APPROVE STATUS --------
                $query = "INSERT INTO `personal_request`(`user_id`,`user_group`,`type_of_request`,`relative_id`,`name_of_requester`,`sectype`,`id_of_company`,`no_of_shares`,`type_of_transaction`,`pdffilepath`,`approver_id`,`sent_contraexeaprvl`,`apprv_contraexedte`,`contraexcapvsts`,`trading_date`,`ex_approve_status`,`exception_reason`,
                `date_added`,`date_modified`,`timeago`)
                VALUES('".$uid."','".$usergroup."','".$data['typeofrequest']."','".$reetiveid."','".$data['reqname']."','".$data['sectype']."','".$data['idofcmp']."','".$data['noofshare']."','".$data['typeoftrans']."','".$pdfpath."','".$data['approverid']."','".$send_status."',NOW(),'0','".$tradingdate."','0','".$data['reasonmsg']."',
                NOW(),NOW(),'".$time."')";

                 //echo $query;exit;
                try
                {
                    $exeget = $connection->query($query);
                    if($exeget)
                    {
                        if($send_status == 1)
                        {
                            $lastid = $connection->lastInsertId();
                            $getsendexcrqstmail = $this->exceptionreqcommon->sendexcrqstmail($lastid,'contratrd');
                        }
                        $msg['status']=true;
                        $msg['message']="Request Saved Successfully";
                        return $msg;
                    }
                 

                }
                catch(Exception $e)
                {
                    $msg['status']=false;
                    $msg['message']="Exception Occured";
                    return $msg;
                } 
    }


    public function selfdematacc($getuserid)
    {
        $connection = $this->dbtrd;
       
            $querygetdetail = "SELECT * FROM `user_demat_accounts` WHERE user_id='".$getuserid."'";  
        
       
        //echo $querygetdetail;exit;
        try
        {
                $exegetdetail = $connection->query($querygetdetail);
                $getnum = trim($exegetdetail->numRows());

                if($getnum>0)
                {
                    while($row = $exegetdetail->fetch())
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
        //print_r($getlist);exit;
        return $getlist;
    }

      public function relativedematacc($getuserid)
    {
        $connection = $this->dbtrd;
       
            
        $querygetdetail = "SELECT * FROM `relative_demat_accounts` WHERE rel_user_id = '".$getuserid."'";
       
        
        //echo $querygetdetail;exit;
        try
        {
                $exegetdetail = $connection->query($querygetdetail);
                $getnum = trim($exegetdetail->numRows());

                if($getnum>0)
                {
                    while($row = $exegetdetail->fetch())
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
        return $getlist;
    }
    
    public function userPersonaldetails($uid,$usergroup)
    {
            $connection = $this->dbtrd;
            $queryget = "SELECT * FROM `personal_info` WHERE userid = '".$uid."'";

            try
            {
                $exeget = $connection->query($queryget);
                $getnum = trim($exeget->numRows());

                if($getnum>0)
                {
                    $getlist =$exeget->fetch();
                }
                else
                {
                    $getlist = array();
                }
            }
            catch (Exception $e)
            {
                $getlist = array();
            }
            return $getlist;

    }



    
    
}
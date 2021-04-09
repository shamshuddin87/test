<?php
ini_set("max_execution_time", '1800');
ini_set('memory_limit', '1024M');

use Phalcon\Mvc\User\Component;

class Automailercommon extends Component
{
	
/* ################################# Start EmailQueue ################################# */
    public function insertemailqueue($getuserid,$user_group_id,$qtypeid,$sendtoid,$sendtoemail,$sendtoname,$infodata)
    {
        $connection = $this->dbtrd;
        $time = time();
        
        try
        {
            //print_r($infodata);exit;
            
            if($qtypeid == '6')
            {
                $maildata = json_encode($infodata);
            }
            else
            {
           
            /*$purpose = htmlentities($infodata['reason'],ENT_QUOTES);
            unset($infodata['reason']);
            $infodata['reason'] = $purpose;*/
            $maildata = '';
            $maildata = json_encode($infodata);
            //print_r($maildata);exit;
          
           
            $maildata = str_replace("'", "''", $maildata);
            //print_r($maildata);exit;    
            }
            
            $queryinsert = "INSERT INTO `email_queue`
                (`user_id`,`user_group_id`,
                `qtypeid`, `sendtoid`, `sendtoemail`, `sendtoname`, `maildata`,
                `date_added`, `date_modified`, `timeago`)
                VALUES ('".$getuserid."', '".$user_group_id."',
                '".$qtypeid."', '".$sendtoid."', '".$sendtoemail."', '".$sendtoname."', '".$maildata."', 
                NOW(),NOW(),'".$time."') ";         
            // print_r($queryinsert); exit;
            
            $exeqry = $connection->query($queryinsert);
            //echo '<pre>'; print_r($exeqry); exit;
            if($exeqry)
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
            return false;
        }
    }
    
    public function getEmailQueueData()
    {
        $connection = $this->dbtrd;
        $time = time();
        
        $getlist = array();
        try
        {
            $sqlqry = "SELECT * FROM `email_queue` WHERE `queuestatus`='0' ORDER BY `id` LIMIT 100 ";         
            //print_r($sqlqry); exit;            
            $exeqry = $connection->query($sqlqry);
            $getnum = trim($exeqry->numRows());
            //echo '<pre>'; print_r($getnum); exit;            
            if($getnum>0)
            {
                while($row = $exeqry->fetch())
                {
                    $getlist[] = $row; 
                }
                //echo '<pre>'; print_r($getlist); exit;
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
        //echo '<pre>'; print_r($getlist); exit;
        
        return $getlist;
    }
    
    public function deleteQID($delid)
    {
        $connection = $this->dbtrd;
        $time = time();
        
        try
        {
            $sqlqry = "DELETE FROM `email_queue` WHERE `id`='".$delid."' ";         
            //print_r($sqlqry); exit;            
            $exeqry = $connection->query($sqlqry);
            //echo '<pre>'; print_r($exeqry); exit;
            if($exeqry)
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
            return false;
        }
    }
    
    public function truncateQ()
    {
        $connection = $this->dbtrd;
        $time = time();
        
        try
        {
            $sqlqry = "SELECT * FROM `email_queue` ";         
            //print_r($sqlqry); exit;            
            $exeqry = $connection->query($sqlqry);
            $getnum = trim($exeqry->numRows());
            //echo '<pre>'; print_r($getnum); exit;            
            if($getnum == 0)
            {
                $sqlext = "TRUNCATE TABLE `email_queue` ";
                $exeext = $connection->query($sqlext);
                
                return true;
            }
            else
            {
                return false;
            }
        }
        catch (Exception $e)
        {
            return false;
        }
    }
/* ################################# End EmailQueue ################################# */
    
    
    
    
    
    
 //--------------------Start SEND MAIL BEFORE TWO DAYS AGO OF TRADING DATE---------------------------------//
   
//------------------------Send Mail To Approver BEFORE ONE DAY----------------------------------------------------//   
    public function sendapprovmail()
    {
        $connection = $this->dbtrd;
        $todaydate=date('d-m-Y');//(strtotime ( '-1 day' , strtotime ( $date) ) )
        $addtwodays=date('d-m-Y',(strtotime ( '+2 day' , strtotime ( $todaydate) ) ));
        $addoneday=date('d-m-Y',(strtotime ( '+1 day' , strtotime ( $todaydate) ) ));
       
  			$sqlquery = "SELECT memb.`email`,memb.`deptaccess` AS department,`cmpdl`.company_name AS mycompany,`relative`.relationship,`relative`.name  ,`rt`.request_type, ts.`transaction`, pr.*,`sec`.security_type 
  			FROM `personal_request` pr
  			LEFT JOIN type_of_transaction ts ON `ts`.id=`pr`.type_of_transaction
  			LEFT JOIN listedcmpmodule cmpdl ON `cmpdl`.id = `pr`.id_of_company 
  			LEFT JOIN relative_info relative ON `relative`.id = `pr`.relative_id 
  			LEFT JOIN request_type rt ON `rt`.id = `pr`.type_of_request 
  			LEFT JOIN `req_securitytype` sec ON `sec`.id = `pr`.sectype
  			LEFT JOIN `it_memberlist` memb ON memb.`wr_id` =  pr.`user_id`
  			LEFT JOIN `con_dept` dpt ON memb.`deptaccess` = dpt.`id`
  			WHERE (pr.`send_status`='1' OR pr.`approved_status`='2')  AND (`trading_status` IS NULL) 
  			AND (trading_date='".$addtwodays."' OR  trading_date='".$addoneday."')";


        // print_r($sqlquery);exit;

        try
        {
            $exeget = $connection->query($sqlquery);
            $getnum = trim($exeget->numRows());
	            

	            if($getnum>0)
	            {

	                while($row = $exeget->fetch())
	                {
                        // print_r("here");exit;
                        $getlist['mycompany'] = $row['mycompany']; 
                        $getlist['name_of_requester'] = $row['name_of_requester'];  
                        $getlist['email'] = $row['email']; 
                        $getlist['no_of_shares']=$row['no_of_shares']; 
                        $getlist['approved_date']=$row['approved_date'];
                        $getlist['trading_date']=$row['trading_date'];
                        $getlist['request_type']=$row['request_type'];
                        $myarry[]=$getlist;

                        $sql="SELECT `email` FROM it_memberlist WHERE wr_id IN(".$row['approver_id'].")";
                        $exegetcon = $connection->query($sql);
                        $getnum = trim($exegetcon->numRows());
                        $exegetcon = $connection->query($sql);
                        $getnumval = trim($exegetcon->numRows());

                        if($getnumval>0)
                        { 
                            while($row = $exegetcon->fetch())
                            { 
                                $result = $this->emailer->sendautomailtoapprover($row['email'],$getlist);
                            }
                        }
		             }
		        }
                else
                {
                    $getlist = array();
                }            
        }
        catch(Exception $e)
        {
           $getlist = array();
        } 

        // print_r("result");
        // print_r($result);exit;   
          
     }
     public function sendapprovmaileveryday()
     {
        $connection = $this->dbtrd;
        $todaydate=date('d-m-Y');//(strtotime ( '-1 day' , strtotime ( $date) ) )
        $addtwodays=date('d-m-Y',(strtotime ( '+2 day' , strtotime ( $todaydate) ) ));
        $addoneday=date('d-m-Y',(strtotime ( '+1 day' , strtotime ( $todaydate) ) ));

        $date1 = new DateTime($todaydate);
       
      $sqlquery = "SELECT memb.`email`,memb.`deptaccess` AS department,`cmpdl`.company_name AS mycompany,`relative`.relationship,`relative`.name  ,`rt`.request_type, ts.`transaction`, pr.*,`sec`.security_type 
      FROM `personal_request` pr
      LEFT JOIN type_of_transaction ts ON `ts`.id=`pr`.type_of_transaction
      LEFT JOIN listedcmpmodule cmpdl ON `cmpdl`.id = `pr`.id_of_company 
      LEFT JOIN relative_info relative ON `relative`.id = `pr`.relative_id 
      LEFT JOIN request_type rt ON `rt`.id = `pr`.type_of_request 
      LEFT JOIN `req_securitytype` sec ON `sec`.id = `pr`.sectype
      LEFT JOIN `it_memberlist` memb ON memb.`wr_id` =  pr.`user_id`
      LEFT JOIN `con_dept` dpt ON memb.`deptaccess` = dpt.`id`
      WHERE (pr.`send_status`='1' OR pr.`approved_status`='2')  AND (`trading_status` IS NULL) 
      AND (trading_date='".$addtwodays."' OR  trading_date='".$addoneday."')";
      // print_r($sqlquery);exit;
         
        try
        {
            $exeget = $connection->query($sqlquery);
            $getnum = trim($exeget->numRows());
              
            if($getnum>0)
            {
                while($row = $exeget->fetch())
                {
                    // print_r("here");exit;
                    $date2 = new DateTime($row['trading_date']);

                    if($date2<$date1)
                    {
                        $getlist['mycompany'] = $row['mycompany']; 
                        $getlist['name_of_requester'] = $row['name_of_requester'];  
                        $getlist['email'] = $row['email']; 
                        $getlist['no_of_shares']=$row['no_of_shares']; 
                        $getlist['approved_date']=$row['approved_date'];
                        $getlist['trading_date']=$row['trading_date'];
                        $getlist['request_type']=$row['request_type'];
                        $myarry[]=$getlist;

                        $sql="SELECT `email` FROM it_memberlist WHERE wr_id IN(".$row['approver_id'].")";
                        $exegetcon = $connection->query($sql);
                        $getnum = trim($exegetcon->numRows());
                        $exegetcon = $connection->query($sql);
                        $getnumval = trim($exegetcon->numRows());

                        if($getnumval>0)
                        { 
                            while($row = $exegetcon->fetch())
                            { 
                                $result = $this->emailer->sendautomailtoapprover($row['email'],$getlist);
                            }
                        }
                    }
                }
            }
            else
            {
                $getlist = array();
            }            
        }
        catch(Exception $e)
        {
           $getlist = array();
        } 

        // print_r("result aprover");
        // print_r($result);exit;   
          
     }
//--------------------------SEND MAIL TO APPROVER BEFORE ONE DAY FINISH HERE---------------------------------------//



    public function sendpendapprovmaileveryday()
    {
        $connection = $this->dbtrd;

        // $sqlquery = "SELECT cd.`id` as reqno,cc.`category` as nature_of_conflict,im.`fullname` as requestername,GROUP_CONCAT(DISTINCT dept.`deptname`) as deptname,im.`deptaccess`,im.`cmpaccess` FROM `coi_declaration` cd
        //             LEFT JOIN `coi_category` cc ON cd.catid = cc.id
        //             LEFT JOIN `it_memberlist` im ON im.wr_id = cd.user_id
        //             LEFT JOIN `con_dept` dept ON FIND_IN_SET(dept.`id`,im.`deptaccess`)
        //             WHERE cd.`hrM_processed_status`='Pending Approval' || cd.`deptM_processed_status`='Pending Approval'";

        $sqlquery = "SELECT cd.`id` as reqno,cc.`category` as nature_of_conflict,im.`fullname` as requestername,dept.`deptname`,im.`deptaccess`,im.`cmpaccess` FROM `coi_declaration` cd
                    LEFT JOIN `coi_category` cc ON cd.catid = cc.id
                    LEFT JOIN `it_memberlist` im ON im.wr_id = cd.user_id
                    LEFT JOIN `con_dept` dept ON FIND_IN_SET(dept.`id`,im.`deptaccess`)
                    WHERE cd.`hrM_processed_status`='Pending Approval' || cd.`deptM_processed_status`='Pending Approval'";
            // print_r($sqlquery);exit;
         
        try
        {
            $exeget = $connection->query($sqlquery);
            $getnum = trim($exeget->numRows());
              
            if($getnum>0)
            {
                while($row = $exeget->fetch())
                {
                        $reqno = "COI".str_pad($row['reqno'], 7, '0', STR_PAD_LEFT);
                        $getlist['reqno'] = $reqno;   
                        $getlist['requestername'] = $row['requestername']; 
                        $getlist['nature_of_conflict']=$row['nature_of_conflict']; 
                        $getlist['deptname'] = $row['deptname'];
                        $getlist['disclosure_made_by'] = $row['requestername']; 
                        $myarry=$getlist;

                        $hrdeptmgrs = $this->coicommon->getHrDeptMgrs($row['deptaccess'],$row['cmpaccess'],"");
                        // echo"<pre>";print_r($hrdeptmgrs);die;

                        foreach($hrdeptmgrs as $hrdeptmgr)
                        { 
                            $result = $this->emailer->sendpendapprovmaileveryday($hrdeptmgr['email'],$hrdeptmgr['mgrname'],$myarry);
                        }
                }
            }
            else
            {
                $getlist = array();
            }            
        }
        catch(Exception $e)
        {
           $getlist = array();
        } 

        // print_r("result aprover");
        // print_r($result);exit;   
          
    }

   public function sendmailtousers()
   {
        $connection = $this->dbtrd;
        $todaydate=date('d-m-Y');//(strtotime ( '-1 day' , strtotime ( $date) ) )
        $addtwodays=date('d-m-Y',(strtotime ( '+2 day' , strtotime ( $todaydate) ) ));
        $addoneday=date('d-m-Y',(strtotime ( '+1 day' , strtotime ( $todaydate) ) ));
       
			$sqlquery = "SELECT memb.`email`,memb.`deptaccess` AS department,`cmpdl`.company_name AS mycompany,`relative`.relationship,`relative`.name  ,`rt`.request_type, ts.`transaction`, pr.*,`sec`.security_type 
			FROM `personal_request` pr
			LEFT JOIN type_of_transaction ts ON `ts`.id=`pr`.type_of_transaction
			LEFT JOIN listedcmpmodule cmpdl ON `cmpdl`.id = `pr`.id_of_company 
			LEFT JOIN relative_info relative ON `relative`.id = `pr`.relative_id 
			LEFT JOIN request_type rt ON `rt`.id = `pr`.type_of_request 
			LEFT JOIN `req_securitytype` sec ON `sec`.id = `pr`.sectype
			LEFT JOIN `it_memberlist` memb ON memb.`wr_id` =  pr.`user_id`
			LEFT JOIN `con_dept` dpt ON memb.`deptaccess` = dpt.`id`
			WHERE (pr.`send_status`='1' OR pr.`approved_status`='2')  AND (`trading_status` IS NULL) 
			AND (trading_date='".$addtwodays."' OR  trading_date='".$addoneday."')";


              
        try
        {
            $exeget = $connection->query($sqlquery);
            $getnum = trim($exeget->numRows());
	            

	            if($getnum>0)
	            {

	                while($row = $exeget->fetch())
	                {
	                     // print_r("here");exit;
	                       $getlist['mycompany'] = $row['mycompany'];  
	                       $getlist['email'] = $row['email']; 
	                       $getlist['no_of_shares']=$row['no_of_shares']; 
	                       $getlist['approved_date']=$row['approved_date'];
	                       $getlist['trading_date']=$row['trading_date'];
	                       $getlist['request_type']=$row['request_type'];
	                       $myarry[]=$getlist;
	                }

	                for($i=0;$i<count($myarry);$i++)
	                {
	                   $result = $this->emailer->sendautomailtouser($myarry[$i]['email'],$myarry[$i]);
	                }

	            }
	            else
	             {
	                $getlist = array();
	             }            
        }
        catch(Exception $e)
        {
           $getlist = array();
        }  
  }

 //--------------------SEND MAIL BEFORE TWO DAYS AGO OF TRADING DATE FINISH---------------------------------//


 //--------------------SEND MAIL BEFORE TO USER EVERY DAY----------------------------------------------------//

	public function sendmailtouserseveryday()
    {
        $connection = $this->dbtrd;
        $todaydate=date('d-m-Y');//(strtotime ( '-1 day' , strtotime ( $date) ) )
        $addtwodays=date('d-m-Y',(strtotime ( '+2 day' , strtotime ( $todaydate) ) ));
        $addoneday=date('d-m-Y',(strtotime ( '+1 day' , strtotime ( $todaydate) ) ));


        $date1 = new DateTime($todaydate);
        // $date2 = new DateTime("2011-10-12");
       
        $sqlquery = "SELECT memb.`email`,memb.`deptaccess` AS department,`cmpdl`.company_name AS mycompany,`relative`.relationship,`relative`.name  ,`rt`.request_type, ts.`transaction`, pr.*,`sec`.security_type 
                FROM `personal_request` pr
                LEFT JOIN type_of_transaction ts ON `ts`.id=`pr`.type_of_transaction
                LEFT JOIN listedcmpmodule cmpdl ON `cmpdl`.id = `pr`.id_of_company 
                LEFT JOIN relative_info relative ON `relative`.id = `pr`.relative_id 
                LEFT JOIN request_type rt ON `rt`.id = `pr`.type_of_request 
                LEFT JOIN `req_securitytype` sec ON `sec`.id = `pr`.sectype
                LEFT JOIN `it_memberlist` memb ON memb.`wr_id` =  pr.`user_id`
                LEFT JOIN `con_dept` dpt ON memb.`deptaccess` = dpt.`id`
                WHERE (pr.`send_status`='1' OR pr.`approved_status`='2')  AND (`trading_status` IS NULL)";

                // print_r($sqlquery);exit; 
        try
        {
            $exeget = $connection->query($sqlquery);
            $getnum = trim($exeget->numRows());
            if($getnum>0)
            {
            	   
                while($row = $exeget->fetch())
                {
                   $date2 = new DateTime($row['trading_date']);
                	
                
                	if($date2<$date1)
                	{
                       $getlist['mycompany'] = $row['mycompany'];  
                       $getlist['email'] = $row['email']; 
                       $getlist['no_of_shares']=$row['no_of_shares']; 
                       $getlist['approved_date']=$row['approved_date'];
                       $getlist['trading_date']=$row['trading_date'];
                       $getlist['request_type']=$row['request_type'];
                       $myarry[]=$getlist;
                		

                	}
                      

                 }

                for($i=0;$i<count($myarry);$i++)
                {
                    $result = $this->emailer->sendautomailtouser($myarry[$i]['email'],$myarry[$i]);
                }

            }
            else
             {
                $getlist = array();
             }            

        }
        catch(Exception $e)
        {
           $getlist = array();
        }    
  }

//--------------------SEND MAIL BEFORE TO USER EVERY DAY FINISH----------------------------------------------------//

    
/* ------------------------ Start ------------------------ */
    public function getallusers()
    {
        $connection = $this->dbtrd;
        try
        {
            $queryget = "SELECT * FROM `it_memberlist` WHERE `master_group_id`!= 2 "; 
            //echo $queryget;  exit;
            
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



    /*---- Send Auto Mail to User For Annual Declaration -----*/
    public function chkifanualdeclfryear($userid,$year)
    {
        $connection = $this->dbtrd;
        try
        {
            $queryget = "SELECT * FROM `annual_initial_declaration` WHERE send_status = '1' AND annualyear = '".$year."' AND `user_id`= '".$userid."' "; 
            //echo $queryget;  exit;
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
    /*---- Send Auto Mail to User For Annual Declaration -----*/
    
    
    public function chkifprsnlinfo($userid)
    {
        $connection = $this->dbtrd;
        try
        {
            $queryget = "SELECT * FROM `personal_info` WHERE `userid`= '".$userid."' "; 
            //echo $queryget;  exit;
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
    
    public function getremindrdate($userid)
    {
        $connection = $this->dbtrd;
        try
        {
            $queryget = "SELECT * FROM `reminderofpersninfo` WHERE `user_id`= '".$userid."' "; 
            //echo $queryget;  exit;
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
    
    public function nameofusr($userid)
    {
        $connection = $this->db;
        try
        {
            $queryget = "SELECT * FROM `web_register_user` WHERE `user_id`= '".$userid."' "; 
            //echo $queryget;  exit;
            $exeget = $connection->query($queryget);
            $getnum = trim($exeget->numRows());

            if($getnum>0)
            {
                while($row = $exeget->fetch())
                {
                    $getlist = $row;
                }
                //echo '<pre>';print_r($getlist);exit;
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
    
    public function updtereminder($userid,$remindrdate)
    {
        $connection = $this->dbtrd;
        $time = time();
        try
        {
            $updata = "UPDATE `reminderofpersninfo` SET `reminderdate`='".$remindrdate."',`date_modified`=NOW(),`timeago`='".$time."' WHERE `user_id`='".$userid."'";
            $exe = $connection->query($updata);
            if($exe)
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
    
    
    public function chkifhldngstmnt($userid)
    {
        $connection = $this->dbtrd;
        try
        {
             
            $queryget = "SELECT * FROM `holdingstatement` WHERE `user_id`= '".$userid."' "; 
            //echo $queryget;  exit;
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
    
    public function gethldngremindrdate($userid)
    {
        $connection = $this->dbtrd;
        try
        {
            $queryget = "SELECT * FROM `reminderofholdingstmnt` WHERE `user_id`= '".$userid."' "; 
            //echo $queryget;  exit;
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
    
    public function updtehldngreminder($userid,$remindrdate)
    {
        $connection = $this->dbtrd;
        $time = time();
        try
        {
            $updata = "UPDATE `reminderofholdingstmnt` SET `reminderdate`='".$remindrdate."',`date_modified`=NOW(),`timeago`='".$time."' WHERE `user_id`='".$userid."'";
            $exe = $connection->query($updata);
            if($exe)
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
    
    public function getnotradereqst()
    {
        $connection = $this->dbtrd;
        try
        {
             $queryget = "SELECT pr.*,memb.`email`,cmp.`company_name`,trans.`transaction`,secu.`security_type` FROM `personal_request` pr LEFT JOIN `it_memberlist` memb ON memb.`wr_id` = pr.`user_id`
                LEFT JOIN `listedcmpmodule` cmp ON cmp.`id` = pr.`id_of_company`
                LEFT JOIN `type_of_transaction` trans ON trans.`id` = pr.`type_of_transaction`
                LEFT JOIN `req_securitytype` secu ON secu.`id`=pr.`sectype`
                WHERE `trading_status`IS NULL"; 
            //echo $queryget;  exit;
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
/* ------------------------ End ------------------------ */    
    
    /* for pending creating coi application */
    public function sendRemindtoReqstreveryday()
    {
        $connection = $this->dbtrd;
        $isreldata = '';
        $ismfrdata = '';
        $allUsers = $this->getallusers();
        foreach($allUsers as $key => $val)
        {
            $userid = $val['wr_id'];
            $useremail = $val['email'];
            $username = $val['fullname'];
            $queryrel = "SELECT * FROM `relative_info` WHERE `user_id`= '".$userid."' "; 
            //echo $queryrel;  exit;
            $querymfr = "SELECT * FROM `mfr` WHERE `user_id`= '".$userid."' ";
            //echo $querymfr;
            $exegetrel = $connection->query($queryrel);
            $exegetmfr = $connection->query($querymfr);
            $getnumrel = trim($exegetrel->numRows());
            $getnummfr = trim($exegetmfr->numRows());
            if($getnumrel>0)
            {
                $rowrel = $exegetrel->fetch();
                $isreldata = $rowrel['isbusiness_partner'];
                //echo '<pre>';print_r($getlist);exit;
            }
            if($getnummfr>0)
            {
                $rowmfr = $exegetmfr->fetch();
                $ismfrdata = $rowmfr['mfr_thirdparty'];
            }
            if($isreldata == 'Yes' || $ismfrdata == 'Yes')
            {
                $mailstatus = $this->emailer->sendRemindtoReqstr($useremail,$username);
            }
        }
    }
    /* for pending creating coi application */
    
}

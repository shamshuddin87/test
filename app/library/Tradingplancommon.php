<?php
use Phalcon\Mvc\User\Component;
class Tradingplancommon extends Component
{
 
/****************** fetch requestor for start ******************/
    public function getrequestfor()
    {
       $connection = $this->dbtrd;
        try
        {
            $queryselect = "SELECT * FROM `tradingplan_relative` ";
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
/****************** fetch requestor for end ******************/
 
/****************** fetch relative detail start ******************/
    public function getretvdetail($uid,$usergroup)
    {
       $connection = $this->dbtrd;
        try
        {
            $queryselect = "SELECT * FROM `relative_info` WHERE `user_id` = '".$uid."' ";
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
/****************** fetch relative detail end ******************/
    
/****************** fetch company detail start ******************/
    
    public function getcompnydetail($uid,$usergroup)
    {
    $connection = $this->dbtrd;
    try
    {
        $queryselect = "SELECT * FROM `it_memberlist` WHERE `wr_id` = '".$uid."' ";
        $exeget = $connection->query($queryselect);
        $getnum = trim($exeget->numRows());
        if($getnum>0)
            {
                while($row = $exeget->fetch())
                {
                    $cmp = explode(',',$row['cmpaccess']);
                    foreach ($cmp as $kid => $vid)
                    {
                        //echo "cheking value";echo '<pre>';print_r($vbp);exit;
                        $querysql = "SELECT * FROM `companylist` 
                        WHERE `id`='".$vid."' "; 
                        $execompinfo = $connection->query($querysql);
                        $execmp = $execompinfo->fetch();
                        $getlist[] = $execmp;

                    }
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
/****************** fetch company detail end ******************/
    
/****************** fetch security type start ******************/
    public function getsectypes()
    {
        $connection = $this->dbtrd;
        try
        {
            $queryselect = "SELECT * FROM `req_securitytype` ";
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
/****************** fetch security type end ******************/


/****************** insert trading plan start ******************/
    public function inserttradingplan($getuserid,$user_group_id,$requestfor,$relative,$cmpnme,$frmdate,$todate,$sectype,$datetype,$spficdate,$daterngfrm,$daterngto,$noofsec,$valueofsecurity,$uniqid,$apprvrid)
    {
     $connection = $this->dbtrd;
     $time = time();   
     for($i = 0;$i<sizeof($sectype);$i++)
     {
       
        if($requestfor==1){$relative = '';}else{$relative = $relative;}
        if($datetype[$i]==2)
         {
          $queryinsert = "INSERT INTO `tradingplan_request`
            (`user_id`,`user_group_id`,`approverid`,`requestfor`,`relative`,`companyid`,`fromdate`,`todate`, `secutype`, `datetype`, `specificdate`, `daterangefrm`, `daterangeto`, `noofsecu`, `valueofsecu`,`num`,`uniqueid`,`date_added`, `date_modified`,`timeago`)
             VALUES ('".$getuserid."','".$user_group_id."','".$apprvrid."','".$requestfor."','".$relative."','".$cmpnme."','".$frmdate."','".$todate."','".$sectype[$i]."','".$datetype[$i]."',NULL,'".$daterngfrm[$i]."','".$daterngto[$i]."','".$noofsec[$i]."','".$valueofsecurity[$i]."','".$i."','".$uniqid."',NOW(),NOW(),'".$time."')";
         }
         else if($datetype[$i]==1)
         {
             $queryinsert = "INSERT INTO `tradingplan_request`
            (`user_id`,`user_group_id`,`approverid`,`requestfor`,`relative`,`companyid`,`fromdate`,`todate`, `secutype`, `datetype`, `specificdate`, `daterangefrm`, `daterangeto`, `noofsecu`, `valueofsecu`,`num`,`uniqueid`,`date_added`, `date_modified`,`timeago`)
             VALUES ('".$getuserid."','".$user_group_id."','".$apprvrid."','".$requestfor."','".$relative."','".$cmpnme."','".$frmdate."','".$todate."','".$sectype[$i]."','".$datetype[$i]."','".$spficdate[$i]."',NULL,NULL,'".$noofsec[$i]."','".$valueofsecurity[$i]."','".$i."','".$uniqid."',NOW(),NOW(),'".$time."')";
         }
         //echo $queryinsert;
         $exe = $connection->query($queryinsert);
     }
        //echo 'here';exit;
         
            //echo $queryinsert;
        try
        {
            return true;
        }
        catch (Exception $e) 
        {
            //echo "checkng Exception";print_r($e);exit;
            return false;
        }
 }
    
    public function getaprvrid($getuserid)
    {
        $connection = $this->dbtrd;
        try
        {
            $queryselect = "SELECT * FROM `it_memberlist` WHERE `wr_id`='".$getuserid."' ";
            //echo $queryselect;exit;
            $exeget = $connection->query($queryselect);
            $getnum = trim($exeget->numRows());
            if($getnum>0)
                {
                    while($row = $exeget->fetch())
                    {
                        $getlist[] = $row['approvid'];
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
    
    public function checkperioddate($getuserid,$cmpnme,$frmdate,$todate)
    {
        $connection = $this->dbtrd;
        try
        {
            $queryselect = "SELECT * FROM `tradingplan_request` 
                            WHERE '".$frmdate."' BETWEEN fromdate AND todate 
                            OR '".$todate."' BETWEEN fromdate AND todate 
                            OR fromdate >= '".$frmdate."' AND todate <= '".$todate."' 
                            OR todate <= '".$frmdate."' AND fromdate >= '".$todate."'  ";
            //echo $queryselect;exit;
            $exeget = $connection->query($queryselect);
            $getnum = trim($exeget->numRows());
            if($getnum>0)
                {
                    while($row = $exeget->fetch())
                    {
                        if($row['companyid'] == $cmpnme && $row['user_id'] == $getuserid)
                        {
                            $getlist[] = $row;
                        }
                        else
                        {
                            $getlist = array();
                        }
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
    
    public function checkblackout($getuserid,$cmpnme,$frmdate,$todate)
    {
        $connection = $this->dbtrd;
        try
        {
            $queryselect = "SELECT * FROM `blackoutperiod_cmp` 
                            WHERE '".$frmdate."' BETWEEN datefrom AND dateto 
                            OR '".$todate."' BETWEEN datefrom AND dateto 
                            OR datefrom >= '".$frmdate."' AND dateto <= '".$todate."' 
                            OR dateto <= '".$frmdate."' AND datefrom >= '".$todate."'  ";
            //echo $queryselect;exit;
            $exeget = $connection->query($queryselect);
            $getnum = trim($exeget->numRows());
            //echo $getnum;exit;
            if($getnum>0)
                {
                    while($row = $exeget->fetch())
                    {
                        if($row['companyid'] == $cmpnme)
                        {
                            $getlist[] = $row;
                        }
                        else
                        {
                            $getlist = array();
                        }
                    }
                   // echo '<pre>';print_r($getlist);exit;

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

/****************** insert trading plan end ******************/
    
/****************** fetch trading plan start ******************/
    public function fetchtradeplan($getuserid,$user_group_id,$query)
    {
        
        $connection = $this->dbtrd;
        try
        {

                 $queryget = "SELECT treq.*,trel.`tradingplan`,cmp.companyname, relinf.name,resec.security_type,memb.`fullname` FROM `tradingplan_request` treq
                             LEFT JOIN `tradingplan_relative` trel ON trel.`id` = treq.`requestfor`
                             LEFT JOIN `companylist` cmp ON cmp.id = treq.companyid
                             LEFT JOIN `relative_info` relinf ON relinf.id = treq.relative
                             LEFT JOIN `req_securitytype` resec ON resec.id = treq.secutype
                             LEFT JOIN `it_memberlist` memb ON memb.`wr_id` = treq.`user_id`
                             WHERE treq.user_id= '".$getuserid."' GROUP BY treq.`uniqueid` ".$query; 
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
/****************** fetch trading plan end ******************/
    
    /****************** fetch trading plan view start ******************/
    public function fetchtradeplanview($getuserid,$user_group_id,$tradeid,$tradeuniid,$query)
    {
        $connection = $this->dbtrd;
        try
        {

                 $queryget = "SELECT treq.*,trel.`tradingplan`,cmp.companyname, relinf.name,resec.security_type FROM                     `tradingplan_request` treq
                             LEFT JOIN `tradingplan_relative` trel ON trel.`id` = treq.`requestfor`
                             LEFT JOIN `companylist` cmp ON cmp.id = treq.companyid
                             LEFT JOIN `relative_info` relinf ON relinf.id = treq.relative
                             LEFT JOIN `req_securitytype` resec ON resec.id = treq.secutype
                             WHERE treq.uniqueid= '".$tradeuniid."' " .$query; 
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
    /****************** fetch trading plan view end ******************/
    
    /****************** send trading plan for approval start (tradeplanview)******************/
    public function sendplanforapprv($getuserid,$user_group_id,$tradeid)
    {
        $connection = $this->dbtrd;
        $time = time();
        $tradeid = explode(',',$tradeid);
        for($i = 0;$i<sizeof($tradeid);$i++)
        {
            $insertml =  "UPDATE `tradingplan_request` SET  `send_status`=1,`approvedstatus`=0,`date_modified`=NOW(),`timeago`='".$time."' WHERE `id`='".$tradeid[$i]."' ";
            //echo $insertml;
            $exe = $connection->query($insertml);

        }
        try
        {
            if($exe)
            {
                $getmailsendtoapprvr = $this->tradingplancommon->tradeplanmailtoapprvr($tradeid[0]);
                $result = $this->notificationcommon->upsisharingnotify($getuserid,$tradeid,"10");
            }

            return true;
        }
        catch (Exception $e) 
        {
            return false;
        }
        
    }
     /****************** send trading plan for approval end ******************/
    
    /******************* fetch trading plan for approve start (planreqstview)******************/
    public function fetchplanforapprove($getuserid,$user_group_id,$query)
    {
        $connection = $this->dbtrd;
        try
        {
            if($user_group_id == 2)
            {
               $queryget = "SELECT treq.*,trel.`tradingplan`,cmp.companyname, relinf.name,resec.security_type,memb.`fullname` FROM `tradingplan_request` treq
                             LEFT JOIN `tradingplan_relative` trel ON trel.`id` = treq.`requestfor`
                             LEFT JOIN `companylist` cmp ON cmp.id = treq.companyid
                             LEFT JOIN `relative_info` relinf ON relinf.id = treq.relative
                             LEFT JOIN `req_securitytype` resec ON resec.id = treq.secutype
                             LEFT JOIN `it_memberlist` memb ON memb.`wr_id` = treq.`user_id`
                             WHERE treq.`send_status` = '1' GROUP BY treq.`uniqueid` ORDER BY ID DESC" .$query; 
            }
            else
            {
                $queryget = "SELECT treq.*,trel.`tradingplan`,cmp.companyname, relinf.name,resec.security_type,memb.`fullname` FROM `tradingplan_request` treq
                             LEFT JOIN `tradingplan_relative` trel ON trel.`id` = treq.`requestfor`
                             LEFT JOIN `companylist` cmp ON cmp.id = treq.companyid
                             LEFT JOIN `relative_info` relinf ON relinf.id = treq.relative
                             LEFT JOIN `req_securitytype` resec ON resec.id = treq.secutype
                             LEFT JOIN `it_memberlist` memb ON memb.`wr_id` = treq.`user_id`
                             WHERE treq.`send_status` = '1' AND FIND_IN_SET('".$getuserid."',treq.`approverid`) GROUP BY treq.`uniqueid` ORDER BY ID DESC" .$query; 
            }
                  
                //echo $queryget;exit;
                $exeget = $connection->query($queryget);
                $getnum = trim($exeget->numRows());

                if($getnum>0)
                {
                    while($row = $exeget->fetch())
                    { 
                        $getlist[] = $row; 
                    
                    }
               }else{
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
    /******************* fetch trading plan for approve end******************/
    
    /******************* approving trade plan start (planreqstapprv)******************/
    public function apprvtradeplan($getuserid,$user_group_id,$tradeid)
    {
        $connection = $this->dbtrd;
        $time = time();
        $tradeid = explode(',',$tradeid);
        for($i = 0;$i<sizeof($tradeid);$i++)
        {
            $insertml =  "UPDATE `tradingplan_request` SET  `approvedstatus`=1,`date_modified`=NOW(),`timeago`='".$time."' WHERE `id`='".$tradeid[$i]."' ";
            //echo $insertml;
            $exe = $connection->query($insertml);

        }
        try
        {
            if($exe)
            {
               $getmailsendtoreqstr = $this->tradingplancommon->tradeplanmailtoreqstr($tradeid[0]); 
               $result=$this->notificationcommon->tradingplanapproval($getuserid,$tradeid,"8");
            }

            return true;
        }
        catch (Exception $e) 
        {
            return false;
        }
        
    }
    /******************* approving trade plan end ******************/
    
    /******************* reject trade plan start (planreqstapprv)******************/
    public function rejcttradeplan($getuserid,$user_group_id,$rejctid,$message)
    {
        //print_r($tradeid);exit;
        $connection = $this->dbtrd;
        $time = time();
        $rejctid = explode(',',$rejctid);
        for($i = 0;$i<sizeof($rejctid);$i++)
        {
            $insertml =  "UPDATE `tradingplan_request` SET  `approvedstatus`=2,`reject_msg`='".$message."',`date_modified`=NOW(),`timeago`='".$time."' WHERE `id`='".$rejctid[$i]."' ";
            //echo $insertml;
            $exe = $connection->query($insertml);

        }
        try
        {
            if($exe)
            {

                 $result=$this->notificationcommon->tradingplanapproval($getuserid,$rejctid,"9");
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
    /******************* reject trade plan end ******************/
    
    /******************* fetch reject trade plan mssg start(tradingplan & planreqstapprv) ******************/
    public function fetchrejectmessage($getuserid,$user_group_id,$tradeid)
    {
        $connection = $this->dbtrd;
        try
        {

                 $queryget = "SELECT treq.*,trel.`tradingplan`,cmp.companyname, relinf.name,resec.security_type FROM                     `tradingplan_request` treq
                             LEFT JOIN `tradingplan_relative` trel ON trel.`id` = treq.`requestfor`
                             LEFT JOIN `companylist` cmp ON cmp.id = treq.companyid
                             LEFT JOIN `relative_info` relinf ON relinf.id = treq.relative
                             LEFT JOIN `req_securitytype` resec ON resec.id = treq.secutype
                             WHERE treq.`id` = '".$tradeid."'"; 
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
    /******************* fetch reject trade plan mssg end ******************/
    
    /******************* fetch trade plan for edit start ******************/
    public function fetchtradeplanedit($getuserid,$user_group_id,$tradeid)
    {
        $connection = $this->dbtrd;
        try
        {

                 $queryget = "SELECT treq.*,trel.`tradingplan`,cmp.companyname, relinf.name,resec.security_type FROM                     `tradingplan_request` treq
                             LEFT JOIN `tradingplan_relative` trel ON trel.`id` = treq.`requestfor`
                             LEFT JOIN `companylist` cmp ON cmp.id = treq.companyid
                             LEFT JOIN `relative_info` relinf ON relinf.id = treq.relative
                             LEFT JOIN `req_securitytype` resec ON resec.id = treq.secutype
                             WHERE treq.`id` = '".$tradeid."'"; 
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
    /******************* fetch trade plan for edit end ******************/
    
    public function updateplan($getuserid,$user_group_id,$sectype,$datetype,$spficdate,$daterngfrm,$daterngto,$noofsec,$valueofsecurity,$planid)
    {
        $connection = $this->dbtrd;
        $time = time();
        //print_r($datetype);exit;
        if($datetype == 1)
        {
            $insertml =  "UPDATE `tradingplan_request` SET  `secutype`='".$sectype."',`datetype`='".$datetype."',`specificdate`='".$spficdate."',`daterangefrm`=NULL,`daterangeto`=NULL,`noofsecu`='".$noofsec."',`valueofsecu`='".$valueofsecurity."',`date_modified`=NOW(),`timeago`='".$time."' WHERE `id`='".$planid."' ";
        }
        else
        {
            $insertml =  "UPDATE `tradingplan_request` SET  `secutype`='".$sectype."',`datetype`='".$datetype."',`specificdate`=NULL,`daterangefrm`='".$daterngfrm."',`daterangeto`='".$daterngto."',`noofsecu`='".$noofsec."',`valueofsecu`='".$valueofsecurity."',`date_modified`=NOW(),`timeago`='".$time."' WHERE `id`='".$planid."' ";
        }
        
        
        try
        {
            $exe = $connection->query($insertml);
            return true;
        }
        catch (Exception $e) 
        {
            return false;
        }
    }
    
    public function updatetrade($getuserid,$user_group_id,$requestfor,$relative,$cmpnme,$frmdate,$todate,$tradeuniqueid)
    {
        $connection = $this->dbtrd;
        $time = time();
        //print_r($tradeuniqueid);exit;
            $insertml =  "UPDATE `tradingplan_request` SET  `requestfor`='".$requestfor."',`relative`='".$relative."',`companyid`='".$cmpnme."',`fromdate`='".$frmdate."',`todate`='".$todate."',`date_modified`=NOW(),`timeago`='".$time."' WHERE `uniqueid`='".$tradeuniqueid."' ";
       
        //echo $insertml;exit;
        
        try
        {
            $exe = $connection->query($insertml);
            return true;
        }
        catch (Exception $e) 
        {
            return false;
        }
      }
    
    public function insertplan($getuserid,$user_group_id,$requestfor,$relative,$cmpnme,$frmdate,$todate,$tradeuniqueid,$sectype,$datetype,$spficdate,$daterngfrm,$daterngto,$noofsec,$valueofsecurity,$getaprvrid)
    {
       $connection = $this->dbtrd;
        $time = time();
        for($i = 0;$i<sizeof($sectype);$i++)
        {
            if($datetype[$i]==2)
             {
              $queryinsert = "INSERT INTO `tradingplan_request`
                (`user_id`,`user_group_id`,`approverid`,`requestfor`,`relative`,`companyid`,`fromdate`,`todate`, `secutype`, `datetype`, `specificdate`, `daterangefrm`, `daterangeto`, `noofsecu`, `valueofsecu`,`num`,`uniqueid`,`date_added`, `date_modified`,`timeago`)
                 VALUES ('".$getuserid."','".$user_group_id."','".$getaprvrid."','".$requestfor."','".$relative."','".$cmpnme."','".$frmdate."','".$todate."','".$sectype[$i]."','".$datetype[$i]."',NULL,'".$daterngfrm[$i]."','".$daterngto[$i]."','".$noofsec[$i]."','".$valueofsecurity[$i]."',1,'".$tradeuniqueid."',NOW(),NOW(),'".$time."')";
             }
             else if($datetype[$i]==1)
             {
                 $queryinsert = "INSERT INTO `tradingplan_request`
                (`user_id`,`user_group_id`,`approverid`,`requestfor`,`relative`,`companyid`,`fromdate`,`todate`, `secutype`, `datetype`, `specificdate`, `daterangefrm`, `daterangeto`, `noofsecu`, `valueofsecu`,`num`,`uniqueid`,`date_added`, `date_modified`,`timeago`)
                 VALUES ('".$getuserid."','".$user_group_id."','".$getaprvrid."','".$requestfor."','".$relative."','".$cmpnme."','".$frmdate."','".$todate."','".$sectype[$i]."','".$datetype[$i]."','".$spficdate[$i]."',NULL,NULL,'".$noofsec[$i]."','".$valueofsecurity[$i]."',1,'".$tradeuniqueid."',NOW(),NOW(),'".$time."')";
             }
             //echo $queryinsert;
             $exe = $connection->query($queryinsert);
        }
        //echo 'here';exit;
         
            //echo $queryinsert;
        try
        {
            
            return true;
        }
        catch (Exception $e) 
        {
            //echo "checkng Exception";print_r($e);exit;
            return false;
        } 
    }
    
    public function checkperiodforupdate($getuserid,$cmpnme,$frmdate,$todate,$tradeuniqueid)
    {
        $connection = $this->dbtrd;
        try
        {
            $queryselect = "SELECT * FROM `tradingplan_request` 
                            WHERE '".$frmdate."' BETWEEN fromdate AND todate 
                            OR '".$todate."' BETWEEN fromdate AND todate 
                            OR fromdate >= '".$frmdate."' AND todate <= '".$todate."' 
                            OR todate <= '".$frmdate."' AND fromdate >= '".$todate."'  ";
            //echo $queryselect;exit;
            $exeget = $connection->query($queryselect);
            $getnum = trim($exeget->numRows());
            if($getnum>0)
                {
                    while($row = $exeget->fetch())
                    {
                        if($row['companyid'] == $cmpnme && $row['user_id'] == $getuserid && $row['uniqueid'] != $tradeuniqueid)
                        {
                            $getlist[] = $row;
                        }
                        else
                        {
                            $getlist = array();
                        }
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
    
    public function deletetradeplan($id)
    {
        $connection = $this->dbtrd;
        $queryget = "DELETE FROM `tradingplan_request` WHERE `id`= '".$id."'"; 
            
           try
           { 
                $exeml = $connection->query($queryget);

                if($exeml)
                {

                        $returndta = array('status'=>true,'msg'=>'Deleted Successfully !! '); 

                }
                else
                { $returndta = array('status'=>false,'msg'=>'Record Not Deleted !! ');   }
            
          }
        catch (Exception $e)
        {
            $returndta = array('status'=>false,'msg'=>'Record Not Deleted !! ');
        }
              
          
        return $returndta; 
    }
        
    public function checkperioddatereltv($getuserid,$cmpnme,$frmdate,$todate,$relative)
    {
        $connection = $this->dbtrd;
        try
        {
            $queryselect = "SELECT * FROM `tradingplan_request` 
                            WHERE '".$frmdate."' BETWEEN fromdate AND todate 
                            OR '".$todate."' BETWEEN fromdate AND todate 
                            OR fromdate >= '".$frmdate."' AND todate <= '".$todate."' 
                            OR todate <= '".$frmdate."' AND fromdate >= '".$todate."'  ";
            //echo $queryselect;exit;
            $exeget = $connection->query($queryselect);
            $getnum = trim($exeget->numRows());
            if($getnum>0)
                {
                    while($row = $exeget->fetch())
                    {
                        if($row['companyid'] == $cmpnme && $row['user_id'] == $getuserid && $row['relative'] == $relative)
                        {
                            $getlist[] = $row;
                        }
                        else
                        {
                            $getlist = array();
                        }
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
    
    public function tradeplanmailtoapprvr($planid)
    {
        $getdetailsmail = $this->tradingplancommon->getdetailtradeplan($planid);
        $maildetailarray = array(
                            'requester_name'=>$getdetailsmail['maildata'][0]['fullname'],
                            'comp_name'=>$getdetailsmail['maildata'][0]['companyname'],
                            'fromdate'=>$getdetailsmail['maildata'][0]['fromdate'],
                            'todate'=>$getdetailsmail['maildata'][0]['todate']
                            );
            for($i = 0;$i<sizeof($getdetailsmail['emailid']);$i++)
            {
                $result = $this->emailer->sendmailtrdepln($maildetailarray,$getdetailsmail['emailid'][$i]);
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
    
    public function getdetailtradeplan($planid)
    {
        $connection = $this->dbtrd;
        try
        {

                 $queryget = "SELECT treq.*,cmp.companyname,memb.`fullname`
                                FROM `tradingplan_request` treq 
                                LEFT JOIN `companylist` cmp ON cmp.id = treq.companyid 
                                LEFT JOIN `it_memberlist` memb ON memb.`wr_id` = treq.`user_id` 
                                WHERE treq.`id` = '".$planid."'"; 
                //echo $queryget;exit;
                $exeget = $connection->query($queryget);
                $getnum = trim($exeget->numRows());

                if($getnum>0)
                {
                    while($row = $exeget->fetch())
                    {
                        $approverid = explode(",",$row['approverid']);
                        $getmaildata[] = $row;
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
                    $getlist = array('maildata'=>$getmaildata,'emailid'=>$getapproveremail);

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
    
    public function getadminmailid($approverid)
    {
        $connection = $this->dbtrd;
        $connectionz = $this->db;
        try
        {
                $queryget = "SELECT `user_id` FROM `it_memberlist` WHERE `wr_id` = '".$approverid."'"; 
                //echo $queryget;exit;
                $exeget = $connection->query($queryget);
                $getnum = trim($exeget->numRows());

                if($getnum>0)
                {
                    while($row = $exeget->fetch())
                    {
                        $querygetemail = "SELECT `email` FROM `web_register_user` WHERE `user_id` = '".$row['user_id']."'";
                        $exegetemail = $connectionz->query($querygetemail);
                        $getnumemail = trim($exegetemail->numRows());
                        if($getnumemail>0)
                        {
                            while($row = $exegetemail->fetch())
                            {
                                $getlist = $row['email'];
                            }
                            
                        }
                    }

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
    
    public function tradeplanmailtoreqstr($planid)
    {
        $getreqsrtmail = $this->tradingplancommon->getreqstrtradeplan($planid);
        $mailreqsrtarray = array(
                            'comp_name'=>$getreqsrtmail[0]['companyname'],
                            'fromdate'=>$getreqsrtmail[0]['fromdate'],
                            'todate'=>$getreqsrtmail[0]['todate'],
                            'email'=>$getreqsrtmail[0]['email']
                            );
        $result = $this->emailer->sendtorqstrofack($mailreqsrtarray);
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
    
    public function getreqstrtradeplan($planid)
    {
        $connection = $this->dbtrd;
        try
        {

                 $queryget = "SELECT treq.*,cmp.companyname,memb.`fullname`,memb.`email`
                                FROM `tradingplan_request` treq 
                                LEFT JOIN `companylist` cmp ON cmp.id = treq.companyid 
                                LEFT JOIN `it_memberlist` memb ON memb.`wr_id` = treq.`user_id` 
                                WHERE treq.`id` = '".$planid."'"; 
                //echo $queryget;exit;
                $exeget = $connection->query($queryget);
                $getnum = trim($exeget->numRows());

                if($getnum>0)
                {
                    while($row = $exeget->fetch())
                    {
                        $getlist[] = $row;
                    }

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
}





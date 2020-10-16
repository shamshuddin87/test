<?php
use Phalcon\Mvc\User\Component;
class Miscommon extends Component
{
    
    //############### fetching holding summary start ###############
    public function fetchholdingsummary($getuserid,$user_group_id,$userid)
    {
        $connection = $this->dbtrd;
        try
        {
            $query = "SELECT hs.*, lc.company_name  FROM `opening_balance` hs
                      INNER JOIN `listedcmpmodule` lc ON hs.id_of_company = lc.id
                      WHERE hs.user_id ='".$userid."' GROUP BY hs.id_of_company ";
            //echo $query;exit;
            
            $exegetquery = $connection->query($query);
            $getnumquery = trim($exegetquery->numRows());
            if($getnumquery>0)
            {
                while($rows = $exegetquery->fetch())
                {
                    $getlist[] = $rows;
                }
            }
            else
            {
                $getlist = array();
            }
            
            if(!empty($getlist))
            {   $companyid = implode(',', array_column($getlist,'id_of_company'));   }
            else
            {   $companyid = '';    } 
        
            $finaldata = array('data'=>$getlist,'companyid'=>$companyid);
            
        }
        catch (Exception $e)
        {
            $finaldata = array();
            //$connection->close();
        }
        //print_r($finaldata);exit;
        return $finaldata;
    }


    public function fetchequity($userid,$compid)
     {
        $connection = $this->dbtrd;
        $compid = explode(',',$compid);
        $getlist = '';
//        for($i=0;$i<sizeof($compid);$i++)
//        {
//            $queryget = "SELECT ts.*,pr.type_of_transaction FROM `trading_status` ts
//                        LEFT JOIN `personal_request` pr ON pr.`id` = ts.`req_id`
//                        WHERE ts.`user_id` = '".$userid."' AND ts.`id_of_company` = '".$compid[$i]."' AND ts.trading_status='1' AND ts.sectype='1' AND pr.`relative_id` = ''";
//            //echo $queryget;exit;
//            try
//            { 
//               $exeget = $connection->query($queryget);
//                $getnum = trim($exeget->numRows());
//                   $buyequity = 0;$sellequity = 0;
//                    
//                if($getnum>0)
//                {
//                    while($row = $exeget->fetch())
//                    {
//                          if( $row['type_of_transaction']=='1' || $row['type_of_transaction']=='3' || $row['type_of_transaction']=='4' )
//                            {
//                               $buyequity =  $buyequity + $row['no_of_share'];
//                            }
//                            else if($row['type_of_transaction']=='2')
//                            {
//                                $sellequity =  $sellequity + $row['no_of_share'];
//                            }
//                            else{ }
//                            $row2 = array('buyequity'=>$buyequity,'sellequity'=>$sellequity);
//                            $finalrw = array_merge($row,$row2);
//                   }
//                     $getlistt[] = array_push($getlist, $finalrw);
//                   
//               }
//                
//               else
//               {
//                    $finalrw = array();
//                   array_push($getlist, $finalrw);
//               }
//            }
//            catch (Exception $e)
//            {
//                $getlist = array();
//            }
//              
//        }
        //print_r($getlist);exit;
        $queryget = "SELECT * FROM `personal_info` 
                        WHERE `userid` = '".$userid."'";
        $exeget = $connection->query($queryget);
        $getnum = trim($exeget->numRows());
        if($getnum>0)
        {
            $row = $exeget->fetch();
            $getlist = $row['sharehldng'];
        }
        else
        {
            $getlist = 0;
        }
        return $getlist; 
    }
    
     public function fetchprefereence($userid,$compid)
     {
        $connection = $this->dbtrd;
        $compid = explode(',',$compid);
         $getlist = '';
//        for($i=0;$i<sizeof($compid);$i++)
//        {
//            $queryget = "SELECT ts.*,pr.type_of_transaction FROM `trading_status` ts
//                        LEFT JOIN `personal_request` pr ON pr.`id` = ts.`req_id`
//                        WHERE ts.`user_id` = '".$userid."' AND ts.`id_of_company` = '".$compid[$i]."' AND ts.trading_status='1' AND ts.sectype='2' AND pr.`relative_id` = ''";
//            //echo $queryget;exit;
//            try
//            { 
//               $exeget = $connection->query($queryget);
//                $getnum = trim($exeget->numRows());
//                   $buyprefer = 0;$sellprefer = 0;
//                    
//                if($getnum>0)
//                {
//                 
//                    while($row = $exeget->fetch())
//                    {
//
//                        if( $row['type_of_transaction']=='1' || $row['type_of_transaction']=='3' || $row['type_of_transaction']=='4' )
//                        {
//                           $buyprefer =  $buyprefer + $row['no_of_share'];
//                        }
//                        else if($row['type_of_transaction']=='2')
//                        {
//                            $sellprefer =  $sellprefer + $row['no_of_share'];
//                        }
//                        else{ }
//                        $row2 = array('buyprefer'=>$buyprefer,'sellprefer'=>$sellprefer);
//                        $finalrw = array_merge($row,$row2);
//                         
//                    }
//                     $getlistt[] = array_push($getlist, $finalrw);
//                   
//               }
//                
//               else
//               {
//                    $finalrw = array();
//                   array_push($getlist, $finalrw);
//               }
//            }
//            catch (Exception $e)
//            {
//                $getlist = array();
//            }
//              
//        }
         $queryget = "SELECT * FROM `personal_info` 
                        WHERE `userid` = '".$userid."'";
        $exeget = $connection->query($queryget);
        $getnum = trim($exeget->numRows());
        if($getnum>0)
        {
            $row = $exeget->fetch();
            $getlist = $row['adrshldng'];
        }
        else
        {
            $getlist = 0;
        }
        return $getlist; 
    }
    
     public function fetchdebenure($userid,$compid)
     {
        $connection = $this->dbtrd;
        $compid = explode(',',$compid);
        $getlist = array();
        for($i=0;$i<sizeof($compid);$i++)
        {
            $queryget = "SELECT ts.*,pr.`type_of_transaction` FROM `trading_status` ts
                        LEFT JOIN `personal_request` pr ON pr.`id` = ts.`req_id` 
                        WHERE ts.`user_id` = '".$userid."' AND ts.`id_of_company` = '".$compid[$i]."' AND ts.trading_status='1' AND ts.sectype='3' AND pr.`relative_id` = ''";
            //echo $queryget;
            
            try
            { 
               $exeget = $connection->query($queryget);
                $getnum = trim($exeget->numRows());
                   $buydebtr = 0;$selldebtr = 0;
                    
                if($getnum>0)
                {
                 
                    while($row = $exeget->fetch())
                    {
                            if( $row['type_of_transaction']=='1' || $row['type_of_transaction']=='3' || $row['type_of_transaction']=='4' )
                            {
                               $buydebtr =  $buydebtr + $row['no_of_share'];
                            }
                            else if($row['type_of_transaction']=='2')
                            {
                                $selldebtr =  $selldebtr + $row['no_of_share'];
                            }
                            else{ }
                            $row2 = array('buydebtr'=>$buydebtr,'selldebtr'=>$selldebtr);
                            $finalrw = array_merge($row,$row2);
                         
                    }
                    $getlistt[] = array_push($getlist, $finalrw);
                    
               }
                
               else
               {
                    $finalrw = array();
                   array_push($getlist, $finalrw);
               }
            }
            catch (Exception $e)
            {
                $getlist = array();
            }
              
        }
        //print_r($getlist);exit;
        return $getlist; 
    }
    //############### fetching holding summary end ###############
    
   public function fetchsubuser($getuserid,$user_group_id,$ext)
   {
        $connection = $this->dbtrd;
        $getlist=array();
        if($user_group_id==2)
        {
        	$query="SELECT * FROM it_memberlist WHERE user_id='".$getuserid."' ".$ext;
        }
        else
        {
        	$query="SELECT * FROM it_memberlist WHERE (FIND_IN_SET('".$getuserid."',`approvid`) OR `wr_id`= '".$getuserid."') ".$ext;
        }
        //print_r($query); exit;
       
            try
            {
                $exeget = $connection->query($query);
                $getnum = trim($exeget->numRows());

                if($getnum>0)
                {                 
                    while($row = $exeget->fetch())
                    {
                        $getlist[]=$row;
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
            //echo '<pre>';print_r($getlist);exit;
            return $getlist;
      } 

      public function useriformation($userid)
      {
        $connection = $this->dbtrd;
        $myarr=array();
        $time = time();

        $query="SELECT * FROM personal_info WHERE userid='".$userid."'";

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

       public function getrelativedata($userid,$user_group_id){
       $connection = $this->dbtrd;
       $time = time();
       try{
            $query="SELECT *,relationship.`relationshipname` FROM `relative_info` INNER JOIN relationship ON relationship.`id`=relative_info.`relationship` WHERE user_id='".$userid."'";
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

   public function getaccnoinfo($uid)
  {
       $connection = $this->dbtrd;
        $myarr=array();
        $time = time();

        $query="SELECT obj1.`*` ,obj2.`fullname` as usname FROM user_demat_accounts obj1
         LEFT JOIN it_memberlist obj2 ON  obj1.`user_id`=obj2.`wr_id` WHERE obj1.`user_id`='".$uid."'";
       

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


     public function getrelinfo($uid)
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

    public function getholingmis($getuserid,$user_group_id,$mainquery)
 {
       $connection = $this->dbtrd;
        $myarr=array();
        $time = time();

        $query="SELECT `ts`.no_of_share,`cmpdl`.company_name,`ts`.demat_acc_no,`ts`.date_of_transaction,`sec`.security_type,`obj`.transaction FROM trading_status ts 
                LEFT JOIN listedcmpmodule cmpdl ON `cmpdl`.id = `ts`.id_of_company
                INNER JOIN personal_request pr ON   ( `pr`.`user_id`=`ts`.user_id AND `pr`.id=`ts`.req_id)
                LEFT JOIN type_of_transaction obj ON `obj`.id=`pr`.type_of_transaction
                JOIN `req_securitytype` sec ON `sec`.id = `pr`.sectype
                WHERE `ts`.user_id = '".$getuserid."' AND (`pr`.trading_status='1' AND  `ts`.type_of_request='1') AND (`ts`.excepapp_status IS NULL OR `ts`.excepapp_status='1')".$mainquery;
       
        // print_r($query);exit;

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


       public function getrelativegmis($getuserid,$user_group_id,$mainquery)
 {
       $connection = $this->dbtrd;
        $myarr=array();
        $time = time();

        $query="SELECT `ts`.no_of_share,`cmpdl`.company_name,`rlin`.name as relname,`rlin`.relationship,`ts`.demat_acc_no,`ts`.date_of_transaction,`sec`.security_type,`obj`.transaction FROM trading_status ts 
                LEFT JOIN listedcmpmodule cmpdl ON `cmpdl`.id = `ts`.id_of_company
                INNER JOIN personal_request pr ON   ( `pr`.`user_id`=`ts`.user_id AND `pr`.id=`ts`.req_id)
                LEFT JOIN type_of_transaction obj ON `obj`.id=`pr`.type_of_transaction
                LEFT JOIN relative_info rlin ON `rlin`.id = `pr`.relative_id
                JOIN `req_securitytype` sec ON `sec`.id = `pr`.sectype
                WHERE `ts`.user_id = '".$getuserid."' AND (`pr`.trading_status='1' AND  `ts`.type_of_request='2') AND (`ts`.excepapp_status IS NULL OR `ts`.excepapp_status='1')".$mainquery;
       
        // print_r($query);exit;

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
    
    // **************************** recipient mis fetch for table***************************
    public function fetchrecipient($getuserid,$user_group_id,$empstatusfilter)
    {
       $connection = $this->dbtrd;
        
        try
         {
            $grpusrs = $this->insidercommon->getGroupUsers($getuserid,$user_group_id);
            $queryget = "SELECT sr.* ,memb.fullname,memb.emp_status,sc.`category` as categoryname FROM `sensitiveinfo_recipient` sr 
                        LEFT JOIN `it_memberlist` memb ON memb.wr_id = sr.user_id
                        LEFT JOIN `sensitiveinfo_category` sc ON sr.category = sc.id 
                        WHERE sr.`user_id` IN (".$grpusrs['ulstring'].")".$empstatusfilter; 
          
             
            
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
    
    // **************************** recipient mis fetch for edit ***************************
    
    // **************************** infosharing mis fetch for table***************************
    public function fetchinfosharing($getuserid,$user_group_id,$upsitypeid,$query)
    {
       $connection = $this->dbtrd;
        try
         {
            //print_r($masteruserdata);exit;
            $grpusrs = $this->insidercommon->getGroupUsers($getuserid,$user_group_id);
            
             $queryget = "SELECT ss.*,sr.`nameofentity`,sr.`identityno`,utype.`upsitype`,
                    memb.`fullname`,sc.`category` AS category_name,sr.`othercategory`,pr.`pan`,pr.`legal_identifier`,pr.`legal_identification_no`,pr.`aadhar`, pr.`age`, pr.`dob`,pr.`sex`,pr.`address`,pr.`education`,pr.`institute`,
                    pr.`mobileno`,pr.`sharehldng`,pr.`adrshldng`,pr.`occupation`,pr.`company`,mem.`email`
                    FROM `sensitiveinfo_sharing` ss 
                    LEFT JOIN `sensitiveinfo_recipient` sr ON ss.`recipientid` = sr.`id` 
                    LEFT JOIN `it_memberlist` memb ON memb.`wr_id` = ss.`user_id` 
                    LEFT JOIN `upsimaster` utype ON utype.`id` = ss.`upsitype` 
                    LEFT JOIN `sensitiveinfo_category` sc ON sc.`id` = sr.`category`
                     LEFT JOIN `personal_info` pr ON pr.`userid` = ss.`wr_id`
                     LEFT JOIN `it_memberlist` mem ON mem.`wr_id` = ss.`wr_id` 
				    WHERE ss.`user_id` IN (".$grpusrs['ulstring'].") AND ss.`upsitype`= '".$upsitypeid."' ORDER BY ss.`id` DESC ".$query; 

          
            
           //echo $queryget;  exit;
            //,sr.`othercategory`
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
    
    // **************************** infosharing mis fetch for table ***************************
     public function  getmfrdataformis($uid)
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
    
    // **************************** infosharing fetch for Archive table***************************
    public function fetcharchiveinfosharing($getuserid,$user_group_id,$upsitypeid,$query)
    {
       $connection = $this->dbtrd;
        try
         {
            $grpusrs = $this->insidercommon->getGroupUsers($getuserid,$user_group_id);
            $queryget = "SELECT ss.*, memb.fullname,sc.`category` AS category_name,sr.`othercategory` 
                        FROM `sensitiveinfo_sharing` ss
                        LEFT JOIN `it_memberlist` memb ON memb.wr_id = ss.user_id
                        LEFT JOIN `sensitiveinfo_category` sc ON sc.`id` = ss.`category`
                        LEFT JOIN `sensitiveinfo_recipient` sr ON ss.`recipientid` = sr.`id` 
                        WHERE ss.`user_id` IN (".$grpusrs['ulstring'].") AND ss.`upsitype`= '".$upsitypeid."' AND ss.`enddate` !=''  ".$query; 
          
            
            //echo $queryget;  exit;
            //,sr.`othercategory`
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


      public function fetchmischngedesprsn($getuserid,$user_group_id,$query)
    {
        $connection = $this->dbtrd;
        try
         {
            $masteruserdata = $this->insidercommon->getMasterUser($getuserid,$user_group_id);
            $queryget = "SELECT * FROM `it_memberlist` WHERE user_id = '".$masteruserdata['user_id']."'".$query; 
         
             // echo $queryget;  exit;
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

       public function fetchmiscontratrd($getuserid,$user_group_id,$query)
    {
        $connection = $this->dbtrd;
        try
         {
            $grpusrs = $this->insidercommon->getGroupUsers($getuserid,$user_group_id);
            $queryget = "SELECT memb.`fullname`,memb.`emp_status`,lst.`company_name`,trans.`transaction`,ts.`date_of_transaction`,pr.`date_added`,ts.`no_of_share`,pr.`trading_date`  
            FROM `trading_status` ts
            LEFT JOIN `it_memberlist` memb ON memb.`wr_id`= ts.`user_id`
            INNER JOIN `personal_request` pr ON pr.`id` = ts.`req_id`
            LEFT JOIN `type_of_transaction` trans ON trans.`id` = pr.`type_of_transaction`
            LEFT JOIN `trading_days` trddays ON trddays.`user_id` = memb.`user_id`
            LEFT JOIN `listedcmpmodule` lst ON lst.`id`=pr.`id_of_company`
            WHERE ts.`user_id` IN (".$grpusrs['ulstring'].") AND ts.`trading_status`=1 AND (ts.`excep_approv`=1 OR pr.`sent_contraexeaprvl`=1) ".$query; 
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



     public function fetchmisnonexetrde($getuserid,$user_group_id,$query)
    {
        $connection = $this->dbtrd;
        try
         {
            $grpusrs = $this->insidercommon->getGroupUsers($getuserid,$user_group_id);
            $queryget = "SELECT pr.`no_of_shares`,lst.`company_name`,ts.`date_added`,pr.`approved_date`,ts.`trading_status`,memb.`fullname`,memb.`emp_status` 
            FROM `trading_status` ts
            LEFT JOIN `personal_request` pr ON pr.`id` = ts.`req_id`
            LEFT JOIN `listedcmpmodule` lst ON lst.`id`=pr.`id_of_company`
            LEFT JOIN `it_memberlist` memb ON memb.`wr_id` = ts.`user_id`
            WHERE (STR_TO_DATE(ts.`date_of_transaction`,'%d-%m-%Y')> STR_TO_DATE(pr.`trading_date`,'%d-%m-%Y') OR ts.trading_status = '0')  AND ts.user_id IN (".$grpusrs['ulstring'].")  ".$query; 
            // echo $queryget;  exit;
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


      public function misconfirmtrde($getuserid,$user_group_id,$mainquery)
    {
        $connection = $this->dbtrd;
        
        $grpusrs = $this->insidercommon->getGroupUsers($getuserid,$user_group_id);
        $query="SELECT `ts`.no_of_share AS actualtrade,lst.`company_name`,`ts`.date_of_transaction,pr.`no_of_shares` AS preclrtrade,pr.`approved_date`,pr.`date_added`,pr.`trading_date`,memb.`fullname`,memb.`emp_status`
        FROM trading_status ts  
        INNER JOIN personal_request pr ON ( `pr`.`user_id`=`ts`.user_id AND `pr`.id=`ts`.req_id)
        LEFT JOIN `it_memberlist` memb ON memb.`wr_id` = ts.`user_id`
        LEFT JOIN `listedcmpmodule` lst ON lst.`id`=pr.`id_of_company`
        WHERE `ts`.user_id IN (".$grpusrs['ulstring'].") AND (`pr`.trading_status='1' AND  `ts`.type_of_request='1') AND (`ts`.excepapp_status IS NULL OR `ts`.excepapp_status='1')".$mainquery;

        // print_r($query);exit;
        try
        {
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


        // ************ Get MIS Form C START ************
    public function fetchmisformc($getuserid,$user_group_id,$finstrtdte,$finenddte,$query,$filter)
    {
      //print_r($filter);die;
        $connection = $this->dbtrd;
        $getlist = array();
       try
        {
            $grpusrs = $this->insidercommon->getGroupUsers($getuserid,$user_group_id);
   
            $queryget = 'SELECT memb.`fullname`,memb.`emp_status`,lst.`company_name`,ts.`date_of_transaction`,ts.`no_of_share`,formc.`send_date`,ts.`total_amount` 
              FROM `trading_status` ts
              LEFT JOIN `it_memberlist` memb ON memb.`wr_id` = ts.`user_id` 
              LEFT JOIN `sebiformc_usrdata` formc ON ts.`id` = formc.`tradeid` 
              LEFT JOIN `personal_request` pr ON pr.`id` = ts.`req_id`
              LEFT JOIN `listedcmpmodule` lst ON lst.`id`=pr.`id_of_company`
              WHERE ts.`user_id` IN ('.$grpusrs['ulstring'].') AND ts.`id_of_company` IS NOT NULL AND ts.`total_amount` > 1000000 AND ts.`date_of_transaction` BETWEEN "'.$finstrtdte.'" AND "'.$finenddte.'" '.$query; 
                
                //print_r($queryget);die;
                $exeget = $connection->query($queryget);
                $getnum = trim($exeget->numRows());

                  // print_r($getnum);

                if($getnum>0)
                {
                    while($row = $exeget->fetch())
                    {
                        $data[] = $row;
                    }
                     
                     $getlist = $data;
                }
              //echo '<pre>';print_r($getlist);die;


      }
        catch (Exception $e)
        {
            $getlist = array();
            //$connection->close();
       }
        // print_r($getlist);exit;
         return $getlist;
    }
    // ************ Get MIS Form C END ************


       public function fetchmisformpctdata($getuserid,$user_group_id,$query)
    {
        $connection = $this->dbtrd;
        try
         {
            $grpusrs = $this->insidercommon->getGroupUsers($getuserid,$user_group_id);
            $queryget = "SELECT cmpdl.`company_name`,pr.`approved_date`,pr.`date_added`,pr.`no_of_shares`,trans.`transaction`,pr.`sendaprvl_date`,memb.`fullname`,pr.`approved_date`
            FROM `personal_request` pr 
            LEFT JOIN `it_memberlist` memb ON memb.`wr_id` = pr.`user_id` 
             LEFT JOIN listedcmpmodule cmpdl ON `cmpdl`.id = `pr`.id_of_company
            LEFT JOIN `type_of_transaction` trans ON trans.`id` = pr.`type_of_transaction` 
            WHERE(pr.`send_status`=1) ".$query; 
            // echo $queryget;  exit;
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
        //echo '<pre>';print_r($getlist);exit;
        return $getlist;
    }



    public function getallcompanyid($user_id)
    {
       $connection = $this->dbtrd;
        try
         {
            
            $queryget = "SELECT id_of_company FROM trading_status WHERE user_id='".$user_id."'"; 
              // echo $queryget;  
            $exeget = $connection->query($queryget);
            $getnum = trim($exeget->numRows());

            if($getnum>0)
            {
                while($row = $exeget->fetch())
                {
                  // print_r($row);
                    $getlist[] = $row['id_of_company'];
                }

                // $getlist=implode(',',$getlist);
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
       // echo '<pre>';print_r($getlist);exit;
        return $getlist; 
    }


        public function fetchhldsingle($getuserid,$user_group_id)
    {
        $connection = $this->dbtrd;
        try
        {
            $query = "SELECT hs.*, lc.company_name  FROM `opening_balance` hs
                      INNER JOIN `listedcmpmodule` lc ON hs.id_of_company = lc.id
                      WHERE hs.user_id ='".$getuserid."' GROUP BY hs.id_of_company ";
            //echo $query;exit;
            
            $exegetquery = $connection->query($query);
            $getnumquery = trim($exegetquery->numRows());
            if($getnumquery>0)
            {
                while($rows = $exegetquery->fetch())
                {
                    $getlist[] = $rows;
                }
            }
            else
            {
                $getlist = array();
            }
            
            if(!empty($getlist))
            {   $companyid = implode(',', array_column($getlist,'id_of_company'));   }
            else
            {   $companyid = '';    } 
        
            $finaldata = array('data'=>$getlist,'companyid'=>$companyid);
            
        }
        catch (Exception $e)
        {
            $finaldata = array();
            //$connection->close();
        }
        //print_r($finaldata);exit;
        return $finaldata;
    }
    
      public function fetchmisinitialdisclsr($getuserid,$user_group_id,$query)
    {
        $connection = $this->dbtrd;
        $getlist = array();
        try
         {
            $grpusrs = $this->insidercommon->getGroupUsers($getuserid,$user_group_id);
            $queryget = "SELECT * FROM `it_memberlist` WHERE `status`='1' AND wr_id IN (".$grpusrs['ulstring'].")";
            $exeget = $connection->query($queryget);
            $getnum = trim($exeget->numRows());

            if($getnum>0)
            {
                while($row = $exeget->fetch())
                {
                    $queryanual = "SELECT memb.`fullname`,memb.`emp_status`,initial.sent_date,initial.pdfpath,initial.send_status,memb.dpdate
                    FROM `it_memberlist` memb
                    LEFT JOIN `initial_declaration` initial ON memb.`wr_id`=initial.`user_id`
                    WHERE memb.wr_id = '".$row['wr_id']."' ".$query;
                    ;
                    //echo $queryanual;exit;
                    $exeanual = $connection->query($queryanual);
                    $getnumanual = trim($exeanual->numRows());
                    if($getnumanual>0)
                    {
                        while($rowanual = $exeanual->fetch())
                        {
                            $getlist[]=$rowanual;
                        }
                    }
                }
                //echo '<pre>';print_r($getlist);exit;
                
            }
        }
        catch (Exception $e)
        {
            $getlist = array();
            //$connection->close();
        }
        
        return $getlist;
    }


     public function fetchallinitialdisclsr($getuserid,$user_group_id,$query)
    {
        $connection = $this->dbtrd;
        $getlist = array();
        try
         {
            $grpusrs = $this->insidercommon->getGroupUsers($getuserid,$user_group_id);
            $queryget = "SELECT memb.`fullname`,memb.`emp_status`,initial.sent_date,initial.pdfpath,memb.dpdate 
            FROM `it_memberlist` memb 
            LEFT JOIN `initial_declaration` initial ON memb.`wr_id` = initial.user_id 
            WHERE memb.wr_id IN (".$grpusrs['ulstring'].")  AND (initial.`send_status`=1 OR initial.`send_status` IS NULL)".$query;
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

    public function fetchinitlpendig($getuserid,$user_group_id,$query)
    {
        $connection = $this->dbtrd;
        $getlist = array();
        $userid = array();
        try
         {
            $grpusrs = $this->insidercommon->getGroupUsers($getuserid,$user_group_id);
            $queryget = "SELECT memb.*
                    FROM `it_memberlist` memb
                    LEFT JOIN `initial_declaration` initial ON memb.`wr_id`=initial.`user_id`
                    WHERE memb.wr_id IN (".$grpusrs['ulstring'].")  AND initial.send_status= 1";
            $exeget = $connection->query($queryget);
            $getnum = trim($exeget->numRows());

            if($getnum>0)
            {
                while($row = $exeget->fetch())
                {
                    $userid[] = $row['wr_id'];
                }
            }
            $grpusers = explode(',',$grpusrs['ulstring']);
            if(!empty($userid))
            {
                $pendusrs = array_diff($grpusers, $userid);
                $pendingusers = implode(',',$pendusrs);
            }
            else
            {
                $pendingusers = $grpusrs['ulstring'];
            }
            
            $queryanual = "SELECT memb.`fullname`,memb.`emp_status`,initial.sent_date,initial.pdfpath,initial.send_status,memb.dpdate
            FROM `it_memberlist` memb
            LEFT JOIN `initial_declaration` initial ON memb.`wr_id`=initial.`user_id`
            WHERE memb.wr_id IN(".$pendingusers.")".$query;
            ;
            //echo $queryanual;exit;
            $exeanual = $connection->query($queryanual);
            $getnumanual = trim($exeanual->numRows());
            if($getnumanual>0)
            {
                while($rowanual = $exeanual->fetch())
                {
                    $getlist[]=$rowanual;
                }
            }
            else
            {
                $getlist = array();
            }
                //print_r($getlist);exit;
            
        }
        catch (Exception $e)
        {
            $getlist = array();
            //$connection->close();
        }
        
        return $getlist;
    }

    public function fetchpendigannualdisclsr($getuserid,$user_group_id,$annualyr,$query)
    {
        $connection = $this->dbtrd;
        $getlist = array();
        $userid = array();
        try
         {
            $grpusrs = $this->insidercommon->getGroupUsers($getuserid,$user_group_id);
            $queryget = "SELECT memb.*
                    FROM `it_memberlist` memb
                    LEFT JOIN `annual_initial_declaration` anualdecl ON memb.`wr_id`=anualdecl.`user_id`
                    WHERE memb.wr_id IN (".$grpusrs['ulstring'].") AND (anualdecl.annualyear='".$annualyr."') AND anualdecl.send_status= 1";
                    //echo $queryget;exit;
            $exeget = $connection->query($queryget);
            $getnum = trim($exeget->numRows());

            if($getnum>0)
            {
                while($row = $exeget->fetch())
                {
                    $userid[] = $row['wr_id'];
                }
            }
            $grpusers = explode(',',$grpusrs['ulstring']);
            if(!empty($userid))
            {
                $pendusrs = array_diff($grpusers, $userid);
                $pendingusers = implode(',',$pendusrs);
            }
            else
            {
                $pendingusers = $grpusrs['ulstring'];
            }
            
            $queryanual = "SELECT anualdecl.annualyear,memb.`fullname`,memb.`email`,memb.`emp_status`,anualdecl.sent_date,anualdecl.pdfpath,anualdecl.send_status
            FROM `it_memberlist` memb
            LEFT JOIN `annual_initial_declaration` anualdecl ON memb.`wr_id`=anualdecl.`user_id`
            WHERE memb.wr_id IN(".$pendingusers.")".$query;
            ;
            //echo $queryanual;exit;
            $exeanual = $connection->query($queryanual);
            $getnumanual = trim($exeanual->numRows());
            if($getnumanual>0)
            {
                while($rowanual = $exeanual->fetch())
                {
                    $getlist[]=$rowanual;
                }
            }
            else
            {
                $getlist = array();
            }
            //print_r($getlist);exit;
            
        }
        catch (Exception $e)
        {
            $getlist = array();
            //$connection->close();
        }
        
        return $getlist;
    }

    public function fetchallannualdisclsr($getuserid,$user_group_id,$annualyr,$query)
    {
        $connection = $this->dbtrd;
        $getlist = array();
        try
         {
            $grpusrs = $this->insidercommon->getGroupUsers($getuserid,$user_group_id);
            $queryget = "SELECT anualdecl.`annualyear`,memb.`fullname`,memb.`email`,memb.`emp_status`,anualdecl.`sent_date`,anualdecl.`pdfpath` 
            FROM `it_memberlist` memb 
            LEFT JOIN `annual_initial_declaration` anualdecl ON memb.`wr_id` = anualdecl.`user_id` 
            WHERE memb.`wr_id` IN (".$grpusrs['ulstring'].")  AND (anualdecl.annualyear='".$annualyr."' OR anualdecl.annualyear IS NULL OR anualdecl.`send_status`=1)".$query;
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


    public function fetchmisannualdisclsr($getuserid,$user_group_id,$annualyr,$query)
    {
        $connection = $this->dbtrd;
        $getlist = array();
        try
         {
            $grpusrs = $this->insidercommon->getGroupUsers($getuserid,$user_group_id);
            $queryget = "SELECT * FROM `it_memberlist` WHERE `status`='1' AND wr_id IN (".$grpusrs['ulstring'].")";
            $exeget = $connection->query($queryget);
            $getnum = trim($exeget->numRows());

            if($getnum>0)
            {
                while($row = $exeget->fetch())
                {
                    $queryanual = "SELECT anualdecl.annualyear,memb.`fullname`,memb.`email`,memb.`emp_status`,anualdecl.sent_date,anualdecl.pdfpath,anualdecl.send_status
                    FROM `it_memberlist` memb
                    LEFT JOIN `annual_initial_declaration` anualdecl ON memb.`wr_id`=anualdecl.`user_id`
                    WHERE memb.wr_id = '".$row['wr_id']."'".$query;
                    ;
                    // echo $queryanual;
                    $exeanual = $connection->query($queryanual);
                    $getnumanual = trim($exeanual->numRows());
                    if($getnumanual>0)
                    {
                        while($rowanual = $exeanual->fetch())
                        {
                            if($rowanual['annualyear']==$annualyr)
                            {
                                $getlist[]=$rowanual;
                            }
                            else
                            {
                                $rowanual['annualyear']='';
                                $rowanual['pdfpath']='';
                                $rowanual['sent_date']='';
                                $getlist[]=$rowanual;
                            }
                        }
                    }
                }
                //echo '<pre>';print_r($getlist);exit;
                
            }
        }
        catch (Exception $e)
        {
            $getlist = array();
            //$connection->close();
        }
        
        return $getlist;
    }
    
    public function fetchallupsitypes($userid,$user_group_id,$rslmt)
    {
       $connection = $this->dbtrd;
       $time = time();
       $getmasterid = $this->tradingrequestcommon->getmasterid($userid);
       //print_r($userid);exit;
       try{
            if($user_group_id == 2 || $user_group_id == 14)
            {
                   $query="SELECT *,ups.`date_added` AS dtadd,ups.`id` AS uppid FROM `upsimaster` ups  LEFT JOIN  `it_memberlist` it ON ups.`user_id`=it.`wr_id`  
                      LEFT JOIN  `personal_info` pr  ON ups.`user_id`=pr.`userid` ".$rslmt;
            }
            else
            {
               $query="SELECT *,ups.`date_added` AS dtadd,ups.`id` AS uppid FROM `upsimaster` ups  LEFT JOIN  `it_memberlist` it ON ups.`user_id`=it.`wr_id`  
                 LEFT JOIN  `personal_info` pr  ON ups.`user_id`=pr.`userid` WHERE  ups.`projectowner` IN(".$userid.") ".$rslmt;
                  //print_r($query);exit;
            }

            //print_r($query);die;
            
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

           // print_r(count($getlist));exit;
        return $getlist;
    }


    
    public function allupsihtml($data)
    {
       $myhtml='';
       for($i=0;$i<sizeof($data);$i++)
       {
          // print_r($data[$i]);exit;
           $j=$i+1;
            $myhtml.="<tr>";
            $myhtml.="<td>".$j."</td>";
            $myhtml.="<td>".$data[$i]['upsitype']."</td>";
            $myhtml.="<td>".$data[$i]['projstartdate']."</td>";
            $myhtml.="<td>".$data[$i]['enddate']."</td>";
            $myhtml.="<td>".$data[$i][11]."</td>";
            $myhtml.="<td>".$data[$i]['fullname']."</td>";

            if($data[$i]['emp_status'] == '1')
            {
              $myhtml.="<td>Active</td>";
            }
            else if($data[$i]['emp_status'] == '2')
            {
              $myhtml.="<td>Resigned</td>";
            }
            else if($data[$i]['emp_status'] == '3')
            {
              $myhtml.="<td>Not a DP</td>";
            }

            $myhtml.="</tr>";
       }

       // print_r($myhtml);exit;

      $html="<!DOCTYPE html>
      <html>
      <head>
        <style>
      </head>
      <body>
         <h5 style='text-align:center;'>Database of UPSI Shared</h5>
         <table>
            <tr>
               <th>Sr No</th>
               <th>Name Of Upsi</th>
               <th>Project Start Date</th>
               <th>Project End Date</th>
               <th>Creation Date</th>
               <th>Shared By</th>
               <th>Status</th>
            </tr>
         ".$myhtml."
         </table>
        </body>
      </html>";
   
       return $html;
    }


    public function allDesgntdPersnHtml($getuserinfo,$relativeinfo,$accountinfo,$relativeaccount,$mfrdata,$getres,$result,$pastemp)
    {
        $myhtml1 = '';$myhtml2 = '';$myhtml3 = '';$myhtml4 = '';$myhtml5 = '';$myhtml6 = '';$myhtml7 = '';$myhtml8 = '';
        //print_r($result);exit;
        if(sizeof($getuserinfo) > 0)
        {
            for($i=0; $i < sizeof($getuserinfo); $i++)
            {
               // print_r($data[$i]);exit;
                $j=$i+1;
                $myhtml1.="<tr>";
                $myhtml1.="<td>".$j."</td>";
                $myhtml1.="<td>".$getuserinfo[$i]['name']."</td>";
                $myhtml1.="<td>".$getuserinfo[$i]['pan']."</td>";
                $myhtml1.="<td>".$getuserinfo[$i]['legal_identifier']."</td>";
                $myhtml1.="<td>".$getuserinfo[$i]['legal_identification_no']."</td>";
                $myhtml1.="<td>".$getuserinfo[$i]['aadhar']."</td>";
                $myhtml1.="<td>".$getuserinfo[$i]['dob']."</td>";
                $myhtml1.="<td>".$getuserinfo[$i]['address']."</td>";
                $myhtml1.="<td>".$getuserinfo[$i]['sex']."</td>";
                $myhtml1.="<td>".$getuserinfo[$i]['education']."</td>";
                $myhtml1.="<td>".$getuserinfo[$i]['institute']."</td>";
                $myhtml1.="<td>".$getuserinfo[$i]['sharehldng']."</td>";
                $myhtml1.="<td>".$getuserinfo[$i]['adrshldng']."</td>";
                $myhtml1.="</tr>";
            }
        }
        else
        {
            $myhtml1.='<tr><td colspan="8" style="text-align: center;">Data Not Found</td>';
        }
       
        if(sizeof($relativeinfo) > 0)
        {
            for($i=0; $i < sizeof($relativeinfo); $i++)
            {
           // print_r($data[$i]);exit;
                $j=$i+1;
                $myhtml2.="<tr>";
                $myhtml2.="<td>".$j."</td>";
                $myhtml2.="<td>".$relativeinfo[$i]['name']."</td>";
                $myhtml2.="<td>".$relativeinfo[$i]['pan']."</td>";
                $myhtml2.="<td>".$relativeinfo[$i]['legal_identifier']."</td>";
                $myhtml2.="<td>".$relativeinfo[$i]['legal_identification_no']."</td>";
                $myhtml2.="<td>".$relativeinfo[$i]['aadhar']."</td>";
                $myhtml2.="<td>".$relativeinfo[$i]['dob']."</td>";
                $myhtml2.="<td>".$relativeinfo[$i]['relationshipname']."</td>";
                $myhtml2.="<td>".$relativeinfo[$i]['address']."</td>";
                $myhtml2.="<td>".$relativeinfo[$i]['sex']."</td>";
                $myhtml2.="<td>".$relativeinfo[$i]['education']."</td>";
                $myhtml2.="<td>".$relativeinfo[$i]['sharehldng']."</td>";
                $myhtml2.="<td>".$relativeinfo[$i]['adrshldng']."</td>";
                $myhtml2.="</tr>";
            }
        }
        else
        {
            $myhtml2.='<tr><td colspan="8" style="text-align: center;">Data Not Found</td>';
        }
        
        if(sizeof($pastemp) > 0)
        {
            for($i=0; $i < sizeof($pastemp); $i++)
            {
                //print_r($pastemp[$i]);exit;
                $j=$i+1;
                $myhtml8.="<tr>";
                $myhtml8.="<td>".$j."</td>";
                $myhtml8.="<td>".$pastemp[$i]['emp_name']."</td>";
                $myhtml8.="<td>".$pastemp[$i]['emp_desigtn']."</td>";
                $myhtml8.="<td>".$pastemp[$i]['startdate']."</td>";
                $myhtml8.="<td>".$pastemp[$i]['enddate']."</td>";
                $myhtml8.="</tr>";
            }
        }
        else
        {
            $myhtml8.='<tr><td colspan="5" style="text-align: center;">Data Not Found</td>';
        }

        if(sizeof($accountinfo) > 0)
        {
            for($i=0; $i < sizeof($accountinfo); $i++)
            {
           // print_r($data[$i]);exit;
                $j=$i+1;
                $myhtml3.="<tr>";
                $myhtml3.="<td>".$j."</td>";
                $myhtml3.="<td>".$accountinfo[$i]['accountno']."</td>";
                $myhtml3.="<td>".$accountinfo[$i]['usname']."</td>";
                $myhtml3.="<td>".$accountinfo[$i]['clearing_house']."</td>";
                $myhtml3.="</tr>";
            }
        }
        else
        {
            $myhtml3.='<tr><td colspan="8" style="text-align: center;">Data Not Found</td>';
        }

        if(sizeof($relativeaccount) > 0)
        {
            for($i=0; $i < sizeof($relativeaccount); $i++)
            {
           // print_r($data[$i]);exit;
                $j=$i+1;
                $myhtml4.="<tr>";
                $myhtml4.="<td>".$j."</td>";
                $myhtml4.="<td>".$relativeaccount[$i]['accountno']."</td>";
                $myhtml4.="<td>".$relativeaccount[$i]['name']."</td>";
                $myhtml4.="<td>".$relativeaccount[$i]['clearing_house']."</td>";
                $myhtml4.="</tr>";
            }
        }
        else
        {
            $myhtml4.='<tr><td colspan="4" style="text-align: center;">Data Not Found</td>';
        }

        if(sizeof($mfrdata) > 0)
        {
            for($i=0; $i < sizeof($mfrdata); $i++)
            {
           // print_r($data[$i]);exit;
                $j=$i+1;
                $myhtml5.="<tr>";
                $myhtml5.="<td>".$j."</td>";
                $myhtml5.="<td>".$mfrdata[$i]['related_party']."</td>";
                $myhtml5.="<td>".$mfrdata[$i]['pan']."</td>";
                $myhtml5.="<td>".$mfrdata[$i]['relationship']."</td>";
                $myhtml5.="<td>".$mfrdata[$i]['address']."</td>";
                $myhtml5.="</tr>";
            }
        }
        else
        {
            $myhtml5.='<tr><td colspan="8" style="text-align: center;">Data Not Found</td>';
        }

        if(sizeof($result) > 0)
        {
            for($i=0; $i < sizeof($result); $i++)
            {
           // print_r($data[$i]);exit;
                $j=$i+1;
                $myhtml6.="<tr>";
                $myhtml6.="<td>".$j."</td>";
                $myhtml6.="<td>".$result[$i]['company_name']."</td>";
                $myhtml6.="<td>".$result[$i]['security_type']."</td>";
                $myhtml6.="<td>".$result[$i]['no_of_share']."</td>";
                $myhtml6.="<td>".$result[$i]['date_of_transaction']."</td>";
                $myhtml6.="<td>".$result[$i]['transaction']."</td>";
                $myhtml6.="<td>".$result[$i]['demat_acc_no']."</td>";
                $myhtml6.="</tr>";
            }
        }
        else
        {
            $myhtml6.='<tr><td colspan="8" style="text-align: center;">Data Not Found</td>';
        }

        if(sizeof($getres) > 0)
        {
            for($i=0; $i < sizeof($getres); $i++)
            {
                // print_r($data[$i]);exit;
                $j=$i+1;
                $myhtml7.="<tr>";
                $myhtml7.="<td>".$j."</td>";
                $myhtml7.="<td>".$getres[$i]['relname']."</td>";
                $myhtml7.="<td>".$getres[$i]['relationship']."</td>";
                $myhtml7.="<td>".$getres[$i]['company_name']."</td>";
                $myhtml7.="<td>".$getres[$i]['security_type']."</td>";
                $myhtml7.="<td>".$getres[$i]['no_of_share']."</td>";
                $myhtml7.="<td>".$getres[$i]['date_of_transaction']."</td>";
                $myhtml7.="<td>".$getres[$i]['transaction']."</td>";
                $myhtml7.="<td>".$getres[$i]['demat_acc_no']."</td>";
                $myhtml7.="</tr>";
            }
        }
        else
        {
            $myhtml7.='<tr><td colspan="8" style="text-align: center;">Data Not Found</td>';
        }

        
       // print_r($myhtml1);exit;

      $html="<!DOCTYPE html>
      <html>
      <head>
        <style>
      </head>
      <body>
         <h3 style='text-align:center;'>Designated Person Information</h3>
         <table>
            <tr>
                <th>Sr No</th>
                <th>Name</th> 
                <th>Pan</th>
                <th>Any other legal identifier</th>
                <th>Any other legal identification number</th>
                <th>Aadhar</th>
                <th>Dob</th>  
                <th>Address</th>  
                <th>Gender</th>    
                <th>Education</th>                                                
                <th>Institution</th>
                <th>Holdings In Shares</th>
                <th>Holdings In ADRs</th>
            </tr>
         ".$myhtml1."
         </table>
         <br> 
         <h3 style='text-align:center;'>Past Employer Details</h3>
         <br>
         <table>
            <tr>
                <th>Sr No</th>
                <th>Employer Name</th> 
                <th>Designation Served</th>
                <th>Start Date</th>
                <th>End Date</th>   
            </tr>
         ".$myhtml8."
         </table>
         <br>
         <h3 style='text-align:center;'>Designated Person's Relative Information</h3>
         <br>
         <table>
            <tr>
                <th>Sr No</th>
                <th>Name</th> 
                <th>Pan</th>
                <th>Any other legal identifier</th>
                <th>Any other legal identification number</th>
                <th>Aadhar</th>
                <th>Dob</th> 
                <th>Relationship</th> 
                <th>Address</th>  
                <th>Gender</th>    
                <th>Education</th>   
                <th>Holdings In Shares</th>   
                <th>Holdings In ADRs</th>   
            </tr>
         ".$myhtml2."
         </table>
         <br>
         
         <h3 style='text-align:center;'>Designated Person's Demat Accounts</h3>
         <br>
         <table>
            <tr>
                <th>Sr No</th>
                <th>Account No</th> 
                <th>Designated Person Name</th>
                <th>Clearing House</th> 
            </tr>
         ".$myhtml3."
         </table>
         <br>
         <h3 style='text-align:center;'>Designated Person's Relative Demat Accounts</h3>
         <br>
         <table>
            <tr>
                <th>Sr No</th>
                <th>Account No</th> 
                <th>Designated Person Name</th>
                <th>Clearing House</th> 
            </tr>
         ".$myhtml4."
         </table>
         <br>
         <h3 style='text-align:center;'>Designated Person's Material Financial Relationship</h3>
         <br>
         <table>
            <tr>
                <th>Sr No</th>
                <th>Name Of Related Party</th> 
                <th>Identity Number</th> 
                <th>Nature Of Relationship</th>
                <th>Address</th> 
            </tr>
         ".$myhtml5."
         </table>
         <br>
         <h3 style='text-align:center;'>Designated Person's Holding MIS</h3>
         <br>
         <table>
            <tr>
               <th>Sr No</th>
                <th>Name Of Company</th> 
                <th>Type Of Security</th> 
                <th>No Of Securities</th> 
                <th>Transaction Date</th>
                <th>Transaction Type</th>
                <th>Demat Account No</th>
            </tr>
         ".$myhtml6."
         </table>
         <br>
         <h3 style='text-align:center;'>Designated Person's Relatives Holding MIS</h3>
         <br>
         <table>
            <tr>
                <th>Sr No</th>
                <th>Name Of Relative</th> 
                <th>Relationship</th> 
                <th>Name Of Company</th> 
                <th>No Of Securities</th> 
                <th>No of Share</th> 
                <th>Transaction Date</th>
                <th>Transaction Type</th>
                <th>Demat Account No</th>
            </tr>
         ".$myhtml7."
         </table>
        </body>
      </html>";
       // print_r($html); exit;
       return $html;
    }


    public function fetchallcontdisclsr($getuserid,$user_group_id,$query)
    {
        $connection = $this->dbtrd;
        $getlist = array();
        try
         {
            $grpusrs = $this->insidercommon->getGroupUsers($getuserid,$user_group_id);
            $queryget = "SELECT  anualdecl.`date_added`,anualdecl.`annualyear`,memb.`fullname`,memb.`emp_status`,anualdecl.`sent_date`,anualdecl.`pdfpath` 
            FROM `continuous_initial_declaration` anualdecl 
            LEFT JOIN `it_memberlist` memb ON memb.`wr_id` = anualdecl.`user_id`
            WHERE memb.`wr_id` IN (".$grpusrs['ulstring'].")".$query;
            //echo "this";echo $queryget;  exit;
            $exeget = $connection->query($queryget);
            $getnum = trim($exeget->numRows());
            //echo "this";echo $getnum;  exit;
            if($getnum>0)
            {
                //echo 'IN IF'; //exit;
                while($row = $exeget->fetch())
                {
                    $getlist[] = $row;
                }
                //echo '<pre>';print_r($getlist);exit;
                
            }else{
                //echo 'IN else'; //exit;
                $getlist = array();
            }
            //exit;
            //echo '<pre>';print_r($getlist);exit;
        }
        catch (Exception $e)
        {
            $getlist = array();
            //$connection->close();
        }
        
        return $getlist;
    }


    public function fetchpendigcontdisclsr($getuserid,$user_group_id,$query)
    {
        $connection = $this->dbtrd;
        $getlist = array();
        $userid = array();
        try
         {
            $grpusrs = $this->insidercommon->getGroupUsers($getuserid,$user_group_id);
            // $queryget = "SELECT memb.*
            //         FROM `it_memberlist` memb
            //         LEFT JOIN `annual_initial_declaration` anualdecl ON memb.`wr_id`=anualdecl.`user_id`
            //         WHERE memb.wr_id IN (".$grpusrs['ulstring'].") AND (anualdecl.annualyear='".$annualyr."') AND anualdecl.send_status= 1";
            //         //echo $queryget;exit;
            // $exeget = $connection->query($queryget);
            // $getnum = trim($exeget->numRows());

            // if($getnum>0)
            // {
            //     while($row = $exeget->fetch())
            //     {
            //         $userid[] = $row['wr_id'];
            //     }
            // }
            // $grpusers = explode(',',$grpusrs['ulstring']);
            // if(!empty($userid))
            // {
            //     $pendusrs = array_diff($grpusers, $userid);
            //     $pendingusers = implode(',',$pendusrs);
            // }
            // else
            // {
            //     $pendingusers = $grpusrs['ulstring'];
            // }
            
            $queryanual = "SELECT anualdecl.`date_added`,anualdecl.`annualyear`,memb.`fullname`,anualdecl.`sent_date`,anualdecl.`pdfpath`,anualdecl.`send_status`
            FROM `continuous_initial_declaration` anualdecl 
            LEFT JOIN `it_memberlist` memb ON memb.`wr_id`=anualdecl.`user_id`
            WHERE memb.`wr_id` IN(".$grpusrs['ulstring'].") AND anualdecl.`send_status`= 0".$query;
            ;
            //echo $queryanual;exit;
            $exeanual = $connection->query($queryanual);
            $getnumanual = trim($exeanual->numRows());
            if($getnumanual>0)
            {
                while($rowanual = $exeanual->fetch())
                {
                    $getlist[]=$rowanual;
                }
            }
            else
            {
                $getlist = array();
            }
            //print_r($getlist);exit;
            
        }
        catch (Exception $e)
        {
            $getlist = array();
            //$connection->close();
        }
        
        return $getlist;
    }


    public function fetchmiscontdisclsr($getuserid,$user_group_id,$query)
    {
        $connection = $this->dbtrd;
        $getlist = array();
        try
         {
            $grpusrs = $this->insidercommon->getGroupUsers($getuserid,$user_group_id);
            // $queryget = "SELECT * FROM `it_memberlist` WHERE `status`='1' AND wr_id IN (".$grpusrs['ulstring'].")";
            // $exeget = $connection->query($queryget);
            // $getnum = trim($exeget->numRows());

            // if($getnum>0)
            // {
            //     while($row = $exeget->fetch())
            //     {
                    $queryanual = "SELECT anualdecl.`date_added`,anualdecl.`annualyear`,memb.`fullname`,anualdecl.`sent_date`,anualdecl.`pdfpath`,anualdecl.`send_status`
                    FROM `continuous_initial_declaration` anualdecl 
                    LEFT JOIN `it_memberlist` memb ON memb.`wr_id`=anualdecl.`user_id`
                    WHERE memb.`wr_id` IN (".$grpusrs['ulstring'].")".$query;
                    ;
                    //echo $queryanual;exit;
                    $exeanual = $connection->query($queryanual);
                    $getnumanual = trim($exeanual->numRows());
                    if($getnumanual>0)
                    {
                        while($rowanual = $exeanual->fetch())
                        {
                            // if($rowanual['annualyear']==$annualyr)
                            // {
                                $getlist[]=$rowanual;
                            // }
                            // else
                            // {
                            //     $rowanual['annualyear']='';
                            //     $rowanual['pdfpath']='';
                            //     $rowanual['sent_date']='';
                            //     $getlist[]=$rowanual;
                            // }
                        }
                    }
                // }
                //echo '<pre>';print_r($getlist);exit;
                
            // }
        }
        catch (Exception $e)
        {
            $getlist = array();
            //$connection->close();
        }
        
        return $getlist;
    }
    
    

}





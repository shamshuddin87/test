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
        $getlist = array();
        for($i=0;$i<sizeof($compid);$i++)
        {
            $queryget = "SELECT ts.*,pr.type_of_transaction FROM `trading_status` ts
                        LEFT JOIN `personal_request` pr ON pr.`id` = ts.`req_id`
                        WHERE ts.`user_id` = '".$userid."' AND ts.`id_of_company` = '".$compid[$i]."' AND ts.trading_status='1' AND ts.sectype='1' AND pr.`relative_id` = ''";
            //echo $queryget;exit;
            try
            { 
               $exeget = $connection->query($queryget);
                $getnum = trim($exeget->numRows());
                   $buyequity = 0;$sellequity = 0;
                    
                if($getnum>0)
                {
                    while($row = $exeget->fetch())
                    {
                          if( $row['type_of_transaction']=='1' || $row['type_of_transaction']=='3' || $row['type_of_transaction']=='4' )
                            {
                               $buyequity =  $buyequity + $row['no_of_share'];
                            }
                            else if($row['type_of_transaction']=='2')
                            {
                                $sellequity =  $sellequity + $row['no_of_share'];
                            }
                            else{ }
                            $row2 = array('buyequity'=>$buyequity,'sellequity'=>$sellequity);
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
    
     public function fetchprefereence($userid,$compid)
     {
        $connection = $this->dbtrd;
        $compid = explode(',',$compid);
         $getlist = array();
        for($i=0;$i<sizeof($compid);$i++)
        {
            $queryget = "SELECT ts.*,pr.type_of_transaction FROM `trading_status` ts
                        LEFT JOIN `personal_request` pr ON pr.`id` = ts.`req_id`
                        WHERE ts.`user_id` = '".$userid."' AND ts.`id_of_company` = '".$compid[$i]."' AND ts.trading_status='1' AND ts.sectype='2' AND pr.`relative_id` = ''";
            //echo $queryget;exit;
            try
            { 
               $exeget = $connection->query($queryget);
                $getnum = trim($exeget->numRows());
                   $buyprefer = 0;$sellprefer = 0;
                    
                if($getnum>0)
                {
                 
                    while($row = $exeget->fetch())
                    {

                        if( $row['type_of_transaction']=='1' || $row['type_of_transaction']=='3' || $row['type_of_transaction']=='4' )
                        {
                           $buyprefer =  $buyprefer + $row['no_of_share'];
                        }
                        else if($row['type_of_transaction']=='2')
                        {
                            $sellprefer =  $sellprefer + $row['no_of_share'];
                        }
                        else{ }
                        $row2 = array('buyprefer'=>$buyprefer,'sellprefer'=>$sellprefer);
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
        return $getlist; 
    }
    
     public function fetchdebenure($userid,$compid)
     {
        $connection = $this->dbtrd;
        $compid = explode(',',$compid);
        $getlist = array();
        for($i=0;$i<sizeof($compid);$i++)
        {
            $queryget = "SELECT ts.*,pr.type_of_transaction FROM `trading_status` ts
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
        	$query="SELECT * FROM it_memberlist WHERE FIND_IN_SET('".$getuserid."',`approvid`) OR `wr_id`= '".$getuserid."' ".$ext;
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
    public function fetchrecipient($getuserid,$user_group_id)
    {
       $connection = $this->dbtrd;
        
        try
         {
            $grpusrs = $this->insidercommon->getGroupUsers($getuserid,$user_group_id);
            $queryget = "SELECT sr.* ,memb.fullname,sc.`category` as categoryname FROM `sensitiveinfo_recipient` sr 
                        LEFT JOIN `it_memberlist` memb ON memb.wr_id = sr.user_id
                        LEFT JOIN `sensitiveinfo_category` sc ON sr.category = sc.id 
                        WHERE sr.`user_id` IN (".$grpusrs['ulstring'].")"; 
          
             
            
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
             $queryget = "SELECT ss.*,sr.name,sr.nameofentity,sr.identityno,utype.upsitype,
                    memb.`fullname`,sc.`category` AS category_name,sr.`othercategory` 
                    FROM `sensitiveinfo_sharing` ss 
                    LEFT JOIN `sensitiveinfo_recipient` sr ON ss.`recipientid` = sr.`id` 
                    LEFT JOIN `it_memberlist` memb ON memb.`wr_id` = ss.`user_id` 
                    LEFT JOIN `upsimaster` utype ON utype.id = ss.`upsitype` 
                    LEFT JOIN `sensitiveinfo_category` sc ON sc.`id` = sr.`category`
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
            $queryget = "SELECT memb.`fullname`,lst.`company_name`,trans.`transaction`,ts.`date_of_transaction`,pr.`date_added`,ts.`no_of_share`,pr.`trading_date`  
            FROM `trading_status` ts
            LEFT JOIN `it_memberlist` memb ON memb.`wr_id`= ts.`user_id`
            INNER JOIN `personal_request` pr ON pr.`id` = ts.`req_id`
            LEFT JOIN `type_of_transaction` trans ON trans.`id` = pr.`type_of_transaction`
            LEFT JOIN `trading_days` trddays ON trddays.`user_id` = memb.`user_id`
            LEFT JOIN `listedcmpmodule` lst ON lst.`id`=pr.`id_of_company`
            WHERE ts.`user_id` IN (".$grpusrs['ulstring'].") AND ts.`trading_status`=1 AND (ts.`excep_approv`=1) ".$query; 
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



     public function fetchmisnonexetrde($getuserid,$user_group_id,$query)
    {
        $connection = $this->dbtrd;
        try
         {
            $grpusrs = $this->insidercommon->getGroupUsers($getuserid,$user_group_id);
            $queryget = "SELECT pr.`no_of_shares`,lst.`company_name`,ts.`date_added`,pr.`approved_date`,ts.`trading_status`,memb.`fullname` 
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
        $query="SELECT `ts`.no_of_share AS actualtrade,lst.`company_name`,`ts`.date_of_transaction,pr.`no_of_shares` AS preclrtrade,pr.`approved_date`,pr.`date_added`,pr.`trading_date`,memb.`fullname` 
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
        $connection = $this->dbtrd;
       try
        {
            $grpusrs = $this->insidercommon->getGroupUsers($getuserid,$user_group_id);
            $usersid = explode(',',$grpusrs['ulstring']);
            $getlist = array();
             // print_r($usersid);exit;
            for($i= 0;$i<sizeof($usersid);$i++)
            {
              $getcmpid=$this->getallcompanyid($usersid[$i]);
                // print_r($getcmpid);
               $allcmpid=implode('","',$getcmpid);

               // print_r("------------------");
               //     print_r($usersid[$n]);
               //     print_r("~");
               // print_r($allcmpid);
               // print_r("------------------");
             
//               //   print_r("-------------");
                
              
                  for($k=0;$k<sizeof($getcmpid);$k++)
                  {
                    $queryget = 'SELECT memb.`fullname`,lst.`company_name`,ts.`date_of_transaction`,ts.`no_of_share`,formc.`send_date`,ts.`total_amount` 
                  
                      FROM  `trading_status` ts
                      LEFT JOIN `it_memberlist` memb ON memb.`wr_id` = ts.`user_id` 
                      LEFT JOIN `sebiformc_usrdata` formc ON ts.`id` = formc.`tradeid` 
                      LEFT JOIN `personal_request` pr ON pr.`id` = ts.`req_id`
                      LEFT JOIN `listedcmpmodule` lst ON lst.`id`=pr.`id_of_company`
                      WHERE ts.`user_id`= "'.$usersid[$i].'" AND  ts.`id_of_company`="'.$getcmpid[$k].'" AND ts.`date_of_transaction` BETWEEN "'.$finstrtdte.'" AND "'.$finenddte.'" '.$query; 
                
                 // print_r($queryget);

                 // print_r("-----------------------------");

                 // echo $i; 
// 
                // print_r("---------------------------");
                $exeget = $connection->query($queryget);
                $getnum = trim($exeget->numRows());

                  // print_r($getnum);

                if($getnum>0)
                {
                  $totlamnt[$k] = 0;
                	// print_r("herer");exit;
                    while($row = $exeget->fetch())
                    {
                        $totlamnt[$k] = $totlamnt[$k]+$row['total_amount'];
                        $data = $row;
                    }
                    // print_r($totlamnt[$k]);
                     
                    if($totlamnt[$k]> 1000000)
                    {
                        if($filter == 'pending')
                        {
                            $getlist[] = $data;
                            foreach($data as $key => $values)
                            {
                                if(!empty($values['send_date']))
                                {
                                    unset($data[$key]);
                                    $getlist[] = array_values($data);
                                }
                            }
                        }
                        else
                        {
                            $getlist[]= $data;
                        }
                    }
                    else
                    {   
                        $data = array();
                    }
                    //exit;

                }
            }
              // echo '<pre>';print_r($getlist);
        
        }

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
                    $queryanual = "SELECT memb.`fullname`,initial.sent_date,initial.pdfpath,initial.send_status,memb.dpdate
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
            $queryget = "SELECT memb.`fullname`,initial.sent_date,initial.pdfpath,memb.dpdate 
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
            
            $queryanual = "SELECT memb.`fullname`,initial.sent_date,initial.pdfpath,initial.send_status,memb.dpdate
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
            
            $queryanual = "SELECT anualdecl.annualyear,memb.`fullname`,anualdecl.sent_date,anualdecl.pdfpath,anualdecl.send_status
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
            $queryget = "SELECT anualdecl.annualyear,memb.`fullname`,anualdecl.sent_date,anualdecl.pdfpath 
            FROM `it_memberlist` memb 
            LEFT JOIN `annual_initial_declaration` anualdecl ON memb.`wr_id` = anualdecl.user_id 
            WHERE memb.wr_id IN (".$grpusrs['ulstring'].")  AND (anualdecl.annualyear='".$annualyr."' OR anualdecl.annualyear IS NULL OR anualdecl.`send_status`=1)".$query;
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
                    $queryanual = "SELECT anualdecl.annualyear,memb.`fullname`,anualdecl.sent_date,anualdecl.pdfpath,anualdecl.send_status
                    FROM `it_memberlist` memb
                    LEFT JOIN `annual_initial_declaration` anualdecl ON memb.`wr_id`=anualdecl.`user_id`
                    WHERE memb.wr_id = '".$row['wr_id']."' AND (anualdecl.annualyear='".$annualyr."' OR anualdecl.annualyear IS NULL )".$query;
                    ;
                     //echo $queryanual;
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
       try{
            if($user_group_id == 2 || $user_group_id == 14)
            {
                   $query="SELECT *,ups.`date_added` as dtadd,ups.`id` as uppid FROM `upsimaster` ups  LEFT JOIN  `it_memberlist` it ON ups.`user_id`=it.`wr_id`  ".$rslmt;
            }
            else
            {
               $query="SELECT *,ups.`date_added` as dtadd,ups.`id` as uppid FROM `upsimaster` ups  LEFT JOIN  `it_memberlist` it ON ups.`user_id`=it.`wr_id` WHERE  ups.`projectowner` IN(".$userid.") ".$rslmt;
            }
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
               <th>Added By</th>
            </tr>
         ".$myhtml."
         </table>
        </body>
      </html>";
   
       return $html;
    }
    

}





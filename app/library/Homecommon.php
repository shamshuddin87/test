<?php
use Phalcon\Mvc\User\Component;
class Homecommon extends Component
{
    public function countofrestrictcomp($getuserid,$user_group_id)
    {
        $connection = $this->dbtrd;
        try
        {
             $grpusrs = $this->insidercommon->getGroupUsers($getuserid,$user_group_id);
             $queryget = "SELECT * FROM `companytrading_period` WHERE `user_id` IN (".$grpusrs['ulstring'].") "; 
            
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
    
    public function countdepndrelative($userid,$user_group_id)
    {
       $connection = $this->dbtrd;
       $time = time();
       try
       {
         $query="SELECT * FROM `relative_info` WHERE user_id='".$userid."'";
         $exeget = $connection->query($query);
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
            $getlist=array();
         }

        }
           catch(Exception $e)
           {
              $getlist=array();
           }
        return $getlist;
    }
    
     public function countofreqpendapp($getuserid,$user_group_id)
     {
       $connection = $this->dbtrd;
        try
         {
             
             $queryget = "SELECT * FROM `personal_request` WHERE approved_status ='' AND `user_id`= '".$getuserid."' "; 
            
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
    
    //############### fetching holding summary start ###############
    public function fetchholdingsummary($getuserid,$user_group_id)
    {
        $connection = $this->dbtrd;
        try
        {
          $query = "SELECT hs.*, lc.company_name  FROM `opening_balance` hs
                      INNER JOIN `listedcmpmodule` lc ON hs.id_of_company = lc.id
                      WHERE hs.user_id = '".$getuserid."' GROUP BY hs.id_of_company ";
            
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
        
        return $finaldata;
    }
    
     public function fetchequity($getuserid,$compid)
     {
        $connection = $this->dbtrd;
        $compid = explode(',',$compid);
        $getlist = '';
//        for($i=0;$i<sizeof($compid);$i++)
//        {
//            $queryget = "SELECT ts.*,pr.type_of_transaction FROM `trading_status` ts
//                        LEFT JOIN `personal_request` pr ON pr.`id` = ts.`req_id`
//                        WHERE ts.`user_id` ='".$getuserid."' AND ts.`id_of_company` = '".$compid[$i]."' AND ts.trading_status='1' AND ts.sectype='1' AND pr.`relative_id` = ''";
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
                        WHERE `userid` = '".$getuserid."'";
         //echo $queryget;exit;
        $exeget = $connection->query($queryget);
        $getnum = trim($exeget->numRows());
        if($getnum>0)
        {
            $row = $exeget->fetch();
            $getlist = $row['sharehldng'];
            if(empty($getlist))
            {
                $getlist = 0;
            }
        }
        else
        {
            $getlist = 0;
        }
        return $getlist; 
    }
    
     public function fetchprefereence($getuserid,$compid)
     {
        $connection = $this->dbtrd;
        $compid = explode(',',$compid);
        $getlist = '';
//        for($i=0;$i<sizeof($compid);$i++)
//        {
//            $queryget = "SELECT ts.*,pr.type_of_transaction FROM `trading_status` ts
//                        LEFT JOIN `personal_request` pr ON pr.`id` = ts.`req_id`
//                        WHERE ts.`user_id` ='".$getuserid."' AND ts.`id_of_company` = '".$compid[$i]."' AND ts.trading_status='1' AND ts.sectype='2' AND pr.`relative_id` = ''";
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
                        WHERE `userid` = '".$getuserid."'";
        $exeget = $connection->query($queryget);
        $getnum = trim($exeget->numRows());
        if($getnum>0)
        {
            $row = $exeget->fetch();
            $getlist = $row['adrshldng'];
            if(empty($getlist))
            {
                $getlist = 0;
            }
        }
        else
        {
            $getlist = 0;
        }
        return $getlist; 
    }
    
     public function fetchdebenure($getuserid,$compid)
     {
        $connection = $this->dbtrd;
        $compid = explode(',',$compid);
        $getlist = array();
        for($i=0;$i<sizeof($compid);$i++)
        {
            $queryget = "SELECT ts.*,pr.type_of_transaction FROM `trading_status` ts
                        LEFT JOIN `personal_request` pr ON pr.`id` = ts.`req_id` 
                        WHERE ts.`user_id` ='".$getuserid."' AND ts.`id_of_company` = '".$compid[$i]."' AND ts.trading_status='1' AND ts.sectype='3' AND pr.`relative_id` = ''";
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
    
    public function fetchcmpname($getuserid,$compid)
    {
        $connection = $this->dbtrd;
        $getlist = '';
        $queryget = "SELECT * FROM `listedcmpmodule` 
                        WHERE `id` = '1'";
        $exeget = $connection->query($queryget);
        $getnum = trim($exeget->numRows());
        if($getnum>0)
        {
            $row = $exeget->fetch();
            $getlist = $row['company_name'];
        }
        else
        {
            $getlist = '';
        }
        return $getlist; 
    }


     public function fetchfirstlogin($getuserid)
    {
        $connection = $this->db;
        $getlist = '';
        $queryget = "SELECT `firstlogin` FROM `web_register_user` where user_id = '".$getuserid."' ";

        $exeget = $connection->query($queryget);
        $getnum = trim($exeget->numRows());
        
        if($getnum>0)
        {
            $row = $exeget->fetch();
            $getlist = $row;
        }
        else
        {
            $getlist = '';
        }
      
        return $getlist; 
    }
    

     public function updatetlogin($getuserid)
    {
        $connection = $this->db;
        $getlist = '';
        $queryget = "UPDATE `web_register_user` SET firstlogin = '1' where user_id = '".$getuserid."' ";

        $exeget = $connection->query($queryget);
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

    public function upsiholding($getuserid)
    {
        $connection = $this->dbtrd;
        $getlist = [];
         
        
        $queryget = "SELECT * FROM upsimaster WHERE (projectowner = '".$getuserid."' OR  FIND_IN_SET('".$getuserid."',`connecteddps`)) ";
        
        
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
            $getlist = '';
        }
                  
        return $getlist; 
    }

      public function gettradingwindw($getuserid,$user_group_id)
    {
        $connection = $this->dbtrd;
        $getlist = array();

          $d       =  date('d-m-Y');
          //print_r($d);exit;
        try
        {
            /* -- get company ---*/
            $querycmp = "SELECT * FROM `it_memberlist`WHERE `wr_id` = '".$getuserid."'";
            $execmp = $connection->query($querycmp);
            $rowz = $execmp->fetch();
            $cmpid = $rowz['cmpaccess'];
            $cmpid = explode(',',$cmpid);
            //print_r($cmpid);exit;
            $queryselect = "SELECT * FROM `blackoutperiod_cmp` WHERE STR_TO_DATE(blackoutperiod_cmp.`dateto`,'%d-%m-%Y') >= STR_TO_DATE('".$d."','%d-%m-%Y') ORDER BY `id` DESC LIMIT 5";
            //echo $queryselect;exit;
            $exeget = $connection->query($queryselect);
            $getnum = trim($exeget->numRows());
            if($getnum>0)
                {
                    while($row = $exeget->fetch())
                    {
                        $blackoutcmp = $row['companyid'];
                        if(in_array($blackoutcmp,$cmpid))
                        {
                            $getlist[] = $row;
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
        //print_r($getlist);exit;
        return $getlist;
    }
    
    public function checkIfCoiApplicable($uid,$usergroup)
    {
        $connection = $this->dbtrd;
        $isAplicable = 'No';
        try
        {
            $querygetRel = "SELECT * FROM `relative_info`
            WHERE `user_id` = '".$uid."' AND `isbusiness_partner` = 'Yes'";
            //echo $queryget;exit;
            $exegetRel = $connection->query($querygetRel);
            $getnumRel = trim($exegetRel->numRows());
            if($getnumRel>0)
            {
                $isAplicable = 'Yes';
            }
            else
            {
                $querygetMfr = "SELECT * FROM `mfr`
                WHERE `user_id` = '".$uid."' AND `mfr_thirdparty` = 'Yes'";
                //echo $queryget;exit;
                $exegetMfr = $connection->query($querygetMfr);
                $getnumMfr = trim($exegetMfr->numRows());
                if($getnumMfr>0)
                {
                    $isAplicable = 'Yes';
                }
                else
                {
                    $isAplicable = 'No';
                }
            }
        }
        catch (Exception $e)
        {
            $isAplicable = 'No';
        }
        return $isAplicable;
    }
    
    public function checkIfCoiFilled($uid,$usergroup)
    {
        $connection = $this->dbtrd;
        $isFilled = 'Yes';
        try
        {
            $queryget = "SELECT * FROM `coi_declaration`
            WHERE `user_id` = '".$uid."'";
            //echo $queryget;exit;
            $exeget = $connection->query($queryget);
            $getnum = trim($exeget->numRows());
            if($getnum>0)
            {
                $isFilled = 'Yes';
            }
            else
            {
                $isFilled = 'No';
            }
        }
        catch (Exception $e)
        {
            $isFilled = 'No';
        }
        return $isFilled;
    }
    
    
    
}





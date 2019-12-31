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
        $getlist = array();
        for($i=0;$i<sizeof($compid);$i++)
        {
            $queryget = "SELECT ts.*,pr.type_of_transaction FROM `trading_status` ts
                        LEFT JOIN `personal_request` pr ON pr.`id` = ts.`req_id`
                        WHERE ts.`user_id` ='".$getuserid."' AND ts.`id_of_company` = '".$compid[$i]."' AND ts.trading_status='1' AND ts.sectype='1' AND pr.`relative_id` = ''";
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
    
     public function fetchprefereence($getuserid,$compid)
     {
        $connection = $this->dbtrd;
        $compid = explode(',',$compid);
         $getlist = array();
        for($i=0;$i<sizeof($compid);$i++)
        {
            $queryget = "SELECT ts.*,pr.type_of_transaction FROM `trading_status` ts
                        LEFT JOIN `personal_request` pr ON pr.`id` = ts.`req_id`
                        WHERE ts.`user_id` ='".$getuserid."' AND ts.`id_of_company` = '".$compid[$i]."' AND ts.trading_status='1' AND ts.sectype='2' AND pr.`relative_id` = ''";
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
    
    
    
    
    
    
    
}





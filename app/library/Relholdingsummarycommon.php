<?php
use Phalcon\Mvc\User\Component;
class Relholdingsummarycommon extends Component
{
 
    //############### insert holding summary start ###############
    public function insertholdingsummry($getuserid,$user_group_id,$relationtype,$noofshares,$sectype)
    {
        $connection = $this->dbtrd;
        $time = time();
        $queryselect = "SELECT * FROM `rel_opening_balance` WHERE `user_id` = '".$getuserid."' AND `id_of_relative` = '".$relationtype."'";
        $exeget = $connection->query($queryselect);
        $getnum = trim($exeget->numRows());
        if($getnum == 0)
        {
            if($sectype == '1')
            {
                $queryinsert = "INSERT INTO `rel_opening_balance`(`user_id`,`user_group_id`,`id_of_relative`,`equityshare`,`prefershare`,`debntrshare`,`sectype`,`from`,`date_added`, `date_modified`,`timeago`)
                VALUES ('".$getuserid."','".$user_group_id."','".$relationtype."','".$noofshares."','0','0','".$sectype."','notrequest',NOW(),NOW(),'".$time."')";
            }
            else if($sectype == '2')
            {
                $queryinsert = "INSERT INTO `rel_opening_balance`(`user_id`,`user_group_id`,`id_of_relative`,`equityshare`,`prefershare`,`debntrshare`,
                `sectype`,`from`,`date_added`, `date_modified`,`timeago`)
                VALUES ('".$getuserid."','".$user_group_id."','".$relationtype."','0','".$noofshares."','0','".$sectype."','notrequest',NOW(),NOW(),'".$time."')";
            }
            else if($sectype == '3')
            {
                $queryinsert = "INSERT INTO `rel_opening_balance`(`user_id`,`user_group_id`,`id_of_relative`,`equityshare`,`prefershare`,`debntrshare`,`sectype`,`from`,`date_added`, `date_modified`,`timeago`)
                VALUES ('".$getuserid."','".$user_group_id."','".$relationtype."','0','0','".$noofshares."','".$sectype."','notrequest',NOW(),NOW(),'".$time."')";
            }
        }
        
        else
        {
             return false;
        }
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
    //############### insert holding summary end ###############
    
    //############### fetching holding summary start ###############
    public function fetchallholdingsummary($getuserid,$user_group_id)
    {
        $connection = $this->dbtrd;
        try
        {
          $query = "SELECT hs.*, lc.relationshipname  FROM `rel_opening_balance` hs
                      LEFT JOIN `relationship` lc ON hs.id_of_relative = lc.id
                      WHERE hs.user_id = '".$getuserid."' GROUP BY hs.id_of_relative" ;
            
              // echo $query;exit;
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
            // print_r($getlist);exit;
            if(!empty($getlist))
            {   $companyid = implode(',', array_column($getlist,'id_of_relative'));   }
            else
            {   $companyid = '';    } 
            
            $finaldata = array('data'=>$getlist,'companyid'=>$companyid);
            
        }
        catch (Exception $e)
        {
            $finaldata = array();
            //$connection->close();
        }
        // print_r($finaldata);exit;
        return $finaldata;
    }
    
    public function fetchholdingsummary($getuserid,$user_group_id,$pagefrom,$pageto)
    {
        $connection = $this->dbtrd;
        try
        {
          $query = "SELECT hs.*, lc.relationshipname  FROM `rel_opening_balance` hs
                      INNER JOIN `relationship` lc ON hs.id_of_relative = lc.id
                      WHERE hs.user_id = '".$getuserid."' GROUP BY hs.id_of_relative" ;


            
            
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
            {   $companyid = implode(',', array_column($getlist,'id_of_relative'));   }
            else
            {   $companyid = '';    } 
            $getdata =array_slice($getlist,$pagefrom,$pageto, true);
            $finaldata = array('data'=>$getdata,'companyid'=>$companyid);
            
        }
        catch (Exception $e)
        {
            $finaldata = array();
            //$connection->close();
        }
        //print_r($finaldata);exit;
        return $finaldata;
    }
    
     public function fetchequity($getuserid,$compid,$pagefrom,$pageto)
     {
        // print_r($compid);exit;
        $connection = $this->dbtrd;
        $compid = explode(',',$compid);
        $getlist = array();
        for($i=0;$i<sizeof($compid);$i++)
        {

          

            $queryget =   "SELECT * FROM `personal_request` pr 
                           INNER JOIN `relative_info` rinfo ON `rinfo`.id=`pr`.relative_id
                           INNER JOIN  `relationship` rp ON `rp`.id=`rinfo`.relationship
                           LEFT JOIN `trading_status` ts ON `ts`.req_id=`pr`.id
                            WHERE pr.`type_of_request`=2 AND pr.`user_id` = '".$getuserid."' AND rinfo.`relationship`='".$compid[$i]."' AND ts.sectype='1'";
             // echo $queryget;
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
                            else if($row['type_of_transaction']=='2' || $row['type_of_transaction']=='5' || $row['type_of_transaction']=='6' || $row['type_of_transaction']=='7')
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
         $getlist1 =array_slice($getlist,$pagefrom,$pageto, true);
        return $getlist1; 
    }
    
     public function fetchprefereence($getuserid,$compid,$pagefrom,$pageto)
     {
        $connection = $this->dbtrd;
        $compid = explode(',',$compid);
         $getlist = array();
        for($i=0;$i<sizeof($compid);$i++)
        {
            $queryget = "SELECT * FROM `personal_request` pr 
                           INNER JOIN `relative_info` rinfo ON `rinfo`.id=`pr`.relative_id
                           INNER JOIN  `relationship` rp ON `rp`.id=`rinfo`.relationship
                           LEFT JOIN `trading_status` ts ON `ts`.req_id=`pr`.id
                            WHERE pr.`type_of_request`=2 AND pr.`user_id` = '".$getuserid."' AND rinfo.`relationship`='".$compid[$i]."' AND ts.sectype='2'";
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
                       else if($row['type_of_transaction']=='2' || $row['type_of_transaction']=='5' || $row['type_of_transaction']=='6' || $row['type_of_transaction']=='7')
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
         $getlist1 =array_slice($getlist,$pagefrom,$pageto, true);
        return $getlist1; 
    }
    
     public function fetchdebenure($getuserid,$compid,$pagefrom,$pageto)
     {
        $connection = $this->dbtrd;
        $compid = explode(',',$compid);
        $getlist = array();
        for($i=0;$i<sizeof($compid);$i++)
        {
            $queryget = "SELECT * FROM `personal_request` pr 
                           INNER JOIN `relative_info` rinfo ON `rinfo`.id=`pr`.relative_id
                           INNER JOIN  `relationship` rp ON `rp`.id=`rinfo`.relationship
                           LEFT JOIN `trading_status` ts ON `ts`.req_id=`pr`.id
                            WHERE pr.`type_of_request`=2 AND pr.`user_id` = '".$getuserid."' AND rinfo.`relationship`='".$compid[$i]."' AND ts.sectype='3'";
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
                             else if($row['type_of_transaction']=='2' || $row['type_of_transaction']=='5' || $row['type_of_transaction']=='6' || $row['type_of_transaction']=='7')
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
        $getlist1 =array_slice($getlist,$pagefrom,$pageto, true);
        return $getlist1; 
    }
    //############### fetching holding summary end ###############
    
    //############### edit holding summary end ###############
    public function holdingsummaryedit($id)
    {
        $connection = $this->dbtrd;
        $queryget = "SELECT *  FROM `rel_opening_balance` ob
                    WHERE ob.`id`= '".$id."'"; 
            //echo $queryget;exit;
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
    //############### edit holding summary end ###############
    
   
    //############### update holding summary start ###############
     public function updateholdingsummry($getuserid,$user_group_id,$equity,$prefernc,$debenture,$id)
     {
            $connection = $this->dbtrd;
            $time = time();
            try
            {
                     $query = "UPDATE `rel_opening_balance` SET  `equityshare`='".$equity."',`prefershare`='".$prefernc."',`debntrshare`='".$debenture."',`date_modified`=NOW(),`timeago`='".$time."' WHERE id='".$id."'";   
                     $exeget = $connection->query($query);
                       if($exeget)
                       {
                          $returndta = array('status'=>true,'msg'=>'Updated Successfully !! ');
                       }
                      else
                      {
                         $returndta = array('status'=>false,'msg'=>'Record Not updated !! ');
                      } 
                   
            }
          catch(Exception $e)
          {

             $returndta = array('status'=>false,'msg'=>'Record Not updated !! ');
          }

        return $returndta;
       }
    //############### update holding summary end ###############
}





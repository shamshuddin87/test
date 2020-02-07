<?php
use Phalcon\Mvc\User\Component;
class Uploadholdingcommon extends Component
{
  public function insertholding($getuserid,$user_group_id,$holdingArray,$dtofhldng,$uniqueid,$typeofhldng)
  {
      $connection = $this->dbtrd;
      $time = time();
      $queryinsert = "INSERT INTO `holding`
        (`user_id`,`user_group_id`,`uniqueid`,`panno`,`type_of_holding`,`holding`,`dateofholding`,`date_added`, `date_modified`,`timeago`)
         VALUES ('".$getuserid."','".$user_group_id."','".$uniqueid."','".$holdingArray['panno']."','".$typeofhldng."','".$holdingArray['holding']."','".$dtofhldng."',NOW(),NOW(),'".$time."')";
      //echo $queryinsert;exit;
      $exeml = $connection->query($queryinsert);
        if($exeml)
        {
             return true;
        }
        else
        {
             return false;
        }
  }
    
    public function fetchholding($getuserid,$user_group_id,$query)
    {
        $connection = $this->dbtrd;
        try
        {
            $grpusrs = $this->insidercommon->getGroupUsers($getuserid,$user_group_id);
            
            $queryselect = "SELECT * FROM `holding` WHERE 
                `user_id` IN (".$grpusrs['ulstring'].") 
                GROUP BY `uniqueid` ORDER BY `dateofholding` DESC " .$query;
            //echo $queryselect;exit;
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
    
    public function fetchholdingforview($getuserid,$user_group_id,$uniqueid,$query)
    {
        $connection = $this->dbtrd;
        $getpanlist = array();
        try
        {
            
            $queryselect = "SELECT re.*,pinfo.`userid` AS personusername ,rinfo.`name` as relativename,rinfo.`relationship`,rinfo.`user_id` AS relativeusername 
                            FROM holding re
                            LEFT JOIN `personal_info` pinfo ON pinfo.`pan` = re.`panno`
                            LEFT JOIN `relative_info` rinfo ON rinfo.`pan` = re.`panno` 
                            WHERE re.`uniqueid`= '".$uniqueid."' ".$query;
            //echo $queryselect;exit;
            $exeget = $connection->query($queryselect);
            $getnum = trim($exeget->numRows());
            if($getnum>0)
                {
                    while($row = $exeget->fetch())
                    {
                        if(empty($row['personusername']))
                        {
                           $queryusrnm = "SELECT * FROM `it_memberlist` WHERE wr_id = '".$row['relativeusername']."'";
                        }
                        else
                        {
                            $queryusrnm = "SELECT * FROM `it_memberlist` WHERE wr_id = '".$row['personusername']."'";
                        }
                      
                        $getpanlist[] = $row['panno'];
                        $exeusrnm = $connection->query($queryusrnm);
                        $getusrnm = trim($exeusrnm->numRows());
                        
                        if($getusrnm>0)
                        {
                            while($rowusrnm = $exeusrnm->fetch())
                            {
                                $getusrnmlist[] = $rowusrnm['fullname'];
                                
                            }
                        }
                        else
                        {
                            $getusrnmlist = array();
                        }
                        $getlist[] = $row;
                        
                      }
                        
                        
                
                    $finaldata = array('data'=>$getlist,'panlist'=>$getpanlist,'username'=>$getusrnmlist);
                    //print_r($finaldata);exit;
                }else{
                    $finaldata = array();
                }
        }
        catch (Exception $e)
        {
            $finaldata = array();
            //$connection->close();
        }
        //echo 'out';exit;
        return $finaldata;
    }
    

    public function updatePersnlinfo($panno,$rtaholding,$typeofhldng)
    {
        $connection = $this->dbtrd;
        $time = time();
        
        if($typeofhldng == 'Shareholding')
        {
            $table_field = "sharehldng";
        }
        else if($typeofhldng == 'ADRs holding')
        {
            $table_field = "adrshldng";
        }

        $queryinsert = "UPDATE `personal_info` SET `".$table_field."` = '".$rtaholding."' WHERE `pan`= '".$panno."'  ";
        //echo $queryinsert;exit;
        $exeml = $connection->query($queryinsert);
        if($exeml)
        {
             return true;
        }
        else
        {
             return false;
        }
    }
}





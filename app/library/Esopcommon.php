<?php
use Phalcon\Mvc\User\Component;
class Esopcommon extends Component
{
    public function insertesop($getuserid,$user_group_id,$esopdata,$uniqueid)
    {
      $connection = $this->dbtrd;
      $time = time();
      if($esopdata['almtdte'])
      {
          $allotmentdate = date('d-m-Y', strtotime($esopdata['almtdte']));
          $queryinsert = "INSERT INTO `esop`(`user_id`,`user_group_id`,`uniqueid`,`emp_name`,`emp_pan`,`emp_shares`,`altmntdate`,`date_added`, `date_modified`,`timeago`) VALUES ('".$getuserid."','".$user_group_id."','".$uniqueid."','".$esopdata['empname']."','".$esopdata['emppan']."','".$esopdata['empshares']."','".$allotmentdate."',NOW(),NOW(),'".$time."')";
      }
      else
      {
          $queryinsert = "INSERT INTO `esop`(`user_id`,`user_group_id`,`uniqueid`,`emp_name`,`emp_pan`,`emp_shares`,`altmntdate`,`cmp_name`,`date_added`, `date_modified`,`timeago`) VALUES ('".$getuserid."','".$user_group_id."','".$uniqueid."','".$esopdata['empname']."','".$esopdata['emppan']."','".$esopdata['empshares']."',NULL,NOW(),NOW(),'".$time."')";
      }
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
    
    public function fetchesop($getuserid,$user_group_id,$query)
    {
        $connection = $this->dbtrd;
        try
        {
            $grpusrs = $this->insidercommon->getGroupUsers($getuserid,$user_group_id);
            $queryselect = "SELECT * FROM `esop` WHERE `user_id` IN (".$grpusrs['ulstring'].")  GROUP BY uniqueid" .$query;
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
    
    public function fetchesopforview($getuserid,$user_group_id,$uniqueid,$query)
    {
        $connection = $this->dbtrd;
        $getpanlist = array();
        try
        {
            $queryselect = "SELECT * FROM esop WHERE `uniqueid`= '".$uniqueid."' ".$query;
            //echo $queryselect;exit;
            $exeget = $connection->query($queryselect);
            $getnum = trim($exeget->numRows());
            if($getnum>0)
                {
                    while($row = $exeget->fetch())
                    {
                        $getlist[] = $row;
                    }
                    //print_r($finaldata);exit;
                }else{
                    $getlist = array();
                }
        }
        catch (Exception $e)
        {
            $getlist = array();
            //$connection->close();
        }
        //echo 'out';exit;
        return $getlist;
    }
    
    public function saveesopfinal($getuserid,$user_group_id,$uniqueid)
    {
        $connection = $this->dbtrd;
        $time = time();
        $getcmpid = array(); 
        $getpanuserid = array(); 
        $noofshares = array(); 
        $updateesop =  "UPDATE `esop` SET `finalsave`='1',`date_modified`=NOW(),`timeago`='".$time."' WHERE `uniqueid`='".$uniqueid."' ";
        //echo $updateesop;exit;
        try
        {
            $exe = $connection->query($updateesop);
            if($exe)
            {
                $selectesop = "SELECT * FROM `esop` WHERE `uniqueid` = '".$uniqueid."'";
                $exeesop = $connection->query($selectesop);
                $getesopnum = trim($exeesop->numRows());
                if($getesopnum>0)
                {
                    while($rowesop = $exeesop->fetch())
                    {
                        $queryselectcmp = ' SELECT * FROM `listedcmpmodule` WHERE `company_name` = "'.$rowesop['cmp_name'].'" ';
                        
                        $queryselectpan = " SELECT * FROM `personal_info` WHERE `pan` = '".$rowesop['emp_pan']."' ";
                        //echo $queryselectpan;exit;
                        $exegetcmp = $connection->query($queryselectcmp);
                        $getnumcmp = trim($exegetcmp->numRows());
                        
                        $exegetpan = $connection->query($queryselectpan);
                        $getnumpan = trim($exegetpan->numRows());
                        if($getnumcmp>0 && $getnumpan>0)
                        {
                          while($rowcmp = $exegetcmp->fetch())
                          {
                              $getcmpid[] = $rowcmp['id'];
                          }
                          while($rowpan = $exegetpan->fetch())
                          {
                              $getpanuserid[] = $rowpan['userid'];
                          }
                            $noofshares[] = $rowesop['emp_shares'];
                        }
                        //print_r($getcmpid);
                    }
                    $getlist = array('logged'=>true,'cmpid'=>$getcmpid,'panusrid'=>$getpanuserid,'shares'=>$noofshares);
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
    
    public function inupintosummary($data,$user_group_id)
    {
        $connection = $this->dbtrd;
        $time = time();
        //print_r($data);exit;
        for($i = 0;$i <sizeof($data['cmpid']);$i++)
        {
            $selectopengblnc = "SELECT * FROM `opening_balance` WHERE `id_of_company` = '".$data['cmpid'][$i]."' AND `user_id` = '".$data['panusrid'][$i]."'";
            
            $exeopengblnc = $connection->query($selectopengblnc);
            $getopengblnc = trim($exeopengblnc->numRows());
            if($getopengblnc>0)
            {
                while($rowopengblnc = $exeopengblnc->fetch())
                {
                    $totesop = $rowopengblnc['esop']+$data['shares'][$i];
                    $queryinup = "UPDATE `opening_balance` SET `esop`='".$totesop."',`date_modified`=NOW(),`timeago`='".$time."' WHERE `id_of_company` = '".$data['cmpid'][$i]."' AND `user_id` = '".$data['panusrid'][$i]."'";
                }
                
            }
            else
            {
                $queryinup = "INSERT INTO `opening_balance`(`user_id`,`user_group_id`,`id_of_company`,`esop`,`equityshare`,`prefershare`,`debntrshare`,`sectype`,`from`,`date_added`, `date_modified`,`timeago`)VALUES ('".$data['panusrid'][$i]."','".$user_group_id."','".$data['cmpid'][$i]."','".$data['shares'][$i]."',0,0,0,1,'notrequest',NOW(),NOW(),'".$time."')";
                
            }
            $exe = $connection->query($queryinup);
        }
        if($exe)
        {
            return true;
        }
        else
        {
            return false;
        }
    }


    public function getcount($getuserid,$user_group_id,$uniqueid)
    {
        $connection = $this->dbtrd;
        $time = time();
        $getcmpid = array(); 
        $getpanuserid = array(); 
        $noofshares = array(); 
        
        //echo $updateesop;exit;
        try
        {
           
                $selectesop = "SELECT * FROM `esop` WHERE `uniqueid` = '".$uniqueid."'";
                $exeesop = $connection->query($selectesop);
                $getesopnum = trim($exeesop->numRows());
                if($getesopnum>0)
                {
                    while($rowesop = $exeesop->fetch())
                    {
                        $rowcmp[] = $rowesop['cmp_name'];
                        $rowpan[] = $rowesop['emp_pan'];
                    }
                    $cmp = implode("','", $rowcmp);
                    $pan = implode("','", $rowpan);

                       
                $queryselectpan = " SELECT * FROM `personal_info` WHERE `pan` IN('$pan') ";

                
                $exegetpan = $connection->query($queryselectpan);
                $getnumpan = trim($exegetpan->numRows());
                 
                if($getnumpan>0)
                {
                   
                    while($rowpan = $exegetpan->fetch())
                {
                    $getpanuserid[] = $rowpan['userid'];
                    $count =  $getnumpan;
                }
                         
                }
                       
                    $getlist = $count;
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





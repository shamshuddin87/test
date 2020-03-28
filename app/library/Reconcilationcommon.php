<?php
use Phalcon\Mvc\User\Component;
class Reconcilationcommon extends Component
{
  public function insertreconcilation($getuserid,$user_group_id,$reconciArray,$stmnttill,$uniqueid)
  {
      $connection = $this->dbtrd;
      $time = time();
      $queryinsert = 'INSERT INTO `reconcilation`
        (`user_id`,`user_group_id`,`uniqueid`,`panno`,`script`,`holding`,`dateofreconcilition`,`date_added`, `date_modified`,`timeago`)
         VALUES ("'.$getuserid.'","'.$user_group_id.'","'.$uniqueid.'","'.$reconciArray['panno'].'","'.$reconciArray['company'].'","'.$reconciArray['holding'].'","'.$stmnttill.'",NOW(),NOW(),"'.$time.'")';
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
    
    public function fetchreconcilation($getuserid,$user_group_id,$query)
    {
        $connection = $this->dbtrd;
        try
        {
            $grpusrs = $this->insidercommon->getGroupUsers($getuserid,$user_group_id);
            
            $queryselect = "SELECT * FROM `reconcilation` WHERE 
                `user_id` IN (".$grpusrs['ulstring'].") 
                GROUP BY `uniqueid` ORDER BY `dateofreconcilition` DESC " .$query;
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
    
    public function fetchreconcilationforview($getuserid,$user_group_id,$uniqueid,$query)
    {
        $connection = $this->dbtrd;
        $getpanlist = array();
        try
        {
            
            $queryselect = "SELECT re.*,pinfo.`userid` AS personusername ,rinfo.`name` as relativename,rel.`relationshipname` AS relationship,rinfo.`user_id` AS relativeusername FROM reconcilation re
                            LEFT JOIN `personal_info` pinfo ON pinfo.`pan` = re.`panno`
                            LEFT JOIN `relative_info` rinfo ON rinfo.`pan` = re.`panno`
                            LEFT JOIN `relationship` rel ON rel.`id` = rinfo.`relationship`
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
    
    public function fetchequityshare($getuserid,$user_group_id,$uniqueid,$dateofrecon)
    {
        $connection = $this->dbtrd;
        try
        {
            $queryselect = " SELECT re.*,pinfo.`userid` AS personid ,rinfo.id AS relativeid  FROM `reconcilation` re
                             LEFT JOIN `personal_info` pinfo ON pinfo.`pan` = re.`panno` 
                             LEFT JOIN `relative_info` rinfo ON rinfo.`pan` = re.`panno`
                             WHERE re.`uniqueid` = '".$uniqueid."'";
           
            $exeget = $connection->query($queryselect);
            $getnum = trim($exeget->numRows());
            if($getnum>0)
                {
                    while($row = $exeget->fetch())
                    {
                        $queryselectcmp = ' SELECT * FROM `listedcmpmodule` WHERE `company_name` = "'.$row['script'].'" ';
                        $exegetcmp = $connection->query($queryselectcmp);
                        $getnumcmp = trim($exegetcmp->numRows());
                        if($getnumcmp>0)
                        {
                          while($rowcmp = $exegetcmp->fetch())
                          {
                              if(empty($row['personid'])) //for relative
                              {
                                  $shareofequity = 0;
                                  $querytrade = "SELECT * FROM `personal_request` WHERE `relative_id` = '".$row['relativeid']."' AND `id_of_company` = '".$rowcmp['id']."' AND `trading_status` = 1 AND `sectype` = 1 ";
                                  $exetrade = $connection->query($querytrade);
                                  $gettrade = trim($exetrade->numRows());
                                  if($gettrade>0)
                                  {
                                      while($rowtrade = $exetrade->fetch())
                                      {
                                          
                                          $querytradests = "SELECT * FROM `trading_status` WHERE `req_id` = '".$rowtrade['id']."' AND `date_of_transaction`<= '".$dateofrecon."'";
                                          $exetradests = $connection->query($querytradests);
                                          $gettradests = trim($exetradests->numRows());
                                          if($gettradests>0)
                                          {
                                              while($rowtradests = $exetradests->fetch())
                                              {
                                                $shareofequity =  $shareofequity + $rowtradests['no_of_share'];
                                                
                                              }
                                          }
                                          else
                                          {
                                              $shareofequity = 0;
                                          }
                                      }
                                  }
                                  else
                                  {
                                      $shareofequity = 0;
                                  }
                                  $queryclsblnc = "SELECT * FROM `opening_balance` WHERE `user_id` = '".$row['personid']."' AND `id_of_company` = '".$rowcmp['id']."'";
                                  $execlsblnc = $connection->query($queryclsblnc);
                                  $getclsblnc = trim($execlsblnc->numRows());
                                  if($getclsblnc > 0)
                                  {
                                      while($rowclsblnc = $execlsblnc->fetch())
                                      {
                                         $shareofequity =  $shareofequity + $rowclsblnc['equityshare'];
                                      }
                                  }
                                  else
                                  {
                                      
                                  }
                                  $getlist[] = $shareofequity;
                              }
                              else  //for person
                              {
                                  $shareofequity = 0;
                                  $querytrade = "SELECT * FROM `personal_request` WHERE `user_id` = '".$row['personid']."' AND `relative_id` = '' AND `id_of_company` = '".$rowcmp['id']."' AND `trading_status` = 1 AND `sectype` = 1 ";
                                  //echo $querytrade;
                                  $exetrade = $connection->query($querytrade);
                                  $gettrade = trim($exetrade->numRows());
                                  if($gettrade>0)
                                  {
                                      while($rowtrade = $exetrade->fetch())
                                      {
                                          
                                          $querytradests = "SELECT * FROM `trading_status` WHERE `req_id` = '".$rowtrade['id']."' AND `date_of_transaction`<= '".$dateofrecon."'";
                                          $exetradests = $connection->query($querytradests);
                                          $gettradests = trim($exetradests->numRows());
                                          if($gettradests>0)
                                          {
                                              while($rowtradests = $exetradests->fetch())
                                              {
                                                $shareofequity =  $shareofequity + $rowtradests['no_of_share']; 
                                                
                                              }
                                          }
                                          else
                                          {
                                              $shareofequity = 0;
                                          }
                                      }
                                      
                                  }
                                  else
                                  {
                                      $shareofequity = 0;
                                  }
                                  $queryclsblnc = "SELECT * FROM `opening_balance` WHERE `user_id` = '".$row['personid']."' AND `id_of_company` = '".$rowcmp['id']."'";
                                  $execlsblnc = $connection->query($queryclsblnc);
                                  $getclsblnc = trim($execlsblnc->numRows());
                                  if($getclsblnc > 0)
                                  {
                                      while($rowclsblnc = $execlsblnc->fetch())
                                      {
                                         $shareofequity =  $shareofequity + $rowclsblnc['equityshare'];
                                      }
                                  }
                                  else
                                  {
                                      
                                  }
                                  $getlist[] = $shareofequity;
                              }
                             
                            }
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
    
    public function fetchpanusr()
    {
        $connection = $this->dbtrd;
        try
        {
                $querygetpanper = " SELECT pinfo.pan AS panno,memb.fullname AS username FROM `personal_info` pinfo LEFT JOIN `it_memberlist` memb ON pinfo.`userid` = memb.`wr_id` ";

                $querygetpanrel = "SELECT rinfo.pan AS panno,rinfo.name AS relativename,rel.`relationshipname` AS relationship,memb.fullname AS username FROM `relative_info` rinfo LEFT JOIN `it_memberlist` memb ON rinfo.`user_id` = memb.`wr_id` LEFT JOIN `relationship` rel ON rel.`id` = rinfo.`relationship` ";
                $exegetpanper = $connection->query($querygetpanper);
                $exegetpanrel = $connection->query($querygetpanrel);
                $getpanper = trim($exegetpanper->numRows());
                $getpanrel = trim($exegetpanrel->numRows());
                if($getpanper>0)
                {
                  while($rowpanper = $exegetpanper->fetch())
                  {
                      $panusrlist[] = $rowpanper;
                  }
                }
                else
                {
                    $panusrlist = array();
                }
                if($getpanrel>0)
                {
                  while($rowpanrel = $exegetpanrel->fetch())
                  {
                      $panusrlist[] = $rowpanrel;
                  }
                }
                else
                {
                    $panusrlist = array();
                }

        }
        catch (Exception $e)
        {
            $panusrlist = array();
            //$connection->close();
        }
        return $panusrlist;
        
    }
}





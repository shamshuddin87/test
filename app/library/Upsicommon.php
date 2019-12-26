<?php
use Phalcon\Mvc\User\Component;

class Upsicommon extends Component
{

    public function addupsi($getuserid,$usergroup,$data)
    {
        //print_r($data);exit;
        $connection = $this->dbtrd;
        $userdata = $this->fetchuserdata($getuserid);
        $addedby = $userdata[0]['fullname'];
        $time=time();
        $toalldps = 0;
        $connctdps = '';
        //print_r($data);exit;
//        if(array_key_exists("alldps", $data))
//        {
//            $cmpname = $this->insidercommon->getcompanydetailofuser($getuserid);
//            if($usergroup == 14)
//            {
//                $cmpname = array_shift($cmpname);
//            }
//            $connctalldps = $this->upsicommon->fetchalldpusr($getuserid,$usergroup,$cmpname['id'],'all','');
//            foreach($connctalldps as $val)
//            {
//                $connectdps[] = $val['wr_id'];
//            }
//            //print_r($connectdps);exit;
//            $connctdps = implode(',',$connectdps);
//            $toalldps = 1;
//        }
//        else
//        {
//           if(array_key_exists("connectdps", $data))
//           {
//                $connctdps = implode(',',$data['connectdps']);
//           } 
//        }
        /* Get Mail id of below user id*/
        $ownerid = explode(',',$data['ownerid']);
        //$condp = explode(',',$connctdps);
        //print_r($ownerid);exit;
        $userids = $ownerid;
        
        //print_r($data);exit;
        $sqlquery = "INSERT INTO `upsimaster`(`user_id`,`user_group_id`,`upsitype`,`projstartdate`,`projectowner`,`projdescriptn`,`date_added`,`date_modified`,`timeago`) 
        VALUES ('".$getuserid."','".$usergroup."','".$data['upname']."','".$data['pstartdte']."','".$data['ownerid']."','".$data['projdesc']."',NOW(),NOW(),'".$time."')"; 

        //echo $sqlquery; exit;
        try
        {
            $exesql = $connection->query($sqlquery);
            if($exesql)
            {
                $data['nameaddedby'] = $addedby;
                $result = $this->upsicommon->mailfortradingwindow($getuserid,$usergroup,$userids,$data);
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

    public function getallupsi($getuserid,$usergroup,$mainqry)
    {
        $connection = $this->dbtrd;
        $sqlquery = "SELECT upsi.*,memb.`fullname` FROM `upsimaster` upsi 
                    LEFT JOIN `it_memberlist` memb ON memb.`wr_id` = upsi.`projectowner`
                    WHERE (upsi.user_id='".$getuserid."' OR FIND_IN_SET('".$getuserid."',upsi.`projectowner`)
                    OR FIND_IN_SET('".$getuserid."',upsi.`connecteddps`)) ".$mainqry; 
         //print_r($sqlquery);exit;
        
        try
        {
            $exeget = $connection->query($sqlquery);
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

    public function getsingleupsi($id)
    {

        $connection = $this->dbtrd;
        $sqlquery = "SELECT upsi.*,memb.`fullname` FROM `upsimaster` upsi 
                    LEFT JOIN `it_memberlist` memb ON memb.`wr_id` = upsi.`projectowner`
                    WHERE upsi.`id`= '".$id."'"; 

        //echo $sqlquery; exit;
        try
        {
            $exeget = $connection->query($sqlquery);
            $getnum = trim($exeget->numRows());
            if($getnum>0)
            {
                while($row = $exeget->fetch())
                {
                   $getlist = $row;                     
                }
            }
            else
            {   $getlist = array(); }
        }
        catch (Exception $e)
        {   $getlist = array(); }
        //echo '<pre>';print_r($getlist);exit;
        return $getlist;
    }

    public function updateupsi($getuserid,$usergroup,$updatedata)
    {
        //print_r($updatedata);exit;
        $connection = $this->dbtrd;
        $userdata = $this->fetchuserdata($getuserid);
        $addedby = $userdata[0]['fullname'];
        $time=time();
        $toalldps = 0;
        $connctdps = '';
        if(array_key_exists("upalldps", $updatedata))
        {
//            $cmpname = $this->insidercommon->getcompanydetailofuser($getuserid);
//            if($usergroup!=2)
//            {
//                $cmpname = array_shift($cmpname);
//            }
            $connctalldps = $this->upsicommon->fetchalldpusr($getuserid,$usergroup,'all','');
            foreach($connctalldps as $val)
            {
                $connectdps[] = $val['wr_id'];
            }
            //print_r($connectdps);exit;
            $connctdps = implode(',',$connectdps);
            $toalldps = 1;
        }
        else
        {
           if(array_key_exists("connectdps", $updatedata))
           {
                $connctdps = implode(',',$updatedata['connectdps']);
           } 
        }
        $sqlquery = "UPDATE `upsimaster` SET  `upsitype`='".$updatedata['upname']."',`toalldps`='".$toalldps."',`projstartdate`='".$updatedata['pstartdte']."',`enddate`='".$updatedata['enddate']."',`projectowner`='".$updatedata['ownerid']."',`projdescriptn`='".$updatedata['projdesc']."',`connecteddps`='".$connctdps."',`date_modified`=NOW(),`timeago`='".$time."'
         WHERE `id`='".$updatedata['editid']."'"; 
        //echo $sqlquery;exit; `companyid`='".$updatedata['cmpid']."',
        try
        {
            $exesql = $connection->query($sqlquery);
            //$exesql = 'rdgd';
            if($exesql)
            {  
                $updatedata['nameaddedby'] = $addedby;
                $datadiffrnt = $this->upsicommon->chckifdatadiff($getuserid,$usergroup,$updatedata);
                return true;   
            }
            else
            {   return false;    }
        }
        
        catch (Exception $e)
        {
//            print_r($e);
//            echo 'in catch';exit;
            return false; 
        }


    }

    public function deleteupsi($id)
    {
        $connection = $this->dbtrd;
        $sqlquery="DELETE FROM `upsimaster` WHERE id='".$id."'";
        // print_r($sqlquery);exit;
        try
        {
            $exesql = $connection->query($sqlquery);
            if($exesql)
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
    
    public function fetchalldpusr($uid,$usergroup,$typof,$getsearchkywo)
    {
        $connection = $this->dbtrd;
        $masteruserdata = $this->insidercommon->getGroupUsers($uid,$usergroup);
        //print_r($masteruserdata);exit;
        if($typof == 'all')
        {
            $sqlquery = "SELECT * FROM `it_memberlist` WHERE `user_id` IN (".$masteruserdata['ulstring'].") AND `status`=1 ORDER BY fullname";
        }
        else if($typof == 'one')
        {
            $sqlquery = "SELECT * FROM `it_memberlist` WHERE `user_id` IN (".$masteruserdata['ulstring'].") AND `status`=1 AND `fullname` LIKE '%{$getsearchkywo}%'";
        }
       //echo $sqlquery;exit;
        
        try
        {
            $exeget = $connection->query($sqlquery);
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
    
    public function mailfortradingwindow($getuserid,$user_group_id,$userids,$data)
    {
        //print_r($data);exit;
        $uniuserid = array_unique($userids);
        $uniuserid = array_values($uniuserid);
        $unquser = implode(',',$uniuserid);
        $userdata = $this->fetchuserdata($unquser);
//        $cmpid = $data['cmpid'];
//        $cmpname = $this->fetchcmpname($cmpid);
        for($i=0;$i<sizeof($userdata);$i++)
        {
            $sendtoid = $userdata[$i]['wr_id'];                        
            $sendtoname = $userdata[$i]['fullname'];
            $emailid = $userdata[$i]['email'];
            $enddate = '';
            if(array_key_exists("enddate", $data))
            {
                $enddate = $data['enddate'];
            }
            $pstartdate = $data['pstartdte'];
            $todaydate = date('d-m-Y');
            // ----- Start InsertDataInAutomailer -----
            $qtypeid = '5'; //-- refer email_queuetype table
            $infodata = array('upsitype'=>$data['upname'],'enddate'=>$enddate,'nameaddedby'=>$data['nameaddedby'],'emaildate'=>$todaydate,'projectstart'=>$pstartdate);
            $result = $this->automailercommon->insertemailqueue($getuserid,$user_group_id,$qtypeid,$sendtoid,$emailid,$sendtoname,$infodata);
            // ----- End InsertDataInAutomailer -----
        }
        //print_r($cntin.'*'.sizeof($getdata)); exit;
        if($result==true)
        {
            return true;
        }
        else
        {   
            return false;
        } 
            
    }
    
    public function fetchuserdata($userids)
    {
        $connection = $this->dbtrd;
        $querysql = "SELECT * FROM `it_memberlist` WHERE `wr_id` IN (".$userids.") AND `status` = 1";
        $exeget = $connection->query($querysql);
        $getnum = trim($exeget->numRows());
        try
        {
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
        return $getlist;
    }
    
    public function chckifdatadiff($getuserid,$usergroup,$updatedata)
    {
        $userids = '';
        if(array_key_exists("upalldps", $updatedata))
        {
//            $cmpname = $this->insidercommon->getcompanydetailofuser($getuserid);
//            if($usergroup!=2)
//            {
//                $cmpname = array_shift($cmpname);
//            }
            $connctalldps = $this->upsicommon->fetchalldpusr($getuserid,$usergroup,'all','');
            foreach($connctalldps as $val)
            {
                $connectdps[] = $val['wr_id'];
            }
            $userids = $connectdps;
        }
        else
        {
            $connctdps = implode(',',$updatedata['connectdps']);
            $flag = 0;
            $chngein = 'all';
            if(strcasecmp($updatedata['cmpupname'], $updatedata['upname']) !=0)
            {
                $flag = 1;
            }
            if(strcasecmp($updatedata['cmppstartdte'], $updatedata['pstartdte']) !=0)
            {
                $flag = 1;
            }
            if(strcasecmp($updatedata['cmpenddate'], $updatedata['enddate']) !=0)
            {
                $flag = 1;
            }
            if(strcasecmp($updatedata['ownerid'], $updatedata['cmpownerid']) !=0)
            {
                $flag = 1;
            }
            if(strcasecmp($connctdps, $updatedata['cmpconnectdps']) !=0)
            {
                $chngein = 'users';
                $flag = 1;
            }
            if($flag == 1)
            {
                if($chngein == 'users')
                {
                    $ownerid = explode(',',$updatedata['ownerid']);
                    $condp = explode(',',$connctdps);
                    $userids1 = array_merge($ownerid, $condp);

                    $owneridcmp = explode(',',$updatedata['cmpownerid']);
                    $connctdpscmp = explode(',',$updatedata['cmpconnectdps']);
                    $userids2 = array_merge($owneridcmp, $connctdpscmp);

                    $userids = array_diff($userids1,$userids2);
                }
                else
                {
                    $ownerid = explode(',',$updatedata['ownerid']);
                    $condp = explode(',',$connctdps);
                    $userids = array_merge($ownerid, $condp);
                }
            }
        }
        if($userids)
        {
            $result = $this->upsicommon->mailfortradingwindow($getuserid,$usergroup,$userids,$updatedata);
        }
        
    }
    
    public function fetchdpuser($dpuser)
    {
        $connection = $this->dbtrd;
        $sqlquery = "SELECT * FROM `it_memberlist` WHERE `wr_id` IN (".$dpuser.") AND `status`=1 ";
        try
        {
            $exeget = $connection->query($sqlquery);
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
            {   $getlist = array(); }
        }
        catch (Exception $e)
        {   $getlist = array(); }
        //echo '<pre>';print_r($getlist);exit;
        return $getlist;
    }
    
    public function fetchcmpname($cmpid)
    {
        $connection = $this->dbtrd;
        $sqlquery = "SELECT * FROM `companylist` WHERE `id`='".$cmpid."'";
        try
        {
            $exeget = $connection->query($sqlquery);
            $getnum = trim($exeget->numRows());
            if($getnum>0)
            {
                 while($row = $exeget->fetch())
                {
                    $getlist[] = $row;                     
                }
            }
            else
            {   $getlist = ''; }
        }
        catch (Exception $e)
        {   $getlist = ''; }
        //echo '<pre>';print_r($getlist);exit;
        return $getlist;
    }

    public function sendannouncement($newarr,$upsiname,$projstartdate,$enddate,$description,$sentby)
    {
        $getuserid = $this->session->loginauthspuserfront['id'];
        $cin = $this->session->memberdoccin;
        $user_group_id = $this->session->loginauthspuserfront['user_group_id'];

        $newarr=implode(",",$newarr);
        $connection = $this->dbtrd;
        $sqlquery = "SELECT `email`,`cmpaccess`,`wr_id`,`fullname` FROM `it_memberlist` WHERE `wr_id` IN (".$newarr.")";
        // print_r($sqlquery);exit;
        try
        {
            $exeget = $connection->query($sqlquery);
            $getnum = trim($exeget->numRows());
            if($getnum>0)
            {
                 while($row = $exeget->fetch())
                {
               
                    $getlist[]= $row;              
                }   
                
                $flag=false;
                for($i=0;$i<sizeof($getlist);$i++)
                {
                     // print_r($getlist);exit;
                     $cmpaccess=explode(",",$getlist[$i]['cmpaccess']);
                     $email=$getlist[$i]['email'];
                     $fullname=$getlist[$i]['fullname'];
                     $sentid= $getlist[$i]['wr_id'];
                     // print_r($email);exit;
                     // $send=$this->emailer->upsiannouncementmail($cmpaccess,$email,$upsiname,$projstartdate,$enddate,$description,$sentby);
                      $insertarr=array("cmpaccess"=>$cmpaccess,"upsiname"=>$upsiname,"projstartdate"=>$projstartdate,"enddate"=>$enddate,"description"=>$description,"sentby"=>$sentby);

                        $result = $this->automailercommon->insertemailqueue($getuserid,$user_group_id,8,$sentid,$email,$fullname,$insertarr);


                      if($result==true)
                    {
                        $flag=true;
                    }
                }


                if($flag==true)
                {
                    return true;
                }
                else
                { 
                    return false;
                }
            }
            else
            {   return false; }
        }
        catch (Exception $e)
        {   return false; }
      



    }

  
}
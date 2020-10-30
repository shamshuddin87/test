<?php
use Phalcon\Mvc\User\Component;

class Upsicommon extends Component
{

    public function addupsi($getuserid,$usergroup,$data)
    {
        //print_r($data);exit;
        $connection = $this->dbtrd;
        $userdata = $this->fetchuserdata($getuserid);
        $todaydate = date('d-m-Y');
        $unixTimestamp = strtotime($todaydate);
 
      
        $dayOfWeek = date("l", $unixTimestamp);
 
       
        $addedby = $userdata[0]['fullname'];
        $addedbyemail = $userdata[0]['email'];
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
        $sqlquery = 'INSERT INTO `upsimaster`(`user_id`,`user_group_id`,`upsitype`,`projstartdate`,`projectowner`,`projdescriptn`,`date_added`,`date_modified`,`timeago`) 
        VALUES ("'.$getuserid.'","'.$usergroup.'","'.$data['upname'].'","'.$data['pstartdte'].'","'.$data['ownerid'].'","'.$data['projdesc'].'",NOW(),NOW(),"'.$time.'")'; 

        //echo $sqlquery; exit;
        try
        {
            $exesql = $connection->query($sqlquery);
            if($exesql)
            {
                $data['nameaddedby'] = $addedby;
                $result = $this->upsicommon->mailfortradingwindow($getuserid,$usergroup,$userids,$data);
                $notifymail =$this->emailer->notifyupsi($addedby,$addedbyemail,$data,$todaydate,$dayOfWeek);
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
        $sqlquery = "SELECT upsi.*,memb.`fullname`,memb.`email` FROM `upsimaster` upsi 
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

     public function getsingleupsidetail($id)
    {

        $connection = $this->dbtrd;
        $sqlquery = "SELECT upsi.*,memb.`fullname`,memb.`email` FROM `upsimaster` upsi 
                    LEFT JOIN `it_memberlist` memb ON memb.`wr_id` = upsi.`user_id`
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

    public function updateupsi($getuserid,$usergroup,$updatedata,$exceldpids,$username)
    {
        //print_r($updatedata);exit;
        $connection = $this->dbtrd;
        $userdata = $this->fetchuserdata($getuserid);
        $addedby = $userdata[0]['fullname'];
        $time=time();
        $toalldps = 0;
        $connctdps = '';
        $excelcondps = '';
        //print_r($updatedata);exit;
        if(array_key_exists("upalldps", $updatedata))
        {
//            $cmpname = $this->insidercommon->getcompanydetailofuser($getuserid);
//            if($usergroup!=2)
//            {
//                $cmpname = array_shift($cmpname);
//            }
            $connctalldps = $this->upsicommon->fetchalldpusr($getuserid,$usergroup,'all','');
            //print_r($connctalldps);echo "hello";exit;
            foreach($connctalldps as $val)
            {
                $connectdps[] = $val['wr_id'];
            }
            //print_r($connectdps);exit;
            $connctdps = implode(',',$connectdps);
            $toalldps = 1;
        }
        else if(array_key_exists("connectdps", $updatedata))
        {
            $connctdps = implode(',',$updatedata['connectdps']);
        }
        if(!empty($exceldpids))
        {
            
            $excelcondps = implode(',',$exceldpids['getres']);
            
            //print_r($updatedata);exit;
            
        }
       
        //print_r($excelcondps);exit;
        if(!empty($connctdps) && !empty($excelcondps))
        {
            $connctdps.= ','.$excelcondps;
            $updatedata['exceldp'] = $excelcondps;
            
        }
        else if(!$connctdps && !empty($excelcondps))
        {
            $connctdps = $excelcondps;
            $updatedata['exceldp'] = $excelcondps;
        }
        //print_r($exceldpids);exit;
        $sqlquery = 'UPDATE `upsimaster` SET  `upsitype`="'.$updatedata['upname'].'",`toalldps`="'.$toalldps.'",`projstartdate`="'.$updatedata['pstartdte'].'",`enddate`="'.$updatedata['enddate'].'",`projectowner`="'.$updatedata['ownerid'].'",`projdescriptn`="'.$updatedata['projdesc'].'",`connecteddps`="'.$connctdps.'",`date_modified`=NOW(),`timeago`="'.$time.'"
         WHERE `id`="'.$updatedata['editid'].'"'; 
        //echo $sqlquery;exit; 
        try
        {
            $exesql = $connection->query($sqlquery);
            //$exesql = 'rdgd';
            if($exesql)
            {  
                $updatedata['nameaddedby'] = $addedby;
                $datadiffrnt = $this->upsicommon->chckifdatadiff($getuserid,$usergroup,$updatedata,$username,$updatedata['editid']);
                //print_r($datadiffrnt);exit;
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
        //print_r($uniuserid);exit;
        $uniuserid = array_values($uniuserid);
        
        $unquser = implode(',',$uniuserid);
        //print_r($unquser);exit;
        $userdata = $this->fetchuserdata($unquser);
        //print_r($userdata);exit;
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


    public function mailfortradingwindowedit($getuserid,$user_group_id,$userdp,$data,$username,$ownerid,$upsiid)
    {
        //print_r($data);exit;
        $uniuserid = array_unique($userdp);
        //print_r($uniuserid);exit;
        $uniuserid = array_values($uniuserid);
        
        $unquser = implode(',',$uniuserid);
        //print_r($unquser);exit;
        $userdatadp = $this->fetchuserdata($unquser);

        $ownerdata = $this->fetchuserdata($ownerid);
        $owneremail =  $ownerdata[0]['email'];
        $ownerfullname = $ownerdata[0]['fullname'];
        for($i=0;$i<sizeof($userdatadp);$i++)
        {
                              
            $sendtoname[] = $userdatadp[$i]['fullname'];
           
        }
        $dpnames = implode(",", $sendtoname);
        
 
        
        $upsiinfo = $this->upsicommon->getsingleupsidetail($upsiid);
        //print_r($upsiinfo);exit;
        $complianceinfo = $this->sensitiveinformationcommon->compliancedetails(); // CO Officer
            foreach ($complianceinfo as $c) 
            {
                $sendmail1[] = $c['email'];
                $sendmailname[] = $c['fullname'];
            }
           // print_r($sendmail1);exit;

        array_push($sendmail1,$owneremail);
        array_push($sendmailname,$ownerfullname); // to send mail to projec owner and co officer
        
        $uniquemail1 = array_unique($sendmail1);
        $uniquemailname = array_unique($sendmailname);
        //print_r($sendmailname);exit;



        for($i=0;$i<sizeof($uniquemail1);$i++)
        {
           
            $email = $uniquemail1[$i];
            $enddate = '';
            //print_r($data);exit;
            if(array_key_exists("enddate", $data))
            {
                $enddate = $data['enddate'];
            }
            $pstartdate = $data['pstartdte'];
            $todaydate = date('d-m-Y');
           
            
            $result = $this->emailer->mailofType1($email,$todaydate,$data['upname'],$upsiinfo,$dpnames,$uniquemailname[$i]);
           
           
           
        }
        
        //mail for dp users
        for($i=0;$i<sizeof($userdatadp);$i++)
        {
          
            $enddate = '';
            //print_r($data);exit;
            if(array_key_exists("enddate", $data))
            {
                $enddate = $data['enddate'];
            }
            $pstartdate = $data['pstartdte'];
            $todaydate = date('d-m-Y');

          // ----- Start InsertDataInAutomailer -----
          $qtypeid = '6'; //-- refer email_queuetype table

          $infodata = array('upsitype'=>$data['upname'],'ownername'=>$ownerfullname,'emaildate'=>$todaydate,'projectstart'=>$pstartdate,'date_added'=>$upsiinfo['date_added']);
          $result1 = $this->automailercommon->insertemailqueue($getuserid,$user_group_id,$qtypeid,$userdatadp[$i]['id'],$userdatadp[$i]['email'],$userdatadp[$i]['fullname'],$infodata);

          // ----- End InsertDataInAutomailer -----
        }
        


         // mail Type One:
        
        //print_r($cntin.'*'.sizeof($getdata)); exit;
        if($result == true)
        {
            return true;
        }
        else
        {   
            return false;
        } 
            
    }

    public function mailfortradingwindoweditexcel($getuserid,$user_group_id,$userdp,$data,$username,$ownerid,$upsiid)
    {
        //print_r($data);exit;
        $uniuserid = array_unique($userdp);
        //print_r($uniuserid);exit;
        $uniuserid = array_values($uniuserid);
        
        $unquser = implode(',',$uniuserid);
        //print_r($unquser);exit;
        $userdatadp = $this->fetchuserdata($unquser); //designated person

        $ownerdata = $this->fetchuserdata($ownerid); //owner person
        $owneremail =  $ownerdata[0]['email'];
        $ownerfullname = $ownerdata[0]['fullname'];
        //print_r($userdatadp);exit;
        for($i=0;$i<sizeof($userdatadp);$i++)
        {
                              
            $sendtoname[] = $userdatadp[$i]['fullname'];
           
        }
        $dpnames = implode(",", $sendtoname);
        
 
        
        $upsiinfo = $this->upsicommon->getsingleupsidetail($upsiid);  //upsiinfo
        //print_r($upsiinfo);exit;
        $complianceinfo = $this->sensitiveinformationcommon->compliancedetails(); // CO Officer
            foreach ($complianceinfo as $c) 
            {
                $sendmail1[] = $c['email'];
                $sendmailname[] = $c['fullname'];
            }
           // print_r($sendmail1);exit;

        array_push($sendmail1,$owneremail);
        array_push($sendmailname,$ownerfullname); // to send mail to projec owner and co officer
        
        $uniquemail1 = array_unique($sendmail1);
        $uniquemailname = array_unique($sendmailname);
        //print_r($sendmailname);exit;



        for($i=0;$i<sizeof($uniquemail1);$i++)
        {
           
            $email = $uniquemail1[$i];
            $enddate = '';
            //print_r($data);exit;
            if(array_key_exists("enddate", $data))
            {
                $enddate = $data['enddate'];
            }
            $pstartdate = $data['pstartdte'];
            $todaydate = date('d-m-Y');

            
            $result = $this->emailer->mailofType1($email,$todaydate,$data['upname'],$upsiinfo,$dpnames,$uniquemailname[$i]);
           
           
        }
        
        //mail for dp users
        for($i=0;$i<sizeof($userdatadp);$i++)
        {
          
            $enddate = '';
            //print_r($data);exit;
            if(array_key_exists("enddate", $data))
            {
                $enddate = $data['enddate'];
            }
            $pstartdate = $data['pstartdte'];
            $todaydate = date('d-m-Y');

          // ----- Start InsertDataInAutomailer -----
          $qtypeid = '6'; //-- refer email_queuetype table

          $infodata = array('upsitype'=>$data['upname'],'ownername'=>$ownerfullname,'emaildate'=>$todaydate,'projectstart'=>$pstartdate,'date_added'=>$upsiinfo['date_added']);
          $result1 = $this->automailercommon->insertemailqueue($getuserid,$user_group_id,$qtypeid,$userdatadp[$i]['id'],$userdatadp[$i]['email'],$userdatadp[$i]['fullname'],$infodata);

          // ----- End InsertDataInAutomailer -----
        }
        

         // mail Type One:
        
        //print_r($cntin.'*'.sizeof($getdata)); exit;
        if($result == true)
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
    
    public function chckifdatadiff($getuserid,$usergroup,$updatedata,$username,$upsiid)
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
            //print_r($userids );exit;
        }
        else
        {
          //echo "else";exit;

            $flag = 0;

            $chngein = 'all';
            
            //print_r($updatedata);exit;  //when both connect and excel
            if(array_key_exists("connectdps",$updatedata) && array_key_exists("exceldp",$updatedata) )
            {
                //print_r($updatedata);exit;

                $connctdps = implode(',',$updatedata['connectdps']);
                $exceldp = $updatedata['exceldp'];
                $connctdps.= ','.$exceldp;

                //print_r($connctdps);exit;

                if(strcasecmp($connctdps, $updatedata['cmpconnectdps']) !=0)
                 { 
                    $chngein = 'excelusers';
                
                   $flag = 1;
                 }
                
            }
            else if(array_key_exists("connectdps",$updatedata))
            {
                //print_r($updatedata);exit;

                $connctdps = implode(',',$updatedata['connectdps']);

                //print_r($connctdps);exit;

                if(strcasecmp($connctdps, $updatedata['cmpconnectdps']) !=0 || array_key_exists("exceldp",$updatedata))
                 { 
                    $chngein = 'users';
                
                   $flag = 1;
                 }
                
            }
            else if(array_key_exists("exceldp",$updatedata))
            {
                //echo "hello";exit;
                $connctdps = $updatedata['exceldp'];
                if(strcasecmp($connctdps, $updatedata['cmpconnectdps']) !=0)
                 { 
                    $chngein = 'excelusers';
                
                   $flag = 1;
                 }
            }
            else
            { 
                      $connctdps ='';
            }
          
          
            // if(strcasecmp($updatedata['cmpupname'], $updatedata['upname']) !=0)
             
            // {

            //     $flag = 1;
            // }
            // if(strcasecmp($updatedata['cmppstartdte'], $updatedata['pstartdte']) !=0)
            // {
            //     $flag = 1;
            // }
            // if(strcasecmp($updatedata['cmpenddate'], $updatedata['enddate']) !=0)
            // {

            //     $flag = 1;

            // }
            if(strcasecmp($updatedata['ownerid'], $updatedata['cmpownerid']) !=0)
            {
                //print_r($updatedata);exit;
                //$flag = 1;
                $ownerid = $updatedata['ownerid'];
            }
            else
            {    

                 $ownerid = $updatedata['cmpownerid'];
            }
           
            if($flag == 1)
            {

                if($chngein == 'users')
                {

                    
                    $condp = explode(',',$connctdps); // all connected dps in array(convert in array)
                    
                    $connctdpscmp = explode(',',$updatedata['cmpconnectdps']); //old dps

                    //Excel Users
                     
                    //print_r($updatedata);exit;
                    //print_r( $connctdpscmp  );


                    $useriddp = array_diff($condp,$connctdpscmp);

                    if($useriddp)
                    {
            
                    $result = $this->upsicommon->mailfortradingwindowedit($getuserid,$usergroup,$useriddp,$updatedata,$username,$ownerid,$upsiid);
                    return $result;
                    }
                      //print_r($useriddp);echo "hello";exit;
                }
                if($chngein == 'excelusers')
                {

                    
                    $condp = explode(',',$connctdps); // all connected dps in array(convert in array)
                    
                    $connctdpscmp = explode(',',$updatedata['cmpconnectdps']); //old dps

                    //Excel Users
                     
                    //print_r($updatedata);exit;
                    //print_r( $connctdpscmp  );


                    $useriddp = array_diff($condp,$connctdpscmp);
                    //print_r($useriddp);exit;

                    if($useriddp)
                    {
            
                     $result = $this->upsicommon->mailfortradingwindoweditexcel($getuserid,$usergroup,$useriddp,$updatedata,$username,$ownerid,$upsiid);
                     return $result;
                    }
                      //print_r($useriddp);echo "hello";exit;
                }
                
                else
                {
                    //$ownerid = explode(',',$updatedata['ownerid']);
                    //$condp = explode(',',$connctdps);
                    //$useriddp = array_merge($ownerid, $condp);
                }
            }
        }
       
        
    }
    
    public function fetchdpuser($dpuser)
    {
        $connection = $this->dbtrd;
        $sqlquery = "SELECT * FROM `it_memberlist` WHERE `wr_id` IN (".$dpuser.") AND `status`=1 ORDER BY FIELD(`wr_id`, ".$dpuser.")";
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

    public function Fetchusersid($getuserid,$user_group_id,$EmailData)
    {
        $connection = $this->dbtrd;
        //$emailid = implode("','",$EmailData['emailid']);
        $emailid = $EmailData['emailid'];
           
        $emailid = implode("','", $emailid);

        $sqlquery = "SELECT * FROM `it_memberlist` WHERE `email` IN('".$emailid."')  AND `status`=1 ";
        //print_r($sqlquery);exit;
        try
        {
            $exeget = $connection->query($sqlquery);
            $getnum = trim($exeget->numRows());
            if($getnum>0)
            {
                while($row = $exeget->fetch())
                {
                    $getlist[] = $row['wr_id'];                     
                }
                 return $getlist;
            }
            else
            {   return false; }
        }
        catch (Exception $e)
        {   $getlist = false;  }
         
       
    }
  
}
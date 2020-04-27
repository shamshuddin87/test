<?php
use Phalcon\Mvc\User\Component;
class Sebicommon extends Component
{
    /*--------------------------- form b section start ---------------------------*/
    /******** fetch name mobile of usr start *******/
    public function fetchdetailsofuser($getuserid)
    {
        $connection = $this->dbtrd;
        try
        {
            $queryget = "SELECT *  FROM `it_memberlist` WHERE `wr_id`='".$getuserid."'";

            $exeget = $connection->query($queryget);
            $getnum = trim($exeget->numRows());

            if($getnum>0)
            {
                while($row = $exeget->fetch())
                {
                    $getlist = $row;
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
    /******** fetch name mobile of usr end *******/
    
     /******** fetch pan address of usr start *******/
    public function fetchuserdata($getuserid)
    {
        $connection = $this->dbtrd;
        try
        {
            $queryget = "SELECT *  FROM `personal_info` WHERE `userid`='".$getuserid."'";
            //echo $queryget;exit;
            $exeget = $connection->query($queryget);
            $getnum = trim($exeget->numRows());

            if($getnum>0)
            {
                while($row = $exeget->fetch())
                {
                    $getlist = $row;
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
    /******** fetch pan address of usr end *******/
    
    /******** fetch category start *******/
    public function fetchcategory()
    {
        $connection = $this->dbtrd;
        try
        {
            $queryget = "SELECT *  FROM `sebiformb_category` ";
            //echo $queryget;exit;
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
    /******** fetch category end *******/
    
     /******** fetch security type start *******/
    public function fetchsecutype()
    {
        $connection = $this->dbtrd;
        try
        {
            $queryget = "SELECT *  FROM `sebiformb_security` ";
            //echo $queryget;exit;
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
    /******** fetch security type end *******/
    
    /******** fetch cmp name from master start *******/
    public function fetchcmpmstr($getuserid,$user_group_id)
    {
        $connection = $this->dbtrd;
        try
        {
            $grpusrs = $this->insidercommon->getGroupUsers($getuserid,$user_group_id);
            $queryget = "SELECT *  FROM `companylist` WHERE `addedby` IN (".$grpusrs['ulstring'].")";
            //echo $queryget;exit;
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
    /******** fetch cmp name from master end *******/
    
    /******* insert formb data start********/
    public function insertformb($getuserid,$user_group_id,$approverid,$cin,$category,$date,$cmpnme,$security,$shrsecuno,$wrntsecuno,$debntrsecuno,$shrhldng,$futureunitnum,$futurentnlvlue,$optionunitnum,$optionntnlvlue)
    {
        $connection = $this->dbtrd;
        $time = time();
        $securitype= implode(',',$security);
           $queryinsert = "INSERT INTO `sebiformb_usrdata` (`user_id`,`user_group_id`,`approverid`,`cin`,`category`, `appntdate`,`companyid`, `securitytype`, `shresec`,`wrntsec`,`debsecu`, `sharehldng`, `futureunit`, `futurevalue`, `optionunit`,`optionvalue`,`date_added`, `date_modified`,`timeago`)
         VALUES ('".$getuserid."','".$user_group_id."','".$approverid."','".$cin."','".$category."','".$date."','".$cmpnme."','".$securitype."','".$shrsecuno."','".$wrntsecuno."','".$debntrsecuno."','".$shrhldng."','".$futureunitnum."','".$futurentnlvlue."','".$optionunitnum."','".$optionntnlvlue."',NOW(),NOW(),'".$time."')"; 
        //print_r($queryinsert);exit;
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
    /******* insert formb data end********/
    
    // ****** formb data fetch for table **********
    public function fetchformbdata($getuserid,$user_group_id,$query)
    {
       $connection = $this->dbtrd;
        try
         {
            
            $queryget = "SELECT formb.*,memb.`designation` FROM `sebiformb_usrdata` formb
                        LEFT JOIN `it_memberlist` memb ON memb.`wr_id` = formb.`user_id`
                        WHERE formb.`user_id`= '".$getuserid."' ORDER BY ID DESC ".$query; 
          
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
    // ****** formb data fetch for table **********
    
    /******* send for approval formb start ********/
    public function sendforapprvlformb($getuserid,$user_group_id,$formbid)
    {
        $connection = $this->dbtrd;
        $time = time();
        $todate=date('d-m-Y');
           $queryinsert = "UPDATE `sebiformb_usrdata` SET `send_status`=1,send_date='".$todate."',`date_modified`=NOW(),`timeago`='".$time."'
         WHERE `id`='".$formbid."'"; 
        //print_r($queryinsert);exit;
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
    /******* send for approval formb end ********/
    
    /******* get content of html document start*********/
    public function getdocucontent($getuserid,$user_group_id,$docid)
    {
        $connection = $this->dbtrd;
        $exegetgeo = "SELECT * FROM `sebiform_url` WHERE `doc_id` ='".$docid."'";
        //echo $exegetgeo;
          try {
                $exeget = $connection->query($exegetgeo);
                $getnum = trim($exeget->numRows());
                if($getnum!=0)
                {
                    $row = $exeget->fetch();
                    $rowfile = @file_get_contents($row['documentpath'],true);
                    //print_r($rowfile);exit;
                    $content = $rowfile;
                }
                else{
                    $content = array();
                }

            }
            catch (Exception $e) {
                $content = array();
            }
                    //echo "<pre>";print_r($garray);exit;
        return $content;
    }
    /******* get content of html document end *********/
    
    /******* get content of html document start*********/
    public function getformdata($getuserid,$user_group_id,$formbid)
    {
        $connection = $this->dbtrd;
        $queryget = "SELECT formb.*,memb.fullname,memb.mobile,pinfo.pan,pinfo.address,cate.category,cmp.companyname FROM `sebiformb_usrdata` formb LEFT JOIN `it_memberlist` memb ON memb.`wr_id` = formb.`user_id`
        LEFT JOIN  `personal_info` pinfo ON pinfo.userid = formb.`user_id`
        LEFT JOIN `sebiformb_category` cate ON cate.id = formb.category
        LEFT JOIN `companylist` cmp ON cmp.id = formb.companyid
        WHERE formb.`id`='".$formbid."'";
        //echo $queryget;exit;
        try{
          $exeget = $connection->query($queryget);
            $getnum = trim($exeget->numRows());

            if($getnum>0)
            {
                while($row = $exeget->fetch())
                {
                    $sectyp = explode(',',$row['securitytype']);
                    for($i = 0;$i<sizeof($sectyp);$i++)
                    {
                        $querysecu = "SELECT * FROM `sebiformb_security` WHERE `id` = '".$sectyp[$i]."'";
                        $exegetsecu = $connection->query($querysecu);
                        $getnumsecu = trim($exegetsecu->numRows());
                        if($getnumsecu>0)
                        {
                           while($rowsecu = $exegetsecu->fetch())
                           {
                               $getsecutye[] = $rowsecu['securitytype'];
                           }
                        }
                    }
                    $getlistdata = $row;
                }
                $getlist = array('data'=>$getlistdata,'securitytype'=>$getsecutye);
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
    /******* get content of html document end *********/
    
     // ****** formb data fetch for edit **********
    public function fetchformbedit($getuserid,$user_group_id,$id)
    {
       $connection = $this->dbtrd;
        try
         {
            
            $queryget = "SELECT formb.*,memb.`designation` FROM `sebiformb_usrdata` formb
                        LEFT JOIN `it_memberlist` memb ON memb.`wr_id` = formb.`user_id`
                        WHERE formb.`id`= '".$id."' "; 
          
            //echo $queryget;  exit;
            $exeget = $connection->query($queryget);
            $getnum = trim($exeget->numRows());

            if($getnum>0)
            {
                while($row = $exeget->fetch())
                {
                    $getlist = $row;
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
    // ****** formb data fetch for edit **********
    
    /******* update formb data start********/
    public function updateformb($getuserid,$user_group_id,$cin,$category,$date,$cmpnme,$security,$shrsecuno,$wrntsecuno,$debntrsecuno,$shrhldng,$futureunitnum,$futurentnlvlue,$optionunitnum,$optionntnlvlue,$upformbid)
    {
        $connection = $this->dbtrd; 
        $time = time();
        $securitype= implode(',',$security);
           $queryinsert = "UPDATE `sebiformb_usrdata` SET `cin`='".$cin."',`category`='".$category."', `appntdate`='".$date."', `companyid`='".$cmpnme."', `securitytype`='".$securitype."', `shresec`='".$shrsecuno."',`wrntsec`='".$wrntsecuno."',`debsecu`='".$debntrsecuno."', `sharehldng`='".$shrhldng."', `futureunit`='".$futureunitnum."', `futurevalue`='".$futurentnlvlue."', `optionunit`='".$optionunitnum."',`optionvalue`='".$optionntnlvlue."', `date_modified`=NOW(),`timeago`='".$time."' WHERE `id`='".$upformbid."'"; 
        //print_r($queryinsert);exit;
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
    /******* update formb data end********/
    
    public function insertpdfpath($pdfpath,$formbid)
    {
        $connection = $this->dbtrd; 
        $time = time();
        $todate=date('d-m-Y');
           $queryinsert = "UPDATE `sebiformb_usrdata` SET `draft`='".$pdfpath."',`date_modified`=NOW(),`timeago`='".$time."'
         WHERE `id`='".$formbid."'"; 
        //print_r($queryinsert);exit;
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
    
    public function fetchformbdataforaprvl($uid,$usergroup,$query)
    {
        $connection = $this->dbtrd;
            if($usergroup!=2)
            {
                $queryget = "SELECT formb.*,memb.`designation`,memb.`fullname`,memb.`mobile`,pinfo.`address`,pinfo.`pan`,cate.`category` FROM `sebiformb_usrdata` formb
                LEFT JOIN `it_memberlist` memb ON memb.`wr_id` = formb.`user_id`
                LEFT JOIN `personal_info` pinfo ON pinfo.`userid` = formb.`user_id`
                LEFT JOIN `sebiformb_category` cate ON cate.`id` = formb.`category`  
                WHERE (formb.`send_status`='1')  AND FIND_IN_SET('".$uid."',formb.`approverid`)".$query;
            }
            else
            {
                $allusers=$this->tradingrequestcommon->getalluserformain($uid);
                $allusers= implode(",",$allusers);

                $queryget = "SELECT formb.*,memb.`designation`,memb.`fullname`,memb.`mobile`,pinfo.`address`,pinfo.`pan`,cate.`category` FROM `sebiformb_usrdata` formb
                LEFT JOIN `it_memberlist` memb ON memb.`wr_id` = formb.`user_id`
                LEFT JOIN `personal_info` pinfo ON pinfo.`userid` = formb.`user_id`
                LEFT JOIN `sebiformb_category` cate ON cate.`id` = formb.`category` 
                WHERE (formb.`send_status`='1') AND formb.`user_id` IN(".$allusers.")".$query;
            }

              //echo $queryget;  exit;

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
    
     /******* approve formb start ********/
    public function apprvrqst($getuserid,$user_group_id,$formbid,$pdfurl)
    {
        $connection = $this->dbtrd; 
        $time = time();
           $queryinsert = "UPDATE `sebiformb_usrdata` SET `approvestatus`=1,`final`='".$pdfurl."',`date_modified`=NOW(),`timeago`='".$time."'
         WHERE `id`='".$formbid."'"; 
        //print_r($queryinsert);exit;
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
    /******* approve formb end ********/
    public function sendemailformb($formbid)
    {
        $getusrdetail = $this->fetchemailofusr($formbid);
        $maildetailarray = array(
                            'fullname'=>$getusrdetail['maildata'][0]['fullname'],
                            'designation'=>$getusrdetail['maildata'][0]['designation'],
                            'pan'=>$getusrdetail['maildata'][0]['pan']
                            );
            for($i = 0;$i<sizeof($getusrdetail['emailid']);$i++)
            {
                $result = $this->emailer->mailformbapprvlrqst($maildetailarray,$getusrdetail['emailid'][$i]);
            }
            //print_r($result);exit;
            if($result['logged']==true)
            {
                $results = array('status'=>true, 'mg'=>'Send Successfully');
            }
            else
            {   
                $results = array('status'=>false, 'mg'=>'Request not Sent');  

            }
        return $results;
    }
    
    public function fetchemailofusr($formbid)
    {
        $connection = $this->dbtrd;
        try
        {
            $queryget= "SELECT formb.`user_id`, formb.`approverid`, formb.`appntdate`, 
                memb.`fullname`, memb.`designation`,
                pinfo.`pan` 
                FROM `sebiformb_usrdata` formb
                LEFT JOIN `it_memberlist` memb ON memb.`wr_id` = formb.user_id
                LEFT JOIN `personal_info` pinfo ON pinfo.`userid` = formb.user_id
                WHERE formb.`id`='".$formbid."' ";
            //echo "<pre>"; print_r($queryget); exit;     
            
                $exeget = $connection->query($queryget);
                $getnum = trim($exeget->numRows());

                if($getnum>0)
                {
                    while($row = $exeget->fetch())
                    {
                        $approverid = explode(",",$row['approverid']);
                        $getmaildata[] = $row;
                    }
                   for($i = 0;$i<sizeof($approverid);$i++)
                    {
                        $querygetemail = "SELECT `email` FROM `it_memberlist` WHERE `wr_id` = '".$approverid[$i]."' ";
                        $exegetemail = $connection->query($querygetemail);
                        $getnumemail = trim($exegetemail->numRows());
                        if($getnumemail>0)
                        {
                            while($rowemail = $exegetemail->fetch())
                            {
                                $getapproveremail[] = $rowemail['email'];
                            }
                        }
                    }
                    $getadminemail = $this->tradingplancommon->getadminmailid($approverid[0]);
                    array_push($getapproveremail,$getadminemail);
                    $getlist = array('maildata'=>$getmaildata,'emailid'=>$getapproveremail);
                    //print_r($getlist);exit;

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
    
    
    /*------ send mail after approve ---------*/
    public function sendemailformbaprv($formbid)
    {
        $getusrdetail = $this->fetchemailofusraprv($formbid);
        //print_r($getusrdetail);exit;
        $maildetailarray = array(
                            'date'=>$getusrdetail['maildata'][0]['appntdate'],
                            'category'=>$getusrdetail['maildata'][0]['catrgry'],
                            'email'=>$getusrdetail['maildata'][0]['email']
                            );
           
        $result = $this->emailer->mailformbackrqst($maildetailarray);
            
            //print_r($result);exit;
            if($result['logged']==true)
            {
                $results = array('status'=>true, 'mg'=>'Send Successfully');
            }
            else
            {   
                $results = array('status'=>false, 'mg'=>'Request not Sent');  

            }
        return $results;
    }
    
    public function fetchemailofusraprv($formbid)
    {
        $connection = $this->dbtrd;
        try
        {
            $queryget= "SELECT formb.`user_id`, formb.`approverid`, formb.`appntdate`,
                memb.`fullname`, memb.`designation`, memb.email, 
                pinfo.`pan`, cate.category AS catrgry 
                FROM  `sebiformb_usrdata` formb
                LEFT JOIN `it_memberlist` memb ON memb.`wr_id` = formb.user_id
                LEFT JOIN `personal_info` pinfo ON pinfo.`userid` = formb.user_id
                LEFT JOIN `sebiformb_category` cate ON cate.id = formb.category
                WHERE formb.`id`='".$formbid."' ";
            //print_r($queryget); exit;
            
                $exeget = $connection->query($queryget);
                $getnum = trim($exeget->numRows());

                if($getnum>0)
                {
                    while($row = $exeget->fetch())
                    {
                        
                        $getmaildata[] = $row;
                    }
                   
                    $getlist = array('maildata'=>$getmaildata);
                    //print_r($getlist);exit;

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
    /*------ send mail after approve ---------*/
    
    /*--------------------------- form b section end ---------------------------*/
    
    /*--------------------------- form c section start ---------------------------*/
    /**********  fetch latest data of formb start ***********/
    public function getformbdata($getuserid)
    {
        $connection = $this->dbtrd;
        try
         {
            $queryget = "SELECT  formb.*,memb.`fullname`,memb.`designation`,memb.`mobile`,pinfo.`pan`,pinfo.`address` FROM `sebiformb_usrdata` formb LEFT JOIN `it_memberlist` memb ON memb.`wr_id` = formb.user_id
            LEFT JOIN `personal_info` pinfo ON pinfo.`userid` = formb.user_id
            ORDER BY ID DESC LIMIT 1";
            //echo $queryget;  exit;
            $exeget = $connection->query($queryget);
            $getnum = trim($exeget->numRows());

            if($getnum>0)
            {
                while($row = $exeget->fetch())
                {
                    $getlist = $row;
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
        //print_r($getlist);exit;
        return $getlist; 
        
    } 
    /**********  fetch latest data of formb end ***********/
    
    /**********  fetch mode data of formc start ***********/
    public function getformcmode()
    {
        $connection = $this->dbtrd;
        try
         {
            $queryget = "SELECT * FROM `sebiformc_mode`";
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
        //print_r($getlist);exit;
        return $getlist; 
        
    }
    /**********  fetch mode data of formc end ***********/
    
    /******* insert form c data start********/
    public function insertformc($getuserid,$user_group_id,$formcdata,$formcids,$appvrid,$category,$cin)
    {
        //print_r($appvrid);exit;
        $time = time();
        $connection = $this->dbtrd; 
        for($i = 0;$i<sizeof($formcdata);$i++)
        {
            $openingblnc = '';
            $querygetdata = "SELECT * FROM `sebiformc_usrdata` WHERE user_id='".$getuserid."' AND `companyid`='".$formcdata[$i]['id_of_company']."'  ORDER BY ID DESC LIMIT 1";

            $exegetdata = $connection->query($querygetdata);
            $getnumdata = trim($exegetdata->numRows());
            if($getnumdata>0)
            {
                while($rowdata = $exegetdata->fetch())
                {
                    $openingblnc = $rowdata['clsblnc'];
                }
            }
            if(in_array($formcdata[$i]['id'],$formcids))
            {
                $tradests = 1;
            }
            else
            {
                $tradests = 0;
            }
            if(empty($openingblnc))
            {
               $queryget ="SELECT * FROM `opening_balance` WHERE `id_of_company` = '".$formcdata[$i]['id_of_company']."' AND `user_id`= '".$getuserid."' AND `sectype`='".$formcdata[$i]['sectype']."'";
                //echo $queryget;exit;
                $exeget = $connection->query($queryget);
                $getnum = trim($exeget->numRows());

                if($getnum>0)
                {
                    while($row = $exeget->fetch())
                    {
                        if($formcdata[$i]['sectype'] == '1')
                        {
                           $openingblnc = $row['equityshare'];
                        }
                        else if($formcdata[$i]['sectype'] == '2')
                        {
                            $openingblnc = $row['prefershare'];
                        }
                        else if($formcdata[$i]['sectype'] == '3')
                        {
                            $openingblnc = $row['debntrshare'];
                        }else{ $openingblnc = 0;}
                    }
                }else{
                    $openingblnc = 0;
                }
            }
            else {$openingblnc = $openingblnc;}
            $queryusrdata = "SELECT * FROM `sebiformc_usrdata` WHERE `tradeid` = '".$formcdata[$i]['id']."'";
            $exegetusrdta = $connection->query($queryusrdata);
            $getnumdta = trim($exegetusrdta->numRows());
            if($getnumdta>0)
            {
                $queryinsert = "UPDATE `sebiformc_usrdata` SET `filestatus` = '".$tradests."',`date_modified`=NOW(),`timeago`='".$time."' WHERE `tradeid`='".$formcdata[$i]['id']."'";
                $exeprev = $connection->query($queryinsert);
            }
            else
            {
                $totalamnt = $formcdata[$i]['total_amount'];
                $clngblnc = $openingblnc+$totalamnt;
                $queryinsert = "INSERT INTO `sebiformc_usrdata` (`user_id`,`user_group_id`,`tradeid`,`approverid`,`cin`,`category`, `companyid`,`acquimode`,`fromdate`, `todate`, `sectype`, `pretrans`,`posttrans`,`dateofintimtn`,`buyvalue`, `buynumbrunt`, `sellvalue`, `sellnumbrunt`,`exetrd`,`opngblnc`,`totalamnt`,`clsblnc`,`filestatus`,`date_added`, `date_modified`,`timeago`)
                 VALUES ('".$getuserid."','".$user_group_id."','".$formcdata[$i]['id']."','".$appvrid."','".$cin."','".$category."','".$formcdata[$i]['id_of_company']."','','".$formcdata[$i]['date_of_transaction']."','".$formcdata[$i]['date_of_transaction']."','".$formcdata[$i]['sectype']."','','',NULL,'','','','','','".$openingblnc."','".$totalamnt."','".$clngblnc."','".$tradests."',NOW(),NOW(),'".$time."')"; 
                // print_r($queryinsert);exit;
                $exeprev = $connection->query($queryinsert);
             }
         }
        
        try
        {
            return true;
        }
        catch (Exception $e) 
        {
            //echo "checkng Exception";print_r($e);exit;
            return false;
        }
    }
    /******* insert form c data end********/
    
    // ****** form c data fetch for table **********
    public function fetchformcdata($getuserid,$user_group_id,$query)
    {
       $connection = $this->dbtrd;
        try
         {
            
            $queryget = "SELECT formc.*,memb.`designation`,cmp.`company_name` FROM `sebiformc_usrdata` formc
                        LEFT JOIN `listedcmpmodule` cmp ON cmp.`id` = formc.`companyid`
                        LEFT JOIN `it_memberlist` memb ON memb.`wr_id` = formc.`user_id`
                        WHERE formc.`user_id`= '".$getuserid."' AND formc.`filestatus` = '1' ORDER BY ID DESC".$query; 
          
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
    // ****** form c data fetch for table **********
    
    // ****** form c data fetch for edit **********
    public function fetchformcedit($getuserid,$user_group_id,$id)
    {
       $connection = $this->dbtrd;
        try
         {
            
            $queryget = "SELECT formc.*,memb.`designation` FROM `sebiformc_usrdata` formc
                        LEFT JOIN `it_memberlist` memb ON memb.`wr_id` = formc.`user_id`
                        WHERE formc.`id`=  '".$id."' "; 
          
            //echo $queryget;  exit;
            $exeget = $connection->query($queryget);
            $getnum = trim($exeget->numRows());

            if($getnum>0)
            {
                while($row = $exeget->fetch())
                {
                    $getlist = $row;
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
    // ****** form c data fetch for edit **********
    
    /******* get content of html document start*********/
    public function getformcdata($getuserid,$user_group_id,$formcid)
    {
        $connection = $this->dbtrd;
        $queryget = "SELECT formc.*,memb.`fullname`,memb.`mobile`,tr.`req_id`,pr.`place`,pr.`no_of_shares`,pinfo.`pan`,pinfo.`address`,cate.`category`,cmp.`company_name`,formmode.`acquisitionmode` AS acquistnmode ,pinfo.`adrshldng`,sc.`pershare` 
         FROM `sebiformc_usrdata` formc 
         LEFT JOIN `it_memberlist` memb ON memb.`wr_id` = formc.`user_id` 
         LEFT JOIN `personal_info` pinfo ON pinfo.`userid` = formc.`user_id` 
         LEFT JOIN `sebiformb_category` cate ON cate.`id` = formc.`category` 
         LEFT JOIN `listedcmpmodule` cmp ON cmp.`id` = formc.`companyid` 
         LEFT JOIN `sebiformc_mode` formmode ON formmode.`id` = formc.`acquimode`
         LEFT JOIN `trading_status` tr ON tr.`id` = formc.`tradeid`
         LEFT JOIN personal_request pr ON pr.`id` = tr.`req_id`
          LEFT JOIN sharecapital sc ON sc.`user_id` = pinfo.`userid`
         WHERE formc.`id`='".$formcid."'";
        //echo $queryget;exit;
        try{
          $exeget = $connection->query($queryget);
            $getnum = trim($exeget->numRows());

            if($getnum>0)
            {
                while($row = $exeget->fetch())
                {
                    $getlistdata = $row;
                }
                $getlist = array('data'=>$getlistdata);
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
    /******* get content of html document end *********/
    
    /******* update form c data start********/
    public function updateformc($getuserid,$user_group_id,$formcupdata)
    {
        $connection = $this->dbtrd; 
        $time = time();
           $queryinsert = "UPDATE `sebiformc_usrdata` SET `cin`='".$formcupdata['cin']."',`category`='".$formcupdata['category']."', `fromdate`='".$formcupdata['fromdate']."', `todate`='".$formcupdata['todate']."', `pretrans`='".$formcupdata['pretrans']."', `posttrans`='".$formcupdata['posttrans']."', `dateofintimtn`='".$formcupdata['dateofintimtn']."', `acquimode`='".$formcupdata['acquimode']."',`buyvalue`='".$formcupdata['buyvalue']."',`buynumbrunt`='".$formcupdata['buynumbrunt']."',`sellvalue`='".$formcupdata['sellvalue']."',`sellnumbrunt`='".$formcupdata['sellnumbrunt']."',`exetrd`='".$formcupdata['exetrd']."', `date_modified`=NOW(),`timeago`='".$time."' WHERE `id`='".$formcupdata['upformcid']."'"; 
        //print_r($queryinsert);exit;
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
    /******* update form c data end********/
    
    /******* send for approval formb start ********/
    public function sendforapprvlformc($getuserid,$user_group_id,$formcid)
    {
        $connection = $this->dbtrd; 
        $time = time();
        $todate=date('d-m-Y');
           $queryinsert = "UPDATE `sebiformc_usrdata` SET `send_status`='1',send_date='".$todate."',`date_modified`=NOW(),`timeago`='".$time."'
         WHERE `id`='".$formcid."'"; 
        // print_r($queryinsert);exit;
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
    /******* send for approval formb end ********/
    
    // ********* fetch form c data on view of apprvr table start *******
    public function fetchformcdataforaprvl($uid,$usergroup,$query)
    {
        $connection = $this->dbtrd;
            if($usergroup!=2)
            {
                $queryget = "SELECT formc.*,memb.`designation`,memb.`fullname`,memb.`mobile`,pinfo.`address`,pinfo.`pan`,cate.`category` 
                FROM `sebiformc_usrdata` formc LEFT JOIN `it_memberlist` memb ON memb.`wr_id` = formc.`user_id` 
                LEFT JOIN `personal_info` pinfo ON pinfo.`userid` = formc.`user_id` 
                LEFT JOIN `sebiformb_category` cate ON cate.`id` = formc.`category`
                WHERE (formc.`send_status`='1') AND FIND_IN_SET('".$uid."',formc.`approverid`)".$query;
            }
            else
            {
                $allusers=$this->tradingrequestcommon->getalluserformain($uid);
                $allusers= implode(",",$allusers);

                $queryget = "SELECT formc.*,memb.`designation`,memb.`fullname`,memb.`mobile`,pinfo.`address`,pinfo.`pan`,cate.`category` 
                FROM `sebiformc_usrdata` formc LEFT JOIN `it_memberlist` memb ON memb.`wr_id` = formc.`user_id` 
                LEFT JOIN `personal_info` pinfo ON pinfo.`userid` = formc.`user_id` 
                LEFT JOIN `sebiformb_category` cate ON cate.`id` = formc.`category`
                WHERE (formc.`send_status`='1') AND formc.`user_id` IN(".$allusers.")".$query;
            }

               //echo $queryget;  exit;

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
    // ********* fetch form c data on view of apprvr table end *******



      // ********* fetch form c data for export table start *******
    public function fetchformcdataforexport($uid,$usergroup,$rowid)
    {
        $connection = $this->dbtrd;
       
       

        if(!empty($rowid))
        {

             if($usergroup!=2)
            {

                $queryget = "SELECT formc.*,memb.`designation`,memb.`fullname`,memb.`mobile`,pinfo.`address`,pinfo.`pan`,cate.`category` 
                FROM `sebiformc_usrdata` formc LEFT JOIN `it_memberlist` memb ON memb.`wr_id` = formc.`user_id` 
                LEFT JOIN `personal_info` pinfo ON pinfo.`userid` = formc.`user_id` 
                LEFT JOIN `sebiformb_category` cate ON cate.`id` = formc.`category`
                WHERE (formc.`send_status`='1') AND FIND_IN_SET('".$uid."',formc.`approverid`) AND formc.`id` IN(".$rowid.")";
                
            }
            else
            {
               
                $allusers=$this->tradingrequestcommon->getalluserformain($uid);
                $allusers= implode(",",$allusers);

                $queryget = "SELECT formc.*,memb.`designation`,memb.`fullname`,memb.`mobile`,pinfo.`address`,pinfo.`pan`,cate.`category` 
                FROM `sebiformc_usrdata` formc LEFT JOIN `it_memberlist` memb ON memb.`wr_id` = formc.`user_id` 
                LEFT JOIN `personal_info` pinfo ON pinfo.`userid` = formc.`user_id` 
                LEFT JOIN `sebiformb_category` cate ON cate.`id` = formc.`category`
                WHERE (formc.`send_status`='1') AND formc.`user_id` IN(".$allusers.") AND formc.`id` IN(".$rowid.")";
            }
        }
        else
        {

              if($usergroup!=2)
            {
                $queryget = "SELECT formc.*,memb.`designation`,memb.`fullname`,memb.`mobile`,pinfo.`address`,pinfo.`pan`,cate.`category` 
                FROM `sebiformc_usrdata` formc LEFT JOIN `it_memberlist` memb ON memb.`wr_id` = formc.`user_id` 
                LEFT JOIN `personal_info` pinfo ON pinfo.`userid` = formc.`user_id` 
                LEFT JOIN `sebiformb_category` cate ON cate.`id` = formc.`category`
                WHERE (formc.`send_status`='1') AND FIND_IN_SET('".$uid."',formc.`approverid`)";
            }
            else
            {
                  
                $allusers=$this->tradingrequestcommon->getalluserformain($uid);
                $allusers= implode(",",$allusers);

                $queryget = "SELECT formc.*,memb.`designation`,memb.`fullname`,memb.`mobile`,pinfo.`address`,pinfo.`pan`,cate.`category` 
                FROM `sebiformc_usrdata` formc LEFT JOIN `it_memberlist` memb ON memb.`wr_id` = formc.`user_id` 
                LEFT JOIN `personal_info` pinfo ON pinfo.`userid` = formc.`user_id` 
                LEFT JOIN `sebiformb_category` cate ON cate.`id` = formc.`category`
                WHERE (formc.`send_status`='1') AND formc.`user_id` IN(".$allusers.")";
            }

           

              
        }

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
    // ********* fetch form c data for export table end *******

    
    public function insertpdfpathformc($pdfpath,$formcid)
    {
        $connection = $this->dbtrd; 
        $time = time();
        $todate=date('d-m-Y');
           $queryinsert = "UPDATE `sebiformc_usrdata` SET `draft`='".$pdfpath."',`date_modified`=NOW(),`timeago`='".$time."'
         WHERE `id`='".$formcid."'"; 
        //print_r($queryinsert);exit;
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
    
    /******* approve form c start ********/
    public function apprvrqstformc($getuserid,$user_group_id,$formcid,$pdfurl)
    {
        $connection = $this->dbtrd; 
        $time = time();
           $queryinsert = "UPDATE `sebiformc_usrdata` SET `approvestatus`=1,`final`='".$pdfurl."',`date_modified`=NOW(),`timeago`='".$time."'
         WHERE `id`='".$formcid."'"; 
        //print_r($queryinsert);exit;
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
    /******* approve form c end ********/
    public function sendemailformc($formcid)
    {
        $getusrdetail = $this->fetchemailofusrformc($formcid);
        $maildetailarray = array(
                            'fullname'=>$getusrdetail['maildata'][0]['fullname'],
                            'designation'=>$getusrdetail['maildata'][0]['designation'],
                            'pan'=>$getusrdetail['maildata'][0]['pan']
                            );
            for($i = 0;$i<sizeof($getusrdetail['emailid']);$i++)
            {
                $result = $this->emailer->mailformcapprvlrqst($maildetailarray,$getusrdetail['emailid'][$i]);
            }
            //print_r($result);exit;
            if($result['logged']==true)
            {
               return true;
            }
            else
            {   
               return false; 

            }
        // return $results;
    }
    
    public function fetchemailofusrformc($formcid)
    {
        $connection = $this->dbtrd;
        try
        {
            $queryget= "SELECT formc.`user_id`, formc.`approverid`, 
                memb.`fullname`,memb.`designation`,pinfo.`pan` 
                FROM `sebiformc_usrdata` formc
                LEFT JOIN `it_memberlist` memb ON memb.`wr_id` = formc.`user_id`
                LEFT JOIN `personal_info` pinfo ON pinfo.`userid` = formc.`user_id`
                WHERE formc.`id`='".$formcid."' ";
            //echo $queryget; exit;
            
                $exeget = $connection->query($queryget);
                $getnum = trim($exeget->numRows());

                if($getnum>0)
                {
                    while($row = $exeget->fetch())
                    {
                        $approverid = explode(",",$row['approverid']);
                        $getmaildata[] = $row;
                    }
                   for($i = 0;$i<sizeof($approverid);$i++)
                    {
                        $querygetemail = "SELECT email FROM `it_memberlist` WHERE `wr_id` = '".$approverid[$i]."' ";
                        $exegetemail = $connection->query($querygetemail);
                        $getnumemail = trim($exegetemail->numRows());
                        if($getnumemail>0)
                        {
                            while($rowemail = $exegetemail->fetch())
                            {
                                $getapproveremail[] = $rowemail['email'];
                            }
                        }
                    }
                    $getadminemail = $this->tradingplancommon->getadminmailid($approverid[0]);
                    array_push($getapproveremail,$getadminemail);
                    $getlist = array('maildata'=>$getmaildata,'emailid'=>$getapproveremail);
                    //print_r($getlist);exit;

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
    
    /*------ send mail after approve ---------*/
    public function sendemailformcaprv($formcid)
    {
        $getusrdetail = $this->fetchemailofusrcaprv($formcid);
        $maildetailarray = array(
                            'fromdate'=>$getusrdetail['maildata'][0]['fromdate'],
                            'todate'=>$getusrdetail['maildata'][0]['todate'],
                            'category'=>$getusrdetail['maildata'][0]['catrgry'],
                            'email'=>$getusrdetail['maildata'][0]['email']
                            );
           
        $result = $this->emailer->mailformcackrqst($maildetailarray);
            
            //print_r($result);exit;
            if($result['logged']==true)
            {
                $results = array('status'=>true, 'mg'=>'Send Successfully');
            }
            else
            {   
                $results = array('status'=>false, 'mg'=>'Request not Sent');  

            }
        return $results;
    }
    
    public function fetchemailofusrcaprv($formcid)
    {
        $connection = $this->dbtrd;
        try
        {
            $queryget= "SELECT formc.*,memb.`fullname`,memb.`designation`,pinfo.`pan`,memb.email,cate.category AS catrgry FROM  `sebiformc_usrdata` formc
                        LEFT JOIN `it_memberlist` memb ON memb.`wr_id` = formc.user_id
                        LEFT JOIN `personal_info` pinfo ON pinfo.`userid` = formc.user_id
                        LEFT JOIN `sebiformb_category` cate ON cate.id = formc.category
                        WHERE formc.`id`='".$formcid."' ";
                //echo $queryget;exit;
                $exeget = $connection->query($queryget);
                $getnum = trim($exeget->numRows());

                if($getnum>0)
                {
                    while($row = $exeget->fetch())
                    {
                        
                        $getmaildata[] = $row;
                    }
                   
                    $getlist = array('maildata'=>$getmaildata);
                    //print_r($getlist);exit;

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
    /*------ send mail after approve ---------*/
    
    public function fetchformctransdata($getuserid,$user_group_id,$finstrtdte,$finenddte,$getcomp,$query)
    {
        $getnumrow = array();
        $getdata = array();
        
        $connection = $this->dbtrd;
        try
         {
            for($i = 0;$i<sizeof($getcomp);$i++)
            {
                $totalamnt = 0;
                    $queryget = "SELECT ts.*,cmp.`company_name`,secu.`security_type`,trans.`transaction` FROM `trading_status` ts
                    LEFT JOIN `listedcmpmodule` cmp ON cmp.`id` = ts.`id_of_company`
                    LEFT JOIN `req_securitytype` secu ON secu.`id` = ts.`sectype`
                    LEFT JOIN `personal_request` pr ON pr.`id` = ts.`req_id`
                    LEFT JOIN `type_of_transaction` trans ON trans.`id` = pr.`type_of_transaction` WHERE ts.`user_id`='".$getuserid."' AND ts.`id_of_company`='".$getcomp[$i]."' AND ts.`formcstatus` = '0' AND ts.`date_of_transaction` BETWEEN '".$finstrtdte."' AND '".$finenddte."' ORDER BY ID DESC ".$query; 
                
                 //echo $queryget;exit;
                $exeget = $connection->query($queryget);
                $getnum = trim($exeget->numRows());
                //echo $getnum;exit;
                if($getnum>0)
                {
                    while($row = $exeget->fetch())
                    {
                        $gettotal[$i] = $this->gettotlamnt($getuserid,$getcomp[$i],$finstrtdte,$finenddte);
                        //print_r($gettotal[$i]);exit;
                        $getrow = "SELECT * FROM `sebiformc_usrdata` WHERE `tradeid` = '".$row['id']."'";
                        //print_r($getrow);exit;
                        $exegetrow = $connection->query($getrow);
                        $getnumrow[$i] = trim($exegetrow->numRows());
                        if($gettotal[$i] > 1000000 || $getnumrow[$i] == 1 )
                        {
                            $getdata[] = $row;
                        }
                        
                    }
                }
             
            }
        }
        catch (Exception $e)
        {
            $getlist = array();
            //$connection->close();
        }
        //print_r($getdata);exit;
        $getlist = array('data'=>$getdata,'prevdata'=>$getnumrow);
        return $getlist; 
    }
    
    public function fetchformccompdata($getuserid,$user_group_id)
    {
        $connection = $this->dbtrd;
        try
         {
            
            $queryget = "SELECT DISTINCT ts.`id_of_company` FROM `trading_status` ts   WHERE ts.`user_id`='".$getuserid."' "; 
          
            //echo $queryget;exit;
            $exeget = $connection->query($queryget);
            $getnum = trim($exeget->numRows());

            if($getnum>0)
            {
                while($row = $exeget->fetch())
                {
                    $getlist[] = $row['id_of_company'];
                }
                //echo '<pre>';print_r($getnumrow);exit;
                
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
        
    public function gettotlamnt($getuserid,$getcomp,$finstrtdte,$finenddte)
    {
        $connection = $this->dbtrd;
        try
         {
            
            $queryget = "SELECT SUM(total_amount) AS totalamnt FROM trading_status  WHERE id_of_company='".$getcomp."' AND user_id='".$getuserid."' AND  `date_of_transaction` BETWEEN '".$finstrtdte."' AND '".$finenddte."' "; 
            //print_r($queryget);exit;
          
            $exeget = $connection->query($queryget);
            $getnum = trim($exeget->numRows());

            if($getnum>0)
            {
                while($row = $exeget->fetch())
                {
                    $getlist = $row['totalamnt'];
                }
                //echo '<pre>';print_r($getnumrow);exit;
                
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
    
    public function tradingdata($ids)
    {
        $connection = $this->dbtrd;
        try
         {
            
            $queryget = "SELECT * FROM `trading_status` ts WHERE ts.`id`='".$ids."'  "; 
            //echo $queryget;  exit;
            $exeget = $connection->query($queryget);
            $getnum = trim($exeget->numRows());

            if($getnum>0)
            {
                while($row = $exeget->fetch())
                {
                    $getlist = $row;
                }
                //echo '<pre>';print_r($getlist);exit;
                
            }else{
                $getlist = array();
            }
        }
        catch (Exception $e)
        {
            $getlist = array();
        }
        
        return $getlist; 
    }
    
    public function updatetrdsts($formcids)
    {
        $connection = $this->dbtrd;
        for($i = 0;$i<sizeof($formcids);$i++)
        {
              $queryinsert = "UPDATE `trading_status` SET  formcstatus = '1' WHERE id='".$formcids[$i]."' "; 
            $exeprev = $connection->query($queryinsert);
            
        }
        try
        {

            return true;
        }
        catch (Exception $e) 
        {
            //echo "checkng Exception";print_r($e);exit;
            return false;
        }
    }
    /*--------------------------- form c section end ---------------------------*/
    
    
    
    /*--------------------------- form d section start ---------------------------*/
    
    /******* insert form d data start********/
    public function insertformd($getuserid,$user_group_id,$formddata,$formdids,$appvrid,$cin)
    {
        $connection = $this->dbtrd; 
        $time = time();
        for($i = 0;$i<sizeof($formddata);$i++)
        {
            $openingblnc = '';
            $querygetdata = "SELECT * FROM `sebiformd_usrdata` WHERE user_id='".$getuserid."' AND `companyid`='".$formddata[$i]['id_of_company']."' ORDER BY ID DESC LIMIT 1";
            $exegetdata = $connection->query($querygetdata);
            $getnumdata = trim($exegetdata->numRows());
            if($getnumdata>0)
            {
                while($rowdata = $exegetdata->fetch())
                {
                    $openingblnc = $rowdata['clsblnc'];
                }
            }
            if(in_array($formddata[$i]['id'],$formdids))
            {
                $tradests = 1;
            }
            else
            {
                $tradests = 0;
            }
            if(empty($openingblnc))
            {
               $queryget ="SELECT * FROM `opening_balance` WHERE `id_of_company` = '".$formddata[$i]['id_of_company']."' AND `user_id`= '".$getuserid."' AND `sectype`='".$formddata[$i]['sectype']."'";
        
                $exeget = $connection->query($queryget);
                $getnum = trim($exeget->numRows());

                if($getnum>0)
                {
                    while($row = $exeget->fetch())
                    {
                        if($formddata[$i]['sectype'] == '1')
                        {
                           $openingblnc = $row['equityshare'];
                        }
                        else if($formddata[$i]['sectype'] == '2')
                        {
                            $openingblnc = $row['prefershare'];
                        }
                        else if($formddata[$i]['sectype'] == '3')
                        {
                            $openingblnc = $row['debntrshare'];
                        }else{ $openingblnc = 0;}
                    }
                }else{
                    $openingblnc = 0;
                } 
            }
            else {$openingblnc = $openingblnc;}
            $queryusrdata = "SELECT * FROM `sebiformd_usrdata` WHERE `tradeid` = '".$formddata[$i]['id']."'";
            $exegetusrdta = $connection->query($queryusrdata);
            $getnumdta = trim($exegetusrdta->numRows());
            if($getnumdta>0)
            {
                $queryinsert = "UPDATE `sebiformd_usrdata` SET `filestatus` = '".$tradests."', `date_modified` = NOW(),`timeago`='".$time."' WHERE `tradeid`='".$formddata[$i]['id']."'";
                $exeprev = $connection->query($queryinsert);
            }
            else
            {
                $totalamnt = $formddata[$i]['total_amount'];
                $clngblnc = $openingblnc+$totalamnt;

                $queryinsert = "INSERT INTO `sebiformd_usrdata` (`user_id`,`user_group_id`,`tradeid`,`approverid`,`cin`, `companyid`,`acquimode`,`fromdate`, `todate`, `sectype`, `pretrans`,`posttrans`,`dateofintimtn`,`buyvalue`, `buynumbrunt`, `sellvalue`, `sellnumbrunt`,`exetrd`,`opngblnc`,`totalamnt`,`clsblnc`,`filestatus`,`date_added`, `date_modified`,`timeago`)
                 VALUES ('".$getuserid."','".$user_group_id."','".$formddata[$i]['id']."','".$appvrid."','".$cin."','".$formddata[$i]['id_of_company']."','','".$formddata[$i]['date_of_transaction']."','".$formddata[$i]['date_of_transaction']."','".$formddata[$i]['sectype']."','','',NULL,'','','','','','".$openingblnc."','".$totalamnt."','".$clngblnc."','".$tradests."',NOW(),NOW(),'".$time."')"; 
                //print_r($queryinsert);exit;
                $exeprev = $connection->query($queryinsert);
             }
            //echo $queryinsert;exit;
         }
        
        try
        {
            return true;
        }
        catch (Exception $e) 
        {
            //echo "checkng Exception";print_r($e);exit;
            return false;
        }
    }
    /******* insert form d data end********/
    
    // ****** form d data fetch for table **********
    public function fetchformddata($getuserid,$user_group_id,$query)
    {
       $connection = $this->dbtrd;
        try
         {
            
            $queryget = "SELECT formd.*,memb.`designation`,cmp.`company_name` FROM `sebiformd_usrdata` formd
                        LEFT JOIN `listedcmpmodule` cmp ON cmp.`id` = formd.`companyid` 
                        LEFT JOIN `it_memberlist` memb ON memb.`wr_id` = formd.`user_id`
                        WHERE formd.`user_id`= '".$getuserid."' AND formd.`filestatus` = '1' ORDER BY ID DESC".$query; 
          
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
    // ****** form d data fetch for table **********
    
    // ****** form d data fetch for edit **********
    public function fetchformdedit($getuserid,$user_group_id,$id)
    {
       $connection = $this->dbtrd;
        try
         {
            
            $queryget = "SELECT formd.*,memb.`designation` FROM `sebiformd_usrdata` formd
                        LEFT JOIN `it_memberlist` memb ON memb.`wr_id` = formd.`user_id`
                        WHERE formd.`id`=  '".$id."' "; 
          
            //echo $queryget;  exit;
            $exeget = $connection->query($queryget);
            $getnum = trim($exeget->numRows());

            if($getnum>0)
            {
                while($row = $exeget->fetch())
                {
                    $getlist = $row;
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
    // ****** form d data fetch for edit **********
    
    /******* get content of html document start*********/
    public function getformddata($getuserid,$user_group_id,$formdid)
    {
        $connection = $this->dbtrd;
        $queryget = "SELECT formd.*,memb.`fullname`,memb.`mobile`,tr.`req_id`,pr.`place`,pinfo.`pan`,pinfo.`address`,cmp.`company_name`,formmode.`acquisitionmode` AS acquistnmode 
         FROM `sebiformd_usrdata` formd 
         LEFT JOIN `it_memberlist` memb ON memb.`wr_id` = formd.`user_id` 
         LEFT JOIN `personal_info` pinfo ON pinfo.`userid` = formd.`user_id` 
         LEFT JOIN `listedcmpmodule` cmp ON cmp.`id` = formd.`companyid`
         LEFT JOIN `sebiformc_mode` formmode ON formmode.`id` = formd.`acquimode`
         LEFT JOIN `trading_status` tr ON tr.`id` = formd.`tradeid`
         LEFT JOIN personal_request pr ON pr.`id` = tr.`req_id`
         WHERE formd.`id`='".$formdid."'";
        //echo $queryget;exit;
        try{
          $exeget = $connection->query($queryget);
            $getnum = trim($exeget->numRows());

            if($getnum>0)
            {
                while($row = $exeget->fetch())
                {
                    $getlistdata = $row;
                }
                $getlist = array('data'=>$getlistdata);
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
    /******* get content of html document end *********/
    
    /******* update form d data start********/
    public function updateformd($getuserid,$user_group_id,$formdupdata)
    {
        $connection = $this->dbtrd; 
        $time = time();
           $queryinsert = "UPDATE `sebiformd_usrdata` SET `cin`='".$formdupdata['cin']."',`cmpcnct`='".$formdupdata['cmpcnctn']."', `fromdate`='".$formdupdata['fromdate']."', `todate`='".$formdupdata['todate']."', `pretrans`='".$formdupdata['pretrans']."', `posttrans`='".$formdupdata['posttrans']."', `dateofintimtn`='".$formdupdata['dateofintimtn']."', `acquimode`='".$formdupdata['acquimode']."',`buyvalue`='".$formdupdata['buyvalue']."',`buynumbrunt`='".$formdupdata['buynumbrunt']."',`sellvalue`='".$formdupdata['sellvalue']."',`sellnumbrunt`='".$formdupdata['sellnumbrunt']."',`exetrd`='".$formdupdata['exetrd']."', `date_modified`=NOW(),`timeago`='".$time."' WHERE `id`='".$formdupdata['upformdid']."'"; 
        //print_r($queryinsert);exit;
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
    
    public function getusersdata($getuserid)
    {
        $connection = $this->dbtrd;
        try
        {
            $queryget= "SELECT memb.`fullname`,memb.`approvid`,pinfo.`address`,pinfo.`pan`,pinfo.`mobileno`
                    FROM  `it_memberlist` memb
                    LEFT JOIN `personal_info` pinfo ON memb.`wr_id` = pinfo.`userid`   
                    WHERE memb.`wr_id`='".$getuserid."' ";
                //echo $queryget;exit;
                $exeget = $connection->query($queryget);
                $getnum = trim($exeget->numRows());

                if($getnum>0)
                {
                   $getlist = $exeget->fetch();
                  
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
    /******* update form d data end********/
    
    /******* send for approval form d start ********/
    public function sendforapprvlformd($getuserid,$user_group_id,$formdid)
    {
        $connection = $this->dbtrd; 
        $todate=date('d-m-Y');
        $time = time();
           $queryinsert = "UPDATE `sebiformd_usrdata` SET `send_status`=1,send_date='".$todate."', `date_modified` = NOW(),`timeago`='".$time."'
         WHERE `id`='".$formdid."'"; 
        //print_r($queryinsert);exit;
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
    /******* send for approval form d end ********/
    
    // ********* fetch form d data on view of apprvr table start *******
    public function fetchformddataforaprvl($uid,$usergroup,$query)
    {
        $connection = $this->dbtrd;
            if($usergroup!=2)
            {
                $queryget = "SELECT formd.*,memb.`designation`,memb.`fullname`,memb.`mobile`,pinfo.`address`,pinfo.`pan` 
                FROM `sebiformd_usrdata` formd LEFT JOIN `it_memberlist` memb ON memb.`wr_id` = formd.`user_id` 
                LEFT JOIN `personal_info` pinfo ON pinfo.`userid` = formd.`user_id`
                WHERE (formd.`send_status`='1') AND FIND_IN_SET('".$uid."',formd.`approverid`)".$query;
            }
            else
            {
                $allusers=$this->tradingrequestcommon->getalluserformain($uid);
                $allusers= implode(",",$allusers);

                $queryget = "SELECT formd.*,memb.`designation`,memb.`fullname`,memb.`mobile`,pinfo.`address`,pinfo.`pan`
                FROM `sebiformd_usrdata` formd LEFT JOIN `it_memberlist` memb ON memb.`wr_id` = formd.`user_id` 
                LEFT JOIN `personal_info` pinfo ON pinfo.`userid` = formd.`user_id`
                WHERE (formd.`send_status`='1') AND formd.`user_id` IN(".$allusers.")".$query;
            }

              //echo $queryget;  exit;

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
    // ********* fetch form d data on view of apprvr table end *******
    
    public function insertpdfpathformd($pdfpath,$formdid)
    {
        $connection = $this->dbtrd; 
        $todate=date('d-m-Y');
        $time = time();
           $queryinsert = "UPDATE `sebiformd_usrdata` SET `draft`='".$pdfpath."', `date_modified` = NOW(),`timeago`='".$time."'
         WHERE `id`='".$formdid."'"; 
        //print_r($queryinsert);exit;
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
    
    /******* approve form d start ********/
    public function apprvrqstformd($getuserid,$user_group_id,$formdid,$pdfurl)
    {
        $connection = $this->dbtrd; 
        $time = time();
           $queryinsert = "UPDATE `sebiformd_usrdata` SET `approvestatus`=1,`final`='".$pdfurl."', `date_modified` = NOW(),`timeago`='".$time."'
         WHERE `id`='".$formdid."'"; 
        //print_r($queryinsert);exit;
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
    /******* approve form d end ********/
    
    public function sendemailformd($formdid)
    {
        $getusrdetail = $this->fetchemailofusrformd($formdid);
        $maildetailarray = array(
                            'fullname'=>$getusrdetail['maildata'][0]['fullname'],
                            'designation'=>$getusrdetail['maildata'][0]['designation'],
                            'pan'=>$getusrdetail['maildata'][0]['pan']
                            );
            for($i = 0;$i<sizeof($getusrdetail['emailid']);$i++)
            {
                $result = $this->emailer->mailformdapprvlrqst($maildetailarray,$getusrdetail['emailid'][$i]);
            }
            //print_r($result);exit;
            if($result['logged']==true)
            {
                $results = array('status'=>true, 'mg'=>'Send Successfully');
            }
            else
            {   
                $results = array('status'=>false, 'mg'=>'Request not Sent');  

            }
        return $results;
    }
    
    public function fetchemailofusrformd($formdid)
    {
        $connection = $this->dbtrd;
        try
        {
            $queryget= "SELECT formd.`user_id`, formd.`approverid`, 
                memb.`fullname`, memb.`designation`,
                pinfo.`pan` 
                FROM `sebiformd_usrdata` formd
                LEFT JOIN `it_memberlist` memb ON memb.`wr_id` = formd.user_id
                LEFT JOIN `personal_info` pinfo ON pinfo.`userid` = formd.user_id
                WHERE formd.`id`='".$formdid."' ";
            //echo $queryget; exit;
            
                $exeget = $connection->query($queryget);
                $getnum = trim($exeget->numRows());

                if($getnum>0)
                {
                    while($row = $exeget->fetch())
                    {
                        $approverid = explode(",",$row['approverid']);
                        $getmaildata[] = $row;
                    }
                   for($i = 0;$i<sizeof($approverid);$i++)
                    {
                        $querygetemail = "SELECT email FROM `it_memberlist` WHERE `wr_id` = '".$approverid[$i]."' ";
                        $exegetemail = $connection->query($querygetemail);
                        $getnumemail = trim($exegetemail->numRows());
                        if($getnumemail>0)
                        {
                            while($rowemail = $exegetemail->fetch())
                            {
                                $getapproveremail[] = $rowemail['email'];
                            }
                        }
                    }
                    $getadminemail = $this->tradingplancommon->getadminmailid($approverid[0]);
                    array_push($getapproveremail,$getadminemail);
                    $getlist = array('maildata'=>$getmaildata,'emailid'=>$getapproveremail);
                    //print_r($getlist);exit;

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
    
    /*------ send mail after approve ---------*/
    public function sendemailformdaprv($formdid)
    {
        $getusrdetail = $this->fetchemailofusrdaprv($formdid);
        $maildetailarray = array(
                            'fromdate'=>$getusrdetail['maildata'][0]['fromdate'],
                            'todate'=>$getusrdetail['maildata'][0]['todate'],
                            'connection'=>$getusrdetail['maildata'][0]['cmpcnct'],
                            'email'=>$getusrdetail['maildata'][0]['email']
                            );
           
        $result = $this->emailer->mailformdackrqst($maildetailarray);
            
            //print_r($result);exit;
            if($result['logged']==true)
            {
                $results = array('status'=>true, 'mg'=>'Send Successfully');
            }
            else
            {   
                $results = array('status'=>false, 'mg'=>'Request not Sent');  

            }
        return $results;
    }
    
    public function fetchemailofusrdaprv($formdid)
    {
        $connection = $this->dbtrd;
        try
        {
            $queryget= "SELECT formd.*,memb.`fullname`,memb.`designation`,pinfo.`pan`,memb.email FROM  `sebiformd_usrdata` formd
                        LEFT JOIN `it_memberlist` memb ON memb.`wr_id` = formd.user_id
                        LEFT JOIN `personal_info` pinfo ON pinfo.`userid` = formd.user_id
                        WHERE formd.`id`='".$formdid."' ";
                //echo $queryget;exit;
                $exeget = $connection->query($queryget);
                $getnum = trim($exeget->numRows());

                if($getnum>0)
                {
                    while($row = $exeget->fetch())
                    {
                        
                        $getmaildata[] = $row;
                    }
                   
                    $getlist = array('maildata'=>$getmaildata);
                    //print_r($getlist);exit;

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
    /*------ send mail after approve ---------*/
    
    public function fetchformdtransdata($getuserid,$user_group_id,$finstrtdte,$finenddte,$getcomp,$query)
    {
        $getnumrow = array();
        $getdata = array();
        $connection = $this->dbtrd;
        try
         {
            for($i = 0;$i<sizeof($getcomp);$i++)
            {
                
                $queryget = "SELECT ts.*,cmp.company_name,secu.security_type,trans.transaction FROM `trading_status` ts
                            LEFT JOIN `listedcmpmodule` cmp ON cmp.id = ts.id_of_company
                            LEFT JOIN `req_securitytype` secu ON secu.id = ts.sectype
                            LEFT JOIN `personal_request` pr ON pr.id = ts.req_id
                            LEFT JOIN `type_of_transaction` trans ON trans.id = pr.type_of_transaction WHERE ts.`user_id`='".$getuserid."' AND ts.`id_of_company`='".$getcomp[$i]."' AND ts.`formdstatus` = '0' AND ts.`date_of_transaction` BETWEEN '".$finstrtdte."' AND '".$finenddte."' ORDER BY ID DESC ".$query; 

                //echo $queryget;  exit;
                $exeget = $connection->query($queryget);
                $getnum = trim($exeget->numRows());

                if($getnum>0)
                {
                    while($row = $exeget->fetch())
                    {
                        $gettotal[$i] = $this->gettotlamnt($getuserid,$getcomp[$i],$finstrtdte,$finenddte);
                        $getrow = "SELECT * FROM `sebiformd_usrdata` WHERE `tradeid` = '".$row['id']."'";
                        $exegetrow = $connection->query($getrow);
                        $getnumrow[] = trim($exegetrow->numRows());
                        if($gettotal[$i] > 1000000 || $getnumrow[$i] == 1 )
                        {
                            $getdata[] = $row;
                        }
                    }
                    //echo '<pre>';print_r($gettotal);exit;

                }else{
                    $getdata = array();
                }
            }
        }
        catch (Exception $e)
        {
            $getdata = array();
            //$connection->close();
        }
        //print_r($data);exit;
        $getlist = array('data'=>$getdata,'prevdata'=>$getnumrow);
        return $getlist; 
    }
    
    public function updatetrdstsformd($formdids)
    {
        $connection = $this->dbtrd;
        for($i = 0;$i<sizeof($formdids);$i++)
        {
              $queryinsert = "UPDATE `trading_status` SET  formdstatus = '1' WHERE id='".$formdids[$i]."' "; 
            $exeprev = $connection->query($queryinsert);
            
        }
        try
        {

            return true;
        }
        catch (Exception $e) 
        {
            //echo "checkng Exception";print_r($e);exit;
            return false;
        }
    }
    
    
    /*--------------------------- form d section end ---------------------------*/


      public function getsharecapital($getuserid,$user_group_id)
    {
        $connection = $this->dbtrd;
        try
        {
            if($user_group_id == 2)
            {
                $queryget = "SELECT *  FROM `sharecapital` WHERE `user_id`='".$getuserid."'  ";
            }
            else
            {
                $grpusrs = $this->insidercommon->getGroupUsers($getuserid,$user_group_id);
                $queryget = "SELECT *  FROM `sharecapital` WHERE `user_id` IN(".$grpusrs['ulstring'].") ";
            }
            //echo $queryget;exit;
            $exeget = $connection->query($queryget);
            $getnum = trim($exeget->numRows());

            if($getnum>0)
            {
                while($row = $exeget->fetch())
                {
                    $getlist = $row;
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
    
    
}





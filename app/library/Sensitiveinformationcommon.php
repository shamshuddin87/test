<?php
use Phalcon\Mvc\User\Component;

class Sensitiveinformationcommon extends Component
{
    // **************************** sensitive recipient category ***************************
    public function categorydetails()
    {
        $connection = $this->dbtrd;
        try
         {
             $queryget = "SELECT *  FROM `sensitiveinfo_category` WHERE `status`='1'";
            
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
    
       // **************************** recipient insert ***************************
    public function insertrecipient($getuserid,$user_group_id,$category,$othercate,$entity,$name,$identitynum,$phonenum,$mobilenum,$designation,$email,$filepath,$agreemntfilepath,$pan,$department)
    {
        
        $connection = $this->dbtrd; 
        $time = time();
       
           $queryinsert = 'INSERT INTO `sensitiveinfo_recipient`(`user_id`,`user_group_id`,`category`,`othercategory`,`department`,`pannumber`,`nameofentity`, `name`, `identityno`, `phoneno`, `mobileno`, `designation`, `email`, `filepath`,`agreemntfile`,`date_added`, `date_modified`,`timeago`)
         VALUES ("'.$getuserid.'","'.$user_group_id.'","'.$category.'","'.$othercate.'","'.$department.'","'.$pan.'","'.$entity.'","'.$name.'","'.$identitynum.'","'.$phonenum.'","'.$mobilenum.'","'.$designation.'","'.$email.'","'.$filepath.'","'.$agreemntfilepath.'",NOW(),NOW(),"'.$time.'")'; 
        //print_r($queryinsert);exit;
        try
        {
            $exeprev = $connection->query($queryinsert);
            $lastid    = $connection->lastInsertId();
            // print_r($lastid);exit;
            $notific=$this->notificationcommon->upsisharingnotify($getuserid,$lastid,"4");
           
            return true;
        }
        catch (Exception $e) 
        {
            //echo "checkng Exception";print_r($e);exit;
            return false;
        }
    }
 
    
    // **************************** recipient fetch for table***************************
    public function fetchrecipient($getuserid,$user_group_id)
    {
       $connection = $this->dbtrd;
        try
         {
            $grpusrs = $this->insidercommon->getGroupUsers($getuserid,$user_group_id);
            //print_r($grpusrs['ulstring']);exit;
            $queryget = "SELECT sr.* ,sc.`category` as categoryname FROM `sensitiveinfo_recipient` sr 
                        LEFT JOIN `sensitiveinfo_category` sc ON sr.category = sc.id 
                        WHERE `user_id` IN (".$grpusrs['ulstring'].") ORDER BY sr.`id` DESC "; 
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
    
    // **************************** recipient fetch for edit ***************************
    public function fetchrecipientforedit($id)
    {
       $connection = $this->dbtrd;
        try
         {
             
             $queryget = "SELECT sr.* ,sc.`category` as categoryname FROM `sensitiveinfo_recipient` sr 
                         LEFT JOIN `sensitiveinfo_category` sc ON sr.category = sc.id  
                         WHERE sr.`id`= '".$id."'"; 
            
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
    
    // **************************** recipient update ***************************
    public function updaterecipient($getuserid,$user_group_id,$category,$othrcategory,$entity,$name,$identitynum,$phonenum,$mobilenum,$designation,$email,$filepath,$agreemntfilepath,$id,$pan,$department)
    {
        $connection = $this->dbtrd;
        $time = time();
        //print_r($frmdta['startdate']);exit;
        
        $insertml =  'UPDATE `sensitiveinfo_recipient` SET  
        `category`="'.$category.'",`othercategory`="'.$othrcategory.'",
        `nameofentity`="'.$entity.'", `name`="'.$name.'",
        `identityno`="'.$identitynum.'", `phoneno`="'.$phonenum.'", `mobileno`="'.$mobilenum.'",
        `designation`="'.$designation.'", `email`="'.$email.'", `department`="'.$department.'",`pannumber`="'.$pan.'",
        `filepath`="'.$filepath.'", `agreemntfile`="'.$agreemntfilepath.'",
        `date_modified`=NOW(),`timeago`="'.$time.'" 
        WHERE `id`="'.$id.'"';       
        //echo $insertml; exit;
        
        try
        { 
            $exeml = $connection->query($insertml);
            if($exeml)
            {
                $returndta = array('status'=>true,'msg'=>'Updated Successfully !! '); 
                $notific=$this->notificationcommon->upsisharingnotify($getuserid,$id,"5");
            }
            else
            { 
                $returndta = array('status'=>false,'msg'=>'Record Not updated !! ');   
            }            
        }
        catch (Exception $e)
        {
            $returndta = array('status'=>false,'msg'=>'Record Not updated !! ');
        }
        return $returndta; 
    }    
    // **************************** recipient Delete ***************************
    
    public function recipientfordelete($id)
    {
       $connection = $this->dbtrd;
        $queryget = "DELETE FROM `sensitiveinfo_recipient` WHERE `id`= '".$id."'"; 
            
           try
           { 
                $exeml = $connection->query($queryget);

                //$lastid    = $connectiondbloreal->lastInsertId();
                if($exeml)
                {

                        $returndta = array('status'=>true,'msg'=>'Deleted Successfully !! '); 

                }
                else
                { $returndta = array('status'=>false,'msg'=>'Record Not Deleted !! ');   }
            
         }
        catch (Exception $e)
        {
            $returndta = array('status'=>false,'msg'=>'Record Not Deleted !! ');
        }
              
          
        return $returndta; 
    }
    
    
    
    // **************************** infosharing insert ***************************
   public function insertinfosharing($getuserid,$user_group_id,$name,$sharingdate,$sharingtime,$enddate,$datashared,$category,$upsitypeid,$recipientid,$filepath,$emailrec,$upsiname,$loggedemail)
    {
        $connection = $this->dbtrd; 
        $times = time();
        $todaydate = date('d-m-Y');
        $unixTimestamp = strtotime($todaydate);
 
      
        $dayOfWeek = date("l", $unixTimestamp);
        $queryinsert = "INSERT INTO `sensitiveinfo_sharing`(`user_id`,`user_group_id`,`recipientid`,`name`,`sharingdate`,`upsitype`,`sharingtime`,`enddate`, `datashared`,`category`,`filepath`,`date_added`, `date_modified`,`timeago`)
         VALUES ('".$getuserid."','".$user_group_id."','".$recipientid."','".$name."','".$sharingdate."','".$upsitypeid."','".$sharingtime."','".$enddate."','".$datashared."','".$category."','".$filepath."',NOW(),NOW(),'".$times."')"; 
        //print_r($queryinsert);exit;
        try
        {
            $exeprev = $connection->query($queryinsert);
            $lastid    = $connection->lastInsertId();
            $notific= $this->notificationcommon->upsisharingnotify($getuserid,$lastid,"6");
           

           
            
            

            $sendmail = $this->emailer->mailofnewupsisharing($emailrec,$sharingdate,$upsiname,$name,$category);
             $notifymail =$this->emailer->notifysharing($name,$loggedemail,$upsiname,$todaydate,$dayOfWeek);

           

            if($sendmail == true)
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
            //echo "checkng Exception";print_r($e);exit;
            return false;
        }
    }
 
    
    // **************************** infosharing fetch for table***************************
    public function fetchinfosharing($getuserid,$user_group_id,$upsitypeid,$query)
    {
       $connection = $this->dbtrd;
        try
         {
            $queryget = "SELECT ss.*, upt.`upsitype` as upsiname, memb.`fullname`,sc.`category` AS category_name,sr.`othercategory`,sr.`name` 
                        FROM `sensitiveinfo_sharing` ss
                        LEFT JOIN `it_memberlist` memb ON memb.`wr_id` = ss.`user_id`
                        LEFT JOIN `upsimaster` upt ON upt.`id` = ss.`upsitype`
                        LEFT JOIN `sensitiveinfo_category` sc ON sc.`id` = ss.`category`
                        LEFT JOIN `sensitiveinfo_recipient` sr ON sr.`id` = ss.`recipientid`
                        WHERE ss.`upsitype`='".$upsitypeid."' AND (FIND_IN_SET('".$getuserid."',upt.`projectowner`) OR FIND_IN_SET('".$getuserid."',upt.`connecteddps`)) ORDER BY ss.`id` DESC ".$query; 
            //echo $queryget;  exit;
            //
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
    
    // **************************** infosharing fetch for edit ***************************
    public function fetchinfosharingforedit($id)
    {
       $connection = $this->dbtrd;
        try
         {
             
             $queryget = "SELECT * FROM `sensitiveinfo_sharing`  
                         WHERE `id`= '".$id."'"; 
            
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
    
    // **************************** infosharing update ***************************
    public function updateinfosharing($getuserid,$user_group_id,$name,$date,$datashared,$purpose,$filepath,$category,$id)
    {
       $connection = $this->dbtrd;
        $time = time();
        //print_r($frmdta['startdate']);exit;
       $insertml =  "UPDATE `sensitiveinfo_sharing` SET `name`='".$name."' ,`sharingdate`='".$date."' ,`datashared`='".$datashared."' ,`purpose`='".$purpose."' , `filepath`='".$filepath."', `category`='".$category."',`date_modified`=NOW() WHERE `id`='".$id."' ";
       
        //echo $insertml; exit;
        try
        { 
            $exeml = $connection->query($insertml);
            
            //$lastid    = $connectiondbloreal->lastInsertId();
            if($exeml)
            {
                
                    $returndta = array('status'=>true,'msg'=>'Updated Successfully !! '); 

                
            }
            else
            { $returndta = array('status'=>false,'msg'=>'Record Not updated !! ');   }
            
        }
        catch (Exception $e)
        {
            $returndta = array('status'=>false,'msg'=>'Record Not updated !! ');
        }
              
          
        return $returndta; 
    }
    
    // **************************** infosharing Delete start ***************************
    public function infosharingfordelete($id)
    {
       $connection = $this->dbtrd;
        $queryget = "DELETE FROM `sensitiveinfo_sharing` WHERE `id`= '".$id."'"; 
            
           try
           { 
                $exeml = $connection->query($queryget);

                //$lastid    = $connectiondbloreal->lastInsertId();
                if($exeml)
                {

                        $returndta = array('status'=>true,'msg'=>'Deleted Successfully !! '); 

                }
                else
                { $returndta = array('status'=>false,'msg'=>'Record Not Deleted !! ');   }
            
         }
        catch (Exception $e)
        {
            $returndta = array('status'=>false,'msg'=>'Record Not Deleted !! ');
        }
              
          
        return $returndta; 
    }
    // **************************** infosharing Delete end ***************************
    
    // **************************** infosharing search name start ***************************
    public function namedetails($getuserid,$user_group_id,$getsearchkywo)
    {
        $connection = $this->dbtrd;
        try
         {
            $grpusrs = $this->insidercommon->getGroupUsers($getuserid,$user_group_id);
            //print_r($grpusrs);exit;
            
             $queryget = "SELECT sr.*,cate.`category` AS `categoryname` FROM `sensitiveinfo_recipient` sr
             LEFT JOIN `sensitiveinfo_category` cate ON cate.`id` = sr.`category`
             WHERE sr.`user_id` IN (".$grpusrs['ulstring'].") AND sr.`name` LIKE '%{$getsearchkywo}%'";
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

    public function itnamedetails($getuserid,$user_group_id,$getsearchkywo,$email)
    {
        $connection = $this->dbtrd;
        
       
        $email = implode("','", $email);
        //print_r($email);exit;
        try
         {
            $grpusrs = $this->insidercommon->getGroupUsers($getuserid,$user_group_id);
            //print_r($grpusrs);exit;
            
             $queryget = "SELECT * FROM it_memberlist 
             WHERE `wr_id` IN (".$grpusrs['ulstring'].") AND `email` NOT IN('".$email."') AND `fullname` LIKE '%{$getsearchkywo}%' ";
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
    // **************************** infosharing search name end ***************************
    
    // ------------------ fetch trail data -----------------
    public function fetchinfotrail($getuserid,$user_group_id,$shareid)
    {
        $connection = $this->dbtrd;
        try
         {
            $queryget = "SELECT * FROM `sensitiveinfo_sharing` WHERE `id` = '".$shareid."'";
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
    // ------------------ fetch trail data -----------------
    
    // **************************** infosharing update ***************************
    public function updateenddate($getuserid,$user_group_id,$id,$enddate)
    {
       $connection = $this->dbtrd;
        $time = time();
        //print_r($frmdta['startdate']);exit;
       $insertml =  "UPDATE `sensitiveinfo_sharing` SET `enddate`='".$enddate."',`date_modified`=NOW(),`timeago`='".$time."' WHERE `id`='".$id."' ";
       
        //echo $insertml; exit;
        try
        { 
            $exeml = $connection->query($insertml);
            
            //$lastid    = $connectiondbloreal->lastInsertId();
            if($exeml)
            {
                
                    $returndta = array('status'=>true,'msg'=>'Updated Successfully !! '); 
                    $notific=$this->notificationcommon->upsisharingnotify($getuserid,$id,"7");
                
            }
            else
            { $returndta = array('status'=>false,'msg'=>'Record Not updated !! ');   }
            
        }
        catch (Exception $e)
        {
            $returndta = array('status'=>false,'msg'=>'Record Not updated !! ');
        }
              
          
        return $returndta; 
    }
    
  // **************************** infosharing fetch for Archive table***************************
    public function fetcharchiveinfosharing($getuserid,$user_group_id,$upsitype,$query)
    {
       $connection = $this->dbtrd;
        try
         {
            $queryget = "SELECT ss.*, memb.fullname,sc.`category` AS category_name,sr.`othercategory`  
                        FROM `sensitiveinfo_sharing` ss
                        LEFT JOIN `it_memberlist` memb ON memb.wr_id = ss.user_id
                        LEFT JOIN `sensitiveinfo_category` sc ON sc.`id` = ss.`category`
                        LEFT JOIN `sensitiveinfo_recipient` sr ON sr.`id` = ss.`recipientid`
                        LEFT JOIN `upsimaster` upt ON upt.`id` = ss.`upsitype`
                        WHERE (FIND_IN_SET('".$getuserid."',upt.`projectowner`) OR FIND_IN_SET('".$getuserid."',upt.`connecteddps`)) AND ss.`enddate` !=''   AND ss.`upsitype` = '".$upsitype."'".$query;  
          
            
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



    public function getallupsitypes($uid)
    {
         $masterid=$this->tradingrequestcommon->getmasterid($uid);
         $connection = $this->dbtrd;
        try
         {
            $queryget = "SELECT  * FROM upsimaster WHERE user_id='".$masterid['user_id']."'"; 
          
            
            //echo $queryget;  exit;
            $exeget = $connection->query($queryget);
            $getnum = trim($exeget->numRows());

            if($getnum>0)
            {
                while($row = $exeget->fetch())
                {
                    $getlist[] = $row;
                }
                  
                    
                // echo '<pre>';print_r($getlist);exit;
                
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
    

     public function fetchinfodata($reqid)
    {
         
         $connection = $this->dbtrd;
        try
         {
            $queryget = "SELECT  `sharingdate` FROM sensitiveinfo_sharing WHERE id='".$reqid."'"; 
          // `sensitiveinfo_sharing` SET `enddate`='".$enddate."',`date_modified`=NOW(),`timeago`='".$time."' WHERE `id`='".$id."' ";
            
            //echo $queryget;  exit;
            $exeget = $connection->query($queryget);
            $getnum = trim($exeget->numRows());

            if($getnum>0)
            {
                while($row = $exeget->fetch())
                {
                    $getlist = $row;
                }
                  
                    
                // echo '<pre>';print_r($getlist);exit;
                
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
    
    // ------------- UPSI TYPE fetch START
    public function fetchupsiinfo($getuserid,$user_group_id,$query,$subquery)
    {
        $connection = $this->dbtrd;
        
		try
		 {
			$queryget = "SELECT * FROM `upsimaster`   
                        WHERE (FIND_IN_SET('".$getuserid."',`projectowner`) OR FIND_IN_SET('".$getuserid."',`connecteddps`)) ORDER BY `id` DESC ".$query.$subquery; 
			//echo $queryget;  exit; `companyid` IN (".$cmpid.") AND 
			
			$exeget = $connection->query($queryget);
			$getnum = trim($exeget->numRows());

			if($getnum>0)
			{
				while($row = $exeget->fetch())
				{
					$getlist[] = $row;
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
		
		return $getlist; 
    }
    // ------------- UPSI TYPE fetch END
    
    public function fetchupsitype($upsiid)
    {
        $connection = $this->dbtrd;
		try
		 {
			$queryget = "SELECT * FROM `upsimaster` 
						 WHERE `id`= '".$upsiid."'"; 
			// echo $queryget;  exit;
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
		}
		catch (Exception $e)
		{
			$getlist = '';
			//$connection->close();
		}
		
		return $getlist; 
    }


    /* ---------- Search for user masters start ---------- */
    public function userdetails($getuserid,$user_group_id,$getsearchkywo)
    {
        $connection = $this->dbtrd;

        $queryget = "SELECT itm.`*`,pinfo.`pan` 
                FROM `it_memberlist` itm
                LEFT JOIN `personal_info` pinfo ON pinfo.`userid` = itm.`wr_id`
                WHERE `fullname` LIKE '%{$getsearchkywo}%' AND `status`= 1";
        // echo $queryget;exit;
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
    /* ---------- Search for user masters End ---------- */



    /* ----------To get compiance officer from application ---------- */
    public function compliancedetails()
    {
        $connection = $this->dbtrd;

        $queryget = "SELECT * from it_memberlist WHERE  `master_group_id`=  14 ";
        // echo $queryget;exit;
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
    /* ---------- Search for user masters End ---------- */
    
    
}





<?php
use Phalcon\Mvc\User\Component;

class Commonquerycommon extends Component
{
    
    public function commoninsertlogic($getuserid,$cin,$user_group_id,$last_id,$fullname,$firstname,$lastname,$email,$mobile,$gender,$designation,$reminderdays,$pwdemail,$accrgt,$deptaccessid,$approvid,$dpdate,$empcode,$l1firstname,$l1lastname,$l1email,$l1empid,$roleid)
    {
        // $connection = $this->db;
        $connectiondbtrd = $this->dbtrd;
        $time = time();

        $queryinsertml = "INSERT INTO `it_memberlist`
            (`user_id`,`master_group_id`,
            `wr_id`,`role_id`,`fullname`,`firstname`,`lastname`,
            `email`,`mobile`,`gender_id`,`employeecode`,`designation`,
            `reminderdays`,`access`,`deptaccess`,`cmpaccess`,`dpdate`,`l1firstname`,
            `l1lastname`,`l1email`,`l1empid`,`date_added`,`date_modified`,`timeago`,`approvid`,`status`)
            VALUES ('".$getuserid."','".$user_group_id."',
            '".$last_id."','".$roleid."','".$fullname."','".$firstname."','".$lastname."',
            '".$email."','".$mobile."','".$gender."','".$empcode."','".$designation."',
            '".$reminderdays."','".$accrgt."','".$deptaccessid."','".$cin."','".$dpdate."','".$l1firstname."','".$l1lastname."','".$l1email."','".$l1empid."',
            NOW(),NOW(),'".$time."','".$approvid."',1) ";
         // print_r($queryinsertml); exit;
        
        $exeml = $connectiondbtrd->query($queryinsertml);

        
        // ----- Start SoftwareSectionAccess -----
        $secaccess = $this->commonquerycommon->softwaresectionaccess($last_id,'206');
        // ----- End SoftwareSectionAccess -----
        
        if($exeml)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    
/* ----------------- Start SoftwareSectionAccess Entry ----------------- */     
    public function softwaresectionaccess($wruid,$sectionaccess)
    {
        $connection = $this->db;
        $connectiondbcdata = $this->dbcdata;
        $time = time();
        
        $qryssa = "SELECT * FROM `software_section_access` WHERE `user_id`='".$wruid."' ";
        //echo $qryssa; exit;
        
        try
        {                
            $exessa = $connectiondbcdata->query($qryssa);
            $getnum = trim($exessa->numRows());
            //echo $getnum; exit;
            if($getnum==0)
            { 
                $softsecacc = "INSERT INTO `software_section_access`
                (`user_id`,`section_id`,`date_added`,`date_modified`,`timeago`)
                VALUES ('".$wruid."', '".$sectionaccess."', NOW(), NOW(), '".$time."')";
                //echo $softsecacc; exit;
                $connectiondbcdata->query($softsecacc);
                return true;
            }
            else
            {   
                $userdata = $exessa->fetch();  
                $secarray = explode('^',$userdata['section_id']);
                if(!in_array("206",$secarray))
                {
                    $temp = $userdata['section_id'];
                    $section_id = $temp.'^206';
                    
                    $softsecacc = "UPDATE `software_section_access`
                    SET `section_id`='".$section_id."',`date_modified`=NOW(),`timeago`='".$time."'
                    WHERE `user_id`='".$wruid."' ";
                    //echo $softsecacc; exit;
                    $connectiondbcdata->query($softsecacc);
                    return true;
                }
                else
                {   return true;    }
            }
        }
        catch (Exception $e)
        {
            return false;
        }
    }
/* ----------------- End SoftwareSectionAccess Entry ----------------- */    
    
    
    public function userdetails($getuserid,$usergroup,$mainqry)
    {
        $connection = $this->dbtrd;
        $sqlquery = "SELECT * FROM `it_memberlist` WHERE `user_id`='".$getuserid."'"; 
        $sqlquery.=" AND `status`=1   ".$mainqry;

         // echo $sqlquery; exit;
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
                 //----------------------fetch company---------------------//
                foreach ($getlist as $k => $val) {
                        $cmpnm=array();
                        $querygett = "SELECT `companyname`
                        FROM companylist WHERE `id` IN (".$val['cmpaccess'].") ";

                        $exegett = $connection->query($querygett);
                        $getnumx = trim($exegett->numRows());
                      
                        if($getnumx>0)
                        {
                            while($rowz = $exegett->fetch())
                            {
                                // echo $k.'---> ';echo '<pre>';print_r($rowz);
                                $cmpnm[] = $rowz['companyname'];
                            }
                            $getlist[$k]['companyname'] = implode(',', $cmpnm);
                        }
                    }
                //--------------------------------------------------------//
            //------------------fetch department----------------------------//
                     foreach ($getlist as $k => $val) {
                        $dept=array();
                        $querygett = "SELECT `deptname`
                        FROM con_dept WHERE `id` IN (".$val['deptaccess'].") ";

                        $exegett = $connection->query($querygett);
                        $getnumx = trim($exegett->numRows());
                      
                        if($getnumx>0)
                        {   
                            while($rowz = $exegett->fetch())
                            {
                                 // echo $k.'---> ';echo '<pre>';print_r($rowz);
                                $dept[] = $rowz['deptname'];

                            }
                            $getlist[$k]['department'] = implode(',', $dept);
                        
                        }
                    }
                    //----------------------------------------------------//
            }
            else
            {   $getlist = array(); }
        }
        catch (Exception $e)
        {   $getlist = array(); }
        //echo '<pre>';print_r($getlist);exit;
        return $getlist;    }

    //------------------------------------DELETE USER  ACTION  -----------------------------------------------

     public function deleteuser($getuserid,$usergroup,$delid)
     {
        // print_r($delid);exit;
       $connection = $this->dbtrd;
       $conn = $this->db;
         
       $sqlquery = "SELECT `wr_id` FROM `it_memberlist` WHERE `id`='".$delid['delid']."' "; 
       // echo $sqlquery; exit;
       try
       {
            $exeget = $connection->query($sqlquery);
            $getnum = trim($exeget->numRows());
            if($getnum>0)
            {
                while($row = $exeget->fetch())
                {                    
                    $deluserid = $row;  
                }
                //---------------delete from it memberlist-----------------------
                if(isset($deluserid))
                {
                   $sqlquery="UPDATE `it_memberlist` SET `status`= '0',`date_modified`= NOW() WHERE id='".$delid['delid']."' ";
                    $exesql = $connection->query($sqlquery);
                }
                
                if($exesql)
                {    
                    return true;
                    
                    // ----- do not delete from web_register_user Start -----
                        /*$sqlquery="DELETE FROM `web_register_user` WHERE user_id='".$deluserid['wr_id']."' ";
                        $exe = $conn->query($sqlquery);
                        if($exe)
                        {   return true;    }
                        else
                        {   return false;   }*/ 
                    // ----- do not delete from web_register_user End -----
                }
                else
                {   
                    return false;  
                }
                //----------------------------------------------------------------
            }
         } 
         catch(Exception $e)
         {
             return false;
         }
       
     }

 //------------------------------------------------------------------------------------------------------------
 public function fetchsingleuser($getuserid,$usergroup,$id){
  
    $connection = $this->dbtrd;
       $sqlquery = "SELECT * FROM `it_memberlist` WHERE `id`='".$id."'"; 
        
       // echo $sqlquery; exit;
       try{
            $exeget = $connection->query($sqlquery);
            $getnum = trim($exeget->numRows());
            if($getnum>0)
            {
                while($row = $exeget->fetch())
                {
                    
                       $getlist[] = $row;                     
                    
                }
                 //----------------------fetch company---------------------//
                foreach ($getlist as $k => $val) {
                        $cmpnm=array();
                        $querygett = "SELECT `companyname`
                        FROM companylist WHERE `id` IN (".$val['cmpaccess'].") ";

                        $exegett = $connection->query($querygett);
                        $getnumx = trim($exegett->numRows());
                      
                        if($getnumx>0)
                        {
                            while($rowz = $exegett->fetch())
                            {
                                // echo $k.'---> ';echo '<pre>';print_r($rowz);
                                $cmpnm[] = $rowz['companyname'];
                            }
                            $getlist[$k]['companyname'] = implode(',', $cmpnm);
                        }
                    }
                //--------------------------------------------------------//
            //------------------fetch department----------------------------//
                     foreach ($getlist as $k => $val) {
                        $dept=array();
                        $querygett = "SELECT `deptname`
                        FROM con_dept WHERE `id` IN (".$val['deptaccess'].") ";

                        $exegett = $connection->query($querygett);
                        $getnumx = trim($exegett->numRows());
                      
                        if($getnumx>0)
                        {   
                            while($rowz = $exegett->fetch())
                            {
                                 // echo $k.'---> ';echo '<pre>';print_r($rowz);
                                $dept[] = $rowz['deptname'];

                            }
                            $getlist[$k]['department'] = implode(',', $dept);
                        
                        }
                    }
                    //----------------------------------------------------//
                    //--------------------fetch approver name-------------//

                    foreach ($getlist as $k => $val) {
                        if($val['approvid']!=''){
                            $approver=array();
                            $querygett = "SELECT `fullname`,`wr_id`
                            FROM it_memberlist WHERE `wr_id` IN (".$val['approvid'].") ";

                            $exegett = $connection->query($querygett);
                            $getnumx = trim($exegett->numRows());
                      
                            if($getnumx>0)
                            {
                                while($rowz = $exegett->fetch())
                                {
                                      // echo $k.'---> ';echo '<pre>';print_r($rowz);
                                 $html='<div id="edit_'.$rowz['wr_id'].'" edituserid="'.$rowz['wr_id'].'" fullname="'.$rowz['fullname'].'">'.$rowz['fullname'].'<i class="fa fa-close ser_cross closeedit" edituserid="'.$rowz['wr_id'].'" ></i></div>';
                                    $approver[] = $html;
                                }
                                $getlist[$k]['approver'] = implode(',', $approver);

                             }
                           }
                        else{
                            $getlist[$k]['approver'] =''; 
                        }
                    }




                    //-----------------------------------------------------//
            }
            else
            {   $getlist = array(); }
        }
        catch (Exception $e)
        {   $getlist = array(); }
        //echo '<pre>';print_r($getlist);exit;
        return $getlist;   
  }
  public function searchuser($getuserid,$usergroup,$search)
  {

     $connection = $this->dbtrd;
    
     $query="SELECT * FROM it_memberlist WHERE `master_group_id`!='7' AND user_id='".$getuserid."' AND `fullname` LIKE '%".$search."%' ";
   //  print_r($query);exit;
        try{
            $exeget = $connection->query($query);
            $getnum = trim($exeget->numRows());
            $getlist=array();
             if($getnum>0)
             {
                while($row = $exeget->fetch())
                {
                    
                       $getlist[] = $row;                     
                    
                }
                 return $getlist;
              }
              else{
                 return $getlist;
              }
            }catch(Exception $e){
                return false;
            }     
     }


     //----------------------------------------------Fetch user details------------------------------------

      public function fetchuserinfo($getuserid,$usergroup){
  
    $connection = $this->dbtrd;
       $sqlquery = "SELECT * FROM `it_memberlist` WHERE `wr_id`='".$getuserid."'"; 
        
       // echo $sqlquery; exit;
       try{
            $exeget = $connection->query($sqlquery);
            $getnum = trim($exeget->numRows());
            if($getnum>0)
            {
                while($row = $exeget->fetch())
                {
                    
                       $getlist[] = $row;                     
                    
                }
                 //----------------------fetch company---------------------//
                foreach ($getlist as $k => $val) {
                        $cmpnm=array();
                        $querygett = "SELECT `companyname`
                        FROM companylist WHERE `id` IN (".$val['cmpaccess'].") ";

                        $exegett = $connection->query($querygett);
                        $getnumx = trim($exegett->numRows());
                      
                        if($getnumx>0)
                        {
                            while($rowz = $exegett->fetch())
                            {
                                // echo $k.'---> ';echo '<pre>';print_r($rowz);
                                $cmpnm[] = $rowz['companyname'];
                            }
                            $getlist[$k]['companyname'] = implode(',', $cmpnm);
                        }
                    }
                //--------------------------------------------------------//
            //------------------fetch department----------------------------//
                     foreach ($getlist as $k => $val) {
                        $dept=array();
                        $querygett = "SELECT `deptname`
                        FROM con_dept WHERE `id` IN (".$val['deptaccess'].") ";

                        $exegett = $connection->query($querygett);
                        $getnumx = trim($exegett->numRows());
                      
                        if($getnumx>0)
                        {   
                            while($rowz = $exegett->fetch())
                            {
                                 // echo $k.'---> ';echo '<pre>';print_r($rowz);
                                $dept[] = $rowz['deptname'];

                            }
                            $getlist[$k]['department'] = implode(',', $dept);
                        
                        }
                    }
                    //----------------------------------------------------//
                    //--------------------fetch approver name-------------//

                    foreach ($getlist as $k => $val) {
                        if($val['approvid']!=''){
                            $approver=array();
                            $querygett = "SELECT `fullname`,`wr_id`
                            FROM it_memberlist WHERE `wr_id` IN (".$val['approvid'].") ";

                            $exegett = $connection->query($querygett);
                            $getnumx = trim($exegett->numRows());
                      
                            if($getnumx>0)
                            {
                                while($rowz = $exegett->fetch())
                                {
                                      // echo $k.'---> ';echo '<pre>';print_r($rowz);
                                 $html='<div id="edit_'.$rowz['wr_id'].'" edituserid="'.$rowz['wr_id'].'" fullname="'.$rowz['fullname'].'">'.$rowz['fullname'].'<i class="fa fa-close ser_cross closeedit" edituserid="'.$rowz['wr_id'].'" ></i></div>';
                                    $approver[] = $html;
                                }
                                $getlist[$k]['approver'] = implode(',', $approver);

                             }
                           }
                        else{
                            $getlist[$k]['approver'] =''; 
                        }
                    }




                    //-----------------------------------------------------//
            }
            else
            {   $getlist = array(); }
        }
        catch (Exception $e)
        {   $getlist = array(); }
        //echo '<pre>';print_r($getlist);exit;
        return $getlist;   
  }
    
    public function inprsnlremindr($userid,$email)
    {
        $time = time();
        $todaysdate = date('d-m-Y');
        $date = date('d-m-Y', strtotime($todaysdate));
        $time = strtotime($date);
        $timeafrmnth = date("d-m-Y", strtotime("+1 month", $time));
        $timeafrmntha =strtotime($timeafrmnth);
        $dateofmnthday =date("d-m-Y", strtotime("+7 day", $timeafrmntha));
        
        $connection = $this->dbtrd;
        $queryinsertml = "INSERT INTO `reminderofpersninfo`
        (`user_id`,`reminderdate`,`emailid`,`date_added`, `date_modified`,`timeago`)
         VALUES ('".$userid."','".$dateofmnthday."','".$email."',NOW(),NOW(),'".$time."')";
        //print_r($queryinsertml);exit;
         $exeml = $connection->query($queryinsertml);
   
        if($exeml)
        {
           return true;
        }
        else
        {
            return false;
        }
    }
    
    public function inhldngremindr($userid,$email)
    {
        $time = time();
        $todaysdate = date('d-m-Y');
        $time=strtotime($todaysdate);
        $month=date("m",$time);
        $day=date("d",$time);
        if($day == '05')
        {
             $dateofday =date("d-m-Y", strtotime("+5 day", $time));
        }
        else
        {
            $newmonth = $month + 1;
            if(strlen($newmonth) == 1)
            {
                $newmonth = '0'.$newmonth;
            }
            $dateofday = date('Y').$newmonth.'05';
        }
        
        $connection = $this->dbtrd;
        $queryinsertml = "INSERT INTO `reminderofholdingstmnt`
        (`user_id`,`reminderdate`,`emailid`,`date_added`, `date_modified`,`timeago`)
         VALUES ('".$userid."','".$dateofday."','".$email."',NOW(),NOW(),'".$time."')";
        //print_r($queryinsertml);exit;
         $exeml = $connection->query($queryinsertml);
   
        if($exeml)
        {
           return true;
        }
        else
        {
            return false;
        }
    }


     public function updateadminmodule($userid)
     {
        $time = time();
        $connection = $this->dbtrd;
        $queryinsertml = "INSERT INTO `adminmodule`
         (`user_id`,`upsi_conn_per_add`,`upsi_conn_per_view`,`upsi_conn_per_edit`, `upsi_conn_per_delete`,`upsi_infoshare_delete`,`upsi_infoshare_add`
          ,`upsi_infoshare_view`,`comp_trad_rest_add`,`comp_trad_rest_view`,`comp_trad_rest_edit`,`comp_trad_rest_delete`,`emplblock_add`,`emplblock_view`,`emplblock_edit`,`emplblock_delete`)
         VALUES ('".$userid."','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0')";
          // print_r($queryinsertml);exit;
         $exeml = $connection->query($queryinsertml);
   
        if($exeml)
        {
           return true;
        }
        else
        {
            return false;
        }
     }
    
     /*----- START check if there duplicate emp code ----*/
    public function checkifduplidata($getuserid,$empcode,$userid)
    {
        $connection = $this->dbtrd;
        $sqlquery = "SELECT * FROM `it_memberlist`
                    WHERE `user_id` = '".$getuserid."' AND `employeecode`='".$empcode."' AND `wr_id`!='".$userid."'";
        //echo $sqlquery;exit;
        try
        {
            $exeget = $connection->query($sqlquery);
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
        catch (Exception $e)
        {   
            return false;
        }
        
    }
    /*----- END check if there duplicate emp code ----*/
}



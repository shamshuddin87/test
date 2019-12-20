<?php
use Phalcon\Mvc\User\Component;

class Restrictedcompanycommon extends Component
{
    // **************************** company restriction search cmp start***************************
    public function cmpdetails($getuserid,$user_group_id,$getsearchkywo)
    {
        $connection = $this->dbtrd;
        try
         {
            $grpusrs = $this->insidercommon->getGroupUsers($getuserid,$user_group_id);
             $queryget = "SELECT *  FROM `listedcmpmodule` WHERE `added_by` IN (".$grpusrs['ulstring'].") AND `company_name` LIKE '%{$getsearchkywo}%'";
            
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
    // **************************** company restriction search cmp end***************************
    
    // **************************** company restriction insert start***************************
    public function insertcomprestriction($getuserid,$user_group_id,$nameofcomp,$periodfrom,$periodto)
    {
        $connection = $this->dbtrd;
        $time = time();
        
        if($user_group_id!=2)
        {
            $masteruserdata = $this->insidercommon->getMasterUser($getuserid,$user_group_id);
            //echo '<pre>'; print_r($masteruserdata); exit;
                
            $getuserid = $masteruserdata['user_id'];
            $user_group_id = $masteruserdata['user_group_id'];
        }
       
        //echo $periodto; exit;
        $queryinsert = "INSERT INTO `companytrading_period`
            (`user_id`,`user_group_id`,
            `listed_company`, `restriction_from`, `restriction_to`,
            `date_added`, `date_modified`, `timeago`)
            VALUES ('".$getuserid."', '".$user_group_id."',
            '".$nameofcomp."', '".$periodfrom."', '".$periodto."', 
            NOW(),NOW(),'".$time."')"; 
        
        // print_r($queryinsert);exit;
        try
        {
            $exeprev = $connection->query($queryinsert);
            if($exeprev)
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
    // **************************** company restriction insert end***************************
    
    // **************************** company restriction fetch for table start***************************
    public function fetchcompanyrestricted($getuserid,$user_group_id)
    {
        $connection = $this->dbtrd;
        
        try
        {
            $grpusrs = $this->insidercommon->getGroupUsers($getuserid,$user_group_id);
            //print_r($grpusrs['ulstring']);exit;
            $queryget = "SELECT cp.*,lcm.`company_name` 
                FROM `companytrading_period` cp
                LEFT JOIN `listedcmpmodule` lcm ON lcm.`id` = cp.`listed_company`
                WHERE cp.`user_id` IN (".$grpusrs['ulstring'].") ORDER BY cp.`date_added` DESC "; 
            //echo '<pre>'; print_r($queryget); exit;
            
            $exeget = $connection->query($queryget);
            $getnum = trim($exeget->numRows());

            if($getnum>0)
            {
                while($row = $exeget->fetch())
                {
                    $getlist[] = $row;
                }
                //echo '<pre>'; print_r($getlist); exit;
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
    // **************************** company restriction fetch for table end***************************
    
    // **************************** company restriction fetch for edit start***************************
    public function companyrestrictedforedit($id)
    {
       $connection = $this->dbtrd;
        try
         {
             
             $queryget = "SELECT cp.*,lcm.`company_name`  FROM `companytrading_period` cp
                          LEFT JOIN `listedcmpmodule` lcm ON lcm.`id` = cp.`listed_company` WHERE cp.`id`= '".$id."'"; 
            
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
    // **************************** company restriction fetch for edit end***************************
    
    // **************************** company restriction update start***************************
    public function updatecomprestriction($getuserid,$user_group_id,$nameofcomp,$perdresfrom,$perdresto,$id)
    {
       $connection = $this->dbtrd;
        $time = time();
        
        $insertml =  "UPDATE `companytrading_period` SET  `listed_company`='".$nameofcomp."' ,
                    `restriction_from`='".$perdresfrom."' , `restriction_to`='".$perdresto."',`date_modified`=NOW(),`timeago`='".$time."' WHERE `id`='".$id."' ";
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
            //print_r($e);exit;
            $returndta = array('status'=>false,'msg'=>'Record Not updated !! ');
        }
              
          
        return $returndta; 
    }
    // **************************** company restriction update end***************************
    
    // **************************** company restriction Delete start***************************
    
    public function companyrestrictedfordelete($id)
    {
       $connection = $this->dbtrd;
        $queryget = "DELETE FROM `companytrading_period` WHERE `id`= '".$id."'"; 
            
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
            //print_r($e);exit;
            $returndta = array('status'=>false,'msg'=>'Record Not Deleted !! ');
        }
              
          
        return $returndta; 
    }
    // **************************** company restriction Delete end***************************
    
    // **************************** company restriction mail shoot start***************************
    public function mailcomprestriction($getuserid,$user_group_id,$nameofcomp,$periodfrom,$periodto)
    {
        $connection = $this->dbtrd;
        
        // --- Start get group users ---
        $grpusrs = $this->insidercommon->getGroupUsers($getuserid,$user_group_id);   
        //echo '<pre>'; print_r($grpusrs); exit;
        // --- End get group users ---
        
        $getdata = $grpusrs['userlist'];
        //print_r($getdata); exit;
        $getcompdata = $this->restrictedcompanycommon->getcompdata($nameofcomp);
        
        for($i=0;$i<sizeof($getdata);$i++)
        {
            //echo '<pre>'; print_r($getdata[$i]); exit;
            $sendtoid = $getdata[$i]['wr_id'];
            $emailid = $getdata[$i]['email'];
            $username = $getdata[$i]['fullname'];
            //$result = $this->emailer->mailcomprestriction($emailid,$username,$getcompdata,$periodfrom,$periodto);
            
            // ----- Start InsertDataInAutomailer -----
            $qtypeid = '1'; //-- refer email_queuetype table
            $infodata = array('getcompdata'=>$getcompdata,'periodfrom'=>$periodfrom,'periodto'=>$periodto);
            $result = $this->automailercommon->insertemailqueue($getuserid,$user_group_id,$qtypeid,$sendtoid,$emailid,$username,$infodata);
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
   

    
    public function getcompdata($nameofcomp)
    {
        $connection = $this->dbtrd;
        try
        {
            $queryget = "SELECT * FROM `listedcmpmodule` WHERE `id` ='".$nameofcomp."'"; 
            //echo $queryget; exit;
            $exeget = $connection->query($queryget);
            $getnum = trim($exeget->numRows());

            if($getnum>0)
            {
                while($row = $exeget->fetch())
                {
                    $getlist = $row['company_name'];
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
    // **************************** company restriction mail shoot end***************************
    
    // **************************** employeeblocking company details start **********************
    public function cmpmasterdetails($getuserid,$user_group_id)
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
                  
                    
//                /echo '<pre>';print_r($getlist);exit;
                
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
    // **************************** employeeblocking company details end **********************
    
    // **************************** employee restriction get department start ***************************
    public function getDept($id)
    {
        $connection = $this->dbtrd;
        try
         {
             $queryget = "SELECT *  FROM `con_dept` WHERE FIND_IN_SET('".$id."', `companyid`)";
            //echo $queryget;exit;
            $exeget = $connection->query($queryget);
            $getnum = trim($exeget->numRows());

            if($getnum>0)
            {
                while($row = $exeget->fetch())
                {
                    $getlist[$row['id']] = $row['deptname'];
                    /*imp logic 
                        $useridarr = explode(",",$row['person_res']);
                        for($ii=0 ;$ii<sizeof($useridarr);$ii++)
                        {
                            if($useridarr[$ii]==$getuserid)
                            {$ff = true;
                                break;}
                           else
                           {$ff = false;
                               continue;}}
                            if($ff==true)
                           {$getlist[] = $row; }
                            else{} */
                    
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
    // **************************** employee restriction get department end ***************************
    
    public function fetchemployee($getuserid,$user_group_id,$cmpid,$deptid)
    {
        //print_r($deptid);exit;
        $connection = $this->dbtrd;
        $getlist = '';
        try
         {
             $queryget = "SELECT * FROM `it_memberlist` WHERE FIND_IN_SET ('".$cmpid."',cmpaccess)";
            //echo $queryget;exit;
            $exeget = $connection->query($queryget);
            $getnum = trim($exeget->numRows());

            if($getnum>0)
            {
                while($row = $exeget->fetch())
                {
                    $deptaccess = explode(",",$row['deptaccess']);
                    for($i = 0;$i<sizeof($deptid);$i++)
                    {
                        if (in_array($deptid[$i], $deptaccess))
                        {
                            $ff = true;
                            break;
                        }
                        else
                        {
                            $ff = false;
                            continue;
                        } 
                    }
                    if($ff==true)
                    { $getlist[] = $row; }
                    else
                    {  } 
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
    
    // **************************** employee restriction insert start***************************
    public function insertemployeerestriction($getuserid,$user_group_id,$nameoflistedcomp,$nameofcomp,$deptaccess,$empid,$periodfrom,$periodto)
    {
        $connection = $this->dbtrd;
        $time = time();
        $deptaccess = implode(',',$deptaccess);
        $empid = implode(',',$empid);
        
        $queryinsert = "INSERT INTO `employeerestriction`
            (`user_id`,`user_group_id`,`nameofcompany`,`deptaccess`,`employee`,`listedcompany`,`restriction_from`, `restriction_to`,`date_added`, `date_modified`,`timeago`)
             VALUES ('".$getuserid."','".$user_group_id."','".$nameofcomp."','".$deptaccess."','".$empid."','".$nameoflistedcomp."','".$periodfrom."','".$periodto."',NOW(),NOW(),'".$time."')";
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
    // **************************** employee restriction insert end***************************
    
    // **************************** employee restriction fetch for table start ***************************
    public function fetchemprestricted($getuserid,$user_group_id)
    {
       $connection = $this->dbtrd;
        try
         {
             $grpusrs = $this->insidercommon->getGroupUsers($getuserid,$user_group_id);
            
             $queryget = "SELECT emp.*,lcm.`company_name`,cmp.`companyname`,memb.`fullname` as username  
                          FROM `employeerestriction` emp
                          LEFT JOIN `listedcmpmodule` lcm ON lcm.`id` = emp.`listedcompany`
                          LEFT JOIN `companylist` cmp ON cmp.`id` = emp.`nameofcompany`
                          LEFT JOIN `it_memberlist` memb ON emp.`user_id` = memb.`wr_id`
                          WHERE emp.`user_id` IN (".$grpusrs['ulstring'].")"; 
            
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
    // **************************** employee restriction fetch for table end ***************************
    
    // **************************** employee restriction fetch for edit start ***************************
    public function employeerestrictedforedit($id)
    {
       $connection = $this->dbtrd;
        try
         {
             
             $queryget = "SELECT emp.*,lcm.`company_name`,cmp.`companyname`  
                             FROM `employeerestriction` emp
                             LEFT JOIN `listedcmpmodule` lcm ON lcm.`id` = emp.`listedcompany`
                             LEFT JOIN `companylist` cmp ON cmp.`id` = emp.`nameofcompany` WHERE emp.`id`= '".$id."'"; 
            
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
    // **************************** employee restriction fetch for edit end ***************************
    
    // **************************** employee restriction update start***************************
    public function updateemprestriction($getuserid,$user_group_id,$nameoflistedcomp,$nameofcomp,$deptaccess,$empid,$perdresfrom,$perdresto,$id)
    {
       $connection = $this->dbtrd;
       $time = time();
       $deptaccess = implode(',',$deptaccess);
       $empid = implode(',',$empid);
        
        $insertml =  "UPDATE `employeerestriction` SET  `listedcompany`='".$nameoflistedcomp."' ,`nameofcompany`='".$nameofcomp."' ,`deptaccess`='".$deptaccess."' ,`employee`='".$empid."',
                        `restriction_from`='".$perdresfrom."' , `restriction_to`='".$perdresto."',`date_modified`=NOW(),`timeago`='".$time."' WHERE `id`='".$id."' ";
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
            //print_r($e);exit;
            $returndta = array('status'=>false,'msg'=>'Record Not updated !! ');
        }
              
          
        return $returndta; 
    }
    // **************************** employee restriction update end***************************
    
    // **************************** employee restriction Delete start***************************
    public function employeerestrictedfordelete($id)
    {
       $connection = $this->dbtrd;
        $queryget = "DELETE FROM `employeerestriction` WHERE `id`= '".$id."'"; 
            
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
    // **************************** employee restriction Delete end***************************
    
    // **************************** employee restriction fetch for table start***************************
    public function getdepartment($dept)
    {
        $connection = $this->dbtrd;
        $dept = explode(',',$dept);
        try
         {
             for($i = 0;$i<sizeof($dept);$i++)
             {
                $queryget = "SELECT  * FROM `con_dept` 
                            WHERE `id`= '".$dept[$i]."'"; 
                $exeget = $connection->query($queryget);
                $getnum = trim($exeget->numRows());

                if($getnum>0)
                {
                    while($row = $exeget->fetch())
                    {
                        $getlist[] = $row['deptname'];
                    }
                    //echo '<pre>';print_r($getlist);exit;

                }else{
                    $getlist = array();
                }
            }
        }
        catch (Exception $e)
        {
            $getlist = array();
            //$connection->close();
        }
        
        return $getlist; 
    }
    
    public function getemp($emp)
    {
        $connection = $this->dbtrd;
        $emp = explode(',',$emp);
        try
         {
             for($i = 0;$i<sizeof($emp);$i++)
             {
                $queryget = "SELECT  * FROM `it_memberlist` 
                            WHERE `wr_id`= '".$emp[$i]."'"; 
                $exeget = $connection->query($queryget);
                $getnum = trim($exeget->numRows());

                if($getnum>0)
                {
                    while($row = $exeget->fetch())
                    {
                        $getlist[] = $row['fullname'];
                    }
                    //echo '<pre>';print_r($getlist);exit;

                }else{
                    $getlist = array();
                }
            }
        }
        catch (Exception $e)
        {
            $getlist = array();
            //$connection->close();
        }
        
        return $getlist; 
    }
    // **************************** employee restriction fetch for table end***************************
    
    // **************************** employee restriction fetch for edit start***************************
    public function getdepartmentedit($dept)
    {
        $connection = $this->dbtrd;
        $dept = explode(',',$dept);
        try
         {
             for($i = 0;$i<sizeof($dept);$i++)
             {
                $queryget = "SELECT  * FROM `con_dept` 
                            WHERE `id`= '".$dept[$i]."'"; 
                $exeget = $connection->query($queryget);
                $getnum = trim($exeget->numRows());

                if($getnum>0)
                {
                    while($row = $exeget->fetch())
                    {
                        $getlist[$row['id']] = $row['deptname'];
                    }
                    //echo '<pre>';print_r($getlist);exit;

                }else{
                    $getlist = array();
                }
            }
        }
        catch (Exception $e)
        {
            $getlist = array();
            //$connection->close();
        }
        
        return $getlist; 
    }
    
    public function getempedit($emp)
    {
        $connection = $this->dbtrd;
        $emp = explode(',',$emp);
        try
         {
             for($i = 0;$i<sizeof($emp);$i++)
             {
                $queryget = "SELECT  * FROM `it_memberlist` 
                            WHERE `wr_id`= '".$emp[$i]."'"; 
                $exeget = $connection->query($queryget);
                $getnum = trim($exeget->numRows());

                if($getnum>0)
                {
                    while($row = $exeget->fetch())
                    {
                        $getlist[$row['wr_id']] = $row['fullname'];
                    }
                    //echo '<pre>';print_r($getlist);exit;

                }else{
                    $getlist = array();
                }
            }
        }
        catch (Exception $e)
        {
            $getlist = array();
            //$connection->close();
        }
        
        return $getlist; 
    }
    // **************************** employee restriction fetch for edit end***************************
    
    // **************************** employee restriction get department start ***************************
    public function getDeptforedit($id)
    {
        $connection = $this->dbtrd;
        try
         {
             $queryget = "SELECT *  FROM `con_dept` WHERE FIND_IN_SET('".$id."', `companyid`)";
            //echo $queryget;exit;
            $exeget = $connection->query($queryget);
            $getnum = trim($exeget->numRows());

            if($getnum>0)
            {
                while($row = $exeget->fetch())
                {
                    $getlist[$row['id']] = $row['deptname'];
                    /*imp logic 
                        $useridarr = explode(",",$row['person_res']);
                        for($ii=0 ;$ii<sizeof($useridarr);$ii++)
                        {
                            if($useridarr[$ii]==$getuserid)
                            {$ff = true;
                                break;}
                           else
                           {$ff = false;
                               continue;}}
                            if($ff==true)
                           {$getlist[] = $row; }
                            else{} */
                    
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
    
    public function fetchemployeeforedit($getuserid,$user_group_id,$cmpid,$deptid)
    {
        //print_r($deptid);exit;
        $connection = $this->dbtrd;
        $getlist = '';
        try
         {
             $queryget = "SELECT * FROM `it_memberlist` WHERE FIND_IN_SET ('".$cmpid."',cmpaccess)";
            //echo $queryget;exit;
            $exeget = $connection->query($queryget);
            $getnum = trim($exeget->numRows());

            if($getnum>0)
            {
                while($row = $exeget->fetch())
                {
                    $deptaccess = explode(",",$row['deptaccess']);
                    for($i = 0;$i<sizeof($deptid);$i++)
                    {
                        if (in_array($deptid[$i], $deptaccess))
                        {
                            $ff = true;
                            break;
                        }
                        else
                        {
                            $ff = false;
                            continue;
                        } 
                    }
                   
                    
//                    print_r($deptaccess);
//                    print_r($deptid);
//                    
//                        for($ii=0 ;$ii<sizeof($deptaccess);$ii++)
//                        {
//                            for($j = 0;$j<sizeof($deptid);$j++)
//                            {
//                                if($deptaccess[$ii] == $deptid[$j])
//                                {
//                                    //echo 'dept id is  ';print_r($deptid[$j]);
//                                    //echo 'dept access is  ';print_r($deptaccess[$ii]);
//                                    $ff = true;
//                                    break;
//                                }
//                                else
//                                {
//                                     $ff = false;
//                                     continue;  
//                                }
//                            }
//
//                        }
                    if($ff==true)
                    { $getlist[] = $row; }
                    else
                    {  } 
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
    
    public function getempforedit($cmpid,$deptid)
    {
        //print_r($cmpid);exit;
        $connection = $this->dbtrd;
        $getlist = '';
        try
         {
             $queryget = "SELECT * FROM `it_memberlist` WHERE FIND_IN_SET ('".$cmpid."',cmpaccess)";
            //echo $queryget;exit;
            $exeget = $connection->query($queryget);
            $getnum = trim($exeget->numRows());

            if($getnum>0)
            {
                while($row = $exeget->fetch())
                {
                    $deptaccess = explode(",",$row['deptaccess']);
                    for($i = 0;$i<sizeof($deptid);$i++)
                    {
                        if (in_array(array_keys($deptid)[$i], $deptaccess))
                        {
                            $ff = true;
                            break;
                        }
                        else
                        {
                            $ff = false;
                            continue;
                        } 
                    }

                    if($ff==true)
                    { $getlist[$row['wr_id']] = $row['fullname']; }
                    else
                    {  } 
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
    // **************************** employee restriction get department end ***************************
    
    // **************************** employee restriction mail shoot start***************************
    public function mailemprestriction($getuserid,$user_group_id,$nameoflistedcomp,$periodfrom,$periodto,$empid)
    {
        $getdata = $this->restrictedcompanycommon->getusrsmailid($empid);
        $getcompdata = $this->restrictedcompanycommon->getcompdata($nameoflistedcomp);
        for($i=0;$i<sizeof($getdata);$i++)
        {
            //echo '<pre>'; print_r($getdata[$i]); exit;
            $sendtoid = $getdata[$i]['wr_id'];
            $emailid = $getdata[$i]['email'];
            $username = $getdata[$i]['fullname'];
            //$result = $this->emailer->mailemprestriction($emailid,$username,$getcompdata,$periodfrom,$periodto);
            
            // ----- Start InsertDataInAutomailer -----
            $qtypeid = '2'; //-- refer email_queuetype table
            $infodata = array('getcompdata'=>$getcompdata,'periodfrom'=>$periodfrom,'periodto'=>$periodto);
            $result = $this->automailercommon->insertemailqueue($getuserid,$user_group_id,$qtypeid,$sendtoid,$emailid,$username,$infodata);
            // ----- End InsertDataInAutomailer -----
            
        }
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
    
    public function getusrsmailid($empid)
    {
        $connection = $this->dbtrd;
        $connectionz = $this->db;
        for($i=0;$i<sizeof($empid);$i++)
        {
            try
            {
             
                 $queryget = "SELECT * FROM `it_memberlist` WHERE `wr_id`= '".$empid[$i]."'"; 
                 
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
      }
        //echo '<pre>';print_r($getlist);exit;
        
        return $getlist; 
    }
    
    // **************************** employee restriction mail shoot end***************************
    
}





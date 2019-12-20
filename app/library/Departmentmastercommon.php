<?php
use Phalcon\Mvc\User\Component;

class Departmentmastercommon extends Component
{
   

    public function insertdepartment($nameofdept,$getuserid,$gtselctedcmp)
    {
        $connection = $this->dbtrd;
        
        $time = time();
        //echo $gtselctedcmp;exit;
        //$nameofdept = strtolower($nameofdept);
        $querysql = "SELECT LOWER(`deptname`) FROM `con_dept` WHERE `deptname`= '".strtolower($nameofdept)."' AND `user_id` = '".$getuserid."' AND `companyid` = '".$gtselctedcmp."' ";
            // echo $querysql;exit;
        $exesql = $connection->query($querysql);

        $rowcnt = $exesql->numRows();
        // echo $rowcnt;exit;
        $insertml = "INSERT INTO `con_dept`
                    (`user_id`,`companyid`,`deptname`,
                    `date_added`,`date_modified`,`timeago`)
                     VALUES ('".$getuserid."','".$gtselctedcmp."','".$nameofdept."',
                     NOW(),NOW(),'".$time."' )";
        // echo $insertml; exit;

        try
        { 
            if ($rowcnt > 0) {
                $returndta = array('status'=>false,'msg'=>'Department Already Exists For This Organisation !! ');
            }else{
                $exeml = $connection->query($insertml);
                //$lastid    = $connection->lastInsertId();
                if($exeml)
                {
                    $returndta = array('status'=>true,'msg'=>'Department Added Successfully !! ');  
                }
                else
                { $returndta = array('status'=>false,'msg'=>'Department not saved !! ');   }
            }
            
        }
        catch (Exception $e)
        {
            //echo "in exception";exit;
            //print_r($e);exit;
            $returndta = array('status'=>false,'msg'=>'Department not saved !! ');
        }

        return $returndta;
    }  

    public function fetchdept($getuserid,$user_group_id,$mainquery)
    {
         $connection = $this->dbtrd;

        $queryget = "SELECT * FROM con_dept  WHERE `user_id` = '".$getuserid."' ";
        $queryget.=$mainquery;
        // echo $queryget;  exit;

         try{
                $exeget = $connection->query($queryget);
                $getnum = trim($exeget->numRows());

                if($getnum>0)
                {
                    while($row = $exeget->fetch())
                    {
                        $getlist[] = $row;
                    }

                    foreach ($getlist as $k => $val) {
                        $cmpnm=array();
                        $querygett = "SELECT `companyname`
                        FROM companylist WHERE `id` IN (".$val['companyid'].") ";

                        $exegett = $connection->query($querygett);
                        $getnumx = trim($exegett->numRows());
                      
                        if($getnumx>0)
                        {
                            while($rowz = $exegett->fetch())
                            {
                                //echo $k.'---> ';echo '<pre>';print_r($rowz);
                                $cmpnm[] = $rowz['companyname'];
                            }
                            $getlist[$k]['companyname'] = implode(',', $cmpnm);
                        }
                    }
                    // echo '<pre>';print_r($getlist);exit;
                }
                else{
                    $getlist = array();
                }
            }
            catch (Exception $e)
            {
                $getlist = array();
                //$connection->close();
            }
        //echo '<pre>';print_r($getlist);exit;
        return $getlist;
    }

  //-------------------------------------------------fetch single department-----------------------------

     public function fetchdeptone($getuserid,$user_group_id,$tempid)
    {
        $connection = $this->dbtrd;
        //echo "wait here ";exit;
        $queryget = "SELECT * FROM `con_dept` WHERE user_id = '".$getuserid."' AND `id` = '".$tempid."' ";

        //echo $queryget;  exit;

         try{
                $exeget = $connection->query($queryget);
                $getnum = trim($exeget->numRows());

                if($getnum>0)
                {
                    while($row = $exeget->fetch())
                    {
                        $getlist[] = $row;
                    }
                    //echo '<pre>';print_r($getlist);exi//
                }
                else{
                    $getlist = array();
                }
            }
            catch (Exception $e)
            {
                $getlist = array();
                //$connection->close();
            }
        //echo '<pre>';print_r($getlist);exit;
        return $getlist;
    }
//----------------------------Update Department----------------------------------------------//

     public function updatedept($nameofdept,$getuserid,$gtselctedcmp,$tempid)
    {
        //echo $large_impfile_location;exit;
        $connection = $this->dbtrd;
        $time = time();

        $insertml = "UPDATE `con_dept` SET 
            `deptname`='".$nameofdept."',`companyid`='".$gtselctedcmp."',
            `date_modified`=NOW(), `timeago`='".$time."' 
            WHERE `id`='".$tempid."' ";
        //echo $insertml; exit;
        try
        { 
            $exeml = $connection->query($insertml);
            //$lastid    = $connectiondbloreal->lastInsertId();
            if($exeml)
            {
                $returndta = array('status'=>true,'msg'=>'Department Updated Successfully !! ');  
            }
            else
            { $returndta = array('status'=>false,'msg'=>'Department could not be updated !! ');   }
            
        }
        catch (Exception $e)
        {
            //echo "in exception";exit;
            //print_r($e);exit;
            $returndta = array('status'=>false,'msg'=>'Department could not be updated !! ');
        }

        return $returndta;
    }
//---------------------------------------------Delete Department--------------------------------

     public function deletedept($getuserid,$tempid)
    {
        //echo $getuserid;exit;
         $connection = $this->dbtrd;
        $time= time();

        

        $deleteud = "DELETE FROM `con_dept` WHERE `id`='".$tempid."' ";
        //echo $deleteud; exit;

        try
        {
            $exeud = $connection->query($deleteud);            
            if($exeud)
            {   
                $returndta = array('status'=>true,'msg'=>'Department deleted !! ');    
            }
            else
            {   
                $returndta = array('status'=>false,'msg'=>'Department cannot be deleted !! ');   
            }
        }
        catch (Exception $e)
        {
            $returndta = array('status'=>false,'msg'=>'Department cannot be deleted !! ');
        }
        return $returndta;
    }
   
}



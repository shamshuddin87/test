<?php
use Phalcon\Mvc\User\Component;
class Declarationformcommon extends Component
{
 
    public function insertdeclrnfrm($getuserid,$user_group_id,$checked)
    {
        $connection = $this->dbtrd;
        $time = time();
        $queryselect = "SELECT * FROM `declarationform` WHERE `user_id` = '".$getuserid."'";
        $exeget = $connection->query($queryselect);
        $getnum = trim($exeget->numRows());
        if($getnum == 0)
        {
            $queryinsert = "INSERT INTO `declarationform`(`user_id`,`user_group_id`,`isagree`,`date_added`, `date_modified`,`timeago`)
                VALUES ('".$getuserid."','".$user_group_id."','".$checked."',NOW(),NOW(),'".$time."')";
            
        }
        else
        {
            return false;
        }
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
    
    public function fetchdeclrnfrm($getuserid,$user_group_id)
    {
        $connection = $this->dbtrd;
        try
        {
            $queryselect = "SELECT * FROM `declarationform` WHERE `user_id` = '".$getuserid."'";
            $exeget = $connection->query($queryselect);
            $getnum = trim($exeget->numRows()); 
            if($getnum>0)
            {
                while($rows = $exeget->fetch())
                {
                    $getlist[] = $rows;
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
}





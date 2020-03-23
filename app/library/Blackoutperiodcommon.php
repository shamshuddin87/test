<?php
use Phalcon\Mvc\User\Component;
class Blackoutperiodcommon extends Component
{
   /**************************** search for cmp masters start *****************************/ 
    public function cmpdetails($getuserid,$user_group_id,$getsearchkywo)
    {
         $connection = $this->dbtrd;
        try
         {
            $grpusrs = $this->insidercommon->getGroupUsers($getuserid,$user_group_id);
             $queryget = "SELECT * FROM `companylist` WHERE `addedby` IN (".$grpusrs['ulstring'].") AND `companyname` LIKE '%{$getsearchkywo}%'";
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
    /**************************** search for cmp masters end *****************************/
    
    /**************************** insert cmp in blackout period start *****************************/
    public function insertblackoutperiod($getuserid,$user_group_id,$compid,$blckoutfrom,$blckoutto)
    {
        $connection = $this->dbtrd;
        $time = time();
         
         if($user_group_id==14)
        {
             $getmasterid = $this->tradingrequestcommon->getmasterid($getuserid);
             $getuserid=$getmasterid['user_id'];
             // print_r($getmasterid);
             $user_group_id=2;
        }

        $queryinsert = "INSERT INTO `blackoutperiod_cmp`
        (`user_id`,`user_group_id`,`companyid`,`datefrom`, `dateto`,`reason`,`date_added`, `date_modified`,`timeago`)
         VALUES ('".$getuserid."','".$user_group_id."','".$compid."','".$blckoutfrom."','".$blckoutto."',NOW(),NOW(),'".$time."')"; 
        
        //print_r($queryinsert);exit;
        try
        {
            $exeprev = $connection->query($queryinsert);
            if($exeprev)
            {
              $lastid    = $connection->lastInsertId();
              $getres = $this->notificationcommon->blackoutperiodnotify($getuserid,$user_group_id,$lastid,"11"); 
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
    /**************************** insert cmp in blackout period end *****************************/
    
    /**************************** fetch cmp in blackout period start *****************************/
    public function fetchblackoutperiod($getuserid,$user_group_id)
    {
        $connection = $this->dbtrd;
        try
        {
            $grpusrs = $this->insidercommon->getGroupUsers($getuserid,$user_group_id);
            $queryselect = "SELECT bcmp.*,cmp.companyname FROM `blackoutperiod_cmp` bcmp
                            LEFT JOIN `companylist` cmp ON cmp.id = bcmp.companyid
                            WHERE bcmp.`user_id` IN (".$grpusrs['ulstring'].")";
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
    /**************************** fetch cmp in blackout period end *****************************/
    
    /**************************** delete cmp in blackout period start *****************************/
    public function blackoutperioddelete($id)
    {
       $connection = $this->dbtrd;
        $queryget = "DELETE FROM `blackoutperiod_cmp` WHERE `id`= '".$id."'"; 
            
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
            echo "in exception";exit;
            //print_r($e);exit;
            $returndta = array('status'=>false,'msg'=>'Record Not Deleted !! ');
        }
              
          
        return $returndta; 
    }
    /**************************** delete cmp in blackout period end *****************************/
}





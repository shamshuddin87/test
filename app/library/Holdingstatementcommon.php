<?php
use Phalcon\Mvc\User\Component;
class Holdingstatementcommon extends Component
{
 
    //############### insert holding statement start ###############
    public function insertholdingstatement($getuserid,$user_group_id,$month,$year,$filepath)
    {
        $connection = $this->dbtrd;
        $time = time();
        $queryselect = "SELECT * FROM `holdingstatement` WHERE `month` = '".$month."' AND `year` ='".$year."' AND `user_id`='".$getuserid."'";
        $exeget = $connection->query($queryselect);
        $getnum = trim($exeget->numRows());
        if($getnum == 0)
        {
            $queryinsert = "INSERT INTO `holdingstatement`
            (`user_id`,`user_group_id`,`month`,`year`,`filepath`,`date_added`, `date_modified`,`timeago`)
             VALUES ('".$getuserid."','".$user_group_id."','".$month."','".$year."','".$filepath."',NOW(),NOW(),'".$time."')";
        }
        else
        {
            $queryinsert = "UPDATE `holdingstatement` SET
            `filepath` = '".$filepath."' , `date_modified` = NOW(),`timeago`='".$time."' WHERE `month` = '".$month."' AND `year` ='".$year."'";
        }
        try
        {
            $exeprev = $connection->query($queryinsert);
            return true;
        }
        catch (Exception $e) 
        {
            return false;
        }
    }
    //############### insert holding statement end ###############
    
    //############### fetching holding statement start ###############
    public function fetchholdingstatement($getuserid,$user_group_id)
    {
        $connection = $this->dbtrd;
        try
        {
            $queryselect = "SELECT * FROM `holdingstatement` WHERE `user_id`= '".$getuserid."' ";
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
    //############### fetching holding statement end ###############
    
    //############### delete holding statement start ###############
    public function holdingstatementdelete($id)
    {
        $connection = $this->dbtrd;
        $queryget = "DELETE FROM `holdingstatement` WHERE `id`= '".$id."'"; 
            
           try
           { 
                $exeml = $connection->query($queryget);

                if($exeml)
                {
                    $returndta = array('status'=>true,'msg'=>'Deleted Successfully !! '); 
                }
                else
                { 
                    $returndta = array('status'=>false,'msg'=>'Record Not Deleted !! ');   
                }
            
         }
        catch (Exception $e)
        {
            echo "in exception";exit;
            $returndta = array('status'=>false,'msg'=>'Record Not Deleted !! ');
        }
              
          
        return $returndta; 
    }
    //############### delete holding statement end ###############
}





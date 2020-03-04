<?php
use Phalcon\Mvc\User\Component;

class Approvelperinfocommon extends Component
{
   
   


    public function getallusers($getuserid,$usergroup,$mainqry)
    {
        $connection = $this->dbtrd;
        // print_r($usergroup);
       
        if($usergroup==2)
        {
            $sqlquery="SELECT  pr.`send_status`,pr.`approved_status`,it.`*` FROM it_memberlist it  LEFT JOIN personal_info pr  ON it.`wr_id`=pr.`userid` WHERE it.`user_id`='".$getuserid."' ".$mainqry;

        }
        else
        {
            $sqlquery="SELECT pr.`send_status`,pr.`approved_status`,it.`*` FROM it_memberlist it  LEFT JOIN personal_info pr  ON it.`wr_id`=pr.`userid` WHERE FIND_IN_SET('".$getuserid."',`approvid`) ".$mainqry;
        }
        // print_r($sqlquery);
        
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
    

     public function getmydetailsmod($uid)
    {

        $connection = $this->dbtrd;

        $queryget = "SELECT pr.`*` ,it.`dpdate` FROM personal_info pr INNER JOIN
        it_memberlist it ON it.`wr_id`=pr.`userid`
        WHERE `userid` = '".$uid."' ";
       // print_r($queryget);exit;
        $getlist=array();

         try{
                $exeget = $connection->query($queryget);
                $getnum = trim($exeget->numRows());
                // $getlist=array();
                if($getnum>0)
                {
                    $getlist=$exeget->fetch();
                    return $getlist;
                }
                else{
                       
                    return $getlist;
                  }     
            
            }catch(Exceptioon $e)
             {
                return $getlist;  
             }
}

     public function getuserdetails($uid)
    {

        $connection = $this->dbtrd;

        $queryget = "SELECT pr.`*` ,it.`dpdate` FROM personal_info pr INNER JOIN
        it_memberlist it ON it.`wr_id`=pr.`userid`
        WHERE `userid` = '".$uid."' ";
       // print_r($queryget);exit;
        $getlist=array();

         try{
                $exeget = $connection->query($queryget);
                $getnum = trim($exeget->numRows());
                // $getlist=array();
                if($getnum>0)
                {
                    $getlist=$exeget->fetch();
                    return $getlist;
                }
                else{
                       
                    return $getlist;
                  }     
            
            }catch(Exceptioon $e)
             {
                return $getlist;  
             }
   }


     public function rejectrequest($getuser)
    {
              $connection = $this->dbtrd;
               $time = time();
             try{
                      $queryup = "UPDATE `personal_info` SET `approved_status`='0',`send_status`='0',`date_modified`=NOW() WHERE userid='".$getuser."'";  //echo 
                      $exegetqry = $connection->query($queryup);
                      // print_r($queryup);exit;
                           
                    
                       
                         if($exegetqry)
                         {
                           return true;
                         }
                         else
                         {
                             return false;
                         }
                     
                    }
                    catch(Exception $e){
                        // echo 'in catch';
                        return false;
                    }
    }
    public function acceptrequest($getuser)
    {
              $connection = $this->dbtrd;
               $time = time();
             try{
                      $queryup = "UPDATE `personal_info` SET `approved_status`='1',`date_modified`=NOW() WHERE userid='".$getuser."'";  //echo 
                      $exegetqry = $connection->query($queryup);
                      // print_r($queryup);exit;
                           
                    
                       
                         if($exegetqry)
                         {
                           return true;
                         }
                         else
                         {
                             return false;
                         }
                     
                    }
                    catch(Exception $e){
                        // echo 'in catch';
                        return false;
                    }
    }

    public function getpastemployer($getuserid,$query)
    {
        $connection = $this->dbtrd;
        try
        {
            $queryselect = "SELECT * FROM `pastemployer` WHERE `user_id` = '".$getuserid."'".$query;
            // echo $query;exit;
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

 
}



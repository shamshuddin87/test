<?php
use Phalcon\Mvc\User\Component;

class Sharecapitalcommon extends Component
{

    public function addsharecapital($getuserid,$data)
    {
       $connection = $this->dbtrd;
        $time=time();
        $sqlq="SELECT * FROM `sharecapital`";
        $exesql = $connection->query($sqlq);
        $getnum = trim($exesql->numRows());

        if($getnum>0)
        {
           $result= array("status"=>false,"message"=>"Please Edit Share Capital");
           return $result;
           exit;
        }

        $sqlquery = "INSERT INTO `sharecapital`(`user_id`,`pershare`,`date_added`,`date_modified`,`timeago`) 
        VALUES ('".$getuserid."','".$data['shrcap']."',NOW(),NOW(),'".$time."')"; 

         // echo $sqlquery; exit;
        try
        {
            $exesql = $connection->query($sqlquery);
            if($exesql)
            {   
                $result= array("status"=>true,"message"=>"Data Added Successfully");
                return $result;
            }
            else
            {   
                 $result= array("status"=>false,"message"=>"Something Went To Wrong");
                 return $result;   
            }
        }
        catch (Exception $e)
        {  
            $result= array("status"=>false,"message"=>"Something Went To Wrong");
            return $result;  
        }
    }

    public function allsharecap($getuserid,$usergroup,$mainqry)
    {
        $connection = $this->dbtrd;
        $sqlquery = "SELECT * FROM `sharecapital`".$mainqry; 
        // print_r($sqlquery);exit;
        
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

      public function getsinglecap($id)
    {

        $connection = $this->dbtrd;
        $sqlquery = "SELECT * FROM `sharecapital` WHERE `id`=$id"; 

        // echo $sqlquery; exit;
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


   public function  updateushare($shr,$id)
    {
        $connection = $this->dbtrd;
        $time=time();
        $sqlquery = "UPDATE `sharecapital` SET `pershare`='".$shr."',
        `date_modified`=NOW(),`timeago`='".$time."'
         WHERE `id`='".$id."'"; 

        try
        {
            $exesql = $connection->query($sqlquery);
            if($exesql)
            {   return true;    }
            else
            {   return false;    }
        }
        
        catch (Exception $e)
        {   
            return false; 
        }


    }


    public function deletesharecap($id)
    {
        $connection = $this->dbtrd;
        $sqlquery="DELETE FROM `sharecapital` WHERE id='".$id."'";
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
  
}
<?php
use Phalcon\Mvc\User\Component;

class Upsicommon extends Component
{

    public function addupsi($getuserid,$data)
    {
       $connection = $this->dbtrd;
        $time=time();
        $sqlquery = "INSERT INTO `upsimaster`(`user_id`,`upsitype`,`date_added`,`date_modified`,`timeago`) 
        VALUES ('".$getuserid."','".$data['upname']."',NOW(),NOW(),'".$time."')"; 

        // echo $sqlquery; exit;
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

    public function getallupsi($getuserid,$usergroup,$mainqry)
    {
        $connection = $this->dbtrd;
        $sqlquery = "SELECT * FROM `upsimaster` WHERE  user_id='".$getuserid."'".$mainqry; 
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

      public function getsingleupsi($id)
    {

        $connection = $this->dbtrd;
        $sqlquery = "SELECT * FROM `upsimaster` WHERE `id`=$id"; 

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


   public function  updateupsi($upsiname,$id)
    {
        $connection = $this->dbtrd;
        $time=time();
        $sqlquery = "UPDATE `upsimaster` SET `upsitype`='".$upsiname."',
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


    public function deleteupsi($id)
    {
        $connection = $this->dbtrd;
        $sqlquery="DELETE FROM `upsimaster` WHERE id='".$id."'";
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
<?php
use Phalcon\Mvc\User\Component;

class Companymastercommon extends Component
{
   
   

/* --------------------------- Method To add Company --------------------------- */    
    public function addcompany($getuserid,$cmp,$pan)
    {
        $connection = $this->dbtrd;
        $time=time();
        
        $sqlquery = "INSERT INTO `companylist`(`companyname`,`panid`,`addedby`,
            `date_added`,`date_modified`,`timeago`) 
            VALUES ('".$cmp."','".$pan."',".$getuserid.",
            NOW(),NOW(),'".$time."') "; 
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
/* --------------------------- Method To add Company Finish --------------------------- */
    
    
    public function cmpdetails($getuserid,$usergroup,$mainqry)
    {
        $connection = $this->dbtrd;
        $sqlquery = "SELECT * FROM `companylist` WHERE  addedby='".$getuserid."'"; 
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

    public function getsinglecmpdetail($cmpid)
    {

        $connection = $this->dbtrd;
        $sqlquery = "SELECT * FROM `companylist` WHERE `id`=$cmpid"; 

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

    public function updatecompany($getuserid,$usergroup,$cmpid,$cmp,$pan)
    {
        $connection = $this->dbtrd;
        $time=time();
        
        $sqlquery = "UPDATE `companylist` SET `companyname`='".$cmp."',
        `panid`='".$pan."',`date_modified`=NOW(),`timeago`='".$time."'
         WHERE `id`='".$cmpid."'"; 

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

    public function deletecompany($getuserid,$usergroup,$cmpid)
    {
        $connection = $this->dbtrd;
        $sqlquery="DELETE FROM `companylist` WHERE id='".$cmpid."'";
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
    
    public function getallpanofcmp()
    {
        $connection = $this->dbtrd;
        $queryget = "SELECT * FROM `companylist`";
        try
        {
            $exeget = $connection->query($queryget);
            $getnum = trim($exeget->numRows());
            if($getnum>0)
            {
                while($row = $exeget->fetch())
                {
                    $getlist[] = $row['panid'];                     
                }
                // echo '<pre>';print_r($getlist);exit;
            }
            else
            {   $getlist = array(); }
        }
        catch (Exception $e)
        {   
            $getlist = array(); 
        }
        return $getlist;
    }

}



<?php
use Phalcon\Mvc\User\Component;

class Initialdeclarationcommon extends Component
{
    public function getalldata($uid,$usergroup)
    {
        $connection = $this->dbtrd;
        $myarr=array();
        $time = time();
        $query="SELECT * FROM mfr WHERE user_id='".$uid."'";
        try
        {
            $exeget = $connection->query($query);
            $getnum = trim($exeget->numRows());
            if($getnum>0)
            {
                while($row = $exeget->fetch())
                { $getlist[] = $row; }
            }
            else
            {  $getlist = array(); }
        }
        catch (Exception $e)
        {   $getlist = array(); }
        return $getlist;
    }

    public function fetchpersonlinfo($uid,$usergroup)
    { 
        $connection = $this->dbtrd;
        $myarr=array();
        $time = time();
        $query="SELECT * FROM personal_info WHERE userid='".$uid."'";

        try
        {
            $exeget = $connection->query($query);
            $getnum = trim($exeget->numRows());
            if($getnum>0)
            {
            while($row = $exeget->fetch())
            { $getlist[] = $row;} 
            }
            else
            {   $getlist = array(); }
        }
        catch (Exception $e)
        {   $getlist = array(); }

        return $getlist;
    }
       
    public function getpastemployee($uid,$usergroup)
    {    
        $connection = $this->dbtrd;
        $myarr=array();
        $time = time();
        $query="SELECT * FROM pastemployer WHERE user_id='".$uid."'";
        try
        {
            $exeget = $connection->query($query);
            $getnum = trim($exeget->numRows());
            if($getnum>0)
            { while($row = $exeget->fetch())
            { $getlist[] = $row; }
            }
            else
            { $getlist = array(); }
        }
        catch (Exception $e)
        {   $getlist = array(); }

        return $getlist;
    }

    public function getdespdemat($uid,$usergroup)
    {   
        $connection = $this->dbtrd;
        $myarr=array();
        $time = time();

        $query="SELECT * FROM user_demat_accounts WHERE user_id='".$uid."'";
        try
        {
            $exeget = $connection->query($query);
            $getnum = trim($exeget->numRows());
            if($getnum>0)
            {    
            while($row = $exeget->fetch())
            {
            $getlist[] = $row['clearing_house'];                     
            }
            }
            else
            {   $getlist = array(); }
        }
        catch (Exception $e)
        {   $getlist = array(); }

        return $getlist;
    }
       
    public function getallrelative($uid,$usergroup)
    {
        $connection = $this->dbtrd;
        $myarr=array();
        $time = time();
        $query="SELECT ri.*,rp.`relationshipname` FROM relative_info ri LEFT JOIN relationship  rp ON `rp`.id=ri.`relationship` 
        WHERE user_id='".$uid."' ";
        try
        {
            $exeget = $connection->query($query);
            $getnum = trim($exeget->numRows());

            if($getnum>0)
            {
                while($row = $exeget->fetch())
                {
                    $clearing_house=$this->getrelativeaccountno($row['id']);
                    $clearing_house=implode(",",$clearing_house);
                    $row['clearing_house']=$clearing_house;
                    $getlist[] = $row;                                    
                }
                // print_r($getlist);exit;
            }
            else
            {   $getlist = array(); }
        }
        catch (Exception $e)
        {   $getlist = array(); }

        return $getlist;

    }
   
    public function getrelativeaccountno($id)
    {
        $connection = $this->dbtrd;
        $myarr=array();
        $time = time();
        $query="SELECT * FROM relative_demat_accounts WHERE rel_user_id='".$id."'";
        try
        {
            $exeget = $connection->query($query);
            $getnum = trim($exeget->numRows());
            if($getnum>0)
            {
            while($row = $exeget->fetch())
            { $getlist[] = $row['clearing_house'];}
            }
            else
            {   $getlist = array(); }
        }
        catch (Exception $e)
        {   $getlist = array(); }

        return $getlist;
    }

    public function noofsharesheld($uid,$usergroup)
    {
        $connection = $this->dbtrd;
        $myarr=array();
        $time = time();
        $query="SELECT *,rp.`relationshipname`AS relationship,SUM(pr.`no_of_shares`) AS heldshares FROM `personal_request` pr 
        INNER JOIN `trading_status` ts ON `ts`.req_id=`pr`.id 
        INNER JOIN `relative_info` rinfo ON `rinfo`.id=`pr`.relative_id
        LEFT JOIN relationship  rp ON `rp`.id=rinfo.`relationship` 
        WHERE `pr`.user_id='".$uid."' AND `pr`.trading_status='1' AND `pr`.type_of_request='2' 
        GROUP BY rinfo.`relationship`";
        try
        {
            $exeget = $connection->query($query);
            $getnum = trim($exeget->numRows());
            if($getnum>0)
            {
            while($row = $exeget->fetch())
            { 

            $getlist[$row['relationship']] = $row['heldshares'];
            }
            // print_r($getlist);exit;
            }

            else
            {   $getlist = array(); }
        }
        catch (Exception $e)
        {   $getlist = array(); }

        return $getlist;
    }

    public function desigpershareheld($uid,$usergroup)
    {
        $connection = $this->dbtrd;
        $myarr=array();
        $time = time();
        $query="SELECT SUM(no_of_shares) AS totalshares FROM `personal_request` pr 
        INNER JOIN `trading_status` ts ON `ts`.req_id=`pr`.id 
        WHERE `pr`.user_id='".$uid."' AND `pr`.trading_status='1' AND `pr`.type_of_request='1'";
        try
        {
            $exeget = $connection->query($query);
            $getnum = trim($exeget->numRows());
            if($getnum>0)
            {
                while($row = $exeget->fetch())
                { 
                    $getlist['desigpershareheld'] = $row['totalshares'];
                }
            }
            else
            {   $getlist = array(); }
        }
        catch (Exception $e)
        {   $getlist = array(); }

        return $getlist;
    }

    public function saveinitialdeclare($uid,$usergroup,$pdfpath)
    {
        // print_r($usergroup);exit;
        $connection = $this->dbtrd;
        $time = time();
        try
        {
            $querysel = "SELECT * FROM `initial_declaration` WHERE `user_id` ='".$uid."'";
            
            $queryin = "INSERT INTO `initial_declaration` (user_id, user_group_id,send_status, pdfpath,date_added,date_modified,timeago) 
            VALUES   ('".$uid."','".$usergroup."',0,'".$pdfpath."',NOW(),NOW(),'".$time."')";
            
            $queryup = "UPDATE `initial_declaration` SET `send_status` = 0,`sent_date` = NULL,`pdfpath` = '".$pdfpath."',`date_added`=NOW(),`date_modified`=NOW(),`timeago`='".$time."' WHERE `user_id` ='".$uid."'";
            // echo $queryup; exit;
            $exeget = $connection->query($querysel);
            $getnum = trim($exeget->numRows());
            if($getnum>0)
            {
                $exegetqry = $connection->query($queryup);
            }
            else
            {  
                $exegetqry = $connection->query($queryin);
            }
            
            if($exegetqry)
            {
                return true;
            }
            else
            {
                return false;
            }                     
        }
        catch(Exception $e)
        {
            return false;
        }
    }

    public function getallsavedpdf($uid,$usergroup)
    {
        $connection = $this->dbtrd;
        $myarr=array();
        $time = time();
        $query="SELECT * FROM initial_declaration WHERE user_id='".$uid."'";
        try
        {
            $exeget = $connection->query($query);
            $getnum = trim($exeget->numRows());
            if($getnum>0)
            {
            while($row = $exeget->fetch())
            { $getlist[] = $row; }
            }
            else
            {  $getlist = array(); }
        }
        catch (Exception $e)
        {   $getlist = array(); }
        return $getlist;
    }

    public function delreqpdf($uid,$usergroup,$delid)
    {
        $connection = $this->dbtrd;
        $myarr=array();
        $time = time();
        try
        {
            $query="DELETE FROM initial_declaration WHERE srno='".$delid."'";
            $exessa= $connection->query($query);
            if($exessa)
            {
                return true;
            }
            else
            {
                return false;
            }
        }
        catch(Exception $e)
        {
            return false;
        }
    }

    public function getemployeecode($uid,$usergroup)
    {
        $connection = $this->dbtrd;
        $myarr=array();
        $time = time();
        $query="SELECT * FROM it_memberlist WHERE wr_id='".$uid."'";
        try
        {
            $exeget = $connection->query($query);
            $getnum = trim($exeget->numRows());
            if($getnum>0)
            {
            $getlist[] = $exeget->fetch();

            }
            else
            {   $getlist = array(); }
        }
        catch (Exception $e)
        {   $getlist = array(); }

        return $getlist;
    }
    
    public function getreqfile($reqid)
    {
        $connection = $this->dbtrd;
        $myarr=array();
        $time = time();
        $query="SELECT * FROM initial_declaration WHERE srno='".$reqid."'";
        try
        {
            $exeget = $connection->query($query);
            $getnum = trim($exeget->numRows());
            if($getnum>0)
            {
                $getlist[] = $exeget->fetch();

            }
            else
            {   $getlist = array(); }
        }
        catch (Exception $e)
        {   $getlist = array(); }

        return $getlist;
    }

    public function sendmailtoapprover($reqid,$getuserapprove,$getname,$getfile)
    {
        $connection = $this->dbtrd;
        $myarr=array();
        $time = time();
        $flag=false;
        $myarr=explode(",",$getuserapprove);
        // print_r($myarr);exit;
        try
        {
            for($i=0;$i<count($myarr);$i++)
            {
                $query="SELECT email FROM it_memberlist WHERE wr_id='".$myarr[$i]."'";
                $exeget = $connection->query($query);
                $getnum = trim($exeget->numRows());
                if($getnum>0)
                {
                    $mail[]= $exeget->fetch();
                }
            }
            for($i=0;$i<count($mail);$i++)
            {
                $status=$this->emailer->sendpdfmailappr($mail[$i]['email'],$getfile,$getname);
                if($status==true)
                {
                    $status= $this->initialdeclarationcommon->updateinitialdeclaration($reqid);
                    $flag=true;
                }
            }
        }
        catch (Exception $e)
        {  return false;  }

        return $flag;  
    }

    public function updateinitialdeclaration($reqid)
    {
        $connection = $this->dbtrd;
        $time = time();
        try
        {
            $queryup = "UPDATE `initial_declaration` SET `send_status`='1',`sent_date`= NOW() WHERE srno='".$reqid."'"; 
            $exegetqry = $connection->query($queryup);
            if($exegetqry)
            {
                return true;
            }
            else
            {
                return false;
            }
        }
        catch(Exception $e)
        {
            return false;
        }
    }
    
     //------------------- fetch Initial Declaration Form Data
    public function getusrdclrnform($masterid,$query)
    {    
        $connection = $this->dbtrd;
        
        $query="SELECT MAX(indec.`pdfpath`) AS pdfpath ,MAX(indec.`sent_date`) AS sent_date,indec.`send_status`,it.`wr_id`,it.`fullname` FROM it_memberlist it LEFT  JOIN initial_declaration indec ON indec.`user_id`=it.`wr_id` 
        WHERE it.`user_id`='".$masterid."' AND it.`status`='1' GROUP BY it.`wr_id` ORDER BY indec.`sent_date` DESC".$query;
        //echo $query;exit;
        try
        {
            $exeget = $connection->query($query);
            $getnum = trim($exeget->numRows());
            if($getnum>0)
            {
                while($row = $exeget->fetch())
                { 
                    $getlist[] = $row; 
                }
            }
            else
            { 
                $getlist = array(); 
            }
        }
        catch (Exception $e)
        {   $getlist = array(); }

        return $getlist;
    }


    public function getreqfile1($uid)
    {
        $connection = $this->dbtrd;
        $myarr=array();
        $time = time();
        $query="SELECT * FROM initial_declaration WHERE user_id='".$uid."'";
        try
        {
            $exeget = $connection->query($query);
            $getnum = trim($exeget->numRows());
            if($getnum>0)
            {
                $getlist[] = $exeget->fetch();

            }
            else
            {   $getlist = array(); }
        }
        catch (Exception $e)
        {   $getlist = array(); }

        return $getlist;
    }


    public function sendmailtoapprover1($uid,$getuserapprove,$getname,$getfile)
    {
        $connection = $this->dbtrd;
        $myarr=array();
        $time = time();
        $flag=false;
        $myarr=explode(",",$getuserapprove);
        // print_r($myarr);exit;
        try
        {
            for($i=0;$i<count($myarr);$i++)
            {
                $query="SELECT email FROM it_memberlist WHERE wr_id='".$myarr[$i]."'";
                $exeget = $connection->query($query);
                $getnum = trim($exeget->numRows());
                if($getnum>0)
                {
                    $mail[]= $exeget->fetch();
                }
            }
            for($i=0;$i<count($mail);$i++)
            {
                $status=$this->emailer->sendpdfmailappr($mail[$i]['email'],$getfile,$getname);
                if($status==true)
                {
                    $status= $this->initialdeclarationcommon->updateinitialdeclaration1($uid);
                    $flag=true;
                }
            }
        }
        catch (Exception $e)
        {  return false;  }

        return $flag;  
    }

    public function updateinitialdeclaration1($uid)
    {
        $connection = $this->dbtrd;
        $time = time();
        try
        {
            $queryup = "UPDATE `initial_declaration` SET `send_status`='1',`sent_date`= NOW() WHERE user_id='".$uid."'"; 
            $exegetqry = $connection->query($queryup);
            if($exegetqry)
            {
                return true;
            }
            else
            {
                return false;
            }
        }
        catch(Exception $e)
        {
            return false;
        }
    }

}
<?php
use Phalcon\Mvc\User\Component;

class Annualdeclarationcommon extends Component
{
  public function getalldata($uid,$usergroup)
  {
      $connection = $this->dbtrd;
      $myarr=array();
      $time = time();
      $query="SELECT * FROM mfr WHERE user_id='".$uid."'";
      try{
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
   
    
      try{
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
     try{
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
    try{
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
    $query="SELECT ri.`*`,rp.`relationshipname` FROM relative_info ri LEFT JOIN relationship  rp ON `rp`.id=ri.`relationship` 
     WHERE user_id='".$uid."' ";
      try{
            $exeget = $connection->query($query);
            $getnum = trim($exeget->numRows());
       
            if($getnum>0)
            {
                while($row = $exeget->fetch())
                {
                       $clearing_house=$this->getrelativeaccountno($row['id']);
                       // print_r($clearing_house);
                       $clearing_house=implode(",",$clearing_house);
                       // print_r($clearing_house);exit;
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
        try{
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

          // print_r($query);exit;
        try{
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

        // print_r($query);exit;
        try{
              $exeget = $connection->query($query);
              $getnum = trim($exeget->numRows());
              if($getnum>0)
              {
                 while($row = $exeget->fetch())
                 { 
                  
                  $getlist['desigpershareheld'] = $row['totalshares'];
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


   public function saveinitialdeclare($uid,$usergroup,$pdfpath,$annualyear,$uniqueid)
   {
            // print_r($usergroup);exit;
            $connection = $this->dbtrd;
            $time = time();
            try
            {
                $querysel = "SELECT * FROM `annual_initial_declaration` WHERE `user_id` ='".$uid."' AND `annualyear`='".$annualyear."'";
                
                $queryin = "INSERT INTO `annual_initial_declaration` (user_id, user_group_id,send_status, pdfpath,annualyear,uniqueid,date_added,date_modified,timeago) 
                VALUES   ('".$uid."','".$usergroup."',0,'".$pdfpath."','".$annualyear."','".$uniqueid."',NOW(),NOW(),'".$time."')"; 
                
                $queryup = "UPDATE `annual_initial_declaration` SET `send_status` = 0,`sent_date` = NULL,`pdfpath` = '".$pdfpath."',`uniqueid` = '".$uniqueid."',`date_added`=NOW(),`date_modified`=NOW(),`timeago`='".$time."' WHERE `user_id` ='".$uid."' AND `annualyear`='".$annualyear."'";
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
                //echo 'in catch';
                return false;
            }
    }

     public function getallsavedpdf($uid,$usergroup)
  {
      $connection = $this->dbtrd;
      $myarr=array();
      $time = time();
      $query="SELECT * FROM annual_initial_declaration WHERE user_id='".$uid."'";
      try{
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
                $query="DELETE FROM annual_initial_declaration WHERE srno='".$delid."'";
                // print_r($query);exit;
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
        try{
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
        $query="SELECT * FROM annual_initial_declaration WHERE srno='".$reqid."'";
        try{
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
        try{
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
                  $status=$this->emailer->sendpdfmailapprannual($mail[$i]['email'],$getfile,$getname);
                  if($status==true)
                  {
                    $status= $this->annualdeclarationcommon->updateinitialdeclaration($reqid);
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
                $queryup = "UPDATE `annual_initial_declaration` SET `send_status`='1',`sent_date`= NOW() WHERE srno='".$reqid."'"; 
                // print_r($queryup);exit;
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
    
    //------------------- fetch Annual Declaration Form Data
    public function fetchannualformdata($masterid,$query)
    {    
        $connection = $this->dbtrd;
        
        $query=" SELECT anualdec.`pdfpath`,it.`wr_id`,it.`fullname`,anualdec.`send_status` 
        FROM it_memberlist it 
        LEFT JOIN `annual_initial_declaration` anualdec ON anualdec.`user_id`=it.`wr_id`
        WHERE it.`user_id`='".$masterid."' AND it.`status`=1 GROUP BY it.`wr_id`".$query;
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
    
    public function fetchannualformuserwise($userid,$query)
    {    
        $connection = $this->dbtrd;
        
        $query=" SELECT anualdec.`pdfpath`,it.`wr_id`,it.`fullname`,anualdec.`send_status`,anualdec.sent_date,anualdec.annualyear 
        FROM `annual_initial_declaration` anualdec 
        LEFT JOIN `it_memberlist` it ON anualdec.`user_id`=it.`wr_id` 
        WHERE anualdec.`user_id`='".$userid."' AND anualdec.send_status = '1' ORDER BY anualdec.srno DESC".$query;
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



/****************** insert Annual start ******************/
    public function inannualselfcompany($getuserid,$company,$decision,$transaction,$unique)
    {
     $connection = $this->dbtrd;
     $time = time();   

     for($i = 0; $i< sizeof($company);$i++)
     {
        

                           
          $queryinsert = "INSERT INTO `annual_self_company`
            (`user_id`,`company`,`decision`,`transaction`,`uniqueid`, `date_added`, `date_modified`,`timeago`)
             VALUES ('".$getuserid."','".$company[$i]."','".$decision[$i]."','".$transaction[$i]."','".$unique."',NOW(),NOW(),'".$time."')";
         
         
         //echo $queryinsert;
         $exe = $connection->query($queryinsert);
     }
        //echo 'here';exit;
         
            //echo $queryinsert;
        try
        {
            return true;
        }
        catch (Exception $e) 
        {
            //echo "checkng Exception";print_r($e);exit;
            return false;
        }
    }

   public function inannualselffirm($getuserid,$company,$interest,$decision,$transaction,$unique)
    {
     $connection = $this->dbtrd;
     $time = time();   
   

     for($i = 0; $i< sizeof($company);$i++)
     {              
          $queryinsert = "INSERT INTO `annual_self_firm`
            (`user_id`,`firm`,`interest`,`decision`,`transaction`,`uniqueid`, `date_added`, `date_modified`,`timeago`)
             VALUES ('".$getuserid."','".$company[$i]."','".$interest[$i]."','".$decision[$i]."','".$transaction[$i]."','".$unique."',NOW(),NOW(),'".$time."')";
         
         
         //echo $queryinsert;
         $exe = $connection->query($queryinsert);

     }
        //echo 'here';exit;
         
            //echo $queryinsert;
        try
        {
            return true;
        }
        catch (Exception $e) 
        {
            //echo "checkng Exception";print_r($e);exit;
            return false;
        }
    }
    
    public function inannualselfpubprivate($getuserid,$company,$interest,$decision,$transaction,$unique)
    {
     $connection = $this->dbtrd;
     $time = time();   
     // print_r($interest);echo "hello";exit;

     for($i = 0; $i< sizeof($company);$i++)
     {              
          $queryinsert = "INSERT INTO `annual_self_publicprivate`
            (`user_id`,`company`,`interest`,`decision`,`transaction`,`uniqueid`, `date_added`, `date_modified`,`timeago`)
             VALUES ('".$getuserid."','".$company[$i]."','".$interest[$i]."','".$decision[$i]."','".$transaction[$i]."','".$unique."',NOW(),NOW(),'".$time."')";
         
         
         //echo $queryinsert;
         $exe = $connection->query($queryinsert);

     }
        //echo 'here';exit;
         
            //echo $queryinsert;
        try
        {
            return true;
        }
        catch (Exception $e) 
        {
            //echo "checkng Exception";print_r($e);exit;
            return false;
        }
    }
    

     public function inannualselfpubshare($getuserid,$company,$interest,$decision,$transaction,$unique)
    {
     $connection = $this->dbtrd;
     $time = time();   
     // print_r($interest);echo "hello";exit;

     for($i = 0; $i< sizeof($company);$i++)
     {              
          $queryinsert = "INSERT INTO `annual_self_publicshare`
            (`user_id`,`company`,`interest`,`decision`,`transaction`,`uniqueid`, `date_added`, `date_modified`,`timeago`)
             VALUES ('".$getuserid."','".$company[$i]."','".$interest[$i]."','".$decision[$i]."','".$transaction[$i]."','".$unique."',NOW(),NOW(),'".$time."')";
         
         
         //echo $queryinsert;
         $exe = $connection->query($queryinsert);

     }
        //echo 'here';exit;
         
            //echo $queryinsert;
        try
        {
            return true;
        }
        catch (Exception $e) 
        {
            //echo "checkng Exception";print_r($e);exit;
            return false;
        }
    }

    public function inannualrelativecompany($getuserid,$relative,$company,$decision,$transaction,$unique)
    {
     $connection = $this->dbtrd;
     $time = time();   
     // print_r($interest);echo "hello";exit;

     for($i = 0; $i< sizeof($relative);$i++)
     {              
          $queryinsert = "INSERT INTO `annual_relative`
            (`user_id`,`relative`,`company`,`decision`,`transaction`,`uniqueid`, `date_added`, `date_modified`,`timeago`)
             VALUES ('".$getuserid."','".$relative[$i]."','".$company[$i]."','".$decision[$i]."','".$transaction[$i]."','".$unique."',NOW(),NOW(),'".$time."')";
         
         
         //echo $queryinsert;
         $exe = $connection->query($queryinsert);

     }
        //echo 'here';exit;
         
            //echo $queryinsert;
        try
        {
            return true;
        }
        catch (Exception $e) 
        {
            //echo "checkng Exception";print_r($e);exit;
            return false;
        }
    }

    public function inannualrelativefirm($getuserid,$relative,$company,$interest,$decision,$transaction,$unique)
    {
     $connection = $this->dbtrd;
     $time = time();   
     //print_r($transaction);echo "hello";exit;

     for($i = 0; $i< sizeof($relative);$i++)
     {              
          $queryinsert = "INSERT INTO `annual_relative_firm`
            (`user_id`,`relative`,`firm`,`interest`,`decision`,`transaction`,`uniqueid`, `date_added`, `date_modified`,`timeago`)
             VALUES ('".$getuserid."','".$relative[$i]."','".$company[$i]."','".$interest[$i]."','".$decision[$i]."','".$transaction[$i]."','".$unique."',NOW(),NOW(),'".$time."')";
         
         
         //echo $queryinsert;
         $exe = $connection->query($queryinsert);

     }
        //echo 'here';exit;
         
            //echo $queryinsert;
        try
        {
            return true;
        }
        catch (Exception $e) 
        {
            //echo "checkng Exception";print_r($e);exit;
            return false;
        }
    }

     public function inannualrelativepublicshare($getuserid,$relative,$company,$interest,$decision,$transaction,$unique)
    {
     $connection = $this->dbtrd;
     $time = time();   
     //print_r($transaction);echo "hello";exit;

     for($i = 0; $i< sizeof($relative);$i++)
     {              
          $queryinsert = "INSERT INTO `annual_relative_publicprivate`
            (`user_id`,`relative`,`company`,`interest`,`decision`,`transaction`,`uniqueid`, `date_added`, `date_modified`,`timeago`)
             VALUES ('".$getuserid."','".$relative[$i]."','".$company[$i]."','".$interest[$i]."','".$decision[$i]."','".$transaction[$i]."','".$unique."',NOW(),NOW(),'".$time."')";
         
         
         //echo $queryinsert;
         $exe = $connection->query($queryinsert);

     }
        //echo 'here';exit;
         
            //echo $queryinsert;
        try
        {
            return true;
        }
        catch (Exception $e) 
        {
            //echo "checkng Exception";print_r($e);exit;
            return false;
        }
    }


 /****************** insert Annual End ******************/
    

  public function annual_self_company($uid,$usergroup,$uniqueid)
  {
      $connection = $this->dbtrd;
      $myarr=array();
      $time = time();
      $query="SELECT * FROM annual_self_company WHERE user_id='".$uid."' && uniqueid= '".$uniqueid."'";
      //print_r($query);exit; 
      try{
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

   public function annual_self_firm($uid,$usergroup,$uniqueid)
  {

      $connection = $this->dbtrd;
      $myarr=array();
      $time = time();
      $query="SELECT * FROM annual_self_firm WHERE user_id='".$uid."' && uniqueid= '".$uniqueid."'";
      try{
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
   public function annual_self_pubpri($uid,$usergroup,$uniqueid)
  {
      $connection = $this->dbtrd;
      $myarr=array();
      $time = time();
      $query="SELECT * FROM annual_self_publicprivate WHERE user_id='".$uid."' && uniqueid= '".$uniqueid."'";
      try{
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
   public function annual_self_pubshare($uid,$usergroup,$uniqueid)
  {
      $connection = $this->dbtrd;
      $myarr=array();
      $time = time();
      $query="SELECT * FROM annual_self_publicshare WHERE user_id='".$uid."' && uniqueid= '".$uniqueid."'";
      try{
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
   public function annual_relative($uid,$usergroup,$uniqueid)
  {
      $connection = $this->dbtrd;
      $myarr=array();
      $time = time();
      $query="SELECT ar.`id`,ar.`company`,ar.`decision`,ar.`transaction`, ar.`relative`, r.`relationshipname` FROM annual_relative ar LEFT JOIN relationship r ON ar.`relative` = r.`id` WHERE user_id='".$uid."' && uniqueid= '".$uniqueid."'";

      try{
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
   public function annual_relative_firm($uid,$usergroup,$uniqueid)
  {
      $connection = $this->dbtrd;
      $myarr=array();
      $time = time();
      $query="SELECT  ar.`id`,ar.`firm`,ar.`decision`,ar.`transaction`,ar.`interest`, ar.`relative`, r.`relationshipname` FROM annual_relative_firm ar LEFT JOIN relationship r ON ar.`relative` = r.`id` WHERE user_id='".$uid."' && uniqueid= '".$uniqueid."'";
     // print_r($query);exit;
      try{
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
   public function annual_relative_pubpri($uid,$usergroup,$uniqueid)
  {
      $connection = $this->dbtrd;
      $myarr=array();
      $time = time();
      $query="SELECT  ar.`id`, ar.`company`,ar.`decision`,ar.`transaction`, ar.`interest`,ar.`relative`, r.`relationshipname` FROM annual_relative_publicprivate ar LEFT JOIN relationship r ON ar.`relative` = r.`id` WHERE user_id='".$uid."' && uniqueid= '".$uniqueid."'";
      try{
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

  public function get_relatives($uid,$usergroup)
  {
    

      $connection = $this->dbtrd;
      $myarr=array();
      $time = time();
      $query="SELECT * FROM relationship";

      try{
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
      //print_r($getlist);exit;

      return $getlist;


  }

  public function relatives_info($uid)
  {
    

      $connection = $this->dbtrd;
      $myarr=array();
      $time = time();
      $query="SELECT * FROM relative_info WHERE user_id='".$uid."'";

      try{
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
      //print_r($getlist);exit;

      return $getlist;


  }


  public function upannualselfcompany($uid,$company,$decision,$transaction,$unique,$id)
    {
       $connection = $this->dbtrd;
       $time = time();

    try
    {
      
      $count = count($company);
  
      
      for($i = 0; $i < $count; $i++)
      {
         
         $check = "SELECT * from annual_self_company WHERE user_id='".$uid."' && uniqueid= '".$unique."' && id= '".$id[$i]."' ";  

         $queryupdate =  "UPDATE `annual_self_company` SET `company` = '".$company[$i]."',`decision` = '".$decision[$i]."',`transaction` = '".$transaction[$i]."',`date_added`=NOW(),`date_modified`=NOW(),`timeago`='".$time."' WHERE `user_id` ='".$uid."' AND `uniqueid`='".$unique."' AND `id` = '".$id[$i]."'";

         $queryinsert = "INSERT INTO `annual_self_company`
            (`user_id`,`company`,`decision`,`transaction`,`uniqueid`, `date_added`, `date_modified`,`timeago`)
             VALUES ('".$uid."','".$company[$i]."','".$decision[$i]."','".$transaction[$i]."','".$unique."',NOW(),NOW(),'".$time."')";
                           
         
         
         
         // echo $check;exit;
          $exe = $connection->query($check);
          $getnum = trim($exe->numRows());

          if($getnum>0)
                {
                   echo "update";exit;
                   $exegetqry = $connection->query($queryupdate);
                }
                else
                {   
                    $exegetqry = $connection->query($queryinsert);
                }


               
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
        catch (Exception $e) 
        {
            //echo "checkng Exception";print_r($e);exit;
            return false;
        }
  }


public function upannualselffirm($uid,$company,$interest,$decision,$transaction,$unique,$id)
  {
    
    $connection = $this->dbtrd;
    $time = time();

    try
    {
      
      $count = count($company);


      for($i = 0; $i < $count; $i++)
      {
         
         $check = "SELECT * from annual_self_firm WHERE user_id='".$uid."' && uniqueid= '".$unique."' && id= '".$id[$i]."' ";  

         $queryupdate =  "UPDATE `annual_self_firm` SET `firm` = '".$company[$i]."',`interest` = '".$interest[$i]."',`decision` = '".$decision[$i]."',`transaction` = '".$transaction[$i]."',`date_added`=NOW(),`date_modified`=NOW(),`timeago`='".$time."' WHERE `user_id` ='".$uid."' AND `uniqueid`='".$unique."' AND `id` = '".$id[$i]."'";
        
         

         $queryinsert = "INSERT INTO `annual_self_firm`
            (`user_id`,`firm`,`interest`,`decision`,`transaction`,`uniqueid`, `date_added`, `date_modified`,`timeago`)
             VALUES ('".$uid."','".$company[$i]."','".$interest[$i]."','".$decision[$i]."','".$transaction[$i]."','".$unique."',NOW(),NOW(),'".$time."')";
                           
         
         
         //echo $queryinsert;
          $exe = $connection->query($check);
          $getnum = trim($exe->numRows());

          if($getnum>0)
                {
                   //echo $queryupdate;
                   $exegetqry = $connection->query($queryupdate);
                }
                else
                {   //echo $queryinsert;
                    $exegetqry = $connection->query($queryinsert);
                }


               
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
        catch (Exception $e) 
        {
            //echo "checkng Exception";print_r($e);exit;
            return false;
        }
}


public function upannualselfpubprivate($uid,$company,$interest,$decision,$transaction,$unique,$id)
  {
    
    $connection = $this->dbtrd;
    $time = time();

    try
    {
      
      $count = count($company);


      for($i = 0; $i < $count; $i++)
      {
         
         $check = "SELECT * from annual_self_publicprivate WHERE user_id='".$uid."' && uniqueid= '".$unique."' && id= '".$id[$i]."' ";  

         $queryupdate =  "UPDATE `annual_self_publicprivate` SET `company` = '".$company[$i]."',`interest` = '".$interest[$i]."',`decision` = '".$decision[$i]."',`transaction` = '".$transaction[$i]."',`date_added`=NOW(),`date_modified`=NOW(),`timeago`='".$time."' WHERE `user_id` ='".$uid."' AND `uniqueid`='".$unique."' AND `id` = '".$id[$i]."'";
        
         

         $queryinsert = "INSERT INTO `annual_self_publicprivate`
            (`user_id`,`company`,`interest`,`decision`,`transaction`,`uniqueid`, `date_added`, `date_modified`,`timeago`)
             VALUES ('".$uid."','".$company[$i]."','".$interest[$i]."','".$decision[$i]."','".$transaction[$i]."','".$unique."',NOW(),NOW(),'".$time."')";
                           
         
         
         //echo $queryinsert;
          $exe = $connection->query($check);
          $getnum = trim($exe->numRows());

          if($getnum>0)
                {
                   echo $queryupdate;
                   $exegetqry = $connection->query($queryupdate);
                }
                else
                {   echo $queryinsert;
                    $exegetqry = $connection->query($queryinsert);
                }


               
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
        catch (Exception $e) 
        {
            //echo "checkng Exception";print_r($e);exit;
            return false;
        }
}

public function upannualselfpubshare($uid,$company,$interest,$decision,$transaction,$unique,$id)
  {
    
    $connection = $this->dbtrd;
    $time = time();

    try
    {
      
      $count = count($company);


      for($i = 0; $i < $count; $i++)
      {
         
         $check = "SELECT * from annual_self_publicshare WHERE user_id='".$uid."' && uniqueid= '".$unique."' && id= '".$id[$i]."' ";  

         $queryupdate =  "UPDATE `annual_self_publicshare` SET `company` = '".$company[$i]."',`interest` = '".$interest[$i]."',`decision` = '".$decision[$i]."',`transaction` = '".$transaction[$i]."',`date_added`=NOW(),`date_modified`=NOW(),`timeago`='".$time."' WHERE `user_id` ='".$uid."' AND `uniqueid`='".$unique."' AND `id` = '".$id[$i]."'";
        
         

         $queryinsert = "INSERT INTO `annual_self_publicshare`
            (`user_id`,`company`,`interest`,`decision`,`transaction`,`uniqueid`, `date_added`, `date_modified`,`timeago`)
             VALUES ('".$uid."','".$company[$i]."','".$interest[$i]."','".$decision[$i]."','".$transaction[$i]."','".$unique."',NOW(),NOW(),'".$time."')";
                           
         
         
         //echo $queryinsert;
          $exe = $connection->query($check);
          $getnum = trim($exe->numRows());

          if($getnum>0)
                {
                   echo $queryupdate;
                   $exegetqry = $connection->query($queryupdate);
                }
                else
                {   echo $queryinsert;
                    $exegetqry = $connection->query($queryinsert);
                }


               
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
        catch (Exception $e) 
        {
            //echo "checkng Exception";print_r($e);exit;
            return false;
        }
}


public function upannualrelativecompany($uid,$relative,$company,$decision,$transaction,$unique,$id)
  {
    
    $connection = $this->dbtrd;
    $time = time();

    try
    {
      
      $count = count($company);


      for($i = 0; $i < $count; $i++)
      {
         
         $check = "SELECT * from annual_relative WHERE user_id='".$uid."' && uniqueid= '".$unique."' && id= '".$id[$i]."' ";  

         $queryupdate =  "UPDATE `annual_relative` SET `company` = '".$company[$i]."',`relative` = '".$relative[$i]."',`decision` = '".$decision[$i]."',`transaction` = '".$transaction[$i]."',`date_added`=NOW(),`date_modified`=NOW(),`timeago`='".$time."' WHERE `user_id` ='".$uid."' AND `uniqueid`='".$unique."' AND `id` = '".$id[$i]."'";
        
         

         $queryinsert = "INSERT INTO `annual_relative`
            (`user_id`,`relative`,`company`,`decision`,`transaction`,`uniqueid`, `date_added`, `date_modified`,`timeago`)
             VALUES ('".$uid."','".$relative[$i]."','".$company[$i]."','".$decision[$i]."','".$transaction[$i]."','".$unique."',NOW(),NOW(),'".$time."')";
                           
         
         
         //echo $queryinsert;
          $exe = $connection->query($check);
          $getnum = trim($exe->numRows());

          if($getnum>0)
                {
                   echo $queryupdate;
                   $exegetqry = $connection->query($queryupdate);
                }
                else
                {   echo $queryinsert;
                    $exegetqry = $connection->query($queryinsert);
                }


               
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
        catch (Exception $e) 
        {
            //echo "checkng Exception";print_r($e);exit;
            return false;
        }
}


public function upannualrelativefirm($uid,$relative,$company,$interest,$decision,$transaction,$unique,$id)
  {
    
    $connection = $this->dbtrd;
    $time = time();

    try
    {
      
      $count = count($company);


      for($i = 0; $i < $count; $i++)
      {
         
         $check = "SELECT * from annual_relative_firm WHERE user_id='".$uid."' && uniqueid= '".$unique."' && id= '".$id[$i]."' ";  

         $queryupdate =  "UPDATE `annual_relative_firm` SET `firm` = '".$company[$i]."',`relative` = '".$relative[$i]."',`interest` = '".$interest[$i]."',`decision` = '".$decision[$i]."',`transaction` = '".$transaction[$i]."',`date_added`=NOW(),`date_modified`=NOW(),`timeago`='".$time."' WHERE `user_id` ='".$uid."' AND `uniqueid`='".$unique."' AND `id` = '".$id[$i]."'";
        
         

         $queryinsert = "INSERT INTO `annual_relative_firm`
            (`user_id`,`relative`,`firm`,`interest`,`decision`,`transaction`,`uniqueid`, `date_added`, `date_modified`,`timeago`)
             VALUES ('".$uid."','".$relative[$i]."','".$company[$i]."','".$interest[$i]."','".$decision[$i]."','".$transaction[$i]."','".$unique."',NOW(),NOW(),'".$time."')";
                           
         
         
         //echo $queryinsert;
          $exe = $connection->query($check);
          $getnum = trim($exe->numRows());

          if($getnum>0)
                {
                   echo $queryupdate;
                   $exegetqry = $connection->query($queryupdate);
                }
                else
                {   echo $queryinsert;
                    $exegetqry = $connection->query($queryinsert);
                }


               
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
        catch (Exception $e) 
        {
            //echo "checkng Exception";print_r($e);exit;
            return false;
        }
}


public function upannualrelativepublicshare($uid,$relative,$company,$interest,$decision,$transaction,$unique,$id)
  {
    
    $connection = $this->dbtrd;
    $time = time();

    try
    {
      
      $count = count($company);


      for($i = 0; $i < $count; $i++)
      {
         
         $check = "SELECT * from annual_relative_publicprivate WHERE user_id='".$uid."' && uniqueid= '".$unique."' && id= '".$id[$i]."' ";  

         $queryupdate =  "UPDATE `annual_relative_publicprivate` SET `company` = '".$company[$i]."',`relative` = '".$relative[$i]."',`interest` = '".$interest[$i]."',`decision` = '".$decision[$i]."',`transaction` = '".$transaction[$i]."',`date_added`=NOW(),`date_modified`=NOW(),`timeago`='".$time."' WHERE `user_id` ='".$uid."' AND `uniqueid`='".$unique."' AND `id` = '".$id[$i]."'";
        
         

         $queryinsert = "INSERT INTO `annual_relative_publicprivate`
            (`user_id`,`relative`,`company`,`interest`,`decision`,`transaction`,`uniqueid`, `date_added`, `date_modified`,`timeago`)
             VALUES ('".$uid."','".$relative[$i]."','".$company[$i]."','".$interest[$i]."','".$decision[$i]."','".$transaction[$i]."','".$unique."',NOW(),NOW(),'".$time."')";
                           
         
         
         //echo $queryinsert;
          $exe = $connection->query($check);
          $getnum = trim($exe->numRows());

          if($getnum>0)
                {
                   
                   $exegetqry = $connection->query($queryupdate);
                }
                else
                {   
                    $exegetqry = $connection->query($queryinsert);
                }


               
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
        catch (Exception $e) 
        {
            //echo "checkng Exception";print_r($e);exit;
            return false;
        }
}

}
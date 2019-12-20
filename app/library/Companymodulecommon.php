<?php
use Phalcon\Mvc\User\Component;

class Companymodulecommon extends Component
{
   public function fetchcmplist($mainqry,$getuserid){
       
       $connection = $this->dbtrd;
       $sqlquery = "SELECT * FROM `listedcmpmodule` WHERE added_by='".$getuserid."'".$mainqry; 
        
      // echo $sqlquery; 
       try{
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
  public function addcmpmodule($getuserid,$usergroup,$cmpname){
      $connection = $this->dbtrd;
      try{
      $sqlquery="SELECT * FROM listedcmpmodule WHERE `company_name`='".$cmpname."' AND added_by='".$getuserid."'";
      $exe = $connection->query($sqlquery);
      $getnum = trim($exe->numRows());
      if($getnum>0)
      {
         return 2;
      }
      else{
        $sql="INSERT INTO listedcmpmodule (company_name,access,added_by) VALUES ('".$cmpname."','1','".$getuserid."')";
        
            $exeget = $connection->query($sql);
            if($exeget)
            {
              return true;
            }
            else{
               return false;
            }
         
        }
     }catch(Exception $e){return false;}
  }
  public function deletecompanymodule($getuserid,$usergroup,$delid){
       $connection = $this->dbtrd;
       $sqlquery = "DELETE FROM listedcmpmodule WHERE id='".$delid."'";
        try{
            $exeget = $connection->query($sqlquery);
            $getnum = trim($exeget->numRows());
            if($exeget){
              return true;
            }
            else{
                return false;
            }
          }catch(Exception $e){

          }
      }

 public function fetcheditcmp($getuserid,$usergroup,$editid)
 {
     $connection = $this->dbtrd;
     try{ $row=array();
          $sqlquery="SELECT * FROM listedcmpmodule WHERE `id`='".$editid."'";
          $exe = $connection->query($sqlquery);
           $getnum = trim($exe->numRows());
             if($getnum>0)
             {
            
               $row = $exe->fetch();
               return $row;

             }
            else
            {
               
                return $row;
            }
         }catch(Exception $e)
         {
             return false;
         }

 }

 public function updatecmp($getuserid,$usergroup,$cmpname,$editcmpid)
 {
   $connection = $this->dbtrd;
   $sql="UPDATE listedcmpmodule SET company_name = '".$cmpname."' WHERE id ='".$editcmpid."'";
    $exe = $connection->query($sql);
    if($exe){
    return true;
    }
    else{
     return false;
    }

 }

}



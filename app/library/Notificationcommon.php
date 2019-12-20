<?php
use Phalcon\Mvc\User\Component;

class Notificationcommon extends Component
{



    public function insertfornotify($reqid,$nameofrequester,$approverid,$type)
    {
        $connection = $this->dbtrd;
        $time=time();
        if($type==1)
        {
           $comment="You Have Approval Request From  ".$nameofrequester;
           
        }
        else if($type==2)
        {
           $comment="Dear  ".$nameofrequester."  Your Request Has Been Approved..!!!";
        }
         else if($type==3)
        {
           $comment=$nameofrequester."  Has Done Final Submission Please Check Your Request Section..!!!";
        }
         else if($type==4)
        {
           $comment=$nameofrequester."  Has Inserted Database of Connected Person..!!!";
        }
          else if($type==5)
        {
           $comment=$nameofrequester."  Has Edited Database of Connected Person..!!!";
        }
         else if($type==6)
        {
           $comment=$nameofrequester."  Has Inserted Data In Information Sharing..!!!";
        }
         else if($type==7)
        {
           $comment=$nameofrequester."  Has Inserted End Date  In Information Sharing..!!!";
        }
          else if($type==8)
        {
           $comment="your  Trading Plan Has Been Approved..!!!";
        }
           else if($type==9)
        {
           $comment="your  Trading Plan Has Been Rejected..!!!";
        }
         else if($type==10)
        {
           $comment="You Have Recieved Trading Plan Approval Request..!!!";
        }
           else if($type==11)
        {
           $comment="New Company Added In Your Blackout Period..!!!";
        }
          
          
        
            $queryget="INSERT INTO `user_notification`(`type_of_notifi`,`matrix_id`,
            `content`,`date_added`,`date_modified`,`timeago`) VALUES('".$type."','".$approverid."','".$comment."',
             NOW(),NOW(),'".$time."')";


        try
        {
           $exeget = $connection->query($queryget);

            if($exeget)
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


    public function insertnotification($reqid,$type)
    {
		$conn = $this->dbtrd;
		$time=time();


		$myarr=explode(",",$reqid);
		// print_r($myarr);exit;
		for($i=0;$i<count($myarr);$i++)
		{
			$chkqry='SELECT * FROM `personal_request` WHERE id="'.$myarr[$i].'"';
			// print_r($chkqry);exit;
			$exeno= $conn->query($chkqry);
			$noofrows = trim($exeno->numRows());

			if($noofrows>0)
			{
				while($rowusrlst = $exeno->fetch())
				{
					$data = $rowusrlst;
					if($type==2)
					{
					$notific=$this->notificationcommon->insertfornotify($myarr[$i],$data['name_of_requester'],$data['user_id'],$type);
					}

					else if($type==1 || $type==3 || $type==4  || $type==5 || $type==6)
					{
					$notific=$this->notificationcommon->insertfornotify($myarr[$i],$data['name_of_requester'],$data['approver_id'],$type);
					}

			    }
		    }  
		}

    }

public function getallnotification($userid)
{
	$connection = $this->dbtrd;
   // $getmasterid = $this->tradingrequestcommon->getmasterid($getuserid);
   // print_r($getmasterid['user_id']);exit;
	$sqlquery = "SELECT * FROM `user_notification` WHERE FIND_IN_SET('".$userid."',`matrix_id`) "; 
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
		}
		else
		{  
		   $getlist = array(); 
		}
	}
	catch (Exception $e)
	{   $getlist = array();
	}

   return $getlist;
}



public function deletenotification($getuserid)
{
	$connection = $this->dbtrd;
	$getallnotif=$this->getallnotification($getuserid);
	$array= explode(",",$getallnotif[0]['matrix_id']);
	$array_to_remove = array($getuserid);
	$final_array = array_diff($array,$array_to_remove);
	$final_array=implode(",",$final_array);


	try{
			for($i=0;$i<count($getallnotif);$i++)
			{

				$query = "UPDATE `user_notification` SET  matrix_id='".$final_array."' 
				WHERE id='".$getallnotif[$i]['id']."'";

				$exeget = $connection->query($query);
				if($exeget)
				{
				// return true;
				}
				else
				{
				// return false;
				}
			}
	}catch(Exception $e)
	{
     	return false;
	}

}
 
 public function upsisharingnotify($getuserid,$lastid,$type)
 {
      $getres = $this->insidercommon->fetchiddata($lastid,'it_memberlist','wr_id',$getuserid);
      $result= $this->insertfornotify($lastid,$getres['fullname'],$getres['approvid'],$type);
 }
 
 public function tradingplanapproval($getuserid,$tradeid,$type)
 { 
 	// print_r($tradeid);exit;
 	for($i=0;$i<count($tradeid);$i++)
 	{
      $getres = $this->insidercommon->fetchiddata("",'tradingplan_request','id',$tradeid[$i]);
      $result= $this->insertfornotify("","",$getres['user_id'],$type);

    }
 
 }

  public function blackoutperiodnotify($getuserid,$user_group_id,$lastid,$type)
  {
        $getres = $this->insidercommon->getGroupUsers($getuserid,$user_group_id);
        $result= $this->insertfornotify("","",$getres['ulstring'],$type);  
  }

}
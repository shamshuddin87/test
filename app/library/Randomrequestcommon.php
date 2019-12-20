<?php
use Phalcon\Mvc\User\Component;

class Randomrequestcommon extends Component
{
 
    /********** approve to rqst start **********/
     public function aprrovalrequst($rqstid,$vote,$comment,$requserid) 
     {
         $connection = $this->dbtrd;
        
          // print_r($requserid);exit;

         if($vote == 1)
         {
             $approvstatus = 1;
             $sendstatus = 1;
             $masterid = $this->tradingrequestcommon->getmasterid($requserid);
             $queryget = "SELECT * FROM  `trading_days` WHERE `user_id` = '".$masterid['user_id']."'";
             $exeget = $connection->query($queryget);
             $getnum = trim($exeget->numRows());
        if($getnum>0)
        {
            $getlst= $exeget->fetch();
            $mydate=date('d-m-Y');
            $tradedate=date('d-m-Y', strtotime($mydate. ' + '.$getlst['noofdays'].' days'));
        }
        else
        {
            $tradedate='';
        }
         }
         elseif($vote == 0)
         {
             $approvstatus = 2;
             $sendstatus = 0;
             $tradedate='';
         }

       

         $queryup = "UPDATE `personal_request` SET `approved_status`='".$approvstatus."' ,`approved_date`=NOW() ,`rejected_message`='".$comment."',
               `send_status`='".$sendstatus."',`trading_date`='".$tradedate."' WHERE `id` = '".$rqstid."'";
         try
         {
             $exe = $connection->query($queryup);
             return true;
         }
         catch(Exception $e)
         {
             return false;
         }
     }
    /********** approve to rqst end **********/
    
    /********* get ackwldg mail data start *********/
    public function mailacknwtoapprvr($rqstid)
    {
        $connection = $this->dbtrd;
        $querygetdetail = "SELECT pr.*,cmp.`company_name`,trans.`transaction`,memb.`email`,secu.`security_type` FROM `personal_request` pr 
                            LEFT JOIN `listedcmpmodule` cmp ON cmp.`id` = pr.`id_of_company`
                            LEFT JOIN `type_of_transaction` trans ON trans.`id` = pr.`type_of_transaction`
                            LEFT JOIN `it_memberlist` memb ON memb.`wr_id` = pr.`user_id`
                            LEFT JOIN `req_securitytype` secu ON secu.`id` = pr.`sectype`
                            WHERE pr.id='".$rqstid."'";
        //echo $querygetdetail;exit;
        try
        {
                $exegetdetail = $connection->query($querygetdetail);
                $getnum = trim($exegetdetail->numRows());

                if($getnum>0)
                {
                    while($row = $exegetdetail->fetch())
                    {
                        $getlist[] = $row;
                    }
                }
                else
                {
                    $getlist[] = array();
                }
        }
        catch (Exception $e)
        {
            $getlist = array();
        //$connection->close();
        }
        return $getlist;
    }
    /********* get ackwldg mail data end **********/
    
    /*----- check if this request already approved or not ------*/
    public function checkalreadyaproved($rqst)
    {
        $connection = $this->dbtrd;
        $queryget = "SELECT * FROM `personal_request` WHERE `id` = '".$rqst."'";

            //echo $queryget;  exit;

             try{
                    $exeget = $connection->query($queryget);
                    $getnum = trim($exeget->numRows());

                    if($getnum>0)
                    {
                        while($row = $exeget->fetch())
                        {
                          $getlist[] = $row;
                        }
                    }
                    else{
                        $getlist[] = array();
                    }
                }
                catch (Exception $e)
                {
                    $getlist = array();
                    //$connection->close();
                }
            //echo '<pre>';print_r($getlist);exit;
            return $getlist;
    }
    /*----- check if this request already approved or not ------*/
    
    
}


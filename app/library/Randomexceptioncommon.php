<?php
use Phalcon\Mvc\User\Component;

class Randomexceptioncommon extends Component
{
 
    /********** approve to rqst start **********/
     public function aprrovalexcrequst($excrqstid,$vote,$comment,$rqstid) 
     {
         $connection = $this->dbtrd;
         if($vote == 1)
         {
             $approvstatus = 1;
         }
         elseif($vote == 0)
         {
             $approvstatus = 2;
         }

         $queryup = "UPDATE `trading_status` SET `excepapp_status`='".$approvstatus."',`excepapprv_date`=NOW() ,`rej_message`='".$comment."' WHERE `id` = '".$excrqstid."'";
         
         $queryupreq = "UPDATE `personal_request` SET `exception_approve`=0 WHERE `id` = '".$rqstid."'";
         //echo $queryupreq;exit;
         try
         {
             $exe = $connection->query($queryup);
             $exeupreq = $connection->query($queryupreq);
             return true;
         }
         catch(Exception $e)
         {
             return false;
         }
     }
    /********** approve to rqst end **********/
    
    /********* get ackwldg mail data start *********/
    public function mailacknwtoexcapprvr($rqstid)
    {
        $connection = $this->dbtrd;
        $querygetdetail = "SELECT ts.*,cmp.`company_name`,trans.`transaction`,memb.`email`,secu.`security_type`,pr.`no_of_shares` as noofsecurity 
                            FROM `trading_status` ts 
                            LEFT JOIN `listedcmpmodule` cmp ON cmp.`id` = ts.`id_of_company` 
                            LEFT JOIN `it_memberlist` memb ON memb.`wr_id` = ts.`user_id` 
                            LEFT JOIN `req_securitytype` secu ON secu.`id` = ts.`sectype` 
                            LEFT JOIN `personal_request` pr ON pr.`id` = ts.`req_id` 
                            LEFT JOIN `type_of_transaction` trans ON trans.`id` = pr.`type_of_transaction`
                            WHERE ts.id='".$rqstid."'";
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
    public function exccheckalreadyaproved($exerqst)
    {
        $connection = $this->dbtrd;
        $queryget = "SELECT * FROM `trading_status` WHERE `id` = '".$exerqst."'";

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


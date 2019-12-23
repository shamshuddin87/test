<?php
ini_set("max_execution_time", '1800');
ini_set('memory_limit', '1024M');

class AutomailerController extends ControllerBase
{
    public function initialize()
    {
        $getlan    = $this->elements->getTranslation();
        
        $this->tag->setTitle($getlan['websitetitle']);
        parent::initialize();
    }

    public function indexAction()
    {
         
    }
    
    
/* ################################# Start EmailQueue ################################# */   
    public function insiderEmailQueueAction()
    {
        $time = time();
        $todaydate = date('d-m-Y');
        $todaytime = date('h:i:sa');
        $datetime = $todaydate.$todaytime;
        //echo '<pre>'; print_r($todaydate.'*'.$todaytime); exit;
        
        // ------ Start Get Data ------
        $senddata = $this->automailercommon->getEmailQueueData();
        //echo '<pre>'; print_r($senddata); exit;
        // ------ End Get Data ------
        
        if(!empty($senddata))
        {
            foreach($senddata as $sky => $svl)
            {
                //echo '<pre>'; print_r($svl); exit;
                
                
            /* ----- Start Company Restriction (Restricted Company List) ----- */
                if($svl['qtypeid']=='1')
                {
                    $emailid = $svl['sendtoemail'];
                    $username = $svl['sendtoname'];
                    
                    if(!empty($svl['maildata']))
                    {
                        $maildata = json_decode($svl['maildata'], true);
                        //echo '<pre>'; print_r($maildata); exit;

                        // ---
                        if(isset($maildata['getcompdata']))
                        {   $getcompdata = $maildata['getcompdata'];    }
                        else
                        {   $getcompdata = '';    }
                        
                        // ---
                        if(isset($maildata['periodfrom']))
                        {   $periodfrom = $maildata['periodfrom'];    }
                        else
                        {   $periodfrom = '';    }
                        
                        // ---
                        if(isset($maildata['periodto']))
                        {   $periodto = $maildata['periodto'];    }
                        else
                        {   $periodto = '';    }
                    }
                    else
                    {
                        $getcompdata = '';
                        $periodfrom = '';
                        $periodto = '';
                    }                    
                    
                    $result = $this->emailer->mailcomprestriction($emailid,$username,$getcompdata,$periodfrom,$periodto);
                    //echo '<pre>'; print_r($result); exit;
                    
                }
            /* ----- End Company Restriction (Restricted Company List) ----- */
                
                
            /* ----- Start Employee Blocking (Restricted Company List) ----- */
                if($svl['qtypeid']=='2')
                {
                    $emailid = $svl['sendtoemail'];
                    $username = $svl['sendtoname'];
                    
                    if(!empty($svl['maildata']))
                    {
                        $maildata = json_decode($svl['maildata'], true);
                        //echo '<pre>'; print_r($maildata); exit;

                        // ---
                        if(isset($maildata['getcompdata']))
                        {   $getcompdata = $maildata['getcompdata'];    }
                        else
                        {   $getcompdata = '';    }
                        
                        // ---
                        if(isset($maildata['periodfrom']))
                        {   $periodfrom = $maildata['periodfrom'];    }
                        else
                        {   $periodfrom = '';    }
                        
                        // ---
                        if(isset($maildata['periodto']))
                        {   $periodto = $maildata['periodto'];    }
                        else
                        {   $periodto = '';    }
                    }
                    else
                    {
                        $getcompdata = '';
                        $periodfrom = '';
                        $periodto = '';
                    }                    
                    
                    $result = $this->emailer->mailemprestriction($emailid,$username,$getcompdata,$periodfrom,$periodto);
                    //echo '<pre>'; print_r($result); exit;
                    
                }
            /* ----- End Employee Blocking (Restricted Company List) ----- */
                
                
            /* ----- Start Blackout Period (Trading Window) ----- */
                if($svl['qtypeid']=='3')
                {
                    $emailid = $svl['sendtoemail'];
                    
                    if(!empty($svl['maildata']))
                    {
                        $maildata = json_decode($svl['maildata'], true);
                        //echo '<pre>'; print_r($maildata); exit;

                        // ---
                        if(isset($maildata['emailcontent']))
                        {   $emailcontent = $maildata['emailcontent'];    }
                        else
                        {   $emailcontent = '';    }
                    }
                    else
                    {
                        $emailcontent = '';
                    }
                    
                    $result = $this->emailer->mailoftradingwindow($emailcontent,$emailid);
                    //echo '<pre>'; print_r($result); exit;
                    
                }
            /* ----- End Blackout Period (Trading Window) ----- */
                
                /*--- send UPSI trading window mail --*/
                if($svl['qtypeid']=='5')
                {
                    $emailid = $svl['sendtoemail'];
                    $username = $svl['sendtoname'];
                    $usergrpid = $svl['user_group_id'];
                    if(!empty($svl['maildata']))
                    {
                        $maildata = json_decode($svl['maildata'], true);
                        //echo '<pre>'; print_r($maildata); exit;
                        // ---
                        if(isset($maildata['upsitype']))
                        {   $upsitype = $maildata['upsitype'];    }
                        else
                        {   $upsitype = '';    }
                        
                        // ---
                        if(isset($maildata['enddate']))
                        {   $enddate = $maildata['enddate'];    }
                        else
                        {   $enddate = '';    }
                        
                        if(isset($maildata['nameaddedby']))
                        {   $addedby = $maildata['nameaddedby'];    }
                        else
                        {   $addedby = '';    }
                        
                        if(isset($maildata['emaildate']))
                        {   $emaildate = $maildata['emaildate'];    }
                        else
                        {   $emaildate = '';    }
                        
                        if(isset($maildata['projectstart']))
                        {   $pstartdate = $maildata['projectstart'];    }
                        else
                        {   $pstartdate = '';    }
                        
                        
                    }
                    else
                    {
                        $upsitype = '';
                        $enddate = '';
                        $addedby = '';
                        $emaildate = '';
                        $pstartdate = '';
                    }                    
                    $today = date('d-m-Y');
                    $result = $this->emailer->mailofupsitradingwindow($emailid,$username,$upsitype,$enddate,$addedby,$pstartdate,$emaildate);
                    //echo '<pre>'; print_r($result); exit;
                    
                }
                
                if($result['logged']==true)
                {
                    $del = $this->automailercommon->deleteQID($svl['id']);
                    //echo '<pre>'; print_r($result); exit;
                    
                    
                    /* ----- Start Truncate if empty (email_queue) ----- */
                        //$trn = $this->automailercommon->truncateQ();
                        //echo '<pre>'; print_r($trn); exit;
                    /* ----- End Truncate if empty (email_queue) ----- */
                }
                
                
            }
        }
        
        
        
        
        $resfilepath = "img/emailer/email_queue.txt";
        $writecontent = 'Date='.$datetime.'-----SUCCESS'."\n";
        $myfile = fopen($resfilepath, "a") or die("Unable to open file!"); //Check Working                   
        fwrite($myfile, $writecontent);
        //file_put_contents($resfilepath, $writecontent, FILE_APPEND);
        chmod($resfilepath,0777);
        exit;
        echo '<pre>'; print_r($senddata); exit;
    }
/* ################################# End EmailQueue ################################# */    
    
    
    
    
    

    public function insiderDailyRemindersAction()
    {
        //echo '<pre>'; print_r('inhere'); exit;
        
        /* ----- Start Truncate if empty (email_queue) ----- */
            $trn = $this->automailercommon->truncateQ();
            //echo '<pre>'; print_r($trn); exit;
        
            // ----- Start TruncateFile -----
            $resfilepath = "img/emailer/email_queue.txt";
            $myfile = fopen($resfilepath, "r+") or die("Unable to open file!"); //Check Working   
            ftruncate($myfile, 0);
            // ----- End TruncateFile -----
        /* ----- End Truncate if empty (email_queue) ----- */
        
                
        //-------------------- Start SEND MAIL BEFORE TWO DAYS AGO OF TRADING DATE-----------//
        $sendmailtouser = $this->automailercommon->sendmailtousers();
        //---------------------------------------------------------------------------//


        //--------------------------- Start SEND MAIL TO EVERY DAY------------------------------//
        $sendmailevryday=$this->automailercommon->sendmailtouserseveryday();          
        //------------------------------------------------------------------------------//


        //---------------------------Start SEND MAIL TO APPROVER BEFORE ONE DAY-------------//
        $approvmail=$this->automailercommon->sendapprovmail();
        //------------------------------------------------------------------------------//


        //---------------------------Start SEND MAIL TO APPROVER  EVERY DAY-------------//
        $approvmail=$this->automailercommon->sendapprovmaileveryday();
        //------------------------------------------------------------------------------//

        
        /* ------------------------ Start ------------------------ */
        $sendremindfrprsnlinfo = $this->remindrofprsnlinfo();
        $sendremindfrhldngstmnt = $this->remindrofhldngstmnt();
        $sendremindfrtradewindow = $this->remindroftradewindow();
        /* ------------------------ End ------------------------ */
        
        exit;
    }

    
    public function remindrofprsnlinfo()
    {
        $todaydate =date('d-m-Y');
        $getusr = $this->automailercommon->getallusers();
        for($i=0;$i<sizeof($getusr);$i++)
        {
            $getrecord = $this->automailercommon->chkifprsnlinfo($getusr[$i]['wr_id']);
            if(empty($getrecord))
            {
                $getremndrdate = $this->automailercommon->getremindrdate($getusr[$i]['wr_id']);
                for($j = 0;$j<sizeof($getremndrdate);$j++)
                {
                    if(strtotime($todaydate) == strtotime($getremndrdate[$j]['reminderdate']))
                    {
                        $update = strtotime($todaydate);
                        $dateofmnthday =date("d-m-Y", strtotime("+7 day", $update));
                        $getnameofusr = $this->automailercommon->nameofusr($getremndrdate[$j]['user_id']);
                        $sentmail = $this->emailer->mailsenttousr($getremndrdate[$j]['emailid'],$getnameofusr['username']);
                        if($sentmail['logged']==true)
                        {
                            $updtermndr = $this->automailercommon->updtereminder($getremndrdate[$j]['user_id'],$dateofmnthday);
                        }
                    }
                }
            }
        }
    }
    
    public function remindrofhldngstmnt()
    {
        $todaydate =date('d-m-Y');
        $getusr = $this->automailercommon->getallusers();
        //print_r($getusr);exit;
        for($i=0;$i<sizeof($getusr);$i++)
        {
            $getholdngrecord = $this->automailercommon->chkifhldngstmnt($getusr[$i]['wr_id']);
            if(empty($getholdngrecord))
            {
                $getholdngremndrdate = $this->automailercommon->gethldngremindrdate($getusr[$i]['wr_id']);
                for($j = 0;$j<sizeof($getholdngremndrdate);$j++)
                {
                    if(strtotime($todaydate) == strtotime($getholdngremndrdate[$j]['reminderdate']))
                    {
                        $update = strtotime($todaydate);
                        $dateofmnthday =date("d-m-Y", strtotime("+5 day", $update));
                        $getnameofusr = $this->automailercommon->nameofusr($getholdngremndrdate[$j]['user_id']);
                        $senthldngmail = $this->emailer->hldngmailsenttousr($getholdngremndrdate[$j]['emailid'],$getnameofusr['username']);
                        if($senthldngmail['logged']==true)
                        {
                            $updtehldngrmndr = $this->automailercommon->updtehldngreminder($getholdngremndrdate[$j]['user_id'],$dateofmnthday);
                        }
                    }
                }
            }
        }
    }
    
    public function remindroftradewindow()
    {
          $todaydate =date('d-m-Y');
          $getreqst = $this->automailercommon->getnotradereqst();
          for($i=0;$i<sizeof($getreqst);$i++)
          {
              $prevdate =  date('d-m-Y', strtotime('-1 day', strtotime($getreqst[$i]['trading_date'])));
              if(strtotime($prevdate) == strtotime($todaydate))
              {
                  $sendmailoftrade = $this->emailer->mailtonotdonetrdrqst($getreqst[$i]);
              }
              if(strtotime($todaydate) == strtotime($getreqst[$i]['trading_date']))
              {
                  $sendmailoftrade = $this->emailer->mailtonotdonetrdrqst($getreqst[$i]);
              }
          }
    }
    
    
    
    
    
}

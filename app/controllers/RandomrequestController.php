<?php


class RandomrequestController extends ControllerBase
{  

    
    public function initialize()
    {
        $getlan    = $this->elements->getTranslation();
        $this->tag->setTitle($getlan['websitetitle']);
        //$this->elements->checkuserloggedin();
        parent::initialize();
    }
    public function indexAction()
    {
        $vote =base64_decode($_GET["vote"]);
        $rqst = base64_decode($_GET["rqst"]);
        $requserid=base64_decode($_GET["userid"]);

         // print_r($requserid);exit;
        
        if(!empty($rqst))
        {
            $chckapprvl = $this->randomrequestcommon->checkalreadyaproved($rqst);  //get request data
            $apprvsts = $chckapprvl[0]['approved_status'];
            if($apprvsts == 1)
            {
                echo '<script>window.setTimeout(function(){ alert("You Have Already Approved Request So You Can Not Reject Or Approved Again!!");window.close()}, 100);</script>'; exit;
            }
            elseif($apprvsts == 2)
            {
                 echo '<script>window.setTimeout(function(){ alert("You Have Already Rejected Request so you can not Reject Or Approved Again!!");window.close()}, 100);</script>'; exit;
            }
            else
            {
                $this->view->vote = $vote;
                $this->view->rqst = $rqst;
                $this->view->requserid = $requserid;
            }
        }
     }
    
    /*-*-*-*-*-  approve requst *-*-*-*-*/
    public function updaterequstAction()
    {
        $this->view->disable();
        $getuserid = $this->session->loginauthspuserfront['id'];
        $cin = $this->session->memberdoccin;
        $user_group_id = $this->session->loginauthspuserfront['user_group_id'];
        //echo $getuserid.'*'.$cin;exit;

        if($this->request->isPost() == true)
        {
            if($this->request->isAjax() == true)
            {
                $rqstid = $this->request->getPost('rqid');
                $vote = $this->request->getPost('vote');
                $requserid=$this->request->getPost('requserid');
                $comment = '';
                $apprvrqst = $this->randomrequestcommon->aprrovalrequst($rqstid,$vote,$comment,$requserid);
                if($apprvrqst)
                {
                    // ----------- Message Start -----------
                    $mssgBdy = '<li class="cssBckSucc"><span><img src="img/thumbUp.png"></span></li>';
                    $mssgBdy .= '<li>';
                    $mssgBdy .= '<h2><p class="csssuccess">You have Approved the Request Successfully.</p></h2>';
                    $mssgBdy .= '<div class="clearelement"></div>';
                    //echo '<pre>'; print_r($mssgBdy); exit;
                    $mssgBdy .= '<div class="clearelement"></div>';
                    $mssgBdy .= '</li>';
                    // ----------- Message end -----------
                }
                
                if($apprvrqst)
                {
                    $data = array("logged" => true,'message' => 'Record Updated','apprvmsg'=>$mssgBdy,'rqstid'=>$rqstid);
                    $this->response->setJsonContent($data);
                }
                else
                {
                    $data = array("logged" => false,'message' => "Record Not Updated..!!");
                    $this->response->setJsonContent($data);
                }
                $this->response->send();
            }
            else
            {
                exit('No direct script access allowed');
                $connection->close();
            }
        }
        else
        {
            return $this->response->redirect('errors/show404');
            exit('No direct script access allowed');
        }
        
    }
    /*-*-*-*-*-  approve requst *-*-*-*-*/
    
    /*-*-*-*-*-  reject requst *-*-*-*-*/
    public function updaterqststatusAction()
    {
        $this->view->disable();
        $getuserid = $this->session->loginauthspuserfront['id'];
        $cin = $this->session->memberdoccin;
        $user_group_id = $this->session->loginauthspuserfront['user_group_id'];
        //echo $getuserid.'*'.$cin;exit;
        if($this->request->isPost() == true)
        {
            if($this->request->isAjax() == true)
            {
                $rqstid = $this->request->getPost('rqst');
                $vote = $this->request->getPost('vote');
                $comment = $this->request->getPost('comment');
                $requserid=$this->request->getPost('requserid');
                $apprvrqst = $this->randomrequestcommon->aprrovalrequst($rqstid,$vote,$comment,$requserid);
                if($apprvrqst)
                {
                    // ----------- Message Start -----------
                    $mssgBdy = '<li class="cssBckSucc"><span><img src="img/thumbDown.png"></span></li>';
                    $mssgBdy .= '<li>';
                    $mssgBdy .= '<h2><p class="csssuccess"> Your Request Has Been Rejected.</p></h2>';
                    $mssgBdy .= '<div class="clearelement"></div>';
                    //echo '<pre>'; print_r($mssgBdy); exit;
                    $mssgBdy .= '<div class="clearelement"></div>';
                    $mssgBdy .= '</li>';
                }
                //print_r($mssgBdy);exit;
                if($apprvrqst)
                {
                    $data = array("logged" => true,'message' => 'Record Updated','rejctmsg'=>$mssgBdy);
                    $this->response->setJsonContent($data);
                }
                else
                {
                    $data = array("logged" => false,'message' => "Record Not Updated..!!");
                    $this->response->setJsonContent($data);
                }
                $this->response->send();
            }
            else
            {
                exit('No direct script access allowed');
                $connection->close();
            }
        }
        else
        {
            return $this->response->redirect('errors/show404');
            exit('No direct script access allowed');
        }
    }
    /*-*-*-*-*-  reject requst *-*-*-*-*/
    
    /*-*-*-*-*-  mail ack requst *-*-*-*-*/
    public function mailacknwtoapprvrAction()
    {
        $this->view->disable();
        $getuserid = $this->session->loginauthspuserfront['id'];
        $cin = $this->session->memberdoccin;
        $user_group_id = $this->session->loginauthspuserfront['user_group_id'];
        //echo $getuserid.'*'.$cin;exit;
        if($this->request->isPost() == true)
        {
            if($this->request->isAjax() == true)
            {
                $rqstid = $this->request->getPost('rqstid');
                /*---------- send acknowledgement to requesster start ---------*/
                    $getackwmaildetl = $this->randomrequestcommon->mailacknwtoapprvr($rqstid); 
                     $ackapprvmail = array( 
                                 'company_name'=>$getackwmaildetl[0]['company_name'],  
                                 'type_trnscn'=>$getackwmaildetl[0]['transaction'],  
                                 'securty_type'=>$getackwmaildetl[0]['security_type'],
                                 'noofshres'=>$getackwmaildetl[0]['no_of_shares'],
                                 'email'=>$getackwmaildetl[0]['email']
                     );
                    $result = $this->emailer->sendmailackapprvl($ackapprvmail);
                /*---------- send acknowledgement to requesster start ---------*/
                if($apprvrqst)
                {
                    $data = array("logged" => true,'message' => 'Mail Sent Successfully');
                    $this->response->setJsonContent($data);
                }
                else
                {
                    $data = array("logged" => false,'message' => "Mail Not Sent..!!");
                    $this->response->setJsonContent($data);
                }
                $this->response->send();
            }
            else
            {
                exit('No direct script access allowed');
                $connection->close();
            }
        }
        else
        {
            return $this->response->redirect('errors/show404');
            exit('No direct script access allowed');
        }
    }
    /*-*-*-*-*-  mail ack requst *-*-*-*-*/
}






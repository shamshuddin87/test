<?php


class RandomexceptionController extends ControllerBase
{  

    
    public function initialize()
    {
        $getlan    = $this->elements->getTranslation();
        $this->tag->setTitle($getlan['websitetitle']);
        //$this->elements->checkuserloggedin();
		//$getuserid = $this->session->loginauthspuserfront['id'];
        //echo ':frontend user::';print_r($this->session->loginauthsuser);exit;
        parent::initialize();
    }

    public function indexAction()
    {
        $vote = base64_decode($_GET["vote"]);
        $exerqst = base64_decode($_GET["excrqst"]);
        $rqst = base64_decode($_GET["rqst"]);
        if(!empty($exerqst))
        {
            $excchckapprvl = $this->randomexceptioncommon->exccheckalreadyaproved($exerqst); //get excpnrequest data
            $excapprvsts = $excchckapprvl[0]['excepapp_status'];
            if($excapprvsts == 1)
            {
                echo '<script>window.setTimeout(function(){ alert("You Have Already Approved Exception Request So You Can Not Reject Or Approved Again!!");window.close()}, 100);</script>'; exit;
            }
            elseif($excapprvsts == 2)
            {
                 echo '<script>window.setTimeout(function(){ alert("You Have Already Exception Rejected Request so you can not Reject Or Approved Again!!");window.close()}, 100);</script>'; exit;
            }
            else
            {
                $this->view->vote = $vote;
                $this->view->exerqst = $exerqst;
                $this->view->rqstid = $rqst;
            }
        }
     }
    
    /****** approve exception request *******/
    public function updateexcrequstAction()
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
                $excrqstid = $this->request->getPost('excrqst');
                $vote = $this->request->getPost('vote');
                $rqstid = $this->request->getPost('rqstid');
                $comment = '';
                $apprvexerqst = $this->randomexceptioncommon->aprrovalexcrequst($excrqstid,$vote,$comment,$rqstid);
                if($apprvexerqst)
                {

                    
                    // ----------- Message Start -----------
                    $mssgBdy = '<li class="cssBckSucc"><span><img src="img/thumbUp.png"></span></li>';
                    $mssgBdy .= '<li>';
                    $mssgBdy .= '<h2><p class="csssuccess">You have Approved the Exception Request Successfully.</p></h2>';
                    $mssgBdy .= '<div class="clearelement"></div>';
                    //echo '<pre>'; print_r($mssgBdy); exit;
                    $mssgBdy .= '<div class="clearelement"></div>';
                    $mssgBdy .= '</li>';
                    // ----------- Message end -----------
                }
                
                if($apprvexerqst)
                {
                    $data = array("logged" => true,'message' => 'Record Updated','apprvmsg'=>$mssgBdy,'rqstid'=>$excrqstid);
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
    /****** approve exception request *******/
    
    
    /****** reject exception request *******/
    public function updateexcrqstAction()
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
                $apprvrqst = $this->randomexceptioncommon->aprrovalexcrequst($rqstid,$vote,$comment);
                if($apprvrqst)
                {
                    // ----------- Message Start -----------
                    $mssgBdy = '<li class="cssBckSucc"><span><img src="img/thumbDown.png"></span></li>';
                    $mssgBdy .= '<li>';
                    $mssgBdy .= '<h2><p class="csssuccess"> Your Exception Request Has Been Rejected.</p></h2>';
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
     /****** reject exception request *******/
    
     /****** ack of exception request sent to requester *******/
    public function mailacknwtoexcapprvrAction()
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
                $excrqstid= $this->request->getPost('excrqstid');
                /*---------- send acknowledgement to requesster start ---------*/
                    $getexcackwmaildetl = $this->randomexceptioncommon->mailacknwtoexcapprvr($excrqstid); 
                     $excackapprvmail = array( 
                                 'company_name'=>$getexcackwmaildetl[0]['company_name'],  
                                 'type_trnscn'=>$getexcackwmaildetl[0]['transaction'],  
                                 'securty_type'=>$getexcackwmaildetl[0]['security_type'],
                                 'noofshres'=>$getexcackwmaildetl[0]['noofsecurity'],
                                 'email'=>$getexcackwmaildetl[0]['email']
                     );
                //print_r($excackapprvmail);exit;
                    $result = $this->emailer->sendexcmailackapprvl($excackapprvmail);
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
    /****** ack of exception request sent to requester *******/
    
    
    
    

 }






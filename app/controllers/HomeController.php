<?php 
class HomeController extends ControllerBase
{
    public function initialize()
    {
        $getlan    = $this->elements->getTranslation();
        $this->tag->setTitle($getlan['websitetitle']);
		$this->elements->checkuserloggedin();
		//$getuserid = $this->session->loginauthspuserfront['id'];
        //echo ':frontend user::';print_r($this->session->loginauthsuser);exit;
        parent::initialize();
    }

    public function indexAction()
    {     
        $uid = $this->session->loginauthspuserfront['id'];
        $gmnlog = $this->session->loginauthspuserfront;
        $user_group_id = $this->session->loginauthspuserfront['user_group_id'];
        
        $this->view->login = $this->homecommon->fetchfirstlogin($uid);
        $checkupsi  = $this->homecommon->upsiholding($uid);
        $this->view->tradingwindw = $this->homecommon->gettradingwindw($uid,$user_group_id);
        //print_r($tradingwindw);exit;
        $date=date('d-m-Y');

        if(!empty($checkupsi))
        {
           for($i = 0 ; $i< count($checkupsi);$i++) 
        {
           
            if(strtotime($checkupsi[$i]['projstartdate']) > strtotime($date))
            {

              $data = "upsi starts in future";

            }
            else
            {
                   //echo "helloo";exit;
                if((strtotime($date) >= strtotime($checkupsi[$i]['projstartdate']) && strtotime($date) <= strtotime($checkupsi[$i]['enddate'])) OR empty($checkupsi[$i]['enddate']))
            {     
                
                  $upsiresult[] = $checkupsi[$i];
            }

            }
           
        }
        }


       

        $this->view->upsiresult = $upsiresult;
             
    }
    public function countofrestrictcompAction()
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
                $getres = $this->homecommon->countofrestrictcomp($getuserid,$user_group_id);
                //print_r($getres);exit;
                if($getres)
                {
                    $data = array("logged" => true,'message' => 'Found','data'=>$getres);
                    $this->response->setJsonContent($data);
                }
                else
                {
                    $data = array("logged" => false,'message' => "Record Not Found..!!");
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
    
    public function countofdepreltvAction()
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
                $getres = $this->homecommon->countdepndrelative($getuserid,$user_group_id);
                //print_r($getres);exit;
                if($getres)
                {
                    $data = array("logged" => true,'message' => 'Found','data'=>$getres);
                    $this->response->setJsonContent($data);
                }
                else
                {
                    $data = array("logged" => false,'message' => "Record Not Found..!!");
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
        
    public function countofreqpendappAction()
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
                $getres = $this->homecommon->countofreqpendapp($getuserid,$user_group_id);
                //print_r($getres);exit;
                if($getres)
                {
                    $data = array("logged" => true,'message' => 'Found','data'=>$getres);
                    $this->response->setJsonContent($data);
                }
                else
                {
                    $data = array("logged" => false,'message' => "Record Not Found..!!");
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

    public function getallholdingsummaryAction()
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
                $getres = $this->homecommon->fetchholdingsummary($getuserid,$user_group_id);
                $getcmpname = $this->homecommon->fetchcmpname($getuserid,$user_group_id);
                $getequity = $this->homecommon->fetchequity($getuserid,$getres['companyid']);
                $getprefereence = $this->homecommon->fetchprefereence($getuserid,$getres['companyid']);
                //$getdebenure = $this->homecommon->fetchdebenure($getuserid,$getres['companyid']);
                //print_r($getdebenure);exit;
                if(!empty($getcmpname))
                {
                    $data = array("logged" => true,'message' => 'Record Added','resdta' => $getres['data'],'data'=>$getres,'user_group_id'=>$user_group_id,'user_id'=>$getuserid,'equity'=>$getequity,'prefer'=>$getprefereence,'cmpname'=>$getcmpname);
                    $this->response->setJsonContent($data);
                }
                else
                {
                    $data = array("logged" => false,'message' => "Record Not Added..!!");
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


    public function checkdetailsAction()
    {
        $this->view->disable();
        $uid = $this->session->loginauthspuserfront['id'];
        $usergroup = $this->session->loginauthspuserfront['user_group_id'];
        if($this->request->isPost() == true)
        {
            if($this->request->isAjax() == true)
            {     
                $result = $this->employeemodulecommon->getmydetails($uid,$usergroup);
                //print_r($result);exit;
                $getdematsstatus=$this->portfoliocommon->getdematsstatus($uid,$usergroup);
                //print_r($getdematsstatus);exit;
                if(!empty($getdematsstatus))
                {
                   // print_r($getdematsstatus);exit;
                  if($getdematsstatus[0]['status']==1)
                  {
                       // print_r("hh");exit;
                      $getdematsstatus=1;
                  }
                  else
                  {
                     $getdematsstatus=0;
                  }
                }
                else
                {
                     $getdematsstatus=2;
                }

                // print_r($getdematsstatus);exit;
            
                if(!empty($result))
                {  
                    

                    $getresponse = $this->portfoliocommon->getaccnoinfo($uid,$usergroup);
                    //print_r($getdematsstatus);exit;
                    if((empty($getresponse) &&  $getdematsstatus==1) || (empty($getresponse) &&  $getdematsstatus==2))
                    {
                       $data = array("logged" => false,'message' => "You will not be allowed access until you update your demat account details. Please click  'No' if you don’t have a demat account.",'data'=>'portfolio','usergroup'=>$usergroup);
                         $this->response->setJsonContent($data);
                       
                    }
                    else
                    {
                        $data = array("logged" => true,'message' => "Data Fetch Successfully",'data'=>'');
                             $this->response->setJsonContent($data);

                    }
                }
                else
                {

                    $data = array("logged" => false,'message' => "Please verify/update your personal information as given under ‘My Info’ first.You will not be allowed access until you verify your personal information.",'data'=>'employeemodule','usergroup'=>$usergroup);
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


    public function firstloginAction()
    {
      
        $this->view->disable();
        $uid = $this->session->loginauthspuserfront['id'];
        $usergroup = $this->session->loginauthspuserfront['user_group_id'];
        if($this->request->isPost() == true)
        {
            if($this->request->isAjax() == true)
            { 

               $getresponse = $this->homecommon->updatetlogin($uid);
               
                if($getresponse == true)
                    {
                       $data = array("logged" => true,'message' => "updated");
                         $this->response->setJsonContent($data);
                      
                    }
                    else
                    {
                        $data = array("logged" => false,'message' => "data not updated");
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
    
    
    
    

}



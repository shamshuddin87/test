<?php 
class ApprovelperinfoController extends ControllerBase
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
        $usergroup = $this->session->loginauthspuserfront['user_group_id'];
        $gmnlog = $this->session->loginauthspuserfront;
        $this->view->relativesinfo =$this->employeemodulecommon->getrelativedata($uid,$usergroup);
        
    }
    
    public function getuserinfoAction()
    {
        if($_GET['userid'])
        {
          $getuserid=$_GET['userid'];
          $this->view->getuserid=$getuserid;
        }
        else
        {
           print_r("User Id Required");exit;
        }
    }
      public function getallusersAction()
    {
        $this->view->disable();
        $getuserid = $this->session->loginauthspuserfront['id'];
        $usergroup =$this->session->loginauthspuserfront['user_group_id'];
        if($this->request->isPost() == true)
        {
            if($this->request->isAjax() == true)
            {

                //----------------pagination start here--------------------------------------------
                $pagedata=$this->request->getPost();
                $noofrows=$pagedata['noofrows'];
                $pagenum=$pagedata['pagenum'];
                $rsstrt = ($pagenum-1) * $noofrows;
                $rslmt = 'ORDER BY it.`ID` DESC LIMIT '.$rsstrt.','.$noofrows;
                $mainqry='';

                $resultcount = $this->approvelperinfocommon->getallusers($getuserid,$usergroup,$mainqry);
                $result = $this->approvelperinfocommon->getallusers($getuserid,$usergroup,$rslmt);
                $rscnt=count($resultcount);
                $rspgs = ceil($rscnt/$noofrows);
                $pgndata = $this->elements->paginatndata($pagenum,$rspgs);
                $pgnhtml = $this->elements->paginationhtml($pagenum,$pgndata['start_loop'],$pgndata['end_loop'],$rspgs);

                if(!empty($result))
                {
                    $data = array("logged"=>true,"message"=>'Data fetch successfully',"data"=>$result,"pgnhtml"=>$pgnhtml);
                    $this->response->setJsonContent($data);
                }
                else
                {
                    $data = array("logged"=>false,"message"=>'something Went to wrong',"data"=>'');
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

     public function getuserdetailsAction()
    {
        $this->view->disable();
        $uid = $this->session->loginauthspuserfront['id'];
        $usergroup = $this->session->loginauthspuserfront['user_group_id'];
        if($this->request->isPost() == true)
        {
            if($this->request->isAjax() == true)
            {     
                $getuser=$this->request->getPost('getuser','trim');
                $result = $this->approvelperinfocommon->getuserdetails($getuser);
            
                if(!empty($result))
                {  
                    $data = array("logged" => true,'message' => "Data Fetch Successfully",'data'=>$result);
                    $this->response->setJsonContent($data);
                }
                else
                {
                    $data = array("logged" => false,'message' => "Data Not Fetch Successfully",'data'=>'');
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

      public function rejectrequestAction()
    {
        $this->view->disable();
        $uid = $this->session->loginauthspuserfront['id'];
        $usergroup = $this->session->loginauthspuserfront['user_group_id'];
        if($this->request->isPost() == true)
        {
            if($this->request->isAjax() == true)
            {     
                $getuser=$this->request->getPost('getuser','trim');
                $result = $this->approvelperinfocommon->rejectrequest($getuser);
            
                if($result==true)
                {  
                    $data = array("logged" => true,'message' => "Request Rejected...!!!");
                    $this->response->setJsonContent($data);
                }
                else
                {
                    $data = array("logged" => false,'message' => "Something Went To Wrong..!!!");
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

     public function acceptrequestAction()
    {
        $this->view->disable();
        $uid = $this->session->loginauthspuserfront['id'];
        $usergroup = $this->session->loginauthspuserfront['user_group_id'];
        if($this->request->isPost() == true)
        {
            if($this->request->isAjax() == true)
            {     
                $getuser=$this->request->getPost('getuser','trim');
                $result = $this->approvelperinfocommon->acceptrequest($getuser);
            
                if($result==true)
                {  
                    $data = array("logged" => true,'message' => "Request Accepted...!!!");
                    $this->response->setJsonContent($data);
                }
                else
                {
                    $data = array("logged" => false,'message' => "Something Went To Wrong..!!!");
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


      public function getmydetailsmodAction()
    {
        $this->view->disable();
        $uid = $this->session->loginauthspuserfront['id'];
        $usergroup = $this->session->loginauthspuserfront['user_group_id'];
        if($this->request->isPost() == true)
        {
            if($this->request->isAjax() == true)
            {     
                $getuser=$this->request->getPost('getuserid','trim');
                $result = $this->approvelperinfocommon->getmydetailsmod($getuser);
            
                if(!empty($result))
                {  
                    $data = array("logged" => true,'message' => "Data Fetch Successfully",'data'=>$result);
                    $this->response->setJsonContent($data);
                }
                else
                {
                    $data = array("logged" => false,'message' => "Data Not Fetch Successfully",'data'=>'');
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

    //-------------------------------------------------FETCH PAST EMPLOYEYR STARTS HERE------------------------------//
      public function getpastemployerAction()
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
                   
                    $noofrows=$this->request->getPost('noofrows');
                    $pagenum=$this->request->getPost('pagenum');
                    $getuser=$this->request->getPost('getuserid');
                    $mainquery = '';

                    $getres = $this->approvelperinfocommon->getpastemployer($getuser,$mainquery);
                 
                    /* start pagination */
                    // $rsstrt = ($pagenum-1) * $noofrows;
                    // $rslmt =' LIMIT '.$rsstrt.','.$noofrows;
                    // $rscnt=count($getres);
                    // $rspgs = ceil($rscnt/$noofrows);
                    // $pgndata = $this->elements->paginatndata($pagenum,$rspgs);
                    // $pgnhtml = $this->elements->paginationhtml($pagenum,$pgndata['start_loop'],$pgndata['end_loop'],$rspgs);
                    // // print_r($rslmt);exit;
                    $getresult = $this->approvelperinfocommon->getpastemployer($getuser,$mainquery);
                    //print_r($getresult);exit;
                    if($getres)
                    {
                        $data = array("logged" => true,'message' => 'Record Added','resdta' => $getresult,'pgnhtml'=>'');
                        $this->response->setJsonContent($data);
                    }
                    else
                    {
                        $data = array("logged" => false,'message' => "Record Not Added..!!",'pgnhtml'=>'');
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

<?php 
class SharecapitalController extends ControllerBase
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
        
    }

    public function addsharecapitalAction()
    {
        $this->view->disable();
        $getuserid = $this->session->loginauthspuserfront['id'];
        $usergroup =$this->session->loginauthspuserfront['user_group_id'];
        if($this->request->isPost() == true)
        {
            if($this->request->isAjax() == true)
            {
                $data = $this->request->getPost();
                // print_r($data);exit;
                
                
                if(empty($data['shrcap']))
                {
                   $data = array("logged" => false,'message' => 'Please Insert Share Capital');
                   $this->response->setJsonContent($data); 
                }
               
               
                else
                {
                   $result = $this->sharecapitalcommon->addsharecapital($getuserid,$data);

                    if($result['status']==true)
                    {
                        $data = array("logged"=>true, 'message'=>$result['message']);
                        $this->response->setJsonContent($data);
                    }
                    else
                    {
                        $data = array("logged"=>false, 'message'=>$result['message']);
                        $this->response->setJsonContent($data);
                    } 
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

 

    public function getallsharecapitalAction()
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
                $rslmt = 'ORDER BY ID DESC LIMIT '.$rsstrt.','.$noofrows;
                $mainqry='';

                $resultcount = $this->sharecapitalcommon->allsharecap($getuserid,$usergroup,$mainqry);
                $result = $this->sharecapitalcommon->allsharecap($getuserid,$usergroup,$rslmt);
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

     public function getsingleupsidetailAction()
    {
        $this->view->disable();
        $getuserid = $this->session->loginauthspuserfront['id'];
        $usergroup =$this->session->loginauthspuserfront['user_group_id'];
        if($this->request->isPost() == true)
        {
            if($this->request->isAjax() == true)
            {
                $shsiid = $this->request->getPost('shsiid');
                $result = $this->sharecapitalcommon->getsinglecap($shsiid);
                // print_r($result);exit;
                if(!empty($result))
                {
                    $data = array("logged"=>true,"message"=>'Data fetch successfully',"data"=>$result);
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

    
    
     public function updateushareAction()
    {
        $this->view->disable();
        $getuserid = $this->session->loginauthspuserfront['id'];
        $usergroup =$this->session->loginauthspuserfront['user_group_id'];
        if($this->request->isPost() == true)
        {
            if($this->request->isAjax() == true)
            {
                $sahrcap = $this->request->getPost('upupsnm');

                $id = $this->request->getPost('id');
                // print_r($id);exit;
               
                $result = $this->sharecapitalcommon->updateushare($sahrcap,$id);
                // print_r($result);exit;
                if($result)
                {
                    $data = array("logged"=>true,"message"=>'Data Updated successfully..!!!');
                    $this->response->setJsonContent($data);
                }
                else
                {
                    $data = array("logged"=>false,"message"=>'Data Not Updated successfully..!!!');
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

  public function deleteshareAction()
  {
       $this->view->disable();
        $getuserid = $this->session->loginauthspuserfront['id'];
        $usergroup =$this->session->loginauthspuserfront['user_group_id'];
        if($this->request->isPost() == true)
        {
            if($this->request->isAjax() == true)
            {
                

                $id = $this->request->getPost('delid');
                // print_r($id);exit;
               
                $result = $this->sharecapitalcommon->deletesharecap($id);
                // print_r($result);exit;
                if($result)
                {
                    $data = array("logged"=>true,"message"=>'Record Deleted successfully..!!!');
                    $this->response->setJsonContent($data);
                }
                else
                {
                    $data = array("logged"=>false,"message"=>'Something Went to Wrong..!!!');
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

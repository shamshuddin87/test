<?php 
class UpsimasterController extends ControllerBase
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

    public function addupsimasterAction()
    {
        $this->view->disable();
        $getuserid = $this->session->loginauthspuserfront['id'];
        $usergroup =$this->session->loginauthspuserfront['user_group_id'];
        if($this->request->isPost() == true)
        {
            if($this->request->isAjax() == true)
            {
                $data = $this->request->getPost();
                 
                
                if(empty($data['upname']))
                {
                   $data = array("logged" => false,'message' => 'Please Enter Type Of Upsi');
                   $this->response->setJsonContent($data); 
                }
               
               
                else
                {
                   $result = $this->upsicommon->addupsi($getuserid,$data);

                    if($result)
                    {
                        $data = array("logged"=>true, 'message'=>'Type Of Upsi Added successfully');
                        $this->response->setJsonContent($data);
                    }
                    else
                    {
                        $data = array("logged"=>false, 'message'=>'Something went wrong');
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

 

    public function getallupsietailAction()
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

                $resultcount = $this->upsicommon->getallupsi($getuserid,$usergroup,$mainqry);
                $result = $this->upsicommon->getallupsi($getuserid,$usergroup,$rslmt);
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
                $upsiid = $this->request->getPost('upsiid');
                $result = $this->upsicommon->getsingleupsi($upsiid);
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

    
    
     public function updateupsiAction()
    {
        $this->view->disable();
        $getuserid = $this->session->loginauthspuserfront['id'];
        $usergroup =$this->session->loginauthspuserfront['user_group_id'];
        if($this->request->isPost() == true)
        {
            if($this->request->isAjax() == true)
            {
                $upsiname = $this->request->getPost('upupsnm');

                $id = $this->request->getPost('id');
                // print_r($id);exit;
               
                $result = $this->upsicommon->updateupsi($upsiname,$id);
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

  public function deleteupsiAction()
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
               
                $result = $this->upsicommon->deleteupsi($id);
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

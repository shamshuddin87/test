<?php 
class CompanymasterController extends ControllerBase
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
        
        /*################  Phalcon Database name Fetching
        $connection = $this->db->getDescriptor();
        $connection = $connection['dbname'];
        echo '<pre>';print_r($connection);exit; 
        ###########################*/
        
        //$getmn = $this->session->orgdtl;
        //echo '<pre>';print_r($getmn);exit;        
    }
    
    
//--------------Method TO ADD COMPANY START HERE-----------------------------------------------//
    public function addcmpmasterAction()
    {
        $this->view->disable();
        $getuserid = $this->session->loginauthspuserfront['id'];
        $usergroup =$this->session->loginauthspuserfront['user_group_id'];
        
        if($this->request->isPost() == true)
        {
            if($this->request->isAjax() == true)
            {
                $cmp = $this->request->getPost('cmp','trim');
                $pan = $this->request->getPost('pan','trim');
                //echo '<pre>';print_r($cmp);exit;        
                
                $pandetail = $this->companymastercommon->getallpanofcmp();
                
                if(empty($cmp) || $cmp=='')
                {
                   $data = array("logged" => false,'message' => 'Please Enter Company!');
                   $this->response->setJsonContent($data); 
                }
                else if(strlen($pan) < 10)
                {
                   $data = array("logged" => false,'message' => 'Your Pan No Should Be 10 Digit!!');
                   $this->response->setJsonContent($data); 
                }
                else if (in_array($pan, $pandetail)) 
                {
                   $data = array("logged" => false,'message' => 'Pan Cannot Be Same!!');
                   $this->response->setJsonContent($data);
                }
                else
                {
                    $result = $this->companymastercommon->addcompany($getuserid,$cmp,$pan);

                    if($result)
                    {
                        $data = array("logged"=>true, 'message'=>'Company Added successfully');
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

    //--------------Method TO ADD COMPANY Finish HERE-----------------------------------------------//

    public function allcmpdetailsAction()
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

                $resultcount = $this->companymastercommon->cmpdetails($getuserid,$usergroup,$mainqry);
                $result = $this->companymastercommon->cmpdetails($getuserid,$usergroup,$rslmt);
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

    public function getsinglecmpdetailAction()
    {
        $this->view->disable();
        $getuserid = $this->session->loginauthspuserfront['id'];
        $usergroup =$this->session->loginauthspuserfront['user_group_id'];
        if($this->request->isPost() == true)
        {
            if($this->request->isAjax() == true)
            {
                $cmpdata = $this->request->getPost('cmpid');
                $result = $this->companymastercommon->getsinglecmpdetail($cmpdata);
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

    public function updatecompanyAction()
    {
        $this->view->disable();
        $getuserid = $this->session->loginauthspuserfront['id'];
        $usergroup =$this->session->loginauthspuserfront['user_group_id'];
        if($this->request->isPost() == true)
        {
            if($this->request->isAjax() == true)
            {
                $cmpid = $this->request->getPost('cmpid','trim');
                $cmp = $this->request->getPost('cmpname','trim');
                $pan = $this->request->getPost('panid','trim');                
                
                if(empty($cmp) || $cmp=='')
                {
                   $data = array("logged" => false,'message' => 'Please Enter Company!');
                   $this->response->setJsonContent($data); 
                }
                else if(strlen($pan) < 10)
                {
                   $data = array("logged" => false,'message' => 'Your Pan No Should Be 10 Digit!!');
                   $this->response->setJsonContent($data); 
                }
                else
                {
                    $result = $this->companymastercommon->updatecompany($getuserid,$usergroup,$cmpid,$cmp,$pan);

                    if(!empty($result))
                    {
                        $data = array("logged"=>true,"message"=>'Data Updated successfully',"data"=>$result);
                        $this->response->setJsonContent($data);
                    }
                    else
                    {
                        $data = array("logged"=>false,"message"=>'something Went to wrong',"data"=>'');
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

    public function deletecompanyAction()
    {
        $this->view->disable();
        $getuserid = $this->session->loginauthspuserfront['id'];
        $usergroup =$this->session->loginauthspuserfront['user_group_id'];
        if($this->request->isPost() == true)
        {
            if($this->request->isAjax() == true)
            {
                $cmpid = $this->request->getPost('cmpid');
                $result = $this->companymastercommon->deletecompany($getuserid,$usergroup,$cmpid);

                if(!empty($result))
                {
                    $data = array("logged"=>true,"message"=>'Company Deleted successfully',"data"=>$result);
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
    
    
    

}

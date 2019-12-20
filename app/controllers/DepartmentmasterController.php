<?php 
class DepartmentmasterController extends ControllerBase
{
    public function initialize()
    {
        $getlan    = $this->elements->getTranslation();
        $this->tag->setTitle($getlan['websitetitle']);
		$this->elements->checkuserloggedin();
	    parent::initialize();
    }

    public function indexAction()
    {     
        $uid = $this->session->loginauthspuserfront['id'];
        $usergroup = $this->session->loginauthspuserfront['user_group_id'];
        $gmnlog = $this->session->loginauthspuserfront;
        $mainqry='';
        $this->view->cmplist = $this->companymastercommon->cmpdetails($uid,$usergroup,$mainqry);
        // print_r($this->view->cmplist);exit;      
    }
    
//---------------------------Method Used To Add Department-----------------------------------------------//
    public function insertdepartmentAction()
    {
        $this->view->disable();
        $getuserid = $this->session->loginauthspuserfront['id'];
        
        if($this->request->isPost() == true)
        {
            if($this->request->isAjax() == true)
            {     
                
                $nameofdept   = $this->request->getPost('deptname','trim');
                $gtselctedcmpp   = $this->request->getPost('cmpaccnme','trim');
                
                if ($nameofdept == '') {
                    $data = array("logged" => false,'message' => "Please Select Name Of Department");
                        $this->response->setJsonContent($data);
                }else if (!isset($gtselctedcmpp)) {
                    $data = array("logged" => false,'message' => "Please Select Atleast One Company");
                        $this->response->setJsonContent($data);
                
                }else{
                    $gtselctedcmpp = implode(',', $gtselctedcmpp);
                    $getresponse = $this->departmentmastercommon->insertdepartment($nameofdept,$getuserid,$gtselctedcmpp);
                
                    if($getresponse['status'] == true)
                    {
                        $data = array("logged" => true,'message' => $getresponse['msg']);
                        $this->response->setJsonContent($data);
                    }
                    else
                    {
                        $data = array("logged" => false,'message' => $getresponse['msg']);
                        $this->response->setJsonContent($data);
                    }
                }
                

                $this->response->send();            
            }
            else
            {
                exit('No direct script access allowed isAjax');
            }
        }
        else
        {
            return $this->response->redirect('errors/show404');
            exit('No direct script access allowed');
        }        
    }
//------------------------------------------------------------------------------------------------------//


    public function fetchdeptAction()
    {
        $this->view->disable();
        $connection = $this->db;
        $getuserid = $this->session->loginauthspuserfront['id'];
        $user_group_id = $this->session->loginauthspuserfront['user_group_id'];
       
        
        if($this->request->isPost() == true)
        {
            if($this->request->isAjax() == true)
            {
                
             $numofdata = $this->request->getPost('numofdata','trim');   
             $pagedata=$this->request->getPost();
                          
              $noofrows=$pagedata['noofrows'];
              $pagenum=$pagedata['pagenum'];
              $rsstrt = ($pagenum-1) * $noofrows;
              $rslmt = 'ORDER BY ID DESC LIMIT '.$rsstrt.','.$noofrows;
              $mainqry='';
                
              $getcount = $this->departmentmastercommon->fetchdept($getuserid,$user_group_id,$mainqry);
              $rscnt=count($getcount);
              $rspgs = ceil($rscnt/$noofrows);
              $pgndata = $this->elements->paginatndata($pagenum,$rspgs);
              $pgnhtml = $this->elements->paginationhtml($pagenum,$pgndata['start_loop'],$pgndata['end_loop'],$rspgs);
              $result = $this->departmentmastercommon->fetchdept($getuserid,$user_group_id,$rslmt);
              // print_r($result);exit;
              if(!empty($result))
                {
                    $data = array("logged" => true,'message' => 'Got Your data' , 'data'=> $result,'pgnhtml'=>$pgnhtml);
                    $this->response->setJsonContent($data);
                }
                else{
                    $data = array("logged" => false,'message' => "No Data Found!!!");
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


//----------------------------------fetch single department-----------------------------------------




    public function fetchsingdeptAction(){
        $this->view->disable();
        $getuserid = $this->session->loginauthspuserfront['id'];
        $user_group_id = $this->session->loginauthspuserfront['user_group_id'];        
        $timeago = time();
        
        if($this->request->isPost() == true)
        {
            if($this->request->isAjax() == true)
            {   

                $tempid = $this->request->getPost('tempid','trim');
                $result = $this->departmentmastercommon->fetchdeptone($getuserid,$user_group_id,$tempid);
                
                if(!empty($result))
                {
                    $data = array("logged" => true,'message' => 'Got Your data' , 'data'=> $result);
                    $this->response->setJsonContent($data);
                }
                else{
                    $data = array("logged" => false,'message' => "No Data Found!!!");
                    $this->response->setJsonContent($data);
                }

                $this->response->send();
            

            }
        }

    }


//----------------------------------------------------------------------------------------------------





//---------------------------------------update Department start here--------------------------------

    public function updatedeptAction()
    {
        $this->view->disable();
        $getuserid = $this->session->loginauthspuserfront['id'];
        $user_group_id = $this->session->loginauthspuserfront['user_group_id'];        
        $timeago = time();
        
        if($this->request->isPost() == true)
        {
            if($this->request->isAjax() == true)
            {     
                $nameofdept   = $this->request->getPost('deptname','trim');
                $gtselctedcmpp   = $this->request->getPost('cmpaccnme','trim');
                $tempid   = $this->request->getPost('tempid','trim');
             
                if ($nameofdept == '') {
                    $data = array("logged" => false,'message' => "Please Select Name Of Department");
                        $this->response->setJsonContent($data);
                 }else if (!isset($gtselctedcmpp)) {
                    $data = array("logged" => false,'message' => "Please Select Atleast One Company");
                        $this->response->setJsonContent($data);
                  }else{
                    $gtselctedcmpp = implode(',', $gtselctedcmpp);
                    $getresponse = $this->departmentmastercommon->updatedept($nameofdept,$getuserid,$gtselctedcmpp,$tempid);
             

                    if($getresponse['status'] == true)
                    {
                        $data = array("logged" => true,'message' => $getresponse['msg']);
                        $this->response->setJsonContent($data);
                    }
                    else
                    {
                        $data = array("logged" => false,'message' => $getresponse['msg']);
                        $this->response->setJsonContent($data);
                    }
                }

                $this->response->send();            
            }
            else
            {
                exit('No direct script access allowed isAjax');
            }
        }
        else
        {
            return $this->response->redirect('errors/show404');
            exit('No direct script access allowed');
        }        
    }




//------------------------------------------------------Delete Department----------------------------------------------
    public function deletedeptAction()
    {
        $this->view->disable();
        $getuserid = $this->session->loginauthspuserfront['id'];
        $cin = $this->session->memberdoccin;
        //echo $getuserid.'*'.$cin;exit;

        if($this->request->isPost() == true)
        {
            if($this->request->isAjax() == true)
            {
                $tempid  = $this->request->getPost('tempid', 'trim');
                //echo "wait hre";echo $tempid;exit;
                $getres = $this->departmentmastercommon->deletedept($getuserid,$tempid);
                      
                if($getres['status'] == true)
                {
                    $data = array("logged" => true,'message' => 'Record Deleted');
                    $this->response->setJsonContent($data);
                }
                else{
                    $data = array("logged" => false,'message' => "Record Not Deleted..!!");
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

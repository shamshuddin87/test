<?php 
class CompanymoduleController extends ControllerBase
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
        // $uid = $this->session->loginauthspuserfront['id'];
        // $usergroup = $this->session->loginauthspuserfront['user_group_id'];
        // $gmnlog = $this->session->loginauthspuserfront;
        // $mainqry='';
        // $this->view->cmplist = $this->companymastercommon->cmpdetails($getuserid,$usergroup);
        // $this->view->deptlist= $this->departmentmastercommon->fetchdept($uid,$usergroup,$mainqry);
    }
    
    
    public function insertcmpfileAction()
    {
        $this->view->disable();
        $getuserid = $this->session->loginauthspuserfront['id'];
        $usergroup =$this->session->loginauthspuserfront['user_group_id'];
        $timeago = time();
        
        if($this->request->isPost() == true)
        {
            if($this->request->isAjax() == true)
            {
                if(isset( $_FILES['excelfile']['name'])) 
                {      
                    $userfile_name = $_FILES['excelfile']['name'];
                    //echo $userfile_name;exit;
                    $userfile_tmp = $_FILES['excelfile']['tmp_name'];
                    $userfile_size = $_FILES['excelfile']['size'];
                    $userfile_type = $_FILES['excelfile']['type'];
                    $filename = basename($_FILES['excelfile']['name']);
                    $file_ext = $this->validationcommon->getfileext($filename);
                    $dir=$this->cmpmodule."/excel/";   
                    $fl = $dir.$timeago.".".$file_ext;
                    // print_r($userfile_name);
                    $uploadedornot = move_uploaded_file($userfile_tmp,$fl);

                    if($uploadedornot)
                    {
                        $result= $this->phpimportexpogen->insertcmpmodule($getuserid,$usergroup,$fl);
                        if($result==1)
                        {
                            $data = array("logged" => true,'message' => "File Uploaded Successfully");
                            $this->response->setJsonContent($data);
                        }
                        else
                        {
                            $data = array("logged" => false,'message' =>"Some thing Went to wrong");
                            $this->response->setJsonContent($data);
                        }
                    }
                    else
                    {
                        $data = array("logged" => false,'message' =>"File Not Uploaded");
                        $this->response->setJsonContent($data);
                    }
                }
                else
                {
                    $data = array("logged" => false,'message' =>"File Not Uploaded");
                    $this->response->setJsonContent($data);
                }
                
                $this->response->send();  
                
            }
        }

    }
    public function fetchcmplistAction()
    {  
         $this->view->disable();
         $getuserid = $this->session->loginauthspuserfront['id'];
         $usergroup =$this->session->loginauthspuserfront['user_group_id'];
         $timeago = time();
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
                   $result= $this->companymodulecommon->fetchcmplist($mainqry,$getuserid);
                   $rscnt=count($result);
                   $rspgs = ceil($rscnt/$noofrows);
                   $pgndata = $this->elements->paginatndata($pagenum,$rspgs);
                   $pgnhtml = $this->elements->paginationhtml($pagenum,$pgndata['start_loop'],$pgndata['end_loop'],$rspgs);
                   $data= $this->companymodulecommon->fetchcmplist($rslmt,$getuserid);
                   // print_r($data);exit;
                    if(!empty($data))
                    {
                        $data = array("logged" => true,'message' =>"Data Fetched Successfully",'data'=>$data,'pgnhtml'=>$pgnhtml);
                        $this->response->setJsonContent($data);
                    }
                    else
                    {
                        $data = array("logged" => false,'message' => "No Data Found",'data'=>'','pgnhtml'=>$pgnhtml);
                        $this->response->setJsonContent($data);
                    }
                    $this->response->send(); 
             }
         }
     }
    
     public function addcmpmoduleAction()
     {
         $this->view->disable();
         $getuserid = $this->session->loginauthspuserfront['id'];
         $usergroup =$this->session->loginauthspuserfront['user_group_id'];
         $timeago = time();
         
        if($this->request->isPost() == true)
        {
            if($this->request->isAjax() == true)
            {
                $cmpname=$this->request->getPost('cmpname','trim');
                
                $result= $this->companymodulecommon->addcmpmodule($getuserid,$usergroup,$cmpname);
                if($result==1)
                {
                    $data = array("logged" => true,'message' =>"Company Added Successfully");
                    $this->response->setJsonContent($data);
                }
                else if($result==2)
                {
                    $data = array("logged" => false,'message' =>"Company  Allready Exist");
                    $this->response->setJsonContent($data);
                }
                else
                {
                    $data = array("logged" => false,'message' =>"Company  Deleted Successfully");
                    $this->response->setJsonContent($data);
                }
                $this->response->send();
            }
        }
     }
    
     public function deletecmpAction()
     {
         $this->view->disable();
         $getuserid = $this->session->loginauthspuserfront['id'];
         $usergroup =$this->session->loginauthspuserfront['user_group_id'];
         $timeago = time();
         
        if($this->request->isPost() == true)
        {
            if($this->request->isAjax() == true)
            {
              $delid=$this->request->getPost('delid','trim');
              $result= $this->companymodulecommon->deletecompanymodule($getuserid,$usergroup,$delid);
              if($result==1)
              {
                  $data = array("logged" => true,'message' =>"Company Deleted Successfully");
                  $this->response->setJsonContent($data);
              }
              else
              {
                 $data = array("logged" => false,'message' =>"Company Not Deleted Successfully");
                 $this->response->setJsonContent($data);
              }
                 $this->response->send(); 
             }
        }
     }
    
     public function fetcheditcmpAction()
     {
         $this->view->disable();
         $getuserid = $this->session->loginauthspuserfront['id'];
         $usergroup =$this->session->loginauthspuserfront['user_group_id'];
         $timeago = time();
         
        if($this->request->isPost() == true)
        {
            if($this->request->isAjax() == true)
            {
               $editid=$this->request->getPost('editid','trim');
               $result= $this->companymodulecommon->fetcheditcmp($getuserid,$usergroup,$editid);
               if(!empty($result))
               {
                   $data = array("logged" => true,'message' =>"data fetch Successfully",'data'=>$result);
                  $this->response->setJsonContent($data);
               }
               else{
                 $data = array("logged" => false,'message' =>"data not fetch");
                 $this->response->setJsonContent($data);
                }
                  $this->response->send(); 
            }
        }
     }
    
     public function updatecmpmodAction()
     {
        $this->view->disable();
        $getuserid = $this->session->loginauthspuserfront['id'];
        $usergroup =$this->session->loginauthspuserfront['user_group_id'];
        $timeago = time();
         
        if($this->request->isPost() == true)
        {
            if($this->request->isAjax() == true)
            {
                $cmpname=$this->request->getPost('cmpname','trim');
                //  $accselect=$this->request->getPost('accselect','trim');
                $editcmpid=$this->request->getPost('editcmpid','trim');
                
                $result= $this->companymodulecommon->updatecmp($getuserid,$usergroup,$cmpname,$editcmpid);
                if($result)
                {
                    $data = array("logged" => true,'message' =>"Data Updated Successfully");
                    $this->response->setJsonContent($data);
                }
                else
                {
                    $data = array("logged" => false,'message' =>"Something Went to wrong");
                    $this->response->setJsonContent($data);
                }
                $this->response->send();
            }
        }

     }

     //-------------------------------------search----------------------------------------
    public function fetchsearchlistAction()
    {  
         $this->view->disable();
         $getuserid = $this->session->loginauthspuserfront['id'];
         $usergroup =$this->session->loginauthspuserfront['user_group_id'];
         $timeago = time();
         if($this->request->isPost() == true)
        {
            if($this->request->isAjax() == true)
            {


                  $numofdata = $this->request->getPost('numofdata','trim'); 
                  $search=  $this->request->getPost('search','trim');  
                  $pagedata=$this->request->getPost();
                          
                   $noofrows=$pagedata['noofrows'];
                   $pagenum=$pagedata['pagenum'];
                   $rsstrt = ($pagenum-1) * $noofrows;
                   $rslmt = 'AND company_name LIKE "%'.$search.'%" ORDER BY ID DESC LIMIT '.$rsstrt.','.$noofrows;
                   $mainqry='AND company_name LIKE "%'.$search.'%"';
                   $result= $this->companymodulecommon->fetchcmplist($mainqry,$getuserid);
                   $rscnt=count($result);
                   $rspgs = ceil($rscnt/$noofrows);
                   $pgndata = $this->elements->paginatndata($pagenum,$rspgs);
                   $pgnhtml = $this->elements->paginationhtml($pagenum,$pgndata['start_loop'],$pgndata['end_loop'],$rspgs);
                   $data= $this->companymodulecommon->fetchcmplist($rslmt,$getuserid);
                   // print_r($data);exit;
                    if(!empty($data))
                    {
                        $data = array("logged" => true,'message' =>"Data Fetched Successfully",'data'=>$data,'pgnhtml'=>$pgnhtml);
                        $this->response->setJsonContent($data);
                    }
                    else
                    {
                        $data = array("logged" => false,'message' => "No Data Found",'data'=>'','pgnhtml'=>$pgnhtml);
                        $this->response->setJsonContent($data);
                    }
                    $this->response->send(); 
             }
         }
     }
  }

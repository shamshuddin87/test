<?php

class TermsandconditionsController extends ControllerBase
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

    public function uploadtradingfileAction()
    {
        $this->view->disable();
        $getuserid = $this->session->loginauthspuserfront['id'];
        $user_group_id = $this->session->loginauthspuserfront['user_group_id'];
          if($this->request->isPost() == true)
        {
            if($this->request->isAjax() == true)
            {


            	    $filetitle = $this->request->getPost('filetitle','trim');
            	    if(empty($filetitle) && $filetitle=='')
            	    {

            	     $data = array("logged" => false,"message" =>"Please Insert File Title");
            	      $this->response->setJsonContent($data);

            	    }

            	     else if(empty($_FILES['fileToUpload']['name']))
                      {
                          
                           $data = array("logged" => false,"message" =>"File Not  Uploaded ");
                            $this->response->setJsonContent($data);
                      }

                    else
                    {
                       

                            $filetitle = $this->request->getPost('filetitle');
	                        $upload_path = $this->cmpmodule."/tradingrequest/";  
	                        $target_file =  $upload_path.time();
	                        $filename = $_FILES['fileToUpload']['name'];    
	                        $file = str_replace(' ','_',$filename);  
     	                    $result = move_uploaded_file($_FILES['fileToUpload']['tmp_name'],$target_file.$file);
 
		                       if($result==true)
		                       {
		                            $res=$this->termsandconditionscommon->uploadtermsandconditions($getuserid,$user_group_id ,$target_file.$file,$filetitle);
			                          if($res==true)
			                          {
			                              $data = array("logged" => true,"message" =>"File Uploaded Successfully..!!! ");
			                               $this->response->setJsonContent($data);
			                          }
			                          else
			                          {
			                               $data = array("logged" => false,"message" =>"File Not Uploaded ");
			                                $this->response->setJsonContent($data);
			                          }

		                       }
              
	                       }
                      }
                
                 
                  $this->response->send();
          }
     }


     public function getallfilesAction()
     {
          $this->view->disable();
          $getuserid = $this->session->loginauthspuserfront['id'];
          $user_group_id = $this->session->loginauthspuserfront['user_group_id'];
          if($this->request->isPost() == true)
        {
            if($this->request->isAjax() == true)
            {   
                $res=$this->termsandconditionscommon->getallfile($getuserid,$user_group_id);
                // print_r($res);exit;
			     if(!empty($res))
			    {
			      $data = array("logged" => true,"message" =>"data fetch Successfully","data"=>$res);
			      $this->response->setJsonContent($data);
			     }
			     else
			    {
			       $data = array("logged" => false,"message" =>"data not fetched","data"=>'');
			       $this->response->setJsonContent($data);
			    }
			     $this->response->send();

            }
        }    
     }
    
     public function deletetermsAction()
     {
          $this->view->disable();
          $getuserid = $this->session->loginauthspuserfront['id'];
          $user_group_id = $this->session->loginauthspuserfront['user_group_id'];
            if($this->request->isPost() == true)
           {
            if($this->request->isAjax() == true)
            {
               $reqid = $this->request->getPost('reqid','trim');
               $res=$this->termsandconditionscommon->deleteresource($reqid);
                 // print_r($res);exit;
			     if($res==true)
			    {
			      $data = array("logged" => true,"message" =>"Record Deleted Successfully");
			      $this->response->setJsonContent($data);
			     }
			     else
			    {
			       $data = array("logged" => false,"message" =>"Record Not Deleted");
			       $this->response->setJsonContent($data);
			    }
			     $this->response->send();
            }
        }
     }
}

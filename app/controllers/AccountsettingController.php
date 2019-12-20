<?php
class AccountsettingController extends ControllerBase
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
        $getmn = $this->session->orgdtl;

        /*#################### Create Files for Controller ####################*/
        $gtnme = $this->router->getControllerName();
        $this->elements->createfile($gtnme);
        /*#################### Create Files for Controller /-####################*/
        $getmoc = $this->request->getQuery('moc');
        $this->view->getmoc = trim($getmoc);
        $uid = $this->session->loginauthspuserfront['id'];
        $exegetuinfo = $this->usercommon->getuinfoext($uid);
        $exegetuinfo = array_shift($exegetuinfo);
        //echo '<pre>';print_r();exit;
        $this->view->exegetuinfo = $exegetuinfo;
        $gerp = $this->session->loginauthspuserfront;
        $this->view->userimg = array_shift($this->usercommon->getuinfoext($uid));
    }
    
    public function updateuerAction()
    {
        $this->view->disable();
        $uid = $this->session->loginauthspuserfront['id'];
        //echo '<pre>';print_r($uid);exit;
        
        if($this->request->isPost() == true)
        {
            if($this->request->isAjax() == true)
            {
                $getmn = $this->session->orgdtl;

                $fnameofu = $this->request->getPost('fnameofu','trim');
                $lnameofu = $this->request->getPost('lnameofu','trim');
                $mobnumnm = $this->request->getPost('mobnumnm','trim');
                $dobofu = $this->request->getPost('dobofu','trim');
                $radiogender = $this->request->getPost('radiogender','trim');
                $emailidmt = $this->request->getPost('emailofu','trim');
                $emailid = $this->session->loginauthspuserfront['email'];
                
                $userarray = array('fnameofu'=>$fnameofu,'lnameofu'=>$lnameofu,'mobnumnm'=>$mobnumnm,
                                   'dobofu'=>$dobofu,'radiogender'=>$radiogender,'emailid'=>$emailid);
                
                if($fnameofu=='' || empty($fnameofu))
                {
                    $data = array("logged"=>false,  'message'=>'Please provide First name');
                    $this->response->setJsonContent($data);
                }
                else if($emailidmt!=$emailid)
                {
                    $data = array("logged"=>false,  'message'=>'Please Don\'t Cheet with web console DOM elements.');
                    $this->response->setJsonContent($data);
                }
                else if($lnameofu=='' || empty($lnameofu))
                {
                    $data = array("logged"=>false,  'message'=>'Please provide last name');
                    $this->response->setJsonContent($data);
                    
                }
                else if($mobnumnm=='' || empty($mobnumnm))
                {
                    $data = array("logged"=>false,  'message'=>'Please Provide mobile num to contact you.' );
                    $this->response->setJsonContent($data);
                }
                else
                {
                    $getresult = $this->usercommon->getuserdetailsupd($userarray);
                    //echo '<pre>'; print_r($getresult); exit;
                    if($getresult['status']==true)
                    {
                        $data = array("logged"=>true, 'data'=>$getresult, 'message'=>'Record Updated !!!');
                        $this->response->setJsonContent($data);
                    }
                    else
                    {
                        $data = array("logged" => false,'message' => 'Not able to update record');
                        $this->response->setJsonContent($data);
                    }
                }
                //echo '<pre>'; print_r($data); exit;
                $this->response->send();
            }
            else
            {
                exit('No direct script access allowed -to this area');
            }

        }
        else
        {
            return $this->response->redirect('errors/show404');
            exit('No direct script access allowed');
        }
    }
    
    public function uploadimageAction()
    {
        $this->view->disable();
        $getuserid = $this->session->loginauthspuserfront['id'];
        $cin = $this->session->memberdoccin;
        $user_group_id = $this->session->loginauthspuserfront['user_group_id'];
        $firstname = $this->session->loginauthspuserfront['firstname'];
        $lastname = $this->session->loginauthspuserfront['lastname'];
        $timeago = time();
        //echo '<pre>';print_r($this->session->profilecommondir['createdirname']);exit;
        $devicedetect = $this->devicedetect;
        
        if($this->request->isPost() == true)
        {
            if($this->request->isAjax() == true)
            {
                
                $userfile_name = $_FILES['uploadimage']['name'];
                //echo $userfile_name;exit;
                $userfile_tmp = $_FILES['uploadimage']['tmp_name'];
                $userfile_size = $_FILES['uploadimage']['size'];
                $userfile_type = $_FILES['uploadimage']['type'];
                $filename = basename($_FILES['uploadimage']['name']);
                //echo $filename;exit;
                
                $file_ext = $this->validationcommon->getfileext($filename);
                $getudir = $this->session->profilecommondir['createdirname'];
                
                $upload_path = $this->avatardocdir."/";  
                $upload_path = $upload_path.$getudir."/";  
                
                
                if(!is_dir($upload_path)){
                    @mkdir($upload_path, 0777);
                    chmod($upload_path, 0777);
                }
                
                $large_imp_name = 'uploadedby-'.$firstname.'_'.$lastname.'_userid-'.$getuserid.'_timeago-'.$timeago;
                $large_imp_name = strtolower($large_imp_name);
                
                
                
                $large_impfile_location = $upload_path.$large_imp_name.".".$file_ext;
                
                $uploadedornot = @move_uploaded_file($userfile_tmp, $large_impfile_location);
                //echo $large_impfile_location;exit;
                
                $m = array('imgpth'=>$large_impfile_location);
                $ttt = $this->usercommon->updateimagepath($getuserid,$m);
                
                //echo '<pre>';print_r($ttt);exit;
                    
                if($ttt['logged']==true)
                {
                    $data = array("logged" => true,'message' => 'File Uploaded','imglocation'=>$large_impfile_location);
                    $this->response->setJsonContent($data);
                }
                else
                {
                    $data = array("logged" => false,'message' => 'File not Uploaded');
                    $this->response->setJsonContent($data);
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
    
}

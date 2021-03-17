<?php 
class CoiController extends ControllerBase
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
        
    }
    
    public function createcoiAction()
    {
        
    }
    
    public function viewcoiAction()
    {
        
    }
    
    public function fetchEmpDetailsAction()
    {
        $this->view->disable();
        $getuserid = $this->session->loginauthspuserfront['id'];
        $user_group_id = $this->session->loginauthspuserfront['user_group_id'];
        //echo $cin;exit;
        $timeago = time();

        if($this->request->isPost() == true)
        {
            if($this->request->isAjax() == true)
            {
                $empData = $this->coicommon->fetchEmpDetails($getuserid,$user_group_id);
                
                if(!empty($empData))
                {
                    $data  = array('logged' => true, 'data' => $empData);
                    $this->response->setJsonContent($data);
                }
                else
                {
                    $data  = array('logged' => false, 'data' => ''); 
                    $this->response->setJsonContent($data);
                }
                $this->response->send();
            }
            else
            {
                exit('No direct script access allowed to this area');
                $connection->close();
            }
        }
        else
        {
            return $this->response->redirect('errors/show404');
            exit('No direct script access allowed');
        }
    }
    
    public function fetchCateQuestionsAction()
    {
        $this->view->disable();
        $getuserid = $this->session->loginauthspuserfront['id'];
        $user_group_id = $this->session->loginauthspuserfront['user_group_id'];
        //echo $cin;exit;
        $timeago = time();

        if($this->request->isPost() == true)
        {
            if($this->request->isAjax() == true)
            {
                $coihtml = '';
                $coicateid = $this->request->getPost('coicate');
                $cateQueData = $this->coicommon->fetchCateQuestions($getuserid,$user_group_id,$coicateid);
                //print_r($cateQueData);exit;
                if(!empty($cateQueData))
                {
                    for ($i = 0; $i < sizeof($cateQueData); $i++) 
                    {
                        $coihtml.= '<input class="cateque" type="radio" name="question" id="'.$cateQueData[$i]['idattr'].'" value="'.$cateQueData[$i]['id'].'">
                        <label>'.$cateQueData[$i]['question'].'</label>';
                    }
                    //print_r($coihtml);exit;
                    $data  = array('logged' => true, 'data' => $coihtml);
                    $this->response->setJsonContent($data);
                }
                else
                {
                    $data  = array('logged' => false, 'data' => ''); 
                    $this->response->setJsonContent($data);
                }
                $this->response->send();
            }
            else
            {
                exit('No direct script access allowed to this area');
                $connection->close();
            }
        }
        else
        {
            return $this->response->redirect('errors/show404');
            exit('No direct script access allowed');
        }
    }
    
    public function insertcoiAction()
    {
        $this->view->disable();
        $getuserid = $this->session->loginauthspuserfront['id'];
        $cin = $this->session->memberdoccin;
        $user_group_id = $this->session->loginauthspuserfront['user_group_id'];
        if($this->request->isPost() == true)
        {
            if($this->request->isAjax() == true)
            {
                //print_r($this->request->getPost());exit;
                $formsend_status = 0;
                $coipolicy = $this->request->getPost('coipolicy');
                $coicategory = $this->request->getPost('coicategory');
                $catequeid = $this->request->getPost('question');
                $others_des = $this->request->getPost('others_des');
                $coipdfhtml = $this->request->getPost('coipdfhtml');
                $formsendtype = $this->request->getPost('formsendtype');
                if($formsendtype == 'yes')
                {
                    $formsend_status = 1;
                }
                
                if(!empty($_FILES["attachment"]))
                {
                    foreach($_FILES['attachment']['tmp_name'] as $key => $val )
                    {
                        $timeago = time();
                        $userfile_name = $_FILES['attachment']['name'][$key];
                        //echo $userfile_name;exit;
                        $userfile_tmp = $_FILES['attachment']['tmp_name'][$key];
                        $userfile_size = $_FILES['attachment']['size'][$key];
                        $userfile_type = $_FILES['attachment']['type'][$key];
                        $filename = basename($_FILES['attachment']['name'][$key]);
                        //echo $filename;exit;
                        $filenm = explode('.', $filename);
                        $filenms[] = $filenm[0];
                        $file_ext = $this->validationcommon->getfileext($filename);
                        $upload_path = $this->coiDir."/Attachments/";
                        //echo $upload_path;exit;
                        $large_imp_name = 'COI_Declaration_userid_'.$getuserid.'_timeago_'.$timeago.'_'.$key;
                        $contract_filepath = $upload_path.$large_imp_name.".".$file_ext;
                        $uploadedornot = move_uploaded_file($userfile_tmp, $contract_filepath);
                        //echo $uploadedornot;exit;
                        $filelist[] = $contract_filepath;
                    }
                    $attachments = implode(',',$filelist);
                    //print_r($filelist);exit;
                }
                else
                {
                    $attachments='';
                }
                
                if($coipolicy == 'yes' && empty($coicategory))
                {
                    $data = array("logged" => false,'message' => "Please select the category.");
                    $this->response->setJsonContent($data);
                }
                else if(empty($catequeid))
                {
                    $data = array("logged" => false,'message' => "Please select option.");
                    $this->response->setJsonContent($data);
                }
                else
                {
                    $pdfpath = $this->dompdfgen->getpdf($coipdfhtml,'COI','Declaration','coi');
                    //print_r($pdfpath);exit;
                    $getres = $this->coicommon->insertcoi($getuserid,$user_group_id,$coipolicy,$coicategory,$catequeid,$others_des,$attachments,$formsend_status,$pdfpath);
                    if($getres)
                    {  
                        $data = array("logged" => true,'message' => 'Record Added');
                        $this->response->setJsonContent($data);
                    }
                    else
                    {
                        $data = array("logged" => false,'message' => "Record Not Added..!!");
                        $this->response->setJsonContent($data);
                    }
                }
                $this->response->send();
            }
            else
            {
                exit('No direct script access allowed to this area');
                $connection->close();
            }
        }
        else
        {
            return $this->response->redirect('errors/show404');
            exit('No direct script access allowed');
        }
    }
    
    public function fetchCoiAllDataAction()
    {
        $this->view->disable();
        $getuserid = $this->session->loginauthspuserfront['id'];
        $user_group_id = $this->session->loginauthspuserfront['user_group_id'];
        //echo $cin;exit;
        $timeago = time();

        if($this->request->isPost() == true)
        {
            if($this->request->isAjax() == true)
            {
                $coiData = $this->coicommon->fetchCoiAllData($getuserid,$user_group_id);
                // print_r($coiData);exit;
                if(!empty($coiData))
                {
                    $data  = array('logged' => true, 'data' => $coiData); 
                    $this->response->setJsonContent($data);
                }
                else
                {
                    $data  = array('logged' => false, 'data' => ''); 
                    $this->response->setJsonContent($data);
                }
                $this->response->send();
            }
            else
            {
                exit('No direct script access allowed to this area');
                $connection->close();
            }
        }
        else
        {
            return $this->response->redirect('errors/show404');
            exit('No direct script access allowed');
        }
    }


//-------------- Start: Send mail to hr/dept manager for approval --------------------//
    public function sendaprvmailtomgrAction()
    {
        $this->view->disable();
        $uid = $this->session->loginauthspuserfront['id'];
        $user_group_id = $this->session->loginauthspuserfront['user_group_id'];
        $timeago = time();

        if($this->request->isPost() == true)
        {
            if($this->request->isAjax() == true)
            {
                $reqid = $this->request->getPost('reqid');
                $deptaccess = $this->coicommon->getDeptaccess($uid);
                $hrmgr = $this->coicommon->getHrDeptMgrs($deptaccess,"","hr");
                print_r($hrmgr);die;
                $mailsentstatus = $this->coicommon->sendaprvmailtomgr($hrmgr['email'],$reqid);
                // print_r($mailsentstatus);exit;
                if($mailsentstatus)
                {
                    $data  = array('logged' => true, 'data' => $coiData); 
                    $this->response->setJsonContent($data);
                }
                else
                {
                    $data  = array('logged' => false, 'data' => ''); 
                    $this->response->setJsonContent($data);
                }
                $this->response->send();
            }
            else
            {
                exit('No direct script access allowed to this area');
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
//-------------- End: Send mail to hr/dept manager for approval --------------------//
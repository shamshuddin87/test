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
    
    public function editcoiAction()
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
                        $coihtml.= '<label class="informationlable"><input class="cateque" type="radio" name="question" id="'.$cateQueData[$i]['idattr'].'" value="'.$cateQueData[$i]['id'].'">
                        <span class="informationqus">'.$cateQueData[$i]['question'].'</span></label>';
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
                else if($coipolicy == 'yes' && empty($catequeid))
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
                        $data = array("logged" => true,'message' => 'Record Added','pdfpath'=>$pdfpath);
                        $this->response->setJsonContent($data);
                    }
                    else
                    {
                        $data = array("logged" => false,'message' => "Record Not Added..!!",'pdfpath'=>'');
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
                // ------- Pagination Start -------
                    $noofrows = $this->request->getPost('noofrows','trim');
                    $pagenum = $this->request->getPost('pagenum','trim');
                    //echo $pagenum.'*'.$noofrows; exit;
                    $rsstrt = ($pagenum-1) * $noofrows;
                    //echo $rsstrt; exit;
                // ------- Pagination End -------
                
                    $rslmt = ' LIMIT '.$rsstrt.','.$noofrows;
                    //echo '<pre>'; print_r($rslmt); exit;
                    $orderby = ' ORDER BY `id` DESC ';
                    //echo $query; exit;

                    $mainqry = $orderby;
                    $fnlqry = $mainqry.$rslmt;
                    // echo $fnlqry; exit;
                
                $coiData = $this->coicommon->fetchCoiAllData($getuserid,$user_group_id,$fnlqry);
                $allrows = $this->coicommon->fetchCoiAllData($getuserid,$user_group_id,$mainqry);
                // print_r($coiData);exit;
                
                // ------- Pagination Start -------
                    $rscnt = count($allrows);
                    $rspgs = ceil($rscnt/$noofrows);
                    $pgndata = $this->elements->paginatndata($pagenum,$rspgs);
                    $pgnhtml = $this->elements->paginationhtml($pagenum,$pgndata['start_loop'],$pgndata['end_loop'],$rspgs);
                    //echo '<pre>';print_r($pgnhtml);exit;
                // ------- Pagination End -------
                if(!empty($coiData))
                {
                    $data  = array('logged' => true, 'data' => $coiData,"pgnhtml"=>$pgnhtml); 
                    $this->response->setJsonContent($data);
                }
                else
                {
                    $data  = array('logged' => false, 'data' => '',"pgnhtml"=>$pgnhtml); 
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


//-------------- Start: Send mail to hr manager for approval --------------------//
    public function sendaprvmailtohrmgrAction()
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
                $deptdata = $this->coicommon->getDeptaccess($uid);
                $hrmgr = $this->coicommon->getHrDeptMgrs($deptdata['deptid'],"","hr");
                // print_r($hrmgr);die;
                $mailsentstatus = $this->coicommon->sendaprvmailtomgr($deptdata['deptname'],$hrmgr['mgrname'],$hrmgr['email'],$reqid);
                // print_r($mailsentstatus);exit;
                if($mailsentstatus)
                {

                    //-------------- Start: CCO and CS email intimation -------------//
                         $YORuser = $this->coicommon->checkYORuser($uid);
                         $recipientnames = array("CCO","CS");
                         $recipientemailids = array("cco@volody.com","cs@volody.com");
                         if($YORuser)
                            {
                             for ($i=0; $i < count($recipientnames); $i++) 
                                { 
                                    $this->coicommon->sendapprmailtoccoandcs($reqid,$recipientnames[$i],$deptdata['deptname'],$recipientemailids[$i],$approvalName);
                                } 
                            }
                         
                    //-------------- End: CCO and CS email intimation -------------//
                            
                    $this->coicommon->updateCOIRequest($reqid,"sent");
                    $this->coicommon->insertCOIAuditTrail($reqid,"sent","");
                    $data  = array('logged' => true, 'message' => 'Mail Sent Successfully.'); 
                    $this->response->setJsonContent($data);
                }
                else
                {
                    $data  = array('logged' => false, 'message' => 'Mail not sent.'); 
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
    
//-------------- End: Send mail to hr manager for approval --------------------//

    public function fetchCoiMgrDataAction()
    {
        $this->view->disable();
        $getuserid = $this->session->loginauthspuserfront['id'];
        $user_group_id = $this->session->loginauthspuserfront['user_group_id'];
        $managertype = $this->session->loginauthspuserfront['managertype'];
        //echo $cin;exit;
        $timeago = time();

        if($this->request->isPost() == true)
        {
            if($this->request->isAjax() == true)
            {
                $coiData = $this->coicommon->fetchCoiMgrData($getuserid,$user_group_id);
                // print_r($coiData);exit;
                if(!empty($coiData))
                {
                    $data  = array('logged' => true, 'data' => $coiData,'managertype'=>$managertype); 
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


    public function approveRequestAction()
    {
        $this->view->disable();
        $uid = $this->session->loginauthspuserfront['id'];
        $user_group_id = $this->session->loginauthspuserfront['user_group_id'];
        $managertype = trim($this->session->loginauthspuserfront['managertype']);
        $timeago = time();

        if($this->request->isPost() == true)
        {
            if($this->request->isAjax() == true)
            {
                $reqid = $this->request->getPost('reqid');
                $approvalName = $this->coicommon->getApprovalName($uid);
                $reqUserId = $this->coicommon->getReqUserId($reqid);          
                $deptdata = $this->coicommon->getDeptaccess($reqUserId);
                if($managertype == "hr")
                {
                    $deptmgr = $this->coicommon->getHrDeptMgrs($deptdata['deptid'],"","dept");
                    // print_r($deptmgr);die;
                    $mailsentstatus = $this->coicommon->sendaprvmailtomgr($deptdata['deptname'],$deptmgr['mgrname'],$deptmgr['email'],$reqid);
                    // print_r($mailsentstatus);exit;
                    if($mailsentstatus)
                    {
                        //-------------- Start: CCO and CS email intimation -------------//

                         $YORuser = $this->coicommon->checkYORuser($uid);
                         $recipientnames = array("CCO","CS");
                         $recipientemailids = array("cco@volody.com","cs@volody.com");
                         if($YORuser)
                            {
                             for ($i=0; $i < count($recipientnames); $i++) 
                                { 
                                    $this->coicommon->sendapprmailtoccoandcs($reqid,$recipientnames[$i],$deptdata['deptname'],$recipientemailids[$i],$approvalName);
                                } 
                            }
                         
                        //-------------- End: CCO and CS email intimation -------------//

                        $this->coicommon->updateCOIRequest($reqid,"approval");
                        $this->coicommon->insertCOIAuditTrail($reqid,"approval","");
                        $data  = array('logged' => true, 'message' => 'Approval Granted.'); 
                        $this->response->setJsonContent($data);
                    }
                    else
                    {
                        $data  = array('logged' => false, 'message' => 'Unable to approve request.'); 
                        $this->response->setJsonContent($data);
                    }
                }
                else if($managertype == "dept")
                {
                    //-------------- Start: CCO and CS email intimation -------------//
                         $YORuser = $this->coicommon->checkYORuser($uid);
                         $recipientnames = array("CCO","CS");
                         $recipientemailids = array("cco@volody.com","cs@volody.com");
                         if($YORuser)
                            {
                             for ($i=0; $i < count($recipientnames); $i++) 
                                { 
                                    $this->coicommon->sendapprmailtoccoandcs($reqid,$recipientnames[$i],$deptdata['deptname'],$recipientemailids[$i],$approvalName);
                                } 
                            }
                         
                    //-------------- End: CCO and CS email intimation -------------//

                    $this->coicommon->updateCOIRequest($reqid,"approval");
                    $this->coicommon->insertCOIAuditTrail($reqid,"approval","");
                    $data  = array('logged' => true, 'message' => 'Approval Granted.'); 
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

    public function fetchAuditTrailAction()
    {
        $this->view->disable();
        $getuserid = $this->session->loginauthspuserfront['id'];
        $user_group_id = $this->session->loginauthspuserfront['user_group_id'];
        $managertype = $this->session->loginauthspuserfront['managertype'];
        //echo $cin;exit;
        $timeago = time();

        if($this->request->isPost() == true)
        {
            if($this->request->isAjax() == true)
            {
                $reqid = $this->request->getPost('reqid');
                $auditTrailData = $this->coicommon->fetchAuditTrail($reqid);
                // print_r($coiData);exit;
                if(!empty($auditTrailData))
                {
                    $data  = array('logged' => true, 'data' => $auditTrailData); 
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


    public function rejectRequestAction()
    {
        $this->view->disable();
        $uid = $this->session->loginauthspuserfront['id'];
        $user_group_id = $this->session->loginauthspuserfront['user_group_id'];
        $managertype = trim($this->session->loginauthspuserfront['managertype']);
        $timeago = time();

        if($this->request->isPost() == true)
        {
            if($this->request->isAjax() == true)
            {
                $reqid = $this->request->getPost('reqid');
                $recommendation = $this->request->getPost('recommendation');
                if($managertype == "hr")
                {
                        $this->coicommon->updateCOIRequest($reqid,"reject");
                        $this->coicommon->insertCOIAuditTrail($reqid,"reject",$recommendation);
                        $data  = array('logged' => true, 'message' => 'Request Rejected.'); 
                        $this->response->setJsonContent($data);
                }
                // else if($managertype == "dept")
                // {
                //     $this->coicommon->updateCOIRequest($reqid,"reject");
                //     $this->coicommon->insertCOIAuditTrail($reqid,"reject");
                //     $data  = array('logged' => true, 'message' => 'Request Rejected.'); 
                //     $this->response->setJsonContent($data);
                // }
                
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


    public function returnRequestAction()
    {
        $this->view->disable();
        $uid = $this->session->loginauthspuserfront['id'];
        $user_group_id = $this->session->loginauthspuserfront['user_group_id'];
        $managertype = trim($this->session->loginauthspuserfront['managertype']);
        $timeago = time();

        if($this->request->isPost() == true)
        {
            if($this->request->isAjax() == true)
            {
                $reqid = $this->request->getPost('reqid');
                $recommendation = $this->request->getPost('recommendation');
                if($managertype == "hr")
                {
                        $this->coicommon->updateCOIRequest($reqid,"return");
                        $this->coicommon->insertCOIAuditTrail($reqid,"return",$recommendation);
                        $data  = array('logged' => true, 'message' => 'Request Returned.'); 
                        $this->response->setJsonContent($data);
                }
                else if($managertype == "dept")
                {
                    $this->coicommon->updateCOIRequest($reqid,"return");
                    $this->coicommon->insertCOIAuditTrail($reqid,"return",$recommendation);
                    $data  = array('logged' => true, 'message' => 'Request Returned.'); 
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


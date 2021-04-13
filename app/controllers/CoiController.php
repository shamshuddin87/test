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
        $coiid = $_GET['coiid'];
        $this->view->coieditid = base64_decode($coiid);
        //print_r($coiid);exit;
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
                        <span class="informationqus">'.$cateQueData[$i]['question'].'</span></label></br>';
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
        $email = $this->session->loginauthspuserfront['email'];
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
                    
                    if($getres['status'] === true)
                    {  
                        $deptdata = $this->coicommon->getDeptaccess($getuserid);
                        /* Send Mail to Requestor after submit form */
                        $mailtoReq = $this->coicommon->sendAckMailtoReq($deptdata['deptname'],$email,$getres['coiid']);
                        /* Send Mail to Requestor after submit form */
                        
                        /* Send Mail to HR for Approval */
                        if($formsendtype == 'yes')
                        {
                            
                            $hrmgr = $this->coicommon->getHrDeptMgrs($deptdata['deptid'],"","hr");
                            // print_r($hrmgr);die;
                            foreach($hrmgr as $mgr)
                            { 
                                $mailsentstatus = $this->coicommon->sendaprvmailtomgr($deptdata['deptname'],$mgr['mgrname'],$mgr['email'],$getres['coiid']);
                            }

                            if($mailsentstatus)
                            {
                                 //-------------- Start: On request for approval: CCO and CS email intimation -------------//
                                $YORuser = $this->coicommon->checkYORuser($getuserid);
                                $recipientnames = array("CCO","CS");
                                $recipientemailids = array("kusum@volody.com1","hemang@volody.com1");
                                if($YORuser)
                                {
                                    for ($i=0; $i < count($recipientnames); $i++) 
                                    { 
                                        $this->coicommon->requestapprmailtoccoandcs($reqid,$recipientnames[$i],$deptdata['deptname'],$recipientemailids[$i]);
                                    } 
                                }
                         
                                //-------------- End: On request for approval: CCO and CS email intimation -------------//
                            
                                //$this->coicommon->updateCOIRequest($reqid,"sent");
                                $this->coicommon->insertCOIAuditTrail($getres['coiid'],"sent","");
                            }
                        }
                        /* Send Mail to HR for Approval */
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
                foreach($hrmgr as $mgr)
                {
                    $mailsentstatus = $this->coicommon->sendaprvmailtomgr($deptdata['deptname'],$mgr['mgrname'],$mgr['email'],$reqid);
                }
                
                // print_r($mailsentstatus);exit;
                if($mailsentstatus)
                {

                    //-------------- Start: On request for approval: CCO and CS email intimation -------------//
                         $YORuser = $this->coicommon->checkYORuser($uid);
                         $recipientnames = array("CCO","CS");
                         $recipientemailids = array("kusum@volody.com1","hemang@volody.com1");
                         if($YORuser)
                            {
                             for ($i=0; $i < count($recipientnames); $i++) 
                                { 
                                    $this->coicommon->requestapprmailtoccoandcs($reqid,$recipientnames[$i],$deptdata['deptname'],$recipientemailids[$i]);
                                } 
                            }
                         
                    //-------------- End: On request for approval: CCO and CS email intimation -------------//
                            
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
                //print_r($this->request->getPost());exit;
                // ------- Pagination Start -------
                $noofrows = $this->request->getPost('noofrows','trim');
                $pagenum = $this->request->getPost('pagenum','trim');
                $filterstatus = $this->request->getPost('filterstatus','trim');
                $startdate = $this->request->getPost('startdate','trim');
                $enddate = $this->request->getPost('enddate','trim');
                $srchbyusr = $this->request->getPost('srchbyusr','trim');
                //echo $pagenum.'*'.$noofrows; exit;
                $rsstrt = ($pagenum-1) * $noofrows;
                //echo $rsstrt; exit;
                // ------- Pagination End -------

                $rslmt = ' LIMIT '.$rsstrt.','.$noofrows;
                //echo '<pre>'; print_r($rslmt); exit;
                $orderby = ' GROUP BY cd.`id` ORDER BY cd.`id` DESC ';
                //echo $query; exit;

                $mainqry = '';
                if(!empty($filterstatus))
                {
                    if($managertype == 'hr')
                    {
                        $mainqry.= " AND `hrM_processed_status` = '".$filterstatus."'";
                    }
                    else if($managertype == 'dept')
                    {
                        $mainqry.= " AND `deptM_processed_status` = '".$filterstatus."'";
                    }
                }
                if(!empty($startdate) && !empty($enddate))
                {
                    $startdate = date('Y-m-d', strtotime($startdate));
                    $enddate = date('Y-m-d', strtotime($enddate));
                    $mainqry.= " AND STR_TO_DATE(cd.`date_added`,'%Y-%m-%d') BETWEEN STR_TO_DATE('".$startdate."','%Y-%m-%d') AND STR_TO_DATE('".$enddate."','%Y-%m-%d')";
                }
                if(!empty($srchbyusr))
                {
                    $mainqry.= " AND (im.`employeecode` LIKE '%".$srchbyusr."%' OR im.`fullname` LIKE '%".$srchbyusr."%') ";
                }
                $fnlqry = $mainqry.$orderby.$rslmt;
                $mainqry = $mainqry.$orderby;
                // echo $fnlqry; exit;
                
                $coiData = $this->coicommon->fetchCoiMgrData($getuserid,$user_group_id,$managertype,$fnlqry);
                $allrows = $this->coicommon->fetchCoiMgrData($getuserid,$user_group_id,$managertype,$mainqry);
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
                    $data  = array('logged' => true, 'data' => $coiData,'managertype'=>$managertype,"pgnhtml"=>$pgnhtml); 
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

    public function exportCoiMgrDataAction()
    {
        $this->view->disable();
        $getuserid = $this->session->loginauthspuserfront['id'];
        $cin = $this->session->memberdoccin;
        $user_group_id = $this->session->loginauthspuserfront['user_group_id'];
        $managertype = $this->session->loginauthspuserfront['managertype'];
        //echo $getuserid.'*'.$cin;exit;

        if($this->request->isPost() == true)
        {
            if($this->request->isAjax() == true)
            {
                $filterstatus = $this->request->getPost('filterstatus','trim');
                $startdate = $this->request->getPost('startdate','trim');
                $enddate = $this->request->getPost('enddate','trim');
                $srchbyusr = $this->request->getPost('srchbyusr','trim');
                $exporttype = $this->request->getPost('exporttype','trim');
                $orderby = ' GROUP BY cd.`id` ORDER BY cd.`id` DESC ';
                //echo $query; exit;

                $mainqry = '';
                if(!empty($filterstatus))
                {
                    if($managertype == 'hr')
                    {
                        $mainqry.= " AND `hrM_processed_status` = '".$filterstatus."'";
                    }
                    else if($managertype == 'dept')
                    {
                        $mainqry.= " AND `deptM_processed_status` = '".$filterstatus."'";
                    }
                }
                if(!empty($startdate) && !empty($enddate))
                {
                    $startdate = date('Y-m-d', strtotime($startdate));
                    $enddate = date('Y-m-d', strtotime($enddate));
                    $mainqry.= " AND STR_TO_DATE(cd.`date_added`,'%Y-%m-%d') BETWEEN STR_TO_DATE('".$startdate."','%Y-%m-%d') AND STR_TO_DATE('".$enddate."','%Y-%m-%d')";
                }
                if(!empty($srchbyusr))
                {
                    $mainqry.= " AND im.`employeecode` LIKE '%".$srchbyusr."%' OR im.`fullname` LIKE '%".$srchbyusr."%' ";
                }
                $fnlqry = $mainqry.$orderby;
                // echo $fnlqry; exit;

                $getres = $this->coicommon->fetchCoiMgrData($getuserid,$user_group_id,$managertype,$fnlqry);
                
                if($exporttype == "pdf")
                {
                   $gethtml = $this->coicommon->fetchCoiMgrHtml($getres,$managertype);
                   $genfile = $this->dompdfgen->getpdf($gethtml,"Coi","Declaration","configCoi");
                }
                else
                {
                    $genfile = $this->phpimportexpogen->fetchCoiMgrExportExcel($getuserid,$user_group_id,$getres,$managertype);
                }
              
                 // print_r($genfile);exit;

                if(!empty($genfile))
                {
                    $data = array("logged" => true,'message' => 'File Generated..!!' , 'genfile'=> $genfile);
                    $this->response->setJsonContent($data);
                }
                else
                {
                    $data = array("logged" => false,'message' => "File Not Generated..!!");
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
                $approvalName = $this->coicommon->getUserName($uid);
                $reqUserId = $this->coicommon->getReqUserId($reqid);          
                $deptdata = $this->coicommon->getDeptaccess($reqUserId);
                
                //------ Start: Approval Mail to requester
                    $reqUserId = $this->coicommon->getReqUserId($reqid);          
                    $requestordata = $this->coicommon->getRequestorData($reqUserId);
                    $this->coicommon->approvalMailToRequestor($reqid,$requestordata['fullname'],$requestordata['deptname'],$requestordata['email']);
                //------ End: Approval Mail to requester
                
                if($managertype == "hr")
                {
                    $deptmgr = $this->coicommon->getHrDeptMgrs($deptdata['deptid'],"","dept");
                    // print_r($deptmgr);die;
                    foreach($deptmgr as $mgr)
                    {
                        $mailsentstatus = $this->coicommon->sendaprvmailtomgr($deptdata['deptname'],$mgr['mgrname'],$mgr['email'],$reqid);
                    }
                    
                    // print_r($mailsentstatus);exit;
                    if($mailsentstatus)
                    {
                        
                         $YORuser = $this->coicommon->checkYORuser($uid);
                         $recipientnames = array("CCO","CS");
                         $recipientemailids = array("kusum@volody.com1","hemang@volody.com1");
                         if($YORuser)
                            {
                             for ($i=0; $i < count($recipientnames); $i++) 
                                { 
                        //-------------- Start: CCO and CS email intimation
                        //------------------- Start: On approval-----------------//
                                    $this->coicommon->sendapprmailtoccoandcs($reqid,$recipientnames[$i],$deptdata['deptname'],$recipientemailids[$i],$approvalName);
                        //------------------- End: On approval -----------------//

                        //---------- Start: On request for approval  --------------//
                                    $this->coicommon->requestapprmailtoccoandcs($reqid,$recipientnames[$i],$deptdata['deptname'],$recipientemailids[$i]);
                        //--------- End: On request for approval -----------------//
                        //-------------- End: CCO and CS email intimation
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
                         $recipientemailids = array("kusum@volody.com1","hemang@volody.com1");
                         if($YORuser)
                            {
                             for ($i=0; $i < count($recipientnames); $i++) 
                                { 
                        //-------------- Start: CCO and CS email intimation
                        //------------------- Start: On approval-----------------//
                                    $this->coicommon->sendapprmailtoccoandcs($reqid,$recipientnames[$i],$deptdata['deptname'],$recipientemailids[$i],$approvalName);
                        //------------------- End: On approval -----------------//
                        //-------------- End: CCO and CS email intimation
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
                $rejectorName = $this->coicommon->getUserName($uid);

                //------ Start: Reject Mail to requester
                    $reqUserId = $this->coicommon->getReqUserId($reqid);          
                    $requestordata = $this->coicommon->getRequestorData($reqUserId);
                    $this->coicommon->rejectMailToRequestor($reqid,$requestordata['fullname'],$requestordata['deptname'],$requestordata['email']);
                //------ End: Reject Mail to requester

                //-------------- Start: On reject: CCO and CS email intimation -------------//
                $reqUserId = $this->coicommon->getReqUserId($reqid);          
                $deptdata = $this->coicommon->getDeptaccess($reqUserId);
                 $YORuser = $this->coicommon->checkYORuser($uid);
                 $recipientnames = array("CCO","CS");
                 $recipientemailids = array("kusum@volody.com1","hemang@volody.com1");
                 if($YORuser)
                    {
                     for ($i=0; $i < count($recipientnames); $i++) 
                        { 
                            $this->coicommon->rejectmailtoccoandcs($reqid,$recipientnames[$i],$deptdata['deptname'],$recipientemailids[$i],$rejectorName);
                        } 
                    }
                //-------------- End: On reject: CCO and CS email intimation -------------//

                if($managertype == "hr")
                {
                    $this->coicommon->updateCOIRequest($reqid,"reject");
                    $this->coicommon->insertCOIAuditTrail($reqid,"reject",$recommendation);
                    $data  = array('logged' => true, 'message' => 'Request Rejected.'); 
                    $this->response->setJsonContent($data);
                }
                else if($managertype == "dept")
                {
                    $this->coicommon->updateCOIRequest($reqid,"reject");
                    $this->coicommon->insertCOIAuditTrail($reqid,"reject",$recommendation);
                    $data  = array('logged' => true, 'message' => 'Request Rejected.'); 
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
                //print_r($this->request->getPost());exit;
                
                $returnBy = $this->coicommon->getUserName($uid);
                //------ Start: Return Mail to requester
                    $reqUserId = $this->coicommon->getReqUserId($reqid);          
                    $requestordata = $this->coicommon->getRequestorData($reqUserId);
                    $this->coicommon->returnMailToRequestor($reqid,$requestordata['fullname'],$requestordata['deptname'],$requestordata['email'],$recommendation);
                //------ End: Return Mail to requester

                //-------------- Start: On return: CCO and CS email intimation -------------//
                $reqUserId = $this->coicommon->getReqUserId($reqid);          
                $deptdata = $this->coicommon->getDeptaccess($reqUserId);
                 $YORuser = $this->coicommon->checkYORuser($uid);
                 $recipientnames = array("CCO","CS");
                 $recipientemailids = array("kusum@volody.com1","hemang@volody.com1");
                 if($YORuser)
                    {
                     for ($i=0; $i < count($recipientnames); $i++) 
                        { 
                            $this->coicommon->returnmailtoccoandcs($reqid,$recipientnames[$i],$deptdata['deptname'],$recipientemailids[$i],$returnBy);
                        } 
                    }
                //-------------- End: On return: CCO and CS email intimation -------------//

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
    
    public function fetchSingleCoiDataAction()
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
                $coieditid = $this->request->getPost('coieditid','trim');
                    
                $coiSingleData = $this->coicommon->fetchSingleCoiData($getuserid,$user_group_id,$coieditid);
                //print_r($coiSingleData);exit;
                
                if(!empty($coiSingleData))
                {
                    $data  = array('logged' => true, 'data' => $coiSingleData); 
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
    
    public function updatecoiAction()
    {
        $this->view->disable();
        $getuserid = $this->session->loginauthspuserfront['id'];
        $cin = $this->session->memberdoccin;
        $user_group_id = $this->session->loginauthspuserfront['user_group_id'];
        if($this->request->isPost() == true)
        {
            if($this->request->isAjax() == true)
            {
                //print_r($this->request->getPost());
                $formsend_status = 0;
                $coipolicy = $this->request->getPost('coipolicy');
                $coicategory = $this->request->getPost('coicategory');
                $catequeid = $this->request->getPost('question');
                $others_des = $this->request->getPost('others_des');
                $coipdfhtml = $this->request->getPost('coipdfhtml');
                $formsendtype = $this->request->getPost('formsendtype');
                $coieditid = $this->request->getPost('coieditid');
                $upattachment = $this->request->getPost('upattachment');
                $attachment = $this->request->getPost('attachment');
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
                        $filelist[$key] = $contract_filepath;
                    }
                    //print_r($filelist);exit;
                    if(!empty($upattachment))
                    {
                        foreach($upattachment as $upkey => $upval)
                        {
                            if(isset($filelist[$upkey]))
                            {
                                $files[$upkey] = $filelist[$upkey];
                            }
                            else if(!empty($upval))
                            {
                                $files[$upkey] = $upval;
                            }
                        }
                    }
                    else
                    {
                        $files = $filelist;
                    }
                    //print_r($files);exit;
                    $attachments = implode(',',$files);
                    //print_r($attachments);exit;
                }
                else
                {
                    if(!empty($upattachment))
                    {
                        $attachments = implode(',',$upattachment);
                    }
                    else
                    {
                        $attachments = '';
                    }
                    
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
                    $getres = $this->coicommon->updatecoi($getuserid,$user_group_id,$coipolicy,$coicategory,$catequeid,$others_des,$attachments,$formsend_status,$pdfpath,$coieditid);
                    if($getres)
                    { 
                        if($formsendtype == 'yes')
                        {
                            $deptdata = $this->coicommon->getDeptaccess($getuserid);
                            $hrmgr = $this->coicommon->getHrDeptMgrs($deptdata['deptid'],"","hr");
                            // print_r($hrmgr);die;
                            foreach($hrmgr as $mgr)
                            {
                                $mailsentstatus = $this->coicommon->sendaprvmailtomgr($deptdata['deptname'],$mgr['mgrname'],$mgr['email'],$coieditid);
                            }
                            
                            if($mailsentstatus)
                            {
                                 //-------------- Start: On request for approval: CCO and CS email intimation -------------//
                                $YORuser = $this->coicommon->checkYORuser($getuserid);
                                $recipientnames = array("CCO","CS");
                                $recipientemailids = array("kusum@volody.com1","hemang@volody.com1");
                                if($YORuser)
                                {
                                    for ($i=0; $i < count($recipientnames); $i++) 
                                    { 
                                        $this->coicommon->requestapprmailtoccoandcs($coieditid,$recipientnames[$i],$deptdata['deptname'],$recipientemailids[$i]);
                                    } 
                                }
                         
                                //-------------- End: On request for approval: CCO and CS email intimation -------------//
                            
                                $this->coicommon->updateCOIRequest($coieditid,"sent");
                                $this->coicommon->insertCOIAuditTrail($coieditid,"sent","");
                            }
                            
                        }
                        $data = array("logged" => true,'message' => 'Record Updated','pdfpath'=>$pdfpath);
                        $this->response->setJsonContent($data);
                    }
                    else
                    {
                        $data = array("logged" => false,'message' => "Record Not Updated..!!",'pdfpath'=>'');
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
    
    public function deletecoireqAction()
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
                $coi_id = $this->request->getPost('coi_id');
                $result = $this->coicommon->deleteCoiData($coi_id);
                // print_r($result);exit;
                if($result)
                {
                    $data  = array('logged' => true, 'message' => 'Record Deleted'); 
                    $this->response->setJsonContent($data);
                }
                else
                {
                    $data  = array('logged' => false, 'message' => 'Record Not Deleted'); 
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


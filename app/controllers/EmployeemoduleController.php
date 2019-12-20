<?php 
class EmployeemoduleController extends ControllerBase
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
        $usergroup = $this->session->loginauthspuserfront['user_group_id'];
        $gmnlog = $this->session->loginauthspuserfront;
        $this->view->userdetails = $this->commonquerycommon->fetchuserinfo($uid,$usergroup);
        $this->view->relatedparty = $this->employeemodulecommon->fetchrelatedparty($uid,$usergroup);
        $this->view->sectype = $this->tradingrequestcommon->securitytype();
        $this->view->transctn = $this->employeemodulecommon->trnsctntypes();
    }
    public function viewpastemployerAction()
    {
        $id = $_GET['personid'];
        $this->view->personid = $id;
    }
    
    public function insmydetailAction()
    {
        $this->view->disable();
        $uid = $this->session->loginauthspuserfront['id'];
        $usergroup = $this->session->loginauthspuserfront['user_group_id'];
        $firstname = $this->session->loginauthspuserfront['firstname'];
        $lastname = $this->session->loginauthspuserfront['lastname'];
        $timeago = time();
        if($this->request->isPost() == true)
        {
            if($this->request->isAjax() == true)
            {
                $date=date('d-m-Y');
                //print_r($this->request->getPost());exit;
                $fname = $this->request->getPost('fname','trim');
                $pan = $this->request->getPost('pan','trim');
                $aadhar = $this->request->getPost('aadhar','trim');
                $dob = $this->request->getPost('dob','trim');
                $sex = $this->request->getPost('sex','trim');
                $address = $this->request->getPost('address','trim');
                $edu = $this->request->getPost('eduqulfcn','trim');
                $institute = $this->request->getPost('institute','trim');
                $mobile=$this->request->getPost('mobno');
                $file   = $this->request->getPost('hldngfile','trim');
               
                if(empty($pan))
                {
                    $data = array("logged" => false,'message' => 'Please Provide Pan Number');
                    $this->response->setJsonContent($data);
                }
                else if(empty($mobile) || $mobile=='')
                {

                   $data = array("logged" => false,'message' => 'Please Enter Mobile Number!!');
                   $this->response->setJsonContent($data); 
                }
                else if(strlen($pan) < 10)
                {
                   $data = array("logged" => false,'message' => 'Your Pan No Should Be 10 Digit!!');
                   $this->response->setJsonContent($data); 
                }
                
                else if(empty($dob)) 
                {
                    $data = array("logged" => false,'message' => 'Please Provide Birth Date');
                    $this->response->setJsonContent($data);
                }
                else if(strtotime($dob)>strtotime($date))
                {
                    $data = array("logged" => false,'message' => 'Birth Date Should Be In Past');
                    $this->response->setJsonContent($data);
                }
                else if(empty($sex))
                {
                    $data = array("logged" => false,'message' => 'Please Provide Gender');
                    $this->response->setJsonContent($data);
                }
                else if(empty($edu))
                {
                    $data = array("logged" => false,'message' => 'Please Provide Educational Qualification');
                    $this->response->setJsonContent($data);
                }
                else if(empty($institute))
                {
                    $data = array("logged" => false,'message' => 'Please Provide Institute From Which Acquired');
                    $this->response->setJsonContent($data);
                }
                else if(empty($address))
                {
                    $data = array("logged" => false,'message' => 'Please Provide address');
                    $this->response->setJsonContent($data);
                }
                else
                {
                    //echo 'in else';exit;
                    if(!empty($_FILES["hldngfile"]))
                    {
                        $userfile_name = $_FILES['hldngfile']['name'];
                        //echo $userfile_name;exit;
                        $userfile_tmp = $_FILES['hldngfile']['tmp_name'];
                        $userfile_size = $_FILES['hldngfile']['size'];
                        $userfile_type = $_FILES['hldngfile']['type'];
                        $filename = basename($_FILES['hldngfile']['name']);
                        //echo $filename;exit;
                        $filenm = explode('.', $filename);
                        $filenms[] = $filenm[0];
                        $file_ext = $this->validationcommon->getfileext($filename);
                        $upload_path = $this->myinfiDir."/";  
                        //echo $upload_path;exit; 
                        $large_imp_name = 'Uploadedby-'.$firstname.'_'.$lastname.'_userid-'.$uid.'_timeago-'.$timeago;
                        $myinfo_filepath = $upload_path.$large_imp_name.".".$file_ext;
                        $uploadedornot = move_uploaded_file($userfile_tmp, $myinfo_filepath);
                        //echo $uploadedornot;exit;                        
                        $filepath = $myinfo_filepath;
                    
                    }
                    else
                    {
                        $filepath='';
                    }
                    $newdob = date("d-m-Y", strtotime($dob));
                    $data=$this->request->getPost();
                    $result = $this->employeemodulecommon->insmydetail($uid,$usergroup,$data,$filepath);
                    //print_r($result);exit;
                    if($result['status']==true)
                    {
                        $data = array("logged" => true,'message' => $result['message']);
                        $this->response->setJsonContent($data);
                    }

                    else
                    {
                        $data = array("logged" => false,'message' =>$result['message']);
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
//-----------------------------------UPDATE USER DETAILS START HERE--------------------------------------
    public function updatemydetailsAction()
    {
        $this->view->disable();
        $uid = $this->session->loginauthspuserfront['id'];
        $usergroup = $this->session->loginauthspuserfront['user_group_id'];
        $firstname = $this->session->loginauthspuserfront['firstname'];
        $lastname = $this->session->loginauthspuserfront['lastname'];
        $timeago = time();
        $date=date('d-m-Y');
        if($this->request->isPost() == true)
        {
            if($this->request->isAjax() == true)
            {     
                $pan=$this->request->getPost('pan','trim');
                $aadhar=$this->request->getPost('aadhar','trim');
                $dob=$this->request->getPost('dob','trim');
                $sex=$this->request->getPost('sex','trim');
                $address=$this->request->getPost('address','trim');
                $edu = $this->request->getPost('eduqulfcn','trim');
                $institute = $this->request->getPost('institute','trim');
                $upmobileno=$this->request->getPost('upmobno');
                $prefilepath = $this->request->getPost('filepath','trim');
                $file   = $this->request->getPost('hldngfile','trim');

                if(empty($pan))
                {
                    $data = array("logged" => false,'message' => 'Please Provide Pan Number');
                    $this->response->setJsonContent($data);
                }
                else if(empty($upmobileno))
                {
                   $data = array("logged" => false,'message' => 'Please Select Mobile Number...!!!');
                   $this->response->setJsonContent($data); 
                }
                else if(strlen($pan) < 10)
                {
                   $data = array("logged" => false,'message' => 'Your Pan No Should Be 10 Digit!!');
                   $this->response->setJsonContent($data); 
                }
                else if(empty($dob)) 
                {
                    $data = array("logged" => false,'message' => 'Please Provide Birth Date');
                    $this->response->setJsonContent($data);
                }
                else if(strtotime($dob)>strtotime($date))
                {
                    $data = array("logged" => false,'message' => 'Birth Date Should Be In Past');
                    $this->response->setJsonContent($data);
                }
                else if(empty($sex))
                {
                    $data = array("logged" => false,'message' => 'Please Provide Gender');
                    $this->response->setJsonContent($data);
                }
                else if(empty($edu))
                {
                    $data = array("logged" => false,'message' => 'Please Provide Educational Qualification');
                    $this->response->setJsonContent($data);
                }
                else if(empty($institute))
                {
                    $data = array("logged" => false,'message' => 'Please Provide Institute From Which Acquired');
                    $this->response->setJsonContent($data);
                }
                else if(empty($address))
                {
                    $data = array("logged" => false,'message' => 'Please Provide address');
                    $this->response->setJsonContent($data);
                }
                else
                {
                    if(!empty($_FILES["hldngfile"]))
                    {
                        $userfile_name = $_FILES['hldngfile']['name'];
                        //echo $userfile_name;exit;
                        $userfile_tmp = $_FILES['hldngfile']['tmp_name'];
                        $userfile_size = $_FILES['hldngfile']['size'];
                        $userfile_type = $_FILES['hldngfile']['type'];
                        $filename = basename($_FILES['hldngfile']['name']);
                        //echo $filename;exit;
                        $filenm = explode('.', $filename);
                        $filenms[] = $filenm[0];
                        $file_ext = $this->validationcommon->getfileext($filename);
                        $upload_path = $this->myinfiDir."/";  
                        //echo $upload_path;exit; 
                        $large_imp_name = 'Uploadedby-'.$firstname.'_'.$lastname.'_userid-'.$uid.'_timeago-'.$timeago;
                        $myinfo_filepath = $upload_path.$large_imp_name.".".$file_ext;
                        $uploadedornot = move_uploaded_file($userfile_tmp, $myinfo_filepath);
                        //echo $uploadedornot;exit;                        
                        $filepath = $myinfo_filepath;
                    }
                    else
                    {
                        $filepath = $prefilepath;
                    }
                    $newdob = date("d-m-Y", strtotime($dob));
                    $data=$this->request->getPost();
                    $reqid=$this->request->getPost('reqid','trim');
                    $result = $this->employeemodulecommon->updatemydetails($uid,$reqid,$usergroup,$data,$filepath);
                    
                    if($result==true)
                    {
                        $data = array("logged" => true,'message' =>"data Updated Successfully");
                        $this->response->setJsonContent($data);
                    }
                    else
                    {
                        $data = array("logged" => false,'message' =>"data Not Updated Successfully");
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
//---------------------------------------------------------------------------------------------------------
//--------------------------------------------------------------------------------------------------------
    public function getmydetailsAction()
    {
        $this->view->disable();
        $uid = $this->session->loginauthspuserfront['id'];
        $usergroup = $this->session->loginauthspuserfront['user_group_id'];
        if($this->request->isPost() == true)
        {
            if($this->request->isAjax() == true)
            {     
                $result = $this->employeemodulecommon->getmydetails($uid,$usergroup);
            
                if(!empty($result))
                {  
                    $data = array("logged" => true,'message' => "Data Fetch Successfully",'data'=>$result);
                    $this->response->setJsonContent($data);
                }
                else
                {
                    $data = array("logged" => false,'message' => "Data Not Fetch Successfully",'data'=>'');
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
    
    public function delmydetailsAction()
    {
        $this->view->disable();
        $uid = $this->session->loginauthspuserfront['id'];
        $usergroup = $this->session->loginauthspuserfront['user_group_id'];
        if($this->request->isPost() == true)
        {
            if($this->request->isAjax() == true)
            {
                $delid=$this->request->getPost('delid','trim');

                $result = $this->employeemodulecommon->delmydetails($uid,$usergroup,$delid);
                if($result==true)
                {
                    $data = array("logged" => true,'message' =>"Data Deleted Successfully");
                    $this->response->setJsonContent($data);
                }
                else
                {
                    $data = array("logged" => false,'message' =>"Data Not Deleted Successfully");
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
    //------------------------------------------store relationship data in db------------------//
    public function relationdataAction()
    {
        $this->view->disable();
        $uid = $this->session->loginauthspuserfront['id'];
        $usergroup = $this->session->loginauthspuserfront['user_group_id'];
        $firstname = $this->session->loginauthspuserfront['firstname'];
        $lastname = $this->session->loginauthspuserfront['lastname'];
        $timeago = time();
        $filepath = '';
        $date=date('d-m-Y');
        if($this->request->isPost() == true)
        {
            if($this->request->isAjax() == true)
            {
                $reldata = $this->request->getPost();
                $fname   = $this->request->getPost('fname','trim');
                $pan   = $this->request->getPost('pan','trim');
                $dob   = $this->request->getPost('dob','trim');
                $relationship   = $this->request->getPost('relationship','trim');
                $sex   = $this->request->getPost('sex','trim');
                $address   = $this->request->getPost('address','trim');
                $file   = $this->request->getPost('file','trim');
                if(empty($fname))
                {
                    $data = array("logged" => false,'message' => 'Please Enter First Name!!');
                    $this->response->setJsonContent($data);
                }
                else if(empty($pan))
                {
                    $data = array("logged" => false,'message' => 'Please Provide Pan Number');
                    $this->response->setJsonContent($data);
                }
                else if(strlen($pan) < 10)
                {
                   $data = array("logged" => false,'message' => 'Your Pan No Should Be 10 Digit!!');
                   $this->response->setJsonContent($data); 
                }
                
                else if(empty($dob)) 
                {
                    $data = array("logged" => false,'message' => 'Please Provide Birth Date');
                    $this->response->setJsonContent($data);
                }
                else if(strtotime($dob)>strtotime($date))
                {
                    $data = array("logged" => false,'message' => 'Birth Date Should Be In Past');
                    $this->response->setJsonContent($data);
                }
                else if(empty($relationship))
                {
                    $data = array("logged" => false,'message' => 'Please Provide Relationship');
                    $this->response->setJsonContent($data);
                }
                else if(empty($sex))
                {
                    $data = array("logged" => false,'message' => 'Please Provide Gender');
                    $this->response->setJsonContent($data);
                }
                else if(empty($address))
                {
                    $data = array("logged" => false,'message' => 'Please Provide address');
                    $this->response->setJsonContent($data);
                }
                else
                {
                    if(!empty($_FILES["file"]))
                    {
                        foreach($_FILES['file']['tmp_name'] as $key => $val )
                        {
                            $userfile_name = $_FILES['file']['name'][$key];
                            //echo $userfile_name;exit;
                            $userfile_tmp = $_FILES['file']['tmp_name'][$key];
                            $userfile_size = $_FILES['file']['size'][$key];
                            $userfile_type = $_FILES['file']['type'][$key];
                            $filename = basename($_FILES['file']['name'][$key]);
                            //echo $filename;exit;
                            $filenm = explode('.', $filename);
                            $filenms[] = $filenm[0];
                            $file_ext = $this->validationcommon->getfileext($filename);
                            $upload_path = $this->myinfiDir."/";  
                            //echo $upload_path;exit; 
                            $large_imp_name = 'Uploadedby-'.$firstname.'_'.$lastname.'_userid-'.$uid.'_timeago-'.$timeago.'_relativeinfo'.$key;
                            $myinfo_filepath = $upload_path.$large_imp_name.".".$file_ext;
                            $uploadedornot = move_uploaded_file($userfile_tmp, $myinfo_filepath);
                            //echo $uploadedornot;exit;                        
                            $filepath = $myinfo_filepath;
                        }
                    }
                    $result = $this->employeemodulecommon->relativeinfo($uid,$usergroup,$reldata,$filepath);
                    if($result['status']==true)
                    {
                        $data = array("logged" => true,'message' =>$result['message']);
                        $this->response->setJsonContent($data);
                    }
                    else
                    {
                        $data = array("logged" => false,'message' =>$result['message']);
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
    //---------------------------------------------------Get Relative Data-------------------------------//
    public function getrelativedataAction()
    {
        $this->view->disable();
        $uid = $this->session->loginauthspuserfront['id'];
        $usergroup = $this->session->loginauthspuserfront['user_group_id'];
        if($this->request->isPost() == true)
        {
            if($this->request->isAjax() == true)
            {
                $result = $this->employeemodulecommon->getrelativedata($uid,$usergroup);
                if(!empty($result))
                {
                    $data = array("logged" => true,'message' =>"DATA FETCH SUCCESSFULLY",'data'=>$result);
                    $this->response->setJsonContent($data);       
                }
                else
                {   
                    $data = array("logged" => false,'message' =>"NO DATA FOUND",'data'=>'');
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
    
    public function reldelinfoAction()
    {
        $this->view->disable();
        $uid = $this->session->loginauthspuserfront['id'];
        $usergroup = $this->session->loginauthspuserfront['user_group_id'];
        if($this->request->isPost() == true)
        {
            if($this->request->isAjax() == true)
            {
                $delid=$this->request->getPost('delid','trim');
                $result = $this->employeemodulecommon->delrelinfo($uid,$usergroup,$delid);

                if($result==true)
                {
                    $data = array("logged" => true,'message' =>"DATA DELETED SUCCESSFULLY..!!!");
                    $this->response->setJsonContent($data);
                }
                else
                {
                    $data = array("logged" => false,'message' =>"DATA NOT DELETED..!!!");
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

    public function deletemfrAction()
    {
        $this->view->disable();
        $uid = $this->session->loginauthspuserfront['id'];
        $usergroup = $this->session->loginauthspuserfront['user_group_id'];
        if($this->request->isPost() == true)
        {
            if($this->request->isAjax() == true)
            {
                $delid=$this->request->getPost('delid','trim');
                $result = $this->employeemodulecommon->deletemfr($uid,$usergroup,$delid);
                if($result==true)
                {
                    $data = array("logged" => true,'message' =>"DATA DELETED SUCCESSFULLY..!!!");
                    $this->response->setJsonContent($data);
                }
                else
                {
                    $data = array("logged" => true,'message' =>"DATA NOT DELETED..!!!");
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
    
    public function getmfrdataAction()
    {
        $this->view->disable();
        $uid = $this->session->loginauthspuserfront['id'];
        $usergroup = $this->session->loginauthspuserfront['user_group_id'];
        if($this->request->isPost() == true)
        {
            if($this->request->isAjax() == true)
            {
                $result = $this->employeemodulecommon->getmfrdata($uid,$usergroup);
                // print_r($result);exit;
                if(!empty($result))
                {
                    $data = array("logged" => true,"data"=>$result,"message" =>"DATA FETCHED SUCCESSFULLY..!!!");
                    $this->response->setJsonContent($data);
                }
                else
                {
                    $data = array("logged" => false,'message' =>"DATA NOT FETCHED..!!!");
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
    
    public function singlerelativeAction()
    {
        $this->view->disable();
        $uid = $this->session->loginauthspuserfront['id'];
        $usergroup = $this->session->loginauthspuserfront['user_group_id'];
        if($this->request->isPost() == true)
        {
            if($this->request->isAjax() == true)
            {
                $releditid=$this->request->getPost('releditid','trim');
                $result = $this->employeemodulecommon->singlerelative($uid,$usergroup,$releditid);
                
                if(!empty($result))
                {
                    $data = array("logged" => true,"data"=>$result,"message" =>"DATA FETCHED SUCCESSFULLY..!!!");
                    $this->response->setJsonContent($data);
                }
                else
                {
                    $data = array("logged" => true,'message' =>"DATA NOT FETCHED..!!!");
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
    
    public function updaterelativesAction()
    {
        $this->view->disable();
        $uid = $this->session->loginauthspuserfront['id'];
        $usergroup = $this->session->loginauthspuserfront['user_group_id'];
        $firstname = $this->session->loginauthspuserfront['firstname'];
        $lastname = $this->session->loginauthspuserfront['lastname'];
        $timeago = time();
        $filepath = '';
        $date=date('d-m-Y');
        if($this->request->isPost() == true)
        {
            if($this->request->isAjax() == true)
            {   
                $data = $this->request->getPost();
                $name = $this->request->getPost('name','trim');
                $pan = $this->request->getPost('pan','trim');
                $aadhar = $this->request->getPost('aadhar','trim');
                $dob = $this->request->getPost('dob','trim');
                $address = $this->request->getPost('address','trim');
                $sex = $this->request->getPost('sex','trim');
                $relationship = $this->request->getPost('relationship','trim');
                $releditid = $this->request->getPost('releditid','trim');
                $prevfilepath = $this->request->getPost('filepath','trim');
                
                if(empty($name))
                { 
                    $data = array("logged" => false,'message' => 'Please Enter Name');
                    $this->response->setJsonContent($data);
                }
                else if(empty($pan))
                {
                    $data = array("logged" => false,'message' => 'Please Provide Pan Number');
                    $this->response->setJsonContent($data);
                }
                else if(strlen($pan) < 10)
                {
                   $data = array("logged" => false,'message' => 'Your Pan No Should Be 10 Digit!!');
                   $this->response->setJsonContent($data); 
                }
                else if(empty($dob)) 
                {
                    $data = array("logged" => false,'message' => 'Please Provide Birth Date');
                    $this->response->setJsonContent($data);
                }
                else if(strtotime($dob)>strtotime($date))
                {
                    $data = array("logged" => false,'message' => 'Birth Date Should Be In Past');
                    $this->response->setJsonContent($data);
                }
                else if(empty($sex))
                {
                    $data = array("logged" => false,'message' => 'Please Select  Gender');
                    $this->response->setJsonContent($data);
                }
                else if(empty($relationship))
                {
                    $data = array("logged" => false,'message' => 'Please Insert Relationnship');
                    $this->response->setJsonContent($data);
                }
                else if(empty($address))
                {
                    $data = array("logged" => false,'message' => 'Please Insert address');
                    $this->response->setJsonContent($data);
                }
               else 
                {
                    if(!empty($_FILES["file"]))
                    {
                            $userfile_name = $_FILES['file']['name'];
                            //echo $userfile_name;exit;
                            $userfile_tmp = $_FILES['file']['tmp_name'];
                            $userfile_size = $_FILES['file']['size'];
                            $userfile_type = $_FILES['file']['type'];
                            $filename = basename($_FILES['file']['name']);
                            //echo $filename;exit;
                            $filenm = explode('.', $filename);
                            $filenms[] = $filenm[0];
                            $file_ext = $this->validationcommon->getfileext($filename);
                            $upload_path = $this->myinfiDir."/";  
                            //echo $upload_path;exit; 
                            $large_imp_name = 'Uploadedby-'.$firstname.'_'.$lastname.'_userid-'.$uid.'_timeago-'.$timeago.'_relativeinfo';
                            $myinfo_filepath = $upload_path.$large_imp_name.".".$file_ext;
                            $uploadedornot = move_uploaded_file($userfile_tmp, $myinfo_filepath);
                            //echo $uploadedornot;exit;                        
                            $filepath = $myinfo_filepath;
                    }
                   else
                   {
                       $filepath = $prevfilepath;
                   }
                    $result = $this->employeemodulecommon->updaterelative($uid,$usergroup,$data,$releditid,$filepath);
                    if($result==true)
                    {
                        $data = array("logged" => true,'message' =>"Updated Successfully");
                        $this->response->setJsonContent($data);
                    }
                    else
                    {
                        $data = array("logged" => false,'message' => "Not Updated Successfully");
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
    
       public function aadharvalidationAction()
       {
            $this->view->disable();
            $uid = $this->session->loginauthspuserfront['id'];
            $usergroup = $this->session->loginauthspuserfront['user_group_id'];
             if($this->request->isPost() == true)
            {
              if($this->request->isAjax() == true)
             {   
              $aadhar=$this->request->getPost('aadharno','trim');
              $result = $this->employeemodulecommon->aadharvalidation($uid,$usergroup,$aadhar);
               if($result==true)
               {
                  $data = array("logged" => true,'message' =>"Aadhar Number Allready Exist");
                  $this->response->setJsonContent($data);
               }
               else
               {
                 $data = array("logged" => false,'message' =>"You Can Insert This Aadhar No");
                 $this->response->setJsonContent($data);
               }
                $this->response->send();
               }
            }
       }
       public function panvalidationAction()
       {
         $this->view->disable();
            $uid = $this->session->loginauthspuserfront['id'];
            $usergroup = $this->session->loginauthspuserfront['user_group_id'];
             if($this->request->isPost() == true)
            {
              if($this->request->isAjax() == true)
              {   
                 $pan=$this->request->getPost('panno','trim');
                 $result = $this->employeemodulecommon->panvalidation($uid,$usergroup,$pan);
                if($result==true)
               {  

                  $data = array("logged" => true,"message:" =>"Pan Number Allready Exist");
                  $this->response->setJsonContent($data);
               }
               else
               {
                 $data = array("logged" => false,"message"=>"You Can Insert This Pan No");
                 $this->response->setJsonContent($data);
               }
                $this->response->send();
                
              }
            }                                     
       }
    
        /******************  insert past employer start *********************/
        public function insertpastempAction()
        {     
            $this->view->disable();
            $getuserid = $this->session->loginauthspuserfront['id'];
            $cin = $this->session->memberdoccin;
            $user_group_id = $this->session->loginauthspuserfront['user_group_id'];
            $timeago = time();
            if($this->request->isPost() == true)
            {
                if($this->request->isAjax() == true)
                {
                    $date=date('d-m-Y');
                    $data=$this->request->getPost();
                    // print_r(sizeof($data));
                   
                    // $empname   = $this->request->getPost('empname','trim');
                    // $designtn   = $this->request->getPost('designtn','trim');
                    // $startdate   = $this->request->getPost('strtdte','trim');
                    // $enddate   = $this->request->getPost('enddte','trim');
                    // if(empty($startdate))
                    // {
                    //     $data = array("logged" => false,'message' => 'Start Date should not empty!!');
                    //     $this->response->setJsonContent($data);
                    // }
                    // else if(strtotime($startdate) > strtotime($date))
                    // {
                    //     $data = array("logged" => false,'message' => 'Start Date should not in future!!');
                    //     $this->response->setJsonContent($data);
                    // }
                    // else if(empty($enddate))
                    // {
                    //     $data = array("logged" => false,'message' => 'End Date should not empty!!');
                    //     $this->response->setJsonContent($data);
                    // }
                    // else if(strtotime($enddate) > strtotime($date))
                    // {
                    //     $data = array("logged" => false,'message' => 'End Date should not in future!!');
                    //     $this->response->setJsonContent($data);
                    // }
                    // else if(strtotime($startdate) > strtotime($enddate))
                    // {
                    //       $data = array("logged" => false,'message' => 'Start Date should be Greater Than End Date!!');
                    //       $this->response->setJsonContent($data);
                    // }
                    // else
                    // {
                    //     $startdate =  date("d-m-Y", strtotime($startdate));
                    //     $enddate =  date("d-m-Y", strtotime($enddate));

                      for($i=0;$i<sizeof($data['myarr']);$i++)
                      {
                         // print_r($data['myarr']);exit;
                          $empname=$data['myarr'][$i]['empname'];
                          $designtn=$data['myarr'][$i]['designtn'];
                          $startdate=$data['myarr'][$i]['strtdte'];
                          $enddate=$data['myarr'][$i]['enddte'];
                         
                           if(empty($startdate))
                            {
                                $data = array("logged" => false,'message' => 'Start Date should not empty!!');
                                $this->response->setJsonContent($data);

                            }
                            else if(strtotime($startdate) > strtotime($date))
                            {
                                $data = array("logged" => false,'message' => 'Start Date should not in future!!');
                                $this->response->setJsonContent($data);
                            }
                            else if(empty($enddate))
                            {
                                $data = array("logged" => false,'message' => 'End Date should not empty!!');
                                $this->response->setJsonContent($data);
                            }
                            else if(strtotime($enddate) > strtotime($date))
                            {
                                $data = array("logged" => false,'message' => 'End Date should not in future!!');
                                $this->response->setJsonContent($data);
                            }
                            else if(strtotime($startdate) > strtotime($enddate))
                            {
                                  $data = array("logged" => false,'message' => 'Start Date should be Greater Than End Date!!');
                                  $this->response->setJsonContent($data);
                            }
                            else
                            {

                                 $startdate =  date("d-m-Y", strtotime($startdate));
                                  $enddate =  date("d-m-Y", strtotime($enddate));
                                $getres = $this->employeemodulecommon->insertpastemp($getuserid,$user_group_id,$empname,$designtn,$startdate,$enddate);
                            }
                         
                       }
                       
                        //print_r($getres);exit;
                        if($getres)
                        {
                            $data = array("logged" => true,'message' => 'Record Added','resdta' => $getres);
                            $this->response->setJsonContent($data);
                        }
                        else
                        {
                            $data = array("logged" => false,'message' => "Record Not Added..!!");
                            $this->response->setJsonContent($data);
                        }  

                    // }

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
        /******************  insert past employer end *********************/
    
        /******************  fetch past employer start *********************/
        public function fetchpastemployerAction()
        {
            $this->view->disable();
            $getuserid = $this->session->loginauthspuserfront['id'];
            $cin = $this->session->memberdoccin;
            $user_group_id = $this->session->loginauthspuserfront['user_group_id'];
            //echo $getuserid.'*'.$cin;exit;

            if($this->request->isPost() == true)
            {
                if($this->request->isAjax() == true)
                {
                   
                    $noofrows=$this->request->getPost('noofrows');
                    $pagenum=$this->request->getPost('pagenum');
                    $mainquery = '';

                    $getres = $this->employeemodulecommon->fetchpastemployer($getuserid,$user_group_id,$mainquery);
                 
                    /* start pagination */
                    // $rsstrt = ($pagenum-1) * $noofrows;
                    // $rslmt =' LIMIT '.$rsstrt.','.$noofrows;
                    // $rscnt=count($getres);
                    // $rspgs = ceil($rscnt/$noofrows);
                    // $pgndata = $this->elements->paginatndata($pagenum,$rspgs);
                    // $pgnhtml = $this->elements->paginationhtml($pagenum,$pgndata['start_loop'],$pgndata['end_loop'],$rspgs);
                    // // print_r($rslmt);exit;
                    // $getresult = $this->employeemodulecommon->fetchpastemployer($getuserid,$user_group_id,$rslmt);
                    //print_r($getresult);exit;
                    if($getres)
                    {
                        $data = array("logged" => true,'message' => 'Record Added','resdta' => $getres,'user_group_id'=>$user_group_id,'user_id'=>$getuserid,'pgnhtml'=>'');
                        $this->response->setJsonContent($data);
                    }
                    else
                    {
                        $data = array("logged" => false,'message' => "Record Not Added..!!",'pgnhtml'=>'');
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
        /******************  fetch past employer end *********************/
    
        /******************  fetch past employer for edit start *********************/
        public function fetchempeditAction()
        {
            $this->view->disable();
            $getuserid = $this->session->loginauthspuserfront['id'];
            $cin = $this->session->memberdoccin;
            $user_group_id = $this->session->loginauthspuserfront['user_group_id'];
            //echo $getuserid.'*'.$cin;exit;

            if($this->request->isPost() == true)
            {
                if($this->request->isAjax() == true)
                {
                    $id = $this->request->getPost('empid');
                    $getres = $this->employeemodulecommon->fetchempedit($getuserid,$user_group_id,$id);

                    //print_r($getresult);exit;
                    if($getres)
                    {
                        $data = array("logged" => true,'message' => 'Record Added','resdta' => $getres,'user_group_id'=>$user_group_id,'user_id'=>$getuserid);
                        $this->response->setJsonContent($data);
                    }
                    else
                    {
                        $data = array("logged" => false,'message' => "Record Not Added..!!");
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
        /******************  fetch past employer for edit end *********************/
    
         // **************************** past employer update start ***************************
         public function updateempAction()
         {
            $this->view->disable();
            $getuserid = $this->session->loginauthspuserfront['id'];
            $cin = $this->session->memberdoccin;
            $user_group_id = $this->session->loginauthspuserfront['user_group_id'];
            //echo $getuserid.'*'.$cin;exit;
            if($this->request->isPost() == true)
            {
                if($this->request->isAjax() == true)
                {
                    $date=date('d-m-Y');
                    $empname   = $this->request->getPost('empname','trim');
                    $designtn   = $this->request->getPost('designtn','trim');
                    $startdate   = $this->request->getPost('strtdte','trim');
                    $enddate   = $this->request->getPost('enddte','trim');
                    $id   = $this->request->getPost('empid','trim');
                    if(empty($startdate))
                    {
                        $data = array("logged" => false,'message' => 'Start Date should not empty!!');
                        $this->response->setJsonContent($data);
                    }
                    else if(strtotime($startdate) > strtotime($date))
                    {
                        $data = array("logged" => false,'message' => 'Start Date should not in future!!');
                        $this->response->setJsonContent($data);
                    }
                    else if(empty($enddate))
                    {
                        $data = array("logged" => false,'message' => 'End Date should not empty!!');
                        $this->response->setJsonContent($data);
                    }
                    else if(strtotime($enddate) > strtotime($date))
                    {
                        $data = array("logged" => false,'message' => 'End Date should not in future!!');
                        $this->response->setJsonContent($data);
                    }
                    else if(empty($enddate))
                    {
                        $data = array("logged" => false,'message' => 'End Date should not empty!!');
                        $this->response->setJsonContent($data);
                    }
                    else if(strtotime($startdate) > strtotime($enddate))
                    {
                          $data = array("logged" => false,'message' => 'Start Date should be Greater Than End Date!!');
                          $this->response->setJsonContent($data);
                    }
                    else
                    {
                        $getres = $this->employeemodulecommon->updateemp($getuserid,$user_group_id,$empname,$designtn,$startdate,$enddate,$id);

                        //echo "checking form data";print_r($getres); exit;      
                        if($getres)
                        {
                            $data = array("logged" => true,'message' => 'Record Updated','data' => $getres);
                            $this->response->setJsonContent($data);
                        }
                        else
                        {
                            $data = array("logged" => false,'message' => "Record Not Updated..!!");
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
    
        // **************************** past employer update end ***************************
    
     /**************************** delete past employer start *****************************/
     public function deleteempdetailAction()
     {
        $this->view->disable();
        $getuserid = $this->session->loginauthspuserfront['id'];
        $cin = $this->session->memberdoccin;
        $user_group_id = $this->session->loginauthspuserfront['user_group_id'];
        //echo $getuserid.'*'.$cin;exit;

        if($this->request->isPost() == true)
        {
            if($this->request->isAjax() == true)
            {
                $id = $this->request->getPost('id','trim');
                $getres = $this->employeemodulecommon->deleteempdetail($id);
                if($getres)
                {
                    $data = array("logged" => true,'message' => 'Record Deleted');
                    $this->response->setJsonContent($data);
                }
                else
                {
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
    /**************************** delete past employer end *****************************/

    public function savemfrAction()
    {
        $this->view->disable();
        $getuserid = $this->session->loginauthspuserfront['id'];
        $user_group_id = $this->session->loginauthspuserfront['user_group_id'];
        if($this->request->isPost() == true)
        {
            if($this->request->isAjax() == true)
            {
                //print_r($this->request->getPost());exit;
                $mfrname = $this->request->getPost('mfrname','trim');
                $mfrrelation = $this->request->getPost('mfrrelation','trim');
                $address = $this->request->getPost('address','trim');
                $pan = $this->request->getPost('pan','trim');
                
                if($mfrname=='')
                {
                    $data = array("logged" => false,'message' => 'Please Select Name of the Related party');
                    $this->response->setJsonContent($data);
                }
                else if($mfrrelation=='')
                {
                    $data = array("logged" => false,'message' => 'Please Select Nature of Relationship');
                    $this->response->setJsonContent($data);
                }
                else if($pan=='')
                {
                    $data = array("logged" => false,'message' => 'Please Select PAN/Adhar');
                    $this->response->setJsonContent($data);
                }
                else
                {
                    $getres = $this->employeemodulecommon->insertmfrindb($getuserid,$user_group_id,$mfrname,$mfrrelation,$pan,$address);
                    if($getres)
                    {
                        $data = array("logged" => true,'message' => 'Data Inserted Successfully..!!!');
                    }
                    else
                    {
                        $data = array("logged" => false,'message' => 'Data Not Inserted..!!!');
                    }
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

    public function updatemfrAction()
    {
        $this->view->disable();
        $getuserid = $this->session->loginauthspuserfront['id'];
        $user_group_id = $this->session->loginauthspuserfront['user_group_id'];
        if($this->request->isPost() == true)
        {
            if($this->request->isAjax() == true)
            {
                //print_r($this->request->getPost());exit;
                $mfreditid= $this->request->getPost('mfreditid','trim');
                $mfrname = $this->request->getPost('mfrname','trim');
                $mfrrelation = $this->request->getPost('mfrrelation','trim');
                $panup = $this->request->getPost('panup','trim');
                $addressup = $this->request->getPost('addressup','trim');
                if($mfrname=='')
                {
                    $data = array("logged" => false,'message' => 'Please Select Name of the Related party');
                    $this->response->setJsonContent($data);
                }
                else  if($mfrrelation=='')
                {
                    $data = array("logged" => false,'message' => 'Please Select Nature of Relationship');
                    $this->response->setJsonContent($data);
                }
                else  if($panup=='')
                {
                    $data = array("logged" => false,'message' => 'Please Select Pan/Adhar');
                    $this->response->setJsonContent($data);
                }
                else
                {
                    $getres = $this->employeemodulecommon->updatemfrindb($getuserid,$user_group_id,$mfrname,$mfrrelation,$mfreditid,$panup,$addressup);
                    if($getres)
                    {
                        $data = array("logged" => true,'message' => 'Data Updated Successfully..!!!');
                    }
                    else
                    {
                        $data = array("logged" => false,'message' => 'Data Not Updated..!!!');
                    }

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
    
    public function fetchmfrdataeditAction()
    {
        $this->view->disable();
        $uid = $this->session->loginauthspuserfront['id'];
        $usergroup = $this->session->loginauthspuserfront['user_group_id'];
        if($this->request->isPost() == true)
        {
            if($this->request->isAjax() == true)
            {
                $editid = $this->request->getPost('editid','trim');
                $result = $this->employeemodulecommon->fetchmfrdataedit($uid,$usergroup,$editid);
                
                if($result==true)
                {
                    $data = array("logged" => true,'message' =>"Data Fetch..!!!",'data'=>$result);
                    $this->response->setJsonContent($data);
                }
                else
                {
                    $data = array("logged" => true,'message' =>"Data NOT Fetch..!!!");
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
    
    public function cmplistsAction()
    {
        $this->view->disable();
        $getuserid = $this->session->loginauthspuserfront['id'];
        $cin = $this->session->memberdoccin;
        $user_group_id = $this->session->loginauthspuserfront['user_group_id'];
        //echo $getuserid.'*'.$cin;exit;

        if($this->request->isPost() == true)
        {
            if($this->request->isAjax() == true)
            {
                $searchvallist = $this->request->getPost('searchvallist');
                //echo  $searchvallist;exit;
                $searchlist = $this->filter->sanitize($searchvallist, "trim");
                $searchlist = $this->filter->sanitize($searchvallist, "string");
                if(preg_match("/[A-Za-z]+/", $searchlist))
                {
                    $getsearchkywo = $searchlist;
                    $limit = 10;
                    
                    $userlist = array();
                    $complist = array();
                    
                    $complist = $this->employeemodulecommon->cmpdetails($getsearchkywo);  
                    
                    $getcount = count($complist);
                    //echo $getcount; exit;

                    if(!empty($complist))
                    {
                        $data = array("logged" => true,'message' => 'Found!!!' ,'data'=> $complist,'count'=> $getcount);
                        //echo '<pre>'; print_r($data); exit;
                        $this->response->setJsonContent($data);
                    }
                    else
                    {
                        $data = array("logged" => false,'message' => 'No Result Found !!!');
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
    
    public function inserttrdintimtnAction()
    {
        $this->view->disable();
        $getuserid = $this->session->loginauthspuserfront['id'];
        $cin = $this->session->memberdoccin;
        $user_group_id = $this->session->loginauthspuserfront['user_group_id'];
        //echo $getuserid.'*'.$cin;exit;
        if($this->request->isPost() == true)
        {
            if($this->request->isAjax() == true)
            {
                $date=date('d-m-Y');
                //print_r($this->request->getPost());exit;
                $nameofcomp   = $this->request->getPost('compid','trim');
                $relatedparty   = $this->request->getPost('reltedprty','trim');
                $secutype   = $this->request->getPost('secutype','trim');
                $trnscntype   = $this->request->getPost('trnstype','trim');
                $noofshares   = $this->request->getPost('shres','trim');
                $transdate   = $this->request->getPost('transdate','trim');
                //print_r($periodfrom.'  to '.$periodto);exit;
                if(empty($nameofcomp))
                {
                    $data = array("logged" => false,'message' => 'Please select company!!');
                    $this->response->setJsonContent($data);
                }
                else if(empty($relatedparty))
                {
                    $data = array("logged" => false,'message' => 'Please select Related party!!');
                    $this->response->setJsonContent($data);
                }
                else if(empty($secutype))
                {
                    $data = array("logged" => false,'message' => 'Please select Security Type!!');
                    $this->response->setJsonContent($data);
                }
                else if(empty($noofshares))
                {
                    $data = array("logged" => false,'message' => 'Please select No. Of Shares!!');
                    $this->response->setJsonContent($data);
                }
                
                else
                {
                    
                    $getres = $this->employeemodulecommon->inserttrdintimtn($getuserid,$user_group_id,$nameofcomp,$relatedparty,$secutype,$trnscntype,$noofshares,$transdate);

                    if($getres)
                    {
                        $data = array("logged" => true,'message' => 'Record Added','resdta' => $getres);
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
    
    public function fetchtradeeintimtnAction()
    {
        $this->view->disable();
        $uid = $this->session->loginauthspuserfront['id'];
        $usergroup = $this->session->loginauthspuserfront['user_group_id'];
        if($this->request->isPost() == true)
        {
            if($this->request->isAjax() == true)
            {
                $result = $this->employeemodulecommon->fetchtradeeintimtn($uid,$usergroup);
                if($result)
                {
                    $data = array("logged" => true,'message' =>"Data Fetch..!!!",'data'=>$result);
                    $this->response->setJsonContent($data);
                }
                else
                {
                    $data = array("logged" => false,'message' =>"Data NOT Fetch..!!!");
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
    
    public function updatetrdintimtnAction()
    {
        $this->view->disable();
        $getuserid = $this->session->loginauthspuserfront['id'];
        $cin = $this->session->memberdoccin;
        $user_group_id = $this->session->loginauthspuserfront['user_group_id'];
        //echo $getuserid.'*'.$cin;exit;
        if($this->request->isPost() == true)
        {
            if($this->request->isAjax() == true)
            {
                $date=date('d-m-Y');
                $updateid   = $this->request->getPost('trdeditid','trim');
                $nameofcomp   = $this->request->getPost('compid','trim');
                $relatedparty   = $this->request->getPost('reltedprty','trim');
                $secutype   = $this->request->getPost('secutype','trim');
                $trnscntype   = $this->request->getPost('trnstype','trim');
                $noofshares   = $this->request->getPost('shres','trim');
                $transdate   = $this->request->getPost('transdate','trim');
                
                if(empty($nameofcomp))
                {
                    $data = array("logged" => false,'message' => 'Please select company!!');
                    $this->response->setJsonContent($data);
                }
                else if(empty($relatedparty))
                {
                    $data = array("logged" => false,'message' => 'Please select Related party!!');
                    $this->response->setJsonContent($data);
                }
                else if(empty($secutype))
                {
                    $data = array("logged" => false,'message' => 'Please select Security Type!!');
                    $this->response->setJsonContent($data);
                }
                else if(empty($noofshares))
                {
                    $data = array("logged" => false,'message' => 'Please select No. Of Shares!!');
                    $this->response->setJsonContent($data);
                }
                
                else
                {
                    
                    $getres = $this->employeemodulecommon->updatetrdintimtn($getuserid,$user_group_id,$nameofcomp,$relatedparty,$secutype,$trnscntype,$noofshares,$transdate,$updateid);

                    if($getres)
                    {
                        $data = array("logged" => true,'message' => 'Record Updated','resdta' => $getres);
                        $this->response->setJsonContent($data);
                    }
                    else
                    {
                        $data = array("logged" => false,'message' => "Record Not Updated..!!");
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
    
    public function fetchtradeeintimtneditAction()
    {
        $this->view->disable();
        $uid = $this->session->loginauthspuserfront['id'];
        $usergroup = $this->session->loginauthspuserfront['user_group_id'];
        if($this->request->isPost() == true)
        {
            if($this->request->isAjax() == true)
            {
                $editid = $this->request->getPost('editid','trim');
                $result = $this->employeemodulecommon->fetchtradeeintimtnedit($uid,$usergroup,$editid);
                
                if($result==true)
                {
                    $data = array("logged" => true,'message' =>"Data Fetch..!!!",'data'=>$result);
                    $this->response->setJsonContent($data);
                }
                else
                {
                    $data = array("logged" => true,'message' =>"Data NOT Fetch..!!!");
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
    
    public function trdintimtndeleteAction()
    {
        $this->view->disable();
        $uid = $this->session->loginauthspuserfront['id'];
        $usergroup = $this->session->loginauthspuserfront['user_group_id'];
        if($this->request->isPost() == true)
        {
            if($this->request->isAjax() == true)
            {
                $id = $this->request->getPost('id','trim');
                $result = $this->employeemodulecommon->trdintimtndelete($uid,$usergroup,$id);
                
                if($result==true)
                {
                    $data = array("logged" => true,'message' =>"Data Fetch..!!!",'data'=>$result);
                    $this->response->setJsonContent($data);
                }
                else
                {
                    $data = array("logged" => true,'message' =>"Data NOT Fetch..!!!");
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


      public function sendreqAction()
    {
        $this->view->disable();
        $uid = $this->session->loginauthspuserfront['id'];
        $usergroup = $this->session->loginauthspuserfront['user_group_id'];
        $username=$this->session->loginauthspuserfront['username'];
        if($this->request->isPost() == true)
        {
            if($this->request->isAjax() == true)
            {     
               
                $result = $this->employeemodulecommon->sendrequest($uid);
             
                // print_r($mailids);exit;
            
                if($result==true)
                {  
                    $mailids=$this->employeemodulecommon->sendmailforaprovel($uid,$username);
                    $data = array("logged" => true,'message' => "Request Sent Successfully...!!!");
                    $this->response->setJsonContent($data);
                }
                else
                {
                    $data = array("logged" => false,'message' => "Something Went To Wrong..!!!");
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

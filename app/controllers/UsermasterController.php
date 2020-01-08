<?php 
class UsermasterController extends ControllerBase
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
        $mainqry='';
        $this->view->cmplist = $this->companymastercommon->cmpdetails($uid,$usergroup,$mainqry);
        $this->view->deptlist= $this->departmentmastercommon->fetchdept($uid,$usergroup,$mainqry);
    }

   public function userviewAction(){
    
   }

  
    public function insertmasterlistAction()
    {
        $this->view->disable();
        $getuserid = $this->session->loginauthspuserfront['id'];
        $cin = $this->session->memberdoccin;
        $user_group_id = $this->session->loginauthspuserfront['user_group_id'];   
        $todate = date('d-m-Y');
        if($this->request->isPost() == true)
        {
            if($this->request->isAjax() == true)
            {
                $firstname = $this->request->getPost('firstname','trim');
                
                $lastname  = $this->request->getPost('lastname','trim');
                $dpdate=$this->request->getPost('dpdate','trim');

                $firstnamecheck =  $this->elements->allownumalphahyphen($firstname);
                $lastnamecheck  =  $this->elements->allownumalphahyphen($lastname);
                $fullname  = $firstname.' '.$lastname;
                
                $email     = strtolower($this->request->getPost('email','trim'));
                $emailcheck = $this->validationcommon->emailvalidate($email);
                
                $mobile    = $this->request->getPost('mobile','trim');
                $gender    = $this->request->getPost('gender','trim');
                $designation = $this->request->getPost('designation','trim');
                $reminderdays = $this->request->getPost('reminderdays','trim');
                $accrgt = $this->request->getPost('accrgt','trim');
              
                $cmpnyaccessid = $this->request->getPost('cmpaccnme','trim');

                $typeofusr = $this->request->getPost('typeofusr','trim');

                $deptaccessid = $this->request->getPost('deptaccess','trim');
                $approvername=$this->request->getPost('approvernm','trim');
                $employeecode = $this->request->getPost('employeecode','trim');
                 // print_r($approvername);exit;
              
                $dupliempcode = $this->commonquerycommon->checkifduplidata($getuserid,$employeecode,'');          
                if(empty($firstname))
                {
                    $data = array("logged" => false,'message' => 'Please Provide Your First Name');
                    $this->response->setJsonContent($data);
                }
                else if(empty($lastname))
                {
                    $data = array("logged" => false,'message' => 'Please Provide Your Last Name');
                    $this->response->setJsonContent($data);
                }
                else if(empty($employeecode))
                {
                    $data = array("logged" => false,'message' => 'Please Provide Your Employee Code');
                    $this->response->setJsonContent($data);
                }
                else if($dupliempcode)
                {
                    $data = array("logged" => false,'message' => 'Employee Code Already Exist..!!');
                    $this->response->setJsonContent($data);
                }
                else if(empty($dpdate))
                {
                    $data = array("logged" => false,'message' => 'Please Select Date Of Becoming Designated Person ');
                    $this->response->setJsonContent($data);
                }
                else if(strtotime($dpdate) > strtotime($todate))
                {
                    $data = array("logged" => false,'message' => 'Date of becoming DP should be in past');
                    $this->response->setJsonContent($data);
                }
                else if($firstnamecheck==true)
                {
                    $data = array("logged" => false,'message' => 'Your Firstname Contains Special Character');
                    $this->response->setJsonContent($data);
                }
                else if($lastnamecheck==true)
                {
                    $data = array("logged" => false,'message' => 'Your Lastname Contains Special Character');
                    $this->response->setJsonContent($data);
                }
                else if($email==false)
                {
                    $data = array("logged" => false,'message' => 'Your Email is not valid');
                    $this->response->setJsonContent($data);
                }
                else if($emailcheck==false)
                {
                    $data = array("logged" => false,'message' => 'Your Email is not valid','fieldname'=>'emailrrormsg','actualvalue'=>$email);
                    $this->response->setJsonContent($data);
                    $this->response->send();
                }
                else if(empty($gender) || ($gender!=('1' || '2')))
                {
                    $data = array("logged" => false,'message' => 'Not valid Gender');
                    $this->response->setJsonContent($data);
                }
                else if(!isset($cmpnyaccessid))
                {
                    $data = array("logged" => false,'message' => 'Please Select Atleast 1 Company');
                    $this->response->setJsonContent($data);
                }
                else if(!isset($deptaccessid))
                {
                    $data = array("logged" => false,'message' => 'Please Select Atleast 1 Department');
                    $this->response->setJsonContent($data);
                }
                else if(empty($approvername))
                {
                    $data = array("logged" => false,'message' => 'Please Select Approver');
                    $this->response->setJsonContent($data);
                }
                else if($dupliempcode)
                {
                    $data = array("logged" => false,'message' => 'Employee Code Already Exist..!!');
                    $this->response->setJsonContent($data);
                }
                else
                {
                    $deptaccessid = implode(',', $deptaccessid);
                    // $cmpnyaccessid=explode(',', $cmpnyaccessid);
                    if(!empty($accrgt))
                    {   $accrgt = implode(',',$accrgt); }
                    else
                    {   $accrgt = '';   }
                    // print_r($accrgt);exit;
                    
                    $getlength = 10;
                    $passgene = $this->validationcommon->randomcodegen_capsalphanum($getlength);
                    $pwdemail = $passgene;
                    // echo $pwdemail; exit;
                    $saltget  = ($salt = substr(md5(uniqid(rand(), true)), 0, 9));
                    $password = (sha1($salt . sha1($salt . sha1($passgene))));

                    $insertmas['getuserid'] = $getuserid;
                    $insertmas['user_group_id'] = $user_group_id;
                    $insertmas['fullname'] = $fullname;
                    $insertmas['firstname'] = $firstname;
                    $insertmas['lastname'] = $lastname;
                    $insertmas['email'] = $email;
                    $insertmas['mobile'] = $mobile;
                    $insertmas['gender'] = $gender;
                    $insertmas['designation'] = $designation;
                    $insertmas['reminderdays'] = $reminderdays;
                    $insertmas['pwdemail'] = $pwdemail;
                    $insertmas['password'] = $password;
                    $insertmas['saltget'] = $saltget;
                    $insertmas['accrgt'] = $accrgt;
                    $insertmas['typeofusr'] = $typeofusr;
                    $insertmas['deptaccessid'] = $deptaccessid;
                    $insertmas['cmpnyaccessid'] = $cmpnyaccessid;
                    $insertmas['approvername'] = $approvername;
                    $insertmas['dpdate']= $dpdate;
                    $insertmas['employeecode']= $employeecode;
                    //print_r($insertmas);exit;

                    $insermresponse = $this->insidercommon->insertmasterlist($insertmas);     
                    // print_r($insermresponse);exit;                       

                    if($insermresponse['logged']==true)
                    {
                        $data = array("logged" => true,'message' => $insermresponse['message']);
                        $this->response->setJsonContent($data);
                    }
                    else
                    {
                        $data = array("logged" => false,'message' => $insermresponse['message']);
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
    
    
//-------------------------------------------------------------update user masterlist---------------------------------------------//
    public function updatemasterlistidAction()
    {
        $this->view->disable();
        $getuserid = $this->session->loginauthspuserfront['id'];
        $cin = $this->session->memberdoccin;
        $user_group_id = $this->session->loginauthspuserfront['user_group_id'];   
        $todate = date('d-m-Y');
        if($this->request->isPost() == true)
        {
            if($this->request->isAjax() == true)
            {
                $firstname = $this->request->getPost('firstname','trim');
                $mlistid= $this->request->getPost('mlistid','trim');
                $lastname  = $this->request->getPost('lastname','trim');

                $firstnamecheck =  $this->elements->allownumalphahyphen($firstname);
                $lastnamecheck  =  $this->elements->allownumalphahyphen($lastname);
                $fullname  = $firstname.' '.$lastname;
                
                $email     = strtolower($this->request->getPost('email','trim'));
                $emailcheck = $this->validationcommon->emailvalidate($email);
                
                $mobile    = $this->request->getPost('mobile','trim');
                $gender    = $this->request->getPost('gender','trim');
                $designation = $this->request->getPost('designation','trim');
                $reminderdays = $this->request->getPost('reminderdays','trim');
                $accrgt = $this->request->getPost('accrgt','trim');
              
                $cmpnyaccessid = $this->request->getPost('cmpaccnme','trim');
                $masterid=$this->request->getPost('masterid','trim');
                $dpdate=$this->request->getPost('dpdate','trim');
                
                if($masterid==2)
                {
                	$typeofusr=2;
                }
                else
                {
                    $typeofusr = $this->request->getPost('typeofusr','trim');
                }
                //  print_r($typeofusr); exit;

                $deptaccessid = $this->request->getPost('deptaccess','trim');
                $employeecode = $this->request->getPost('empcode','trim');
                $userid = $this->request->getPost('userid','trim');
                $dupliempcode = $this->commonquerycommon->checkifduplidata($getuserid,$employeecode,$userid);
                $approvername=$this->request->getPost('approveid','trim');
              
                if(empty($firstname))
                {
                    $data = array("logged" => false,'message' => 'Please Provide Your First Name');
                    $this->response->setJsonContent($data);
                }
                else if(empty($lastname))
                {
                    $data = array("logged" => false,'message' => 'Please Provide Your Last Name');
                    $this->response->setJsonContent($data);
                }
                 else if(empty($dpdate))
                {
                    $data = array("logged" => false,'message' => 'PleaseSelect Date Of Becoming Designated Person');
                    $this->response->setJsonContent($data);
                }
                else if(strtotime($dpdate) > strtotime($todate))
                {
                    $data = array("logged" => false,'message' => 'Date of becoming DP should be in past');
                    $this->response->setJsonContent($data);
                }
                else if($typeofusr=='')
                {
                    $data = array("logged" => false,'message' => 'Please Select Type Of User');
                    $this->response->setJsonContent($data);
                }
                else if($firstnamecheck==true)
                {
                    $data = array("logged" => false,'message' => 'Your Firstname Contains Special Character');
                    $this->response->setJsonContent($data);
                }
                else if($lastnamecheck==true)
                {
                    $data = array("logged" => false,'message' => 'Your Lastname Contains Special Character');
                    $this->response->setJsonContent($data);
                }
                else if($email==false)
                {
                    $data = array("logged" => false,'message' => 'Your Email is not valid');
                    $this->response->setJsonContent($data);
                }
                else if($emailcheck==false)
                {
                    $data = array("logged" => false,'message' => 'Your Email is not valid','fieldname'=>'emailrrormsg','actualvalue'=>$email);
                    $this->response->setJsonContent($data);
                    $this->response->send();
                }
                else if(!isset($cmpnyaccessid))
                {
                    $data = array("logged" => false,'message' => 'Please Select Atleast 1 Company');
                    $this->response->setJsonContent($data);
                }
                else if(!isset($deptaccessid))
                {
                    $data = array("logged" => false,'message' => 'Please Select Atleast 1 Department');
                    $this->response->setJsonContent($data);
                }
                else if(empty($approvername))
                {
                    $data = array("logged" => false,'message' => 'Please Select Approver');
                    $this->response->setJsonContent($data);
                }
                else if($dupliempcode)
                {
                    $data = array("logged" => false,'message' => 'Employee Code Already Exist..!!');
                    $this->response->setJsonContent($data);
                }
                else
                {
                    $deptaccessid = implode(',', $deptaccessid);
                    $cmpnyaccessid=implode(',', $cmpnyaccessid);
                    
                    if(!empty($accrgt))
                    {   $accrgt = implode(',',$accrgt); }
                    else
                    {   $accrgt = '';   }
                    // print_r($accrgt);exit;
                    
                    $updatemas['getuserid'] = $getuserid;
                    $updatemas['user_group_id'] = $user_group_id;
                    $updatemas['fullname'] = $fullname;
                    $updatemas['firstname'] = $firstname;
                    $updatemas['lastname'] = $lastname;
                    $updatemas['email'] = $email;
                    $updatemas['mobile'] = $mobile;
                    $updatemas['gender'] = $gender;
                    $updatemas['designation'] = $designation;
                    $updatemas['reminderdays'] = $reminderdays;                           
                    $updatemas['accrgt'] = $accrgt;
                    $updatemas['typeofusr'] = $typeofusr;
                    $updatemas['deptaccessid'] = $deptaccessid;
                    $updatemas['cmpnyaccessid'] = $cmpnyaccessid;
                    $updatemas['mlistid'] = $mlistid;
                    $updatemas['approvername'] = $approvername;
                    $updatemas['dpdate']=$dpdate;
                    $updatemas['employeecode']= $employeecode;
                    //print_r($updatemas);exit;

                    $chkresponse = $this->insidercommon->updatemasterlist($updatemas);
                    //echo "<pre>";print_r($response);exit;
                    if($chkresponse==true)
                    {
                        $data = array("logged" => true,'message' => 'Record Updated Successfully');
                        $this->response->setJsonContent($data);
                    }
                    else
                    {
                        $data = array("logged" => false,'message' => 'Record Not Updated');
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

//--------------------------------------------------------------------------------------------------------------------------------//
      //------------------------------------------------Fetch all User List-----------------------------------------------------//



    public function fetchuserAction()
    {
        $this->view->disable();
        $getuserid = $this->session->loginauthspuserfront['id'];
        $usergroup =$this->session->loginauthspuserfront['user_group_id'];
        
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
                
                
                    $rslmt = 'ORDER BY ID DESC LIMIT '.$rsstrt.','.$noofrows;
                    $mainqry='';

                
                    $getdata = $this->commonquerycommon->userdetails($getuserid,$usergroup,$rslmt);
                    $allrows = $this->commonquerycommon->userdetails($getuserid,$usergroup,$mainqry);
                    // print_r($allrows);exit;
                         
                // ------- Pagination Start -------
                    $rscnt = count($allrows);
                    $rspgs = ceil($rscnt/$noofrows);
                    $pgndata = $this->elements->paginatndata($pagenum,$rspgs);
                    $pgnhtml = $this->elements->paginationhtml($pagenum,$pgndata['start_loop'],$pgndata['end_loop'],$rspgs);
                    //echo '<pre>';print_r($pgnhtml);exit;
                // ------- Pagination End -------
                
                    if(!empty($getdata))
                    {
                        $data = array("logged"=>true, "message"=>'Data fetch successfully', "data"=>$getdata, "pgnhtml"=>$pgnhtml);
                        $this->response->setJsonContent($data);

                    }
                    else
                    {
                        $data = array("logged"=>false,"message"=>'something Went to wrong', "data"=>'', "pgnhtml"=>$pgnhtml);
                        $this->response->setJsonContent($data);
                    }
                    $this->response->send();
             }
        }    
  }
  //------------------------------------------delete user-----------------------------------------------------//

  public function deleteuserAction()
  {
         $this->view->disable();
         $getuserid = $this->session->loginauthspuserfront['id'];
         $usergroup =$this->session->loginauthspuserfront['user_group_id'];
         if($this->request->isPost() == true)
        {
            if($this->request->isAjax() == true)
            {
               // print_r("here");
              //----------------pagination start here--------------------------------------------
              $delid=$this->request->getPost();
              $result = $this->commonquerycommon->deleteuser($getuserid,$usergroup,$delid);
               if($result){
                 $data = array("logged"=>true,"message"=>'User Deleted successfully');
                 $this->response->setJsonContent($data);

               }
               else{
                   $data = array("logged"=>false,"message"=>'something Went to wrong',"data"=>'');
                     $this->response->setJsonContent($data);

                 }
                   $this->response->send();
        
             }
        }
    }            
  public function fetchsingleuserAction(){
         $this->view->disable();
         $getuserid = $this->session->loginauthspuserfront['id'];
         $usergroup =$this->session->loginauthspuserfront['user_group_id'];
         if($this->request->isPost() == true)
         {
            if($this->request->isAjax() == true)
            {
               // print_r("here");
              //----------------pagination start here--------------------------------------------
              $id=$this->request->getPost('tempid','trim');
              // print_r($id);exit;
              $result = $this->commonquerycommon->fetchsingleuser($getuserid,$usergroup,$id);
              // print_r($result);
               if($result){
                 $data = array("logged"=>true,"message"=>'User fetch successfully',"data"=>$result);
                 $this->response->setJsonContent($data);

               }
               else{
                   $data = array("logged"=>false,"message"=>'something Went to wrong',"data"=>'');
                     $this->response->setJsonContent($data);

                 }
                   $this->response->send();
        
             }
        }
  }
  public function searchuserAction(){
       $this->view->disable();
         $getuserid = $this->session->loginauthspuserfront['id'];
         $usergroup =$this->session->loginauthspuserfront['user_group_id'];
         if($this->request->isPost() == true)
         {
            if($this->request->isAjax() == true)
            {
               $search=$this->request->getPost('search','trim');
               $result = $this->commonquerycommon->searchuser($getuserid,$usergroup,$search);
               if(!empty($result))
               {
                 $data = array("logged"=>true,"message"=>'User fetch successfully',"data"=>$result);
                 $this->response->setJsonContent($data);
               }
                else{
                   $data = array("logged"=>false,"message"=>'User Not found',"data"=>'');
                     $this->response->setJsonContent($data);

                 }
                   $this->response->send();
              }
          }
  }
}

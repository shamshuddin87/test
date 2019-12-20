<?php

class ForgotpasswordController extends ControllerBase
{
    public function initialize()
    {
		$this->elements->checkalreadyuserloggedin();
        $this->tag->setTitle("Forgot your password don't worry");
        $LoginAuthsAdmin = $this->session->loginauthspuserfront;
        parent::initialize();
        
		
    }

    public function indexAction()
    {
		$getuserid = $this->session->loginauthspuserfront['id'];
		if(!empty($getuserid))
		{
			return $this->response->redirect('profile/yourworld');
		}
    }
	public function changepasswordAction()
    {
        
    }
    public function emailchecAction()
    {
        $this->view->disable();
		if($this->request->isPost() == true) 
        {
            if($this->request->isAjax() == true) 
            {
				$Mail = $this->emailer; 
				$ip = $this->request->getClientAddress();
				$givenemail = $this->request->getPost('youremail');
				$youremail = $this->request->getPost('youremail');
				$youremail = $this->filter->sanitize($youremail, "trim");
				$emailvalidate= $this->validationcommon->emailvalidate($youremail);
				
				$getemailshouldbe = strtolower($this->filter->sanitize($youremail, "trim"));
				
				if($emailvalidate==false)
				{
					$data = array("logged" => false,'message' => 'Not valid email',
					'emailgiven'=>$givenemail,'emailshuldbe'=>$getemailshouldbe);
					$this->response->setJsonContent($data);
				}
				else
				{
					$getresult = $this->querybrucecommon->selectforgotpwduser($getemailshouldbe);
                    
					if($getresult['status']!=false)
					{
						$code = $this->validationcommon->randomcodegen_capsalphanum(7);
                        //echo $code;exit;
						$updatecode = $this->querybrucecommon->passwordresetcodeupdate($getresult['user_id'],$code);
                        //echo '<pre>';print_r($updatecode);exit;
						if($updatecode['status']==true)
						{
/*--------------------------- Emailer Send -------------------------------------------------*/	
					
$getbody = $this->elements->gethtmlforgotpassword($getresult['username'],$code);
$emailsent = '';
//echo $getemailshouldbe." ".$getresult['username']." ".$code." ".$getresult['user_id']; exit;
                            $getopt = $Mail->sendmailchpwd($getemailshouldbe,$getresult['username'],'You just requested for new password.',$getbody);
if($getopt) 
{$emailsent='1';}else{$emailsent='0';}	
$timeago = time();
                            
$this->querybrucecommon->updateemailpwd($getresult['user_id'],$emailsent,$code);	
/*--------------------------- Emailer Send /-------------------------------------------------*/		
				
							
							
							$data = array("logged" => true,'message' => 'Your Email Id was registered',
							'username'=>$getresult['username'],'email'=> trim($getresult['email']),'userid'=> trim($getresult['user_id']));
						}
						else
						{
							$data = array("logged" => false,'message' => 'Please try it later. We are upgrading something for you.',
							'emailgiven'=>$givenemail,'emailshuldbe'=>$getemailshouldbe);
						}
					}
					else
					{
						if($getresult['type']=='noresultfound')
						{
							$data = array("logged" => false,'message' => 'Your account does not exist with us.',
							'emailgiven'=>$givenemail,'emailshuldbe'=>$getemailshouldbe);
						}
						else
						{
							$data = array("logged" => false,'message' => 'Please try it later. We are upgrading something for you.',
							'emailgiven'=>$givenemail,'emailshuldbe'=>$getemailshouldbe);
						}
						
					}
					
					$this->response->setJsonContent($data);
				}
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
		}
				
    }
	public function pwdlordvishnuAction()
    {
		$this->view->disable();
		
        if($this->request->isPost() == true) 
        {
            if($this->request->isAjax() == true) 
            {
				$ip = $this->request->getClientAddress();
				$givenemail = $this->request->getPost('emailid');
				$youremail = $this->request->getPost('emailid');
				$youremail = $this->filter->sanitize($youremail, "trim");
				$emailvalidate= $this->validationcommon->emailvalidate($youremail);
				
				$useridget = $this->request->getPost('useridget');
				$useridget = $this->filter->sanitize($useridget, "trim");
				
				
				$getemailshouldbe = strtolower($this->filter->sanitize($youremail, "trim"));
				$useridvalidate = $this->validationcommon->getint($useridget);
				
				$yoursecuritycode = $this->request->getPost('yoursecuritycode');
				$yoursecuritycode = $this->filter->sanitize($yoursecuritycode, "trim");
				
				$newpwd = $this->request->getPost('passwordnew');
				$newpwdcheck =  $this->elements->pwdcharregex($newpwd);
				//echo $newpwdcheck;exit;
				if($emailvalidate==false)
				{
					$data = array("logged" => false,'message' => 'Not valid email ! You are cheating with developer console!',
					'emailshuldbe'=>$getemailshouldbe);
					$this->response->setJsonContent($data);
				}
				else if($useridvalidate==false)
				{
					$data = array("logged" => false,'message' => 'You are cheating with developer console!');
					$this->response->setJsonContent($data);
				}
				else
				{
					if(empty($newpwd))
                    {
                        $data = array("logged" => false,'message' => 'Your password is blank!');
                        $this->response->setJsonContent($data);
                    }
					else if($newpwdcheck==true)
                    {
                        $data = array("logged" => false,'message' => 'Password Contains Special Character. Supports only "@", "Alphabets" and "numbers');
                        $this->response->setJsonContent($data);
                    }
					else
                    {
							//echo $useridget.' '.$youremail.' '.$newpwd; exit;
							
						    $getresult = $this->querybrucecommon->forgotpasswordreset($useridget,$youremail,$newpwd,$yoursecuritycode); 
                        
							$getuserdetails = $this->querybrucecommon->getuserdetails($useridget);
							if($getresult['status']==true)
							{
								$data = array("logged" => true,'message' => 'Your password has been updated',
								'timeago'=>$this->timecommon->timeAgo($getresult['timeago']),'username'=> $getuserdetails['username']);
								$this->response->setJsonContent($data);
							}
							else
							{
								if($getresult['type']=='codenotmatch')
								{
									$data = array("logged" => false,'message' => 'Your code did not matched.','type'=>'codenotmatch');
									$this->response->setJsonContent($data);
								}
								else
								{
									$data = array("logged" => false,'message' => 'Please try it later. We are upgrading something for you.',
									'type'=>'errorgot');
									$this->response->setJsonContent($data);
								}
								
							}
							
							
							
                            
					}
				}
				
				
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
    public function endAction()
    {
        $this->session->remove('loginauths');
        $this->flash->success('Goodbye!');
		return $this->response->redirect('index');
        //return $this->forward('login/logout');
    }
	public function logoutAction()
    {
		$this->session->destroy();
		$this->session->remove('loginauths');
		return $this->response->redirect('index');
	}
}

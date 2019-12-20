<?php 
class ChangepasswordController extends ControllerBase
{
    public function initialize()
    {
        $getlan    = $this->elements->getTranslation();
        $this->tag->setTitle($getlan['websitetitle']);
		$this->elements->checkuserloggedin();
		$getuserid = $this->session->loginauthspuserfront['id'];
        //echo ':frontend user::';print_r($this->session->loginauthsuser);exit;
        parent::initialize();
    }

    public function indexAction()
    {
       
        
    }
    public function passwordchangeAction(){
        //echo 'here'; exit;
         $this->view->disable();
         $getuserid = $this->session->loginauthspuserfront['id'];
        
            if($this->request->isPost() == true)
            {
                //si es una petición ajax
                if($this->request->isAjax() == true)
                {
                    
                    $getval = $this->security->getSessionToken();
                    
                    $newpassword = $this->request->getPost('newpwd','trim');
                    $confirmpwd = $this->request->getPost('renewpwd','trim');
                    $csrf = $this->request->getPost('csrfironmanrajuharry','trim');
                    
                    //echo '<pre>';print_r($this->security);exit;
                    
                   // echo $getval." ---- chtkon - ".$chmn." chtnmkon ---  ".$csrf;exit;

                    
                    if ($getval===$csrf) {
                        if($newpassword=='' || $confirmpwd=='')
                        {
                            $data = array("logged" => false,'message' => 'Password IS BLANK!!!' );
                            $this->response->setJsonContent($data);
                        }
                        else if(strlen($newpassword) < 7 || strlen($confirmpwd) < 7)
                        {
                            $data = array("logged" => false,'message' => 'Password Must be greater than 7 Digit' );
                            $this->response->setJsonContent($data);
                        }
                        else if($newpassword!=$confirmpwd)
                        {
                            $data = array("logged" => false,'message' => 'Password Mis matched!!!' );
                            $this->response->setJsonContent($data);
                        }
                        else
                        {
                            if($getuserid){
                                
                                $salt     = ($salt = substr(md5(uniqid($confirmpwd, true)), 0, 9));
                                $password      = (sha1($salt . sha1($salt . sha1($confirmpwd)))) ;
                                //echo $salt .'<br/>';
                                // echo $password; exit;

                                $ch_pass = $this->changepasswordcommon->pwdchange($salt, $password, $getuserid);
                                
                                if($ch_pass == true){
                                    $data = array("logged" => true,'message' => 'Update Data Successfully!!!' );
                                    $this->response->setJsonContent($data);
                                }
                                else{
                                    $data = array("logged" => false,'message' => 'Not Updated!!!' );
                                    $this->response->setJsonContent($data);
                                }
                            } 
                            else
                            {
                                $data = array("logged" => false,'message' => 'You are not auth user!!!' );
                                $this->response->setJsonContent($data);
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

}

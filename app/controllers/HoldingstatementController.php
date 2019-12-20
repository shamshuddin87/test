<?php 
class HoldingstatementController extends ControllerBase
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
    
    //############### insert holding statement start ###############
    public function insertholdingstatementAction()
    {     
        $this->view->disable();
        $getuserid = $this->session->loginauthspuserfront['id'];
        $cin = $this->session->memberdoccin;
        $user_group_id = $this->session->loginauthspuserfront['user_group_id'];
        $firstname = $this->session->loginauthspuserfront['firstname'];
        $lastname = $this->session->loginauthspuserfront['lastname'];
        $timeago = time();
        if($this->request->isPost() == true)
        {
            if($this->request->isAjax() == true)
            {
                $date=date('d-m-Y');
                //print_r($this->request->getPost());exit;
                $month   = $this->request->getPost('month','trim');
                $year   = $this->request->getPost('year','trim');
                $hldngfile   = $this->request->getPost('hldngfile','trim');
                
                if($hldngfile)
                {
                    $data = array("logged" => false,'message' => 'Please select file!!');
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
                            $upload_path = $this->holdingstatement."/";  
                            //echo $upload_path;exit; 
                            $large_imp_name = 'Uploadedby-'.$firstname.'_'.$lastname.'_userid-'.$getuserid.'_timeago-'.$timeago;
                            $holding_filepath = $upload_path.$large_imp_name.".".$file_ext;
                            $uploadedornot = move_uploaded_file($userfile_tmp, $holding_filepath);
                            //echo $uploadedornot;exit;                        
                            $filepath = $holding_filepath;
                    }
                    //print_r($filepath);exit;
                    $getres = $this->holdingstatementcommon->insertholdingstatement($getuserid,$user_group_id,$month,$year,$filepath);
                    
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
    
    //############### insert holding statement end ###############
    
    //############### fetching holding statement start ###############
    public function fetchholdingstatementAction()
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
                $getres = $this->holdingstatementcommon->fetchholdingstatement($getuserid,$user_group_id);
                //print_r($getres);exit;
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
    
    //############### fetching holding statement end ###############
    
    //############### delete holding statement start ###############
    public function holdingstatementdeleteAction()
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
                $getres = $this->holdingstatementcommon->holdingstatementdelete($id);
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
    
    //############### delete holding statement end ###############
    
}

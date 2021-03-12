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
                    $data  = array('logged' => true, 'data' => ''); 
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
                        $coihtml.= '<input class="coipolicy" type="radio" name="question" id="'.$cateQueData[$i]['idattr'].'" value="'.$cateQueData[$i]['id'].'">
                        <label>'.$cateQueData[$i]['question'].'</label>';
                    }
                    //print_r($coihtml);exit;
                    $data  = array('logged' => true, 'data' => $coihtml);
                    $this->response->setJsonContent($data);
                }
                else
                {
                    $data  = array('logged' => true, 'data' => ''); 
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
                $coipolicy = $this->request->getPost('coipolicy');
                $coicategory = $this->request->getPost('coicategory');
                $catequeid = $this->request->getPost('question');
                
                $getres = $this->coicommon->insertcoi($getuserid,$user_group_id,$coipolicy,$coicategory,$catequeid);
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

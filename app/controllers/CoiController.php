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
    
   
}

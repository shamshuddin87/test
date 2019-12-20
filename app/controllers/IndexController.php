<?php
class IndexController extends ControllerBase
{
    public function initialize()
    {
        $this->tag->setTitle('Welcome to ');
		$this->elements->checkalreadyuserloggedin();
		
        parent::initialize();
    }

    public function indexAction()
    {

		 //echo 'hello';exit;
		
    }

    
		
}

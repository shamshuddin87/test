<?php 
class AdminaccessController extends ControllerBase
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
        $gmnlog = $this->session->loginauthspuserfront;      
    }

     public function updateconnectedperAction()
      {

       if($this->request->isPost() == true)
         {
           if($this->request->isAjax() == true)
          {
             $this->view->disable();
             $getalldata = $this->request->getPost();
             $getalldata['method']="updateupsi";
             $result=$this->adminaccesscommon->updateaaccess($getalldata);
             if(!empty($result))
             {
                 $data = array("logged"=>true,"message"=>'Data Updated successfully');
                 $this->response->setJsonContent($data);

              }
              else
               {
                   $data = array("logged"=>false,"message"=>'something Went to wrong');
                   $this->response->setJsonContent($data);

                }
                  
                   $this->response->send();
              }
           }
        }


       public function restrictedcmpaccessAction()
       {
          if($this->request->isPost() == true)
         {
           if($this->request->isAjax() == true)
          { 
              $this->view->disable();
              $getalldata = $this->request->getPost();
              $getalldata['method']="updaterescmp";
              $result=$this->adminaccesscommon->updateaaccess($getalldata);
            
             if(!empty($result))
             {
                 $data = array("logged"=>true,"message"=>'Data Updated successfully');
                 $this->response->setJsonContent($data);
             }
              else
               {
                   $data = array("logged"=>false,"message"=>'something Went to wrong');
                   $this->response->setJsonContent($data);
               }
                $this->response->send();
            }
          }
        }
   

}

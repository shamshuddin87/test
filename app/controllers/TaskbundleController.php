<?php
class TaskbundleController extends ControllerBase
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
        $getmn = $this->session->orgdtl;

        /*#################### Create Files for Controller ####################*/
        $gtnme = $this->router->getControllerName();
        $this->elements->createfile($gtnme);
        /*#################### Create Files for Controller /-####################*/
        $getmoc = $this->request->getQuery('moc');
        $getleadid = $this->request->getQuery('leadid');
        $uid = $this->session->loginauthspuserfront['id'];
        //echo $getleadid;exit;

        $leadget = $this->taskcommon->getallworkallot($uid,$getleadid,'one');
        $leadget = array_shift($leadget);
        $this->view->leadget = $leadget;
        $this->view->getmoc = trim($getmoc);

        $mnoval = $this->usercommon->getuinfoext($uid);
        $mnoval =  array_shift($mnoval);

        if($mnoval['invprefix']=='' || empty($mnoval['invprefix']))
        {
            $mnoval['invprefix'] = 'V';
        }


        $billnum = $mnoval['invprefix']."-Quick-".$this->validationcommon->randomcodegennum(10)."-".date('Y');
        $billnum = strtoupper($billnum);
        $this->view->cbillnum = trim($billnum);
    }
    
    
    
    
}

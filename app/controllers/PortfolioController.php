<?php 
class PortfolioController extends ControllerBase
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
        $this->view->relativesinfo =$this->employeemodulecommon->getrelativedata($uid,$usergroup);
        
        
        /*################  Phalcon Database name Fetching
        $connection = $this->db->getDescriptor();
        $connection = $connection['dbname'];
        echo '<pre>';print_r($connection);exit; 
        ###########################*/
        
        //$getmn = $this->session->orgdtl;
        //echo '<pre>';print_r($getmn);exit;        
    }
    
    public function storeaccnoAction()
    {
        $this->view->disable();
        $uid = $this->session->loginauthspuserfront['id'];
        $usergroup = $this->session->loginauthspuserfront['user_group_id'];
        if($this->request->isPost() == true)
        {
         if($this->request->isAjax() == true)
         {
             $flag =0;
            $accnodata= $this->request->getPost('accno');
            $clhouse= $this->request->getPost('clhouse');
            for($i=0;$i<sizeof($accnodata);$i++)
            {
               if(strlen($accnodata[$i]['accno'])<16)
               {
                   $data = array("logged" => false,'message' => 'Demat account no. should be 16 characters!!');
                   $this->response->setJsonContent($data);
                   $this->response->send();
                   $flag =0;
                   break;
               }
                else
                {
                    $flag = 1;
                }
            }
            if($flag == 1)
            {
                
             $getresponse = $this->portfoliocommon->storeaccno($uid,$usergroup,$accnodata);
             if($getresponse['status']==true)
                {
                    $data = array("logged" => true,'message' =>$getresponse['msg']);
                    $this->response->setJsonContent($data);
                }
                else{
                    $data = array("logged" => false,'message' => $getresponse['msg']);
                    $this->response->setJsonContent($data);
                }
            }

                $this->response->send();

         }
      }
    }
    public function getaccnoAction(){

        $this->view->disable();
        $uid = $this->session->loginauthspuserfront['id'];
        $usergroup = $this->session->loginauthspuserfront['user_group_id'];
        if($this->request->isPost() == true)
        {
         if($this->request->isAjax() == true)
         {     
            
            $getresponse = $this->portfoliocommon->getaccnoinfo($uid,$usergroup);
             if(!empty($getresponse))
                {
                    $data = array("logged" => true,"message"=>"Data Fetched Successfully","data"=>$getresponse);
                    $this->response->setJsonContent($data);
                }
                else{
                    $data = array("logged" => false,"message" => "Data Not Found","data"=>'');
                    $this->response->setJsonContent($data);
                }

                $this->response->send();
           }
      }

    }
      //############################################DELETE USER ACCOUNT DETAILS########################

      public function deleteaccAction(){
        $this->view->disable();
        $uid = $this->session->loginauthspuserfront['id'];
        $usergroup = $this->session->loginauthspuserfront['user_group_id'];
        if($this->request->isPost() == true)
        {
         if($this->request->isAjax() == true)
         {     
            $delid= $this->request->getPost('delid','trim');
            $getresponse = $this->portfoliocommon->delaccount($uid,$usergroup,$delid);
            if($getresponse==true)
            {
                $data = array("logged" => true,"message"=>"Record Deleted Successfully");
                $this->response->setJsonContent($data);

              }
            else
            {
                $data = array("logged" => true,"message"=>"Record Not Deleted Successfully");
                $this->response->setJsonContent($data);
            }
            $this->response->send();
          }
        }
    }
    //############################################EDIT ACCOUNT NO START HERE########################

    public function updateaccAction()
    {
        $this->view->disable();
        $uid = $this->session->loginauthspuserfront['id'];
        $usergroup = $this->session->loginauthspuserfront['user_group_id'];
        if($this->request->isPost() == true)
        {
         if($this->request->isAjax() == true)
         {     
            $accno= $this->request->getPost('accno','trim');
            $hc= $this->request->getPost('hc','trim');
            $dp= $this->request->getPost('rp','trim');
            $editid= $this->request->getPost('editid','trim');
            if(strlen($accno)<16)
            {
                $data = array("logged" => false,'message' => 'Demat account no. should be 16 characters!!');
                $this->response->setJsonContent($data);
            }
            else
            {
                $getresponse = $this->portfoliocommon->updateaccount($uid,$usergroup,$accno,$editid,$hc,$dp);
                if($getresponse==true)
                {
                    $data = array("logged" => true,"message"=>"Record Updated Successfully");
                    $this->response->setJsonContent($data);

                  }
                else
                {
                    $data = array("logged" => true,"message"=>"Record Not Updated Successfully");
                    $this->response->setJsonContent($data);
                }
           }
            $this->response->send();
          }
        }
    }

    public function insertrelativeaccAction(){
        $this->view->disable();
        $uid = $this->session->loginauthspuserfront['id'];
        $usergroup = $this->session->loginauthspuserfront['user_group_id'];
        if($this->request->isPost() == true)
        {
         if($this->request->isAjax() == true)
         { 
               $flag = 1;
               $myarr= $this->request->getPost('myarr');
               $relitiveid= $this->request->getPost('relid');
                for($i=0;$i<sizeof($myarr);$i++)
                {
                    if(strlen($myarr[$i]['relativeacc'])<16)
                    {
                        $data = array("logged" => false,'message' => 'Demat account no. should be 16 characters!!');
                        $this->response->setJsonContent($data);
                        $this->response->send();
                        $flag =0;
                        break;
                    }
                    else
                    {
                        $flag = 1;
                    }
                }
             if($flag == 1)
             {
                $getresponse = $this->portfoliocommon->storerelativeacc($uid,$usergroup,$myarr,$relitiveid);
                if($getresponse['status']==true)
                {
                    $data = array("logged" => true,"message"=>$getresponse['msg']);
                    $this->response->setJsonContent($data);
                }
                else
                {
                    $data = array("logged" => true,"message"=>$getresponse['msg']);
                    $this->response->setJsonContent($data);
                } 
             }
             
               
            $this->response->send();
              
          }
        }
      }

    //##################################################GET RELATIVE USER INFO##########################


      public function getreluseraccAction(){

        $this->view->disable();
        $uid = $this->session->loginauthspuserfront['id'];
        $usergroup = $this->session->loginauthspuserfront['user_group_id'];
        if($this->request->isPost() == true)
        {
         if($this->request->isAjax() == true)
         {     
            
            $getresponse = $this->portfoliocommon->getrelinfo($uid,$usergroup);

             if(!empty($getresponse))
                {
                    $data = array("logged" => true,"message"=>"Data Fetched Successfully","data"=>$getresponse);
                    $this->response->setJsonContent($data);
                }
                else{
                    $data = array("logged" => false,"message" => "Data Not Found","data"=>'');
                    $this->response->setJsonContent($data);
                }

                $this->response->send();
           }
        }
     }
      public function reldeleteaccAction(){
        $this->view->disable();
        $uid = $this->session->loginauthspuserfront['id'];
        $usergroup = $this->session->loginauthspuserfront['user_group_id'];
        if($this->request->isPost() == true)
        {
         if($this->request->isAjax() == true)
         {     
            $delid= $this->request->getPost('delid','trim');
            $getresponse = $this->portfoliocommon->reldelaccount($uid,$usergroup,$delid);
            if($getresponse==true)
            {
                $data = array("logged" => true,"message"=>"Record Deleted Successfully");
                $this->response->setJsonContent($data);

              }
            else
            {
                $data = array("logged" => true,"message"=>"Record Not Deleted Successfully");
                $this->response->setJsonContent($data);
            }
            $this->response->send();
          }
        }   
      }

      public function updaterelaccAction(){
        $this->view->disable();
        $uid = $this->session->loginauthspuserfront['id'];
        $usergroup = $this->session->loginauthspuserfront['user_group_id'];
        if($this->request->isPost() == true)
        {
         if($this->request->isAjax() == true)
         {     
            $reledit= $this->request->getPost('reledit','trim');
            $accno= $this->request->getPost('accno','trim');
             $dp= $this->request->getPost('dp','trim');
              $ch= $this->request->getPost('ch','trim');
            if(strlen($accno)<16)
            {
                $data = array("logged" => false,'message' => 'Demat account no. should be 16 characters!!');
                $this->response->setJsonContent($data);
            }
            else
            {
                $getresponse = $this->portfoliocommon->updaterelacc($uid,$usergroup,$reledit,$accno,$dp,$ch);
                if($getresponse==true)
                {
                    $data = array("logged" => true,"message"=>"Record Updated Successfully");
                    $this->response->setJsonContent($data);

                  }
                else
                {
                    $data = array("logged" => true,"message"=>"Record Not Updated Successfully");
                    $this->response->setJsonContent($data);
                }
            }
            $this->response->send();
          }
        }   

      }
   }

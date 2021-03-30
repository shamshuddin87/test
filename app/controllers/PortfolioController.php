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
       // demat Account Detail
      

        $demat = $this->portfoliocommon->getdematsstatus($uid,$usergroup);
        if(!empty($demat))
        {
            $this->view->getdematsstatus=$this->portfoliocommon->getdematsstatus($uid,$usergroup);
        }

        $reldemat = $this->portfoliocommon->getreldematsstatus($uid,$usergroup);
        if(!empty($reldemat))
        {
            $this->view->getreldematsstatus=$this->portfoliocommon->getreldematsstatus($uid,$usergroup);
        }
        //print_r($getdematsstatus);exit;
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
            $self_nation = $this->request->getPost('self_nation');
            //print_r($accnodata);exit;
            //$clhouse= $this->request->getPost('clhouse');

            if($self_nation == 'Indian')
            {
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
            }
            else
            {
                $flag = 1;
            }
            if($flag == 1)
            {
                $isFilled = $this->employeemodulecommon->fetchUserFlow($uid,$usergroup,'userdemat');
                //print_r($isfirst);exit;
                $isNextFilled = $this->employeemodulecommon->fetchUserFlow($uid,$usergroup,'relativedemat');
                //print_r($isDataEmpty);exit;
                $isNextEmpty = $this->employeemodulecommon->checkIfFirstData($uid,$usergroup,'relative_demat_accounts','parent_user_id');
                //print_r($isNextEmpty);exit;
                $getresponse = $this->portfoliocommon->storeaccno($uid,$usergroup,$accnodata);
                if($getresponse['status']==true)
                {
                    if($isFilled == 'no')
                    {
                        $inupuserdetail = $this->employeemodulecommon->inupUserFlow($uid,$usergroup,'userdemat','yes');
                    }
                    $data = array("logged" => true,'message' =>$getresponse['msg'],'isfilled'=>$isFilled,'isnextdatafilled'=>$isNextFilled,'isNextEmpty'=>$isNextEmpty);
                    $this->response->setJsonContent($data);
                }
                else
                {
                    $data = array("logged" => false,'message' => $getresponse['msg'],'isfilled'=>$isFilled,'isnextdatafilled'=>$isNextFilled,'isNextEmpty'=>$isNextEmpty);
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
            $self_nation= $this->request->getPost('self_nation','trim');
            //print_r($self_nation);exit;


            if(strlen($accno)<16 && $self_nation == 'Indian')
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
               $nationality= $this->request->getPost('nationality');

               if($nationality == 'Indian')
               {
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
               }
               else
               {
                 $flag = 1;
               }
                
             if($flag == 1)
             {
                $getresponse = $this->portfoliocommon->storerelativeacc($uid,$usergroup,$myarr,$relitiveid);
                if($getresponse['status']==true)
                {
                    $inupuserdetail = $this->employeemodulecommon->inupUserFlow($uid,$usergroup,'relativedemat','yes');
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
              $rel_nation = $this->request->getPost('rel_nation','trim');

            


            if(strlen($accno)<16 && $rel_nation == 'Indian')
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


      public function zerodemataccAction()
      {
        $this->view->disable();
        $uid = $this->session->loginauthspuserfront['id'];
        $usergroup = $this->session->loginauthspuserfront['user_group_id'];
        if($this->request->isPost() == true)
        {
          if($this->request->isAjax() == true)
          {
                $dematup= $this->request->getPost('dematup','trim');
                // print_r($dematup);exit;
                $isFilled = $this->employeemodulecommon->fetchUserFlow($uid,$usergroup,'userdemat');
                //print_r($isfirst);exit;
                $isNextFilled = $this->employeemodulecommon->fetchUserFlow($uid,$usergroup,'relativedemat');
                //print_r($isDataEmpty);exit;
              
                $getresponse = $this->portfoliocommon->zerodematacc($uid,$usergroup,$dematup);
                if($getresponse['status']==true)
                {
                    if($dematup == 0)
                    {
                        $inupuserdetail = $this->employeemodulecommon->inupUserFlow($uid,$usergroup,'userdemat','yes');
                    }
                    $data = array("logged" => true,"message"=>"Record Saved Successfully",'isfilled'=>$isFilled,'isnextdatafilled'=>$isNextFilled);
                    $this->response->setJsonContent($data);
                }
                else
                {
                    $data = array("logged" => true,"message"=>$getresponse['message'],'isfilled'=>$isFilled,'isnextdatafilled'=>$isNextFilled);
                    $this->response->setJsonContent($data);
                }
                  $this->response->send();
          }
        }
      }

    public function zeroreldemataccAction()
    {
        $this->view->disable();
        $uid = $this->session->loginauthspuserfront['id'];
        $usergroup = $this->session->loginauthspuserfront['user_group_id'];
        if($this->request->isPost() == true)
        {
            if($this->request->isAjax() == true)
            {
                $dematup= $this->request->getPost('dematup','trim');
                // print_r($dematup);exit;
                
              
                $getresponse = $this->portfoliocommon->zeroreldematacc($uid,$usergroup,$dematup);
                if($getresponse['status']==true)
                {
                    $data = array("logged" => true,"message"=>"Record Saved Successfully");
                    $this->response->setJsonContent($data);
                }
                else
                {
                    $data = array("logged" => true,"message"=>$getresponse['message']);
                    $this->response->setJsonContent($data);
                }
                $this->response->send();
            }
        }
    }
}

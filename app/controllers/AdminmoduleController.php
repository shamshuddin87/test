<?php 
class AdminmoduleController extends ControllerBase
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
        
        /*################  Phalcon Database name Fetching
        $connection = $this->db->getDescriptor();
        $connection = $connection['dbname'];
        echo '<pre>';print_r($connection);exit; 
        ###########################*/
        
        //$getmn = $this->session->orgdtl;
        //echo '<pre>';print_r($getmn);exit;        
    }

    public function accesstouserAction()
    {
            $userid=base64_decode($_GET['userid']);
            $this->view->userid=$userid;

            $this->view->getallaccess = $this->adminmodulecommon->gatallaccessdetails($userid);
    }
    public function tradingdaysAction()
    {

    }
     public function autoaproveAction()
     {
        
     }


    public function inserttradingdaysAction()
    {
         $this->view->disable();
         $getuserid = $this->session->loginauthspuserfront['id'];
         $usergroup =$this->session->loginauthspuserfront['user_group_id'];
         if($this->request->isPost() == true)
        {
            if($this->request->isAjax() == true)
            {  
                $mydate=date('d-m-Y');
                $tdays= $this->request->getPost('tdays');
             
                $result = $this->adminmodulecommon->inserttradingdays($getuserid,$tdays,$mydate,$mydate);
                 if($result['status']== true)
                 {
                    $data = array("logged" => true,'message' => $result['msg']);
                    $this->response->setJsonContent($data);
                 }
                 else
                  {
                     $data = array("logged" => false,'message' => $result['msg']);
                     $this->response->setJsonContent($data);
                  }

                     $this->response->send();   

            }

        }

    }

    public function insertapproversharessAction()
    {
         $this->view->disable();
         $getuserid = $this->session->loginauthspuserfront['id'];
         $usergroup =$this->session->loginauthspuserfront['user_group_id'];
         if($this->request->isPost() == true)
        {
            if($this->request->isAjax() == true)
            {  
                $mydate=date('Y-m-d');
                $appshares= $this->request->getPost('tshares');
               
                $result = $this->adminmodulecommon->insertapprovershares($getuserid,$appshares,$mydate);
                 if($result['status']== true)
                 {
                    $data = array("logged" => true,'message' => $result['msg']);
                    $this->response->setJsonContent($data);
                 }
                 else
                  {
                     $data = array("logged" => false,'message' => $result['msg']);
                     $this->response->setJsonContent($data);
                  }

                     $this->response->send();   

            }

        }

    }

    public function fetchtradingdaysAction()
    {
       $this->view->disable();
         $getuserid = $this->session->loginauthspuserfront['id'];
         $usergroup =$this->session->loginauthspuserfront['user_group_id'];
         if($this->request->isPost() == true)
        {
            if($this->request->isAjax() == true)
            {  
                  $result = $this->adminmodulecommon->gettradingdays($getuserid);
                 
                 if(!empty($result))
                 {
                    $data = array("logged" => true,'data' => $result);
                    $this->response->setJsonContent($data);
                 }
                 else
                  {
                     $data = array("logged" => false,'data' =>'');
                     $this->response->setJsonContent($data);
                  }

                     $this->response->send();   
            }

        }
    }

     public function fetchautoapprovesharesAction()
    {
       $this->view->disable();
         $getuserid = $this->session->loginauthspuserfront['id'];
         $usergroup =$this->session->loginauthspuserfront['user_group_id'];
         if($this->request->isPost() == true)
        {
            if($this->request->isAjax() == true)
            {  
                  $result = $this->adminmodulecommon->fetchautoapproveshares($getuserid,$usergroup);
                 
                 if(!empty($result))
                 {
                    $data = array("logged" => true,'data' => $result);
                    $this->response->setJsonContent($data);
                 }
                 else
                  {
                     $data = array("logged" => false,'data' =>'');
                     $this->response->setJsonContent($data);
                  }

                     $this->response->send();   
            }

        }
    }
    public function delautoapprovesharesAction()
    {
       $this->view->disable();
          $getuserid = $this->session->loginauthspuserfront['id'];
          $user_group_id = $this->session->loginauthspuserfront['user_group_id'];
            if($this->request->isPost() == true)
           {
            if($this->request->isAjax() == true)
            {
               $reqid = $this->request->getPost('reqid','trim');
               $res=$this->adminmodulecommon->delautoapproveshares($reqid);
                 // print_r($res);exit;
                 if($res==true)
                {
                  $data = array("logged" => true,"message" =>"Record Deleted Successfully");
                  $this->response->setJsonContent($data);
                 }
                 else
                {
                   $data = array("logged" => false,"message" =>"Data Not Deleted");
                   $this->response->setJsonContent($data);
                }
                 $this->response->send();
            }
        }

    }
    public function deltradingdaysAction()
     {
          $this->view->disable();
          $getuserid = $this->session->loginauthspuserfront['id'];
          $user_group_id = $this->session->loginauthspuserfront['user_group_id'];
            if($this->request->isPost() == true)
           {
            if($this->request->isAjax() == true)
            {
               $reqid = $this->request->getPost('reqid','trim');
               $res=$this->adminmodulecommon->deletetradedays($reqid);
                 // print_r($res);exit;
                 if($res==true)
                {
                  $data = array("logged" => true,"message" =>"Record Deleted Successfully");
                  $this->response->setJsonContent($data);
                 }
                 else
                {
                   $data = array("logged" => false,"message" =>"Data Not Deleted");
                   $this->response->setJsonContent($data);
                }
                 $this->response->send();
            }
        }
     }  
  
  public function updatetradeaysdAction()
  {
         $this->view->disable();
          $getuserid = $this->session->loginauthspuserfront['id'];
          $user_group_id = $this->session->loginauthspuserfront['user_group_id'];
            if($this->request->isPost() == true)
           {
            if($this->request->isAjax() == true)
             {
               $reqid = $this->request->getPost('reqid','trim');
               $mdtdays = $this->request->getPost('mdtdays','trim'); 
                 if($mdtdays=='')
                {
                  $data = array("logged" => false,"message" =>"Please Enter No Of Trading days");
                  $this->response->setJsonContent($data);
                 }
                 else
                {
                   $res=$this->adminmodulecommon->updatetradingdays($reqid,$mdtdays);
                      if($res==true)
                        {
                          $data = array("logged" => true,"message" =>"Data Updated Successfully");
                          $this->response->setJsonContent($data);
                         }
                         else
                        {
                           $data = array("logged" => false,"message" =>"Data Not Updated");
                           $this->response->setJsonContent($data);
                        }
                }
                 $this->response->send();
             }
       }
  
  }


  public function updateautoapprovelAction()
  {
          $this->view->disable();
          $getuserid = $this->session->loginauthspuserfront['id'];
          $user_group_id = $this->session->loginauthspuserfront['user_group_id'];
            if($this->request->isPost() == true)
           {
            if($this->request->isAjax() == true)
             {
               $reqid = $this->request->getPost('reqid','trim');
               $mdadays = $this->request->getPost('mdadays','trim'); 
                 if($mdadays=='')
                {
                  $data = array("logged" => false,"message" =>"Please Enter No Of Shares To Auto Approvel");
                  $this->response->setJsonContent($data);
                 }
                 else
                {
                   $res=$this->adminmodulecommon->updateautoapprovel($reqid,$mdadays);
                      if($res==true)
                        {
                          $data = array("logged" => true,"message" =>"Data Updated Successfully");
                          $this->response->setJsonContent($data);
                         }
                         else
                        {
                           $data = array("logged" => false,"message" =>"Data Not Updated");
                           $this->response->setJsonContent($data);
                        }
                }
                 $this->response->send();
             }
          }
  
       }

   
        public function fetchuserAction(){
           $this->view->disable();
           $getuserid = $this->session->loginauthspuserfront['id'];
           $usergroup =$this->session->loginauthspuserfront['user_group_id'];
             if($this->request->isPost() == true)
             {
                 if($this->request->isAjax() == true)
                {
                 
                  //----------------pagination start here--------------------------------------------
                    $pagedata=$this->request->getPost();
                    // print_r($pagedata);exit;
                 
                    $noofrows = $pagedata['noofrows'];
                    $pagenum = $pagedata['pagenum'];
                    $searchby = $pagedata['searchby'];
                    $rsstrt = ($pagenum-1) * $noofrows;
                    $rslmt = ' AND `fullname` LIKE "%'.$searchby.'%" ORDER BY ID DESC LIMIT '.$rsstrt.','.$noofrows;
                    $mainqry=' AND `fullname` LIKE "%'.$searchby.'%"';

                    $resultcount = $this->adminmodulecommon->userdetails($getuserid,$usergroup,$mainqry);
                   
                    
                    
                    $rscnt=count($resultcount);
                    // $noofrows=10;
                    $rspgs = ceil($rscnt/$noofrows);

                     $pgndata = $this->elements->paginatndata($pagenum,$rspgs);
                    


                     // print_r($pgndata);exit;
                     $pgnhtml = $this->elements->paginationhtml($pagenum,$pgndata['start_loop'],$pgndata['end_loop'],$rspgs);
                    
                     $result = $this->adminmodulecommon->userdetails($getuserid,$usergroup,$rslmt);
               
              
                      if(!empty($result))
                      {
                         $data = array("logged"=>true,"message"=>'Data fetch successfully',"data"=>$result,"pgnhtml"=>$pgnhtml);
                         $this->response->setJsonContent($data);

                       }
                     else
                     {
                         $data = array("logged"=>false,"message"=>'something Went to wrong',"data"=>'');
                          $this->response->setJsonContent($data);

                       }
                  
                     $this->response->send();
               }
          }    
      }


      // public function updateconnectedperAction()
      // {

      //  if($this->request->isPost() == true)
      //    {
      //      if($this->request->isAjax() == true)
      //     {
      //        $this->view->disable();
      //        $getalldata = $this->request->getPost();
      //        $result=$this->adminmodulecommon->updateaaccess($getalldata);
      //        if(!empty($result))
      //        {
      //            $data = array("logged"=>true,"message"=>'Data Updated successfully');
      //            $this->response->setJsonContent($data);

      //         }
      //         else
      //          {
      //              $data = array("logged"=>false,"message"=>'something Went to wrong');
      //              $this->response->setJsonContent($data);

      //           }
                  
      //              $this->response->send();

      //     }
      //   }
      // }

}

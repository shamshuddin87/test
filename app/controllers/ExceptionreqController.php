<?php 
class ExceptionreqController extends ControllerBase
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
         $this->view->demataccno = $this->exceptionreqcommon->getaccdetails($uid,$usergroup);
         $this->view->alldetails = $this->exceptionreqcommon->userdetails($uid,$usergroup);
        $this->view->relativeinfo = $this->exceptionreqcommon->getrelativeinfo($uid,$usergroup);
         $this->view->sectype = $this->exceptionreqcommon->securitytype();
         // print_r($this->view->sectype);exit;
       
    }

    

    public function exception_reqAction(){

    }

    public function excsearchcompanyAction(){
        $this->view->disable();
        $uid = $this->session->loginauthspuserfront['id'];
        $usergroup = $this->session->loginauthspuserfront['user_group_id'];
        if($this->request->isPost() == true)
        {
         if($this->request->isAjax() == true)
         {   

            $search  =$this->request->getPost('search','trim');
            $getresponse = $this->exceptionreqcommon->excgetusercmp($uid,$usergroup,$search);
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

    public function exctradingrequestsAction()
    {
        $this->view->disable();
        $uid = $this->session->loginauthspuserfront['id'];
        $usergroup = $this->session->loginauthspuserfront['user_group_id'];
         $time = time();
        if($this->request->isPost() == true)
        {
         if($this->request->isAjax() == true)
         {   
             $date=date('d-m-Y');
             $alldata= $this->request->getPost();
             $approverid = $this->request->getPost('approverid','trim');
//             $demataccno  = $this->request->getPost('demataccno','trim');
             $sectype = $this->request->getPost('sectype','trim');
             $idofcmp = $this->request->getPost('idofcmp','trim');
             $nameofcmp  = $this->request->getPost('nameofcmp','trim');
             $noofshare = $this->request->getPost('noofshare','trim');
             $typeoftrans  = $this->request->getPost('typeoftrans','trim');
             $typeofrequest=$this->request->getPost('typeofrequest','trim');
             $selrelative=$this->request->getPost('selrelative','trim');
                        // print_r
             //$pricepershare = $this->request->getPost('pricepershare','trim');
             //$totalamt  = $this->request->getPost('totalamt','trim');
             $reqname= $this->request->getPost('reqname','trim');
             //$transdate=$this->request->getPost('transdate','trim');
             $sendreq=$this->request->getPost('sendreq','trim');
             $flag = 1;
               if(empty($approverid))
                {
                    $data = array("logged" => false,'message' => 'You Do Not Have Approvel For Sending Request');
                    $this->response->setJsonContent($data);
                    $this->response->send();
                }
                else if($typeofrequest==2 && empty($selrelative))
                {
                    $data = array("logged" => false,'message' => 'Please Select Atleast One Relative');
                    $this->response->setJsonContent($data);
                    $this->response->send();
                }

                else if(empty($sectype))
                {
                    $data = array("logged" => false,'message' => 'Please Select Security Type');
                    $this->response->setJsonContent($data);
                    $this->response->send();
                }

                else if(empty($idofcmp))
                {
                    $data = array("logged" => false,'message' => 'Please Select Valid Company');
                    $this->response->setJsonContent($data);
                    $this->response->send();
                }
                else if(empty($nameofcmp))
                {
                    $data = array("logged" => false,'message' => 'Name Of Comapny Can Not Be Blank');
                    $this->response->setJsonContent($data);
                    $this->response->send();
                }

                else if(empty($noofshare))
                {
                    $data = array("logged" => false,'message' => 'Please Insert Total No Of Shares');
                    $this->response->setJsonContent($data);
                    $this->response->send();
                }
                else if(empty($typeoftrans))
                {
                    $data = array("logged" => false,'message' => 'Please Select Type Of transaction');
                    $this->response->setJsonContent($data);
                    $this->response->send();
                }
               else
                {
    //                              $flag = 1;  
                }
               if(!empty($sendreq))
                 {
                    $send_status=1;
                    $msg="Record Sent Successfully";
                    $getresult = $this->exceptionreqcommon->getblackoutperiod($uid,$usergroup);
                    for($i=0;$i<sizeof($getresult);$i++)
                    {
                        if(!empty($getresult[$i]))
                        {
                            $dateto = $getresult[$i]['dateto'];
                            if(strtotime($date) > strtotime($dateto))
                            {
                                $flag = 1;
                            }
                            else
                            {
                                $flag = 0;
                                break;
                            }
                        }
                    }
                 }
                 else
                 {
                    $send_status=0;
                    $msg="Record Saved In Draft";
                  }
                    
                    
                        
                    
                 if($flag == 1)
                 {
                     //print_r($data);
                     $result = $this->exceptionreqcommon->exccreaterequest($uid,$usergroup,$alldata,$send_status);

                             if($result==true)
                             {
                                 $data = array("logged" => true,'message' =>$msg);
                                 $this->response->setJsonContent($data);
                             }
                             else{

                                 $data = array("logged" => false,'message' => 'Something Went to Wrong');
                                 $this->response->setJsonContent($data);

                             }
                 }
                 else
                 {
                     $data = array("logged" => false,'message' => 'Black Out Period');
                     $this->response->setJsonContent($data);
                 }
            }
             else
             {
                 exit('No direct script access allowed');
             }
            $this->response->send();
        }
        else
        {
            return $this->response->redirect('errors/show404');
            exit('No direct script access allowed');
        }
    } 
 
    public function tradingrequdateAction()
    {
       $this->view->disable();
       $uid = $this->session->loginauthspuserfront['id'];
       $usergroup = $this->session->loginauthspuserfront['user_group_id'];
       $time = time();
       if($this->request->isPost() == true)
       {
        if($this->request->isAjax() == true)
        {  
                $data= $this->request->getPost();
                //print_r($data);exit;
                $sectype=$this->request->getPost('sectype','trim');
                $idofcmp=$this->request->getPost('idofcmp','trim');
                $typeofrequest=$this->request->getPost('typeofrequest','trim');
                $selrelative=$this->request->getPost('selrelative','trim');
                // print_r($typeofrequest);
                // print_r($selrelative);
                // exit;



                $nameofcmp=$this->request->getPost('nameofcmp','trim');
                //$transdate=$this->request->getPost('transdate','trim');
                $noofshare=$this->request->getPost('noofshare','trim');
                $typeoftrans=$this->request->getPost('typeoftrans','trim');
                //$pricepershare=$this->request->getPost('pricepershare','trim');
                //$totalamt=$this->request->getPost('totalamt','trim');
                $editid=$this->request->getPost('editid','trim');
                 if(empty($typeofrequest))
                {
                    $data = array("logged" => false,'message' => 'Please Type Of  Request');
                    $this->response->setJsonContent($data);
                }
                 else if($typeofrequest==2 && empty($selrelative))
                {
                    $data = array("logged" => false,'message' => 'Please Select Atleast One Relative');
                    $this->response->setJsonContent($data);
                }
               else  if(empty($sectype))
                {
                    $data = array("logged" => false,'message' => 'Please Select Security type');
                    $this->response->setJsonContent($data);
                }

                else if(empty($idofcmp))
                {
                    $data = array("logged" => false,'message' => 'Please Select Valid Company');
                    $this->response->setJsonContent($data);
                }
                else if(empty($nameofcmp))
                {
                    $data = array("logged" => false,'message' => 'Name Of Comapny Can Not Be Blank');
                    $this->response->setJsonContent($data);
                }
    //                        else if(empty($transdate)){
    //                           $data = array("logged" => false,'message' => 'Please Select Transaction Date');
    //                            $this->response->setJsonContent($data);
    //                        }

                else if(empty($noofshare))
                {
                    $data = array("logged" => false,'message' => 'Please Insert Total No Of Shares');
                    $this->response->setJsonContent($data);
                }
                else if(empty($typeoftrans))
                {
                    $data = array("logged" => false,'message' => 'Please Select Type Of transaction');
                    $this->response->setJsonContent($data);
                }

    //                        else if(empty($pricepershare))
    //                        {
    //                            $data = array("logged" => false,'message' => 'Please Total Price Per Share');
    //                            $this->response->setJsonContent($data);
    //                        }
    //                        else if(empty($totalamt))
    //                        {
    //                            $data = array("logged" => false,'message' => 'Please Insert Total Amount');
    //                            $this->response->setJsonContent($data);
    //                        }

                else{

                        $result = $this->exceptionreqcommon->updaterequest($uid,$usergroup,$editid,$data);
                          if($result==true)
                          {
                            $data = array("logged" => true,'message' =>"Record Updated Successfully");
                            $this->response->setJsonContent($data);
                          }
                        else
                        {
                            $data = array("logged" => false,'message' =>"Record Not Updated Successfully");
                            $this->response->setJsonContent($data);

                           }

                   }
                      $this->response->send();
              }
          }
      }

            public function excgettradingrequestAction()
            {
               $this->view->disable();
               $uid = $this->session->loginauthspuserfront['id'];
               $usergroup = $this->session->loginauthspuserfront['user_group_id'];
               $time = time();
               if($this->request->isPost() == true)
               {
                if($this->request->isAjax() == true)
                {   
                    $pagedata=$this->request->getPost();
                    $mainqry=''; 
                    // print_r($pagedata);exit;
           
                    $noofrows=$pagedata['noofrows'];
                    $pagenum=$pagedata['pagenum'];
                    $redirecturl=$pagedata['redirecturl'];
                    // print_r($redirecturl);
                    if($redirecturl==1)
                    {
                        $addquery="AND `send_status`=0";
                        $mainqry="AND `send_status`=0";
                    }
                    else
                    {
                        $addquery="";
                        $mainqry="";
                    }
                    // print_r($addquery);
                    
                       $rsstrt = ($pagenum-1) * $noofrows;
                       $rslmt =$addquery.' LIMIT '.$rsstrt.','.$noofrows;
                     
                       $resultcount = $this->exceptionreqcommon->excgettradingrequest($uid,$usergroup,$mainqry);
                       $rscnt=count($resultcount);
                       $rspgs = ceil($rscnt/$noofrows);
                       $pgndata = $this->elements->paginatndata($pagenum,$rspgs);
                       $pgnhtml = $this->elements->paginationhtml($pagenum,$pgndata['start_loop'],$pgndata['end_loop'],$rspgs);
                       $result = $this->exceptionreqcommon->excgettradingrequest($uid,$usergroup,$rslmt);
             
                       // print_r($rscnt);exit;

                       if(!empty($result))
                         {
                             $data = array("logged" => true,"data"=>$result,"pgnhtml"=>$pgnhtml,"message" =>"Record Fetched Successfully");
                             $this->response->setJsonContent($data);
                         }
                       else
                         {
                             $data = array("logged" => false,"data"=>'',"pgnhtml"=>$pgnhtml,"message" =>"Record Not Found");
                             $this->response->setJsonContent($data);
                          }

                       $this->response->send();

                     }
              

                 }
            }

        public function excesubuserapprovalAction()
        {
            $this->view->disable();
            $uid = $this->session->loginauthspuserfront['id'];
            $usergroup = $this->session->loginauthspuserfront['user_group_id'];
            $time = time();
            if($this->request->isPost() == true)
            {
                if($this->request->isAjax() == true)
                {   
                    $pagedata=$this->request->getPost();
                    // print_r($pagedata);exit;
           
                    $noofrows=$pagedata['noofrows'];
                    $pagenum=$pagedata['pagenum'];
                    $rsstrt = ($pagenum-1) * $noofrows;
                    $rslmt = ' LIMIT '.$rsstrt.','.$noofrows;
                    $mainqry='';  
                    $resultcount = $this->exceptionreqcommon->subuserreqapproval($uid,$usergroup,$mainqry);
                    $rscnt=count($resultcount);
                    $rspgs = ceil($rscnt/$noofrows);
                    $pgndata = $this->elements->paginatndata($pagenum,$rspgs);
                    $pgnhtml = $this->elements->paginationhtml($pagenum,$pgndata['start_loop'],$pgndata['end_loop'],$rspgs);
                    $result = $this->exceptionreqcommon->subuserreqapproval($uid,$usergroup,$rslmt);
                    //print_r($result);exit;

                    if(!empty($result))
                    {
                        $data = array("logged" => true,"data"=>$result,"pgnhtml"=>$pgnhtml,"chkusergroup"=>$usergroup,"message" =>"Record Fetched Successfully");
                        $this->response->setJsonContent($data);
                    }
                    else
                    {
                        $data = array("logged" => false,"data"=>'',"chkusergroup"=>$usergroup,"pgnhtml"=>$pgnhtml,"message" =>"Record Not Found");
                        $this->response->setJsonContent($data);
                    }

                    $this->response->send();

                }
              

            }
        }

        public function deletepersrequestAction()
        {
               $this->view->disable();
               $uid = $this->session->loginauthspuserfront['id'];
               $usergroup = $this->session->loginauthspuserfront['user_group_id'];
               $time = time();
               if($this->request->isPost() == true)
               {
                if($this->request->isAjax() == true)
                {   
                    $delid=$this->request->getPost('delid','trim');  
                    $reqtype = $this->request->getPost('reqtype','trim');  
                    $result = $this->exceptionreqcommon->excdelpersonalreq($uid,$usergroup,$delid,$reqtype);
                       if($result==true)
                         {
                             $data = array("logged" => true,"message" =>"Record Deleted Successfully");
                             $this->response->setJsonContent($data);
                         }
                       else
                         {
                             $data = array("logged" => false,"message" =>"Record Not Deleted Successfully");
                             $this->response->setJsonContent($data);
                          }

                       $this->response->send();

                     }
              

                 }
        }


            public function excgetsinglereqAction()
            {
               $this->view->disable();
               $uid = $this->session->loginauthspuserfront['id'];
               $usergroup = $this->session->loginauthspuserfront['user_group_id'];
               $time = time();
               if($this->request->isPost() == true)
               {
                if($this->request->isAjax() == true)
                {   $editid=$this->request->getPost('editid','trim');  
                    $result = $this->exceptionreqcommon->excgetsinglereq($uid,$usergroup,$editid);
                    // print_r($result);exit;
                       if($result==true)
                         {
                             $data = array("logged" => true,"data"=>$result,"message" =>"Record Fetched Successfully");
                             $this->response->setJsonContent($data);
                         }
                       else
                         {
                             $data = array("logged" => false,"data"=>'',"message" =>"Record Not Fetched Successfully");
                             $this->response->setJsonContent($data);
                          }

                       $this->response->send();

                     }
              

                 }
            }

            public function sendmultiplereqAction()
            {
               $this->view->disable();
               $uid = $this->session->loginauthspuserfront['id'];
               $usergroup = $this->session->loginauthspuserfront['user_group_id'];
               $time = time();
               $date=date('d-m-Y');
               $flag = 1;
               if($this->request->isPost() == true)
               {
                if($this->request->isAjax() == true)
                {  
                    $getresult = $this->exceptionreqcommon->getblackoutperiod($uid,$usergroup);
                    for($i=0;$i<sizeof($getresult);$i++)
                    {
                        if(!empty($getresult[$i]))
                        {
                            $dateto = $getresult[$i]['dateto'];
                            if(strtotime($date) > strtotime($dateto))
                            {
                                $flag = 1;
                            }
                            else
                            {
                                $flag = 0;
                                break;
                            }
                        }
                    }
                    if($flag == 1)
                    {
                        $selctedid=$this->request->getPost('selctedid');
                        $result = $this->exceptionreqcommon->sendmultiplereq($uid,$usergroup,$selctedid);
                        if($result['status']==true)
                        {
                           $data = array("logged" => true,"message" =>$result['message']);
                           $this->response->setJsonContent($data);
                        }
                        else
                        {
                           $data = array("logged" => true,"message" =>$result['message']);
                            $this->response->setJsonContent($data);
                        }
                    }
                    else
                    {
                         $data = array("logged" => false,'message' => 'Black Out Period');
                         $this->response->setJsonContent($data);
                    }
                 }
                else
                {
                    exit('No direct script access allowed');
                }
                $this->response->send();
            }
            else
            {
                return $this->response->redirect('errors/show404');
                exit('No direct script access allowed');
            }
               
        }

               public function exceacceptapprovelAction()
            {
               $this->view->disable();
               $uid = $this->session->loginauthspuserfront['id'];
               $usergroup = $this->session->loginauthspuserfront['user_group_id'];
               $time = time();
               if($this->request->isPost() == true)
               {
                if($this->request->isAjax() == true)
                {
                    //print_r($this->request->getPost());exit;
                    $selctedid = $this->request->getPost('selctedid');  
                    $ckkval2 = $this->request->getPost('ckkval2'); 
                   // print_r($selctedid);exit;
                 
                        $result = $this->exceptionreqcommon->acceptapprovel($uid,$usergroup,$selctedid,$ckkval2);
                        //print_r($result);exit;
                        if($result['status']==true)
                        {
                           $data = array("logged" => true,"message" =>$result['message']);
                           $this->response->setJsonContent($data);
                        }
                        else
                        {
                           $data = array("logged" => true,"message" =>$result['message']);
                            $this->response->setJsonContent($data);
                        }
                    
                        $this->response->send();
                    
                 }
               }
            }
      
           public function uploadtradingfileAction()
           {
               $this->view->disable();
               $uid = $this->session->loginauthspuserfront['id'];
               $usergroup = $this->session->loginauthspuserfront['user_group_id'];
               $time = time();
               if($this->request->isPost() == true)
               {
                  if($this->request->isAjax() == true)
                  {   $data=$this->request->getPost(); 
                      $typeofbutton=$data['uploadtrade'];
                    
                       if($typeofbutton=="Upload")
                       {
                          $exceptinappr=0;
                       }
                       else
                       {
                          $exceptinappr=1;
                       }
                    
                    
                      if(empty($_FILES['fileToUpload']['name']))
                      {
                         $data = array("logged" => false,"message" =>"File Not Uploaded");
                         $this->response->setJsonContent($data);

                      } 
                       else if(empty($data['noofshare']))
                       {
                           $data = array("logged" => false,"message" =>"Please Enter No Of share");
                           $this->response->setJsonContent($data);

                       }
                        else if(empty($data['priceofshare']))
                        {
                            $data = array("logged" => false,"message" =>"Please Enter Price Per Share");
                             $this->response->setJsonContent($data);

                        }
                        else if(empty($data['total']))
                        {
                             $data = array("logged" => false,"message" =>"Please Enter total amount");
                             $this->response->setJsonContent($data); 
                         }
                        else if(empty($data['transdate']))
                        {
                            $data = array("logged" => false,"message" =>"Please Enter transaction date");
                             $this->response->setJsonContent($data); 
                       }
                        else if((strtotime($data['transdate']) > strtotime($data['tradedate'])) && $typeofbutton=="Upload")
                        {
                            $data = array("logged" => false,"message" =>"You have not traded within the trading window. Please take exception approval.");
                            $this->response->setJsonContent($data); 
                        }
                      else if(empty($data['dmatacc']))
                        {
                            $data = array("logged" => false,"message" =>"Please Select DEMAT Account");
                             $this->response->setJsonContent($data); 
                       }

                   
                    else
                    {       $data=$this->request->getPost();
                            $data['exceptinappr']=$exceptinappr;
                           // print_r($data);exit;

                            
                            $reqid=$this->request->getPost('reqid','trim');  
                            $upload_path = $this->cmpmodule."/tradingrequest/";  
                            $target_file =  $upload_path.basename($_FILES["fileToUpload"]["name"]);
                            $file=$_FILES['fileToUpload']['name'];    
                            $result = move_uploaded_file($_FILES['fileToUpload']['tmp_name'],$target_file.$file);
                            // print_r("INSIDE ELSE");exit;
                             if ($result) 
                             {

                                  $resp=$this->exceptionreqcommon->uploadtradingfile($uid,$usergroup,$reqid,$target_file.$file,$data);
                                  // print_r($resp);exit;
                                  if($resp)
                                  {
                                   $data = array("logged" =>true,"message" =>"Data Inserted Successfully");
                                   $this->response->setJsonContent($data);
                                  }
                                  else
                                  {
                                    $data = array("logged" => false,"message" =>"Data Not Inserted");
                                    $this->response->setJsonContent($data);
                                  }

                              }
                          
                       }

                      $this->response->send();
                  }
              }
          }

          public function excerejectapprovelAction()
          {  
              $this->view->disable();
               $uid = $this->session->loginauthspuserfront['id'];
               $usergroup = $this->session->loginauthspuserfront['user_group_id'];
               $time = time();
               if($this->request->isPost() == true)
               {
                  if($this->request->isAjax() == true)
                  {   
                
                    $message=$this->request->getPost('message'); 
                    $rejectid=$this->request->getPost('rejectid');
                    if(!empty($message)){
                      $response=$this->exceptionreqcommon->rejectreq($uid,$usergroup,$rejectid,$message);
                      if($response==true)
                      {
                      $data = array("logged" => true,"message" =>"request Rejected Successfully");
                      $this->response->setJsonContent($data);
                      }
                      else{
                         $data = array("logged" => true,"message" =>"request Not Rejected Successfully");
                         $this->response->setJsonContent($data);
                      }
                    }
                    else{
                       $data = array("logged" => false,"message" =>"Please Enter Your Message..!!!");
                       $this->response->setJsonContent($data);
                    }
                     $this->response->send();

                   }
                }

          }

           public function checktradestatusAction()
           {
              $this->view->disable();
               $uid = $this->session->loginauthspuserfront['id'];
               $usergroup = $this->session->loginauthspuserfront['user_group_id'];
               $time = time();
               if($this->request->isPost() == true)
               {
                  if($this->request->isAjax() == true)
                  {   
                    $reqid=$this->request->getPost('editid','trim');
                    $typeofreq=$this->request->getPost('typeofreq','trim');
                    $response=$this->exceptionreqcommon->checktradestatus($uid,$usergroup,$reqid);  
                    $demataccno = $this->exceptionreqcommon->getuseracc($uid,$usergroup,$reqid,$typeofreq);
                      //print_r($demataccno);exit;
                     if($response['status']==true)
                      {
                           $data = array("logged" => true,"data"=>$response['data'],'dematacc'=>$demataccno,"message" =>"request Rejected Successfully");
                           $this->response->setJsonContent($data);
                      }
                      else{
                         $data = array("logged" => false,"data"=>'','dematacc'=>$demataccno,"message" =>"request Not Rejected Successfully");
                         $this->response->setJsonContent($data);
                      }
                     $this->response->send();
                  }
                }
          }

          public function notdonetradeAction()
          {
              $this->view->disable();
               $uid = $this->session->loginauthspuserfront['id'];
               $usergroup = $this->session->loginauthspuserfront['user_group_id'];
               $time = time();
               if($this->request->isPost() == true)
               {
                  if($this->request->isAjax() == true)
                  {   
                    $reqid=$this->request->getPost('reqid','trim');
                    $response=$this->exceptionreqcommon->notdonetrade($uid,$usergroup,$reqid);  
                     if($response==true)
                      {
                           $data = array("logged" => true,"message" =>"Record Updated Successfully");
                           $this->response->setJsonContent($data);
                      }
                      else{
                         $data = array("logged" => false,"message" =>"request Not Updated Successfully");
                         $this->response->setJsonContent($data);
                      }
                     $this->response->send();
                  }
                }
          }


          public function getsuccesstradeAction()
          {
               $this->view->disable();
               $uid = $this->session->loginauthspuserfront['id'];
               $usergroup = $this->session->loginauthspuserfront['user_group_id'];
               $time = time();
               if($this->request->isPost() == true)
               {
                  if($this->request->isAjax() == true)
                  {   
                      $reqid=$this->request->getPost('reqid','trim');
                   
                      $response=$this->exceptionreqcommon->excsuccessstatus($uid,$usergroup,$reqid);
                      //print_r($response);exit;
                        if(!empty($response))
                      {
                           $data = array("logged" => true,"data"=>$response,"message" =>"Record Fetched Successfully");
                           $this->response->setJsonContent($data);
                      }
                      else{
                         $data = array("logged" => false,"data"=>'',"message" =>"Data Not Found");
                         $this->response->setJsonContent($data);
                      }
                     $this->response->send();

                  }
                }
          }
    
          public function fetchexcereqtrailAction()
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
                        $reqstid = $this->request->getPost('rqstid');
                        $id = $this->request->getPost('trdeid');
                        $getres = $this->exceptionreqcommon->fetchexcereqtrail($getuserid,$user_group_id,$id);
                        $getresult = $this->exceptionreqcommon->fetchconfmtrdeexcetrail($getuserid,$user_group_id,$reqstid);
                        if($getres)
                        {
                            $data = array("logged" => true,'message' => 'Record Fetch','data' => $getres,'persnreq'=>$getresult,'user_group_id'=>$user_group_id,'user_id'=>$getuserid);
                            $this->response->setJsonContent($data);
                        }
                        else
                        {
                            $data = array("logged" => false,'message' => "Record Not Fetch..!!");
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
    
        public function fetchreasonofexeAction()
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
                    $reqstid = $this->request->getPost('reqid');
                    $id = $this->request->getPost('trdeid');
                    $type = $this->request->getPost('type');
                    $getres = $this->exceptionreqcommon->fetchreasonofexe($getuserid,$user_group_id,$reqstid,$id,$type);
                    
                    if($getres)
                    {
                        $data = array("logged" => true,'message' => 'Record Fetch','data' => $getres,'user_group_id'=>$user_group_id,'user_id'=>$getuserid);
                        $this->response->setJsonContent($data);
                    }
                    else
                    {
                        $data = array("logged" => false,'message' => "Record Not Fetch..!!");
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
  }

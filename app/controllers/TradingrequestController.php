<?php 
class TradingrequestController extends ControllerBase
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
         $this->view->demataccno = $this->tradingrequestcommon->getaccdetails($uid,$usergroup);
         $this->view->alldetails = $this->tradingrequestcommon->userdetails($uid,$usergroup);
         $this->view->relativeinfo = $this->tradingrequestcommon->getrelativeinfo($uid,$usergroup);
         $this->view->sectype = $this->tradingrequestcommon->securitytype();
         

         
        
         if(isset($_GET["redirect"]))
         {
           $this->view->$redirecturl= $_GET["redirect"];
         }
         else
         {
            $this->view->$redirecturl='';
         }
         // print_r($this->view->sectype);exit;
       
    }

    public function reqviewAction()
    {
        $uid = $this->session->loginauthspuserfront['id'];
        $usergroup = $this->session->loginauthspuserfront['user_group_id'];
        
        $this->view->status = base64_decode($_GET['status']);
    }

    public function searchcompanyAction()
    {
        $this->view->disable();
        $uid = $this->session->loginauthspuserfront['id'];
        $usergroup = $this->session->loginauthspuserfront['user_group_id'];
        if($this->request->isPost() == true)
        {
            if($this->request->isAjax() == true)
            {   

                $search  =$this->request->getPost('search','trim');
                $getresponse = $this->tradingrequestcommon->getusercmp($uid,$usergroup,$search);
                if(!empty($getresponse))
                {
                    $data = array("logged" => true,"message"=>"Data Fetched Successfully","data"=>$getresponse);
                    $this->response->setJsonContent($data);
                }
                else
                {
                    $data = array("logged" =>false,"message" => "Data Not Found");
                    $this->response->setJsonContent($data);
                }
                $this->response->send();
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
    
    public function checkclosebalvalAction()
    {
        $this->view->disable();
        $uid = $this->session->loginauthspuserfront['id'];
        $usergroup = $this->session->loginauthspuserfront['user_group_id'];
        $time = time();
        
        if($this->request->isPost() == true)
        {
            if($this->request->isAjax() == true)
            { 
                $clsstatus=1;
                $alldata= $this->request->getPost();
                $idofcmp=$this->request->getPost('idofcmps','trim');
                $typeoftrans=$this->request->getPost('typeoftranss','trim');
                $sectype=$this->request->getPost('sectypes','trim');
                $noofshare=$this->request->getPost('noofshares','trim');
                $typeofrequests=$this->request->getPost('typeofrequests');

                 // print_r($typeofrequests);exit;
                if(empty($idofcmp))
                {
                    $data = array("logged" => false,'message' => 'Please Select Company..!!!');
                    $this->response->setJsonContent($data);
                }
                else if(empty($typeoftrans))
                {
                    $data = array("logged" => false,'message' =>"Please Select Type Of Transaction..!!!");
                    $this->response->setJsonContent($data);
                }
                else if(empty($sectype))
                {
                    $data = array("logged" => false,'message' => 'Please Select Security Type..!!!');
                    $this->response->setJsonContent($data);
                }
                else if(empty($noofshare))
                {
                    $data = array("logged" => false,'message' => 'Please Select Number Of Shares...!!!');
                    $this->response->setJsonContent($data);
                }
                else if(empty($typeofrequests))
                {
                    $data = array("logged" => false,'message' => 'Please Select Type Of request...!!!');
                    $this->response->setJsonContent($data);
                }
                else
                {
                    //print_r($typeofrequests);exit;
                    $checkval = $this->tradingrequestcommon->checkvalrequest($uid,$usergroup,$idofcmp,$typeoftrans);
                    //print_r($checkval);exit;    

                    if($typeofrequests==1 && $typeoftrans==2)
                    {
                        $checkopbal = $this->tradingrequestcommon->checkopeningbalance($uid,$usergroup,$idofcmp,$typeoftrans,$sectype,
                        $noofshare); 
                        //echo '<pre>'; print_r($checkopbal); exit;
                        if($checkopbal['status'])
                        { 

                            $clsstatus=1;
                        }
                        else
                        {
                            $clsstatus=0;
                        }
                    }
                    else
                    {
                        $clsstatus=1;
                    }

                    //print_r($clsstatus); exit;
                    if($clsstatus)
                    {
                        
                        $data = array("logged" => true,'message' => "You Can Create Request...!!!",'contratrd'=>$checkval);
                        $this->response->setJsonContent($data);
                    }
                    else
                    {
                        $data = array("logged" => false,'message' => $checkopbal['msg'],'contratrd'=>$checkval);
                        $this->response->setJsonContent($data);
                    }
                    //print_R($data);exit;
                }
                $this->response->send();
            }
        } 
    }



    public function tradingrequestsAction()
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
                $sectype = $this->request->getPost('sectype','trim');
                $idofcmp = $this->request->getPost('idofcmp','trim');
                $nameofcmp  = $this->request->getPost('nameofcmp','trim');
                $noofshare = $this->request->getPost('noofshare','trim');
                $typeoftrans  = $this->request->getPost('typeoftrans','trim');
                //print_r($typeoftrans);exit;
                $typeofrequest=$this->request->getPost('typeofrequest','trim');
                $selrelative=$this->request->getPost('selrelative','trim');

                $reqname= $this->request->getPost('reqname','trim');
                $sendreq=$this->request->getPost('sendreq','trim');
                //print_r($sendreq);exit;
                //$pdfpath = $this->request->getPost('link','trim');

                $approxprice=$this->request->getPost('approxprice','trim');
                $broker=$this->request->getPost('broker','trim');
                $demataccountid=$this->request->getPost('demataccount','trim');
                $place=$this->request->getPost('place','trim');
                $datetrans=$this->request->getPost('datetrans','trim');
                $transaction=$this->request->getPost('transaction','trim');
                $sharestrans=$this->request->getPost('sharestrans','trim');
                if($typeoftrans == 2)
                {
                    $nature = 'Sale';
                    $relativeinfo = $this->tradingrequestcommon->getrelativesingle($selrelative);
                    if(!empty($demataccountid))
                    {
                        $dematinfo = $this->tradingrequestcommon->relativedemat($demataccountid);
                        $dp = $dematinfo['depository_participient'];
                        $dpacc = $dematinfo['accountno'];
                    }
                    else
                    {
                        $dp = ' ';
                        $dpacc = ' ';
                    }
                    
                    $relativename = $relativeinfo['name'];
                }
                else if($typeoftrans == 1)
                {
                    $nature = 'Purchase';
                    $relativename = ' ';
                    //print_r($dematinfo);exit;
                     if(!empty($demataccountid))
                    {
                          $dematinfo = $this->tradingrequestcommon->userdemat($demataccountid);
                          $dp = $dematinfo['depository_participient'];
                          $dpacc = $dematinfo['accountno'];

                    }
                    else
                    {
                        $dp = ' ';
                        $dpacc = ' ';
                    }
                  
                }
                else
                {
                    $nature = ' ';
                    $relativename = ' ';
                    $dematinfo = ' ';
                }
                //print_r($dematinfo);exit;
                
               
                
                $personalinfo = $this->tradingrequestcommon->getpersonalinfo($uid,$usergroup);

                $itmemberinfo = $this->tradingrequestcommon->userdetails($uid,$usergroup);
                
                $datetrans = explode(",", $datetrans);
                $transaction = explode(",", $transaction);
                $sharestrans = explode(",", $sharestrans);
               

               
                //print_r( $datetrans);exit;
                 $pdf_content = $this->htmlelements->formI($personalinfo,$itmemberinfo,$approxprice,$broker,$demataccountid,$place,$datetrans,$transaction,$sharestrans,$nature,$noofshare,$date,$dp,$dpacc,$relativename,$datetrans,$transaction,$sharestrans);
                 print_r($pdf_content);exit;        

                   
               
                //print_r($html);exit;
                

                $pdfpath = $this->dompdfgen->getpdf($pdf_content,'check','Form I','FormI');
                //print_r($pdfpath);exit;



                $checkval = $this->tradingrequestcommon->checkvalrequest($uid,$usergroup,$idofcmp,$typeoftrans);

                $flag = 1;
                
                $checkval = $this->tradingrequestcommon->checkvalrequest($uid,$usergroup,$idofcmp,$typeoftrans);
                $checreq = $this->tradingrequestcommon->checktypeofreq($uid,$usergroup,$alldata);
                $checkdemat = $this->tradingrequestcommon->checkdematacc($uid,$usergroup,$selrelative);
                //print_r($clsstatus);exit;
                
                if(empty($approverid))
                {
                    $data = array("logged" => false,'message' => 'You Do Not Have Approvel  user To Sending Request Please  Contact To Admin User');
                    $this->response->setJsonContent($data);
                    $this->response->send();
                }            
                else if($checreq)
                {
                    $data = array("logged" => false,'message' => 'Date Should Not Less Than Transaction Date Of This Company');
                    $this->response->setJsonContent($data);
                    $this->response->send();
                }
                else if(empty($checkdemat))
                {
                    $data = array("logged" => false,'message' => 'Please Update Your Demat Account Number');
                    $this->response->setJsonContent($data);
                    $this->response->send();
                }
                else if($checkval==1)
                {
                    $data = array("logged" => false,'message' => 'You Are Doing Different Trade Before Six Months Transaction');
                    $this->response->setJsonContent($data);
                    $this->response->send();
                }
//                else if($checkval['status']=='false')
//                {
//                    $data = array("logged" => false,'message' => $checkval['mg']);
//                    $this->response->setJsonContent($data);
//                    $this->response->send();
//                }
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
                    //echo 'in else';exit;
                    if(!empty($sendreq))
                    {
                        $send_status=1;
                        $msg="Record Sent Successfully";
                        $getresult = $this->tradingrequestcommon->getblackoutperiod($uid,$usergroup);
                        $upsitrading = $this->tradingrequestcommon->getupsitradingblock($uid,$usergroup);
                        if(count($upsitrading)>0)
                        {
                            $flag = 0;
                            $data = array("logged" => false,'message' => 'Your trading window has been closed because you have been added to the UPSI recipeint list','type'=>'');
                            $this->response->setJsonContent($data);
                            $this->response->send();
                            exit;
                        }
                        for($i=0;$i<sizeof($getresult);$i++)
                        {
                            if(!empty($getresult[$i]))
                            {
                                $dateto = $getresult[$i]['dateto'];
                                $datefrom = $getresult[$i]['datefrom'];
                                if(strtotime($date) < strtotime($datefrom) || strtotime($date) > strtotime($dateto))
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
                        $result = $this->tradingrequestcommon->createrequest($uid,$usergroup,$alldata,$send_status,$pdfpath);
                        //print_r($result);exit;
                        if($result['status']==true)
                        {
                            $data = array("logged" => true,'message' =>$msg);
                            $this->response->setJsonContent($data);
                        }
                        else
                        {
                            $data = array("logged" => false,'message' =>$result['message']);
                            $this->response->setJsonContent($data);
                        }
                    }
                    else
                    {
                        $data = array("logged" => false,'message' => 'Black Out Period');
                        $this->response->setJsonContent($data);
                    }
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
                $sectype=$this->request->getPost('sectype','trim');
                $idofcmp=$this->request->getPost('idofcmp','trim');
                $typeofrequest=$this->request->getPost('typeofrequest','trim');
                $selrelative=$this->request->getPost('selrelative','trim');
                $nameofcmp=$this->request->getPost('nameofcmp','trim');
                $noofshare=$this->request->getPost('noofshare','trim');
                $typeoftrans=$this->request->getPost('typeoftrans','trim');
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
                else
                {
                    $result = $this->tradingrequestcommon->updaterequest($uid,$usergroup,$editid,$data);
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

    public function gettradingrequestAction()
    {
        $this->view->disable();
        $uid = $this->session->loginauthspuserfront['id'];
        $usergroup = $this->session->loginauthspuserfront['user_group_id'];
        $time = time();
        if($this->request->isPost() == true)
        {
            if($this->request->isAjax() == true)
            {   
                // ------- Pagination Start -------
                    $noofrows = $this->request->getPost('noofrows','trim');
                    $pagenum = $this->request->getPost('pagenum','trim');
                    //echo $pagenum.'*'.$noofrows; exit;
                    $rsstrt = ($pagenum-1) * $noofrows;
                    //echo $rsstrt; exit;
                // ------- Pagination End -------
                
                // ------- FilterValues Start -------  
                    $status = $this->request->getPost('status','trim');
                // ------- FilterValues End -------
                
                
                $redirecturl = $this->request->getPost('redirecturl','trim');
                
                
                // ------------ Queries Start ------------
                    if($redirecturl==1)
                    {
                        $addquery=" AND `send_status`=0";
                    }
                    elseif($status == "drafted")
                    {
                        $addquery="AND `send_status`=0";
                    } 
                    elseif($status == "sent_for_approval")
                    {
                        $addquery="AND `send_status`=1";
                    } 
                    elseif($status == "not_approved")
                    {
                        $addquery="AND `approved_status` IS NULL ";
                    } 
                    elseif($status == "approved")
                    {
                        $addquery="AND `approved_status`=1";
                    } 
                    elseif($status == "rejected")
                    {
                        $addquery="AND `approved_status`=2";
                    }   
                    elseif($status == "trade_pending")
                    {
                        $addquery="AND `trading_status` IS NULL";
                    } 
                    elseif($status == "trade_not_done")
                    {
                        $addquery="AND `trading_status`=0";
                    } 
                    elseif($status == "trade_completed")
                    {
                        $addquery="AND `trading_status`=1";
                    } 
                    else 
                    {
                        $addquery=" ";
                    }
                    // echo $addquery; exit;

                    $rslmt = ' LIMIT '.$rsstrt.','.$noofrows;
                    //echo '<pre>'; print_r($rslmt); exit;
                    $orderby = ' ORDER BY pr.`id` DESC ';
                    //echo $query; exit;

                    $mainqry = $addquery;
                    $fnlqry = $mainqry.$orderby.$rslmt;
                    // echo $fnlqry; exit;
                // ------------ Queries End ------------
                
                
                $getdata = $this->tradingrequestcommon->gettradingrequest($uid,$usergroup,$fnlqry);
                $allrows = $this->tradingrequestcommon->gettradingrequest($uid,$usergroup,$mainqry);
                
                
                // ------- Pagination Start -------
                    $rscnt = count($allrows);
                    $rspgs = ceil($rscnt/$noofrows);
                    $pgndata = $this->elements->paginatndata($pagenum,$rspgs);
                    $pgnhtml = $this->elements->paginationhtml($pagenum,$pgndata['start_loop'],$pgndata['end_loop'],$rspgs);
                    //echo '<pre>';print_r($pgnhtml);exit;
                // ------- Pagination End -------
                
                if(!empty($getdata))
                {
                    $data = array("logged" => true,"data"=>$getdata,"pgnhtml"=>$pgnhtml,"message" =>"Record Fetched Successfully");
                    $this->response->setJsonContent($data);
                }
                else
                {
                    $data = array("logged" => false,"data"=>'',"pgnhtml"=>$pgnhtml,"message" =>"Record Not Found");
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

    public function subuserapprovalAction()
    {
        $this->view->disable();
        $uid = $this->session->loginauthspuserfront['id'];
        $usergroup = $this->session->loginauthspuserfront['user_group_id'];
        $time = time();
        if($this->request->isPost() == true)
        {
            if($this->request->isAjax() == true)
            {   
                // ------- Pagination Start -------
                    $noofrows = $this->request->getPost('noofrows','trim');
                    $pagenum = $this->request->getPost('pagenum','trim');
                    //echo $pagenum.'*'.$noofrows; exit;
                    $rsstrt = ($pagenum-1) * $noofrows;
                    //echo $rsstrt; exit;
                // ------- Pagination End -------
                
                // ------- FilterValues Start -------  
                    $status = $this->request->getPost('status','trim');
                // ------- FilterValues End -------
                
                
                // ------------ Queries Start ------------                
                    if($status == "drafted")
                    {
                        $addquery=" AND `send_status`=0  ";
                    } 
                    elseif($status == "sent_for_approval")
                    {
                        $addquery=" AND `send_status`=1  ";
                    } 
                    elseif($status == "not_approved")
                    {
                        $addquery=" AND `approved_status` IS NULL  ";
                    } 
                    elseif($status == "approved")
                    {
                        $addquery=" AND `approved_status`=1  ";
                    } 
                    elseif($status == "rejected")
                    {
                        $addquery=" AND `approved_status`=2  ";
                    }   
                    elseif($status == "trade_pending")
                    {
                        $addquery=" AND `trading_status` IS NULL  ";
                    } 
                    elseif($status == "trade_not_done")
                    {
                        $addquery=" AND `trading_status`=0  ";
                    } 
                    elseif($status == "trade_completed")
                    {
                        $addquery=" AND `trading_status`=1  ";
                    } 
                    else 
                    {
                        $addquery=" ";
                    }
                    // echo $addquery; exit;

                    $rslmt = ' LIMIT '.$rsstrt.','.$noofrows;
                    //echo '<pre>'; print_r($rslmt); exit;
                    $orderby = ' ORDER BY pr.`id` DESC ';
                    //echo $query; exit;

                    $mainqry = $addquery;
                    $fnlqry = $mainqry.$orderby.$rslmt;
                    // echo $fnlqry; exit;
                // ------------ Queries End ------------
                
                
                $getdata = $this->tradingrequestcommon->subuserreqapproval($uid,$usergroup,$fnlqry);
                $allrows = $this->tradingrequestcommon->subuserreqapproval($uid,$usergroup,$mainqry);
                
                
                // ------- Pagination Start -------
                    $rscnt = count($allrows);
                    $rspgs = ceil($rscnt/$noofrows);
                    $pgndata = $this->elements->paginatndata($pagenum,$rspgs);
                    $pgnhtml = $this->elements->paginationhtml($pagenum,$pgndata['start_loop'],$pgndata['end_loop'],$rspgs);
                    //echo '<pre>';print_r($pgnhtml);exit;
                // ------- Pagination End -------
                
                if(!empty($getdata))
                {
                    $data = array("logged"=>true, "data"=>$getdata, "pgnhtml"=>$pgnhtml, "chkusergroup"=>$usergroup, "message"=>"Record Fetched Successfully");
                    $this->response->setJsonContent($data);
                }
                else
                {
                    $data = array("logged"=>false, "data"=>'', "chkusergroup"=>$usergroup, "pgnhtml"=>$pgnhtml, "message"=>"Record Not Found");
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
                $result = $this->tradingrequestcommon->delpersonalreq($uid,$usergroup,$delid);
                
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

    public function deltradeAction()
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
                $result = $this->tradingrequestcommon->deltrade($uid,$usergroup,$delid);

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
    
    public function getsinglereqAction()
    {
        $this->view->disable();
        $uid = $this->session->loginauthspuserfront['id'];
        $usergroup = $this->session->loginauthspuserfront['user_group_id'];
        $time = time();
        if($this->request->isPost() == true)
        {
            if($this->request->isAjax() == true)
            {   
                $editid=$this->request->getPost('editid','trim');  
                $result = $this->tradingrequestcommon->getsinglereq($uid,$usergroup,$editid);
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

    public function sendmultiplereqAction()
    {
        $this->view->disable();
        $uid = $this->session->loginauthspuserfront['id'];
        $usergroup = $this->session->loginauthspuserfront['user_group_id'];
        $time = time();
        $date=date('d-m-Y');
        
        if($this->request->isPost() == true)
        {
            if($this->request->isAjax() == true)
            {  
                $flag = 1;
                
                $getresult = $this->tradingrequestcommon->getblackoutperiod($uid,$usergroup);
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

                    $result = $this->tradingrequestcommon->sendmultiplereq($uid,$usergroup,$selctedid);
                    if($result['status']==true)
                    {
                        
                        $notific=$this->notificationcommon->insertnotification($selctedid,"1");
                       
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
    

    public function acceptapprovelAction()
    {
        $this->view->disable();
        $uid = $this->session->loginauthspuserfront['id'];
        $usergroup = $this->session->loginauthspuserfront['user_group_id'];
        $time = time();
        if($this->request->isPost() == true)
        {
            if($this->request->isAjax() == true)
            {
                $selctedid = $this->request->getPost('selctedid');  
                $result = $this->tradingrequestcommon->acceptapprovel($uid,$usergroup,$selctedid);

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
            
      
    public function uploadtradingfileAction()
    {
        $this->view->disable();
        $uid = $this->session->loginauthspuserfront['id'];
        $usergroup = $this->session->loginauthspuserfront['user_group_id'];
        $time = time();
        $date = date('d-m-Y');
        if($this->request->isPost() == true)
        {
            if($this->request->isAjax() == true)
            {   
                $data=$this->request->getPost();
                $reqid=$this->request->getPost('reqid','trim'); 
                $data['typetrans']=$this->request->getPost('transtype','trim');
                
                
                $createdttime = date('d-m-Y', strtotime($data['createdate'] ) ); 
                $typeofbutton = $data['uploadtrade'];
                $allowtedshares = $data['noofffshares'];
                if($data['transshare']!='')
                {
                    $transactedshares=$data['transshare'];
                }
                else
                {
                    $transactedshares=0;
                }
                $transactedshares= $transactedshares+$data['noofshare'];

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
                else if(strtotime($data['transdate']) < strtotime($createdttime) || strtotime($data['transdate'])> strtotime($date))
                {
                    $data = array("logged" => false,"message" =>"Date of transaction should not be before date of creation of request and also it cannot be in future");
                    $this->response->setJsonContent($data);
                }
                else if(($transactedshares>$allowtedshares) && $exceptinappr==0)
                {
                    $data = array("logged" => true,"message" =>"limit exception");
                    $this->response->setJsonContent($data);
                }
                else if(empty($data['noofshare']))
                {
                    $data = array("logged" => false,"message" =>"Please Enter No Of share");
                    $this->response->setJsonContent($data);
                }
                else if(($data['noofshare']>$allowtedshares)  && $exceptinappr==0)
                {
                    $data = $data = array("logged" => true,"message" =>"limit exception");
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
                    $data = array("logged" => true,"message" =>"exception");
                    $this->response->setJsonContent($data); 
                }
                else if(empty($data['dmatacc']))
                {
                    $data = array("logged" => false,"message" =>"Please Select DEMAT Account");
                    $this->response->setJsonContent($data); 
                }
                else
                { 
                    $data=$this->request->getPost();
                    $data['exceptinappr']=$exceptinappr;
                    $reqid=$this->request->getPost('reqid','trim');  
                    $data['typetrans']=$this->request->getPost('transtype','trim'); 
                    
                    $upload_path = $this->cmpmodule."/tradingrequest/"; 
                    // print_r($upload_path);exit; 
                    if(empty($_FILES["fileToUpload"]["name"]))
                    {
                         $target_file ='';
                         $file='';  
                         $result =true;
                    }
                    else
                    {
                        $target_file =  $upload_path.basename($_FILES["fileToUpload"]["name"]);
                        $file=$_FILES['fileToUpload']['name'];    
                        $result = move_uploaded_file($_FILES['fileToUpload']['tmp_name'],$target_file.$file);
                        // print_r($result);exit;
                    }
                    if ($result) 
                    {
                        $resp=$this->tradingrequestcommon->uploadtradingfile($uid,$usergroup,$reqid,$target_file,$data,$typeofbutton);
                        //  print_r($resp);exit;
                        if($resp)
                        {
                            $data = array("logged" =>true,"message" =>"Data Inserted Successfully","exceptinappr"=>$exceptinappr);
                            $this->response->setJsonContent($data);
                        }
                        else
                        {
                            $data = array("logged" => false,"message" =>"Data Not Inserted");
                            $this->response->setJsonContent($data);
                        }

                    }

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

    public function rejectapprovelAction()
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
                if(!empty($message))
                {
                    $response=$this->tradingrequestcommon->rejectreq($uid,$usergroup,$rejectid,$message);
                    if($response==true)
                    {
                        $data = array("logged" => true,"message" =>"request Rejected Successfully");
                        $this->response->setJsonContent($data);
                    }
                    else
                    {
                        $data = array("logged" => true,"message" =>"request Not Rejected Successfully");
                        $this->response->setJsonContent($data);
                    }
                }
                else
                {
                    $data = array("logged" => false,"message" =>"Please Enter Your Message..!!!");
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
                $resp=$this->tradingrequestcommon->checktradestatus($uid,$usergroup,$reqid);  
                $demataccno = $this->tradingrequestcommon->getuseracc($uid,$usergroup,$reqid,$typeofreq);
                
                if(!empty($resp))
                {
                    $data = array("logged" => true,"data"=>$resp,'dematacc'=>$demataccno,"message" =>"request Fetch Successfully");
                    $this->response->setJsonContent($data);
                }
                else
                {
                    $data = array("logged" => false,"data"=>'','dematacc'=>$demataccno,"message" =>"request Not Fetch Successfully");
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
                $response=$this->tradingrequestcommon->notdonetrade($uid,$usergroup,$reqid);  
                
                if($response==true)
                {
                    $data = array("logged" => true,"message" =>"Record Updated Successfully");
                    $this->response->setJsonContent($data);
                }
                else
                {
                    $data = array("logged" => false,"message" =>"Record Not Updated Successfully");
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
    

    public function donetradeAction()
    {
        $this->view->disable();
        $uid = $this->session->loginauthspuserfront['id'];
        $usergroup = $this->session->loginauthspuserfront['user_group_id'];
        $time = time();
        if($this->request->isPost() == true)
        {
            if($this->request->isAjax() == true)
            {   
                $reqid = $this->request->getPost('reqid','trim');
                $response = $this->tradingrequestcommon->donetrade($uid,$usergroup,$reqid); 
                
                if($response==true)
                {
                    $mailaftrfinalsub = $this->tradingrequestcommon->mailaftrfinalsub($reqid);

                    $notific=$this->notificationcommon->insertnotification($reqid,"3");
                
                    $data = array("logged" => true,"message" =>"Record Updated Successfully");
                    $this->response->setJsonContent($data);
                }
                else
                {
                    $data = array("logged" => false,"message" =>"request Not Updated Successfully");
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
                $resp=$this->tradingrequestcommon->successstatus($uid,$usergroup,$reqid);
                // print_r($resp);exit;
                if(!empty($resp))
                {
                    $data = array("logged" => true,"data"=>$resp,"message" =>"Record Fetched Successfully");
                    $this->response->setJsonContent($data);
                }
                else
                {
                    $data = array("logged" => false,"data"=>'',"message" =>"Data Not Found");
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
    
    
    /****************** fetch audit trail data start******************/
    public function fetchreqtrailAction()
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
                $rqstid = $this->request->getPost('rqstid');
                $getres = $this->tradingrequestcommon->fetchreqtrail($getuserid,$user_group_id,$rqstid);
                $gettransdate = $this->tradingrequestcommon->fetchreqtransdte($getuserid,$user_group_id,$rqstid);
                if($getres)
                {
                    $data = array("logged" => true,'message' => 'Record Fetch','data' => $getres,'user_group_id'=>$user_group_id,'user_id'=>$getuserid,'transdate'=>$gettransdate);
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
    /****************** fetch audit trail data start******************/


      public function deletenotificationAction()
     {
          $this->view->disable();
          $getuserid = $this->session->loginauthspuserfront['id'];
          $user_group_id = $this->session->loginauthspuserfront['user_group_id'];
            if($this->request->isPost() == true)
           {
            if($this->request->isAjax() == true)
            {
                $status=$this->notificationcommon->deletenotification($getuserid);
                // print_r($status);exit;
            }
          }
     }


    public function getfilecontentAction()
    {
        $this->view->disable();
        $uid = $this->session->loginauthspuserfront['id'];
        $user_group_id = $this->session->loginauthspuserfront['user_group_id'];
        //echo $uid.'*'.$user_group_id; exit;

        if($this->request->isPost() == true)
        {
            if($this->request->isAjax() == true)
            {
                $formtype = $this->request->getPost("formtype");

                if($formtype == "form1")
                {
                    $pdf_content = file_get_contents("declaration_form/preclearance.html");
                    //$pdfpath = $this->dompdfgen->getpdf($pdf_content,'check','weaver','weaver');
                }
                else if($formtype == "form2")
                {
                     
                    $pdf_content = file_get_contents("declaration_form/weaverform.html");
                    //$pdfpath = $this->dompdfgen->getpdf($pdf_content,'check','preclerance','preclerance');
                }
               
               
                
                if(!empty($pdf_content))
                {
                    $data = array("logged" => true,"message"=>"PDF Generated Successfully","pdf_content"=> $pdf_content);
                    $this->response->setJsonContent($data);
                }
                else
                {
                    $data = array("logged" =>false,"message" => "PDF Not Generated");
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
    
    public function savecontratrdexceptnAction()
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
                //print_R($alldata);exit;
                $approverid = $this->request->getPost('approverid','trim');
                $sectype = $this->request->getPost('sectype','trim');
                $idofcmp = $this->request->getPost('idofcmp','trim');
                $nameofcmp  = $this->request->getPost('nameofcmp','trim');
                $noofshare = $this->request->getPost('noofshare','trim');
                $typeoftrans  = $this->request->getPost('typeoftrans','trim');
                $typeofrequest = $this->request->getPost('typeofrequest','trim');
                $selrelative = $this->request->getPost('selrelative','trim');
                $reqname = $this->request->getPost('reqname','trim');
                $typeofsave = $this->request->getPost('typeofsave','trim');
                
                /*----additional questions*/
                $reasonoftrans = $this->request->getPost('reasonoftrans','trim');
                $otherreason = $this->request->getPost('otherreason','trim');
                $lasttransdate = $this->request->getPost('lasttransdate','trim');
                $noofshareoftrans = $this->request->getPost('noofshareoftrans','trim');
                $form2place = $this->request->getPost('form2place','trim');
                //$path = $this->request->getPost('link','trim');
                //print_r($path);exit;
                $flag = 1;
//                if($typeofrequest==3)
//                {
//                	   $uid =$this->request->getPost('dpuserid','trim');
//                	   $usergroup=$this->request->getPost('dpusergroup','trim');
//                }
                // print_r($usergroup);exit;
                $checkdemat = $this->tradingrequestcommon->checkdematacc($uid,$usergroup,$selrelative);
              
                //print_r($checkdemat);exit;
                if(empty($approverid))
                {
                    $data = array("logged" => false,'message' => 'You Do Not Have Approval user To Sending Request Please  Contact To Admin User');
                    $this->response->setJsonContent($data);
                    $this->response->send();
                }
                else if(empty($checkdemat))
                {
                    $data = array("logged" => false,'message' => 'Please Update Your Demat Account Number');
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
                else if($reasonoftrans == 4 && empty($otherreason)) 
                {
                    $data = array("logged" => false,'message' => 'Please specify any other reason');
                    $this->response->setJsonContent($data);
                    $this->response->send();
                }
                
                else
                {
                    $send_status=1;
                    $msg = "Record Sent Successfully";
                    $getresult = $this->tradingrequestcommon->getblackoutperiod($uid,$usergroup);
                    //print_r($getresult);exit;
                    for($i=0;$i<sizeof($getresult);$i++)
                    {
                        if(!empty($getresult[$i]))
                        {
                            $dateto = $getresult[$i]['dateto'];
                            $datefrom = $getresult[$i]['datefrom'];
                            if(strtotime($date) < strtotime($datefrom) || strtotime($date) > strtotime($dateto))
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
                        $result = $this->tradingrequestcommon->savecontratrdexceptn($uid,$usergroup,$alldata,$send_status);
                        if($result['status']==true)
                        {
                            $data = array("logged" => true,'message' =>$msg);
                            $this->response->setJsonContent($data);
                        }
                        else
                        {
                            $data = array("logged" => false,'message' =>$result['message']);
                            $this->response->setJsonContent($data);
                        }
                    }
                    else
                    {
                        $data = array("logged" => false,'message' => 'Black Out Period');
                        $this->response->setJsonContent($data);
                    }
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


     public function fetchdematAction()
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
                
                //print_R($alldata);exit;
                $typeofreq = $this->request->getPost('typeofreq','trim');
               
                if($typeofreq == 1)
                {
                     $result = $this->tradingrequestcommon->selfdematacc($uid);

                }
                else if($typeofreq == 2)
                {
                    $result = $this->tradingrequestcommon->relativedematacc($uid);
                }
               
                   
                if($result)
                {
                    $data = array("logged" => true,'message' =>"data fetched",'data'=>$result);
                    $this->response->setJsonContent($data);
                }
                else
                {
                    $data = array("logged" => false,'message' =>"data not fetched");
                    $this->response->setJsonContent($data);
                }
                   
                $this->response->send();

            }
            else
            {
                exit('No direct script access allowed');
            }
            
           
        }
        else
        {
            return $this->response->redirect('errors/show404');
            exit('No direct script access allowed');
        }
    }

    

    
  }

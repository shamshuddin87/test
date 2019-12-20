<?php 
class TradingplanController extends ControllerBase
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
        $this->view->rquestfor = $this->tradingplancommon->getrequestfor();
        $this->view->retvdetail = $this->tradingplancommon->getretvdetail($uid,$usergroup);
        $this->view->cmpnydetail = $this->tradingplancommon->getcompnydetail($uid,$usergroup);
        $this->view->sectype = $this->tradingplancommon->getsectypes();
    }
    
    public function tradeplanviewAction()
    {
        $uid = $this->session->loginauthspuserfront['id'];
        $usergroup = $this->session->loginauthspuserfront['user_group_id'];
        $id = $_GET['tradeid'];
        $unique = $_GET['uniqueid'];
        $this->view->planid = base64_decode($id);
        $this->view->planuniqueid = base64_decode($unique);
        $this->view->rquestfor = $this->tradingplancommon->getrequestfor();
        $this->view->retvdetail = $this->tradingplancommon->getretvdetail($uid,$usergroup);
        $this->view->cmpnydetail = $this->tradingplancommon->getcompnydetail($uid,$usergroup);
        $this->view->sectype = $this->tradingplancommon->getsectypes();
    }
    
    public function planreqstviewAction()
    {
        
    }
    public function planreqstapprvAction()
    {
        $id = $_GET['tradeid'];
        $unique = $_GET['uniqueid'];
        $this->view->planid = base64_decode($id);
        $this->view->planuniqueid = base64_decode($unique);
    }
    /****************** fetch security types for added field start (tradingplan)******************/
    public function fetchsectypeAction()
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
                $getres = $this->tradingplancommon->getsectypes();
                if($getres)
                {
                    $data = array("logged" => true,'message' => 'Record Added','resdta' => $getres,'user_group_id'=>$user_group_id);
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
    /****************** fetch security types for added field end******************/
    
    /****************** insert trading plan start (tradingplan)******************/
    public function inserttradingplanAction()
    {
        $this->view->disable();
        $getuserid = $this->session->loginauthspuserfront['id'];
        $cin = $this->session->memberdoccin;
        $user_group_id = $this->session->loginauthspuserfront['user_group_id'];
        if($this->request->isPost() == true)
        {
            if($this->request->isAjax() == true)
            {
                $flag = 1;
                $date=date('d-m-Y');
                $requestfor = $this->request->getPost('reqstfr');
                $relative = $this->request->getPost('relative');
                $cmpnme = $this->request->getPost('cmpnme');
                $frmdate = $this->request->getPost('frmdate');
                $todate = $this->request->getPost('todate');
                $sectype = $this->request->getPost('sectype');
                $datetype = $this->request->getPost('datetype');
                $spficdate = $this->request->getPost('spficdate');
                $daterngfrm = $this->request->getPost('daterngfrm');
                $daterngto = $this->request->getPost('daterngto');
                $noofsec = $this->request->getPost('noofsec');
                $valueofsecurity = $this->request->getPost('valueofsecurity');
                $uniqid = uniqid();
                $getaprvrid = $this->tradingplancommon->getaprvrid($getuserid);
                if($requestfor == 1) //for self
                {
                    $getfrmdate = $this->tradingplancommon->checkperioddate($getuserid,$cmpnme,$frmdate,$todate);
                    if(sizeof($getfrmdate)!=0)
                    {
                        $data = array("logged" => false,'message' => 'Overlapping Of two period for same person for same company should not allowed!!');
                            $this->response->setJsonContent($data);
                            $this->response->send();
                            exit;
                    }
                }
                else  // for relative
                {
                    $getfrmdatefrrel = $this->tradingplancommon->checkperioddatereltv($getuserid,$cmpnme,$frmdate,$todate,$relative);
                    if(sizeof($getfrmdatefrrel)!=0)
                    {
                        $data = array("logged" => false,'message' => 'Overlapping Of two period for same person for same company should not allowed!!');
                            $this->response->setJsonContent($data);
                            $this->response->send();
                            exit;
                    }
                }
                
                $getblackoutdate = $this->tradingplancommon->checkblackout($getuserid,$cmpnme,$frmdate,$todate);
            
                if(sizeof($getblackoutdate)!=0)
                {
                    $data = array("logged" => false,'message' => 'Black Out Period!!');
                        $this->response->setJsonContent($data);
                        $this->response->send();
                        exit;
                }
                $date1=date_create($frmdate);
                $date2=date_create($todate);
                $diff=date_diff($date1,$date2);
                $days = $diff->format("%a");
                if($days < 365 || $days > 550)
                {
                    $data = array("logged" => false,'message' => 'Period of plan shall be a minimum period of 12 months and maximum period of 18 months!!');
                    $this->response->setJsonContent($data);
                    $this->response->send();
                    exit;
                }
                $getaprvrid = implode(',',$getaprvrid);
                for($i = 0;$i<sizeof($sectype);$i++)
                {
                    if($datetype[$i] == 1)
                    {
                           if(!empty($spficdate[$i]))
                            {
                                $cmpspecific = date('d-m-Y', strtotime("+6 months", strtotime($frmdate)));
                                if(strtotime($cmpspecific) > strtotime($spficdate[$i]))
                                {
                                    $data = array("logged" => false,'message' => 'Date Should be after 6 months from date of period of plan from!!');
                                    $this->response->setJsonContent($data);
                                    $flag = 0;
                                    break;
                                }
                               else
                                {
                                    $flag = 1;
                                }
                            }
                            else
                            {
                                $data = array("logged" => false,'message' => 'Specific date  Should not empty!!');
                                $this->response->setJsonContent($data);
                                $flag = 0;
                                break;
                            }
                    }
                    if($datetype[$i] == 2)
                    {
                        if(empty($daterngfrm[$i]))
                        {
                            $data = array("logged" => false,'message' => 'Date range From Should not empty!!');
                            $this->response->setJsonContent($data);
                            $flag = 0;
                            break;
                        }
                        else  if(empty($daterngto[$i]))
                        {
                            $data = array("logged" => false,'message' => 'Date range To Should not empty!!');
                            $this->response->setJsonContent($data);
                            $flag = 0;
                            break;
                        }
                       else if(!empty($daterngfrm[$i]))
                        {
                            $cmpspecific = date('d-m-Y', strtotime("+6 months", strtotime($frmdate)));
                            if(strtotime($cmpspecific) > strtotime($daterngfrm[$i]))
                            {
                                $data = array("logged" => false,'message' => 'Date range from Should be after 6 months from date of period of plan from!!');
                                $this->response->setJsonContent($data);
                                $flag = 0;
                                break;
                            }
                           else if(strtotime($daterngfrm[$i]) > strtotime($daterngto[$i]))
                            {
                                $data = array("logged" => false,'message' => 'Date range To Should not be greater than Date range From!!');
                                $this->response->setJsonContent($data);
                                $flag = 0;
                                break;
                            }
                            else
                            {
                                $flag = 1;
                            }
                        }
                    
                        
                       
                    }
                  
                 
                    if(empty($noofsec[$i]))
                    {
                        if(empty($valueofsecurity[$i]))
                        {
                            $data = array("logged" => false,'message' => 'Please Select No.of Securities Or Value of Securities!!');
                            $this->response->setJsonContent($data);
                            $flag = 0;
                            break;
                        }
                    }
                    else
                    {
                        $flag = 1;
                    }
                    
                   
                    
               }
                 if($flag == 1)
                    {
                        //echo 'in flag 1';exit;
                        $getres = $this->tradingplancommon->inserttradingplan($getuserid,$user_group_id,$requestfor,$relative,$cmpnme,$frmdate,$todate,$sectype,$datetype,$spficdate,$daterngfrm,$daterngto,$noofsec,$valueofsecurity,$uniqid,$getaprvrid);
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
                    }
                    else
                    {
                        $this->response->send();
                        exit;
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
    /****************** insert trading plan end ******************/
    
    /****************** fetch trading plan start (tradingplan)******************/
    public function fetchtradeplanAction()
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
                $noofrows=$this->request->getPost('noofrows');
                $pagenum=$this->request->getPost('pagenum');
                $mainquery = '';
                $getres = $this->tradingplancommon->fetchtradeplan($getuserid,$user_group_id,$mainquery);
                /* start pagination */
                $rsstrt = ($pagenum-1) * $noofrows;
                $rslmt =' LIMIT '.$rsstrt.','.$noofrows;
                $rscnt=count($getres);
                $rspgs = ceil($rscnt/$noofrows);
                $pgndata = $this->elements->paginatndata($pagenum,$rspgs);
                $pgnhtml = $this->elements->paginationhtml($pagenum,$pgndata['start_loop'],$pgndata['end_loop'],$rspgs);
                
                $getresult = $this->tradingplancommon->fetchtradeplan($getuserid,$user_group_id,$rslmt);
                if($getres)
                {
                    $data = array("logged" => true,'message' => 'Record Added','resdta' => $getresult,'user_group_id'=>$user_group_id,"pgnhtml"=>$pgnhtml);
                    $this->response->setJsonContent($data);
                }
                else
                {
                    $data = array("logged" => false,'message' => "Record Not Added..!!","pgnhtml"=>$pgnhtml);
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
    /****************** fetch trading plan end ******************/
    
    /****************** fetch trading plan view start (tradeplanview)******************/
    public function fetchtradeplanviewAction()
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
                $noofrows=$this->request->getPost('noofrows');
                $pagenum=$this->request->getPost('pagenum');
                $mainquery = '';
                $tradeid = $this->request->getPost('tradeid');
                $tradeuniid = $this->request->getPost('tradeuniqid');
                $getres = $this->tradingplancommon->fetchtradeplanview($getuserid,$user_group_id,$tradeid,$tradeuniid,$mainquery);
                
                /* start pagination */
                $rsstrt = ($pagenum-1) * $noofrows;
                $rslmt =' LIMIT '.$rsstrt.','.$noofrows;
                $rscnt=count($getres);
                $rspgs = ceil($rscnt/$noofrows);
                $pgndata = $this->elements->paginatndata($pagenum,$rspgs);
                $pgnhtml = $this->elements->paginationhtml($pagenum,$pgndata['start_loop'],$pgndata['end_loop'],$rspgs);
                
                $getresult = $this->tradingplancommon->fetchtradeplanview($getuserid,$user_group_id,$tradeid,$tradeuniid,$rslmt);
                if($getres)
                {
                    $data = array("logged" => true,'message' => 'Record Added','resdta' => $getresult,'user_group_id'=>$user_group_id,"pgnhtml"=>$pgnhtml);
                    $this->response->setJsonContent($data);
                }
                else
                {
                    $data = array("logged" => false,'message' => "Record Not Added..!!","pgnhtml"=>$pgnhtml);
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
     /****************** fetch trading plan view end ******************/
    
    /****************** send trading plan for approval start (tradeplanview)******************/
    public function sendplanforapprvAction()
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
                $tradeid = $this->request->getPost('tradeid');
                $getres = $this->tradingplancommon->sendplanforapprv($getuserid,$user_group_id,$tradeid);
                //print_r($getres);exit;
                if($getres)
                {
                    $data = array("logged" => true,'message' => 'Record Sent Successfully','resdta' => $getres,'user_group_id'=>$user_group_id);
                    $this->response->setJsonContent($data);
                }
                else
                {
                    $data = array("logged" => false,'message' => "Record Not Sent..!!");
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
    /****************** send trading plan for approval end ******************/
    
    /******************* fetch trading plan for approve start (planreqstview)******************/
    public function fetchplanforapproveAction()
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
                $noofrows=$this->request->getPost('noofrows');
                $pagenum=$this->request->getPost('pagenum');
                $mainquery = '';
                $getres = $this->tradingplancommon->fetchplanforapprove($getuserid,$user_group_id,$mainquery);
                
                /* start pagination */
                $rsstrt = ($pagenum-1) * $noofrows;
                $rslmt =' LIMIT '.$rsstrt.','.$noofrows;
                $rscnt=count($getres);
                $rspgs = ceil($rscnt/$noofrows);
                $pgndata = $this->elements->paginatndata($pagenum,$rspgs);
                $pgnhtml = $this->elements->paginationhtml($pagenum,$pgndata['start_loop'],$pgndata['end_loop'],$rspgs);
                
                $getresult = $this->tradingplancommon->fetchplanforapprove($getuserid,$user_group_id,$rslmt);
                if($getresult)
                {
                    $data = array("logged" => true,'message' => 'Record Added','resdta' => $getresult,'user_group_id'=>$user_group_id,'user_id'=>$getuserid,"pgnhtml"=>$pgnhtml);
                    $this->response->setJsonContent($data);
                }
                else
                {
                    $data = array("logged" => false,'message' => "Record Not Added..!!","pgnhtml"=>$pgnhtml);
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
    /******************* fetch trading plan for approve end******************/
    
    /******************* fetch trading plan for approver start (planreqstapprv)******************/
    public function fetchallplanforapproveAction()
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
                $tradeid = $this->request->getPost('tradeid');
                $tradeuniid = $this->request->getPost('tradeuniqid');
                $noofrows=$this->request->getPost('noofrows');
                $pagenum=$this->request->getPost('pagenum');
                $mainquery = '';
                $getres = $this->tradingplancommon->fetchtradeplanview($getuserid,$user_group_id,$tradeid,$tradeuniid,$mainquery);
                
                /* start pagination */
                $rsstrt = ($pagenum-1) * $noofrows;
                $rslmt =' LIMIT '.$rsstrt.','.$noofrows;
                $rscnt=count($getres);
                $rspgs = ceil($rscnt/$noofrows);
                $pgndata = $this->elements->paginatndata($pagenum,$rspgs);
                $pgnhtml = $this->elements->paginationhtml($pagenum,$pgndata['start_loop'],$pgndata['end_loop'],$rspgs);
                //print_r($getres);exit;
                
                $getresult = $this->tradingplancommon->fetchtradeplanview($getuserid,$user_group_id,$tradeid,$tradeuniid,$rslmt);
                if($getresult)
                {
                    $data = array("logged" => true,'message' => 'Record Added','resdta' => $getresult,'user_group_id'=>$user_group_id,'user_id'=>$getuserid,"pgnhtml"=>$pgnhtml);
                    $this->response->setJsonContent($data);
                }
                else
                {
                    $data = array("logged" => false,'message' => "Record Not Added..!!","pgnhtml"=>$pgnhtml);
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
    /******************* fetch trading plan for approver end******************/
    
    /******************* approving trade plan start (planreqstapprv)******************/
    public function apprvtradeplanAction()
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
                $tradeid = $this->request->getPost('tradeid');
                $getres = $this->tradingplancommon->apprvtradeplan($getuserid,$user_group_id,$tradeid);
                //print_r($getres);exit;
                if($getres)
                {
                    $data = array("logged" => true,'message' => 'Plan Approved Successfully','resdta' => $getres,'user_group_id'=>$user_group_id);
                    $this->response->setJsonContent($data);
                }
                else
                {
                    $data = array("logged" => false,'message' => "Plan Not Approved..!!");
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
    /******************* approving trade plan end ******************/
    
    /******************* reject trade plan start (planreqstapprv)******************/
    public function rejcttradeplanAction()
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
                $rejctid = $this->request->getPost('rejctid');
                $message = $this->request->getPost('messg');
                $getres = $this->tradingplancommon->rejcttradeplan($getuserid,$user_group_id,$rejctid,$message);
                //print_r($getres);exit;
                if($getres)
                {
                    $data = array("logged" => true,'message' => 'Plan Rejected','resdta' => $getres,'user_group_id'=>$user_group_id);
                    $this->response->setJsonContent($data);
                }
                else
                {
                    $data = array("logged" => false,'message' => "Plan Not Rejected..!!");
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
    
    /******************* reject trade plan end ******************/
    
    /******************* fetch reject trade plan mssg start(tradingplan & planreqstapprv) ******************/
    
    public function fetchrejectmessageAction()
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
                $tradeid = $this->request->getPost('planid');
                $getres = $this->tradingplancommon->fetchrejectmessage($getuserid,$user_group_id,$tradeid);
                //print_r($getres);exit;
                if($getres)
                {
                    $data = array("logged" => true,'message' => 'Plan Approved Successfully','resdta' => $getres,'user_group_id'=>$user_group_id);
                    $this->response->setJsonContent($data);
                }
                else
                {
                    $data = array("logged" => false,'message' => "Plan Not Approved..!!");
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
    /******************* fetch reject trade plan mssg end ******************/
    
    /******************* fetch trade plan for edit start ******************/
    public function fetchtradeplaneditAction()
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
                $tradeid = $this->request->getPost('trdeplnids');
                $getres = $this->tradingplancommon->fetchtradeplanedit($getuserid,$user_group_id,$tradeid);
                //print_r($getres);exit;
                if($getres)
                {
                    $data = array("logged" => true,'message' => 'Plan Fetch Successfully','resdta' => $getres,'user_group_id'=>$user_group_id);
                    $this->response->setJsonContent($data);
                }
                else
                {
                    $data = array("logged" => false,'message' => "Plan Not Fetch..!!");
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
    
    /******************* fetch trade plan for edit end ******************/
    
    /****************** update plan start (tradingplanview)******************/
    public function updateplanAction()
    {
        $this->view->disable();
        $getuserid = $this->session->loginauthspuserfront['id'];
        $cin = $this->session->memberdoccin;
        $user_group_id = $this->session->loginauthspuserfront['user_group_id'];
        if($this->request->isPost() == true)
        {
            if($this->request->isAjax() == true)
            {
                $flag = 1;
                $date=date('d-m-Y');
                //print_r($this->request->getPost());exit;
                $planid = $this->request->getPost('planid');
                $requestfor = $this->request->getPost('requestfor');
                $relative = $this->request->getPost('relative');
                $cmpnme = $this->request->getPost('companyid');
                $frmdate = $this->request->getPost('fromdate');
                $todate = $this->request->getPost('todate');
                $sectype = $this->request->getPost('sectype');
                $datetype = $this->request->getPost('datetype');
                $spficdate = $this->request->getPost('spficdate');
                $daterngfrm = $this->request->getPost('daterngfrm');
                $daterngto = $this->request->getPost('daterngto');
                $noofsec = $this->request->getPost('noofsec');
                $valueofsecurity = $this->request->getPost('valueofsecurity');
                    if($datetype == 1)
                    {
                           if(!empty($spficdate))
                            {
                                $cmpspecific = date('d-m-Y', strtotime("+6 months", strtotime($frmdate)));
                                if(strtotime($cmpspecific) > strtotime($spficdate))
                                {
                                    $data = array("logged" => false,'message' => 'Date Should be after 6 months from date of period of plan from!!');
                                    $this->response->setJsonContent($data);
                                    $this->response->send();
                                    $flag = 0;
                                    exit;
                                }
                               else
                                {
                                    $flag = 1;
                                }
                            }
                            else
                            {
                                $data = array("logged" => false,'message' => 'Specific date  Should not empty!!');
                                $this->response->setJsonContent($data);
                                $this->response->send();
                                $flag = 0;
                                exit;
                            }
                    }
                    if($datetype == 2)
                    {
                        if(empty($daterngfrm))
                        {
                            $data = array("logged" => false,'message' => 'Date range From Should not empty!!');
                            $this->response->setJsonContent($data);
                            $this->response->send();
                            $flag = 0;
                            exit;
                        }
                        else  if(empty($daterngto))
                        {
                            $data = array("logged" => false,'message' => 'Date range To Should not empty!!');
                            $this->response->setJsonContent($data);
                            $this->response->send();
                            $flag = 0;
                            exit;
                        }
                       else if(!empty($daterngfrm))
                        {
                            $cmpspecific = date('d-m-Y', strtotime("+6 months", strtotime($frmdate)));
                            if(strtotime($cmpspecific) > strtotime($daterngfrm))
                            {
                                $data = array("logged" => false,'message' => 'Date range from Should be after 6 months from date of period of plan from!!');
                                $this->response->setJsonContent($data);
                                $this->response->send();
                                $flag = 0;
                                exit;
                            }
                           else if(strtotime($daterngfrm) > strtotime($daterngto))
                            {
                                $data = array("logged" => false,'message' => 'Date range To Should not be greater than Date range From!!');
                                $this->response->setJsonContent($data);
                                $this->response->send();
                                $flag = 0;
                                exit;
                            }
                            else
                            {
                                $flag = 1;
                            }
                        }
                    }
                  
                    if(empty($noofsec))
                    {
                        if(empty($valueofsecurity))
                        {
                            $data = array("logged" => false,'message' => 'Please Select No.of Securities Or Value of Securities!!');
                            $this->response->setJsonContent($data);
                            $this->response->send();
                            $flag = 0;
                            exit;
                        }
                    }
                    else
                    {
                        $flag = 1;
                    }
                    
                   
                    
               
                 if($flag == 1)
                    {
                        //echo 'in flag 1';exit;
                        $getres = $this->tradingplancommon->updateplan($getuserid,$user_group_id,$sectype,$datetype,$spficdate,$daterngfrm,$daterngto,$noofsec,$valueofsecurity,$planid);
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
                    }
                    else
                    {
                        $this->response->send();
                        exit;
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
    
    /****************** update plan end (tradingplanview)******************/
    
    /****************** insert trade start (tradingplanview)******************/
    public function inserttradeAction()
    {
       $this->view->disable();
        $getuserid = $this->session->loginauthspuserfront['id'];
        $cin = $this->session->memberdoccin;
        $user_group_id = $this->session->loginauthspuserfront['user_group_id'];
        if($this->request->isPost() == true)
        {
            if($this->request->isAjax() == true)
            {
                $flag = 1;
                $date=date('d-m-Y');
                //print_r($this->request->getPost());exit;
                $tradeuniqueid = $this->request->getPost('tradeuniqueid');
                $requestfor = $this->request->getPost('reqstfr');
                $relative = $this->request->getPost('relative');
                $cmpnme = $this->request->getPost('cmpnme');
                $frmdate = $this->request->getPost('frmdate');
                $todate = $this->request->getPost('todate');
                $sectype = $this->request->getPost('sectype');
                $datetype = $this->request->getPost('datetype');
                $spficdate = $this->request->getPost('spficdate');
                $daterngfrm = $this->request->getPost('daterngfrm');
                $daterngto = $this->request->getPost('daterngto');
                $noofsec = $this->request->getPost('noofsec');
                $valueofsecurity = $this->request->getPost('valueofsecurity');
                $getaprvrid = $this->tradingplancommon->getaprvrid($getuserid);
                $getfrmdate = $this->tradingplancommon->checkperiodforupdate($getuserid,$cmpnme,$frmdate,$todate,$tradeuniqueid);
                $getblackoutdate = $this->tradingplancommon->checkblackout($getuserid,$cmpnme,$frmdate,$todate);
                if(sizeof($getfrmdate)!=0)
                {
                    $data = array("logged" => false,'message' => 'Overlapping Of two period for same person for same company should not allowed!!');
                        $this->response->setJsonContent($data);
                        $this->response->send();
                        exit;
                }
                if(sizeof($getblackoutdate)!=0)
                {
                    $data = array("logged" => false,'message' => 'Black Out Period!!');
                        $this->response->setJsonContent($data);
                        $this->response->send();
                        exit;
                }
                $date1=date_create($frmdate);
                $date2=date_create($todate);
                $diff=date_diff($date1,$date2);
                $days = $diff->format("%a");
                if($days < 365 || $days > 550)
                {
                    $data = array("logged" => false,'message' => 'Period of plan shall be a minimum period of 12 months and maximum period of 18 months!!');
                    $this->response->setJsonContent($data);
                    $this->response->send();
                    exit;
                }
                $getaprvrid = implode(',',$getaprvrid);
                for($i = 0;$i<sizeof($sectype);$i++)
                {
                    if($datetype[$i] == 1)
                    {
                           if(!empty($spficdate[$i]))
                            {
                                $cmpspecific = date('d-m-Y', strtotime("+6 months", strtotime($frmdate)));
                                if(strtotime($cmpspecific) > strtotime($spficdate[$i]))
                                {
                                    $data = array("logged" => false,'message' => 'Date Should be after 6 months from date of period of plan from!!');
                                    $this->response->setJsonContent($data);
                                    $flag = 0;
                                    break;
                                }
                               else
                                {
                                    $flag = 1;
                                }
                            }
                            else
                            {
                                $data = array("logged" => false,'message' => 'Specific date  Should not empty!!');
                                $this->response->setJsonContent($data);
                                $flag = 0;
                                break;
                            }
                    }
                    if($datetype[$i] == 2)
                    {
                        if(empty($daterngfrm[$i]))
                        {
                            $data = array("logged" => false,'message' => 'Date range From Should not empty!!');
                            $this->response->setJsonContent($data);
                            $flag = 0;
                            break;
                        }
                        else  if(empty($daterngto[$i]))
                        {
                            $data = array("logged" => false,'message' => 'Date range To Should not empty!!');
                            $this->response->setJsonContent($data);
                            $flag = 0;
                            break;
                        }
                       else if(!empty($daterngfrm[$i]))
                        {
                            $cmpspecific = date('d-m-Y', strtotime("+6 months", strtotime($frmdate)));
                            if(strtotime($cmpspecific) > strtotime($daterngfrm[$i]))
                            {
                                $data = array("logged" => false,'message' => 'Date range from Should be after 6 months from date of period of plan from!!');
                                $this->response->setJsonContent($data);
                                $flag = 0;
                                break;
                            }
                           else if(strtotime($daterngfrm[$i]) > strtotime($daterngto[$i]))
                            {
                                $data = array("logged" => false,'message' => 'Date range To Should not be greater than Date range From!!');
                                $this->response->setJsonContent($data);
                                $flag = 0;
                                break;
                            }
                            else
                            {
                                $flag = 1;
                            }
                        }
                     }
                  
                 
                    if(empty($noofsec[$i]))
                    {
                        if(empty($valueofsecurity[$i]))
                        {
                            $data = array("logged" => false,'message' => 'Please Select No.of Securities Or Value of Securities!!');
                            $this->response->setJsonContent($data);
                            $flag = 0;
                            break;
                        }
                    }
                    else
                    {
                        $flag = 1;
                    }
                }
                 if($flag == 1)
                    {
//                        echo 'in flag 1';exit;
                        $getres = $this->tradingplancommon->updatetrade($getuserid,$user_group_id,$requestfor,$relative,$cmpnme,$frmdate,$todate,$tradeuniqueid);
                        $getresult = $this->tradingplancommon->insertplan($getuserid,$user_group_id,$requestfor,$relative,$cmpnme,$frmdate,$todate,$tradeuniqueid,$sectype,$datetype,$spficdate,$daterngfrm,$daterngto,$noofsec,$valueofsecurity,$getaprvrid);
                        if($getres && $getresult)
                        {
                            $data = array("logged" => true,'message' => 'Record Added');
                            $this->response->setJsonContent($data);
                        }
                        else
                        {
                            $data = array("logged" => false,'message' => "Record Not Added..!!");
                            $this->response->setJsonContent($data);
                        } 
                    }
                    else
                    {
                        $this->response->send();
                        exit;
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
    /****************** insert trade start (tradingplanview)******************/
    
    /****************** delete plan start (tradingplanview)******************/
    public function deletetradeplanAction()
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
                $id = $this->request->getPost('id','trim');
                $getres = $this->tradingplancommon->deletetradeplan($id);
                //print_r($getres);exit;
                if($getres)
                {
                    $data = array("logged" => true,'message' => 'Record Deleted');
                    $this->response->setJsonContent($data);
                }
                else
                {
                    $data = array("logged" => false,'message' => "Record Not Deleted..!!");
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
    /****************** delete plan end (tradingplanview)******************/
}

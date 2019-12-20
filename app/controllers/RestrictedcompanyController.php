<?php 
class RestrictedcompanyController extends ControllerBase
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
        $gmnlog = $this->session->loginauthspuserfront;
               
    }
    
    public function companytradingperiodAction()
    {     
        $uid = $this->session->loginauthspuserfront['id'];
        $gmnlog = $this->session->loginauthspuserfront;      
    }
    
    public function companytradebyempAction()
    {     
        $uid = $this->session->loginauthspuserfront['id'];
        $gmnlog = $this->session->loginauthspuserfront;

    }
    
    public function employeeblockingAction()
    {
        $uid = $this->session->loginauthspuserfront['id'];
        $gmnlog = $this->session->loginauthspuserfront;
        $user_group_id = $this->session->loginauthspuserfront['user_group_id'];
        if($user_group_id==2)
        {
           $this->view->cmplists = $this->restrictedcompanycommon->cmpmasterdetails($uid,$user_group_id);
        }
        else
        {
              $getmasterid = $this->tradingrequestcommon->getmasterid($uid);
              $getgroupid = $this->tradingrequestcommon->getmastergroupid($getmasterid['user_id']);
              $this->view->cmplists = $this->restrictedcompanycommon->cmpmasterdetails($getmasterid['user_id'],$getgroupid['master_group_id']);
              // print_r($getgroupid['master_group_id']);exit;
        }
               
    }
    
    // **************************** company restriction insert start***************************
    public function insertcomprestrictionAction()
    {
        $this->view->disable();
        $getuserid = $this->session->loginauthspuserfront['id'];
        $cin = $this->session->memberdoccin;
        $user_group_id = $this->session->loginauthspuserfront['user_group_id'];
        //echo $getuserid.'*'.$cin;exit;
        $flag = 0;
        if($this->request->isPost() == true)
        {
            if($this->request->isAjax() == true)
            {
                $date=date('d-m-Y');
                //print_r($this->request->getPost());exit;
                $nameofcomp   = $this->request->getPost('compid','trim');
                $periodfrom   = $this->request->getPost('perdresfrom','trim');
                $periodto   = $this->request->getPost('perdresto','trim');
                //print_r($periodfrom.'  to '.$periodto);exit;
                if(empty($nameofcomp))
                {
                    $data = array("logged" => false,'message' => 'Please select company!!');
                    $this->response->setJsonContent($data);
                }
                else if(empty($periodfrom))
                {
                    $data = array("logged" => false,'message' => 'Period Of Restriction From should not empty!!');
                    $this->response->setJsonContent($data);
                }
                else if(strtotime($date) > strtotime($periodfrom))
                {
                      $data = array("logged" => false,'message' => 'Period Of Restriction From should be in future!!');
                      $this->response->setJsonContent($data);
                }
                else if(empty($periodto))
                {
                    if($this->request->getPost('perpetuity','trim') == 'perpetuity')
                    {
                        $flag = 1;
                        
                    }
                    else
                    {
                        $data = array("logged" => false,'message' => 'Please Select Period Of Restriction To Or For Perpetuity!!');
                        $this->response->setJsonContent($data);
                    }
                }
                else if(empty($periodto))
                {
                    $data = array("logged" => false,'message' => 'Period Of Restriction To should not empty!!');
                    $this->response->setJsonContent($data);
                }
                else if($periodto)
                {
                    if(strtotime($date) > strtotime($periodto))
                    {
                          $data = array("logged" => false,'message' => 'Period Of Restriction To should be in future!!');
                          $this->response->setJsonContent($data);
                    }
                    else if(strtotime($periodfrom) > strtotime($periodto))
                    {
                       $data = array("logged" => false,'message' => 'Period Of Restriction To should be Greater Than Period Of Restriction From!!');
                       $this->response->setJsonContent($data);
                    }
                    else
                    {
                        $flag = 1;
                    }
                }                
                else
                {
                    $flag = 1;
                    
                }
                //echo "<pre>"; print_r($flag); exit;     
                
                if($flag == 1)
                {
                    $getres = $this->restrictedcompanycommon->insertcomprestriction($getuserid,$user_group_id,$nameofcomp,$periodfrom,$periodto);
                    if($getres)
                    {
                        $mailsent = $this->restrictedcompanycommon->mailcomprestriction($getuserid,$user_group_id,$nameofcomp,$periodfrom,$periodto);
                    }
                    //echo "checking form data";print_r($mailsent); exit;      
                    if($getres)
                    {
                        $data = array("logged" => true,'message' => 'Record Added','resdta' => $getres);
                        $this->response->setJsonContent($data);
                    }
                    else
                    {
                        $data = array("logged" => false,'message' => "Record Not Added..!!");
                        $this->response->setJsonContent($data);
                    }  
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
    // **************************** company restriction insert end***************************
    
    // **************************** company restriction fetch for table start***************************
    public function fetchcompanyrestrictedAction()
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
                $getres = $this->restrictedcompanycommon->fetchcompanyrestricted($getuserid,$user_group_id);
                $getaccess =$this->adminmodulecommon->gatallaccessdetails($getuserid);
               
                if($getres)
                {
                    $data = array("logged" => true,'message' => 'Record Added','resdta' => $getres,'user_group_id'=>$user_group_id,'getaccess'=>$getaccess);
                    $this->response->setJsonContent($data);
                }
                else
                {
                    $data = array("logged" => false,'message' => "Record Not Added..!!",'getaccess'=>$getaccess);
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
    // **************************** company restriction fetch for table end***************************
    
    // **************************** company restriction fetch for edit start***************************
    public function companyrestrictedforeditAction()
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
                $getres = $this->restrictedcompanycommon->companyrestrictedforedit($id);
                if($getres)
                {
                    $data = array("logged" => true,'message' => 'Record Added','data' => $getres);
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
    // **************************** company restriction fetch for edit end***************************
    
    // **************************** company restriction update start***************************
    public function updatecomprestrictionAction()
    {
        $this->view->disable();
        $getuserid = $this->session->loginauthspuserfront['id'];
        $cin = $this->session->memberdoccin;
        $user_group_id = $this->session->loginauthspuserfront['user_group_id'];
        //echo $getuserid.'*'.$cin;exit;
        $flag = 0;
        if($this->request->isPost() == true)
        {
            if($this->request->isAjax() == true)
            {
                $date=date('d-m-Y');
                $nameofcomp   = $this->request->getPost('compid','trim');
                $perdresfrom   = $this->request->getPost('perdresfrom','trim');
                $perdresto   = $this->request->getPost('perdresto','trim');
                $id   = $this->request->getPost('tempid','trim');
                
                //echo "checking form data";print_r($this->request->getPost()); exit;
                if(empty($nameofcomp))
                {
                    $data = array("logged" => false,'message' => 'Please select company!!');
                    $this->response->setJsonContent($data);
                }
                else if(empty($perdresfrom))
                {
                    $data = array("logged" => false,'message' => 'Period Of Restriction From should not empty!!');
                    $this->response->setJsonContent($data);
                }
                else if(strtotime($date) > strtotime($perdresfrom))
                {
                      $data = array("logged" => false,'message' => 'Period Of Restriction From should be in future!!');
                      $this->response->setJsonContent($data);
                }
                else if(empty($perdresto))
                {
                    if($this->request->getPost('perpetuity','trim') == 'perpetuity')
                    {
                        $flag = 1;
                        
                    }
                    else
                    {
                        $data = array("logged" => false,'message' => 'Please Select Period Of Restriction To Or For Perpetuity!!');
                        $this->response->setJsonContent($data);
                    }
                    
                }
                else if(empty($perdresto))
                {
                    $data = array("logged" => false,'message' => 'Period Of Restriction To should not empty!!');
                    $this->response->setJsonContent($data);
                }
                    
                
                else if($perdresto)
                {
                    if(strtotime($date) > strtotime($perdresto))
                    {
                          $data = array("logged" => false,'message' => 'Period Of Restriction To should be in future!!');
                          $this->response->setJsonContent($data);
                    }
                    else if(strtotime($perdresfrom) > strtotime($perdresto))
                    {
                       $data = array("logged" => false,'message' => 'Period Of Restriction To should be Greater Than Period Of Restriction From!!');
                       $this->response->setJsonContent($data);
                    }
                    else
                    {
                        $flag = 1;
                    }
                }
                
                else
                {
                    $flag = 1;
                }
                if($flag == 1)
                {
                    $getres = $this->restrictedcompanycommon->updatecomprestriction($getuserid,$user_group_id,$nameofcomp,$perdresfrom,$perdresto,$id);
                    if($getres)
                    {
                       $mailsent = $this->restrictedcompanycommon->mailcomprestriction($getuserid,$user_group_id,$nameofcomp,$perdresfrom,$perdresto); 
                    }
                    
                    //echo "checking form data";print_r($getres); exit;      
                    if($getres)
                    {
                        $data = array("logged" => true,'message' => 'Record Updated','data' => $getres);
                        $this->response->setJsonContent($data);
                    }
                    else
                    {
                        $data = array("logged" => false,'message' => "Record Not Updated..!!");
                        $this->response->setJsonContent($data);
                    }
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
    // **************************** company restriction update end***************************
    
    
    // **************************** company restriction Delete start***************************
     public function companyrestrictedfordeleteAction()
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
                $getres = $this->restrictedcompanycommon->companyrestrictedfordelete($id);
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
    // **************************** company restriction Delete end***************************
    
    // **************************** company restriction search cmp start***************************
    public function cmplistsAction()
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
                $searchvallist = $this->request->getPost('searchvallist');
                //echo  $searchvallist;exit;
                $searchlist = $this->filter->sanitize($searchvallist, "trim");
                $searchlist = $this->filter->sanitize($searchvallist, "string");
                if(preg_match("/[A-Za-z]+/", $searchlist))
                {
                    $getsearchkywo = $searchlist;
                    $limit = 10;
                    
                    $userlist = array();
                    $complist = array();
                    
                    $complist = $this->restrictedcompanycommon->cmpdetails($getuserid,$user_group_id,$getsearchkywo);  
                    
                    $getcount = count($complist);
                    //echo $getcount; exit;

                    if(!empty($complist))
                    {
                        $data = array("logged" => true,'message' => 'Found!!!' ,'data'=> $complist,'count'=> $getcount);
                        //echo '<pre>'; print_r($data); exit;
                        $this->response->setJsonContent($data);
                    }
                    else
                    {
                        $data = array("logged" => false,'message' => 'No Result Found !!!');
                        $this->response->setJsonContent($data);
                    }
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
    // **************************** company restriction search cmp end***************************
    
    // **************************** employee restriction get department start *************************** 
    public function getDeptAction()
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
                $id = $this->request->getPost('cmpid','trim');
                $getres = $this->restrictedcompanycommon->getDept($id);
                //print_r($getres);exit;
                if($getres)
                {
                    $data = array("logged" => true,'message' => 'Found','data'=>$getres);
                    $this->response->setJsonContent($data);
                }
                else
                {
                    $data = array("logged" => false,'message' => "Record Not Found..!!");
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
    // **************************** employee restriction get department end ***************************
    
    // **************************** employee restriction get employee start*************************** 
    public function getallemployeeAction()
    {
        $this->view->disable();
        $getuserid = $this->session->loginauthspuserfront['id'];
        $user_group_id = $this->session->loginauthspuserfront['user_group_id']; 
        $timeago = time();
        if($this->request->isPost() == true)
        {
            if($this->request->isAjax() == true)
            {
                $deptid    = $this->request->getPost('deptid');
                $cmpid    = $this->request->getPost('cmpid');
                $gotemployee = $this->restrictedcompanycommon->fetchemployee($getuserid,$user_group_id,$cmpid,$deptid);
//                /echo '<pre>'; print_r($gotemployee); exit;

                if(!empty($gotemployee))
                {
                    $data = array("logged" => true,'message' => 'User Found', "data" => $gotemployee);
                    $this->response->setJsonContent($data);
                }
                else
                {
                    $data = array("logged" => false,'message' => 'User Not Found');
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
    // **************************** employee restriction get employee end***************************

    // **************************** employee restriction insert start ***************************
    public function insertemployeerestrictionAction()
    {
        $this->view->disable();
        $getuserid = $this->session->loginauthspuserfront['id'];
        $cin = $this->session->memberdoccin;
        $user_group_id = $this->session->loginauthspuserfront['user_group_id'];
        //echo $getuserid.'*'.$cin;exit;
        $flag = 0;
        if($this->request->isPost() == true)
        {
            if($this->request->isAjax() == true)
            {
                if($user_group_id!=2)
                {
                    $getmasterid = $this->tradingrequestcommon->getmasterid($getuserid);
                    $getgroupid = $this->tradingrequestcommon->getmastergroupid($getmasterid['user_id']);
                    $getuserid=$getmasterid['user_id'];
                    $user_group_id=$getgroupid['master_group_id'];
                }
               
                $date=date('d-m-Y');
                //print_r($this->request->getPost());exit;
                $nameoflistedcomp   = $this->request->getPost('compid','trim');
                $nameofcomp   = $this->request->getPost('nameofcomp','trim');
                $deptaccess   = $this->request->getPost('deptaccess','trim');
                $empid   = $this->request->getPost('empbanned','trim');
                $periodfrom   = $this->request->getPost('perdresfrom','trim');
                $periodto   = $this->request->getPost('perdresto','trim');
                
                if(empty($nameoflistedcomp))
                {
                    $data = array("logged" => false,'message' => 'Please select company!!');
                    $this->response->setJsonContent($data);
                }
                else if(empty($periodfrom))
                {
                    $data = array("logged" => false,'message' => 'Period Of Restriction From should not empty!!');
                    $this->response->setJsonContent($data);
                }
                else if(strtotime($date) > strtotime($periodfrom))
                {
                      $data = array("logged" => false,'message' => 'Period Of Restriction From should be in future!!');
                      $this->response->setJsonContent($data);
                }
                else if(empty($periodto))
                {
                    if($this->request->getPost('perpetuity','trim') == 'perpetuity')
                    {
                        $flag = 1;                        
                    }
                    else
                    {
                        $data = array("logged" => false,'message' => 'Please Select Period Of Restriction To Or For Perpetuity!!');
                        $this->response->setJsonContent($data);
                    }
                    
                }
                else if(empty($periodto))
                {
                    $data = array("logged" => false,'message' => 'Period Of Restriction To should not empty!!');
                    $this->response->setJsonContent($data);
                }
                else if($periodto)
                {
                    if(strtotime($date) > strtotime($periodto))
                    {
                          $data = array("logged" => false,'message' => 'Period Of Restriction To should be in future!!');
                          $this->response->setJsonContent($data);
                    }
                    else if(strtotime($periodfrom) > strtotime($periodto))
                    {
                       $data = array("logged" => false,'message' => 'Period Of Restriction To should be Greater Than Period Of Restriction From!!');
                       $this->response->setJsonContent($data);
                    }
                    else
                    {
                        $flag = 1;
                    }
                }
                
                else
                {
                    $flag = 1;
                    
                }
                if($flag == 1)
                {
                  
                  $getres = $this->restrictedcompanycommon->insertemployeerestriction($getuserid,$user_group_id,$nameoflistedcomp,$nameofcomp,$deptaccess,$empid,$periodfrom,$periodto);
                  if($getres)
                  {
                      $mailsent = $this->restrictedcompanycommon->mailemprestriction($getuserid,$user_group_id,$nameoflistedcomp,$periodfrom,$periodto,$empid);
                  }
                  
                    // echo "checking form data";print_r($getres); exit;      
                    if($getres)
                    {
                        $data = array("logged" => true,'message' => 'Record Added','resdta' => $getres);
                        $this->response->setJsonContent($data);
                    }
                    else
                    {
                        $data = array("logged" => false,'message' => "Record Not Added..!!");
                        $this->response->setJsonContent($data);
                    }  
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
    // **************************** employee restriction insert end ***************************
    
    // **************************** employee restriction fetch for table start***************************
    public function fetchemprestrictedAction()
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
                $getres = $this->restrictedcompanycommon->fetchemprestricted($getuserid,$user_group_id);
                for($i=0;$i<sizeof($getres);$i++)
                {
                   $dept = $getres[$i]['deptaccess'];
                   $emp = $getres[$i]['employee'];
                   $empid[] = explode(',',$emp);
                   $getdept[] = $this->restrictedcompanycommon->getdepartment($dept);
                   $getemp[] = $this->restrictedcompanycommon->getemp($emp);
                   
                }
                if($getres)
                {
                    $data = array("logged" => true,'message' => 'Record Added','resdta' => $getres,'user_group_id'=>$user_group_id,'user_id'=>$getuserid,'deptname'=>$getdept,'empname'=>$getemp,'empid'=>$empid);
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
     public function allrestrctedAction()
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
              $getaccess =$this->adminmodulecommon->gatallaccessdetails($getuserid);
              
               if($user_group_id!=2)
                {
                    $getmasterid = $this->tradingrequestcommon->getmasterid($getuserid);
                    $getgroupid = $this->tradingrequestcommon->getmastergroupid($getmasterid['user_id']);
                    $getuserid=$getmasterid['user_id'];
                    $user_group_id=$getgroupid['master_group_id'];
                 }

                $getres = $this->restrictedcompanycommon->fetchemprestricted($getuserid,$user_group_id);
               
                for($i=0;$i<sizeof($getres);$i++)
                {
                   $dept = $getres[$i]['deptaccess'];
                   $emp = $getres[$i]['employee'];
                   $empid[] = explode(',',$emp);
                   $getdept[] = $this->restrictedcompanycommon->getdepartment($dept);
                   $getemp[] = $this->restrictedcompanycommon->getemp($emp);
                   
                }
                if($getres)
                {
                    $data = array("logged" => true,'message' => 'Record Added','resdta' => $getres,'user_group_id'=>$user_group_id,'user_id'=>$getuserid,'deptname'=>$getdept,'empname'=>$getemp,'empid'=>$empid,'getaccess'=>$getaccess);
                    $this->response->setJsonContent($data);
                }
                else
                {
                    $data = array("logged" => false,'message' => "Record Not Added..!!",'getaccess'=>$getaccess);
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

    // **************************** employee restriction fetch for table end***************************
    
    // **************************** employee restriction fetch for edit start***************************
    public function employeerestrictedforeditAction()
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
                $getres = $this->restrictedcompanycommon->employeerestrictedforedit($id);
                $getresdept = $this->restrictedcompanycommon->getDeptforedit($getres[0]['nameofcompany']);
                $getresemp = $this->restrictedcompanycommon->getempforedit($getres[0]['nameofcompany'],$getresdept);
                //print_r($getresemp);exit;
                for($i=0;$i<sizeof($getres);$i++)
                {
                   $dept = $getres[$i]['deptaccess'];
                   $emp = $getres[$i]['employee'];
                   $getdept[] = $this->restrictedcompanycommon->getdepartmentedit($dept);
                   $getemp[] = $this->restrictedcompanycommon->getempedit($emp);
                   
                }
                if($getres)
                {
                    $data = array("logged" => true,'message' => 'Record Added','data' => $getres,'user_group_id'=>$user_group_id,'deptname'=>$getdept,'empname'=>$getemp,'alldeptname'=>$getresdept,'allempname'=>$getresemp);
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
    // **************************** employee restriction fetch for edit end***************************
    
    // **************************** employee restriction Delete start***************************
     public function employeerestrictedfordeleteAction()
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
                $getres = $this->restrictedcompanycommon->employeerestrictedfordelete($id);
                
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
    // **************************** employee restriction Delete end***************************
    
      // **************************** employee restriction get department start *************************** 
    public function getDeptforeditAction()
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
                $id = $this->request->getPost('cmpid','trim');
                $getres = $this->restrictedcompanycommon->getDeptforedit($id);
                //print_r($getres);exit;
                if($getres)
                {
                    $data = array("logged" => true,'message' => 'Found','data'=>$getres);
                    $this->response->setJsonContent($data);
                }
                else
                {
                    $data = array("logged" => false,'message' => "Record Not Found..!!");
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
    // **************************** employee restriction get department end *************************** 
    
    // **************************** employee restriction get employee start*************************** 
    public function getallemployeeforeditAction()
    {
        $this->view->disable();
        $getuserid = $this->session->loginauthspuserfront['id'];
        $user_group_id = $this->session->loginauthspuserfront['user_group_id']; 
        $timeago = time();
        if($this->request->isPost() == true)
        {
            if($this->request->isAjax() == true)
            {
                $deptid    = $this->request->getPost('deptid');
                $cmpid    = $this->request->getPost('cmpid');
                $gotemployee = $this->restrictedcompanycommon->fetchemployee($getuserid,$user_group_id,$cmpid,$deptid);
//                /echo '<pre>'; print_r($gotemployee); exit;

                if(!empty($gotemployee))
                {
                    $data = array("logged" => true,'message' => 'User Found', "data" => $gotemployee);
                    $this->response->setJsonContent($data);
                }
                else
                {
                    $data = array("logged" => false,'message' => 'User Not Found');
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
    // **************************** employee restriction get employee end*************************** 
    
    // **************************** employee restriction update start***************************
    public function updateemprestrictionAction()
    {
        $this->view->disable();
        $getuserid = $this->session->loginauthspuserfront['id'];
        $cin = $this->session->memberdoccin;
        $user_group_id = $this->session->loginauthspuserfront['user_group_id'];
        //echo $getuserid.'*'.$cin;exit;
        $flag = 0;
        if($this->request->isPost() == true)
        {
            if($this->request->isAjax() == true)
            {
                $date=date('d-m-Y');
                //print_r($this->request->getPost());exit;
                $nameoflistedcomp   = $this->request->getPost('compid','trim');
                $nameofcomp   = $this->request->getPost('nameofcomp','trim');
                $deptaccess   = $this->request->getPost('deptaccess','trim');
                $empid   = $this->request->getPost('empbanned','trim');
                $perdresfrom   = $this->request->getPost('perdresfrom','trim');
                $perdresto   = $this->request->getPost('perdresto','trim');
                $id   = $this->request->getPost('tempid','trim');
                
                //echo "checking form data";print_r($this->request->getPost()); exit;
                if(empty($nameofcomp))
                {
                    $data = array("logged" => false,'message' => 'Please select company!!');
                    $this->response->setJsonContent($data);
                }
                else if(empty($perdresfrom))
                {
                    $data = array("logged" => false,'message' => 'Period Of Restriction From should not empty!!');
                    $this->response->setJsonContent($data);
                }
                else if(strtotime($date) > strtotime($perdresfrom))
                {
                      $data = array("logged" => false,'message' => 'Period Of Restriction From should be in future!!');
                      $this->response->setJsonContent($data);
                }
                else if(empty($perdresto))
                {
                    if($this->request->getPost('perpetuity','trim') == 'perpetuity')
                    {
                        $flag = 1;
                        
                    }
                    else
                    {
                        $data = array("logged" => false,'message' => 'Please Select Period Of Restriction To Or For Perpetuity!!');
                        $this->response->setJsonContent($data);
                    }
                    
                }
                else if(empty($perdresto))
                {
                    $data = array("logged" => false,'message' => 'Period Of Restriction To should not empty!!');
                    $this->response->setJsonContent($data);
                }
                    
                
                else if($perdresto)
                {
                    if(strtotime($date) > strtotime($perdresto))
                    {
                          $data = array("logged" => false,'message' => 'Period Of Restriction To should be in future!!');
                          $this->response->setJsonContent($data);
                    }
                    else if(strtotime($perdresfrom) > strtotime($perdresto))
                    {
                       $data = array("logged" => false,'message' => 'Period Of Restriction To should be Greater Than Period Of Restriction From!!');
                       $this->response->setJsonContent($data);
                    }
                    else
                    {
                        $flag = 1;
                    }
                }
                
                else
                {
                    $flag = 1;
                }
                if($flag == 1)
                {
                    $getres = $this->restrictedcompanycommon->updateemprestriction($getuserid,$user_group_id,$nameoflistedcomp,$nameofcomp,$deptaccess,$empid,$perdresfrom,$perdresto,$id);
                    if($getres)
                    {
                        $mailsent = $this->restrictedcompanycommon->mailemprestriction($getuserid,$user_group_id,$nameofcomp,$perdresfrom,$perdresto,$empid);
                    }
                    
                    //echo "checking form data";print_r($getres); exit;      
                    if($getres)
                    {
                        $data = array("logged" => true,'message' => 'Record Updated','data' => $getres);
                        $this->response->setJsonContent($data);
                    }
                    else
                    {
                        $data = array("logged" => false,'message' => "Record Not Updated..!!");
                        $this->response->setJsonContent($data);
                    }
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
    
    // **************************** employee restriction update end***************************

}

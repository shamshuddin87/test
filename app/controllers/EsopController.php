<?php 
class EsopController extends ControllerBase
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
    }
    
    public function viewesopAction()
    {
        $id = $_GET['esopid'];
        $unique = $_GET['uniqueid'];
        $this->view->esopid = base64_decode($id);
        $this->view->esopuniqueid = base64_decode($unique);
    }
    
    /*************   insert into ESOP start *************/
    public function insertesopAction()
    {
        $this->view->disable();
        $getuserid = $this->session->loginauthspuserfront['id'];
        $cin = $this->session->memberdoccin;
        $user_group_id = $this->session->loginauthspuserfront['user_group_id'];        
        $firstname = $this->session->loginauthspuserfront['firstname'];
        $lastname = $this->session->loginauthspuserfront['lastname'];
        
        if($this->request->isPost() == true)
        {
            if($this->request->isAjax() == true)
            { 
                $userfile_name = $_FILES['esopfile']['name'];
                //echo $userfile_name;exit;
                $userfile_tmp = $_FILES['esopfile']['tmp_name'];
                $userfile_size = $_FILES['esopfile']['size'];
                $userfile_type = $_FILES['esopfile']['type'];
                $filename = basename($_FILES['esopfile']['name']);
                //echo $filename;exit;
                
                $file_ext = $this->validationcommon->getfileext($filename);
                $upload_path = $this->esopDir."/";
                $large_imp_name = 'uploadedby-'.$firstname.'_'.$lastname.'_userid-'.$getuserid;
                $large_impfile_location = $upload_path.$large_imp_name.".".$file_ext;
                $uploadedornot = move_uploaded_file($userfile_tmp, $large_impfile_location);
                //echo $uploadedornot; exit;
                
                $uniqueid = md5(microtime().rand());
                

                $getresponse = $this->phpimportexpogen->insertesop($getuserid,$user_group_id,$large_impfile_location,$uniqueid);

               
                //print_r($employeecount);exit;
                
                if($getresponse)
                {
                    $data = array("logged" => true,'message' => 'Record Added Successful !!','data'=>$getresponse);
                    $this->response->setJsonContent($data);
                }
                else
                {
                    $data = array("logged" => false,'message' => 'Record Not Added !!');
                    $this->response->setJsonContent($data);
                }

                $this->response->send();            
            }
            else
            {
                exit('No direct script access allowed isAjax');
            }
        }
        else
        {
            return $this->response->redirect('errors/show404');
            exit('No direct script access allowed');
        }        
    }
    
    /*************   insert into ESOP end *************/
    
    /*************   fetch ESOP for table start *************/
    public function fetchesopAction()
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
                $getres = $this->esopcommon->fetchesop($getuserid,$user_group_id,$mainquery);

                
                /* start pagination */
                $rsstrt = ($pagenum-1) * $noofrows;
                $rslmt =' LIMIT '.$rsstrt.','.$noofrows;
                $rscnt=count($getres);
                $rspgs = ceil($rscnt/$noofrows);
                $pgndata = $this->elements->paginatndata($pagenum,$rspgs);
                $pgnhtml = $this->elements->paginationhtml($pagenum,$pgndata['start_loop'],$pgndata['end_loop'],$rspgs);
                
                $getresult = $this->esopcommon->fetchesop($getuserid,$user_group_id,$rslmt);
                //print_r($getres);exit;
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
    /*************   fetch ESOP for table end *************/
    
    /*************   fetch ESOP for viewesop table start *************/
    
    public function fetchesopforviewAction()
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
                $mainquery = '';
                $uniqueid = $this->request->getPost('esopuniqueid');
                $noofrows = $this->request->getPost('noofrows');
                $pagenum = $this->request->getPost('pagenum');
                $getres = $this->esopcommon->fetchesopforview($getuserid,$user_group_id,$uniqueid,$mainquery);
                 $employeecount = $this->esopcommon->getcount($getuserid,$user_group_id,$uniqueid);
                
                 /* start pagination */
                $rsstrt = ($pagenum-1) * $noofrows;
                $rslmt =' LIMIT '.$rsstrt.','.$noofrows;
                $rscnt=count($getres);
                $rspgs = ceil($rscnt/$noofrows);
                $pgndata = $this->elements->paginatndata($pagenum,$rspgs);
                $pgnhtml = $this->elements->paginationhtml($pagenum,$pgndata['start_loop'],$pgndata['end_loop'],$rspgs);
                
                $getresult = $this->esopcommon->fetchesopforview($getuserid,$user_group_id,$uniqueid,$rslmt);
                if($getresult)
                {
                    $data = array("logged" => true,'message' => 'Record Added','resdta' => $getresult,'user_group_id'=>$user_group_id,'user_id'=>$getuserid,"pgnhtml"=>$pgnhtml,'empcount' =>$employeecount);
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
    
    /*************   fetch ESOP for viewesop table end *************/
    
    /*************  save ESOP as Final start ***************/
    public function saveesopfinalAction()
    {
        $this->view->disable();
        $getuserid = $this->session->loginauthspuserfront['id'];
        $user_group_id = $this->session->loginauthspuserfront['user_group_id']; 
        
        if($this->request->isPost() == true)
        {
            if($this->request->isAjax() == true)
            {
                $uniqueid = $this->request->getPost('esopuniq');
                $getresponse = $this->esopcommon->saveesopfinal($getuserid,$user_group_id,$uniqueid); 
                $getinsummary = $this->esopcommon->inupintosummary($getresponse,$user_group_id); 
               
                if($getresponse['logged'] ===true)
                {
                    $data = array("logged" => true,'message' => 'Record Saved Successful !!','data'=>$getresponse);
                    $this->response->setJsonContent($data);
                }
                else
                {
                    $data = array("logged" => false,'message' => 'Record Not Saved !!');
                    $this->response->setJsonContent($data);
                }

                $this->response->send();            
            }
            else
            {
                exit('No direct script access allowed isAjax');
            }
        }
        else
        {
            return $this->response->redirect('errors/show404');
            exit('No direct script access allowed');
        }        
    }
    /*************  save ESOP as Final end ***************/
}

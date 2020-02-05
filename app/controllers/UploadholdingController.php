<?php 
class UploadholdingController extends ControllerBase
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
    
    public function viewholdingAction()
    {
        $id = $_GET['reconciid'];
        $unique = $_GET['uniqueid'];
        $dateofrecon = $_GET['dateofrecon'];
        $this->view->rtaid = base64_decode($id);
        $this->view->rtauniqueid = base64_decode($unique);
        $this->view->dateofrecon = base64_decode($dateofrecon);
    }
    
    public function insertholdingAction()
    {
        $this->view->disable();
        $getuserid = $this->session->loginauthspuserfront['id'];
        $cin = $this->session->memberdoccin;
        $user_group_id = $this->session->loginauthspuserfront['user_group_id'];        
        $firstname = $this->session->loginauthspuserfront['firstname'];
        $lastname = $this->session->loginauthspuserfront['lastname'];
        $date=date('d-m-Y');
        if($this->request->isPost() == true)
        {
            if($this->request->isAjax() == true)
            {
                $dtofhldng = $this->request->getPost('dtofhldng','trim');
                $typeofhldng = $this->request->getPost('typeofhldng','trim');

                if(strtotime($dtofhldng) > strtotime($date))
                {
                    $data = array("logged" => false,'message' => 'Date Should Be In Past');
                    $this->response->setJsonContent($data);
                }
                else
                {
                    $userfile_name = $_FILES['holdingfile']['name'];
                    $userfile_tmp = $_FILES['holdingfile']['tmp_name'];
                    $userfile_size = $_FILES['holdingfile']['size'];
                    $userfile_type = $_FILES['holdingfile']['type'];
                    $filename = basename($_FILES['holdingfile']['name']);
                    //echo $filename;exit;

                    $file_ext = $this->validationcommon->getfileext($filename);
                    $upload_path = $this->holdingDir."/";
                    $large_imp_name = 'uploadedby-'.$firstname.'_'.$lastname.'_userid-'.$getuserid;
                    $large_impfile_location = $upload_path.$large_imp_name.".".$file_ext;
                    $uploadedornot = move_uploaded_file($userfile_tmp, $large_impfile_location);
                    //echo $uploadedornot; exit;

                    $uniqueid = md5(microtime().rand());
                    $getresponse = $this->phpimportexpogen->insertholding($getuserid,$user_group_id,$large_impfile_location,$dtofhldng,$uniqueid,$typeofhldng);

                    //echo "checking response";print_r($chkuserexist); exit;

                    if($getresponse)
                    {
                        $data = array("logged" => true,'message' => 'Report Run Successful !!','data'=>$getresponse);
                        $this->response->setJsonContent($data);
                    }
                    else
                    {
                        $data = array("logged" => false,'message' => 'Problem in Report Run !!');
                        $this->response->setJsonContent($data);
                    }
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
    
    public function fetchholdingAction()
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
                $getres = $this->uploadholdingcommon->fetchholding($getuserid,$user_group_id,$mainquery);
                
                /* start pagination */
                $rsstrt = ($pagenum-1) * $noofrows;
                $rslmt =' LIMIT '.$rsstrt.','.$noofrows;
                $rscnt=count($getres);
                $rspgs = ceil($rscnt/$noofrows);
                $pgndata = $this->elements->paginatndata($pagenum,$rspgs);
                $pgnhtml = $this->elements->paginationhtml($pagenum,$pgndata['start_loop'],$pgndata['end_loop'],$rspgs);
                
                $getresult = $this->uploadholdingcommon->fetchholding($getuserid,$user_group_id,$rslmt);
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
    
    public function fetchholdingforviewAction()
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
                $uniqueid = $this->request->getPost('rtauniqueid');
                $dateofrecon = $this->request->getPost('dateofrecon');
                
                //$getresequty = $this->reconcilationcommon->fetchequityshare($getuserid,$user_group_id,$uniqueid,$dateofrecon);
                $getresult = $this->uploadholdingcommon->fetchholdingforview($getuserid,$user_group_id,$uniqueid,$mainquery);
                //$getpanusr = $this->reconcilationcommon->fetchpanusr();
                if($getresult)
                {
                    $data = array("logged" => true,'message' => 'Record Added','resdta' => $getresult,'user_group_id'=>$user_group_id,'user_id'=>$getuserid,'panlist'=>$getresult['panlist']);
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
   
    
}

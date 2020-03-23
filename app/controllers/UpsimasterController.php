<?php 
class UpsimasterController extends ControllerBase
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
        $usergroup =$this->session->loginauthspuserfront['user_group_id'];
        $gmnlog = $this->session->loginauthspuserfront;
 
        $this->view->alldpusers = $this->upsicommon->fetchalldpusr($uid,$usergroup,'all','');
        //print_r($this->view->alldpusers);exit;
    }

    public function addupsimasterAction()
    {
        $this->view->disable();
        $getuserid = $this->session->loginauthspuserfront['id'];
        $usergroup =$this->session->loginauthspuserfront['user_group_id'];
        if($this->request->isPost() == true)
        {
            if($this->request->isAjax() == true)
            {
                $data = $this->request->getPost();
                //print_r($data);exit;
                if(empty($data['upname']))
                {
                   $data = array("logged" => false,'message' => 'Please Enter Type of Upsi');
                   $this->response->setJsonContent($data); 
                }
                else if(empty($data['pstartdte']))
                {
                   $data = array("logged" => false,'message' => 'Please Select Project Start Date');
                   $this->response->setJsonContent($data); 
                }
                else if(empty($data['owner']))
                {
                   $data = array("logged" => false,'message' => 'Please Select Project Owner / Group Leader');
                   $this->response->setJsonContent($data); 
                }
                else
                {
                    //print_r($data);exit;
                   $result = $this->upsicommon->addupsi($getuserid,$usergroup,$data);

                    if($result)
                    {
                        $data = array("logged"=>true, 'message'=>'UPSI Created');
                        $this->response->setJsonContent($data);
                    }
                    else
                    {
                        $data = array("logged"=>false, 'message'=>'Something went wrong');
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

    public function getallupsietailAction()
    {
        $this->view->disable();
        $getuserid = $this->session->loginauthspuserfront['id'];
        $usergroup =$this->session->loginauthspuserfront['user_group_id'];
        if($this->request->isPost() == true)
        {
            if($this->request->isAjax() == true)
            {

                //----------------pagination start here--------------------------------------------
                $pagedata=$this->request->getPost();
                $noofrows=$pagedata['noofrows'];
                $pagenum=$pagedata['pagenum'];
                $rsstrt = ($pagenum-1) * $noofrows;
                $rslmt = 'ORDER BY ID DESC LIMIT '.$rsstrt.','.$noofrows;
                $mainqry='';

                $resultcount = $this->upsicommon->getallupsi($getuserid,$usergroup,$mainqry);
                $result = $this->upsicommon->getallupsi($getuserid,$usergroup,$rslmt);
                $rscnt=count($resultcount);
                $rspgs = ceil($rscnt/$noofrows);
                $pgndata = $this->elements->paginatndata($pagenum,$rspgs);
                $pgnhtml = $this->elements->paginationhtml($pagenum,$pgndata['start_loop'],$pgndata['end_loop'],$rspgs);

                if(!empty($result))
                {
                    $data = array("logged"=>true,"message"=>'Data fetch successfully',"data"=>$result,"pgnhtml"=>$pgnhtml,'userid'=>$getuserid,'usergrp'=>$usergroup);
                    $this->response->setJsonContent($data);
                }
                else
                {
                    $data = array("logged"=>false,"message"=>'something Went to wrong',"data"=>'');
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

    public function getsingleupsidetailAction()
    {
        $this->view->disable();
        $getuserid = $this->session->loginauthspuserfront['id'];
        $usergroup =$this->session->loginauthspuserfront['user_group_id'];
        if($this->request->isPost() == true)
        {
            if($this->request->isAjax() == true)
            {
                $getusername = '';
                $upsiid = $this->request->getPost('upsiid');
                $result = $this->upsicommon->getsingleupsi($upsiid);
                //print_r($result);exit;
                $dpuser = $result['connecteddps'];
                $getusername = $this->upsicommon->fetchdpuser($dpuser);
                // print_r($result);exit;
                if(!empty($result))
                {
                    $data = array("logged"=>true,"message"=>'Data fetch successfully',"data"=>$result,'dpusers'=>$getusername,'loggedinuser' => $getuserid);
                    $this->response->setJsonContent($data);
                }
                else
                {
                    $data = array("logged"=>false,"message"=>'something Went to wrong',"data"=>'','dpusers'=>'');
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

    public function updateupsiAction()
    {
        $this->view->disable();
        $getuserid = $this->session->loginauthspuserfront['id'];
        $user_group_id = $this->session->loginauthspuserfront['user_group_id'];
        $firstname = $this->session->loginauthspuserfront['firstname'];
        $lastname = $this->session->loginauthspuserfront['lastname'];
        $username = $this->session->loginauthspuserfront['username'];
        
       

        $timeago = time();
        if($this->request->isPost() == true)
        {
            if($this->request->isAjax() == true)
            {
                $updatedata = $this->request->getPost();
                //print_r($updatedata);exit;
                // if((!array_key_exists("connectdps",$updatedata) && !array_key_exists("upalldps",$updatedata)) && empty($_FILES['connecteddps']))
                // {
                //     $data = array("logged" => false,'message' => 'Please Select Atleast One Connected Dp OR upload file' );
                //     $this->response->setJsonContent($data);
                // }
                // else
                // {
                  
                    $exceldpids = array();
                    if(!empty($_FILES['connecteddps']))
                    {
                        $userfile_name = $_FILES['connecteddps']['name'];
                        //echo $userfile_name;exit;
                        $userfile_tmp = $_FILES['connecteddps']['tmp_name'];
                        $userfile_size = $_FILES['connecteddps']['size'];
                        $userfile_type = $_FILES['connecteddps']['type'];
                        $filename = basename($_FILES['connecteddps']['name']);
                        //echo $filename;exit;
                        $file_ext = $this->validationcommon->getfileext($filename);
                        $upload_path = $this->upsiconnectedDPDir.'/'.$getuserid.'_'.$firstname.'_'.$lastname;
                        if(!file_exists($upload_path)) 
                        {
                            mkdir($upload_path, 0777, true);
                        }
                        //echo $upload_path; exit;
                        $large_imp_name = '/'.$timeago.'_'.rand();               
                        //echo $large_imp_name."*".$file_ext;exit;
                        $large_impfile_location = $upload_path.$large_imp_name.".".$file_ext;
                        $uploadedornot = move_uploaded_file($userfile_tmp, $large_impfile_location);
                        //echo 'here';exit;
                        
                        $exceldpids = $this->phpimportexpogen->FetchconnectedDP($getuserid,$user_group_id,$large_impfile_location);
                        //print_r($exceldpids);exit;
                        if($exceldpids)
                        {

                            $result = $this->upsicommon->updateupsi($getuserid,$user_group_id,$updatedata,$exceldpids,$username);
                        }
                        else
                        {
                            $data = array("logged"=>false,"message"=>'Email id is not valid.');
                            $this->response->setJsonContent($data);
                            $this->response->send();
                            exit;
                        }
                    }
                    else
                    {
                        $result = $this->upsicommon->updateupsi($getuserid,$user_group_id,$updatedata,$exceldpids,$username);
                    }
                    
                    if($result)
                    {
                        $data = array("logged"=>true,"message"=>'Data Updated successfully..!!!');
                        $this->response->setJsonContent($data);
                    }
                    else
                    {
                        $data = array("logged"=>false,"message"=>'Data Not Updated..!!!');
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

  public function deleteupsiAction()
  {
       $this->view->disable();
        $getuserid = $this->session->loginauthspuserfront['id'];
        $usergroup =$this->session->loginauthspuserfront['user_group_id'];
        if($this->request->isPost() == true)
        {
            if($this->request->isAjax() == true)
            {
                

                $id = $this->request->getPost('delid');
                // print_r($id);exit;
               
                $result = $this->upsicommon->deleteupsi($id);
                // print_r($result);exit;
                if($result)
                {
                    $data = array("logged"=>true,"message"=>'Record Deleted successfully..!!!');
                    $this->response->setJsonContent($data);
                }
                else
                {
                    $data = array("logged"=>false,"message"=>'Something Went to Wrong..!!!');
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

    public function sendmailannounceAction()
    {
         $this->view->disable();
        $getuserid = $this->session->loginauthspuserfront['id'];
        $usergroup =$this->session->loginauthspuserfront['user_group_id'];
        if($this->request->isPost() == true)
        {
            if($this->request->isAjax() == true)
            {   $newarr=array();
                $projectowner=$this->request->getPost('prowner','trim');
                $dps=$this->request->getPost('cndps','trim');
                $upsiname=$this->request->getPost('upsiname','trim');
                $projstartdate=$this->request->getPost('projstartdate','trim');
                $enddate=$this->request->getPost('enddate','trim');
                $description=$this->request->getPost('description','trim');
                $sentby = $this->session->loginauthspuserfront['username'];
                if(empty($description) || $description=='null')
                {
                    $data = array("logged"=>false,"message"=>'Description Required..!!!');
                    $this->response->setJsonContent($data);
                    $this->response->send();
                    exit;
                }
                if($enddate=='null')
                {
                    $enddate='';
                }
               // print_r($sentby); exit;
               if($dps!='null')
               {  
                   
                   $dps=explode(",", $dps);
                   array_push($dps, $projectowner);
                   $newarr=$dps;
               }
               else
               {
                     $newarr=array("0"=>$projectowner);
               }
                
                $send = $this->upsicommon->sendannouncement($newarr,$upsiname,$projstartdate,$enddate,$description,$sentby);
                if($send==true)
                {

                     $data = array("logged"=>true,"message"=>'Mail Sent Successfully..!!!');
                     $this->response->setJsonContent($data);
                }
                else
                {
                   $data = array("logged"=>false,"message"=>'Mail Not Sent..!!!');
                    $this->response->setJsonContent($data);
                }

                 $this->response->send();

            }
        }
    }
    
    public function dpuserlistsAction()
    {
        $this->view->disable();
        $getuserid = $this->session->loginauthspuserfront['id'];
        $usergroup =$this->session->loginauthspuserfront['user_group_id'];
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
                    $userlist = $this->upsicommon->fetchalldpusr($getuserid,$usergroup,'one',$getsearchkywo);
                      
                    
                    $getcount = count($userlist);
                    //echo $getcount; exit;

                    if(!empty($userlist))
                    {
                        $data = array("logged" => true,'message' => 'Found!!!' ,'data'=> $userlist,'count'=> $getcount);
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
    

}

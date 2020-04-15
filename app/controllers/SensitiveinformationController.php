<?php 
class SensitiveinformationController extends ControllerBase
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
    
    public function recipientAction()
    {     
        $uid = $this->session->loginauthspuserfront['id'];
        $gmnlog = $this->session->loginauthspuserfront;
        $this->view->category = $this->sensitiveinformationcommon->categorydetails();

        //print_r($this->view->category);exit;       
    }
    
    public function infosharingAction()
    {     
        $uid = $this->session->loginauthspuserfront['id'];
        $gmnlog = $this->session->loginauthspuserfront;
        $upsiid = $this->session->upsitypeid;
        $this->view->getupsiname = $this->sensitiveinformationcommon->fetchupsitype($upsiid);
        $this->view->upsitype = $this->sensitiveinformationcommon->fetchupsitype($upsiid);
    }
    
    public function archive_infosharingAction()
    {
        $uid = $this->session->loginauthspuserfront['id'];
        $gmnlog = $this->session->loginauthspuserfront;
        $upsiid = $this->session->upsitypeid;
        $this->view->upsitype = $this->sensitiveinformationcommon->fetchupsitype($upsiid);
    }
    
    public function upsi_infosharingAction()
    {
        $uid = $this->session->loginauthspuserfront['id'];
        $gmnlog = $this->session->loginauthspuserfront;
    }
    
    // **************************** recipient insert start***************************
        
    public function insertrecipientAction()
    {
        $this->view->disable();
        $getuserid = $this->session->loginauthspuserfront['id'];
        $cin = $this->session->memberdoccin;
        $user_group_id = $this->session->loginauthspuserfront['user_group_id'];
        $firstname = $this->session->loginauthspuserfront['firstname'];
        $lastname = $this->session->loginauthspuserfront['lastname'];
        $timeago = time();
        if($this->request->isPost() == true)
        {
            if($this->request->isAjax() == true)
            {

                $category   = $this->request->getPost('category','trim');
              
                $othercate = $this->request->getPost('othercategory','trim');
                $department = $this->request->getPost('empcategory','trim');
                
                $entity   = $this->request->getPost('entity','trim');
                $name   = $this->request->getPost('name','trim');
                $identitynum   = $this->request->getPost('identitynum','trim');
                $phonenum   = $this->request->getPost('phonenum','trim');
                $mobilenum   = $this->request->getPost('mobilenum','trim');
                $designation   = $this->request->getPost('designation','trim');
                $email   = $this->request->getPost('email','trim');
                $pan   = $this->request->getPost('panentity','trim');


               
                $panvalidate = $this->elements->panvalidation($pan);
                
                if($panvalidate == false )
                {
                    $data = array("logged" => false,'message' => 'Please enter valid PAN number',);
                    $this->response->setJsonContent($data);
                    
                }
                else if(empty($email))
                {
                    $data = array("logged" => false,'message' => 'Please enter Email Address',);
                    $this->response->setJsonContent($data);
                }
                else
                {
                
                $filepath = '';
                $agreemntfilepath = '';
                if(!empty($_FILES["upload"]))
                {
                        $userfile_name = $_FILES['upload']['name'];
                        //echo $userfile_name;exit;
                        $userfile_tmp = $_FILES['upload']['tmp_name'];
                        $userfile_size = $_FILES['upload']['size'];
                        $userfile_type = $_FILES['upload']['type'];
                        $filename = basename($_FILES['upload']['name']);
                        //echo $filename;exit;
                        $filenm = explode('.', $filename);
                        $filenms[] = $filenm[0];
                        $file_ext = $this->validationcommon->getfileext($filename);
                        $upload_path = $this->recipientupload."/";  
                        //echo $upload_path;exit; 
                        $large_imp_name = 'Uploadedby-'.$firstname.'_'.$lastname.'_userid-'.$getuserid.'_timeago-'.$timeago;
                        $upload_filepath = $upload_path.$large_imp_name.".".$file_ext;
                        $uploadedornot = move_uploaded_file($userfile_tmp, $upload_filepath);
                        //echo $uploadedornot;exit;                        
                        $filepath = $upload_filepath;
                 }
                   if(!empty($_FILES["uploadagrm"]))
                   {
                        $userfile_name = $_FILES['uploadagrm']['name'];
                        //echo $userfile_name;exit;
                        $userfile_tmp = $_FILES['uploadagrm']['tmp_name'];
                        $userfile_size = $_FILES['uploadagrm']['size'];
                        $userfile_type = $_FILES['uploadagrm']['type'];
                        $filename = basename($_FILES['uploadagrm']['name']);
                        //echo $filename;exit;
                        $filenm = explode('.', $filename);
                        $filenms[] = $filenm[0];
                        $file_ext = $this->validationcommon->getfileext($filename);
                        $upload_path = $this->recipientupload."/";  
                        //echo $upload_path;exit; 
                        $large_imp_name = 'Uploadedby-'.$firstname.'_'.$lastname.'_userid-'.$getuserid.'_timeago-'.$timeago;
                        $upload_filepath = $upload_path.$large_imp_name.".".$file_ext;
                        $uploadedornot = move_uploaded_file($userfile_tmp, $upload_filepath);
                        //echo $uploadedornot;exit;                        
                        $agreemntfilepath = $upload_filepath;
                  }
                //print_r($agreemntfilepath);exit;
                  $getres = $this->sensitiveinformationcommon->insertrecipient($getuserid,$user_group_id,$category,$othercate,$entity,$name,$identitynum,$phonenum,$mobilenum,$designation,$email,$filepath,$agreemntfilepath,$pan,$department);
                    //echo "checking form data";print_r($getres); exit;      
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
    // **************************** recipient insert end***************************
    
   // **************************** recipient fetch for table start***************************
    public function fetchrecipientAction()
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
                $getres = $this->sensitiveinformationcommon->fetchrecipient($getuserid,$user_group_id);
                // print_r($getres);exit;
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
    // **************************** recipient fetch for table end*************************** 
    
    // **************************** recipient fetch for edit start ***************************
    public function fetchrecipientforeditAction()
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
                $getres = $this->sensitiveinformationcommon->fetchrecipientforedit($id);
                //print_r($getres);exit;
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
    // **************************** recipient fetch for edit end ***************************
    
    // **************************** recipient update start***************************
    public function updaterecipientAction()
    {
        $this->view->disable();
        $getuserid = $this->session->loginauthspuserfront['id'];
        $cin = $this->session->memberdoccin;
        $user_group_id = $this->session->loginauthspuserfront['user_group_id'];
        $firstname = $this->session->loginauthspuserfront['firstname'];
        $lastname = $this->session->loginauthspuserfront['lastname'];
        $timeago = time();
        //echo $getuserid.'*'.$cin;exit;
        if($this->request->isPost() == true)
        {
            if($this->request->isAjax() == true)
            {
                //echo "checking form data";print_r($this->request->getPost()); exit;
                $category   = $this->request->getPost('category','trim');
                
               $othrcategory = $this->request->getPost('othercategory','trim');
               $department = $this->request->getPost('empcategory','trim');
                
                $entity   = $this->request->getPost('entity','trim');
                $name   = $this->request->getPost('name','trim');
                $identitynum   = $this->request->getPost('identitynum','trim');
                $phonenum   = $this->request->getPost('phonenum','trim');
                $mobilenum   = $this->request->getPost('mobilenum','trim');
                $designation   = $this->request->getPost('designation','trim');
                $email   = $this->request->getPost('email','trim');
                $identityfile   = $this->request->getPost('identityfile','trim');
                $confiagrmnt   = $this->request->getPost('confiagrmnt','trim');
                $id   = $this->request->getPost('tempid','trim');
                $pan = $this->request->getPost('panentity','trim');
                
                //echo "checking form data";print_r($this->request->getPost()); exit;
                $filepath = '';
                $agreemntfilepath = '';
                $panvalidate = $this->elements->panvalidation($pan);
                //print_r($panvalidate);exit;
                
                if($panvalidate == false )
                {

                    $data = array("logged" => false,'message' => 'Please enter valid PAN number',);
                    $this->response->setJsonContent($data);
                    
                }
                else if(empty($email))
                {
                    $data = array("logged" => false,'message' => 'Please enter Email Address',);
                    $this->response->setJsonContent($data);
                }
                else
                {
                if(!empty($_FILES["upload"]))
                {
                        $userfile_name = $_FILES['upload']['name'];
                        //echo $userfile_name;exit;
                        $userfile_tmp = $_FILES['upload']['tmp_name'];
                        $userfile_size = $_FILES['upload']['size'];
                        $userfile_type = $_FILES['upload']['type'];
                        $filename = basename($_FILES['upload']['name']);
                        //echo $filename;exit;
                        $filenm = explode('.', $filename);
                        $filenms[] = $filenm[0];
                        $file_ext = $this->validationcommon->getfileext($filename);
                        $upload_path = $this->recipientupload."/";  
                        //echo $upload_path;exit; 
                        $large_imp_name = 'Uploadedby-'.$firstname.'_'.$lastname.'_userid-'.$getuserid.'_timeago-'.$timeago;
                        $upload_filepath = $upload_path.$large_imp_name.".".$file_ext;
                        $uploadedornot = move_uploaded_file($userfile_tmp, $upload_filepath);
                        //echo $uploadedornot;exit;                        
                        $filepath = $upload_filepath;
                }
                else
                {
                    $filepath = $identityfile;
                }
                if(!empty($_FILES["uploadagrm"]))
                {
                    $userfile_name = $_FILES['uploadagrm']['name'];
                    //echo $userfile_name;exit;
                    $userfile_tmp = $_FILES['uploadagrm']['tmp_name'];
                    $userfile_size = $_FILES['uploadagrm']['size'];
                    $userfile_type = $_FILES['uploadagrm']['type'];
                    $filename = basename($_FILES['uploadagrm']['name']);
                    //echo $filename;exit;
                    $filenm = explode('.', $filename);
                    $filenms[] = $filenm[0];
                    $file_ext = $this->validationcommon->getfileext($filename);
                    $upload_path = $this->recipientupload."/";  
                    //echo $upload_path;exit; 
                    $large_imp_name = 'Uploadedby-'.$firstname.'_'.$lastname.'_userid-'.$getuserid.'_timeago-'.$timeago;
                    $upload_filepath = $upload_path.$large_imp_name.".".$file_ext;
                    $uploadedornot = move_uploaded_file($userfile_tmp, $upload_filepath);
                    //echo $uploadedornot;exit;                        
                    $agreemntfilepath = $upload_filepath;
                }
                 else
                {
                    $agreemntfilepath = $confiagrmnt;
                }
                //print_r($agreemntfilepath);exit;
                
                
                $getres = $this->sensitiveinformationcommon->updaterecipient($getuserid,$user_group_id,$category,$othrcategory,$entity,$name,$identitynum,$phonenum,$mobilenum,$designation,$email,$filepath,$agreemntfilepath,$id,$pan,$department);
                    
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
     // **************************** recipient update end***************************
    
    // **************************** recipient Delete start ***************************
     public function recipientfordeleteAction()
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
                $getres = $this->sensitiveinformationcommon->recipientfordelete($id);
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
    
    // **************************** recipient Delete end ***************************
    
    // **************************** infosharing insert start ***************************
        
    public function insertinfosharingAction()
    {
        $this->view->disable();
        $getuserid = $this->session->loginauthspuserfront['id'];
        $cin = $this->session->memberdoccin;
        $user_group_id = $this->session->loginauthspuserfront['user_group_id'];
        $firstname = $this->session->loginauthspuserfront['firstname'];
        $nameoflogged = $this->session->loginauthspuserfront['username'];
        //print_r($fullname);exit;
        $lastname = $this->session->loginauthspuserfront['lastname'];
        $loggedemail = $this->session->loginauthspuserfront['email'];
        $timeago = time();
        $todaydate=date('d-m-Y');
        if($this->request->isPost() == true)
        {
            if($this->request->isAjax() == true)
            {
                //print_r($this->request->getPost());exit;
                $name   = $this->request->getPost('name','trim');
                $upsitypeid   = $this->request->getPost('upsitypeid','trim');
                $flag=0;

                $date   = $this->request->getPost('date','trim');
                $date1 =  date("d-m-Y", strtotime($date));
                $stdate=new DateTime($date);
                $time = $this->request->getPost('time_of_data','trim');
                $email = $this->request->getPost('emailforsendmail','trim');

                //print_r($email);exit;
                $enddate   = $this->request->getPost('enddate','trim');
                $upsiname = $this->request->getPost('selectupsi','trim');
                $endchkdate= new DateTime($enddate);
                $mytoday=new DateTime($todaydate);
                if(!empty($enddate) )
                {
                    if($endchkdate>$stdate && $mytoday>=$endchkdate)
                    {
                        $flag=0;
                    }
                    else
                    {
                        $flag=1;
                    }
                }

                $datashared   = $this->request->getPost('datashared','trim');
                //$purpose   = $this->request->getPost('purpose','trim');
                $file   = $this->request->getPost('upload','trim');
                $category   = $this->request->getPost('category','trim');
                $recipientid   = $this->request->getPost('recid','trim');
                $recipienttype   = $this->request->getPost('rectype','trim');
                $filepath = '';
                //print_r($time);
                if(empty($date))
                {
                    $data = array("logged" => false,'message' => 'Please select Date!!');
                    $this->response->setJsonContent($data);
                }
                else if($flag)
                {
                     $data = array("logged" => false,'message' => 'Please Check Difference Between information Sharing Date And End Date');
                    $this->response->setJsonContent($data);
                }
                else if(strtotime($date)>strtotime($todaydate))
                {
                    $data = array("logged" => false,'message' => 'Date of Information Sharing Should Be In Past!!');
                    $this->response->setJsonContent($data);
                }
                else if(empty($time))
                {
                    $data = array("logged" => false,'message' => 'Please select Time!!');
                    $this->response->setJsonContent($data);
                }
                else if(empty(strtotime($time)))
                {
                    $data = array("logged" => false,'message' => 'Time Cannot Exceed 24:59!!');
                    $this->response->setJsonContent($data);
                }

                else
                {
                    $filepath = '';
                    if(!empty($_FILES["upload"]))
                    {
                        $filepath = array();
                        for($i=0; $i < sizeof($_FILES['upload']['name']); $i++)
                        {
                            if(!empty($_FILES["upload"]['name'][$i]))
                            {
                                // print_r($_FILES['othrdoc']['name'][$i]); exit;
                                $userfile_name = $_FILES['upload']['name'][$i];
                                $userfile_tmp = $_FILES['upload']['tmp_name'][$i];
                                $userfile_size = $_FILES['upload']['size'][$i];
                                $userfile_type = $_FILES['upload']['type'][$i];
                                $filename = basename($_FILES['upload']['name'][$i]);
                                $filenm = explode('.', $filename);
                                $filenms[] = $filenm[0];
                                $file_ext = $this->validationcommon->getfileext($filename);
                                $upload_path = $this->infoshareattachment."/";  
                                //echo $upload_path;exit; 
                                $large_imp_name = 'Uploadedby-'.$firstname.'_'.$lastname.'_userid-'.$getuserid.'_timeago-'.$timeago;
                                $upload_filepath = $upload_path.$large_imp_name.".".$file_ext;
                                $uploadedornot = move_uploaded_file($userfile_tmp, $upload_filepath);
                                //-----------------Encrypt File------------------------//
                                $content=file_get_contents($upload_filepath);
                                $pdfencrypt=$upload_path.time().".pdf";
                                $encrypt=$this->encryptdecryptcommon->getpdffileencrypt($content,$pdfencrypt);
                                if(isset($encrypt))
                                {
                                    unlink($upload_filepath);
                                }
                                $filepath[] = $encrypt;
                            }
                            else
                            {
                                $data = array("logged" => false,'message' => "Please select file..!!");
                                $this->response->setJsonContent($data);
                                $this->response->send();
                                exit;
                            }
                            
                        }
                        $filepath = implode(',',$filepath);
                            
                        
                    }
                  //print_r($filepath);exit;
                  $getres = $this->sensitiveinformationcommon->insertinfosharing($getuserid,$user_group_id,$name,$date1,$time,$enddate,$datashared,$category,$upsitypeid,$recipientid,$recipienttype,$filepath,$email,$upsiname,$loggedemail,$nameoflogged);
                  //print_r($getres);exit;
                    
                  if($getres == true)
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
    //----------------------------GET DECRYPT FILE ----------------------//

        public function getdecryptedfileAction()
      {
            $this->view->disable();
            $getuserid = $this->session->loginauthspuserfront['id'];
            $cin = $this->session->memberdoccin;
            $user_group_id = $this->session->loginauthspuserfront['user_group_id'];

              if($this->request->isPost() == true)
             {
                if($this->request->isAjax() == true)
                {
                     $filepath   = $this->request->getPost('filepath','trim');
                     if(!empty($filepath))
                    {
                      $decrypt=$this->encryptdecryptcommon->getdecrptedinfofile($filepath);
                      if(!empty($decrypt))
                    {
                        $data = array("logged" => true,'message' => 'File Decrypted Successfully','filepath' => $decrypt);
                        $this->response->setJsonContent($data);
                    }
                    else
                    {
                        $data = array("logged" => false,'message' => "Some Thing Went To Wrong..!!!");
                        $this->response->setJsonContent($data);
                    } 
                       $this->response->send();
                  }
                }
             }

      }


          public function unlinkgivenfileAction()
        {
            $this->view->disable();
            $getuserid = $this->session->loginauthspuserfront['id'];
            $cin = $this->session->memberdoccin;
            $user_group_id = $this->session->loginauthspuserfront['user_group_id'];

              if($this->request->isPost() == true)
             {
                if($this->request->isAjax() == true)
                {
                   $filepath=$this->request->getPost('filepath');
                   if(!empty($filepath))
                   {
                      $status=unlink($filepath);
                    }
                    
                      if($status)
                    {
                        $data = array("logged" => true,'message' => 'File Delete Successfully');
                        $this->response->setJsonContent($data);
                    }
                    else
                    {
                        $data = array("logged" => false,'message' => "Some Thing Went To Wrong..!!!");
                        $this->response->setJsonContent($data);
                    } 
                       $this->response->send();
                }
             }

       }
     


    //----------------------------------------------------------------------------//

    // **************************** infosharing insert end ***************************
    
    // **************************** infosharing fetch for table start***************************
    public function fetchinfosharingAction()
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
                $upsitypeid = $this->request->getPost('upsitypeid');
                $mainquery = '';
                $getres = $this->sensitiveinformationcommon->fetchinfosharing($getuserid,$user_group_id,$upsitypeid,$mainquery);
                /* start pagination */
                $rsstrt = ($pagenum-1) * $noofrows;
                $rslmt =' LIMIT '.$rsstrt.','.$noofrows;
                $rscnt=count($getres);
                $rspgs = ceil($rscnt/$noofrows);
                $pgndata = $this->elements->paginatndata($pagenum,$rspgs);
                $pgnhtml = $this->elements->paginationhtml($pagenum,$pgndata['start_loop'],$pgndata['end_loop'],$rspgs);
                
                $getres = $this->sensitiveinformationcommon->fetchinfosharing($getuserid,$user_group_id,$upsitypeid,$rslmt);
                $getaccess =$this->adminmodulecommon->gatallaccessdetails($getuserid);
                //print_r($getres);exit;
                if($getres)
                {
                    $data = array("logged" => true,'message' => 'Record Added','resdta' =>$getres,'getaccess'=>$getaccess,'user_group_id'=>$user_group_id,"pgnhtml"=>$pgnhtml);
                    $this->response->setJsonContent($data);
                }
                else
                {
                    $data = array("logged" => false,'getaccess'=>$getaccess,'message' => "Record Not Added..!!","pgnhtml"=>$pgnhtml);
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
    
    // **************************** infosharing fetch for table end***************************
    
    // **************************** infosharing fetch for edit start***************************
    public function fetchinfosharingforeditAction()
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
                $getres = $this->sensitiveinformationcommon->fetchinfosharingforedit($id);
                //print_r($getres);exit;
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
    
    // **************************** infosharing fetch for edit end***************************
    
    // **************************** infosharing update start***************************
    public function updateinfosharingAction()
    {
        $this->view->disable();
        $getuserid = $this->session->loginauthspuserfront['id'];
        $cin = $this->session->memberdoccin;
        $user_group_id = $this->session->loginauthspuserfront['user_group_id'];
        $firstname = $this->session->loginauthspuserfront['firstname'];
        $lastname = $this->session->loginauthspuserfront['lastname'];
        $timeago = time();
        //echo $getuserid.'*'.$cin;exit;
        if($this->request->isPost() == true)
        {
            if($this->request->isAjax() == true)
            {
                //echo "checking form data";print_r($this->request->getPost()); exit;
                $name   = $this->request->getPost('name','trim');
                $date   = $this->request->getPost('date','trim');
                $date1 =  date("d-m-Y", strtotime($date));
                $datashared   = $this->request->getPost('datashared','trim');
                $purpose   = $this->request->getPost('purpose','trim');
                $file   = $this->request->getPost('upload','trim');
                $category   = $this->request->getPost('category','trim');
                $id   = $this->request->getPost('tempid','trim');
                $filepath = '';
                if(empty($date))
                {
                    $data = array("logged" => false,'message' => 'Please select Date!!');
                    $this->response->setJsonContent($data);
                }
                else if($file)
                {
                    $data = array("logged" => false,'message' => 'Please select Attachment!!');
                    $this->response->setJsonContent($data);
                }
                else
                {
                //echo "checking form data";print_r($this->request->getPost()); exit;
                    $filepath = '';
                    if(!empty($_FILES["upload"]))
                    {
                            $userfile_name = $_FILES['upload']['name'];
                            //echo $userfile_name;exit;
                            $userfile_tmp = $_FILES['upload']['tmp_name'];
                            $userfile_size = $_FILES['upload']['size'];
                            $userfile_type = $_FILES['upload']['type'];
                            $filename = basename($_FILES['upload']['name']);
                            //echo $filename;exit;
                            $filenm = explode('.', $filename);
                            $filenms[] = $filenm[0];
                            $file_ext = $this->validationcommon->getfileext($filename);
                            $upload_path = $this->infoshareattachment."/";  
                            //echo $upload_path;exit; 
                            $large_imp_name = 'Uploadedby-'.$firstname.'_'.$lastname.'_userid-'.$getuserid.'_timeago-'.$timeago;
                            $upload_filepath = $upload_path.$large_imp_name.".".$file_ext;
                            $uploadedornot = move_uploaded_file($userfile_tmp, $upload_filepath);
                            //echo $uploadedornot;exit;                        
                            $filepath = $upload_filepath;
                        
                     }
                        $getres = $this->sensitiveinformationcommon->updateinfosharing($getuserid,$user_group_id,$name,$date1,$datashared,$purpose,$filepath,$category,$id);

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
    // **************************** infosharing update end***************************
    
    // **************************** recipient Delete start***************************
     public function infosharingfordeleteAction()
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
                $getres = $this->sensitiveinformationcommon->infosharingfordelete($id);
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
    // **************************** recipient Delete end***************************
    
     // **************************** info sharing search name start ***************************
    
    public function namelistsAction()
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
                $namelistemail = array();
                $searchvallist = $this->request->getPost('searchvallist');
                //echo  $searchvallist;exit;
                $searchlist = $this->filter->sanitize($searchvallist, "trim");
                $searchlist = $this->filter->sanitize($searchvallist, "string");
                if(preg_match("/[A-Za-z]+/", $searchlist))
                {

                    $getsearchkywo = $searchlist;
                    $limit = 10;
                    $receipientlist = array();
                    $receipientemailid = array();
                    $softuserlist = array();
                    
                    $receipientlist = $this->sensitiveinformationcommon->namedetails($getuserid,$user_group_id,$getsearchkywo);  
                    //print_r($namelist);exit;
                    foreach ($receipientlist as $n) 
                    {
                        if(!empty($n['email']))
                        {
                             $receipientemailid[] = $n['email'];
                        }
                      
                    }
                    
                    $softuserlist = $this->sensitiveinformationcommon->itnamedetails($getuserid,$user_group_id,$getsearchkywo,$receipientemailid); 
                    //print_r($softuserlist);exit;
                    if(empty($receipientlist) && !empty($softuserlist))
                    {
                        $finallist = $softuserlist;
                    }
                    else if(!empty($receipientlist) && empty($softuserlist))
                    {
                        $finallist = $receipientlist;
                    }
                    else if(!empty($receipientlist) && !empty($softuserlist))
                    {
                        $finallist = array_merge($receipientlist,$softuserlist);
                    }
                    else
                    {
                        $finallist = array();
                    }
                    //print_r($finallist);exit;
//                    $finallist1 = array_push($namelist,$namelist1);
//                    $finallist1 = array_push($namelist,$namelist1);
//                    $finallistnew = array_unique($namelist);
//                    $finallist = array_shift($finallistnew);
//                    print_r($finallist1);
                    //print_r($abc);exit;

                  
                    if(!empty($finallist))
                    {
                        $getcount = count($finallist);
                    }
                    else
                    {
                        $getcount = 0;
                    }
                    //echo $getcount; exit;

                    if(!empty($finallist))
                    {
                        $data = array("logged" => true,'message' => 'Found!!!' ,'data'=> $finallist,'count'=> $getcount);
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
    // **************************** info sharing search name end ***************************
    
    // ------------------ fetch trail data -----------------
    public function fetchinfotrailAction()
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
                $shareid = $this->request->getPost('infoid');
                $getres = $this->sensitiveinformationcommon->fetchinfotrail($getuserid,$user_group_id,$shareid);
                //print_r($getres);exit;
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
    // ------------------ fetch trail data -----------------
    
    
    // **************************** infosharing end date update start***************************
    public function updateenddateAction()
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
                $todaydate=date('d-m-Y');
                $enddate   = $this->request->getPost('enddate','trim');
                $id   = $this->request->getPost('tempid','trim');


                  $getres = $this->sensitiveinformationcommon->fetchinfodata($id);
                  $mytoday=new DateTime($todaydate);
                  $endchkdate=new DateTime($enddate);
                  $stdate=new DateTime($getres['sharingdate']);
                    
                        if($endchkdate>$stdate && $mytoday>=$endchkdate)
                        {
                          $flag=0;
                        }
                        else
                        {
                          $flag=1;
                        }
                



                if(empty($enddate))
                {
                    $data = array("logged" => false,'message' => 'Please select End Date!!');
                    $this->response->setJsonContent($data);
                }
                else if($flag)
                {
                    $data = array("logged" => false,'message' => 'Please Check Difference Between End Date And Start Date...!!!');
                    $this->response->setJsonContent($data);
                }
                else
                {
                    $getres = $this->sensitiveinformationcommon->updateenddate($getuserid,$user_group_id,$id,$enddate);

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
    // **************************** infosharing end date update end***************************
    
    // **************************** infosharing fetch for Archive table start***************************
    public function fetcharchiveinfosharingAction()
    {
        $this->view->disable();
        $getuserid = $this->session->loginauthspuserfront['id'];
        $cin = $this->session->memberdoccin;
        $user_group_id = $this->session->loginauthspuserfront['user_group_id'];
        //echo $getuserid.'*'.$cin;exit;
        $upsitype = $this->session->upsitypeid;

        if($this->request->isPost() == true)
        {
            if($this->request->isAjax() == true)
            {
                $noofrows=$this->request->getPost('noofrows');
                $pagenum=$this->request->getPost('pagenum');
                $mainquery = '';
                $getres = $this->sensitiveinformationcommon->fetcharchiveinfosharing($getuserid,$user_group_id,$upsitype,$mainquery);
                /* start pagination */
                $rsstrt = ($pagenum-1) * $noofrows;
                $rslmt =' LIMIT '.$rsstrt.','.$noofrows;
                $rscnt=count($getres);
                $rspgs = ceil($rscnt/$noofrows);
                $pgndata = $this->elements->paginatndata($pagenum,$rspgs);
                $pgnhtml = $this->elements->paginationhtml($pagenum,$pgndata['start_loop'],$pgndata['end_loop'],$rspgs);
                
                $getres = $this->sensitiveinformationcommon->fetcharchiveinfosharing($getuserid,$user_group_id,$upsitype,$rslmt);
                //print_r($getres);exit;
                if($getres)
                {
                    $data = array("logged" => true,'message' => 'Record Added','resdta' => $getres,'user_group_id'=>$user_group_id,"pgnhtml"=>$pgnhtml);
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


     public function getaccessAction()
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
                // print_r($getaccess);exit;
              
                if(!empty($getaccess))
                {
                    $data = array("logged" => true,'message' => 'Record Added','adminaccess' => $getaccess[0]);
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

    // public function fetchiddataAction()
    // {
    //     $this->view->disable();
    //     $getuserid = $this->session->loginauthspuserfront['id'];         
    //     $user_group_id = $this->session->loginauthspuserfront['user_group_id'];
    //     $cin = $this->session->memberdoccin;  
    //     //echo '<pre>'; print_r($getresult); exit;
    //     $timeago = time();

    //     if($this->request->isPost() == true)
    //     {
    //         if($this->request->isAjax() == true)
    //         {
    //             $dhanushya  = $this->request->getPost('dhanushya');
    //             $baan       = $this->request->getPost('baan');
    //             $nishana    = $this->request->getPost('nishana');
    //             //echo $dhanushya.'*'.$baan.'*'.$nishana; exit;
                
    //             $getresult = $this->allquerycommon->fetchiddata($getuserid,$dhanushya,$baan,$nishana);
    //             //print_r($getresult);exit;
    //             if(!empty($getresult))
    //             {
    //                 $data = array("logged"=>true, 'message'=>'Got Result', 'data'=>$getresult);
    //                 $this->response->setJsonContent($data);
    //             }
    //             else
    //             {
    //                 $data = array("logged" => false, 'message'=>'No Result', 'data'=>'');
    //                 $this->response->setJsonContent($data);
    //             }
    //             $this->response->send();
    //         }
    //         else
    //         {
    //             exit('No direct script access allowed to this area');
    //             $connection->close();
    //         }
    //     }
    //     else
    //     {
    //         return $this->response->redirect('errors/show404');
    //         exit('No direct script access allowed');
    //     }
    // }
    // **************************** infosharing fetch for Archive table end***************************
    
     // ------------- UPSI TYPE fetch START
    public function fetchupsiinfoAction()
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
                $noofrows = $this->request->getPost('noofrows');
                $pagenum = $this->request->getPost('pagenum');
                $mainquery = '';
                
                $getres = $this->sensitiveinformationcommon->fetchupsiinfo($getuserid,$user_group_id,'',$mainquery);
                
                /* start pagination */
                $rsstrt = ($pagenum-1) * $noofrows;
                $rslmt =' LIMIT '.$rsstrt.','.$noofrows;
                $rscnt=count($getres);
                $rspgs = ceil($rscnt/$noofrows);
                $pgndata = $this->elements->paginatndata($pagenum,$rspgs);
                $pgnhtml = $this->elements->paginationhtml($pagenum,$pgndata['start_loop'],$pgndata['end_loop'],$rspgs);

                $getaccess =$this->adminmodulecommon->gatallaccessdetails($getuserid);
                
                $getresult = $this->sensitiveinformationcommon->fetchupsiinfo($getuserid,$user_group_id,'',$rslmt);
              
                if($getresult)
                {
                    $data = array("logged" => true,'message' => 'Record Added','resdta' => $getres,'user_group_id'=>$user_group_id,"pgnhtml"=>$pgnhtml,'access'=>$getaccess);
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
    // ------------- UPSI TYPE fetch END 
    
    /* ----------- SET SESSION of UpsiTypeID start -----------*/
    public function upsiidSETsessionAction()
    {
        $this->view->disable();
        $getuserid = $this->session->loginauthspuserfront['id'];
        $cin = $this->session->memberdoccin;
        $user_group_id = $this->session->loginauthspuserfront['user_group_id'];
        
        if($this->request->isPost() == true)
        {
            if($this->request->isAjax() == true)
            {   
                $upsitypeid = $this->request->getPost('upsitypeid');                             
                //echo $upsitypeid; exit;
                if(!empty($upsitypeid))
                {
                    // ----------- userid_session Start -----------
                    $upsitypeid = $this->session->set('upsitypeid',$upsitypeid);
                    $upsitypeid =  $this->session->upsitypeid; 
                    // ----------- userid_session End -----------
                    
                }
                //echo "<pre>";print_r($this->session->userid);exit;
              
                if(!empty($upsitypeid))
                {
                    $data = array("logged" => true, 'message' => 'Session SET');
                    $this->response->setJsonContent($data);
                }
                else
                {
                    $data = array("logged" => false, 'message' => "Session Not SET");
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
    /* ----------- SET SESSION of UpsiTypeID end -----------*/

    /* ---------- Search for user masters start ---------- */
    public function fetchUsersAction()
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
                $searchvallist = $this->request->getPost('search');
                //echo  $searchvallist;exit;
                $searchlist = $this->filter->sanitize($searchvallist, "trim");
                $searchlist = $this->filter->sanitize($searchvallist, "string");
                if(preg_match("/[A-Za-z]+/", $searchlist))
                {
                    $getsearchkywo = $searchlist;
                    $limit = 10;
                    //echo $getsearchkywo;exit;
                    $userlist = array();
                    
                    $userlist = $this->sensitiveinformationcommon->userdetails($getuserid,$user_group_id,$getsearchkywo);  

                    $getcount = count($userlist);
                    //print_r($userlist); exit;

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
    /* ---------- Search for user masters End ---------- */
    
}

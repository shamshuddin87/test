<?php 
class SebiController extends ControllerBase
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
        $getuserid = $this->session->loginauthspuserfront['id'];
        $user_group_id = $this->session->loginauthspuserfront['user_group_id'];
        $gmnlog = $this->session->loginauthspuserfront;
    }
    
    public function formbAction()
    {
        $getuserid = $this->session->loginauthspuserfront['id'];
        $user_group_id =  $this->session->loginauthspuserfront['user_group_id'];
        $getdataofuser = $this->sebicommon->fetchdetailsofuser($getuserid);   //fetch name mobile of usr
        $getuserdata = $this->sebicommon->fetchuserdata($getuserid);   //fetch address pan of usr
        $this->view->name = $getdataofuser['fullname'];
        $this->view->cntctno = $getuserdata['mobileno'];
        $this->view->approverid = $getdataofuser['approvid'];
        $this->view->pan = $getuserdata['pan'];
        $this->view->address = $getuserdata['address'];
        $this->view->category = $this->sebicommon->fetchcategory();   //fetch category of usr
        $this->view->security = $this->sebicommon->fetchsecutype();   //fetch security of usr
        $this->view->company = $this->sebicommon->fetchcmpmstr($getuserid,$user_group_id);   //fetch cmp name from mstr
    }
    
    public function formcAction()
    {
        $getuserid = $this->session->loginauthspuserfront['id'];
        $user_group_id = $this->session->loginauthspuserfront['user_group_id'];
        $getdataformcuser = $this->sebicommon->getformbdata($getuserid);   //fetch latest data of formb
        $getdatauser = $this->sebicommon->getusersdata($getuserid);   //fetch user data of formb
        //print_r($getdatauser);exit;
        $getformcmodedetail = $this->sebicommon->getformcmode();   //fetch mode data of formc
        $this->view->modeacqui = $getformcmodedetail;
        $this->view->name = $getdatauser['fullname'];
        $this->view->cntctno = $getdatauser['mobileno'];
        $this->view->approverid = $getdatauser['approvid'];
        $this->view->pan = $getdatauser['pan'];
        $this->view->address = $getdatauser['address'];
        $this->view->cin = $getdataformcuser['cin'];
        $this->view->category = $this->sebicommon->fetchcategory();   //fetch category of usr
        $this->view->security = $this->sebicommon->fetchsecutype();   //fetch security of usr
        $this->view->company = $this->sebicommon->fetchcmpmstr($getuserid,$user_group_id);   //fetch cmp name from mstr
    }
    public function formdAction()
    {
        $getuserid = $this->session->loginauthspuserfront['id'];
        $user_group_id = $this->session->loginauthspuserfront['user_group_id'];
        $getdataformcuser = $this->sebicommon->getformbdata($getuserid);   //fetch latest data of formb
        $getdatauser = $this->sebicommon->getusersdata($getuserid);   //fetch user data of formb
        //print_r($getdatauser);exit;
        $getformcmodedetail = $this->sebicommon->getformcmode();   //fetch mode data of formc
        $this->view->modeacqui = $getformcmodedetail;
        $this->view->name = $getdatauser['fullname'];
        $this->view->cntctno = $getdatauser['mobileno'];
        $this->view->approverid = $getdatauser['approvid'];
        $this->view->pan = $getdatauser['pan'];
        $this->view->address = $getdatauser['address'];
        $this->view->cin = $getdataformcuser['cin'];
        $this->view->category = $this->sebicommon->fetchcategory();   //fetch category of usr
        $this->view->security = $this->sebicommon->fetchsecutype();   //fetch security of usr
        $this->view->company = $this->sebicommon->fetchcmpmstr($getuserid,$user_group_id);   //fetch cmp name from mstr
    }
    
    public function viewformbAction()
    {
        
    }
    public function viewformcAction()
    {
        
    }
    public function viewformdAction()
    {
        
    }
    public function transformcAction()
    {
        $getuserid = $this->session->loginauthspuserfront['id'];
        $getdataformcuser = $this->sebicommon->getformbdata($getuserid);   //fetch latest data of formb
        $getdatauser = $this->sebicommon->getusersdata($getuserid);   //fetch user data of formb
        $this->view->approverid = $getdatauser['approverid'];
        $this->view->cin = $getdataformcuser['cin'];
        $this->view->category = $getdataformcuser['category'];
    }
    public function viewtransformcAction()
    {
        $getuserid = $this->session->loginauthspuserfront['id'];
        $user_group_id = $this->session->loginauthspuserfront['user_group_id'];
        $getdataformcuser = $this->sebicommon->getformbdata($getuserid);   //fetch latest data of formb
        //print_r($getdataformcuser);exit;
        $getdatauser = $this->sebicommon->getusersdata($getuserid);   //fetch user data of formb
        $getformcmodedetail = $this->sebicommon->getformcmode();   //fetch mode data of formc
        $this->view->modeacqui = $getformcmodedetail;
        $this->view->name = $getdatauser['fullname'];
        $this->view->cntctno = $getdatauser['mobileno'];
        $this->view->approverid = $getdatauser['approverid'];
        $this->view->pan = $getdatauser['pan'];
        $this->view->address = $getdatauser['address'];
        $this->view->cin = $getdataformcuser['cin'];
        $this->view->category = $this->sebicommon->fetchcategory();   //fetch category of usr
        $this->view->security = $this->sebicommon->fetchsecutype();   //fetch security of usr
        $this->view->company = $this->sebicommon->fetchcmpmstr($getuserid,$user_group_id);   //fetch cmp name from mstr
    }
    
    public function transformdAction()
    {
        $getuserid = $this->session->loginauthspuserfront['id'];
        $getdataformcuser = $this->sebicommon->getformbdata($getuserid);   //fetch latest data of formb
        $getdatauser = $this->sebicommon->getusersdata($getuserid);   //fetch user data of formb
        $this->view->approverid = $getdatauser['approverid'];
        $this->view->cin = $getdataformcuser['cin'];
        $this->view->category = $getdataformcuser['category'];
    }
    
    public function viewtransformdAction()
    {
        $getuserid = $this->session->loginauthspuserfront['id'];
        $user_group_id = $this->session->loginauthspuserfront['user_group_id'];
        $getdataformcuser = $this->sebicommon->getformbdata($getuserid);   //fetch latest data of formb
        //print_r($getdataformcuser);exit;
        $getdatauser = $this->sebicommon->getusersdata($getuserid);   //fetch user data of formb
        $getformcmodedetail = $this->sebicommon->getformcmode();   //fetch mode data of formc
        $this->view->modeacqui = $getformcmodedetail;
        $this->view->name = $getdatauser['fullname'];
        $this->view->cntctno = $getdatauser['mobileno'];
        $this->view->approverid = $getdatauser['approverid'];
        $this->view->pan = $getdatauser['pan'];
        $this->view->address = $getdatauser['address'];
        $this->view->cin = $getdataformcuser['cin'];
        $this->view->category = $this->sebicommon->fetchcategory();   //fetch category of usr
        $this->view->security = $this->sebicommon->fetchsecutype();   //fetch security of usr
        $this->view->company = $this->sebicommon->fetchcmpmstr($getuserid,$user_group_id);   //fetch cmp name from mstr
    }
    
    /*--------------------------- form b section start ---------------------------*/
    /**************************** insert formb data start ****************************/
    
    public function insertformbAction()
    {
        $this->view->disable();
        $getuserid = $this->session->loginauthspuserfront['id'];
        $user_group_id = $this->session->loginauthspuserfront['user_group_id'];
        $todate = date('d-m-Y');
        if($this->request->isPost() == true)
        {
            if($this->request->isAjax() == true)
            {
                $approverid   = $this->request->getPost('approverid','trim');
                $cin   = $this->request->getPost('cin','trim');
                $category   = $this->request->getPost('category','trim');
                $date   = $this->request->getPost('date','trim');
                $cmpnme   = $this->request->getPost('cmpnme','trim');
                $security   = $this->request->getPost('security','trim');
                $shrsecuno   = $this->request->getPost('shrsecuno','trim');
                $wrntsecuno   = $this->request->getPost('wrntsecuno','trim');
                $debntrsecuno   = $this->request->getPost('debntrsecuno','trim');
                $shrhldng   = $this->request->getPost('shrhldng','trim');
                $futureunitnum   = $this->request->getPost('futureunitnum','trim');
                $futurentnlvlue   = $this->request->getPost('futurentnlvlue','trim');
                $optionunitnum   = $this->request->getPost('optionunitnum','trim');
                $optionntnlvlue   = $this->request->getPost('optionntnlvlue','trim');
                if(empty($date))
                {
                    $data = array("logged" => false,'message' => "Date Of Appointment Of Director should not empty..!!");
                    $this->response->setJsonContent($data);
                }
                else if(strtotime($date)>strtotime($todate))
                {
                    $data = array("logged" => false,'message' => "Date Of Appointment Of Director should be in past..!!");
                    $this->response->setJsonContent($data);
                }
                else
                {
                    $getres = $this->sebicommon->insertformb($getuserid,$user_group_id,$approverid,$cin,$category,$date,$cmpnme,$security,$shrsecuno,$wrntsecuno,$debntrsecuno,$shrhldng,$futureunitnum,$futurentnlvlue,$optionunitnum,$optionntnlvlue);      
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
    
    /**************************** insert formb data end ****************************/
    
    // **************************** formb data fetch for table start***************************
    public function fetchformbdataAction()
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
                $getres = $this->sebicommon->fetchformbdata($getuserid,$user_group_id,$mainquery);
                /* start pagination */
                $rsstrt = ($pagenum-1) * $noofrows;
                $rslmt =' LIMIT '.$rsstrt.','.$noofrows;
                $rscnt=count($getres);
                $rspgs = ceil($rscnt/$noofrows);
                $pgndata = $this->elements->paginatndata($pagenum,$rspgs);
                $pgnhtml = $this->elements->paginationhtml($pagenum,$pgndata['start_loop'],$pgndata['end_loop'],$rspgs);
                
                $getres = $this->sebicommon->fetchformbdata($getuserid,$user_group_id,$rslmt);
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
    // **************************** formb data fetch for table end***************************
    
    // **************************** send for approval formb start***************************
    public function sendforapprvlformbAction()
    {
        $this->view->disable();
        $getuserid = $this->session->loginauthspuserfront['id'];
        $user_group_id = $this->session->loginauthspuserfront['user_group_id'];
        //echo "<pre>"; print_r($this->session->loginauthspuserfront); exit;     
        
        if($this->request->isPost() == true)
        {
            if($this->request->isAjax() == true)
            {
                $formbid   = $this->request->getPost('id','trim');
                
                $getres = $this->sebicommon->sendforapprvlformb($getuserid,$user_group_id,$formbid);
                    //echo "checking form data";print_r($getres); exit;      
                if($getres)
                {
                    $sendmail = $this->sebicommon->sendemailformb($formbid);
                    $data = array("logged" => true,'message' => 'Record Sent for approval','resdta' => $getres);
                    $this->response->setJsonContent($data);
                }
                else
                {
                    $data = array("logged" => false,'message' => "Record Not Sent for approval..!!");
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
    // **************************** send for approval formb end***************************
    
    /**************** preview of form b *************/
    public function previewofformbAction()
    {
        $this->view->disable();
        $getuserid = $this->session->loginauthspuserfront['id'];
        $user_group_id = $this->session->loginauthspuserfront['user_group_id'];
        if($this->request->isPost() == true)
        {
            if($this->request->isAjax() == true)
            {
                $formbid   = $this->request->getPost('id','trim');
                $docid   = $this->request->getPost('docid','trim');
                
                $getdocres = $this->sebicommon->getdocucontent($getuserid,$user_group_id,$docid);
                $getres = $this->sebicommon->getformdata($getuserid,$user_group_id,$formbid);      
                if(!empty($getdocres))
                {
                    $data = array("logged" => true,'message' => 'Record Sent for approval','docontent' => $getdocres,'formdata'=>$getres['data'],'secutype'=>$getres['securitytype']);
                    $this->response->setJsonContent($data);
                }
                else
                {
                    $data = array("logged" => false,'message' => "Record Not Sent for approval..!!");
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
    /**************** preview of form b *************/
    
    /**************** generate form b pdf *************/
    public function generateformbPDFAction()
    {
        $this->view->disable();
        $uid = $this->session->loginauthspuserfront['id'];
        $user_group_id = $this->session->loginauthspuserfront['user_group_id'];
        //echo $uid.'*'.$user_group_id; exit;

        if($this->request->isPost() == true)
        {
            if($this->request->isAjax() == true)
            {
                $pdf_content = $this->request->getPost('htmldata');
                $formbid = $this->request->getPost('formbid');
                $pdfpath = $this->dompdfgen->getpdf($pdf_content,'Formb','Form_b','configFormb');
                if(!empty($pdfpath))
                {
                    $getres = $this->sebicommon->insertpdfpath($pdfpath,$formbid);
                }
                //print_r($pdfpath);exit;
                if(!empty($pdfpath))
                {
                    $data = array("logged"=>true,'message'=>'PDF Generated..!!', 'pdfpath'=>$pdfpath);
                    $this->response->setJsonContent($data);
                }
                else
                {
                     $data = array("logged"=>false,  'message'=>'No PDF Generated..!!', 'pdfpath'=>'');
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
    /**************** generate pdf *************/
    
    // ****************** formb data fetch for edit ********************
    public function fetchformbeditAction()
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
                $id = $this->request->getPost('id');
                $getres = $this->sebicommon->fetchformbedit($getuserid,$user_group_id,$id);
                if($getres)
                {
                    $data = array("logged" => true,'message' => 'Record Added','data' => $getres,'user_group_id'=>$user_group_id);
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
    // ****************** formb data fetch for edit ********************
    
    /**************************** update formb data start ****************************/
    
    public function updateformbAction()
    {
        $this->view->disable();
        $getuserid = $this->session->loginauthspuserfront['id'];
        $user_group_id = $this->session->loginauthspuserfront['user_group_id'];
        $todate = date('d-m-Y');
        if($this->request->isPost() == true)
        {
            if($this->request->isAjax() == true)
            {
                $cin   = $this->request->getPost('cin','trim');
                $category   = $this->request->getPost('category','trim');
                $date   = $this->request->getPost('date','trim');
                $cmpnme   = $this->request->getPost('cmpnme','trim');
                $security   = $this->request->getPost('security','trim');
                $shrsecuno   = $this->request->getPost('shrsecuno','trim');
                $wrntsecuno   = $this->request->getPost('wrntsecuno','trim');
                $debntrsecuno   = $this->request->getPost('debntrsecuno','trim');
                $shrhldng   = $this->request->getPost('shrhldng','trim');
                $futureunitnum   = $this->request->getPost('futureunitnum','trim');
                $futurentnlvlue   = $this->request->getPost('futurentnlvlue','trim');
                $optionunitnum   = $this->request->getPost('optionunitnum','trim');
                $optionntnlvlue   = $this->request->getPost('optionntnlvlue','trim');
                $upformbid   = $this->request->getPost('upformbid','trim');
                
                if(empty($date))
                {
                    $data = array("logged" => false,'message' => "Date Of Appointment Of Director should not empty..!!");
                    $this->response->setJsonContent($data);
                }
                else if(strtotime($date)>strtotime($todate))
                {
                    $data = array("logged" => false,'message' => "Date Of Appointment Of Director should be in past..!!");
                    $this->response->setJsonContent($data);
                }
                else
                {
                    $getres = $this->sebicommon->updateformb($getuserid,$user_group_id,$cin,$category,$date,$cmpnme,$security,$shrsecuno,$wrntsecuno,$debntrsecuno,$shrhldng,$futureunitnum,$futurentnlvlue,$optionunitnum,$optionntnlvlue,$upformbid);
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
    
    /**************************** update formb data end ****************************/
    
    public function fetchformbdataforaprvlAction()
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
                $getres = $this->sebicommon->fetchformbdataforaprvl($getuserid,$user_group_id,$mainquery);
                
                /* start pagination */
                $rsstrt = ($pagenum-1) * $noofrows;
                $rslmt =' LIMIT '.$rsstrt.','.$noofrows;
                $rscnt=count($getres);
                $rspgs = ceil($rscnt/$noofrows);
                $pgndata = $this->elements->paginatndata($pagenum,$rspgs);
                $pgnhtml = $this->elements->paginationhtml($pagenum,$pgndata['start_loop'],$pgndata['end_loop'],$rspgs);
                
                $getres = $this->sebicommon->fetchformbdataforaprvl($getuserid,$user_group_id,$rslmt);
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
    
    public function apprvrqstAction()
    {
        $this->view->disable();
        $getuserid = $this->session->loginauthspuserfront['id'];
        $user_group_id = $this->session->loginauthspuserfront['user_group_id'];
        if($this->request->isPost() == true)
        {
            if($this->request->isAjax() == true)
            {
                $formbid   = $this->request->getPost('id','trim');
                $pdfurl   = $this->request->getPost('pdfurl','trim');
                $getres = $this->sebicommon->apprvrqst($getuserid,$user_group_id,$formbid,$pdfurl);
                    //echo "checking form data";print_r($getres); exit;      
                if($getres)
                {
                    $sendmail = $this->sebicommon->sendemailformbaprv($formbid); 
                    $data = array("logged" => true,'message' => 'Record Approved','resdta' => $getres);
                    $this->response->setJsonContent($data);
                }
                else
                {
                    $data = array("logged" => false,'message' => "Record Not Approved..!!");
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
    
    /*--------------------------- form b section end ---------------------------*/
    
    
    
    /*--------------------------- form c section start ---------------------------*/
    /**************************** insert formc data start ****************************/
   
    public function insertformcAction()
    {
        $this->view->disable();
        $getuserid = $this->session->loginauthspuserfront['id'];
        $user_group_id = $this->session->loginauthspuserfront['user_group_id'];
        $todate = date('d-m-Y');
        if($this->request->isPost() == true)
        {
            if($this->request->isAjax() == true)
            {
                $formcids = $this->request->getPost('ids');
                $trdeid = $this->request->getPost('trdeid');
                $appvrid = $this->request->getPost('apprvid');
                // print_r("hererr");
                // print_r($appvrid);exit;
                $category = $this->request->getPost('category');
                $cin = $this->request->getPost('cin');
                $trdeid = explode(',',$trdeid);
                for($i = 0;$i<sizeof($trdeid);$i++)
                {
                    $formcdata[] = $this->sebicommon->tradingdata($trdeid[$i]);
                    
                }
                $getres = $this->sebicommon->insertformc($getuserid,$user_group_id,$formcdata,$formcids,$appvrid,$category,$cin);
                if($getres)
                {
                    $uptradingsts = $this->sebicommon->updatetrdsts($formcids);
                    //print_r($uptradingsts);exit;
                    $data = array("logged" => true,'message' => 'Record Added','resdta' => $getres);
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
    
    /**************************** insert formc data end ****************************/
    
    // **************************** form c data fetch for table start***************************
    public function fetchformcdataAction()
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
                $getres = $this->sebicommon->fetchformcdata($getuserid,$user_group_id,$mainquery);
                
                /* start pagination */
                $rsstrt = ($pagenum-1) * $noofrows;
                $rslmt =' LIMIT '.$rsstrt.','.$noofrows;
                $rscnt=count($getres);
                $rspgs = ceil($rscnt/$noofrows);
                $pgndata = $this->elements->paginatndata($pagenum,$rspgs);
                $pgnhtml = $this->elements->paginationhtml($pagenum,$pgndata['start_loop'],$pgndata['end_loop'],$rspgs);
                
                $getres = $this->sebicommon->fetchformcdata($getuserid,$user_group_id,$rslmt);
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
    // **************************** form c data fetch for table end***************************
    
     // ****************** formc data fetch for edit ********************
    public function fetchformceditAction()
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
                $id = $this->request->getPost('id');
                $getres = $this->sebicommon->fetchformcedit($getuserid,$user_group_id,$id);
                if($getres)
                {
                    $data = array("logged" => true,'message' => 'Record Added','data' => $getres,'user_group_id'=>$user_group_id);
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
    // ****************** formc data fetch for edit ********************
    
    /**************** preview of form b *************/
    public function previewofformcAction()
    {
        $this->view->disable();
        $getuserid = $this->session->loginauthspuserfront['id'];
        $user_group_id = $this->session->loginauthspuserfront['user_group_id'];
        if($this->request->isPost() == true)
        {
            if($this->request->isAjax() == true)
            {
                $formcid   = $this->request->getPost('id','trim');
                $docid   = $this->request->getPost('docid','trim');
                
                $getdocres = $this->sebicommon->getdocucontent($getuserid,$user_group_id,$docid);
                $getres = $this->sebicommon->getformcdata($getuserid,$user_group_id,$formcid);      
                if(!empty($getdocres))
                {
                    $data = array("logged" => true,'message' => 'Record Sent for approval','docontent' => $getdocres,'formdata'=>$getres['data']/*,'secutype'=>$getres['securitytype']*/);
                    $this->response->setJsonContent($data);
                }
                else
                {
                    $data = array("logged" => false,'message' => "Record Not Sent for approval..!!");
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
    /**************** preview of form b *************/
    
    /**************** generate form c pdf *************/
    public function generateformcPDFAction()
    {
        $this->view->disable();
        $uid = $this->session->loginauthspuserfront['id'];
        $user_group_id = $this->session->loginauthspuserfront['user_group_id'];
        //echo $uid.'*'.$user_group_id; exit;

        if($this->request->isPost() == true)
        {
            if($this->request->isAjax() == true)
            {
                $pdf_content = $this->request->getPost('htmldata');
                $formcid = $this->request->getPost('formcid');
                $pdfpath = $this->dompdfgen->getpdf($pdf_content,'Formc','Form_c','configFormc');
                if(!empty($pdfpath))
                {
                    $getres = $this->sebicommon->insertpdfpathformc($pdfpath,$formcid);
                }
                //print_r($pdfpath);exit;
                if(!empty($pdfpath))
                {
                    $data = array("logged"=>true,'message'=>'PDF Generated..!!', 'pdfpath'=>$pdfpath);
                    $this->response->setJsonContent($data);
                }
                else
                {
                     $data = array("logged"=>false,  'message'=>'No PDF Generated..!!', 'pdfpath'=>'');
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
    /**************** generate pdf *************/
    
    /**************************** update form c data start ****************************/
    
    public function updateformcAction()
    {
        $this->view->disable();
        $getuserid = $this->session->loginauthspuserfront['id'];
        $user_group_id = $this->session->loginauthspuserfront['user_group_id'];
        if($this->request->isPost() == true)
        {
            if($this->request->isAjax() == true)
            {
                $formcupdata = $this->request->getPost();
                if(empty($formcupdata['fromdate']))
                {
                    $data = array("logged" => false,'message' => " Date of allotment From should not empty..!!");
                    $this->response->setJsonContent($data);
                }
                else if(empty($formcupdata['todate']))
                {
                    $data = array("logged" => false,'message' => " Date of allotment To should not empty..!!");
                    $this->response->setJsonContent($data);
                }
                else if(strtotime($formcupdata['fromdate'])>strtotime($formcupdata['todate']))
                {
                    $data = array("logged" => false,'message' => " Date of allotment From should not greater than Date of allotment To date..!!");
                    $this->response->setJsonContent($data);
                }
                else if(empty($formcupdata['dateofintimtn']))
                {
                    $data = array("logged" => false,'message' => " Date of intimation to company should not empty..!!");
                    $this->response->setJsonContent($data);
                }
                else
                {
                    $getres = $this->sebicommon->updateformc($getuserid,$user_group_id,$formcupdata);
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
    
    /**************************** update form c data end ****************************/
    
     // **************************** send for approval form c start***************************
    public function sendforapprvlformcAction()
    {
        $this->view->disable();
        $getuserid = $this->session->loginauthspuserfront['id'];
        $user_group_id = $this->session->loginauthspuserfront['user_group_id'];
        if($this->request->isPost() == true)
        {
            if($this->request->isAjax() == true)
            {
                $formcid   = $this->request->getPost('id','trim');
                $getres = $this->sebicommon->sendforapprvlformc($getuserid,$user_group_id,$formcid);
                    // echo "checking form data";print_r($getres); exit;      
                if($getres)
                {
                    $sendmail = $this->sebicommon->sendemailformc($formcid);
                    $data = array("logged" => true,'message' => 'Record Sent for approval','resdta' => $getres);
                    $this->response->setJsonContent($data);
                }
                else
                {
                    $data = array("logged" => false,'message' => "Record Not Sent for approval..!!");
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
    // **************************** send for approval form c end***************************
    
    // ********* fetch form c data on view of apprvr table start *******
    public function fetchformcdataforaprvlAction()
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
                $getres = $this->sebicommon->fetchformcdataforaprvl($getuserid,$user_group_id,$mainquery);
                
                /* start pagination */
                $rsstrt = ($pagenum-1) * $noofrows;
                $rslmt =' LIMIT '.$rsstrt.','.$noofrows;
                $rscnt=count($getres);
                $rspgs = ceil($rscnt/$noofrows);
                $pgndata = $this->elements->paginatndata($pagenum,$rspgs);
                $pgnhtml = $this->elements->paginationhtml($pagenum,$pgndata['start_loop'],$pgndata['end_loop'],$rspgs);
                
                $getres = $this->sebicommon->fetchformcdataforaprvl($getuserid,$user_group_id,$rslmt);
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
    // ********* fetch form c data on view of apprvr table end *******
    
    public function apprvrqstformcAction()
    {
        $this->view->disable();
        $getuserid = $this->session->loginauthspuserfront['id'];
        $user_group_id = $this->session->loginauthspuserfront['user_group_id'];
        if($this->request->isPost() == true)
        {
            if($this->request->isAjax() == true)
            {
                $formcid   = $this->request->getPost('id','trim');
                $pdfurl   = $this->request->getPost('pdfurl','trim');
                $getres = $this->sebicommon->apprvrqstformc($getuserid,$user_group_id,$formcid,$pdfurl);
                    //echo "checking form data";print_r($getres); exit;      
                if($getres)
                {
                    $sendmail = $this->sebicommon->sendemailformcaprv($formcid);
                    $data = array("logged" => true,'message' => 'Record Approved','resdta' => $getres);
                    $this->response->setJsonContent($data);
                }
                else
                {
                    $data = array("logged" => false,'message' => "Record Not Approved..!!");
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
    
    /*------ get form c transaction data start -----*/
    public function fetchformctransdataAction()
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
                /*count current financial year*/
                $today = date('d-m-y'); 
                $finclstartdt = date("01-04-y"); 
                $year="";
                $year1="";
                if($today<$finclstartdt)
                {
                    $year=date("Y");
                    $year1=date("Y")+1;
                }
                else
                {
                    $year=date("Y");
                    $year1=date("Y")+1;
                }
                $month="04";
                $month1="03";
                $date="01";
                $date1="31";
                
                $finenddte= (string)$date."-".(string)$month."-".(string)$year;
                $finstrtdte= (string)$date1."-".(string)$month1."-".(string)$year1;
                /*count current financial year*/ 
                
                /*---get id of company ----*/
                $getcomp = $this->sebicommon->fetchformccompdata($getuserid,$user_group_id);
                
                $noofrows=$this->request->getPost('noofrows');
                $pagenum=$this->request->getPost('pagenum');
                $mainquery = '';
                $getres = $this->sebicommon->fetchformctransdata($getuserid,$user_group_id,$finenddte,$finstrtdte,$getcomp,$mainquery);
                
                /* start pagination */
                $rsstrt = ($pagenum-1) * $noofrows;
                $rslmt =' LIMIT '.$rsstrt.','.$noofrows;
                $rscnt=count($getres['data']);
                $rspgs = ceil($rscnt/$noofrows);
                $pgndata = $this->elements->paginatndata($pagenum,$rspgs);
                $pgnhtml = $this->elements->paginationhtml($pagenum,$pgndata['start_loop'],$pgndata['end_loop'],$rspgs);
                
                $getres = $this->sebicommon->fetchformctransdata($getuserid,$user_group_id,$finenddte,$finstrtdte,$getcomp,$rslmt);
                //print_r($getres);exit;
                if($getres['data'])
                {
                    $data = array("logged" => true,'message' => 'Record Added','resdta' => $getres['data'],'user_group_id'=>$user_group_id,"pgnhtml"=>$pgnhtml);
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
    /*------ get form c transaction data end -----*/
    
    /*--------------------------- form c section end ---------------------------*/
    
    /*--------------------------- form d section start ---------------------------*/

   /**************************** insert form d data start ****************************/
   
    public function insertformdAction()
    {
        $this->view->disable();
        $getuserid = $this->session->loginauthspuserfront['id'];
        $user_group_id = $this->session->loginauthspuserfront['user_group_id'];
        $todate = date('d-m-Y');
        if($this->request->isPost() == true)
        {
            if($this->request->isAjax() == true)
            {
                $formdids = $this->request->getPost('ids');
                $trdeid = $this->request->getPost('trdeid');
                $appvrid = $this->request->getPost('apprvid');
                // print_r($appvrid);exit;
                $cin = $this->request->getPost('cin');
                $trdeid = explode(',',$trdeid);
                for($i = 0;$i<sizeof($trdeid);$i++)
                {
                    $formddata[] = $this->sebicommon->tradingdata($trdeid[$i]);
                    
                }
                $getres = $this->sebicommon->insertformd($getuserid,$user_group_id,$formddata,$formdids,$appvrid,$cin);
                if($getres)
                {
                    $uptradingstsformd = $this->sebicommon->updatetrdstsformd($formdids);
                    //print_r($uptradingsts);exit;
                    $data = array("logged" => true,'message' => 'Record Added','resdta' => $getres);
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
    
    /**************************** insert form d data end ****************************/
    
    // **************************** form d data fetch for table start***************************
    public function fetchformddataAction()
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
                $getres = $this->sebicommon->fetchformddata($getuserid,$user_group_id,$mainquery);
                
                /* start pagination */
                $rsstrt = ($pagenum-1) * $noofrows;
                $rslmt =' LIMIT '.$rsstrt.','.$noofrows;
                $rscnt=count($getres);
                $rspgs = ceil($rscnt/$noofrows);
                $pgndata = $this->elements->paginatndata($pagenum,$rspgs);
                $pgnhtml = $this->elements->paginationhtml($pagenum,$pgndata['start_loop'],$pgndata['end_loop'],$rspgs);
                //print_r($getres);exit;
                
                $getresult = $this->sebicommon->fetchformddata($getuserid,$user_group_id,$rslmt);
                
                if($getresult)
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
    // **************************** form d data fetch for table end***************************
    
     // ****************** formd data fetch for edit ********************
    public function fetchformdeditAction()
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
                $id = $this->request->getPost('id');
                $getres = $this->sebicommon->fetchformdedit($getuserid,$user_group_id,$id);
                if($getres)
                {
                    $data = array("logged" => true,'message' => 'Record Added','data' => $getres,'user_group_id'=>$user_group_id);
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
    // ****************** formd data fetch for edit ********************
    
    /**************** preview of form d *************/
    public function previewofformdAction()
    {
        $this->view->disable();
        $getuserid = $this->session->loginauthspuserfront['id'];
        $user_group_id = $this->session->loginauthspuserfront['user_group_id'];
        if($this->request->isPost() == true)
        {
            if($this->request->isAjax() == true)
            {
                $formdid   = $this->request->getPost('id','trim');
                $docid   = $this->request->getPost('docid','trim');
                
                $getdocres = $this->sebicommon->getdocucontent($getuserid,$user_group_id,$docid);
                $getres = $this->sebicommon->getformddata($getuserid,$user_group_id,$formdid);
                //print_r( $getres)   ;exit;   
                if(!empty($getdocres))
                {
                    $data = array("logged" => true,'message' => 'Record Sent for approval','docontent' => $getdocres,'formdata'=>$getres['data']);
                    $this->response->setJsonContent($data);
                }
                else
                {
                    $data = array("logged" => false,'message' => "Record Not Sent for approval..!!");
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
    /**************** preview of form d *************/
    
    /**************** generate form d pdf *************/
    public function generateformdPDFAction()
    {
        $this->view->disable();
        $uid = $this->session->loginauthspuserfront['id'];
        $user_group_id = $this->session->loginauthspuserfront['user_group_id'];
        //echo $uid.'*'.$user_group_id; exit;

        if($this->request->isPost() == true)
        {
            if($this->request->isAjax() == true)
            {
                $pdf_content = $this->request->getPost('htmldata');
                $formdid = $this->request->getPost('formdid');
                $pdfpath = $this->dompdfgen->getpdf($pdf_content,'Formd','Form_d','configFormd');
                if(!empty($pdfpath))
                {
                    $getres = $this->sebicommon->insertpdfpathformd($pdfpath,$formdid);
                }
                //print_r($pdfpath);exit;
                if(!empty($pdfpath))
                {
                    $data = array("logged"=>true,'message'=>'PDF Generated..!!', 'pdfpath'=>$pdfpath);
                    $this->response->setJsonContent($data);
                }
                else
                {
                     $data = array("logged"=>false,  'message'=>'No PDF Generated..!!', 'pdfpath'=>'');
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
    /**************** generate form d pdf *************/
    
    /**************************** update form d data start ****************************/
    
    public function updateformdAction()
    {
        $this->view->disable();
        $getuserid = $this->session->loginauthspuserfront['id'];
        $user_group_id = $this->session->loginauthspuserfront['user_group_id'];
        if($this->request->isPost() == true)
        {
            if($this->request->isAjax() == true)
            {
                $formdupdata = $this->request->getPost();
                if(empty($formdupdata['fromdate']))
                {
                    $data = array("logged" => false,'message' => " Date of allotment From should not empty..!!");
                    $this->response->setJsonContent($data);
                }
                else if(empty($formdupdata['todate']))
                {
                    $data = array("logged" => false,'message' => " Date of allotment To should not empty..!!");
                    $this->response->setJsonContent($data);
                }
                else if(strtotime($formdupdata['fromdate'])>strtotime($formdupdata['todate']))
                {
                    $data = array("logged" => false,'message' => " Date of allotment From should not greater than Date of allotment To..!!");
                    $this->response->setJsonContent($data);
                }
                else if(empty($formdupdata['dateofintimtn']))
                {
                    $data = array("logged" => false,'message' => " Date of intimation to company should not empty..!!");
                    $this->response->setJsonContent($data);
                }
                else
                {
                    $getres = $this->sebicommon->updateformd($getuserid,$user_group_id,$formdupdata);
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
    
    /**************************** update form d data end ****************************/
    
     // **************************** send for approval form d start***************************
    public function sendforapprvlformdAction()
    {
        $this->view->disable();
        $getuserid = $this->session->loginauthspuserfront['id'];
        $user_group_id = $this->session->loginauthspuserfront['user_group_id'];
        if($this->request->isPost() == true)
        {
            if($this->request->isAjax() == true)
            {
                $formdid   = $this->request->getPost('id','trim');
                $getres = $this->sebicommon->sendforapprvlformd($getuserid,$user_group_id,$formdid);
                    //echo "checking form data";print_r($getres); exit;      
                if($getres)
                {
                    $sendmail = $this->sebicommon->sendemailformd($formdid);
                    $data = array("logged" => true,'message' => 'Record Sent for approval','resdta' => $getres);
                    $this->response->setJsonContent($data);
                }
                else
                {
                    $data = array("logged" => false,'message' => "Record Not Sent for approval..!!");
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
    // **************************** send for approval form d end***************************
    
    // ********* fetch form d data on view of apprvr table start *******
    public function fetchformddataforaprvlAction()
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
                $getres = $this->sebicommon->fetchformddataforaprvl($getuserid,$user_group_id,$mainquery);
                
                 /* start pagination */
                $rsstrt = ($pagenum-1) * $noofrows;
                $rslmt =' LIMIT '.$rsstrt.','.$noofrows;
                $rscnt=count($getres);
                $rspgs = ceil($rscnt/$noofrows);
                $pgndata = $this->elements->paginatndata($pagenum,$rspgs);
                $pgnhtml = $this->elements->paginationhtml($pagenum,$pgndata['start_loop'],$pgndata['end_loop'],$rspgs);
                
                $getres = $this->sebicommon->fetchformddataforaprvl($getuserid,$user_group_id,$rslmt);
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
    // ********* fetch form d data on view of apprvr table end *******
    
    public function apprvrqstformdAction()
    {
        $this->view->disable();
        $getuserid = $this->session->loginauthspuserfront['id'];
        $user_group_id = $this->session->loginauthspuserfront['user_group_id'];
        if($this->request->isPost() == true)
        {
            if($this->request->isAjax() == true)
            {
                $formdid   = $this->request->getPost('id','trim');
                $pdfurl   = $this->request->getPost('pdfurl','trim');
                $getres = $this->sebicommon->apprvrqstformd($getuserid,$user_group_id,$formdid,$pdfurl);
                    //echo "checking form data";print_r($getres); exit;      
                if($getres)
                {
                    $sendmail = $this->sebicommon->sendemailformdaprv($formdid);
                    $data = array("logged" => true,'message' => 'Record Approved','resdta' => $getres);
                    $this->response->setJsonContent($data);
                }
                else
                {
                    $data = array("logged" => false,'message' => "Record Not Approved..!!");
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
    
    /*------ get form d transaction data start -----*/
    public function fetchformdtransdataAction()
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
                /*count current financial year*/
                $today = date('d-m-y'); 
                $finclstartdt = date("01-04-y"); 
                $year="";
                $year1="";
                if($today<$finclstartdt)
                {
                    $year=date("Y");
                    $year1=date("Y")+1;
                }
                else
                {
                    $year=date("Y");
                    $year1=date("Y")+1;
                }
                $month="04";
                $month1="03";
                $date="01";
                $date1="31";
                
                $finenddte=(string)$date."-".(string)$month."-".(string)$year;
                $finstrtdte=(string)$date1."-".(string)$month1."-".(string)$year1;
                /*count current financial year*/ 
                
                /*---get id of company ----*/
                $getcomp = $this->sebicommon->fetchformccompdata($getuserid,$user_group_id);
                
                $noofrows=$this->request->getPost('noofrows');
                $pagenum=$this->request->getPost('pagenum');
                $mainquery = '';
                $getres = $this->sebicommon->fetchformdtransdata($getuserid,$user_group_id,$finenddte,$finstrtdte,$getcomp,$mainquery);
                
                /* start pagination */
                $rsstrt = ($pagenum-1) * $noofrows;
                $rslmt =' LIMIT '.$rsstrt.','.$noofrows;
                $rscnt=count($getres);
                $rspgs = ceil($rscnt/$noofrows);
                $pgndata = $this->elements->paginatndata($pagenum,$rspgs);
                $pgnhtml = $this->elements->paginationhtml($pagenum,$pgndata['start_loop'],$pgndata['end_loop'],$rspgs);
                
                $getres = $this->sebicommon->fetchformdtransdata($getuserid,$user_group_id,$finenddte,$finstrtdte,$getcomp,$rslmt);
                //print_r($getres);exit;
                if($getres['data'])
                {
                    $data = array("logged" => true,'message' => 'Record Added','resdta' => $getres['data'],'user_group_id'=>$user_group_id,"pgnhtml"=>$pgnhtml);
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
    /*------ get form d transaction data end -----*/
    
     /*--------------------------- form d section end ---------------------------*/

    
    /*--------------------------- Export formc ---------------------------*/

    public function exportformcAction()
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
                $id=$this->request->getPost('id');
                //print_r($id);exit;
                if($id)
                {
                    $rowid = implode(",", $id);
                }
                else
                {
                    $rowid = '';
                }
               // print_r($rowid);exit;

                
                
               
                $getres = $this->sebicommon->fetchformcdataforexport($getuserid,$user_group_id,$rowid);
                
                //print_r($getres);exit;
                $genfile = $this->phpimportexpogen->exportformc($getuserid,$user_group_id,$getres);
                
                if(file_exists($genfile))
                {
                    $data = array("logged" => true,'message' => 'File Generated..!!' , 'genfile'=> $genfile);
                    $this->response->setJsonContent($data);
                }
                else
                {
                    $data = array("logged" => false,'message' => "File Not Generated..!!");
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

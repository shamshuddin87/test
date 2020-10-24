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
        //$this->view->cin = $getdataformcuser['cin'];
        $this->view->category = $this->sebicommon->fetchcategory();   //fetch category of usr
        $this->view->security = $this->sebicommon->fetchsecutype();   //fetch security of usr
        $this->view->company = $this->sebicommon->fetchcmpmstr($getuserid,$user_group_id);   //fetch cmp name from mstr
        $this->view->exchngtrd = $this->sebicommon->getformcexchngetrd();   //fetch exchange on which trade was executed
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
        //print_r($getdatauser);exit; 
        $this->view->name = $getdatauser['fullname'];
        $this->view->cntctno = $getdatauser['mobileno'];
        $this->view->approverid = $getdatauser['approvid'];
        $this->view->pan = $getdatauser['pan'];
        $this->view->address = $getdatauser['address'];
        
        $getformcmodedetail = $this->sebicommon->getformcmode();   //fetch mode data of formc
        $this->view->modeacqui = $getformcmodedetail;
        
        $this->view->category = $this->sebicommon->fetchcategory();   //fetch category of usr
        
        $this->view->security = $this->tradingrequestcommon->securitytype();   //fetch security Types
        
        $this->view->exchngtrd = $this->sebicommon->getformcexchngetrd();   //fetch exchange on which trade was executed
        
        $this->view->company = $this->sebicommon->fetchcmpmstr($getuserid,$user_group_id);   //fetch cmp name from mstr
        
        $this->view->demataccno = $this->tradingrequestcommon->getaccdetails($getuserid,$user_group_id); //demat account no
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
        $this->view->exchngtrd = $this->sebicommon->getformcexchngetrd();   //fetch exchange on which trade was executed
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
                $trdeid = explode(',',$trdeid);
                for($i = 0;$i<sizeof($trdeid);$i++)
                {
                    $formcdata[] = $this->sebicommon->tradingdata($trdeid[$i]);
                    $formcdata[$i]['category'] = '';
                    $formcdata[$i]['intimtndate'] = NULL;
                    $formcdata[$i]['allotmentfrm'] = '';
                    $formcdata[$i]['allotmentto'] = '';
                    $formcdata[$i]['aquimode'] = '';
                    $formcdata[$i]['exetrd'] = '';
                    $formcdata[$i]['formctype'] = '1';
                    
                }
                $getres = $this->sebicommon->insertformc($getuserid,$user_group_id,$formcdata,$formcids,$appvrid);
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
                $formctype   = $this->request->getPost('formctype','trim');
                if($formctype == '1')
                {
                    $docid   = '2';
                }
                else if($formctype == '2')
                {
                    $docid   = '4';
                }
                else if($formctype == '3')
                {
                    $docid   = '5';
                }
                $getdocres = $this->sebicommon->getdocucontent($getuserid,$user_group_id,$docid);
                $getres = $this->sebicommon->getformcdata($getuserid,$user_group_id,$formcid);
                //print_r($getres);exit;

                 $getsharecapital=$this->sebicommon->getsharecapital($getuserid,$user_group_id,$getres['data']['companyid']);
                 //print_r($getres);exit;
                if(empty($getsharecapital))
                {
                    $meassage = 'Share Capital Is Not Inserted For Selected Company.Please Contact To Super Admin..';
                }
                if(!empty($getsharecapital))
                {
                    $prepercentshrecap=($getres['data']['sharehldng']/$getsharecapital['pershare'])*100;

                    $postpercentshrecap=($getres['data']['sharehldng']+$getres['data']['no_of_shares'])/$getsharecapital['pershare'];

                    $postpercentshrecap = $postpercentshrecap*100;
                      //print_r( $postpercentshrecap);exit;

                    $finalprepercentshrecap = number_format((float)$prepercentshrecap, 2, '.', ''); 
                    $finalpostpercentshrecap = number_format((float)$postpercentshrecap, 2, '.', ''); 
                      
                    $postnumber=$getres['data']['sharehldng']+$getres['data']['no_of_shares'];
                    
                }
                else
                {
                    $percentshrecap='';
                }      
                if(!empty($getdocres))
                {
                    $data = array("logged" => true,'message' => 'Record Sent for approval','docontent' => $getdocres,'formdata'=>$getres['data'],'prepercent'=> $finalprepercentshrecap,'postpercent'=> $finalpostpercentshrecap,'postnumber'=>$postnumber);
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
                $exceldata = $this->request->getPost('exceldata');
                $exceldata = json_encode($exceldata);
                $myfile = fopen("img/mis/".$formcid.".txt", "w");
                // print_r($myfile);exit;
                $txt = $exceldata;
                fwrite($myfile, $txt);
                fclose($myfile);
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
                
                /*Date Validation for Date Infimation,From Date and To date Start */
                if(!empty($formcupdata['dateofintimtn']))
                {
                    $dateofintimtn = $formcupdata['dateofintimtn'];
                    $dateofintimtn_arr = explode('-', $dateofintimtn);

                    $dateofintimtnm = $dateofintimtn_arr[1];
                    $dateofintimtny = $dateofintimtn_arr[2];
                    $dateofintimtnd = $dateofintimtn_arr[0];
                    $dateofintimtnstatus = $this->elements->checkdate($dateofintimtnm,$dateofintimtny,$dateofintimtnd);
                }
                
                if(!empty($formcupdata['fromdate']))
                {
                    $fromdate = $formcupdata['fromdate'];
                    $fromdate_arr = explode('-', $fromdate);

                    $fromdatem = $fromdate_arr[1];
                    $fromdatey = $fromdate_arr[2];
                    $fromdated = $fromdate_arr[0];
                    $fromdatestatus = $this->elements->checkdate($fromdatem,$fromdatey,$fromdated);
                    $fromdateday = date('l', strtotime($fromdate)); // check week day(cannot be saturday and sunday)
                }
                
                if(!empty($formcupdata['todate']))
                {
                    $todate = $formcupdata['todate'];
                    $todate_arr = explode('-', $todate);

                    $todatem = $todate_arr[1];
                    $todatey = $todate_arr[2];
                    $todated = $todate_arr[0];
                    $todatestatus = $this->elements->checkdate($todatem,$todatey,$todated);
                    $todateday = date('l', strtotime($todate)); // check week day(cannot be saturday and sunday)
                }
                /*Date Validation for Date Infimation,From Date and To date End */
                
                if(empty($formcupdata['dateofintimtn']))
                {
                    $data = array("logged" => false,'message' => " Date of intimation to company should not empty..!!");
                    $this->response->setJsonContent($data);
                }
                else if($dateofintimtnstatus != "valid")
                {
                    $data = array("logged" => false,'message' => 'Please provide correct Date of intimation to company');
                    $this->response->setJsonContent($data);
                }
                else if(empty($formcupdata['fromdate']))
                {
                    $data = array("logged" => false,'message' => " Date of allotment From should not empty..!!");
                    $this->response->setJsonContent($data);
                }
                else if($fromdatestatus != "valid")
                {
                    $data = array("logged" => false,'message' => 'Please provide correct Date of allotment From');
                    $this->response->setJsonContent($data);
                }
                else if($fromdateday == 'Saturday' || $fromdateday == 'Sunday')
                {
                    $data = array("logged" => false,'message' => " Date of allotment From cannot be Saturday and Sunday");
                    $this->response->setJsonContent($data);
                }
                else if(empty($formcupdata['todate']))
                {
                    $data = array("logged" => false,'message' => " Date of allotment To should not empty..!!");
                    $this->response->setJsonContent($data);
                }
                else if($todatestatus != "valid")
                {
                    $data = array("logged" => false,'message' => 'Please provide correct Date of allotment To');
                    $this->response->setJsonContent($data);
                }
                else if($todateday == 'Saturday' || $todateday == 'Sunday')
                {
                    $data = array("logged" => false,'message' => " Date of allotment From cannot be Saturday and Sunday");
                    $this->response->setJsonContent($data);
                }
                else if(strtotime($formcupdata['fromdate'])>strtotime($formcupdata['todate']))
                {
                    $data = array("logged" => false,'message' => " Date of allotment From should not greater than Date of allotment To date..!!");
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
               
                $exceldata=$this->request->getPost('id');
                for($i=0;$i<sizeof($exceldata);$i++)
                {    
                     $data='';
                     $filecontent='';
                     $filecontent=file_get_contents("img/mis/".$exceldata[$i].".txt");
                     //print_r($filecontent);exit;
                   
                     $data=json_decode($filecontent,true);
                   
                      // print_r($data);exit;
                     $myarr2=array();
                     for($n=0;$n<sizeof($data);$n++)
                     {
                        // $myarr2=array();
                        $myarr2[]=$data[$n]['value'];
                     }

                      $myarr[]=$myarr2; 
                }

                if(isset($myarr) && !empty($myarr))
                   {
                         $genfile = $this->phpimportexpogen->exportformc($getuserid,$user_group_id,$myarr);
                   }
                   else
                   {
                       $data = array("logged" => false,'message' => 'Please Select Atleast One CheckBox' , 'genfile'=> '');
                       $this->response->setJsonContent($data);
                       $this->response->send();
                       exit;
                   }
                 
                 if(!empty($genfile))
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
    
    /*  ------------ Form C Types start  ------------ */
    
    // Insert Form C type 1
    public function insertformctype1Action()
    {
        $this->view->disable();
        $getuserid = $this->session->loginauthspuserfront['id'];
        $user_group_id = $this->session->loginauthspuserfront['user_group_id'];
        $todate = date('d-m-Y');
        if($this->request->isPost() == true)
        {
            if($this->request->isAjax() == true)
            {
                $type1data = $this->request->getPost();
                //print_r($type1data);exit;
                
                /*Date Validation for Date of transaction,Date Infimation,From Date and To date Start */
                
                if(!empty($type1data['dateoftrans']))
                {
                    $dateoftrans = $type1data['dateoftrans'];
                    $dateoftrans_arr = explode('-', $dateoftrans);

                    $dateoftransm = $dateoftrans_arr[1];
                    $dateoftransy = $dateoftrans_arr[2];
                    $dateoftransd = $dateoftrans_arr[0];
                    $dateoftransstatus = $this->elements->checkdate($dateoftransm,$dateoftransy,$dateoftransd);
                }
                
                if(!empty($type1data['dateofintimtn']))
                {
                    $dateofintimtn = $type1data['dateofintimtn'];
                    $dateofintimtn_arr = explode('-', $dateofintimtn);

                    $dateofintimtnm = $dateofintimtn_arr[1];
                    $dateofintimtny = $dateofintimtn_arr[2];
                    $dateofintimtnd = $dateofintimtn_arr[0];
                    $dateofintimtnstatus = $this->elements->checkdate($dateofintimtnm,$dateofintimtny,$dateofintimtnd);
                }
                
                if(!empty($type1data['fromdate']))
                {
                    $fromdate = $type1data['fromdate'];
                    $fromdate_arr = explode('-', $fromdate);

                    $fromdatem = $fromdate_arr[1];
                    $fromdatey = $fromdate_arr[2];
                    $fromdated = $fromdate_arr[0];
                    $fromdatestatus = $this->elements->checkdate($fromdatem,$fromdatey,$fromdated);
                    $fromdateday = date('l', strtotime($fromdate)); // check week day(cannot be saturday and sunday)
                }
                
                if(!empty($type1data['todate']))
                {
                    $todate = $type1data['todate'];
                    $todate_arr = explode('-', $todate);

                    $todatem = $todate_arr[1];
                    $todatey = $todate_arr[2];
                    $todated = $todate_arr[0];
                    $todatestatus = $this->elements->checkdate($todatem,$todatey,$todated);
                    $todateday = date('l', strtotime($todate)); // check week day(cannot be saturday and sunday)
                }
                /*Date Validation for Date of transaction,Date Infimation,From Date and To date End */
                
                if($dateoftransstatus != "valid")
                {
                    $data = array("logged" => false,'message' => 'Please provide correct Date of Transaction');
                    $this->response->setJsonContent($data);
                }
                else if(empty($type1data['dateofintimtn']))
                {
                    $data = array("logged" => false,'message' => " Date of intimation to company should not empty..!!");
                    $this->response->setJsonContent($data);
                }
                else if($dateofintimtnstatus != "valid")
                {
                    $data = array("logged" => false,'message' => 'Please provide correct Date of intimation to company');
                    $this->response->setJsonContent($data);
                }
                else if(empty($type1data['fromdate']))
                {
                    $data = array("logged" => false,'message' => " Date of allotment From should not empty..!!");
                    $this->response->setJsonContent($data);
                }
                else if($fromdatestatus != "valid")
                {
                    $data = array("logged" => false,'message' => 'Please provide correct Date of allotment From');
                    $this->response->setJsonContent($data);
                }
                else if($fromdateday == 'Saturday' || $fromdateday == 'Sunday')
                {
                    $data = array("logged" => false,'message' => " Date of allotment From cannot be Saturday and Sunday");
                    $this->response->setJsonContent($data);
                }
                else if(empty($type1data['todate']))
                {
                    $data = array("logged" => false,'message' => " Date of allotment To should not empty..!!");
                    $this->response->setJsonContent($data);
                }
                else if($todatestatus != "valid")
                {
                    $data = array("logged" => false,'message' => 'Please provide correct Date of allotment To');
                    $this->response->setJsonContent($data);
                }
                else if($todateday == 'Saturday' || $todateday == 'Sunday')
                {
                    $data = array("logged" => false,'message' => " Date of allotment To cannot be Saturday and Sunday");
                    $this->response->setJsonContent($data);
                }
                else if(strtotime($type1data['fromdate'])>strtotime($type1data['todate']))
                {
                    $data = array("logged" => false,'message' => " Date of allotment From should not greater than Date of allotment To date..!!");
                    $this->response->setJsonContent($data);
                }
                else
                {
                    $rqstMod = '3';
                    $resPersonalReq = $this->sebicommon->inFormcTypePersonalReq($getuserid,$user_group_id,$type1data,$rqstMod);
                    if($resPersonalReq['logged']===true)
                    {
                        $resTradeStatus = $this->sebicommon->inFormcTypeTradingStatus($getuserid,$user_group_id,$type1data,$resPersonalReq['ReqId']);
                        if($resTradeStatus['logged']===true)
                        {
                            $formcdata[] = $this->sebicommon->tradingdata($resTradeStatus['TradeId']);
                            $formcids[] = $resTradeStatus['TradeId'];
                            $appvrid = $type1data['approverid'];
                            $formcdata[0]['category'] = $type1data['category'];
                            $formcdata[0]['intimtndate'] = $type1data['dateofintimtn'];
                            $formcdata[0]['allotmentfrm'] = $type1data['fromdate'];
                            $formcdata[0]['allotmentto'] = $type1data['todate'];
                            $formcdata[0]['aquimode'] = $type1data['acquimode'];
                            $formcdata[0]['exetrd'] = $type1data['exetrd'];
                            $formcdata[0]['formctype'] = '1';
                            //print_r($formcdata);exit;
                            $getres = $this->sebicommon->insertformc($getuserid,$user_group_id,$formcdata,$formcids,$appvrid);
                            if($getres)
                            {
                                //$uptradingsts = $this->sebicommon->updatetrdsts($formcids);
                                //print_r($uptradingsts);exit;
                                $data = array("logged" => true,'message' => 'Record Added','resdta' => $getres);
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
                            $data = array("logged" => false,'message' => "Record Not Added..!!");
                            $this->response->setJsonContent($data);
                        }
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
    
    // Insert Form C type 2
    public function insertformctype2Action()
    {
        $this->view->disable();
        $getuserid = $this->session->loginauthspuserfront['id'];
        $user_group_id = $this->session->loginauthspuserfront['user_group_id'];
        $todate = date('d-m-Y');
        if($this->request->isPost() == true)
        {
            if($this->request->isAjax() == true)
            {
                $type2data = $this->request->getPost();
                //print_r($type2data);exit;
                
                /*Date Validation for Date of transaction,Date Infimation,From Date and To date Start */
                
                if(!empty($type2data['dateoftrans']))
                {
                    $dateoftrans = $type2data['dateoftrans'];
                    $dateoftrans_arr = explode('-', $dateoftrans);

                    $dateoftransm = $dateoftrans_arr[1];
                    $dateoftransy = $dateoftrans_arr[2];
                    $dateoftransd = $dateoftrans_arr[0];
                    $dateoftransstatus = $this->elements->checkdate($dateoftransm,$dateoftransy,$dateoftransd);
                }
                
                if(!empty($type2data['dateofintimtn']))
                {
                    $dateofintimtn = $type2data['dateofintimtn'];
                    $dateofintimtn_arr = explode('-', $dateofintimtn);

                    $dateofintimtnm = $dateofintimtn_arr[1];
                    $dateofintimtny = $dateofintimtn_arr[2];
                    $dateofintimtnd = $dateofintimtn_arr[0];
                    $dateofintimtnstatus = $this->elements->checkdate($dateofintimtnm,$dateofintimtny,$dateofintimtnd);
                }
                
                if(!empty($type2data['fromdate']))
                {
                    $fromdate = $type2data['fromdate'];
                    $fromdate_arr = explode('-', $fromdate);

                    $fromdatem = $fromdate_arr[1];
                    $fromdatey = $fromdate_arr[2];
                    $fromdated = $fromdate_arr[0];
                    $fromdatestatus = $this->elements->checkdate($fromdatem,$fromdatey,$fromdated);
                    $fromdateday = date('l', strtotime($fromdate)); // check week day(cannot be saturday and sunday)
                }
                
                if(!empty($type2data['todate']))
                {
                    $todate = $type2data['todate'];
                    $todate_arr = explode('-', $todate);

                    $todatem = $todate_arr[1];
                    $todatey = $todate_arr[2];
                    $todated = $todate_arr[0];
                    $todatestatus = $this->elements->checkdate($todatem,$todatey,$todated);
                    $todateday = date('l', strtotime($todate)); // check week day(cannot be saturday and sunday)
                }
                /*Date Validation for Date of transaction,Date Infimation,From Date and To date End */
                
                if($dateoftransstatus != "valid")
                {
                    $data = array("logged" => false,'message' => 'Please provide correct Date of Transaction');
                    $this->response->setJsonContent($data);
                }
                else if(empty($type2data['dateofintimtn']))
                {
                    $data = array("logged" => false,'message' => " Date of intimation to company should not empty..!!");
                    $this->response->setJsonContent($data);
                }
                else if($dateofintimtnstatus != "valid")
                {
                    $data = array("logged" => false,'message' => 'Please provide correct Date of intimation to company');
                    $this->response->setJsonContent($data);
                }
                else if(empty($type2data['fromdate']))
                {
                    $data = array("logged" => false,'message' => " Date of purchase / sale of shares From should not empty..!!");
                    $this->response->setJsonContent($data);
                }
                else if($fromdatestatus != "valid")
                {
                    $data = array("logged" => false,'message' => 'Please provide correct Date of purchase / sale of shares From');
                    $this->response->setJsonContent($data);
                }
                else if($fromdateday == 'Saturday' || $fromdateday == 'Sunday')
                {
                    $data = array("logged" => false,'message' => " Date of purchase / sale of shares From cannot be Saturday and Sunday");
                    $this->response->setJsonContent($data);
                }
                else if(empty($type2data['todate']))
                {
                    $data = array("logged" => false,'message' => " Date of purchase / sale of shares To should not empty..!!");
                    $this->response->setJsonContent($data);
                }
                else if($todatestatus != "valid")
                {
                    $data = array("logged" => false,'message' => 'Please provide correct Date of purchase / sale of shares To');
                    $this->response->setJsonContent($data);
                }
                else if($todateday == 'Saturday' || $todateday == 'Sunday')
                {
                    $data = array("logged" => false,'message' => " Date of purchase / sale of shares From cannot be Saturday and Sunday");
                    $this->response->setJsonContent($data);
                }
                else if(strtotime($type2data['fromdate'])>strtotime($type2data['todate']))
                {
                    $data = array("logged" => false,'message' => " Date of purchase / sale of shares From should not greater than Date of purchase / sale of shares To date..!!");
                    $this->response->setJsonContent($data);
                }
                else
                {
                    $rqstMod = '4';
                    $type2data['typeoftrans'] = '7';
                    $resPersonalReq = $this->sebicommon->inFormcTypePersonalReq($getuserid,$user_group_id,$type2data,$rqstMod);
                    if($resPersonalReq['logged']===true)
                    {
                        $resTradeStatus = $this->sebicommon->inFormcTypeTradingStatus($getuserid,$user_group_id,$type2data,$resPersonalReq['ReqId']);
                        if($resTradeStatus['logged']===true)
                        {
                            $formcdata[] = $this->sebicommon->tradingdata($resTradeStatus['TradeId']);
                            $formcids[] = $resTradeStatus['TradeId'];
                            $appvrid = $type2data['approverid'];
                            $formcdata[0]['category'] = $type2data['category'];
                            $formcdata[0]['intimtndate'] = $type2data['dateofintimtn'];
                            $formcdata[0]['allotmentfrm'] = $type2data['fromdate'];
                            $formcdata[0]['allotmentto'] = $type2data['todate'];
                            $formcdata[0]['aquimode'] = 'Allotment after exercise of ESOPs';
                            $formcdata[0]['exetrd'] = 'Allotment after exercise of ESOPs';
                            $formcdata[0]['formctype'] = '2';
                            //print_r($formcdata);exit;
                            $getres = $this->sebicommon->insertformc($getuserid,$user_group_id,$formcdata,$formcids,$appvrid);
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
                        else 
                        {
                            $data = array("logged" => false,'message' => "Record Not Added..!!");
                            $this->response->setJsonContent($data);
                        }
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
    
    // Insert Form C type 3
    public function insertformctype3Action()
    {
        $this->view->disable();
        $getuserid = $this->session->loginauthspuserfront['id'];
        $user_group_id = $this->session->loginauthspuserfront['user_group_id'];
        $todate = date('d-m-Y');
        if($this->request->isPost() == true)
        {
            if($this->request->isAjax() == true)
            {
                $type3data = $this->request->getPost();
                //print_r($type3data);exit;
                
                /*Date Validation for Date of transaction,Date Infimation,From Date and To date Start */
                
                if(!empty($type3data['dateoftrans']))
                {
                    $dateoftrans = $type3data['dateoftrans'];
                    $dateoftrans_arr = explode('-', $dateoftrans);

                    $dateoftransm = $dateoftrans_arr[1];
                    $dateoftransy = $dateoftrans_arr[2];
                    $dateoftransd = $dateoftrans_arr[0];
                    $dateoftransstatus = $this->elements->checkdate($dateoftransm,$dateoftransy,$dateoftransd);
                }
                
                if(!empty($type3data['dateofintimtn']))
                {
                    $dateofintimtn = $type3data['dateofintimtn'];
                    $dateofintimtn_arr = explode('-', $dateofintimtn);

                    $dateofintimtnm = $dateofintimtn_arr[1];
                    $dateofintimtny = $dateofintimtn_arr[2];
                    $dateofintimtnd = $dateofintimtn_arr[0];
                    $dateofintimtnstatus = $this->elements->checkdate($dateofintimtnm,$dateofintimtny,$dateofintimtnd);
                }
                
                if(!empty($type3data['fromdate']))
                {
                    $fromdate = $type3data['fromdate'];
                    $fromdate_arr = explode('-', $fromdate);

                    $fromdatem = $fromdate_arr[1];
                    $fromdatey = $fromdate_arr[2];
                    $fromdated = $fromdate_arr[0];
                    $fromdatestatus = $this->elements->checkdate($fromdatem,$fromdatey,$fromdated);
                    $fromdateday = date('l', strtotime($fromdate)); // check week day(cannot be saturday and sunday)
                }
                
                if(!empty($type3data['todate']))
                {
                    $todate = $type3data['todate'];
                    $todate_arr = explode('-', $todate);

                    $todatem = $todate_arr[1];
                    $todatey = $todate_arr[2];
                    $todated = $todate_arr[0];
                    $todatestatus = $this->elements->checkdate($todatem,$todatey,$todated);
                    $todateday = date('l', strtotime($todate)); // check week day(cannot be saturday and sunday)
                }
                /*Date Validation for Date of transaction,Date Infimation,From Date and To date End */
                
                if($dateoftransstatus != "valid")
                {
                    $data = array("logged" => false,'message' => 'Please provide correct Date of Transaction');
                    $this->response->setJsonContent($data);
                }
                else if(empty($type3data['dateofintimtn']))
                {
                    $data = array("logged" => false,'message' => " Date of intimation to company should not empty..!!");
                    $this->response->setJsonContent($data);
                }
                else if($dateofintimtnstatus != "valid")
                {
                    $data = array("logged" => false,'message' => 'Please provide correct Date of intimation to company');
                    $this->response->setJsonContent($data);
                }
                else if(empty($type3data['fromdate']))
                {
                    $data = array("logged" => false,'message' => " Date of purchase / sale of shares From should not empty..!!");
                    $this->response->setJsonContent($data);
                }
                else if($fromdatestatus != "valid")
                {
                    $data = array("logged" => false,'message' => 'Please provide correct Date of purchase / sale of shares From');
                    $this->response->setJsonContent($data);
                }
                else if($fromdateday == 'Saturday' || $fromdateday == 'Sunday')
                {
                    $data = array("logged" => false,'message' => " Date of purchase / sale of shares From cannot be Saturday and Sunday");
                    $this->response->setJsonContent($data);
                }
                else if(empty($type3data['todate']))
                {
                    $data = array("logged" => false,'message' => " Date of purchase / sale of shares To should not empty..!!");
                    $this->response->setJsonContent($data);
                }
                else if($todatestatus != "valid")
                {
                    $data = array("logged" => false,'message' => 'Please provide correct Date of purchase / sale of shares To');
                    $this->response->setJsonContent($data);
                }
                else if($todateday == 'Saturday' || $todateday == 'Sunday')
                {
                    $data = array("logged" => false,'message' => " Date of purchase / sale of shares From cannot be Saturday and Sunday");
                    $this->response->setJsonContent($data);
                }
                else if(strtotime($type3data['fromdate'])>strtotime($type3data['todate']))
                {
                    $data = array("logged" => false,'message' => " Date of purchase / sale of shares From should not greater than Date of purchase / sale of shares To date..!!");
                    $this->response->setJsonContent($data);
                }
                else
                {
                    $rqstMod = '5';
                    $type3data['typeoftrans'] = '6';
                    $resPersonalReq = $this->sebicommon->inFormcTypePersonalReq($getuserid,$user_group_id,$type3data,$rqstMod);
                    if($resPersonalReq['logged']===true)
                    {
                        $resTradeStatus = $this->sebicommon->inFormcTypeTradingStatus($getuserid,$user_group_id,$type3data,$resPersonalReq['ReqId']);
                        if($resTradeStatus['logged']===true)
                        {
                            $formcdata[] = $this->sebicommon->tradingdata($resTradeStatus['TradeId']);
                            $formcids[] = $resTradeStatus['TradeId'];
                            $appvrid = $type3data['approverid'];
                            $formcdata[0]['category'] = $type3data['category'];
                            $formcdata[0]['intimtndate'] = $type3data['dateofintimtn'];
                            $formcdata[0]['allotmentfrm'] = $type3data['fromdate'];
                            $formcdata[0]['allotmentto'] = $type3data['todate'];
                            $formcdata[0]['aquimode'] = 'Received on exercise of ESOPs';
                            $formcdata[0]['exetrd'] = 'Received on exercise of ESOPs';
                            $formcdata[0]['formctype'] = '3';
                            //print_r($formcdata);exit;
                            $getres = $this->sebicommon->insertformc($getuserid,$user_group_id,$formcdata,$formcids,$appvrid);
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
                        else 
                        {
                            $data = array("logged" => false,'message' => "Record Not Added..!!");
                            $this->response->setJsonContent($data);
                        }
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
    /*  ------------ Form C Types End  ------------ */
}

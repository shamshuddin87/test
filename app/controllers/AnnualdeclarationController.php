<?php 
class AnnualdeclarationController extends ControllerBase
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
    public function annualformAction()
    {     
        $uid = $this->session->loginauthspuserfront['id'];
        $usergroup = $this->session->loginauthspuserfront['user_group_id'];
        $gmnlog = $this->session->loginauthspuserfront;
        $status = $this->session->remove('userid');
        $userid = $this->session->userid;
       
    }
    public function viewannualformAction()
    {     
       $userid = $this->session->userid;
    }
    
    public function fetchinitialdeclarationAction()
    {    
        $this->view->disable(); 
        $uid = $this->session->loginauthspuserfront['id'];
        $usergroup = $this->session->loginauthspuserfront['user_group_id'];
        if($this->request->isPost() == true)
        {
            if($this->request->isAjax() == true)
            {   

                $getresponse = $this->annualdeclarationcommon->getalldata($uid,$usergroup);
                $getresponse2 = $this->annualdeclarationcommon->fetchpersonlinfo($uid,$usergroup);

                $getresponse3 = $this->annualdeclarationcommon->getpastemployee($uid,$usergroup);
                $clrhouse = $this->annualdeclarationcommon->getdespdemat($uid,$usergroup);
                $getallrelative = $this->annualdeclarationcommon->getallrelative($uid,$usergroup);
                // print_r($getallrelative);exit;
                $getres = $this->relholdingsummarycommon->fetchallholdingsummary($uid,$usergroup);
                //print_r($getres);exit; 
                // $noofshares = $this->annualdeclarationcommon->noofsharesheld($uid,$usergroup);
                $result = $this->relholdingsummarycommon->fetchholdingsummary($uid,$usergroup,0,25);

                    end($result);
                $key = key( $result );   // get end number of key
                $getequity = $this->relholdingsummarycommon->fetchequity($uid,$getres['companyid'],0,25);
                $getprefereence = $this->relholdingsummarycommon->fetchprefereence($uid,$getres['companyid'],0,25);
                $getdebenure = $this->relholdingsummarycommon->fetchdebenure($uid,$getres['companyid'],0,25);
                $allclosebal=$this->generatemisrelative($result,$getequity,$getprefereence,$getdebenure);
                //print_r($allclosebal);exit;
                $desigtotalshares = $this->annualdeclarationcommon->desigpershareheld($uid,$usergroup);
                $getemployeecode = $this->annualdeclarationcommon->getemployeecode($uid,$usergroup);
                $desimisheldshare=$this->generatemisheldshare($uid,$usergroup);
                if(isset($desimisheldshare))
                {
                   $desigpershareheld=$desimisheldshare;
                }
                else
                {
                   $desigpershareheld=0;
                }

                if(isset($allclosebal['Son']))
                {
                   $Son=$allclosebal['Son'];
                }
                else
                {
                   $Son=0;
                }

                
                if(isset($allclosebal['Daughter']))
                {
                   $Daughter=$allclosebal['Daughter'];
                }
                else
                {
                   $Daughter=0;
                }

                
                if(isset($allclosebal['Brother']))
                {
                   $brother=$allclosebal['Brother'];
                }
                else
                {
                   $brother=0;
                }
                // print_r($brother);exit;
                if(isset($allclosebal['Sister']))
                {
                   $sister=$allclosebal['Sister'];
                }
                else
                {
                   $sister=0;
                }

                if(isset($allclosebal['Mother']))
                {
                   $mother=$allclosebal['Mother'];
                }
                else
                {
                   $mother=0;
                }

                if(isset($allclosebal['Father']))
                {
                   $father=$allclosebal['Father'];
                }
                else
                {
                   $father=0;
                }

                if(isset($allclosebal['HUF']))
                {
                   $huf=$allclosebal['HUF'];
                }
                else
                {
                   $huf=0;
                }

                if(isset($allclosebal['Spouse']))
                {
                   $spouse=$allclosebal['Spouse'];
                }
                else
                {
                   $spouse=0;
                }

               
                 // print_r($getdesperdemat);
             
                if(!empty($clrhouse))
                {
                  $clrhouse=implode(",",$clrhouse);
                }
                else
                {
                   $clrhouse="Not Available";
                }
             
                $heldshares['Son']=$Son;
                $heldshares['Daughter']=$Daughter;
                $heldshares['mother']=$mother;
                $heldshares['father']=$father;
                $heldshares['brother']=$brother;
                $heldshares['sister']=$sister;
                $heldshares['huf']=$huf;
                $heldshares['spouse']=$spouse;
                $heldshares['desigpershareheld']=$desigpershareheld;
                // print_r($heldshares);exit;
                if(!empty($getresponse2))
                {
                    $data = array("logged" => true,"message"=>"Data Fetched Successfully","data"=>$getresponse,"persinfo"=>$getresponse2,"pastemployee"=>$getresponse3,"clrhouse"=>$clrhouse,"getallrelative"=>$getallrelative,"heldshares"=>$heldshares,"getemployeecode"=>$getemployeecode);
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

     public function fetchannualdeclarationAction()
    {    
       

        $this->view->disable(); 
        $uid = $this->session->loginauthspuserfront['id'];
        $usergroup = $this->session->loginauthspuserfront['user_group_id'];
        if($this->request->isPost() == true)
        {
            if($this->request->isAjax() == true)
            {   
                
                $uniqueid = $this->request->getPost('uniqueid');
                //$uniqueid = '5e0ec764808fc';

                $getresponse1 = $this->annualdeclarationcommon->annual_self_company($uid,$usergroup,$uniqueid);
                $getresponse2 = $this->annualdeclarationcommon->annual_self_firm($uid,$usergroup,$uniqueid);
                 $getresponse3 = $this->annualdeclarationcommon->annual_self_pubpri($uid,$usergroup,$uniqueid);
                $getresponse4 = $this->annualdeclarationcommon->annual_self_pubshare($uid,$usergroup,$uniqueid);
                $getresponse5 = $this->annualdeclarationcommon->annual_relative($uid,$usergroup,$uniqueid);
                $getresponse6 = $this->annualdeclarationcommon->annual_relative_firm($uid,$usergroup,$uniqueid);
                $getresponse7 = $this->annualdeclarationcommon->annual_relative_pubpri($uid,$usergroup,$uniqueid);
               

                
                if(!empty($getresponse1 || $getresponse2 || $getresponse3 || $getresponse4 || $getresponse5 || $getresponse6 || $getresponse7))
                {
                    $data = array("logged" => true,"message"=>"Data Fetched Successfully","selfcompany"=>$getresponse1,"selffirm"=>$getresponse2,"selfpubpri"=>$getresponse3,"selfpubshare"=>$getresponse4,"relative"=>$getresponse5,"relativefirm"=>$getresponse6,"relativepubpri"=>$getresponse7);
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



    //--------------- GENERATE PDF ----------------- 
    public function generateformbPDFAction()
    {
       
        $this->view->disable();
        $uid = $this->session->loginauthspuserfront['id'];
        $user_group_id = $this->session->loginauthspuserfront['user_group_id'];
        // echo $uid.'*'.$user_group_id; exit;

        if($this->request->isPost() == true)
        {
            if($this->request->isAjax() == true)
            {
                $pdf_content = $this->request->getPost('htmldata');
                $uniqueid =$this->request->getPost('uniqueid');
               // $uniqueid = '5e0ec764808fc';

                $annualyear = $this->request->getPost('annualyear');
                // print_r($pdf_content);exit;
                $pdfpath = $this->dompdfgen->getpdf($pdf_content,'check','annualdeclaration','annualdeclarationpdf');
                // print_r($pdfpath);exit;
                if(!empty($pdfpath))
                {
                      $savedata = $this->annualdeclarationcommon->saveinitialdeclare($uid,$user_group_id,$pdfpath,$annualyear,$uniqueid);
                      $data = array("logged" => true,"message"=>"PDF Generated Successfully","pdfpath"=>$pdfpath);
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
                $pdf_content = file_get_contents("declaration_form/annualdeclaration.html");
                // print_r($pdf_content);exit;
                if(!empty($pdf_content))
                {
                    $data = array("logged" => true,"message"=>"PDF Generated Successfully","pdf_content"=>$pdf_content);
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
    
    public function getallsavedpdfAction()
    {
        $this->view->disable();
        $uid = $this->session->loginauthspuserfront['id'];
        $user_group_id = $this->session->loginauthspuserfront['user_group_id'];
        //echo $uid.'*'.$user_group_id; exit;

        if($this->request->isPost() == true)
        {
            if($this->request->isAjax() == true)
            {
               $data = $this->annualdeclarationcommon->getallsavedpdf($uid,$user_group_id);
                 //print_r($data);exit;
                if(!empty($data))
                {
                      $data = array("logged" => true,"message"=>"Data Fetched Successfully","data"=>$data);
                      $this->response->setJsonContent($data);
                }
                else
                {
                    $data = array("logged" =>false,"message" => "Data Not Fetched");
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

    public function deletepdfreqAction()
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
                $result = $this->annualdeclarationcommon->delreqpdf($uid,$usergroup,$delid);

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

    public function generatemisheldshare($getuserid,$user_group_id)
    {
        //echo '<pre>'; print_r($getdata); exit;
        $addhtmlnxt = '';
        $getres = $this->miscommon->fetchhldsingle($getuserid,$user_group_id);
        //echo '$getres-----<pre>'; print_r($getres); exit;

        $getequity = $this->miscommon->fetchequity($getuserid,$getres['companyid']);
        //echo '$getequity-----<pre>'; print_r($getequity); exit;

        $getprefereence = $this->miscommon->fetchprefereence($getuserid,$getres['companyid']);
        // echo '$getprefereence-----<pre>'; print_r($getprefereence); exit;

        $getdebenure = $this->miscommon->fetchdebenure($getuserid,$getres['companyid']);
        //echo '$getdebenure-----<pre>'; print_r($getdebenure); exit;

        /* --------------- html process Start --------------- */
        $sum1=0;    $sum2=0;    $sum3=0;
        foreach($getres['data'] as $kyres => $resdata)
        {   
            //echo '<pre>'; print_r($resdata); exit;
            $equitybuysell = array();   $preferbuysell = array();   $debntrbuysell = array();
            $equityclosblnc = array();  $preferclosblnc = array();  $debntrclosblnc = array();            
            $equityopnblnc = '';    $preferopnblnc = '';    $debntropnblnc = '';            
            $othercloseequity = array();    $othercloseprefer = array();    $otherclosedebtr = array();

            // ----- Equity Start -----
            if(!empty($getequity[$kyres]))
            {
                $opnblnceq = $resdata['equityshare'];
                $buyeq = $getequity[$kyres]['buyequity'];
                $selleq = $getequity[$kyres]['sellequity'];
                $totaleq = $buyeq - $selleq;
                $closblnceq = $opnblnceq + $totaleq;

                $equityclosblnc[$kyres] = $closblnceq;
            }
            else
            {
                $opnblnceq = $resdata['equityshare'];
                $totaleq = 0;                        
                $closblnceq = $opnblnceq + $totaleq;

                $equityclosblnc[$kyres] = $closblnceq;
            }
            //echo '$equityclosblnc-----<pre>'; print_r($equityclosblnc); exit;
            // ----- Equity End -----

            // ----- Preference Start -----
            if(!empty($getprefereence[$kyres]))
            {
                $opnblncpref = $resdata['prefershare'];
                $buypref = $getprefereence[$kyres]['buyprefer'];
                $sellpref = $getprefereence[$kyres]['sellprefer'];
                $totalpref = $buypref - $sellpref;
                $closblncpref = $opnblncpref + $totalpref;

                $preferclosblnc[$kyres] = $closblncpref;
            }
            else
            {
                $opnblncpref = $resdata['prefershare'];
                $totalpref = 0;
                $closblncpref = $opnblncpref + $totalpref;

                $preferclosblnc[$kyres] = $closblncpref;
            }
            // ----- Preference End -----


            // ----- Debenture Start -----
            if(!empty($getdebenure[$kyres]))
            {
                $opnblncdeb = $resdata['debntrshare'];
                $buydeb = $getdebenure[$kyres]['buydebtr'];
                $selldeb = $getdebenure[$kyres]['selldebtr'];;
                $totaldeb = $buydeb - $selldeb;
                $closblncdeb = $opnblncdeb + $totaldeb;

                $debntrclosblnc[$kyres] = $closblncdeb;
            }
            else
            {
                $opnblncdeb = $resdata['debntrshare'];
                $totaldeb = 0;
                $closblncdeb = $opnblncdeb + $totaldeb;

                $debntrclosblnc[$kyres] = $closblncdeb;
            }
            // ----- Debenture End -----

            if(!empty($getequity))
            { 
                $sum1 = $sum1 + $equityclosblnc[$kyres] + $resdata['esop'];
            }

            if(!empty($getprefereence))
            {
                $sum2 = $sum2 + $preferclosblnc[$kyres];
            }                

            if(!empty($getdebenure))
            { 
                $sum3 = $sum3 + $debntrclosblnc[$kyres];
            }

        }
        /* --------------- html process End --------------- */
        return $sum1;
    }

    public function sendrequestAction()
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
                $getuserapprove = $this->insidercommon->fetchiddata($usergroup,'it_memberlist','wr_id',$uid);
                $getfile= $this->annualdeclarationcommon->getreqfile($reqid);
                $sendmail= $this->annualdeclarationcommon->sendmailtoapprover($reqid,$getuserapprove['approvid'],$getuserapprove['fullname'],$getfile);
                // print_r($getfile[0]['pdfpath']);exit;
                if($sendmail==true)
                {
                    $data = array("logged" => true,"message" =>"Mail Sent Successfully..!!!");
                    $this->response->setJsonContent($data);
                }
                else
                {
                    $data = array("logged" => false,"message" =>"Nail  Not Sent..!!!");
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

    public function generatemisrelative($getres,$getequity,$getprefereence,$getdebenure)
    {
        //echo '<pre>'; print_r($getdata); exit;
        $addhtmlnxt = '';
        $myclose='';
        /* --------------- html process Start --------------- */
        $sum1=0;    $sum2=0;    $sum3=0;
        foreach($getres['data'] as $kyres => $resdata)
        {   
            $equitybuysell = array();   $preferbuysell = array();   $debntrbuysell = array();
            $equityclosblnc = array();  $preferclosblnc = array();  $debntrclosblnc = array();            
            $equityopnblnc = '';    $preferopnblnc = '';    $debntropnblnc = '';            
            $othercloseequity = array();    $othercloseprefer = array();    $otherclosedebtr = array();

            // ----- Equity Start -----
            if(!empty($getequity[$kyres]))
            {
                $opnblnceq = $resdata['equityshare'];
                $buyeq = $getequity[$kyres]['buyequity'];
                $selleq = $getequity[$kyres]['sellequity'];
                $totaleq = $buyeq - $selleq;
                $closblnceq = $opnblnceq + $totaleq;

                $equityclosblnc[$kyres] = $closblnceq;
            }
            else
            {
                $opnblnceq = $resdata['equityshare'];
                $totaleq = 0;                        
                $closblnceq = $opnblnceq + $totaleq;

                $equityclosblnc[$kyres] = $closblnceq;
            }

            $myclose[$resdata['relationshipname']]=$closblnceq; 
            // ----- Equity End -----
            
            // ----- Preference Start -----
            if(!empty($getprefereence[$kyres]))
            {
                $opnblncpref = $resdata['prefershare'];
                $buypref = $getprefereence[$kyres]['buyprefer'];
                $sellpref = $getprefereence[$kyres]['sellprefer'];
                $totalpref = $buypref - $sellpref;
                $closblncpref = $opnblncpref + $totalpref;

                $preferclosblnc[$kyres] = $closblncpref;
            }
            else
            {
                $opnblncpref = $resdata['prefershare'];
                $totalpref = 0;
                $closblncpref = $opnblncpref + $totalpref;

                $preferclosblnc[$kyres] = $closblncpref;
            }
            // ----- Preference End -----


            // ----- Debenture Start -----
            if(!empty($getdebenure[$kyres]))
            {
                $opnblncdeb = $resdata['debntrshare'];
                $buydeb = $getdebenure[$kyres]['buydebtr'];
                $selldeb = $getdebenure[$kyres]['selldebtr'];;
                $totaldeb = $buydeb - $selldeb;
                $closblncdeb = $opnblncdeb + $totaldeb;

                $debntrclosblnc[$kyres] = $closblncdeb;
            }
            else
            {
                $opnblncdeb = $resdata['debntrshare'];
                $totaldeb = 0;
                $closblncdeb = $opnblncdeb + $totaldeb;

                $debntrclosblnc[$kyres] = $closblncdeb;
            }
            // ----- Debenture End -----

        }
        /* --------------- html process End --------------- */
        return $myclose;
    }
    
    //------------------- fetch Annual Declaration Form Data
    public function fetchannualformdataAction()
    {
        $this->view->disable();
        $uid = $this->session->loginauthspuserfront['id'];
        $user_group_id = $this->session->loginauthspuserfront['user_group_id'];
        // echo $uid.'*'.$user_group_id; exit;
        if($this->request->isPost() == true)
        {
            if($this->request->isAjax() == true)
            {
                $noofrows = $this->request->getPost('noofrows','trim');  
                $pagenum = $this->request->getPost('pagenum','trim'); 
                $getmasterid = $this->tradingrequestcommon->getmasterid($uid);
                $getres = $this->annualdeclarationcommon->fetchannualformdata($getmasterid['user_id'],'');
                
                 /* start pagination */
                $rsstrt = ($pagenum-1) * $noofrows;
                $rslmt =' LIMIT '.$rsstrt.','.$noofrows;
                $rscnt=count($getres);
                $rspgs = ceil($rscnt/$noofrows);
                $pgndata = $this->elements->paginatndata($pagenum,$rspgs);
                $pgnhtml = $this->elements->paginationhtml($pagenum,$pgndata['start_loop'],$pgndata['end_loop'],$rspgs);
                
                $allusrdclrnform = $this->annualdeclarationcommon->fetchannualformdata($getmasterid['user_id'],$rslmt);
                //print_r($allusrdclrnform);exit;
                if(!empty($allusrdclrnform))
                {
                    $data = array("logged" => true,"message"=>"Record Found","resdta"=>$allusrdclrnform,"pgnhtml"=>$pgnhtml);
                    $this->response->setJsonContent($data);
                }
                else
                {
                    $data = array("logged" =>false,"message" => "No Record Found","pgnhtml"=>'');
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
    
    /* ----------- SET SESSION of USERID start -----------*/
    public function useridSETsessionAction()
    {
        $this->view->disable();
        $getuserid = $this->session->loginauthspuserfront['id'];
        $cin = $this->session->memberdoccin;
        $user_group_id = $this->session->loginauthspuserfront['user_group_id'];
        
        if($this->request->isPost() == true)
        {
            if($this->request->isAjax() == true)
            {   
                $userid = $this->request->getPost('userid');                             
                //echo $rqid; exit;
                if(!empty($userid))
                {
                    // ----------- userid_session Start -----------
                    $userid = $this->session->set('userid',$userid);
                    $userid =  $this->session->userid; 
                    // ----------- userid_session End -----------
                    
                }
                //echo "<pre>";print_r($this->session->userid);exit;
              
                if(!empty($userid))
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
    /* ----------- SET SESSION of USERID end -----------*/
    
    public function fetchannualformuserwiseAction()
    {
        $this->view->disable();
        $uid = $this->session->loginauthspuserfront['id'];
        $user_group_id = $this->session->loginauthspuserfront['user_group_id'];
        // echo $uid.'*'.$user_group_id; exit;
        $userid = $this->session->userid;
        if($this->request->isPost() == true)
        {
            if($this->request->isAjax() == true)
            {
                $noofrows = $this->request->getPost('noofrows','trim');  
                $pagenum = $this->request->getPost('pagenum','trim'); 
                $getres = $this->annualdeclarationcommon->fetchannualformuserwise($userid,'');
                
                 /* start pagination */
                $rsstrt = ($pagenum-1) * $noofrows;
                $rslmt =' LIMIT '.$rsstrt.','.$noofrows;
                $rscnt=count($getres);
                $rspgs = ceil($rscnt/$noofrows);
                $pgndata = $this->elements->paginatndata($pagenum,$rspgs);
                $pgnhtml = $this->elements->paginationhtml($pagenum,$pgndata['start_loop'],$pgndata['end_loop'],$rspgs);
                
                $allusrdclrnform = $this->annualdeclarationcommon->fetchannualformuserwise($userid,$rslmt);
                //print_r($allusrdclrnform);exit;
                if(!empty($allusrdclrnform))
                {
                    $data = array("logged" => true,"message"=>"Record Found","resdta"=>$allusrdclrnform,"pgnhtml"=>$pgnhtml);
                    $this->response->setJsonContent($data);
                }
                else
                {
                    $data = array("logged" =>false,"message" => "No Record Found","pgnhtml"=>'');
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


    //*************************** insert Annual Declaration *******************//
    public function insertannualAction(){


        $this->view->disable();
        $getuserid = $this->session->loginauthspuserfront['id'];
        $cin = $this->session->memberdoccin;
        $user_group_id = $this->session->loginauthspuserfront['user_group_id'];
        if($this->request->isPost() == true)
        {
            if($this->request->isAjax() == true)
            {

                $date=date('d-m-Y');
                $d1ques1 = $this->request->getPost('d1ques1');
                $d1ques2 = $this->request->getPost('d1ques2');
                $d1ques3 = $this->request->getPost('d1ques3');

                $d2ques1 = $this->request->getPost('d2ques1');
                $d2ques2 = $this->request->getPost('d2ques2');
                $d2ques3 = $this->request->getPost('d2ques3');
                $d2ques4 = $this->request->getPost('d2ques4');

                $d3ques1 = $this->request->getPost('d3ques1');
                $d3ques2 = $this->request->getPost('d3ques2');
                $d3ques3 = $this->request->getPost('d3ques3');
                $d3ques4 = $this->request->getPost('d3ques4');

                $d4ques1 = $this->request->getPost('d4ques1');
                $d4ques2 = $this->request->getPost('d4ques2');
                $d4ques3 = $this->request->getPost('d4ques3');
                $d4ques4 = $this->request->getPost('d4ques4');

                $d5ques1 = $this->request->getPost('d5ques1');
                $d5ques2 = $this->request->getPost('d5ques2');
                $d5ques3 = $this->request->getPost('d5ques3');
                $d5ques4 = $this->request->getPost('d5ques4');

                $d6ques1 = $this->request->getPost('d6ques1');
                $d6ques2 = $this->request->getPost('d6ques2');
                $d6ques3 = $this->request->getPost('d6ques3');
                $d6ques4 = $this->request->getPost('d6ques4');
                $d6ques5 = $this->request->getPost('d6ques5');

                $d7ques1 = $this->request->getPost('d7ques1');
                $d7ques2 = $this->request->getPost('d7ques2');
                $d7ques3 = $this->request->getPost('d7ques3');
                $d7ques4 = $this->request->getPost('d7ques4');
                $d7ques5 = $this->request->getPost('d7ques5');

                 $uniqid = uniqid();
               
               
               
               
               
                //print_r($company);print_r($decision);


                 if($d1ques1 != '' || $d2ques1 != '' || $d2ques1 != '' || $d2ques1 != '' || $d2ques1 != '' || $d2ques1 != '' || $d2ques1 != '')
                    {
                        //echo 'in flag 1';exit;
                    $getres1 = $this->annualdeclarationcommon->inannualselfcompany($getuserid,$d1ques1,$d1ques2,$d1ques3,$uniqid);
                    $getres2 = $this->annualdeclarationcommon->inannualselffirm($getuserid,$d2ques1,$d2ques2,$d2ques3,$d2ques4,$uniqid);

                    $getres3 = $this->annualdeclarationcommon->inannualselfpubprivate($getuserid,$d3ques1,$d3ques2,$d3ques3,$d3ques4,$uniqid);

                    $getres4 = $this->annualdeclarationcommon->inannualselfpubshare($getuserid,$d4ques1,$d4ques2,$d4ques3,$d4ques4,$uniqid);

                     $getres5 = $this->annualdeclarationcommon->inannualrelativecompany($getuserid,$d5ques1,$d5ques2,$d5ques3,$d5ques4,$uniqid);

                    $getres6 = $this->annualdeclarationcommon->inannualrelativefirm($getuserid,$d6ques1,$d6ques2,$d6ques3,$d6ques4,$d6ques5,$uniqid);

                    $getres7 = $this->annualdeclarationcommon->inannualrelativepublicshare($getuserid,$d7ques1,$d7ques2,$d7ques3,$d7ques4,$d7ques5,$uniqid);

           

                        if($getres1 || $getres2 || $getres3 || $getres4 || $getres5  || $getres6 || $getres7)
                        {  
                            $data = array("logged" => true,'message' => 'Record Added' , 'uniqueid' => $uniqid);
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

        }


    }
    //*************************** Insert Annual Declaration End *******************//



     //*************************** Update Annual Declaration Start *******************//

 public function updateannualAction(){
 
        $this->view->disable();
        $getuserid = $this->session->loginauthspuserfront['id'];
        $cin = $this->session->memberdoccin;
        $user_group_id = $this->session->loginauthspuserfront['user_group_id'];
        if($this->request->isPost() == true)
        {
            if($this->request->isAjax() == true)
            {

                $date=date('d-m-Y');
                $d1ques1 = $this->request->getPost('d1ques1');
                $d1ques2 = $this->request->getPost('d1ques2');
                $d1ques3 = $this->request->getPost('d1ques3');


                $d2ques1 = $this->request->getPost('d2ques1');
                $d2ques2 = $this->request->getPost('d2ques2');
                $d2ques3 = $this->request->getPost('d2ques3');
                $d2ques4 = $this->request->getPost('d2ques4');

                $d3ques1 = $this->request->getPost('d3ques1');
                $d3ques2 = $this->request->getPost('d3ques2');
                $d3ques3 = $this->request->getPost('d3ques3');
                $d3ques4 = $this->request->getPost('d3ques4');

                $d4ques1 = $this->request->getPost('d4ques1');
                $d4ques2 = $this->request->getPost('d4ques2');
                $d4ques3 = $this->request->getPost('d4ques3');
                $d4ques4 = $this->request->getPost('d4ques4');

                $d5ques1 = $this->request->getPost('d5ques1');
                $d5ques2 = $this->request->getPost('d5ques2');
                $d5ques3 = $this->request->getPost('d5ques3');
                $d5ques4 = $this->request->getPost('d5ques4');

                $d6ques1 = $this->request->getPost('d6ques1');
                $d6ques2 = $this->request->getPost('d6ques2');
                $d6ques3 = $this->request->getPost('d6ques3');
                $d6ques4 = $this->request->getPost('d6ques4');
                $d6ques5 = $this->request->getPost('d6ques5');

                $d7ques1 = $this->request->getPost('d7ques1');
                $d7ques2 = $this->request->getPost('d7ques2');
                $d7ques3 = $this->request->getPost('d7ques3');
                $d7ques4 = $this->request->getPost('d7ques4');
                $d7ques5 = $this->request->getPost('d7ques5');

                $uniqueid = $this->request->getPost('uniqueid');
                //$uniqueid = '5e0ec764808fc';
                
                //ids of individual divs
                 $d1id = $this->request->getPost('d1id');
                 $d2id = $this->request->getPost('d2id');
                 $d3id = $this->request->getPost('d3id');
                 $d4id = $this->request->getPost('d4id');
                 $d5id = $this->request->getPost('d5id');
                 $d6id = $this->request->getPost('d6id');
                 $d7id = $this->request->getPost('d7id');



                
               
                //print_r($company);print_r($decision);


                 if($d1ques1 != '' || $d2ques1 != '' || $d2ques1 != '' || $d2ques1 != '' || $d2ques1 != '' || $d2ques1 != '' || $d2ques1 != '')
                    {
                        
                    $getres1 = $this->annualdeclarationcommon->upannualselfcompany($getuserid,$d1ques1,$d1ques2,$d1ques3,$uniqueid,$d1id);
                   
                     $getres2 = $this->annualdeclarationcommon->upannualselffirm($getuserid,$d2ques1,$d2ques2,$d2ques3,$d2ques4,$uniqueid,$d2id);

                     $getres3 = $this->annualdeclarationcommon->upannualselfpubprivate($getuserid,$d3ques1,$d3ques2,$d3ques3,$d3ques4,$uniqueid,$d3id);

                    $getres4 = $this->annualdeclarationcommon->upannualselfpubshare($getuserid,$d4ques1,$d4ques2,$d4ques3,$d4ques4,$uniqueid,$d4id);

                      $getres5 = $this->annualdeclarationcommon->upannualrelativecompany($getuserid,$d5ques1,$d5ques2,$d5ques3,$d5ques4,$uniqueid,$d5id);

                     $getres6 = $this->annualdeclarationcommon->upannualrelativefirm($getuserid,$d6ques1,$d6ques2,$d6ques3,$d6ques4,$d6ques5,$uniqueid,$d6id);

                     $getres7 = $this->annualdeclarationcommon->upannualrelativepublicshare($getuserid,$d7ques1,$d7ques2,$d7ques3,$d7ques4,$d7ques5,$uniqueid,$d7id);

           

                        if($getres1 || $getres2 || $getres3 || $getres4 || $getres5  || $getres6 || $getres7)
                        {  
                            $data = array("logged" => true,'message' => 'Record Updated' );
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

        }


    }

     //*************************** Update Annual Declaration End *******************//




        public function createannualAction()
    {
        $uid = $this->session->loginauthspuserfront['id'];
        $usergroup = $this->session->loginauthspuserfront['user_group_id'];
        $relatives_info = $this->annualdeclarationcommon->relatives_info($uid);


        $this->view->$relativesinfo = $relatives_info;

       

    }


        public function editannualAction()
    {
        $uid = $this->session->loginauthspuserfront['id'];
        $usergroup = $this->session->loginauthspuserfront['user_group_id'];

        $this->view->$uid;
         $uniqueid = $this->request->getPost('uniqueid');
        // $uniqueid = '5e0ec764808fc';

        $relatives = $this->annualdeclarationcommon->get_relatives($uid,$usergroup);
         $this->view->relatives = $relatives;

        $getresponse1 = $this->annualdeclarationcommon->annual_self_company($uid,$usergroup,$uniqueid);
        $this->view->selfcompany = $getresponse1;
        $getresponse2 = $this->annualdeclarationcommon->annual_self_firm($uid,$usergroup,$uniqueid);
        $this->view->selffirm = $getresponse2;
        $getresponse3 = $this->annualdeclarationcommon->annual_self_pubpri($uid,$usergroup,$uniqueid);
        $this->view->selfpublic = $getresponse3;
        $getresponse4 = $this->annualdeclarationcommon->annual_self_pubshare($uid,$usergroup,$uniqueid);
        $this->view->selfpubshare = $getresponse4;
        $getresponse5 = $this->annualdeclarationcommon->annual_relative($uid,$usergroup,$uniqueid);

         $this->view->relativecompany = $getresponse5;
        $getresponse6 = $this->annualdeclarationcommon->annual_relative_firm($uid,$usergroup,$uniqueid);
        //print_r($getresponse6);exit;
        $this->view->relativefirm = $getresponse6;
        $getresponse7 = $this->annualdeclarationcommon->annual_relative_pubpri($uid,$usergroup,$uniqueid);
         $this->view->relativepublic = $getresponse7;      

       

    }
   
}

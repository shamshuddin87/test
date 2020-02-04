<?php 
class MisController extends ControllerBase
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
        $gmnlog = $this->session->loginauthspuserfront;
        $this->view->relativesinfo =$this->employeemodulecommon->getrelativedata($uid,$usergroup);
        
        
        /*################  Phalcon Database name Fetching
        $connection = $this->db->getDescriptor();
        $connection = $connection['dbname'];
        echo '<pre>';print_r($connection);exit; 
        ###########################*/
        
        //$getmn = $this->session->orgdtl;
        //echo '<pre>';print_r($getmn);exit;        
    }

     public  function mis_formcAction()
    {

    }

       public function mis_nonexetradeAction()
    {
        
    }

     public function mis_contratrdAction()
    {
        
    }
      public function mis_changedesprsnAction()
    {
        
    }


    public function mis_confirmtradeAction()
    {
        
    }

    public function mis_formpctAction()
    {

    }

    public function mis_annualdiscsrAction()
    {

    }
    
    public function upsitypeclassifyAction()
    {
        
    }

    public function misdetailsAction()
    {
        $this->view->$userid = base64_decode($_GET["userid"]);
        $this->view->getuserinfo =$this->miscommon->useriformation(base64_decode($_GET["userid"]));
        $this->view->relativeinfo =$this->miscommon->getrelativedata(base64_decode($_GET["userid"]),"");
        $this->view->accountinfo= $this->miscommon->getaccnoinfo(base64_decode($_GET["userid"]));
        $this->view->relativeaccount= $this->miscommon->getrelinfo(base64_decode($_GET["userid"]));
        $this->view->mfrdata= $this->miscommon->getmfrdataformis(base64_decode($_GET["userid"]));
        
        //print_r(base64_decode($_GET["userid"]));exit;       
    }
    
    public function mis_recipientAction()
    {
        
    }
    
    public function mis_infosharingAction()
    {
        $upsiid=$_GET['upsid'];
        $upsidata = $this->sensitiveinformationcommon->fetchupsitype($upsiid);
        $this->view->upsitype = $upsidata['upsitype'];
        //print_r($upsitype);exit;
        $this->view->upsiid=$upsiid;
    }
    public function archive_missharingAction()
    {
        $upsiid=$_GET['upsitype'];
        $upsidata = $this->sensitiveinformationcommon->fetchupsitype($upsiid);
        $this->view->upsitype = $upsidata['upsitype'];
        $this->view->upsiid=$upsiid;
    }

    public function mis_initialdiscsrAction()
    {

    }
      
    public function getMisAllusersAction()
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
                // ------- Pagination Start -------
                $noofrows = $this->request->getPost('noofrows','trim');
                $pagenum = $this->request->getPost('pagenum','trim');
                $searchby = $this->request->getPost('search');
                //echo $pagenum.'*'.$noofrows; exit;
                $rsstrt = ($pagenum-1) * $noofrows;
                //echo $rsstrt; exit;
                // ------- Pagination End -------
                
                // ------------ Queries Start ------------
                $rslmt = ' LIMIT '.$rsstrt.','.$noofrows;
                $orderby = ' ORDER BY `wr_id` DESC';
                //echo $searchby; exit;

                if($searchby !== '')
                {
                    $mainqry = ' AND `fullname` LIKE "%'.$searchby.'%"';
                }
                else
                {
                    $mainqry = '';
                }

                $fnlqry = $mainqry.$orderby.$rslmt;
                //echo $sqlfltr1; exit;
                // ------------ Queries End ------------
                                
                $getdata = $this->miscommon->fetchsubuser($getuserid,$user_group_id,$fnlqry);
                $allrows = $this->miscommon->fetchsubuser($getuserid,$user_group_id,$mainqry);
                //print_r($getdata); exit;
                                
                // ------- Pagination Start -------
                    $rscnt = count($allrows);
                    $rspgs = ceil($rscnt/$noofrows);
                    $pgndata = $this->elements->paginatndata($pagenum,$rspgs);
                    $pgnhtml = $this->elements->paginationhtml($pagenum,$pgndata['start_loop'],$pgndata['end_loop'],$rspgs);
                    //echo '<pre>';print_r($pgnhtml);exit;
                // ------- Pagination End -------
                
                
                $processdata = $this->generateMisHtml($getuserid,$user_group_id,$getdata);
                //echo '<pre>'; print_r($processdata); exit;
                
                if($processdata['status']==true)
                {
                    $data = array('logged'=>true, 'message'=>'Data Found', 'mishtml'=>$processdata['mishtml'], 'pgnhtml'=>$pgnhtml, 'count'=>$rscnt);
                    $this->response->setJsonContent($data);
                }
                else
                {
                    $data = array('logged'=>false, 'message'=>'Data Not Found..!!', 'mishtml'=>'', 'pgnhtml'=>'', "count"=>$rscnt);
                    $this->response->setJsonContent($data);
                }                

                $this->response->send();
            }
        }
    }
     
    public function generateMisHtml($getuserid,$user_group_id,$getdata)
    {
        //echo '<pre>'; print_r($getdata); exit;
        $addhtmlnxt = '';
        foreach($getdata as $kyusr => $usrdata)
        {
            //echo '$usrdata-----<pre>'; print_r($usrdata); exit;
            
            $getres = $this->miscommon->fetchholdingsummary($getuserid,$user_group_id,$usrdata['wr_id']);
            //echo '$getres-----<pre>'; print_r($getres); exit;
            
            $getequity = $this->miscommon->fetchequity($usrdata['wr_id'],$getres['companyid']);
            //echo '$getequity-----<pre>'; print_r($getequity); exit;
            
            $getprefereence = $this->miscommon->fetchprefereence($usrdata['wr_id'],$getres['companyid']);
            //echo '$getprefereence-----<pre>'; print_r($getprefereence); exit;
            
            $getdebenure = $this->miscommon->fetchdebenure($usrdata['wr_id'],$getres['companyid']);
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
            
            $addhtmlnxt .= '<tr class="redirectpg" userid="'.$usrdata['wr_id'].'">';
            $addhtmlnxt .= '<td width="25%">'.$usrdata['fullname'].'</td>';
            $addhtmlnxt .= '<td width="25%">'.$sum1.'</td>';
            $addhtmlnxt .= '<td width="25%">'.$sum2.'</td>';
            //$addhtmlnxt .= '<td width="25%">'.$sum3.'</td>';
            $addhtmlnxt .= '</tr>';
            
        }        
        //echo '<pre>'; print_r($addhtmlnxt); exit;
            
        if($addhtmlnxt!='')
        {
            $senddata = array("status"=>true, 'mishtml'=>$addhtmlnxt);
        }
        else
        {
            $senddata = array("status"=>false, 'mishtml'=>'');
        }            
        return $senddata;
    }
    
    
    public function getholingmisAction()
    {
        $this->view->disable();
        $getuserid = $this->session->loginauthspuserfront['id'];
        $user_group_id = $this->session->loginauthspuserfront['user_group_id'];
        //echo $getuserid.'*'.$cin;exit;

        if($this->request->isPost() == true)
        {
            if($this->request->isAjax() == true)
            {   $noofrows=$this->request->getPost('noofrows');
                 $pagenum=$this->request->getPost('pagenum');
                 $userid=$this->request->getPost('userid');
                 $startdate=$this->request->getPost('startdate');
                 $enddate=$this->request->getPost('enddate');

                 // print_r($userid);exit;

               
                if($startdate=='' && $enddate=='')
                {
                    $mainquery = '';
                    $getres = $this->miscommon->getholingmis($userid,$user_group_id,$mainquery);
                    $rsstrt = ($pagenum-1) * $noofrows;
                    $rslmt =' LIMIT '.$rsstrt.','.$noofrows;
                }
                else
                {
                    $mainquery = "   AND (`ts`.`date_of_transaction`>='".$startdate."'  AND  `ts`.`date_of_transaction`<='".$enddate."')";
                    $getres = $this->miscommon->getholingmis($userid,$user_group_id,$mainquery);
                    $rsstrt = ($pagenum-1) * $noofrows;

                    $rslmt =" AND (`ts`.`date_of_transaction`>='".$startdate."'  AND  `ts`.`date_of_transaction`<='".$enddate."')".'  LIMIT '.$rsstrt.','.$noofrows;
                }

                $rscnt=count($getres);
                $rspgs = ceil($rscnt/$noofrows);
                $pgndata = $this->elements->paginatndata($pagenum,$rspgs);
                $pgnhtml = $this->elements->paginationhtml($pagenum,$pgndata['start_loop'],$pgndata['end_loop'],$rspgs);
                $result = $this->miscommon->getholingmis($userid,$user_group_id,$rslmt);

                // print_r($result);exit;

                if(!empty($result))
                {
                    $data = array("logged" => true,'message' => 'Date Fetched','data'=>$result,"pgnhtml"=>$pgnhtml,"count"=>$rscnt);
                    $this->response->setJsonContent($data);
                }
                else
                {
                    $data = array("logged" => false,'message' => "Record Not Found..!!","pgnhtml"=>$pgnhtml,"count"=>$rscnt);
                    $this->response->setJsonContent($data);
                }               

                $this->response->send();
            }
        }        
       
       }


      public function relativeholdingAction()
       {
         $this->view->disable();
           $getuserid = $this->session->loginauthspuserfront['id'];
           $user_group_id = $this->session->loginauthspuserfront['user_group_id'];
                if($this->request->isPost() == true)
                {
                    if($this->request->isAjax() == true)
                    {   $noofrows=$this->request->getPost('noofrows');
                        $pagenum=$this->request->getPost('pagenum');
                        // print_r($pagenum);exit;
                        $userid=$this->request->getPost('userid');
                        $startdate=$this->request->getPost('startdate');
                        $enddate=$this->request->getPost('enddate');
                       
                       if($startdate=='' && $enddate=='')
                       { $mainquery = '';
                         $getres = $this->miscommon->getrelativegmis($userid,$user_group_id,$mainquery);
                         $rsstrt = ($pagenum-1) * $noofrows;
                         $rslmt =' LIMIT '.$rsstrt.','.$noofrows;
                       }
                       else
                       {
                           $mainquery = "   AND (`ts`.`date_of_transaction`>='".$startdate."'  AND  `ts`.`date_of_transaction`<='".$enddate."')";
                           $getres = $this->miscommon->getrelativegmis($userid,$user_group_id,$mainquery);
                           $rsstrt = ($pagenum-1) * $noofrows;
                           $rslmt =" AND (`ts`.`date_of_transaction`>='".$startdate."'  AND  `ts`.`date_of_transaction`<='".$enddate."')".'  LIMIT '.$rsstrt.','.$noofrows;
                       }
                        $rscnt=count($getres);
                        $rspgs = ceil($rscnt/$noofrows);
                        $pgndata = $this->elements->paginatndata($pagenum,$rspgs);
                        $pgnhtml = $this->elements->paginationhtml($pagenum,$pgndata['start_loop'],$pgndata['end_loop'],$rspgs);
                        // print_r($pgnhtml);exit;
                        $getres = $this->miscommon->getrelativegmis($userid,$user_group_id,$rslmt);
                       
                         
                        if(!empty($getres))
                        {
                            $data = array("logged" => true,'message' => 'Date Fetched','data'=>$getres,
                                "pgnhtml"=>$pgnhtml,"count"=>$rscnt);
                            $this->response->setJsonContent($data);
                        }
                        else
                        {
                            $data = array("logged" => false,'message' => "Record Not Found..!!","pgnhtml"=>$pgnhtml,"count"=>$rscnt);
                            $this->response->setJsonContent($data);
                        }
                        

                        $this->response->send();
                    }
        }        
       
       }
    
    // **************************** recipient mis fetch for table start***************************
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
                $getres = $this->miscommon->fetchrecipient($getuserid,$user_group_id);
                //print_r($getres);exit;
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
    // **************************** recipient mis fetch for table end***************************
    
    // **************************** infosharing mis fetch for table start***************************
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
                $upsitypeid=$this->request->getPost('upsitypeid');
                $mainquery = '';
                $getres = $this->miscommon->fetchinfosharing($getuserid,$user_group_id,$upsitypeid,$mainquery);
                /* start pagination */
                $rsstrt = ($pagenum-1) * $noofrows;
                $rslmt =' LIMIT '.$rsstrt.','.$noofrows;
                $rscnt=count($getres);
                $rspgs = ceil($rscnt/$noofrows);
                $pgndata = $this->elements->paginatndata($pagenum,$rspgs);
                $pgnhtml = $this->elements->paginationhtml($pagenum,$pgndata['start_loop'],$pgndata['end_loop'],$rspgs);
                
                $getresult = $this->miscommon->fetchinfosharing($getuserid,$user_group_id,$upsitypeid,$rslmt);
                //print_r($getres);exit;
                if($getresult)
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
    
    // **************************** infosharing mis fetch for table end***************************
    
    // **************************** infosharing fetch for Archive table start***************************
    public function fetcharchiveinfosharingAction()
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
                $upsitypeid=$this->request->getPost('upsitypeid');
                $mainquery = '';
                $getres = $this->miscommon->fetcharchiveinfosharing($getuserid,$user_group_id,$upsitypeid,$mainquery);
                /* start pagination */
                $rsstrt = ($pagenum-1) * $noofrows;
                $rslmt =' LIMIT '.$rsstrt.','.$noofrows;
                $rscnt=count($getres);
                $rspgs = ceil($rscnt/$noofrows);
                $pgndata = $this->elements->paginatndata($pagenum,$rspgs);
                $pgnhtml = $this->elements->paginationhtml($pagenum,$pgndata['start_loop'],$pgndata['end_loop'],$rspgs);
                
                $getres = $this->miscommon->fetcharchiveinfosharing($getuserid,$user_group_id,$upsitypeid,$rslmt);
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
    
    // **************************** infosharing fetch for Archive table end***************************


        // ************ Get MIS Change Designation Person START ************
    public function mischngedesprsnAction()
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
                $searchby = $this->request->getPost('search');
                $startdate = $this->request->getPost('startdate');
                $enddate = $this->request->getPost('enddate');
                $dresign=$this->request->getPost('dresign');
                // print_r($dresign);exit;
                $mainquery = ' AND (`fullname` LIKE "%'.$searchby.'%")';
                $rsstrt = ($pagenum-1) * $noofrows;
                $rslmt =' AND (`fullname` LIKE "%'.$searchby.'%" )  LIMIT '.$rsstrt.','.$noofrows;
                if(!empty($startdate) && !empty($enddate))
                {
                    $mainquery = ' AND STR_TO_DATE(`date_modified`,"%Y-%m-%d") BETWEEN STR_TO_DATE("'.$startdate.'","%Y-%m-%d") AND STR_TO_DATE("'.$enddate.'","%Y-%m-%d") AND (`fullname` LIKE "%'.$searchby.'%" OR `employeecode` LIKE "%'.$searchby.'%")';
                    
                    $rslmt =' AND STR_TO_DATE(`date_modified`,"%Y-%m-%d") BETWEEN STR_TO_DATE("'.$startdate.'","%Y-%m-%d") AND STR_TO_DATE("'.$enddate.'","%Y-%m-%d") AND (`fullname` LIKE "%'.$searchby.'%" OR `employeecode` LIKE "%'.$searchby.'%")  LIMIT '.$rsstrt.','.$noofrows;
                }
                if($dresign==1)
                {
                     $mydate= date ( "d-m-Y", strtotime("-6 month",time("d-m-Y")));
                     $today=date("d-m-Y");
                     // print_r($mydate);exit; 
                     $mainquery = ' AND STR_TO_DATE(`dpdate`,"%d-%m-%Y") BETWEEN STR_TO_DATE("'.$mydate.'","%d-%m-%Y") AND STR_TO_DATE("'.$today.'","%d-%m-%Y") AND (`fullname` LIKE "%'.$searchby.'%" )';
                    
                    $rslmt =' AND STR_TO_DATE(`dpdate`,"%d-%m-%Y") BETWEEN STR_TO_DATE("'.$mydate.'","%d-%m-%Y") AND STR_TO_DATE("'.$today.'","%d-%m-%Y") AND (`fullname` LIKE "%'.$searchby.'%") LIMIT '.$rsstrt.','.$noofrows;  

                        // SELECT * FROM `it_memberlist` WHERE user_id = '1' AND  STR_TO_DATE(`resignationdte`,"%d-%m-%Y") BETWEEN STR_TO_DATE("07-02-2019","%d-%m-%Y") AND STR_TO_DATE("07-08-2019","%d-%m-%Y") 
                }
                $getres = $this->miscommon->fetchmischngedesprsn($getuserid,$user_group_id,$mainquery);
                /* start pagination */
                
               
                $rscnt=count($getres);
                $rspgs = ceil($rscnt/$noofrows);
                $pgndata = $this->elements->paginatndata($pagenum,$rspgs);
                $pgnhtml = $this->elements->paginationhtml($pagenum,$pgndata['start_loop'],$pgndata['end_loop'],$rspgs);
                //print_r($getres);exit;
                
                $getres = $this->miscommon->fetchmischngedesprsn($getuserid,$user_group_id,$rslmt);
                // print_r($getres);exit;
                if($getres)
                {
                    $data = array("logged" => true,'message' => 'Record Added','data' => $getres,'user_group_id'=>$user_group_id,"pgnhtml"=>$pgnhtml);
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
    // ************ Get MIS Change Designation Person END ************

       // ************ Get MIS Contra Trade START ************
    public function miscontratrdAction()
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
                $searchby = $this->request->getPost('search');
                $startdate = $this->request->getPost('startdate');
                $enddate = $this->request->getPost('enddate');
                
                $mainquery = ' AND (memb.`fullname` LIKE "%'.$searchby.'%" )';
                $rsstrt = ($pagenum-1) * $noofrows;
                $rslmt =' AND (memb.`fullname` LIKE "%'.$searchby.'%" )  LIMIT '.$rsstrt.','.$noofrows;
                if(!empty($startdate) && !empty($enddate))
                {
                    $mainquery = ' AND STR_TO_DATE(ts.`date_of_transaction`,"%d-%m-%Y") BETWEEN STR_TO_DATE("'.$startdate.'","%d-%m-%Y") AND STR_TO_DATE("'.$enddate.'","%d-%m-%Y") AND emb.`fullname` LIKE "%'.$searchby.'%"';
                    
                    $rslmt =' AND STR_TO_DATE(ts.`date_of_transaction`,"%d-%m-%Y") BETWEEN STR_TO_DATE("'.$startdate.'","%d-%m-%Y") AND STR_TO_DATE("'.$enddate.'","%d-%m-%Y") AND memb.`fullname` LIKE "%'.$searchby.'%" LIMIT '.$rsstrt.','.$noofrows;
                }
                $getres = $this->miscommon->fetchmiscontratrd($getuserid,$user_group_id,$mainquery);
                
                /* start pagination */
                
                $rscnt=count($getres);
                $rspgs = ceil($rscnt/$noofrows);
                $pgndata = $this->elements->paginatndata($pagenum,$rspgs);
                $pgnhtml = $this->elements->paginationhtml($pagenum,$pgndata['start_loop'],$pgndata['end_loop'],$rspgs);
                //print_r($getres);exit;
                
                $getres = $this->miscommon->fetchmiscontratrd($getuserid,$user_group_id,$rslmt);
                if($getres)
                {
                    $data = array("logged" => true,'message' => 'Record Added','data' => $getres,'user_group_id'=>$user_group_id,"pgnhtml"=>$pgnhtml);
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
    // ************ Get MIS Contra Trade END ************

      // ************ Get MIS Non Exe Trade START ************
    public function misnonexetrdeAction()
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
                $searchby = $this->request->getPost('search');
                $mainquery = ' AND (memb.`fullname` LIKE "%'.$searchby.'%" )';
                $getres = $this->miscommon->fetchmisnonexetrde($getuserid,$user_group_id,$mainquery);
                
                /* start pagination */
                $rsstrt = ($pagenum-1) * $noofrows;
                $rslmt =' AND (memb.`fullname` LIKE "%'.$searchby.'%") LIMIT '.$rsstrt.','.$noofrows;
                $rscnt=count($getres);
                $rspgs = ceil($rscnt/$noofrows);
                $pgndata = $this->elements->paginatndata($pagenum,$rspgs);
                $pgnhtml = $this->elements->paginationhtml($pagenum,$pgndata['start_loop'],$pgndata['end_loop'],$rspgs);
                //print_r($getres);exit;
                
                $getres = $this->miscommon->fetchmisnonexetrde($getuserid,$user_group_id,$rslmt);
                if($getres)
                {
                    $data = array("logged" => true,'message' => 'Record Added','data' => $getres,'user_group_id'=>$user_group_id,"pgnhtml"=>$pgnhtml);
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
    // ************ Get MIS Non Exe Trade END ************


       // ************ Get MIS Confirm Trade START ************
    public function misconfirmtrdeAction()
    {
        $this->view->disable();
        $getuserid = $this->session->loginauthspuserfront['id'];
        $user_group_id = $this->session->loginauthspuserfront['user_group_id'];
        //echo $getuserid.'*'.$cin;exit;

        if($this->request->isPost() == true)
        {
            if($this->request->isAjax() == true)
            {   
                $noofrows=$this->request->getPost('noofrows');
                $pagenum=$this->request->getPost('pagenum');
                $startdate=$this->request->getPost('startdate');
                $enddate=$this->request->getPost('enddate');
                $searchby = $this->request->getPost('search');

                if($startdate=='' && $enddate=='')
                {
                    $mainquery = '';
                    $mainquery.= ' AND (memb.`fullname` LIKE "%'.$searchby.'%" )';
                    $getres = $this->miscommon->misconfirmtrde($getuserid,$user_group_id,$mainquery);
                    $rsstrt = ($pagenum-1) * $noofrows;
                    $rslmt =' AND (memb.`fullname` LIKE "%'.$searchby.'%") LIMIT '.$rsstrt.','.$noofrows;
                }
                else
                {
                    $mainquery = "   AND STR_TO_DATE(`ts`.`date_of_transaction`,'%d-%m-%Y') BETWEEN STR_TO_DATE('".$startdate."','%d-%m-%Y') AND STR_TO_DATE('".$enddate."','%d-%m-%Y')";
                    $mainquery .= ' AND (memb.`fullname` LIKE "%'.$searchby.'%" )';
                    $getres = $this->miscommon->misconfirmtrde($getuserid,$user_group_id,$mainquery);
                    $rsstrt = ($pagenum-1) * $noofrows;

                    $rslmt =" AND STR_TO_DATE(`ts`.`date_of_transaction`,'%d-%m-%Y') BETWEEN STR_TO_DATE('".$startdate."','%d-%m-%Y') AND STR_TO_DATE('".$enddate."','%d-%m-%Y')"  ;
                    $rslmt .= ' AND (memb.`fullname` LIKE "%'.$searchby.'%" ) LIMIT '.$rsstrt.','.$noofrows;
                }

                $rscnt=count($getres);
                $rspgs = ceil($rscnt/$noofrows);
                $pgndata = $this->elements->paginatndata($pagenum,$rspgs);
                $pgnhtml = $this->elements->paginationhtml($pagenum,$pgndata['start_loop'],$pgndata['end_loop'],$rspgs);
                $result = $this->miscommon->misconfirmtrde($getuserid,$user_group_id,$rslmt);
                // print_r($result);exit;
                if(!empty($result))
                {
                    $data = array("logged" => true,'message' => 'Date Fetched','data'=>$result,"pgnhtml"=>$pgnhtml,"count"=>$rscnt);
                    $this->response->setJsonContent($data);
                }
                else
                {
                    $data = array("logged" => false,'message' => "Record Not Found..!!","pgnhtml"=>$pgnhtml,"count"=>$rscnt);
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
     // ************ Get MIS Confirm Trade END ************

      public function misformcAction()
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
                $searchby = $this->request->getPost('search');
                $startdate = $this->request->getPost('startdate');
                $enddate = $this->request->getPost('enddate');
                $filter = $this->request->getPost('filterstatus');
                $filterquery = '';
               /* if($filter == 'pending')
                {
                    $filterquery = ' AND (formc.send_date IS NULL OR ts.`formcstatus`=0)';
                }
                else */if($filter == 'submitted')
                {
                    $filterquery = ' AND formc.send_date IS NOT NULL';
                }
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
                if(empty($startdate) && empty($enddate))
                {
                    $mainquery = $filterquery.'   AND (memb.`fullname` LIKE "%'.$searchby.'%") ORDER BY ts.ID DESC';
                }
                else
                {
                    $mainquery = $filterquery.' AND DATE_ADD(STR_TO_DATE(ts.`date_of_transaction`,"%d-%m-%Y"),INTERVAL 2 DAY) BETWEEN STR_TO_DATE("'.$startdate.'","%Y-%m-%d") AND STR_TO_DATE("'.$enddate.'","%Y-%m-%d") AND (memb.`fullname` LIKE "%'.$searchby.'%" ) ORDER BY ts.ID DESC';
                }
                
                $getres = $this->miscommon->fetchmisformc($getuserid,$user_group_id,$finenddte,$finstrtdte,$mainquery,$filter);
                
                /* start pagination */
                $rsstrt = ($pagenum-1) * $noofrows;
                if(empty($startdate) && empty($enddate))
                {
                    $rslmt =$filterquery.'  AND (memb.`fullname` LIKE "%'.$searchby.'%") ORDER BY ts.ID DESC LIMIT ' .$rsstrt.','.$noofrows;
                }
                else
                {
                    $rslmt =$filterquery.' AND DATE_ADD(STR_TO_DATE(ts.`date_of_transaction`,"%d-%m-%Y"),INTERVAL 2 DAY) BETWEEN STR_TO_DATE("'.$startdate.'","%Y-%m-%d") AND STR_TO_DATE("'.$enddate.'","%Y-%m-%d") AND (memb.`fullname` LIKE "%'.$searchby.'%") ORDER BY ts.ID DESC LIMIT ' .$rsstrt.','.$noofrows;
                }
                $rscnt=count($getres);
                $rspgs = ceil($rscnt/$noofrows);
                $pgndata = $this->elements->paginatndata($pagenum,$rspgs);
                $pgnhtml = $this->elements->paginationhtml($pagenum,$pgndata['start_loop'],$pgndata['end_loop'],$rspgs);
                //print_r($getres);exit;
                
                $getres = $this->miscommon->fetchmisformc($getuserid,$user_group_id,$finenddte,$finstrtdte,$rslmt,$filter);
                //print_r($getres);exit;
                if($getres)
                {
                    $data = array("logged" => true,'message' => 'Record Added','data' => $getres,'user_group_id'=>$user_group_id,"pgnhtml"=>$pgnhtml);
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

     // ************ Get Form PCT START ************
    public function misformpctAction()
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
                $searchby = $this->request->getPost('search');
                $startdate = $this->request->getPost('startdate');
                $enddate = $this->request->getPost('enddate');
                
                $mainquery = ' AND ((pr.`no_of_shares`>=25000  AND pr.`approved_status`=1) ) OR ((pr.`no_of_shares`< 25000 AND pr.`approved_status`=1)) AND (memb.`fullname` LIKE "%'.$searchby.'%" OR memb.`employeecode` LIKE "%'.$searchby.'%")';
                $rsstrt = ($pagenum-1) * $noofrows;
                $rslmt =' AND ((pr.`no_of_shares`>=25000 AND pr.`approved_status`=1) ) OR ((pr.`no_of_shares`< 25000 AND pr.`approved_status`=1)) AND (memb.`fullname` LIKE "%'.$searchby.'%"  )  LIMIT '.$rsstrt.','.$noofrows;
                // if(!empty($startdate) && !empty($enddate))  
                // {
                //     $mainquery = ' AND ((pr.`no_of_shares`>=25000 AND pr.`approved_status`=1) AND STR_TO_DATE(pr.`ceoaprv_date`,"%Y-%m-%d") BETWEEN STR_TO_DATE("'.$startdate.'","%Y-%m-%d") AND STR_TO_DATE("'.$enddate.'","%Y-%m-%d")) OR ((pr.`no_of_shares`< 25000 AND pr.`approved_status`=1) AND STR_TO_DATE(pr.`approved_date`,"%Y-%m-%d") BETWEEN STR_TO_DATE("'.$startdate.'","%Y-%m-%d") AND STR_TO_DATE("'.$enddate.'","%Y-%m-%d"))  AND (memb.`fullname` LIKE "%'.$searchby.'%" OR memb.`employeecode` LIKE "%'.$searchby.'%")';
                    
                //     $rslmt =' AND ((pr.`no_of_shares`>=25000 AND pr.`ceoapprv_status`=1 AND pr.`approved_status`=1) AND STR_TO_DATE(pr.`ceoaprv_date`,"%Y-%m-%d") BETWEEN STR_TO_DATE("'.$startdate.'","%Y-%m-%d") AND STR_TO_DATE("'.$enddate.'","%Y-%m-%d")) OR ((pr.`no_of_shares`< 25000 AND pr.`approved_status`=1) AND STR_TO_DATE(pr.`approved_date`,"%Y-%m-%d") BETWEEN STR_TO_DATE("'.$startdate.'","%Y-%m-%d") AND STR_TO_DATE("'.$enddate.'","%Y-%m-%d")) AND (memb.`fullname` LIKE "%'.$searchby.'%" OR memb.`employeecode` LIKE "%'.$searchby.'%")  LIMIT '.$rsstrt.','.$noofrows;
                // }
                //$getres = $this->miscommon->fetchmisformpctdata($getuserid,$user_group_id,$mainquery);
                //OR STR_TO_DATE(pr.`ceoaprv_date`,"%Y-%m-%d") BETWEEN STR_TO_DATE("'.$startdate.'","%Y-%m-%d") AND STR_TO_DATE("'.$enddate.'","%Y-%m-%d"))
                //print_r($getres);exit;
                /* start pagination */
                
                $rscnt=count(2);
                $rspgs = ceil($rscnt/$noofrows);
                $pgndata = $this->elements->paginatndata($pagenum,$rspgs);
                $pgnhtml = $this->elements->paginationhtml($pagenum,$pgndata['start_loop'],$pgndata['end_loop'],$rspgs);
                //print_r($getres);exit;
                
                $getres = $this->miscommon->fetchmisformpctdata($getuserid,$user_group_id,$rslmt);
                //print_r($getres);exit;
                if($getres)
                {
                    $data = array("logged" => true,'message' => 'Record Added','data' => $getres,'user_group_id'=>$user_group_id,"pgnhtml"=>$pgnhtml);
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

     public function pendinginitialdisclsrAction()
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
                $filterby = '';
                $noofrows = $this->request->getPost('noofrows');
                $pagenum = $this->request->getPost('pagenum');
                $searchby = $this->request->getPost('search');
                $filterstatus = $this->request->getPost('filterstatus');
                
                if($filterstatus == '')
                {
                    $mainquery = ' AND (memb.`fullname` LIKE "%'.$searchby.'%") GROUP BY memb.`wr_id`';
                    $getres = $this->miscommon->fetchallinitialdisclsr($getuserid,$user_group_id,$mainquery);
                    //print_r($getres);exit;
                    $rsstrt = ($pagenum-1) * $noofrows;
                    $rslmt = $filterby.' AND (memb.`fullname` LIKE "%'.$searchby.'%") GROUP BY memb.`wr_id` LIMIT '.$rsstrt.','.$noofrows;
                    $rscnt=count($getres);
                    $rspgs = ceil($rscnt/$noofrows);
                    $pgndata = $this->elements->paginatndata($pagenum,$rspgs);
                    $pgnhtml = $this->elements->paginationhtml($pagenum,$pgndata['start_loop'],$pgndata['end_loop'],$rspgs);
                    //print_r($getres);exit;

                    $getresult = $this->miscommon->fetchallinitialdisclsr($getuserid,$user_group_id,$rslmt);
                }
                else if($filterstatus == 'pending')
                {
                    $mainquery = ' AND (memb.`fullname` LIKE "%'.$searchby.'%") GROUP BY memb.`wr_id`';
                    $getres = $this->miscommon->fetchinitlpendig($getuserid,$user_group_id,$mainquery);
                    //print_r($getres);exit;
                    $rsstrt = ($pagenum-1) * $noofrows;
                    $rslmt = $filterby.' AND (memb.`fullname` LIKE "%'.$searchby.'%" ) GROUP BY memb.`wr_id` LIMIT '.$rsstrt.','.$noofrows;
                    $rscnt=count($getres);
                    $rspgs = ceil($rscnt/$noofrows);
                    $pgndata = $this->elements->paginatndata($pagenum,$rspgs);
                    $pgnhtml = $this->elements->paginationhtml($pagenum,$pgndata['start_loop'],$pgndata['end_loop'],$rspgs);
                    //print_r($getres);exit;

                    $getresult = $this->miscommon->fetchinitlpendig($getuserid,$user_group_id,$rslmt);
                }
                else if($filterstatus == 'sent_for_approval') 
                {
                    $filterby = ' AND initial.send_status= 1';
                    $mainquery = $filterby.' AND (memb.`fullname` LIKE "%'.$searchby.'%" ) ';
                    $getres = $this->miscommon->fetchmisinitialdisclsr($getuserid,$user_group_id,$mainquery);
                    /* start pagination */
                    
                    $rsstrt = ($pagenum-1) * $noofrows;
                    $rslmt = $filterby.' AND (memb.`fullname` LIKE "%'.$searchby.'%" )  LIMIT '.$rsstrt.','.$noofrows;
                    $rscnt=count($getres);
                    $rspgs = ceil($rscnt/$noofrows);
                    $pgndata = $this->elements->paginatndata($pagenum,$rspgs);
                    $pgnhtml = $this->elements->paginationhtml($pagenum,$pgndata['start_loop'],$pgndata['end_loop'],$rspgs);

                    $getresult = $this->miscommon->fetchmisinitialdisclsr($getuserid,$user_group_id,$rslmt);
                }
             
                if($getresult)
                {
                    $data = array("logged" => true,'message' => 'Record Added','data' => $getresult,'user_group_id'=>$user_group_id,"pgnhtml"=>$pgnhtml);
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
   


    // ************ Get MIS Annual Disclosure START ************
    public function pendingannualdisclsrAction()
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
                $filterby = '';
                $annualyr = $this->request->getPost('annualyr');
                $noofrows = $this->request->getPost('noofrows');
                $pagenum = $this->request->getPost('pagenum');
                $searchby = $this->request->getPost('search');
                $filterstatus = $this->request->getPost('filterstatus');
                
                if($filterstatus == '')
                {
                    $mainquery = ' AND (memb.`fullname` LIKE "%'.$searchby.'%" ) GROUP BY memb.`wr_id`';
                    $getres = $this->miscommon->fetchallannualdisclsr($getuserid,$user_group_id,$annualyr,$mainquery);
                    //print_r($getres);exit;
                    $rsstrt = ($pagenum-1) * $noofrows;
                    $rslmt = $filterby.' AND (memb.`fullname` LIKE "%'.$searchby.'%" ) GROUP BY memb.`wr_id` LIMIT '.$rsstrt.','.$noofrows;
                    $rscnt=count($getres);
                    $rspgs = ceil($rscnt/$noofrows);
                    $pgndata = $this->elements->paginatndata($pagenum,$rspgs);
                    $pgnhtml = $this->elements->paginationhtml($pagenum,$pgndata['start_loop'],$pgndata['end_loop'],$rspgs);
                    //print_r($getres);exit;

                    $getresult = $this->miscommon->fetchallannualdisclsr($getuserid,$user_group_id,$annualyr,$rslmt);
                }
                else if($filterstatus == 'pending')
                {
                    $mainquery = ' AND (memb.`fullname` LIKE "%'.$searchby.'%" ) GROUP BY memb.`wr_id`';
                    $getres = $this->miscommon->fetchpendigannualdisclsr($getuserid,$user_group_id,$annualyr,$mainquery);
                    //print_r($getres);exit;
                    $rsstrt = ($pagenum-1) * $noofrows;
                    $rslmt = $filterby.' AND (memb.`fullname` LIKE "%'.$searchby.'%" ) GROUP BY memb.`wr_id` LIMIT '.$rsstrt.','.$noofrows;
                    $rscnt=count($getres);
                    $rspgs = ceil($rscnt/$noofrows);
                    $pgndata = $this->elements->paginatndata($pagenum,$rspgs);
                    $pgnhtml = $this->elements->paginationhtml($pagenum,$pgndata['start_loop'],$pgndata['end_loop'],$rspgs);
                    //print_r($getres);exit;

                    $getresult = $this->miscommon->fetchpendigannualdisclsr($getuserid,$user_group_id,$annualyr,$rslmt);
                }
                else if($filterstatus == 'sent_for_approval') 
                {
                    $filterby = ' AND (anualdecl.annualyear='.$annualyr.' OR anualdecl.annualyear IS NULL) AND anualdecl.send_status= 1';
                    $mainquery = $filterby.' AND (memb.`fullname` LIKE "%'.$searchby.'%") ';
                    $getres = $this->miscommon->fetchmisannualdisclsr($getuserid,$user_group_id,$annualyr,$mainquery);
                    /* start pagination */
                    //print_r($getres);exit;
                    $rsstrt = ($pagenum-1) * $noofrows;
                    $rslmt = $filterby.' AND (memb.`fullname` LIKE "%'.$searchby.'%") LIMIT '.$rsstrt.','.$noofrows;
                    $rscnt=count($getres);
                    $rspgs = ceil($rscnt/$noofrows);
                    $pgndata = $this->elements->paginatndata($pagenum,$rspgs);
                    $pgnhtml = $this->elements->paginationhtml($pagenum,$pgndata['start_loop'],$pgndata['end_loop'],$rspgs);
                    //print_r($getres);exit;

                    $getresult = $this->miscommon->fetchmisannualdisclsr($getuserid,$user_group_id,$annualyr,$rslmt);
                    //print_r($getresult);exit;
                }
                
                
                
                if($getresult)
                {
                    $data = array("logged" => true,'message' => 'Record Added','data' => $getresult,'user_group_id'=>$user_group_id,"pgnhtml"=>$pgnhtml);
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
    
    // ****************************  fetch All Upsi table start***************************
    public function fetchallupsitypesAction()
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
                $getres = $this->miscommon->fetchallupsitypes($getuserid,$user_group_id,$mainquery);
                /* start pagination */
                $rsstrt = ($pagenum-1) * $noofrows;
                $rslmt =' LIMIT '.$rsstrt.','.$noofrows;
                $rscnt=count($getres);
                $rspgs = ceil($rscnt/$noofrows);
                $pgndata = $this->elements->paginatndata($pagenum,$rspgs);
                $pgnhtml = $this->elements->paginationhtml($pagenum,$pgndata['start_loop'],$pgndata['end_loop'],$rspgs);
                
                $getres = $this->miscommon->fetchallupsitypes($getuserid,$user_group_id,$rslmt);
                // print_r($getres);exit;
                if(!empty($getres))
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
    
    public function fetchallupsiexportAction()
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
                $request=$this->request->getPost('request');
                $getres = $this->miscommon->fetchallupsitypes($getuserid,$user_group_id,'');
                //print_r($getres);exit;
                if($request=="pdf")
                {
                   $gethtml=$this->miscommon->allupsihtml($getres);
                   $genfile =$this->dompdfgen->getpdf($gethtml,"upsitypeclassify","upsi","misrecip");
                }
                else
                {
                 $genfile = $this->phpimportexpogen->fetchallupsiexportexcel($getuserid,$user_group_id,$getres);
                }
              
                 // print_r($genfile);exit;

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
    
    public function ExportSharedInfoAction()
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
                $request = $this->request->getPost('request');
                $upsitypeid = $this->request->getPost('upsitypeid');
                $query = '';
                $getres = $this->miscommon->fetchinfosharing($getuserid,$user_group_id,$upsitypeid,$query);
                //print_r($getres);exit;
                $genfile = $this->phpimportexpogen->fetchSharedInfoexcel($getuserid,$user_group_id,$getres);
                //print_r($genfile);exit;
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
    
    public function ExportArchiveSharedInfoAction()
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
                $request = $this->request->getPost('request');
                $upsitypeid = $this->request->getPost('upsitypeid');
                $query = '';
                $getres = $this->miscommon->fetcharchiveinfosharing($getuserid,$user_group_id,$upsitypeid,$query);
                //print_r($getres);exit;
                $genfile = $this->phpimportexpogen->fetchArchiveSharedInfoexcel($getuserid,$user_group_id,$getres);
                //print_r($genfile);exit;
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


    public function fetchDesigntdPersonMISAction()
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
                $userid = $this->request->getPost('userId');

                $noofrows = $this->request->getPost('noofrows');
                $pagenum = $this->request->getPost('pagenum');

                $noofrows1 = $this->request->getPost('noofrows1');
                $pagenum1 = $this->request->getPost('pagenum1');
                // print_r($noofrows);exit;
                $startdate = $this->request->getPost('startdate');
                $enddate = $this->request->getPost('enddate');

                $startdesdate = $this->request->getPost('startdesdate');
                $enddesdate = $this->request->getPost('enddesdate');


                /*####### Fetch Holding MIS Start #######*/
                if($startdate=='' && $enddate=='')
                {
                    $mainquery = '';
                    $getres = $this->miscommon->getholingmis($userid,$user_group_id,$mainquery);
                    $rsstrt = ($pagenum-1) * $noofrows;
                    $rslmt =' LIMIT '.$rsstrt.','.$noofrows;
                }
                else
                {
                    $mainquery = "   AND (`ts`.`date_of_transaction`>='".$startdate."'  AND  `ts`.`date_of_transaction`<='".$enddate."')";
                    $getres = $this->miscommon->getholingmis($userid,$user_group_id,$mainquery);
                    $rsstrt = ($pagenum-1) * $noofrows;

                    $rslmt =" AND (`ts`.`date_of_transaction`>='".$startdate."'  AND  `ts`.`date_of_transaction`<='".$enddate."')".'  LIMIT '.$rsstrt.','.$noofrows;
                }

                $rscnt=count($getres);
                $rspgs = ceil($rscnt/$noofrows);
                $pgndata = $this->elements->paginatndata($pagenum,$rspgs);
                $pgnhtml = $this->elements->paginationhtml($pagenum,$pgndata['start_loop'],$pgndata['end_loop'],$rspgs);
                $result = $this->miscommon->getholingmis($userid,$user_group_id,$rslmt);
                /*####### Fetch Holding MIS End #######*/     

                /*####### Fetch Relative Holding MIS Start #######*/  
                if($startdesdate == '' && $enddesdate == '')
                {  
                    $mainquery = '';
                    $getres = $this->miscommon->getrelativegmis($userid,$user_group_id,$mainquery);
                    $rsstrt = ($pagenum-1) * $noofrows;
                    $rslmt =' LIMIT '.$rsstrt.','.$noofrows;
                }
                else
                {
                   $mainquery = "   AND (`ts`.`date_of_transaction`>='".$startdate."'  AND  `ts`.`date_of_transaction`<='".$enddate."')";
                   $getres = $this->miscommon->getrelativegmis($userid,$user_group_id,$mainquery);
                   $rsstrt = ($pagenum-1) * $noofrows;
                   $rslmt =" AND (`ts`.`date_of_transaction`>='".$startdate."'  AND  `ts`.`date_of_transaction`<='".$enddate."')".'  LIMIT '.$rsstrt.','.$noofrows;
                }
                $rscnt=count($getres);
                $rspgs = ceil($rscnt/$noofrows);
                $pgndata = $this->elements->paginatndata($pagenum,$rspgs);
                $pgnhtml = $this->elements->paginationhtml($pagenum,$pgndata['start_loop'],$pgndata['end_loop'],$rspgs);
                // print_r($pgnhtml);exit;
                $getres = $this->miscommon->getrelativegmis($userid,$user_group_id,$rslmt);
                /*####### Fetch Relative Holding MIS Start #######*/ 


                $getuserinfo = $this->miscommon->useriformation($userid);
                $relativeinfo = $this->miscommon->getrelativedata($userid,"");
                $accountinfo = $this->miscommon->getaccnoinfo($userid);
                $relativeaccount = $this->miscommon->getrelinfo($userid);
                $mfrdata = $this->miscommon->getmfrdataformis($userid);
                //print_r($getuserinfo);exit;
                $gethtml=$this->miscommon->allDesgntdPersnHtml($getuserinfo,$relativeinfo,$accountinfo,$relativeaccount,$mfrdata,$getres,$result);
                $genfile =$this->dompdfgen->getpdf($gethtml,"misdesgntdpersn","mis","mispersnlinfo");
                //print_r($genfile);exit;
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
    
    
   }

<?php 
class RelholdingsummaryController extends ControllerBase
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
        $this->view->sectype = $this->tradingrequestcommon->securitytype();
            
    }
    
    //############### insert holding summary start ###############
    public function insertholdingsummryAction()
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
                $date=date('d-m-Y');
                //print_r($this->request->getPost());exit;
                $relationtype   = $this->request->getPost('relid','trim');
                $noofshares   = $this->request->getPost('noofshares','trim');
                $sectype   = $this->request->getPost('sectype','trim');
               
                $getres = $this->relholdingsummarycommon->insertholdingsummry($getuserid,$user_group_id,$relationtype,$noofshares,$sectype);
                if($getres)
                {
                    $data = array("logged" => true,'message' => 'Record Added','resdta' => $getres);
                    $this->response->setJsonContent($data);
                }
                else
                {
                    $data = array("logged" => false,'message' => "This company exists in your holding list please edit your entry from list..!!");
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
    //############### insert holding summary end ###############
    
    //############### fetching holding summary start ###############
    public function fetchholdingsummaryAction()
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
                $getres = $this->relholdingsummarycommon->fetchallholdingsummary($getuserid,$user_group_id);
                // print_r($getres);exit;
                
                /* start pagination */
                $rsstrt = ($pagenum-1) * $noofrows;
                $rslmt =' LIMIT '.$rsstrt.','.$noofrows;
                $rscnt=count($getres['data']);
                $rspgs = ceil($rscnt/$noofrows);
                $pgndata = $this->elements->paginatndata($pagenum,$rspgs);
                $pgnhtml = $this->elements->paginationhtml($pagenum,$pgndata['start_loop'],$pgndata['end_loop'],$rspgs);
                $result = $this->relholdingsummarycommon->fetchholdingsummary($getuserid,$user_group_id,$rsstrt,$noofrows);
                 // print_r($rsstrt."  ".$noofrows);exit;
                end($result['data']);
                $key = key( $result['data'] );   // get end number of key
                $getequity = $this->relholdingsummarycommon->fetchequity($getuserid,$getres['companyid'],$rsstrt,$noofrows);
                $getprefereence = $this->relholdingsummarycommon->fetchprefereence($getuserid,$getres['companyid'],$rsstrt,$noofrows);
                $getdebenure = $this->relholdingsummarycommon->fetchdebenure($getuserid,$getres['companyid'],$rsstrt,$noofrows);


                 // $allclosebal=$this->generatemisrelative($result,$getequity,$getprefereence,$getdebenure);

                // print_r($getequity);exit;
                
                if(!empty($result['data']))
                {
                    $data = array("logged" => true,'message' => 'Record Added','resdta'=>$result['data'],'data'=>$getres,'user_group_id'=>$user_group_id,'user_id'=>$getuserid,'equity'=>$getequity,'prefer'=>$getprefereence,'debenture'=>$getdebenure,'pgnhtml'=>$pgnhtml,'pagefrm'=>$rsstrt,'len'=>$key);
                    $this->response->setJsonContent($data);
                }
                else
                {
                    $data = array("logged" => false,'message' => "Record Not Added..!!",'pgnhtml'=>$pgnhtml);
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
    //############### fetching holding summary end ###############
    
    //############### edit holding summary end ###############
    public function holdingsummaryeditAction()
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
                //print_r($id);exit;
                $getres = $this->relholdingsummarycommon->holdingsummaryedit($id);
                if($getres)
                {
                    $data = array("logged" => true,'message' => 'Record Found','data'=>$getres);
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
    //############### edit holding summary end ###############
    
    
     //############### update holding summary start ###############
     public function updateholdingsummryAction()
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
                
                $equity   = $this->request->getPost('equity','trim');
                $prefernc   = $this->request->getPost('prefernc','trim');
                $debenture   = $this->request->getPost('debenture','trim');
                $id   = $this->request->getPost('tempid','trim');
                
                //echo "checking form data";print_r($this->request->getPost()); exit;
                
                    $getres = $this->relholdingsummarycommon->updateholdingsummry($getuserid,$user_group_id,$equity,$prefernc,$debenture,$id);
                    //print_r($getres);exit;
                        
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
    //############### update holding summary end ###############

     public function generatemisrelative($getres,$getequity,$getprefereence,$getdebenure)
    {
        //echo '<pre>'; print_r($getdata); exit;
        $addhtmlnxt = '';
       
            
            
            /* --------------- html process Start --------------- */
            $sum1=0;    $sum2=0;    $sum3=0;
            foreach($getres['data'] as $kyres => $resdata)
            {   
                 print_r($resdata['relationshipname']); 
                
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
                    print_r($equityclosblnc); 
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
            
          
            
                
         // echo '<pre>'; print_r($sum1);
            
      
        
    }

    
    
    
}


    
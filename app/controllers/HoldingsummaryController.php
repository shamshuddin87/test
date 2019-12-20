<?php 
class HoldingsummaryController extends ControllerBase
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
                $listedcomp   = $this->request->getPost('compid','trim');
                $noofshares   = $this->request->getPost('noofshares','trim');
                $sectype   = $this->request->getPost('sectype','trim');
               
                $getres = $this->holdingsummarycommon->insertholdingsummry($getuserid,$user_group_id,$listedcomp,$noofshares,$sectype);
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
                $getres = $this->holdingsummarycommon->fetchallholdingsummary($getuserid,$user_group_id);
                
                
                /* start pagination */
                $rsstrt = ($pagenum-1) * $noofrows;
                $rslmt =' LIMIT '.$rsstrt.','.$noofrows;
                $rscnt=count($getres['data']);
                $rspgs = ceil($rscnt/$noofrows);
                $pgndata = $this->elements->paginatndata($pagenum,$rspgs);
                $pgnhtml = $this->elements->paginationhtml($pagenum,$pgndata['start_loop'],$pgndata['end_loop'],$rspgs);
                $result = $this->holdingsummarycommon->fetchholdingsummary($getuserid,$user_group_id,$rsstrt,$noofrows);
                end($result['data']);
                $key = key( $result['data'] );   // get end number of key
                $getequity = $this->holdingsummarycommon->fetchequity($getuserid,$getres['companyid'],$rsstrt,$noofrows);
                $getprefereence = $this->holdingsummarycommon->fetchprefereence($getuserid,$getres['companyid'],$rsstrt,$noofrows);
                $getdebenure = $this->holdingsummarycommon->fetchdebenure($getuserid,$getres['companyid'],$rsstrt,$noofrows);
                
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
                $getres = $this->holdingsummarycommon->holdingsummaryedit($id);
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
                
                    $getres = $this->holdingsummarycommon->updateholdingsummry($getuserid,$user_group_id,$equity,$prefernc,$debenture,$id);
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
    
    
    
}


    
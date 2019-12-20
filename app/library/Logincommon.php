<?php
use Phalcon\Mvc\User\Component;

class Logincommon extends Component
{
    
    public function checkusermylogin($username,$pwd)
    {
		$connection = $this->dbtrd;
		$getemail 	=	strtolower($username);
        
        $timeago = time();
        
		$statement 	= "SELECT * FROM `web_employee` WHERE LOWER(`emaild`) = '" . $getemail. "' AND (`password` = SHA1(CONCAT(salt, SHA1(CONCAT(salt, SHA1('" . $pwd . "'))))) OR `password` = '" . md5($pwd) . "') AND STATUS = '1'";
        //echo $statement;exit;
		try 
        { 
			$numrowch = $connection->query($statement);
			if((trim($numrowch->numRows()))==1)
			{
				$getinfo = "SELECT we.*
                            FROM `web_employee` we 
                            WHERE LOWER(we.`emaild`) = '".$getemail."'";
				try 
                {
					$result_get = $connection->query($getinfo);
					$robot = $result_get->fetch();
					//echo '<pre>';print_r($robot);exit;
                    $getuserid = $robot['id'];
                    $dir_uname = $robot['fname']." ".$robot['lname'];
                    //echo '<pre>';print_r($dir_uname);exit;
                    
                    $this->elements->createdirectoryofuser($getuserid,$dir_uname);
                    //exit;
                    
                    // ------------------ ModuleData Start ------------------
                        $mnhgh = array('uid'=>$robot['id']);
                        $getdtl = $this->logincommon->fetchModulemlp($mnhgh);
                        //echo '<pre>';print_r($getdtl);exit;
                    // ------------------ ModuleData End ------------------

                    $this->session->remove('loginauthspuserfront');
                    /* =================== SET Values In Session START =================== */
                        $setsession = $this->session->set('loginauthspuserfront',array(
                            'id' => trim($robot['id']),
                            'user_group_id' => trim($robot['user_group_id']),
                            'username' => trim($dir_uname),
                            'firstname' => trim($this->elements->htmldecode($robot['fname'])),
                            'lastname' => trim($this->elements->htmldecode($robot['lname'])),
                            'email' => strtolower($robot['emaild']),'moduleaccess'=>$getdtl,
                            'master' => $robot['userid'],'mastergroup' => ''
                        ));
                    /* =================== SET Values In Session END =================== */
                        //echo '<pre>'; print_r($this->session->loginauthspuserfront); exit;

			        $updatetimelogin = "UPDATE `web_employee` SET `timeago` = '".$timeago."' WHERE `id`='".$robot['id']."' ";
					$connection->query($updatetimelogin);
                    
                    $data = array("logged" => true,'message' => 'Its Login insert id- ' .$robot['id'] , 
                                  'user_group_id' => $robot['user_group_id'],'fieldname'=>'loginpage');
				} 
				catch (Exception $e) {if(!empty($e)){
						$error = $e;
						$data = array("logged" => false,'message' => $error->errorInfo['2'],);
					}
				}	
			}
			else
			{
				$data = array("logged" => false,'message' => '');
			}
		} 
		catch (Exception $e) {if(!empty($e)){
				$error = $e;
				$data = array("logged" => false,'message' => $error->errorInfo,);
			}
		}
		return $data;	
	}
    
    
	public function checkuserlogin($username,$pwd)
    {
		$connection = $this->db;
		$connectiondbtrd = $this->dbtrd;
        $timeago = time();
        
		$getemail 	=	strtolower($username);
        
        $statement 	= "SELECT * FROM `web_register_user` WHERE LOWER(`email`) = '" . $getemail. "' AND (`password` = SHA1(CONCAT(salt, SHA1(CONCAT(salt, SHA1('" . $pwd . "'))))) OR `password` = '" . md5($pwd) . "') AND STATUS = '1'";
        //echo $statement;exit;
		try 
        { 
			$numrowch = $connection->query($statement);
			if((trim($numrowch->numRows()))==1)
			{
				$getinfo = "SELECT we.*
                            FROM `web_register_user` we 
                            WHERE LOWER(we.`email`) = '".$getemail."'";
				try 
                {
					$result_get = $connection->query($getinfo);
					$robot = $result_get->fetch();
                    //echo '<pre>';print_r($robot);exit;
                    $getuserid = $robot['user_id'];
                    $dir_uname = $robot['username'];
                    
                    $this->elements->createdirectoryofuser($getuserid,$dir_uname);
                    //exit;
                    
                    // ------------------ ModuleData Start ------------------
                        $mnhgh = array('uid'=>$robot['user_id']);
                        $getdtl = $this->logincommon->fetchModulemlp($mnhgh);
                        //echo '<pre>';print_r($getdtl);exit;
                    // ------------------ ModuleData End ------------------

                    // ------------------ BoardData Start ------------------
                        /*$board = $this->logincommon->boardappdata($robot['user_id'],$getemail);
                        //echo '<pre>';print_r($board);exit;
                        if(empty($board))
                        {   
                            $board=$robot;
                            $board['empl']='empl';
                        }*/
                        //echo '<pre>';print_r($board);exit;
                    // ------------------ BoardData End ------------------

                    /* =================== SET Values In Session START =================== */
                        $setsession = $this->session->set('loginauthspuserfront',array(
                        'id' => trim($robot['user_id']),
                        'user_group_id' => trim($robot['user_group_id']),
                        'username' => trim($this->elements->htmldecode($robot['username'])),
                        'firstname' => trim($this->elements->htmldecode($robot['firstname'])),
                        'lastname' => trim($this->elements->htmldecode($robot['lastname'])),
                        'email' => strtolower($robot['email']),'moduleaccess'=>$getdtl,
                        'master' => $robot['master_user_id'],'mastergroup' => $robot['master_group_id']
                        ));
                        //echo '<pre>'; print_r($setsession); exit;
                    /* =================== SET Values In Session END =================== */
                        //exit;
                    
                    $updatetimelogin = "UPDATE `web_register_user` SET `timeago` = '".$timeago."' WHERE `user_id`='".$robot['user_id']."' ";
					$connection->query($updatetimelogin);
                    
                    
                    $data = array("logged" => true,'message' => 'Its Login insert id- ' .$robot['user_id'] , 'user_group_id' => $robot['user_group_id'],'fieldname'=>'loginpage');
                    //echo $dir_uname;exit;
                    
				} 
				catch (Exception $e){if(!empty($e)){
						$error = $e;
						$data = array("logged" => false,'message' => $error->errorInfo['2'],);
					}
				}	
			}
			else
			{
				$data = array("logged" => false,'message' => '');
			}
		} 
		catch (Exception $e){if(!empty($e)){
				$error = $e;
				$data = array("logged" => false,'message' => $error->errorInfo,);
			}
		}
		return $data;	
	}
    
/* ------------------ ModuleData End ------------------ */
    public function fetchModulemlp($mnhgh)
    {
         $connection = $this->dbcdata;
         //echo '<pre>';print_r($mnhgh);exit;
         $querysql = "SELECT * FROM `web_u_role_rights` wur
         INNER JOIN `web_u_module` wum ON wum.`mod_modulecode`= wur.`rr_modulecode`
         WHERE wur.`rr_uid`='".$mnhgh['uid']."'
         ORDER BY wur.`rr_modulecode` ASC ";
         //echo $querysql;exit;
         try
         {
                $exesql = $connection->query($querysql);
                $getnum = trim($exesql->numRows());
                if($getnum!=0)
                {
                    while($row = $exesql->fetch())
                    {
                        $getlist[] = $row;
                    }
                    //echo '<pre>';print_r($getlist);exit;
                }
                else{   $getlist = array();     }
          }
          catch (Exception $e)
          {
                $getlist = array();
          }
        return $getlist;
    }
/* ------------------ ModuleData End ------------------ */
    
/* ------------------ BoardData Start ------------------ */
    public function boardappdata($getuserid,$getemail)
    {
        $connection = $this->dbtrd;
        //echo $getuserid.'*'.$getemail;exit;

        $getlist = array();

        $querysql = "SELECT * FROM `web_employee`
        WHERE `id`='".$getuserid."' AND `emaild`='".$getemail."' ";
        //echo $querysql;exit;
        try
        {
            $exesql = $connection->query($querysql);
            $getnum = trim($exesql->numRows());
            if($getnum!=0)
            {
                $getlist = $exesql->fetch();
                $getlist['empl']='empl';
                //echo '<pre>';print_r($getlist);exit;
            }
            else{   $getlist = array();     }
        }
        catch (Exception $e)
        {
            $getlist = array();
        }
        return $getlist;
    }
/* ------------------ BoardData End ------------------ */
    
    
    
    public function getuserinfo($uid,$tp)
    {
        $connection = $this->dbtrd;
        if($tp=='one')
        {
           $exegetgeo = "SELECT wru.* FROM `web_register_user` wru 
            WHERE wru.`user_id`='".$uid."' AND  wru.`status`='1' "; 
        }
        else
        {
            $exegetgeo = "SELECT wru.* FROM `web_register_user` wru WHERE wru.`status`='1'";
        }
        
        
        //echo $exegetgeo;exit;
        try
        {
            $bhimrao = $connection->query($exegetgeo);
            $getnum = trim($bhimrao->numRows());
            if($getnum!=0)
            {
                $newarray ='';
                while($row = $bhimrao->fetch())
                {
                    $newarray[] = $row;
                }
                $getlist = $newarray;
            }
            else{
                $getlist = array();
            }
        }
        catch (Exception $e) {
            $getlist = array();
        }
        return $getlist;
    }
    public function loginusermnadmintoup($type,$getemail)
    {
        $connection = $this->dbtrd;
        $getinfo = "SELECT we.* FROM `web_register_user` we 
            WHERE LOWER(we.`email`) = '".$getemail."' ";
        
        try
        {
            $result_get = $connection->query($getinfo);
            $robot = $result_get->fetch();
            //echo '<pre>';print_r($robot);exit;
            $getuserid = $robot['user_id'];
                
            $getlist = $this->session->set('loginauthspuserfront',array(
            'id' => trim($robot['user_id']),
            'user_group_id' => trim($robot['user_group_id']),
            'username' => trim($this->elements->htmldecode($robot['username'])),
            'firstname' => trim($this->elements->htmldecode($robot['firstname'])),
            'lastname' => trim($this->elements->htmldecode($robot['lastname'])),
            'email' => strtolower($robot['email']) )
            );

            /*################### Organisation details get ##########################*/
                /*$getorgdtl = $this->commonquerycommon->fetchorgdetl($getuserid);
                if(count($getorgdtl)>0)
                {
                    $mgetorgdtl = array_shift($getorgdtl);
                    $this->session->set('orgdtl',$mgetorgdtl);
                }*/
            /*################### Organisation details get /-##########################*/
            
        }
        catch (Exception $e) {
            $getlist = array();
        }
        return $getlist;
        
    }
    
    
}							
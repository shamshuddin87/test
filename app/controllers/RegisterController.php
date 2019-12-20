<?php /*if ( ! defined('APP_PATH')) exit('No direct script access allowed');*/
use \Phalcon\Paginator\Adapter\QueryBuilder as PaginacionBuilder;
use \Phalcon\Http\Request;
use \Phalcon\Filter;
// Getting a request instance
$request = new Request();
class RegisterController extends ControllerBase
{
    public function initialize()
    {
        $this->tag->setTitle('Sign Up/Sign In');
        parent::initialize();
    }

    /**
     * Action to register a new user
     */
    public function indexAction()
    {
        return $this->response->redirect('index');
    }
	public function registerchecAction()
    {
    	$connection = $this->db;
		$filter = new Filter();
        $this->view->disable();
 		//echo print_r($this->request->getPost());exit();
        //si es una petición post
        if($this->request->isPost() == true) 
        {
            //si es una petición ajax
            if($this->request->isAjax() == true) 
            {
				//$cname = $_POST["firstname"]; this works;
				$ip = $this->request->getClientAddress();
				$firstname = $this->request->getPost('firstname', array('striptags', 'trim'));
				$lastname = $this->request->getPost('lastname', array('striptags', 'trim'));
				
				$firstnamecheck =  $this->elements->allownumalphahyphen($firstname);
				$lastnamecheck =  $this->elements->allownumalphahyphen($lastname);
				
				$dir_uname = trim($firstname." ".$lastname);
				$pwd = $this->request->getPost('password');
				$pwdcharter = $this->elements->pwdcharregex($pwd);
				//echo $pwd ;exit;
				$date	= trim($_POST["dateofbirth"]);$month= trim($_POST["dateofbirthmonth"]);$year= trim($_POST["dateofbirthyear"]);
				$finaldob =  $year."-".$month."-".$date;
				$youremail = strtolower(trim($_POST["youremail"]));
				$youremail = $this->validationcommon->emailvalidate($youremail);
				$dobcheck  = $this->validationcommon->dobvalidate($date,$month,$year);
				$getgender = $this->request->getPost('malefemalegender', array('striptags', 'trim'));

				if(empty($firstname))
				{
					$data = array("logged" => false,'message' => 'Please Provide Your First Name','fieldname'=>'fnameerrormsg');
					$this->response->setJsonContent($data);
				}
				else if(empty($lastname))
				{
					$data = array("logged" => false,'message' => 'Please Provide Your Last Name','fieldname'=>'lnameerrormsg');
					$this->response->setJsonContent($data);
				}
				else if($firstnamecheck==true)
				{
					$data = array("logged" => false,'message' => 'Your Firstname Contains Special Character','fieldname'=>'pwderrormsg');
					$this->response->setJsonContent($data);
				}
				else if($lastnamecheck==true)
				{
					$data = array("logged" => false,'message' => 'Your Lastname Contains Special Character','fieldname'=>'pwderrormsg');
					$this->response->setJsonContent($data);
				}
				else if($pwdcharter==true)
				{
					$data = array("logged" => false,'message' => 'Password Contains Special Character','fieldname'=>'pwderrormsg');
					$this->response->setJsonContent($data);
				}
				else if($youremail==false)
				{
					$data = array("logged" => false,'message' => 'Your Email is not valid','fieldname'=>'emailrrormsg');
					$this->response->setJsonContent($data);
				}
				else if(empty($pwd))
				{
					$data = array("logged" => false,'message' => 'Password is Blank','fieldname'=>'pwderrormsg');
					$this->response->setJsonContent($data);
				}
				else if($dobcheck==false)
				{
					$data = array("logged" => false,'message' => 'Not valid date of Birth','fieldname'=>'doberrormsg');
					$this->response->setJsonContent($data);
				}
				else if(empty($getgender) || ($getgender!=('1' || '2')))
				{
					$data = array("logged" => false,'message' => 'Not valid Gender','fieldname'=>'gendererrormsg');
					$this->response->setJsonContent($data);
				}
				else
				{
				
					$getemail =	$connection->escapeString($_POST["youremail"]);
					$statement = ('SELECT * FROM `web_login` WHERE LOWER(`email`) = '.$getemail);
					
					try {
						$numrowch = $connection->query($statement);
						
						if((trim($numrowch->numRows()))==1)
						{
							$data = array("logged" => false,'message' => 'Email Already Exist','fieldname'=>'emailrrormsg');
							$this->response->setJsonContent($data);
						}
						else
						{
							$username 	= $connection->escapeString(($firstname." ".$lastname));
							$firstname 	= $connection->escapeString($firstname);
							$lastname 	= $connection->escapeString($lastname);
							$getemail 	= strtolower($getemail);
							//echo $pwd;exit;
							$saltget  	= ($salt = substr(md5(uniqid(rand(), true)), 0, 9));
							$pwdgene 	= (sha1($salt . sha1($salt . sha1($pwd)))) ; 
							$timeago = time();
							$executeit 	= ('INSERT INTO `web_login` (`user_group_id`,
                            `username`,`firstname`, 
                            `lastname`, `email`, `salt` ,
                            `password`,`date_added`,
                            `date_modified`,
                            `status`,
                            `timeago`) 
                            VALUES ("1",'.$username.',
                            '.$firstname.','.$lastname.',
                            '.$getemail.', "'.$saltget.'",
                            "'.$pwdgene.'",NOW(),NOW(),
                            "1","'.$timeago.'")');
							echo $executeit ;exit;
							try {
							$result = $connection->execute($executeit);
							$id 	= $connection->lastInsertId();
								if($result)
								{
									
									$executeprofile = ('INSERT INTO `web_user_about` (`user_id`) VALUES ('.$ip.'",NOW(),NOW())');
									try {
									$result_profile = $connection->execute($executeprofile);
									
									if($result_profile)
									{
										$data = array("logged" => true,'message' => 'Last insert id'.$id ,'fieldname'=>'noofiled',"photouploaded"=>false);
										$setsession = $this->session->set('loginauths',array('id' => $id,'user_group_id' => '1',
										'username' => (trim($this->elements->htmldecode($_POST["firstname"]))." ".(trim($this->elements->htmldecode($_POST["lastname"])))),
										'firstname' => trim($this->elements->htmldecode($_POST["firstname"])),
										'lastname' => trim($this->elements->htmldecode($_POST["lastname"])),
										'email' => trim(strtolower($_POST["youremail"])),
										));
										$this->response->setJsonContent($data);
									}
									else
									{
										$data = array("logged" => false,'message' => 'Something went Wrong','fieldname'=>'formerrormsg');
										$this->response->setJsonContent($data);
									}
									}
									catch (Exception $e) {if(!empty($e)){
											$error = $e;
											$data = array("logged" => false,'message' => $error->errorInfo['2'],);
											$this->response->setJsonContent($data);}
									}
								}
								else
								{
									$data = array("logged" => false,'message' => 'Something went Wrong','fieldname'=>'formerrormsg');
									$this->response->setJsonContent($data);
								}
							}
							catch (Exception $e) {if(!empty($e)){
											$error = $e;
											$data = array("logged" => false,'message' => $error->errorInfo['2'],);
											$this->response->setJsonContent($data);}
									}
						}
						
						$this->response->setJsonContent($data);
					
					}
					catch (Exception $e) {if(!empty($e)){
											$error = $e;
											$data = array("logged" => false,'message' => $error->errorInfo['2'],);
											$this->response->setJsonContent($data);}
									}
				}
				$this->response->send();
				$connection->close();
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

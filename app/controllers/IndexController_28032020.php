<?php
/*--------------------------------VIDM AND SAP-----------------------------------*/
// require_once ('../../simplesamlphp/lib/_autoload.php');
// require_once('../app/library/HTTP_Request2/HTTP/Request2.php');
// require_once('../app/library/HTTP_Request2/vendor/autoload.php');
/*--------------------------------VIDM AND SAP-----------------------------------*/

class IndexController extends ControllerBase
{
    public function initialize()
    {
        $this->tag->setTitle('Welcome to ');
		$this->elements->checkalreadyuserloggedin();
		
        parent::initialize();
    }

   public function indexAction()
    {
/*--------------------------------VIDM AND SAP-----------------------------------*/
        // $as = new SimpleSAML_Auth_Simple('drreddy-sp');
        // $as->requireAuth();
        // $attributes = $as->getAttributes();
        // $vidm_loggedemail = $attributes['email'][0];
        // $vidm_userid = $as->getAuthData("saml:sp:NameID")->value;
        // $auth_userid = "P40000266"; // it should be same auth_userid used for sap api
        // $pasword = "SAPCloud@99"; // it sud be same for each user
        // $authorization_code = $auth_userid.":".$pasword;
        // $emp_user_id =  $vidm_userid;//T00000256 to be provided in vidm attribute set
        // $emp_user_id = $this->commonquerycommon->checkforempuserid($emp_user_id);   
        // //print_r($emp_user_id);die;
        // if($emp_user_id) //if emp_user_id exist
        // {
        //    $this->view->vidmemail = $vidm_loggedemail; //'simply@consultlane.com';
        // }
        // else
        // {  
        //     $vidm_loggedemail = $vidm_loggedemail;//'simply@consultlane.com';//to be commented
        //     $request = new HTTP_Request2();
        //     $request->setUrl('https://drl-test.apimanagement.eu2.hana.ondemand.com:443/ZHR_INTERFACE_SRV_01/Emp_detailsSet?$filter=(Aedtm%20eq%20datetime%272019-11-1T00:00:00%27)&saml2=disabled');
        //     $request->setMethod(HTTP_Request2::METHOD_GET);
        //     $request->setConfig(array(
        //       'follow_redirects' => TRUE
        //     ));
        //     $request->setHeader(array(
        //       'Authorization' => 'Basic '.base64_encode($authorization_code)
        //     ));

        //       $response = $request->send();
        //       if ($response->getStatus() == 200) {
        //         $header = $request->getHeaders();
        //         $encoded_credentials = str_replace("Basic ", "", $header['authorization']);
        //         $decoded_credentials = base64_decode($encoded_credentials);
        //         $decoded_credentials = explode(":", $decoded_credentials);
        //         $auth_userid = $decoded_credentials[0];
        //         $password = $decoded_credentials[1];
        //         $xmlbody = $response->getBody();
        //         $xmlbody = str_replace('d:', '', $xmlbody);
        //         $xmlbody = str_replace('m:', '', $xmlbody);
        //         $xml = simplexml_load_string($xmlbody);
        //         //$xml = simplexml_load_file("../app/library/load.xml");
        //         $json = json_encode($xml);
        //         $userdata = json_decode($json,TRUE);

        //         for($i=0;$i<count($userdata['entry']);$i++)
        //         {
        //             //$empuserid = 'P00026428';
        //             if($userdata['entry'][$i]['content']['properties']['EmpUsrid'] == $emp_user_id)
        //             {
        //                 $post_params = array
        //             (
        //             'empuserid' => $userdata['entry'][$i]['content']['properties']['EmpUsrid'],
        //             'employeecode' => $userdata['entry'][$i]['content']['properties']['Pernr'],
        //             'firstname' => $userdata['entry'][$i]['content']['properties']['Vorna'],
        //             'lastname' => $userdata['entry'][$i]['content']['properties']['Lnamr'],
        //             'email' => $vidm_loggedemail,//$userdata['entry']['content']['properties']['Email'],
        //             'designation' => $userdata['entry'][$i]['content']['properties']['PlansText'],
        //             'dpdate' => $userdata['entry'][$i]['content']['properties']['Hiredate'],
        //             'deptaccessid' => $userdata['entry'][$i]['content']['properties']['KostlText'],
        //             'gender' => $userdata['entry'][$i]['content']['properties']['Gesch'],
        //             'role_id' => $userdata['entry'][$i]['content']['properties']['PerskText'],
        //             'mobile' => '',
        //             'reminderdays' => '',
        //             'accrgt' => '',
        //             'cmpnyaccessid' => 1,
        //             'typeofusr' => 7,
        //             'approvername' => ''
        //             );
        //             }
        //         }
        //     $this->dispatcher->forward([
        //         'controller' => 'Usermaster',
        //         'action' => 'insertmasterlist',
        //         'params' => $post_params
        //           ]);
        //       }
        //       else {
        //         echo 'Unexpected HTTP status: ' . $response->getStatus() . ' ' .
        //         $response->getReasonPhrase();
        //       }
        // }
/*--------------------------------VIDM AND SAP-----------------------------------*/
    }

    
		
}

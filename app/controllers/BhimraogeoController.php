<?php
class BhimraogeoController extends ControllerBase
{
    public function initialize()
    {
        $getuserid = $this->session->loginauthspuserfront['id'];
        parent::initialize();

    }
    public function indexAction()
    {
        return $this->response->redirect('errors/show404');
        exit('No direct script access allowed');
    }
    public function getgeolocationAction()
    {
        $connection = $this->dbtrd;
        $this->view->disable();
        $getuserid = $this->session->loginauthspuserfront['id'];
        $devicedetect = $this->devicedetect;
        if($this->request->isPost() == true)
        {
            if($this->request->isAjax() == true)
            {

                $ip =  $this->request->getPost('getip');
                $ip = $this->filter->sanitize($ip, "trim");

                $getipvalidate = $this->validationcommon->validateip($ip);

                    if($getipvalidate==true)
                    {
                        $geo = unserialize(file_get_contents("http://www.geoplugin.net/php.gp?ip=".$ip));


                        $getdevice = $devicedetect->getdeviceinfo();
                        //echo $getdevice['devicetype']." ".$getdevice['useragent'] ;exit;

                        $geoplugin_status = isset($geo["geoplugin_status"]) ? $geo["geoplugin_status"] : '';
                           if($geoplugin_status===200)
                            {
                                $country = $geo["geoplugin_countryName"];
                                $country_code = $geo["geoplugin_countryCode"];
                                $region = $geo["geoplugin_region"];
                                $region_code = $geo["geoplugin_regionCode"];
                                $city = $geo["geoplugin_city"];
                                $currencyCode = $geo["geoplugin_currencyCode"];
                                $currencySymbol = $geo["geoplugin_currencySymbol"];
                                $currencySymbol_UTF8 = $geo["geoplugin_currencySymbol_UTF8"];
                                $longitude = $geo["geoplugin_longitude"];
                                $latitude = $geo["geoplugin_latitude"];
                            }
                            else
                            {
                                $country = "webpagenotfound";
                                $country_code = "webpagenotfound";
                                $region = "webpagenotfound";
                                $region_code = "webpagenotfound";
                                $city = "webpagenotfound";
                                $currencyCode = "webpagenotfound";
                                $currencySymbol = "webpagenotfound";
                                $currencySymbol_UTF8 = "webpagenotfound";
                                $longitude = "webpagenotfound";
                                $latitude = "webpagenotfound";
                            }

                            $getcomplete = $this->querybrucecommon->geotrackingphp($country,
                                                                    $country_code,
                                                                    $region,
                                                                    $region_code,
                                                                    $city,
                                                                    $currencyCode,
                                                                    $currencySymbol,
                                                                    $currencySymbol_UTF8,
                                                                    $longitude,
                                                                    $latitude,$ip,$getuserid);

                        $getstat = $this->querybrucecommon->mobiledetect($getdevice['devicetype'],
                        $getdevice['useragent'],$ip,$getuserid);
                        if($getcomplete || $getstat)
                        {
                            $data = array("logged" => true,'getcontent' => 'Got Content ');
                            $this->response->setJsonContent($data);
                        }
                    }
                    else
                    {
                        $data = array("logged" => false,'getcontent' => 'Could no Content ');
                        $this->response->setJsonContent($data);
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

    public function geolocationAction()
    {
        $this->view->disable();
        $getuserid = $this->session->loginauths['id'];

        if($this->request->isPost() == true)
        {
            if($this->request->isAjax() == true)
            {
                $ip = $this->request->getClientAddress();
                $a = $this->filter->sanitize($this->request->getPost('country_batman'), "trim");
                $b = $this->filter->sanitize($this->request->getPost('countrycode_batman'), "trim");
                $c = $this->filter->sanitize($this->request->getPost('state_batman'), "trim");
                $d = $this->filter->sanitize($this->request->getPost('statecode_batman'), "trim");
                $e = $this->filter->sanitize($this->request->getPost('city_batman'), "trim");
                $f = $this->filter->sanitize($this->request->getPost('street_number_batman'), "trim");
                $g = $this->filter->sanitize($this->request->getPost('route_batman'), "trim");
                $h = $this->filter->sanitize($this->request->getPost('sublocality1_batman'), "trim");
                $i = $this->filter->sanitize($this->request->getPost('sublocality2_batman'), "trim");
                $j = $this->filter->sanitize($this->request->getPost('postalcode_batman'), "trim");
                $k = $this->filter->sanitize($this->request->getPost('lat_batman'), "trim");
                $l = $this->filter->sanitize($this->request->getPost('lng_batman'), "trim");
                $m = $ip;


                $getupdate = $this->querybrucecommon->geotrackinggoogle($a, $b, $c,$d,$e,$f,$g,$h,$i,$j,$k,$l,$m,$getuserid);

                $data = array("logged" => true,'message' => $getupdate);
                $this->response->setJsonContent($data);
                $this->response->send();
            }
            else
            {
                exit('No direct script access allowed -to this area');
                $connection->close();
            }

        }
        else
        {
            return $this->response->redirect('errors/show404');
            exit('No direct script access allowed');
        }

    }
    /* ########################### Automatic EmailShoot CRAWN Start ########################### */
    public function updateemailidAction()
    {
        $datagecur = date('d-m-Y');
        $getuser = $this->employeecommon->crongetwork($datagecur);

        //echo '<pre>';print_r($getuser);exit;
        foreach($getuser as $value)
        {
            //echo '<pre>';print_r($value);exit;

            $diff = date('d-m-Y', strtotime('-'.$value['reminderday'].' day', strtotime($value['tsktedate'])));
            //echo $diff.'<br>';

            if($diff==$datagecur)
            {
                $gewornk ='';$getworklot='';
                if (strpos($value['workallotid'], ',') !== false) {
                    $getworklot = explode(',',$row['workallotid']);
                }
                else
                {
                    $getworklot[] = $value['workallotid'];
                }

                //echo '<pre>';print_r($getworklot);


                $nwarray = '';

                foreach($getworklot as $mnwork)
                {
                    $gework = $this->employeecommon->fetchempdata($uid,$mnwork,'one');
                    $gework = array_shift($gework);
                    $to = $gework['emaild'];
                    $name = $gework['fname']." ".$gework['lname'];

                    $subject = 'Gentle Reminder for Task in ERP Console';
                    $newarraymm = array('name'=>$name,'subject'=>$subject,'desc'=>'Task Must be done before '.$value['tsktedate'].'<br>'.$value['comment']);

                    $chekeml = $this->emailer->cronemail($to,$name,$subject,$newarraymm);

                    $nwarray = array('reminderday'=>$value['reminderday'],'tsktedate'=>$value['tsktedate'],
                                 'emailto'=>$to,'emailsent'=>$chekeml,'reminderdate'=>$diff);
                    //echo '<pre>';print_r($nwarray);
                    $this->employeecommon->initnotifydata($nwarray);

                }

            }


        }

        exit;
        $myfile = fopen("img/cronch/ERP_Crawn_Testing.txt", "w");  //Creates File For Checking Crown Working
        //echo 'Coming here'; exit;
        //echo '<pre>';print_r($getuser);exit;
    }
    /* ########################### Automatic EmailShoot CRAWN End ########################### */
    
    
    public function checklogAction()
    {
        $this->view->disable();
        $data = $this->elements->checkuserloggedinpage();
        //echo '<pre>'; print_r($data); exit;
        
        /* --- Start Destroy Session after 30 minutes --- */
        if($data['status']==true)
        {
            if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) 
            {
                // last request was more than 30 minutes ago
                session_unset();     // unset $_SESSION variable for the run-time 
                session_destroy();   // destroy session data in storage
            }
            $_SESSION['LAST_ACTIVITY'] = time(); // update last activity time stamp
        }
        /* --- End Destroy Session after 30 minutes --- */

        $this->response->setJsonContent($data);
        $this->response->send();
    }
}

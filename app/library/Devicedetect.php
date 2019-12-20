<?php
require_once 'devicedetect/Mobile_Detect.php';
Class Devicedetect extends Phalcon\Mvc\User\Component {

    //private $Hostname = 'smtp.gmail.com';

    public function getdeviceinfo() {
		
        $detect = new Mobile_Detect;
		$deviceType = ($detect->isMobile() ? ($detect->isTablet() ? 'tablet' : 'phone') : 'computer');
        
        $scriptVersion = $detect->getScriptVersion();
        $useragent = isset($_SERVER['HTTP_USER_AGENT']) ? htmlentities($_SERVER['HTTP_USER_AGENT']) : '';
        
        $a = array('devicetype', 'scriptVersion', 'useragent');
        $b = array($deviceType, $scriptVersion, $useragent);
        $c = array_combine($a, $b);
        
        return $c;
    }

}


/*$getos = ($detect->isAndroidOS() ? ($detect->isAndroidOS() ? true : false) : false);
$getos = ($detect->isAndroidOS() ? ($detect->isAndroidOS() ? true : false) : false);
$getos = ($detect->isAndroidOS() ? ($detect->isAndroidOS() ? true : false) : false);
$getos = ($detect->isAndroidOS() ? ($detect->isAndroidOS() ? true : false) : false);
$getos = ($detect->isAndroidOS() ? ($detect->isAndroidOS() ? true : false) : false);
$getos = ($detect->isAndroidOS() ? ($detect->isAndroidOS() ? true : false) : false);
$getos = ($detect->isAndroidOS() ? ($detect->isAndroidOS() ? true : false) : false);
$getos = ($detect->isAndroidOS() ? ($detect->isAndroidOS() ? true : false) : false);

isBlackBerryOS()	bool(false)
isPalmOS()	bool(false)
isSymbianOS()	bool(false)
isWindowsMobileOS()	bool(false)
isWindowsPhoneOS()	bool(false)
isiOS()	bool(false)
isMeeGoOS()	bool(false)
isMaemoOS()	bool(false)
isJavaOS()	bool(false)
iswebOS()	bool(false)
isbadaOS()	bool(false)
isBREWOS()	bool(false)*/
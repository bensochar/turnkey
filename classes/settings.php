<?php
/* DIVICE SWITCH
_______________________________________________________________*/
include('detect/Mobile_Detect.php');
$detect = new Mobile_Detect();

if (strtolower($s_Pref) == 'full') {
    $is_mobile 	= false;
    $is_tablet 	= false;
    $is_ios 	= false;
} else {
$is_mobile 	= ($detect->isMobile() && !$detect->isTablet() || isset($_GET['mobile']))? true : false;
$is_tablet 	= ($detect->isTablet() || isset($_GET['tablet']))? true : false;
$is_ios 	= ($detect->isiOS() || isset($_GET['ios']))? true : false;
    
}
 
$GLOBALS['mobile'] = $is_mobile;
$GLOBALS['tablet'] = $is_tablet;
$GLOBALS['ios'] = $is_ios;






/* Enviroment Switch
_______________________________________________________________*/
$en_prod = array('bluebird.com', 'www.bluebird.com');
$en_stage = array('arcade-staging.com', 'www.arcade-staging.com');
$en_dev = array('bsms4001.com', 'lobsms4001.com', 'bluebirdphase2.com' , 'www.bluebirdphase2.com');

$conflen=strlen('classes');
$B=substr(__FILE__,0,strrpos(__FILE__,'/'));
$A=substr($_SERVER['DOCUMENT_ROOT'], strrpos($_SERVER['DOCUMENT_ROOT'], $_SERVER['PHP_SELF']));
$C=substr($B,strlen($A));
$posconf=strlen($C)-$conflen-0;
$D=substr($C,0,$posconf);

$cHttp = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') ? 'https://' : 'http://';
if (in_array($_SERVER['SERVER_NAME'], $en_prod)) {
$tPath = "https://bluebird.com/";
$bPath = "https://bluebird.com/";
} else if (in_array($_SERVER['SERVER_NAME'], $en_stage)) {
$tPath = $cHttp.''.$_SERVER['SERVER_NAME'].'/';
$bPath = $tPath;
}   else if (in_array($_SERVER['SERVER_NAME'], $en_dev)) {
$tPath = $cHttp.''.$_SERVER['SERVER_NAME'].''.$D;
$bPath = $tPath;
} else {
$tPath = $cHttp.''.$_SERVER['SERVER_NAME'].'/'.$D;
$bPath = $tPath;
}

// Meta Prefetch
$meta_pre  = "\n<link rel=dns-prefetch href=//ajax.googleapis.com>"; // Prefetch Google CDN
$meta_pre .= "\n<link rel=dns-prefetch href=//www.google-analytics.com>"; // Prefetch Google Analytics
// Meta Robots
$meta_robots = '<meta name="robots" content="noindex,nofollow">';
$meta_verify = '<meta name="google-site-verification" content="rGQgy3_OMwrWCLsYBGbCdnVL0ct50LDT-LQM8XW9oI0" />\n<meta name="msvalidate.01" content="F2755313519F06188F14B44E05940408" />';

// Analytics
$ga_url = 'u/ga_debug.js';
$ga_acc = 'UA-35799279-1';


if (in_array($_SERVER['SERVER_NAME'], $en_prod)) {
    error_reporting(0);
    $debug = false;
    $en_prod  = 1;
    $en_stage = 0;
    $en_dev   = 0;
    $ga_url = 'ga.js';
	$meta_robots = $meta_verify;
	
} else if (in_array($_SERVER['SERVER_NAME'], $en_stage)) {
    error_reporting(0);
    $en_prod = 0;
	$en_stage= 1;
	$en_dev  = 0;
	$ga_acc = 'UA-35799279-2';
	$ga_url = 'u/ga_debug.js';
	
} else {
    error_reporting(1);
	$debug     = false;
	$en_prod = 0;
	$en_stage= 0;
	$en_dev  = 1;
	$ga_acc = 'UA-35799279-2';
};



?>

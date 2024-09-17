<?php

/**
 * Bitrix Framework
 * @package bitrix
 * @subpackage main
 * @copyright 2001-2023 Bitrix
 */

use Bitrix\Main;
use Bitrix\Main\Session\Legacy\HealerEarlySessionStart;

require_once(__DIR__."/bx_root.php");
require_once(__DIR__."/start.php");

$application = Main\HttpApplication::getInstance();
$application->initializeExtendedKernel([
	"get" => $_GET,
	"post" => $_POST,
	"files" => $_FILES,
	"cookie" => $_COOKIE,
	"server" => $_SERVER,
	"env" => $_ENV
]);

if (defined('SITE_ID'))
{
	define('LANG', SITE_ID);
}

$context = $application->getContext();
$context->initializeCulture(defined('LANG') ? LANG : null, defined('LANGUAGE_ID') ? LANGUAGE_ID : null);

// needs to be after culture initialization
$application->start();

// constants for compatibility
$culture = $context->getCulture();
define('SITE_CHARSET', $culture->getCharset());
define('FORMAT_DATE', $culture->getFormatDate());
define('FORMAT_DATETIME', $culture->getFormatDatetime());
define('LANG_CHARSET', SITE_CHARSET);

$site = $context->getSiteObject();
if (!defined('LANG'))
{
	define('LANG', ($site ? $site->getLid() : $context->getLanguage()));
}
define('SITE_DIR', ($site ? $site->getDir() : ''));
if (!defined('SITE_SERVER_NAME'))
{
	define('SITE_SERVER_NAME', ($site ? $site->getServerName() : ''));
}
define('LANG_DIR', SITE_DIR);

if (!defined('LANGUAGE_ID'))
{
	define('LANGUAGE_ID', $context->getLanguage());
}
define('LANG_ADMIN_LID', LANGUAGE_ID);

if (!defined('SITE_ID'))
{
	define('SITE_ID', LANG);
}

/** @global $lang */
$lang = $context->getLanguage();

//define global application object
$GLOBALS["APPLICATION"] = new CMain;

if (!defined("POST_FORM_ACTION_URI"))
{
	define("POST_FORM_ACTION_URI", htmlspecialcharsbx(GetRequestUri()));
}

$GLOBALS["MESS"] = [];
$GLOBALS["ALL_LANG_FILES"] = [];
IncludeModuleLangFile(__DIR__."/tools.php");
IncludeModuleLangFile(__FILE__);

error_reporting(COption::GetOptionInt("main", "error_reporting", E_COMPILE_ERROR | E_ERROR | E_CORE_ERROR | E_PARSE) & ~E_STRICT & ~E_DEPRECATED & ~E_WARNING & ~E_NOTICE);

if (!defined("BX_COMP_MANAGED_CACHE") && COption::GetOptionString("main", "component_managed_cache_on", "Y") <> "N")
{
	define("BX_COMP_MANAGED_CACHE", true);
}

// global functions
require_once(__DIR__."/filter_tools.php");

define('BX_AJAX_PARAM_ID', 'bxajaxid');

/*ZDUyZmZZGVmYjRhMDU5Mjg1YzE0MzE4NzczMWIxZDFjY2NjNWY=*/$GLOBALS['_____1626445211']= array(base64_decode('R2V0TW9kdW'.'xlRXZlbn'.'Rz'),base64_decode('RXhlY3V0'.'ZU1'.'v'.'Z'.'HVsZ'.'UV2ZW50RXg='));$GLOBALS['____1982258461']= array(base64_decode('ZG'.'Vma'.'W'.'5l'),base64_decode(''.'Ym'.'FzZT'.'Y0'.'X2R'.'lY29kZQ=='),base64_decode('dW'.'5'.'zZX'.'JpYWxpemU='),base64_decode('aXN'.'fYXJyYX'.'k='),base64_decode('aW5fYX'.'JyYXk='),base64_decode('c2V'.'yaW'.'FsaXpl'),base64_decode('Y'.'mFz'.'ZTY0'.'X2VuY'.'29kZQ=='),base64_decode('bWt0a'.'W1l'),base64_decode('ZG'.'F0ZQ=='),base64_decode('Z'.'GF'.'0ZQ=='),base64_decode('c'.'3RybGVu'),base64_decode('bWt0'.'aW1l'),base64_decode(''.'ZG'.'F0ZQ=='),base64_decode('ZG'.'F0'.'ZQ'.'=='),base64_decode('bWV0'.'aG9'.'kX2'.'V'.'4'.'aXN0cw=='),base64_decode('Y2Fs'.'bF9'.'1c2Vy'.'X2'.'Z'.'1bm'.'N'.'fYX'.'JyYXk='),base64_decode('c3R'.'ybGVu'),base64_decode('c'.'2V'.'yaWFsaXpl'),base64_decode('YmF'.'zZTY0X2Vu'.'Y29kZQ=='),base64_decode('c3Ry'.'bGV'.'u'),base64_decode('aXNfYXJyYX'.'k='),base64_decode('c2V'.'y'.'aWFsaX'.'p'.'l'),base64_decode('YmFzZTY0X2VuY2'.'9kZ'.'Q='.'='),base64_decode('c2Vy'.'aWF'.'saXpl'),base64_decode('Ym'.'FzZTY0X'.'2V'.'uY29'.'kZQ=='),base64_decode('aXNfY'.'XJ'.'y'.'YXk'.'='),base64_decode('a'.'XNfYXJyYXk'.'='),base64_decode('aW5fY'.'XJyYX'.'k='),base64_decode('aW5fYXJyYXk='),base64_decode('bWt0aW1l'),base64_decode('ZGF0ZQ'.'=='),base64_decode('ZGF0ZQ='.'='),base64_decode('ZGF'.'0'.'ZQ=='),base64_decode(''.'bWt'.'0aW1l'),base64_decode('ZGF0ZQ=='),base64_decode('Z'.'GF0ZQ='.'='),base64_decode('a'.'W5fY'.'XJyYXk='),base64_decode(''.'c2VyaWF'.'saXpl'),base64_decode('Y'.'mFz'.'Z'.'T'.'Y0X2VuY'.'29'.'kZ'.'Q'.'=='),base64_decode('aW50dmFs'),base64_decode('dGltZQ'.'=='),base64_decode(''.'Zml'.'sZ'.'V9leGl'.'zdHM'.'='),base64_decode('c'.'3Ry'.'X3JlcGxh'.'Y2U='),base64_decode('Y2x'.'hc3'.'NfZXhpc3Rz'),base64_decode('Z'.'GV'.'ma'.'W'.'5l'));if(!function_exists(__NAMESPACE__.'\\___260683213')){function ___260683213($_1683588509){static $_722920682= false; if($_722920682 == false) $_722920682=array('S'.'U5UUkFORV'.'Rf'.'RURJ'.'V'.'ElP'.'Tg'.'==','WQ==',''.'bWFp'.'bg==','fmNwZ'.'l9tYXBfd'.'m'.'FsdW'.'U=','','','YW'.'xsb'.'3'.'dlZF9jb'.'G'.'F'.'zc'.'2Vz',''.'ZQ==','Z'.'g'.'==','ZQ==','Rg==','WA==','Zg='.'=','bWFpbg='.'=',''.'fmNwZl9tYXBfdmFsdW'.'U=','UG9ydGFs','Rg='.'=','ZQ==','ZQ==','WA==','Rg'.'==',''.'RA==','RA'.'==','bQ==','ZA==','WQ==','Z'.'g='.'=',''.'Zg==','Zg'.'==','Zg'.'==','UG9ydGFs','Rg='.'=','ZQ'.'==','ZQ==','W'.'A='.'=',''.'Rg==','RA==','RA==','bQ='.'=','Z'.'A==','WQ==','bW'.'Fp'.'bg==',''.'T24'.'=','U2'.'V'.'0dG'.'luZ'.'3NDaGFuZ2U=','Zg==','Zg==','Z'.'g='.'=',''.'Zg'.'==','bWF'.'p'.'b'.'g==','fm'.'Nw'.'Zl'.'9tY'.'XBfd'.'mFsdWU=','ZQ==',''.'ZQ==','RA'.'==','ZQ==',''.'ZQ==','Z'.'g='.'=','Zg'.'='.'=','Zg==','ZQ'.'='.'=','bWFpbg'.'==','fmNw'.'Zl'.'9'.'t'.'YXB'.'f'.'dm'.'F'.'sdW'.'U=',''.'ZQ==','Zg'.'==','Z'.'g'.'==','Zg==','Zg'.'==','b'.'WFpbg'.'==','fmNw'.'Zl9'.'t'.'YX'.'B'.'fdmFsdW'.'U'.'=','ZQ'.'==','Zg==','UG9'.'ydGFs','UG9'.'ydGFs','ZQ==','ZQ==',''.'UG'.'9'.'y'.'dGFs','R'.'g'.'==','W'.'A==','Rg==','RA==','ZQ='.'=','Z'.'Q==','RA'.'==','bQ='.'=',''.'Z'.'A'.'==','WQ==','ZQ'.'==',''.'WA==','ZQ='.'=','Rg'.'==',''.'ZQ='.'=','RA==','Z'.'g==','Z'.'Q'.'==','RA==','ZQ='.'=','bQ'.'==','Z'.'A'.'==','WQ==','Z'.'g==','Zg==','Zg'.'==',''.'Zg==','Zg==','Zg==','Zg==',''.'Zg==',''.'bWFpb'.'g==',''.'f'.'mNwZl9tYXBfdmFs'.'dWU'.'=','Z'.'Q==','ZQ==','U'.'G'.'9'.'ydGFs',''.'Rg==',''.'WA==',''.'VF'.'lQR'.'Q==','RE'.'FURQ==',''.'RkVBVFVSRVM=','RVhQ'.'SVJFRA'.'==','VFlQRQ'.'==','RA'.'==','VFJ'.'ZX'.'0'.'RB'.'W'.'VNfQ09VTlQ=','REFURQ==','VFJZX0RBWVNfQ0'.'9VTlQ'.'=','R'.'VhQ'.'SVJFRA==','R'.'kVBVFVS'.'RVM=',''.'Zg==','Zg==',''.'R'.'E9DVU1FTl'.'RfUk9PVA==','L2Jpd'.'HJ'.'peC9tb2R'.'1b'.'GVzLw='.'=','L2l'.'uc'.'3Rhb'.'GwvaW5'.'kZXgucGh'.'w',''.'Lg==','Xw==','c'.'2V'.'hc'.'mNo','Tg==','','','QUNUS'.'V'.'ZF','W'.'Q==','c29ja'.'WF'.'sbmV'.'0d29yaw==',''.'YWxsb3dfZnJ'.'p'.'ZWxk'.'cw==',''.'WQ==','SUQ=','c2'.'9ja'.'WFsb'.'mV0d29yaw'.'==','YWxsb'.'3dfZnJp'.'ZW'.'xk'.'cw==','SUQ=','c2'.'9jaWFsbmV0d29yaw'.'='.'=','Y'.'W'.'xs'.'b3dfZnJpZWxk'.'c'.'w==',''.'Tg='.'=','','','QUNUS'.'V'.'ZF',''.'WQ==','c29ja'.'WF'.'s'.'bmV0'.'d29yaw'.'==','YWxsb3dfbW'.'ljcm'.'9ibG9n'.'X3VzZXI'.'=',''.'WQ'.'==',''.'S'.'UQ'.'=','c29jaW'.'Fs'.'bm'.'V'.'0d2'.'9yaw==','Y'.'Wxsb3dfbWljcm9ib'.'G9'.'nX3VzZXI=','SUQ=',''.'c29ja'.'WFsbmV'.'0d29yaw==','Y'.'Wxsb3d'.'f'.'bWljcm'.'9ibG9'.'n'.'X3V'.'z'.'ZXI=',''.'c29'.'j'.'aWFs'.'bmV0d'.'2'.'9yaw==','YWxsb3df'.'bWljcm9i'.'bG9nX2dyb3Vw','WQ==','SUQ=','c29jaWFsbmV0d29yaw'.'==','YWxs'.'b3df'.'b'.'W'.'ljcm9'.'ibG9nX'.'2dy'.'b3'.'Vw',''.'SUQ=','c29jaWFsbmV0d29yaw'.'==','Y'.'Wx'.'sb3dfbWl'.'jcm9ibG9nX2dy'.'b3'.'Vw','Tg'.'==','','','QUN'.'US'.'VZF',''.'WQ==','c2'.'9jaW'.'Fsbm'.'V'.'0'.'d29y'.'aw==','Y'.'Wxsb3df'.'Z'.'m'.'lsZXNf'.'dXNl'.'cg==','W'.'Q==','SUQ'.'=','c29jaWFsb'.'mV0d29yaw==','Y'.'Wx'.'sb3df'.'ZmlsZX'.'Nfd'.'XNlc'.'g==',''.'SUQ=','c29jaWFsbmV0d29'.'yaw==','YW'.'xsb'.'3dfZ'.'mlsZXNfdXNlc'.'g='.'=','T'.'g==','','','Q'.'UNUSV'.'ZF','WQ==',''.'c29jaWFsb'.'mV0d29'.'ya'.'w==','Y'.'Wxsb3'.'df'.'Y'.'mxvZ'.'1'.'9'.'1c'.'2Vy','WQ='.'=','SUQ=','c29'.'jaWF'.'sbmV0d29ya'.'w==','Y'.'Wxsb3d'.'fYmxvZ191c2'.'V'.'y',''.'S'.'UQ'.'=',''.'c2'.'9ja'.'WF'.'s'.'bmV0d29'.'ya'.'w==','YWx'.'sb3dfY'.'mx'.'vZ191'.'c2Vy',''.'Tg='.'=','','','QUNU'.'SVZF',''.'WQ='.'=','c29jaWF'.'sb'.'m'.'V0d'.'2'.'9'.'ya'.'w==','YW'.'xsb'.'3df'.'cG'.'hvdG'.'9fdX'.'N'.'lcg==','WQ==','SUQ=','c29j'.'aWFsbmV0d'.'2'.'9ya'.'w==','Y'.'Wxsb3dfcGhvdG9f'.'dXNlcg==','SUQ=',''.'c29jaWFsbmV'.'0d29'.'yaw==',''.'YW'.'xs'.'b3'.'dfcG'.'hvdG9fdXNlcg='.'=','Tg==','','',''.'Q'.'UNU'.'SVZF','WQ==',''.'c29'.'j'.'aW'.'Fsb'.'mV0d29yaw'.'==','YWxsb3dfZm9yd'.'W1fdX'.'Nlcg='.'=',''.'WQ==',''.'SUQ'.'=','c29'.'jaWFsbmV0'.'d29yaw'.'==','YWxsb3dfZ'.'m9'.'ydW1fdXNl'.'cg==','S'.'U'.'Q=','c'.'29jaWFsbmV0d29'.'yaw='.'=',''.'Y'.'Wx'.'sb3'.'d'.'fZm9ydW1fd'.'X'.'N'.'lc'.'g==','Tg==','','',''.'QUNUSVZF','WQ='.'=','c29ja'.'WFsbmV0'.'d'.'29'.'ya'.'w='.'=','YWxsb'.'3dfdGFza3N'.'fdXNlcg==','WQ==',''.'SUQ=','c2'.'9j'.'aWFsbmV0d2'.'9yaw==','YW'.'xsb3dfdGFza'.'3NfdXNl'.'cg==','SUQ=','c29'.'jaWFsbm'.'V'.'0d2'.'9yaw'.'==',''.'YWxs'.'b3d'.'fdGFza3Nfd'.'XNlcg'.'='.'=','c29'.'jaWFsbm'.'V0'.'d29'.'y'.'a'.'w'.'==','YWxs'.'b'.'3dfdGFz'.'a3NfZ3Jv'.'dXA=','WQ==','SUQ=','c'.'29'.'jaWFsb'.'mV0'.'d29yaw='.'=',''.'YWxsb3'.'dfd'.'GFza3NfZ'.'3JvdX'.'A=','S'.'UQ=','c29jaWFsbmV0d29y'.'aw'.'==','YWxs'.'b'.'3dfdGFza3NfZ'.'3'.'Jv'.'dXA=','dGFza'.'3'.'M'.'=','Tg==','','','QU'.'N'.'U'.'S'.'VZF','WQ==',''.'c'.'2'.'9jaWFsbmV0d29yaw'.'==','YWx'.'sb3d'.'fY2FsZ'.'W5k'.'Y'.'XJ'.'fdXNlcg==','W'.'Q==','S'.'UQ'.'=',''.'c'.'29jaW'.'FsbmV'.'0d29y'.'aw==','YW'.'x'.'sb3'.'d'.'fY2F'.'sZW5kY'.'X'.'JfdXN'.'l'.'cg='.'=','SUQ=','c29jaWFsbmV0d29yaw==','YWxsb3dfY'.'2F'.'sZW5kY'.'X'.'Jf'.'d'.'XNlc'.'g='.'=','c29jaWFsbmV0'.'d29yaw==',''.'YWxsb3'.'df'.'Y'.'2FsZW5kYXJfZ3JvdXA=','W'.'Q==','SUQ'.'=',''.'c29'.'ja'.'WFsbmV0d'.'29y'.'aw'.'==','YWxsb3d'.'fY'.'2FsZW5kYXJf'.'Z3JvdXA=','SU'.'Q'.'=','c2'.'9j'.'aWF'.'sbmV0d29y'.'aw==','YWxs'.'b'.'3d'.'fY2FsZW5kYXJfZ'.'3Jv'.'dXA'.'=','Q'.'UNUSVZ'.'F','WQ==','Tg'.'==','ZXh0'.'cmFuZX'.'Q'.'=',''.'aWJsb2Nr','T25BZnRlckl'.'CbG9j'.'a0Vs'.'ZW'.'1lbn'.'R'.'Vc'.'GRhdGU=',''.'a'.'W50cmFuZXQ=',''.'Q'.'0lu'.'d'.'HJh'.'bmV0RXZlbnRIY'.'W5kbGVycw==','U1'.'BS'.'ZWdpc3Rlc'.'lVwZGF0ZWRJ'.'dGVt','Q0l'.'udHJhbmV'.'0U2hh'.'cmVwb2lu'.'dDo6QW'.'dl'.'bnRMaXN0cyg'.'pO'.'w==','a'.'W50'.'cmFuZXQ=','Tg==','Q0'.'l'.'udHJh'.'bm'.'V0U2hhc'.'m'.'Vwb2'.'ludDo6QW'.'dl'.'bnRR'.'d'.'WV1Z'.'Sgp'.'Ow==','aW'.'50'.'cmFu'.'Z'.'X'.'Q=','Tg==','Q'.'0ludHJhb'.'mV0U2hhcmV'.'wb2ludDo'.'6Q'.'W'.'dl'.'bnRV'.'cGRhdGUoKTs=','aW5'.'0cmFuZX'.'Q=','Tg==','aWJsb2N'.'r',''.'T25'.'BZ'.'nRlck'.'l'.'Cb'.'G'.'9ja0'.'Vs'.'ZW1l'.'bnRBZGQ'.'=','aW'.'50cmFuZ'.'XQ=','Q'.'0lu'.'dHJ'.'hb'.'mV0RXZlbnRIYW5kb'.'GVy'.'cw='.'=','U1BSZWdpc3Rlcl'.'VwZGF'.'0ZWR'.'J'.'dGV'.'t','aW'.'Jsb'.'2'.'Nr','T25B'.'ZnR'.'lck'.'lCbG9ja0'.'VsZW1'.'lb'.'nRVcGR'.'hdGU=','aW5'.'0cmFu'.'Z'.'XQ=','Q0l'.'udHJ'.'hbmV0'.'RXZlbnRIYW5k'.'bGVycw==','U1BSZWd'.'pc'.'3Rlc'.'l'.'VwZGF'.'0ZWRJdGVt','Q'.'0'.'ludH'.'JhbmV0U2'.'h'.'hcmVwb'.'2l'.'udDo'.'6'.'QWdlbn'.'RM'.'aX'.'N0cyg'.'pOw==','aW50c'.'m'.'FuZ'.'XQ=','Q0lu'.'d'.'HJh'.'bmV0U2h'.'hc'.'mVwb'.'2ludDo6QWdlbnRRd'.'WV1ZS'.'g'.'pOw==','aW50cmFuZXQ=',''.'Q0'.'ludH'.'J'.'hbmV0U2hhcmVwb2l'.'udDo6Q'.'Wd'.'lbn'.'RVcGR'.'hdGUoKTs=','aW'.'50'.'cm'.'FuZXQ=','Y3Jt','bWFpbg='.'=',''.'T'.'25'.'CZWZvcmVQcm9sb'.'2c=','b'.'WFpbg==','Q1dp'.'emFyZF'.'N'.'vbFB'.'hbmVsSW50c'.'mFu'.'ZXQ=','U2hvd1BhbmVs','L'.'2'.'1vZHVsZX'.'Mv'.'aW50cmFuZ'.'XQvcG'.'F'.'uZW'.'xfYnV0dG9uLnBo'.'cA==','RU5DT'.'0RF','WQ==');return base64_decode($_722920682[$_1683588509]);}};$GLOBALS['____1982258461'][0](___260683213(0), ___260683213(1));class CBXFeatures{ private static $_343522862= 30; private static $_987784867= array( "Portal" => array( "CompanyCalendar", "CompanyPhoto", "CompanyVideo", "CompanyCareer", "StaffChanges", "StaffAbsence", "CommonDocuments", "MeetingRoomBookingSystem", "Wiki", "Learning", "Vote", "WebLink", "Subscribe", "Friends", "PersonalFiles", "PersonalBlog", "PersonalPhoto", "PersonalForum", "Blog", "Forum", "Gallery", "Board", "MicroBlog", "WebMessenger",), "Communications" => array( "Tasks", "Calendar", "Workgroups", "Jabber", "VideoConference", "Extranet", "SMTP", "Requests", "DAV", "intranet_sharepoint", "timeman", "Idea", "Meeting", "EventList", "Salary", "XDImport",), "Enterprise" => array( "BizProc", "Lists", "Support", "Analytics", "crm", "Controller", "LdapUnlimitedUsers",), "Holding" => array( "Cluster", "MultiSites",),); private static $_6027254= null; private static $_772409311= null; private static function __444677751(){ if(self::$_6027254 === null){ self::$_6027254= array(); foreach(self::$_987784867 as $_354839546 => $_1177907687){ foreach($_1177907687 as $_1424280647) self::$_6027254[$_1424280647]= $_354839546;}} if(self::$_772409311 === null){ self::$_772409311= array(); $_1225340744= COption::GetOptionString(___260683213(2), ___260683213(3), ___260683213(4)); if($_1225340744 != ___260683213(5)){ $_1225340744= $GLOBALS['____1982258461'][1]($_1225340744); $_1225340744= $GLOBALS['____1982258461'][2]($_1225340744,[___260683213(6) => false]); if($GLOBALS['____1982258461'][3]($_1225340744)){ self::$_772409311= $_1225340744;}} if(empty(self::$_772409311)){ self::$_772409311= array(___260683213(7) => array(), ___260683213(8) => array());}}} public static function InitiateEditionsSettings($_2085655071){ self::__444677751(); $_1110316291= array(); foreach(self::$_987784867 as $_354839546 => $_1177907687){ $_1093209763= $GLOBALS['____1982258461'][4]($_354839546, $_2085655071); self::$_772409311[___260683213(9)][$_354839546]=($_1093209763? array(___260683213(10)): array(___260683213(11))); foreach($_1177907687 as $_1424280647){ self::$_772409311[___260683213(12)][$_1424280647]= $_1093209763; if(!$_1093209763) $_1110316291[]= array($_1424280647, false);}} $_636376122= $GLOBALS['____1982258461'][5](self::$_772409311); $_636376122= $GLOBALS['____1982258461'][6]($_636376122); COption::SetOptionString(___260683213(13), ___260683213(14), $_636376122); foreach($_1110316291 as $_2127154323) self::__1386291250($_2127154323[(924-2*462)], $_2127154323[round(0+0.33333333333333+0.33333333333333+0.33333333333333)]);} public static function IsFeatureEnabled($_1424280647){ if($_1424280647 == '') return true; self::__444677751(); if(!isset(self::$_6027254[$_1424280647])) return true; if(self::$_6027254[$_1424280647] == ___260683213(15)) $_1805624390= array(___260683213(16)); elseif(isset(self::$_772409311[___260683213(17)][self::$_6027254[$_1424280647]])) $_1805624390= self::$_772409311[___260683213(18)][self::$_6027254[$_1424280647]]; else $_1805624390= array(___260683213(19)); if($_1805624390[(210*2-420)] != ___260683213(20) && $_1805624390[(850-2*425)] != ___260683213(21)){ return false;} elseif($_1805624390[min(162,0,54)] == ___260683213(22)){ if($_1805624390[round(0+0.25+0.25+0.25+0.25)]< $GLOBALS['____1982258461'][7]((1340/2-670),(816-2*408), min(176,0,58.666666666667), Date(___260683213(23)), $GLOBALS['____1982258461'][8](___260683213(24))- self::$_343522862, $GLOBALS['____1982258461'][9](___260683213(25)))){ if(!isset($_1805624390[round(0+0.4+0.4+0.4+0.4+0.4)]) ||!$_1805624390[round(0+0.4+0.4+0.4+0.4+0.4)]) self::__513326064(self::$_6027254[$_1424280647]); return false;}} return!isset(self::$_772409311[___260683213(26)][$_1424280647]) || self::$_772409311[___260683213(27)][$_1424280647];} public static function IsFeatureInstalled($_1424280647){ if($GLOBALS['____1982258461'][10]($_1424280647) <= 0) return true; self::__444677751(); return(isset(self::$_772409311[___260683213(28)][$_1424280647]) && self::$_772409311[___260683213(29)][$_1424280647]);} public static function IsFeatureEditable($_1424280647){ if($_1424280647 == '') return true; self::__444677751(); if(!isset(self::$_6027254[$_1424280647])) return true; if(self::$_6027254[$_1424280647] == ___260683213(30)) $_1805624390= array(___260683213(31)); elseif(isset(self::$_772409311[___260683213(32)][self::$_6027254[$_1424280647]])) $_1805624390= self::$_772409311[___260683213(33)][self::$_6027254[$_1424280647]]; else $_1805624390= array(___260683213(34)); if($_1805624390[min(20,0,6.6666666666667)] != ___260683213(35) && $_1805624390[min(246,0,82)] != ___260683213(36)){ return false;} elseif($_1805624390[(792-2*396)] == ___260683213(37)){ if($_1805624390[round(0+0.2+0.2+0.2+0.2+0.2)]< $GLOBALS['____1982258461'][11]((181*2-362), min(250,0,83.333333333333),(1052/2-526), Date(___260683213(38)), $GLOBALS['____1982258461'][12](___260683213(39))- self::$_343522862, $GLOBALS['____1982258461'][13](___260683213(40)))){ if(!isset($_1805624390[round(0+1+1)]) ||!$_1805624390[round(0+0.5+0.5+0.5+0.5)]) self::__513326064(self::$_6027254[$_1424280647]); return false;}} return true;} private static function __1386291250($_1424280647, $_1824944226){ if($GLOBALS['____1982258461'][14]("CBXFeatures", "On".$_1424280647."SettingsChange")) $GLOBALS['____1982258461'][15](array("CBXFeatures", "On".$_1424280647."SettingsChange"), array($_1424280647, $_1824944226)); $_1935290317= $GLOBALS['_____1626445211'][0](___260683213(41), ___260683213(42).$_1424280647.___260683213(43)); while($_1763402588= $_1935290317->Fetch()) $GLOBALS['_____1626445211'][1]($_1763402588, array($_1424280647, $_1824944226));} public static function SetFeatureEnabled($_1424280647, $_1824944226= true, $_381909736= true){ if($GLOBALS['____1982258461'][16]($_1424280647) <= 0) return; if(!self::IsFeatureEditable($_1424280647)) $_1824944226= false; $_1824944226= (bool)$_1824944226; self::__444677751(); $_248553516=(!isset(self::$_772409311[___260683213(44)][$_1424280647]) && $_1824944226 || isset(self::$_772409311[___260683213(45)][$_1424280647]) && $_1824944226 != self::$_772409311[___260683213(46)][$_1424280647]); self::$_772409311[___260683213(47)][$_1424280647]= $_1824944226; $_636376122= $GLOBALS['____1982258461'][17](self::$_772409311); $_636376122= $GLOBALS['____1982258461'][18]($_636376122); COption::SetOptionString(___260683213(48), ___260683213(49), $_636376122); if($_248553516 && $_381909736) self::__1386291250($_1424280647, $_1824944226);} private static function __513326064($_354839546){ if($GLOBALS['____1982258461'][19]($_354839546) <= 0 || $_354839546 == "Portal") return; self::__444677751(); if(!isset(self::$_772409311[___260683213(50)][$_354839546]) || self::$_772409311[___260683213(51)][$_354839546][(806-2*403)] != ___260683213(52)) return; if(isset(self::$_772409311[___260683213(53)][$_354839546][round(0+2)]) && self::$_772409311[___260683213(54)][$_354839546][round(0+1+1)]) return; $_1110316291= array(); if(isset(self::$_987784867[$_354839546]) && $GLOBALS['____1982258461'][20](self::$_987784867[$_354839546])){ foreach(self::$_987784867[$_354839546] as $_1424280647){ if(isset(self::$_772409311[___260683213(55)][$_1424280647]) && self::$_772409311[___260683213(56)][$_1424280647]){ self::$_772409311[___260683213(57)][$_1424280647]= false; $_1110316291[]= array($_1424280647, false);}} self::$_772409311[___260683213(58)][$_354839546][round(0+0.4+0.4+0.4+0.4+0.4)]= true;} $_636376122= $GLOBALS['____1982258461'][21](self::$_772409311); $_636376122= $GLOBALS['____1982258461'][22]($_636376122); COption::SetOptionString(___260683213(59), ___260683213(60), $_636376122); foreach($_1110316291 as $_2127154323) self::__1386291250($_2127154323[(130*2-260)], $_2127154323[round(0+0.25+0.25+0.25+0.25)]);} public static function ModifyFeaturesSettings($_2085655071, $_1177907687){ self::__444677751(); foreach($_2085655071 as $_354839546 => $_1359897338) self::$_772409311[___260683213(61)][$_354839546]= $_1359897338; $_1110316291= array(); foreach($_1177907687 as $_1424280647 => $_1824944226){ if(!isset(self::$_772409311[___260683213(62)][$_1424280647]) && $_1824944226 || isset(self::$_772409311[___260683213(63)][$_1424280647]) && $_1824944226 != self::$_772409311[___260683213(64)][$_1424280647]) $_1110316291[]= array($_1424280647, $_1824944226); self::$_772409311[___260683213(65)][$_1424280647]= $_1824944226;} $_636376122= $GLOBALS['____1982258461'][23](self::$_772409311); $_636376122= $GLOBALS['____1982258461'][24]($_636376122); COption::SetOptionString(___260683213(66), ___260683213(67), $_636376122); self::$_772409311= false; foreach($_1110316291 as $_2127154323) self::__1386291250($_2127154323[(826-2*413)], $_2127154323[round(0+0.25+0.25+0.25+0.25)]);} public static function SaveFeaturesSettings($_217984996, $_275096955){ self::__444677751(); $_859760313= array(___260683213(68) => array(), ___260683213(69) => array()); if(!$GLOBALS['____1982258461'][25]($_217984996)) $_217984996= array(); if(!$GLOBALS['____1982258461'][26]($_275096955)) $_275096955= array(); if(!$GLOBALS['____1982258461'][27](___260683213(70), $_217984996)) $_217984996[]= ___260683213(71); foreach(self::$_987784867 as $_354839546 => $_1177907687){ if(isset(self::$_772409311[___260683213(72)][$_354839546])){ $_566174069= self::$_772409311[___260683213(73)][$_354839546];} else{ $_566174069=($_354839546 == ___260683213(74)? array(___260683213(75)): array(___260683213(76)));} if($_566174069[(832-2*416)] == ___260683213(77) || $_566174069[min(234,0,78)] == ___260683213(78)){ $_859760313[___260683213(79)][$_354839546]= $_566174069;} else{ if($GLOBALS['____1982258461'][28]($_354839546, $_217984996)) $_859760313[___260683213(80)][$_354839546]= array(___260683213(81), $GLOBALS['____1982258461'][29]((986-2*493), min(170,0,56.666666666667),(250*2-500), $GLOBALS['____1982258461'][30](___260683213(82)), $GLOBALS['____1982258461'][31](___260683213(83)), $GLOBALS['____1982258461'][32](___260683213(84)))); else $_859760313[___260683213(85)][$_354839546]= array(___260683213(86));}} $_1110316291= array(); foreach(self::$_6027254 as $_1424280647 => $_354839546){ if($_859760313[___260683213(87)][$_354839546][(148*2-296)] != ___260683213(88) && $_859760313[___260683213(89)][$_354839546][(206*2-412)] != ___260683213(90)){ $_859760313[___260683213(91)][$_1424280647]= false;} else{ if($_859760313[___260683213(92)][$_354839546][min(30,0,10)] == ___260683213(93) && $_859760313[___260683213(94)][$_354839546][round(0+0.25+0.25+0.25+0.25)]< $GLOBALS['____1982258461'][33]((171*2-342),(844-2*422),(246*2-492), Date(___260683213(95)), $GLOBALS['____1982258461'][34](___260683213(96))- self::$_343522862, $GLOBALS['____1982258461'][35](___260683213(97)))) $_859760313[___260683213(98)][$_1424280647]= false; else $_859760313[___260683213(99)][$_1424280647]= $GLOBALS['____1982258461'][36]($_1424280647, $_275096955); if(!isset(self::$_772409311[___260683213(100)][$_1424280647]) && $_859760313[___260683213(101)][$_1424280647] || isset(self::$_772409311[___260683213(102)][$_1424280647]) && $_859760313[___260683213(103)][$_1424280647] != self::$_772409311[___260683213(104)][$_1424280647]) $_1110316291[]= array($_1424280647, $_859760313[___260683213(105)][$_1424280647]);}} $_636376122= $GLOBALS['____1982258461'][37]($_859760313); $_636376122= $GLOBALS['____1982258461'][38]($_636376122); COption::SetOptionString(___260683213(106), ___260683213(107), $_636376122); self::$_772409311= false; foreach($_1110316291 as $_2127154323) self::__1386291250($_2127154323[(1452/2-726)], $_2127154323[round(0+0.25+0.25+0.25+0.25)]);} public static function GetFeaturesList(){ self::__444677751(); $_937795791= array(); foreach(self::$_987784867 as $_354839546 => $_1177907687){ if(isset(self::$_772409311[___260683213(108)][$_354839546])){ $_566174069= self::$_772409311[___260683213(109)][$_354839546];} else{ $_566174069=($_354839546 == ___260683213(110)? array(___260683213(111)): array(___260683213(112)));} $_937795791[$_354839546]= array( ___260683213(113) => $_566174069[(189*2-378)], ___260683213(114) => $_566174069[round(0+0.33333333333333+0.33333333333333+0.33333333333333)], ___260683213(115) => array(),); $_937795791[$_354839546][___260683213(116)]= false; if($_937795791[$_354839546][___260683213(117)] == ___260683213(118)){ $_937795791[$_354839546][___260683213(119)]= $GLOBALS['____1982258461'][39](($GLOBALS['____1982258461'][40]()- $_937795791[$_354839546][___260683213(120)])/ round(0+28800+28800+28800)); if($_937795791[$_354839546][___260683213(121)]> self::$_343522862) $_937795791[$_354839546][___260683213(122)]= true;} foreach($_1177907687 as $_1424280647) $_937795791[$_354839546][___260683213(123)][$_1424280647]=(!isset(self::$_772409311[___260683213(124)][$_1424280647]) || self::$_772409311[___260683213(125)][$_1424280647]);} return $_937795791;} private static function __658410375($_798173501, $_2091716218){ if(IsModuleInstalled($_798173501) == $_2091716218) return true; $_87383249= $_SERVER[___260683213(126)].___260683213(127).$_798173501.___260683213(128); if(!$GLOBALS['____1982258461'][41]($_87383249)) return false; include_once($_87383249); $_1535815914= $GLOBALS['____1982258461'][42](___260683213(129), ___260683213(130), $_798173501); if(!$GLOBALS['____1982258461'][43]($_1535815914)) return false; $_1002104934= new $_1535815914; if($_2091716218){ if(!$_1002104934->InstallDB()) return false; $_1002104934->InstallEvents(); if(!$_1002104934->InstallFiles()) return false;} else{ if(CModule::IncludeModule(___260683213(131))) CSearch::DeleteIndex($_798173501); UnRegisterModule($_798173501);} return true;} protected static function OnRequestsSettingsChange($_1424280647, $_1824944226){ self::__658410375("form", $_1824944226);} protected static function OnLearningSettingsChange($_1424280647, $_1824944226){ self::__658410375("learning", $_1824944226);} protected static function OnJabberSettingsChange($_1424280647, $_1824944226){ self::__658410375("xmpp", $_1824944226);} protected static function OnVideoConferenceSettingsChange($_1424280647, $_1824944226){ self::__658410375("video", $_1824944226);} protected static function OnBizProcSettingsChange($_1424280647, $_1824944226){ self::__658410375("bizprocdesigner", $_1824944226);} protected static function OnListsSettingsChange($_1424280647, $_1824944226){ self::__658410375("lists", $_1824944226);} protected static function OnWikiSettingsChange($_1424280647, $_1824944226){ self::__658410375("wiki", $_1824944226);} protected static function OnSupportSettingsChange($_1424280647, $_1824944226){ self::__658410375("support", $_1824944226);} protected static function OnControllerSettingsChange($_1424280647, $_1824944226){ self::__658410375("controller", $_1824944226);} protected static function OnAnalyticsSettingsChange($_1424280647, $_1824944226){ self::__658410375("statistic", $_1824944226);} protected static function OnVoteSettingsChange($_1424280647, $_1824944226){ self::__658410375("vote", $_1824944226);} protected static function OnFriendsSettingsChange($_1424280647, $_1824944226){ if($_1824944226) $_623565158= "Y"; else $_623565158= ___260683213(132); $_1561619132= CSite::GetList(___260683213(133), ___260683213(134), array(___260683213(135) => ___260683213(136))); while($_1932253054= $_1561619132->Fetch()){ if(COption::GetOptionString(___260683213(137), ___260683213(138), ___260683213(139), $_1932253054[___260683213(140)]) != $_623565158){ COption::SetOptionString(___260683213(141), ___260683213(142), $_623565158, false, $_1932253054[___260683213(143)]); COption::SetOptionString(___260683213(144), ___260683213(145), $_623565158);}}} protected static function OnMicroBlogSettingsChange($_1424280647, $_1824944226){ if($_1824944226) $_623565158= "Y"; else $_623565158= ___260683213(146); $_1561619132= CSite::GetList(___260683213(147), ___260683213(148), array(___260683213(149) => ___260683213(150))); while($_1932253054= $_1561619132->Fetch()){ if(COption::GetOptionString(___260683213(151), ___260683213(152), ___260683213(153), $_1932253054[___260683213(154)]) != $_623565158){ COption::SetOptionString(___260683213(155), ___260683213(156), $_623565158, false, $_1932253054[___260683213(157)]); COption::SetOptionString(___260683213(158), ___260683213(159), $_623565158);} if(COption::GetOptionString(___260683213(160), ___260683213(161), ___260683213(162), $_1932253054[___260683213(163)]) != $_623565158){ COption::SetOptionString(___260683213(164), ___260683213(165), $_623565158, false, $_1932253054[___260683213(166)]); COption::SetOptionString(___260683213(167), ___260683213(168), $_623565158);}}} protected static function OnPersonalFilesSettingsChange($_1424280647, $_1824944226){ if($_1824944226) $_623565158= "Y"; else $_623565158= ___260683213(169); $_1561619132= CSite::GetList(___260683213(170), ___260683213(171), array(___260683213(172) => ___260683213(173))); while($_1932253054= $_1561619132->Fetch()){ if(COption::GetOptionString(___260683213(174), ___260683213(175), ___260683213(176), $_1932253054[___260683213(177)]) != $_623565158){ COption::SetOptionString(___260683213(178), ___260683213(179), $_623565158, false, $_1932253054[___260683213(180)]); COption::SetOptionString(___260683213(181), ___260683213(182), $_623565158);}}} protected static function OnPersonalBlogSettingsChange($_1424280647, $_1824944226){ if($_1824944226) $_623565158= "Y"; else $_623565158= ___260683213(183); $_1561619132= CSite::GetList(___260683213(184), ___260683213(185), array(___260683213(186) => ___260683213(187))); while($_1932253054= $_1561619132->Fetch()){ if(COption::GetOptionString(___260683213(188), ___260683213(189), ___260683213(190), $_1932253054[___260683213(191)]) != $_623565158){ COption::SetOptionString(___260683213(192), ___260683213(193), $_623565158, false, $_1932253054[___260683213(194)]); COption::SetOptionString(___260683213(195), ___260683213(196), $_623565158);}}} protected static function OnPersonalPhotoSettingsChange($_1424280647, $_1824944226){ if($_1824944226) $_623565158= "Y"; else $_623565158= ___260683213(197); $_1561619132= CSite::GetList(___260683213(198), ___260683213(199), array(___260683213(200) => ___260683213(201))); while($_1932253054= $_1561619132->Fetch()){ if(COption::GetOptionString(___260683213(202), ___260683213(203), ___260683213(204), $_1932253054[___260683213(205)]) != $_623565158){ COption::SetOptionString(___260683213(206), ___260683213(207), $_623565158, false, $_1932253054[___260683213(208)]); COption::SetOptionString(___260683213(209), ___260683213(210), $_623565158);}}} protected static function OnPersonalForumSettingsChange($_1424280647, $_1824944226){ if($_1824944226) $_623565158= "Y"; else $_623565158= ___260683213(211); $_1561619132= CSite::GetList(___260683213(212), ___260683213(213), array(___260683213(214) => ___260683213(215))); while($_1932253054= $_1561619132->Fetch()){ if(COption::GetOptionString(___260683213(216), ___260683213(217), ___260683213(218), $_1932253054[___260683213(219)]) != $_623565158){ COption::SetOptionString(___260683213(220), ___260683213(221), $_623565158, false, $_1932253054[___260683213(222)]); COption::SetOptionString(___260683213(223), ___260683213(224), $_623565158);}}} protected static function OnTasksSettingsChange($_1424280647, $_1824944226){ if($_1824944226) $_623565158= "Y"; else $_623565158= ___260683213(225); $_1561619132= CSite::GetList(___260683213(226), ___260683213(227), array(___260683213(228) => ___260683213(229))); while($_1932253054= $_1561619132->Fetch()){ if(COption::GetOptionString(___260683213(230), ___260683213(231), ___260683213(232), $_1932253054[___260683213(233)]) != $_623565158){ COption::SetOptionString(___260683213(234), ___260683213(235), $_623565158, false, $_1932253054[___260683213(236)]); COption::SetOptionString(___260683213(237), ___260683213(238), $_623565158);} if(COption::GetOptionString(___260683213(239), ___260683213(240), ___260683213(241), $_1932253054[___260683213(242)]) != $_623565158){ COption::SetOptionString(___260683213(243), ___260683213(244), $_623565158, false, $_1932253054[___260683213(245)]); COption::SetOptionString(___260683213(246), ___260683213(247), $_623565158);}} self::__658410375(___260683213(248), $_1824944226);} protected static function OnCalendarSettingsChange($_1424280647, $_1824944226){ if($_1824944226) $_623565158= "Y"; else $_623565158= ___260683213(249); $_1561619132= CSite::GetList(___260683213(250), ___260683213(251), array(___260683213(252) => ___260683213(253))); while($_1932253054= $_1561619132->Fetch()){ if(COption::GetOptionString(___260683213(254), ___260683213(255), ___260683213(256), $_1932253054[___260683213(257)]) != $_623565158){ COption::SetOptionString(___260683213(258), ___260683213(259), $_623565158, false, $_1932253054[___260683213(260)]); COption::SetOptionString(___260683213(261), ___260683213(262), $_623565158);} if(COption::GetOptionString(___260683213(263), ___260683213(264), ___260683213(265), $_1932253054[___260683213(266)]) != $_623565158){ COption::SetOptionString(___260683213(267), ___260683213(268), $_623565158, false, $_1932253054[___260683213(269)]); COption::SetOptionString(___260683213(270), ___260683213(271), $_623565158);}}} protected static function OnSMTPSettingsChange($_1424280647, $_1824944226){ self::__658410375("mail", $_1824944226);} protected static function OnExtranetSettingsChange($_1424280647, $_1824944226){ $_685641787= COption::GetOptionString("extranet", "extranet_site", ""); if($_685641787){ $_1911334097= new CSite; $_1911334097->Update($_685641787, array(___260683213(272) =>($_1824944226? ___260683213(273): ___260683213(274))));} self::__658410375(___260683213(275), $_1824944226);} protected static function OnDAVSettingsChange($_1424280647, $_1824944226){ self::__658410375("dav", $_1824944226);} protected static function OntimemanSettingsChange($_1424280647, $_1824944226){ self::__658410375("timeman", $_1824944226);} protected static function Onintranet_sharepointSettingsChange($_1424280647, $_1824944226){ if($_1824944226){ RegisterModuleDependences("iblock", "OnAfterIBlockElementAdd", "intranet", "CIntranetEventHandlers", "SPRegisterUpdatedItem"); RegisterModuleDependences(___260683213(276), ___260683213(277), ___260683213(278), ___260683213(279), ___260683213(280)); CAgent::AddAgent(___260683213(281), ___260683213(282), ___260683213(283), round(0+166.66666666667+166.66666666667+166.66666666667)); CAgent::AddAgent(___260683213(284), ___260683213(285), ___260683213(286), round(0+300)); CAgent::AddAgent(___260683213(287), ___260683213(288), ___260683213(289), round(0+1800+1800));} else{ UnRegisterModuleDependences(___260683213(290), ___260683213(291), ___260683213(292), ___260683213(293), ___260683213(294)); UnRegisterModuleDependences(___260683213(295), ___260683213(296), ___260683213(297), ___260683213(298), ___260683213(299)); CAgent::RemoveAgent(___260683213(300), ___260683213(301)); CAgent::RemoveAgent(___260683213(302), ___260683213(303)); CAgent::RemoveAgent(___260683213(304), ___260683213(305));}} protected static function OncrmSettingsChange($_1424280647, $_1824944226){ if($_1824944226) COption::SetOptionString("crm", "form_features", "Y"); self::__658410375(___260683213(306), $_1824944226);} protected static function OnClusterSettingsChange($_1424280647, $_1824944226){ self::__658410375("cluster", $_1824944226);} protected static function OnMultiSitesSettingsChange($_1424280647, $_1824944226){ if($_1824944226) RegisterModuleDependences("main", "OnBeforeProlog", "main", "CWizardSolPanelIntranet", "ShowPanel", 100, "/modules/intranet/panel_button.php"); else UnRegisterModuleDependences(___260683213(307), ___260683213(308), ___260683213(309), ___260683213(310), ___260683213(311), ___260683213(312));} protected static function OnIdeaSettingsChange($_1424280647, $_1824944226){ self::__658410375("idea", $_1824944226);} protected static function OnMeetingSettingsChange($_1424280647, $_1824944226){ self::__658410375("meeting", $_1824944226);} protected static function OnXDImportSettingsChange($_1424280647, $_1824944226){ self::__658410375("xdimport", $_1824944226);}} $GLOBALS['____1982258461'][44](___260683213(313), ___260683213(314));/**/			//Do not remove this

require_once(__DIR__."/autoload.php");

// Component 2.0 template engines
$GLOBALS['arCustomTemplateEngines'] = [];

// User fields manager
$GLOBALS['USER_FIELD_MANAGER'] = new CUserTypeManager;

// todo: remove global
$GLOBALS['BX_MENU_CUSTOM'] = CMenuCustom::getInstance();

if (file_exists(($_fname = __DIR__."/classes/general/update_db_updater.php")))
{
	$US_HOST_PROCESS_MAIN = false;
	include($_fname);
}

if (file_exists(($_fname = $_SERVER["DOCUMENT_ROOT"]."/bitrix/init.php")))
{
	include_once($_fname);
}

if (($_fname = getLocalPath("php_interface/init.php", BX_PERSONAL_ROOT)) !== false)
{
	include_once($_SERVER["DOCUMENT_ROOT"].$_fname);
}

if (($_fname = getLocalPath("php_interface/".SITE_ID."/init.php", BX_PERSONAL_ROOT)) !== false)
{
	include_once($_SERVER["DOCUMENT_ROOT"].$_fname);
}

if (!defined("BX_FILE_PERMISSIONS"))
{
	define("BX_FILE_PERMISSIONS", 0644);
}
if (!defined("BX_DIR_PERMISSIONS"))
{
	define("BX_DIR_PERMISSIONS", 0755);
}

//global var, is used somewhere
$GLOBALS["sDocPath"] = $GLOBALS["APPLICATION"]->GetCurPage();

if ((!(defined("STATISTIC_ONLY") && STATISTIC_ONLY && mb_substr($GLOBALS["APPLICATION"]->GetCurPage(), 0, mb_strlen(BX_ROOT."/admin/")) != BX_ROOT."/admin/")) && COption::GetOptionString("main", "include_charset", "Y")=="Y" && LANG_CHARSET <> '')
{
	header("Content-Type: text/html; charset=".LANG_CHARSET);
}

if (COption::GetOptionString("main", "set_p3p_header", "Y")=="Y")
{
	header("P3P: policyref=\"/bitrix/p3p.xml\", CP=\"NON DSP COR CUR ADM DEV PSA PSD OUR UNR BUS UNI COM NAV INT DEM STA\"");
}

$license = $application->getLicense();
header("X-Powered-CMS: Bitrix Site Manager (" . ($license->isDemoKey() ? "DEMO" : $license->getPublicHashKey()) . ")");

if (COption::GetOptionString("main", "update_devsrv", "") == "Y")
{
	header("X-DevSrv-CMS: Bitrix");
}

if (!defined("BX_CRONTAB_SUPPORT"))
{
	define("BX_CRONTAB_SUPPORT", defined("BX_CRONTAB"));
}

//agents
if (COption::GetOptionString("main", "check_agents", "Y") == "Y")
{
	$application->addBackgroundJob(["CAgent", "CheckAgents"], [], \Bitrix\Main\Application::JOB_PRIORITY_LOW);
}

//send email events
if (COption::GetOptionString("main", "check_events", "Y") !== "N")
{
	$application->addBackgroundJob(['\Bitrix\Main\Mail\EventManager', 'checkEvents'], [], \Bitrix\Main\Application::JOB_PRIORITY_LOW-1);
}

$healerOfEarlySessionStart = new HealerEarlySessionStart();
$healerOfEarlySessionStart->process($application->getKernelSession());

$kernelSession = $application->getKernelSession();
$kernelSession->start();
$application->getSessionLocalStorageManager()->setUniqueId($kernelSession->getId());

foreach (GetModuleEvents("main", "OnPageStart", true) as $arEvent)
{
	ExecuteModuleEventEx($arEvent);
}

//define global user object
$GLOBALS["USER"] = new CUser;

//session control from group policy
$arPolicy = $GLOBALS["USER"]->GetSecurityPolicy();
$currTime = time();
if (
	(
		//IP address changed
		$kernelSession['SESS_IP']
		&& $arPolicy["SESSION_IP_MASK"] <> ''
		&& (
			(ip2long($arPolicy["SESSION_IP_MASK"]) & ip2long($kernelSession['SESS_IP']))
			!=
			(ip2long($arPolicy["SESSION_IP_MASK"]) & ip2long($_SERVER['REMOTE_ADDR']))
		)
	)
	||
	(
		//session timeout
		$arPolicy["SESSION_TIMEOUT"]>0
		&& $kernelSession['SESS_TIME']>0
		&& $currTime-$arPolicy["SESSION_TIMEOUT"]*60 > $kernelSession['SESS_TIME']
	)
	||
	(
		//signed session
		isset($kernelSession["BX_SESSION_SIGN"])
		&& $kernelSession["BX_SESSION_SIGN"] <> bitrix_sess_sign()
	)
	||
	(
		//session manually expired, e.g. in $User->LoginHitByHash
		isSessionExpired()
	)
)
{
	$compositeSessionManager = $application->getCompositeSessionManager();
	$compositeSessionManager->destroy();

	$application->getSession()->setId(Main\Security\Random::getString(32));
	$compositeSessionManager->start();

	$GLOBALS["USER"] = new CUser;
}
$kernelSession['SESS_IP'] = $_SERVER['REMOTE_ADDR'];
if (empty($kernelSession['SESS_TIME']))
{
	$kernelSession['SESS_TIME'] = $currTime;
}
elseif (($currTime - $kernelSession['SESS_TIME']) > 60)
{
	$kernelSession['SESS_TIME'] = $currTime;
}
if (!isset($kernelSession["BX_SESSION_SIGN"]))
{
	$kernelSession["BX_SESSION_SIGN"] = bitrix_sess_sign();
}

//session control from security module
if (
	(COption::GetOptionString("main", "use_session_id_ttl", "N") == "Y")
	&& (COption::GetOptionInt("main", "session_id_ttl", 0) > 0)
	&& !defined("BX_SESSION_ID_CHANGE")
)
{
	if (!isset($kernelSession['SESS_ID_TIME']))
	{
		$kernelSession['SESS_ID_TIME'] = $currTime;
	}
	elseif (($kernelSession['SESS_ID_TIME'] + COption::GetOptionInt("main", "session_id_ttl")) < $kernelSession['SESS_TIME'])
	{
		$compositeSessionManager = $application->getCompositeSessionManager();
		$compositeSessionManager->regenerateId();

		$kernelSession['SESS_ID_TIME'] = $currTime;
	}
}

define("BX_STARTED", true);

if (isset($kernelSession['BX_ADMIN_LOAD_AUTH']))
{
	define('ADMIN_SECTION_LOAD_AUTH', 1);
	unset($kernelSession['BX_ADMIN_LOAD_AUTH']);
}

$bRsaError = false;
$USER_LID = false;

if (!defined("NOT_CHECK_PERMISSIONS") || NOT_CHECK_PERMISSIONS!==true)
{
	$doLogout = isset($_REQUEST["logout"]) && (strtolower($_REQUEST["logout"]) == "yes");

	if ($doLogout && $GLOBALS["USER"]->IsAuthorized())
	{
		$secureLogout = (\Bitrix\Main\Config\Option::get("main", "secure_logout", "N") == "Y");

		if (!$secureLogout || check_bitrix_sessid())
		{
			$GLOBALS["USER"]->Logout();
			LocalRedirect($GLOBALS["APPLICATION"]->GetCurPageParam('', array('logout', 'sessid')));
		}
	}

	// authorize by cookies
	if (!$GLOBALS["USER"]->IsAuthorized())
	{
		$GLOBALS["USER"]->LoginByCookies();
	}

	$arAuthResult = false;

	//http basic and digest authorization
	if (($httpAuth = $GLOBALS["USER"]->LoginByHttpAuth()) !== null)
	{
		$arAuthResult = $httpAuth;
		$GLOBALS["APPLICATION"]->SetAuthResult($arAuthResult);
	}

	//Authorize user from authorization html form
	//Only POST is accepted
	if (isset($_POST["AUTH_FORM"]) && $_POST["AUTH_FORM"] <> '')
	{
		if (COption::GetOptionString('main', 'use_encrypted_auth', 'N') == 'Y')
		{
			//possible encrypted user password
			$sec = new CRsaSecurity();
			if (($arKeys = $sec->LoadKeys()))
			{
				$sec->SetKeys($arKeys);
				$errno = $sec->AcceptFromForm(['USER_PASSWORD', 'USER_CONFIRM_PASSWORD', 'USER_CURRENT_PASSWORD']);
				if ($errno == CRsaSecurity::ERROR_SESS_CHECK)
				{
					$arAuthResult = array("MESSAGE"=>GetMessage("main_include_decode_pass_sess"), "TYPE"=>"ERROR");
				}
				elseif ($errno < 0)
				{
					$arAuthResult = array("MESSAGE"=>GetMessage("main_include_decode_pass_err", array("#ERRCODE#"=>$errno)), "TYPE"=>"ERROR");
				}

				if ($errno < 0)
				{
					$bRsaError = true;
				}
			}
		}

		if (!$bRsaError)
		{
			if (!defined("ADMIN_SECTION") || ADMIN_SECTION !== true)
			{
				$USER_LID = SITE_ID;
			}

			$_POST["TYPE"] = $_POST["TYPE"] ?? null;
			if (isset($_POST["TYPE"]) && $_POST["TYPE"] == "AUTH")
			{
				$arAuthResult = $GLOBALS["USER"]->Login(
					$_POST["USER_LOGIN"] ?? '',
					$_POST["USER_PASSWORD"] ?? '',
					$_POST["USER_REMEMBER"] ?? ''
				);
			}
			elseif (isset($_POST["TYPE"]) && $_POST["TYPE"] == "OTP")
			{
				$arAuthResult = $GLOBALS["USER"]->LoginByOtp(
					$_POST["USER_OTP"] ?? '',
					$_POST["OTP_REMEMBER"] ?? '',
					$_POST["captcha_word"] ?? '',
					$_POST["captcha_sid"] ?? ''
				);
			}
			elseif (isset($_POST["TYPE"]) && $_POST["TYPE"] == "SEND_PWD")
			{
				$arAuthResult = CUser::SendPassword(
					$_POST["USER_LOGIN"] ?? '',
					$_POST["USER_EMAIL"] ?? '',
					$USER_LID,
					$_POST["captcha_word"] ?? '',
					$_POST["captcha_sid"] ?? '',
					$_POST["USER_PHONE_NUMBER"] ?? ''
				);
			}
			elseif (isset($_POST["TYPE"]) && $_POST["TYPE"] == "CHANGE_PWD")
			{
				$arAuthResult = $GLOBALS["USER"]->ChangePassword(
					$_POST["USER_LOGIN"] ?? '',
					$_POST["USER_CHECKWORD"] ?? '',
					$_POST["USER_PASSWORD"] ?? '',
					$_POST["USER_CONFIRM_PASSWORD"] ?? '',
					$USER_LID,
					$_POST["captcha_word"] ?? '',
					$_POST["captcha_sid"] ?? '',
					true,
					$_POST["USER_PHONE_NUMBER"] ?? '',
					$_POST["USER_CURRENT_PASSWORD"] ?? ''
				);
			}

			if ($_POST["TYPE"] == "AUTH" || $_POST["TYPE"] == "OTP")
			{
				//special login form in the control panel
				if ($arAuthResult === true && defined('ADMIN_SECTION') && ADMIN_SECTION === true)
				{
					//store cookies for next hit (see CMain::GetSpreadCookieHTML())
					$GLOBALS["APPLICATION"]->StoreCookies();
					$kernelSession['BX_ADMIN_LOAD_AUTH'] = true;

					// die() follows
					CMain::FinalActions('<script type="text/javascript">window.onload=function(){(window.BX || window.parent.BX).AUTHAGENT.setAuthResult(false);};</script>');
				}
			}
		}
		$GLOBALS["APPLICATION"]->SetAuthResult($arAuthResult);
	}
	elseif (!$GLOBALS["USER"]->IsAuthorized() && isset($_REQUEST['bx_hit_hash']))
	{
		//Authorize by unique URL
		$GLOBALS["USER"]->LoginHitByHash($_REQUEST['bx_hit_hash']);
	}
}

//logout or re-authorize the user if something importand has changed
$GLOBALS["USER"]->CheckAuthActions();

//magic short URI
if (defined("BX_CHECK_SHORT_URI") && BX_CHECK_SHORT_URI && CBXShortUri::CheckUri())
{
	//local redirect inside
	die();
}

//application password scope control
if (($applicationID = $GLOBALS["USER"]->getContext()->getApplicationId()) !== null)
{
	$appManager = Main\Authentication\ApplicationManager::getInstance();
	if ($appManager->checkScope($applicationID) !== true)
	{
		$event = new Main\Event("main", "onApplicationScopeError", Array('APPLICATION_ID' => $applicationID));
		$event->send();

		$context->getResponse()->setStatus("403 Forbidden");
		$application->end();
	}
}

//define the site template
if (!defined("ADMIN_SECTION") || ADMIN_SECTION !== true)
{
	$siteTemplate = "";
	if (isset($_REQUEST["bitrix_preview_site_template"]) && is_string($_REQUEST["bitrix_preview_site_template"]) && $_REQUEST["bitrix_preview_site_template"] <> "" && $GLOBALS["USER"]->CanDoOperation('view_other_settings'))
	{
		//preview of site template
		$signer = new Bitrix\Main\Security\Sign\Signer();
		try
		{
			//protected by a sign
			$requestTemplate = $signer->unsign($_REQUEST["bitrix_preview_site_template"], "template_preview".bitrix_sessid());

			$aTemplates = CSiteTemplate::GetByID($requestTemplate);
			if ($template = $aTemplates->Fetch())
			{
				$siteTemplate = $template["ID"];

				//preview of unsaved template
				if (isset($_GET['bx_template_preview_mode']) && $_GET['bx_template_preview_mode'] == 'Y' && $GLOBALS["USER"]->CanDoOperation('edit_other_settings'))
				{
					define("SITE_TEMPLATE_PREVIEW_MODE", true);
				}
			}
		}
		catch(\Bitrix\Main\Security\Sign\BadSignatureException $e)
		{
		}
	}
	if ($siteTemplate == "")
	{
		$siteTemplate = CSite::GetCurTemplate();
	}

	if (!defined('SITE_TEMPLATE_ID'))
	{
		define("SITE_TEMPLATE_ID", $siteTemplate);
	}

	define("SITE_TEMPLATE_PATH", getLocalPath('templates/'.SITE_TEMPLATE_ID, BX_PERSONAL_ROOT));
}
else
{
	// prevents undefined constants
	if (!defined('SITE_TEMPLATE_ID'))
	{
		define('SITE_TEMPLATE_ID', '.default');
	}

	define('SITE_TEMPLATE_PATH', '/bitrix/templates/.default');
}

//magic parameters: show page creation time
if (isset($_GET["show_page_exec_time"]))
{
	if ($_GET["show_page_exec_time"]=="Y" || $_GET["show_page_exec_time"]=="N")
	{
		$kernelSession["SESS_SHOW_TIME_EXEC"] = $_GET["show_page_exec_time"];
	}
}

//magic parameters: show included file processing time
if (isset($_GET["show_include_exec_time"]))
{
	if ($_GET["show_include_exec_time"]=="Y" || $_GET["show_include_exec_time"]=="N")
	{
		$kernelSession["SESS_SHOW_INCLUDE_TIME_EXEC"] = $_GET["show_include_exec_time"];
	}
}

//magic parameters: show include areas
if (isset($_GET["bitrix_include_areas"]) && $_GET["bitrix_include_areas"] <> "")
{
	$GLOBALS["APPLICATION"]->SetShowIncludeAreas($_GET["bitrix_include_areas"]=="Y");
}

//magic sound
if ($GLOBALS["USER"]->IsAuthorized())
{
	$cookie_prefix = COption::GetOptionString('main', 'cookie_name', 'BITRIX_SM');
	if (!isset($_COOKIE[$cookie_prefix.'_SOUND_LOGIN_PLAYED']))
	{
		$GLOBALS["APPLICATION"]->set_cookie('SOUND_LOGIN_PLAYED', 'Y', 0);
	}
}

//magic cache
\Bitrix\Main\Composite\Engine::shouldBeEnabled();

// should be before proactive filter on OnBeforeProlog
$userPassword = $_POST["USER_PASSWORD"] ?? null;
$userConfirmPassword = $_POST["USER_CONFIRM_PASSWORD"] ?? null;

foreach(GetModuleEvents("main", "OnBeforeProlog", true) as $arEvent)
{
	ExecuteModuleEventEx($arEvent);
}

if (!defined("NOT_CHECK_PERMISSIONS") || NOT_CHECK_PERMISSIONS !== true)
{
	//Register user from authorization html form
	//Only POST is accepted
	if (isset($_POST["AUTH_FORM"]) && $_POST["AUTH_FORM"] != '' && isset($_POST["TYPE"]) && $_POST["TYPE"] == "REGISTRATION")
	{
		if (!$bRsaError)
		{
			if (COption::GetOptionString("main", "new_user_registration", "N") == "Y" && (!defined("ADMIN_SECTION") || ADMIN_SECTION !== true))
			{
				$arAuthResult = $GLOBALS["USER"]->Register(
					$_POST["USER_LOGIN"] ?? '',
					$_POST["USER_NAME"] ?? '',
					$_POST["USER_LAST_NAME"] ?? '',
					$userPassword,
					$userConfirmPassword,
					$_POST["USER_EMAIL"] ?? '',
					$USER_LID,
					$_POST["captcha_word"] ?? '',
					$_POST["captcha_sid"] ?? '',
					false,
					$_POST["USER_PHONE_NUMBER"] ?? ''
				);

				$GLOBALS["APPLICATION"]->SetAuthResult($arAuthResult);
			}
		}
	}
}

if ((!defined("NOT_CHECK_PERMISSIONS") || NOT_CHECK_PERMISSIONS!==true) && (!defined("NOT_CHECK_FILE_PERMISSIONS") || NOT_CHECK_FILE_PERMISSIONS!==true))
{
	$real_path = $context->getRequest()->getScriptFile();

	if (!$GLOBALS["USER"]->CanDoFileOperation('fm_view_file', array(SITE_ID, $real_path)) || (defined("NEED_AUTH") && NEED_AUTH && !$GLOBALS["USER"]->IsAuthorized()))
	{
		if ($GLOBALS["USER"]->IsAuthorized() && $arAuthResult["MESSAGE"] == '')
		{
			$arAuthResult = array("MESSAGE"=>GetMessage("ACCESS_DENIED").' '.GetMessage("ACCESS_DENIED_FILE", array("#FILE#"=>$real_path)), "TYPE"=>"ERROR");

			if (COption::GetOptionString("main", "event_log_permissions_fail", "N") === "Y")
			{
				CEventLog::Log("SECURITY", "USER_PERMISSIONS_FAIL", "main", $GLOBALS["USER"]->GetID(), $real_path);
			}
		}

		if (defined("ADMIN_SECTION") && ADMIN_SECTION==true)
		{
			if (isset($_REQUEST["mode"]) && ($_REQUEST["mode"] === "list" || $_REQUEST["mode"] === "settings"))
			{
				echo "<script>top.location='".$GLOBALS["APPLICATION"]->GetCurPage()."?".DeleteParam(array("mode"))."';</script>";
				die();
			}
			elseif (isset($_REQUEST["mode"]) && $_REQUEST["mode"] === "frame")
			{
				echo "<script type=\"text/javascript\">
					var w = (opener? opener.window:parent.window);
					w.location.href='".$GLOBALS["APPLICATION"]->GetCurPage()."?".DeleteParam(array("mode"))."';
				</script>";
				die();
			}
			elseif (defined("MOBILE_APP_ADMIN") && MOBILE_APP_ADMIN==true)
			{
				echo json_encode(Array("status"=>"failed"));
				die();
			}
		}

		/** @noinspection PhpUndefinedVariableInspection */
		$GLOBALS["APPLICATION"]->AuthForm($arAuthResult);
	}
}

/*ZDUyZmZNjVjMjU1ZjViNmEzMmEwNzEwM2VlNzFiYjg3MmNhYzM=*/$GLOBALS['____441702368']= array(base64_decode('bXR'.'fcmFuZA'.'=='),base64_decode('ZXhwbG9kZ'.'Q'.'=='),base64_decode('c'.'GFja'.'w=='),base64_decode('bWQ1'),base64_decode('Y2'.'9uc3'.'RhbnQ='),base64_decode('a'.'G'.'FzaF9obWFj'),base64_decode('c3Ry'.'Y'.'21'.'w'),base64_decode('a'.'XNfb2J'.'qZWN0'),base64_decode('Y2FsbF'.'91c'.'2Vy'.'X2Z'.'1'.'b'.'m'.'M'.'='),base64_decode('Y2Fsb'.'F91c2V'.'yX2Z1'.'bmM='),base64_decode('Y2FsbF91c2VyX2Z1bmM='),base64_decode('Y'.'2'.'FsbF'.'9'.'1c2VyX2Z1bmM='),base64_decode('Y2F'.'sb'.'F91c2VyX2Z1bmM'.'='));if(!function_exists(__NAMESPACE__.'\\___1366578981')){function ___1366578981($_703383007){static $_1503445911= false; if($_1503445911 == false) $_1503445911=array('REI=','U0VMR'.'UNUIFZB'.'T'.'FVF'.'IE'.'Z'.'ST0'.'0'.'g'.'Yl9vc'.'HRp'.'b'.'2'.'4'.'gV0h'.'FUkUgT'.'kFN'.'RT0nflBB'.'Uk'.'FNX01BWF9VU0V'.'SUyc'.'gQU'.'5E'.'IE1PR'.'FVMRV9'.'JRD0'.'nbWFpbi'.'cg'.'QU5EIFNJV'.'EV'.'fSUQgS'.'VM'.'gTlV'.'MTA==','V'.'k'.'FMVUU=','L'.'g='.'=',''.'S'.'C'.'o'.'=','Y'.'ml0cml'.'4','TE'.'lD'.'RU5TRV'.'9LRV'.'k=','c2'.'h'.'hMj'.'U2','VVNFUg==','VVNFUg==',''.'VVNFUg==','SXNBd'.'X'.'Rob3JpemVk',''.'VVN'.'FUg==','S'.'XNB'.'ZG1p'.'b'.'g==','QVBQTElDQVRJT'.'04=','U'.'mV'.'zdGFydEJ1ZmZ'.'l'.'cg==',''.'TG9jY'.'WxS'.'ZWRpcmVj'.'dA='.'=',''.'L'.'2x'.'pY'.'2Vuc2VfcmVzdH'.'JpY3R'.'p'.'b24u'.'cGhw','X'.'EJp'.'dHJp'.'eFxNYWluX'.'ENv'.'bmZpZ1'.'xPcHRpb246OnNldA==','bWFpbg='.'=',''.'UEFS'.'QU1f'.'TUF'.'YX1V'.'TRVJT');return base64_decode($_1503445911[$_703383007]);}};if($GLOBALS['____441702368'][0](round(0+0.25+0.25+0.25+0.25), round(0+10+10)) == round(0+1.75+1.75+1.75+1.75)){ $_1609821770= $GLOBALS[___1366578981(0)]->Query(___1366578981(1), true); if($_1331498871= $_1609821770->Fetch()){ $_1065733855= $_1331498871[___1366578981(2)]; list($_1713819699, $_942182292)= $GLOBALS['____441702368'][1](___1366578981(3), $_1065733855); $_1070489955= $GLOBALS['____441702368'][2](___1366578981(4), $_1713819699); $_2024713965= ___1366578981(5).$GLOBALS['____441702368'][3]($GLOBALS['____441702368'][4](___1366578981(6))); $_658763027= $GLOBALS['____441702368'][5](___1366578981(7), $_942182292, $_2024713965, true); if($GLOBALS['____441702368'][6]($_658763027, $_1070489955) !==(762-2*381)){ if(isset($GLOBALS[___1366578981(8)]) && $GLOBALS['____441702368'][7]($GLOBALS[___1366578981(9)]) && $GLOBALS['____441702368'][8](array($GLOBALS[___1366578981(10)], ___1366578981(11))) &&!$GLOBALS['____441702368'][9](array($GLOBALS[___1366578981(12)], ___1366578981(13)))){ $GLOBALS['____441702368'][10](array($GLOBALS[___1366578981(14)], ___1366578981(15))); $GLOBALS['____441702368'][11](___1366578981(16), ___1366578981(17), true);}}} else{ $GLOBALS['____441702368'][12](___1366578981(18), ___1366578981(19), ___1366578981(20), round(0+6+6));}}/**/       //Do not remove this


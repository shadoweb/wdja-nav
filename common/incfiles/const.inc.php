<?php
//****************************************************
// WDJA CMS Power by wdja.net
// Email: admin@wdja.net
// Web: http://www.wdja.net/
//****************************************************
session_start();
date_default_timezone_set('Asia/Shanghai');
define('ADMIN_FOLDER','admin');
define('APP_NAME','wdja_');
define('CACHE_DIR','_CACHE');
define('CHARSET','utf-8');
define('COOKIES_PATH','/');
define('COOKIES_EXPIRES',date("l, d-M-Y H:i:s",time()+36000).' GMT');
define('CRLF', chr(13) . chr(10));
define('GMT_PLUS', 0);
define('WDJA_CINFO','<!--WDJA_CINFO-->');
define('WDJA_CINFO_INFOS','<!--WDJA_CINFO_INFOS-->');
define('NAV_SP_STR',' &raquo; ');
define('SP_STR','_');
define('SYS_NAME','WDJA');
define('USER_FOLDER','user');
define('XML_SFX','.wdja');
if (!defined('E_DEPRECATED')) error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
else error_reporting(E_ALL ^ E_NOTICE ^ E_DEPRECATED ^ E_WARNING);
header('Content-Type: text/html; charset=' . CHARSET);
$starttime = microtime(1);
define('DB_HOST','localhost');
define('DB_USERNAME','nav');
define('DB_PASSWORD','nav');
define('DB_DATABASE','nav');
define('DEFAULT_LANGUAGE','chinese');
define('DEFAULT_TEMPLATE','tpl_default');
define('DEFAULT_URL','www.ppdh.net');
define('MOBILE_URL','www.ppdh.net');
define('DEFAULT_SKIN','daohang');
define('MOBILE_SKIN','daohang');
define('ROBOTS_SKIN','daohang');
define('DEFAULT_HEAD','default_head');
define('DEFAULT_FOOT','default_foot');
define('SMTPTYPE','1');
define('SMTPCHARSET','utf8');
define('SMTPSERVER','smtp.qq.com');
define('SMTPPORT','465');
define('SMTPUSERNAME','sh***web@qq.com');
define('SMTPPASSWORD','');
define('SMTPFROMNAME','sh***web@qq.com');
define('API_ID','jx2drzu9oycnzy3h');
define('API_KEY','3ba2b923d4a79a014c7135dfc7b7d0c9');
define('OSS_SWITCH','0');
define('OSS_ID','');
define('OSS_KEY','');
define('OSS_POINT','oss-cn-shenzhen.aliyuncs.com');
define('OSS_BUCKET','WDJA');
define('OSS_BACK','0');
$db_host = DB_HOST;
$db_username = DB_USERNAME;
$db_password = DB_PASSWORD;
$db_database = DB_DATABASE;
$default_language = DEFAULT_LANGUAGE;
$default_template = DEFAULT_TEMPLATE;
$default_skin = DEFAULT_SKIN;
$mobile_skin = MOBILE_SKIN;
$robots_skin = ROBOTS_SKIN;
$default_head = DEFAULT_HEAD;
$default_foot = DEFAULT_FOOT;
//****************************************************
// WDJA CMS Power by wdja.net
// Email: admin@wdja.net
// Web: http://www.wdja.net/
//****************************************************
?>
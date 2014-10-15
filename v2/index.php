<?php
/**
 * 全局入口页
 * @authors MaiCong (sb@yxx.me)
 * @date    2014-07-23 09:37:47
 * @version v1.0
 */

define('WX_CORE', true);
define('WX_DEBUG', true);

require_once ('config.php');
require_once (WX_PATH.'/inc/McDo.class.php');
require_once (WX_PATH.'/inc/MysqliDb.class.php');
require_once (WX_PATH.'/inc/WeChat.class.php');

$wxdb = new MysqliDb(DB_HOST, DB_USER, DB_PWD, DB_NAME);
$wxdb->setPrefix('wx_');

$wxdo = new McDo(array(
		'cookie_prefix' => '__wx_',
		'base_url' => WX_URL
	));

$v = preg_replace('/[^a-z]+/', '', $wxdo->get('v'));

switch ($v) {
	case 'token':
		include_once (WX_PATH.'/view/token.php');
		break;
	case 'admin':
		include_once (WX_PATH.'/view/admin.php');
		break;
	case 'login':
		include_once (WX_PATH.'/view/login.php');
		break;
	case 'debug':
		include_once (WX_PATH.'/view/debug.php');
		break;
	case 'logout':
		session_destroy();
		header("Location: ".WX_URL);
		break;
	default:
		include_once (WX_PATH.'/view/home.php');
}

/*********************** end code ***/
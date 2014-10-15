<?php if (!defined('WX_CORE')) {header('HTTP/1.1 403 Forbidden');exit('<h1>403 - Forbidden</h1>');}
/**
 * 配置文件
 * @authors MaiCong (sb@yxx.me)
 * @date    2014-07-23 09:37:47
 * @version v1.0
 */

if(defined('WX_DEBUG') && WX_DEBUG) {
    error_reporting(E_ALL);
    ini_set('display_errors', 'On');
}else{
    error_reporting(0);
    ini_set('display_errors', 'Off');
}

define('WX_START_TIME', microtime(true));

// 程序路径
define('WX_PATH', rtrim(str_replace("\\", "/", dirname(__FILE__)), '/'));

// 程序url
define('WX_URL', 'http://weixin.domain.com');

// 微信AppId
define('WX_APPID', '[********]');

// 微信AppSecret
define('WX_APPSECRET', '[********]');

// 微信Token
define('WX_TOKEN', '[********]');

// Mysql数据库地址
define('DB_HOST', 'localhost');

// Mysql数据库表名
define('DB_NAME', 'dbwx01');

// Mysql数据库用户名
define('DB_USER', 'root');

// Mysql数据库密码
define('DB_PWD', 'root');

// Mysql数据库表前缀
define('DB_FIX', 'wx_');

header('Content-Type:text/html; charset=utf-8');

session_start();

/*********************** end code ***/
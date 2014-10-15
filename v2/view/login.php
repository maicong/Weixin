<?php if (!defined('WX_CORE')) {header('HTTP/1.1 403 Forbidden');exit('<h1>403 - Forbidden</h1>');}
/**
 * 登录处理
 * @authors MaiCong (sb@yxx.me)
 * @date    2014-07-23 09:37:47
 * @version v1.0
 */

$user  = htmlspecialchars(preg_replace('/[^\w]+/iu', '', $wxdo->post('username')));
$pwd   = sha1(md5($wxdo->post('password')));
$token = htmlspecialchars($wxdo->post('tokenhash'));
$hash  = md5(uniqid(mt_rand()));

!isset($_SESSION['showerr']) && $_SESSION['showerr'] = 0;

$_SESSION['showerr']++;

if ($_SESSION['showerr'] > 2) {
	unset($_SESSION['err']);
	$_SESSION['showerr'] = 0;
}

if ($token) {
	if ($token != $wxdo->session('hash')) {
		$err = '来路不正确请刷新重试';
	} elseif (empty($user) || empty($pwd)) {
		$err = '帐号或密码不能为空';
	} else {
		$cked = $wxdb->where('user', $user)->where('pwd', $pwd)->get('user', 1);
		if (!$cked) {
			$err = '帐号或密码错误';
		} else {
			$_SESSION['user'] = $user;
			header('location:?v=admin');
			exit();
		}
	}
	$_SESSION['err']     = $err;
	$_SESSION['showerr'] = 1;
	header('location:?v=login');
	exit();
}

$_SESSION['hash'] = $hash;

include_once(WX_PATH.'/tpl/login.php');

/*********************** end code ***/
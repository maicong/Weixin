<?php
/**
*   [***]彩票网微信入口
*   v1.2 By HagenYu
*/
include "wechat.class.php";
$options = array(
		'token'=>'**********',
		'appid'=>'**********',
		'appsecret'=>'**********'
	);
$weObj = new Wechat($options);
$weObj->valid();
$type = $weObj->getRev()->getRevType();
$keyword =$weObj->getRev()->getRevContent();
$form = $weObj->getRev()->getRevEvent();
$form_Event =$form['event'];
$form_Key = $form['key'];
$text_arr = array(
	'1' => "感谢亲关注[***]彩票网，[***]彩票网(www.[***]caipiao.com)是国内一流的福利彩票和体育彩票互联网代购平台。我们将通过微信公众平台为您提供最新的开奖服务和最新的彩票资讯，让你离中大奖更进一步！\r\n回复A，获取开奖服务指令；\r\n回复B，获取最新[***]彩票网活动指令；\r\n回复H，获取指令菜单；\r\n直接回复彩种或名称缩写也可获取开奖信息；\r\n亲快快来体验吧，您还在等什么！\r\n[***]彩票网和您一起见证大奖！",
	'2' => "你就这么忍心抛弃我吗？",
	'3' => "回复A，获取开奖服务指令；\r\n回复B，获取最新[***]彩票网活动指令；\r\n回复H，获取指令菜单；\r\n直接回复彩种或名称缩写也可获取开奖信息；\r\n亲快快来体验吧，您还在等什么！[***]彩票网和您一起见证大奖！",
	'4' => "回复1，获取双色球开奖信息；\r\n回复2，获取东方6+1开奖信息；\r\n回复3，获取福彩3D开奖信息；\r\n回复4，获取大乐透开奖信息；\r\n回复5，获取排列3开奖信息；\r\n回复6，获取排列5开奖信息；\r\n回复0，获取更多开奖信息；\r\n回复H，获取指令菜单；\r\n直接回复彩种或名称缩写也可获取开奖信息；\r\n如有投诉建议请拨打[***]彩票网客服电话：400-000-0000；愿大奖和您在一起！\r\n您可以进入[***]彩票网享受更多服务www.[***]caipiao.com",
	'5' => array(
		"0"=>array(
			'Title' => '江西时时彩1000万加奖',
			'Description' => '1、派奖奖金 本次派奖总奖金为1000万元 2、派奖时间 2014年5月26日至1000万奖金派完为止',
			'PicUrl' => 'http://www.[***]caipiao.com/img/v3/images/jxssc.jpg',
			'Url' => 'http://www.[***]caipiao.com/news/view-65405-1.html'
		),
		"1"=>array(
			'Title' => '周末玩3D，中奖送红包 中的越多奖金越多!',
			'Description' => '尊敬的彩民朋友们：为了让大家赢得更多奖金，[***]彩票网近期开展了周末玩3D，中奖送红包大礼。中的越多红包越多!',
			'PicUrl' => 'http://www.[***]caipiao.com/img/v3/images/3d.jpg',
			'Url' => 'http://www.[***]caipiao.com/news/view-59984-1.html'
		),
		"2"=>array(
			'Title' => '新用户注册送彩金',
			'Description' => '即日起，在[***]彩票网上进行注册，完成帐户手机认证并填写有效的真实姓名及身份证号码，即可获得[***]彩票网赠送的3元彩金。',
			'PicUrl' => 'http://www.[***]caipiao.com/img/v3/images/reg.jpg',
			'Url' => 'http://www.[***]caipiao.com/news/view-62616-1.html'
		)
	),
	'6' => "回复7，获取七星彩开奖信息；\r\n回复8，获取22选5开奖信息；\r\n回复11，获取胜负彩开奖信息；\r\n回复12，获取任选9场开奖信息；\r\n回复13，获取进球彩开奖信息；\r\n回复14，获取半全场开奖信息；\r\n回复H，获取指令菜单；\r\n直接回复彩种或名称缩写也可获取开奖信息；\r\n如有投诉建议请拨打[***]彩票网客服电话：400-000-0000；愿大奖和您在一起！\r\n您可以进入[***]彩票网享受更多服务www.[***]caipiao.com",
	'7' => "相关推荐、分析、预测的信息请登录 http://www.[***]caipiao.com/news/"
);

switch($type) {
	case Wechat::MSGTYPE_TEXT:
		switch (strtoupper($keyword)) {
			case 'HELLO2BIZUSER':
			case 'SUBSCRIBE':
				$note = $text_arr['1'];
				$weObj->text($note)->reply();
				break;
			case 'UNSUBSCRIBE':
				$note = $text_arr['2'];
				$weObj->text($note)->reply();
				break;
			case 'HELP':
			case 'H':
			case '菜单':
			case '帮助':
			case '彩票':
			case '开奖':
				$note = $text_arr['3'];
				$weObj->text($note)->reply();
				break;
			case 'A':
				$note = $text_arr['4'];
				$weObj->text($note)->reply();
				break;
			case 'B':
			case '活动':
				$newsData = $text_arr['5'];
				$weObj->news($newsData)->reply();
				break;
			case '0':
				$note = $text_arr['6'];
				$weObj->text($note)->reply();
				break;
			case '推荐':
			case '预测':
			case '﻿分析':
				$note = $text_arr['7'];
				$weObj->text($note)->reply();
				break;
			default:
				$weObj->lottery($keyword)->reply();
				break;
		}
		break;
	case Wechat::MSGTYPE_EVENT:
		if ('CLICK' === $form_Event) {
			if (strstr($form_Key, 'rand')) {
				$weObj->lottery($form_Key, 'rand')->reply();
			} else {
				switch ($form_Key) {
					case 'A':
						$note = $text_arr['4'];
						$weObj->text($note)->reply();
						break;
					case 'B':
						$newsData = $text_arr['5'];
						$weObj->news($newsData)->reply();
						break;
					case '0':
						$note = $text_arr['6'];
						$weObj->text($note)->reply();
						break;
					case 'zcnews':
					case 'szcnews':
						$weObj->lottery($form_Key, 'news')->reply();
						break;
					default:
						$weObj->lottery($form_Key)->reply();
						break;
				}
			}
		}
		break;
	case Wechat::MSGTYPE_VOICE:
		$weObj->text("啦啦啦~啦啦啦~")->reply();
		break;
	case Wechat::MSGTYPE_IMAGE:
		$weObj->text("这是一张图片咩~")->reply();
		break;
	case Wechat::MSGTYPE_LINK:
		$weObj->text("你发送了什么链接？")->reply();
		break;
	default:
		$weObj->text("您好，我是[***]微信小助手，请问有什么需要帮助的吗？回复H获取帮助菜单！")->reply();
		break;
}
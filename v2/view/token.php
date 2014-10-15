<?php if (!defined('WX_CORE')) {header('HTTP/1.1 403 Forbidden');exit('<h1>403 - Forbidden</h1>');}
/**
 * 微信入口文件
 * @authors MaiCong (sb@yxx.me)
 * @date    2014-07-23 09:37:47
 * @version v1.0
 */

$weObj = new Wechat(array(
		'token'     => WX_TOKEN,
		'appid'     => WX_APPID,
		'appsecret' => WX_APPSECRET
	));
$weObj->valid();

$type       = $weObj->getRev()->getRevType();
$keyword    = $weObj->getRev()->getRevContent();
$form       = $weObj->getRev()->getRevEvent();
$form_Event = $form['event'];
$form_Key   = $form['key'];

switch ($type) {
	case Wechat::MSGTYPE_TEXT:
		$keyword  = strtoupper($wxdo->xss_clean($keyword));
		$chatArr  = $wxdb->get('chat', null, array("type", "key", "note"));
		$replyArr = array();
		if (empty($chatArr)) {
			$weObj->xiaohuangji($keyword)->reply();
		} else {
			foreach ($chatArr as $val) {
				similar_text($keyword, strtoupper($val['key']), $similarity);
				if (round($similarity) > 30) {
					$replyArr[round($similarity)] = array('type' => $val['type'], 'note' => $val['note']);
				}
			}
			krsort($replyArr);
			$reply = reset($replyArr);
			if (empty($reply)) {
				$weObj->xiaohuangji($keyword)->reply();
			} else {
				if ($reply['type'] == 'text') {
					$weObj->text($reply['note'])->reply();
				} elseif ($reply['type'] == 'news') {
					$weObj->news($reply['note'])->reply();
				} else {
					$weObj->text('等等，让我思考一会。')->reply();
				}
			}
		}
		break;
	case Wechat::MSGTYPE_EVENT:
		if ('CLICK' === $form_Event) {
			$chat = $wxdb->where("`key` = '$form_Key'")->getOne('chat');
			if ($chat) {
				$newsData = $chat['note'];
				$weObj->news($newsData)->reply();
			} else {
				$weObj->xiaohuangji($form_Key)->reply();
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
		$weObj->text("您好，感谢您的咨询，我们稍后将进行答复。")->reply();
		break;
}

/*********************** end code ***/
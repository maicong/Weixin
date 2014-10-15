<?php
/**
*   [***]彩票网微信开奖接口
*   v1.2 By HagenYu
*/
header('Content-Type:text/html;charset=utf-8');

function get_contents($url){
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_TIMEOUT, 30); // 30秒超时
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); // 禁用验证
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE); // 返回原网页
	curl_setopt($ch, CURLOPT_REFERER, 'http://hao123.lecai.com'); // 伪造来源
	curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.2; Trident/6.0)'); // 伪造User-Agent
	curl_setopt($ch, CURLOPT_HTTPHEADER , array('X-FORWARDED-FOR:1.2.4.8', 'X-FORWARDED-HOST:hao123.lecai.com', 'X-FORWARDED-SERVER:hao123.lecai.com')); // 伪造HTTP头
	$response =  curl_exec($ch);
	curl_close($ch);

	// 请求为空
	if(empty($response)){
		$response = json_encode(array('message'=>'暂时无法获取数据','data'=>''));
	}

	return $response;
}

function cn_zodiac($num){
	$zarr = array('01'=>'鼠', '02'=>'牛', '03'=>'虎', '04'=>'兔', '05'=>'龙', '06'=>'蛇', '07'=>'马', '08'=>'羊', '09'=>'猴', '10'=>'鸡', '11'=>'狗', '12'=>'猪');
	return $zarr[$num];
}

function lottery_num($num, $str){
	$lott = '';
	switch($num) {
		case 1: case 50:
			$lott .= '红球 ';
			for ($i=0; $i<=count($str[0]['data']); $i++) {
				$lott .= $str[0]['data'][$i] . ' ';
			}
			$lott .= '蓝球 ';
			for ($i=0; $i<=count($str[1]['data']); $i++) {
				$lott .= $str[1]['data'][$i] . ' ';
			}
		break;
		case 54:
			$lott .= '数字 ';
			for ($i=0; $i<=count($str[0]['data']); $i++) {
				$lott .= $str[0]['data'][$i] . ' ';
			}
			$lott .= '生肖 ';
			for ($i=0; $i<=count($str[1]['data']); $i++) {
				$lott .= cn_zodiac($str[1]['data'][$i]) . ' ';
			}
		break;
		default:
			for ($i=0; $i<=count($str[0]['data']); $i++) {
				$lott .= $str[0]['data'][$i] . ' ';
			}
	}
	return $lott;
}

$key = urldecode($_REQUEST['key']);
$key = trim(strtolower(str_replace('开奖', '', $key)));

$type = urldecode($_REQUEST['type']);
$phase = urldecode($_REQUEST['phase']);

$keyarr = array(
	array('key' => array('dlt', '大乐透', '4'), 'num' => '1', 'name' => '大乐透'),
	array('key' => array('qxc', '七星彩', '7xc', '7'), 'num' => '2', 'name' => '七星彩'),
	array('key' => array('pl3', '排列三', '排列3', 'pls', '5'), 'num' => '3', 'name' => '排列三'),
	array('key' => array('pl5', '排列五', '排列5', 'plw', '6'), 'num' => '4', 'name' => '排列五'),
	array('key' => array('22x5', '22选5', '225', 'eex5', 'eexw', 'eew', 'esexw', 'esex5', 'esew', 'ee5', '8'), 'num' => '5', 'name' => '22选5'),
	array('key' => array('sfc', '14场胜负彩', '胜负彩', '14csfc', 'sscsfc', '11'), 'num' => '7', 'name' => '14场胜负彩'),
	array('key' => array('rx9c', 'rxjc', '任选9场', '任选九场', '9场', 'jc', '9c', '12'), 'num' => '8', 'name' => '任选9场'),
	array('key' => array('jqc', '4cjqc', 'scjqc', '4场进球彩', '四场进球彩', '进球彩', '4场', 'sc', '4c', '13'), 'num' => '9', 'name' => '4场进球彩'),
	array('key' => array('bqc', '6cbqc', 'lcbqc', '6场半全场', '六场半全场', '半全场', '6场', 'lc', '6c', '14'), 'num' => '10', 'name' => '6场半全场'),
	array('key' => array('l11x5', '老11选5', '十一运夺金', '11运夺金', '山东11选5', 'l115', 'lsyx5', 'lsyxw', 'lsyw', 'lyyw', 'lyyxw', 'lyyx5', 'lyy5', '19'), 'num' => '20', 'name' => '老11选5'),
	array('key' => array('x11x5', '新11选5', '多乐彩', '江西11选5', 'x115', 'xsyx5', 'xsyxw', 'xsyw', 'xyyw', 'xyyxw', 'xyyx5', 'xyy5', '10'), 'num' => '22', 'name' => '新11选5'),
	array('key' => array('11x5', '11选5', '115', 'syx5', 'syxw', 'syw', 'yyw', 'yyxw', 'yyx5', 'yy5', '10'), 'num' => '22', 'name' => '新11选5'),
	array('key' => array('ssq', '双色球', '1'), 'num' => '50', 'name' => '双色球'),
	array('key' => array('3d', '福彩3D', '3', 'fc3d'), 'num' => '52', 'name' => '福彩3D'),
	array('key' => array('df6+1', '东方6+1', '2', 'df61'), 'num' => '54', 'name' => '东方6+1'),
	array('key' => array('ssc', '时时彩', '重庆时时彩', '老时时彩', '9'), 'num' => '200', 'name' => '老时时彩'),
	array('key' => array('ssl', '时时乐', '17'), 'num' => '201', 'name' => '时时乐'),
	array('key' => array('xssc', '新时时彩', '江西时时彩', '16'), 'num' => '202', 'name' => '新时时彩'),
	array('key' => array('klb', 'kl8', '快乐8', '23'), 'num' => '543', 'name' => '快乐8'),
	array('key' => array('pks', 'pk10', 'PK拾', '20'), 'num' => '557', 'name' => 'PK拾'),
	array('key' => array('xks', 'xk3', '新快3', '新快三', '21'), 'num' => '560', 'name' => '新快3'),
	array('key' => array('ks', 'k3', '快3', '快三', '15'), 'num' => '561', 'name' => '快3'),
	array('key' => array('lks', 'lk3', '老快3', '老快三', '22'), 'num' => '564', 'name' => '老快3'),
);

foreach ($keyarr as $arr) {
	if (in_array($key, $arr['key'])) {
		$num = $arr['num'];
		$name = $arr['name'];
	}
}

$url = 'http://hao123.lecai.com/lottery/ajax_lottery_draw_phaselist.php?lottery_type='.  $num;
$info = get_contents($url);
$json = json_decode($info, true);

if (empty($key)) {
	$json['message'] = '请输入要查询的彩种';
}

if (empty($num)) {
	$json['message'] = '暂不支持此彩种';
}

if (empty($phase)) {
	$data = $json['data']['data'][0]; //开奖数据
	$phase = empty($data['phase']) ? 0 : $data['phase']; // 期次
} else {
	foreach($json['data']['data'] as $key => $value) {
		$result[$key] = array_keys($value, $phase);
		if ( ! empty($result[$key])) $dnum = $key;
	}
	$data = $json['data']['data'][$dnum];
	$json['message'] = '当前期次有误';
}

$time_draw = empty($data['time_draw']) ? 0 : date('Y-m-d', strtotime($data['time_draw'])); // 开奖日期
$sale_amount = empty($data['sale_amount']) ? '-' : $data['sale_amount'] . '元'; // 本期销量
$pool_amount = empty($data['pool_amount']) ? '-' : $data['pool_amount'] . '元'; // 奖池滚存
$message = $json['message']; // 错误消息

if (empty($type)) {
	$type = 'html';  
}

if ($type == 'json') {
	header('Content-type: text/json');
	if (empty($data)) {
		echo json_encode(array('error' => $message));
		exit();
	}
	$lottery = array(
		'name' => $name, 
		'phase' => $phase, 
		'lottery_num' => $data['result']['result'], 
		'time_draw' => $time_draw, 
		'sale_amount' => $sale_amount, 
		'pool_amount' => $pool_amount
	);
	echo json_encode($lottery);
} else {
	if (empty($data)) {
		echo $message;
		exit();
	}
	echo "{$name} 第 {$phase} 期开奖结果：\n";
	echo "开奖号码：" . lottery_num($num, $data['result']['result']) . "\n";
	echo "开奖日期：{$time_draw}\n";
	echo "本期销量：{$sale_amount}\n";
	echo "奖池滚存：{$pool_amount}\n";
}
<?php
/**
 * 汇率转换，Currency Converter.  xiaojo微信插件
 * author：灵静斋steve
 * date:2013.6.2
 */
header("Content-type: text/html; charset=utf-8");
$getdata=urldecode($_REQUEST['key']);
$getdata=trim(str_replace('汇率','',$getdata));//把计算换成你要的关键词
$regexp = "/(-?\d+)(\.\d+)?/";
preg_match($regexp,$getdata,$n);
$from_cur_CNY=$n[0];  //提取金额数目
$from=mb_substr($getdata,0,1,'utf-8');
$to=mb_substr($getdata,1,1,'utf-8');
switch($from){
  	case "中":$from="CNY";break;
    case "港":$from="HKD";break;
    case "日":$from="JPY";break;
    case "美":$from="USD";break;
  	case "台":$from="TWD";break;
    case "欧":$from="EUR";break;  
    case "英":$from="GBP";break;
    case "澳":$from="AUD";break;
  	case "新":$from="SGD";break;
 	case "韩":$from="KRW";break;
    case "加":$from="CAD";break;
    default: $from="0";break;
}
switch($to){
  	case "中":$to="CNY";break;
    case "港":$to="HKD";break;
    case "日":$to="JPY";break;
    case "美":$to="USD";break;
  	case "台":$to="TWD";break;
    case "欧":$to="EUR";break;  
    case "英":$to="GBP";break;
  	case "澳":$to="AUD";break;
  	case "韩":$to="KRW";break;
 	case "新":$to="SGD";break;
    case "加":$to="CAD";break;
    default: $to="0";break;
}
if($from=="0"||$to=="0"){
 	echo "查询错误：输入的货币或字符非法！请输入 汇率 了解相关帮助";
}else{
	echo $from_cur_CNY."→".currency($from, $to, $from_cur_CNY);break;
}
//Google 实时汇率兑换接口
function currency($from_currency, $to_currency, $amount)
{
    $amount = urlencode($amount);
    $from_currency = urlencode($from_currency);
    $to_currency = urlencode($to_currency);
    $url = "http://www.google.com/ig/calculator?hl=en&q=$amount$from_currency=?$to_currency";
    $ch = curl_init();
    $timeout = 0;
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.1)");
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
    $rawdata = curl_exec($ch);
    curl_close($ch);
    $data = explode('"', $rawdata);
    $data = explode('.', $data['3']);
  	$flag=strstr($data[1],"million");//判断是否有百万字符
    $data[0] = str_replace(" ", "",preg_replace('/\D/', '',  $data[0]));
	if(isset($data[1])){
    	$data[1] = str_replace(" ", "",preg_replace('/\D/', '', $data[1]));
    	$var = $data[0].".".$data[1];        
  	} else{
    	$var = $data[0];
  	}
  	if($flag){
      	return $var."百万";
    }else{
    	return round($var, 2);
    }
}

?>

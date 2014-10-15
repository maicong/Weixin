<?php 
header("Content-Type:text/html;charset=utf-8"); 
$dream = urldecode($_REQUEST['key']); 

$dream=str_replace('梦见','',$dream);//把解梦换成你要的关键词

$dream=rawurlencode(mb_convert_encoding($dream, 'gb2312', 'utf-8'));

if (isset($_REQUEST['key'])) { 
$url = 'http://www.gpsso.com/WebService/Dream/Dream.asmx/SearchDreamInfo'; 
$ch = curl_init(); 
curl_setopt($ch, CURLOPT_URL, $url); 
curl_setopt($ch, CURLOPT_POST, true); 
curl_setopt($ch, CURLOPT_POSTFIELDS, "dream={$dream}"); 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
$data = curl_exec($ch); 
curl_close($ch); 
if(!$data){
 $results="查询失败，可能是我太笨啦，找不到周公！";
 }else{
$results=str_replace('<?xml version="1.0" encoding="utf-8"?>','',$data);
    $results=str_replace('<API>','',$results);
    $results=str_replace('  <MESSAGE>接口查询成功</MESSAGE>','',$results);
    $results=str_replace('  <RESULTS>0</RESULTS>','',$results);
  	$results=str_replace('<DREAM>','',$results);
    $results=str_replace('</DREAM>','',$results);
  $results=str_replace('</API>','要解梦请发送\n梦见+内容\n',$results);
  $results=str_replace('  <INFO>未知数据</INFO>','查询失败，可能是我太笨啦，找不到周公！',$results);
  $results=str_replace('\n','%n',$results);
  
  
}
echo $results;
} 

?>
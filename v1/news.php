<?php
/**
*   [***]彩票网微信资讯显示入口
*   v1.2 By HagenYu
*/
header('Content-type: text/html; charset=utf-8');
error_reporting(0);
$key = urldecode($_REQUEST['key']);
if(empty($key)){
  echo "暂时无法处理您的请求";
}elseif(!is_numeric($key)){
  echo "参数id非法";
}elseif($key < 2479){
  echo "参数id不存在";
}else{
include_once 'phpQuery.php'; 
$url = 'www.[***]caipiao.com/news/view-'.$key.'-1.html';
phpQuery::newDocumentFile($url);
$title = pq(".post-head>h1")->text();
// $time = pq(".post-meta>span>:eq(0)")->text();
$info = pq(".post-body")->html();
$content = preg_replace("/<a[^>]+>(.+?)<\/a>/i","$1",$info);
$content = str_replace('src="/uploads','src="http://cms.[***]caipiao.com/uploads',$info);
?>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8">
<title><?php echo trim($title); ?> | [***]彩票网微信端资讯</title>
<meta name="viewport" content="width=device-width,height=device-height,inital-scale=1.0,maximum-scale=1.0,user-scalable=no;">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta name="format-detection" content="telephone=no">
<meta name="author" content="HagenYu">
<link rel="stylesheet" href="news.css">
</head>
<body>
<div class="page">
    <h1 class="page-title"><?php echo trim($title); ?></h1>
    <div class="page-link">
        <div class="logo">
            <div class="circle"></div>
            <img src="http://wx.xiaojo.com/public/upload/13/07/16/137395679132201.jpg"></div>
        <div class="nickname">[***]彩票网</div>
        <div class="weixinid">微信号:[***]caipiao</div>
    </div>
    <div class="page-content">
        <?php echo $content; ?>
    </div>
  <div class="page-follow">关注[***]彩票网微信公众号，一键帮您查询，轻松获取最新资讯！</div>
</div>
</body>
</html>
<?php } ?>
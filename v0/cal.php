<?php 
header("Content-Type:text/html;charset=utf-8"); 
$cal = urldecode($_REQUEST['key']); 
$cal=str_replace('计算','',$cal);//把计算换成你要的关键词
$cal=str_replace(' ','+',$cal);//小九的规则，把加号过滤掉了，现在又补充回去
$result=eval("return $cal;");
if ($result!= 0){
if(empty($result)){
  echo "字符非法，请书写满足数学表达式的相应字符(请使用西文字符，包括括号)：+ - * / abs() sin()，比如:计算5*(sin(2)-3)";
}else{
echo "等于：$result";
}
}else{
echo "等于：0";	
}
?>
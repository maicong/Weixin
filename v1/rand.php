<?php
/**
*   [***]彩票网微信随机一注入口
*   v1.2 By HagenYu
*/
header("Content-Type:text/html;charset=utf-8"); 
$randkey = urldecode($_REQUEST['key']);
$red1=array_rand(range(1,33),7);
$red2=array_rand(range(1,35),6);
$blue1=mt_rand(1,16);
$blue2=array_rand(range(1,12),3);
$fc1 = mt_rand(0,9);
$fc2 = mt_rand(0,9);
$fc3 = mt_rand(0,9);
$pls1 = mt_rand(0,9);
$pls2 = mt_rand(0,9);
$pls3 = mt_rand(0,9);
$plw1 = mt_rand(0,9);
$plw2 = mt_rand(0,9);
$plw3 = mt_rand(0,9);
$plw4 = mt_rand(0,9);
$plw5 = mt_rand(0,9);
if ($randkey=="randssq"){
echo '随机一注双色球： ';
for ($i=1;$i<7;$i++) {
$ssqred = $red1[$i] <10 ? "0".$red1[$i] : $red1[$i]; 
echo $ssqred." ";
}
$ssqblue = $blue1 <10 ? "0".$blue1 : $blue1; 
echo "+ ".$ssqblue;
}
elseif ($randkey=="randdlt"){
echo '随机一注大乐透： ';
for ($ii=1;$ii<6;$ii++) {
$dltred = $red2[$ii] <10 ? "0".$red2[$ii] : $red2[$ii]; 
echo $dltred." ";
}
echo '+';
for ($iii=1;$iii<3;$iii++) {
$dltblue = $blue2[$iii] <10 ? "0".$blue2[$iii] : $blue2[$iii]; 
echo " ".$dltblue;
}
}
elseif ($randkey=="randfc3d"){
echo '随机一注福彩3D： ';
echo $fc1." ".$fc2." ".$fc3;
}
elseif ($randkey=="randpls"){
echo '随机一注排列三： ';
echo $pls1." ".$pls2." ".$pls3;
}
elseif ($randkey=="randplw"){
echo '随机一注排列五： ';
echo $plw1." ".$plw2." ".$plw3." ".$plw4." ".$plw5;
}
else{
echo '暂不支持此彩种';
}
?>
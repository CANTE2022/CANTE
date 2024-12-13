<?php

if( $_SERVER['HTTP_REFERER'] == "" ){
header("");
echo '<script type="text/javascript">window.location.href="/"</script>'; 
exit('错误');}

include "includes/commons.inc.php";

phpdisk_core::user_login();
$in_front = true;
define('IN_MYDISK' ,true);
$title = '空间安全 '.$settings['site_title'];
$diskurl =$settings['phpdisk_url'];
include PHPDISK_ROOT.'includes/header.inc.php';
$act = trim(gpc('act','G',''));

$userinfo= @$db->fetch_one_array("select * from {$tpf}users where userid='$pd_uid'");
$diskinfo= @$db->fetch_one_array("select * from {$tpf}groups where gid=".$userinfo['gid']);

//print_r($diskinfo);
if($act =='index'){
require_once template_echo('aq_index',$user_tpl_dir);

}
elseif($act=="dlmm"){
$rsd = trim(gpc('rsd','P',''));
$t2 = trim(gpc('t2','P',''));
if(intval($rsd)==0){
$sql = "update {$tpf}users set dlmm='' where userid='$pd_uid'";
}elseif(intval($rsd)==1){
$sql = "update {$tpf}users set dlmm='$t2' where userid='$pd_uid'";
}
$db->query_unbuffered($sql);
echo '<script type="text/javascript">alert("操作成功!");window.location.href="/aq.php?act=index"</script>';
}


elseif($act=="glmm"){
require_once template_echo('aq_glmm',$user_tpl_dir);
}

elseif($act=="glmme"){
$sd_te1 = trim(gpc('sd_te1','P','1'));
$sd_te2 = trim(gpc('sd_te2','P','1'));
$sd_te3 = trim(gpc('sd_te3','P','1'));


if(empty($sd_te2)){
echo '<script type="text/javascript">alert("新管理密码不能为空!");window.history.back(-1);</script>';
exit;
}
if(strlen($sd_te2)<6){
echo '<script type="text/javascript">alert("新管理密码长度必须6-20位!");window.history.back(-1);</script>';
exit;
}


if($sd_te2!=$sd_te3){
echo '<script type="text/javascript">alert("新管理密码和确认新密码不一至!");window.history.back(-1);</script>';
exit;
}
if(md5($sd_te1)!=$userinfo['password']){
echo '<script type="text/javascript">alert("原管理密码不正确!");window.history.back(-1);</script>';
exit;
}
$t2=md5($sd_te2);
$sql = "update {$tpf}users set password='$t2' where userid='$pd_uid'";
$db->query($sql);
echo '<script type="text/javascript">alert("操作成功!");window.location.href="/aq.php?act=glmm"</script>';
}




elseif($act=="szmb"){
	
if(!empty($userinfo['wen1'])){
	header('Location:/aq.php?act=xgmb');
}

require_once template_echo('aq_szmb',$user_tpl_dir);
}

elseif($act=="szmbs"){
$wen1 = trim(gpc('wen1','P',''));
$daan1 = trim(gpc('daan1','P',''));
$wen2 = trim(gpc('wen2','P',''));
$daan2 = trim(gpc('daan2','P',''));
if(empty($wen1)||empty($daan1)||empty($wen2)||empty($daan2)){
echo '<script type="text/javascript">alert("请设置好密保资料!");window.history.back(-1);</script>';
exit;
}
$sql = "update {$tpf}users set wen1='$wen1',daan1='$daan1',wen2='$wen2',daan2='$daan2' where userid='$pd_uid'";
$db->query($sql);
echo '<script type="text/javascript">alert("操作成功，请牢记您的密保资料!");window.location.href="/aq.php?act=szmb"</script>';

}



elseif($act=="xgmb"){
	
if(empty($userinfo['wen1'])){
	header('Location:/aq.php?act=szmb');
}

require_once template_echo('aq_xgmb',$user_tpl_dir);
}

elseif($act=="xgmbe"){
$y_da1 = trim(gpc('y_da1','P',''));
$y_da2 = trim(gpc('y_da2','P',''));



$x_wt1 = trim(gpc('x_wt1','P',''));
$x_da1 = trim(gpc('x_da1','P',''));
$x_wt2 = trim(gpc('x_wt2','P',''));
$x_da2 = trim(gpc('x_da2','P',''));

if($userinfo['daan1']!=$y_da1){
echo '<script type="text/javascript">alert("答案1不正确!");window.history.back(-1);</script>';
exit;
}
if($userinfo['daan2']!=$y_da2){
echo '<script type="text/javascript">alert("答案2不正确!");window.history.back(-1);</script>';
exit;
}

if(empty($x_wt1)||empty($x_da1)||empty($x_wt2)||empty($x_da2)){
echo '<script type="text/javascript">alert("请设置好密保资料!");window.history.back(-1);</script>';
exit;
}
$sql = "update {$tpf}users set wen1='$x_wt1',daan1='$x_da1',wen2='$x_wt2',daan2='$x_da2' where userid='$pd_uid'";
$db->query($sql);
echo '<script type="text/javascript">alert("操作成功，请牢记您的密保资料!");window.location.href="/aq.php?act=xgmb"</script>';

}



else{
	redirect("aq.php?act=index",'',0);
}

include PHPDISK_ROOT."./includes/footer.inc.php";

?>



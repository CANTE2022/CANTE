<?php

if( $_SERVER['HTTP_REFERER'] == "" ){
header("");
echo '<script type="text/javascript">window.location.href="/"</script>'; 
exit('错误');}

include "includes/commons.inc.php";

$in_front = true;
define('IN_MYDISK' ,true);
$diskurl =$settings['phpdisk_url'];
$act = trim(gpc('act','G',''));
$name = trim(gpc('name','G',''));
$userinfo= @$db->fetch_one_array("select * from {$tpf}users where username='$name'");
if(empty($userinfo)){
	echo '<script type="text/javascript">alert("您访问的Ｅ盘空间不存在或者尚未注册!");window.location.href="/user.php"</script>';
	exit;
}
if($act =='display'){
	
$teqtbz = trim(gpc('teqtbz','P',''));
if($teqtbz!=$userinfo['dlmm']){
	$error="登录密码不正确！";
	$_SESSION['diskstatus']='';
}else{
	$_SESSION['diskstatus']=$name;
	header("Location:/disk.php?name=".$name);
}
require_once template_echo('login_index',$user_tpl_dir);
}
else{
	require_once template_echo('login_index',$user_tpl_dir);
}


?>


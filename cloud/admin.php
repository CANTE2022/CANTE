<?php

include "includes/commons.inc.php";

$in_front = true;
define('IN_MYDISK' ,true);
$diskurl =$settings['phpdisk_url'];
$max_file_size =$settings['max_file_size'];
$act = trim(gpc('act','G',''));
//$name = "www.56wl.net";
$name = "admin";//这里设置你在海诚Ｅ盘注册的用户名
$userinfo= @$db->fetch_one_array("select * from {$tpf}users where username='$name'");
if(empty($userinfo)){
	echo '<script type="text/javascript">alert("您访问的空间不存在!");window.location.href="/"</script>';
	exit;
}
if($userinfo['gid']!=1&&$userinfo['gid']!=4){
	if(time()>$userinfo['dqsj']){
		echo '<script type="text/javascript">alert("此空间已到期!");window.location.href="/"</script>';
		exit;
	}
}

if($_SESSION['diskstatus']!=$name & !empty($userinfo['dlmm'])){
	$_SESSION['diskstatus']='';
	//header("Location:/l.php?name=".$name);
	//exit;
}

if(!empty($userinfo['seo1'])){
	$webtitle=$userinfo['seo1'];
}elseif(!empty($userinfo['t1'])){
	$webtitle=$userinfo['t1'];
}else{
	$webtitle=$userinfo['username'];
}

if(!empty($userinfo['seo2'])){
	$webkey=$userinfo['seo2'];
}
if(!empty($userinfo['seo3'])){
	$webdes=$userinfo['seo3'];
}
$sql = "update {$tpf}users set allcount=`allcount`+1 where userid='".$userinfo['userid']."'";
$db->query_unbuffered($sql);


$intime=time();
$rs = $db->fetch_one_array("select * from {$tpf}oline where userid='".$userinfo['userid']."' and ip='$onlineip' limit 1");
//echo "select * from {$tpf}oline where userid='".$userinfo['userid']."' and ip='$onlineip' limit 1";
if(!$rs){
$sql = "insert into {$tpf}oline(userid,ip,intime) values('".$userinfo['userid']."','".$onlineip."','".time()."')";
$db->query_unbuffered($sql);

}else{
$sql = "update {$tpf}oline set intime='".time()."' where userid='".$userinfo['userid']."' and ip='".$onlineip."' and intime>=".$intime;
$db->query_unbuffered($sql);
}
//$sql = "update {$tpf}users set allcount=`allcount`+1 where userid='".$userinfo['userid']."'";

$diskinfo= @$db->fetch_one_array("select * from {$tpf}groups where gid=".$userinfo['gid']);
$file_size_total = $db->result_first("select sum(file_size) from {$tpf}files where userid='".$userinfo['userid']."'");
if(intval($userinfo['dqlq'])==0){
	$info="未定";
}else{
	$info=date("Y-m-d",$userinfo['dqlq']);
}
$userlk= $db->query("select * from {$tpf}userlinks where userid='".$userinfo['userid']."'");

if($act =='asdfasd'){


}
else{
	require_once template_echo('disk_index',$user_tpl_dir);
}

?>
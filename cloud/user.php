<?php

include "includes/commons.inc.php";

phpdisk_core::user_login();
$in_front = true;
define('IN_MYDISK' ,true);
$title = '空间管理 '.$settings['site_title'];
$diskurl =$settings['phpdisk_url'];
include PHPDISK_ROOT.'includes/header.inc.php';
$act = trim(gpc('act','G',''));

$userinfo= @$db->fetch_one_array("select * from {$tpf}users where userid='$pd_uid'");
$diskinfo= @$db->fetch_one_array("select * from {$tpf}groups where gid=".$userinfo['gid']);

//print_r($diskinfo);
if($act =='index'){

if($userinfo['gid']<>4 && $userinfo['gid']<>1){
	$dqsj=date("Y-m-d",$userinfo['dqsj']);
}else{
	$dqsj='免费用户六个月内至少要在空间管理区登录一次，否则空间会被锁定。<br>如果空间被锁定，在空间后台登录一次即可解锁，如果用户超过六个月没有解锁，系统将清除此空间。';
}

require_once template_echo('user_index',$user_tpl_dir);
}elseif($act =='sj'){
$q=$db->query("select * from {$tpf}groups where gid<>1 and gid<>4 order by jb asc");
$result=array();
$i=0;
while($rs = $db->fetch_array($q)){
	$result[$i]=$rs;
	$i++;
}
require_once template_echo('user_sj',$user_tpl_dir);
}
elseif($act=='sjs'){
$kjstatus = gpc('kjstatus','P','');
$s=explode("-",$kjstatus);

$s_gid=intval($s[0]);
$s_s=intval($s[1]);
$diskstatus= @$db->fetch_one_array("select * from {$tpf}groups where gid=".$s_gid);
if($s_s==1){
	$s_s=$diskstatus['jg_yy'];
	$ts=30*24*60*60;
}elseif($s_s==2){
	$s_s=$diskstatus['jg_bn'];
	$ts=181*24*60*60;
}
elseif($s_s==3){
	$s_s=$diskstatus['jg_yn'];
	$ts=365*24*60*60;
}
elseif($s_s==4){
	$s_s=$diskstatus['jg_ln'];
	$ts=730*24*60*60;
}

$tss=time()+$ts;

if($userinfo['gid']==1){
	echo '<script type="text/javascript">alert("系统管理员不可升级");window.location.href="/user.php"</script>';
	exit;
}

if($userinfo['wealth']<$s_s){
	echo '<script type="text/javascript">alert("账户余额不足，请充值");window.location.href="/zh.php"</script>';
	exit;
}

/*if($diskinfo['jb']>$diskstatus['jb']){
	echo '<script type="text/javascript">alert("出错：当前空间类型级别高于需升级的空间类型级别，不可升级。");window.location.href="/user.php?act=sj"</script>';
	exit;
}
*/$sql = "update {$tpf}users set wealth=`wealth`-$s_s,gid=$s_gid,dqsj=$tss where userid='$pd_uid'";

$db->query_unbuffered($sql);


$ins = array(
'je' => $s_s,
'xfname' => $diskstatus['group_name'],
'userid' => $pd_uid,
'intime'=>time(),
'outtime'=>$tss,
);
@$db->query_unbuffered("insert into {$tpf}xiaofei set ".$db->sql_array($ins).";");



echo '<script type="text/javascript">alert("升级成功!");window.location.href="/user.php"</script>';
exit;

}
else{
	redirect("user.php?act=index",'',0);
}

include PHPDISK_ROOT."./includes/footer.inc.php";

?>



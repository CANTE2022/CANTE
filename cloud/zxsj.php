<?php

if( $_SERVER['HTTP_REFERER'] == "" ){
header("");
echo '<script type="text/javascript">window.location.href="/"</script>'; 
exit('´íÎó');}

include "includes/commons.inc.php";
//echo "aaa";

$intime=time();
$name = trim(gpc('dlmc','G',''));
$userinfo= @$db->fetch_one_array("select * from {$tpf}users where username='$name'");

$intime=time();
$rs = $db->fetch_one_array("select * from {$tpf}oline where userid='".$userinfo['userid']."' and ip='$onlineip' limit 1");
if(!$rs){
$sql = "insert into {$tpf}oline(userid,ip,intime) values('".$userinfo['userid']."','".$onlineip."','".time()."')";
$db->query_unbuffered($sql);
}else{
$sql = "update {$tpf}oline set intime='".time()."' where ip='".$onlineip."' and userid='".$userinfo['userid']."'";
$db->query_unbuffered($sql);
}
$sql_now = "select count(*) from {$tpf}oline where `intime` > '".(time()-120)."'";
$now = $db->result_first($sql_now);

/*$userinfo= @$db->fetch_one_array("select * from {$tpf}users where username='$name'");*/
$sql_day = "select count(*) from {$tpf}oline where  `intime` > '".strtotime(date("Y-m-d"))."'"; 
$day= $db->result_first($sql_day);
echo "~$now~$day~~~~0~~";
?>



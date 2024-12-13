<?php

if( $_SERVER['HTTP_REFERER'] == "" ){
header("");
echo '<script type="text/javascript">window.location.href="/"</script>'; 
exit('´íÎó');}

include "includes/commons.inc.php";

$chunk = is_numeric($settings['down_chunk']) ? (int)$settings['down_chunk'] : 16384;
@set_time_limit(0);
@ignore_user_abort(true);
@set_magic_quotes_runtime(0);
$file_id = (int)gpc('id','G',0);
$userid = (int)gpc('userid','G',0);


$rs = $db->fetch_one_array("select * from {$tpf}files where file_id='$file_id'");
$file_real_name = $rs['file_real_name'].'.'.$rs['file_extension'];


$ins = array(
'dx' => get_size($rs['file_size']),
'wenjian' => $rs['file_name'].'.'.$rs['file_extension'],
'userid' => $userid,
'ip' => $onlineip,
'downtime'=>time(),
);
$db->query_unbuffered("insert into {$tpf}download set ".$db->sql_array($ins).";");


$file_location2=$settings['file_path']."/".$file_real_name;
echo '<script>document.location="'.$file_location2.'";</script>';
?>


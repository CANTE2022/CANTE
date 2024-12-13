<?php

if( $_SERVER['HTTP_REFERER'] == "" ){
header("");
echo '<script type="text/javascript">window.location.href="/"</script>'; 
exit('错误');}

include "includes/commons.inc.php";
$name = trim(gpc('name','G',''));
$login = $_SESSION[$name."diskname"];
if($login != '1'){
	if(isset($_COOKIE['oldtime'])){ // 如果存在cookie
		$oldtime = $_COOKIE['oldtime'];
		$count = mysql_num_rows(mysql_query("select `in_time` from {$tpf}folders where `in_time` > " . $oldtime));
		if($count > 0){
			$rs = $db->fetch_one_array("select `in_time` from {$tpf}folders where (`in_time` > " . $oldtime . ") order by `in_time` desc");
			$lastpath = $rs['in_time'];
			echo '<p>' . date("H:i", $lastpath) . ' <font style="color:#ff0000;">新增目录</font></p>';
		}
		$count = mysql_num_rows(mysql_query("select `in_time` from {$tpf}comments where `in_time` > " . $oldtime));
		if($count > 0){
			$rs = $db->fetch_one_array("select `in_time` from {$tpf}comments where (`in_time` > " . $oldtime . ") order by `in_time` desc");
			$lastword = $rs['in_time'];
			echo '<p>' . date("H:i", $lastword) . ' <font style="color:#ff0000;">新增留言</font></p>';
		}
	}
	setcookie("oldtime", time());
}
?>
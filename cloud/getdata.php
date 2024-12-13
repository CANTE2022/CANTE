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
		$oldcount = $_COOKIE['oldcount'];
		$result = mysql_query("select COUNT(*) from {$tpf}newdata where `mytime` > " . $oldtime);
		list($newcount) = mysql_fetch_row($result);
		if($newcount != $oldcount){
			$result = mysql_query("select `mytime`, `action` from {$tpf}newdata where `mytime` > " . $oldtime . " order by `id` desc");
			while($row = mysql_fetch_array($result)){
				echo '<p>' . date("H:i", $row['mytime']) . ' ' . $row['action'] . '</p>';
			}
			setcookie('oldcount', $newcount);
		}
	}
	setcookie('oldtime', time());
}
?>
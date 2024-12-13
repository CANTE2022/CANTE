<?php

if( $_SERVER['HTTP_REFERER'] == "" ){
header("");
echo '<script type="text/javascript">window.location.href="/"</script>'; 
exit('´íÎó');}

include "includes/commons.inc.php";
$result = mysql_query("select COUNT(*) from {$tpf}newdata where `mytime` > 0");
list($newcount) = mysql_fetch_row($result);

$result = mysql_query("select `mytime`, `action` from {$tpf}newdata where `mytime` > 0");
while ($row = mysql_fetch_array($result)) {
	echo $row['mytime'] . ' ' . $row['action'] . '<br/>';
}
?>
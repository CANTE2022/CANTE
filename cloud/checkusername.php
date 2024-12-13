<?php

if( $_SERVER['HTTP_REFERER'] == "" ){
header("");
echo '<script type="text/javascript">window.location.href="/"</script>'; 
exit('错误');}

include "includes/commons.inc.php";
$username = gpc('dlmc','G','',1);


$rs = $db->fetch_one_array("select username from {$tpf}users where username='$username' limit 1");

if($rs){
	if(strcasecmp($username,$rs['username']) ==0){
		$str="<img src='images/reg_f.gif' /><font color='red'>此用户名已存在</font>";
	}else{
		$str="<img src='images/reg_t.gif' /><font color='green'>此用户名可用</font>";
	}
}else{
	$str="<img src='images/reg_t.gif' /><font color='green'>此用户名可用</font>";
}
unset($rs);
echo $str;
?>


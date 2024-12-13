<?php

if( $_SERVER['HTTP_REFERER'] == "" ){
header("");
echo '<script type="text/javascript">window.location.href="/"</script>'; 
exit('错误');}

include "includes/commons.inc.php";

phpdisk_core::user_login();
$in_front = true;
define('IN_MYDISK' ,true);
$title = '空间管理 '.$settings['site_title'];
$diskurl =$settings['phpdisk_url'];
include PHPDISK_ROOT.'includes/header.inc.php';

$userinfo= @$db->fetch_one_array("select * from {$tpf}users where userid='$pd_uid'");
$diskinfo= @$db->fetch_one_array("select * from {$tpf}groups where gid=".$userinfo['gid']);


$q=$db->query("select * from {$tpf}folders where password<>'' order by folder_id asc");
$result='';
$i=1;
while($rs = $db->fetch_array($q)){
	$result.='<tr class="tr'.$i.'"><td>'.$rs['folder_name'].'</td><td>'.$rs['folder_description'].'</td><td><font color="blue">'.$rs['password'].'</font></td></tr>';
	if($i==1){
		$i=0;
	}else{
		$i=1;
	}
}



require_once template_echo('mmcx',$user_tpl_dir);

include PHPDISK_ROOT."./includes/footer.inc.php";

?>



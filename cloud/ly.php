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
$act = trim(gpc('act','P',''));

$userinfo= @$db->fetch_one_array("select * from {$tpf}users where userid='$pd_uid'");
$diskinfo= @$db->fetch_one_array("select * from {$tpf}groups where gid=".$userinfo['gid']);

if($act=="dele"){
	$ids=implode(",",$_POST['name']);
	$sql = "delete from {$tpf}comments where cmt_id in(".$ids.")";
	$db->query_unbuffered($sql);

}

$q=$db->query("select * from {$tpf}comments where userid='$pd_uid' order by cmt_id desc");
$result='';
$i=0;

while($rs = $db->fetch_array($q)){
	//$result.='<tr class="tr'.$i.'"><td>'.$rs['folder_name'].'</td><td>'.$rs['folder_description'].'</td><td><font color="blue">'.$rs['password'].'</font></td></tr>';
	$result.='<tr class="tr'.$i.'"><td width="40" align="center"><input type="checkbox" title="选中/不选" name="name[]" value="'.$rs['cmt_id'].'"></td><td>'.$rs['file_key'].'</td><td style="word-break:break-all;">'.$rs['content'].'</td><td>'.date("Y-m-d H:i:s",$rs['in_time']).'<br>ip:'.$rs['ip'].'</td>';
	if($i==1){
		$i=0;
	}else{
		$i=1;
	}
}



require_once template_echo('ly',$user_tpl_dir);

include PHPDISK_ROOT."./includes/footer.inc.php";

?>



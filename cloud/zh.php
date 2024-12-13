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
$act = trim(gpc('act','G',''));

$userinfo= @$db->fetch_one_array("select * from {$tpf}users where userid='$pd_uid'");
$diskinfo= @$db->fetch_one_array("select * from {$tpf}groups where gid=".$userinfo['gid']);

//print_r($diskinfo);
if($act =='index'){
require_once template_echo('zh_index',$user_tpl_dir);


}elseif($act =='zfb'){
require_once template_echo('zh_zfb',$user_tpl_dir);
}
elseif($act=='cz'){
	
$q=$db->query("select * from {$tpf}orders where userid='$pd_uid' order by order_id desc");
$result='';
while($rs = $db->fetch_array($q)){
	//$result.='<tr class="tr'.$i.'"><td width="40" align="center"><input type="checkbox" title="选中/不选" name="name[]" value="'.$rs['cmt_id'].'"></td><td>'.$rs['file_key'].'</td><td style="word-break:break-all;">'.$rs['content'].'</td><td>'.date("Y-m-d H:i:s",$rs['in_time']).'<br>ip:'.$rs['ip'].'</td>';
	if($rs['pay_status']=='success'){
		$s='支付成功';
		$b='#fffff';
	}else{
		$s='支付失败';
		$b='#F3895A';
	}
	$result.='<tr bgcolor="'.$b.'"><td>'.date("Y-m-d H:i:s",$rs['in_time']).'</td><td>'.$rs['total_fee'].'元</td><td>'.$rs['pay_method'].'</td><td>'.$s.'</td></tr>';
}

	
require_once template_echo('zh_cz',$user_tpl_dir);
}
elseif($act=='xf'){
	
$q=$db->query("select * from {$tpf}xiaofei where userid='$pd_uid' order by id desc");
$result='';
while($rs = $db->fetch_array($q)){
	//$result.='<tr class="tr'.$i.'"><td width="40" align="center"><input type="checkbox" title="选中/不选" name="name[]" value="'.$rs['cmt_id'].'"></td><td>'.$rs['file_key'].'</td><td style="word-break:break-all;">'.$rs['content'].'</td><td>'.date("Y-m-d H:i:s",$rs['in_time']).'<br>ip:'.$rs['ip'].'</td>';
	if($i==1){
		$b='#fffff';
		$i=0;
	}else{
		$i=1;
		$b='#ECECEC';
	}
	$result.='<tr bgcolor="'.$b.'"><td>'.$rs['id'].'</td><td>'.date("Y-m-d H:i:s",$rs['intime']).'</td><td>'.$rs['je'].'</td><td>'.$rs['xfname'].'</td><td>'.date("Y-m-d",$rs['outtime']).'</td></tr>';
}

	
require_once template_echo('zh_xf',$user_tpl_dir);
}


else{
	redirect("zh.php?act=index",'',0);
}

include PHPDISK_ROOT."./includes/footer.inc.php";

?>



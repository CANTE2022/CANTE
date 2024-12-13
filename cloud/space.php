<?php

if( $_SERVER['HTTP_REFERER'] == "" ){
header("");
echo '<script type="text/javascript">window.location.href="/"</script>'; 
exit('´íÎó');}

include "includes/commons.inc.php";

$in_front = true;

$username = trim(gpc('username','G',''));
$rs = $db->fetch_one_array("select username,userid from {$tpf}users where username='$username'");
$title = $rs['username'].' '.__('space_title').' - '.$settings['site_title'];
$space_title = $rs['username'].' '.__('space_title');
$userid = $rs['userid'];
if(!$userid){
	aheader('./');
}
include PHPDISK_ROOT."./includes/header.inc.php";

function show_file(){
	global $db,$tpf,$userid;
	$sql_do = "{$tpf}files where userid='$userid' and in_share=1 and in_recycle=0";
	$q = $db->query("select file_id,file_key,file_name,file_extension,file_size,file_time,server_oid,file_store_path,file_real_name,is_image,store_old from {$sql_do} order by file_id desc limit 20");
	$files_array = array();
	while($rs = $db->fetch_array($q)){
		$tmp_ext = $rs['file_extension'] ? '.'.$rs['file_extension'] : "";
		$rs['file_thumb'] = get_file_thumb($rs);
		$rs['file_name_all'] = $rs['file_name'].$tmp_ext;
		$rs['file_name'] = cutstr($rs['file_name'].$tmp_ext,25);
		$rs['file_size'] = get_size($rs['file_size']);
		$rs['file_time'] = custom_time("Y-m-d",$rs['file_time']);
		$rs['a_viewfile'] = urr("viewfile","file_id={$rs['file_id']}");
		$files_array[] = $rs;
	}
	$db->free($q);
	unset($rs);
	return $files_array;
}
$files_array = show_file();
//$hot_file = get_hot_file();

require_once template_echo('pd_space',$user_tpl_dir);

include PHPDISK_ROOT."./includes/footer.inc.php";
?>

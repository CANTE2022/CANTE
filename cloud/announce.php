<?php

if( $_SERVER['HTTP_REFERER'] == "" ){
header("");
echo '<script type="text/javascript">window.location.href="/"</script>'; 
exit('´íÎó');}

include "includes/commons.inc.php";

$inner_box = true;
$aid = (int)gpc('aid','G',0);
include PHPDISK_ROOT.'includes/header.inc.php';

$arr = super_cache::get('get_announce|'.$aid,'announce',1,0);
$content = $arr[0];

require_once template_echo('pd_announce',$user_tpl_dir);

include PHPDISK_ROOT.'includes/footer.inc.php';

function get_announce($aid){
	global $db,$tpf;
	if(!$aid){
		die("$aid Error!");
	}else{
		$content = $db->result_first("select content from {$tpf}announces where annid='$aid'");
	}
	return array($content);
}

?>
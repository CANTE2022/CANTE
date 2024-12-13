<?php

if( $_SERVER['HTTP_REFERER'] == "" ){
header("");
echo '<script type="text/javascript">window.location.href="/"</script>'; 
exit('错误');}

include "includes/commons.inc.php";

$in_front = true;
$title = '产品列表 '.$settings['site_title'];
include PHPDISK_ROOT.'includes/header.inc.php';
require_once template_echo('pd_cp',$user_tpl_dir);

include PHPDISK_ROOT."./includes/footer.inc.php";


?>


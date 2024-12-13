<?php

if( $_SERVER['HTTP_REFERER'] == "" ){
header("");
echo '<script type="text/javascript">window.location.href="/"</script>'; 
exit('错误');}

include "includes/commons.inc.php";

$in_front = true;
$title = '设置空间自定义区 '.$settings['site_title'];
$khlb = htmlspecialchars_decode($settings['khlb']);
$contact1 = htmlspecialchars_decode($settings['contact1']);

include PHPDISK_ROOT.'includes/header.inc.php';
require_once template_echo('pd_div',$user_tpl_dir);

include PHPDISK_ROOT."./includes/footer.inc.php";


?>


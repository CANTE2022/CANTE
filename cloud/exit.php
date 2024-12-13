<?php

if( $_SERVER['HTTP_REFERER'] == "" ){
header("");
echo '<script type="text/javascript">window.location.href="/"</script>'; 
exit('´íÎó');}

include "includes/commons.inc.php";

define('IN_MYDISK' ,true);
$dlmc = trim(gpc('dlmc','G',''));
unset($_SESSION[$dlmc."diskname"]);
unset($_SESSION['diskstatus']);
require_once template_echo('center_exit',$user_tpl_dir);

?>



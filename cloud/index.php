<?php

include "includes/commons.inc.php";

$in_front = true;
$title = $settings['site_title'];
include PHPDISK_ROOT.'includes/header.inc.php';
require_once template_echo('pd_index',$user_tpl_dir);

include PHPDISK_ROOT."includes/footer.inc.php";

?>
<?php
#	$Id: my_nav_bar.inc.php 9 2012-02-04 02:17:20Z along $
#

if(!defined('IN_PHPDISK') || !defined('IN_MYDISK')) {
	exit('[PHPDisk] Access Denied');
}
require_once template_echo('my_nav_bar',$user_tpl_dir);

?>

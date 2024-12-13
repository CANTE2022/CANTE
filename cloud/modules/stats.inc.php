<?php
#	$Id: stats.inc.php 31 2012-04-04 02:55:38Z along $
#

if(!defined('IN_PHPDISK') || !defined('IN_MYDISK')) {
	exit('[PHPDisk] Access Denied');
}

if(!display_plugin('filelog','open_filelog_plugin',$settings['open_filelog'],0)){
	exit('ERROR: filelog'.__('plugin_not_install'));
}

switch($action){
	default:
		$log_arr = glob(PHPDISK_ROOT."system/cache/$pd_uid/".date("Ymd")."_*.log");
		if(count($log_arr)){
			foreach($log_arr as $fn){
				$content = file_exists($fn) ? read_file($fn) : 'Open file error!';
			}
		}
		
		require_once template_echo('stats',$user_tpl_dir);
}
?>
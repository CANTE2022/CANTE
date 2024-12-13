<?php
#	$Id: core.class.php 32 2012-04-05 09:28:38Z along $
#
!defined('IN_PHPDISK') && exit('[PHPDisk] Access Denied');

class phpdisk_core{
	function init_core(){
		phpdisk_core::__init_env();
	}
	function init_db_connect(){
		global $configs;
		$dbc = new cls_mysql();
		$dbc->connect($configs['dbhost'],$configs['dbuser'],$configs['dbpasswd'],$configs['dbname'],$configs['pconnect']);
		unset($configs['dbhost'],$configs['dbuser'],$configs['dbpasswd'],$configs['pconnect']);
		return $dbc;
	}
	function __init_env(){
		$env_arr = array('system/','system/cache/','system/plugins/','system/templates/','system/global/');
		for ($i=0;$i<count($env_arr);$i++){
			make_dir(PHPDISK_ROOT.$env_arr[$i]);
		}
	}
	function gzcompress_open(){
		global $C;
		if ($C['gz']['open'] && function_exists('ob_gzhandler')) {
			ob_start('ob_gzhandler');
			$C['gz']['status'] = 'Enabled';
		} else {
			ob_start();
			$C['gz']['status'] = 'Disabled';
		}
	}
	function init_lang_tpl(){
		$file = PHPDISK_ROOT.'system/global/lang_settings.inc.php';
		file_exists($file) ? require_once $file : lang_cache();
		$file = PHPDISK_ROOT.'system/global/tpl_settings.inc.php';
		file_exists($file) ? require_once $file : tpl_cache();
		
		foreach($tpl_settings as $v){
			if($v[actived] && $v[tpl_type]=='user'){
				$user_tpl_dir = $v[tpl_name];
			}
			if($v[actived] && $v[tpl_type]=='admin'){
				$admin_tpl_dir = $v[tpl_name];
			}			
		}
		foreach($lang_settings as $v){
			if($v[actived]){
				$lang_name = $v[lang_name];
			}
		}
		$user_tpl_dir = $user_tpl_dir ? "templates/$user_tpl_dir/" : 'templates/default/';
		$admin_tpl_dir = $admin_tpl_dir ? "templates/$admin_tpl_dir/" : 'templates/admin/';
		$lang_name = $lang_name ? $lang_name : 'zh-cn';		
		return array('user_tpl_dir'=>$user_tpl_dir,'admin_tpl_dir'=>$admin_tpl_dir,'lang_name'=>$lang_name);
	}
	function user_login(){
		global $pd_uid,$pd_pwd;
		if(!$pd_uid || !$pd_pwd){
			header("Location: ".urr("account","action=login&ref=".$_SERVER['REQUEST_URI']));
		}
	}
	function admin_login(){
		global $C,$db,$tpf,$pd_uid,$pd_pwd,$pd_gid;
		$admin_not_login =0;
		$rs = $db->fetch_one_array("select * from {$tpf}adminsession where userid='$pd_uid' limit 1");
		if(!$_SESSION['pd_sid'] || $rs['hashcode'] != $_SESSION['pd_sid']){
			$admin_not_login =1;
		}
		unset($rs);
		if(!$pd_uid || !$pd_pwd || $pd_gid !=1 || $admin_not_login){
			aheader(urr("account","action=adminlogin&ref=".$_SERVER['REQUEST_URI']));
		}
	}

}

?>
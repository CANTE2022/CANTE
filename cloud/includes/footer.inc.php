<?php

!defined('IN_PHPDISK') && exit('[PHPDisk] Access Denied');

$site_index = '<a href="./">'.__('site_index').'</a>';
$contact_us = $settings['contact_us'] ? '&nbsp;<a href="mailto:'.$settings['contact_us'].'">'.__('contact_us_txt').'</a>' : '';
$miibeian = $settings['miibeian'] ? '&nbsp;<a href="http://www.miibeian.gov.cn/" target="_blank">'.$settings['miibeian'].'</a>' : '';
$site_stat = $settings['site_stat'] ? '&nbsp;'.stripslashes(base64_decode($settings['site_stat'])) : '';
$pageinfo = page_end_time();	
$C[navi_bottom_link] = super_cache::get('get_navigation_link|bottom','navigation',1,0);
if($in_front){
	require_once template_echo('pd_footer',$user_tpl_dir);
}
if($q){
	$db->free($q);
}
$db->close();
unset($C,$tpf,$configs,$rs,$_SESSION);
ob_end_flush();

?>
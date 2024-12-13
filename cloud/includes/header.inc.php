<?php

if(!defined('IN_PHPDISK')) {
	exit('[PHPDisk] Access Denied');
}
$footer=htmlspecialchars_decode($settings['footer']);
$a_index_share = urr("space","username=".rawurlencode($pd_username));
$C[navi_top_link] = super_cache::get('get_navigation_link|top','navigation',1,0);

require_once template_echo('pd_header',$user_tpl_dir);

?>
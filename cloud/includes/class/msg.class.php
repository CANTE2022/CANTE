<?php
#	$Id: logger.class.php 16 2012-02-10 09:02:39Z along $
#
!defined('IN_PHPDISK') && exit('[PHPDisk] Access Denied');

class msg {

	function msg() {

	}
	function fmsg($str,$param){
		return sprintf($str,$param);
	}
}
?>
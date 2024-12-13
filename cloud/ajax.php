<?php

if( $_SERVER['HTTP_REFERER'] == "" ){
header("");
echo '<script type="text/javascript">window.location.href="/"</script>'; 
exit('´íÎó');}

include "includes/commons.inc.php";

switch($action){
	case 'digg':
		$file_id = (int)gpc('file_id','G',0);
		$dig_type = (int)gpc('dig_type','G',0);
		$digg_cookie = gpc("phpdisk_digg_{$file_id}",'C','');
		if(!$digg_cookie){
			$rs = $db->fetch_one_array("select good_count,bad_count,userid from {$tpf}files where file_id='$file_id' limit 1");
			if($rs){
				$good_count = (int)$rs['good_count']+1;
				$bad_count = (int)$rs['bad_count']+1;
				$userid = (int)$rs['userid'];
			}
			unset($rs);
			if($dig_type ==1){
				$db->query_unbuffered("update {$tpf}files set good_count=good_count+1 where file_id='$file_id'");
			}elseif($dig_type ==2){
				$db->query_unbuffered("update {$tpf}files set bad_count=bad_count+1 where file_id='$file_id'");
			}
			pd_setcookie("phpdisk_digg_{$file_id}", $file_id, $timestamp+3600);
			echo "var re=new Array();re[0]=".$file_id.";re[1]=".$dig_type.";re[2]=\"success\";re[3]=\"".__('vote_success')."\";";
		}else{
			echo "var re=new Array();re[0]=".$file_id.";re[1]=".$dig_type.";re[2]=\"fail\";re[3]=\"".__('cannot_same_vote')."\";";
		}
		break;
	case 'down_process':
		$temp_ip = base64_decode(gpc('down_ip','C',''));
		$file_id = (int)gpc('file_id','G',0);
		$userid = $db->result_first("select userid from {$tpf}files where file_id='$file_id'");
		$exp_down = (int)$settings['exp_down'];
		$db->query_unbuffered("update {$tpf}users set exp=exp+$exp_down where userid='$pd_uid'");

		$exp_down_my = (int)$settings['exp_down_my'];
		$db->query_unbuffered("update {$tpf}users set exp=exp+$exp_down_my where userid='$userid'");

		if($settings['credit_open'] && $pd_uid!=$userid){
			$credit = $settings['credit_open'] ? (int)$settings['credit_down'] : 0;
			$credit_my = $settings['credit_open'] ? (int)$settings['credit_down_my'] : 0;
			$pd_credit = (int)$db->result_first("select credit from {$tpf}users where userid='$pd_uid' limit 1");
			if($pd_credit && $pd_credit>=$credit){				
				$db->query_unbuffered("update {$tpf}users set credit=credit-{$credit} where userid='$pd_uid'");
			}
			$db->query_unbuffered("update {$tpf}users set credit=credit+{$credit_my} where userid='$userid'");
			unset($rs);
		}

		if(display_plugin('filelog','open_filelog_plugin',($settings['open_filelog'] && $settings['open_down_filelog']),0)){
			$username = @$db->result_first("select username from {$tpf}users where userid='$userid' limit 1");
			$down_username = @$db->result_first("select username from {$tpf}users where userid='$pd_uid' limit 1");
			$down_username = $down_username ? $down_username : '-';
			$log_format = $file_name.'|'.get_size($file_size).'|'.__('download').'|'.$username.'|'.$down_username.'|'.date("Y-m-d H:i:s").'|'.$onlineip;
			all_file_logs($log_format);
			my_file_down_logs($log_format,$userid);
		}
		if($temp_ip!=get_ip()){
			pd_setcookie('down_ip',base64_encode(get_ip()),86400);
			$db->query_unbuffered("update {$tpf}files set file_downs=file_downs+1,file_last_view='$timestamp' where file_id='$file_id'");
		}
		echo 'true';
		break;
}

include PHPDISK_ROOT."./includes/footer.inc.php";

?>
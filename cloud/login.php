<?php

if( $_SERVER['HTTP_REFERER'] == "" ){
header("");
echo '<script type="text/javascript">window.location.href="/"</script>'; 
exit('错误');}

include "includes/commons.inc.php";

$in_front = true;
$title = '用户登录 '.$settings['site_title'];
include PHPDISK_ROOT.'includes/header.inc.php';
$title = __('account_login');
if($task =='login'){
	form_auth(gpc('formhash','P',''),formhash());

	$username = $username_pd = gpc('username','P','',1);
	$password = $password_pd = gpc('password','P','',1);
	$md5_pwd = md5($password);
	$remember = (int)gpc('remember','P',0);
	$verycode = trim(gpc('verycode','P','',1));
	$ref = trim(gpc('ref','P',''));

	if(checklength($username,2,60)){
		$error = true;
		$sysmsg[] = __('invalid_username');
	}
	if(checklength($password,6,20)){
		$error = true;
		$sysmsg[] = __('invalid_password');
	}
		if (!$verycode || strtolower($verycode) != strtolower($_SESSION['_verycode'])) {
			unset($_SESSION['_verycode']);
			$error = true;
			$sysmsg[] = __('invalid_verycode');
		}

	if(display_plugin('api','open_uc_plugin',$settings['connect_uc'],0)){
		if($settings['connect_uc_type']=='phpwind'){
			$user_login = uc_user_login($username,$md5_pwd,0);
			$ucsynlogin = $user_login['synlogin'];
		}else{
			list($uid, $username, $password, $email) = uc_user_login($username, $password);
			if($uid > 0){
				$ucsynlogin = uc_user_synlogin($uid);
				if(trim($username)){
					$rs = $db->fetch_one_array("select username from {$tpf}users where username='$username' limit 1");
					if(!$rs){
						$gid = 4;
						$ins = array(
						'username' => $username,
						'password' => $md5_pwd,
						'email' => $email,
						'gid' => $gid,
						'reg_time' => $timestamp,
						'reg_ip' => $onlineip,
						);
						$db->query("insert into {$tpf}users set ".$db->sql_array($ins).";");
						$userid = $db->insert_id();
					}
					unset($rs);
				}
				if(!$db->result_first("select count(*) from {$tpf}users where username='$username' and password='$md5_pwd' limit 1")){
					$db->query_unbuffered("update {$tpf}users set password='$md5_pwd',email='".$db->escape($email)."' where username='$username' limit 1");
				}
			}elseif($uid ==-1){
				$email = $db->result_first("select email from {$tpf}users where username='$username_pd' limit 1");
				if($email){
					$uid = uc_user_register($username_pd , $password_pd , $email);
					if($uid<=0){
						$error = true;
						$sysmsg[] = 'UC:'.__('invalid_username');
					}
				}else{
					$error = true;
					$sysmsg[] = 'UC:'.__('user_already_delete');
				}
			}elseif($uid ==-2){
				$error = true;
				$sysmsg[] = __('password_is_error');
			}
		}
	}
	$rs = $db->fetch_one_array("select userid,gid,username,password,email,is_locked from {$tpf}users where username='$username' limit 1");
	if(!$rs){
		$error = true;
		$sysmsg[] = __('user_not_exists');
	}else{
		
		if($md5_pwd != $rs['password']){
			$error = true;
			$sysmsg[] = __('user_password_false');
		}elseif($rs['is_locked']){
			$error = true;
			$sysmsg[] = __('user_is_locked');
		}else{
			$userid = (int)$rs['userid'];
			$gid = (int)$rs['gid'];
			$username = trim($rs['username']);
			$password = trim($rs['password']);
			$email = trim($rs['email']);
		}
	}
	if(!$settings['allow_access'] && $gid !=1){
		$error = true;
		$sysmsg[] = __('admin_not_valid');
	}
	if(!$error){

		$credit = $settings['credit_open'] ? (int)$settings['credit_login'] : 0;
		$sql_do = $credit ? ", credit=credit+{$credit}" : "";
		$exp_login = (int)$settings['exp_login'];
		$db->query_unbuffered("update {$tpf}users set last_login_ip='$onlineip',last_login_time='$timestamp',exp=exp+$exp_login {$sql_do} where userid='$userid'");
		if($settings['create_default_folder']){
			$num = $db->result_first("select count(*) from {$tpf}folders where userid='$userid'");
			if(!$num){
				$ins = array(
				'folder_node' => 1,
				'folder_name' => $db->escape(trim($settings['create_default_folder'])),
				'userid' => $userid,
				'in_time' => $timestamp,
				);
				$db->query_unbuffered("insert into {$tpf}folders set ".$db->sql_array($ins).";");
			}
		}
		if($remember){
			pd_setcookie('phpdisk_info',pd_encode("$userid\t$gid\t$username\t$password\t$email"),86400*30);
		}else{
			pd_setcookie('phpdisk_info',pd_encode("$userid\t$gid\t$username\t$password\t$email"));
		}
		if(display_plugin('api','open_uc_plugin',$settings['connect_uc'],0)){
			echo $ucsynlogin;
		}
		$login_success = 1;
		$sysmsg[] = __('login_success');
		//redirect(urr("mydisk",""),$sysmsg,3000,'top');
		header("Location:/user.php");
	}
}else{
	if(!$settings['allow_access']){
		$sysmsg[] = __('close_access');
	}
	$user_title = __('user_login');
	$ref = trim(gpc('ref','G',''));
	$ref = $ref ? $ref : $_SERVER['HTTP_REFERER'];
	if($pd_uid && $action=='login'){
		header("Location: /");
	}
}
require_once template_echo('pd_login',$user_tpl_dir);

include PHPDISK_ROOT."./includes/footer.inc.php";


?>


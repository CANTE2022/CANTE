<?php

if( $_SERVER['HTTP_REFERER'] == "" ){
header("");
echo '<script type="text/javascript">window.location.href="/"</script>'; 
exit('错误');}

include "includes/commons.inc.php";
include 'Upload.class.php';
@set_time_limit(0);

$fl = trim(gpc('fl','G',''));
$name = trim(gpc('name','G',''));
$folder_id = intval(gpc('folder_id','G','0'));


/*$name="admin";
$folder_id=1;
*/$userinfo= @$db->fetch_one_array("select * from {$tpf}users where username='$name'");
if(empty($userinfo)){
	exit;
}

$diskinfo= @$db->fetch_one_array("select * from {$tpf}groups where gid=".$userinfo['gid']);
$folderinfo= @$db->fetch_one_array("select * from {$tpf}folders where folder_id=".$folder_id);

if(empty($folderinfo)){
	exit;
}
//010010
if(substr($folderinfo['fileorder'],1,1)=="1"||substr($folderinfo['fileorder'],4,1)=="1"){
}else{
	exit;
}
$file_path =$settings['file_path'];

$file_size_total = $db->result_first("select sum(file_size) from {$tpf}files where userid='".$userinfo['userid']."'");
$now_space=intval($diskinfo['max_storage'])-get_size1($file_size_total);
if($now_space<=0){
	exit;
}


if($diskinfo['group_file_types']){
	$user_file_types = explode(',',trim($diskinfo['group_file_types']));
}else{
	if($userinfo['user_file_types']){
		$user_file_types = explode(',',trim($userinfo['user_file_types']));
	}else{
		$user_file_types = '';
	}
}
$insert=$folder_id;
if(!empty($fl)&$fl!='undefined'){
	
	
$folinfo= @$db->fetch_one_array("select * from {$tpf}folders where parent_id=".$folder_id." and folder_name='".$fl."'");
if(empty($folinfo)){
	$ins = array(
	'parent_id'=>$folder_id,
	'folder_node'=>1,
	'folder_name' => $fl,
	'folder_description' => $fl,
	'userid' => $userinfo['userid'],
	'in_time'=>time(),
	);
	@$db->query_unbuffered("insert into {$tpf}folders set ".$db->sql_array($ins).";");
	$insert=@$db->insert_id();
}else{
	$insert=$folinfo['folder_id'];
}
}

if(intval($insert)==0){
$insert=$folder_id;
}
$upload = new Upload();// 实例化上传类
$upload->maxSize  = '123456789123456789' ;// 设置附件上传大小
$upload->allowExts  = $user_file_types; // 设置附件上传类型
$upload->savePath =  './'.$file_path.'/';// 设置附件上传目录
$upload->saveRule='uniqid';
if($upload->upload()){// 上传成功 获取上传文件信息
$info =  $upload->getUploadFileInfo();
if(@in_array($info[0]['extension'],array('jpg','jpeg','png','gif','bmp'))){
	$is_image = 1;
}else{
	$is_image = 0;
}
$filename=explode(".",$info[0]['name']);
$file_real_name=explode(".",$info[0]['savename']);
$thumb_size = 0;
$file_extension=$filename[1];
$ins = array(
'file_name' => $filename[0],
'file_key' => $file_key ? $file_key : '',
'file_extension' => $file_extension,
'is_image' => $is_image,
'file_mime' => 'application/octet-stream',
'file_description' => $file_description ? $file_description : '',
'file_store_path' => $file_store_path ? $file_store_path : '',
'file_real_name' => $file_real_name[0],
'file_md5' => $file_md5 ? $file_md5 : '',
'server_oid' => (int)$server_oid,
'file_size' => $info[0]['size'],
'thumb_size' => $thumb_size,
'file_time' => $timestamp,
'is_checked' => 1,
'in_share' => 0,
'is_public' => 0,
'report_status' => 0,
'userid' => $userinfo['userid'],
'folder_id' => $insert,
'cate_id' => 0,
'subcate_id' => 0,
'ip' => $onlineip,
);
$db->query_unbuffered("insert into {$tpf}files set ".$db->sql_array($ins).";");

	$newdata = array(
		'action' => '<font color="#ff0000">新增数据</font>，位于：<a href="javascript:void(0);" onclick="kq(' . $folder_id . ');" class="ml">' . $folderinfo['folder_name'] . '</a>',
		'mytime' => time()
	);
	$db->query_unbuffered("insert into {$tpf}newdata set ".$db->sql_array($newdata).";");

}
?>



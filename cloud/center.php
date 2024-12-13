<?php

if( $_SERVER['HTTP_REFERER'] == "" ){
header("");
echo '<script type="text/javascript">window.location.href="/"</script>'; 
exit('错误');}

include "includes/commons.inc.php";

$in_front = true;
define('IN_MYDISK' ,true);
$diskurl =$settings['phpdisk_url'];
$act = trim(gpc('Yz0','P',''));
$name = trim(gpc('name','G',''));

$userinfo= @$db->fetch_one_array("select * from {$tpf}users where username='$name'");
if(empty($userinfo)){
	echo '<script type="text/javascript">alert("您访问的Ｅ盘空间不存在或者尚未注册!");window.location.href="/index.php"</script>';
	exit;
}
$diskinfo= @$db->fetch_one_array("select * from {$tpf}groups where gid=".$userinfo['gid']);

$file_size_total = $db->result_first("select sum(file_size) from {$tpf}files where userid='".$userinfo['userid']."'");
$now_space=intval($diskinfo['max_storage'])-get_size1($file_size_total);


$Yz1 = trim(gpc('Yz1','P',''));
$Yz2 = trim(gpc('Yz2','P',''));
$Yz3 = trim(gpc('Yz3','P',''));
$Yz4 = trim(gpc('Yz4','P',''));

switch($userinfo['mlpx']){
	case 1:
	$sql_order=" in_time asc";
	break;
	case 2:
	$sql_order=" in_time desc";
	break;
	case 3:
	$sql_order=" folder_name asc";
	break;
	case 4:
	$sql_order=" folder_name desc";
	break;
	case 5:
	$sql_order=" folder_description asc";
	break;
	case 6:
	$sql_order=" folder_description desc";
	break;

	default:
	$sql_order=" in_time asc";
}


$diskname=0;
if(isset($_SESSION[$name."diskname"])&&intval($_SESSION[$name."diskname"])==1){
	$diskname=1;
}
	


if($act =='lytj'){

if($diskname==0&&$userinfo['ly']==0){
	require_once template_echo('center_lyerr',$user_tpl_dir);
	exit;
}
$textarea = str_replace("\n","<br>",$Yz3);
$ins = array(
'file_id'=>$Yz1,
'file_key' => $Yz2,
'userid' => $userinfo['userid'],
'content' => $textarea,
'in_time'=>time(),
'is_checked'=>1,
'ip'=>$onlineip
);
$db->query_unbuffered("insert into {$tpf}comments set ".$db->sql_array($ins).";");

	$rs = $db->fetch_one_array("select count(*) as total_num from {$tpf}comments c,{$tpf}users us where c.userid=us.userid and us.username='$name'");
	$numt=$rs['total_num'];
	$pages=ceil($numt/16);
	$commons=$db->query("select c.*,us.username from {$tpf}comments c,{$tpf}users us where c.userid=us.userid and us.username='$name' order by cmt_id desc limit 0,16");
	while($rs = $db->fetch_array($commons)){
	//$yz4=$yz4."<p><img src='/images/".$rs['file_id'].".gif'><b>".$rs['file_key']."</b><br><span>".$rs['content']."</span><br><label>".date("Y-m-d",$rs['in_time'])."</label><label>IP:".$rs['ip']."</label></p>";
	
		if(intval($_SESSION[$name."diskname"])==1){
			$ip=$rs['ip'];
		}else{
			$ips=explode(".",$rs['ip']);
			$ips[3]="*";
			$ip=implode(".",$ips);
		}
		// $text = str_replace ( "<BR>", chr(10), $rs['content']);
		// $text = str_replace ( "<BR>", chr(13), $text);
	$fileid=substr($rs['file_id'],1);
	
	$ss=time()-$rs['in_time'];
	if(($ss<=(10*60)&&$onlineip==$rs['ip'])||intval($_SESSION[$name."diskname"])==1){
		$yyy=$yyy."<p><img onclick='lyxg(".$rs['cmt_id'].",".$fileid.",&quot;n&quot;);' src='/images/".$rs['file_id'].".gif'><b id='Xm_".$rs['cmt_id']."'>".$rs['file_key']."</b><a class='yybj' onclick='lyxg(".$rs['cmt_id'].",".$fileid.",&quot;n&quot;);' href='javascript:'>[编辑]</a><br><span id='Nr_".$rs['cmt_id']."'>".$rs['content']."</span><br><label>".date("Y-m-d H:i",$rs['in_time'])."</label><label>IP:".$ip."</label></p>";
	}else{
		$yyy=$yyy."<p><img src='/images/".$rs['file_id'].".gif'><b id='Xm_".$rs['cmt_id']."'>".$rs['file_key']."</b><br><span id='Nr_".$rs['cmt_id']."'>".$rs['content']."</span><br><label>".date("Y-m-d H:i",$rs['in_time'])."</label><label>IP:".$ip."</label></p>";
	}
	
	
	
	}
	$yz4=$yyy."<div id='L_dh' class='ysdh' style='line-height:150%;text-align:right;'>共".$numt."条记录,第1/".$pages."页<br>&nbsp;<input type='button' value='首页' class='bt2' onclick='lyfy(this,1);'/>";
	if($pages<=1){
	$yz4=$yz4."<input type='button' value='上页' disabled='disabled' class='bt2'/><input type='button' value='下页' disabled='disabled' class='bt2'/><input type='button' value='尾页' disabled='disabled' class='bt2'/></div>";
	}else{
	$yz4=$yz4."<input type='button' value='上页' disabled='disabled' class='bt2'/><input type='button' value='下页' onclick='lyfy(this,2);' class='bt2'/><input type='button' value='尾页' onclick='lyfy(this,".$pages.");'class='bt2'/></div>";
	}

require_once template_echo('center_lysuc',$user_tpl_dir);

	$newdata = array(
	'action' => '<font color="#ff0000">新增留言</font>',
	'mytime' => time()
	);
	$db->query_unbuffered("insert into {$tpf}newdata set ".$db->sql_array($newdata).";");
}

elseif($act=="lysc"){
	
$sql="delete from {$tpf}comments where cmt_id=".$Yz1;
$db->query_unbuffered($sql);
	$rs = $db->fetch_one_array("select count(*) as total_num from {$tpf}comments c,{$tpf}users us where c.userid=us.userid and us.username='$name'");
	$numt=$rs['total_num'];
	$pages=ceil($numt/16);
	$commons=$db->query("select c.*,us.username from {$tpf}comments c,{$tpf}users us where c.userid=us.userid and us.username='$name' order by cmt_id desc limit 0,16");
	while($rs = $db->fetch_array($commons)){
		
		
		
	//$yz4=$yz4."<p><img src='/images/".$rs['file_id'].".gif'><b>".$rs['file_key']."</b><br><span>".$rs['content']."</span><br><label>".date("Y-m-d",$rs['in_time'])."</label><label>IP:".$rs['ip']."</label></p>";
	
	
		if(intval($_SESSION[$name."diskname"])==1){
			$ip=$rs['ip'];
		}else{
			$ips=explode(".",$rs['ip']);
			//$ips[1]="*";
			//$ips[2]="*";
			$ips[3]="*";
			$ip=implode(".",$ips);
		}
		// $text = str_replace ( "<BR>", chr(10), $rs['content']);
		// $text = str_replace ( "<BR>", chr(13), $text);
	$fileid=substr($rs['file_id'],1);
	
	$ss=time()-$rs['in_time'];
	if(($ss<=(10*60)&&$onlineip==$rs['ip'])||intval($_SESSION[$name."diskname"])==1){
		$yyy=$yyy."<p><img onclick='lyxg(".$rs['cmt_id'].",".$fileid.",&quot;n&quot;);' src='/images/".$rs['file_id'].".gif'><b id='Xm_".$rs['cmt_id']."'>".$rs['file_key']."</b><a class='yybj' onclick='lyxg(".$rs['cmt_id'].",".$fileid.",&quot;n&quot;);' href='javascript:'>[编辑]</a><br><span id='Nr_".$rs['cmt_id']."'>".$rs['content']."</span><br><label>".date("Y-m-d H:i",$rs['in_time'])."</label><label>IP:".$ip."</label></p>";
	}else{
		$yyy=$yyy."<p><img src='/images/".$rs['file_id'].".gif'><b id='Xm_".$rs['cmt_id']."'>".$rs['file_key']."</b><br><span id='Nr_".$rs['cmt_id']."'>".$rs['content']."</span><br><label>".date("Y-m-d H:i",$rs['in_time'])."</label><label>IP:".$ip."</label></p>";
	}
	
	}
	$yz4=$yyy."<div id='L_dh' class='ysdh' style='line-height:150%;text-align:right;'>共".$numt."条记录,第1/".$pages."页<br>&nbsp;<input type='button' value='首页' class='bt2' onclick='lyfy(this,1);'/>";
	if($pages<=1){
	$yz4=$yz4."<input type='button' value='上页' disabled='disabled' class='bt2'/><input type='button' value='下页' disabled='disabled' class='bt2'/><input type='button' value='尾页' disabled='disabled' class='bt2'/></div>";
	}else{
	$yz4=$yz4."<input type='button' value='上页' disabled='disabled' class='bt2'/><input type='button' value='下页' onclick='lyfy(this,2);' class='bt2'/><input type='button' value='尾页' onclick='lyfy(this,".$pages.");'class='bt2'/></div>";
	}

require_once template_echo('center_lysuc',$user_tpl_dir);

	$newdata = array(
	'action' => '删除留言',
	'mytime' => time()
	);
	$db->query_unbuffered("insert into {$tpf}newdata set ".$db->sql_array($newdata).";");

}elseif($act=="lyxg"){
	$textarea = str_replace("\n",'<br>',$Yz3);

$sql="update {$tpf}comments set file_key='".$Yz2."',content='".$textarea."',file_id='".$Yz1."' where cmt_id=".$Yz4;
$db->query_unbuffered($sql);
	$rs = $db->fetch_one_array("select count(*) as total_num from {$tpf}comments c,{$tpf}users us where c.userid=us.userid and us.username='$name'");
	$numt=$rs['total_num'];
	$pages=ceil($numt/16);
	$commons=$db->query("select c.*,us.username from {$tpf}comments c,{$tpf}users us where c.userid=us.userid and us.username='$name' order by cmt_id desc limit 0,16");
	while($rs = $db->fetch_array($commons)){
		
		
		
	//$yz4=$yz4."<p><img src='/images/".$rs['file_id'].".gif'><b>".$rs['file_key']."</b><br><span>".$rs['content']."</span><br><label>".date("Y-m-d",$rs['in_time'])."</label><label>IP:".$rs['ip']."</label></p>";
	
	
		if(intval($_SESSION[$name."diskname"])==1){
			$ip=$rs['ip'];
		}else{
			$ips=explode(".",$rs['ip']);
			$ips[3]="*";
			$ip=implode(".",$ips);
		}
		// $text = str_replace ( "<BR>", chr(10), $rs['content']);
		// $text = str_replace ( "<BR>", chr(13), $text);
	$fileid=substr($rs['file_id'],1);
	
	$ss=time()-$rs['in_time'];
	if(($ss<=(10*60)&&$onlineip==$rs['ip'])||intval($_SESSION[$name."diskname"])==1){
		$yyy=$yyy."<p><img onclick='lyxg(".$rs['cmt_id'].",".$fileid.",&quot;n&quot;);' src='/images/".$rs['file_id'].".gif'><b id='Xm_".$rs['cmt_id']."'>".$rs['file_key']."</b><a class='yybj' onclick='lyxg(".$rs['cmt_id'].",".$fileid.",&quot;n&quot;);' href='javascript:'>[编辑]</a><br><span id='Nr_".$rs['cmt_id']."'>".$rs['content']."</span><br><label>".date("Y-m-d H:i",$rs['in_time'])."</label><label>IP:".$ip."</label></p>";
	}else{
		$yyy=$yyy."<p><img src='/images/".$rs['file_id'].".gif'><b id='Xm_".$rs['cmt_id']."'>".$rs['file_key']."</b><br><span id='Nr_".$rs['cmt_id']."'>".$rs['content']."</span><br><label>".date("Y-m-d H:i",$rs['in_time'])."</label><label>IP:".$ip."</label></p>";
	}
	
	}
	$yz4=$yyy."<div id='L_dh' class='ysdh' style='line-height:150%;text-align:right;'>共".$numt."条记录,第1/".$pages."页<br>&nbsp;<input type='button' value='首页' class='bt2' onclick='lyfy(this,1);'/>";
	if($pages<=1){
	$yz4=$yz4."<input type='button' value='上页' disabled='disabled' class='bt2'/><input type='button' value='下页' disabled='disabled' class='bt2'/><input type='button' value='尾页' disabled='disabled' class='bt2'/></div>";
	}else{
	$yz4=$yz4."<input type='button' value='上页' disabled='disabled' class='bt2'/><input type='button' value='下页' onclick='lyfy(this,2);' class='bt2'/><input type='button' value='尾页' onclick='lyfy(this,".$pages.");'class='bt2'/></div>";
	}

require_once template_echo('center_lysuc',$user_tpl_dir);
	
}elseif($act=="scml"){
$sql="delete from {$tpf}folders where folder_id=".$Yz1;
$db->query_unbuffered($sql);

$sql="delete from {$tpf}folders where parent_id=".$Yz1;
$db->query_unbuffered($sql);


$sql="delete from {$tpf}files where folder_id=".$Yz1;
$db->query_unbuffered($sql);
$yz3=sub_folders(-1,$userinfo['userid'],$sql_order);

require_once template_echo('center_scml',$user_tpl_dir);
	
	$newdata = array(
	'action' => '删除目录',
	'mytime' => time()
	);
	$db->query_unbuffered("insert into {$tpf}newdata set ".$db->sql_array($newdata).";");
}

elseif($act=="scjl"){
if($Yz1=="z"){
$file_id=explode("_",$Yz2);

//$floderinfo= @$db->fetch_one_array("select folder_id from {$tpf}folders where parent_id='".$file_id[1]."' and folder_name='".$file_id[2]."'");
$floderinfo = @$db->fetch_one_array("select folder_id from {$tpf}folders where parent_id = '".$file_id[1]."' and folder_name='".$file_id[2]."'");

if(!empty($floderinfo)){
$sql="delete from {$tpf}folders where folder_id=".$floderinfo['folder_id'];
//echo $sql;
//exit;
$db->query_unbuffered($sql);
$sql="delete from {$tpf}files where folder_id=".$floderinfo['folder_id'];
$db->query_unbuffered($sql);
}
}
else{
	$file_id=explode("_", $Yz2);

	$fileinfo= @$db->fetch_one_array("select folder_id from {$tpf}files where file_id=".$file_id[1]);

	$sql="delete from {$tpf}files where file_id=".$file_id[1];
	$db->query_unbuffered($sql);

	if(!empty($fileinfo)){
		$floderinfo = @$db->fetch_one_array("select folder_id, parent_id from {$tpf}folders where folder_id=".$fileinfo['folder_id']);
		if($floderinfo['parent_id'] != -1){
			$toalc=@$db->fetch_one_array("select count(*) as toalc from {$tpf}files where folder_id=".$floderinfo['folder_id']);
			$ttt=intval($toalc['toalc']);
			if($ttt<=0){
				$sql="delete from {$tpf}folders where folder_id=".$floderinfo['folder_id'];
				$db->query_unbuffered($sql);
			}
			$folderid = $floderinfo['parent_id'];
		}
		else{
			$folderid = $floderinfo['folder_id'];
		}
	}
}
require_once template_echo('center_scjl',$user_tpl_dir);

	//$folderid = $floderinfo['parent_id'];
	$folder = @$db->fetch_one_array("select folder_name from {$tpf}folders where folder_id = '$folderid'");
	$foldername = $folder['folder_name'];
	$newdata = array(
	'action' => '删除数据，位于：<a href="javascript:void(0);" onclick="kq(' . $folderid . ');" class="ml">' . $foldername . '</a>',
	'mytime' => time()
	);
	$db->query_unbuffered("insert into {$tpf}newdata set ".$db->sql_array($newdata).";");
}
elseif($act=="gly_dl"){
$password=md5($Yz1);
$diskinfo= @$db->fetch_one_array("select * from {$tpf}users where username='$name' and `password`='$password'");
if(empty($diskinfo)){
	require_once template_echo('center_dlyerr',$user_tpl_dir);
	exit;
}
	$_SESSION[$name."diskname"]=1;
	
	
	
	
	
	$rs = $db->fetch_one_array("select count(*) as total_num from {$tpf}comments c,{$tpf}users us where c.userid=us.userid and us.username='$name'");
	$numt=$rs['total_num'];
	$pages=ceil($numt/16);
	$commons=$db->query("select c.*,us.username from {$tpf}comments c,{$tpf}users us where c.userid=us.userid and us.username='$name' order by cmt_id desc limit 0,16");
	while($rs = $db->fetch_array($commons)){
	//$yz4=$yz4."<p><img src='/images/".$rs['file_id'].".gif'><b>".$rs['file_key']."</b><br><span>".$rs['content']."</span><br><label>".date("Y-m-d",$rs['in_time'])."</label><label>IP:".$rs['ip']."</label></p>";
	
		if(intval($_SESSION[$name."diskname"])==1){
			$ip=$rs['ip'];
		}else{
			$ips=explode(".",$rs['ip']);
			$ips[3]="*";
			$ip=implode(".",$ips);
		}
		// $text = str_replace ( "<BR>", chr(10), $rs['content']);
		// $text = str_replace ( "<BR>", chr(13), $text);
	$fileid=substr($rs['file_id'],1);
	
	$ss=time()-$rs['in_time'];
	if(($ss<=(10*60)&&$onlineip==$rs['ip'])||intval($_SESSION[$name."diskname"])==1){
		$yyy=$yyy."<p><img onclick='lyxg(".$rs['cmt_id'].",".$fileid.",&quot;n&quot;);' src='/images/".$rs['file_id'].".gif'><b id='Xm_".$rs['cmt_id']."'>".$rs['file_key']."</b><a class='yybj' onclick='lyxg(".$rs['cmt_id'].",".$fileid.",&quot;n&quot;);' href='javascript:'>[编辑]</a><br><span id='Nr_".$rs['cmt_id']."'>".$rs['content']."</span><br><label>".date("Y-m-d H:i",$rs['in_time'])."</label><label>IP:".$ip."</label></p>";
	}else{
		$yyy=$yyy."<p><img src='/images/".$rs['file_id'].".gif'><b id='Xm_".$rs['cmt_id']."'>".$rs['file_key']."</b><br><span id='Nr_".$rs['cmt_id']."'>".$rs['content']."</span><br><label>".date("Y-m-d H:i",$rs['in_time'])."</label><label>IP:".$ip."</label></p>";
	}
	
	
	
	}
	$yz4=$yyy."<div id='L_dh' class='ysdh' style='line-height:150%;text-align:right;'>共".$numt."条记录,第1/".$pages."页<br>&nbsp;<input type='button' value='首页' class='bt2' onclick='lyfy(this,1);'/>";
	if($pages<=1){
	$yz4=$yz4."<input type='button' value='上页' disabled='disabled' class='bt2'/><input type='button' value='下页' disabled='disabled' class='bt2'/><input type='button' value='尾页' disabled='disabled' class='bt2'/></div>";
	}else{
	$yz4=$yz4."<input type='button' value='上页' disabled='disabled' class='bt2'/><input type='button' value='下页' onclick='lyfy(this,2);' class='bt2'/><input type='button' value='尾页' onclick='lyfy(this,".$pages.");'class='bt2'/></div>";
	}
	require_once template_echo('center_dlysuc',$user_tpl_dir);
}
elseif($act=="gly_tc"){
	$_SESSION[$name."diskname"]=0;
	$rs = $db->fetch_one_array("select count(*) as total_num from {$tpf}comments c,{$tpf}users us where c.userid=us.userid and us.username='$name'");
	$numt=$rs['total_num'];
	$pages=ceil($numt/16);
	$commons=$db->query("select c.*,us.username from {$tpf}comments c,{$tpf}users us where c.userid=us.userid and us.username='$name' order by cmt_id desc limit 0,16");
	while($rs = $db->fetch_array($commons)){
	//$yz4=$yz4."<p><img src='/images/".$rs['file_id'].".gif'><b>".$rs['file_key']."</b><br><span>".$rs['content']."</span><br><label>".date("Y-m-d",$rs['in_time'])."</label><label>IP:".$rs['ip']."</label></p>";
	
		if(intval($_SESSION[$name."diskname"])==1){
			$ip=$rs['ip'];
		}else{
			$ips=explode(".",$rs['ip']);
			$ips[3]="*";
			$ip=implode(".",$ips);
		}
		// $text = str_replace ( "<BR>", chr(10), $rs['content']);
		// $text = str_replace ( "<BR>", chr(13), $text);
	$fileid=substr($rs['file_id'],1);
	
	$ss=time()-$rs['in_time'];
	if(($ss<=(10*60)&&$onlineip==$rs['ip'])||intval($_SESSION[$name."diskname"])==1){
		$yyy=$yyy."<p><img onclick='lyxg(".$rs['cmt_id'].",".$fileid.",&quot;n&quot;);' src='/images/".$rs['file_id'].".gif'><b id='Xm_".$rs['cmt_id']."'>".$rs['file_key']."</b><a class='yybj' onclick='lyxg(".$rs['cmt_id'].",".$fileid.",&quot;n&quot;);' href='javascript:'>[编辑]</a><br><span id='Nr_".$rs['cmt_id']."'>".$rs['content']."</span><br><label>".date("Y-m-d H:i",$rs['in_time'])."</label><label>IP:".$ip."</label></p>";
	}else{
		$yyy=$yyy."<p><img src='/images/".$rs['file_id'].".gif'><b id='Xm_".$rs['cmt_id']."'>".$rs['file_key']."</b><br><span id='Nr_".$rs['cmt_id']."'>".$rs['content']."</span><br><label>".date("Y-m-d H:i",$rs['in_time'])."</label><label>IP:".$ip."</label></p>";
	}
	
	
	
	}
	$yz4=$yyy."<div id='L_dh' class='ysdh' style='line-height:150%;text-align:right;'>共".$numt."条记录,第1/".$pages."页<br>&nbsp;<input type='button' value='首页' class='bt2' onclick='lyfy(this,1);'/>";
	if($pages<=1){
	$yz4=$yz4."<input type='button' value='上页' disabled='disabled' class='bt2'/><input type='button' value='下页' disabled='disabled' class='bt2'/><input type='button' value='尾页' disabled='disabled' class='bt2'/></div>";
	}else{
	$yz4=$yz4."<input type='button' value='上页' disabled='disabled' class='bt2'/><input type='button' value='下页' onclick='lyfy(this,2);' class='bt2'/><input type='button' value='尾页' onclick='lyfy(this,".$pages.");'class='bt2'/></div>";
	}
	
	
	
	
	
	
	
	
	
	
	
	require_once template_echo('center_out',$user_tpl_dir);
}elseif($act=="kqmmpd"){

$folderinfo= @$db->fetch_one_array("select * from {$tpf}folders where folder_id='$Yz1' and `password`='$Yz2'");
$status=1;
if(empty($folderinfo)){
	$status=0;
}
require_once template_echo('center_mlmmpd',$user_tpl_dir);

}elseif($act=="xgsj"){


$fileid=explode("_",$Yz1);

if($fileid[0]=="u")//链接
{
	
$name=$Yz2;
$des=$Yz3;
$pid=explode("_",$Yz4);

if($pid[0]=="z"){
$floderid=getfloderid($pid[1],$pid[2]);
$sql="update {$tpf}files set file_name='".$name."',file_description='".$des."',folder_id='".$floderid."' where file_id=".$fileid[1];

}else{
$sql="update {$tpf}files set file_name='".$name."',file_description='".$des."',folder_id='".$pid[1]."' where file_id=".$fileid[1];
}



}elseif($fileid[0]=="z"){//目录
$name=$Yz3;
$pid=explode("_",$Yz4);	

if($pid[0]=="z"){
	$floderid=getfloderid($pid[1],$pid[2]);
$sql="update {$tpf}folders set folder_name='".$name."',folder_description='".$name."',parent_id='".$floderid."' where folder_id=".$fileid[1];
}else{
$sql="update {$tpf}folders set folder_name='".$name."',folder_description='".$name."',parent_id='".$pid[1]."' where folder_id=".$fileid[1];
}


//echo $sql;

}elseif($fileid[0]=="t"){//文本
$name=$Yz2;
$des=$Yz3;
$pid=explode("_",$Yz4);	

if($pid[0]=="z"){
	$floderid=getfloderid($pid[1],$pid[2]);
$sql="update {$tpf}files set file_name='".$name."',file_description='".$des."',folder_id='".$floderid."' where file_id=".$fileid[1];
}else{
$sql="update {$tpf}files set file_name='".$name."',file_description='".$des."',folder_id='".$pid[1]."' where file_id=".$fileid[1];
}


	
	
}else{//文件
$name=explode(".",$Yz2);
$des=$Yz3;
$pid=explode("_",$Yz4);	

if($pid[0]=="z"){
	$floderid=getfloderid($pid[1],$pid[2]);
	$sql="update {$tpf}files set file_name='".$name[0]."',file_description='".$des."',folder_id='".$floderid."' where file_id=".$fileid[1];
}else{
$sql="update {$tpf}files set file_name='".$name[0]."',file_description='".$des."',folder_id='".$pid[1]."' where file_id=".$fileid[1];
}


}







$fileinfo= @$db->fetch_one_array("select folder_id from {$tpf}files where file_id=".$fileid[1]);
$db->query_unbuffered($sql);

if(!empty($fileinfo)){
	$floderinfo= @$db->fetch_one_array("select folder_id ,parent_id from {$tpf}folders where folder_id=".$fileinfo['folder_id']);
	if($floderinfo['parent_id']!=-1){
		$toalc=@$db->fetch_one_array("select count(*) as toalc from {$tpf}files where folder_id=".$floderinfo['folder_id']);
		$ttt=intval($toalc['toalc']);
		if($ttt<=0){
			$sql="delete from {$tpf}folders where folder_id=".$floderinfo['folder_id'];
			$db->query_unbuffered($sql);
		}
	}
}



require_once template_echo('center_xgsj',$user_tpl_dir);
}elseif($act=="xgml"){
	
$fileorder=explode("|",$Yz4);
if(empty($fileorder[0])){
	
$sql="update {$tpf}folders set folder_name='".$Yz2."',folder_description='".$Yz3."',password='',fileorder='".$fileorder[1]."' where folder_id=".$Yz1;
}else{
if($fileorder[0]=="~"){
	
$sql="update {$tpf}folders set folder_name='".$Yz2."',folder_description='".$Yz3."',fileorder='".$fileorder[1]."' where folder_id=".$Yz1;
}else{
$sql="update {$tpf}folders set folder_name='".$Yz2."',folder_description='".$Yz3."',password='".$fileorder[0]."',fileorder='".$fileorder[1]."' where folder_id=".$Yz1;
}
}
//echo $sql;
$db->query_unbuffered($sql);
$yz3=sub_folders(-1,$userinfo['userid'],$sql_order);
require_once template_echo('center_xgml',$user_tpl_dir);


}
elseif($act=="xzlj"){
	if(!empty($Yz4)){
		//$floderid = @$db->fetch_one_array("select folder_id from {$tpf}folders where parent_id='$Yz3' and folder_name='$Yz4'");
		$floderid = @$db->fetch_one_array("select folder_id, parent_id from {$tpf}folders where parent_id='$Yz3' and folder_name='$Yz4'");
		if(empty($floderid)){
			$ins = array(
			'parent_id'=>$Yz3,
			'folder_node'=>1,
			'folder_name' => $Yz4,
			'folder_description' => $Yz4,
			'userid' => $userinfo['userid'],
			'in_time'=>time(),
			);
			@$db->query_unbuffered("insert into {$tpf}folders set ".$db->sql_array($ins).";");
			$idddd=@$db->insert_id();
		}
		else{
			$idddd = $floderid['folder_id'];
			$folderid = $floderid['parent_id']; //找到父目录
		}
	}
	else{
		$idddd = $Yz3;
		$folderid = $idddd;  //找到父目录
	}
	$ins = array(
		'file_name' => $Yz1,
		'file_key' => $file_key ? $file_key : '',
		'file_extension' => '',
		'is_image' => 2,
		'file_mime' => 'application/octet-stream',
		'file_description' => $Yz2,
		'file_store_path' => $file_store_path ? $file_store_path : '',
		'file_real_name' => '',
		'file_md5' => $file_md5 ? $file_md5 : '',
		'server_oid' => (int)$server_oid,
		'file_size' => 0,
		'thumb_size' => 0,
		'file_time' => $timestamp,
		'is_checked' => 1,
		'in_share' => 0,
		'is_public' => 0,
		'report_status' => 0,
		'userid' => $userinfo['userid'],
		'folder_id' => $idddd,
		'cate_id' => 0,
		'subcate_id' => 0,
		'ip' => $onlineip,
	);
	$db->query_unbuffered("insert into {$tpf}files set ".$db->sql_array($ins).";");
	$insert=$db->insert_id();
	if(substr($Yz2,0,4)=="http"){
		$ss="<img src='/images/url.gif' id='t_".$insert."' onclick='_fbj.tj(this)'><a href='".$Yz2."' style='color:blue' target=_blank class=lj>".$Yz1."</a>";
	}
	else{
		$ss="<img src='/images/wj.gif' id='t_".$insert."' onclick='_fbj.tj(this)'><span style='color:blue'>".$Yz1."</span><font>".$Yz2."</font>";
	}
	require_once template_echo('center_xzlj',$user_tpl_dir);

	$folder = @$db->fetch_one_array("select folder_name from {$tpf}folders where folder_id = '$folderid'");
	$foldername = $folder['folder_name'];
	$newdata = array(
		'action' => '<font color="#ff0000">新增数据</font>，位于：<a href="javascript:void(0);" onclick="kq(' . $folderid . ');" class="ml">' . $foldername . '</a>',
		'mytime' => time()
	);
	$db->query_unbuffered("insert into {$tpf}newdata set ".$db->sql_array($newdata).";");
}elseif($act=="xzml"){
	
$rs = $db->fetch_one_array("select count(*) as total from {$tpf}folders where userid='".$userinfo['userid']."'");
$tatal=$diskinfo['max_folders'];

if($rs['total'] >= $diskinfo['max_folders']){
	require_once template_echo('center_mlerr1',$user_tpl_dir);
	exit;
}

	
if($diskname==0&&$userinfo['ml']==0){
	require_once template_echo('center_mlerr',$user_tpl_dir);
	exit;
}


$ins = array(
'parent_id'=>-1,
'folder_node'=>1,
'folder_name' => $Yz1,
'folder_description' => $Yz2,
'password' => $Yz3,
'fileorder' => $Yz4,

'userid' => $userinfo['userid'],
'in_time'=>time(),
);
$db->query_unbuffered("insert into {$tpf}folders set ".$db->sql_array($ins).";");
$insert=$db->insert_id();
$yz3=sub_folders(-1,$userinfo['userid'],$sql_order);
require_once template_echo('center_mlsuc',$user_tpl_dir);

	$newdata = array(
	'action' => '<font color="#ff0000">新增目录</font>',
	'mytime' => time()
	);
	$db->query_unbuffered("insert into {$tpf}newdata set ".$db->sql_array($newdata).";");
}elseif($act=="lyb_dq"){
	$cur=$Yz1;
	if($cur<0)$cur=1;
	$page=($cur-1)*16;
	if($page<0)$page=0;
	$rs = $db->fetch_one_array("select count(*) as total_num from {$tpf}comments c,{$tpf}users us where c.userid=us.userid and us.username='$name'");
	$numt=$rs['total_num'];
	$pages=ceil($numt/16);
	$commons=$db->query("select c.*,us.username from {$tpf}comments c,{$tpf}users us where c.userid=us.userid and us.username='$name' order by cmt_id desc limit {$page},16");
	while($rs = $db->fetch_array($commons)){
		if(intval($_SESSION[$name."diskname"])==1){
			$ip=$rs['ip'];
		}else{
			$ips=explode(".",$rs['ip']);
			$ips[3]="*";
			$ip=implode(".",$ips);
		}
	$yz4=$yz4."<p><img src='/images/".$rs['file_id'].".gif'><b>".$rs['file_key']."</b><br><span>".$rs['content']."</span><br><label>".date("Y-m-d H:i",$rs['in_time'])."</label><label>IP:".$ip."</label></p>";
	}
	$yz4=$yz4."<div id='L_dh' class='ysdh' style='line-height:150%;text-align:right;'>共".$numt."条记录,第1/".$pages."页<br>&nbsp;<input type='button' value='首页' class='bt2' onclick='lyfy(this,1);'/>";
	if($pages<=1){
	}else{
		
		if($cur>1){
			$yz4=$yz4."<input type='button' value='上页' onclick='lyfy(this,".($cur-1).");' class='bt2'/>";
		}else{
			$yz4.="<input type='button' value='上页' disabled='disabled' class='bt2'/>";
		}
		
		if($cur>=$pages){
		$yz4=$yz4."<input type='button' value='下页' disabled='disabled' class='bt2'/><input type='button' value='尾页' disabled='disabled' class='bt2'/></div>";
		}else{
		$yz4=$yz4."<input type='button' value='下页' onclick='lyfy(this,".($cur+1).");' class='bt2'/><input type='button' value='尾页' onclick='lyfy(this,".$cur.");'class='bt2'/></div>";
		}
	}
require_once template_echo('center_lylist',$user_tpl_dir);
	
}


elseif($act=="kqmmfq"){
	$folderid=$Yz1;
	$yz1="0,0,0|".sub_files($Yz1,$userinfo['userid'],$sql_order).folder_files($Yz1,$userinfo['userid']);
	require_once template_echo('center_kqmmfq',$user_tpl_dir);
}
elseif($act=="dq"){
	$folderid = $Yz1;
	$yz1="0,0,0|".sub_files($Yz1,$userinfo['userid'],$sql_order).folder_files($Yz1,$userinfo['userid']);
	require_once template_echo('center_dq',$user_tpl_dir);
}

elseif($act=="xsdllb"){
	$cur=$Yz1;
	if($cur<0)$cur=1;
	$page=($cur-1)*10;
	if($page<0)$page=0;
	$rs = $db->fetch_one_array("select count(*) as total_num from {$tpf}download where userid=".$userinfo['userid']);
	$numt=$rs['total_num'];
	$pages=ceil($numt/10);
	$commons=$db->query("select * from {$tpf}download where userid=".$userinfo['userid']." order by id desc limit {$page},10");
	$yz3="<table class='sjtb' border='1' cellspacing='0' cellpadding='2'><tr class='trbt'><td>下载时间</td><td>下载人IP</td><td>文件名</td><td>下载量</td></tr>";
	while($rs = $db->fetch_array($commons)){
		if(intval($_SESSION[$name."diskname"])==1){
			$ip=$rs['ip'];
		}else{
			$ips=explode(".",$rs['ip']);
			$ips[3]="*";
			$ip=implode(".",$ips);
		}

		$yyy.="<tr><td>".date("Y-m-d H:i:s",$rs['downtime'])."</td><td>".$ip."</td><td><font color=green>".$rs['wenjian']."</font></td><td align=right>".$rs['dx']."</td></tr>";
	}
	if($pages>1){
		$str=$numt.','.$cur.','.$pages.',1,1,1';
	}else{
		$str=$numt.','.$cur.','.$pages.',0,0,0';
	}
	if($cur==$pages){
		$str=$numt.','.$cur.','.$pages.',1,0,0';
	}
	$yz3=$yz3.$yyy."</table>";
	
	require_once template_echo('center_xsdllb',$user_tpl_dir);
}elseif($act=="xszxlb"){
	$intime=time()-120;
	$rsa = $db->query("select * from {$tpf}oline where  intime>='".$intime."' order by `intime` desc");
	//echo "select * from {$tpf}oline where userid=".$userinfo['userid']." and intime>=".$intime;
	$online="<table class='sjtb' cellspacing='0' cellpadding='2'><tr class='trbt'><td width='33'>编号</td><td>IP值</td><td>进入时间</td><td>最后时间</td></tr>";
	$i=0;
	while($rs = $db->fetch_array($rsa)){
		$i++;
		$intimes=time()-$rs['intime'];
		if($intimes>=60){
			$intimel=ceil($intimes/60)."分钟前";
		}else{
			$intimel=$intimes."秒前";
		}
		if(intval($_SESSION[$name."diskname"])==1){
			$ip=$rs['ip'];
		}else{
			$ips=explode(".",$rs['ip']);
			$ips[3]="*";
			$ip=implode(".",$ips);
		}
		$online.="<tr><td>$i</td><td>$ip</td><td>".date("Y-m-d H:i:s",$rs['intime'])."</td><td align=right>".$intimel."</td></tr>";
	}
	$online.="</table>";
	require_once template_echo('center_ip',$user_tpl_dir);
	
}

else{
	$yz3=sub_folders(-1,$userinfo['userid'],$sql_order);
	
	$intime=strtotime(date("Y-m-d"));
$rs = $db->fetch_one_array("select * from {$tpf}oline where userid='".$userinfo['userid']."' and ip='$onlineip' limit 1");
//echo "select * from {$tpf}oline where userid='".$userinfo['userid']."' and ip='$onlineip' limit 1";
if(!$rs){
$sql = "insert into {$tpf}oline(userid,ip,intime) values('".$userinfo['userid']."','".$onlineip."','".time()."')";
$db->query_unbuffered($sql);

}else{
$sql = "update {$tpf}oline set intime='".time()."' where ip='".$onlineip."' and userid='".$userinfo['userid']."'";
$db->query_unbuffered($sql);
}

	
 

 
	$rs = $db->fetch_one_array("select count(*) as total from {$tpf}oline where userid=".$userinfo['userid']." and intime>=".(time()-120));
	$olinenum=$rs['total'];
	$rs = $db->fetch_one_array("select count(*) as total_num from {$tpf}comments c,{$tpf}users us where c.userid=us.userid and us.username='$name'");
	$numt=$rs['total_num'];
	$pages=ceil($numt/16);
	$commons=$db->query("select c.*,us.username from {$tpf}comments c,{$tpf}users us where c.userid=us.userid and us.username='$name' order by cmt_id desc limit 0,16");
	while($rs = $db->fetch_array($commons)){
		if(intval($_SESSION[$name."diskname"])==1){
			$ip=$rs['ip'];
		}else{
			$ips=explode(".",$rs['ip']);
			$ips[1]="*";
			$ips[2]="*";
			$ips[3]="*";
			$ip=implode(".",$ips);
		}
		// $text = str_replace ( "<BR>", chr(10), $rs['content']);
		// $text = str_replace ( "<BR>", chr(13), $text);
	$fileid=substr($rs['file_id'],1);
	
	$ss=time()-$rs['in_time'];
	//if(($ss<=(10*60)&&$onlineip==$rs['ip'])||intval($_SESSION[$name."diskname"])==1){
	if(intval($_SESSION[$name."diskname"])==1){
		$yyy=$yyy."<p><img onclick='lyxg(".$rs['cmt_id'].",".$fileid.",&quot;n&quot;);' src='/images/".$rs['file_id'].".gif'><b id='Xm_".$rs['cmt_id']."'>".$rs['file_key']."</b><a class='yybj' onclick='lyxg(".$rs['cmt_id'].",".$fileid.",&quot;n&quot;);' href='javascript:'>[编辑]</a><br><span id='Nr_".$rs['cmt_id']."'>".$rs['content']."</span><br><label>".date("Y-m-d H:i",$rs['in_time'])."</label><label>IP:".$ip."</label></p>";
	}else{
		$yyy=$yyy."<p><img src='/images/".$rs['file_id'].".gif'><b id='Xm_".$rs['cmt_id']."'>".$rs['file_key']."</b><br><span id='Nr_".$rs['cmt_id']."'>".$rs['content']."</span><br><label>".date("Y-m-d H:i",$rs['in_time'])."</label><label>IP:".$ip."</label></p>";
	}
	}
	
	if(empty($yyy)){
		$yyy='<P><br>&nbsp;尚无留言！</P>';
	}
	
/*	if($pages>1){
*/	$yz4=$yyy."<div id='L_dh' class='ysdh' style='line-height:150%;text-align:right;'>共".$numt."条记录,第1/".$pages."页<br>&nbsp;<input type='button' value='首页' class='bt2' onclick='lyfy(this,1);'/>";
	if($pages<=1){
	$yz4=$yz4."<input type='button' value='上页' disabled='disabled' class='bt2'/><input type='button' value='下页' disabled='disabled' class='bt2'/><input type='button' value='尾页' disabled='disabled' class='bt2'/></div>";
	}else{
	$yz4=$yz4."<input type='button' value='上页' disabled='disabled' class='bt2'/><input type='button' value='下页' onclick=
	'lyfy(this,2);' class='bt2'/><input type='button' value='尾页' onclick='lyfy(this,".$pages.");'class='bt2'/></div>";
	}
/*	}else{
		$yz4=$yyy;
	}
*/	require_once template_echo('center_index',$user_tpl_dir);
}


function sub_folders($folder_id,$pd_uid,$sql_order){
	global $db,$tpf;
	$folder_id = $folder_id ? (int)$folder_id : -1;
	$q = $db->query("select * from {$tpf}folders where parent_id='$folder_id' and userid='$pd_uid' and in_recycle=0 order by {$sql_order}");
	$sub_folders = '';
	while($rs = $db->fetch_array($q)){
		$password=0;
		if(!empty($rs['password'])){
			$password=1;
		}
		$sub_folders.="<li id='x".$rs['folder_id']."_".$password."|".$rs['fileorder']."'>";
		
		if(empty($rs['password'])){
			$sub_folders.="<table cellspacing='1'><tr>";
			
			
			if(substr($rs['fileorder'],1,1)=='1'){//显示
			$sub_folders.="<td class='g'></td>";
			}else{
			$sub_folders.="<td class='r'></td>";
			}
			if(substr($rs['fileorder'],0,1)=='1'){//上传
			$sub_folders.="<td class='g'></td>";
			}else{
			$sub_folders.="<td class='r'></td>";
			}
			if(substr($rs['fileorder'],2,1)=='1'){//下载
			$sub_folders.="<td class='g'></td>";
			}else{
			$sub_folders.="<td class='r'></td>";
			}
			
			
			$sub_folders.="</tr></table>";
			
	$z=folder_files1($rs['folder_id'],$pd_uid,$sql_order);
	if($z==true){
			$sub_folders.="<img border=0 src='/images/mlgk.gif'/><a href='javascript:;' class='mln'>".$rs['folder_name']."</a><label>".$rs['folder_description']."</label><ul style='display:none;' id='ZMm_".$rs['folder_id']."' class=menu></ul></li>";
}else{
			$sub_folders.="<img border=0 src='/images/mlgk.gif'/><a href='javascript:;' class='ml'>".$rs['folder_name']."</a><label>".$rs['folder_description']."</label><ul style='display:none;' id='ZMm_".$rs['folder_id']."' class=menu></ul></li>";
	}
			
			//$sub_folders.="<img border=0 src='/images/mlgk.gif'/><a href='javascript:;' class='ml'>".$rs['folder_name']."</a><label>".$rs['folder_description']."</label><ul style='display:none;' id='ZMm_".$rs['folder_id']."' class=menu></ul></li>";
			
			
			
		}else{
			
			$sub_folders.="<table cellspacing='1'><tr>";
			
			$floderimg='mlsd';
			if($rs['fileorder']=='000000'){
				$sub_folders.="<td class='r'></td><td class='r'></td><td class='r'></td></tr><tr><td class='r'></td><td class='r'></td><td class='r'></td>";
			}elseif($rs['fileorder']=='111111'){
				$sub_folders.="<td class='g'></td><td class='g'></td><td class='g'></td></tr><tr><td class='g'></td><td class='g'></td><td class='g'></td>";
			}elseif($rs['fileorder']=='000111'){
				$sub_folders.="<td class='g'></td><td class='g'></td><td class='g'></td>";
				$floderimg='mlgk';
			}elseif(substr($rs['fileorder'],3,3)=='000'){

				if(substr($rs['fileorder'],1,1)=='1'){//上传
				$sub_folders.="<td class='g'></td>";
				}else{
				$sub_folders.="<td class='r'></td>";
				}
				
				if(substr($rs['fileorder'],2,1)=='1'){//下载
				$sub_folders.="<td class='g'></td>";
				}else{
				$sub_folders.="<td class='r'></td>";
				}
				
				if(substr($rs['fileorder'],0,1)=='1'){//编辑
				$sub_folders.="<td class='g'></td>";
				}else{
				$sub_folders.="<td class='r'></td>";
				}

			}else{
			
				if(substr($rs['fileorder'],1,1)=='1'){//上传
				$sub_folders.="<td class='g'></td>";
				}else{
				$sub_folders.="<td class='r'></td>";
				}
				
				if(substr($rs['fileorder'],2,1)=='1'){//下载
				$sub_folders.="<td class='g'></td>";
				}else{
				$sub_folders.="<td class='r'></td>";
				}
				
				if(substr($rs['fileorder'],0,1)=='1'){//编辑
				$sub_folders.="<td class='g'></td>";
				}else{
				$sub_folders.="<td class='r'></td>";
				}
			
				$sub_folders.="</tr><tr>";
				
				if(substr($rs['fileorder'],3,1)=='1'){//上传
				$sub_folders.="<td class='g'></td>";
				}else{
				$sub_folders.="<td class='r'></td>";
				}
				
				if(substr($rs['fileorder'],4,1)=='1'){//下载
				$sub_folders.="<td class='g'></td>";
				}else{
				$sub_folders.="<td class='r'></td>";
				}
				
				if(substr($rs['fileorder'],5,1)=='1'){//编辑
				$sub_folders.="<td class='g'></td>";
				}else{
				$sub_folders.="<td class='r'></td>";
				}
				
				
			
			}
			
			

			$sub_folders.="</tr></table>";
			
	$z=folder_files1($rs['folder_id'],$pd_uid,$sql_order);
	if($z==true){
			$sub_folders.="<img border=0 src='/images/".$floderimg.".gif'/><a href='javascript:;' class='mln'>".$rs['folder_name']."</a><label>".$rs['folder_description']."</label><ul style='display:none;' id='ZMm_".$rs['folder_id']."' class=menu></ul></li>";
	}else{
			$sub_folders.="<img border=0 src='/images/".$floderimg.".gif'/><a href='javascript:;' class='ml'>".$rs['folder_name']."</a><label>".$rs['folder_description']."</label><ul style='display:none;' id='ZMm_".$rs['folder_id']."' class=menu></ul></li>";
	}
		}
		
		
		//<a class='yybj' href='javascript:;' onclick='_m.b(this);' title='在关闭页面前，您可以编辑您新加的数据'>[编辑]</a>
	}
	$db->free($q);
	if(empty($sub_folders)){
		return "<li style='padding:5px;font-size:9pt;'>尚无目录，请在左侧操作区增加目录。 <a style='color:blue;' target='_blank' href='/help.php'>[海诚Ｅ盘操作指南]</a></li>";
	}
	return $sub_folders;

}

function sub_files($folder_id,$pd_uid,$sql_order){
global $db,$tpf;
$q = $db->query("select * from {$tpf}folders where parent_id='$folder_id' and userid='$pd_uid' and in_recycle=0 order by {$sql_order}");
$files_array ='';
while($rs = $db->fetch_array($q)){
	//<a href='javascript:' class='yybj' onclick=_fbj.tj(this) title='关闭页面前，您可以编辑您新加的数据'>[编辑]
	
	$z=folder_files1($rs['folder_id'],$pd_uid,$sql_order);
	if($z==true){
		$files_array.="<li><img src='/images/mlgk.gif' id='z_".$folder_id."_".$rs['folder_description']."_i' onclick='_fbj.tj(this)'><a href='javascript:' onclick='zmlkq(this);' style='color:blue;'>".$rs['folder_description']."</a><ul id='z_".$folder_id."_".$rs['folder_description']."' class='menu' style='display:none;'>".folder_files($rs['folder_id'],$pd_uid,$sql_order)."</ul></li>";
	}else{
		$files_array.="<li><img src='/images/mlgk.gif' id='z_".$rs['folder_id']."_".$rs['folder_description']."_i' onclick='_fbj.tj(this)'><a href='javascript:' onclick='zmlkq(this);'>".$rs['folder_description']."</a><ul id='z_".$rs['folder_id']."_".$rs['folder_description']."' class='menu' style='display:none;'>".folder_files($rs['folder_id'],$pd_uid,$sql_order)."</ul></li>";
	}
	//$files_array.="<li><img src='/images/mlgk.gif' id='z_".$rs['folder_id']."_".$rs['folder_description']."_i' onclick='_fbj.tj(this)'><a href='javascript:' onclick='zmlkq(this);'>".$rs['folder_description']."</a><ul id='z_".$rs['folder_id']."_".$rs['folder_description']."' class='menu' style='display:none;'>".folder_files($rs['folder_id'],$pd_uid,$sql_order)."</ul></li>";
	
	//<ul id='z_1052241_sdfg' class='menu' style='display:none;'><li><img src='http://zy.ys168.com/tp/wjlx/eye.gif' id=w_7864178 onclick='_fbj.tj(this)'><a href='http://ys-D.ys168.com/1.0/342568814/l36715M3LGHOOIfTvKjH/494a173ad251d43b5932d6163f12aecd.cdr' title='上传时间:2012-10-28 16:54:44' class=wj style='color:blue'>494a173ad251d43b5932d6163f12aecd.cdr KB</a><font></font></li></ul>
}
$db->free($q);
unset($rs);
return $files_array;
}

function folder_files1($folder_id,$pd_uid){
global $db,$tpf;
$sql_do = " {$tpf}files where folder_id='$folder_id' and userid='$pd_uid' and in_recycle=0 and is_public=0";
$q = $db->query("select * from {$sql_do} order by file_id desc");
$tt=24*60*60;
$q2 =  $db->query("select folder_id from {$tpf}folders where parent_id='$folder_id'");
while($rs = $db->fetch_array($q2))
{
 
    if(folder_files1($rs['folder_id'],$pd_uid))
	 	return true;
}

while($rs = $db->fetch_array($q)){

	$aa=time()-$rs['file_time'];
	if($aa<$tt){
		return true;
	}
}

return false;
}

function getfloderid($pid,$name){
global $db,$tpf,$userinfo;
$floderinfo= @$db->fetch_one_array("select folder_id from {$tpf}folders where parent_id='$pid' and folder_name='$name'");
if(empty($floderinfo)){
	
	
	$ins = array(
	'parent_id'=>$pid,
	'folder_node'=>1,
	'folder_name' => $name,
	'folder_description' => $name,
	'userid' => $userinfo['userid'],
	'in_time'=>time(),
	);
	@$db->query_unbuffered("insert into {$tpf}folders set ".$db->sql_array($ins).";");
	return @$db->insert_id();
	
	
	
	
	
	
	
	
}else{
	return $floderinfo['folder_id'];
}
}

function folder_files($folder_id,$pd_uid){
global $db,$tpf;
$fileexs=array('bmp','chm','css','js','doc','exe','eye','gif','jpg','mp3','rar','txt','url','wj','xls','psd','ppt','png');
$sql_do = " {$tpf}files where folder_id='$folder_id' and userid='$pd_uid' and in_recycle=0 and is_public=0";
$q = $db->query("select * from {$sql_do} order by file_id desc");
$files_array ='';
while($rs = $db->fetch_array($q)){
	//$files_array.="<li><img src='http://zy.ys168.com/tp/wjlx/jpg.gif' id=w_7863824 onclick='_fbj.tj(this)'><a href='http://ys-D.ys168.com/1.0/342568863/ihithRo37226O2H4MOI/d57e999477b39479d31b707e.jpg' title='上传时间:2012-10-28 14:05:33' class=wj target=_blank style='color:blue'>d57e999477b39479d31b707e.jpg 41KB</a><a href='javascript:' class=yyck onclick='show(this)'>查看</a><font>fghj</font><a href='javascript:' class='yybj' onclick=_fbj.tj(this) title='关闭页面前，您可以编辑您新加的数据'>[编辑]</a></li>";
	//<a href='javascript:' class='yybj' onclick=_fbj.tj(this) title='关闭页面前，您可以编辑您新加的数据'>[编辑]
	$file_size = get_size($rs['file_size']);
	$tmp_ext = $rs['file_extension'] ? '.'.$rs['file_extension'] : "";
	$file_name = $rs['file_name'].$tmp_ext;
	$real_name = $rs['file_store_path'].$rs['file_real_name'].$tmp_ext;
	$file_time=date("Y-m-d H:i:s",$rs['file_time']);
	
	$file_extension=$rs['file_extension'];
	if(!in_array($file_extension,$fileexs)) {
		$file_extension='eye';
	}
	$is_out_date = (time() - $rs['file_time']) > 24*60*60;
	$style = $is_out_date ?"color:black":"color:blue";
	$editable = "";//$is_out_date?"style='display:none;'":"";
	if($rs['is_image']==1){
	//$files_array.="<li><img src='/images/".$file_extension.".gif' id=w_".$rs['file_id']." onclick='_fbj.tj(this)'><a href='/downfile.php?id=".$rs['file_id']."&userid=".$pd_uid."' title='上传时间:".$file_time."' class=wj target=_blank style='color:blue'>".$file_name." ".$file_size."</a> <a href='/filestores/".$real_name."' target='_blank'>查看</a><font>".$rs['file_description']."</font></a></li>";
	$files_array.="<li><img src='/images/".$file_extension.".gif' id=w_".$rs['file_id']." onclick='_fbj.tj(this)'><a href='/downfile.php?id=".$rs['file_id']."&userid=".$pd_uid."' title='上传时间:".$file_time."' class=wj target=_blank style='".$style."'>".$file_name." ".$file_size."</a><a href='/up/".$real_name."' class=yyck target='_blank'>查看</a><font>".$rs['file_description']."</font></li>";
	
	}elseif($rs['is_image']==2){
		if(substr($rs['file_description'],0,4)=="http"){
			//$files_array.="<li><img src='/images/url.gif' id=u_".$rs['file_id']." onclick='_fbj.tj(this)'><a href='/filestores/".$real_name."' title='上传时间:".$file_time."' class=wj target=_blank style='color:blue'>".$file_name." ".$file_size."</a><a href='javascript:' class=yyck onclick='show(this)'>打开</a><font>".$rs['file_description']."</font></a></li>";
			$files_array.="<li><img src='/images/url.gif' id='u_".$rs['file_id']."' onclick='_fbj.tj(this)'><a href='".$rs['file_description']."' style='".$style."' target=_blank class=lj>".$file_name."</a></li>";
		}else{
			//$files_array.="<li><img src='/images/wj.gif' id=t_".$rs['file_id']." onclick='_fbj.tj(this)'><a href='/filestores/".$real_name."' title='上传时间:".$file_time."' class=wj target=_blank style='color:blue'>".$file_name." ".$file_size."</a><a href='javascript:' class=yyck onclick='show(this)'>打开</a><font>".$rs['file_description']."</font></a></li>";
			$files_array.="<li><img src='/images/wj.gif' $editable  id='t_".$rs['file_id']."' onclick='_fbj.tj(this)'><span title='上传时间:".$file_time."' style='".$style."'>".$file_name."</span><font>".$rs['file_description']."</font></li>";
		}
	}
	elseif($rs['file_extension']=="txt"){
	//$files_array.="<li><img src='/images/".$file_extension.".gif' id=w_".$rs['file_id']." onclick='_fbj.tj(this)'><a href='/downfile.php?id=".$rs['file_id']."&userid=".$pd_uid."' title='上传时间:".$file_time."' class=wj target=_blank style='color:blue'>".$file_name." ".$file_size."</a> <a href='/filestores/".$real_name."' class=yyck target='_blank' >打开</a><font>".$rs['file_description']."</font></li>";
	
	$files_array.="<li><img src='/images/".$file_extension.".gif' id=w_".$rs['file_id']." onclick='_fbj.tj(this)'><a href='/downfile.php?id=".$rs['file_id']."&userid=".$pd_uid."' title='上传时间:".$file_time."' class=wj target=_blank style='".$style."'>".$file_name." ".$file_size."</a><a href='/up/".$real_name."' class=yyck onclick='show(this)'>打开</a><font>".$rs['file_description']."</font></li>";
	
	}else{
	$files_array.="<li><img src='/images/".$file_extension.".gif' id=w_".$rs['file_id']." onclick='_fbj.tj(this)'><a href='/downfile.php?id=".$rs['file_id']."&userid=".$pd_uid."' title='上传时间:".$file_time."' class=wj target=_blank style='".$style."'>".$file_name." ".$file_size."</a><font>".$rs['file_description']."</font></li>";
	}
	
}
$db->free($q);
unset($rs);
return $files_array;
}



?>



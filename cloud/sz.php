<?php

if( $_SERVER['HTTP_REFERER'] == "" ){
header("");
echo '<script type="text/javascript">window.location.href="/"</script>'; 
exit('错误');}

include "includes/commons.inc.php";

phpdisk_core::user_login();
$in_front = true;
define('IN_MYDISK' ,true);
$title = '空间管理 '.$settings['site_title'];
$diskurl =$settings['phpdisk_url'];
include PHPDISK_ROOT.'includes/header.inc.php';
$act = trim(gpc('act','G',''));

$userinfo= @$db->fetch_one_array("select * from {$tpf}users where userid='$pd_uid'");
$diskinfo= @$db->fetch_one_array("select * from {$tpf}groups where gid=".$userinfo['gid']);

//print_r($diskinfo);
if($act =='index'){
require_once template_echo('sz_index',$user_tpl_dir);


}elseif($act =='szcg'){
$t1 = trim(gpc('t1','P',''));
$t3 = trim(gpc('t3','P',''));

$seo1 = trim(gpc('seo1','P',''));
$seo2 = trim(gpc('seo2','P',''));
$seo3 = trim(gpc('seo3','P',''));

$sql = "update {$tpf}users set t1='$t1',t3='$t3',seo1='$seo1',seo2='$seo2',seo3='$seo3' where userid='$pd_uid'";

$db->query_unbuffered($sql);
echo '<script type="text/javascript">alert("操作成功!");window.location.href="/sz.php?act=index"</script>';
}

elseif($act=='qx'){
require_once template_echo('sz_qx',$user_tpl_dir);
}
elseif($act=="qxs"){
$ly = trim(gpc('ly','P',''));
$xz = trim(gpc('xz','P',''));
$ml = trim(gpc('ml','P',''));
$sc = trim(gpc('sc','P',''));
$sql = "update {$tpf}users set ly='$ly',xz='$xz',ml='$ml',sc='$sc' where userid='$pd_uid'";
$db->query_unbuffered($sql);
echo '<script type="text/javascript">alert("操作成功!");window.location.href="/sz.php?act=qx"</script>';
}
elseif($act=='lj'){
$userlk= $db->query("select * from {$tpf}userlinks where userid='$pd_uid'");
require_once template_echo('sz_lj',$user_tpl_dir);
}
elseif($act=="lja"){
$ljmc = trim(gpc('ljmc','P',''));
$ljdz = trim(gpc('ljdz','P',''));
$ins = array(
'userid' => $pd_uid,
'linku' => $ljdz,
'linkt' => $ljmc
);

$db->query("insert into {$tpf}userlinks set ".$db->sql_array($ins).";");
echo '<script type="text/javascript">alert("操作成功!");window.location.href="/sz.php?act=lj"</script>';

}
elseif($act=="lid"){
$id = trim(gpc('id','G',''));
$db->query("delete from {$tpf}userlinks where id=$id and userid='$pd_uid'");
echo '<script type="text/javascript">alert("操作成功!");window.location.href="/sz.php?act=lj"</script>';

}
elseif($act=="lke"){
$id = trim(gpc('id','G',''));
$userlinkse=$db->fetch_one_array("select * from {$tpf}userlinks where id=$id and userid='$pd_uid'");
require_once template_echo('sz_lje',$user_tpl_dir);
}
elseif($act=="lkedit"){
$id = trim(gpc('id','P',''));
$ljmc = trim(gpc('ljmc','P',''));
$ljdz = trim(gpc('ljdz','P',''));

$db->query("update {$tpf}userlinks set linku='$ljdz',linkt='$ljmc' where id=$id and userid='$pd_uid'");
echo '<script type="text/javascript">alert("操作成功!");window.location.href="/sz.php?act=lj"</script>';

}


elseif($act=="px"){
require_once template_echo('sz_px',$user_tpl_dir);
}

elseif($act=="pxe"){
$aa = trim(gpc('aa','P',''));
$sql = "update {$tpf}users set mlpx='$aa' where userid='$pd_uid'";
$db->query_unbuffered($sql);
echo '<script type="text/javascript">alert("操作成功!");window.location.href="/sz.php?act=px"</script>';
}


elseif($act=="fg"){
require_once template_echo('sz_fg',$user_tpl_dir);
}

elseif($act=="fge"){
$rsd = trim(gpc('rsd','P',''));
$sql = "update {$tpf}users set kjfg='$rsd' where userid='$pd_uid'";
$db->query_unbuffered($sql);
echo '<script type="text/javascript">alert("操作成功!");window.location.href="/sz.php?act=fg"</script>';
}


elseif($act=="zl"){
require_once template_echo('sz_zl',$user_tpl_dir);
}

elseif($act=="zle"){
$zl_te1 = trim(gpc('zl_te1','P',''));
$zl_te3 = trim(gpc('zl_te3','P',''));
$zl_teqq = trim(gpc('zl_teqq','P',''));
$zl_te4 = trim(gpc('zl_te4','P',''));
$zl_tesfz = trim(gpc('zl_tesfz','P',''));
$email = trim(gpc('email','P',''));

$sql = "update {$tpf}users set email='$email',zl_te1='$zl_te1',zl_te3='$zl_te3',zl_teqq='$zl_teqq',zl_te4='$zl_te4',zl_tesfz='$zl_tesfz' where userid='$pd_uid'";
$db->query_unbuffered($sql);
echo '<script type="text/javascript">alert("操作成功!");window.location.href="/sz.php?act=zl"</script>';
}


else{
	redirect("sz.php?act=index",'',0);
}

include PHPDISK_ROOT."./includes/footer.inc.php";

?>



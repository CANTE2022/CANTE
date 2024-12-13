-- phpMyAdmin SQL Dump
-- version 4.0.6-rc1
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2016-09-18 22:44:34
-- 服务器版本: 5.5.19
-- PHP 版本: 5.2.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `install`
--

-- --------------------------------------------------------

--
-- 表的结构 `epan_adminsession`
--

CREATE TABLE IF NOT EXISTS `epan_adminsession` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `userid` int(10) unsigned NOT NULL DEFAULT '0',
  `login_time` int(10) unsigned NOT NULL DEFAULT '0',
  `hashcode` char(9) NOT NULL,
  `ip` varchar(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

-- --------------------------------------------------------

--
-- 表的结构 `epan_advertisements`
--

CREATE TABLE IF NOT EXISTS `epan_advertisements` (
  `advid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `adv_type` varchar(30) NOT NULL,
  `adv_position` varchar(50) NOT NULL,
  `params` text NOT NULL,
  `code` text NOT NULL,
  `show_order` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `starttime` int(10) unsigned NOT NULL DEFAULT '0',
  `endtime` int(10) unsigned NOT NULL DEFAULT '0',
  `is_hidden` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`advid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `epan_announces`
--

CREATE TABLE IF NOT EXISTS `epan_announces` (
  `annid` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `userid` int(10) unsigned NOT NULL DEFAULT '0',
  `subject` varchar(100) NOT NULL,
  `content` text NOT NULL,
  `show_order` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `is_hidden` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `is_expand` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `in_time` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`annid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `epan_buddys`
--

CREATE TABLE IF NOT EXISTS `epan_buddys` (
  `bdid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `userid` int(10) unsigned NOT NULL DEFAULT '0',
  `touserid` int(10) unsigned NOT NULL DEFAULT '0',
  `in_time` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`bdid`),
  KEY `userid` (`userid`),
  KEY `touserid` (`touserid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `epan_categories`
--

CREATE TABLE IF NOT EXISTS `epan_categories` (
  `cate_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pid` int(10) unsigned NOT NULL DEFAULT '0',
  `cate_name` varchar(50) NOT NULL,
  `cate_size` int(10) unsigned NOT NULL DEFAULT '0',
  `show_order` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `is_hidden` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`cate_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `epan_comments`
--

CREATE TABLE IF NOT EXISTS `epan_comments` (
  `cmt_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `file_id` varchar(20) NOT NULL,
  `file_key` char(8) NOT NULL,
  `content` text NOT NULL,
  `userid` int(10) unsigned NOT NULL DEFAULT '0',
  `is_checked` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `in_time` int(10) unsigned NOT NULL DEFAULT '0',
  `ip` varchar(15) NOT NULL,
  PRIMARY KEY (`cmt_id`),
  KEY `userid` (`userid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `epan_cp_shortcut`
--

CREATE TABLE IF NOT EXISTS `epan_cp_shortcut` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `url` varchar(255) NOT NULL,
  `title` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- 转存表中的数据 `epan_cp_shortcut`
--

INSERT INTO `epan_cp_shortcut` (`id`, `url`, `title`) VALUES
(1, 'item=users&menu=user&action=index', '用户列表'),
(2, 'item=templates&menu=lang_tpl', '模板名称'),
(3, 'item=database&menu=tool&action=optimize', '优化数据库');

-- --------------------------------------------------------

--
-- 表的结构 `epan_datacalls`
--

CREATE TABLE IF NOT EXISTS `epan_datacalls` (
  `dcid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `c_key` varchar(255) NOT NULL,
  `c_value` mediumtext NOT NULL,
  PRIMARY KEY (`dcid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `epan_disk2user`
--

CREATE TABLE IF NOT EXISTS `epan_disk2user` (
  `duid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `userid` int(10) unsigned NOT NULL DEFAULT '0',
  `disk_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `starttime` int(10) unsigned NOT NULL DEFAULT '0',
  `endtime` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`duid`),
  KEY `userid` (`userid`),
  KEY `diskid` (`disk_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `epan_disks`
--

CREATE TABLE IF NOT EXISTS `epan_disks` (
  `disk_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `logo` varchar(250) NOT NULL,
  `space` varchar(50) NOT NULL,
  `price` int(10) unsigned NOT NULL DEFAULT '0',
  `expire` smallint(5) unsigned NOT NULL DEFAULT '0',
  `show_order` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `is_hidden` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`disk_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `epan_download`
--

CREATE TABLE IF NOT EXISTS `epan_download` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `downtime` int(11) NOT NULL,
  `ip` varchar(100) NOT NULL,
  `wenjian` varchar(100) NOT NULL,
  `dx` varchar(100) NOT NULL,
  `userid` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- 表的结构 `epan_extracts`
--

CREATE TABLE IF NOT EXISTS `epan_extracts` (
  `extract_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `userid` int(10) unsigned NOT NULL DEFAULT '0',
  `extract_code` varchar(16) NOT NULL,
  `extract_file_ids` text NOT NULL,
  `extract_total` smallint(5) unsigned NOT NULL DEFAULT '0',
  `extract_count` smallint(5) unsigned NOT NULL DEFAULT '0',
  `extract_time` int(10) unsigned NOT NULL DEFAULT '0',
  `extract_type` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `extract_locked` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `in_time` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`extract_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `epan_file2tag`
--

CREATE TABLE IF NOT EXISTS `epan_file2tag` (
  `ftid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `tag_name` varchar(30) NOT NULL,
  `file_id` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`ftid`),
  KEY `tag_name` (`tag_name`),
  KEY `file_id` (`file_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `epan_files`
--

CREATE TABLE IF NOT EXISTS `epan_files` (
  `file_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `file_name` varchar(100) NOT NULL,
  `file_key` char(8) NOT NULL,
  `file_short_url` char(6) NOT NULL,
  `file_extension` varchar(10) NOT NULL,
  `is_image` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `file_mime` varchar(50) NOT NULL,
  `file_description` text NOT NULL,
  `file_store_path` varchar(50) NOT NULL,
  `file_real_name` varchar(255) NOT NULL,
  `file_md5` char(32) NOT NULL,
  `server_oid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `store_old` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `file_size` int(10) unsigned NOT NULL DEFAULT '0',
  `thumb_size` int(10) unsigned NOT NULL DEFAULT '0',
  `file_time` int(10) unsigned NOT NULL DEFAULT '0',
  `file_views` int(10) unsigned DEFAULT '0',
  `file_downs` int(10) unsigned NOT NULL DEFAULT '0',
  `file_last_view` int(10) unsigned DEFAULT '0',
  `file_credit` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `report_status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `in_share` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `space_pos` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `good_count` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `bad_count` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `is_locked` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `is_checked` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `is_public` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `userid` int(10) unsigned NOT NULL DEFAULT '0',
  `folder_id` bigint(20) NOT NULL DEFAULT '0',
  `cate_id` int(10) unsigned NOT NULL DEFAULT '0',
  `subcate_id` int(10) unsigned NOT NULL DEFAULT '0',
  `in_recycle` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `ip` varchar(15) NOT NULL,
  PRIMARY KEY (`file_id`),
  KEY `userid` (`userid`),
  KEY `folder_id` (`folder_id`),
  KEY `server_id` (`server_oid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- 表的结构 `epan_folders`
--

CREATE TABLE IF NOT EXISTS `epan_folders` (
  `folder_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` bigint(20) NOT NULL DEFAULT '0',
  `folder_node` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `folder_name` varchar(50) NOT NULL,
  `folder_description` varchar(255) NOT NULL,
  `in_recycle` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `in_share` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `folder_order` smallint(5) unsigned NOT NULL DEFAULT '0',
  `folder_size` int(10) unsigned NOT NULL DEFAULT '0',
  `userid` int(10) unsigned NOT NULL DEFAULT '0',
  `in_time` int(10) unsigned NOT NULL DEFAULT '0',
  `password` varchar(100) DEFAULT NULL,
  `fileorder` varchar(6) NOT NULL DEFAULT '011000',
  PRIMARY KEY (`folder_id`),
  KEY `userid` (`userid`),
  KEY `parent_id` (`parent_id`),
  KEY `folder_node` (`folder_node`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

-- --------------------------------------------------------

--
-- 表的结构 `epan_gallery`
--

CREATE TABLE IF NOT EXISTS `epan_gallery` (
  `gal_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `gal_path` varchar(200) NOT NULL,
  `gal_title` varchar(150) NOT NULL,
  `go_url` varchar(200) NOT NULL,
  `gal_target` varchar(10) NOT NULL,
  `show_order` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `is_hidden` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`gal_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `epan_groups`
--

CREATE TABLE IF NOT EXISTS `epan_groups` (
  `gid` tinyint(3) unsigned NOT NULL,
  `group_type` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `group_name` varchar(50) NOT NULL,
  `max_messages` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `max_flow_down` varchar(20) NOT NULL DEFAULT '0',
  `max_flow_view` varchar(20) NOT NULL DEFAULT '0',
  `max_storage` varchar(20) NOT NULL DEFAULT '0',
  `group_file_types` varchar(150) NOT NULL,
  `max_filesize` varchar(20) NOT NULL DEFAULT '0',
  `max_folders` int(10) unsigned NOT NULL DEFAULT '0',
  `max_files` int(10) unsigned NOT NULL DEFAULT '0',
  `can_share` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `secs_loading` smallint(5) unsigned NOT NULL DEFAULT '0',
  `server_ids` varchar(30) NOT NULL,
  `jg_yy` int(11) DEFAULT '0',
  `jg_bn` int(11) DEFAULT '0',
  `jg_yn` int(11) DEFAULT '0',
  `jg_ln` int(11) DEFAULT '0',
  `jb` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`gid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `epan_groups`
--

INSERT INTO `epan_groups` (`gid`, `group_type`, `group_name`, `max_messages`, `max_flow_down`, `max_flow_view`, `max_storage`, `group_file_types`, `max_filesize`, `max_folders`, `max_files`, `can_share`, `secs_loading`, `server_ids`, `jg_yy`, `jg_bn`, `jg_yn`, `jg_ln`, `jb`) VALUES
(1, 1, '系统管理员', 0, '0', '0', '2222M', 'jpg,jpeg,bmp,png,gif,zip,rar,txt,doc,dll,db,htm,wav,fla,wmv,swf,mp3,mp4,rmvb,mov,avi,exe,torrent,ani,cur,ico,js,css,chm,ppt,pdf,psd,xls,xml,xsl', '500m', 100, 100, 1, 5, '', 0, 0, 0, 0, 0),
(2, 1, '标准型', 0, '', '', '2000M', 'jpg,jpeg,bmp,png,gif,zip,rar,txt,doc,dll,db,htm,wav,fla,wmv,swf,mp3,mp4,rmvb,mov,avi,exe,torrent,ani,cur,ico,js,css,chm,ppt,pdf,psd,xls,xml,xsl', '', 100, 100, 1, 0, '0', 2, 12, 24, 30, 2),
(3, 1, '个人型', 0, '0', '0', '1000M', 'jpg,jpeg,bmp,png,gif,zip,rar,txt,doc,dll,db,htm,wav,fla,wmv,swf,mp3,mp4,rmvb,mov,avi,exe,torrent,ani,cur,ico,js,css,chm,ppt,pdf,psd,xls,xml,xsl', '0', 100, 100, 1, 0, '0', 1, 6, 10, 20, 1),
(4, 1, '免费型空间', 0, '0', '0', '300M', 'jpg,jpeg,bmp,png,gif,zip,rar,txt,doc,dll,db,htm,wav,fla,wmv,swf,mp3,mp4,rmvb,mov,avi,exe,torrent,ani,cur,ico,js,css,chm,ppt,pdf,psd,xls,xml,xsl', '0', 100, 100, 1, 0, '0', 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `epan_invitelog`
--

CREATE TABLE IF NOT EXISTS `epan_invitelog` (
  `bdid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `userid` int(10) unsigned NOT NULL DEFAULT '0',
  `touserid` int(10) unsigned NOT NULL DEFAULT '0',
  `in_time` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`bdid`),
  KEY `userid` (`userid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `epan_langs`
--

CREATE TABLE IF NOT EXISTS `epan_langs` (
  `lang_name` varchar(30) NOT NULL,
  `actived` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`lang_name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `epan_links`
--

CREATE TABLE IF NOT EXISTS `epan_links` (
  `linkid` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `url` varchar(100) NOT NULL,
  `logo` varchar(200) NOT NULL,
  `show_order` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `is_hidden` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`linkid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `epan_messages`
--

CREATE TABLE IF NOT EXISTS `epan_messages` (
  `msgid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `reply_id` int(11) unsigned NOT NULL DEFAULT '0',
  `userid` int(10) unsigned NOT NULL DEFAULT '0',
  `touserid` int(10) unsigned NOT NULL DEFAULT '0',
  `content` text NOT NULL,
  `is_new` tinyint(1) NOT NULL,
  `in_sendbox` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `is_del` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `is_reply` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `in_time` int(10) unsigned NOT NULL,
  PRIMARY KEY (`msgid`),
  KEY `touserid` (`touserid`),
  KEY `userid` (`userid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `epan_navigations`
--

CREATE TABLE IF NOT EXISTS `epan_navigations` (
  `navid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `text` varchar(30) NOT NULL,
  `title` varchar(50) NOT NULL,
  `href` varchar(80) NOT NULL,
  `target` varchar(10) NOT NULL,
  `position` varchar(10) NOT NULL,
  `show_order` tinyint(3) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`navid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- 表的结构 `epan_oline`
--

CREATE TABLE IF NOT EXISTS `epan_oline` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `ip` varchar(100) NOT NULL,
  `intime` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=60 ;

-- --------------------------------------------------------

--
-- 表的结构 `epan_orders`
--

CREATE TABLE IF NOT EXISTS `epan_orders` (
  `order_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `pay_method` varchar(10) NOT NULL,
  `userid` int(10) unsigned NOT NULL DEFAULT '0',
  `order_number` varchar(50) NOT NULL,
  `total_fee` float unsigned NOT NULL DEFAULT '0',
  `pay_status` varchar(10) NOT NULL,
  `retcode` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `in_time` int(10) unsigned NOT NULL DEFAULT '0',
  `ip` varchar(15) NOT NULL,
  PRIMARY KEY (`order_id`),
  KEY `pay_method` (`pay_method`),
  KEY `userid` (`userid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- 表的结构 `epan_plugins`
--

CREATE TABLE IF NOT EXISTS `epan_plugins` (
  `plugin_name` varchar(100) NOT NULL,
  `actived` tinyint(1) NOT NULL DEFAULT '0',
  `action_time` int(10) unsigned NOT NULL DEFAULT '0',
  `in_shortcut` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`plugin_name`),
  KEY `in_shortcut` (`in_shortcut`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `epan_plugins`
--

INSERT INTO `epan_plugins` (`plugin_name`, `actived`, `action_time`, `in_shortcut`) VALUES
('api', 0, 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `epan_replys`
--

CREATE TABLE IF NOT EXISTS `epan_replys` (
  `rpid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `tid` int(11) unsigned NOT NULL DEFAULT '0',
  `userid` int(10) NOT NULL,
  `content` text NOT NULL,
  `is_best` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `in_time` int(10) unsigned NOT NULL DEFAULT '0',
  `ip` varchar(15) NOT NULL,
  PRIMARY KEY (`rpid`),
  KEY `tid` (`tid`),
  KEY `userid` (`userid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `epan_reports`
--

CREATE TABLE IF NOT EXISTS `epan_reports` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `file_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `file_key` char(8) NOT NULL,
  `content` varchar(255) NOT NULL,
  `userid` int(10) unsigned NOT NULL DEFAULT '0',
  `is_new` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `in_time` int(10) unsigned NOT NULL DEFAULT '0',
  `ip` varchar(15) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `userid` (`userid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `epan_search_index`
--

CREATE TABLE IF NOT EXISTS `epan_search_index` (
  `searchid` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(10) unsigned NOT NULL DEFAULT '0',
  `scope` varchar(6) NOT NULL,
  `word` varchar(200) NOT NULL,
  `search_time` int(10) NOT NULL DEFAULT '0',
  `total_count` smallint(6) NOT NULL DEFAULT '0',
  `file_ids` text NOT NULL,
  `ip` varchar(15) NOT NULL,
  PRIMARY KEY (`searchid`),
  KEY `userid` (`userid`),
  KEY `scope` (`scope`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `epan_servers`
--

CREATE TABLE IF NOT EXISTS `epan_servers` (
  `server_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `server_oid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `server_name` varchar(50) NOT NULL,
  `server_host` varchar(100) NOT NULL,
  `server_closed` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `server_store_path` varchar(50) NOT NULL,
  `server_key` varchar(50) NOT NULL,
  `ftp_host` varchar(50) NOT NULL,
  `ftp_port` varchar(10) NOT NULL,
  `ftp_user` varchar(20) NOT NULL,
  `ftp_pass` varchar(20) NOT NULL,
  `ftp_ssl` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `ftp_pasv` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `ftp_path` varchar(30) NOT NULL,
  `ftp_closed` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`server_id`),
  KEY `server_oid` (`server_oid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- 表的结构 `epan_settings`
--

CREATE TABLE IF NOT EXISTS `epan_settings` (
  `vars` varchar(100) NOT NULL,
  `value` text NOT NULL,
  PRIMARY KEY (`vars`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `epan_settings`
--

INSERT INTO `epan_settings` (`vars`, `value`) VALUES
('site_title', '伍六Ｅ盘'),
('phpdisk_url', 'http://56wl.net/'),
('file_path', 'up'),
('max_file_size', '500MB'),
('perpage', '20'),
('gzipcompress', '1'),
('allow_access', '1'),
('allow_register', '1'),
('close_access_reason', '系统维护中...'),
('close_register_reason', '系统暂时关闭注册...'),
('meta_keywords', '伍六Ｅ盘（pan.56wl.net）_网络存储系统'),
('meta_description', '伍六Ｅ盘（pan.56wl.net）_网络存储系统'),
('site_stat', ''),
('miibeian', ''),
('contact_us', 'admin@56wl.net'),
('credit_convert', '1'),
('user_active', '0'),
('debug_info', '1'),
('open_demo_login', '0'),
('open_share', '1'),
('open_link', '1'),
('open_link_domain', '*.56wl.net|www.56wl.net|'),
('report_word', 'bat,sh'),
('encrypt_key', 'd6rJzbWbRZo9'),
('register_verycode', '0'),
('login_verycode', '0'),
('open_seo', '1'),
('version_info', '1'),
('email_address', 'admin@56wl.net'),
('email_pwd', 'mima'),
('email_user', '伍六Ｅ盘'),
('email_smtp', 'smtp.qq.com'),
('email_port', '25'),
('email_ssl', '0'),
('open_rewrite', '0'),
('credit_invite', '6'),
('credit_reg', '10'),
('credit_login', '2'),
('credit_msg', '1'),
('credit_upload', '3'),
('credit_down', '2'),
('credit_open', '0'),
('login_down_file', '0'),
('online_demo', '0'),
('credit_down_my', '1'),
('filter_extension', 'asp,php,asa,aspx,ascx,dtd,xsd,xsl,xslt,as,wml,java,vtm,vtml,jst,asr,php,php3,php4,php5,vb,vbs,jsf,jsp,pl,cgi,js,html,htm,xhtml,xml,css,shtm,cfm,cfml,shtml,bat,sh'),
('open_thunder', '0'),
('thunder_pid', ''),
('open_flashget', '0'),
('flashget_uid', ''),
('connect_uc', '0'),
('uc_charset', 'utf-8'),
('uc_dbname', 'ultrax'),
('uc_dbtablepre', 'pre_ucenter_'),
('uc_appid', '2'),
('uc_key', 'phpdisk_dx15_uc'),
('uc_api', 'http://localhost/x15/uc_server'),
('uc_feed', '1'),
('uc_credit_exchange', '1'),
('uc_dbcharset', 'utf8'),
('thumb_width', '120'),
('thumb_height', '90'),
('check_comment', '1'),
('secs_loading', '10'),
('true_link', '0'),
('true_link_extension', ''),
('open_verycode', '0'),
('verycode_type', '2'),
('forget_verycode', '0'),
('open_tag', '1'),
('open_comment', '1'),
('open_vote', '1'),
('open_file_url', '1'),
('open_report', '1'),
('viewfile_keyword', ''),
('powered_info', '0'),
('uc_admin', 'admin'),
('uc_dbhost', 'localhost'),
('uc_dbuser', 'root'),
('uc_dbpwd', 'passwd'),
('store_true_filename', '0'),
('open_plugins_cp', '1'),
('open_credit_convert', '0'),
('open_multi_server', '0'),
('show_index', '1'),
('show_public', '1'),
('open_email', '1'),
('open_plugins_last', '1'),
('connect_uc_type', 'discuz'),
('open_file_preview', '0'),
('open_file_extract_code', '0'),
('open_file_outlink', '0'),
('open_file_shorturl', '0'),
('downfile_directly', '0'),
('open_gallery_index', '1'),
('gallery_type', '1'),
('gallery_size_width', '650'),
('gallery_size_height', '200'),
('open_autoupdate', '0'),
('downfile_stat_time', '3600'),
('create_default_folder', ''),
('default_amount', '10'),
('show_relative_file', '0'),
('wealth_reg', '0'),
('wealth_login', '0'),
('wealth_invite', '0'),
('wealth_msg', '0'),
('wealth_upload', '0'),
('wealth_down', '0'),
('wealth_down_my', '0'),
('exp_reg', '20'),
('exp_login', '2'),
('exp_invite', '6'),
('exp_msg', '1'),
('exp_upload', '3'),
('exp_down', '2'),
('exp_down_my', '1'),
('credit_union', '积分'),
('wealth_union', '金钱'),
('exp_union', '经验'),
('exp_const', '50'),
('show_stat_index', '0'),
('invite_register_encode', '0'),
('share_tool', ''),
('file_to_public_checked', '0'),
('secs_for_user', '0'),
('global_secs_loading', ''),
('show_hot_file_right', '0'),
('all_file_share', '0'),
('footer', '&lt;br/&gt;Copyright© 2015-2016 伍六Ｅ盘（pan.56wl.net）_网络存储系统 伍六Ｅ盘工作室版权所有，并保留所有权利 &lt;script src=&quot;https://s4.cnzz.com/z_stat.php?id=1256185585&amp;web_id=1256185585&quot; language=&quot;JavaScript&quot;&gt;&lt;/script&gt;&lt;br&gt;\n&lt;br&gt;'),
('khlb', '上海致逸建筑设计有限公司&lt;br/&gt;\n上海日清景观设计有限公司&lt;br/&gt;\n武汉市建筑设计院建筑空间&lt;br/&gt;\n荆州市晴川建筑设计院有限公司&lt;br/&gt;\n上海新建设建筑设计有限公司&lt;br/&gt;\n上海印象空间数码科技有限公司&lt;br/&gt;\n浙江绿城东方建筑设计有限公司&lt;br/&gt;\n南京水晶石数字科技有限公司&lt;br/&gt;\n上海广亩景观设计咨询有限公司&lt;br/&gt;\n上海现代设计集团&lt;br/&gt;\n浙江昌盛电气有限公司&lt;br/&gt;\n大化县财政局&lt;br/&gt;\n河池市财政局&lt;br/&gt;\n云和县安监局&lt;br/&gt;\n邮储银行上海浦东新区南汇支行&lt;br/&gt;\n上海邮政速递物流公司&lt;br/&gt;\n奉贤区邮政局&lt;br/&gt;\n上海市清洁生产中心&lt;br/&gt;\n湟中县教育局&lt;br/&gt;\n广州市番禺区象贤中学&lt;br/&gt;\n广西武宣县中学&lt;br/&gt;\n广州市花都区教育局花山教育指导中心&lt;br/&gt;\n妮梦衣服饰&lt;br/&gt;\n上海沐海服饰有限公司&lt;br/&gt;\n我衣我秀中国服饰代理分销总站&lt;br/&gt;\n广州市纤婷服饰有限公司&lt;br/&gt;\n风尚服饰批发&lt;br/&gt;\n南方服装网&lt;br/&gt;\n杭州恩娴服饰有限公司&lt;br/&gt;\n千鸿网络鞋店&lt;br/&gt;\n万辉服装&lt;br/&gt;\n轩氏邦服饰&lt;br/&gt;\n酷依家男装网&lt;br/&gt;\n北京华夏顺泽投资集团&lt;br/&gt;\n盐城中南世纪城房地产投资有限公司&lt;br/&gt;\n华润置地工程管理部&lt;br/&gt;\n乐品品牌策划（北京）有限公司&lt;br/&gt;\n广州搏智广告有限公司&lt;br/&gt;\n长春君地房地产开发有限公司&lt;br/&gt;\n广东奥马电器股份有限公司&lt;br/&gt;\n雅善贸易（上海）有限公司&lt;br/&gt;\n上海今尚数码科技有限公司&lt;br/&gt;\n中信建投证券&lt;br/&gt;\n光大证券&lt;br/&gt;\n南通中南新世界中心开发有限公司&lt;br/&gt;\n南京艺景数字科技有限公司&lt;br/&gt;\n上海鼎为软件技术有限公司&lt;br/&gt;'),
('syxx', '公告'),
('contact1', 'Email：www@56wl.net&lt;br/&gt;Email：admin@56wl.net'),
('active_verycode', '0');

-- --------------------------------------------------------

--
-- 表的结构 `epan_stats`
--

CREATE TABLE IF NOT EXISTS `epan_stats` (
  `vars` varchar(50) NOT NULL,
  `value` varchar(50) NOT NULL,
  PRIMARY KEY (`vars`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `epan_stats`
--

INSERT INTO `epan_stats` (`vars`, `value`) VALUES
('user_folders_count', '0'),
('user_files_count', '0'),
('users_count', '1'),
('users_locked_count', '0'),
('extract_code_count', '0'),
('all_files_count', '0'),
('user_storage_count', '0.0B'),
('public_storage_count', '0.0B'),
('total_storage_count', '0.0B'),
('users_open_count', '1'),
('stat_time', '1433912747');

-- --------------------------------------------------------

--
-- 表的结构 `epan_tags`
--

CREATE TABLE IF NOT EXISTS `epan_tags` (
  `tag_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `tag_name` varchar(30) NOT NULL,
  `tag_count` int(10) unsigned NOT NULL DEFAULT '0',
  `is_hidden` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`tag_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- 表的结构 `epan_templates`
--

CREATE TABLE IF NOT EXISTS `epan_templates` (
  `tpl_name` varchar(50) NOT NULL,
  `actived` tinyint(1) unsigned NOT NULL,
  `tpl_type` varchar(30) NOT NULL,
  PRIMARY KEY (`tpl_name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `epan_templates`
--

INSERT INTO `epan_templates` (`tpl_name`, `actived`, `tpl_type`) VALUES
('admin', 1, 'admin'),
('default', 0, 'user'),
('disk', 1, 'user');

-- --------------------------------------------------------

--
-- 表的结构 `epan_topics`
--

CREATE TABLE IF NOT EXISTS `epan_topics` (
  `tid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `userid` int(10) unsigned NOT NULL DEFAULT '0',
  `credit` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `subject` varchar(100) NOT NULL,
  `content` text NOT NULL,
  `is_closed` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `in_time` int(10) unsigned NOT NULL DEFAULT '0',
  `ip` varchar(15) NOT NULL,
  PRIMARY KEY (`tid`),
  KEY `userid` (`userid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `epan_userlinks`
--

CREATE TABLE IF NOT EXISTS `epan_userlinks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) DEFAULT NULL,
  `linkt` text,
  `linku` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

-- --------------------------------------------------------

--
-- 表的结构 `epan_users`
--

CREATE TABLE IF NOT EXISTS `epan_users` (
  `userid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(64) NOT NULL,
  `password` varchar(32) NOT NULL,
  `email` varchar(255) NOT NULL,
  `gid` tinyint(3) unsigned DEFAULT '0',
  `reset_code` varchar(32) NOT NULL,
  `is_activated` tinyint(1) DEFAULT '0',
  `is_locked` tinyint(1) DEFAULT '0',
  `last_login_time` int(11) DEFAULT '0',
  `last_login_ip` varchar(15) NOT NULL,
  `reg_time` int(10) unsigned DEFAULT '0',
  `reg_ip` varchar(15) NOT NULL,
  `credit` int(10) unsigned NOT NULL DEFAULT '0',
  `wealth` float NOT NULL DEFAULT '0',
  `rank` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `exp` smallint(5) unsigned NOT NULL DEFAULT '0',
  `accept_pm` tinyint(1) DEFAULT '1',
  `show_email` tinyint(1) DEFAULT '0',
  `space_pos` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `user_file_types` varchar(150) NOT NULL,
  `user_store_space` varchar(30) NOT NULL,
  `user_rent_space` varchar(30) NOT NULL,
  `space_day_credits` float NOT NULL,
  `down_flow_count` varchar(20) NOT NULL DEFAULT '0',
  `view_flow_count` varchar(20) NOT NULL DEFAULT '0',
  `flow_reset_time` int(10) unsigned NOT NULL DEFAULT '0',
  `max_flow_down` varchar(30) NOT NULL,
  `max_flow_view` varchar(30) NOT NULL,
  `t1` varchar(1000) DEFAULT NULL,
  `t3` varchar(6000) DEFAULT NULL,
  `ly` int(11) NOT NULL DEFAULT '0',
  `xz` int(11) NOT NULL DEFAULT '0',
  `ml` int(11) NOT NULL DEFAULT '0',
  `sc` int(11) NOT NULL DEFAULT '0',
  `mlpx` int(11) NOT NULL DEFAULT '2',
  `kjfg` int(11) NOT NULL DEFAULT '5',
  `zl_te1` text,
  `zl_te3` text,
  `zl_teqq` text,
  `zl_te4` text,
  `zl_tesfz` text,
  `dlmm` text,
  `wen1` text,
  `daan1` text,
  `wen2` text,
  `daan2` text,
  `dqlq` int(11) DEFAULT NULL,
  `allcount` int(11) NOT NULL DEFAULT '0',
  `dqsj` int(11) DEFAULT '0',
  `seo1` text,
  `seo2` text,
  `seo3` text,
  PRIMARY KEY (`userid`),
  KEY `username` (`username`),
  KEY `gid` (`gid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- 表的结构 `epan_xiaofei`
--

CREATE TABLE IF NOT EXISTS `epan_xiaofei` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `xfname` varchar(100) NOT NULL,
  `je` int(11) NOT NULL,
  `outtime` int(11) NOT NULL,
  `intime` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

CREATE TABLE `wdja_aboutus` (
  `abid` int NOT NULL AUTO_INCREMENT,
  `ab_topic` varchar(50) DEFAULT NULL,
  `ab_titles` varchar(250) DEFAULT NULL,
  `ab_keywords` varchar(252) DEFAULT NULL,
  `ab_description` varchar(252) DEFAULT NULL,
  `ab_image` varchar(255) DEFAULT NULL,
  `ab_content` text,
  `ab_content_atts_list` text,
  `ab_time` datetime DEFAULT '2021-08-01 08:00:00',
  `ab_update` datetime DEFAULT '2021-08-01 08:00:00',
  `ab_ucode` varchar(50) DEFAULT NULL,
  `ab_hidden` int DEFAULT '0',
  `ab_good` int DEFAULT '0',
  `ab_tpl` varchar(50) DEFAULT NULL,
  `ab_gourl` varchar(255) DEFAULT NULL,
  `ab_count` int DEFAULT '0',
  `ab_lng` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`abid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `wdja_admin` (
  `aid` int NOT NULL AUTO_INCREMENT,
  `a_name` varchar(50) DEFAULT NULL,
  `a_pword` varchar(50) DEFAULT NULL,
  `a_popedom` text,
  `a_lock` int DEFAULT '0',
  `a_lasttime` datetime DEFAULT '2021-08-01 08:00:00',
  `a_lastip` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`aid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `wdja_admin_log` (
  `lid` int NOT NULL AUTO_INCREMENT,
  `l_name` varchar(50) DEFAULT NULL,
  `l_time` datetime DEFAULT '2021-08-01 08:00:00',
  `l_ip` varchar(50) DEFAULT NULL,
  `l_islogin` int DEFAULT '0',
  PRIMARY KEY (`lid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `wdja_check` (
  `cid` int NOT NULL AUTO_INCREMENT,
  `c_url` varchar(255) DEFAULT NULL,
  `c_genre` varchar(50) DEFAULT NULL,
  `c_gid` varchar(50) DEFAULT NULL,
  `c_name` varchar(50) DEFAULT NULL,
  `c_ip` varchar(50) DEFAULT NULL,
  `c_sex` int DEFAULT '0',
  `c_mobile` varchar(50) DEFAULT '0',
  `c_email` varchar(50) DEFAULT NULL,
  `c_address` varchar(255) DEFAULT NULL,
  `c_title` varchar(252) DEFAULT NULL,
  `c_content` text,
  `c_time` datetime DEFAULT '2021-08-01 08:00:00',
  `c_reply` text,
  `c_replytime` datetime DEFAULT '2021-08-01 08:00:00',
  `c_hidden` int DEFAULT '0',
  `c_lng` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`cid`),
  UNIQUE KEY `cid` (`cid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `wdja_expansion_baidupush` (
  `bid` int NOT NULL AUTO_INCREMENT,
  `b_genre` varchar(152) DEFAULT NULL,
  `b_gid` int NOT NULL,
  `b_topic` varchar(255) DEFAULT NULL,
  `b_url` varchar(255) DEFAULT NULL,
  `b_content` text,
  `b_count` int DEFAULT '0',
  `b_type` varchar(25) DEFAULT '0',
  `b_state` varchar(25) DEFAULT '0',
  `b_time` datetime DEFAULT '2021-08-01 08:00:00',
  `b_update` datetime DEFAULT '2021-08-01 08:00:00',
  `b_lng` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`bid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `wdja_expansion_baidupush_data` (
  `bdid` int NOT NULL AUTO_INCREMENT,
  `bd_bid` int NOT NULL,
  `bd_order` int DEFAULT '0',
  `bd_type` varchar(25) DEFAULT '0',
  `bd_state` varchar(25) DEFAULT '0',
  `bd_content` text,
  `bd_time` datetime DEFAULT '2021-08-01 08:00:00',
  `bd_lng` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`bdid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `wdja_expansion_fields` (
  `fid` int NOT NULL AUTO_INCREMENT,
  `f_genre` varchar(50) DEFAULT NULL,
  `f_name` varchar(50) DEFAULT NULL,
  `f_topic` varchar(50) DEFAULT NULL,
  `f_type` int DEFAULT '0',
  `f_count` varchar(9) DEFAULT '0',
  `f_hidden` int DEFAULT '0',
  `f_hidden_list` int DEFAULT '0',
  `f_hidden_detail` int DEFAULT '0',
  `f_time` datetime DEFAULT '2021-08-01 08:00:00',
  `f_update` datetime DEFAULT '2021-08-01 08:00:00',
  `f_lng` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`fid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `wdja_expansion_fields_data` (
  `fdid` int NOT NULL AUTO_INCREMENT,
  `fd_topic` varchar(50) DEFAULT NULL,
  `fd_fid` int DEFAULT '0',
  `fd_oid` int DEFAULT '0',
  PRIMARY KEY (`fdid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `wdja_expansion_fields_gid` (
  `fgid` int NOT NULL AUTO_INCREMENT,
  `fg_fid` int DEFAULT '0',
  `fg_gid` varchar(50) DEFAULT NULL,
  `fg_data` text,
  `fg_time` datetime DEFAULT '2021-08-01 08:00:00',
  `fg_update` datetime DEFAULT '2021-08-01 08:00:00',
  PRIMARY KEY (`fgid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `wdja_expansion_iplock` (
  `ipid` int NOT NULL AUTO_INCREMENT,
  `ip_area` varchar(50) DEFAULT NULL,
  `ip_robots` varchar(25) DEFAULT NULL,
  `ip_ip` varchar(152) DEFAULT NULL,
  `ip_come` varchar(255) DEFAULT NULL,
  `ip_content` text,
  `ip_lock` int DEFAULT '0',
  `ip_out` int DEFAULT '0',
  `ip_time` datetime DEFAULT '2021-08-01 08:00:00',
  `ip_update` datetime DEFAULT '2021-08-01 08:00:00',
  `ip_count` int DEFAULT '0',
  `ip_lng` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`ipid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `wdja_expansion_label` (
  `elid` int NOT NULL AUTO_INCREMENT,
  `el_topic` varchar(50) DEFAULT NULL,
  `el_type` int DEFAULT '0',
  `el_images_tpl` varchar(50) DEFAULT NULL,
  `el_content` text,
  `el_content_atts_list` text,
  `el_inputs_type` varchar(50) DEFAULT 'text',
  `el_time` datetime DEFAULT '2021-08-01 08:00:00',
  `el_update` datetime DEFAULT '2021-08-01 08:00:00',
  `el_hidden` int DEFAULT '0',
  `el_lng` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`elid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `wdja_expansion_timer` (
  `etid` int NOT NULL AUTO_INCREMENT,
  `et_topic` varchar(50) DEFAULT NULL,
  `et_genre` varchar(50) DEFAULT NULL COMMENT '模块',
  `et_gid` int DEFAULT '0' COMMENT '内容ID',
  `et_event` int DEFAULT '0' COMMENT '定时事件:发布,删除,上下架',
  `et_timer_switch` int DEFAULT '0' COMMENT '定时开关',
  `et_timer` datetime DEFAULT '2021-08-01 08:00:00' COMMENT '任务启动时间',
  `et_state` int DEFAULT '0' COMMENT '任务状态:中止,暂停,进行中,结束',
  `et_time` datetime DEFAULT '2021-08-01 08:00:00',
  `et_update` datetime DEFAULT '2021-08-01 08:00:00',
  `et_lng` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`etid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `wdja_expansion_vuser` (
  `evid` int NOT NULL AUTO_INCREMENT,
  `ev_topic` varchar(50) DEFAULT NULL,
  `ev_time` datetime DEFAULT '2021-08-01 08:00:00',
  `ev_update` datetime DEFAULT '2021-08-01 08:00:00',
  `ev_count` int DEFAULT '0',
  `ev_lng` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`evid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `wdja_message` (
  `mid` int NOT NULL AUTO_INCREMENT,
  `m_name` varchar(50) DEFAULT NULL,
  `m_ip` varchar(50) DEFAULT NULL,
  `m_sex` int DEFAULT '0',
  `m_mobile` varchar(50) DEFAULT '0',
  `m_email` varchar(50) DEFAULT NULL,
  `m_address` varchar(255) DEFAULT NULL,
  `m_title` varchar(252) DEFAULT NULL,
  `m_content` text,
  `m_time` datetime DEFAULT '2021-08-01 08:00:00',
  `m_reply` text,
  `m_replytime` datetime DEFAULT '2021-08-01 08:00:00',
  `m_hidden` int DEFAULT '0',
  `m_token` varchar(255) NOT NULL,
  `m_lng` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`mid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `wdja_search` (
  `sid` int NOT NULL AUTO_INCREMENT,
  `s_topic` varchar(252) DEFAULT NULL,
  `s_ip` varchar(252) DEFAULT NULL,
  `s_content` varchar(252) DEFAULT NULL,
  `s_infos` text,
  `s_hidden` int DEFAULT '0',
  `s_update` datetime DEFAULT '2021-08-01 08:00:00',
  `s_time` datetime DEFAULT '2021-08-01 08:00:00',
  `s_count` int DEFAULT '0',
  `s_lng` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`sid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `wdja_site` (
  `sid` int NOT NULL AUTO_INCREMENT,
  `s_topic` varchar(252) DEFAULT NULL,
  `s_weburl` varchar(250) DEFAULT NULL,
  `s_webicon` varchar(250) DEFAULT NULL,
  `s_webtitle` varchar(150) DEFAULT NULL,
  `s_webkeywords` varchar(150) DEFAULT NULL,
  `s_webdescription` varchar(255) DEFAULT NULL,
  `s_titles` varchar(250) DEFAULT NULL,
  `s_keywords` varchar(252) DEFAULT NULL,
  `s_description` varchar(252) DEFAULT NULL,
  `s_image` varchar(255) DEFAULT NULL,
  `s_content` text,
  `s_content_atts_list` text,
  `s_time` datetime DEFAULT '2021-08-01 08:00:00',
  `s_update` datetime DEFAULT '2021-08-01 08:00:00',
  `s_cls` text,
  `s_class` int DEFAULT '0',
  `s_class_list` varchar(50) DEFAULT '0',
  `s_ucode` varchar(50) DEFAULT NULL,
  `s_vuser` int DEFAULT '0',
  `s_vuid` int DEFAULT '0',
  `s_hidden` int DEFAULT '0',
  `s_good` int DEFAULT '0',
  `s_count` int DEFAULT '0',
  `s_lng` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`sid`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `wdja_support_collect` (
  `cid` int NOT NULL AUTO_INCREMENT,
  `c_url` varchar(255) DEFAULT NULL,
  `c_image` varchar(255) DEFAULT NULL,
  `c_title` varchar(255) DEFAULT NULL,
  `c_author` varchar(255) DEFAULT NULL,
  `c_content` varchar(255) DEFAULT NULL,
  `c_replace` varchar(255) DEFAULT NULL,
  `c_hidden` int DEFAULT '0',
  `c_time` datetime DEFAULT '2021-08-01 08:00:00',
  `c_update` datetime DEFAULT '2021-08-01 08:00:00',
  `c_lng` varchar(50) DEFAULT 'chinese',
  PRIMARY KEY (`cid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `wdja_support_menu` (
  `mid` int NOT NULL AUTO_INCREMENT,
  `m_pid` int DEFAULT '0',
  `m_topic` varchar(50) DEFAULT NULL,
  `m_title` varchar(50) DEFAULT NULL,
  `m_image` varchar(255) DEFAULT NULL,
  `m_alt` varchar(250) DEFAULT NULL,
  `m_fid` varchar(255) DEFAULT NULL,
  `m_fsid` int DEFAULT '0',
  `m_lid` int DEFAULT '0',
  `m_group` varchar(50) DEFAULT NULL,
  `m_hidden` int DEFAULT '0',
  `m_gourl` varchar(255) DEFAULT NULL,
  `m_order` int DEFAULT '0',
  `m_time` datetime DEFAULT '2021-08-01 08:00:00',
  `m_update` datetime DEFAULT '2021-08-01 08:00:00',
  `m_lng` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`mid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `wdja_support_sort` (
  `sortid` int NOT NULL AUTO_INCREMENT,
  `sort_pid` int DEFAULT '0',
  `sort_sort` varchar(50) DEFAULT NULL,
  `sort_titles` varchar(250) DEFAULT NULL,
  `sort_keywords` varchar(50) DEFAULT NULL,
  `sort_description` varchar(250) DEFAULT NULL,
  `sort_image` varchar(255) DEFAULT NULL,
  `sort_fid` varchar(255) DEFAULT NULL,
  `sort_fsid` int DEFAULT '0',
  `sort_lid` int DEFAULT '0',
  `sort_genre` varchar(50) DEFAULT NULL,
  `sort_hidden` int DEFAULT '0',
  `sort_gourl` varchar(255) DEFAULT NULL,
  `sort_tpl_list` varchar(50) DEFAULT NULL,
  `sort_tpl_detail` varchar(50) DEFAULT NULL,
  `sort_order` int DEFAULT '0',
  `sort_time` datetime DEFAULT '2021-08-01 08:00:00',
  `sort_update` datetime DEFAULT '2021-08-01 08:00:00',
  `sort_lng` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`sortid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `wdja_sys_note` (
  `nid` int NOT NULL AUTO_INCREMENT,
  `n_topic` varchar(50) DEFAULT NULL,
  `n_image` varchar(255) DEFAULT NULL,
  `n_content` text,
  `n_content_atts_list` text,
  `n_time` datetime DEFAULT '2021-08-01 08:00:00',
  `n_update` datetime DEFAULT '2021-08-01 08:00:00',
  `n_finish` int DEFAULT '0',
  `n_count` int DEFAULT '0',
  `n_lng` varchar(50) DEFAULT 'chinese',
  PRIMARY KEY (`nid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `wdja_sys_related` (
  `rid` int NOT NULL AUTO_INCREMENT,
  `r_genre` varchar(50) DEFAULT NULL,
  `r_gid` varchar(50) DEFAULT NULL,
  `r_source` varchar(25) DEFAULT NULL,
  `r_title` varchar(250) DEFAULT NULL,
  `r_sid` varchar(250) DEFAULT NULL,
  `r_time` datetime DEFAULT '2021-08-01 08:00:00',
  `r_update` datetime DEFAULT '2021-08-01 08:00:00',
  `r_lng` varchar(25) DEFAULT 'chinese',
  PRIMARY KEY (`rid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `wdja_sys_upload` (
  `upid` int NOT NULL AUTO_INCREMENT,
  `up_genre` varchar(50) DEFAULT NULL,
  `up_upident` varchar(50) DEFAULT NULL,
  `up_filename` varchar(255) DEFAULT NULL,
  `up_field` varchar(50) DEFAULT NULL,
  `up_fid` int DEFAULT '0',
  `up_time` datetime DEFAULT '2021-08-01 08:00:00',
  `up_user` varchar(50) DEFAULT NULL,
  `up_valid` int DEFAULT '0',
  `up_voidreason` int DEFAULT '0',
  `up_lng` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`upid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `wdja_tags` (
  `tid` int NOT NULL AUTO_INCREMENT,
  `t_topic` varchar(50) DEFAULT NULL,
  `t_titles` varchar(250) DEFAULT NULL,
  `t_keywords` varchar(152) DEFAULT NULL,
  `t_description` varchar(252) DEFAULT NULL,
  `t_image` varchar(255) DEFAULT NULL,
  `t_content` text,
  `t_content_atts_list` text,
  `t_time` datetime DEFAULT '2021-08-01 08:00:00',
  `t_update` datetime DEFAULT '2021-08-01 08:00:00',
  `t_hidden` int DEFAULT '0',
  `t_good` int DEFAULT '0',
  `t_gourl` varchar(255) DEFAULT NULL,
  `t_count` int DEFAULT '0',
  `t_lng` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`tid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `wdja_tags_data` (
  `tdid` int NOT NULL AUTO_INCREMENT,
  `td_genre` varchar(50) NOT NULL,
  `td_gid` int DEFAULT '0',
  `td_tid` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`tdid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `wdja_admin` (`a_name`, `a_pword`, `a_popedom`, `a_lock`, `a_lasttime`, `a_lastip`) VALUES ( 'admin', '21232f297a57a5a743894a0e4a801fc3', '-1', '0', '2021-08-01 08:00:00', '127.0.0.1');


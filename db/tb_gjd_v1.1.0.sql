/*
Navicat MySQL Data Transfer

Source Server         : benji
Source Server Version : 50611
Source Host           : localhost:3306
Source Database       : a0909221552

Target Server Type    : MYSQL
Target Server Version : 50611
File Encoding         : 65001

Date: 2015-12-23 11:28:31
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `tb_gjd_bg`
-- ----------------------------
DROP TABLE IF EXISTS `tb_gjd_bg`;
CREATE TABLE `tb_gjd_bg` (
  `uuid` int(11) NOT NULL,
  `bg_name` varchar(255) NOT NULL,
  `bg_count` int(11) NOT NULL,
  `bg_pic` varchar(255) NOT NULL,
  `bg_dis` varchar(255) NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tb_gjd_bg
-- ----------------------------

-- ----------------------------
-- Table structure for `tb_gjd_dl`
-- ----------------------------
DROP TABLE IF EXISTS `tb_gjd_dl`;
CREATE TABLE `tb_gjd_dl` (
  `dl_level` int(11) NOT NULL,
  `dl_time` int(11) NOT NULL,
  `dl_gt` int(11) NOT NULL,
  `dl_money` int(11) NOT NULL,
  `dl_dis` varchar(255) NOT NULL,
  `level/time` varchar(255) NOT NULL,
  `dl_attack` int(11) NOT NULL,
  `dl_hp` int(11) NOT NULL,
  `dl_mp` int(11) NOT NULL,
  `dl_fy` int(11) NOT NULL,
  PRIMARY KEY (`level/time`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tb_gjd_dl
-- ----------------------------
INSERT INTO `tb_gjd_dl` VALUES ('100', '1', '0', '100', 'BOSS', '0', '10000', '10000', '10000', '10000');
INSERT INTO `tb_gjd_dl` VALUES ('10', '1', '10', '10', '10级的怪', '10:1', '10', '100', '1000', '10');
INSERT INTO `tb_gjd_dl` VALUES ('10', '24', '240', '240', '10级的怪', '10:24', '10', '100', '1000', '10');
INSERT INTO `tb_gjd_dl` VALUES ('10', '3', '30', '30', '10级的怪', '10:3', '10', '100', '1000', '10');
INSERT INTO `tb_gjd_dl` VALUES ('10', '8', '80', '80', '10级的怪', '10:8', '10', '100', '1000', '10');
INSERT INTO `tb_gjd_dl` VALUES ('1', '1', '10', '10', '1级的怪', '1:1', '1', '10', '100', '1');
INSERT INTO `tb_gjd_dl` VALUES ('1', '24', '240', '240', '1级的怪', '1:24', '1', '10', '100', '1');
INSERT INTO `tb_gjd_dl` VALUES ('1', '3', '30', '30', '1级的怪', '1:3', '1', '10', '100', '1');
INSERT INTO `tb_gjd_dl` VALUES ('1', '8', '80', '80', '1级的怪', '1:8', '1', '10', '100', '1');
INSERT INTO `tb_gjd_dl` VALUES ('5', '1', '10', '10', '5级的怪', '5:1', '5', '50', '500', '5');
INSERT INTO `tb_gjd_dl` VALUES ('5', '24', '240', '240', '5级的怪', '5:24', '5', '50', '500', '5');
INSERT INTO `tb_gjd_dl` VALUES ('5', '3', '30', '30', '5级的怪', '5:3', '5', '50', '500', '5');
INSERT INTO `tb_gjd_dl` VALUES ('5', '8', '80', '80', '5级的怪', '5:8', '5', '50', '500', '5');

-- ----------------------------
-- Table structure for `tb_gjd_dy`
-- ----------------------------
DROP TABLE IF EXISTS `tb_gjd_dy`;
CREATE TABLE `tb_gjd_dy` (
  `dy_level` int(11) NOT NULL,
  `dy_sy` int(11) NOT NULL,
  `dy_time` int(11) NOT NULL,
  `dy_dis` varchar(255) NOT NULL,
  `level/time` varchar(255) NOT NULL,
  PRIMARY KEY (`level/time`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tb_gjd_dy
-- ----------------------------
INSERT INTO `tb_gjd_dy` VALUES ('10', '10', '1', '10级的鱼', '10:1');
INSERT INTO `tb_gjd_dy` VALUES ('10', '240', '24', '10级的鱼', '10:24');
INSERT INTO `tb_gjd_dy` VALUES ('10', '30', '3', '10级的鱼', '10:3');
INSERT INTO `tb_gjd_dy` VALUES ('10', '80', '8', '10级的鱼', '10:8');
INSERT INTO `tb_gjd_dy` VALUES ('1', '10', '1', '1级的鱼', '1:1');
INSERT INTO `tb_gjd_dy` VALUES ('1', '240', '24', '1级的鱼', '1:24');
INSERT INTO `tb_gjd_dy` VALUES ('1', '30', '3', '1级的鱼', '1:3');
INSERT INTO `tb_gjd_dy` VALUES ('1', '80', '8', '1级的鱼', '1:8');
INSERT INTO `tb_gjd_dy` VALUES ('5', '10', '1', '5级的鱼', '5:1');
INSERT INTO `tb_gjd_dy` VALUES ('5', '240', '24', '5级的鱼', '5:24');
INSERT INTO `tb_gjd_dy` VALUES ('5', '30', '3', '5级的鱼', '5:3');
INSERT INTO `tb_gjd_dy` VALUES ('5', '80', '8', '5级的鱼', '5:8');

-- ----------------------------
-- Table structure for `tb_gjd_gc`
-- ----------------------------
DROP TABLE IF EXISTS `tb_gjd_gc`;
CREATE TABLE `tb_gjd_gc` (
  `zb_name` varchar(255) NOT NULL,
  `zb_level` int(11) NOT NULL,
  `zb_dis` varchar(255) NOT NULL,
  `zb_cl1` varchar(255) NOT NULL,
  `zb_cl2` varchar(255) DEFAULT NULL,
  `zb_cl3` varchar(255) DEFAULT NULL,
  `zb_type` varchar(255) DEFAULT NULL,
  `zb_cl1_count` int(11) NOT NULL,
  `zb_cl2_count` int(11) DEFAULT NULL,
  `zb_cl3_count` int(11) DEFAULT NULL,
  `zb_sx1` varchar(255) NOT NULL,
  `zb_sx2` varchar(255) DEFAULT NULL,
  `zb_sx3` varchar(255) DEFAULT NULL,
  `zb_sx1_value` int(11) NOT NULL,
  `zb_sx2_value` int(11) DEFAULT NULL,
  `zb_sx3_value` int(11) DEFAULT NULL,
  PRIMARY KEY (`zb_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tb_gjd_gc
-- ----------------------------
INSERT INTO `tb_gjd_gc` VALUES ('10级战甲', '10', '10级战甲,防御+6', '10级骨头', null, null, 'zj', '100', null, null, 'fy', null, null, '6', null, null);
INSERT INTO `tb_gjd_gc` VALUES ('10级武器', '10', '10级武器,攻击+20', '10骨头', null, null, 'wq', '100', null, null, 'gj', null, null, '20', null, null);
INSERT INTO `tb_gjd_gc` VALUES ('10级裤子', '10', '10级裤子,hp+100', '10级骨头', null, null, 'kz', '100', null, null, 'hp', null, null, '100', null, null);
INSERT INTO `tb_gjd_gc` VALUES ('10级鞋子', '10', '10级鞋子,hp+20,攻击+10', '10级骨头', null, null, 'xz', '100', null, null, 'hp', 'gj', null, '20', '10', null);
INSERT INTO `tb_gjd_gc` VALUES ('1级战甲', '1', '1级战甲,防御+2', '1级骨头', null, null, 'zj', '10', null, null, 'fy', null, null, '2', null, null);
INSERT INTO `tb_gjd_gc` VALUES ('1级武器', '1', '1级武器,攻击+5', '1级骨头', null, null, 'wq', '10', null, null, 'gj', null, null, '5', null, null);
INSERT INTO `tb_gjd_gc` VALUES ('1级裤子', '1', '1级裤子,hp+10', '1级骨头', null, null, 'kz', '10', null, null, 'hp', null, null, '10', null, null);
INSERT INTO `tb_gjd_gc` VALUES ('1级鞋子', '1', '1级鞋子,hp+5,攻击+2', '1级骨头', null, null, 'xz', '10', null, null, 'hp', 'gj', null, '5', '2', null);
INSERT INTO `tb_gjd_gc` VALUES ('5级战甲', '5', '5级战甲,防御+4', '5级骨头', null, null, 'zj', '50', null, null, 'fy', null, null, '4', null, null);
INSERT INTO `tb_gjd_gc` VALUES ('5级武器', '5', '5级武器,攻击+10', '5级骨头', null, null, 'wq', '50', null, null, 'gj', null, null, '10', null, null);
INSERT INTO `tb_gjd_gc` VALUES ('5级裤子', '5', '5级裤子,hp+50', '5级骨头', null, null, 'kz', '50', null, null, 'hp', null, null, '50', null, null);
INSERT INTO `tb_gjd_gc` VALUES ('5级鞋子', '5', '5级鞋子,hp+10,攻击+5', '5级骨头', null, null, 'xz', '50', null, null, 'hp', 'gj', null, '10', '5', null);
INSERT INTO `tb_gjd_gc` VALUES ('屠龙宝刀', '1', '传说中的屠龙宝刀，自带VIP1，攻击+1000，防御+100', '特殊', null, null, 'wq', '0', null, null, 'gj', 'fy', null, '1000', '100', null);

-- ----------------------------
-- Table structure for `tb_gjd_hdzt`
-- ----------------------------
DROP TABLE IF EXISTS `tb_gjd_hdzt`;
CREATE TABLE `tb_gjd_hdzt` (
  `uuid` int(11) NOT NULL,
  `dy` tinyint(1) NOT NULL,
  `dl` tinyint(1) NOT NULL,
  `zz` tinyint(1) NOT NULL,
  `gc` tinyint(1) NOT NULL,
  `jg` tinyint(1) NOT NULL,
  `dy_level` int(11) DEFAULT NULL,
  `dy_end` varchar(255) DEFAULT NULL,
  `dl_level` int(11) DEFAULT NULL,
  `dl_end` varchar(255) DEFAULT NULL,
  `zz_level` int(11) DEFAULT NULL,
  `zz_end` varchar(255) DEFAULT NULL,
  `dy_time` int(11) DEFAULT NULL,
  `zz_time` int(11) DEFAULT NULL,
  `dl_time` int(11) DEFAULT NULL,
  `jg_level` int(11) DEFAULT NULL,
  `jg_count` int(11) DEFAULT NULL,
  `jg_end` varchar(255) DEFAULT NULL,
  `gc_level` int(11) DEFAULT NULL,
  `gc_type` varchar(11) DEFAULT NULL,
  `gc_end` varchar(255) DEFAULT NULL,
  `jg_type` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tb_gjd_hdzt
-- ----------------------------

-- ----------------------------
-- Table structure for `tb_gjd_jbxx`
-- ----------------------------
DROP TABLE IF EXISTS `tb_gjd_jbxx`;
CREATE TABLE `tb_gjd_jbxx` (
  `uuid` int(11) NOT NULL,
  `user_tx` varchar(255) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_level` int(11) NOT NULL,
  `dao_level` int(11) NOT NULL,
  `money` int(11) NOT NULL,
  `money_h` int(11) NOT NULL,
  `jingyan_h` int(11) NOT NULL,
  `vip` int(11) DEFAULT NULL,
  PRIMARY KEY (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tb_gjd_jbxx
-- ----------------------------

-- ----------------------------
-- Table structure for `tb_gjd_jg`
-- ----------------------------
DROP TABLE IF EXISTS `tb_gjd_jg`;
CREATE TABLE `tb_gjd_jg` (
  `jg_dis` varchar(255) NOT NULL,
  `jg_level` int(11) NOT NULL,
  `jg_count` int(11) NOT NULL,
  `jg_cl1` varchar(255) DEFAULT NULL,
  `jg_cl2` varchar(255) DEFAULT NULL,
  `jg_cl3` varchar(255) DEFAULT NULL,
  `jg_type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tb_gjd_jg
-- ----------------------------
INSERT INTO `tb_gjd_jg` VALUES ('1级红蓝药水', '1', '1', '1级的鱼', null, null, 'HP');
INSERT INTO `tb_gjd_jg` VALUES ('1级红蓝药水', '1', '5', '1级的鱼', null, null, 'HP');
INSERT INTO `tb_gjd_jg` VALUES ('1级红蓝药水', '1', '10', '1级的鱼', null, null, 'HP');
INSERT INTO `tb_gjd_jg` VALUES ('5级红蓝药水', '5', '1', '5级的鱼', null, null, 'HP');
INSERT INTO `tb_gjd_jg` VALUES ('5级红蓝药水', '5', '5', '5级的鱼', null, null, 'HP');
INSERT INTO `tb_gjd_jg` VALUES ('5级红蓝药水', '5', '10', '5级的鱼', null, null, 'HP');
INSERT INTO `tb_gjd_jg` VALUES ('10级红蓝药水', '10', '1', '10级的鱼', null, null, 'HP');
INSERT INTO `tb_gjd_jg` VALUES ('10级红蓝药水', '10', '5', '10级的鱼', null, null, 'HP');
INSERT INTO `tb_gjd_jg` VALUES ('10级红蓝药水', '10', '10', '10级的鱼', null, null, 'HP');
INSERT INTO `tb_gjd_jg` VALUES ('1级攻击药水', '1', '1', '1级植物', null, null, 'gj');
INSERT INTO `tb_gjd_jg` VALUES ('5级攻击药水', '5', '5', '5级植物', null, null, 'gj');
INSERT INTO `tb_gjd_jg` VALUES ('5级攻击药水', '5', '10', '5级植物', null, null, 'gj');
INSERT INTO `tb_gjd_jg` VALUES ('5级攻击药水', '5', '1', '5级植物', null, null, 'gj');
INSERT INTO `tb_gjd_jg` VALUES ('10级攻击药水', '10', '5', '10级植物', null, null, 'gj');
INSERT INTO `tb_gjd_jg` VALUES ('10级攻击药水', '10', '10', '10级植物', null, null, 'gj');
INSERT INTO `tb_gjd_jg` VALUES ('10级攻击药水', '10', '1', '10级植物', null, null, 'gj');
INSERT INTO `tb_gjd_jg` VALUES ('1级攻击药水', '1', '5', '1级植物', null, null, 'gj');
INSERT INTO `tb_gjd_jg` VALUES ('1级攻击药水', '1', '10', '1级植物', null, null, 'gj');
INSERT INTO `tb_gjd_jg` VALUES ('1级经验药水', '1', '1', '1级的鱼', '1级植物', '', 'jy');
INSERT INTO `tb_gjd_jg` VALUES ('5级经验药水', '5', '5', '5级的鱼', '5级植物', null, 'jy');
INSERT INTO `tb_gjd_jg` VALUES ('5级经验药水', '5', '10', '5级的鱼', '5级植物', null, 'jy');
INSERT INTO `tb_gjd_jg` VALUES ('5级经验药水', '5', '1', '5级的鱼', '5级植物', null, 'jy');
INSERT INTO `tb_gjd_jg` VALUES ('10级经验药水', '10', '5', '10级的鱼', '10级植物', null, 'jy');
INSERT INTO `tb_gjd_jg` VALUES ('10级经验药水', '10', '10', '10级的鱼', '10级植物', null, 'jy');
INSERT INTO `tb_gjd_jg` VALUES ('10级经验药水', '10', '1', '10级的鱼', '10级植物', null, 'jy');
INSERT INTO `tb_gjd_jg` VALUES ('1级经验药水', '1', '5', '1级的鱼', '1级植物', null, 'jy');
INSERT INTO `tb_gjd_jg` VALUES ('1级经验药水', '1', '10', '1级的鱼', '1级植物', null, 'jy');
INSERT INTO `tb_gjd_jg` VALUES ('10级防御药水', '10', '5', '10级的鱼', '10级植物', '10级骨头', 'fy');
INSERT INTO `tb_gjd_jg` VALUES ('10级防御药水', '10', '10', '10级的鱼', '10级植物', '10级骨头', 'fy');
INSERT INTO `tb_gjd_jg` VALUES ('10级防御药水', '10', '1', '10级的鱼', '10级植物', '10级骨头', 'fy');
INSERT INTO `tb_gjd_jg` VALUES ('1级防御药水', '1', '1', '1级的鱼', '1级植物', '1级骨头', 'fy');
INSERT INTO `tb_gjd_jg` VALUES ('1级防御药水', '1', '5', '1级的鱼', '1级植物', '1级骨头', 'fy');
INSERT INTO `tb_gjd_jg` VALUES ('1级防御药水', '1', '10', '1级的鱼', '1级植物', '1级骨头', 'fy');
INSERT INTO `tb_gjd_jg` VALUES ('5级防御药水', '5', '1', '5级的鱼', '5级植物', '5级骨头', 'fy');
INSERT INTO `tb_gjd_jg` VALUES ('5级防御药水', '5', '5', '5级的鱼', '5级植物', '5级骨头', 'fy');
INSERT INTO `tb_gjd_jg` VALUES ('5级防御药水', '5', '10', '5级的鱼', '5级植物', '5级骨头', 'fy');

-- ----------------------------
-- Table structure for `tb_gjd_pic`
-- ----------------------------
DROP TABLE IF EXISTS `tb_gjd_pic`;
CREATE TABLE `tb_gjd_pic` (
  `bg_name` varchar(255) NOT NULL,
  `pic` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`bg_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tb_gjd_pic
-- ----------------------------
INSERT INTO `tb_gjd_pic` VALUES ('10级战甲', 'thing_image/zj.png');
INSERT INTO `tb_gjd_pic` VALUES ('10级攻击药水', 'thing_image/ys.jpg');
INSERT INTO `tb_gjd_pic` VALUES ('10级植物', 'thing_image/zw.jpg');
INSERT INTO `tb_gjd_pic` VALUES ('10级武器', 'thing_image/wq.png');
INSERT INTO `tb_gjd_pic` VALUES ('10级的怪', 'thing_image/gt.jpg');
INSERT INTO `tb_gjd_pic` VALUES ('10级的鱼', 'thing_image/yu.jpg');
INSERT INTO `tb_gjd_pic` VALUES ('10级红蓝药水', 'thing_image/ys.jpg');
INSERT INTO `tb_gjd_pic` VALUES ('10级经验药水', 'thing_image/ys.jpg');
INSERT INTO `tb_gjd_pic` VALUES ('10级裤子', 'thing_image/kz.jpg');
INSERT INTO `tb_gjd_pic` VALUES ('10级防御药水', 'thing_image/ys.jpg');
INSERT INTO `tb_gjd_pic` VALUES ('10级鞋子', 'thing_image/xz.jpg');
INSERT INTO `tb_gjd_pic` VALUES ('1级战甲', 'thing_image/zj.png');
INSERT INTO `tb_gjd_pic` VALUES ('1级攻击药水', 'thing_image/ys.jpg');
INSERT INTO `tb_gjd_pic` VALUES ('1级植物', 'thing_image/zw.jpg');
INSERT INTO `tb_gjd_pic` VALUES ('1级武器', 'thing_image/wq.png');
INSERT INTO `tb_gjd_pic` VALUES ('1级的怪', 'thing_image/gt.jpg');
INSERT INTO `tb_gjd_pic` VALUES ('1级的鱼', 'thing_image/yu.jpg');
INSERT INTO `tb_gjd_pic` VALUES ('1级红蓝药水', 'thing_image/ys.jpg');
INSERT INTO `tb_gjd_pic` VALUES ('1级经验药水', 'thing_image/ys.jpg');
INSERT INTO `tb_gjd_pic` VALUES ('1级裤子', 'thing_image/kz.jpg');
INSERT INTO `tb_gjd_pic` VALUES ('1级防御药水', 'thing_image/ys.jpg');
INSERT INTO `tb_gjd_pic` VALUES ('1级鞋子', 'thing_image/xz.jpg');
INSERT INTO `tb_gjd_pic` VALUES ('5级战甲', 'thing_image/zj.png');
INSERT INTO `tb_gjd_pic` VALUES ('5级攻击药水', 'thing_image/ys.jpg');
INSERT INTO `tb_gjd_pic` VALUES ('5级植物', 'thing_image/zw.jpg');
INSERT INTO `tb_gjd_pic` VALUES ('5级武器', 'thing_image/wq.png');
INSERT INTO `tb_gjd_pic` VALUES ('5级的怪', 'thing_image/gt.jpg');
INSERT INTO `tb_gjd_pic` VALUES ('5级的鱼', 'thing_image/yu.jpg');
INSERT INTO `tb_gjd_pic` VALUES ('5级红蓝药水', 'thing_image/ys.jpg');
INSERT INTO `tb_gjd_pic` VALUES ('5级经验药水', 'thing_image/ys.jpg');
INSERT INTO `tb_gjd_pic` VALUES ('5级裤子', 'thing_image/kz.jpg');
INSERT INTO `tb_gjd_pic` VALUES ('5级防御药水', 'thing_image/ys.jpg');
INSERT INTO `tb_gjd_pic` VALUES ('5级鞋子', 'thing_image/xz.jpg');
INSERT INTO `tb_gjd_pic` VALUES ('屠龙宝刀', 'thing_image/tlbd.jpg');

-- ----------------------------
-- Table structure for `tb_gjd_shop`
-- ----------------------------
DROP TABLE IF EXISTS `tb_gjd_shop`;
CREATE TABLE `tb_gjd_shop` (
  `uuid` int(11) NOT NULL,
  `sp_name` varchar(255) NOT NULL,
  `sp_price` int(11) NOT NULL,
  `sp_count` int(11) NOT NULL,
  `sp_f5_count` int(11) NOT NULL,
  `sp_pic` varchar(255) NOT NULL,
  `sp_dis` varchar(255) NOT NULL,
  PRIMARY KEY (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tb_gjd_shop
-- ----------------------------

-- ----------------------------
-- Table structure for `tb_gjd_user`
-- ----------------------------
DROP TABLE IF EXISTS `tb_gjd_user`;
CREATE TABLE `tb_gjd_user` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `uuid` int(8) NOT NULL,
  PRIMARY KEY (`id`,`uuid`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tb_gjd_user
-- ----------------------------

-- ----------------------------
-- Table structure for `tb_gjd_ys`
-- ----------------------------
DROP TABLE IF EXISTS `tb_gjd_ys`;
CREATE TABLE `tb_gjd_ys` (
  `buff_type` varchar(255) NOT NULL,
  `buff_time` varchar(255) NOT NULL,
  `buff_dis` varchar(255) DEFAULT NULL,
  `buff_gj` int(11) DEFAULT NULL,
  `buff_fy` int(11) DEFAULT NULL,
  `buff_hp` int(11) DEFAULT NULL,
  PRIMARY KEY (`buff_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tb_gjd_ys
-- ----------------------------
INSERT INTO `tb_gjd_ys` VALUES ('10级攻击药水', '24', '10级buff药时间1天', '10', null, null);
INSERT INTO `tb_gjd_ys` VALUES ('10级红蓝药水', '24', '10级buff药时间1天', null, null, '100');
INSERT INTO `tb_gjd_ys` VALUES ('10级防御药水', '24', '10级buff药时间1天', null, '10', null);
INSERT INTO `tb_gjd_ys` VALUES ('1级攻击药水\r\n', '24', '1级buff药时间1天', '1', null, null);
INSERT INTO `tb_gjd_ys` VALUES ('1级红蓝药水', '24', '1级buff药时间1天', null, null, '10');
INSERT INTO `tb_gjd_ys` VALUES ('1级防御药水', '24', '1级buff药时间1天', null, '1', null);
INSERT INTO `tb_gjd_ys` VALUES ('5级攻击药水', '24', '5级buff药时间1天', '5', null, null);
INSERT INTO `tb_gjd_ys` VALUES ('5级红蓝药水', '24', '5级buff药时间1天', null, null, '50');
INSERT INTO `tb_gjd_ys` VALUES ('5级防御药水', '24', '5级buff药时间1天', null, '5', null);

-- ----------------------------
-- Table structure for `tb_gjd_zb`
-- ----------------------------
DROP TABLE IF EXISTS `tb_gjd_zb`;
CREATE TABLE `tb_gjd_zb` (
  `uuid` int(11) NOT NULL,
  `zb_name` varchar(255) NOT NULL,
  `zb_pic` varchar(255) NOT NULL,
  `zb_dis` varchar(2550) NOT NULL,
  `zb_count` int(11) NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tb_gjd_zb
-- ----------------------------
INSERT INTO `tb_gjd_zb` VALUES ('67930908', '屠龙宝刀', 'thing_image/tlbd.jpg', '传说中的屠龙宝刀，自带VIP1，攻击+1000，防御+100', '4', '55');

-- ----------------------------
-- Table structure for `tb_gjd_zdxx`
-- ----------------------------
DROP TABLE IF EXISTS `tb_gjd_zdxx`;
CREATE TABLE `tb_gjd_zdxx` (
  `uuid` int(11) NOT NULL,
  `hp` int(11) NOT NULL,
  `mp` int(11) NOT NULL,
  `attck` int(11) NOT NULL,
  `fy` int(11) NOT NULL,
  `jyz` int(11) NOT NULL,
  `jyz_level` int(11) NOT NULL,
  `zb_wq` varchar(255) DEFAULT NULL,
  `zb_zj` varchar(255) DEFAULT NULL,
  `zb_xz` varchar(255) DEFAULT NULL,
  `zb_kz` varchar(255) DEFAULT NULL,
  `gj_buff` int(11) DEFAULT NULL,
  `fy_buff` int(11) DEFAULT NULL,
  `hp_buff` int(11) DEFAULT NULL,
  `mp_buff` int(11) DEFAULT NULL,
  `buff_end_time` varchar(255) DEFAULT NULL,
  `zb_gj` int(11) DEFAULT NULL,
  `zb_fy` int(11) DEFAULT NULL,
  `zb_hp` int(11) DEFAULT NULL,
  `zb_mp` int(11) DEFAULT NULL,
  `zb_buff` int(11) unsigned DEFAULT '0',
  PRIMARY KEY (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tb_gjd_zdxx
-- ----------------------------
INSERT INTO `tb_gjd_zdxx` VALUES ('61446228', '400', '100', '20', '5', '0', '10', '10级武器', '10级战甲', '10级鞋子', '10级裤子', null, null, null, null, null, '15', null, null, null, '1');
INSERT INTO `tb_gjd_zdxx` VALUES ('67930908', '100', '100', '13010', '1307', '0', '10', '10级武器', '10级战甲', '10级鞋子', '10级裤子', null, null, null, null, null, '15', null, null, null, '1');

-- ----------------------------
-- Table structure for `tb_gjd_zz`
-- ----------------------------
DROP TABLE IF EXISTS `tb_gjd_zz`;
CREATE TABLE `tb_gjd_zz` (
  `zz_level` int(11) NOT NULL,
  `zz_sy` int(11) NOT NULL,
  `zz_time` int(11) NOT NULL,
  `zz_dis` varchar(255) NOT NULL,
  `level/time` varchar(255) NOT NULL,
  PRIMARY KEY (`level/time`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tb_gjd_zz
-- ----------------------------
INSERT INTO `tb_gjd_zz` VALUES ('10', '10', '1', '10级植物', '10:1');
INSERT INTO `tb_gjd_zz` VALUES ('10', '240', '24', '10级植物', '10:24');
INSERT INTO `tb_gjd_zz` VALUES ('10', '30', '3', '10级植物', '10:3');
INSERT INTO `tb_gjd_zz` VALUES ('10', '80', '8', '10级植物', '10:8');
INSERT INTO `tb_gjd_zz` VALUES ('1', '10', '1', '1级植物', '1:1');
INSERT INTO `tb_gjd_zz` VALUES ('1', '240', '24', '1级植物', '1:24');
INSERT INTO `tb_gjd_zz` VALUES ('1', '30', '3', '1级植物', '1:3');
INSERT INTO `tb_gjd_zz` VALUES ('1', '80', '8', '1级植物', '1:8');
INSERT INTO `tb_gjd_zz` VALUES ('5', '10', '1', '5级植物', '5:1');
INSERT INTO `tb_gjd_zz` VALUES ('5', '240', '24', '5级植物', '5:24');
INSERT INTO `tb_gjd_zz` VALUES ('5', '30', '3', '5级植物', '5:3');
INSERT INTO `tb_gjd_zz` VALUES ('5', '80', '8', '5级植物', '5:8');

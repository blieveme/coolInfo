/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50508
Source Host           : localhost:3306
Source Database       : cool_info

Target Server Type    : MYSQL
Target Server Version : 50508
File Encoding         : 65001

Date: 2011-05-15 23:34:42
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `attach`
-- ----------------------------
DROP TABLE IF EXISTS `attach`;
CREATE TABLE `attach` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `info_id` int(10) unsigned NOT NULL,
  `f_name` char(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of attach
-- ----------------------------

-- ----------------------------
-- Table structure for `category`
-- ----------------------------
DROP TABLE IF EXISTS `category`;
CREATE TABLE `category` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` char(50) NOT NULL,
  `parent_id` int(10) unsigned NOT NULL DEFAULT '0',
  `sort` tinyint(3) unsigned DEFAULT '0',
  `path` char(50) DEFAULT ',0,',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of category
-- ----------------------------

-- ----------------------------
-- Table structure for `info`
-- ----------------------------
DROP TABLE IF EXISTS `info`;
CREATE TABLE `info` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` char(150) NOT NULL,
  `content` text NOT NULL,
  `c_time` date NOT NULL,
  `is_pub` tinyint(1) DEFAULT '0',
  `cate_id` int(10) unsigned NOT NULL,
  `r_times` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of info
-- ----------------------------

-- ----------------------------
-- Table structure for `power`
-- ----------------------------
DROP TABLE IF EXISTS `power`;
CREATE TABLE `power` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` char(50) NOT NULL,
  `passwd` char(100) NOT NULL,
  `l_login_time` date DEFAULT NULL,
  `l_login_ip` char(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of power
-- ----------------------------
INSERT INTO `power` VALUES ('1', 'power', '0cb6341143df93ce45e35e2db9e2e9c6', '2011-05-15', '127.0.0.1');

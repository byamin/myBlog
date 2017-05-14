/*
Navicat MySQL Data Transfer

Source Server         : local
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : myblog

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2017-05-14 23:28:15
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for admin_login
-- ----------------------------
DROP TABLE IF EXISTS `admin_login`;
CREATE TABLE `admin_login` (
  `id` int(9) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `user_name` varchar(40) NOT NULL COMMENT '用户名',
  `password` varchar(40) NOT NULL COMMENT '密码',
  `salt` varchar(255) DEFAULT NULL COMMENT '盐',
  PRIMARY KEY (`id`),
  UNIQUE KEY `un_u` (`user_name`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of admin_login
-- ----------------------------
INSERT INTO `admin_login` VALUES ('5', 'admin', '4725e45901368a2abde2d29a9e63586d', 'FxgbNDyZHZBMD4+87v5lEQ==');
INSERT INTO `admin_login` VALUES ('6', 'test', '39996fb885aaca1febd4cfc29e605e66', 'ft4Qt/oipdmOr9brww4qeQ==');

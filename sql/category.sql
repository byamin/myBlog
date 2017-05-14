/*
Navicat MySQL Data Transfer

Source Server         : local
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : myblog

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2017-05-14 23:28:27
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for category
-- ----------------------------
DROP TABLE IF EXISTS `category`;
CREATE TABLE `category` (
  `id` int(9) NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `category_name` varchar(255) DEFAULT NULL COMMENT '分类名称',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0 显示 1不显示',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of category
-- ----------------------------
INSERT INTO `category` VALUES ('1', '程序设计', '0');
INSERT INTO `category` VALUES ('2', '网站前端', '0');
INSERT INTO `category` VALUES ('3', '测试分类', '0');
INSERT INTO `category` VALUES ('4', '技术分享', '0');

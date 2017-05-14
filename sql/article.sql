/*
Navicat MySQL Data Transfer

Source Server         : local
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : myblog

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2017-05-14 23:28:22
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for article
-- ----------------------------
DROP TABLE IF EXISTS `article`;
CREATE TABLE `article` (
  `id` int(9) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `title` varchar(255) DEFAULT NULL COMMENT '文章标题',
  `category_id` int(9) DEFAULT '0' COMMENT '分类id',
  `cover_img` varchar(255) DEFAULT NULL COMMENT '封面图',
  `content` varchar(255) DEFAULT NULL COMMENT '文章内容',
  `add_time` datetime DEFAULT NULL COMMENT '文章添加时间',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0 显示 1不显示',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of article
-- ----------------------------
INSERT INTO `article` VALUES ('1', '测试1', '1', 'img/article/cover/1494426485bd.png', '<p>测试1<img src=\"http://7xsvey.com1.z0.glb.clouddn.com/1494426474.png\" title=\"1494426474.png\" alt=\"bd.png\"/></p>', '2017-05-10 22:28:05', '1');
INSERT INTO `article` VALUES ('2', '测试1', '1', 'img/article/cover/1494509230bd.png', '<p>测试1</p>', '2017-05-11 21:27:10', '0');

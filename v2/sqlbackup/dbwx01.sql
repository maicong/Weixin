/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50538
Source Host           : localhost:3306
Source Database       : dbwx01

Target Server Type    : MYSQL
Target Server Version : 50538
File Encoding         : 65001

Date: 2014-10-15 12:10:06
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for wx_chat
-- ----------------------------
DROP TABLE IF EXISTS `wx_chat`;
CREATE TABLE `wx_chat` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(16) DEFAULT NULL,
  `key` varchar(200) DEFAULT NULL,
  `note` text,
  PRIMARY KEY (`id`),
  KEY `key` (`key`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wx_chat
-- ----------------------------
INSERT INTO `wx_chat` VALUES ('1', 'text', 'HELLO2BIZUSER', '感谢关注上海[***]');
INSERT INTO `wx_chat` VALUES ('2', 'text', 'SUBSCRIBE', '感谢关注上海[***]');
INSERT INTO `wx_chat` VALUES ('3', 'text', 'UNSUBSCRIBE', '你就这么忍心抛弃我吗？');
INSERT INTO `wx_chat` VALUES ('4', 'text', 'HELP', '您好，请问您需要什么帮助？');
INSERT INTO `wx_chat` VALUES ('5', 'text', '你们是做什么的', '我们是[***]公司，是专业[***]的。');

-- ----------------------------
-- Table structure for wx_user
-- ----------------------------
DROP TABLE IF EXISTS `wx_user`;
CREATE TABLE `wx_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user` varchar(32) CHARACTER SET utf8 DEFAULT NULL,
  `pwd` varchar(40) CHARACTER SET utf8 DEFAULT NULL,
  `regtime` int(10) DEFAULT NULL,
  `regip` varchar(15) CHARACTER SET utf8 DEFAULT NULL,
  `lastime` int(10) DEFAULT NULL,
  `lastip` varchar(15) CHARACTER SET utf8 DEFAULT NULL,
  `hashkey` varchar(36) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user` (`user`,`hashkey`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of wx_user
-- ----------------------------
INSERT INTO `wx_user` VALUES ('1', 'admin', '90b9aa7e25f80cf4f64e990b78a9fc5ebd6cecad', '0', '0', '0', '0', '0');

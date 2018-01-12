/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : nianhui

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2018-01-04 15:00:41
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for setp4
-- ----------------------------
DROP TABLE IF EXISTS `2018_setp4`;
CREATE TABLE `2018_setp4` (
  `presentId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `level` int(4) NOT NULL,
  `sentId` int(8) DEFAULT NULL,
  `sentDatetime` datetime DEFAULT NULL,
  PRIMARY KEY (`presentId`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

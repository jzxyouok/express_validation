/*
Navicat MySQL Data Transfer

Source Server         : mysql
Source Server Version : 50709
Source Host           : localhost:3306
Source Database       : xx

Target Server Type    : MYSQL
Target Server Version : 50709
File Encoding         : 65001

Date: 2016-05-29 10:59:55
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for juba_original
-- ----------------------------
DROP TABLE IF EXISTS `juba_original`;
CREATE TABLE `juba_original` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `stu_id` varchar(15) NOT NULL,
  `name` varchar(10) NOT NULL,
  `card_id` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28633 DEFAULT CHARSET=utf8;

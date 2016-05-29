/*
Navicat MySQL Data Transfer

Source Server         : mysql
Source Server Version : 50709
Source Host           : localhost:3306
Source Database       : xx

Target Server Type    : MYSQL
Target Server Version : 50709
File Encoding         : 65001

Date: 2016-05-29 11:00:02
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for juba_user
-- ----------------------------
DROP TABLE IF EXISTS `juba_user`;
CREATE TABLE `juba_user` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `open_id` varchar(50) NOT NULL,
  `stu_id` varchar(15) CHARACTER SET latin1 NOT NULL,
  `name` varchar(20) NOT NULL,
  `phone` varchar(13) CHARACTER SET latin1 NOT NULL,
  `card_id` varchar(25) CHARACTER SET latin1 NOT NULL,
  `pic` longblob NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

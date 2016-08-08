/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 50505
 Source Host           : localhost
 Source Database       : ntnq4

 Target Server Type    : MySQL
 Target Server Version : 50505
 File Encoding         : utf-8

 Date: 08/08/2016 15:29:07 PM
*/

SET NAMES utf8;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `subject_class`
-- ----------------------------
DROP TABLE IF EXISTS `subject_class`;
CREATE TABLE `subject_class` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `subject_id` int(11) DEFAULT NULL,
  `timelearning` varchar(200) DEFAULT NULL,
  `fromhours` varchar(100) DEFAULT NULL,
  `tohours` varchar(100) DEFAULT NULL,
  `teacher_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `subject_class`
-- ----------------------------
BEGIN;
INSERT INTO `subject_class` VALUES ('1', '4', ',mondaytuesday', '10h30', '12h30', '1'), ('2', '4', ',saturdaysunday', '19h30', '21h30', '2'), ('3', '5', ',mondaytuesday', '10h30', '12h30', '1');
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;

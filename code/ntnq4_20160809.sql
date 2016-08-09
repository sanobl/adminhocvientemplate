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

 Date: 08/09/2016 10:10:41 AM
*/

SET NAMES utf8;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `genbillcode1`
-- ----------------------------
DROP TABLE IF EXISTS `genbillcode1`;
CREATE TABLE `genbillcode1` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `datenow` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `genbillcode1`
-- ----------------------------
BEGIN;
INSERT INTO `genbillcode1` VALUES ('1', '2016-08-09 06:53:55'), ('2', '2016-08-09 07:18:09'), ('3', '2016-08-09 07:20:55');
COMMIT;

-- ----------------------------
--  Table structure for `migrations`
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
--  Records of `migrations`
-- ----------------------------
BEGIN;
INSERT INTO `migrations` VALUES ('2014_10_12_000000_create_users_table', '1'), ('2014_10_12_100000_create_password_resets_table', '1'), ('2016_07_24_155509_create_teachers_table', '1');
COMMIT;

-- ----------------------------
--  Table structure for `password_resets`
-- ----------------------------
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
--  Table structure for `student_bill`
-- ----------------------------
DROP TABLE IF EXISTS `student_bill`;
CREATE TABLE `student_bill` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bill_code` varchar(200) DEFAULT NULL,
  `student_id` int(11) DEFAULT NULL,
  `created_by` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `money` int(11) DEFAULT NULL,
  `is_status` bit(1) DEFAULT NULL,
  `subject_id` int(11) DEFAULT NULL,
  `content` varchar(1000) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `student_bill`
-- ----------------------------
BEGIN;
INSERT INTO `student_bill` VALUES ('1', '0003232', '1', 'bangnk', '2016-08-02 12:10:08', '20000', null, null, null), ('2', '0002232', '2', 'bangnk', '2016-08-02 12:10:23', '1000', null, null, null), ('3', '000213', '3', 'bangnk', '2016-08-02 12:10:56', '2929', null, null, null), ('4', '000001', '8', 'thuatnv', null, '200000', b'0', null, null), ('5', '000002', '9', 'thuatnv', '2016-08-09 07:18:09', '200000', b'0', '11', ''), ('6', '000003', '10', 'thuatnv', '2016-08-09 07:20:55', '200000', b'0', '11', '');
COMMIT;

-- ----------------------------
--  Table structure for `student_detail`
-- ----------------------------
DROP TABLE IF EXISTS `student_detail`;
CREATE TABLE `student_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) DEFAULT NULL,
  `pay_period` varchar(200) DEFAULT NULL,
  `pay_money` int(11) DEFAULT NULL,
  `pay_total` int(11) DEFAULT NULL,
  `created_by` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `is_status` bit(1) DEFAULT NULL,
  `subject_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `student_detail`
-- ----------------------------
BEGIN;
INSERT INTO `student_detail` VALUES ('1', '8', '08/2016', '200000', '200000', 'thuatnv', '2016-08-09 06:53:55', b'0', null), ('2', '10', '08/2016', '200000', '200000', 'thuatnv', '2016-08-09 07:20:55', b'0', '11');
COMMIT;

-- ----------------------------
--  Table structure for `students`
-- ----------------------------
DROP TABLE IF EXISTS `students`;
CREATE TABLE `students` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `student_fullname` varchar(200) DEFAULT NULL,
  `student_phone` varchar(100) DEFAULT NULL,
  `student_email` varchar(200) DEFAULT NULL,
  `parent_fullname` varchar(200) DEFAULT NULL,
  `parent_phone` varchar(100) DEFAULT NULL,
  `parent_email` varchar(200) DEFAULT NULL,
  `is_old_student` bit(1) DEFAULT NULL,
  `subject_id` int(11) DEFAULT NULL,
  `subject_class_id` int(11) DEFAULT NULL,
  `money_total` int(11) DEFAULT NULL,
  `money_detail` int(11) DEFAULT NULL,
  `payment_type` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` varchar(100) DEFAULT NULL,
  `updated_by` varchar(100) DEFAULT NULL,
  `money_percent_for_teacher` int(10) DEFAULT NULL,
  `money_of_teacher` int(11) DEFAULT NULL,
  `teacher_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `students`
-- ----------------------------
BEGIN;
INSERT INTO `students` VALUES ('1', 'Bang', '01782', 'ba@a.vng', 'Nguyen Khanh Bang', '018293', 'ba@vng.com', b'1', '1', '1', '100', '10', '1', '2016-08-02 11:07:47', '2016-08-02 11:07:52', 'bangnk', 'bangnk', null, null, null), ('2', 'A', 'B', null, 'C', null, null, b'0', '1', '1', '100', '10', '2', '2016-08-02 12:44:35', null, null, null, null, null, null), ('3', 'D', 'D', 'D', 'D', 'D', 'D', b'0', '2', '2', '10000', '100', '1', '2016-08-02 12:45:35', '2016-08-02 12:45:40', null, null, null, null, null), ('4', 'Bang', '01682682578', 'a@a.vn', 'Baba', '01682682578', 'b@b.vn', b'1', '1', '1', '122000', null, '0', '2016-08-03 16:30:10', null, 'thuatnv', null, null, null, null), ('5', '', '', '', '', '', '', b'1', '2', '2', '2500000', null, '2', '2016-08-03 16:48:24', null, 'thuatnv', null, null, null, null), ('6', 'Nguyen khanh A', '01682682578', 'bangnk@vng.com.vn', '', '', '', b'0', '11', '17', '200000', null, '0', '2016-08-09 06:08:33', null, 'thuatnv', null, null, null, null), ('7', 'Nguyen Van Canh', '01682682578', 'bangnk@vng.com.vn', '', '', '', b'0', '11', '18', '200000', null, '0', '2016-08-09 06:08:58', null, 'thuatnv', null, null, null, null), ('8', 'Nguyen Khanh Bang', 'aadad', 'khanhbangpro@gmail.com', '', '', '', b'0', '11', '18', '200000', null, '0', '2016-08-09 06:53:55', null, 'thuatnv', null, null, null, null), ('9', 'Dao A', '1921083091', 'bangnk@vng.com.vn', 'Ngoj', 'Sd', 'sdsd', b'0', '11', '18', '200000', null, '0', '2016-08-09 07:18:09', null, 'thuatnv', null, null, null, null), ('10', 'Dao B', '124234', 'khanhbangpro@gmail.com', 'Nguyen', '239812', 'khanhbangpro@gmail.com', b'0', '11', '18', '200000', null, '0', '2016-08-09 07:20:55', null, 'thuatnv', null, null, null, null);
COMMIT;

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
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `subject_class`
-- ----------------------------
BEGIN;
INSERT INTO `subject_class` VALUES ('1', '4', ',mondaytuesday', '10h30', '12h30', '1'), ('2', '4', ',saturdaysunday', '19h30', '21h30', '2'), ('3', '5', ',mondaytuesday', '10h30', '12h30', '1'), ('4', '6', ',monday,tuesday', '10h30', '20h30', '1'), ('5', '6', ',friday,saturday', '10h30', '21h30', '2'), ('6', '7', '', '', '', '0'), ('7', '8', '', '', '', '1'), ('8', '9', 'monday,tuesday,', '10h30', '12h30', '1'), ('9', '9', 'wednesday,thursday,', '20h30', '21h30', '2'), ('10', '10', 'monday,tuesday,', '10h20', '12h30', '1'), ('17', '11', 'monday,tuesday', '7h30', '9h30', '1'), ('18', '11', 'tuesday,wednesday', '9h30', '11h30', '1'), ('19', '11', 'thursday,friday,saturday', '13h30', '17h30', '2');
COMMIT;

-- ----------------------------
--  Table structure for `subject_detail`
-- ----------------------------
DROP TABLE IF EXISTS `subject_detail`;
CREATE TABLE `subject_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pay_period` varchar(100) DEFAULT NULL,
  `pay_money` int(11) DEFAULT NULL,
  `subject_id` int(11) DEFAULT NULL,
  `payment_type` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `subject_detail`
-- ----------------------------
BEGIN;
INSERT INTO `subject_detail` VALUES ('8', 'All', '2500000', '2', '1'), ('9', 'T8/2016', '1250000', '2', '2'), ('10', 'T8/2016', '1250000', '2', '2'), ('11', 'P1', '1250000', '2', '3'), ('12', 'P2', '1250000', '2', '3'), ('13', 'All', '10000', '4', '1'), ('14', 'T8/2016', '5000', '4', '2'), ('15', 'T8/2016', '5000', '4', '2'), ('16', 'P1', '5000', '4', '3'), ('17', 'P2', '5000', '4', '3'), ('18', 'All', '122000', '5', '1'), ('19', 'T8/2016', '61000', '5', '2'), ('20', 'T8/2016', '61000', '5', '2'), ('21', 'P1', '61000', '5', '3'), ('22', 'P2', '61000', '5', '3'), ('23', 'All', '200', '6', '1'), ('24', 'T8/2016', '100', '6', '2'), ('25', 'T8/2016', '100', '6', '2'), ('26', 'P1', '100', '6', '3'), ('27', 'P2', '100', '6', '3');
COMMIT;

-- ----------------------------
--  Table structure for `subjects`
-- ----------------------------
DROP TABLE IF EXISTS `subjects`;
CREATE TABLE `subjects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(200) DEFAULT NULL,
  `description` varchar(1000) DEFAULT NULL,
  `subject_type` tinyint(2) DEFAULT NULL,
  `fromdate` date DEFAULT NULL,
  `todate` date DEFAULT NULL,
  `money_total` int(11) DEFAULT NULL,
  `payment_type` tinyint(4) DEFAULT NULL,
  `phase` int(10) DEFAULT NULL,
  `isactive` bit(1) DEFAULT NULL,
  `isdelete` bit(1) DEFAULT NULL,
  `money_detail` int(11) DEFAULT NULL,
  `is_support_old_student` bit(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `money_percent_for_teacher` int(10) DEFAULT NULL,
  `subject_payment_type` tinyint(2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `subjects`
-- ----------------------------
BEGIN;
INSERT INTO `subjects` VALUES ('1', 'Võ truyền thống', 'mô tả', '2', '1970-01-01', '1970-01-01', '122000', '2', '2', b'1', null, null, b'1', '2016-08-03 13:52:27', '2016-08-03 14:03:22', '40', '1'), ('2', 'Võ Vovinam ngắn hạn', 'mô tả', '1', '2016-08-01', '2016-09-30', '2500000', '0', '2', b'1', null, null, b'1', '2016-08-03 14:04:41', '2016-08-03 14:04:52', '30', '1'), ('3', '', '', '1', '1970-01-01', '1970-01-01', '0', '0', '2', b'0', null, null, b'0', '2016-08-08 06:10:28', '2016-08-08 06:10:28', '0', '2'), ('4', 'A', 'B', '1', '2016-08-01', '2016-09-06', '10000', '0', '2', b'1', null, null, b'1', '2016-08-08 06:28:55', '2016-08-08 06:28:55', '12', '1'), ('5', 'A', 'B', '1', '2016-08-01', '2016-09-08', '122000', '0', '2', b'1', null, null, b'1', '2016-08-08 06:30:57', '2016-08-08 06:30:57', '23', '1'), ('6', 'Demo A', 'Demo A', '1', '2016-08-01', '2016-09-10', '200', '0', '2', b'1', null, null, b'1', '2016-08-09 04:43:20', '2016-08-09 04:43:20', '20', '1'), ('7', 'Demo ko co giao vien', 'demo ko co giao vien', '2', '1970-01-01', '1970-01-01', '100', '2', '2', b'1', null, null, b'0', '2016-08-09 04:46:31', '2016-08-09 04:46:31', '10', '2'), ('8', '', '', '2', '1970-01-01', '1970-01-01', '0', '2', '2', b'0', null, null, b'0', '2016-08-09 04:52:32', '2016-08-09 04:52:32', '0', '0'), ('9', 'Demo khoa 1', 'demo', '2', '1970-01-01', '1970-01-01', '200', '2', '2', b'1', null, null, b'1', '2016-08-09 04:54:18', '2016-08-09 04:54:18', '10', '0'), ('10', 'demo 1', 'sa', '2', '1970-01-01', '1970-01-01', '100000', '2', '2', b'1', null, null, b'1', '2016-08-09 05:08:26', '2016-08-09 05:08:26', '10', '1'), ('11', 'Demo 5', 'Demo 5', '2', '1970-01-01', '1970-01-01', '200000', '2', '2', b'1', null, null, b'1', '2016-08-09 05:19:55', '2016-08-09 05:25:14', '10', '1');
COMMIT;

-- ----------------------------
--  Table structure for `teachers`
-- ----------------------------
DROP TABLE IF EXISTS `teachers`;
CREATE TABLE `teachers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `isactive` tinyint(1) NOT NULL,
  `isdelete` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `address` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
--  Records of `teachers`
-- ----------------------------
BEGIN;
INSERT INTO `teachers` VALUES ('1', 'Nguyễn Văn Thảo', 'thao@gmail.com', '01682682578', '1', '0', '2016-08-03 13:34:49', '2016-08-03 13:34:49', 'Quận 4 Hồ chí Minh'), ('2', 'Nguyễn Văn B', 'khanhbangpro@gmail.com', '01682682578', '1', '0', '2016-08-03 13:35:06', '2016-08-03 13:35:06', '58 Nguyen Trung Truc');
COMMIT;

-- ----------------------------
--  Table structure for `users`
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `phone` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `full_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `isdelete` tinyint(4) DEFAULT NULL,
  `isadmin` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
--  Records of `users`
-- ----------------------------
BEGIN;
INSERT INTO `users` VALUES ('1', 'bangnk', 'bangnk@vng.com.vn', 'e10adc3949ba59abbe56e057f20f883e', null, '2016-08-03 13:11:08', '2016-08-03 13:11:08', '012890132', 'Nguyen Khanh', '0', '1');
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;

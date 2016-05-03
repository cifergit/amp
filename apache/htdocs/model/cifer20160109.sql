/*
Navicat MySQL Data Transfer

Source Server         : mysql5
Source Server Version : 50519
Source Host           : localhost:3306
Source Database       : cifer

Target Server Type    : MYSQL
Target Server Version : 50519
File Encoding         : 65001

Date: 2016-01-09 23:19:04
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for t_invite_code
-- ----------------------------
DROP TABLE IF EXISTS `t_invite_code`;
CREATE TABLE `t_invite_code` (
  `id` int(12) NOT NULL,
  `invite_code` varchar(16) DEFAULT NULL,
  `create_user_id` int(10) DEFAULT NULL,
  `used_user_id` int(10) DEFAULT NULL,
  `create_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_invite_code
-- ----------------------------

-- ----------------------------
-- Table structure for t_movie
-- ----------------------------
DROP TABLE IF EXISTS `t_movie`;
CREATE TABLE `t_movie` (
  `id` int(7) NOT NULL AUTO_INCREMENT,
  `name` varchar(40) NOT NULL,
  `sm_pic` varchar(20) DEFAULT NULL,
  `movie_point` varchar(600) DEFAULT NULL,
  `create_time` datetime DEFAULT NULL,
  `modify_time` datetime DEFAULT NULL,
  `user_id` int(10) DEFAULT NULL,
  `pv` int(14) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for t_user
-- ----------------------------
DROP TABLE IF EXISTS `t_user`;
CREATE TABLE `t_user` (
  `id` int(10) NOT NULL,
  `name` varchar(30) NOT NULL,
  `password` varchar(10) NOT NULL,
  `birthday` date DEFAULT NULL,
  `validate_code` varchar(4) DEFAULT NULL,
  `error_number` int(2) DEFAULT '0',
  `lock_time` datetime DEFAULT NULL,
  `score` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

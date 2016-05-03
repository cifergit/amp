/*
Navicat MySQL Data Transfer

Source Server         : mysql5
Source Server Version : 50519
Source Host           : localhost:3306
Source Database       : cifer

Target Server Type    : MYSQL
Target Server Version : 50519
File Encoding         : 65001

Date: 2016-01-19 00:14:59
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for t_invite_code
-- ----------------------------
DROP TABLE IF EXISTS `t_invite_code`;
CREATE TABLE `t_invite_code` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
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
  `movie_point` varchar(600) DEFAULT NULL,
  `create_time` datetime DEFAULT NULL,
  `modify_time` datetime DEFAULT NULL,
  `user_id` int(10) DEFAULT NULL,
  `pv` int(14) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_movie
-- ----------------------------

-- ----------------------------
-- Table structure for t_movie_day_recommend
-- ----------------------------
DROP TABLE IF EXISTS `t_movie_day_recommend`;
CREATE TABLE `t_movie_day_recommend` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `name` varchar(40) NOT NULL,
  `comment` varchar(600) DEFAULT NULL,
  `recommend_time` date DEFAULT NULL,
  `create_time` date DEFAULT NULL,
  `user_id` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  UNIQUE KEY `recommend_time` (`recommend_time`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_movie_day_recommend
-- ----------------------------
INSERT INTO `t_movie_day_recommend` VALUES ('1', '缺席的人', '假如生活欺骗了你，就算无从下手，也要装做一切在掌控中。', '2016-01-01', '2016-01-05', null);
INSERT INTO `t_movie_day_recommend` VALUES ('2', '入殓师', '不理解是因为不了解。', '2016-01-02', '2016-01-05', null);
INSERT INTO `t_movie_day_recommend` VALUES ('3', '银翼杀手', '谁又分的清呢？', '2016-01-03', '2016-01-05', null);
INSERT INTO `t_movie_day_recommend` VALUES ('4', '大鱼', '梦幻传奇', '2016-01-04', '2016-01-05', null);
INSERT INTO `t_movie_day_recommend` VALUES ('5', '本杰明·巴顿奇事', '前所未有的爱情故事。', '2016-01-05', '2016-01-05', null);
INSERT INTO `t_movie_day_recommend` VALUES ('6', '范海辛', '魔幻经典', '2016-01-06', '2016-01-05', null);
INSERT INTO `t_movie_day_recommend` VALUES ('7', '机器人总动员', '孤独中有些欢快，欢快中让人思索。', '2016-01-07', '2016-01-05', null);
INSERT INTO `t_movie_day_recommend` VALUES ('8', '霸王别姬', '为戏生，为戏死。', '2016-01-08', '2016-01-06', null);
INSERT INTO `t_movie_day_recommend` VALUES ('9', '楚门的世界', '世界为你转', '2016-01-09', '2016-01-06', null);
INSERT INTO `t_movie_day_recommend` VALUES ('10', '老男孩', '（朴赞郁执导）复仇之路，心理惊悚。', '2016-01-10', '2016-01-06', null);
INSERT INTO `t_movie_day_recommend` VALUES ('11', '一代娇马', '最后一刻，整世界都沸腾了！', '2016-01-11', '2016-01-06', null);
INSERT INTO `t_movie_day_recommend` VALUES ('12', '成为简·奥斯汀', '没有撕心裂肺，却是刻骨铭心。', '2016-01-12', '2016-01-06', null);
INSERT INTO `t_movie_day_recommend` VALUES ('13', '谋杀绿脚趾', '黑色幽默，值得一看。', '2016-01-13', '2016-01-06', null);
INSERT INTO `t_movie_day_recommend` VALUES ('14', '夜访吸血鬼', '可能再不会有更好的吸血鬼电影了', '2016-01-14', '2016-01-06', null);
INSERT INTO `t_movie_day_recommend` VALUES ('15', '云图', '六重奏，犹如轮回。', '2016-01-15', '2016-01-06', null);

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

-- ----------------------------
-- Records of t_user
-- ----------------------------
INSERT INTO `t_user` VALUES ('1', '系统', '123456', '2016-01-05', '1234', '0', '2016-01-01 00:01:22', '0');

/*
Navicat MySQL Data Transfer

Source Server         : mysql5
Source Server Version : 50519
Source Host           : localhost:3306
Source Database       : cifer

Target Server Type    : MYSQL
Target Server Version : 50519
File Encoding         : 65001

Date: 2016-01-09 23:58:56
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
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

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
  `show_time` datetime DEFAULT NULL,
  `user_id` int(10) DEFAULT NULL,
  `pv` int(14) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_movie
-- ----------------------------
INSERT INTO `t_movie` VALUES ('1', '缺席的人', null, '假如生活欺骗了你，就算无从下手，也要装做一切在掌控中。', '2016-01-09 23:30:39', null, null, '1', '1');
INSERT INTO `t_movie` VALUES ('2', '入殓师', null, '不理解是因为不了解。', '2016-01-09 23:31:40', null, null, '1', '1');
INSERT INTO `t_movie` VALUES ('3', '银翼杀手', null, '谁又分的清呢？', '2016-01-09 23:32:43', null, null, '1', '1');
INSERT INTO `t_movie` VALUES ('4', '大鱼', null, '梦幻的传说，荒诞的喜剧！', '2016-01-09 23:34:01', null, null, '1', '1');
INSERT INTO `t_movie` VALUES ('5', '本杰明·巴顿奇事', null, '前所未有的爱情故事。', '2016-01-09 23:34:48', null, null, '1', '1');
INSERT INTO `t_movie` VALUES ('6', '范海辛', null, '早期狼人、吸血鬼，魔幻经典', '2016-01-09 23:35:42', null, null, '1', '1');
INSERT INTO `t_movie` VALUES ('7', '机器人总动员', null, '孤独中有些欢快，欢快中让人思索。', '2016-01-09 23:36:06', null, null, '1', '1');
INSERT INTO `t_movie` VALUES ('8', '霸王别姬', null, '不疯魔，不成活', '2016-01-09 23:38:14', null, null, '1', '1');
INSERT INTO `t_movie` VALUES ('9', '楚门的世界', null, '名字已经暴露内容', '2016-01-09 23:39:28', null, null, '1', '1');
INSERT INTO `t_movie` VALUES ('10', '赛德克·巴莱(上)太阳旗', null, '如果是狼，就是过去很多年，也还有狼性。', '2016-01-09 23:40:01', null, null, '1', '1');
INSERT INTO `t_movie` VALUES ('11', '赛德克·巴莱(下)彩虹桥', null, '我们会失败，不过这可能是我们最后的气概了', '2016-01-09 23:41:02', null, null, '1', '1');
INSERT INTO `t_movie` VALUES ('12', '夜访吸血鬼', null, '可能再不会有更好的吸血鬼电影了', '2016-01-09 23:41:21', null, null, '1', '1');
INSERT INTO `t_movie` VALUES ('13', '成为简·奥斯汀', null, '没有撕心裂肺，却是刻骨铭心。', '2016-01-09 23:42:15', null, null, '1', '1');
INSERT INTO `t_movie` VALUES ('14', '潘神的迷宫', null, '童话与现实的完美交织', '2016-01-09 23:43:02', null, null, '1', '1');
INSERT INTO `t_movie` VALUES ('15', '放牛班的春天', null, '如果愿意挖掘，每个人都有自己的位置', '2016-01-09 23:44:12', null, null, '1', '1');
INSERT INTO `t_movie` VALUES ('16', '逍遥法外', null, '天才般的演技，魔鬼般的智商', '2016-01-09 23:45:43', null, null, '1', '1');
INSERT INTO `t_movie` VALUES ('17', '一代娇马', null, '最后一刻，整世界都沸腾了！', '2016-01-09 23:46:08', null, null, '1', '1');
INSERT INTO `t_movie` VALUES ('18', '云图', null, '六重奏，六轮回', '2016-01-09 23:46:40', null, null, '1', '1');
INSERT INTO `t_movie` VALUES ('19', '荒野大镖客', null, '似乎带回了牛仔时代', '2016-01-09 23:46:57', null, null, '1', '1');
INSERT INTO `t_movie` VALUES ('20', '黄昏双镖客', null, '里应外合，牛仔经典', '2016-01-09 23:47:12', null, null, '1', '1');
INSERT INTO `t_movie` VALUES ('21', '黄金三镖客', null, '三角关系，牛仔之巅', '2016-01-09 23:47:37', null, null, '1', '1');
INSERT INTO `t_movie` VALUES ('22', '卧虎藏龙', null, '新派武侠，新高度', '2016-01-09 23:48:10', null, null, '1', '1');
INSERT INTO `t_movie` VALUES ('23', '谋杀绿脚趾', null, '黑色幽默，值得一看。', '2016-01-09 23:48:38', null, null, '1', '1');
INSERT INTO `t_movie` VALUES ('24', '盗贼同盟', null, '剧情复杂却不混乱，高潮跌宕不休', '2016-01-09 23:49:44', null, null, '1', '1');
INSERT INTO `t_movie` VALUES ('25', '致命魔术', null, '没有极致，只有更极致', '2016-01-09 23:50:01', null, null, '1', '1');
INSERT INTO `t_movie` VALUES ('26', '海上钢琴师', null, '船下的世界，看不到尽头，无法掌控', '2016-01-09 23:50:27', null, null, '1', '1');
INSERT INTO `t_movie` VALUES ('27', '七武士', null, '古代最真实的战争片', '2016-01-09 23:50:41', null, null, '1', '1');
INSERT INTO `t_movie` VALUES ('28', '独行侠', null, '再现牛仔经典', '2016-01-09 23:51:24', null, null, '1', '1');
INSERT INTO `t_movie` VALUES ('29', '宇宙威龙', null, '出乎意料', '2016-01-09 23:52:25', null, null, '1', '1');
INSERT INTO `t_movie` VALUES ('30', '史密斯夫妇', null, '家庭与杀手', '2016-01-09 23:55:00', null, null, '1', '1');

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
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_user
-- ----------------------------

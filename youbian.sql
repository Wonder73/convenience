/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50714
Source Host           : localhost:3306
Source Database       : youbian

Target Server Type    : MYSQL
Target Server Version : 50714
File Encoding         : 65001

Date: 2018-11-23 21:11:37
*/

SET FOREIGN_KEY_CHECKS=0;

CREATE DATABASE IF NOT EXISTS `youbian` CHARSET UTF8;

USE `youbian`;

-- ----------------------------
-- Table structure for yb-aa
-- ----------------------------
DROP TABLE IF EXISTS `yb-aa`;
CREATE TABLE `yb-aa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `utilities_id` int(11) NOT NULL COMMENT 'utilities表的外键',
  `user_id` int(11) NOT NULL COMMENT '用户id',
  `cost` varchar(8) NOT NULL COMMENT '费用',
  `complete_pay` int(11) DEFAULT '0' COMMENT '0代表未完成支付，1代表完成支付',
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  PRIMARY KEY (`id`),
  KEY `utilities_id` (`utilities_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of yb-aa
-- ----------------------------
INSERT INTO `yb-aa` VALUES ('1', '2', '10', '500', '1', '2018-11-06 13:25:40');
INSERT INTO `yb-aa` VALUES ('2', '2', '11', '500', '0', '2018-11-06 13:25:40');
INSERT INTO `yb-aa` VALUES ('3', '5', '10', '500', '0', '2018-11-06 14:31:19');
INSERT INTO `yb-aa` VALUES ('4', '5', '11', '500', '0', '2018-11-06 14:31:19');
INSERT INTO `yb-aa` VALUES ('8', '1', '11', '500', '0', '2018-11-08 11:14:36');
INSERT INTO `yb-aa` VALUES ('5', '6', '10', '500', '0', '2018-11-06 17:12:18');
INSERT INTO `yb-aa` VALUES ('6', '6', '11', '500', '0', '2018-11-06 17:12:18');
INSERT INTO `yb-aa` VALUES ('7', '1', '10', '500', '1', '2018-11-08 11:14:36');

-- ----------------------------
-- Table structure for yb-app
-- ----------------------------
DROP TABLE IF EXISTS `yb-app`;
CREATE TABLE `yb-app` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `app_name` varchar(32) NOT NULL COMMENT '应用名称',
  `app_address` varchar(128) NOT NULL COMMENT '应用地址',
  `app_logo` varchar(64) NOT NULL COMMENT '应用logo',
  `app_permission` varchar(32) NOT NULL COMMENT '应用权限',
  `app_description` text COMMENT '应用描述',
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of yb-app
-- ----------------------------
INSERT INTO `yb-app` VALUES ('8', '333333333333', '3333333333333333', './uploads/app_logo/5be9927ecc4792018-11-12-22-47-26.jpg', '4,3,2,1', null, '2018-11-12 22:47:26');
INSERT INTO `yb-app` VALUES ('7', '22222222222', '222222222222222', './uploads/app_logo/5be98e06d93622018-11-12-22-28-22.jpg', '4,3,2,1', null, '2018-11-12 22:28:22');
INSERT INTO `yb-app` VALUES ('3', '11111111111', '111111111111111111111111111', './uploads/app_logo/5bea34fbc80642018-11-13-10-20-43.jpg', '4', null, '2018-11-12 18:07:14');
INSERT INTO `yb-app` VALUES ('4', '1111111', '1111111111111111111111111', './uploads/app_logo/5be95135402ab2018-11-12-18-08-53.jpg', '4,2', null, '2018-11-12 18:08:53');
INSERT INTO `yb-app` VALUES ('5', '11111111111111111111111111111', '1111111111111111111111111111', './uploads/app_logo/5be95161e92ba2018-11-12-18-09-37.jpg', '4,3', null, '2018-11-12 18:09:37');
INSERT INTO `yb-app` VALUES ('9', '444444444444', '4444444444444', './uploads/app_logo/5be992f5d55ff2018-11-12-22-49-25.jpg', '3,4', null, '2018-11-12 22:49:25');
INSERT INTO `yb-app` VALUES ('10', '55555555555', '555555555555', './uploads/app_logo/5be993daa1fb92018-11-12-22-53-14.jpg', '1,2,3,4', null, '2018-11-12 22:53:14');
INSERT INTO `yb-app` VALUES ('11', '6666666666666', '6666666666666666', './uploads/app_logo/5be994967e2af2018-11-12-22-56-22.jpg', '4,3,2,1', null, '2018-11-12 22:56:22');
INSERT INTO `yb-app` VALUES ('12', '111111111111111112222', '111111111111222', './uploads/app_logo/5bea33ad008dd2018-11-13-10-15-09.jpg', '3,2,1,4', null, '2018-11-13 10:15:09');
INSERT INTO `yb-app` VALUES ('13', '水电费', 'utilities', './uploads/app_logo/5bea3a4a929b52018-11-13-10-43-22.jpg', '1,2,3,4', '水电费，用于用户进行一些水电方面的支出', '2018-11-13 10:43:22');
INSERT INTO `yb-app` VALUES ('14', '水电费管理', 'utilities-manage', './uploads/app_logo/5bea3d36bd2b82018-11-13-10-55-50.jpg', '4', '用于管理水电费', '2018-11-13 10:55:50');
INSERT INTO `yb-app` VALUES ('15', '教学教务系统', 'http://jwxt.gdpi.edu.cn/(qtge5zmwwddqgi45lt5xdt45)/Default2.aspx', './uploads/app_logo/5bebcf95bf9b92018-11-14-15-32-37.jpg', '1,2,3,4', '教学教务系统', '2018-11-14 15:32:37');

-- ----------------------------
-- Table structure for yb-book
-- ----------------------------
DROP TABLE IF EXISTS `yb-book`;
CREATE TABLE `yb-book` (
  `id` int(32) NOT NULL AUTO_INCREMENT COMMENT '书ID',
  `user_id` int(32) DEFAULT NULL COMMENT '用户ID',
  `book_name` varchar(255) NOT NULL COMMENT '书名',
  `book_desc` varchar(255) NOT NULL COMMENT '书描述',
  `book_pic` varchar(255) NOT NULL COMMENT '书图片',
  `book_cate` varchar(255) NOT NULL COMMENT '类型',
  `book_owner` varchar(255) NOT NULL COMMENT '书现所在',
  `is_lend` int(11) NOT NULL DEFAULT '1' COMMENT '是否可借',
  `contact_info` varchar(255) NOT NULL COMMENT '联系方式',
  `created_at` timestamp NOT NULL COMMENT '共享时间',
  `updated_at` timestamp NOT NULL COMMENT '结束时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of yb-book
-- ----------------------------
INSERT INTO `yb-book` VALUES ('1', '1', '百年孤独', '作品描写了布恩迪亚家族七代人的传奇故事，以及加勒比海沿岸小镇马孔多的百年兴衰，反映了拉丁美洲一个世纪以来风云变幻的历史。作品融入神话传说、民间故事、宗教典故等神秘因素，巧妙地糅合了现实与虚幻，展现出一个瑰丽的想象世界，成为20世纪重要的经典文学巨著之一。', '/uploads/image/book.jpg', '小说', '无名氏', '2', '123456789', '2018-11-07 16:00:00', '2018-11-09 22:52:06');
INSERT INTO `yb-book` VALUES ('2', '2', '百年', '作品描写了布恩迪亚家族七代人的传奇故事，以及加勒比海沿岸小镇马孔多的百年兴衰，反映了拉丁美洲一个世纪以来风云变幻的历史。作品融入神话传说、民间故事、宗教典故等神秘因素，巧妙地糅合了现实与虚幻，展现出一个瑰丽的想象世界，成为20世纪重要的经典文学巨著之一。', '/uploads/image/book.jpg', '专业教科书', '无名氏', '2', '123456789', '2018-11-07 16:00:00', '2018-11-09 22:48:24');
INSERT INTO `yb-book` VALUES ('3', '2', '百年孤独', '作品描写了布恩迪亚家族七代人的传奇故事，以及加勒比海沿岸小镇马孔多的百年兴衰，反映了拉丁美洲一个世纪以来风云变幻的历史。作品融入神话传说、民间故事、宗教典故等神秘因素，巧妙地糅合了现实与虚幻，展现出一个瑰丽的想象世界，成为20世纪重要的经典文学巨著之一。', 'image/book/book.jpg', '公共教科书', '无名氏', '2', '123456789', '2018-11-07 16:00:00', '2018-11-09 23:49:59');
INSERT INTO `yb-book` VALUES ('4', '2', '百年孤独', '作品描写了布恩迪亚家族七代人的传奇故事，以及加勒比海沿岸小镇马孔多的百年兴衰，反映了拉丁美洲一个世纪以来风云变幻的历史。作品融入神话传说、民间故事、宗教典故等神秘因素，巧妙地糅合了现实与虚幻，展现出一个瑰丽的想象世界，成为20世纪重要的经典文学巨著之一。', 'image/book/book.jpg', '历史文化', '无名氏', '1', '123456789', '2018-11-07 16:00:00', '2018-11-15 16:00:00');
INSERT INTO `yb-book` VALUES ('5', '5', '百年孤独', '作品描写了布恩迪亚家族七代人的传奇故事，以及加勒比海沿岸小镇马孔多的百年兴衰，反映了拉丁美洲一个世纪以来风云变幻的历史。作品融入神话传说、民间故事、宗教典故等神秘因素，巧妙地糅合了现实与虚幻，展现出一个瑰丽的想象世界，成为20世纪重要的经典文学巨著之一。', 'image/book/book.jpg', '考证资料', '无名氏', '1', '123456789', '2018-11-07 16:00:00', '2018-11-15 16:00:00');
INSERT INTO `yb-book` VALUES ('6', '6', '百年孤独', '作品描写了布恩迪亚家族七代人的传奇故事，以及加勒比海沿岸小镇马孔多的百年兴衰，反映了拉丁美洲一个世纪以来风云变幻的历史。作品融入神话传说、民间故事、宗教典故等神秘因素，巧妙地糅合了现实与虚幻，展现出一个瑰丽的想象世界，成为20世纪重要的经典文学巨著之一。', 'image/book/book.jpg', '哲学', '无名氏', '1', '123456789', '2018-11-07 16:00:00', '2018-11-15 16:00:00');
INSERT INTO `yb-book` VALUES ('7', '7', '百年孤独', '作品描写了布恩迪亚家族七代人的传奇故事，以及加勒比海沿岸小镇马孔多的百年兴衰，反映了拉丁美洲一个世纪以来风云变幻的历史。作品融入神话传说、民间故事、宗教典故等神秘因素，巧妙地糅合了现实与虚幻，展现出一个瑰丽的想象世界，成为20世纪重要的经典文学巨著之一。', 'image/book/book.jpg', '其他', '无名氏', '1', '123456789', '2018-11-07 16:00:00', '2018-11-15 16:00:00');
INSERT INTO `yb-book` VALUES ('12', '2', 'adsf', 'dfeasdfa', '/uploads/books/0294e74a2b57fa09a3570948f4f44abc.jpeg', '1', 'dfe', '1', '2345254', '2018-11-06 18:50:55', '2018-11-06 18:50:55');

-- ----------------------------
-- Table structure for yb-comment
-- ----------------------------
DROP TABLE IF EXISTS `yb-comment`;
CREATE TABLE `yb-comment` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `item_id` int(11) DEFAULT NULL,
  `comment` text,
  `date` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of yb-comment
-- ----------------------------
INSERT INTO `yb-comment` VALUES ('1', '1', '1', '我要留言', '2018-11-13 11:22:41');

-- ----------------------------
-- Table structure for yb-consume
-- ----------------------------
DROP TABLE IF EXISTS `yb-consume`;
CREATE TABLE `yb-consume` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL COMMENT '用户id',
  `pay_user_id` int(11) NOT NULL COMMENT '支付人的id或收入人id',
  `organization` varchar(32) NOT NULL COMMENT '消费机构',
  `consume_type` int(11) NOT NULL COMMENT '消费类型, 0代表支出，1代表收入',
  `consume_cost` varchar(8) NOT NULL COMMENT '消费金额',
  `consume_description` text COMMENT '消费描述',
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '消费时间',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=98 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of yb-consume
-- ----------------------------
INSERT INTO `yb-consume` VALUES ('1', '10', '12', '电费', '0', '250', null, '2018-11-05 22:17:39');
INSERT INTO `yb-consume` VALUES ('2', '12', '10', '电费', '1', '250', null, '2018-11-05 22:17:39');
INSERT INTO `yb-consume` VALUES ('3', '10', '12', '电费', '0', '250', null, '2018-11-05 22:21:48');
INSERT INTO `yb-consume` VALUES ('4', '12', '10', '电费', '1', '250', null, '2018-11-05 22:21:48');
INSERT INTO `yb-consume` VALUES ('5', '10', '12', '电费', '0', '250', null, '2018-11-05 22:28:27');
INSERT INTO `yb-consume` VALUES ('6', '12', '10', '电费', '1', '250', null, '2018-11-05 22:28:27');
INSERT INTO `yb-consume` VALUES ('7', '10', '12', '电费', '0', '500', null, '2018-11-05 22:39:01');
INSERT INTO `yb-consume` VALUES ('8', '12', '10', '电费', '1', '500', null, '2018-11-05 22:39:01');
INSERT INTO `yb-consume` VALUES ('9', '10', '12', '电费', '0', '500', null, '2018-11-05 22:39:55');
INSERT INTO `yb-consume` VALUES ('10', '12', '10', '电费', '1', '500', null, '2018-11-05 22:39:55');
INSERT INTO `yb-consume` VALUES ('11', '10', '12', '电费', '0', '500', null, '2018-11-05 22:40:26');
INSERT INTO `yb-consume` VALUES ('12', '12', '10', '电费', '1', '500', null, '2018-11-05 22:40:26');
INSERT INTO `yb-consume` VALUES ('13', '10', '12', '电费', '0', '500', null, '2018-11-05 22:50:19');
INSERT INTO `yb-consume` VALUES ('14', '12', '10', '电费', '1', '500', null, '2018-11-05 22:50:19');
INSERT INTO `yb-consume` VALUES ('15', '10', '12', '电费', '0', '500', null, '2018-11-05 22:51:14');
INSERT INTO `yb-consume` VALUES ('16', '12', '10', '电费', '1', '500', null, '2018-11-05 22:51:14');
INSERT INTO `yb-consume` VALUES ('17', '10', '12', '电费', '0', '500', null, '2018-11-05 22:51:33');
INSERT INTO `yb-consume` VALUES ('18', '12', '10', '电费', '1', '500', null, '2018-11-05 22:51:33');
INSERT INTO `yb-consume` VALUES ('19', '10', '12', '电费', '0', '500', null, '2018-11-05 22:51:51');
INSERT INTO `yb-consume` VALUES ('20', '12', '10', '电费', '1', '500', null, '2018-11-05 22:51:51');
INSERT INTO `yb-consume` VALUES ('21', '10', '12', '电费', '0', '500', null, '2018-11-05 22:53:19');
INSERT INTO `yb-consume` VALUES ('22', '12', '10', '电费', '1', '500', null, '2018-11-05 22:53:19');
INSERT INTO `yb-consume` VALUES ('23', '10', '12', '电费', '0', '500', null, '2018-11-05 22:58:27');
INSERT INTO `yb-consume` VALUES ('24', '12', '10', '电费', '1', '500', null, '2018-11-05 22:58:27');
INSERT INTO `yb-consume` VALUES ('25', '10', '12', '电费', '0', '500', null, '2018-11-05 23:01:58');
INSERT INTO `yb-consume` VALUES ('26', '12', '10', '电费', '1', '500', null, '2018-11-05 23:01:58');
INSERT INTO `yb-consume` VALUES ('27', '10', '12', '电费', '0', '500', null, '2018-11-05 23:03:04');
INSERT INTO `yb-consume` VALUES ('28', '12', '10', '电费', '1', '500', null, '2018-11-05 23:03:04');
INSERT INTO `yb-consume` VALUES ('29', '10', '12', '电费', '0', '500', null, '2018-11-05 23:03:42');
INSERT INTO `yb-consume` VALUES ('30', '12', '10', '电费', '1', '500', null, '2018-11-05 23:03:42');
INSERT INTO `yb-consume` VALUES ('31', '10', '12', '电费', '0', '500', null, '2018-11-05 23:04:16');
INSERT INTO `yb-consume` VALUES ('32', '12', '10', '电费', '1', '500', null, '2018-11-05 23:04:16');
INSERT INTO `yb-consume` VALUES ('33', '11', '12', '电费', '0', '500', null, '2018-11-06 11:10:12');
INSERT INTO `yb-consume` VALUES ('34', '12', '11', '电费', '1', '500', null, '2018-11-06 11:10:12');
INSERT INTO `yb-consume` VALUES ('35', '11', '12', '电费', '0', '500', null, '2018-11-06 11:12:00');
INSERT INTO `yb-consume` VALUES ('36', '12', '11', '电费', '1', '500', null, '2018-11-06 11:12:00');
INSERT INTO `yb-consume` VALUES ('37', '11', '12', '电费', '0', '500', null, '2018-11-06 12:33:01');
INSERT INTO `yb-consume` VALUES ('38', '12', '11', '电费', '1', '500', null, '2018-11-06 12:33:01');
INSERT INTO `yb-consume` VALUES ('39', '11', '12', '电费', '0', '500', null, '2018-11-06 13:04:21');
INSERT INTO `yb-consume` VALUES ('40', '12', '11', '电费', '1', '500', null, '2018-11-06 13:04:21');
INSERT INTO `yb-consume` VALUES ('41', '11', '12', '电费', '0', '500', null, '2018-11-06 13:05:09');
INSERT INTO `yb-consume` VALUES ('42', '12', '11', '电费', '1', '500', null, '2018-11-06 13:05:09');
INSERT INTO `yb-consume` VALUES ('43', '11', '12', '电费', '0', '500', null, '2018-11-06 13:05:37');
INSERT INTO `yb-consume` VALUES ('44', '12', '11', '电费', '1', '500', null, '2018-11-06 13:05:37');
INSERT INTO `yb-consume` VALUES ('45', '11', '12', '电费', '0', '500', null, '2018-11-06 13:06:51');
INSERT INTO `yb-consume` VALUES ('46', '12', '11', '电费', '1', '500', null, '2018-11-06 13:06:51');
INSERT INTO `yb-consume` VALUES ('47', '11', '12', '电费', '0', '500', null, '2018-11-06 13:07:30');
INSERT INTO `yb-consume` VALUES ('48', '12', '11', '电费', '1', '500', null, '2018-11-06 13:07:30');
INSERT INTO `yb-consume` VALUES ('49', '11', '12', '电费', '0', '500', null, '2018-11-06 13:07:57');
INSERT INTO `yb-consume` VALUES ('50', '12', '11', '电费', '1', '500', null, '2018-11-06 13:07:57');
INSERT INTO `yb-consume` VALUES ('51', '11', '12', '电费', '0', '500', null, '2018-11-06 13:08:12');
INSERT INTO `yb-consume` VALUES ('52', '12', '11', '电费', '1', '500', null, '2018-11-06 13:08:12');
INSERT INTO `yb-consume` VALUES ('53', '11', '12', '电费', '0', '1000', null, '2018-11-06 13:22:55');
INSERT INTO `yb-consume` VALUES ('54', '12', '11', '电费', '1', '1000', null, '2018-11-06 13:22:55');
INSERT INTO `yb-consume` VALUES ('55', '11', '12', '电费', '0', '500', null, '2018-11-06 14:49:58');
INSERT INTO `yb-consume` VALUES ('56', '12', '11', '电费', '1', '500', null, '2018-11-06 14:49:58');
INSERT INTO `yb-consume` VALUES ('57', '11', '12', '电费', '0', '500', null, '2018-11-06 14:50:43');
INSERT INTO `yb-consume` VALUES ('58', '12', '11', '电费', '1', '500', null, '2018-11-06 14:50:43');
INSERT INTO `yb-consume` VALUES ('59', '11', '12', '电费', '0', '500', null, '2018-11-06 14:52:16');
INSERT INTO `yb-consume` VALUES ('60', '12', '11', '电费', '1', '500', null, '2018-11-06 14:52:17');
INSERT INTO `yb-consume` VALUES ('61', '11', '12', '电费', '0', '500', null, '2018-11-06 14:57:23');
INSERT INTO `yb-consume` VALUES ('62', '12', '11', '电费', '1', '500', null, '2018-11-06 14:57:23');
INSERT INTO `yb-consume` VALUES ('63', '11', '12', '电费', '0', '1000', null, '2018-11-06 15:55:40');
INSERT INTO `yb-consume` VALUES ('64', '12', '11', '水费', '1', '1000', null, '2018-11-06 15:55:40');
INSERT INTO `yb-consume` VALUES ('65', '11', '12', '电费', '0', '1000', null, '2018-11-06 15:56:45');
INSERT INTO `yb-consume` VALUES ('66', '12', '11', '水费', '1', '1000', null, '2018-11-06 15:56:45');
INSERT INTO `yb-consume` VALUES ('67', '11', '12', '电费', '0', '1000', null, '2018-11-06 15:58:15');
INSERT INTO `yb-consume` VALUES ('68', '12', '11', '水费', '1', '1000', null, '2018-11-06 15:58:15');
INSERT INTO `yb-consume` VALUES ('69', '11', '12', '水费', '0', '1000', null, '2018-11-06 15:59:06');
INSERT INTO `yb-consume` VALUES ('70', '12', '11', '水费', '1', '1000', null, '2018-11-06 15:59:06');
INSERT INTO `yb-consume` VALUES ('71', '11', '12', '水费', '0', '500', null, '2018-11-06 16:47:30');
INSERT INTO `yb-consume` VALUES ('72', '12', '11', '水费', '1', '500', null, '2018-11-06 16:47:30');
INSERT INTO `yb-consume` VALUES ('73', '11', '12', '水费', '0', '500', null, '2018-11-06 16:49:23');
INSERT INTO `yb-consume` VALUES ('74', '12', '11', '水费', '1', '500', null, '2018-11-06 16:49:23');
INSERT INTO `yb-consume` VALUES ('75', '11', '12', '水费', '0', '500', null, '2018-11-06 16:50:29');
INSERT INTO `yb-consume` VALUES ('76', '12', '11', '水费', '1', '500', null, '2018-11-06 16:50:29');
INSERT INTO `yb-consume` VALUES ('77', '10', '12', '水费', '0', '500', null, '2018-11-06 16:59:26');
INSERT INTO `yb-consume` VALUES ('78', '12', '10', '水费', '1', '500', null, '2018-11-06 16:59:26');
INSERT INTO `yb-consume` VALUES ('79', '10', '12', '水费', '0', '1000', null, '2018-11-06 17:01:47');
INSERT INTO `yb-consume` VALUES ('80', '12', '10', '水费', '1', '1000', null, '2018-11-06 17:01:47');
INSERT INTO `yb-consume` VALUES ('81', '10', '12', '电费', '0', '500', null, '2018-11-06 17:02:24');
INSERT INTO `yb-consume` VALUES ('82', '12', '10', '电费', '1', '500', null, '2018-11-06 17:02:24');
INSERT INTO `yb-consume` VALUES ('83', '10', '12', '电费', '0', '500', null, '2018-11-06 17:14:41');
INSERT INTO `yb-consume` VALUES ('84', '12', '10', '电费', '1', '500', null, '2018-11-06 17:14:41');
INSERT INTO `yb-consume` VALUES ('85', '10', '12', '电费', '0', '500', null, '2018-11-06 17:16:03');
INSERT INTO `yb-consume` VALUES ('86', '12', '10', '电费', '1', '500', null, '2018-11-06 17:16:03');
INSERT INTO `yb-consume` VALUES ('87', '10', '12', '电费', '0', '500', null, '2018-11-06 17:16:16');
INSERT INTO `yb-consume` VALUES ('88', '12', '10', '电费', '1', '500', null, '2018-11-06 17:16:16');
INSERT INTO `yb-consume` VALUES ('89', '10', '12', '水费', '0', '500', null, '2018-11-07 15:58:02');
INSERT INTO `yb-consume` VALUES ('90', '12', '10', '水费', '1', '500', null, '2018-11-07 15:58:02');
INSERT INTO `yb-consume` VALUES ('91', '10', '12', '水费', '0', '500', null, '2018-11-08 11:14:40');
INSERT INTO `yb-consume` VALUES ('92', '12', '10', '水费', '1', '500', null, '2018-11-08 11:14:40');
INSERT INTO `yb-consume` VALUES ('93', '10', '0', '充值', '1', '1000', null, '2018-11-13 16:49:10');
INSERT INTO `yb-consume` VALUES ('94', '10', '0', '充值', '1', '1000', null, '2018-11-13 16:49:44');
INSERT INTO `yb-consume` VALUES ('95', '10', '0', '充值', '1', '1000', null, '2018-11-13 16:50:51');
INSERT INTO `yb-consume` VALUES ('96', '10', '0', '充值', '1', '1000', null, '2018-11-13 16:51:25');
INSERT INTO `yb-consume` VALUES ('97', '10', '0', '充值', '1', '1000', null, '2018-11-13 16:51:47');

-- ----------------------------
-- Table structure for yb-item
-- ----------------------------
DROP TABLE IF EXISTS `yb-item`;
CREATE TABLE `yb-item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL COMMENT '用户id',
  `type` varchar(32) DEFAULT NULL COMMENT '启事类型',
  `title` varchar(255) DEFAULT NULL COMMENT '标题',
  `sort` varchar(32) DEFAULT NULL COMMENT '物品类别',
  `time` date NOT NULL COMMENT '丢失或捡拾日期',
  `address` varchar(64) DEFAULT NULL COMMENT '丢失或捡拾地点',
  `description` varchar(255) DEFAULT NULL COMMENT '详情描述',
  `picture` varchar(255) DEFAULT NULL COMMENT '图片',
  `linkman` varchar(32) DEFAULT NULL COMMENT '联系人',
  `phone` varchar(20) DEFAULT NULL COMMENT '联系电话',
  `qq` varchar(255) DEFAULT NULL COMMENT 'QQ号码',
  `date` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of yb-item
-- ----------------------------
INSERT INTO `yb-item` VALUES ('1', '888', '寻物启事', '11111', '钱包', '2018-11-13', '111111', '11111111111111111111', '/uploads/noticeImg/5bea4236cec602018-11-13-11-17-10.jpg', '1111', '1111', '1111', '2018-11-13 11:17:10');

-- ----------------------------
-- Table structure for yb-pay
-- ----------------------------
DROP TABLE IF EXISTS `yb-pay`;
CREATE TABLE `yb-pay` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL COMMENT '用户id',
  `money` varchar(32) NOT NULL DEFAULT '0' COMMENT '金额',
  `pay_password` varchar(32) NOT NULL COMMENT '支付密码',
  `salt` varchar(8) NOT NULL COMMENT '支付密码盐',
  `error_count` int(11) DEFAULT '0' COMMENT '错误次数',
  `cooling_date` varchar(32) DEFAULT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of yb-pay
-- ----------------------------
INSERT INTO `yb-pay` VALUES ('2', '10', '11000', '9449d06419fa105ff420bc79c4b467c0', 'wonder', '0', null, '2018-11-05 20:17:19');
INSERT INTO `yb-pay` VALUES ('4', '11', '6500', '9449d06419fa105ff420bc79c4b467c0', 'wonder', '1', '2018-11-06 12:45:59', '2018-11-06 11:10:03');
INSERT INTO `yb-pay` VALUES ('3', '12', '36000', '9449d06419fa105ff420bc79c4b467c0', 'wonder', '0', null, '2018-11-05 20:37:47');

-- ----------------------------
-- Table structure for yb-role
-- ----------------------------
DROP TABLE IF EXISTS `yb-role`;
CREATE TABLE `yb-role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_name` varchar(8) NOT NULL COMMENT '角色名',
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of yb-role
-- ----------------------------
INSERT INTO `yb-role` VALUES ('1', '舍长', '2018-11-04 12:56:41');
INSERT INTO `yb-role` VALUES ('2', '学生', '2018-11-04 12:56:41');
INSERT INTO `yb-role` VALUES ('3', '后期人员', '2018-11-04 12:56:41');
INSERT INTO `yb-role` VALUES ('4', '水电费后勤', '2018-11-05 20:28:41');

-- ----------------------------
-- Table structure for yb-user
-- ----------------------------
DROP TABLE IF EXISTS `yb-user`;
CREATE TABLE `yb-user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(32) NOT NULL,
  `password` varchar(32) NOT NULL,
  `email` varchar(32) NOT NULL,
  `salt` varchar(10) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of yb-user
-- ----------------------------
INSERT INTO `yb-user` VALUES ('10', 'wonder', 'fdfa7b4095f286e066a597ea1b6d732b', '1491733348@qq.com', 'td6Z', '2018-10-25 11:29:17');
INSERT INTO `yb-user` VALUES ('11', 'wonder1', '5b4f571f247d02bccde6ee09e162bd67', 'wonder_97@163.com', 'ceSk', '2018-10-26 10:49:36');
INSERT INTO `yb-user` VALUES ('12', 'utilities', 'fdfa7b4095f286e066a597ea1b6d732b', '1491733348@qq.com', 'td6Z', '2018-11-05 20:31:15');
INSERT INTO `yb-user` VALUES ('14', 'wonder3', 'a069a02359479f2a784c28aa0cb9292f', '3566409483@qq.com', 'cajw', '2018-11-14 15:55:07');

-- ----------------------------
-- Table structure for yb-user_identity
-- ----------------------------
DROP TABLE IF EXISTS `yb-user_identity`;
CREATE TABLE `yb-user_identity` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL COMMENT '用户名id',
  `role_id` int(11) DEFAULT NULL COMMENT '角色id',
  `ridgepole` varchar(4) DEFAULT NULL COMMENT '所属栋',
  `dorm_num` int(11) DEFAULT NULL COMMENT '宿舍号',
  `check` int(11) NOT NULL DEFAULT '0' COMMENT '审核：0代表审核中，1代表审核通过',
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `role_id` (`role_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of yb-user_identity
-- ----------------------------
INSERT INTO `yb-user_identity` VALUES ('1', '10', '1', '10', '306', '1', '2018-11-04 12:59:56');
INSERT INTO `yb-user_identity` VALUES ('2', '11', '2', '10', '306', '1', '2018-11-04 12:59:56');
INSERT INTO `yb-user_identity` VALUES ('3', '12', '4', 'g', '206', '1', '2018-11-05 20:36:50');
INSERT INTO `yb-user_identity` VALUES ('4', '9', '1', null, null, '0', '2018-11-14 15:55:07');

-- ----------------------------
-- Table structure for yb-user_info
-- ----------------------------
DROP TABLE IF EXISTS `yb-user_info`;
CREATE TABLE `yb-user_info` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL COMMENT '用户id',
  `nickname` varchar(32) DEFAULT NULL COMMENT '昵称',
  `major` varchar(255) DEFAULT NULL COMMENT '当前专业',
  `real_name` varchar(32) DEFAULT NULL COMMENT '真实姓名',
  `qq` varchar(255) DEFAULT NULL COMMENT 'QQ号码',
  `birth` date DEFAULT NULL COMMENT '出生日期',
  `phone` varchar(20) DEFAULT NULL COMMENT '联系电话',
  `head` varchar(255) DEFAULT NULL COMMENT '头像',
  `app` text COMMENT '选择的应用',
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of yb-user_info
-- ----------------------------
INSERT INTO `yb-user_info` VALUES ('5', '10', 'wonder', '计算机应用技术', '蔡大胖', '1111111111@qq.com', '2018-12-12', '11111111111', '/uploads/image/5bea4e43a6c982018-11-13-12-08-35.jpg', '1,2,3,4,5,6,13,15', '2018-11-14 18:22:36');
INSERT INTO `yb-user_info` VALUES ('6', '11', null, null, null, null, null, null, null, '2,3,6', '2018-10-26 10:49:37');
INSERT INTO `yb-user_info` VALUES ('7', '12', null, null, null, null, null, null, null, '1,2,3', '2018-11-05 20:32:27');
INSERT INTO `yb-user_info` VALUES ('9', '14', null, null, null, null, null, null, null, '15,13', '2018-11-14 15:55:07');

-- ----------------------------
-- Table structure for yb-utilities
-- ----------------------------
DROP TABLE IF EXISTS `yb-utilities`;
CREATE TABLE `yb-utilities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ridgepole` int(11) NOT NULL COMMENT '所属栋',
  `dorm_num` int(11) NOT NULL COMMENT '所属宿舍',
  `category` int(11) NOT NULL COMMENT '0代表水费，1代表电费',
  `last_degrees` varchar(8) NOT NULL COMMENT '上个月度数',
  `this_degrees` varchar(8) NOT NULL COMMENT '这个月度数',
  `practical_degrees` varchar(8) NOT NULL COMMENT '实际度数',
  `price` varchar(8) NOT NULL COMMENT '每度的价格',
  `cost` varchar(8) NOT NULL COMMENT '费用',
  `has_pay` varchar(8) NOT NULL DEFAULT '0' COMMENT '已支付的金额',
  `start_month` date NOT NULL COMMENT '开始日期',
  `end_month` date NOT NULL COMMENT '结束日期',
  `complete_pay` int(11) DEFAULT '0' COMMENT '0代表未完成支付，1代表完成支付',
  `aa` int(11) DEFAULT '0' COMMENT '0代表不进行aa，1代表进行aa',
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=767 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of yb-utilities
-- ----------------------------
INSERT INTO `yb-utilities` VALUES ('691', '5', '105', '1', '2000', '1000', '1000', '1.25', '1250', '0', '2016-05-01', '2016-06-01', '0', '0', '2018-11-10 22:20:51');
INSERT INTO `yb-utilities` VALUES ('694', '8', '108', '1', '2000', '1000', '1000', '1.25', '1250', '0', '2016-08-01', '2016-09-01', '0', '0', '2018-11-10 22:20:51');
INSERT INTO `yb-utilities` VALUES ('693', '7', '107', '1', '2000', '1000', '1000', '1.25', '1250', '0', '2016-07-01', '2016-08-01', '0', '0', '2018-11-10 22:20:51');
INSERT INTO `yb-utilities` VALUES ('692', '6', '106', '1', '2000', '1000', '1000', '1.25', '1250', '0', '2016-06-01', '2016-07-01', '0', '0', '2018-11-10 22:20:51');
INSERT INTO `yb-utilities` VALUES ('690', '4', '104', '1', '2000', '1000', '1000', '1.25', '1250', '0', '2016-04-01', '2016-05-01', '0', '0', '2018-11-10 22:20:51');
INSERT INTO `yb-utilities` VALUES ('689', '3', '103', '1', '3000', '1000', '2000', '1.25', '2500', '0', '2016-03-01', '2016-04-01', '0', '0', '2018-11-10 22:20:51');
INSERT INTO `yb-utilities` VALUES ('687', '1', '101', '1', '2000', '1000', '1000', '1.25', '1250', '0', '2016-01-01', '2016-02-01', '0', '0', '2018-11-10 22:20:51');
INSERT INTO `yb-utilities` VALUES ('688', '2', '102', '1', '2000', '1000', '1000', '1.25', '1250', '0', '2016-02-01', '2016-03-01', '0', '0', '2018-11-10 22:20:51');
INSERT INTO `yb-utilities` VALUES ('728', '2', '102', '1', '2000', '1000', '1000', '1.25', '1250', '0', '2016-02-01', '2016-03-01', '0', '0', '2018-11-11 19:50:58');
INSERT INTO `yb-utilities` VALUES ('729', '3', '103', '1', '3000', '1000', '2000', '1.25', '2500', '0', '2016-03-01', '2016-04-01', '0', '0', '2018-11-11 19:50:58');
INSERT INTO `yb-utilities` VALUES ('727', '1', '101', '1', '2000', '1000', '1000', '1.25', '1250', '0', '2016-01-01', '2016-02-01', '0', '0', '2018-11-11 19:50:58');
INSERT INTO `yb-utilities` VALUES ('14', '8', '108', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-08-01', '2016-09-01', '0', '0', '2018-11-09 16:49:13');
INSERT INTO `yb-utilities` VALUES ('15', '9', '109', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-09-01', '2016-10-01', '0', '0', '2018-11-09 16:49:13');
INSERT INTO `yb-utilities` VALUES ('16', '10', '110', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-10-01', '2016-11-01', '0', '0', '2018-11-09 16:49:13');
INSERT INTO `yb-utilities` VALUES ('18', '2', '112', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-12-01', '2016-01-01', '0', '0', '2018-11-09 16:49:13');
INSERT INTO `yb-utilities` VALUES ('19', '3', '113', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-01-01', '2016-02-01', '0', '0', '2018-11-09 16:49:13');
INSERT INTO `yb-utilities` VALUES ('20', '4', '114', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-02-01', '2016-03-01', '0', '0', '2018-11-09 16:49:13');
INSERT INTO `yb-utilities` VALUES ('21', '5', '115', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-03-01', '2016-04-01', '0', '0', '2018-11-09 16:49:13');
INSERT INTO `yb-utilities` VALUES ('22', '6', '116', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-04-01', '2016-05-01', '0', '0', '2018-11-09 16:49:13');
INSERT INTO `yb-utilities` VALUES ('23', '7', '117', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-05-01', '2016-06-01', '0', '0', '2018-11-09 16:49:13');
INSERT INTO `yb-utilities` VALUES ('24', '8', '118', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-06-01', '2016-07-01', '0', '0', '2018-11-09 16:49:13');
INSERT INTO `yb-utilities` VALUES ('25', '9', '119', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-07-01', '2016-08-01', '0', '0', '2018-11-09 16:49:13');
INSERT INTO `yb-utilities` VALUES ('26', '10', '120', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-08-01', '2016-09-01', '0', '0', '2018-11-09 16:49:13');
INSERT INTO `yb-utilities` VALUES ('27', '1', '121', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-09-01', '2016-10-01', '0', '0', '2018-11-09 16:49:13');
INSERT INTO `yb-utilities` VALUES ('28', '2', '122', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-10-01', '2016-11-01', '0', '0', '2018-11-09 16:49:13');
INSERT INTO `yb-utilities` VALUES ('29', '3', '123', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-11-01', '2016-12-01', '0', '0', '2018-11-09 16:49:13');
INSERT INTO `yb-utilities` VALUES ('30', '4', '124', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-12-01', '2016-01-01', '0', '0', '2018-11-09 16:49:13');
INSERT INTO `yb-utilities` VALUES ('31', '5', '125', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-01-01', '2016-02-01', '0', '0', '2018-11-09 16:49:13');
INSERT INTO `yb-utilities` VALUES ('32', '6', '126', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-02-01', '2016-03-01', '0', '0', '2018-11-09 16:49:13');
INSERT INTO `yb-utilities` VALUES ('33', '7', '127', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-03-01', '2016-04-01', '0', '0', '2018-11-09 16:49:13');
INSERT INTO `yb-utilities` VALUES ('34', '8', '128', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-04-01', '2016-05-01', '0', '0', '2018-11-09 16:49:13');
INSERT INTO `yb-utilities` VALUES ('35', '9', '129', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-05-01', '2016-06-01', '0', '0', '2018-11-09 16:49:13');
INSERT INTO `yb-utilities` VALUES ('36', '10', '130', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-06-01', '2016-07-01', '0', '0', '2018-11-09 16:49:14');
INSERT INTO `yb-utilities` VALUES ('37', '1', '131', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-07-01', '2016-08-01', '0', '0', '2018-11-09 16:49:14');
INSERT INTO `yb-utilities` VALUES ('38', '2', '132', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-08-01', '2016-09-01', '0', '0', '2018-11-09 16:49:14');
INSERT INTO `yb-utilities` VALUES ('39', '3', '133', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-09-01', '2016-10-01', '0', '0', '2018-11-09 16:49:14');
INSERT INTO `yb-utilities` VALUES ('40', '4', '134', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-10-01', '2016-11-01', '0', '0', '2018-11-09 16:49:14');
INSERT INTO `yb-utilities` VALUES ('41', '5', '135', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-11-01', '2016-12-01', '0', '0', '2018-11-09 16:49:14');
INSERT INTO `yb-utilities` VALUES ('42', '6', '136', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-12-01', '2016-01-01', '0', '0', '2018-11-09 16:49:14');
INSERT INTO `yb-utilities` VALUES ('43', '7', '137', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-01-01', '2016-02-01', '0', '0', '2018-11-09 16:49:14');
INSERT INTO `yb-utilities` VALUES ('44', '8', '138', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-02-01', '2016-03-01', '0', '0', '2018-11-09 16:49:14');
INSERT INTO `yb-utilities` VALUES ('45', '9', '139', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-03-01', '2016-04-01', '0', '0', '2018-11-09 16:49:14');
INSERT INTO `yb-utilities` VALUES ('46', '10', '140', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-04-01', '2016-05-01', '0', '0', '2018-11-09 16:49:14');
INSERT INTO `yb-utilities` VALUES ('47', '1', '101', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-01-01', '2016-02-01', '0', '0', '2018-11-09 16:50:26');
INSERT INTO `yb-utilities` VALUES ('48', '2', '102', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-02-01', '2016-03-01', '0', '0', '2018-11-09 16:50:26');
INSERT INTO `yb-utilities` VALUES ('49', '3', '103', '0', '3000', '1000', '2000', '1.25', '2500', '0', '2016-03-01', '2016-04-01', '0', '0', '2018-11-09 16:50:26');
INSERT INTO `yb-utilities` VALUES ('50', '4', '104', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-04-01', '2016-05-01', '0', '0', '2018-11-09 16:50:26');
INSERT INTO `yb-utilities` VALUES ('51', '5', '105', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-05-01', '2016-06-01', '0', '0', '2018-11-09 16:50:26');
INSERT INTO `yb-utilities` VALUES ('52', '6', '106', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-06-01', '2016-07-01', '0', '0', '2018-11-09 16:50:26');
INSERT INTO `yb-utilities` VALUES ('53', '7', '107', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-07-01', '2016-08-01', '0', '0', '2018-11-09 16:50:26');
INSERT INTO `yb-utilities` VALUES ('54', '8', '108', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-08-01', '2016-09-01', '0', '0', '2018-11-09 16:50:26');
INSERT INTO `yb-utilities` VALUES ('55', '9', '109', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-09-01', '2016-10-01', '0', '0', '2018-11-09 16:50:26');
INSERT INTO `yb-utilities` VALUES ('56', '10', '110', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-10-01', '2016-11-01', '0', '0', '2018-11-09 16:50:26');
INSERT INTO `yb-utilities` VALUES ('57', '1', '111', '0', '4000', '1000', '3000', '1.25', '3750', '0', '2016-11-01', '2016-12-01', '0', '0', '2018-11-09 16:50:26');
INSERT INTO `yb-utilities` VALUES ('58', '2', '112', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-12-01', '2016-01-01', '0', '0', '2018-11-09 16:50:26');
INSERT INTO `yb-utilities` VALUES ('59', '3', '113', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-01-01', '2016-02-01', '0', '0', '2018-11-09 16:50:26');
INSERT INTO `yb-utilities` VALUES ('60', '4', '114', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-02-01', '2016-03-01', '0', '0', '2018-11-09 16:50:26');
INSERT INTO `yb-utilities` VALUES ('61', '5', '115', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-03-01', '2016-04-01', '0', '0', '2018-11-09 16:50:26');
INSERT INTO `yb-utilities` VALUES ('62', '6', '116', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-04-01', '2016-05-01', '0', '0', '2018-11-09 16:50:26');
INSERT INTO `yb-utilities` VALUES ('63', '7', '117', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-05-01', '2016-06-01', '0', '0', '2018-11-09 16:50:26');
INSERT INTO `yb-utilities` VALUES ('64', '8', '118', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-06-01', '2016-07-01', '0', '0', '2018-11-09 16:50:26');
INSERT INTO `yb-utilities` VALUES ('65', '9', '119', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-07-01', '2016-08-01', '0', '0', '2018-11-09 16:50:26');
INSERT INTO `yb-utilities` VALUES ('66', '10', '120', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-08-01', '2016-09-01', '0', '0', '2018-11-09 16:50:26');
INSERT INTO `yb-utilities` VALUES ('67', '1', '121', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-09-01', '2016-10-01', '0', '0', '2018-11-09 16:50:26');
INSERT INTO `yb-utilities` VALUES ('68', '2', '122', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-10-01', '2016-11-01', '0', '0', '2018-11-09 16:50:26');
INSERT INTO `yb-utilities` VALUES ('69', '3', '123', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-11-01', '2016-12-01', '0', '0', '2018-11-09 16:50:26');
INSERT INTO `yb-utilities` VALUES ('70', '4', '124', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-12-01', '2016-01-01', '0', '0', '2018-11-09 16:50:26');
INSERT INTO `yb-utilities` VALUES ('71', '5', '125', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-01-01', '2016-02-01', '0', '0', '2018-11-09 16:50:26');
INSERT INTO `yb-utilities` VALUES ('72', '6', '126', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-02-01', '2016-03-01', '0', '0', '2018-11-09 16:50:26');
INSERT INTO `yb-utilities` VALUES ('73', '7', '127', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-03-01', '2016-04-01', '0', '0', '2018-11-09 16:50:26');
INSERT INTO `yb-utilities` VALUES ('74', '8', '128', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-04-01', '2016-05-01', '0', '0', '2018-11-09 16:50:26');
INSERT INTO `yb-utilities` VALUES ('75', '9', '129', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-05-01', '2016-06-01', '0', '0', '2018-11-09 16:50:26');
INSERT INTO `yb-utilities` VALUES ('76', '10', '130', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-06-01', '2016-07-01', '0', '0', '2018-11-09 16:50:26');
INSERT INTO `yb-utilities` VALUES ('77', '1', '131', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-07-01', '2016-08-01', '0', '0', '2018-11-09 16:50:26');
INSERT INTO `yb-utilities` VALUES ('78', '2', '132', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-08-01', '2016-09-01', '0', '0', '2018-11-09 16:50:26');
INSERT INTO `yb-utilities` VALUES ('79', '3', '133', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-09-01', '2016-10-01', '0', '0', '2018-11-09 16:50:26');
INSERT INTO `yb-utilities` VALUES ('80', '4', '134', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-10-01', '2016-11-01', '0', '0', '2018-11-09 16:50:26');
INSERT INTO `yb-utilities` VALUES ('81', '5', '135', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-11-01', '2016-12-01', '0', '0', '2018-11-09 16:50:26');
INSERT INTO `yb-utilities` VALUES ('82', '6', '136', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-12-01', '2016-01-01', '0', '0', '2018-11-09 16:50:26');
INSERT INTO `yb-utilities` VALUES ('83', '7', '137', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-01-01', '2016-02-01', '0', '0', '2018-11-09 16:50:26');
INSERT INTO `yb-utilities` VALUES ('84', '8', '138', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-02-01', '2016-03-01', '0', '0', '2018-11-09 16:50:26');
INSERT INTO `yb-utilities` VALUES ('85', '9', '139', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-03-01', '2016-04-01', '0', '0', '2018-11-09 16:50:26');
INSERT INTO `yb-utilities` VALUES ('86', '10', '140', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-04-01', '2016-05-01', '0', '0', '2018-11-09 16:50:26');
INSERT INTO `yb-utilities` VALUES ('87', '1', '101', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-01-01', '2016-02-01', '0', '0', '2018-11-09 16:53:47');
INSERT INTO `yb-utilities` VALUES ('88', '2', '102', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-02-01', '2016-03-01', '0', '0', '2018-11-09 16:53:47');
INSERT INTO `yb-utilities` VALUES ('89', '3', '103', '0', '3000', '1000', '2000', '1.25', '2500', '0', '2016-03-01', '2016-04-01', '0', '0', '2018-11-09 16:53:47');
INSERT INTO `yb-utilities` VALUES ('90', '4', '104', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-04-01', '2016-05-01', '0', '0', '2018-11-09 16:53:47');
INSERT INTO `yb-utilities` VALUES ('91', '5', '105', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-05-01', '2016-06-01', '0', '0', '2018-11-09 16:53:47');
INSERT INTO `yb-utilities` VALUES ('92', '6', '106', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-06-01', '2016-07-01', '0', '0', '2018-11-09 16:53:47');
INSERT INTO `yb-utilities` VALUES ('93', '7', '107', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-07-01', '2016-08-01', '0', '0', '2018-11-09 16:53:47');
INSERT INTO `yb-utilities` VALUES ('94', '8', '108', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-08-01', '2016-09-01', '0', '0', '2018-11-09 16:53:47');
INSERT INTO `yb-utilities` VALUES ('95', '9', '109', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-09-01', '2016-10-01', '0', '0', '2018-11-09 16:53:47');
INSERT INTO `yb-utilities` VALUES ('96', '10', '110', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-10-01', '2016-11-01', '0', '0', '2018-11-09 16:53:47');
INSERT INTO `yb-utilities` VALUES ('97', '1', '111', '0', '4000', '1000', '3000', '1.25', '3750', '0', '2016-11-01', '2016-12-01', '0', '0', '2018-11-09 16:53:47');
INSERT INTO `yb-utilities` VALUES ('98', '2', '112', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-12-01', '2016-01-01', '0', '0', '2018-11-09 16:53:47');
INSERT INTO `yb-utilities` VALUES ('99', '3', '113', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-01-01', '2016-02-01', '0', '0', '2018-11-09 16:53:47');
INSERT INTO `yb-utilities` VALUES ('100', '4', '114', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-02-01', '2016-03-01', '0', '0', '2018-11-09 16:53:47');
INSERT INTO `yb-utilities` VALUES ('101', '5', '115', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-03-01', '2016-04-01', '0', '0', '2018-11-09 16:53:47');
INSERT INTO `yb-utilities` VALUES ('102', '6', '116', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-04-01', '2016-05-01', '0', '0', '2018-11-09 16:53:48');
INSERT INTO `yb-utilities` VALUES ('103', '7', '117', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-05-01', '2016-06-01', '0', '0', '2018-11-09 16:53:48');
INSERT INTO `yb-utilities` VALUES ('104', '8', '118', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-06-01', '2016-07-01', '0', '0', '2018-11-09 16:53:48');
INSERT INTO `yb-utilities` VALUES ('105', '9', '119', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-07-01', '2016-08-01', '0', '0', '2018-11-09 16:53:48');
INSERT INTO `yb-utilities` VALUES ('106', '10', '120', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-08-01', '2016-09-01', '0', '0', '2018-11-09 16:53:48');
INSERT INTO `yb-utilities` VALUES ('107', '1', '121', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-09-01', '2016-10-01', '0', '0', '2018-11-09 16:53:48');
INSERT INTO `yb-utilities` VALUES ('108', '2', '122', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-10-01', '2016-11-01', '0', '0', '2018-11-09 16:53:48');
INSERT INTO `yb-utilities` VALUES ('109', '3', '123', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-11-01', '2016-12-01', '0', '0', '2018-11-09 16:53:48');
INSERT INTO `yb-utilities` VALUES ('110', '4', '124', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-12-01', '2016-01-01', '0', '0', '2018-11-09 16:53:48');
INSERT INTO `yb-utilities` VALUES ('111', '5', '125', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-01-01', '2016-02-01', '0', '0', '2018-11-09 16:53:48');
INSERT INTO `yb-utilities` VALUES ('112', '6', '126', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-02-01', '2016-03-01', '0', '0', '2018-11-09 16:53:48');
INSERT INTO `yb-utilities` VALUES ('113', '7', '127', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-03-01', '2016-04-01', '0', '0', '2018-11-09 16:53:48');
INSERT INTO `yb-utilities` VALUES ('114', '8', '128', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-04-01', '2016-05-01', '0', '0', '2018-11-09 16:53:48');
INSERT INTO `yb-utilities` VALUES ('115', '9', '129', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-05-01', '2016-06-01', '0', '0', '2018-11-09 16:53:48');
INSERT INTO `yb-utilities` VALUES ('116', '10', '130', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-06-01', '2016-07-01', '0', '0', '2018-11-09 16:53:48');
INSERT INTO `yb-utilities` VALUES ('117', '1', '131', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-07-01', '2016-08-01', '0', '0', '2018-11-09 16:53:48');
INSERT INTO `yb-utilities` VALUES ('118', '2', '132', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-08-01', '2016-09-01', '0', '0', '2018-11-09 16:53:48');
INSERT INTO `yb-utilities` VALUES ('119', '3', '133', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-09-01', '2016-10-01', '0', '0', '2018-11-09 16:53:48');
INSERT INTO `yb-utilities` VALUES ('120', '4', '134', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-10-01', '2016-11-01', '0', '0', '2018-11-09 16:53:48');
INSERT INTO `yb-utilities` VALUES ('121', '5', '135', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-11-01', '2016-12-01', '0', '0', '2018-11-09 16:53:48');
INSERT INTO `yb-utilities` VALUES ('122', '6', '136', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-12-01', '2016-01-01', '0', '0', '2018-11-09 16:53:48');
INSERT INTO `yb-utilities` VALUES ('123', '7', '137', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-01-01', '2016-02-01', '0', '0', '2018-11-09 16:53:48');
INSERT INTO `yb-utilities` VALUES ('124', '8', '138', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-02-01', '2016-03-01', '0', '0', '2018-11-09 16:53:48');
INSERT INTO `yb-utilities` VALUES ('125', '9', '139', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-03-01', '2016-04-01', '0', '0', '2018-11-09 16:53:48');
INSERT INTO `yb-utilities` VALUES ('126', '10', '140', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-04-01', '2016-05-01', '0', '0', '2018-11-09 16:53:48');
INSERT INTO `yb-utilities` VALUES ('127', '1', '101', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-01-01', '2016-02-01', '0', '0', '2018-11-09 16:54:34');
INSERT INTO `yb-utilities` VALUES ('128', '2', '102', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-02-01', '2016-03-01', '0', '0', '2018-11-09 16:54:34');
INSERT INTO `yb-utilities` VALUES ('129', '3', '103', '0', '3000', '1000', '2000', '1.25', '2500', '0', '2016-03-01', '2016-04-01', '0', '0', '2018-11-09 16:54:34');
INSERT INTO `yb-utilities` VALUES ('130', '4', '104', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-04-01', '2016-05-01', '0', '0', '2018-11-09 16:54:34');
INSERT INTO `yb-utilities` VALUES ('131', '5', '105', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-05-01', '2016-06-01', '0', '0', '2018-11-09 16:54:34');
INSERT INTO `yb-utilities` VALUES ('132', '6', '106', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-06-01', '2016-07-01', '0', '0', '2018-11-09 16:54:34');
INSERT INTO `yb-utilities` VALUES ('133', '7', '107', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-07-01', '2016-08-01', '0', '0', '2018-11-09 16:54:34');
INSERT INTO `yb-utilities` VALUES ('134', '8', '108', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-08-01', '2016-09-01', '0', '0', '2018-11-09 16:54:34');
INSERT INTO `yb-utilities` VALUES ('135', '9', '109', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-09-01', '2016-10-01', '0', '0', '2018-11-09 16:54:34');
INSERT INTO `yb-utilities` VALUES ('136', '10', '110', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-10-01', '2016-11-01', '0', '0', '2018-11-09 16:54:34');
INSERT INTO `yb-utilities` VALUES ('137', '1', '111', '0', '4000', '1000', '3000', '1.25', '3750', '0', '2016-11-01', '2016-12-01', '0', '0', '2018-11-09 16:54:34');
INSERT INTO `yb-utilities` VALUES ('138', '2', '112', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-12-01', '2016-01-01', '0', '0', '2018-11-09 16:54:34');
INSERT INTO `yb-utilities` VALUES ('139', '3', '113', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-01-01', '2016-02-01', '0', '0', '2018-11-09 16:54:34');
INSERT INTO `yb-utilities` VALUES ('140', '4', '114', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-02-01', '2016-03-01', '0', '0', '2018-11-09 16:54:35');
INSERT INTO `yb-utilities` VALUES ('141', '5', '115', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-03-01', '2016-04-01', '0', '0', '2018-11-09 16:54:35');
INSERT INTO `yb-utilities` VALUES ('142', '6', '116', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-04-01', '2016-05-01', '0', '0', '2018-11-09 16:54:35');
INSERT INTO `yb-utilities` VALUES ('143', '7', '117', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-05-01', '2016-06-01', '0', '0', '2018-11-09 16:54:35');
INSERT INTO `yb-utilities` VALUES ('144', '8', '118', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-06-01', '2016-07-01', '0', '0', '2018-11-09 16:54:35');
INSERT INTO `yb-utilities` VALUES ('145', '9', '119', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-07-01', '2016-08-01', '0', '0', '2018-11-09 16:54:35');
INSERT INTO `yb-utilities` VALUES ('146', '10', '120', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-08-01', '2016-09-01', '0', '0', '2018-11-09 16:54:35');
INSERT INTO `yb-utilities` VALUES ('147', '1', '121', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-09-01', '2016-10-01', '0', '0', '2018-11-09 16:54:35');
INSERT INTO `yb-utilities` VALUES ('148', '2', '122', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-10-01', '2016-11-01', '0', '0', '2018-11-09 16:54:35');
INSERT INTO `yb-utilities` VALUES ('149', '3', '123', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-11-01', '2016-12-01', '0', '0', '2018-11-09 16:54:35');
INSERT INTO `yb-utilities` VALUES ('150', '4', '124', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-12-01', '2016-01-01', '0', '0', '2018-11-09 16:54:35');
INSERT INTO `yb-utilities` VALUES ('151', '5', '125', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-01-01', '2016-02-01', '0', '0', '2018-11-09 16:54:35');
INSERT INTO `yb-utilities` VALUES ('152', '6', '126', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-02-01', '2016-03-01', '0', '0', '2018-11-09 16:54:35');
INSERT INTO `yb-utilities` VALUES ('153', '7', '127', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-03-01', '2016-04-01', '0', '0', '2018-11-09 16:54:35');
INSERT INTO `yb-utilities` VALUES ('154', '8', '128', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-04-01', '2016-05-01', '0', '0', '2018-11-09 16:54:35');
INSERT INTO `yb-utilities` VALUES ('155', '9', '129', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-05-01', '2016-06-01', '0', '0', '2018-11-09 16:54:35');
INSERT INTO `yb-utilities` VALUES ('156', '10', '130', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-06-01', '2016-07-01', '0', '0', '2018-11-09 16:54:35');
INSERT INTO `yb-utilities` VALUES ('157', '1', '131', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-07-01', '2016-08-01', '0', '0', '2018-11-09 16:54:35');
INSERT INTO `yb-utilities` VALUES ('158', '2', '132', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-08-01', '2016-09-01', '0', '0', '2018-11-09 16:54:35');
INSERT INTO `yb-utilities` VALUES ('159', '3', '133', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-09-01', '2016-10-01', '0', '0', '2018-11-09 16:54:35');
INSERT INTO `yb-utilities` VALUES ('160', '4', '134', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-10-01', '2016-11-01', '0', '0', '2018-11-09 16:54:35');
INSERT INTO `yb-utilities` VALUES ('161', '5', '135', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-11-01', '2016-12-01', '0', '0', '2018-11-09 16:54:35');
INSERT INTO `yb-utilities` VALUES ('162', '6', '136', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-12-01', '2016-01-01', '0', '0', '2018-11-09 16:54:35');
INSERT INTO `yb-utilities` VALUES ('163', '7', '137', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-01-01', '2016-02-01', '0', '0', '2018-11-09 16:54:35');
INSERT INTO `yb-utilities` VALUES ('164', '8', '138', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-02-01', '2016-03-01', '0', '0', '2018-11-09 16:54:35');
INSERT INTO `yb-utilities` VALUES ('165', '9', '139', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-03-01', '2016-04-01', '0', '0', '2018-11-09 16:54:35');
INSERT INTO `yb-utilities` VALUES ('166', '10', '140', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-04-01', '2016-05-01', '0', '0', '2018-11-09 16:54:35');
INSERT INTO `yb-utilities` VALUES ('167', '1', '101', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-01-01', '2016-02-01', '0', '0', '2018-11-09 16:55:05');
INSERT INTO `yb-utilities` VALUES ('168', '2', '102', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-02-01', '2016-03-01', '0', '0', '2018-11-09 16:55:05');
INSERT INTO `yb-utilities` VALUES ('169', '3', '103', '0', '3000', '1000', '2000', '1.25', '2500', '0', '2016-03-01', '2016-04-01', '0', '0', '2018-11-09 16:55:05');
INSERT INTO `yb-utilities` VALUES ('170', '4', '104', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-04-01', '2016-05-01', '0', '0', '2018-11-09 16:55:05');
INSERT INTO `yb-utilities` VALUES ('171', '5', '105', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-05-01', '2016-06-01', '0', '0', '2018-11-09 16:55:05');
INSERT INTO `yb-utilities` VALUES ('172', '6', '106', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-06-01', '2016-07-01', '0', '0', '2018-11-09 16:55:05');
INSERT INTO `yb-utilities` VALUES ('173', '7', '107', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-07-01', '2016-08-01', '0', '0', '2018-11-09 16:55:05');
INSERT INTO `yb-utilities` VALUES ('174', '8', '108', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-08-01', '2016-09-01', '0', '0', '2018-11-09 16:55:05');
INSERT INTO `yb-utilities` VALUES ('175', '9', '109', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-09-01', '2016-10-01', '0', '0', '2018-11-09 16:55:05');
INSERT INTO `yb-utilities` VALUES ('176', '10', '110', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-10-01', '2016-11-01', '0', '0', '2018-11-09 16:55:05');
INSERT INTO `yb-utilities` VALUES ('177', '1', '111', '0', '4000', '1000', '3000', '1.25', '3750', '0', '2016-11-01', '2016-12-01', '0', '0', '2018-11-09 16:55:05');
INSERT INTO `yb-utilities` VALUES ('178', '2', '112', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-12-01', '2016-01-01', '0', '0', '2018-11-09 16:55:05');
INSERT INTO `yb-utilities` VALUES ('179', '3', '113', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-01-01', '2016-02-01', '0', '0', '2018-11-09 16:55:05');
INSERT INTO `yb-utilities` VALUES ('180', '4', '114', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-02-01', '2016-03-01', '0', '0', '2018-11-09 16:55:05');
INSERT INTO `yb-utilities` VALUES ('181', '5', '115', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-03-01', '2016-04-01', '0', '0', '2018-11-09 16:55:05');
INSERT INTO `yb-utilities` VALUES ('182', '6', '116', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-04-01', '2016-05-01', '0', '0', '2018-11-09 16:55:05');
INSERT INTO `yb-utilities` VALUES ('183', '7', '117', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-05-01', '2016-06-01', '0', '0', '2018-11-09 16:55:05');
INSERT INTO `yb-utilities` VALUES ('184', '8', '118', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-06-01', '2016-07-01', '0', '0', '2018-11-09 16:55:05');
INSERT INTO `yb-utilities` VALUES ('185', '9', '119', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-07-01', '2016-08-01', '0', '0', '2018-11-09 16:55:05');
INSERT INTO `yb-utilities` VALUES ('186', '10', '120', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-08-01', '2016-09-01', '0', '0', '2018-11-09 16:55:05');
INSERT INTO `yb-utilities` VALUES ('187', '1', '121', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-09-01', '2016-10-01', '0', '0', '2018-11-09 16:55:05');
INSERT INTO `yb-utilities` VALUES ('188', '2', '122', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-10-01', '2016-11-01', '0', '0', '2018-11-09 16:55:05');
INSERT INTO `yb-utilities` VALUES ('189', '3', '123', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-11-01', '2016-12-01', '0', '0', '2018-11-09 16:55:05');
INSERT INTO `yb-utilities` VALUES ('190', '4', '124', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-12-01', '2016-01-01', '0', '0', '2018-11-09 16:55:05');
INSERT INTO `yb-utilities` VALUES ('191', '5', '125', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-01-01', '2016-02-01', '0', '0', '2018-11-09 16:55:06');
INSERT INTO `yb-utilities` VALUES ('192', '6', '126', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-02-01', '2016-03-01', '0', '0', '2018-11-09 16:55:06');
INSERT INTO `yb-utilities` VALUES ('193', '7', '127', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-03-01', '2016-04-01', '0', '0', '2018-11-09 16:55:06');
INSERT INTO `yb-utilities` VALUES ('194', '8', '128', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-04-01', '2016-05-01', '0', '0', '2018-11-09 16:55:06');
INSERT INTO `yb-utilities` VALUES ('195', '9', '129', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-05-01', '2016-06-01', '0', '0', '2018-11-09 16:55:06');
INSERT INTO `yb-utilities` VALUES ('196', '10', '130', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-06-01', '2016-07-01', '0', '0', '2018-11-09 16:55:06');
INSERT INTO `yb-utilities` VALUES ('197', '1', '131', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-07-01', '2016-08-01', '0', '0', '2018-11-09 16:55:06');
INSERT INTO `yb-utilities` VALUES ('198', '2', '132', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-08-01', '2016-09-01', '0', '0', '2018-11-09 16:55:06');
INSERT INTO `yb-utilities` VALUES ('199', '3', '133', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-09-01', '2016-10-01', '0', '0', '2018-11-09 16:55:06');
INSERT INTO `yb-utilities` VALUES ('200', '4', '134', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-10-01', '2016-11-01', '0', '0', '2018-11-09 16:55:06');
INSERT INTO `yb-utilities` VALUES ('201', '5', '135', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-11-01', '2016-12-01', '0', '0', '2018-11-09 16:55:06');
INSERT INTO `yb-utilities` VALUES ('202', '6', '136', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-12-01', '2016-01-01', '0', '0', '2018-11-09 16:55:06');
INSERT INTO `yb-utilities` VALUES ('203', '7', '137', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-01-01', '2016-02-01', '0', '0', '2018-11-09 16:55:06');
INSERT INTO `yb-utilities` VALUES ('204', '8', '138', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-02-01', '2016-03-01', '0', '0', '2018-11-09 16:55:06');
INSERT INTO `yb-utilities` VALUES ('205', '9', '139', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-03-01', '2016-04-01', '0', '0', '2018-11-09 16:55:06');
INSERT INTO `yb-utilities` VALUES ('206', '10', '140', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-04-01', '2016-05-01', '0', '0', '2018-11-09 16:55:06');
INSERT INTO `yb-utilities` VALUES ('207', '1', '101', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-01-01', '2016-02-01', '0', '0', '2018-11-09 16:55:51');
INSERT INTO `yb-utilities` VALUES ('208', '2', '102', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-02-01', '2016-03-01', '0', '0', '2018-11-09 16:55:51');
INSERT INTO `yb-utilities` VALUES ('209', '3', '103', '0', '3000', '1000', '2000', '1.25', '2500', '0', '2016-03-01', '2016-04-01', '0', '0', '2018-11-09 16:55:51');
INSERT INTO `yb-utilities` VALUES ('210', '4', '104', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-04-01', '2016-05-01', '0', '0', '2018-11-09 16:55:51');
INSERT INTO `yb-utilities` VALUES ('211', '5', '105', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-05-01', '2016-06-01', '0', '0', '2018-11-09 16:55:51');
INSERT INTO `yb-utilities` VALUES ('212', '6', '106', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-06-01', '2016-07-01', '0', '0', '2018-11-09 16:55:51');
INSERT INTO `yb-utilities` VALUES ('213', '7', '107', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-07-01', '2016-08-01', '0', '0', '2018-11-09 16:55:51');
INSERT INTO `yb-utilities` VALUES ('214', '8', '108', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-08-01', '2016-09-01', '0', '0', '2018-11-09 16:55:51');
INSERT INTO `yb-utilities` VALUES ('215', '9', '109', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-09-01', '2016-10-01', '0', '0', '2018-11-09 16:55:51');
INSERT INTO `yb-utilities` VALUES ('216', '10', '110', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-10-01', '2016-11-01', '0', '0', '2018-11-09 16:55:51');
INSERT INTO `yb-utilities` VALUES ('217', '1', '111', '0', '4000', '1000', '3000', '1.25', '3750', '0', '2016-11-01', '2016-12-01', '0', '0', '2018-11-09 16:55:51');
INSERT INTO `yb-utilities` VALUES ('218', '2', '112', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-12-01', '2016-01-01', '0', '0', '2018-11-09 16:55:51');
INSERT INTO `yb-utilities` VALUES ('219', '3', '113', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-01-01', '2016-02-01', '0', '0', '2018-11-09 16:55:51');
INSERT INTO `yb-utilities` VALUES ('220', '4', '114', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-02-01', '2016-03-01', '0', '0', '2018-11-09 16:55:51');
INSERT INTO `yb-utilities` VALUES ('221', '5', '115', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-03-01', '2016-04-01', '0', '0', '2018-11-09 16:55:51');
INSERT INTO `yb-utilities` VALUES ('222', '6', '116', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-04-01', '2016-05-01', '0', '0', '2018-11-09 16:55:51');
INSERT INTO `yb-utilities` VALUES ('223', '7', '117', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-05-01', '2016-06-01', '0', '0', '2018-11-09 16:55:51');
INSERT INTO `yb-utilities` VALUES ('224', '8', '118', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-06-01', '2016-07-01', '0', '0', '2018-11-09 16:55:51');
INSERT INTO `yb-utilities` VALUES ('225', '9', '119', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-07-01', '2016-08-01', '0', '0', '2018-11-09 16:55:51');
INSERT INTO `yb-utilities` VALUES ('226', '10', '120', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-08-01', '2016-09-01', '0', '0', '2018-11-09 16:55:51');
INSERT INTO `yb-utilities` VALUES ('227', '1', '121', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-09-01', '2016-10-01', '0', '0', '2018-11-09 16:55:51');
INSERT INTO `yb-utilities` VALUES ('228', '2', '122', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-10-01', '2016-11-01', '0', '0', '2018-11-09 16:55:51');
INSERT INTO `yb-utilities` VALUES ('229', '3', '123', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-11-01', '2016-12-01', '0', '0', '2018-11-09 16:55:52');
INSERT INTO `yb-utilities` VALUES ('230', '4', '124', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-12-01', '2016-01-01', '0', '0', '2018-11-09 16:55:52');
INSERT INTO `yb-utilities` VALUES ('231', '5', '125', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-01-01', '2016-02-01', '0', '0', '2018-11-09 16:55:52');
INSERT INTO `yb-utilities` VALUES ('232', '6', '126', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-02-01', '2016-03-01', '0', '0', '2018-11-09 16:55:52');
INSERT INTO `yb-utilities` VALUES ('233', '7', '127', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-03-01', '2016-04-01', '0', '0', '2018-11-09 16:55:52');
INSERT INTO `yb-utilities` VALUES ('234', '8', '128', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-04-01', '2016-05-01', '0', '0', '2018-11-09 16:55:52');
INSERT INTO `yb-utilities` VALUES ('235', '9', '129', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-05-01', '2016-06-01', '0', '0', '2018-11-09 16:55:52');
INSERT INTO `yb-utilities` VALUES ('236', '10', '130', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-06-01', '2016-07-01', '0', '0', '2018-11-09 16:55:52');
INSERT INTO `yb-utilities` VALUES ('237', '1', '131', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-07-01', '2016-08-01', '0', '0', '2018-11-09 16:55:52');
INSERT INTO `yb-utilities` VALUES ('238', '2', '132', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-08-01', '2016-09-01', '0', '0', '2018-11-09 16:55:52');
INSERT INTO `yb-utilities` VALUES ('239', '3', '133', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-09-01', '2016-10-01', '0', '0', '2018-11-09 16:55:52');
INSERT INTO `yb-utilities` VALUES ('240', '4', '134', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-10-01', '2016-11-01', '0', '0', '2018-11-09 16:55:52');
INSERT INTO `yb-utilities` VALUES ('241', '5', '135', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-11-01', '2016-12-01', '0', '0', '2018-11-09 16:55:52');
INSERT INTO `yb-utilities` VALUES ('242', '6', '136', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-12-01', '2016-01-01', '0', '0', '2018-11-09 16:55:52');
INSERT INTO `yb-utilities` VALUES ('243', '7', '137', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-01-01', '2016-02-01', '0', '0', '2018-11-09 16:55:52');
INSERT INTO `yb-utilities` VALUES ('244', '8', '138', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-02-01', '2016-03-01', '0', '0', '2018-11-09 16:55:52');
INSERT INTO `yb-utilities` VALUES ('245', '9', '139', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-03-01', '2016-04-01', '0', '0', '2018-11-09 16:55:52');
INSERT INTO `yb-utilities` VALUES ('246', '10', '140', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-04-01', '2016-05-01', '0', '0', '2018-11-09 16:55:52');
INSERT INTO `yb-utilities` VALUES ('247', '1', '101', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-01-01', '2016-02-01', '0', '0', '2018-11-09 16:57:12');
INSERT INTO `yb-utilities` VALUES ('248', '2', '102', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-02-01', '2016-03-01', '0', '0', '2018-11-09 16:57:12');
INSERT INTO `yb-utilities` VALUES ('249', '3', '103', '0', '3000', '1000', '2000', '1.25', '2500', '0', '2016-03-01', '2016-04-01', '0', '0', '2018-11-09 16:57:12');
INSERT INTO `yb-utilities` VALUES ('250', '4', '104', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-04-01', '2016-05-01', '0', '0', '2018-11-09 16:57:12');
INSERT INTO `yb-utilities` VALUES ('251', '5', '105', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-05-01', '2016-06-01', '0', '0', '2018-11-09 16:57:13');
INSERT INTO `yb-utilities` VALUES ('252', '6', '106', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-06-01', '2016-07-01', '0', '0', '2018-11-09 16:57:13');
INSERT INTO `yb-utilities` VALUES ('253', '7', '107', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-07-01', '2016-08-01', '0', '0', '2018-11-09 16:57:13');
INSERT INTO `yb-utilities` VALUES ('254', '8', '108', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-08-01', '2016-09-01', '0', '0', '2018-11-09 16:57:13');
INSERT INTO `yb-utilities` VALUES ('255', '9', '109', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-09-01', '2016-10-01', '0', '0', '2018-11-09 16:57:13');
INSERT INTO `yb-utilities` VALUES ('256', '10', '110', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-10-01', '2016-11-01', '0', '0', '2018-11-09 16:57:13');
INSERT INTO `yb-utilities` VALUES ('257', '1', '111', '0', '4000', '1000', '3000', '1.25', '3750', '0', '2016-11-01', '2016-12-01', '0', '0', '2018-11-09 16:57:13');
INSERT INTO `yb-utilities` VALUES ('258', '2', '112', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-12-01', '2016-01-01', '0', '0', '2018-11-09 16:57:13');
INSERT INTO `yb-utilities` VALUES ('259', '3', '113', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-01-01', '2016-02-01', '0', '0', '2018-11-09 16:57:13');
INSERT INTO `yb-utilities` VALUES ('260', '4', '114', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-02-01', '2016-03-01', '0', '0', '2018-11-09 16:57:13');
INSERT INTO `yb-utilities` VALUES ('261', '5', '115', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-03-01', '2016-04-01', '0', '0', '2018-11-09 16:57:13');
INSERT INTO `yb-utilities` VALUES ('262', '6', '116', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-04-01', '2016-05-01', '0', '0', '2018-11-09 16:57:13');
INSERT INTO `yb-utilities` VALUES ('263', '7', '117', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-05-01', '2016-06-01', '0', '0', '2018-11-09 16:57:13');
INSERT INTO `yb-utilities` VALUES ('264', '8', '118', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-06-01', '2016-07-01', '0', '0', '2018-11-09 16:57:13');
INSERT INTO `yb-utilities` VALUES ('265', '9', '119', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-07-01', '2016-08-01', '0', '0', '2018-11-09 16:57:13');
INSERT INTO `yb-utilities` VALUES ('266', '10', '120', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-08-01', '2016-09-01', '0', '0', '2018-11-09 16:57:13');
INSERT INTO `yb-utilities` VALUES ('267', '1', '121', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-09-01', '2016-10-01', '0', '0', '2018-11-09 16:57:13');
INSERT INTO `yb-utilities` VALUES ('268', '2', '122', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-10-01', '2016-11-01', '0', '0', '2018-11-09 16:57:13');
INSERT INTO `yb-utilities` VALUES ('269', '3', '123', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-11-01', '2016-12-01', '0', '0', '2018-11-09 16:57:13');
INSERT INTO `yb-utilities` VALUES ('270', '4', '124', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-12-01', '2016-01-01', '0', '0', '2018-11-09 16:57:13');
INSERT INTO `yb-utilities` VALUES ('271', '5', '125', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-01-01', '2016-02-01', '0', '0', '2018-11-09 16:57:13');
INSERT INTO `yb-utilities` VALUES ('272', '6', '126', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-02-01', '2016-03-01', '0', '0', '2018-11-09 16:57:13');
INSERT INTO `yb-utilities` VALUES ('273', '7', '127', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-03-01', '2016-04-01', '0', '0', '2018-11-09 16:57:13');
INSERT INTO `yb-utilities` VALUES ('274', '8', '128', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-04-01', '2016-05-01', '0', '0', '2018-11-09 16:57:13');
INSERT INTO `yb-utilities` VALUES ('275', '9', '129', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-05-01', '2016-06-01', '0', '0', '2018-11-09 16:57:13');
INSERT INTO `yb-utilities` VALUES ('276', '10', '130', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-06-01', '2016-07-01', '0', '0', '2018-11-09 16:57:13');
INSERT INTO `yb-utilities` VALUES ('277', '1', '131', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-07-01', '2016-08-01', '0', '0', '2018-11-09 16:57:13');
INSERT INTO `yb-utilities` VALUES ('278', '2', '132', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-08-01', '2016-09-01', '0', '0', '2018-11-09 16:57:13');
INSERT INTO `yb-utilities` VALUES ('279', '3', '133', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-09-01', '2016-10-01', '0', '0', '2018-11-09 16:57:13');
INSERT INTO `yb-utilities` VALUES ('280', '4', '134', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-10-01', '2016-11-01', '0', '0', '2018-11-09 16:57:13');
INSERT INTO `yb-utilities` VALUES ('281', '5', '135', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-11-01', '2016-12-01', '0', '0', '2018-11-09 16:57:13');
INSERT INTO `yb-utilities` VALUES ('282', '6', '136', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-12-01', '2016-01-01', '0', '0', '2018-11-09 16:57:13');
INSERT INTO `yb-utilities` VALUES ('283', '7', '137', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-01-01', '2016-02-01', '0', '0', '2018-11-09 16:57:13');
INSERT INTO `yb-utilities` VALUES ('284', '8', '138', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-02-01', '2016-03-01', '0', '0', '2018-11-09 16:57:13');
INSERT INTO `yb-utilities` VALUES ('285', '9', '139', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-03-01', '2016-04-01', '0', '0', '2018-11-09 16:57:13');
INSERT INTO `yb-utilities` VALUES ('286', '10', '140', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-04-01', '2016-05-01', '0', '0', '2018-11-09 16:57:13');
INSERT INTO `yb-utilities` VALUES ('287', '1', '101', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-01-01', '2016-02-01', '0', '0', '2018-11-09 17:01:44');
INSERT INTO `yb-utilities` VALUES ('288', '2', '102', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-02-01', '2016-03-01', '0', '0', '2018-11-09 17:01:44');
INSERT INTO `yb-utilities` VALUES ('289', '3', '103', '0', '3000', '1000', '2000', '1.25', '2500', '0', '2016-03-01', '2016-04-01', '0', '0', '2018-11-09 17:01:44');
INSERT INTO `yb-utilities` VALUES ('290', '4', '104', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-04-01', '2016-05-01', '0', '0', '2018-11-09 17:01:44');
INSERT INTO `yb-utilities` VALUES ('291', '5', '105', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-05-01', '2016-06-01', '0', '0', '2018-11-09 17:01:44');
INSERT INTO `yb-utilities` VALUES ('292', '6', '106', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-06-01', '2016-07-01', '0', '0', '2018-11-09 17:01:44');
INSERT INTO `yb-utilities` VALUES ('293', '7', '107', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-07-01', '2016-08-01', '0', '0', '2018-11-09 17:01:44');
INSERT INTO `yb-utilities` VALUES ('294', '8', '108', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-08-01', '2016-09-01', '0', '0', '2018-11-09 17:01:44');
INSERT INTO `yb-utilities` VALUES ('295', '9', '109', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-09-01', '2016-10-01', '0', '0', '2018-11-09 17:01:44');
INSERT INTO `yb-utilities` VALUES ('296', '10', '110', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-10-01', '2016-11-01', '0', '0', '2018-11-09 17:01:44');
INSERT INTO `yb-utilities` VALUES ('297', '1', '111', '0', '4000', '1000', '3000', '1.25', '3750', '0', '2016-11-01', '2016-12-01', '0', '0', '2018-11-09 17:01:44');
INSERT INTO `yb-utilities` VALUES ('298', '2', '112', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-12-01', '2016-01-01', '0', '0', '2018-11-09 17:01:44');
INSERT INTO `yb-utilities` VALUES ('299', '3', '113', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-01-01', '2016-02-01', '0', '0', '2018-11-09 17:01:44');
INSERT INTO `yb-utilities` VALUES ('300', '4', '114', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-02-01', '2016-03-01', '0', '0', '2018-11-09 17:01:44');
INSERT INTO `yb-utilities` VALUES ('301', '5', '115', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-03-01', '2016-04-01', '0', '0', '2018-11-09 17:01:44');
INSERT INTO `yb-utilities` VALUES ('302', '6', '116', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-04-01', '2016-05-01', '0', '0', '2018-11-09 17:01:44');
INSERT INTO `yb-utilities` VALUES ('303', '7', '117', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-05-01', '2016-06-01', '0', '0', '2018-11-09 17:01:44');
INSERT INTO `yb-utilities` VALUES ('304', '8', '118', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-06-01', '2016-07-01', '0', '0', '2018-11-09 17:01:45');
INSERT INTO `yb-utilities` VALUES ('305', '9', '119', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-07-01', '2016-08-01', '0', '0', '2018-11-09 17:01:45');
INSERT INTO `yb-utilities` VALUES ('306', '10', '120', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-08-01', '2016-09-01', '0', '0', '2018-11-09 17:01:45');
INSERT INTO `yb-utilities` VALUES ('307', '1', '121', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-09-01', '2016-10-01', '0', '0', '2018-11-09 17:01:45');
INSERT INTO `yb-utilities` VALUES ('308', '2', '122', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-10-01', '2016-11-01', '0', '0', '2018-11-09 17:01:45');
INSERT INTO `yb-utilities` VALUES ('309', '3', '123', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-11-01', '2016-12-01', '0', '0', '2018-11-09 17:01:45');
INSERT INTO `yb-utilities` VALUES ('310', '4', '124', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-12-01', '2016-01-01', '0', '0', '2018-11-09 17:01:45');
INSERT INTO `yb-utilities` VALUES ('311', '5', '125', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-01-01', '2016-02-01', '0', '0', '2018-11-09 17:01:45');
INSERT INTO `yb-utilities` VALUES ('312', '6', '126', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-02-01', '2016-03-01', '0', '0', '2018-11-09 17:01:45');
INSERT INTO `yb-utilities` VALUES ('313', '7', '127', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-03-01', '2016-04-01', '0', '0', '2018-11-09 17:01:45');
INSERT INTO `yb-utilities` VALUES ('314', '8', '128', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-04-01', '2016-05-01', '0', '0', '2018-11-09 17:01:45');
INSERT INTO `yb-utilities` VALUES ('315', '9', '129', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-05-01', '2016-06-01', '0', '0', '2018-11-09 17:01:45');
INSERT INTO `yb-utilities` VALUES ('316', '10', '130', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-06-01', '2016-07-01', '0', '0', '2018-11-09 17:01:45');
INSERT INTO `yb-utilities` VALUES ('317', '1', '131', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-07-01', '2016-08-01', '0', '0', '2018-11-09 17:01:45');
INSERT INTO `yb-utilities` VALUES ('318', '2', '132', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-08-01', '2016-09-01', '0', '0', '2018-11-09 17:01:45');
INSERT INTO `yb-utilities` VALUES ('319', '3', '133', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-09-01', '2016-10-01', '0', '0', '2018-11-09 17:01:45');
INSERT INTO `yb-utilities` VALUES ('320', '4', '134', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-10-01', '2016-11-01', '0', '0', '2018-11-09 17:01:45');
INSERT INTO `yb-utilities` VALUES ('321', '5', '135', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-11-01', '2016-12-01', '0', '0', '2018-11-09 17:01:45');
INSERT INTO `yb-utilities` VALUES ('322', '6', '136', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-12-01', '2016-01-01', '0', '0', '2018-11-09 17:01:45');
INSERT INTO `yb-utilities` VALUES ('323', '7', '137', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-01-01', '2016-02-01', '0', '0', '2018-11-09 17:01:45');
INSERT INTO `yb-utilities` VALUES ('324', '8', '138', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-02-01', '2016-03-01', '0', '0', '2018-11-09 17:01:45');
INSERT INTO `yb-utilities` VALUES ('325', '9', '139', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-03-01', '2016-04-01', '0', '0', '2018-11-09 17:01:45');
INSERT INTO `yb-utilities` VALUES ('326', '10', '140', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-04-01', '2016-05-01', '0', '0', '2018-11-09 17:01:45');
INSERT INTO `yb-utilities` VALUES ('327', '1', '101', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-01-01', '2016-02-01', '0', '0', '2018-11-09 17:01:57');
INSERT INTO `yb-utilities` VALUES ('328', '2', '102', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-02-01', '2016-03-01', '0', '0', '2018-11-09 17:01:57');
INSERT INTO `yb-utilities` VALUES ('329', '3', '103', '0', '3000', '1000', '2000', '1.25', '2500', '0', '2016-03-01', '2016-04-01', '0', '0', '2018-11-09 17:01:57');
INSERT INTO `yb-utilities` VALUES ('330', '4', '104', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-04-01', '2016-05-01', '0', '0', '2018-11-09 17:01:57');
INSERT INTO `yb-utilities` VALUES ('331', '5', '105', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-05-01', '2016-06-01', '0', '0', '2018-11-09 17:01:57');
INSERT INTO `yb-utilities` VALUES ('332', '6', '106', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-06-01', '2016-07-01', '0', '0', '2018-11-09 17:01:57');
INSERT INTO `yb-utilities` VALUES ('333', '7', '107', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-07-01', '2016-08-01', '0', '0', '2018-11-09 17:01:57');
INSERT INTO `yb-utilities` VALUES ('334', '8', '108', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-08-01', '2016-09-01', '0', '0', '2018-11-09 17:01:57');
INSERT INTO `yb-utilities` VALUES ('335', '9', '109', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-09-01', '2016-10-01', '0', '0', '2018-11-09 17:01:57');
INSERT INTO `yb-utilities` VALUES ('336', '10', '110', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-10-01', '2016-11-01', '0', '0', '2018-11-09 17:01:57');
INSERT INTO `yb-utilities` VALUES ('337', '1', '111', '0', '4000', '1000', '3000', '1.25', '3750', '0', '2016-11-01', '2016-12-01', '0', '0', '2018-11-09 17:01:57');
INSERT INTO `yb-utilities` VALUES ('338', '2', '112', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-12-01', '2016-01-01', '0', '0', '2018-11-09 17:01:57');
INSERT INTO `yb-utilities` VALUES ('339', '3', '113', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-01-01', '2016-02-01', '0', '0', '2018-11-09 17:01:57');
INSERT INTO `yb-utilities` VALUES ('340', '4', '114', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-02-01', '2016-03-01', '0', '0', '2018-11-09 17:01:57');
INSERT INTO `yb-utilities` VALUES ('341', '5', '115', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-03-01', '2016-04-01', '0', '0', '2018-11-09 17:01:57');
INSERT INTO `yb-utilities` VALUES ('342', '6', '116', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-04-01', '2016-05-01', '0', '0', '2018-11-09 17:01:57');
INSERT INTO `yb-utilities` VALUES ('343', '7', '117', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-05-01', '2016-06-01', '0', '0', '2018-11-09 17:01:57');
INSERT INTO `yb-utilities` VALUES ('344', '8', '118', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-06-01', '2016-07-01', '0', '0', '2018-11-09 17:01:57');
INSERT INTO `yb-utilities` VALUES ('345', '9', '119', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-07-01', '2016-08-01', '0', '0', '2018-11-09 17:01:57');
INSERT INTO `yb-utilities` VALUES ('346', '10', '120', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-08-01', '2016-09-01', '0', '0', '2018-11-09 17:01:57');
INSERT INTO `yb-utilities` VALUES ('347', '1', '121', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-09-01', '2016-10-01', '0', '0', '2018-11-09 17:01:57');
INSERT INTO `yb-utilities` VALUES ('348', '2', '122', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-10-01', '2016-11-01', '0', '0', '2018-11-09 17:01:57');
INSERT INTO `yb-utilities` VALUES ('349', '3', '123', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-11-01', '2016-12-01', '0', '0', '2018-11-09 17:01:57');
INSERT INTO `yb-utilities` VALUES ('350', '4', '124', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-12-01', '2016-01-01', '0', '0', '2018-11-09 17:01:57');
INSERT INTO `yb-utilities` VALUES ('351', '5', '125', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-01-01', '2016-02-01', '0', '0', '2018-11-09 17:01:57');
INSERT INTO `yb-utilities` VALUES ('352', '6', '126', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-02-01', '2016-03-01', '0', '0', '2018-11-09 17:01:57');
INSERT INTO `yb-utilities` VALUES ('353', '7', '127', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-03-01', '2016-04-01', '0', '0', '2018-11-09 17:01:57');
INSERT INTO `yb-utilities` VALUES ('354', '8', '128', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-04-01', '2016-05-01', '0', '0', '2018-11-09 17:01:57');
INSERT INTO `yb-utilities` VALUES ('355', '9', '129', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-05-01', '2016-06-01', '0', '0', '2018-11-09 17:01:57');
INSERT INTO `yb-utilities` VALUES ('356', '10', '130', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-06-01', '2016-07-01', '0', '0', '2018-11-09 17:01:57');
INSERT INTO `yb-utilities` VALUES ('357', '1', '131', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-07-01', '2016-08-01', '0', '0', '2018-11-09 17:01:57');
INSERT INTO `yb-utilities` VALUES ('358', '2', '132', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-08-01', '2016-09-01', '0', '0', '2018-11-09 17:01:57');
INSERT INTO `yb-utilities` VALUES ('359', '3', '133', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-09-01', '2016-10-01', '0', '0', '2018-11-09 17:01:57');
INSERT INTO `yb-utilities` VALUES ('360', '4', '134', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-10-01', '2016-11-01', '0', '0', '2018-11-09 17:01:57');
INSERT INTO `yb-utilities` VALUES ('361', '5', '135', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-11-01', '2016-12-01', '0', '0', '2018-11-09 17:01:57');
INSERT INTO `yb-utilities` VALUES ('362', '6', '136', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-12-01', '2016-01-01', '0', '0', '2018-11-09 17:01:57');
INSERT INTO `yb-utilities` VALUES ('363', '7', '137', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-01-01', '2016-02-01', '0', '0', '2018-11-09 17:01:57');
INSERT INTO `yb-utilities` VALUES ('364', '8', '138', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-02-01', '2016-03-01', '0', '0', '2018-11-09 17:01:57');
INSERT INTO `yb-utilities` VALUES ('365', '9', '139', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-03-01', '2016-04-01', '0', '0', '2018-11-09 17:01:57');
INSERT INTO `yb-utilities` VALUES ('366', '10', '140', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-04-01', '2016-05-01', '0', '0', '2018-11-09 17:01:57');
INSERT INTO `yb-utilities` VALUES ('367', '1', '101', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-01-01', '2016-02-01', '0', '0', '2018-11-09 17:02:36');
INSERT INTO `yb-utilities` VALUES ('368', '2', '102', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-02-01', '2016-03-01', '0', '0', '2018-11-09 17:02:36');
INSERT INTO `yb-utilities` VALUES ('369', '3', '103', '0', '3000', '1000', '2000', '1.25', '2500', '0', '2016-03-01', '2016-04-01', '0', '0', '2018-11-09 17:02:36');
INSERT INTO `yb-utilities` VALUES ('370', '4', '104', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-04-01', '2016-05-01', '0', '0', '2018-11-09 17:02:36');
INSERT INTO `yb-utilities` VALUES ('371', '5', '105', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-05-01', '2016-06-01', '0', '0', '2018-11-09 17:02:36');
INSERT INTO `yb-utilities` VALUES ('372', '6', '106', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-06-01', '2016-07-01', '0', '0', '2018-11-09 17:02:36');
INSERT INTO `yb-utilities` VALUES ('373', '7', '107', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-07-01', '2016-08-01', '0', '0', '2018-11-09 17:02:36');
INSERT INTO `yb-utilities` VALUES ('374', '8', '108', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-08-01', '2016-09-01', '0', '0', '2018-11-09 17:02:36');
INSERT INTO `yb-utilities` VALUES ('375', '9', '109', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-09-01', '2016-10-01', '0', '0', '2018-11-09 17:02:36');
INSERT INTO `yb-utilities` VALUES ('376', '10', '110', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-10-01', '2016-11-01', '0', '0', '2018-11-09 17:02:36');
INSERT INTO `yb-utilities` VALUES ('377', '1', '111', '0', '4000', '1000', '3000', '1.25', '3750', '0', '2016-11-01', '2016-12-01', '0', '0', '2018-11-09 17:02:36');
INSERT INTO `yb-utilities` VALUES ('378', '2', '112', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-12-01', '2016-01-01', '0', '0', '2018-11-09 17:02:36');
INSERT INTO `yb-utilities` VALUES ('379', '3', '113', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-01-01', '2016-02-01', '0', '0', '2018-11-09 17:02:36');
INSERT INTO `yb-utilities` VALUES ('380', '4', '114', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-02-01', '2016-03-01', '0', '0', '2018-11-09 17:02:36');
INSERT INTO `yb-utilities` VALUES ('381', '5', '115', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-03-01', '2016-04-01', '0', '0', '2018-11-09 17:02:36');
INSERT INTO `yb-utilities` VALUES ('382', '6', '116', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-04-01', '2016-05-01', '0', '0', '2018-11-09 17:02:36');
INSERT INTO `yb-utilities` VALUES ('383', '7', '117', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-05-01', '2016-06-01', '0', '0', '2018-11-09 17:02:36');
INSERT INTO `yb-utilities` VALUES ('384', '8', '118', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-06-01', '2016-07-01', '0', '0', '2018-11-09 17:02:36');
INSERT INTO `yb-utilities` VALUES ('385', '9', '119', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-07-01', '2016-08-01', '0', '0', '2018-11-09 17:02:36');
INSERT INTO `yb-utilities` VALUES ('386', '10', '120', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-08-01', '2016-09-01', '0', '0', '2018-11-09 17:02:36');
INSERT INTO `yb-utilities` VALUES ('387', '1', '121', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-09-01', '2016-10-01', '0', '0', '2018-11-09 17:02:36');
INSERT INTO `yb-utilities` VALUES ('388', '2', '122', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-10-01', '2016-11-01', '0', '0', '2018-11-09 17:02:36');
INSERT INTO `yb-utilities` VALUES ('389', '3', '123', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-11-01', '2016-12-01', '0', '0', '2018-11-09 17:02:36');
INSERT INTO `yb-utilities` VALUES ('390', '4', '124', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-12-01', '2016-01-01', '0', '0', '2018-11-09 17:02:36');
INSERT INTO `yb-utilities` VALUES ('391', '5', '125', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-01-01', '2016-02-01', '0', '0', '2018-11-09 17:02:36');
INSERT INTO `yb-utilities` VALUES ('392', '6', '126', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-02-01', '2016-03-01', '0', '0', '2018-11-09 17:02:36');
INSERT INTO `yb-utilities` VALUES ('393', '7', '127', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-03-01', '2016-04-01', '0', '0', '2018-11-09 17:02:36');
INSERT INTO `yb-utilities` VALUES ('394', '8', '128', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-04-01', '2016-05-01', '0', '0', '2018-11-09 17:02:36');
INSERT INTO `yb-utilities` VALUES ('395', '9', '129', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-05-01', '2016-06-01', '0', '0', '2018-11-09 17:02:36');
INSERT INTO `yb-utilities` VALUES ('396', '10', '130', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-06-01', '2016-07-01', '0', '0', '2018-11-09 17:02:36');
INSERT INTO `yb-utilities` VALUES ('397', '1', '131', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-07-01', '2016-08-01', '0', '0', '2018-11-09 17:02:36');
INSERT INTO `yb-utilities` VALUES ('398', '2', '132', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-08-01', '2016-09-01', '0', '0', '2018-11-09 17:02:36');
INSERT INTO `yb-utilities` VALUES ('399', '3', '133', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-09-01', '2016-10-01', '0', '0', '2018-11-09 17:02:36');
INSERT INTO `yb-utilities` VALUES ('400', '4', '134', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-10-01', '2016-11-01', '0', '0', '2018-11-09 17:02:36');
INSERT INTO `yb-utilities` VALUES ('401', '5', '135', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-11-01', '2016-12-01', '0', '0', '2018-11-09 17:02:36');
INSERT INTO `yb-utilities` VALUES ('402', '6', '136', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-12-01', '2016-01-01', '0', '0', '2018-11-09 17:02:36');
INSERT INTO `yb-utilities` VALUES ('403', '7', '137', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-01-01', '2016-02-01', '0', '0', '2018-11-09 17:02:36');
INSERT INTO `yb-utilities` VALUES ('404', '8', '138', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-02-01', '2016-03-01', '0', '0', '2018-11-09 17:02:36');
INSERT INTO `yb-utilities` VALUES ('405', '9', '139', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-03-01', '2016-04-01', '0', '0', '2018-11-09 17:02:36');
INSERT INTO `yb-utilities` VALUES ('406', '10', '140', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-04-01', '2016-05-01', '0', '0', '2018-11-09 17:02:36');
INSERT INTO `yb-utilities` VALUES ('407', '1', '101', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-01-01', '2016-02-01', '0', '0', '2018-11-09 17:04:45');
INSERT INTO `yb-utilities` VALUES ('408', '2', '102', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-02-01', '2016-03-01', '0', '0', '2018-11-09 17:04:45');
INSERT INTO `yb-utilities` VALUES ('409', '3', '103', '0', '3000', '1000', '2000', '1.25', '2500', '0', '2016-03-01', '2016-04-01', '0', '0', '2018-11-09 17:04:45');
INSERT INTO `yb-utilities` VALUES ('410', '4', '104', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-04-01', '2016-05-01', '0', '0', '2018-11-09 17:04:45');
INSERT INTO `yb-utilities` VALUES ('411', '5', '105', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-05-01', '2016-06-01', '0', '0', '2018-11-09 17:04:45');
INSERT INTO `yb-utilities` VALUES ('412', '6', '106', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-06-01', '2016-07-01', '0', '0', '2018-11-09 17:04:45');
INSERT INTO `yb-utilities` VALUES ('413', '7', '107', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-07-01', '2016-08-01', '0', '0', '2018-11-09 17:04:45');
INSERT INTO `yb-utilities` VALUES ('414', '8', '108', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-08-01', '2016-09-01', '0', '0', '2018-11-09 17:04:45');
INSERT INTO `yb-utilities` VALUES ('415', '9', '109', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-09-01', '2016-10-01', '0', '0', '2018-11-09 17:04:45');
INSERT INTO `yb-utilities` VALUES ('416', '10', '110', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-10-01', '2016-11-01', '0', '0', '2018-11-09 17:04:45');
INSERT INTO `yb-utilities` VALUES ('417', '1', '111', '0', '4000', '1000', '3000', '1.25', '3750', '0', '2016-11-01', '2016-12-01', '0', '0', '2018-11-09 17:04:45');
INSERT INTO `yb-utilities` VALUES ('418', '2', '112', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-12-01', '2016-01-01', '0', '0', '2018-11-09 17:04:45');
INSERT INTO `yb-utilities` VALUES ('419', '3', '113', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-01-01', '2016-02-01', '0', '0', '2018-11-09 17:04:45');
INSERT INTO `yb-utilities` VALUES ('420', '4', '114', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-02-01', '2016-03-01', '0', '0', '2018-11-09 17:04:45');
INSERT INTO `yb-utilities` VALUES ('421', '5', '115', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-03-01', '2016-04-01', '0', '0', '2018-11-09 17:04:45');
INSERT INTO `yb-utilities` VALUES ('422', '6', '116', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-04-01', '2016-05-01', '0', '0', '2018-11-09 17:04:45');
INSERT INTO `yb-utilities` VALUES ('423', '7', '117', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-05-01', '2016-06-01', '0', '0', '2018-11-09 17:04:45');
INSERT INTO `yb-utilities` VALUES ('424', '8', '118', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-06-01', '2016-07-01', '0', '0', '2018-11-09 17:04:45');
INSERT INTO `yb-utilities` VALUES ('425', '9', '119', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-07-01', '2016-08-01', '0', '0', '2018-11-09 17:04:45');
INSERT INTO `yb-utilities` VALUES ('426', '10', '120', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-08-01', '2016-09-01', '0', '0', '2018-11-09 17:04:45');
INSERT INTO `yb-utilities` VALUES ('427', '1', '121', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-09-01', '2016-10-01', '0', '0', '2018-11-09 17:04:45');
INSERT INTO `yb-utilities` VALUES ('428', '2', '122', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-10-01', '2016-11-01', '0', '0', '2018-11-09 17:04:45');
INSERT INTO `yb-utilities` VALUES ('429', '3', '123', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-11-01', '2016-12-01', '0', '0', '2018-11-09 17:04:45');
INSERT INTO `yb-utilities` VALUES ('430', '4', '124', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-12-01', '2016-01-01', '0', '0', '2018-11-09 17:04:45');
INSERT INTO `yb-utilities` VALUES ('431', '5', '125', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-01-01', '2016-02-01', '0', '0', '2018-11-09 17:04:45');
INSERT INTO `yb-utilities` VALUES ('432', '6', '126', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-02-01', '2016-03-01', '0', '0', '2018-11-09 17:04:45');
INSERT INTO `yb-utilities` VALUES ('433', '7', '127', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-03-01', '2016-04-01', '0', '0', '2018-11-09 17:04:45');
INSERT INTO `yb-utilities` VALUES ('434', '8', '128', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-04-01', '2016-05-01', '0', '0', '2018-11-09 17:04:45');
INSERT INTO `yb-utilities` VALUES ('435', '9', '129', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-05-01', '2016-06-01', '0', '0', '2018-11-09 17:04:45');
INSERT INTO `yb-utilities` VALUES ('436', '10', '130', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-06-01', '2016-07-01', '0', '0', '2018-11-09 17:04:45');
INSERT INTO `yb-utilities` VALUES ('437', '1', '131', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-07-01', '2016-08-01', '0', '0', '2018-11-09 17:04:45');
INSERT INTO `yb-utilities` VALUES ('438', '2', '132', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-08-01', '2016-09-01', '0', '0', '2018-11-09 17:04:45');
INSERT INTO `yb-utilities` VALUES ('439', '3', '133', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-09-01', '2016-10-01', '0', '0', '2018-11-09 17:04:45');
INSERT INTO `yb-utilities` VALUES ('440', '4', '134', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-10-01', '2016-11-01', '0', '0', '2018-11-09 17:04:45');
INSERT INTO `yb-utilities` VALUES ('441', '5', '135', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-11-01', '2016-12-01', '0', '0', '2018-11-09 17:04:45');
INSERT INTO `yb-utilities` VALUES ('442', '6', '136', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-12-01', '2016-01-01', '0', '0', '2018-11-09 17:04:45');
INSERT INTO `yb-utilities` VALUES ('443', '7', '137', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-01-01', '2016-02-01', '0', '0', '2018-11-09 17:04:45');
INSERT INTO `yb-utilities` VALUES ('444', '8', '138', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-02-01', '2016-03-01', '0', '0', '2018-11-09 17:04:45');
INSERT INTO `yb-utilities` VALUES ('445', '9', '139', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-03-01', '2016-04-01', '0', '0', '2018-11-09 17:04:45');
INSERT INTO `yb-utilities` VALUES ('446', '10', '140', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-04-01', '2016-05-01', '0', '0', '2018-11-09 17:04:46');
INSERT INTO `yb-utilities` VALUES ('447', '1', '101', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-01-01', '2016-02-01', '0', '0', '2018-11-09 17:06:46');
INSERT INTO `yb-utilities` VALUES ('448', '2', '102', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-02-01', '2016-03-01', '0', '0', '2018-11-09 17:06:46');
INSERT INTO `yb-utilities` VALUES ('449', '3', '103', '0', '3000', '1000', '2000', '1.25', '2500', '0', '2016-03-01', '2016-04-01', '0', '0', '2018-11-09 17:06:46');
INSERT INTO `yb-utilities` VALUES ('450', '4', '104', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-04-01', '2016-05-01', '0', '0', '2018-11-09 17:06:46');
INSERT INTO `yb-utilities` VALUES ('451', '5', '105', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-05-01', '2016-06-01', '0', '0', '2018-11-09 17:06:46');
INSERT INTO `yb-utilities` VALUES ('452', '6', '106', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-06-01', '2016-07-01', '0', '0', '2018-11-09 17:06:46');
INSERT INTO `yb-utilities` VALUES ('453', '7', '107', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-07-01', '2016-08-01', '0', '0', '2018-11-09 17:06:46');
INSERT INTO `yb-utilities` VALUES ('454', '8', '108', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-08-01', '2016-09-01', '0', '0', '2018-11-09 17:06:46');
INSERT INTO `yb-utilities` VALUES ('455', '9', '109', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-09-01', '2016-10-01', '0', '0', '2018-11-09 17:06:46');
INSERT INTO `yb-utilities` VALUES ('456', '10', '110', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-10-01', '2016-11-01', '0', '0', '2018-11-09 17:06:46');
INSERT INTO `yb-utilities` VALUES ('457', '1', '111', '0', '4000', '1000', '3000', '1.25', '3750', '0', '2016-11-01', '2016-12-01', '0', '0', '2018-11-09 17:06:46');
INSERT INTO `yb-utilities` VALUES ('458', '2', '112', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-12-01', '2016-01-01', '0', '0', '2018-11-09 17:06:46');
INSERT INTO `yb-utilities` VALUES ('459', '3', '113', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-01-01', '2016-02-01', '0', '0', '2018-11-09 17:06:46');
INSERT INTO `yb-utilities` VALUES ('460', '4', '114', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-02-01', '2016-03-01', '0', '0', '2018-11-09 17:06:46');
INSERT INTO `yb-utilities` VALUES ('461', '5', '115', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-03-01', '2016-04-01', '0', '0', '2018-11-09 17:06:46');
INSERT INTO `yb-utilities` VALUES ('462', '6', '116', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-04-01', '2016-05-01', '0', '0', '2018-11-09 17:06:46');
INSERT INTO `yb-utilities` VALUES ('463', '7', '117', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-05-01', '2016-06-01', '0', '0', '2018-11-09 17:06:46');
INSERT INTO `yb-utilities` VALUES ('464', '8', '118', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-06-01', '2016-07-01', '0', '0', '2018-11-09 17:06:46');
INSERT INTO `yb-utilities` VALUES ('465', '9', '119', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-07-01', '2016-08-01', '0', '0', '2018-11-09 17:06:46');
INSERT INTO `yb-utilities` VALUES ('466', '10', '120', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-08-01', '2016-09-01', '0', '0', '2018-11-09 17:06:46');
INSERT INTO `yb-utilities` VALUES ('467', '1', '121', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-09-01', '2016-10-01', '0', '0', '2018-11-09 17:06:46');
INSERT INTO `yb-utilities` VALUES ('468', '2', '122', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-10-01', '2016-11-01', '0', '0', '2018-11-09 17:06:46');
INSERT INTO `yb-utilities` VALUES ('469', '3', '123', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-11-01', '2016-12-01', '0', '0', '2018-11-09 17:06:46');
INSERT INTO `yb-utilities` VALUES ('470', '4', '124', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-12-01', '2016-01-01', '0', '0', '2018-11-09 17:06:46');
INSERT INTO `yb-utilities` VALUES ('471', '5', '125', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-01-01', '2016-02-01', '0', '0', '2018-11-09 17:06:46');
INSERT INTO `yb-utilities` VALUES ('472', '6', '126', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-02-01', '2016-03-01', '0', '0', '2018-11-09 17:06:46');
INSERT INTO `yb-utilities` VALUES ('473', '7', '127', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-03-01', '2016-04-01', '0', '0', '2018-11-09 17:06:46');
INSERT INTO `yb-utilities` VALUES ('474', '8', '128', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-04-01', '2016-05-01', '0', '0', '2018-11-09 17:06:46');
INSERT INTO `yb-utilities` VALUES ('475', '9', '129', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-05-01', '2016-06-01', '0', '0', '2018-11-09 17:06:46');
INSERT INTO `yb-utilities` VALUES ('476', '10', '130', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-06-01', '2016-07-01', '0', '0', '2018-11-09 17:06:46');
INSERT INTO `yb-utilities` VALUES ('477', '1', '131', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-07-01', '2016-08-01', '0', '0', '2018-11-09 17:06:46');
INSERT INTO `yb-utilities` VALUES ('478', '2', '132', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-08-01', '2016-09-01', '0', '0', '2018-11-09 17:06:46');
INSERT INTO `yb-utilities` VALUES ('479', '3', '133', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-09-01', '2016-10-01', '0', '0', '2018-11-09 17:06:46');
INSERT INTO `yb-utilities` VALUES ('480', '4', '134', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-10-01', '2016-11-01', '0', '0', '2018-11-09 17:06:46');
INSERT INTO `yb-utilities` VALUES ('481', '5', '135', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-11-01', '2016-12-01', '0', '0', '2018-11-09 17:06:46');
INSERT INTO `yb-utilities` VALUES ('482', '6', '136', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-12-01', '2016-01-01', '0', '0', '2018-11-09 17:06:46');
INSERT INTO `yb-utilities` VALUES ('483', '7', '137', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-01-01', '2016-02-01', '0', '0', '2018-11-09 17:06:46');
INSERT INTO `yb-utilities` VALUES ('484', '8', '138', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-02-01', '2016-03-01', '0', '0', '2018-11-09 17:06:46');
INSERT INTO `yb-utilities` VALUES ('485', '9', '139', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-03-01', '2016-04-01', '0', '0', '2018-11-09 17:06:46');
INSERT INTO `yb-utilities` VALUES ('486', '10', '140', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-04-01', '2016-05-01', '0', '0', '2018-11-09 17:06:46');
INSERT INTO `yb-utilities` VALUES ('487', '1', '101', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-01-01', '2016-02-01', '0', '0', '2018-11-09 17:07:21');
INSERT INTO `yb-utilities` VALUES ('488', '2', '102', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-02-01', '2016-03-01', '0', '0', '2018-11-09 17:07:21');
INSERT INTO `yb-utilities` VALUES ('489', '3', '103', '0', '3000', '1000', '2000', '1.25', '2500', '0', '2016-03-01', '2016-04-01', '0', '0', '2018-11-09 17:07:21');
INSERT INTO `yb-utilities` VALUES ('490', '4', '104', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-04-01', '2016-05-01', '0', '0', '2018-11-09 17:07:21');
INSERT INTO `yb-utilities` VALUES ('491', '5', '105', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-05-01', '2016-06-01', '0', '0', '2018-11-09 17:07:21');
INSERT INTO `yb-utilities` VALUES ('492', '6', '106', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-06-01', '2016-07-01', '0', '0', '2018-11-09 17:07:21');
INSERT INTO `yb-utilities` VALUES ('493', '7', '107', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-07-01', '2016-08-01', '0', '0', '2018-11-09 17:07:21');
INSERT INTO `yb-utilities` VALUES ('494', '8', '108', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-08-01', '2016-09-01', '0', '0', '2018-11-09 17:07:21');
INSERT INTO `yb-utilities` VALUES ('495', '9', '109', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-09-01', '2016-10-01', '0', '0', '2018-11-09 17:07:21');
INSERT INTO `yb-utilities` VALUES ('496', '10', '110', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-10-01', '2016-11-01', '0', '0', '2018-11-09 17:07:21');
INSERT INTO `yb-utilities` VALUES ('497', '1', '111', '0', '4000', '1000', '3000', '1.25', '3750', '0', '2016-11-01', '2016-12-01', '0', '0', '2018-11-09 17:07:21');
INSERT INTO `yb-utilities` VALUES ('498', '2', '112', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-12-01', '2016-01-01', '0', '0', '2018-11-09 17:07:21');
INSERT INTO `yb-utilities` VALUES ('499', '3', '113', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-01-01', '2016-02-01', '0', '0', '2018-11-09 17:07:21');
INSERT INTO `yb-utilities` VALUES ('500', '4', '114', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-02-01', '2016-03-01', '0', '0', '2018-11-09 17:07:21');
INSERT INTO `yb-utilities` VALUES ('501', '5', '115', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-03-01', '2016-04-01', '0', '0', '2018-11-09 17:07:21');
INSERT INTO `yb-utilities` VALUES ('502', '6', '116', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-04-01', '2016-05-01', '0', '0', '2018-11-09 17:07:21');
INSERT INTO `yb-utilities` VALUES ('503', '7', '117', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-05-01', '2016-06-01', '0', '0', '2018-11-09 17:07:21');
INSERT INTO `yb-utilities` VALUES ('504', '8', '118', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-06-01', '2016-07-01', '0', '0', '2018-11-09 17:07:21');
INSERT INTO `yb-utilities` VALUES ('505', '9', '119', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-07-01', '2016-08-01', '0', '0', '2018-11-09 17:07:21');
INSERT INTO `yb-utilities` VALUES ('506', '10', '120', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-08-01', '2016-09-01', '0', '0', '2018-11-09 17:07:21');
INSERT INTO `yb-utilities` VALUES ('507', '1', '121', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-09-01', '2016-10-01', '0', '0', '2018-11-09 17:07:21');
INSERT INTO `yb-utilities` VALUES ('508', '2', '122', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-10-01', '2016-11-01', '0', '0', '2018-11-09 17:07:21');
INSERT INTO `yb-utilities` VALUES ('509', '3', '123', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-11-01', '2016-12-01', '0', '0', '2018-11-09 17:07:21');
INSERT INTO `yb-utilities` VALUES ('510', '4', '124', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-12-01', '2016-01-01', '0', '0', '2018-11-09 17:07:21');
INSERT INTO `yb-utilities` VALUES ('511', '5', '125', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-01-01', '2016-02-01', '0', '0', '2018-11-09 17:07:21');
INSERT INTO `yb-utilities` VALUES ('512', '6', '126', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-02-01', '2016-03-01', '0', '0', '2018-11-09 17:07:21');
INSERT INTO `yb-utilities` VALUES ('513', '7', '127', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-03-01', '2016-04-01', '0', '0', '2018-11-09 17:07:21');
INSERT INTO `yb-utilities` VALUES ('514', '8', '128', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-04-01', '2016-05-01', '0', '0', '2018-11-09 17:07:21');
INSERT INTO `yb-utilities` VALUES ('515', '9', '129', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-05-01', '2016-06-01', '0', '0', '2018-11-09 17:07:21');
INSERT INTO `yb-utilities` VALUES ('516', '10', '130', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-06-01', '2016-07-01', '0', '0', '2018-11-09 17:07:21');
INSERT INTO `yb-utilities` VALUES ('517', '1', '131', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-07-01', '2016-08-01', '0', '0', '2018-11-09 17:07:21');
INSERT INTO `yb-utilities` VALUES ('518', '2', '132', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-08-01', '2016-09-01', '0', '0', '2018-11-09 17:07:21');
INSERT INTO `yb-utilities` VALUES ('519', '3', '133', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-09-01', '2016-10-01', '0', '0', '2018-11-09 17:07:21');
INSERT INTO `yb-utilities` VALUES ('520', '4', '134', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-10-01', '2016-11-01', '0', '0', '2018-11-09 17:07:21');
INSERT INTO `yb-utilities` VALUES ('521', '5', '135', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-11-01', '2016-12-01', '0', '0', '2018-11-09 17:07:21');
INSERT INTO `yb-utilities` VALUES ('522', '6', '136', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-12-01', '2016-01-01', '0', '0', '2018-11-09 17:07:21');
INSERT INTO `yb-utilities` VALUES ('523', '7', '137', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-01-01', '2016-02-01', '0', '0', '2018-11-09 17:07:21');
INSERT INTO `yb-utilities` VALUES ('524', '8', '138', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-02-01', '2016-03-01', '0', '0', '2018-11-09 17:07:21');
INSERT INTO `yb-utilities` VALUES ('525', '9', '139', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-03-01', '2016-04-01', '0', '0', '2018-11-09 17:07:21');
INSERT INTO `yb-utilities` VALUES ('526', '10', '140', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-04-01', '2016-05-01', '0', '0', '2018-11-09 17:07:21');
INSERT INTO `yb-utilities` VALUES ('527', '1', '101', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-01-01', '2016-02-01', '0', '0', '2018-11-09 17:07:34');
INSERT INTO `yb-utilities` VALUES ('528', '2', '102', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-02-01', '2016-03-01', '0', '0', '2018-11-09 17:07:34');
INSERT INTO `yb-utilities` VALUES ('529', '3', '103', '0', '3000', '1000', '2000', '1.25', '2500', '0', '2016-03-01', '2016-04-01', '0', '0', '2018-11-09 17:07:34');
INSERT INTO `yb-utilities` VALUES ('530', '4', '104', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-04-01', '2016-05-01', '0', '0', '2018-11-09 17:07:34');
INSERT INTO `yb-utilities` VALUES ('531', '5', '105', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-05-01', '2016-06-01', '0', '0', '2018-11-09 17:07:34');
INSERT INTO `yb-utilities` VALUES ('532', '6', '106', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-06-01', '2016-07-01', '0', '0', '2018-11-09 17:07:34');
INSERT INTO `yb-utilities` VALUES ('533', '7', '107', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-07-01', '2016-08-01', '0', '0', '2018-11-09 17:07:34');
INSERT INTO `yb-utilities` VALUES ('534', '8', '108', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-08-01', '2016-09-01', '0', '0', '2018-11-09 17:07:34');
INSERT INTO `yb-utilities` VALUES ('535', '9', '109', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-09-01', '2016-10-01', '0', '0', '2018-11-09 17:07:34');
INSERT INTO `yb-utilities` VALUES ('536', '10', '110', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-10-01', '2016-11-01', '0', '0', '2018-11-09 17:07:34');
INSERT INTO `yb-utilities` VALUES ('537', '1', '111', '0', '4000', '1000', '3000', '1.25', '3750', '0', '2016-11-01', '2016-12-01', '0', '0', '2018-11-09 17:07:34');
INSERT INTO `yb-utilities` VALUES ('538', '2', '112', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-12-01', '2016-01-01', '0', '0', '2018-11-09 17:07:34');
INSERT INTO `yb-utilities` VALUES ('539', '3', '113', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-01-01', '2016-02-01', '0', '0', '2018-11-09 17:07:34');
INSERT INTO `yb-utilities` VALUES ('540', '4', '114', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-02-01', '2016-03-01', '0', '0', '2018-11-09 17:07:34');
INSERT INTO `yb-utilities` VALUES ('541', '5', '115', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-03-01', '2016-04-01', '0', '0', '2018-11-09 17:07:34');
INSERT INTO `yb-utilities` VALUES ('542', '6', '116', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-04-01', '2016-05-01', '0', '0', '2018-11-09 17:07:34');
INSERT INTO `yb-utilities` VALUES ('543', '7', '117', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-05-01', '2016-06-01', '0', '0', '2018-11-09 17:07:34');
INSERT INTO `yb-utilities` VALUES ('544', '8', '118', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-06-01', '2016-07-01', '0', '0', '2018-11-09 17:07:34');
INSERT INTO `yb-utilities` VALUES ('545', '9', '119', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-07-01', '2016-08-01', '0', '0', '2018-11-09 17:07:34');
INSERT INTO `yb-utilities` VALUES ('546', '10', '120', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-08-01', '2016-09-01', '0', '0', '2018-11-09 17:07:34');
INSERT INTO `yb-utilities` VALUES ('547', '1', '121', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-09-01', '2016-10-01', '0', '0', '2018-11-09 17:07:34');
INSERT INTO `yb-utilities` VALUES ('548', '2', '122', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-10-01', '2016-11-01', '0', '0', '2018-11-09 17:07:34');
INSERT INTO `yb-utilities` VALUES ('549', '3', '123', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-11-01', '2016-12-01', '0', '0', '2018-11-09 17:07:34');
INSERT INTO `yb-utilities` VALUES ('550', '4', '124', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-12-01', '2016-01-01', '0', '0', '2018-11-09 17:07:34');
INSERT INTO `yb-utilities` VALUES ('551', '5', '125', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-01-01', '2016-02-01', '0', '0', '2018-11-09 17:07:34');
INSERT INTO `yb-utilities` VALUES ('552', '6', '126', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-02-01', '2016-03-01', '0', '0', '2018-11-09 17:07:34');
INSERT INTO `yb-utilities` VALUES ('553', '7', '127', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-03-01', '2016-04-01', '0', '0', '2018-11-09 17:07:34');
INSERT INTO `yb-utilities` VALUES ('554', '8', '128', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-04-01', '2016-05-01', '0', '0', '2018-11-09 17:07:34');
INSERT INTO `yb-utilities` VALUES ('555', '9', '129', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-05-01', '2016-06-01', '0', '0', '2018-11-09 17:07:34');
INSERT INTO `yb-utilities` VALUES ('556', '10', '130', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-06-01', '2016-07-01', '0', '0', '2018-11-09 17:07:34');
INSERT INTO `yb-utilities` VALUES ('557', '1', '131', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-07-01', '2016-08-01', '0', '0', '2018-11-09 17:07:34');
INSERT INTO `yb-utilities` VALUES ('558', '2', '132', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-08-01', '2016-09-01', '0', '0', '2018-11-09 17:07:34');
INSERT INTO `yb-utilities` VALUES ('559', '3', '133', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-09-01', '2016-10-01', '0', '0', '2018-11-09 17:07:34');
INSERT INTO `yb-utilities` VALUES ('560', '4', '134', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-10-01', '2016-11-01', '0', '0', '2018-11-09 17:07:34');
INSERT INTO `yb-utilities` VALUES ('561', '5', '135', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-11-01', '2016-12-01', '0', '0', '2018-11-09 17:07:34');
INSERT INTO `yb-utilities` VALUES ('562', '6', '136', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-12-01', '2016-01-01', '0', '0', '2018-11-09 17:07:34');
INSERT INTO `yb-utilities` VALUES ('563', '7', '137', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-01-01', '2016-02-01', '0', '0', '2018-11-09 17:07:34');
INSERT INTO `yb-utilities` VALUES ('564', '8', '138', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-02-01', '2016-03-01', '0', '0', '2018-11-09 17:07:34');
INSERT INTO `yb-utilities` VALUES ('565', '9', '139', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-03-01', '2016-04-01', '0', '0', '2018-11-09 17:07:34');
INSERT INTO `yb-utilities` VALUES ('566', '10', '140', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-04-01', '2016-05-01', '0', '0', '2018-11-09 17:07:34');
INSERT INTO `yb-utilities` VALUES ('567', '1', '101', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-01-01', '2016-02-01', '0', '0', '2018-11-09 17:08:02');
INSERT INTO `yb-utilities` VALUES ('568', '2', '102', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-02-01', '2016-03-01', '0', '0', '2018-11-09 17:08:02');
INSERT INTO `yb-utilities` VALUES ('569', '3', '103', '0', '3000', '1000', '2000', '1.25', '2500', '0', '2016-03-01', '2016-04-01', '0', '0', '2018-11-09 17:08:02');
INSERT INTO `yb-utilities` VALUES ('570', '4', '104', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-04-01', '2016-05-01', '0', '0', '2018-11-09 17:08:02');
INSERT INTO `yb-utilities` VALUES ('571', '5', '105', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-05-01', '2016-06-01', '0', '0', '2018-11-09 17:08:02');
INSERT INTO `yb-utilities` VALUES ('572', '6', '106', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-06-01', '2016-07-01', '0', '0', '2018-11-09 17:08:02');
INSERT INTO `yb-utilities` VALUES ('573', '7', '107', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-07-01', '2016-08-01', '0', '0', '2018-11-09 17:08:02');
INSERT INTO `yb-utilities` VALUES ('574', '8', '108', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-08-01', '2016-09-01', '0', '0', '2018-11-09 17:08:02');
INSERT INTO `yb-utilities` VALUES ('575', '9', '109', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-09-01', '2016-10-01', '0', '0', '2018-11-09 17:08:02');
INSERT INTO `yb-utilities` VALUES ('576', '10', '110', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-10-01', '2016-11-01', '0', '0', '2018-11-09 17:08:02');
INSERT INTO `yb-utilities` VALUES ('577', '1', '111', '0', '4000', '1000', '3000', '1.25', '3750', '0', '2016-11-01', '2016-12-01', '0', '0', '2018-11-09 17:08:02');
INSERT INTO `yb-utilities` VALUES ('578', '2', '112', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-12-01', '2016-01-01', '0', '0', '2018-11-09 17:08:02');
INSERT INTO `yb-utilities` VALUES ('579', '3', '113', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-01-01', '2016-02-01', '0', '0', '2018-11-09 17:08:02');
INSERT INTO `yb-utilities` VALUES ('580', '4', '114', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-02-01', '2016-03-01', '0', '0', '2018-11-09 17:08:02');
INSERT INTO `yb-utilities` VALUES ('581', '5', '115', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-03-01', '2016-04-01', '0', '0', '2018-11-09 17:08:02');
INSERT INTO `yb-utilities` VALUES ('582', '6', '116', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-04-01', '2016-05-01', '0', '0', '2018-11-09 17:08:02');
INSERT INTO `yb-utilities` VALUES ('583', '7', '117', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-05-01', '2016-06-01', '0', '0', '2018-11-09 17:08:02');
INSERT INTO `yb-utilities` VALUES ('584', '8', '118', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-06-01', '2016-07-01', '0', '0', '2018-11-09 17:08:02');
INSERT INTO `yb-utilities` VALUES ('585', '9', '119', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-07-01', '2016-08-01', '0', '0', '2018-11-09 17:08:02');
INSERT INTO `yb-utilities` VALUES ('586', '10', '120', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-08-01', '2016-09-01', '0', '0', '2018-11-09 17:08:02');
INSERT INTO `yb-utilities` VALUES ('587', '1', '121', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-09-01', '2016-10-01', '0', '0', '2018-11-09 17:08:02');
INSERT INTO `yb-utilities` VALUES ('588', '2', '122', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-10-01', '2016-11-01', '0', '0', '2018-11-09 17:08:02');
INSERT INTO `yb-utilities` VALUES ('589', '3', '123', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-11-01', '2016-12-01', '0', '0', '2018-11-09 17:08:02');
INSERT INTO `yb-utilities` VALUES ('590', '4', '124', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-12-01', '2016-01-01', '0', '0', '2018-11-09 17:08:02');
INSERT INTO `yb-utilities` VALUES ('591', '5', '125', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-01-01', '2016-02-01', '0', '0', '2018-11-09 17:08:02');
INSERT INTO `yb-utilities` VALUES ('592', '6', '126', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-02-01', '2016-03-01', '0', '0', '2018-11-09 17:08:02');
INSERT INTO `yb-utilities` VALUES ('593', '7', '127', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-03-01', '2016-04-01', '0', '0', '2018-11-09 17:08:02');
INSERT INTO `yb-utilities` VALUES ('594', '8', '128', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-04-01', '2016-05-01', '0', '0', '2018-11-09 17:08:02');
INSERT INTO `yb-utilities` VALUES ('595', '9', '129', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-05-01', '2016-06-01', '0', '0', '2018-11-09 17:08:02');
INSERT INTO `yb-utilities` VALUES ('596', '10', '130', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-06-01', '2016-07-01', '0', '0', '2018-11-09 17:08:02');
INSERT INTO `yb-utilities` VALUES ('597', '1', '131', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-07-01', '2016-08-01', '0', '0', '2018-11-09 17:08:02');
INSERT INTO `yb-utilities` VALUES ('598', '2', '132', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-08-01', '2016-09-01', '0', '0', '2018-11-09 17:08:02');
INSERT INTO `yb-utilities` VALUES ('599', '3', '133', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-09-01', '2016-10-01', '0', '0', '2018-11-09 17:08:02');
INSERT INTO `yb-utilities` VALUES ('600', '4', '134', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-10-01', '2016-11-01', '0', '0', '2018-11-09 17:08:02');
INSERT INTO `yb-utilities` VALUES ('601', '5', '135', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-11-01', '2016-12-01', '0', '0', '2018-11-09 17:08:02');
INSERT INTO `yb-utilities` VALUES ('602', '6', '136', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-12-01', '2016-01-01', '0', '0', '2018-11-09 17:08:02');
INSERT INTO `yb-utilities` VALUES ('603', '7', '137', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-01-01', '2016-02-01', '0', '0', '2018-11-09 17:08:02');
INSERT INTO `yb-utilities` VALUES ('604', '8', '138', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-02-01', '2016-03-01', '0', '0', '2018-11-09 17:08:02');
INSERT INTO `yb-utilities` VALUES ('605', '9', '139', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-03-01', '2016-04-01', '0', '0', '2018-11-09 17:08:02');
INSERT INTO `yb-utilities` VALUES ('606', '10', '140', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-04-01', '2016-05-01', '0', '0', '2018-11-09 17:08:02');
INSERT INTO `yb-utilities` VALUES ('607', '1', '101', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-01-01', '2016-02-01', '0', '0', '2018-11-09 17:08:39');
INSERT INTO `yb-utilities` VALUES ('608', '2', '102', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-02-01', '2016-03-01', '0', '0', '2018-11-09 17:08:39');
INSERT INTO `yb-utilities` VALUES ('609', '3', '103', '0', '3000', '1000', '2000', '1.25', '2500', '0', '2016-03-01', '2016-04-01', '0', '0', '2018-11-09 17:08:39');
INSERT INTO `yb-utilities` VALUES ('610', '4', '104', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-04-01', '2016-05-01', '0', '0', '2018-11-09 17:08:39');
INSERT INTO `yb-utilities` VALUES ('611', '5', '105', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-05-01', '2016-06-01', '0', '0', '2018-11-09 17:08:39');
INSERT INTO `yb-utilities` VALUES ('612', '6', '106', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-06-01', '2016-07-01', '0', '0', '2018-11-09 17:08:39');
INSERT INTO `yb-utilities` VALUES ('613', '7', '107', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-07-01', '2016-08-01', '0', '0', '2018-11-09 17:08:39');
INSERT INTO `yb-utilities` VALUES ('614', '8', '108', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-08-01', '2016-09-01', '0', '0', '2018-11-09 17:08:39');
INSERT INTO `yb-utilities` VALUES ('615', '9', '109', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-09-01', '2016-10-01', '0', '0', '2018-11-09 17:08:39');
INSERT INTO `yb-utilities` VALUES ('616', '10', '110', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-10-01', '2016-11-01', '0', '0', '2018-11-09 17:08:39');
INSERT INTO `yb-utilities` VALUES ('617', '1', '111', '0', '4000', '1000', '3000', '1.25', '3750', '0', '2016-11-01', '2016-12-01', '0', '0', '2018-11-09 17:08:39');
INSERT INTO `yb-utilities` VALUES ('618', '2', '112', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-12-01', '2016-01-01', '0', '0', '2018-11-09 17:08:39');
INSERT INTO `yb-utilities` VALUES ('619', '3', '113', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-01-01', '2016-02-01', '0', '0', '2018-11-09 17:08:39');
INSERT INTO `yb-utilities` VALUES ('620', '4', '114', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-02-01', '2016-03-01', '0', '0', '2018-11-09 17:08:39');
INSERT INTO `yb-utilities` VALUES ('621', '5', '115', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-03-01', '2016-04-01', '0', '0', '2018-11-09 17:08:39');
INSERT INTO `yb-utilities` VALUES ('622', '6', '116', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-04-01', '2016-05-01', '0', '0', '2018-11-09 17:08:39');
INSERT INTO `yb-utilities` VALUES ('623', '7', '117', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-05-01', '2016-06-01', '0', '0', '2018-11-09 17:08:39');
INSERT INTO `yb-utilities` VALUES ('624', '8', '118', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-06-01', '2016-07-01', '0', '0', '2018-11-09 17:08:39');
INSERT INTO `yb-utilities` VALUES ('625', '9', '119', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-07-01', '2016-08-01', '0', '0', '2018-11-09 17:08:39');
INSERT INTO `yb-utilities` VALUES ('626', '10', '120', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-08-01', '2016-09-01', '0', '0', '2018-11-09 17:08:39');
INSERT INTO `yb-utilities` VALUES ('627', '1', '121', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-09-01', '2016-10-01', '0', '0', '2018-11-09 17:08:39');
INSERT INTO `yb-utilities` VALUES ('628', '2', '122', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-10-01', '2016-11-01', '0', '0', '2018-11-09 17:08:39');
INSERT INTO `yb-utilities` VALUES ('629', '3', '123', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-11-01', '2016-12-01', '0', '0', '2018-11-09 17:08:39');
INSERT INTO `yb-utilities` VALUES ('630', '4', '124', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-12-01', '2016-01-01', '0', '0', '2018-11-09 17:08:39');
INSERT INTO `yb-utilities` VALUES ('631', '5', '125', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-01-01', '2016-02-01', '0', '0', '2018-11-09 17:08:39');
INSERT INTO `yb-utilities` VALUES ('632', '6', '126', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-02-01', '2016-03-01', '0', '0', '2018-11-09 17:08:39');
INSERT INTO `yb-utilities` VALUES ('633', '7', '127', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-03-01', '2016-04-01', '0', '0', '2018-11-09 17:08:39');
INSERT INTO `yb-utilities` VALUES ('634', '8', '128', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-04-01', '2016-05-01', '0', '0', '2018-11-09 17:08:39');
INSERT INTO `yb-utilities` VALUES ('635', '9', '129', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-05-01', '2016-06-01', '0', '0', '2018-11-09 17:08:39');
INSERT INTO `yb-utilities` VALUES ('636', '10', '130', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-06-01', '2016-07-01', '0', '0', '2018-11-09 17:08:39');
INSERT INTO `yb-utilities` VALUES ('637', '1', '131', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-07-01', '2016-08-01', '0', '0', '2018-11-09 17:08:39');
INSERT INTO `yb-utilities` VALUES ('638', '2', '132', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-08-01', '2016-09-01', '0', '0', '2018-11-09 17:08:39');
INSERT INTO `yb-utilities` VALUES ('639', '3', '133', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-09-01', '2016-10-01', '0', '0', '2018-11-09 17:08:39');
INSERT INTO `yb-utilities` VALUES ('640', '4', '134', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-10-01', '2016-11-01', '0', '0', '2018-11-09 17:08:39');
INSERT INTO `yb-utilities` VALUES ('641', '5', '135', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-11-01', '2016-12-01', '0', '0', '2018-11-09 17:08:40');
INSERT INTO `yb-utilities` VALUES ('642', '6', '136', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-12-01', '2016-01-01', '0', '0', '2018-11-09 17:08:40');
INSERT INTO `yb-utilities` VALUES ('643', '7', '137', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-01-01', '2016-02-01', '0', '0', '2018-11-09 17:08:40');
INSERT INTO `yb-utilities` VALUES ('644', '8', '138', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-02-01', '2016-03-01', '0', '0', '2018-11-09 17:08:40');
INSERT INTO `yb-utilities` VALUES ('645', '9', '139', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-03-01', '2016-04-01', '0', '0', '2018-11-09 17:08:40');
INSERT INTO `yb-utilities` VALUES ('646', '10', '140', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-04-01', '2016-05-01', '0', '0', '2018-11-09 17:08:40');
INSERT INTO `yb-utilities` VALUES ('647', '1', '101', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-01-01', '2016-02-01', '0', '0', '2018-11-09 17:09:44');
INSERT INTO `yb-utilities` VALUES ('648', '2', '102', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-02-01', '2016-03-01', '0', '0', '2018-11-09 17:09:44');
INSERT INTO `yb-utilities` VALUES ('649', '3', '103', '0', '3000', '1000', '2000', '1.25', '2500', '0', '2016-03-01', '2016-04-01', '0', '0', '2018-11-09 17:09:44');
INSERT INTO `yb-utilities` VALUES ('650', '4', '104', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-04-01', '2016-05-01', '0', '0', '2018-11-09 17:09:44');
INSERT INTO `yb-utilities` VALUES ('651', '5', '105', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-05-01', '2016-06-01', '0', '0', '2018-11-09 17:09:44');
INSERT INTO `yb-utilities` VALUES ('652', '6', '106', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-06-01', '2016-07-01', '0', '0', '2018-11-09 17:09:44');
INSERT INTO `yb-utilities` VALUES ('653', '7', '107', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-07-01', '2016-08-01', '0', '0', '2018-11-09 17:09:44');
INSERT INTO `yb-utilities` VALUES ('654', '8', '108', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-08-01', '2016-09-01', '0', '0', '2018-11-09 17:09:45');
INSERT INTO `yb-utilities` VALUES ('655', '9', '109', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-09-01', '2016-10-01', '0', '0', '2018-11-09 17:09:45');
INSERT INTO `yb-utilities` VALUES ('656', '10', '110', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-10-01', '2016-11-01', '0', '0', '2018-11-09 17:09:45');
INSERT INTO `yb-utilities` VALUES ('657', '1', '111', '0', '4000', '1000', '3000', '1.25', '3750', '0', '2016-11-01', '2016-12-01', '0', '0', '2018-11-09 17:09:45');
INSERT INTO `yb-utilities` VALUES ('658', '2', '112', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-12-01', '2016-01-01', '0', '0', '2018-11-09 17:09:45');
INSERT INTO `yb-utilities` VALUES ('659', '3', '113', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-01-01', '2016-02-01', '0', '0', '2018-11-09 17:09:45');
INSERT INTO `yb-utilities` VALUES ('660', '4', '114', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-02-01', '2016-03-01', '0', '0', '2018-11-09 17:09:45');
INSERT INTO `yb-utilities` VALUES ('661', '5', '115', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-03-01', '2016-04-01', '0', '0', '2018-11-09 17:09:45');
INSERT INTO `yb-utilities` VALUES ('662', '6', '116', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-04-01', '2016-05-01', '0', '0', '2018-11-09 17:09:45');
INSERT INTO `yb-utilities` VALUES ('663', '7', '117', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-05-01', '2016-06-01', '0', '0', '2018-11-09 17:09:45');
INSERT INTO `yb-utilities` VALUES ('664', '8', '118', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-06-01', '2016-07-01', '0', '0', '2018-11-09 17:09:45');
INSERT INTO `yb-utilities` VALUES ('665', '9', '119', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-07-01', '2016-08-01', '0', '0', '2018-11-09 17:09:45');
INSERT INTO `yb-utilities` VALUES ('666', '10', '120', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-08-01', '2016-09-01', '0', '0', '2018-11-09 17:09:45');
INSERT INTO `yb-utilities` VALUES ('667', '1', '121', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-09-01', '2016-10-01', '0', '0', '2018-11-09 17:09:45');
INSERT INTO `yb-utilities` VALUES ('668', '2', '122', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-10-01', '2016-11-01', '0', '0', '2018-11-09 17:09:45');
INSERT INTO `yb-utilities` VALUES ('669', '3', '123', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-11-01', '2016-12-01', '0', '0', '2018-11-09 17:09:45');
INSERT INTO `yb-utilities` VALUES ('670', '4', '124', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-12-01', '2016-01-01', '0', '0', '2018-11-09 17:09:45');
INSERT INTO `yb-utilities` VALUES ('671', '5', '125', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-01-01', '2016-02-01', '0', '0', '2018-11-09 17:09:45');
INSERT INTO `yb-utilities` VALUES ('672', '6', '126', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-02-01', '2016-03-01', '0', '0', '2018-11-09 17:09:45');
INSERT INTO `yb-utilities` VALUES ('673', '7', '127', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-03-01', '2016-04-01', '0', '0', '2018-11-09 17:09:45');
INSERT INTO `yb-utilities` VALUES ('674', '8', '128', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-04-01', '2016-05-01', '0', '0', '2018-11-09 17:09:45');
INSERT INTO `yb-utilities` VALUES ('675', '9', '129', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-05-01', '2016-06-01', '0', '0', '2018-11-09 17:09:45');
INSERT INTO `yb-utilities` VALUES ('676', '10', '130', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-06-01', '2016-07-01', '0', '0', '2018-11-09 17:09:45');
INSERT INTO `yb-utilities` VALUES ('677', '1', '131', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-07-01', '2016-08-01', '0', '0', '2018-11-09 17:09:45');
INSERT INTO `yb-utilities` VALUES ('678', '2', '132', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-08-01', '2016-09-01', '0', '0', '2018-11-09 17:09:45');
INSERT INTO `yb-utilities` VALUES ('679', '3', '133', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-09-01', '2016-10-01', '0', '0', '2018-11-09 17:09:45');
INSERT INTO `yb-utilities` VALUES ('680', '4', '134', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-10-01', '2016-11-01', '0', '0', '2018-11-09 17:09:45');
INSERT INTO `yb-utilities` VALUES ('681', '5', '135', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-11-01', '2016-12-01', '0', '0', '2018-11-09 17:09:45');
INSERT INTO `yb-utilities` VALUES ('682', '6', '136', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-12-01', '2016-01-01', '0', '0', '2018-11-09 17:09:45');
INSERT INTO `yb-utilities` VALUES ('683', '7', '137', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-01-01', '2016-02-01', '0', '0', '2018-11-09 17:09:45');
INSERT INTO `yb-utilities` VALUES ('684', '8', '138', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-02-01', '2016-03-01', '0', '0', '2018-11-09 17:09:45');
INSERT INTO `yb-utilities` VALUES ('685', '9', '139', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-03-01', '2016-04-01', '0', '0', '2018-11-09 17:09:45');
INSERT INTO `yb-utilities` VALUES ('686', '10', '140', '0', '2000', '1000', '1000', '1.25', '1250', '0', '2016-04-01', '2016-05-01', '0', '0', '2018-11-09 17:09:45');
INSERT INTO `yb-utilities` VALUES ('695', '9', '109', '1', '2000', '1000', '1000', '1.25', '1250', '0', '2016-09-01', '2016-10-01', '0', '0', '2018-11-10 22:20:51');
INSERT INTO `yb-utilities` VALUES ('696', '10', '110', '1', '2000', '1000', '1000', '1.25', '1250', '0', '2016-10-01', '2016-11-01', '0', '0', '2018-11-10 22:20:51');
INSERT INTO `yb-utilities` VALUES ('697', '1', '111', '1', '4000', '1000', '3000', '1.25', '3750', '0', '2016-11-01', '2016-12-01', '0', '0', '2018-11-10 22:20:51');
INSERT INTO `yb-utilities` VALUES ('698', '2', '112', '1', '2000', '1000', '1000', '1.25', '1250', '0', '2016-12-01', '2016-01-01', '0', '0', '2018-11-10 22:20:51');
INSERT INTO `yb-utilities` VALUES ('699', '3', '113', '1', '2000', '1000', '1000', '1.25', '1250', '0', '2016-01-01', '2016-02-01', '0', '0', '2018-11-10 22:20:51');
INSERT INTO `yb-utilities` VALUES ('700', '4', '114', '1', '2000', '1000', '1000', '1.25', '1250', '0', '2016-02-01', '2016-03-01', '0', '0', '2018-11-10 22:20:51');
INSERT INTO `yb-utilities` VALUES ('701', '5', '115', '1', '2000', '1000', '1000', '1.25', '1250', '0', '2016-03-01', '2016-04-01', '0', '0', '2018-11-10 22:20:51');
INSERT INTO `yb-utilities` VALUES ('702', '6', '116', '1', '2000', '1000', '1000', '1.25', '1250', '0', '2016-04-01', '2016-05-01', '0', '0', '2018-11-10 22:20:51');
INSERT INTO `yb-utilities` VALUES ('703', '7', '117', '1', '2000', '1000', '1000', '1.25', '1250', '0', '2016-05-01', '2016-06-01', '0', '0', '2018-11-10 22:20:51');
INSERT INTO `yb-utilities` VALUES ('704', '8', '118', '1', '2000', '1000', '1000', '1.25', '1250', '0', '2016-06-01', '2016-07-01', '0', '0', '2018-11-10 22:20:51');
INSERT INTO `yb-utilities` VALUES ('705', '9', '119', '1', '2000', '1000', '1000', '1.25', '1250', '0', '2016-07-01', '2016-08-01', '0', '0', '2018-11-10 22:20:51');
INSERT INTO `yb-utilities` VALUES ('706', '10', '120', '1', '2000', '1000', '1000', '1.25', '1250', '0', '2016-08-01', '2016-09-01', '0', '0', '2018-11-10 22:20:51');
INSERT INTO `yb-utilities` VALUES ('707', '1', '121', '1', '2000', '1000', '1000', '1.25', '1250', '0', '2016-09-01', '2016-10-01', '0', '0', '2018-11-10 22:20:51');
INSERT INTO `yb-utilities` VALUES ('708', '2', '122', '1', '2000', '1000', '1000', '1.25', '1250', '0', '2016-10-01', '2016-11-01', '0', '0', '2018-11-10 22:20:51');
INSERT INTO `yb-utilities` VALUES ('709', '3', '123', '1', '2000', '1000', '1000', '1.25', '1250', '0', '2016-11-01', '2016-12-01', '0', '0', '2018-11-10 22:20:51');
INSERT INTO `yb-utilities` VALUES ('710', '4', '124', '1', '2000', '1000', '1000', '1.25', '1250', '0', '2016-12-01', '2016-01-01', '0', '0', '2018-11-10 22:20:51');
INSERT INTO `yb-utilities` VALUES ('711', '5', '125', '1', '2000', '1000', '1000', '1.25', '1250', '0', '2016-01-01', '2016-02-01', '0', '0', '2018-11-10 22:20:51');
INSERT INTO `yb-utilities` VALUES ('712', '6', '126', '1', '2000', '1000', '1000', '1.25', '1250', '0', '2016-02-01', '2016-03-01', '0', '0', '2018-11-10 22:20:51');
INSERT INTO `yb-utilities` VALUES ('713', '7', '127', '1', '2000', '1000', '1000', '1.25', '1250', '0', '2016-03-01', '2016-04-01', '0', '0', '2018-11-10 22:20:51');
INSERT INTO `yb-utilities` VALUES ('714', '8', '128', '1', '2000', '1000', '1000', '1.25', '1250', '0', '2016-04-01', '2016-05-01', '0', '0', '2018-11-10 22:20:51');
INSERT INTO `yb-utilities` VALUES ('715', '9', '129', '1', '2000', '1000', '1000', '1.25', '1250', '0', '2016-05-01', '2016-06-01', '0', '0', '2018-11-10 22:20:51');
INSERT INTO `yb-utilities` VALUES ('716', '10', '130', '1', '2000', '1000', '1000', '1.25', '1250', '0', '2016-06-01', '2016-07-01', '0', '0', '2018-11-10 22:20:51');
INSERT INTO `yb-utilities` VALUES ('717', '1', '131', '1', '2000', '1000', '1000', '1.25', '1250', '0', '2016-07-01', '2016-08-01', '0', '0', '2018-11-10 22:20:51');
INSERT INTO `yb-utilities` VALUES ('718', '2', '132', '1', '2000', '1000', '1000', '1.25', '1250', '0', '2016-08-01', '2016-09-01', '0', '0', '2018-11-10 22:20:51');
INSERT INTO `yb-utilities` VALUES ('719', '3', '133', '1', '2000', '1000', '1000', '1.25', '1250', '0', '2016-09-01', '2016-10-01', '0', '0', '2018-11-10 22:20:51');
INSERT INTO `yb-utilities` VALUES ('720', '4', '134', '1', '2000', '1000', '1000', '1.25', '1250', '0', '2016-10-01', '2016-11-01', '0', '0', '2018-11-10 22:20:51');
INSERT INTO `yb-utilities` VALUES ('721', '5', '135', '1', '2000', '1000', '1000', '1.25', '1250', '0', '2016-11-01', '2016-12-01', '0', '0', '2018-11-10 22:20:51');
INSERT INTO `yb-utilities` VALUES ('722', '6', '136', '1', '2000', '1000', '1000', '1.25', '1250', '0', '2016-12-01', '2016-01-01', '0', '0', '2018-11-10 22:20:51');
INSERT INTO `yb-utilities` VALUES ('723', '7', '137', '1', '2000', '1000', '1000', '1.25', '1250', '0', '2016-01-01', '2016-02-01', '0', '0', '2018-11-10 22:20:51');
INSERT INTO `yb-utilities` VALUES ('724', '8', '138', '1', '2000', '1000', '1000', '1.25', '1250', '0', '2016-02-01', '2016-03-01', '0', '0', '2018-11-10 22:20:51');
INSERT INTO `yb-utilities` VALUES ('725', '9', '139', '1', '2000', '1000', '1000', '1.25', '1250', '0', '2016-03-01', '2016-04-01', '0', '0', '2018-11-10 22:20:51');
INSERT INTO `yb-utilities` VALUES ('726', '10', '140', '1', '2000', '1000', '1000', '1.25', '1250', '0', '2016-04-01', '2016-05-01', '0', '0', '2018-11-10 22:20:51');
INSERT INTO `yb-utilities` VALUES ('730', '4', '104', '1', '2000', '1000', '1000', '1.25', '1250', '0', '2016-04-01', '2016-05-01', '0', '0', '2018-11-11 19:50:58');
INSERT INTO `yb-utilities` VALUES ('731', '5', '105', '1', '2000', '1000', '1000', '1.25', '1250', '0', '2016-05-01', '2016-06-01', '0', '0', '2018-11-11 19:50:58');
INSERT INTO `yb-utilities` VALUES ('732', '6', '106', '1', '2000', '1000', '1000', '1.25', '1250', '0', '2016-06-01', '2016-07-01', '0', '0', '2018-11-11 19:50:58');
INSERT INTO `yb-utilities` VALUES ('733', '7', '107', '1', '2000', '1000', '1000', '1.25', '1250', '0', '2016-07-01', '2016-08-01', '0', '0', '2018-11-11 19:50:58');
INSERT INTO `yb-utilities` VALUES ('734', '8', '108', '1', '2000', '1000', '1000', '1.25', '1250', '0', '2016-08-01', '2016-09-01', '0', '0', '2018-11-11 19:50:58');
INSERT INTO `yb-utilities` VALUES ('735', '9', '109', '1', '2000', '1000', '1000', '1.25', '1250', '0', '2016-09-01', '2016-10-01', '0', '0', '2018-11-11 19:50:58');
INSERT INTO `yb-utilities` VALUES ('736', '10', '110', '1', '2000', '1000', '1000', '1.25', '1250', '0', '2016-10-01', '2016-11-01', '0', '0', '2018-11-11 19:50:58');
INSERT INTO `yb-utilities` VALUES ('737', '1', '111', '1', '4000', '1000', '3000', '1.25', '3750', '0', '2016-11-01', '2016-12-01', '0', '0', '2018-11-11 19:50:58');
INSERT INTO `yb-utilities` VALUES ('738', '2', '112', '1', '2000', '1000', '1000', '1.25', '1250', '0', '2016-12-01', '2016-01-01', '0', '0', '2018-11-11 19:50:58');
INSERT INTO `yb-utilities` VALUES ('739', '3', '113', '1', '2000', '1000', '1000', '1.25', '1250', '0', '2016-01-01', '2016-02-01', '0', '0', '2018-11-11 19:50:58');
INSERT INTO `yb-utilities` VALUES ('740', '4', '114', '1', '2000', '1000', '1000', '1.25', '1250', '0', '2016-02-01', '2016-03-01', '0', '0', '2018-11-11 19:50:58');
INSERT INTO `yb-utilities` VALUES ('741', '5', '115', '1', '2000', '1000', '1000', '1.25', '1250', '0', '2016-03-01', '2016-04-01', '0', '0', '2018-11-11 19:50:58');
INSERT INTO `yb-utilities` VALUES ('742', '6', '116', '1', '2000', '1000', '1000', '1.25', '1250', '0', '2016-04-01', '2016-05-01', '0', '0', '2018-11-11 19:50:58');
INSERT INTO `yb-utilities` VALUES ('743', '7', '117', '1', '2000', '1000', '1000', '1.25', '1250', '0', '2016-05-01', '2016-06-01', '0', '0', '2018-11-11 19:50:58');
INSERT INTO `yb-utilities` VALUES ('744', '8', '118', '1', '2000', '1000', '1000', '1.25', '1250', '0', '2016-06-01', '2016-07-01', '0', '0', '2018-11-11 19:50:58');
INSERT INTO `yb-utilities` VALUES ('745', '9', '119', '1', '2000', '1000', '1000', '1.25', '1250', '0', '2016-07-01', '2016-08-01', '0', '0', '2018-11-11 19:50:58');
INSERT INTO `yb-utilities` VALUES ('746', '10', '120', '1', '2000', '1000', '1000', '1.25', '1250', '0', '2016-08-01', '2016-09-01', '0', '0', '2018-11-11 19:50:58');
INSERT INTO `yb-utilities` VALUES ('747', '1', '121', '1', '2000', '1000', '1000', '1.25', '1250', '0', '2016-09-01', '2016-10-01', '0', '0', '2018-11-11 19:50:58');
INSERT INTO `yb-utilities` VALUES ('748', '2', '122', '1', '2000', '1000', '1000', '1.25', '1250', '0', '2016-10-01', '2016-11-01', '0', '0', '2018-11-11 19:50:58');
INSERT INTO `yb-utilities` VALUES ('749', '3', '123', '1', '2000', '1000', '1000', '1.25', '1250', '0', '2016-11-01', '2016-12-01', '0', '0', '2018-11-11 19:50:58');
INSERT INTO `yb-utilities` VALUES ('750', '4', '124', '1', '2000', '1000', '1000', '1.25', '1250', '0', '2016-12-01', '2016-01-01', '0', '0', '2018-11-11 19:50:58');
INSERT INTO `yb-utilities` VALUES ('751', '5', '125', '1', '2000', '1000', '1000', '1.25', '1250', '0', '2016-01-01', '2016-02-01', '0', '0', '2018-11-11 19:50:58');
INSERT INTO `yb-utilities` VALUES ('752', '6', '126', '1', '2000', '1000', '1000', '1.25', '1250', '0', '2016-02-01', '2016-03-01', '0', '0', '2018-11-11 19:50:58');
INSERT INTO `yb-utilities` VALUES ('753', '7', '127', '1', '2000', '1000', '1000', '1.25', '1250', '0', '2016-03-01', '2016-04-01', '0', '0', '2018-11-11 19:50:58');
INSERT INTO `yb-utilities` VALUES ('754', '8', '128', '1', '2000', '1000', '1000', '1.25', '1250', '0', '2016-04-01', '2016-05-01', '0', '0', '2018-11-11 19:50:58');
INSERT INTO `yb-utilities` VALUES ('755', '9', '129', '1', '2000', '1000', '1000', '1.25', '1250', '0', '2016-05-01', '2016-06-01', '0', '0', '2018-11-11 19:50:58');
INSERT INTO `yb-utilities` VALUES ('756', '10', '130', '1', '2000', '1000', '1000', '1.25', '1250', '0', '2016-06-01', '2016-07-01', '0', '0', '2018-11-11 19:50:58');
INSERT INTO `yb-utilities` VALUES ('757', '1', '131', '1', '2000', '1000', '1000', '1.25', '1250', '0', '2016-07-01', '2016-08-01', '0', '0', '2018-11-11 19:50:58');
INSERT INTO `yb-utilities` VALUES ('758', '2', '132', '1', '2000', '1000', '1000', '1.25', '1250', '0', '2016-08-01', '2016-09-01', '0', '0', '2018-11-11 19:50:58');
INSERT INTO `yb-utilities` VALUES ('759', '3', '133', '1', '2000', '1000', '1000', '1.25', '1250', '0', '2016-09-01', '2016-10-01', '0', '0', '2018-11-11 19:50:58');
INSERT INTO `yb-utilities` VALUES ('760', '4', '134', '1', '2000', '1000', '1000', '1.25', '1250', '0', '2016-10-01', '2016-11-01', '0', '0', '2018-11-11 19:50:58');
INSERT INTO `yb-utilities` VALUES ('761', '5', '135', '1', '2000', '1000', '1000', '1.25', '1250', '0', '2016-11-01', '2016-12-01', '0', '0', '2018-11-11 19:50:58');
INSERT INTO `yb-utilities` VALUES ('762', '6', '136', '1', '2000', '1000', '1000', '1.25', '1250', '0', '2016-12-01', '2016-01-01', '0', '0', '2018-11-11 19:50:58');
INSERT INTO `yb-utilities` VALUES ('763', '7', '137', '1', '2000', '1000', '1000', '1.25', '1250', '0', '2016-01-01', '2016-02-01', '0', '0', '2018-11-11 19:50:58');
INSERT INTO `yb-utilities` VALUES ('764', '8', '138', '1', '2000', '1000', '1000', '1.25', '1250', '0', '2016-02-01', '2016-03-01', '0', '0', '2018-11-11 19:50:58');
INSERT INTO `yb-utilities` VALUES ('765', '9', '139', '1', '2000', '1000', '1000', '1.25', '1250', '0', '2016-03-01', '2016-04-01', '0', '0', '2018-11-11 19:50:58');
INSERT INTO `yb-utilities` VALUES ('766', '10', '140', '1', '2000', '1000', '1000', '1.25', '1250', '0', '2016-04-01', '2016-05-01', '0', '0', '2018-11-11 19:50:59');

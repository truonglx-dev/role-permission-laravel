/*
Navicat MySQL Data Transfer

Source Server         : localhostest
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : acltest

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2018-12-27 18:17:26
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES ('1', '2014_10_12_000000_create_users_table', '1');
INSERT INTO `migrations` VALUES ('2', '2014_10_12_100000_create_password_resets_table', '1');
INSERT INTO `migrations` VALUES ('3', '2018_12_19_153033_create_roles_table', '2');
INSERT INTO `migrations` VALUES ('4', '2018_12_19_153105_create_permissions_table', '2');

-- ----------------------------
-- Table structure for password_resets
-- ----------------------------
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of password_resets
-- ----------------------------

-- ----------------------------
-- Table structure for permissions
-- ----------------------------
DROP TABLE IF EXISTS `permissions`;
CREATE TABLE `permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of permissions
-- ----------------------------
INSERT INTO `permissions` VALUES ('1', 'user-list', 'Danh sách user', null, null);
INSERT INTO `permissions` VALUES ('2', 'user-add', 'Them user', null, null);
INSERT INTO `permissions` VALUES ('3', 'user-edit', 'Sua user', null, null);
INSERT INTO `permissions` VALUES ('4', 'user-delete', 'Xoa user', null, null);
INSERT INTO `permissions` VALUES ('5', 'role-list', 'Danh sach role', null, null);
INSERT INTO `permissions` VALUES ('6', 'role-add', 'Them role', null, null);
INSERT INTO `permissions` VALUES ('7', 'role-edit', 'Sua role', null, null);
INSERT INTO `permissions` VALUES ('8', 'role-delete', 'Xoa role', null, null);

-- ----------------------------
-- Table structure for roles
-- ----------------------------
DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of roles
-- ----------------------------
INSERT INTO `roles` VALUES ('7', 'admin', 'Quản lí', '2018-12-21 09:39:27', '2018-12-22 07:24:08');
INSERT INTO `roles` VALUES ('8', 'content', 'Soạn nội dung', '2018-12-21 09:39:56', '2018-12-21 09:39:56');
INSERT INTO `roles` VALUES ('9', 'writer', 'Writer', '2018-12-21 09:40:21', '2018-12-21 09:40:21');

-- ----------------------------
-- Table structure for permission_role
-- ----------------------------
DROP TABLE IF EXISTS `permission_role`;
CREATE TABLE `permission_role` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of permission_role
-- ----------------------------
INSERT INTO `permission_role` VALUES ('27', '8', '1', null, null);
INSERT INTO `permission_role` VALUES ('28', '9', '1', null, null);
INSERT INTO `permission_role` VALUES ('29', '9', '2', null, null);
INSERT INTO `permission_role` VALUES ('30', '9', '3', null, null);
INSERT INTO `permission_role` VALUES ('31', '9', '4', null, null);
INSERT INTO `permission_role` VALUES ('47', '7', '2', null, null);
INSERT INTO `permission_role` VALUES ('48', '7', '3', null, null);
INSERT INTO `permission_role` VALUES ('49', '7', '4', null, null);
INSERT INTO `permission_role` VALUES ('50', '7', '5', null, null);
INSERT INTO `permission_role` VALUES ('51', '7', '6', null, null);
INSERT INTO `permission_role` VALUES ('52', '7', '7', null, null);
INSERT INTO `permission_role` VALUES ('53', '7', '8', null, null);

-- ----------------------------
-- Table structure for role_user
-- ----------------------------
DROP TABLE IF EXISTS `role_user`;
CREATE TABLE `role_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of role_user
-- ----------------------------
INSERT INTO `role_user` VALUES ('10', '1', '7', null, null);
INSERT INTO `role_user` VALUES ('11', '7', '8', null, null);
INSERT INTO `role_user` VALUES ('12', '7', '9', null, null);

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('1', 'admin', 'adminweb@gmail.com', '$2y$10$9eHWJ97sGRYh0JMBU/HZGuCuaHSDGW2IMpr36Bb3m4JJA6Jg0d1U.', 'gmway5IEQybm5x1OtQQqk2cpB07u8EAjue6tU2NRouPqV34iaOSTGBWJBetj', '2018-12-19 15:29:07', '2018-12-21 09:40:48');
INSERT INTO `users` VALUES ('7', 'normal user', 'normal@gmail.com', '$2y$10$2Jaic6e929UzRJ7XgJn0Se3C9LTMrK4SopzOtns0wWIfvLY5edsT2', '0fblgE23LVQjpyPAu0brU1M9nHWP0AdnuSJuWbv7egGBvOufxaHYZe9GpG2c', '2018-12-21 09:41:37', '2018-12-21 09:41:37');

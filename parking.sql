/*
 Navicat Premium Data Transfer

 Source Server         : local
 Source Server Type    : MySQL
 Source Server Version : 100413
 Source Host           : localhost:3306
 Source Schema         : parking

 Target Server Type    : MySQL
 Target Server Version : 100413
 File Encoding         : 65001

 Date: 25/02/2021 22:45:08
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for failed_jobs
-- ----------------------------
DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp(0) NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `failed_jobs_uuid_unique`(`uuid`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES (1, '2014_10_12_000000_create_users_table', 1);
INSERT INTO `migrations` VALUES (2, '2014_10_12_100000_create_password_resets_table', 1);
INSERT INTO `migrations` VALUES (3, '2019_08_19_000000_create_failed_jobs_table', 1);
INSERT INTO `migrations` VALUES (4, '2021_02_23_115630_rate', 2);
INSERT INTO `migrations` VALUES (5, '2021_02_24_104133_parking', 3);

-- ----------------------------
-- Table structure for parking
-- ----------------------------
DROP TABLE IF EXISTS `parking`;
CREATE TABLE `parking`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `vehicle_no` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `parking_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `time_in` datetime(0) NOT NULL,
  `time_out` datetime(0) NULL DEFAULT NULL,
  `created_by` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `rate` bigint(20) NULL DEFAULT NULL,
  `duration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `cost` bigint(10) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 38 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of parking
-- ----------------------------
INSERT INTO `parking` VALUES (1, 'BB 2333 RRR', '2333RRR106', '2021-02-23 12:00:07', '2021-02-25 02:52:07', 'user', 3000, '1 Day, 14 Hours 52 Minutes 0 Seconds', 117000);
INSERT INTO `parking` VALUES (2, 'B 4804 SAS', '4804SAS214', '2021-02-24 12:01:28', '2021-02-25 02:53:15', 'user', 3000, '0 Day, 14 Hours 51 Minutes 47 Seconds', 45000);
INSERT INTO `parking` VALUES (4, 'B 4663 TMT', '4663TMT358', '2021-02-24 12:03:21', '2021-02-25 02:57:50', 'user', 3000, '0 Day, 14 Hours 54 Minutes 29 Seconds', 45000);
INSERT INTO `parking` VALUES (5, 'BK 4432 FSD', '4432FSD889', '2021-02-24 12:08:32', '2021-02-25 04:27:38', 'user', 3000, '0 Day, 16 Hours 19 Minutes 6 Seconds', 51000);
INSERT INTO `parking` VALUES (6, 'DK 4234 SDF', '4234SDF921', '2021-02-24 12:15:45', '2021-02-25 02:55:19', 'user', 3000, '0 Day, 14 Hours 39 Minutes 34 Seconds', 45000);
INSERT INTO `parking` VALUES (8, 'DK 2332 DSF', '2332DSF188', '2021-02-24 14:39:54', '2021-02-25 02:56:34', 'user', 3000, '0 Day, 12 Hours 16 Minutes 40 Seconds', 39000);
INSERT INTO `parking` VALUES (16, 'KT 3243 DFD', '3243DFD297', '2021-02-24 14:42:34', NULL, 'user', 3000, NULL, NULL);
INSERT INTO `parking` VALUES (17, 'B 6868 DSF', '6868DSF143', '2021-02-24 14:51:29', '2021-02-25 02:57:35', 'user', 3000, '0 Day, 12 Hours 6 Minutes 6 Seconds', 39000);
INSERT INTO `parking` VALUES (19, 'Z 3245 VVX', '3245VVX523', '2021-02-24 15:09:15', NULL, 'user', 3000, NULL, NULL);
INSERT INTO `parking` VALUES (20, 'AS 4234 TYT', '4234TYT121', '2021-02-24 15:16:34', '2021-02-25 09:44:22', 'user', 3000, '0 Day, 18 Hours 27 Minutes 48 Seconds', 57000);
INSERT INTO `parking` VALUES (22, 'Z 7832 KLM', '7832KLM282', '2021-02-24 16:25:15', NULL, 'user', 3000, NULL, NULL);
INSERT INTO `parking` VALUES (23, 'BK 4325 PLP', '4325PLP207', '2021-02-24 16:55:27', NULL, 'user', 3000, NULL, NULL);
INSERT INTO `parking` VALUES (24, 'BB 2434 DDA', '2434DDA387', '2021-02-24 16:55:58', '2021-02-25 04:30:48', 'user', 3000, '0 Day, 11 Hours 34 Minutes 50 Seconds', 36000);
INSERT INTO `parking` VALUES (25, 'KT 3421 SDF', '3421SDF139', '2021-02-24 16:56:08', '2021-02-25 02:53:30', 'user', 3000, '0 Day, 9 Hours 57 Minutes 22 Seconds', 30000);
INSERT INTO `parking` VALUES (26, 'DK 7789 E', '7789E45651', '2021-02-25 05:49:19', NULL, 'user', 3000, NULL, NULL);
INSERT INTO `parking` VALUES (27, 'DK 7781 E', '7781E20009', '2021-02-25 05:54:24', '2021-02-25 05:54:50', 'user', 3000, '0 Day, 0 Hours 0 Minutes 26 Seconds', 0);
INSERT INTO `parking` VALUES (28, 'DK 7781 E', '7781E13964', '2021-02-25 05:55:27', '2021-02-25 08:19:34', 'user', 3000, '0 Day, 2 Hours 24 Minutes 7 Seconds', 9000);
INSERT INTO `parking` VALUES (29, 'Z 7786 E', '7786E16346', '2021-02-25 06:33:23', '2021-02-25 06:37:07', 'user', 4000, '0 Day, 0 Hours 3 Minutes 44 Seconds', 4000);
INSERT INTO `parking` VALUES (30, 'B 3480 Y', '3480Y11028', '2021-02-25 09:50:26', NULL, 'user', 3500, NULL, NULL);
INSERT INTO `parking` VALUES (31, 'B 343 RWE', '343RWE1730', '2021-02-25 09:52:18', NULL, 'user', 3500, NULL, NULL);
INSERT INTO `parking` VALUES (32, 'B 1 SA', '1SA6975761', '2021-02-25 09:52:28', NULL, 'user', 3500, NULL, NULL);
INSERT INTO `parking` VALUES (33, 'B 3423 SDF', '3423SDF504', '2021-02-25 09:52:41', NULL, 'user', 3500, NULL, NULL);
INSERT INTO `parking` VALUES (34, 'B 453 F', '453F941471', '2021-02-25 09:52:48', NULL, 'user', 3500, NULL, NULL);
INSERT INTO `parking` VALUES (35, 'R 4534 SDF', '4534SDF127', '2021-02-25 09:52:54', NULL, 'user', 3500, NULL, NULL);
INSERT INTO `parking` VALUES (36, 'Z 4534 FGH', '4534FGH718', '2021-02-25 09:53:00', '2021-02-25 13:08:10', 'user', 3500, '0 Day, 3 Hours 15 Minutes 10 Seconds', 14000);
INSERT INTO `parking` VALUES (37, 'B 4804 SAS', '4804SAS275', '2021-02-25 09:58:01', '2021-02-25 09:58:53', 'user', 3500, '0 Day, 0 Hours 0 Minutes 52 Seconds', 0);

-- ----------------------------
-- Table structure for password_resets
-- ----------------------------
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets`  (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  INDEX `password_resets_email_index`(`email`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for rates
-- ----------------------------
DROP TABLE IF EXISTS `rates`;
CREATE TABLE `rates`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `rate` double(8, 2) NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of rates
-- ----------------------------
INSERT INTO `rates` VALUES (1, 3500.00, '2021-02-25 09:50:10', '2021-02-25 09:50:10');

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp(0) NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `users_email_unique`(`email`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (1, 'admin', 'admin@mail.com', NULL, '$2y$10$qcpI5Q0JdPIhm9Rlj3jho.zli4lnFt7.QcMOfPZp3iJ7VA.8TEtgm', 'admin', 'u8AQHjeQP6BkinocBghelD0Jy4D8SeHDIwUyejmyf1b17eI8kDJjszJ4sCEf', '2021-02-23 11:07:26', '2021-02-23 11:07:26');
INSERT INTO `users` VALUES (2, 'user', 'user@mail.com', NULL, '$2y$10$1tlt8gktKxd/.3m0vQwzUeJTGgrG9orlcEV/L8ee9YCYBEqub1SOW', 'user', NULL, '2021-02-23 11:08:59', '2021-02-23 11:08:59');

SET FOREIGN_KEY_CHECKS = 1;

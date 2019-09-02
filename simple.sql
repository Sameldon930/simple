-- --------------------------------------------------------
-- 主机:                           127.0.0.1
-- Server version:               5.7.24 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL 版本:                  9.5.0.5332
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for simple
CREATE DATABASE IF NOT EXISTS `simple` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `simple`;

-- Dumping structure for table simple.comments
CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL DEFAULT '0' COMMENT '用户id',
  `post_id` int(11) NOT NULL DEFAULT '0' COMMENT '文章id',
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '评论内容',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='评论表';

-- Dumping data for table simple.comments: ~0 rows (approximately)
DELETE FROM `comments`;
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
INSERT INTO `comments` (`id`, `user_id`, `post_id`, `content`, `created_at`, `updated_at`) VALUES
	(1, 2, 25, '231231231', '2019-08-29 09:02:33', '2019-08-29 09:02:33'),
	(2, 1, 25, 'hhahahh', '2019-08-30 01:52:03', '2019-08-30 01:52:03');
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;

-- Dumping structure for table simple.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table simple.migrations: ~3 rows (approximately)
DELETE FROM `migrations`;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2019_08_27_021123_create_posts_table', 1),
	(2, '2019_08_28_092247_create_users_table', 2),
	(3, '2019_08_29_030139_create_comments_table', 3),
	(4, '2019_08_30_015349_create_zans_table', 4);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

-- Dumping structure for table simple.posts
CREATE TABLE IF NOT EXISTS `posts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '文章标题',
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '文章内容',
  `user_id` int(11) NOT NULL DEFAULT '0' COMMENT '发布文章的用户',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table simple.posts: ~2 rows (approximately)
DELETE FROM `posts`;
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;
INSERT INTO `posts` (`id`, `title`, `content`, `user_id`, `created_at`, `updated_at`) VALUES
	(24, '313224234', '<p><img src="http://localhost/storage/b6da6ec84a1a70d1ae23b965ca25ba9e/7erPlWuEDD1R9mG5SZKUjZcU16mjYL71ZYfJafaq.png" alt="聊天记录4" style="max-width:100%;"><br></p><p><br></p>', 1, '2019-08-29 02:02:31', '2019-08-29 02:02:31'),
	(25, '社会信用体系建设数据采集标准', '<p><img src="http://localhost/storage/1e566411cdc6767742ecb60768d5889c/AGFl1u5P4cHzUVmaROfea9dH7XZ9MmprsAKJrkRi.png" alt="聊天记录4" style="max-width:100%;"><br></p><p><br></p>', 1, '2019-08-29 02:03:09', '2019-08-29 02:03:09');
/*!40000 ALTER TABLE `posts` ENABLE KEYS */;

-- Dumping structure for table simple.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table simple.users: ~2 rows (approximately)
DELETE FROM `users`;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'zhangzeshan', '1071119121@qq.com', '$2y$10$/otVghyS0ht06TMvVtOJduY5XEPv.QEYOEEqGv4E.BvG54Ybej9.i', 'M3YZpwCGT17Vh8QcGghxKvB6vgwlAoY08auduqfPhpQ8bWyNOfjyZfhQdHQ6', '2019-08-28 09:37:51', '2019-08-28 09:37:51'),
	(2, 'test2222', '1071119121@zzs.com', '$2y$10$If96IUVO1AWpNZ4ryy/KGeADWZjECVXBI24SLHMsr0Y8aVEbO.0/K', 'H4Hp7gpujTWTaDnqZIhTZ6SCWIlaWRKCrAy5iC1KJ9vbHbpufKkUpdRsZr1U', '2019-08-29 02:46:46', '2019-08-29 02:46:46');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

-- Dumping structure for table simple.zans
CREATE TABLE IF NOT EXISTS `zans` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL DEFAULT '0' COMMENT '用户id',
  `post_id` int(11) NOT NULL DEFAULT '0' COMMENT '文章id',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table simple.zans: ~0 rows (approximately)
DELETE FROM `zans`;
/*!40000 ALTER TABLE `zans` DISABLE KEYS */;
/*!40000 ALTER TABLE `zans` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;

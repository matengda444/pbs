SET NAMES utf8;

CREATE DATABASE pbs;

USE pbs;

CREATE TABLE `user` (
  `id` INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `username` VARCHAR(16) NOT NULL,
  `nickname` VARCHAR(16) NOT NULL,
  `email` VARCHAR(64) NOT NULL,
  `last_login_time` INT UNSIGNED NOT NULL DEFAULT 0,
  `last_login_ip` VARCHAR(15) NOT NULL DEFAULT ''
)ENGINE=innodb DEFAULT CHARSET utf8;

ALTER TABLE `user` ADD COLUMN password VARCHAR(64) NOT NULL AFTER username;

UPDATE user SET password = md5(md5('root')) WHERE 1 = 1;

CREATE TABLE `category` (
    `id` INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `name` VARCHAR(20) NOT NULL,
    `alias` VARCHAR(10) NOT NULL DEFAULT '',
    `sort` INT UNSIGNED NULL NULL DEFAULT 0,
    `parent_id` INT UNSIGNED NOT NULL DEFAULT 0
)ENGINE=innodb DEFAULT CHARSET utf8;

INSERT INTO `category` VALUES
(NULL, '科技', '', 50, 0),
(NULL, '武侠', '', 50, 0),
(NULL, 'IT', '', 50, 1),
(NULL, '生物', '', 50, 1),
(NULL, '鸟类', '', 50, 6),
(NULL, '川菜', '', 50, 4),
(NULL, '粤菜', '', 50, 4);

CREATE TABLE IF NOT EXISTS `article` (
    `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
    `name` varchar(100) NOT NULL,
    `content` text,
    `category_id` int(11) DEFAULT NULL,
    `status` tinyint(4) NOT NULL DEFAULT '2',
    `publish_date` int(11) NOT NULL,
    `is_top` tinyint(4) NOT NULL DEFAULT '2',
    PRIMARY KEY (`id`)
) ENGINE = innodb AUTO_INCREMENT=510 DEFAULT CHARSET = utf8;
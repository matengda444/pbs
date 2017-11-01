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
(NULL, '科技', '', 0, 50),
(NULL, '武侠', '', 0, 50),
(NULL, 'IT', '', 1, 50),
(NULL, '生物', '', 1, 50),
(NULL, '鸟类', '', 6, 50),
(NULL, '川菜', '', 4, 50),
(NULL, '粤菜', '', 4, 50)
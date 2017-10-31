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
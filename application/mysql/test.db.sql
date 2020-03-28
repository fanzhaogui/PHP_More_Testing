CREATE TABLE `user1` (
 `id` BIGINT(11) unsigned NOT NULL,
 `user_name` VARCHAR(45) NOT NULL,
 `password` VARCHAR(45) NOT NULL,
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_name` (`user_name`),
  KEY `create_time` (`create_time`)
)ENGINE = MyISAM;
CREATE TABLE `user2` like user1;
CREATE TABLE `user3` like user1;

CREATE TABLE `users` (
 `id` BIGINT(11) unsigned NOT NULL,
 `user_name` VARCHAR(45) NOT NULL,
 `password` VARCHAR(45) NOT NULL,
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_name` (`user_name`),
  KEY `create_time` (`create_time`)
)ENGINE = MERGE UNION = (`user1`,`user2`,`user3`);

-- or
-- CREATE TABLE users like user1;
-- ALTER TABLE users ENGINE=MERGE UNION(`user1`,`user2`,`user3`) insert_method=no;

-- 产生ID值
CREATE TABLE `user_ids` (
 `id` BIGINT(11) unsigned NOT NULL AUTO_INCREMENT,
 PRIMARY KEY (`id`)
)ENGINE = MyISAM;
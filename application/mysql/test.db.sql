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


-- try2 need sql
CREATE TABLE `copylog01` (
  `id` bigint(10) unsigned NOT NULL AUTO_INCREMENT,
  `company_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '公司ID',
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '当前url',
  `search_word` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '搜索词',
  `copy_content` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '复制内容',
  `copy_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '复制类型？',
  `source_engine` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '来源搜索引擎',
  `source_ip` varchar(44) CHARACTER SET utf8mb4 NOT NULL DEFAULT '' COMMENT '来源ip',
  `source_area` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '来源地域',
  `sys` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '操作系统',
  `browser` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '浏览器类型',
  `source_url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '来源url',
  `tourists` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '游客身份标识',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `company_id` (`company_id`) USING BTREE
) ENGINE=InnoDB CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC COMMENT='复制记录';

CREATE TABLE `copylog02` like `copylog01`;
CREATE TABLE `copylog03` like `copylog01`;
CREATE TABLE `copylog04` like `copylog01`;
CREATE TABLE `copylog05` like `copylog01`;

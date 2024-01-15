SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `comment`;
CREATE TABLE `comment` (
                           `id` int(11) NOT NULL AUTO_INCREMENT,
                           `text` text NOT NULL,
                           `user` varchar(300) NOT NULL,
                           `idea` int(11) NOT NULL,
                           PRIMARY KEY (`id`),
                           KEY `idea` (`idea`),
                           KEY `user` (`user`),
                           CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`idea`) REFERENCES `ideas` (`id`),
                           CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`user`) REFERENCES `users` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


DROP TABLE IF EXISTS `favorite`;
CREATE TABLE `favorite` (
                            `name` varchar(300) NOT NULL,
                            `idea` int(11) NOT NULL,
                            `id` int(11) NOT NULL AUTO_INCREMENT,
                            PRIMARY KEY (`id`),
                            KEY `name` (`name`),
                            CONSTRAINT `favorite_ibfk_1` FOREIGN KEY (`name`) REFERENCES `users` (`name`),
                            CONSTRAINT `favorite_ibfk_2` FOREIGN KEY (`idea`) REFERENCES `ideas` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


DROP TABLE IF EXISTS `ideas`;
CREATE TABLE `ideas` (
                         `user` varchar(300) NOT NULL,
                         `title` varchar(30) NOT NULL,
                         `type` int(11) NOT NULL,
                         `date` text NOT NULL DEFAULT '0000-00-00 00:00:00',
                         `id` int(11) NOT NULL AUTO_INCREMENT,
                         `text` text DEFAULT NULL,
                         `picture` varchar(300) NOT NULL,
                         PRIMARY KEY (`id`),
                         KEY `user` (`user`),
                         KEY `type` (`type`),
                         CONSTRAINT `ideas_ibfk_1` FOREIGN KEY (`user`) REFERENCES `users` (`name`),
                         CONSTRAINT `ideas_ibfk_2` FOREIGN KEY (`type`) REFERENCES `theme` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


DROP TABLE IF EXISTS `theme`;
CREATE TABLE `theme` (
                         `id` int(11) NOT NULL AUTO_INCREMENT,
                         `text` varchar(30) NOT NULL,
                         PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
                         `id` int(11) NOT NULL AUTO_INCREMENT,
                         `name` varchar(300) NOT NULL,
                         `password` text NOT NULL,
                         `rola` char(1) NOT NULL,
                         PRIMARY KEY (`id`),
                         UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `users` (`id`, `name`, `password`, `rola`) VALUES
                                                           (1,	'admin',	'$2y$10$GRA8D27bvZZw8b85CAwRee9NH5nj4CQA6PDFMc90pN9Wi4VAWq3yq',	'a');


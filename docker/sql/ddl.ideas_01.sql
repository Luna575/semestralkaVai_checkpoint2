SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `comments`;
CREATE TABLE `comments` (
                            `date` text NOT NULL DEFAULT '0000-00-00 00:00:00',
                            `id` int(11) NOT NULL AUTO_INCREMENT,
                            `text` text NOT NULL,
                            `user` varchar(300) NOT NULL,
                            `idea` int(11) NOT NULL,
                            PRIMARY KEY (`id`),
                            KEY `idea` (`idea`),
                            KEY `user` (`user`),
                            CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`idea`) REFERENCES `ideas` (`id`),
                            CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`user`) REFERENCES `users` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `comments` (`date`, `id`, `text`, `user`, `idea`) VALUES
                                                                  ('2024-01-18 06:01:04',	1,	'nice',	'admin',	2),
                                                                  ('2024-01-18 07:01:50',	3,	'He looks sooooo happy!!!',	'admin',	2);

DROP TABLE IF EXISTS `favorites`;
CREATE TABLE `favorites` (
                             `name` varchar(300) NOT NULL,
                             `idea` int(11) NOT NULL,
                             `id` int(11) NOT NULL AUTO_INCREMENT,
                             PRIMARY KEY (`id`),
                             KEY `name` (`name`),
                             KEY `favorite_ibfk_2` (`idea`),
                             CONSTRAINT `favorites_ibfk_1` FOREIGN KEY (`name`) REFERENCES `users` (`name`),
                             CONSTRAINT `favorites_ibfk_2` FOREIGN KEY (`idea`) REFERENCES `ideas` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `favorites` (`name`, `idea`, `id`) VALUES
                                                   ('luna',	1,	1),
                                                   ('luna',	6,	18),
                                                   ('luna',	3,	20),
                                                   ('luna',	7,	24);

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
                         CONSTRAINT `ideas_ibfk_2` FOREIGN KEY (`type`) REFERENCES `themes` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `ideas` (`user`, `title`, `type`, `date`, `id`, `text`, `picture`) VALUES
                                                                                   ('luna',	'šteniatka',	3,	'2024-01-16 08:01:59',	1,	'',	'144820192683248-images (6).jpg'),
                                                                                   ('admin',	'happy',	3,	'2024-01-16 04:01:55',	2,	'happy',	'137111335939732-stiahnuť.jpg'),
                                                                                   ('luna',	'Pupy',	3,	'2024-01-16 08:01:05',	3,	'pupy is the best',	'144702771055046-1511194376-cavachon-puppy-christmas.jpg'),
                                                                                   ('luna',	'auu',	3,	'2024-01-19 08:01:03',	5,	'auu',	'313255195728559-images (7).jpg'),
                                                                                   ('luna',	'So sweet',	3,	'2024-01-20 01:01:45',	6,	'aHEFILUHui&ggbjbbvb,jgcug&iuguwgvuhichy&kjncknknjv bjyb&k bsb &b&j cbcmb jb ckbkab:BCkBKCB:BScBJAKBC:KJBSJBCjk:BCXkjbJ*NA*VKJAdvakjab*KJB JKBKA*B:KBBjd*:DJvdj:BJbKB:KJAb .kvjdabk.bvdjkb.kBAJBdjk&bvkdj..bvjA:B:DJBAJKBSABCk.K',	'347859971421317-images (8).jpg'),
                                                                                   ('luna',	'EXPERIMENT',	2,	'2024-01-20 02:01:01',	7,	'KFOib*\"bfob*oeIFBOôIWNFIO.VBEOWDVJB KJBS& JS.BWDB VKBKJEFVJB KJ&B. KJWBVKBKJWEBVWI.BUOWEBôOIDEVôBôOUbogvubOJNB',	'348014287468374-Screen_Shot_2015-02-20_at_17.28.30.png'),
                                                                                   ('luna',	'Give others',	2,	'2024-01-20 02:01:08',	9,	'',	'351843206803132-giving_offering_dana_give_offering_requisite_charity_aid_gift-1367013-1.jpg');

DROP TABLE IF EXISTS `themes`;
CREATE TABLE `themes` (
                          `icon` varchar(30) NOT NULL,
                          `id` int(11) NOT NULL AUTO_INCREMENT,
                          `text` varchar(30) NOT NULL,
                          PRIMARY KEY (`id`),
                          UNIQUE KEY `text` (`text`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `themes` (`icon`, `id`, `text`) VALUES
                                                ('bi bi-pencil',	1,	'Drawings'),
                                                ('bi bi-backpack2',	2,	'Activity'),
                                                ('bi bi-file-image\"',	3,	'Pictures');

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
                                                           (1,	'admin',	'$2y$10$GRA8D27bvZZw8b85CAwRee9NH5nj4CQA6PDFMc90pN9Wi4VAWq3yq',	'a'),
                                                           (3,	'luna',	'$2y$10$MGM4BSBivX8bTtCofAsWjOzWephJfQ0UtlgHY1kMiYo5FT2bcv/Le',	'p');

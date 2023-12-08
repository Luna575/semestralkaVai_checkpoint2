SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `ideas`;
CREATE TABLE `ideas` (
                         `theme` text NOT NULL,
                         `type` char(1) NOT NULL,
                         `date` text NOT NULL DEFAULT '0000-00-00 00:00:00',
                         `id` int(11) NOT NULL AUTO_INCREMENT,
                         `text` text DEFAULT NULL,
                         `picture` varchar(300) NOT NULL,
                         PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `ideas` (`theme`, `type`, `date`, `id`, `text`, `picture`) VALUES
    ('',	'',	'0000-00-00 00:00:00',	1,	'This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.',	'https://static.vecteezy.com/system/resources/thumbnails/025/181/412/small/picture-a-captivating-scene-of-a-tranquil-lake-at-sunset-ai-generative-photo.jpg');

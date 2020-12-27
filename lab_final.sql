-- Adminer 4.7.8 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `buses`;
CREATE TABLE `buses` (
  `id` int NOT NULL AUTO_INCREMENT,
  `driver_name` varchar(45) NOT NULL COMMENT 'ФИО водителя',
  `plate_num` varchar(255) NOT NULL COMMENT 'Государственный номер автобуса',
  `seats_amount` int NOT NULL COMMENT 'Количество мест всего',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `buses` (`id`, `driver_name`, `plate_num`, `seats_amount`) VALUES
(1,	'Иванов И.И.',	'З180НО',	20);

DROP TABLE IF EXISTS `migration`;
CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base',	1609077092),
('m201226_003002_create_stations_table',	1609077097),
('m201226_003005_create_routes_table',	1609077098),
('m201227_095601_create_buses_table',	1609077098),
('m201227_095648_create_trips_table',	1609077099),
('m201227_095657_create_users_table',	1609077203),
('m201227_095712_create_tickets_table',	1609077204);

DROP TABLE IF EXISTS `routes`;
CREATE TABLE `routes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `departureId` int NOT NULL COMMENT 'ID пункта отправления',
  `destinationId` int NOT NULL COMMENT 'ID пункта прибытия',
  `name` varchar(65) NOT NULL COMMENT 'Название маршрута',
  `price` decimal(5,2) NOT NULL COMMENT 'Стоимость маршрута',
  `createdAt` datetime NOT NULL COMMENT 'Дата создания',
  `updatedAt` datetime DEFAULT NULL COMMENT 'Дата изменения',
  PRIMARY KEY (`id`),
  KEY `fk_departureId` (`departureId`),
  KEY `fk_destinationId` (`destinationId`),
  CONSTRAINT `fk_departureId` FOREIGN KEY (`departureId`) REFERENCES `stations` (`id`),
  CONSTRAINT `fk_destinationId` FOREIGN KEY (`destinationId`) REFERENCES `stations` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `routes` (`id`, `departureId`, `destinationId`, `name`, `price`, `createdAt`, `updatedAt`) VALUES
(1,	4,	1,	'Губкин - Воронеж',	323.00,	'2020-12-27 15:08:16',	'2020-12-27 15:08:16'),
(2,	4,	2,	'Губкин - Курск',	398.00,	'2020-12-27 15:08:35',	'2020-12-27 15:08:35'),
(3,	4,	3,	'Губкин - Белгород',	290.00,	'2020-12-27 15:08:55',	'2020-12-27 15:08:55');

DROP TABLE IF EXISTS `stations`;
CREATE TABLE `stations` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL COMMENT 'Название населенного пункта',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `stations` (`id`, `name`) VALUES
(1,	'Воронеж'),
(2,	'Курск'),
(3,	'Белгород'),
(4,	'Губкин');

DROP TABLE IF EXISTS `tickets`;
CREATE TABLE `tickets` (
  `id` int NOT NULL AUTO_INCREMENT,
  `userId` int NOT NULL COMMENT 'ID пассажира',
  `tripId` int NOT NULL COMMENT 'ID маршрута',
  `seat` int NOT NULL COMMENT 'номер места в автобусе',
  `createdAt` datetime NOT NULL COMMENT 'Дата создания',
  `updatedAt` datetime DEFAULT NULL COMMENT 'Дата изменения',
  PRIMARY KEY (`id`),
  KEY `fk_tripId` (`userId`),
  CONSTRAINT `fk_tripId` FOREIGN KEY (`userId`) REFERENCES `trips` (`id`),
  CONSTRAINT `fk_userId` FOREIGN KEY (`userId`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `tickets` (`id`, `userId`, `tripId`, `seat`, `createdAt`, `updatedAt`) VALUES
(1,	1,	1,	1,	'2020-12-27 15:27:09',	'2020-12-27 15:27:09'),
(12,	2,	1,	2,	'2020-12-27 15:27:57',	'2020-12-27 15:27:57'),
(13,	1,	1,	3,	'2020-12-27 15:28:45',	'2020-12-27 15:28:45'),
(14,	1,	2,	1,	'2020-12-27 15:29:08',	'2020-12-27 15:29:08'),
(15,	1,	2,	2,	'2020-12-27 15:29:27',	'2020-12-27 15:29:27'),
(16,	1,	2,	3,	'2020-12-27 15:30:16',	'2020-12-27 15:30:16'),
(17,	1,	3,	1,	'2020-12-27 15:30:28',	'2020-12-27 15:30:28');

DROP TABLE IF EXISTS `trips`;
CREATE TABLE `trips` (
  `id` int NOT NULL AUTO_INCREMENT,
  `busId` int NOT NULL COMMENT 'ID автобуса',
  `routeId` int DEFAULT NULL COMMENT 'ID маршрута',
  `departureTime` datetime NOT NULL COMMENT 'Дата и время отправления из населенного пункта',
  `destinationTime` datetime NOT NULL COMMENT 'Дата и время прибытия в пункт назначения',
  `createdAt` datetime NOT NULL COMMENT 'Дата создания',
  `updatedAt` datetime DEFAULT NULL COMMENT 'Дата изменения',
  PRIMARY KEY (`id`),
  KEY `fk_busId` (`busId`),
  KEY `fk_routeId` (`routeId`),
  CONSTRAINT `fk_busId` FOREIGN KEY (`busId`) REFERENCES `buses` (`id`),
  CONSTRAINT `fk_routeId` FOREIGN KEY (`routeId`) REFERENCES `routes` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `trips` (`id`, `busId`, `routeId`, `departureTime`, `destinationTime`, `createdAt`, `updatedAt`) VALUES
(1,	1,	1,	'2020-12-31 06:50:00',	'2020-12-31 09:25:00',	'2020-12-27 15:14:54',	'2020-12-27 15:14:54'),
(2,	1,	2,	'2020-12-31 12:50:00',	'2020-12-31 15:35:00',	'2020-12-27 15:15:34',	'2020-12-27 15:15:34'),
(3,	1,	3,	'2020-12-31 07:00:00',	'2020-12-31 08:45:00',	'2020-12-27 15:17:02',	'2020-12-27 15:17:02');

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(128) DEFAULT NULL COMMENT 'Имя пассажира',
  `email` varchar(128) DEFAULT NULL COMMENT 'email пассажира',
  `password` varchar(32) DEFAULT NULL COMMENT 'Пароль пассажира',
  `phone` varchar(128) DEFAULT NULL COMMENT 'Номер телефона пассажира',
  `createdAt` datetime NOT NULL COMMENT 'Дата создания',
  `updatedAt` datetime DEFAULT NULL COMMENT 'Дата изменения',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `users` (`id`, `name`, `email`, `password`, `phone`, `createdAt`, `updatedAt`) VALUES
(1,	'Empty slot',	'Empty',	'bstu',	'Empty',	'2020-12-27 15:20:41',	'2020-12-27 15:20:41'),
(2,	'Константин Шевченко',	'konstashapovalov@gmail.com',	'bstu',	'123456789',	'2020-12-27 15:05:30',	'2020-12-27 15:05:30'),
(3,	'Николаев Н.Н.',	'tester@myserver.com',	'bstu',	'987654321',	'2020-12-27 15:10:12',	'2020-12-27 15:10:12');

-- 2020-12-27 15:39:09

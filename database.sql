/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50539
Source Host           : 127.0.0.1:3306
Source Database       : dvdrental

Target Server Type    : MYSQL
Target Server Version : 50539
File Encoding         : 65001

Date: 2016-01-10 16:19:33
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for cast
-- ----------------------------
DROP TABLE IF EXISTS `cast`;
CREATE TABLE `cast` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `biography` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of cast
-- ----------------------------
INSERT INTO `cast` VALUES ('1', 'cast name', 'sd');
INSERT INTO `cast` VALUES ('2', 'yhesde erfds', 'ddf');
INSERT INTO `cast` VALUES ('3', 'test ggff', 'sdsd');

-- ----------------------------
-- Table structure for directors
-- ----------------------------
DROP TABLE IF EXISTS `directors`;
CREATE TABLE `directors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `biography` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of directors
-- ----------------------------
INSERT INTO `directors` VALUES ('1', 'Quentin Tarenino', 'fff');
INSERT INTO `directors` VALUES ('2', 'Steven Spielburg', 'ssfg');
INSERT INTO `directors` VALUES ('3', 'Peter Jackson', 'Sir Peter Robert Jackson ONZ KNZM is a New Zealand filmmaker and screenwriter. He is best known as the director and producer of The Lord of the Rings trilogy and The Hobbit trilogy,');
INSERT INTO `directors` VALUES ('4', 'Kyle Patrick Alvarez', 'Writer/Director Kyle Patrick Alvarez holds the keen ability to craft a character-based, true-to-life performance from scratch.\r\n');

-- ----------------------------
-- Table structure for dvds
-- ----------------------------
DROP TABLE IF EXISTS `dvds`;
CREATE TABLE `dvds` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `synopsis` text NOT NULL,
  `director_id` int(11) NOT NULL,
  `release_year` varchar(255) NOT NULL,
  `priceband_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_dvds_have_users` (`user_id`),
  KEY `fk_dvds_have_directors``` (`director_id`),
  KEY `fk_dvds_have_pricebands` (`priceband_id`),
  CONSTRAINT `fk_dvds_have_directors``` FOREIGN KEY (`director_id`) REFERENCES `directors` (`id`),
  CONSTRAINT `fk_dvds_have_pricebands` FOREIGN KEY (`priceband_id`) REFERENCES `pricebands` (`id`),
  CONSTRAINT `fk_dvds_have_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of dvds
-- ----------------------------
INSERT INTO `dvds` VALUES ('1', 'TEST', 'Test', '2', '2012', '1', '1');
INSERT INTO `dvds` VALUES ('2', 'Test DVD', 'eff', '1', '2012', '2', '2');
INSERT INTO `dvds` VALUES ('3', 'I am Legend', 'sfsfsd', '1', '2011', '3', '1');
INSERT INTO `dvds` VALUES ('4', 'Galidator', '3424', '1', '2014', '3', null);
INSERT INTO `dvds` VALUES ('5', 'Aslyumn', '2dhsjd', '1', '1964', '1', null);
INSERT INTO `dvds` VALUES ('6', 'Rain Man', 'dfsfsda', '1', '2012', '3', null);
INSERT INTO `dvds` VALUES ('7', 'The Graduate', 'skfdnfjn', '2', '2014', '2', null);
INSERT INTO `dvds` VALUES ('8', 'Harry Potter', 'dsasfsdf', '2', '2015', '1', null);
INSERT INTO `dvds` VALUES ('11', 'The Hobbit: The Battle of the Five Armies', 'Having reclaimed Erebor and vast treasure from the dragon Smaug, Thorin Oakenshield (Richard Armitage) sacrifices friendship and honor in seeking the Arkenstone, despite Smaug\'s fiery wrath and desperate attempts by the Hobbit Bilbo (Martin Freeman) to make him see reason. Meanwhile, Sauron sends legions of Orcs in a sneak attack upon the Lonely Mountain. As the fate of Middle Earth hangs in the balance, the races of Men, Elves and Dwarves must decide whether to unite and prevail -- or all die.', '3', '2016', '3', null);
INSERT INTO `dvds` VALUES ('12', 'The Stanford Prison Experiment', 'In 1971, Stanford\'s Professor Philip Zimbardo (Billy Crudup) conducts a controversial psychology experiment in which college students pretend to be either prisoners or guards, but the proceedings soon get out of hand.', '4', '2016', '2', '10');
INSERT INTO `dvds` VALUES ('13', 'The Man from U.N.C.L.E.', 'At the height of the Cold War, a mysterious criminal organization plans to use nuclear weapons and technology to upset the fragile balance of power between the United States and Soviet Union. CIA agent Napoleon Solo (Henry Cavill) and KGB agent Illya Kuryakin (Armie Hammer) are forced to put aside their hostilities and work together to stop the evildoers in their tracks. The duo\'s only lead is the daughter of a missing German scientist, whom they must find soon to prevent a global catastrophe.', '3', '2016', '2', null);
INSERT INTO `dvds` VALUES ('14', 'Cobain: Montage of Heck', 'Filmmaker Brett Morgen uses material from the Cobains\' personal archives in an in-depth examination of the Nirvana frontman\'s childhood, music career and untimely death.', '1', '2017', '1', '1');

-- ----------------------------
-- Table structure for dvds_cast
-- ----------------------------
DROP TABLE IF EXISTS `dvds_cast`;
CREATE TABLE `dvds_cast` (
  `dvd_id` int(11) NOT NULL,
  `cast_id` int(11) NOT NULL,
  KEY `dvd_fk` (`dvd_id`),
  KEY `cast_fk` (`cast_id`),
  CONSTRAINT `cast_fk` FOREIGN KEY (`cast_id`) REFERENCES `cast` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `dvd_fk` FOREIGN KEY (`dvd_id`) REFERENCES `dvds` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of dvds_cast
-- ----------------------------
INSERT INTO `dvds_cast` VALUES ('1', '1');
INSERT INTO `dvds_cast` VALUES ('1', '2');
INSERT INTO `dvds_cast` VALUES ('2', '3');
INSERT INTO `dvds_cast` VALUES ('2', '1');
INSERT INTO `dvds_cast` VALUES ('2', '2');
INSERT INTO `dvds_cast` VALUES ('12', '1');
INSERT INTO `dvds_cast` VALUES ('12', '3');
INSERT INTO `dvds_cast` VALUES ('13', '1');
INSERT INTO `dvds_cast` VALUES ('14', '2');
INSERT INTO `dvds_cast` VALUES ('11', '1');
INSERT INTO `dvds_cast` VALUES ('11', '2');

-- ----------------------------
-- Table structure for dvds_genres
-- ----------------------------
DROP TABLE IF EXISTS `dvds_genres`;
CREATE TABLE `dvds_genres` (
  `dvd_id` int(11) NOT NULL,
  `genre_id` int(11) DEFAULT NULL,
  KEY `fk_dvds_have_many_genres` (`dvd_id`),
  KEY `fk_genres_have_many_dvds` (`genre_id`),
  CONSTRAINT `fk_dvds_have_many_genres` FOREIGN KEY (`dvd_id`) REFERENCES `dvds` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_genres_have_many_dvds` FOREIGN KEY (`genre_id`) REFERENCES `genres` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of dvds_genres
-- ----------------------------
INSERT INTO `dvds_genres` VALUES ('2', '2');
INSERT INTO `dvds_genres` VALUES ('3', '1');
INSERT INTO `dvds_genres` VALUES ('2', '3');
INSERT INTO `dvds_genres` VALUES ('1', '1');
INSERT INTO `dvds_genres` VALUES ('1', '2');
INSERT INTO `dvds_genres` VALUES ('2', '1');
INSERT INTO `dvds_genres` VALUES ('4', '2');
INSERT INTO `dvds_genres` VALUES ('5', '1');
INSERT INTO `dvds_genres` VALUES ('5', '1');
INSERT INTO `dvds_genres` VALUES ('6', '2');
INSERT INTO `dvds_genres` VALUES ('7', '3');
INSERT INTO `dvds_genres` VALUES ('7', '1');
INSERT INTO `dvds_genres` VALUES ('8', '1');
INSERT INTO `dvds_genres` VALUES ('8', '2');
INSERT INTO `dvds_genres` VALUES ('11', '1');
INSERT INTO `dvds_genres` VALUES ('11', '3');
INSERT INTO `dvds_genres` VALUES ('12', '3');
INSERT INTO `dvds_genres` VALUES ('12', '1');
INSERT INTO `dvds_genres` VALUES ('13', '2');
INSERT INTO `dvds_genres` VALUES ('14', '1');
INSERT INTO `dvds_genres` VALUES ('1', '1');
INSERT INTO `dvds_genres` VALUES ('2', '1');

-- ----------------------------
-- Table structure for genres
-- ----------------------------
DROP TABLE IF EXISTS `genres`;
CREATE TABLE `genres` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `synopsis` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of genres
-- ----------------------------
INSERT INTO `genres` VALUES ('1', 'Action', '');
INSERT INTO `genres` VALUES ('2', 'Adventure', '');
INSERT INTO `genres` VALUES ('3', 'Romance', '');
INSERT INTO `genres` VALUES ('4', 'Kids', '');

-- ----------------------------
-- Table structure for images
-- ----------------------------
DROP TABLE IF EXISTS `images`;
CREATE TABLE `images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `type` int(11) NOT NULL,
  `dvd_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_dvds_have_images` (`dvd_id`),
  CONSTRAINT `fk_dvds_have_images` FOREIGN KEY (`dvd_id`) REFERENCES `dvds` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of images
-- ----------------------------
INSERT INTO `images` VALUES ('3', 'The Hobbit dvd', 'dvds/thehobbit.jpg', '1', '11');
INSERT INTO `images` VALUES ('4', 'The Hobbit Picture', 'covers/the hobbit.png', '2', '11');
INSERT INTO `images` VALUES ('5', 'SPE dvd cover', 'dvds/the-stanford-prison-experiment.jpg', '1', '12');
INSERT INTO `images` VALUES ('6', 'SPE cover', 'covers/the-stanford-prison-experiment.jpg', '2', '12');
INSERT INTO `images` VALUES ('7', 'uncle dvd', 'dvds/man-from-uncle.jpg', '1', '13');
INSERT INTO `images` VALUES ('8', 'heck cover', 'covers/montage-of-heck-1050x1555.jpg', '2', '14');
INSERT INTO `images` VALUES ('9', 'heck dvd', 'dvds/kurt_cobain_montage_of_heck.jpg', '1', '2');
INSERT INTO `images` VALUES ('10', 'heck dvd', 'dvds/kurt_cobain_montage_of_heck.jpg', '1', '3');
INSERT INTO `images` VALUES ('11', 'uncle cover', 'covers/The-Man-From-U.N.C.L.E.-2015-Images.jpg', '2', '13');
INSERT INTO `images` VALUES ('12', 'heck dvd', 'dvds/kurt_cobain_montage_of_heck.jpg', '1', '14');
INSERT INTO `images` VALUES ('13', 'heck dvd', 'dvds/kurt_cobain_montage_of_heck.jpg', '1', '4');
INSERT INTO `images` VALUES ('14', 'heck dvd', 'dvds/kurt_cobain_montage_of_heck.jpg', '1', '5');
INSERT INTO `images` VALUES ('15', 'heck dvd', 'dvds/kurt_cobain_montage_of_heck.jpg', '1', '6');
INSERT INTO `images` VALUES ('16', 'heck dvd', 'dvds/kurt_cobain_montage_of_heck.jpg', '1', '7');
INSERT INTO `images` VALUES ('17', 'heck dvd', 'dvds/kurt_cobain_montage_of_heck.jpg', '1', '8');
INSERT INTO `images` VALUES ('18', 'heck dvd', 'dvds/kurt_cobain_montage_of_heck.jpg', '1', '1');

-- ----------------------------
-- Table structure for pricebands
-- ----------------------------
DROP TABLE IF EXISTS `pricebands`;
CREATE TABLE `pricebands` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `character` char(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of pricebands
-- ----------------------------
INSERT INTO `pricebands` VALUES ('1', 'A', '3.50');
INSERT INTO `pricebands` VALUES ('2', 'B', '2.50');
INSERT INTO `pricebands` VALUES ('3', 'C', '1.00');

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `mobile_number` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('1', 'Katie Paxton-Fear', 'rstamac+something@gmail.com', 'password', '230 longmore road', '1217331358');
INSERT INTO `users` VALUES ('2', 'Quentin Brault', 'tititesouris@laposte.net', 'password', 'france', '123456789');
INSERT INTO `users` VALUES ('3', 'Katie Paxton-Fear', 'rstamac@gmail.com', '$2y$10$QBp0kZM32I0dBNbwcjAwX.GyzA0/1Li9wL8cqlgcWos75LFrnpnSu', '230 Longmore road', '1217331358');
INSERT INTO `users` VALUES ('4', 'fvnkdnf', 'test@test.com', '$2y$10$abGl8USDgB8IySfdnV4ZDOmrIu2Zfr2zWWfSZ.lyy3fXXfxNieD8q', 'dfdsfefefewr', '12');
INSERT INTO `users` VALUES ('5', 'ghhjhj', 'rstamac@gmail.com', '$2y$10$./zH1Ohi.Aky70I2HAqypu7x8sYKEDoVwO3zgNVbRfjV6tG1o2i9e', 'egfd regerg regwregre', '123413241');
INSERT INTO `users` VALUES ('6', 'kjiijjh efeiwfi', 'dewge@regewr.com', '$2y$10$Esyxu2JvUeFptmAFR8NsbuSCbx9jxQ3vDVWRS11Ba5aQ/YxZSmE72', 'hirughiwrg ergewg', '112234');
INSERT INTO `users` VALUES ('7', 'Some Name', 'email@email.com', '$2y$10$OtF3sx3apRiRV7NV5USTC.zuoOV0AKZ5n3ukQCWq.LQq7p7aeWwWK', 'eferf ferferfe', '1234');
INSERT INTO `users` VALUES ('8', 'Joe Bloggs', 'awesomekt.dev@gmail.com', '$2y$10$WTR4iG0LeU7ZnyzM3h94ce0fLSAnHokxeJQtqxwJ2aAQfVxOP9YIK', 'jsjdisn idif efwe', '1234');
INSERT INTO `users` VALUES ('9', 'Hello World', 'aasdas@sad.com', '$2y$10$RJz4NNY8B/dqRwK05YyJbe/t1HjEQG8ao54VAWuR6K62lLlag0pvy', '19 road', '123455');
INSERT INTO `users` VALUES ('10', 'Joe Bloggs', 'joe.blogs@email.com', '$2y$10$X5GF2UN8vzpSqtmrenbUwOqLhx6T0nvSc59.P6jqdTkPoW.0MuUsK', '13 Hillside View, Solihull, B903WT', '1216554759');
INSERT INTO `users` VALUES ('11', 'Joe Bloggs', 'joe.blogs@email.com', '$2y$10$HVaboGhNmijZAXiCcchmyOQ96q36xuKSjy6Z0.ZSoaZn3zQAGGZe.', '13 Hillside View, Solihull, B903WT', '1216554759');

-- ----------------------------
-- Table structure for wishlist
-- ----------------------------
DROP TABLE IF EXISTS `wishlist`;
CREATE TABLE `wishlist` (
  `user_id` int(11) NOT NULL,
  `dvd_id` int(11) NOT NULL,
  KEY `fk_user_id` (`user_id`),
  KEY `fk_dvd_id` (`dvd_id`),
  CONSTRAINT `fk_dvd_id` FOREIGN KEY (`dvd_id`) REFERENCES `dvds` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of wishlist
-- ----------------------------
INSERT INTO `wishlist` VALUES ('4', '11');
INSERT INTO `wishlist` VALUES ('4', '14');
INSERT INTO `wishlist` VALUES ('6', '11');
INSERT INTO `wishlist` VALUES ('7', '14');
INSERT INTO `wishlist` VALUES ('7', '12');
INSERT INTO `wishlist` VALUES ('4', '12');

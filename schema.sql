CREATE DATABASE yeticave;
USE yeticave;

CREATE TABLE `category` (
	`id` INT(11) NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(50) NOT NULL,
	PRIMARY KEY (`id`),
	UNIQUE INDEX `name` (`name`)
);

CREATE TABLE `user` (
	`id` INT(11) NOT NULL AUTO_INCREMENT,
	`reg_date` DATETIME NOT NULL,
	`email` VARCHAR(50) NOT NULL,
	`name` VARCHAR(50) NOT NULL,
	`password` VARCHAR(72) NOT NULL,
	`avatar` VARCHAR(128) NOT NULL,
	`contacts` VARCHAR(512) NOT NULL,
	PRIMARY KEY (`id`),
	UNIQUE INDEX `email` (`email`)
);

CREATE TABLE `lot` (
	`id` INT(11) NOT NULL AUTO_INCREMENT,
	`date_publish` DATETIME NOT NULL,
	`name` VARCHAR(50) NOT NULL,
	`description` TEXT NOT NULL,
	`image` VARCHAR(128) NOT NULL,
	`price_start` INT(11) NOT NULL,
	`date_expire` DATETIME NOT NULL,
	`bet_step` INT(11) NOT NULL,
	`user_id` INT(11) NOT NULL,
	`winner_id` INT(11) NULL DEFAULT NULL,
	`category_id` INT(11) NOT NULL,
	PRIMARY KEY (`id`),
  INDEX `FK_lot_user_id` (`user_id`),
	INDEX `FK_lot_winner_id` (`winner_id`),
	INDEX `FK_lot_category_id` (`category_id`),
  INDEX `date_publish` (`date_publish`),
  INDEX `name` (`name`),
	INDEX `date_expire` (`date_expire`),
	CONSTRAINT `FK_lot_category_id` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`),
	CONSTRAINT `FK_lot_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
	CONSTRAINT `FK_lot_winner_id` FOREIGN KEY (`winner_id`) REFERENCES `user` (`id`)
);

CREATE TABLE `bet` (
	`id` INT(11) NOT NULL AUTO_INCREMENT,
	`date` DATETIME NOT NULL,
	`cost` INT(11) NOT NULL,
	`user_id` INT(11) NOT NULL,
	`lot_id` INT(11) NOT NULL,
	PRIMARY KEY (`id`),
  INDEX `FK_bet_user_id` (`user_id`),
	INDEX `FK_bet_lot_id` (`lot_id`),
  INDEX `date` (`date`),
	CONSTRAINT `FK_bet_lot_id` FOREIGN KEY (`lot_id`) REFERENCES `lot` (`id`),
	CONSTRAINT `FK_bet_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
);


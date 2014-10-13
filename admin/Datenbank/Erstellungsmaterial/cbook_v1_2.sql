-- ----------- P I M P _ T H E _ S K R I P T -----------
-- 1. Remove comments                                 --
-- 2. Rename DB Names ('mydb' --> 'cbooks'            --
-- 3. Splitt Skript                                   --
--    1. Create Tables                                --
--    2. Define Foreign keys                          --
-- 4. CHECK Head and Foot                             --
--                                                    --
--                                                    --
--                                                    --
-- ----------------------- E N D -----------------------

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

CREATE DATABASE IF NOT EXISTS `cbooks` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `cbooks` ;

-- -----------------------------------------------------
-- Table `cbooks`.`user`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cbooks`.`user` (
  `id_user` INT NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(100) NULL,
  `pword` VARCHAR(45) NULL,
  `access_right` SET('u','s','l') NULL DEFAULT 'l',
  `first_name` VARCHAR(100) NULL,
  `family_name` VARCHAR(100) NULL,
  `street` VARCHAR(100) NULL,
  `street_num` VARCHAR(4) NULL,
  `zip` VARCHAR(10) NULL,
  `city` VARCHAR(45) NULL,
  `country` VARCHAR(45) NULL,
  `reg_date` TIMESTAMP NULL,
  PRIMARY KEY (`id_user`),
  UNIQUE INDEX `username_UNIQUE` (`username` ASC));

-- -----------------------------------------------------
-- Table `cbooks`.`books`
-- -----------------------------------------------------

CREATE TABLE IF NOT EXISTS `cbooks`.`books` (
  `id_books` INT NOT NULL AUTO_INCREMENT,
  `isbn` VARCHAR(17) NULL,
  `title` VARCHAR(250) NULL,
  `subtitle` VARCHAR(250) NULL,
  `author` VARCHAR(250) NULL,
  `description` TEXT NULL,
  `category` VARCHAR(45) NULL,
  `language` VARCHAR(45) NULL,
  `image_link` VARCHAR(24) NULL,
  `availability` SET('a','l','i') NULL DEFAULT 'a',
  `owner` VARCHAR(45) NULL,
  `reg_date` TIMESTAMP NULL,
  PRIMARY KEY (`id_books`));

-- -----------------------------------------------------
-- Table `cbooks`.`request`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cbooks`.`request` (
	`id_relation` INT NOT NULL AUTO_INCREMENT,
	`requestDate` DATE NULL,
	`authorizationDate` DATE NULL,
	`returnDate` DATE NULL,
	`state` SET('r','a','c') NULL DEFAULT 'r',
	`lender` INT NULL,
	`item` INT NULL,
	`reg_date` TIMESTAMP NULL,
	PRIMARY KEY (`id_relation`)
	)
;

-- -----------------------------------------------------
-- Add Foreign Key to table 'books'
-- -----------------------------------------------------
ALTER TABLE books
	ADD INDEX `fk_objects_user1_idx` (`owner` ASC),
	ADD CONSTRAINT `fk_objects_user1`
			FOREIGN KEY (`owner`)
			REFERENCES `cbooks`.`user` (`id_user`)
			ON DELETE NO ACTION
			ON UPDATE NO ACTION
;

-- -----------------------------------------------------
-- Add Foreign Key to table 'request'
-- -----------------------------------------------------
ALTER TABLE request
	ADD INDEX `fk_relation_user2_idx` (`lender` ASC),
	ADD INDEX `fk_relation_objects1_idx` (`item` ASC),
	ADD CONSTRAINT `fk_relation_user2`
		FOREIGN KEY (`lender`)
		REFERENCES `cbooks`.`user` (`id_user`)
		ON DELETE NO ACTION
		ON UPDATE NO ACTION,
	ADD CONSTRAINT `fk_relation_objects1`
		FOREIGN KEY (`item`)
		REFERENCES `cbooks`.`books` (`id_books`)
		ON DELETE NO ACTION
		ON UPDATE NO ACTION
;

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

CREATE SCHEMA IF NOT EXISTS `mydb` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `mydb` ;

-- -----------------------------------------------------
-- Table `mydb`.`user`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`user` (
  `id_user` INT NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(100) NULL COMMENT 'Must be e-mail-adress\nWhat if e-mail-adress changes?\n',
  `pword` VARCHAR(45) NULL,
  `access_right` SET('u','s','l') NULL DEFAULT 'l' COMMENT 'u - user\ns - superuser\nl - locked\n\nAfter E-Mail-Confirmation: \'u\'',
  `first_name` VARCHAR(100) NULL,
  `family_name` VARCHAR(100) NULL,
  `street` VARCHAR(100) NULL COMMENT 'Possible to check with webservice?',
  `street_num` VARCHAR(4) NULL,
  `zip` VARCHAR(10) NULL COMMENT 'Possible to check with webservice?',
  `city` VARCHAR(45) NULL COMMENT 'Possible to check with webservice?',
  `country` VARCHAR(45) NULL COMMENT 'Possible to check with webservice?',
  `reg_date` TIMESTAMP NULL,
  PRIMARY KEY (`id_user`),
  UNIQUE INDEX `username_UNIQUE` (`username` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`books`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`books` (
  `id_books` INT NOT NULL AUTO_INCREMENT,
  `isbn` VARCHAR(17) NULL COMMENT 'Prüfziffer: http://de.wikipedia.org/wiki/Internationale_Standardbuchnummer',
  `title` VARCHAR(250) NULL,
  `subtitle` VARCHAR(250) NULL,
  `author` VARCHAR(250) NULL,
  `description` TEXT NULL,
  `category` VARCHAR(45) NULL COMMENT 'Category: Possible to make List?\n',
  `language` VARCHAR(45) NULL COMMENT 'Language: Possible to make List?\n',
  `image_link` VARCHAR(24) NULL,
  `availability` SET('a','l','i') NULL DEFAULT 'a' COMMENT 'Availability: \"SET\" useful?\n-  available\n-  lent\n-  inactive',
  `lender` VARCHAR(45) NULL,
  `owner` VARCHAR(45) NULL,
  `reg_date` TIMESTAMP NULL,
  PRIMARY KEY (`id_books`),
  INDEX `fk_objects_user1_idx` (`owner` ASC),
  INDEX `fk_objects_user2_idx` (`lender` ASC),
  CONSTRAINT `fk_objects_user1`
    FOREIGN KEY (`owner`)
    REFERENCES `mydb`.`user` (`id_user`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_objects_user2`
    FOREIGN KEY (`lender`)
    REFERENCES `mydb`.`user` (`id_user`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`request`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`request` (
  `id_relation` INT NOT NULL AUTO_INCREMENT COMMENT 'Muss die Adresse in den Request geschrieben werden aus historischen Gründen?\nWas, wenn der Leihende umzieht und die Adresse nicht mehr zurück verfolgt werden kann?',
  `requestDate` DATE NULL,
  `authorizationDate` DATE NULL,
  `returnDate` DATE NULL,
  `state` SET('r','a','c') NULL DEFAULT 'r' COMMENT 'r - requested\na - approved\nc - closed',
  `lender` INT NULL,
  `item` INT NULL,
  `reg_date` TIMESTAMP NULL,
  PRIMARY KEY (`id_relation`),
  INDEX `fk_relation_user2_idx` (`lender` ASC),
  INDEX `fk_relation_objects1_idx` (`item` ASC),
  CONSTRAINT `fk_relation_user2`
    FOREIGN KEY (`lender`)
    REFERENCES `mydb`.`user` (`id_user`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_relation_objects1`
    FOREIGN KEY (`item`)
    REFERENCES `mydb`.`books` (`id_books`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

-- ----------- P I M P _ T H E _ S K R I P T -----------
--                                                    --
--    Rename DBs: 'mydb' > 'cbooksch_dev'             --
--                                                    --
-- ----------------------- E N D -----------------------




SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

CREATE SCHEMA IF NOT EXISTS `cbooksch_dev` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `cbooksch_dev` ;

-- -----------------------------------------------------
-- Table `cbooksch_dev`.`languages`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cbooksch_dev`.`languages` (
  `id_language` INT NOT NULL AUTO_INCREMENT,
  `lng_name` VARCHAR(45) NULL,
  PRIMARY KEY (`id_language`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cbooksch_dev`.`books`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cbooksch_dev`.`books` (
  `id_isbn` VARCHAR(17) NOT NULL COMMENT 'Prüfziffer: http://de.wikipedia.org/wiki/Internationale_Standardbuchnummer',
  `title` VARCHAR(250) NULL,
  `subtitle` VARCHAR(250) NULL,
  `blurb` TEXT NULL COMMENT 'Klappentext',
  `language` INT NULL COMMENT 'Language: Possible to make List?\n',
  `image_link` VARCHAR(24) NULL,
  `reg_date` TIMESTAMP NULL,
  `publisher` VARCHAR(45) NULL COMMENT 'Verlag -> besser: externe Tabelle',
  `publication_date` DATE NULL,
  UNIQUE INDEX `id_isbn_UNIQUE` (`id_isbn` ASC),
  PRIMARY KEY (`id_isbn`),
  INDEX `fk_books_languages1_idx` (`language` ASC),
  CONSTRAINT `fk_books_languages1`
    FOREIGN KEY (`language`)
    REFERENCES `cbooksch_dev`.`languages` (`id_language`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cbooksch_dev`.`cb_users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cbooksch_dev`.`cb_users` (
  `id_cb_user` INT NOT NULL AUTO_INCREMENT,
  `title` SET('h','f','b') NULL DEFAULT 'b' COMMENT 'b - blank\nh - Herr\nf - Frau',
  `username` VARCHAR(100) NULL COMMENT 'Must be e-mail-adress\nWhat if e-mail-adress changes?\n',
  `pword` CHAR(32) NULL COMMENT 'Vergleiche Länge MD5\nmd5(pword) --> Hash',
  `birth_date` DATE NULL COMMENT 'ergänzt am 5.10.2014',
  `first_name` VARCHAR(100) NULL,
  `family_name` VARCHAR(100) NULL,
  `street` VARCHAR(100) NULL COMMENT 'Possible to check with webservice?',
  `street_num` VARCHAR(4) NULL,
  `zip` VARCHAR(10) NULL COMMENT 'Possible to check with webservice?',
  `city` VARCHAR(45) NULL COMMENT 'Possible to check with webservice?',
  `country` VARCHAR(45) NULL COMMENT 'Possible to check with webservice?',
  `access_right` SET('u','s','l') NULL DEFAULT 'l' COMMENT 'u - user\ns - superuser\nl - locked\n\nAfter E-Mail-Confirmation: \'u\'',
  `reg_date` TIMESTAMP NULL,
  `last_activity` DATETIME NULL,
  `language` INT NULL COMMENT 'Sprache',
  PRIMARY KEY (`id_cb_user`),
  UNIQUE INDEX `username_UNIQUE` (`username` ASC),
  INDEX `fk_cb_users_languages1_idx` (`language` ASC),
  CONSTRAINT `fk_cb_users_languages1`
    FOREIGN KEY (`language`)
    REFERENCES `cbooksch_dev`.`languages` (`id_language`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cbooksch_dev`.`personal_books`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cbooksch_dev`.`personal_books` (
  `id_personal_book` INT NOT NULL AUTO_INCREMENT,
  `isbn` VARCHAR(17) NULL COMMENT 'Prüfziffer: http://de.wikipedia.org/wiki/Internationale_Standardbuchnummer',
  `description` TEXT NULL,
  `availability` SET('a','l','i') NULL DEFAULT 'a' COMMENT 'Availability: \"SET\" useful?\n-  available\n-  lent\n-  inactive',
  `owner_id_user` INT NULL,
  `reg_date` TIMESTAMP NULL,
  `last_activity` DATETIME NULL,
  `run` VARCHAR(45) NULL COMMENT 'Auflage',
  `volume` VARCHAR(45) NULL COMMENT 'Band\n',
  PRIMARY KEY (`id_personal_book`),
  INDEX `fk_objects_user1_idx` (`owner_id_user` ASC),
  INDEX `fk_personal_books_books1_idx` (`isbn` ASC),
  CONSTRAINT `fk_objects_user10`
    FOREIGN KEY (`owner_id_user`)
    REFERENCES `cbooksch_dev`.`cb_users` (`id_cb_user`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_personal_books_books1`
    FOREIGN KEY (`isbn`)
    REFERENCES `cbooksch_dev`.`books` (`id_isbn`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cbooksch_dev`.`lending_relations`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cbooksch_dev`.`lending_relations` (
  `id_lending_relation` INT NOT NULL AUTO_INCREMENT COMMENT 'Muss die Adresse in den Request geschrieben werden aus historischen Gründen?\nWas, wenn der Leihende umzieht und die Adresse nicht mehr zurück verfolgt werden kann?',
  `requestDate` DATE NULL,
  `authorizationDate` DATE NULL,
  `returnDate` DATE NULL,
  `state` SET('r','a','c','l') NULL DEFAULT 'r' COMMENT 'r - requested\na - approved\nc - closed\nl  - late/lost\n\nEs kann nur ein Request pro Item ID frei gegeben werden.',
  `lender_id_user` INT NULL,
  `item_id_personal_book` INT NULL,
  `addressString` VARCHAR(500) NULL COMMENT 'Falls Benutzerdaten geändert werden als Beleg.',
  PRIMARY KEY (`id_lending_relation`),
  INDEX `fk_relation_user2_idx` (`lender_id_user` ASC),
  INDEX `fk_lending_relations_personal_books1_idx` (`item_id_personal_book` ASC),
  CONSTRAINT `fk_relation_user2`
    FOREIGN KEY (`lender_id_user`)
    REFERENCES `cbooksch_dev`.`cb_users` (`id_cb_user`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_lending_relations_personal_books1`
    FOREIGN KEY (`item_id_personal_book`)
    REFERENCES `cbooksch_dev`.`personal_books` (`id_personal_book`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cbooksch_dev`.`authors`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cbooksch_dev`.`authors` (
  `id_author` INT NOT NULL AUTO_INCREMENT,
  `aut_name` VARCHAR(100) NULL,
  PRIMARY KEY (`id_author`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cbooksch_dev`.`categorys`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cbooksch_dev`.`categorys` (
  `id_categorys` INT NOT NULL,
  `cat_name` VARCHAR(45) NULL,
  PRIMARY KEY (`id_categorys`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cbooksch_dev`.`books_has_authors`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cbooksch_dev`.`books_has_authors` (
  `books_id_isbn` VARCHAR(17) NOT NULL,
  `authors_id_author` INT NOT NULL,
  PRIMARY KEY (`books_id_isbn`, `authors_id_author`),
  INDEX `fk_books_has_authors_authors1_idx` (`authors_id_author` ASC),
  INDEX `fk_books_has_authors_books1_idx` (`books_id_isbn` ASC),
  CONSTRAINT `fk_books_has_authors_books1`
    FOREIGN KEY (`books_id_isbn`)
    REFERENCES `cbooksch_dev`.`books` (`id_isbn`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_books_has_authors_authors1`
    FOREIGN KEY (`authors_id_author`)
    REFERENCES `cbooksch_dev`.`authors` (`id_author`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cbooksch_dev`.`books_has_categorys`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cbooksch_dev`.`books_has_categorys` (
  `books_id_isbn` VARCHAR(17) NOT NULL,
  `categorys_id_categorys` INT NOT NULL,
  PRIMARY KEY (`books_id_isbn`, `categorys_id_categorys`),
  INDEX `fk_books_has_categorys_categorys1_idx` (`categorys_id_categorys` ASC),
  INDEX `fk_books_has_categorys_books1_idx` (`books_id_isbn` ASC),
  CONSTRAINT `fk_books_has_categorys_books1`
    FOREIGN KEY (`books_id_isbn`)
    REFERENCES `cbooksch_dev`.`books` (`id_isbn`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_books_has_categorys_categorys1`
    FOREIGN KEY (`categorys_id_categorys`)
    REFERENCES `cbooksch_dev`.`categorys` (`id_categorys`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

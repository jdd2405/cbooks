-- ----------- P I M P _ T H E _ S C R I P T -----------
--                                                    --
--    Rename DBs: 'mydb' > 'c_booksch'            --
--    Add Constraints and FK in seperate script part  --
--    Remove Comments                                 --
--    Add Table LoginAttempts                         --
--                                                    --
-- ----------------------- E N D -----------------------



SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

CREATE SCHEMA IF NOT EXISTS `c_booksch` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `c_booksch` ;

-- -----------------------------------------------------
-- Table `c_booksch`.`languages`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `c_booksch`.`languages` (
  `id_language` INT NOT NULL AUTO_INCREMENT,
  `lng_name` VARCHAR(45) NULL,
  PRIMARY KEY (`id_language`))
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `c_booksch`.`books`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `c_booksch`.`books` (
  `id_isbn` VARCHAR(17) NOT NULL,
  `title` VARCHAR(250) NULL,
  `subtitle` VARCHAR(250) NULL,
  `blurb` TEXT NULL,
  `language` INT NULL,
  `image_link` VARCHAR(24) NULL,
  `reg_date` TIMESTAMP NULL,
  `publisher` VARCHAR(45) NULL,
  `publication_date` DATE NULL,
  UNIQUE INDEX `id_isbn_UNIQUE` (`id_isbn` ASC),
  PRIMARY KEY (`id_isbn`))
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `c_booksch`.`cb_users`  pword not null
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `c_booksch`.`cb_users` (
  `id_cb_user` INT NOT NULL AUTO_INCREMENT,
  `title` SET('h','f','b') NULL DEFAULT 'b',
  `username` VARCHAR(100) NULL,
  `pword` CHAR(128) NULL,
  `salt` CHAR(128) NULL,
  `birth_date` DATE NULL,
  `first_name` VARCHAR(100) NULL,
  `family_name` VARCHAR(100) NULL,
  `street` VARCHAR(100) NULL,
  `street_num` VARCHAR(4) NULL,
  `zip` VARCHAR(10) NULL,
  `city` VARCHAR(45) NULL,
  `country` VARCHAR(45) NULL,
  `access_right` SET('u','s','l') NULL DEFAULT 'l',
  `reg_date` TIMESTAMP NULL,
  `last_activity` DATETIME NULL,
  `language` INT NULL,
  PRIMARY KEY (`id_cb_user`),
  UNIQUE INDEX `username_UNIQUE` (`username` ASC),
  INDEX `fk_cb_users_languages1_idx` (`language` ASC),
  CONSTRAINT `fk_cb_users_languages1`
    FOREIGN KEY (`language`)
    REFERENCES `c_booksch`.`languages` (`id_language`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `c_booksch`.`personal_books`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `c_booksch`.`personal_books` (
  `id_personal_book` INT NOT NULL AUTO_INCREMENT,
  `isbn` VARCHAR(17) NULL,
  `description` TEXT NULL,
  `availability` SET('a','l','i') NULL DEFAULT 'a',
  `owner_id_user` INT NULL,
  `reg_date` TIMESTAMP NULL,
  `last_activity` DATETIME NULL,
  `run` VARCHAR(45) NULL,
  `volume` VARCHAR(45) NULL,
  PRIMARY KEY (`id_personal_book`),
  INDEX `fk_objects_user1_idx` (`owner_id_user` ASC),
  INDEX `fk_personal_books_books1_idx` (`isbn` ASC),
  CONSTRAINT `fk_objects_user10`
    FOREIGN KEY (`owner_id_user`)
    REFERENCES `c_booksch`.`cb_users` (`id_cb_user`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `c_booksch`.`lending_relations`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `c_booksch`.`lending_relations` (
  `id_lending_relation` INT NOT NULL AUTO_INCREMENT,
  `requestDate` DATE NULL,
  `authorizationDate` DATE NULL,
  `returnDate` DATE NULL,
  `state` SET('r','a','c','l') NULL DEFAULT 'r',
  `lender_id_user` INT NULL,
  `item_id_personal_book` INT NULL,
  `addressString` VARCHAR(500) NULL,
  PRIMARY KEY (`id_lending_relation`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `c_booksch`.`authors`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `c_booksch`.`authors` (
  `id_author` INT NOT NULL AUTO_INCREMENT,
  `aut_name` VARCHAR(100) NULL,
  PRIMARY KEY (`id_author`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `c_booksch`.`categories`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `c_booksch`.`categories` (
  `id_categories` INT NOT NULL,
  `cat_name` VARCHAR(45) NULL,
  PRIMARY KEY (`id_categories`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `c_booksch`.`books_has_authors`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `c_booksch`.`books_has_authors` (
  `books_id_isbn` VARCHAR(17) NOT NULL,
  `authors_id_author` INT NOT NULL,
  PRIMARY KEY (`books_id_isbn`, `authors_id_author`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `c_booksch`.`books_has_categories`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `c_booksch`.`books_has_categories` (
  `books_id_isbn` VARCHAR(17) NOT NULL,
  `categories_id_categories` INT NOT NULL,
  PRIMARY KEY (`books_id_isbn`, `categories_id_categories`))
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `c_booksch`.`user_activities`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `c_booksch`.`user_activities` (
  `cb_users_id_cb_user` INT(11) NOT NULL,
  `loginAttemptTime` TIMESTAMP NULL,
  `failedLoginAttempt` INT(2) NOT NULL,
  PRIMARY KEY (`cb_users_id_cb_user`))
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Add Foreign Key to table `user_activities`
-- -----------------------------------------------------
ALTER TABLE `user_activities`
	ADD INDEX `fk_user_activities_cb_users1_idx` (`cb_users_id_cb_user` ASC),
	ADD CONSTRAINT `fk_user_activities_cb_users1`
		FOREIGN KEY (`cb_users_id_cb_user`)
		REFERENCES `c_booksch`.`cb_users` (`id_cb_user`)
		ON DELETE NO ACTION
		ON UPDATE NO ACTION,
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Add Foreign Key to table `books`
-- -----------------------------------------------------
ALTER TABLE `books`
  ADD INDEX `fk_books_languages1_idx` (`language` ASC),
  ADD CONSTRAINT `fk_books_languages1`
    FOREIGN KEY (`language`)
    REFERENCES `c_booksch`.`languages` (`id_language`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Add Foreign Key to table `personal_books`
-- -----------------------------------------------------
ALTER TABLE `personal_books`
  ADD CONSTRAINT `fk_personal_books_books1`
    FOREIGN KEY (`isbn`)
    REFERENCES `c_booksch`.`books` (`id_isbn`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Add Foreign Key to table `lending_relations`
-- -----------------------------------------------------
ALTER TABLE `lending_relations`
  ADD INDEX `fk_relation_user2_idx` (`lender_id_user` ASC),
  ADD INDEX `fk_lending_relations_personal_books1_idx` (`item_id_personal_book` ASC),
  ADD CONSTRAINT `fk_relation_user2`
    FOREIGN KEY (`lender_id_user`)
    REFERENCES `c_booksch`.`cb_users` (`id_cb_user`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_lending_relations_personal_books1`
    FOREIGN KEY (`item_id_personal_book`)
    REFERENCES `c_booksch`.`personal_books` (`id_personal_book`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Add Foreign Key to table `books_has_authors`
-- -----------------------------------------------------
ALTER TABLE `books_has_authors`  
  ADD INDEX `fk_books_has_authors_authors1_idx` (`authors_id_author` ASC),
  ADD INDEX `fk_books_has_authors_books1_idx` (`books_id_isbn` ASC),
  ADD CONSTRAINT `fk_books_has_authors_books1`
    FOREIGN KEY (`books_id_isbn`)
    REFERENCES `c_booksch`.`books` (`id_isbn`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_books_has_authors_authors1`
    FOREIGN KEY (`authors_id_author`)
    REFERENCES `c_booksch`.`authors` (`id_author`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
ENGINE = InnoDB;
	
-- -----------------------------------------------------
-- Add Foreign Key to table `books_has_categories`
-- -----------------------------------------------------
ALTER TABLE `books_has_categories`
  ADD INDEX `fk_books_has_categories_categories1_idx` (`categories_id_categories` ASC),
  ADD INDEX `fk_books_has_categories_books1_idx` (`books_id_isbn` ASC),
  ADD CONSTRAINT `fk_books_has_categories_books1`
    FOREIGN KEY (`books_id_isbn`)
    REFERENCES `c_booksch`.`books` (`id_isbn`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_books_has_categories_categories1`
    FOREIGN KEY (`categories_id_categories`)
    REFERENCES `c_booksch`.`categories` (`id_categories`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

-- MySQL Workbench Forward Engineering (version WebDev : sans CREATE SCHEMA ni USE)

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Table `author`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `author` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  `birthday` DATE NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb3;


-- -----------------------------------------------------
-- Table `book`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `book` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(60) NOT NULL,
  `isbn` VARCHAR(20) NOT NULL,
  `description` TEXT NULL DEFAULT NULL,
  `price` DOUBLE NOT NULL,
  `author_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `isbn` (`isbn` ASC),
  INDEX `fk_book_author` (`author_id` ASC),
  CONSTRAINT `fk_book_author`
    FOREIGN KEY (`author_id`)
    REFERENCES `author` (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb3;


-- -----------------------------------------------------
-- Table `client`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `client` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  `address` VARCHAR(60) NULL DEFAULT NULL,
  `zip_code` VARCHAR(10) NULL DEFAULT NULL,
  `phone` VARCHAR(20) NULL DEFAULT NULL,
  `email` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `email` (`email` ASC))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb3;


-- -----------------------------------------------------
-- Table `sale`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sale` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `quantity` INT NOT NULL DEFAULT '1',
  `sold_date` DATE NOT NULL,
  `unit_price` DOUBLE NOT NULL,
  `book_id` INT NOT NULL,
  `client_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_book_id` (`book_id` ASC),
  INDEX `fk_client_id` (`client_id` ASC),
  CONSTRAINT `fk_book_id`
    FOREIGN KEY (`book_id`)
    REFERENCES `book` (`id`),
  CONSTRAINT `fk_client_id`
    FOREIGN KEY (`client_id`)
    REFERENCES `client` (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb3;

-- -----------------------------------------------------
-- Data
-- -----------------------------------------------------
INSERT INTO `author` (`name`, `birthday`)
VALUES ('Annick Grimoire', '1982-06-25');
INSERT INTO `author` (`name`, `birthday`)
VALUES ('Gabrielle Bradefroy', '1999-03-22');
INSERT INTO `author` (`name`, `birthday`)
VALUES ('Dany Brière', '1983-04-13');
INSERT INTO `author` (`name`, `birthday`)
VALUES ('Kim Prum', '1988-09-18');

INSERT INTO `client` (`name`, `address`, `zip_code`, `phone`, `email`)
VALUES ('Julie Gagnon', '145 rue Saint-Charles, Longueuil', 'J4H 1C7', '450-555-0142', 'julie@test.ca');
INSERT INTO `client` (`name`, `address`, `zip_code`, `phone`, `email`)
VALUES ('Marc Lavoie', '2030 boul. Pie-IX, Montreal', 'H1V 2C8', '514-555-0198', 'marc@test.ca');
INSERT INTO `client` (`name`, `address`, `zip_code`, `phone`, `email`)
VALUES ('Sophie Bergeron', '88 avenue du Parc, Montreal', 'H2W 1R2', '514-555-0176', 'sophie@test.ca');

INSERT INTO `book` (`title`, `isbn`, `description`, `price`, `author_id`)
VALUES ('Le grimoire oublie', '9782760912341', 'Roman fantastique en trois actes.', 24.95, 1);
INSERT INTO `book` (`title`, `isbn`, `description`, `price`, `author_id`)
VALUES ('La tour de verre', '9782760923452', 'Suite du grimoire oublie.', 29.95, 1);
INSERT INTO `book` (`title`, `isbn`, `description`, `price`, `author_id`)
VALUES ('Les rives du Nord', '9782764634563', 'Roman sur la vie en Gaspesie.', 19.95, 2);
INSERT INTO `book` (`title`, `isbn`, `description`, `price`, `author_id`)
VALUES ('Le sentier des songes', '9782764645674', 'Recit publie en 2019.', 22.50, 2);
INSERT INTO `book` (`title`, `isbn`, `description`, `price`, `author_id`)
VALUES ('Retour a Kamouraska', '9782764456785', 'Recit du retour au pays natal.', 27.95, 3);
INSERT INTO `book` (`title`, `isbn`, `description`, `price`, `author_id`)
VALUES ('Saisons breves', '9782764867896', 'Premier roman de l auteure.', 18.95, 4);


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

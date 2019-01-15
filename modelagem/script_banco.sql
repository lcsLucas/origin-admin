-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema projeto_mvc
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `projeto_mvc` ;

-- -----------------------------------------------------
-- Schema projeto_mvc
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `projeto_mvc` DEFAULT CHARACTER SET utf8 ;
USE `projeto_mvc` ;

-- -----------------------------------------------------
-- Table `projeto_mvc`.`tipo_usuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `projeto_mvc`.`tipo_usuario` (
  `tip_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `tip_nome` VARCHAR(60) NOT NULL,
  PRIMARY KEY (`tip_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `projeto_mvc`.`usuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `projeto_mvc`.`usuario` (
  `usu_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `usu_dtCad` DATE NOT NULL,
  `usu_nome` VARCHAR(60) NOT NULL,
  `usu_login` VARCHAR(30) NOT NULL,
  `usu_senha` VARCHAR(60) NOT NULL,
  `usu_email` VARCHAR(60) NULL,
  `usu_ativo` CHAR(1) NOT NULL,
  `usu_apelido` VARCHAR(40) NULL,
  `tip_id` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`usu_id`),
  INDEX `fk_usuario_tipo_usuario1_idx` (`tip_id` ASC),
  CONSTRAINT `fk_usuario_tipo_usuario1`
    FOREIGN KEY (`tip_id`)
    REFERENCES `projeto_mvc`.`tipo_usuario` (`tip_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `projeto_mvc`.`menu_adminitrativo`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `projeto_mvc`.`menu_adminitrativo` (
  `men_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `men_nome` VARCHAR(60) NOT NULL,
  `men_url` VARCHAR(60) NULL,
  `men_icone` VARCHAR(30) NULL,
  `men_indice` INT NULL,
  `men_pai` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`men_id`),
  INDEX `fk_menu_adminitrativo_menu_adminitrativo1_idx` (`men_pai` ASC),
  CONSTRAINT `fk_menu_adminitrativo_menu_adminitrativo1`
    FOREIGN KEY (`men_pai`)
    REFERENCES `projeto_mvc`.`menu_adminitrativo` (`men_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `projeto_mvc`.`permissao_usuario_menu`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `projeto_mvc`.`permissao_usuario_menu` (
  `tip_id` INT UNSIGNED NOT NULL,
  `men_id` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`tip_id`, `men_id`),
  INDEX `fk_tipo_usuario_has_menu_adminitrativo_menu_adminitrativo1_idx` (`men_id` ASC),
  INDEX `fk_tipo_usuario_has_menu_adminitrativo_tipo_usuario1_idx` (`tip_id` ASC),
  CONSTRAINT `fk_tipo_usuario_has_menu_adminitrativo_tipo_usuario1`
    FOREIGN KEY (`tip_id`)
    REFERENCES `projeto_mvc`.`tipo_usuario` (`tip_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tipo_usuario_has_menu_adminitrativo_menu_adminitrativo1`
    FOREIGN KEY (`men_id`)
    REFERENCES `projeto_mvc`.`menu_adminitrativo` (`men_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

-- -----------------------------------------------------
-- Data for table `projeto_mvc`.`tipo_usuario`
-- -----------------------------------------------------
START TRANSACTION;
USE `projeto_mvc`;
INSERT INTO `projeto_mvc`.`tipo_usuario` (`tip_id`, `tip_nome`) VALUES (1, 'Administrador');
INSERT INTO `projeto_mvc`.`tipo_usuario` (`tip_id`, `tip_nome`) VALUES (2, 'Básico');

COMMIT;


-- -----------------------------------------------------
-- Data for table `projeto_mvc`.`usuario`
-- -----------------------------------------------------
START TRANSACTION;
USE `projeto_mvc`;
INSERT INTO `projeto_mvc`.`usuario` (`usu_id`, `usu_dtCad`, `usu_nome`, `usu_login`, `usu_senha`, `usu_email`, `usu_ativo`, `usu_apelido`, `tip_id`) VALUES (DEFAULT, '2018-12-21', 'Administrador do Sistema', 'admin', '$2y$10$r0I3oKZak.nrmJUlOQtSFOC5e1HOIylJxdsUMxlGr5EdKSkd2fZ/m', 'admin@admin.com', '1', NULL, 1);

COMMIT;
-- MySQL Script generated by MySQL Workbench
-- Qua 24 Out 2018 07:15:00 -03
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema chamado
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `chamado` ;

-- -----------------------------------------------------
-- Schema chamado
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `chamado` DEFAULT CHARACTER SET utf8 ;
USE `chamado` ;

-- -----------------------------------------------------
-- Table `chamado`.`perfil`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `chamado`.`perfil` (
  `per_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `per_perfil` VARCHAR(15) NOT NULL,
  PRIMARY KEY (`per_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `chamado`.`usuario_status`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `chamado`.`usuario_status` (
  `stu_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `stu_status` VARCHAR(15) NOT NULL,
  PRIMARY KEY (`stu_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `chamado`.`usuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `chamado`.`usuario` (
  `usu_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `usu_nome` VARCHAR(45) NOT NULL,
  `usu_login` VARCHAR(45) NULL,
  `usu_senha` VARCHAR(255) NOT NULL,
  `usu_perfil` INT UNSIGNED NOT NULL,
  `usu_status` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`usu_id`),
  INDEX `fk_usuario_perfil_idx` (`usu_perfil` ASC),
  INDEX `fk_usuario_usustatus1_idx` (`usu_status` ASC),
  CONSTRAINT `fk_usuario_perfil`
    FOREIGN KEY (`usu_perfil`)
    REFERENCES `chamado`.`perfil` (`per_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_usuario_usustatus1`
    FOREIGN KEY (`usu_status`)
    REFERENCES `chamado`.`usuario_status` (`stu_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `chamado`.`empresa`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `chamado`.`empresa` (
  `emp_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `emp_nome` VARCHAR(80) NOT NULL,
  PRIMARY KEY (`emp_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `chamado`.`chamado_status`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `chamado`.`chamado_status` (
  `stc_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `stc_status` VARCHAR(10) NOT NULL,
  PRIMARY KEY (`stc_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `chamado`.`chamado_nivel`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `chamado`.`chamado_nivel` (
  `cni_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `cni_nivel` VARCHAR(10) NOT NULL,
  PRIMARY KEY (`cni_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `chamado`.`chamado`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `chamado`.`chamado` (
  `cha_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `cha_designacao` VARCHAR(70) NOT NULL,
  `cha_atendente` VARCHAR(45) NOT NULL,
  `cha_protocolo` VARCHAR(45) NOT NULL,
  `cha_data_inicio` DATETIME NOT NULL,
  `cha_data_fim` DATETIME NULL,
  `cha_snitoma` VARCHAR(100) NOT NULL,
  `cha_motivo` VARCHAR(45) NOT NULL,
  `cha_previsao` VARCHAR(45) NULL,
  `cha_empresa` INT UNSIGNED NOT NULL,
  `cha_usuario` INT UNSIGNED NOT NULL,
  `cha_status` INT UNSIGNED NOT NULL,
  `cha_nivel` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`cha_id`),
  INDEX `fk_chamado_empresa1_idx` (`cha_empresa` ASC),
  INDEX `fk_chamado_usuario1_idx` (`cha_usuario` ASC),
  INDEX `fk_chamado_chamado_status1_idx` (`cha_status` ASC),
  INDEX `fk_chamado_chamado_nivel1_idx` (`cha_nivel` ASC),
  CONSTRAINT `fk_chamado_empresa1`
    FOREIGN KEY (`cha_empresa`)
    REFERENCES `chamado`.`empresa` (`emp_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_chamado_usuario1`
    FOREIGN KEY (`cha_usuario`)
    REFERENCES `chamado`.`usuario` (`usu_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_chamado_chamado_status1`
    FOREIGN KEY (`cha_status`)
    REFERENCES `chamado`.`chamado_status` (`stc_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_chamado_chamado_nivel1`
    FOREIGN KEY (`cha_nivel`)
    REFERENCES `chamado`.`chamado_nivel` (`cni_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `chamado`.`pendencia_nivel`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `chamado`.`pendencia_nivel` (
  `niv_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `niv_nivel` VARCHAR(10) NOT NULL,
  PRIMARY KEY (`niv_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `chamado`.`pendencia_status`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `chamado`.`pendencia_status` (
  `stc_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `stc_status` VARCHAR(10) NOT NULL,
  PRIMARY KEY (`stc_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `chamado`.`pendencia`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `chamado`.`pendencia` (
  `pen_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `pen_descricao` TEXT NOT NULL,
  `pen_titulo` VARCHAR(100) NOT NULL,
  `pen_data_inicio` DATETIME NOT NULL,
  `pen_data_fim` DATETIME NOT NULL,
  `pen_data_previsao` DATETIME NOT NULL,
  `pen_usuario` INT UNSIGNED NOT NULL,
  `pen_nivel` INT UNSIGNED NOT NULL,
  `pen_status` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`pen_id`),
  INDEX `fk_pendencia_usuario1_idx` (`pen_usuario` ASC),
  INDEX `fk_pendencia_nivel1_idx` (`pen_nivel` ASC),
  INDEX `fk_pendencia_pendencia_status1_idx` (`pen_status` ASC),
  CONSTRAINT `fk_pendencia_usuario1`
    FOREIGN KEY (`pen_usuario`)
    REFERENCES `chamado`.`usuario` (`usu_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_pendencia_nivel1`
    FOREIGN KEY (`pen_nivel`)
    REFERENCES `chamado`.`pendencia_nivel` (`niv_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_pendencia_pendencia_status1`
    FOREIGN KEY (`pen_status`)
    REFERENCES `chamado`.`pendencia_status` (`stc_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `chamado`.`estado`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `chamado`.`estado` (
  `est_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `est_sigla` CHAR(2) NOT NULL,
  PRIMARY KEY (`est_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `chamado`.`cidade`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `chamado`.`cidade` (
  `cid_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `cid_nome` VARCHAR(15) NOT NULL,
  `cid_estado` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`cid_id`),
  INDEX `fk_cidade_estado1_idx` (`cid_estado` ASC),
  CONSTRAINT `fk_cidade_estado1`
    FOREIGN KEY (`cid_estado`)
    REFERENCES `chamado`.`estado` (`est_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `chamado`.`filial`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `chamado`.`filial` (
  `fil_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `fil_nome` VARCHAR(45) NULL,
  `fil_numero` INT NOT NULL,
  `fil_cidade` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`fil_id`),
  INDEX `fk_filial_cidade1_idx` (`fil_cidade` ASC),
  CONSTRAINT `fk_filial_cidade1`
    FOREIGN KEY (`fil_cidade`)
    REFERENCES `chamado`.`cidade` (`cid_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `chamado`.`comentario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `chamado`.`comentario` (
  `com_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `com_comentario` TEXT NOT NULL,
  `com_usuario` INT UNSIGNED NOT NULL,
  `com_pendencia` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`com_id`),
  INDEX `fk_comentario_usuario1_idx` (`com_usuario` ASC),
  INDEX `fk_comentario_pendencia1_idx` (`com_pendencia` ASC),
  CONSTRAINT `fk_comentario_usuario1`
    FOREIGN KEY (`com_usuario`)
    REFERENCES `chamado`.`usuario` (`usu_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_comentario_pendencia1`
    FOREIGN KEY (`com_pendencia`)
    REFERENCES `chamado`.`pendencia` (`pen_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `chamado`.`funcionalidade`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `chamado`.`funcionalidade` (
  `fun_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `fun_funcionalidade` VARCHAR(10) NOT NULL,
  PRIMARY KEY (`fun_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `chamado`.`permissoes`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `chamado`.`permissoes` (
  `perm_id` INT NOT NULL AUTO_INCREMENT,
  `perm_cadastrar` TINYINT(1) NOT NULL,
  `perm_listar` TINYINT(1) NOT NULL,
  `perm_editar` TINYINT(1) NOT NULL,
  `perm_funcionalidade` INT UNSIGNED NOT NULL,
  `perm_perfil` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`perm_id`),
  INDEX `fk_permissoes_funcionalidade1_idx` (`perm_funcionalidade` ASC),
  INDEX `fk_permissoes_perfil1_idx` (`perm_perfil` ASC),
  CONSTRAINT `fk_permissoes_funcionalidade1`
    FOREIGN KEY (`perm_funcionalidade`)
    REFERENCES `chamado`.`funcionalidade` (`fun_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_permissoes_perfil1`
    FOREIGN KEY (`perm_perfil`)
    REFERENCES `chamado`.`perfil` (`per_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `chamado`.`chamado_filial`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `chamado`.`chamado_filial` (
  `chf_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `chf_chamado` INT UNSIGNED NOT NULL,
  `chf_filial` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`chf_id`),
  INDEX `fk_chamado_filial_chamado1_idx` (`chf_chamado` ASC),
  INDEX `fk_chamado_filial_filial1_idx` (`chf_filial` ASC),
  CONSTRAINT `fk_chamado_filial_chamado1`
    FOREIGN KEY (`chf_chamado`)
    REFERENCES `chamado`.`chamado` (`cha_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_chamado_filial_filial1`
    FOREIGN KEY (`chf_filial`)
    REFERENCES `chamado`.`filial` (`fil_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

-- -----------------------------------------------------
-- Data for table `chamado`.`perfil`
-- -----------------------------------------------------
START TRANSACTION;
USE `chamado`;
INSERT INTO `chamado`.`perfil` (`per_id`, `per_perfil`) VALUES (1, 'Administrador');

COMMIT;


-- -----------------------------------------------------
-- Data for table `chamado`.`usuario_status`
-- -----------------------------------------------------
START TRANSACTION;
USE `chamado`;
INSERT INTO `chamado`.`usuario_status` (`stu_id`, `stu_status`) VALUES (1, 'ativo');
INSERT INTO `chamado`.`usuario_status` (`stu_id`, `stu_status`) VALUES (2, 'inativo');

COMMIT;


-- -----------------------------------------------------
-- Data for table `chamado`.`usuario`
-- -----------------------------------------------------
START TRANSACTION;
USE `chamado`;
INSERT INTO `chamado`.`usuario` (`usu_id`, `usu_nome`, `usu_login`, `usu_senha`, `usu_perfil`, `usu_status`) VALUES (1, 'Ramon Lima', 'ramonlima', 'senha', 1, 1);

COMMIT;


-- -----------------------------------------------------
-- Data for table `chamado`.`estado`
-- -----------------------------------------------------
START TRANSACTION;
USE `chamado`;
INSERT INTO `chamado`.`estado` (`est_id`, `est_sigla`) VALUES (1, 'PA');

COMMIT;


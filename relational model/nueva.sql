-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema mydb k
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema bd
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema bd
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `bd` DEFAULT CHARACTER SET latin1 ;
USE `bd` ;

-- -----------------------------------------------------
-- Table `bd`.`cargo`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `bd`.`cargo` ;

CREATE TABLE IF NOT EXISTS `bd`.`cargo` (
  `idCargos` INT(11) NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NOT NULL,
  `nivel` INT(11) NOT NULL,
  PRIMARY KEY (`idCargos`))
ENGINE = InnoDB
AUTO_INCREMENT = 3
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `bd`.`seccional`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `bd`.`seccional` ;

CREATE TABLE IF NOT EXISTS `bd`.`seccional` (
  `idSeccional` INT(11) NOT NULL AUTO_INCREMENT,
  `ciudad` VARCHAR(45) NOT NULL,
  `pais` VARCHAR(45) NOT NULL,
  `departamento` VARCHAR(45) NOT NULL,
  `direccion` VARCHAR(45) NOT NULL,
  `liderProceso` VARCHAR(45) NOT NULL,
  `Tipo` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idSeccional`))
ENGINE = InnoDB
AUTO_INCREMENT = 4
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `bd`.`empleado`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `bd`.`empleado` ;

CREATE TABLE IF NOT EXISTS `bd`.`empleado` (
  `cedula` BIGINT(50) NOT NULL,
  `nombre` VARCHAR(45) NOT NULL,
  `apellido` VARCHAR(45) NOT NULL,
  `email` VARCHAR(45) NOT NULL,
  `telefono` VARCHAR(45) NOT NULL,
  `direccion` VARCHAR(45) NOT NULL,
  `numero` VARCHAR(45) NOT NULL,
  `sexo` VARCHAR(3) NOT NULL,
  `idSeccional` INT(11) NOT NULL,
  `cargo_idCargos` INT(11) NOT NULL,
  PRIMARY KEY (`cedula`),
  INDEX `fk_empleado_seccional1_idx` (`idSeccional` ASC),
  INDEX `fk_empleado_cargo1_idx` (`cargo_idCargos` ASC),
  CONSTRAINT `fk_empleado_cargo1`
    FOREIGN KEY (`cargo_idCargos`)
    REFERENCES `bd`.`cargo` (`idCargos`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_empleado_seccional1`
    FOREIGN KEY (`idSeccional`)
    REFERENCES `bd`.`seccional` (`idSeccional`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `bd`.`cuenta`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `bd`.`cuenta` ;

CREATE TABLE IF NOT EXISTS `bd`.`cuenta` (
  `contrasena` VARCHAR(45) NOT NULL,
  `cedula` BIGINT(50) NOT NULL,
  PRIMARY KEY (`cedula`),
  INDEX `fk_cuenta_empleado1_idx` (`cedula` ASC),
  CONSTRAINT `fk_cuenta_empleado1`
    FOREIGN KEY (`cedula`)
    REFERENCES `bd`.`empleado` (`cedula`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `bd`.`registro`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `bd`.`registro` ;

CREATE TABLE IF NOT EXISTS `bd`.`registro` (
  `idRegistro` INT(11) NOT NULL,
  `fecha` DATETIME NOT NULL,
  PRIMARY KEY (`idRegistro`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `bd`.`Documento`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `bd`.`Documento` ;

CREATE TABLE IF NOT EXISTS `bd`.`Documento` (
  `idDocumento` INT NOT NULL,
  `nombre` VARCHAR(45) NOT NULL,
  `tipo` VARCHAR(20) NOT NULL COMMENT 'pueden ser, manuales, guías, procedimientos, instructivos o acuerdos.',
  `fecha_creacion` DATE NOT NULL,
  `fecha_aprobacion` DATE NOT NULL,
  `fecha_publicacion` DATE NOT NULL,
  PRIMARY KEY (`idDocumento`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bd`.`Macroproceso`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `bd`.`Macroproceso` ;

CREATE TABLE IF NOT EXISTS `bd`.`Macroproceso` (
  `id` INT NOT NULL,
  `Nombrel` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bd`.`Proceso`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `bd`.`Proceso` ;

CREATE TABLE IF NOT EXISTS `bd`.`Proceso` (
  `id` INT NOT NULL,
  `Nombre` VARCHAR(45) NOT NULL,
  `Macroproceso_id` INT NOT NULL,
  `Tipo` VARCHAR(45) NOT NULL COMMENT 'Puede ser crear/actualizar/eliminar/aprovar\n',
  `Estado` VARCHAR(15) NOT NULL COMMENT 'Aprobado/No aprobado/Pendiente',
  PRIMARY KEY (`id`),
  INDEX `fk_Proceso_Macroproceso1_idx` (`Macroproceso_id` ASC),
  CONSTRAINT `fk_Proceso_Macroproceso1`
    FOREIGN KEY (`Macroproceso_id`)
    REFERENCES `bd`.`Macroproceso` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bd`.`Regristro_de_procesos`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `bd`.`Regristro_de_procesos` ;

CREATE TABLE IF NOT EXISTS `bd`.`Regristro_de_procesos` (
  `idRegistro` INT(11) NOT NULL,
  `cedula` BIGINT(50) NOT NULL,
  `Hora` TIME NOT NULL,
  `Descripción` VARCHAR(100) NULL,
  `idDocumento` INT NOT NULL,
  `idProceso` INT NOT NULL,
  PRIMARY KEY (`idRegistro`),
  INDEX `fk_registro_has_cuenta_registro1_idx` (`idRegistro` ASC),
  INDEX `fk_registro_has_cuenta_cuenta1_idx` (`cedula` ASC),
  INDEX `fk_registro_has_cuenta_Documento1_idx` (`idDocumento` ASC),
  INDEX `fk_registro_has_cuenta_Proceso1_idx` (`idProceso` ASC),
  CONSTRAINT `fk_registro_has_cuenta_registro1`
    FOREIGN KEY (`idRegistro`)
    REFERENCES `bd`.`registro` (`idRegistro`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_registro_has_cuenta_cuenta1`
    FOREIGN KEY (`cedula`)
    REFERENCES `bd`.`cuenta` (`cedula`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_registro_has_cuenta_Documento1`
    FOREIGN KEY (`idDocumento`)
    REFERENCES `bd`.`Documento` (`idDocumento`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_registro_has_cuenta_Proceso1`
    FOREIGN KEY (`idProceso`)
    REFERENCES `bd`.`Proceso` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

-- MySQL Script generated by MySQL Workbench
-- Tue Nov 30 16:18:55 2021
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema talento_ti
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema talento_ti
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `talento_ti` DEFAULT CHARACTER SET utf8 ;
USE `talento_ti` ;

-- -----------------------------------------------------
-- Table `talento_ti`.`usuarios`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `talento_ti`.`usuarios` (
  `id_usuario` INT NOT NULL AUTO_INCREMENT,
  `email` VARCHAR(100) NULL,
  `password` VARCHAR(100) NULL,
  PRIMARY KEY (`id_usuario`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `talento_ti`.`estados`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `talento_ti`.`estados` (
  `id_estado` INT NOT NULL AUTO_INCREMENT,
  `nombre_estado` VARCHAR(200) NULL,
  `descripcion_estado` VARCHAR(200) NULL,
  `tabla` VARCHAR(50) NULL,
  PRIMARY KEY (`id_estado`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `talento_ti`.`tipos_personas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `talento_ti`.`tipos_personas` (
  `id_tipo_persona` INT NOT NULL AUTO_INCREMENT,
  `descripcion_tipo` VARCHAR(200) NULL,
  `id_estado` INT NULL,
  PRIMARY KEY (`id_tipo_persona`),
  INDEX `fk_id_estado_tipo_idx` (`id_estado` ASC),
  CONSTRAINT `fk_id_estado_tipo`
    FOREIGN KEY (`id_estado`)
    REFERENCES `talento_ti`.`estados` (`id_estado`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `talento_ti`.`personas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `talento_ti`.`personas` (
  `id_persona` INT NOT NULL AUTO_INCREMENT,
  `nombre_razonsocial` VARCHAR(200) NULL,
  `apellidos` VARCHAR(200) NULL,
  `id_usuario` INT NULL,
  `rut` VARCHAR(45) NULL,
  `direccion` VARCHAR(200) NULL,
  `comuna` VARCHAR(45) NULL,
  `ciudad` VARCHAR(45) NULL,
  `region` VARCHAR(45) NULL,
  `pais` VARCHAR(45) NULL,
  `telefono` VARCHAR(45) NULL,
  `email` VARCHAR(200) NULL,
  `id_tipo_persona` INT NULL,
  PRIMARY KEY (`id_persona`),
  INDEX `id_usuario_idx` (`id_usuario` ASC),
  INDEX `fk_id_tipo_persona_idx` (`id_tipo_persona` ASC),
  CONSTRAINT `fk_id_usuario`
    FOREIGN KEY (`id_usuario`)
    REFERENCES `talento_ti`.`usuarios` (`id_usuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_id_tipo_persona`
    FOREIGN KEY (`id_tipo_persona`)
    REFERENCES `talento_ti`.`tipos_personas` (`id_tipo_persona`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `talento_ti`.`roles`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `talento_ti`.`roles` (
  `id_rol` INT NOT NULL AUTO_INCREMENT,
  `nombre_rol` VARCHAR(100) NULL,
  `id_estado` INT NULL,
  PRIMARY KEY (`id_rol`),
  INDEX `fk_id_estado_idx` (`id_estado` ASC),
  CONSTRAINT `fk_id_estado`
    FOREIGN KEY (`id_estado`)
    REFERENCES `talento_ti`.`estados` (`id_estado`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `talento_ti`.`usuarios_roles`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `talento_ti`.`usuarios_roles` (
  `id_usuario_rol` INT NOT NULL AUTO_INCREMENT,
  `id_usuario` INT NULL,
  `id_rol` INT NULL,
  PRIMARY KEY (`id_usuario_rol`),
  INDEX `id_usuario_idx` (`id_usuario` ASC),
  INDEX `fk_id_rol_idx` (`id_rol` ASC),
  CONSTRAINT `fk_id_usuario_rol`
    FOREIGN KEY (`id_usuario`)
    REFERENCES `talento_ti`.`usuarios` (`id_usuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_id_rol`
    FOREIGN KEY (`id_rol`)
    REFERENCES `talento_ti`.`roles` (`id_rol`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `talento_ti`.`habilidades`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `talento_ti`.`habilidades` (
  `id_habilidad` INT NOT NULL AUTO_INCREMENT,
  `nombre_habilidad` VARCHAR(45) NULL,
  `grupo` VARCHAR(45) NULL,
  PRIMARY KEY (`id_habilidad`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `talento_ti`.`habilidades_personas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `talento_ti`.`habilidades_personas` (
  `id_habilidad_persona` INT NOT NULL AUTO_INCREMENT,
  `id_persona` INT NULL,
  `id_habilidad` INT NULL,
  `nivel` INT NULL,
  PRIMARY KEY (`id_habilidad_persona`),
  INDEX `fk_id_persona_idx` (`id_persona` ASC),
  INDEX `fk_id_habilidad_idx` (`id_habilidad` ASC),
  CONSTRAINT `fk_id_persona`
    FOREIGN KEY (`id_persona`)
    REFERENCES `talento_ti`.`personas` (`id_persona`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_id_habilidad`
    FOREIGN KEY (`id_habilidad`)
    REFERENCES `talento_ti`.`habilidades` (`id_habilidad`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `talento_ti`.`ofertas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `talento_ti`.`ofertas` (
  `id_oferta` INT NOT NULL AUTO_INCREMENT,
  `nombre_oferta` VARCHAR(200) NULL,
  `descripcion` VARCHAR(2000) NULL,
  `fecha_oferta` DATETIME NULL,
  `comentarios` VARCHAR(2000) NULL,
  `url_documento` VARCHAR(200) NULL,
  `id_proyecto` VARCHAR(45) NULL,
  `tipo_proyecto` VARCHAR(45) NULL,
  PRIMARY KEY (`id_oferta`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `talento_ti`.`ofertas_personas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `talento_ti`.`ofertas_personas` (
  `id_oferta_persona` INT NOT NULL AUTO_INCREMENT,
  `id_persona` INT NULL,
  `id_oferta` INT NULL,
  `id_estado` INT NULL,

  PRIMARY KEY (`id_oferta_persona`),
  INDEX `fk_id_persona_idx` (`id_persona` ASC),
  INDEX `fk_id_oferta_idx` (`id_oferta` ASC),
  INDEX `fk_id_estado_ofertas_personas` (`id_estado` ASC),
  CONSTRAINT `fk_id_persona_oferta`
    FOREIGN KEY (`id_persona`)
    REFERENCES `talento_ti`.`personas` (`id_persona`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_id_oferta`
    FOREIGN KEY (`id_oferta`)
    REFERENCES `talento_ti`.`ofertas` (`id_oferta`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_id_estado_ofertas_personas`
    FOREIGN KEY (`id_estado`)
    REFERENCES `talento_ti`.`estados` (`id_estado`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `talento_ti`.`solicitudes`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `talento_ti`.`solicitudes` (
  `id_solicitud` INT NOT NULL AUTO_INCREMENT,
  `id_oferta` INT NULL,
  `id_persona_prof` INT NULL,
  `id_persona_emp` INT NULL,
  `id_estado` INT NULL,
  `fecha_solicitud` DATETIME NULL,
  PRIMARY KEY (`id_solicitud`),
  INDEX `fk_id_oferta_idx` (`id_oferta` ASC),
  INDEX `fk_id_persona_prof_idx` (`id_persona_prof` ASC),
  INDEX `fk_id_persona_emp_idx` (`id_persona_emp` ASC),
  INDEX `fk_id_estado_idx` (`id_estado` ASC),
  CONSTRAINT `fk_id_oferta_solicitud`
    FOREIGN KEY (`id_oferta`)
    REFERENCES `talento_ti`.`ofertas` (`id_oferta`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_id_persona_prof`
    FOREIGN KEY (`id_persona_prof`)
    REFERENCES `talento_ti`.`personas` (`id_persona`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_id_persona_emp`
    FOREIGN KEY (`id_persona_emp`)
    REFERENCES `talento_ti`.`personas` (`id_persona`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_id_estado_solicitud`
    FOREIGN KEY (`id_estado`)
    REFERENCES `talento_ti`.`estados` (`id_estado`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `talento_ti`.`ofertas_habilidades`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `talento_ti`.`ofertas_habilidades` (
  `id_oferta_habilidad` INT NOT NULL AUTO_INCREMENT,
  `id_oferta` INT NULL,
  `id_habilidad` INT NULL,
  PRIMARY KEY (`id_oferta_habilidad`),
  INDEX `fk_id_oferta_idx` (`id_oferta` ASC),
  INDEX `fk_id_habilidad_idx` (`id_habilidad` ASC),
  CONSTRAINT `fk_id_oferta_habilidad`
    FOREIGN KEY (`id_oferta`)
    REFERENCES `talento_ti`.`ofertas` (`id_oferta`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_id_habilidad_oferta`
    FOREIGN KEY (`id_habilidad`)
    REFERENCES `talento_ti`.`habilidades` (`id_habilidad`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `talento_ti`.`perfiles`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `talento_ti`.`perfiles` (
  `id_perfil` INT NOT NULL AUTO_INCREMENT,
  `titulo_prof` VARCHAR(200) NULL,
  `resumen` VARCHAR(1000) NULL,
  `url_cv` VARCHAR(45) NULL,
  `disponibilidad` VARCHAR(45) NULL,
  `id_persona` INT NULL,
  `plazo_proyecto` VARCHAR(45) NULL,
  PRIMARY KEY (`id_perfil`),
  INDEX `fk_id_persona_perfil_idx` (`id_persona` ASC),
  CONSTRAINT `fk_id_persona_perfil`
    FOREIGN KEY (`id_persona`)
    REFERENCES `talento_ti`.`personas` (`id_persona`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
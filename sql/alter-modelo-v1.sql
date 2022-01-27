-- MySQL Workbench Synchronization
-- Generated: 2021-12-22 11:28
-- Model: New Model
-- Version: 1.0
-- Project: Name of the project
-- Author: Carlos Palma

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

ALTER SCHEMA `talento_ti`  DEFAULT CHARACTER SET utf8  DEFAULT COLLATE utf8_general_ci ;

ALTER TABLE `talento_ti`.`usuarios` 
CHARACTER SET = utf8 , COLLATE = utf8_general_ci ,
ADD COLUMN `ultimo_login` DATETIME NULL DEFAULT NULL AFTER `password`;

ALTER TABLE `talento_ti`.`personas` 
CHARACTER SET = utf8 , COLLATE = utf8_general_ci ,
ADD COLUMN `sitio_web` VARCHAR(200) NULL DEFAULT NULL AFTER `id_tipo_persona`,
ADD COLUMN `giro` VARCHAR(200) NULL DEFAULT NULL AFTER `sitio_web`,
ADD COLUMN `fecha_ingreso` DATETIME NULL DEFAULT NULL AFTER `giro`;

ALTER TABLE `talento_ti`.`roles` 
CHARACTER SET = utf8 , COLLATE = utf8_general_ci ;

ALTER TABLE `talento_ti`.`usuarios_roles` 
CHARACTER SET = utf8 , COLLATE = utf8_general_ci ;

ALTER TABLE `talento_ti`.`habilidades` 
CHARACTER SET = utf8 , COLLATE = utf8_general_ci ,
ADD COLUMN `descripcion_habilidad` VARCHAR(1000) NULL DEFAULT NULL AFTER `grupo`,
CHANGE COLUMN `nombre_habilidad` `nombre_habilidad` VARCHAR(100) NULL DEFAULT NULL ;

ALTER TABLE `talento_ti`.`habilidades_personas` 
CHARACTER SET = utf8 , COLLATE = utf8_general_ci ;

ALTER TABLE `talento_ti`.`ofertas` 
CHARACTER SET = utf8 , COLLATE = utf8_general_ci ,
ADD COLUMN `fecha_termino` DATETIME NULL DEFAULT NULL AFTER `tipo_proyecto`;

ALTER TABLE `talento_ti`.`ofertas_personas` 
CHARACTER SET = utf8 , COLLATE = utf8_general_ci ;

ALTER TABLE `talento_ti`.`solicitudes` 
CHARACTER SET = utf8 , COLLATE = utf8_general_ci ;

ALTER TABLE `talento_ti`.`estados` 
CHARACTER SET = utf8 , COLLATE = utf8_general_ci ;

ALTER TABLE `talento_ti`.`ofertas_habilidades` 
CHARACTER SET = utf8 , COLLATE = utf8_general_ci ,
ADD COLUMN `nivel` INT(11) NULL DEFAULT NULL AFTER `id_habilidad`;

ALTER TABLE `talento_ti`.`perfiles` 
CHARACTER SET = utf8 , COLLATE = utf8_general_ci ,
ADD COLUMN `modalidad` VARCHAR(45) NULL DEFAULT NULL AFTER `plazo_proyecto`,
ADD COLUMN `portafolio` VARCHAR(200) NULL DEFAULT NULL AFTER `modalidad`;

ALTER TABLE `talento_ti`.`tipos_personas` 
CHARACTER SET = utf8 , COLLATE = utf8_general_ci ;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;

SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;


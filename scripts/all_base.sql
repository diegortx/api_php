-- MySQL Script generated by MySQL Workbench
-- Wed Aug 16 13:59:43 2023
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema api_php
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema api_php
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `api_php` DEFAULT CHARACTER SET utf8 ;
USE `api_php` ;

-- -----------------------------------------------------
-- Table `api_php`.`tb_clientes`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `api_php`.`tb_clientes` ;

CREATE TABLE IF NOT EXISTS `api_php`.`tb_clientes` (
  `co_seq_clientes` INT NOT NULL AUTO_INCREMENT,
  `no_cliente` VARCHAR(255) NOT NULL,
  `no_email` VARCHAR(255) NOT NULL,
  `no_cidade` VARCHAR(255) NOT NULL,
  `no_estado` VARCHAR(255) NOT NULL,
  `nu_telefone` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`co_seq_clientes`))
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

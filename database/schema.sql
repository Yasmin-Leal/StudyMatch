-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema studymatch
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema studymatch
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `studymatch` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci ;
USE `studymatch` ;

-- -----------------------------------------------------
-- Table `studymatch`.`materias`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `studymatch`.`materias` (
  `id_materia` INT NOT NULL AUTO_INCREMENT,
  `nome_materia` VARCHAR(100) NOT NULL,
  `id_area` INT NULL DEFAULT NULL,
  PRIMARY KEY (`id_materia`),
  INDEX `id_area` (`id_area` ASC) VISIBLE,
  CONSTRAINT `materias_ibfk_1`
    FOREIGN KEY (`id_area`)
    REFERENCES `studymatch`.`area_conhecimento` (`id_area`))
ENGINE = InnoDB
AUTO_INCREMENT = 16
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `studymatch`.`area_conhecimento`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `studymatch`.`area_conhecimento` (
  `id_area` INT NOT NULL AUTO_INCREMENT,
  `nome_area` VARCHAR(100) NOT NULL,
  `id_materia` INT NULL DEFAULT NULL,
  PRIMARY KEY (`id_area`),
  INDEX `fk_area_materia` (`id_materia` ASC) VISIBLE,
  CONSTRAINT `fk_area_materia`
    FOREIGN KEY (`id_materia`)
    REFERENCES `studymatch`.`materias` (`id_materia`))
ENGINE = InnoDB
AUTO_INCREMENT = 5
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `studymatch`.`escolaridade`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `studymatch`.`escolaridade` (
  `id_escolar` INT NOT NULL AUTO_INCREMENT,
  `ano_escolar` VARCHAR(20) NOT NULL,
  PRIMARY KEY (`id_escolar`))
ENGINE = InnoDB
AUTO_INCREMENT = 10
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `studymatch`.`grupos_estudos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `studymatch`.`grupos_estudos` (
  `id_grupo` INT NOT NULL AUTO_INCREMENT,
  `nome_grupo` VARCHAR(100) NOT NULL,
  `data_criacao` DATE NOT NULL,
  `nome_area` VARCHAR(100) NOT NULL,
  `nome_materia` VARCHAR(100) NOT NULL,
  `senha` VARCHAR(20) NOT NULL,
  `status_grupo` VARCHAR(50) NOT NULL,
  `id_imagem` INT NULL DEFAULT NULL,
  `criador` VARCHAR(50) NOT NULL,
  PRIMARY KEY (`id_grupo`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `studymatch`.`lembretes`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `studymatch`.`lembretes` (
  `id_lembrete` INT NOT NULL AUTO_INCREMENT,
  `data_lembrete` DATE NOT NULL,
  `descricao` VARCHAR(200) NOT NULL,
  `nome_usuario` VARCHAR(50) NULL DEFAULT NULL,
  PRIMARY KEY (`id_lembrete`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `studymatch`.`personagens`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `studymatch`.`personagens` (
  `personagem` INT NOT NULL,
  `acessorio` INT NULL DEFAULT NULL,
  `nome_usuario` VARCHAR(50) NULL DEFAULT NULL)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `studymatch`.`usuarios`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `studymatch`.`usuarios` (
  `id_usuario` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(100) NOT NULL,
  `nome_usuario` VARCHAR(50) NOT NULL,
  `email` VARCHAR(120) NOT NULL,
  `data_nascimento` DATE NOT NULL,
  `senha` VARCHAR(10) NOT NULL,
  `telefone` VARCHAR(20) NULL DEFAULT NULL,
  `ano_escolar` VARCHAR(20) NOT NULL,
  `ultimo_resgate` DATE NULL DEFAULT NULL,
  `sequencia_resgate` INT NULL DEFAULT '0',
  PRIMARY KEY (`id_usuario`),
  UNIQUE INDEX `nome_usuario` (`nome_usuario` ASC) VISIBLE,
  UNIQUE INDEX `email` (`email` ASC) VISIBLE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

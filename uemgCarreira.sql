-- MySQL Script generated by MySQL Workbench
-- Sun Jul 11 14:24:24 2021
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema uemg_carreira
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema uemg_carreira
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `uemg_carreira` DEFAULT CHARACTER SET utf8 ;
USE `uemg_carreira` ;

-- -----------------------------------------------------
-- Table `uemg_carreira`.`unidade`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `uemg_carreira`.`unidade` (
  `idUnidade` INT NOT NULL AUTO_INCREMENT,
  `unidadeNome` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idUnidade`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `uemg_carreira`.`curso`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `uemg_carreira`.`curso` (
  `idCurso` INT NOT NULL AUTO_INCREMENT,
  `cursoNome` VARCHAR(45) NULL,
  PRIMARY KEY (`idCurso`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `uemg_carreira`.`aluno`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `uemg_carreira`.`aluno` (
  `idAluno` INT NOT NULL AUTO_INCREMENT,
  `alunoNome` VARCHAR(255) NOT NULL,
  `alunoTel` VARCHAR(15) NOT NULL,
  `alunoDataNascimento` DATE NOT NULL,
  `alunoCPF` VARCHAR(15) NOT NULL,
  `alunoEmail` VARCHAR(45) NOT NULL,
  `alunoSenha` VARCHAR(45) NOT NULL,
  `unidade_idUnidade` INT NOT NULL,
  `curso_idCurso` INT NOT NULL,
  PRIMARY KEY (`idAluno`, `unidade_idUnidade`, `curso_idCurso`),
  INDEX `fk_aluno_unidade1_idx` (`unidade_idUnidade` ASC),
  INDEX `fk_aluno_curso1_idx` (`curso_idCurso` ASC),
  CONSTRAINT `fk_aluno_unidade1`
    FOREIGN KEY (`unidade_idUnidade`)
    REFERENCES `uemg_carreira`.`unidade` (`idUnidade`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_aluno_curso1`
    FOREIGN KEY (`curso_idCurso`)
    REFERENCES `uemg_carreira`.`curso` (`idCurso`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `uemg_carreira`.`professor`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `uemg_carreira`.`professor` (
  `idProfessor` INT NOT NULL AUTO_INCREMENT,
  `professorNome` VARCHAR(255) NOT NULL,
  `professorTel` VARCHAR(15) NOT NULL,
  `professorDataNascimento` DATE NOT NULL,
  `professorCPF` VARCHAR(15) NOT NULL,
  `professorEmail` VARCHAR(45) NOT NULL,
  `professorSenha` VARCHAR(45) NOT NULL,
  `professorMateria` VARCHAR(45) NULL,
  `unidade_idUnidade` INT NOT NULL,
  `professorLattes` VARCHAR(45) NOT NULL,
  `professorInfo` LONGTEXT NULL,
  `professorCoord` TINYINT ZEROFILL NOT NULL,
  PRIMARY KEY (`idProfessor`, `unidade_idUnidade`),
  INDEX `fk_professor_unidade1_idx` (`unidade_idUnidade` ASC),
  CONSTRAINT `fk_professor_unidade1`
    FOREIGN KEY (`unidade_idUnidade`)
    REFERENCES `uemg_carreira`.`unidade` (`idUnidade`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `uemg_carreira`.`planoCarreira`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `uemg_carreira`.`planoCarreira` (
  `idPlanoCarreira` INT NOT NULL AUTO_INCREMENT,
  `planoCarreiraInfo` LONGTEXT NULL,
  `professor_idProfessor` INT NOT NULL,
  `aluno_idAluno` INT NOT NULL,
  `planoCarreiraDtaPedido` DATETIME NOT NULL DEFAULT NOW(),
  `planoCarreiraStatus` TINYINT ZEROFILL NOT NULL,
  PRIMARY KEY (`idPlanoCarreira`, `professor_idProfessor`, `aluno_idAluno`),
  INDEX `fk_planoCarreira_professor1_idx` (`professor_idProfessor` ASC),
  INDEX `fk_planoCarreira_aluno1_idx` (`aluno_idAluno` ASC),
  CONSTRAINT `fk_planoCarreira_professor1`
    FOREIGN KEY (`professor_idProfessor`)
    REFERENCES `uemg_carreira`.`professor` (`idProfessor`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_planoCarreira_aluno1`
    FOREIGN KEY (`aluno_idAluno`)
    REFERENCES `uemg_carreira`.`aluno` (`idAluno`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `uemg_carreira`.`curso_has_professor`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `uemg_carreira`.`curso_has_professor` (
  `curso_idCurso` INT NOT NULL,
  `professor_idProfessor` INT NOT NULL,
  PRIMARY KEY (`curso_idCurso`, `professor_idProfessor`),
  INDEX `fk_curso_has_professor_professor1_idx` (`professor_idProfessor` ASC),
  INDEX `fk_curso_has_professor_curso_idx` (`curso_idCurso` ASC),
  CONSTRAINT `fk_curso_has_professor_curso`
    FOREIGN KEY (`curso_idCurso`)
    REFERENCES `uemg_carreira`.`curso` (`idCurso`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_curso_has_professor_professor1`
    FOREIGN KEY (`professor_idProfessor`)
    REFERENCES `uemg_carreira`.`professor` (`idProfessor`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

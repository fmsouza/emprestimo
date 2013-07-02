SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

DROP SCHEMA IF EXISTS `emprestimos` ;
CREATE SCHEMA IF NOT EXISTS `emprestimos` ;
USE `emprestimos` ;

-- -----------------------------------------------------
-- Table `emprestimos`.`acervo_categoria`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `emprestimos`.`acervo_categoria` ;

CREATE  TABLE IF NOT EXISTS `emprestimos`.`acervo_categoria` (
  `id` VARCHAR(9) NOT NULL ,
  `titulo` TEXT NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `emprestimos`.`acervo_item`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `emprestimos`.`acervo_item` ;

CREATE  TABLE IF NOT EXISTS `emprestimos`.`acervo_item` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `acervo_categoria_id` VARCHAR(9) NOT NULL ,
  `titulo` TEXT NOT NULL ,
  `ano` INT(11) NOT NULL ,
  `editora` VARCHAR(50) NULL DEFAULT NULL ,
  `prazo` INT(11) NOT NULL ,
  `keywords` TEXT NOT NULL ,
  `valor` DOUBLE NULL ,
  `patrimonio` VARCHAR(10) NULL DEFAULT NULL ,
  `autor` VARCHAR(50) NULL DEFAULT NULL ,
  `marca` VARCHAR(50) NULL DEFAULT NULL ,
  `registro` VARCHAR(10) NULL DEFAULT NULL ,
  `descricao` TEXT NOT NULL ,
  `local_publicacao` TEXT NOT NULL ,
  `extensao` TEXT NOT NULL ,
  `notacao` TEXT NOT NULL ,
  PRIMARY KEY (`id`, `acervo_categoria_id`) ,
  INDEX `fk_acervo_item_acervo_categoria1` (`acervo_categoria_id` ASC) ,
  CONSTRAINT `fk_acervo_item_acervo_categoria1`
    FOREIGN KEY (`acervo_categoria_id` )
    REFERENCES `emprestimos`.`acervo_categoria` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `emprestimos`.`acervo_exemplar`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `emprestimos`.`acervo_exemplar` ;

CREATE  TABLE IF NOT EXISTS `emprestimos`.`acervo_exemplar` (
  `codigo` VARCHAR(9) NOT NULL ,
  `data_inclusao` DATE NOT NULL ,
  `acervo_item_id` INT(11) NOT NULL ,
  PRIMARY KEY (`codigo`, `acervo_item_id`) ,
  INDEX `fk_acervo_exemplar_acervo_item1` (`acervo_item_id` ASC) ,
  CONSTRAINT `fk_acervo_exemplar_acervo_item1`
    FOREIGN KEY (`acervo_item_id` )
    REFERENCES `emprestimos`.`acervo_item` (`id` )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `emprestimos`.`emprestimo_finalidade`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `emprestimos`.`emprestimo_finalidade` ;

CREATE  TABLE IF NOT EXISTS `emprestimos`.`emprestimo_finalidade` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `titulo` TEXT NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `emprestimos`.`nivel_usuario`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `emprestimos`.`nivel_usuario` ;

CREATE  TABLE IF NOT EXISTS `emprestimos`.`nivel_usuario` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `nome` TEXT NOT NULL ,
  `ver_usuario` TINYINT(1) NOT NULL DEFAULT '0' ,
  `editar_usuario` TINYINT(1) NOT NULL DEFAULT '0' ,
  `ver_categoria` TINYINT(1) NOT NULL DEFAULT '0' ,
  `editar_categoria` TINYINT(1) NOT NULL DEFAULT '0' ,
  `editar_acervo` TINYINT(1) NOT NULL DEFAULT '0' ,
  `deferir_emprestimo` TINYINT(1) NOT NULL DEFAULT '0' ,
  `apagar_usuario` TINYINT(1) NOT NULL DEFAULT '0' ,
  `apagar_acervo` TINYINT(1) NOT NULL DEFAULT '0' ,
  `cancelar_emprestimo` TINYINT(1) NOT NULL DEFAULT '0' ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
AUTO_INCREMENT = 3
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `emprestimos`.`usuario`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `emprestimos`.`usuario` ;

CREATE  TABLE IF NOT EXISTS `emprestimos`.`usuario` (
  `cpf` VARCHAR(14) NOT NULL ,
  `nivel_usuario_id` INT(11) NOT NULL DEFAULT '3' ,
  `nome` TEXT NOT NULL ,
  `identidade` VARCHAR(9) NOT NULL ,
  `dre` VARCHAR(9) NULL DEFAULT NULL ,
  `siape` VARCHAR(15) NULL DEFAULT NULL ,
  `senha` TEXT NOT NULL ,
  `endereco` TEXT NOT NULL ,
  `profissao` TEXT NOT NULL ,
  `email` TEXT NOT NULL ,
  `email_alternativo` TEXT NULL DEFAULT NULL ,
  `tel_fixo` VARCHAR(13) NOT NULL ,
  `tel_comercial` VARCHAR(13) NULL DEFAULT NULL ,
  `tel_celular` VARCHAR(13) NOT NULL ,
  PRIMARY KEY (`cpf`, `nivel_usuario_id`) ,
  INDEX `fk_usuario_nivel_usuario1` (`nivel_usuario_id` ASC) ,
  CONSTRAINT `fk_usuario_nivel_usuario1`
    FOREIGN KEY (`nivel_usuario_id` )
    REFERENCES `emprestimos`.`nivel_usuario` (`id` )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `emprestimos`.`formulario_emprestimo`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `emprestimos`.`formulario_emprestimo` ;

CREATE  TABLE IF NOT EXISTS `emprestimos`.`formulario_emprestimo` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `usuario_cpf` VARCHAR(14) NOT NULL ,
  `emprestimo_finalidade_id` INT(11) NOT NULL ,
  `data_emprestimo` DATE NOT NULL ,
  `data_devolucao` DATE NOT NULL ,
  `acervo_exemplar_codigo` VARCHAR(9) NOT NULL ,
  `devolvido` TINYINT(1) NOT NULL DEFAULT '0' ,
  `retirado` TINYINT(1) NOT NULL DEFAULT '0' ,
  PRIMARY KEY (`id`, `usuario_cpf`, `emprestimo_finalidade_id`, `acervo_exemplar_codigo`) ,
  INDEX `fk_formulario_emprestimo_emprestimo_finalidade1` (`emprestimo_finalidade_id` ASC) ,
  INDEX `fk_formulario_emprestimo_acervo_exemplar1` (`acervo_exemplar_codigo` ASC) ,
  INDEX `fk_formulario_emprestimo_usuario1_idx` (`usuario_cpf` ASC) ,
  CONSTRAINT `fk_formulario_emprestimo_acervo_exemplar1`
    FOREIGN KEY (`acervo_exemplar_codigo` )
    REFERENCES `emprestimos`.`acervo_exemplar` (`codigo` )
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_formulario_emprestimo_emprestimo_finalidade1`
    FOREIGN KEY (`emprestimo_finalidade_id` )
    REFERENCES `emprestimos`.`emprestimo_finalidade` (`id` )
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_formulario_emprestimo_usuario1`
    FOREIGN KEY (`usuario_cpf` )
    REFERENCES `emprestimos`.`usuario` (`cpf` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `emprestimos`.`emprestimo_deferimento`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `emprestimos`.`emprestimo_deferimento` ;

CREATE  TABLE IF NOT EXISTS `emprestimos`.`emprestimo_deferimento` (
  `deferido` TINYINT(1) NOT NULL DEFAULT '0' ,
  `formulario_emprestimo_id` INT(11) NOT NULL ,
  `formulario_emprestimo_usuario_cpf` VARCHAR(14) NOT NULL ,
  PRIMARY KEY (`formulario_emprestimo_id`, `formulario_emprestimo_usuario_cpf`) ,
  CONSTRAINT `fk_emprestimo_deferimento_formulario_emprestimo1`
    FOREIGN KEY (`formulario_emprestimo_id` , `formulario_emprestimo_usuario_cpf` )
    REFERENCES `emprestimos`.`formulario_emprestimo` (`id` , `usuario_cpf` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

USE `emprestimos` ;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

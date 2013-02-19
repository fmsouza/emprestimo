-- phpMyAdmin SQL Dump
-- version 3.4.11.1deb1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tempo de Geração: 24/01/2013 às 22:34:15
-- Versão do Servidor: 5.5.29
-- Versão do PHP: 5.4.6-1ubuntu1.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "-03:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;


CREATE SCHEMA IF NOT EXISTS emprestimos;
USE esmprestimos;
--
-- Banco de Dados: `emprestimos`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `acervo_categoria`
--

CREATE TABLE IF NOT EXISTS `acervo_categoria` (
  `id` varchar(9) NOT NULL,
  `titulo` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `acervo_categoria`
--

INSERT INTO `acervo_categoria` (`id`, `titulo`) VALUES
('equ', 'Equipamentos'),
('mec', 'Mapas e Cartas'),
('tlea', 'Teses, Livros e Artigos');

-- --------------------------------------------------------

--
-- Estrutura da tabela `acervo_exemplar`
--

CREATE TABLE IF NOT EXISTS `acervo_exemplar` (
  `codigo` varchar(9) NOT NULL,
  `data_inclusao` date NOT NULL,
  `acervo_item_id` int(11) NOT NULL,
  PRIMARY KEY (`codigo`,`acervo_item_id`),
  KEY `fk_acervo_exemplar_acervo_item1` (`acervo_item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `acervo_item`
--

CREATE TABLE IF NOT EXISTS `acervo_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `acervo_categoria_id` varchar(9) NOT NULL,
  `titulo` text,
  `ano` int(11) DEFAULT NULL,
  `editora` varchar(50) DEFAULT NULL,
  `prazo` int(11) DEFAULT NULL,
  `keywords` text,
  `valor` double DEFAULT NULL,
  `patrimonio` varchar(10) DEFAULT NULL,
  `autor` varchar(50) DEFAULT NULL,
  `marca` varchar(50) DEFAULT NULL,
  `registro` varchar(10) DEFAULT NULL,
  `descricao` text NOT NULL,
  PRIMARY KEY (`id`,`acervo_categoria_id`),
  KEY `fk_acervo_item_acervo_categoria1` (`acervo_categoria_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `emprestimo_deferimento`
--

CREATE TABLE IF NOT EXISTS `emprestimo_deferimento` (
  `deferido` tinyint(1) NOT NULL DEFAULT '0',
  `formulario_emprestimo_id` int(11) NOT NULL,
  `formulario_emprestimo_usuario_cpf` varchar(14) NOT NULL,
  PRIMARY KEY (`formulario_emprestimo_id`,`formulario_emprestimo_usuario_cpf`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `emprestimo_finalidade`
--

CREATE TABLE IF NOT EXISTS `emprestimo_finalidade` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `formulario_emprestimo`
--

CREATE TABLE IF NOT EXISTS `formulario_emprestimo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario_cpf` varchar(14) NOT NULL,
  `emprestimo_finalidade_id` int(11) NOT NULL,
  `data_emprestimo` date NOT NULL,
  `data_devolucao` date NOT NULL,
  `acervo_exemplar_codigo` varchar(9) NOT NULL,
  `devolvido` tinyint(1) NOT NULL DEFAULT '0',
  `retirado` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`,`usuario_cpf`,`emprestimo_finalidade_id`,`acervo_exemplar_codigo`),
  KEY `fk_formulario_emprestimo_emprestimo_finalidade1` (`emprestimo_finalidade_id`),
  KEY `fk_formulario_emprestimo_acervo_exemplar1` (`acervo_exemplar_codigo`),
  KEY `fk_formulario_emprestimo_usuario1_idx` (`usuario_cpf`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `nivel_usuario`
--

CREATE TABLE IF NOT EXISTS `nivel_usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` text NOT NULL,
  `ver_usuario` tinyint(1) NOT NULL DEFAULT '0',
  `editar_usuario` tinyint(1) NOT NULL DEFAULT '0',
  `ver_categoria` tinyint(1) NOT NULL DEFAULT '0',
  `editar_categoria` tinyint(1) NOT NULL DEFAULT '0',
  `editar_acervo` tinyint(1) NOT NULL DEFAULT '0',
  `deferir_emprestimo` tinyint(1) NOT NULL DEFAULT '0',
  `apagar_usuario` tinyint(1) NOT NULL DEFAULT '0',
  `apagar_acervo` tinyint(1) NOT NULL DEFAULT '0',
  `cancelar_emprestimo` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3;

--
-- Extraindo dados da tabela `nivel_usuario`
--

INSERT INTO `nivel_usuario` (`id`, `nome`, `ver_usuario`, `editar_usuario`, `ver_categoria`, `editar_categoria`, `editar_acervo`, `deferir_emprestimo`, `apagar_usuario`, `apagar_acervo`, `cancelar_emprestimo`) VALUES
(1, 'Administrador', 1, 1, 1, 1, 1, 1, 1, 1, 1),
(3, 'Usuário', 0, 0, 0, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `cpf` varchar(14) NOT NULL,
  `nivel_usuario_id` int(11) NOT NULL DEFAULT '3',
  `nome` text NOT NULL,
  `identidade` varchar(9) NOT NULL,
  `dre` varchar(9) DEFAULT NULL,
  `siape` varchar(15) DEFAULT NULL,
  `senha` text NOT NULL,
  `endereco` text NOT NULL,
  `profissao` text NOT NULL,
  `email` text NOT NULL,
  `email_alternativo` text,
  `tel_fixo` varchar(13) NOT NULL,
  `tel_comercial` varchar(13) DEFAULT NULL,
  `tel_celular` varchar(13) NOT NULL,
  PRIMARY KEY (`cpf`,`nivel_usuario_id`),
  KEY `fk_usuario_nivel_usuario1` (`nivel_usuario_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`cpf`, `nivel_usuario_id`, `nome`, `identidade`, `dre`, `siape`, `senha`, `endereco`, `profissao`, `email`, `email_alternativo`, `tel_fixo`, `tel_comercial`, `tel_celular`) VALUES
('000.000.000-00', 1, 'Administrador', '000000000', '000000000', '', '123mudar', 'Endereço', 'Administrador', 'administrador@emprestimos.com.br', '', '(00)0000-0000', '', '(00)0000-0000');

--
-- Restrições para as tabelas dumpadas
--

--
-- Restrições para a tabela `acervo_exemplar`
--
ALTER TABLE `acervo_exemplar`
  ADD CONSTRAINT `fk_acervo_exemplar_acervo_item1` FOREIGN KEY (`acervo_item_id`) REFERENCES `acervo_item` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para a tabela `acervo_item`
--
ALTER TABLE `acervo_item`
  ADD CONSTRAINT `fk_acervo_item_acervo_categoria1` FOREIGN KEY (`acervo_categoria_id`) REFERENCES `acervo_categoria` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para a tabela `emprestimo_deferimento`
--
ALTER TABLE `emprestimo_deferimento`
  ADD CONSTRAINT `fk_emprestimo_deferimento_formulario_emprestimo1` FOREIGN KEY (`formulario_emprestimo_id`, `formulario_emprestimo_usuario_cpf`) REFERENCES `formulario_emprestimo` (`id`, `usuario_cpf`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para a tabela `formulario_emprestimo`
--
ALTER TABLE `formulario_emprestimo`
  ADD CONSTRAINT `fk_formulario_emprestimo_acervo_exemplar1` FOREIGN KEY (`acervo_exemplar_codigo`) REFERENCES `acervo_exemplar` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_formulario_emprestimo_emprestimo_finalidade1` FOREIGN KEY (`emprestimo_finalidade_id`) REFERENCES `emprestimo_finalidade` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_formulario_emprestimo_usuario1` FOREIGN KEY (`usuario_cpf`) REFERENCES `usuario` (`cpf`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para a tabela `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `fk_usuario_nivel_usuario1` FOREIGN KEY (`nivel_usuario_id`) REFERENCES `nivel_usuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

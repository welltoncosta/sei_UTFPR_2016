-- phpMyAdmin SQL Dump
-- version 4.0.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tempo de Geração: 03/03/2025 às 14:11
-- Versão do servidor: 5.5.62-0+deb8u1
-- Versão do PHP: 5.4.4-14+deb7u14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Banco de dados: `sei`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `2016_areas`
--

CREATE TABLE IF NOT EXISTS `2016_areas` (
  `id` int(3) NOT NULL,
  `area` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura para tabela `2016_atividades`
--

CREATE TABLE IF NOT EXISTS `2016_atividades` (
  `idAtividade` int(3) NOT NULL AUTO_INCREMENT,
  `atividade` varchar(200) NOT NULL,
  PRIMARY KEY (`idAtividade`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- Estrutura para tabela `2016_avaliacoes_trabalhos`
--

CREATE TABLE IF NOT EXISTS `2016_avaliacoes_trabalhos` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `id_trabalho` varchar(4) NOT NULL,
  `id_parecerista` varchar(4) NOT NULL,
  `nota` varchar(400) NOT NULL,
  `planilha` varchar(500) NOT NULL,
  `avaliacao` text NOT NULL,
  `parecer` varchar(50) NOT NULL,
  `datahora` varchar(50) NOT NULL,
  `hash` varchar(200) NOT NULL,
  `modificado` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=516 ;

-- --------------------------------------------------------

--
-- Estrutura para tabela `2016_banda`
--

CREATE TABLE IF NOT EXISTS `2016_banda` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(400) NOT NULL,
  `estilo` varchar(400) NOT NULL,
  `email` varchar(400) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

-- --------------------------------------------------------

--
-- Estrutura para tabela `2016_campus`
--

CREATE TABLE IF NOT EXISTS `2016_campus` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `campus` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

-- --------------------------------------------------------

--
-- Estrutura para tabela `2016_oficinas`
--

CREATE TABLE IF NOT EXISTS `2016_oficinas` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `nome` varchar(200) NOT NULL,
  `coordenador` varchar(200) NOT NULL,
  `extensionistas` varchar(200) NOT NULL,
  `sala` varchar(200) NOT NULL,
  `vagas` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

-- --------------------------------------------------------

--
-- Estrutura para tabela `2016_oficinas_inscritos`
--

CREATE TABLE IF NOT EXISTS `2016_oficinas_inscritos` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `id_oficina` int(3) NOT NULL,
  `id_participante` int(3) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=120 ;

-- --------------------------------------------------------

--
-- Estrutura para tabela `2016_palestra_inpi`
--

CREATE TABLE IF NOT EXISTS `2016_palestra_inpi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_participante` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=155 ;

-- --------------------------------------------------------

--
-- Estrutura para tabela `2016_participantes`
--

CREATE TABLE IF NOT EXISTS `2016_participantes` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `nome` varchar(200) NOT NULL,
  `cpf` varchar(100) NOT NULL,
  `campus` varchar(200) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `instituicao` varchar(500) NOT NULL,
  `papel` varchar(100) NOT NULL,
  `ra` varchar(500) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(1000) NOT NULL,
  `tipo` varchar(50) NOT NULL,
  `participar` varchar(100) NOT NULL,
  `almocar` varchar(100) NOT NULL,
  `ids_areas` varchar(500) NOT NULL,
  `data_inscricao` varchar(200) NOT NULL,
  `hash` varchar(300) NOT NULL,
  `navegador` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=966 ;

-- --------------------------------------------------------

--
-- Estrutura para tabela `2016_pastas`
--

CREATE TABLE IF NOT EXISTS `2016_pastas` (
  `id` int(3) NOT NULL,
  `pasta` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura para tabela `2016_presencas`
--

CREATE TABLE IF NOT EXISTS `2016_presencas` (
  `idPresenca` int(3) NOT NULL AUTO_INCREMENT,
  `idParticipante` int(3) NOT NULL,
  `nome` varchar(200) NOT NULL,
  `atividade` varchar(500) NOT NULL,
  PRIMARY KEY (`idPresenca`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=592 ;

-- --------------------------------------------------------

--
-- Estrutura para tabela `2016_trabalhos`
--

CREATE TABLE IF NOT EXISTS `2016_trabalhos` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `id_participante` int(3) NOT NULL,
  `id_parecerista` int(3) NOT NULL,
  `parecer` varchar(100) NOT NULL,
  `nota` varchar(10) NOT NULL,
  `reavaliacao` int(1) NOT NULL,
  `id_campus` int(2) NOT NULL,
  `id_area` int(3) NOT NULL,
  `tipo` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `autores` varchar(5000) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `orientador_nome` varchar(200) NOT NULL,
  `orientador_email` varchar(200) NOT NULL,
  `tipoapresentacao` varchar(10) NOT NULL,
  `titulo` varchar(5000) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `resumo` text NOT NULL,
  `trabalho` varchar(5000) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `trabalho_sem_nome` varchar(200) NOT NULL,
  `trab_cript` varchar(200) NOT NULL,
  `palavras_chave` varchar(5000) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `data_envio` varchar(200) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `trabalho_sem_nome_enviado` varchar(100) NOT NULL,
  `hash` varchar(500) NOT NULL,
  `modificado` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=615 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 29-Fev-2016 às 06:12
-- Versão do servidor: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `testelogin`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `userID` int(11) NOT NULL AUTO_INCREMENT,
  `userNome` varchar(255) NOT NULL,
  `userNasc` date NOT NULL,
  `userEmail` varchar(50) NOT NULL,
  `userSenha` varchar(20) NOT NULL,
  `userCidade` varchar(50) NOT NULL,
  `userEstado` varchar(50) NOT NULL,
  `userPais` varchar(50) NOT NULL,
  PRIMARY KEY (`userID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`userID`, `userNome`, `userNasc`, `userEmail`, `userSenha`, `userCidade`, `userEstado`, `userPais`) VALUES
(1, 'Everton', '1996-01-22', 'evertonslaa@hotmail.com', '321', 'Curitiba', 'Parana', 'Brasil'),
(2, 'JoÃ£o da Silva', '1914-07-05', 'jaosilv.s@hotmail.com', '456123', 'Rolandia', 'PR', 'BrasilZIL');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

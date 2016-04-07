SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

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

INSERT INTO `usuario` (`userID`, `userNome`, `userNasc`, `userEmail`, `userSenha`, `userCidade`, `userEstado`, `userPais`) VALUES
(1, 'Everton', '1996-01-22', 'evertonslaa@hotmail.com', '321', 'Curitiba', 'Parana', 'Brasil'),
(2, 'JoÃ£o da Silva', '1914-07-05', 'jaosilv.s@hotmail.com', '456123', 'Cwb', 'PR', 'Brasil');

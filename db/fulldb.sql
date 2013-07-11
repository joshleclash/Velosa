-- phpMyAdmin SQL Dump
-- version 2.9.0.1
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Generation Time: Jul 10, 2013 at 03:04 PM
-- Server version: 5.0.24
-- PHP Version: 5.1.6
-- 
-- Database: `fundicol_veloza`
-- 

-- --------------------------------------------------------

-- 
-- Table structure for table `archivo`
-- 

CREATE TABLE `archivo` (
  `idArchivo` int(11) NOT NULL auto_increment,
  `idUsuario` int(11) NOT NULL,
  `routeFile` varchar(200) NOT NULL,
  `nameFile` varchar(200) NOT NULL,
  `smalldatetime` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `estate` enum('activo','inactivo') NOT NULL,
  `typeFile` varchar(200) NOT NULL,
  `blobFile` longblob NOT NULL,
  `description` text NOT NULL,
  `size` varchar(20) default NULL,
  `idUsuarioUpdate` int(11) default NULL,
  PRIMARY KEY  (`idArchivo`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

-- 
-- Dumping data for table `archivo`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `perfil`
-- 

CREATE TABLE `perfil` (
  `idPerfil` int(11) NOT NULL auto_increment,
  `nombrePerfil` varchar(20) default NULL,
  PRIMARY KEY  (`idPerfil`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

-- 
-- Dumping data for table `perfil`
-- 

INSERT INTO `perfil` VALUES (1, 'Administrador');
INSERT INTO `perfil` VALUES (2, 'Visitante');
INSERT INTO `perfil` VALUES (3, 'Inactivo');

-- --------------------------------------------------------

-- 
-- Table structure for table `proyecto`
-- 

CREATE TABLE `proyecto` (
  `idProyecto` int(11) NOT NULL auto_increment,
  `nombreProyecto` varchar(200) NOT NULL,
  `codigoProyecto` varchar(200) NOT NULL,
  `nombreAuditor` varchar(200) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `mail` varchar(30) NOT NULL,
  `idCreate` int(11) NOT NULL,
  PRIMARY KEY  (`idProyecto`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

-- 
-- Dumping data for table `proyecto`
-- 

INSERT INTO `proyecto` VALUES (5, 'RAKUMIN', '0123456', 'JOHAN CAMARGO', 1, 'johan@mcalgo.com', 1);
INSERT INTO `proyecto` VALUES (4, 'TESTJUAN', '0123456', 'JUAN PABLO VERANO RUSSI', 1, 'joshleclash@gmail.com', 1);

-- --------------------------------------------------------

-- 
-- Table structure for table `usuario`
-- 

CREATE TABLE `usuario` (
  `idUsuario` int(11) NOT NULL auto_increment,
  `idPerfil` int(11) default '2',
  `nombreUsuario` varchar(60) default NULL,
  `apellidoUsuario` varchar(60) default NULL,
  `celular` varchar(20) default NULL,
  `mail` varchar(30) default NULL,
  `clave` varchar(20) default NULL,
  `identificacion` int(15) default NULL,
  `idCreate` int(11) NOT NULL,
  PRIMARY KEY  (`idUsuario`),
  KEY `usuario perfil` (`idPerfil`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

-- 
-- Dumping data for table `usuario`
-- 

INSERT INTO `usuario` VALUES (1, 1, 'Juan Pablo', 'Verano Russi', '3204796367', 'joshleclash@gmail.com', '1234567', 1019002704, 1);
INSERT INTO `usuario` VALUES (2, 1, 'Luis ', 'Veloza', '3004567890', 'luisvelozah@gmail.com', 'HH&07epDFGB', 80200532, 1);
INSERT INTO `usuario` VALUES (3, 2, 'luis', 'veloza', '3007280526', 'luisvelozah@gmail.com', 'H4qd8qYKOK3', 80111301, 1);
INSERT INTO `usuario` VALUES (4, 2, 'pruebas', 'pruebas', '3213221', 'pruebas@pruebas.com', 'oFT&jOPFGZQ', 20253698, 1);
INSERT INTO `usuario` VALUES (5, 2, 'Diana', 'Cedeno', '3112123434', 'dipacedeno@gmail.com', 'r5ti#dZNXd#', 1014222321, 1);

-- --------------------------------------------------------

-- 
-- Table structure for table `usuario_proyecto`
-- 

CREATE TABLE `usuario_proyecto` (
  `idUsuarioProyecto` int(11) NOT NULL auto_increment,
  `idUsuario` int(11) NOT NULL,
  `idProyecto` int(11) NOT NULL,
  `idCreate` int(11) NOT NULL,
  PRIMARY KEY  (`idUsuarioProyecto`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=10 ;

-- 
-- Dumping data for table `usuario_proyecto`
-- 

INSERT INTO `usuario_proyecto` VALUES (6, 4, 4, 1);
INSERT INTO `usuario_proyecto` VALUES (7, 3, 4, 1);
INSERT INTO `usuario_proyecto` VALUES (8, 5, 5, 1);
INSERT INTO `usuario_proyecto` VALUES (9, 3, 5, 1);
INSERT INTO `usuario_proyecto` VALUES (5, 4, 4, 1);
-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-05-2016 a las 00:45:32
-- Versión del servidor: 5.6.20
-- Versión de PHP: 5.5.15
CREATE DATABASE IF NOT EXISTS venta;
USE venta;

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: venta
--
--
-- Estructura de tabla para la tabla usuario
--

CREATE TABLE IF NOT EXISTS usuario (
  email varchar(75) NOT NULL,
  nombre varchar(60) NOT NULL,
  apellido varchar(80) NOT NULL,
  contrasena varchar(48) NOT NULL,
  tipo varchar(15) NOT NULL DEFAULT 'normal',
  estado varchar(50) NOT NULL DEFAULT 'activo',
  PRIMARY KEY(email)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;



-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla venta
--

CREATE TABLE IF NOT EXISTS venta (
  id_venta int(11) NOT NULL ,
  monto int(11) NOT NULL DEFAULT '0',
  fecha datetime NOT NULL,
  fk_email_usuario varchar(75) NOT NULL,
  PRIMARY KEY(id_venta),
  FOREIGN KEY (fk_email_usuario) REFERENCES usuario(email)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

--
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla devolucion
--

CREATE TABLE IF NOT EXISTS devolucion (
  id_devolucion int(11) NOT NULL AUTO_INCREMENT,
  motivo varchar(300) NOT NULL,
  descripcion text NOT NULL,
  monto int(11) NOT NULL DEFAULT '0',
  fecha datetime NOT NULL,
  fk_id_venta int(11) NOT NULL,
  PRIMARY KEY(id_devolucion),
  FOREIGN KEY (fk_id_venta) REFERENCES venta(id_venta)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

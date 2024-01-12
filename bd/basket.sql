-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 12-01-2024 a las 06:28:18
-- Versión del servidor: 10.4.27-MariaDB
-- Versión de PHP: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `basket`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `calendarios`
--

CREATE TABLE `calendarios` (
  `idcalendarios` int(11) NOT NULL,
  `fk_equipo_local` int(11) DEFAULT NULL,
  `fk_equipo_visitante` int(11) DEFAULT NULL,
  `fecha_hora` datetime DEFAULT NULL,
  `sede` varchar(145) DEFAULT NULL,
  `tipo_juego` varchar(145) DEFAULT NULL,
  `equipo_ganador` varchar(145) DEFAULT NULL,
  `razon_ganador` enum('ANOTACIONES','DEFAULT') DEFAULT 'DEFAULT',
  `marcador_visitante` double DEFAULT 0,
  `marcador_local` double DEFAULT 0,
  `fk_rol` int(11) DEFAULT NULL,
  `jornada` int(11) DEFAULT NULL,
  `fk_torneo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `calendarios`
--

INSERT INTO `calendarios` (`idcalendarios`, `fk_equipo_local`, `fk_equipo_visitante`, `fecha_hora`, `sede`, `tipo_juego`, `equipo_ganador`, `razon_ganador`, `marcador_visitante`, `marcador_local`, `fk_rol`, `jornada`, `fk_torneo`) VALUES
(1, 3, 4, '0000-00-00 00:00:00', 'CANCHAS INFONAVIT PLAYAS', 'EXHIBICION', NULL, 'DEFAULT', 1, 1, 1, 1, 4),
(2, 4, 3, '0000-00-00 00:00:00', 'CANCHAS INFONAVIT PLAYAS', 'EXHIBICION', NULL, 'DEFAULT', 0, 0, 1, 1, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `calendario_equipos_jugadores_torneo_jornada`
--

CREATE TABLE `calendario_equipos_jugadores_torneo_jornada` (
  `id` int(11) NOT NULL,
  `fk_calendario` int(11) DEFAULT NULL,
  `fk_equipo` int(11) DEFAULT NULL,
  `fk_jugador` int(11) DEFAULT NULL,
  `fk_torneo` int(11) DEFAULT NULL,
  `jornada` int(11) DEFAULT NULL,
  `triples` int(11) DEFAULT 0,
  `dobles` int(11) DEFAULT 0,
  `faltas` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `encuentros`
--

CREATE TABLE `encuentros` (
  `idencuentros` int(11) NOT NULL,
  `fk_equipo_local` int(11) DEFAULT NULL,
  `fk_equipo_visitante` int(11) DEFAULT NULL,
  `cantidad_juegos` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equipos`
--

CREATE TABLE `equipos` (
  `idequipos` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `nombre_capitan` varchar(100) DEFAULT NULL,
  `correo_capitan` varchar(100) DEFAULT NULL,
  `telefono_capitan` double DEFAULT NULL,
  `logo` varchar(300) DEFAULT NULL,
  `fk_torneo` int(11) DEFAULT NULL,
  `juegos_ganados` int(11) DEFAULT NULL,
  `juegos_perdidos` int(11) DEFAULT NULL,
  `puntos_a_favor` double DEFAULT NULL,
  `puntos_en_contra` double DEFAULT NULL,
  `partidos_perdidos_default` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `equipos`
--

INSERT INTO `equipos` (`idequipos`, `nombre`, `nombre_capitan`, `correo_capitan`, `telefono_capitan`, `logo`, `fk_torneo`, `juegos_ganados`, `juegos_perdidos`, `puntos_a_favor`, `puntos_en_contra`, `partidos_perdidos_default`) VALUES
(3, 'Golden State Warriors', 'Stephen Curry', 'stephencurry@gmail.com', 654565162, '../../img/equipos/659e35c6d8d86_Golden_State_Warriors_logo.svg.png', 4, NULL, NULL, NULL, NULL, NULL),
(4, 'Los Angeles Lakers', 'Lebron James', 'lebronjames@gmail.com', 654165515, '../../img/equipos/659f6f877079d_98fa13af68e08dac6d7d952f0cfd5c7b.jpg', 4, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupos`
--

CREATE TABLE `grupos` (
  `idgrupos` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `categoria` varchar(100) DEFAULT NULL,
  `fk_torneo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `grupos`
--

INSERT INTO `grupos` (`idgrupos`, `nombre`, `categoria`, `fk_torneo`) VALUES
(1, 'A', '1ra. Fuerza', 4),
(2, 'GRUPO B', '1ra. fuerza', 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jugadores`
--

CREATE TABLE `jugadores` (
  `idjugadores` int(11) NOT NULL,
  `nombre` varchar(145) DEFAULT NULL,
  `apellido1` varchar(145) DEFAULT NULL,
  `apellido2` varchar(145) DEFAULT NULL,
  `fecha_nac` date DEFAULT NULL,
  `correo` varchar(145) DEFAULT NULL,
  `celular` varchar(145) DEFAULT NULL,
  `tipo_sangre` varchar(145) DEFAULT NULL,
  `contacto_emergencia` varchar(145) DEFAULT NULL,
  `fotografia` varchar(145) DEFAULT NULL,
  `fk_equipo` int(11) DEFAULT NULL,
  `fk_usuario` int(11) DEFAULT NULL,
  `triples` int(11) DEFAULT 0,
  `dobles` int(11) DEFAULT 0,
  `faltas` int(11) DEFAULT 0,
  `posicion` varchar(145) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `jugadores`
--

INSERT INTO `jugadores` (`idjugadores`, `nombre`, `apellido1`, `apellido2`, `fecha_nac`, `correo`, `celular`, `tipo_sangre`, `contacto_emergencia`, `fotografia`, `fk_equipo`, `fk_usuario`, `triples`, `dobles`, `faltas`, `posicion`) VALUES
(1, 'Valeria', 'Sanchez', 'Velazquez', '0000-00-00', 'asdf@gmail.com', '32323423', 'O+', NULL, '../../img/jugadores/659f6b496d8c6_curry.png', 3, 6, 0, 0, 0, 'Ala'),
(2, 'Raton', 'Paton', 'Paton', '2024-01-10', 'asdf@gmail.com', '1234512345', 'O+', NULL, '../../img/jugadores/659f6ff3242c4_lebron.png', 4, 7, 0, 0, 0, 'Ala-pivot');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jugadores_equipos_torneo`
--

CREATE TABLE `jugadores_equipos_torneo` (
  `idjugadores_equipos_torneo` int(11) NOT NULL,
  `fk_usuario` int(11) DEFAULT NULL,
  `fk_torneo` int(11) DEFAULT NULL,
  `fk_equipos` int(11) DEFAULT NULL,
  `triples` double DEFAULT NULL,
  `dobles` double DEFAULT NULL,
  `faltas` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `patrocinadores`
--

CREATE TABLE `patrocinadores` (
  `idpatrocinadores` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `logo` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `patrocinadores`
--

INSERT INTO `patrocinadores` (`idpatrocinadores`, `nombre`, `logo`) VALUES
(3, 'ADIDAS', '../../img/equipos/659cdcaac0567_pngwing.com.png'),
(4, 'NBA', '../../img/sponsors/659b0d3406ece_NBA-logo-png-download-free-1200x675.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `patrocinadores_torneos`
--

CREATE TABLE `patrocinadores_torneos` (
  `id` int(11) NOT NULL,
  `fk_patrocinador` int(11) DEFAULT NULL,
  `nombre_torneo` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `patrocinadores_torneos`
--

INSERT INTO `patrocinadores_torneos` (`id`, `fk_patrocinador`, `nombre_torneo`) VALUES
(1, 3, '0'),
(2, 4, '0'),
(11, 3, 'Prueba'),
(12, 4, 'Prueba');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol_juegos`
--

CREATE TABLE `rol_juegos` (
  `idrol_juegos` int(11) NOT NULL,
  `jornadas` int(11) DEFAULT NULL,
  `fk_torneo` int(11) DEFAULT NULL,
  `nombre` varchar(145) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `rol_juegos`
--

INSERT INTO `rol_juegos` (`idrol_juegos`, `jornadas`, `fk_torneo`, `nombre`) VALUES
(1, 3, 4, 'Apertura');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `torneos`
--

CREATE TABLE `torneos` (
  `idtorneos` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `sede` varchar(100) DEFAULT NULL,
  `premio1` varchar(100) DEFAULT NULL,
  `premio2` varchar(100) DEFAULT NULL,
  `premio3` varchar(100) DEFAULT NULL,
  `premio_otro` varchar(100) DEFAULT NULL,
  `fk_organizador` int(11) DEFAULT NULL,
  `categoria` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `torneos`
--

INSERT INTO `torneos` (`idtorneos`, `nombre`, `sede`, `premio1`, `premio2`, `premio3`, `premio_otro`, `fk_organizador`, `categoria`) VALUES
(4, 'Prueba', 'Prueba', 'Prueba', 'Prueba', 'Prueba', 'Prueba', 3, '1ra. fuerza');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `idusuarios` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `username` varchar(45) DEFAULT NULL,
  `password` varchar(45) DEFAULT NULL,
  `rol` varchar(45) DEFAULT 'USUARIO'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`idusuarios`, `nombre`, `username`, `password`, `rol`) VALUES
(1, 'Nitzia', 'nitzia', 'fruta', 'ADMINISTRADOR'),
(3, 'Valeria Sanchez Velazquez', 'valeria', 'fruta', 'ORGANIZADOR'),
(4, 'valeriana', 'valeriana', 'fruta', 'JUGADOR'),
(6, 'Valeria', '123', '202cb962ac59075b964b07152d234b70', 'JUGADOR'),
(7, 'Raton', 'raton', 'raton', 'JUGADOR');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `calendarios`
--
ALTER TABLE `calendarios`
  ADD PRIMARY KEY (`idcalendarios`);

--
-- Indices de la tabla `calendario_equipos_jugadores_torneo_jornada`
--
ALTER TABLE `calendario_equipos_jugadores_torneo_jornada`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `encuentros`
--
ALTER TABLE `encuentros`
  ADD PRIMARY KEY (`idencuentros`);

--
-- Indices de la tabla `equipos`
--
ALTER TABLE `equipos`
  ADD PRIMARY KEY (`idequipos`),
  ADD KEY `fk_equipostorneo` (`fk_torneo`);

--
-- Indices de la tabla `grupos`
--
ALTER TABLE `grupos`
  ADD PRIMARY KEY (`idgrupos`),
  ADD KEY `fk_torneosgrupos` (`fk_torneo`);

--
-- Indices de la tabla `jugadores`
--
ALTER TABLE `jugadores`
  ADD PRIMARY KEY (`idjugadores`);

--
-- Indices de la tabla `jugadores_equipos_torneo`
--
ALTER TABLE `jugadores_equipos_torneo`
  ADD PRIMARY KEY (`idjugadores_equipos_torneo`);

--
-- Indices de la tabla `patrocinadores`
--
ALTER TABLE `patrocinadores`
  ADD PRIMARY KEY (`idpatrocinadores`);

--
-- Indices de la tabla `patrocinadores_torneos`
--
ALTER TABLE `patrocinadores_torneos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_patrocinadores` (`fk_patrocinador`);

--
-- Indices de la tabla `rol_juegos`
--
ALTER TABLE `rol_juegos`
  ADD PRIMARY KEY (`idrol_juegos`);

--
-- Indices de la tabla `torneos`
--
ALTER TABLE `torneos`
  ADD PRIMARY KEY (`idtorneos`),
  ADD KEY `fk_organizadores` (`fk_organizador`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idusuarios`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `calendarios`
--
ALTER TABLE `calendarios`
  MODIFY `idcalendarios` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `equipos`
--
ALTER TABLE `equipos`
  MODIFY `idequipos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `grupos`
--
ALTER TABLE `grupos`
  MODIFY `idgrupos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `jugadores`
--
ALTER TABLE `jugadores`
  MODIFY `idjugadores` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `jugadores_equipos_torneo`
--
ALTER TABLE `jugadores_equipos_torneo`
  MODIFY `idjugadores_equipos_torneo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `patrocinadores`
--
ALTER TABLE `patrocinadores`
  MODIFY `idpatrocinadores` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `patrocinadores_torneos`
--
ALTER TABLE `patrocinadores_torneos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `rol_juegos`
--
ALTER TABLE `rol_juegos`
  MODIFY `idrol_juegos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `torneos`
--
ALTER TABLE `torneos`
  MODIFY `idtorneos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idusuarios` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `equipos`
--
ALTER TABLE `equipos`
  ADD CONSTRAINT `fk_equipostorneo` FOREIGN KEY (`fk_torneo`) REFERENCES `torneos` (`idtorneos`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `grupos`
--
ALTER TABLE `grupos`
  ADD CONSTRAINT `fk_torneosgrupos` FOREIGN KEY (`fk_torneo`) REFERENCES `torneos` (`idtorneos`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `patrocinadores_torneos`
--
ALTER TABLE `patrocinadores_torneos`
  ADD CONSTRAINT `fk_patrocinadores` FOREIGN KEY (`fk_patrocinador`) REFERENCES `patrocinadores` (`idpatrocinadores`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `torneos`
--
ALTER TABLE `torneos`
  ADD CONSTRAINT `fk_organizadores` FOREIGN KEY (`fk_organizador`) REFERENCES `usuarios` (`idusuarios`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

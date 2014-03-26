-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 25-12-2013 a las 21:33:44
-- Versión del servidor: 5.5.24-log
-- Versión de PHP: 5.4.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `portafolio_charlotte`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE IF NOT EXISTS `categorias` (
  `categoria_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `categoria_imagen` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`categoria_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`categoria_id`, `nombre`, `categoria_imagen`) VALUES
(1, 'deportes', 'deportes.jpg'),
(2, 'entretenimiento', 'entretenimiento.jpg'),
(3, 'cultura', 'cultura.jpg'),
(4, 'politica', 'politica.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `noticias`
--

CREATE TABLE IF NOT EXISTS `noticias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `categoria_id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `titulo` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `contenido` text COLLATE utf8_spanish_ci NOT NULL,
  `publicado_fecha` date NOT NULL,
  `expiracion_fecha` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=26 ;

--
-- Volcado de datos para la tabla `noticias`
--

INSERT INTO `noticias` (`id`, `categoria_id`, `usuario_id`, `titulo`, `contenido`, `publicado_fecha`, `expiracion_fecha`) VALUES
(1, 1, 15, 'Cristiano Ronaldo y Leonel Messi jugaran con el Bayer Munich', 'Fuentes del Real Madrid mantienen que el fichaje de Neymar esta megacontrolado y que es cuestion de horas que se pueda hacer oficial. Fuentes del Real Madrid han contado a la SER que ya conocen el acuerdo alcanzado entre Neymar y Barca El Santos ha aceptado durante la madrugada de este sabado dos ofertas por la estrella brasileña gb con Messi', '2013-12-10', '2013-12-10'),
(2, 1, 32, 'Falcao pasará este lunes a reconocimiento médico con el Mónaco', 'El delantero Radamel Falcao abandonará el Atlético de Madrid en los próximos días rumbo a Mónaco. El colombiano quería decidir su futuro antes de marchar con su selección la próxima semana a jugarse la clasificación para el Mundial de Brasil. Falcao, que cumple ahora su segunda temporada en el Atlético de Madrid, se irá a la Costa Azul a cambio de unos 60 millones de euros. El todavía del Atlético cobrará en Mónaco una ficha cercana a las 12 millones de euros, bastante más de lo que cobra en el conjunto del Calderón.', '2013-12-08', '2013-12-08'),
(3, 2, 33, 'Bayern Munich venció 2-1 a Borussia Dortmund y es el nuevo campeón de la Champions League', 'El Bayern Múnich se impuso al Borussia de Dortmund en la primera final alemana en la historia de la Liga de Campeones gracias a un gol del holandés Arjen Robben a falta de dos minutos para la conclusión de un duelo brillante que parecía destinado a la prórroga (1-2).\r\n\r\nTras perder la final del año pasado y la de 2010, el conjunto bávaro conquistó por fin en Londres la quinta Copa de Europa para sus vitrinas, un título que cierra con honores el ciclo de Jupp Heynckes al mando del Bayern antes de que el español Pep Guardiola tome las riendas la próxima temporada.\r\n\r\nEra la séptima ocasión en la historia en la que la batalla final por el máximo título europeo se libraba en Wembley, testigo en esta ocasión de un choque entre dos equipos que se conocen bien, dos mecanismos de relojería acostumbrados a jugar bajo presión que demostraron su sangre fría desde el inicio.', '2013-03-28', '2013-04-28'),
(7, 3, 37, 'noticia nueva Susan cumple anios', 'noticia nueva Susan cumple aniosnoticia nueva Susan cumple aniosnoticia nueva Susan cumple aniosnoticia nueva Susan cumple aniosnoticia nueva Susan cumple anios', '2013-04-28', '2013-05-28'),
(9, 3, 15, 'Noticia de prueba con fecha de creacion', 'Noticia de prueba con fecha de creacion Noticia de prueba con fecha de creacion Noticia de prueba con fecha de creacion Noticia de prueba con fecha de creacion', '2013-05-28', '2013-06-28'),
(10, 2, 32, 'Nueva prueba de noticia con fecha de expiracion', 'Nueva prueba de noticia con fecha de expiracion Nueva prueba de noticia con fecha de expiracion Nueva prueba de noticia con fecha de expiracion Nueva prueba de noticia con fecha de expiracion', '2013-05-28', '0000-00-00'),
(12, 4, 37, 'nueva Susan fechas sin comillas', 'nueva Susan fechas sin comillas nueva Susan fechas sin comillas nueva Susan fechas sin comillas nueva Susan fechas sin comillas nueva Susan fechas sin comillas nueva Susan fechas sin comillas', '0000-00-00', '0000-00-00'),
(13, 3, 15, 'Prueba tiempo referencia Robert', 'Prueba tiempo referencia Robert Prueba tiempo referencia Robert Prueba tiempo referencia Robert Prueba tiempo referencia Robert Prueba tiempo referencia Robert', '2013-05-28', '0000-00-00'),
(14, 2, 32, 'nUEVA noticia  Carmila', 'Es demasiado simple, y también podemos manejar el formato como por ej. Dia/Mes/Año. O Dia-Mes-Año, el tipo de números, por ejemplo, Enero = 1, o Enero = 01. Mostrar el nombre del mes directamente. Aunque luego se necesitaria traducirlo. Ya que generalmente se usa el idioma del servidor\r\n\r\nURL del artículo: http://www.ejemplode.com/20-php/537-ejemplo_de_fecha_y_tiempo_en_php.html\r\nLeer completo: Ejemplo de Fecha y Tiempo en PHP', '2013-05-28', '2013-05-28'),
(15, 1, 33, 'muere Nelson Diaz', 'Nelson Mandel ha muerto despues de estar enfermo desde hace varios meses a causa de una infeccion respiratoria que lo ha debilitado paulatinamente desde varos años. DIOMEDES.', '2013-12-23', '2013-12-23'),
(16, 2, 37, '''10 Años se cumplen de la muerte de Pablo Escobar''', '''La tumba de Pablo Escobar ha sido visitada por sus numerosos simpatizantes, pese a que muchos mas recuerdan con dolor toda la sangre derramada por el capo en los años 80. y principis de los noventas. ñandú''', '2013-12-08', '2013-12-08'),
(17, 1, 15, 'Porrista de Millonarios es asesinada', 'Una hermosa joven de 18 años porrista de Millonarios ha sido asesinada, al paraecer por robarle sus pertenencias a la llegada a su casa la noche del domingo, el sospechoso ha sido captado por varias camaras de seguridad de conjuntos residenciales aledaños, se ofrecen 20 millones por su captura.', '2013-12-05', '2013-12-27'),
(18, 2, 32, 'Colombia se enfrentara a Francia en el mundial', 'El sorteo de los bombos ha definido los rivales de Colombia en el mundial Brasil 2014. Francia, Grecia y Surafrica seran nuetsros rivales en la primera ronda del mundial. Suerte!!!', '2013-12-05', '2013-12-27'),
(19, 3, 33, 'Nacional y Cali disputaran la final del futbol colombiano', 'Lo mas probable es que Nacional sea otra vez campeon del futbol colombiano, aunque Deportivo Cali llega de la ronda eliminatoria con un rendimiento de 100% habiendo ganado todos sus partidos.', '2013-12-07', '2013-12-30'),
(20, 1, 37, 'America ha quedado BBBpor fuera de la final', 'Tristemente América de Cali no logro llegar a disputar la final del torneo de la B. otro año mas que se quedara en la segunda división, dejandono completamente desolados a nosotros los hinchas.BBBB', '2013-12-13', '2013-12-13'),
(22, 3, 15, 'Nueva Noticia cambiando guerreras magicas', 'Ahora mejoramos dicho método para que no nos muestre al usuario todos los valores entrecomillados, al combinarlo con el php data object. suerte!!', '2013-12-09', '2013-12-09'),
(23, 1, 32, 'tenemos el resumen de seguridad', 'hemos hechoun buen resumen de las medidas de seguridad a tomar al desarrollar aplicaciones en php NUEVO CONT', '2013-12-13', '2013-12-13'),
(24, 4, 33, 'Nueva noticia de clare', 'este es el contenido de la nueva noticia de clare que debe quedar a sociada al usuario clare', '2013-12-20', '2013-12-20'),
(25, 1, 32, 'OTRA NOTICIA MAS', 'otranoticia mas contenido este es', '2013-12-24', '2013-12-24');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `usuario_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombres` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `apellidos` varchar(250) COLLATE utf8_spanish_ci NOT NULL,
  `email` varchar(250) COLLATE utf8_spanish_ci NOT NULL,
  `foto` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `passwordjs` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `passwordjsphp` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `usuario_level` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `estado` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`usuario_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=40 ;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`usuario_id`, `nombres`, `apellidos`, `email`, `foto`, `passwordjs`, `passwordjsphp`, `usuario_level`, `estado`) VALUES
(15, 'gloria janeth', 'rozo galeano', 'gloria@pelusa.com', 'por_defecto.jpg', '81DC9BDB52D04DC20036DBD8313ED055', '23b621240e3dd8b7e3d676b421e2d241', 'registrado', 'activado'),
(32, 'Elvis Andersson', 'Martin Rozo', 'saetaweb@gmail.com', 'por_defecto.jpg', '827CCB0EEA8A706C4C34A16891F84E7B', 'cf7d4bdd2afbb023f0b265b3e99ba1f9', 'admin', 'activado'),
(33, 'clare', 'claymore', 'clare@claymore.com', 'clare.jpg', '827CCB0EEA8A706C4C34A16891F84E7B', 'cf7d4bdd2afbb023f0b265b3e99ba1f9', 'registrado', 'activado'),
(37, 'hikaru', 'shidow', 'hikaru@hikaru.com', 'hikaru.jpg', '827CCB0EEA8A706C4C34A16891F84E7B', 'cf7d4bdd2afbb023f0b265b3e99ba1f9', 'admin', 'desactivado'),
(38, 'teresa', 'the beauty best', 'teresa@claymore.com', 'por_defecto.jpg', '827CCB0EEA8A706C4C34A16891F84E7B', 'cf7d4bdd2afbb023f0b265b3e99ba1f9', 'registrado', 'activado'),
(39, 'undine', 'priscilla', 'pris@claymore.com', 'por_defecto.jpg', '827CCB0EEA8A706C4C34A16891F84E7B', 'cf7d4bdd2afbb023f0b265b3e99ba1f9', 'registrado', 'desactivado');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-10-2024 a las 20:00:23
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sistema_nt`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE categoria (
id_categoria int(11) NOT NULL,
nombre varchar(45) NOT NULL,
descripcion varchar(150) NOT NULL,
URL_imagen varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla categoria
--

INSERT INTO categoria (id_categoria, nombre, descripcion, URL_imagen) VALUES
(1, 'Hamburguesas', 'Listado de hamburguesas', 'https://img.freepik.com/vector-gratis/ilustracion-dibujos-animados-hamburguesa-dibujada-mano_23-2150623475.jpg'),
(3, 'Bebidas', 'Listado de bebidas', 'https://img.freepik.com/vector-gratis/dibujado-mano-ilustracion-dibujos-animados-refresco_23-2150812727.jpg?ga=GA1.1.269343668.1729241896&semt=ais_hybrid');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla producto
--

CREATE TABLE producto (
id_producto int(11) NOT NULL,
nombre varchar(45) NOT NULL,
descripcion varchar(150) NOT NULL,
precio decimal(10,0) NOT NULL,
URL_imagen varchar(200) NOT NULL,
id_categoria int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla producto
--

INSERT INTO producto (id_producto, nombre, descripcion, precio, URL_imagen, id_categoria) VALUES
(32, 'Rhos Burger', 'Hamburguesa doble carne, con cheddar panceta y cebolla caramelizada. Incluye papas', 6000, 'https://bigpons.com.ar/productos/20220621103718.jpeg', 1),
(33, 'Lake Burger', 'Hamburguesa doble carne, con queso dambo, y jamon cocido. Incluye papas', 6000, 'https://viejodave.com.ar/wp-content/uploads/2024/02/hamburguesa-jamon-y-queso-carne-01.jpg', 1),
(34, 'Cheese Burger', 'Hamburguesa doble carne, con queso cheddar x4 fetas. Incluye papas', 6000, 'https://bigpons.com.ar/productos/20220621103022.jpeg', 1),
(35, 'Bealton Burger', 'Hamburguesa doble carne, con cheddar, panceta, cebolla morada y salsa nt. Incluye papas', 6000, 'https://www.cucinare.tv/wp-content/uploads/2022/05/Dia-de-la-H.jpg', 1),
(36, 'Boston Burger', 'Hamburguesa doble carne, con cheddar, panceta, cebolla crispy y salsa de mostaza y miel. Incluye papas', 6000, 'https://pbs.twimg.com/media/Fk227IWXkAE3HHw.png', 1),
(37, 'Rockford Burger', 'Hamburguesa doble carne, con queso dambo, queso roquefort, y cebolla caramelizada. Incluye papas', 6000, 'https://viejodave.com.ar/wp-content/uploads/2024/02/hamburguesa-queso-panceta-roquefort-cebolla-caramelizada-y-huevo-carne-01.jpg', 1),
(41, 'Soho Burger', 'Hamburguesa doble carne, con queso dambo, cebolla caramelizada, hongos y rucula. Incluye papas', 6000, 'https://viejodave.com.ar/wp-content/uploads/2024/02/hamburguesa-queso-rucula-tomate-confitado-y-cebolla-caramelizada.jpg', 1),
(42, 'Hatton Burger', 'Hamburguesa doble carne, con cheddar, panceta, cebolla crispy y salsa alioli. Incluye papas', 6000, 'https://cloudfront-us-east-1.images.arcpublishing.com/infobae/GTUKDAVECNARFKQ2UNMIF5LSFY.jpeg', 1),
(47, 'Coca Cola', 'Gaseosa de 1.5lts', 2500, 'https://elnenearg.vtexassets.com/arquivos/ids/159773/GASEOSA-COCA-COLA-1-5L-DESC-1-5706.jpg?v=637967901793630000', 3),
(48, 'Sprite', 'Gaseosa 1,5lts', 2500, 'https://roldanonline.com.ar/wp-content/uploads/2020/06/Gaseosa-SPRITE-1.5lt.webp', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla usuario
--

CREATE TABLE usuario (
id int(11) NOT NULL,
email varchar(250) NOT NULL,
password char(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla usuario
--

INSERT INTO usuario (id, email, password) VALUES
(1, 'webadmin', '$pass');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla categoria
--
ALTER TABLE categoria
ADD PRIMARY KEY (id_categoria);

--
-- Indices de la tabla producto
--
ALTER TABLE producto
ADD PRIMARY KEY (id_producto),
ADD KEY id_categoria (id_categoria);

--
-- Indices de la tabla usuario
--
ALTER TABLE usuario
ADD PRIMARY KEY (id);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla categoria
--
ALTER TABLE categoria
MODIFY id_categoria int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla producto
--
ALTER TABLE producto
MODIFY id_producto int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT de la tabla usuario
--
ALTER TABLE usuario
MODIFY id int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla producto
--
ALTER TABLE producto
ADD CONSTRAINT producto_ibfk_1 FOREIGN KEY (id_categoria) REFERENCES categoria (id_categoria) ON UPDATE CASCADE;
COMMIT;

﻿-- Script was generated by Devart dbForge Studio for MySQL, Version 6.0.128.0
-- Product home page: http://www.devart.com/dbforge/mysql/studio
-- Script date 16/08/2018 10:53:45 a. m.
-- Server version: 5.5.5-10.1.31-MariaDB
-- Client version: 4.1

--
-- Definition for database u207546111_motel
--
DROP DATABASE IF EXISTS u207546111_motel;
CREATE DATABASE u207546111_motel
	CHARACTER SET utf8
	COLLATE utf8_unicode_ci;

-- 
-- Disable foreign keys
-- 
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;

-- 
-- Set character set the client will use to send SQL statements to the server
--
SET NAMES 'utf8';

-- 
-- Set default database
--
USE u207546111_motel;

--
-- Definition for table grupoproductos
--
CREATE TABLE grupoproductos (
  Idgrupo INT(11) NOT NULL AUTO_INCREMENT,
  NombreGrupo VARCHAR(25) NOT NULL,
  Especificaciones VARCHAR(50) DEFAULT NULL,
  PRIMARY KEY (Idgrupo)
)
ENGINE = INNODB
AUTO_INCREMENT = 5
AVG_ROW_LENGTH = 4096
CHARACTER SET utf8
COLLATE utf8_unicode_ci;

--
-- Definition for table horas
--
CREATE TABLE horas (
  id INT(11) NOT NULL AUTO_INCREMENT,
  Hora INT(11) NOT NULL,
  Estado VARCHAR(10) NOT NULL DEFAULT 'Inactivo',
  PRIMARY KEY (id)
)
ENGINE = INNODB
AUTO_INCREMENT = 25
AVG_ROW_LENGTH = 744
CHARACTER SET utf8
COLLATE utf8_unicode_ci;

--
-- Definition for table listaprecios
--
CREATE TABLE listaprecios (
  CodLista INT(11) NOT NULL AUTO_INCREMENT,
  NomLista VARCHAR(50) NOT NULL,
  Especial VARCHAR(5) NOT NULL DEFAULT 'NO',
  PRIMARY KEY (CodLista),
  UNIQUE INDEX NomLista (NomLista)
)
ENGINE = INNODB
AUTO_INCREMENT = 6
AVG_ROW_LENGTH = 5461
CHARACTER SET utf8
COLLATE utf8_spanish_ci;

--
-- Definition for table ocupacion
--
CREATE TABLE ocupacion (
  IdOcupacion INT(11) NOT NULL AUTO_INCREMENT,
  NumeroHab VARCHAR(255) NOT NULL,
  Estado VARCHAR(10) DEFAULT 'OCUPADO',
  Horas INT(11) NOT NULL,
  Extras INT(11) DEFAULT NULL,
  ValorServicio DOUBLE NOT NULL,
  ValorExtra DOUBLE DEFAULT 0,
  ValorConsumos DOUBLE DEFAULT 0,
  ValorTotal DOUBLE DEFAULT 0,
  FIngreso DATETIME DEFAULT 'CURRENT_TIMESTAMP',
  FSalida DATETIME DEFAULT NULL,
  ValorPagado DOUBLE DEFAULT NULL,
  Usr_Registro VARCHAR(20) DEFAULT NULL,
  PRIMARY KEY (IdOcupacion)
)
ENGINE = INNODB
AUTO_INCREMENT = 82
AVG_ROW_LENGTH = 2340
CHARACTER SET utf8
COLLATE utf8_spanish_ci
COMMENT = 'Tabla donde se guarda la ocupacion en vivo';

--
-- Definition for table servicioshabitaciones
--
CREATE TABLE servicioshabitaciones (
  CodServicioHab INT(11) NOT NULL AUTO_INCREMENT,
  NomServicio VARCHAR(50) NOT NULL,
  Descripcion VARCHAR(255) DEFAULT NULL,
  Estado VARCHAR(15) NOT NULL DEFAULT 'Activo',
  PRIMARY KEY (CodServicioHab),
  UNIQUE INDEX NomServicio (NomServicio)
)
ENGINE = INNODB
AUTO_INCREMENT = 8
AVG_ROW_LENGTH = 4096
CHARACTER SET utf8
COLLATE utf8_spanish_ci;

--
-- Definition for table tiposhabitaciones
--
CREATE TABLE tiposhabitaciones (
  CodTipoHab INT(11) NOT NULL AUTO_INCREMENT,
  NomTipo VARCHAR(255) NOT NULL,
  Caracteristicas VARCHAR(255) DEFAULT NULL,
  PRIMARY KEY (CodTipoHab),
  UNIQUE INDEX NomTipo (NomTipo)
)
ENGINE = INNODB
AUTO_INCREMENT = 6
AVG_ROW_LENGTH = 5461
CHARACTER SET utf8
COLLATE utf8_spanish_ci;

--
-- Definition for table diaslistas
--
CREATE TABLE diaslistas (
  CodLista INT(11) NOT NULL,
  DiaSemana INT(11) NOT NULL,
  FInicial DATE DEFAULT NULL,
  FFinal DATE DEFAULT NULL,
  HInicial TIME DEFAULT NULL,
  HFinal TIME DEFAULT NULL,
  PRIMARY KEY (CodLista, DiaSemana),
  UNIQUE INDEX DiaSemana (DiaSemana),
  CONSTRAINT `dias-lista` FOREIGN KEY (CodLista)
    REFERENCES listaprecios(CodLista) ON DELETE CASCADE ON UPDATE RESTRICT
)
ENGINE = INNODB
AVG_ROW_LENGTH = 2730
CHARACTER SET utf8
COLLATE utf8_spanish_ci;

--
-- Definition for table habitaciones
--
CREATE TABLE habitaciones (
  CodHabitacion INT(11) NOT NULL AUTO_INCREMENT,
  Numero VARCHAR(4) NOT NULL,
  CodTipoHab INT(11) NOT NULL,
  Estado VARCHAR(15) NOT NULL DEFAULT 'Activo',
  CodBarras VARCHAR(255) DEFAULT NULL,
  PRIMARY KEY (CodHabitacion),
  UNIQUE INDEX Numero (Numero),
  CONSTRAINT `habitaciones-tipo` FOREIGN KEY (CodTipoHab)
    REFERENCES tiposhabitaciones(CodTipoHab) ON DELETE RESTRICT ON UPDATE RESTRICT
)
ENGINE = INNODB
AUTO_INCREMENT = 15
AVG_ROW_LENGTH = 1489
CHARACTER SET utf8
COLLATE utf8_spanish_ci;

--
-- Definition for table precioshabitaciones
--
CREATE TABLE precioshabitaciones (
  CodLista INT(11) NOT NULL,
  CodTipoHab INT(11) NOT NULL,
  CodServicioHab INT(11) NOT NULL,
  ValorServicio DOUBLE DEFAULT NULL,
  INDEX `precio-servicio` (CodServicioHab),
  CONSTRAINT `precio-lista` FOREIGN KEY (CodLista)
    REFERENCES listaprecios(CodLista) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `precios-tipo` FOREIGN KEY (CodTipoHab)
    REFERENCES tiposhabitaciones(CodTipoHab) ON DELETE RESTRICT ON UPDATE RESTRICT
)
ENGINE = INNODB
AVG_ROW_LENGTH = 606
CHARACTER SET utf8
COLLATE utf8_spanish_ci;

--
-- Definition for table productos
--
CREATE TABLE productos (
  IdProducto INT(11) NOT NULL AUTO_INCREMENT,
  Nombre VARCHAR(255) NOT NULL,
  Abreviacion VARCHAR(255) DEFAULT NULL,
  ValorVenta DOUBLE NOT NULL DEFAULT 0,
  CodigoBarras VARCHAR(255) DEFAULT NULL,
  Grupo INT(11) NOT NULL,
  PRIMARY KEY (IdProducto),
  CONSTRAINT `producto-grupo` FOREIGN KEY (Grupo)
    REFERENCES grupoproductos(Idgrupo) ON DELETE RESTRICT ON UPDATE RESTRICT
)
ENGINE = INNODB
AUTO_INCREMENT = 7
AVG_ROW_LENGTH = 2730
CHARACTER SET utf8
COLLATE utf8_unicode_ci;

--
-- Definition for table consumos
--
CREATE TABLE consumos (
  IdOcupacion INT(11) NOT NULL,
  IdProducto INT(11) NOT NULL,
  Cantidad DOUBLE NOT NULL,
  VlrUnit DOUBLE NOT NULL,
  Usr_Registro VARCHAR(50) DEFAULT NULL,
  F_Registro DATETIME DEFAULT NULL,
  CONSTRAINT `consumos-ocupacion` FOREIGN KEY (IdOcupacion)
    REFERENCES ocupacion(IdOcupacion) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `consumos-producto` FOREIGN KEY (IdProducto)
    REFERENCES productos(IdProducto) ON DELETE RESTRICT ON UPDATE RESTRICT
)
ENGINE = INNODB
AVG_ROW_LENGTH = 963
CHARACTER SET utf8
COLLATE utf8_unicode_ci;

DELIMITER $$

--
-- Definition for procedure I_Insertar_Consumo
--
CREATE PROCEDURE I_Insertar_Consumo(IN IdO int, IN IdP int, IN Cant int, IN ValorU double)
  SQL SECURITY INVOKER
INSERT INTO consumos (IdOcupacion, IdProducto, Cantidad, VlrUnit, Usr_Registro, F_Registro)
    VALUES (Ido, IdP, Cant, ValorU, CURRENT_USER(), NOW())
$$

--
-- Definition for procedure I_Insertar_Ocupacion
--
CREATE PROCEDURE I_Insertar_Ocupacion(IN NHab varchar(4), IN H int, IN ValorS double)
  SQL SECURITY INVOKER
INSERT INTO ocupacion (NumeroHab, Horas, ValorServicio, ValorTotal, Usr_Registro)
    VALUES (NHab, H, ValorS, ValorS, CURRENT_USER())
$$

--
-- Definition for procedure S_Buscar_Producto
--
CREATE DEFINER = 'root'@'localhost'
PROCEDURE S_Buscar_Producto(IN tipo int, IN cod varchar(50))
BEGIN
  IF tipo = 1 THEN
    SELECT
      productos.*,
      grupoproductos.NombreGrupo AS NombreGrupo,
      productos.ValorVenta * 0 AS Cantidad
    FROM productos
      INNER JOIN grupoproductos
        ON productos.Grupo = grupoproductos.Idgrupo
    WHERE IdProducto = cod;
  ELSE
    SELECT
      productos.*,
      grupoproductos.NombreGrupo AS NombreGrupo,
      productos.ValorVenta * 0 AS Cantidad
    FROM productos
      INNER JOIN grupoproductos
        ON productos.Grupo = grupoproductos.Idgrupo
    WHERE CodigoBarras = cod;
  END IF;
END
$$

--
-- Definition for procedure S_Precios_Lista
--
CREATE DEFINER = 'root'@'localhost'
PROCEDURE S_Precios_Lista(IN listaSeleccionada INT, IN tipo INT)
SELECT
  horas.Hora AS Hora,
  precioshabitaciones.ValorServicio AS ValorServicio
FROM (precioshabitaciones
  JOIN horas
    ON ((precioshabitaciones.CodServicioHab = horas.id)))
WHERE ((precioshabitaciones.CodLista = listaSeleccionada) AND (precioshabitaciones.CodTipoHab = tipo) AND (horas.Estado = 'Activo') AND (precioshabitaciones.ValorServicio > 0))
$$

--
-- Definition for procedure S_Traer_Consumos
--
CREATE DEFINER = 'root'@'localhost'
PROCEDURE S_Traer_Consumos(IN IdO int)
SELECT
  productos.*,
  grupoproductos.NombreGrupo AS NombreGrupo,
  SUM(consumos.Cantidad) AS Cantidad
FROM productos
  INNER JOIN grupoproductos
    ON productos.Grupo = grupoproductos.Idgrupo
  INNER JOIN consumos
    ON consumos.IdProducto = productos.IdProducto
WHERE consumos.IdOcupacion = IdO
GROUP BY productos.IdProducto,
         productos.Nombre,
         productos.Abreviacion,
         productos.ValorVenta,
         productos.CodigoBarras,
         productos.Grupo,
         grupoproductos.NombreGrupo
$$

DELIMITER ;

--
-- Definition for view listarlistas
--
CREATE OR REPLACE 
	DEFINER = 'root'@'localhost'
VIEW listarlistas
AS
	select `listaprecios`.`CodLista` AS `CodLista`,`listaprecios`.`NomLista` AS `NombreLista`,`listaprecios`.`Especial` AS `Especial`,`diaslistas`.`DiaSemana` AS `Dias`,`diaslistas`.`FInicial` AS `FechaInicial`,`diaslistas`.`FFinal` AS `FechaFinal` from (`diaslistas` join `listaprecios` on((`diaslistas`.`CodLista` = `listaprecios`.`CodLista`)));

--
-- Definition for view view_lista_habtiaciones
--
CREATE OR REPLACE 
	DEFINER = 'root'@'localhost'
VIEW view_lista_habtiaciones
AS
	select `habitaciones`.`CodHabitacion` AS `CodHabitacion`,`habitaciones`.`Numero` AS `Numero`,`tiposhabitaciones`.`CodTipoHab` AS `CodTipoHab`,`tiposhabitaciones`.`NomTipo` AS `NomTipo` from (`habitaciones` join `tiposhabitaciones` on((`habitaciones`.`CodTipoHab` = `tiposhabitaciones`.`CodTipoHab`))) where (`habitaciones`.`Estado` = 'Activo') order by `habitaciones`.`Numero`;

--
-- Definition for view view_lista_precios_activaxdia
--
CREATE OR REPLACE 
	DEFINER = 'root'@'localhost'
VIEW view_lista_precios_activaxdia
AS
	select `diaslistas`.`CodLista` AS `CodLista`,`diaslistas`.`DiaSemana` AS `DiaSemana`,`diaslistas`.`FInicial` AS `FInicial`,`diaslistas`.`FFinal` AS `FFinal`,`diaslistas`.`HInicial` AS `HInicial`,`diaslistas`.`HFinal` AS `HFinal` from `diaslistas` where (`diaslistas`.`DiaSemana` = (dayofweek(curdate()) - 1));

--
-- Definition for view view_lista_precios_activaxrango
--
CREATE OR REPLACE 
	DEFINER = 'root'@'localhost'
VIEW view_lista_precios_activaxrango
AS
	select `diaslistas`.`CodLista` AS `CodLista`,`diaslistas`.`DiaSemana` AS `DiaSemana`,`diaslistas`.`FInicial` AS `FInicial`,`diaslistas`.`FFinal` AS `FFinal`,`diaslistas`.`HInicial` AS `HInicial`,`diaslistas`.`HFinal` AS `HFinal` from `diaslistas` where (((`diaslistas`.`FInicial` = curdate()) and (`diaslistas`.`HInicial` <= curtime())) or ((`diaslistas`.`FInicial` < curdate()) and (`diaslistas`.`FFinal` > curdate())) or ((`diaslistas`.`FFinal` = curdate()) and (`diaslistas`.`HFinal` >= curtime())));

--
-- Definition for view view_ocupaciones
--
CREATE OR REPLACE 
	DEFINER = 'root'@'localhost'
VIEW view_ocupaciones
AS
	select `ocupacion`.`IdOcupacion` AS `IdOcupacion`,`ocupacion`.`NumeroHab` AS `NumeroHab`,`ocupacion`.`Estado` AS `Estado`,`ocupacion`.`Horas` AS `Horas`,`ocupacion`.`Extras` AS `Extras`,`ocupacion`.`ValorServicio` AS `ValorServicio`,`ocupacion`.`ValorExtra` AS `ValorExtra`,`ocupacion`.`ValorConsumos` AS `ValorConsumos`,`ocupacion`.`ValorTotal` AS `ValorTotal`,date_format(`ocupacion`.`FIngreso`,'%d-%m-%Y %h:%i:%s %p') AS `FIngreso`,date_format((`ocupacion`.`FIngreso` + interval `ocupacion`.`Horas` hour),'%d-%m-%Y %h:%i:%s %p') AS `FSalida`,`ocupacion`.`ValorPagado` AS `ValorPagado` from `ocupacion` where (`ocupacion`.`Estado` = 'OCUPADO');

--
-- Definition for view vistahabitaciones
--
CREATE OR REPLACE 
	SQL SECURITY INVOKER
VIEW vistahabitaciones
AS
	select `h`.`CodHabitacion` AS `CodHabitacion`,`h`.`Numero` AS `Numero`,`t`.`NomTipo` AS `Nombre`,`h`.`Estado` AS `Estado` from (`habitaciones` `h` join `tiposhabitaciones` `t`) where (`h`.`CodTipoHab` = `t`.`CodTipoHab`);

--
-- Definition for view vistaprecios
--
CREATE OR REPLACE 
	DEFINER = 'root'@'localhost'
VIEW vistaprecios
AS
	select `precioshabitaciones`.`CodLista` AS `CodLista`,`tiposhabitaciones`.`CodTipoHab` AS `CodTipo`,`precioshabitaciones`.`CodServicioHab` AS `Servicio`,`precioshabitaciones`.`ValorServicio` AS `Valor` from (`precioshabitaciones` join `tiposhabitaciones` on((`precioshabitaciones`.`CodTipoHab` = `tiposhabitaciones`.`CodTipoHab`)));

-- 
-- Dumping data for table grupoproductos
--
INSERT INTO grupoproductos VALUES
(1, 'BEBIDAS', 'bebidas no alcoholicas'),
(2, 'LICORES', 'cervezas, tragos diversos'),
(3, 'COMESTIBLES', NULL),
(4, 'SEXSHOP', NULL);

-- 
-- Dumping data for table horas
--
INSERT INTO horas VALUES
(1, 1, 'Activo'),
(2, 2, 'Activo'),
(3, 3, 'Activo'),
(4, 4, 'Activo'),
(5, 5, 'Inactivo'),
(6, 6, 'Activo'),
(7, 7, 'Inactivo'),
(8, 8, 'Inactivo'),
(9, 9, 'Inactivo'),
(10, 10, 'Inactivo'),
(11, 11, 'Inactivo'),
(12, 12, 'Activo'),
(13, 13, 'Inactivo'),
(14, 14, 'Inactivo'),
(15, 15, 'Inactivo'),
(16, 16, 'Inactivo'),
(17, 17, 'Inactivo'),
(18, 18, 'Inactivo'),
(19, 19, 'Inactivo'),
(20, 20, 'Inactivo'),
(21, 21, 'Inactivo'),
(22, 22, 'Inactivo'),
(23, 23, 'Inactivo'),
(24, 24, 'Activo');

-- 
-- Dumping data for table listaprecios
--
INSERT INTO listaprecios VALUES
(1, 'SEMANA', 'NO'),
(4, 'FIN DE SEMANA', 'NO'),
(5, 'AMOR Y AMISTAD', 'SI');

-- 
-- Dumping data for table ocupacion
--
INSERT INTO ocupacion VALUES
(74, '101', 'OCUPADO', 3, NULL, 30000, 0, 32300, 62300, '2018-07-27 18:06:52', NULL, NULL, NULL),
(75, '202', 'OCUPADO', 3, NULL, 30000, 0, 12600, 42600, '2018-07-27 18:06:59', NULL, NULL, NULL),
(76, '204', 'OCUPADO', 3, NULL, 50000, 0, 19800, 69800, '2018-07-27 18:07:04', NULL, NULL, NULL),
(78, '205', 'OCUPADO', 6, NULL, 45000, 0, 5000, 50000, '2018-07-30 17:54:09', NULL, NULL, NULL),
(79, '206', 'OCUPADO', 6, NULL, 45000, 0, 0, 45000, '2018-07-30 17:57:52', NULL, NULL, 'root@localhost'),
(80, '207', 'OCUPADO', 1, NULL, 25000, 0, 16000, 41000, '2018-07-30 17:58:26', NULL, NULL, 'root@localhost'),
(81, '301', 'OCUPADO', 12, NULL, 50000, 0, 15000, 65000, '2018-08-01 16:51:36', NULL, NULL, 'root@localhost');

-- 
-- Dumping data for table servicioshabitaciones
--
INSERT INTO servicioshabitaciones VALUES
(6, 'PERSONA ADICIONAL', '', 'Activo'),
(7, 'DOS PERSONAS ADICIONALES', '', 'Activo');

-- 
-- Dumping data for table tiposhabitaciones
--
INSERT INTO tiposhabitaciones VALUES
(1, 'SENCILLA', ''),
(2, 'JUNIOR', NULL),
(3, 'PRESIDENCIAL', NULL),
(4, 'SUITE', NULL),
(5, 'MULTIPLE', '');

-- 
-- Dumping data for table diaslistas
--
INSERT INTO diaslistas VALUES
(1, 1, NULL, NULL, '07:00:00', '06:59:00'),
(1, 2, NULL, NULL, '07:00:00', '06:59:00'),
(1, 3, NULL, NULL, '07:00:00', '06:59:59'),
(1, 4, NULL, NULL, '07:00:00', '06:59:59'),
(4, 5, NULL, NULL, '07:00:00', '06:59:59'),
(4, 6, NULL, NULL, '07:00:00', '06:59:59');

-- 
-- Dumping data for table habitaciones
--
INSERT INTO habitaciones VALUES
(2, '101', 1, 'Activo', NULL),
(3, '202', 1, 'Activo', NULL),
(4, '203', 1, 'Activo', NULL),
(5, '102', 1, 'Activo', NULL),
(6, '204', 3, 'Activo', NULL),
(7, '205', 1, 'Activo', NULL),
(8, '206', 1, 'Activo', NULL),
(9, '207', 2, 'Activo', NULL),
(10, '301', 1, 'Activo', NULL),
(11, '302', 1, 'Activo', NULL),
(12, '303', 5, 'Activo', NULL),
(14, '304', 3, 'Activo', NULL);

-- 
-- Dumping data for table precioshabitaciones
--
INSERT INTO precioshabitaciones VALUES
(1, 1, 1, 20000),
(1, 2, 1, 25000),
(1, 1, 3, 0),
(4, 1, 3, 30000),
(4, 2, 3, 35000),
(4, 3, 3, 50000),
(1, 1, 4, 30000),
(1, 2, 4, 35000),
(1, 3, 4, 50000),
(1, 1, 6, 45000),
(1, 2, 6, 50000),
(1, 3, 6, 70000),
(4, 1, 6, 45000),
(4, 2, 6, 50000),
(4, 3, 6, 70000),
(1, 1, 12, 50000),
(1, 2, 12, 65000),
(1, 3, 12, 85000),
(4, 1, 12, 50000),
(4, 2, 12, 65000),
(4, 3, 12, 85000),
(5, 1, 1, 0),
(5, 1, 3, 30000),
(5, 2, 3, 35000),
(5, 3, 3, 50000),
(5, 1, 6, 45000),
(5, 2, 6, 50000),
(5, 3, 6, 70000),
(5, 1, 12, 50000),
(5, 2, 12, 65000),
(5, 3, 12, 85000),
(1, 1, 2, 25000);

-- 
-- Dumping data for table productos
--
INSERT INTO productos VALUES
(1, 'COCA COLA 600ML', 'COCA COLA', 2500, '6953070958389', 1),
(2, 'DETODITO', 'DETODITO', 2000, NULL, 3),
(3, 'PAPAS MARGARITAS', 'PAPAS', 3000, NULL, 3),
(4, 'PRESERVATIVOS TODAY', 'TODAY', 3500, NULL, 4),
(5, 'AGUA OASIS 600ML', 'AGUA', 2300, '7702090028836', 1),
(6, 'AGUA CARULLA 1.100ML', 'AGUA', 5000, '7701001740430', 1);

-- 
-- Dumping data for table consumos
--
INSERT INTO consumos VALUES
(74, 1, 4, 2500, NULL, NULL),
(74, 2, 5, 2000, NULL, NULL),
(74, 5, 1, 2300, 'root@localhost', '2018-08-01 15:05:02'),
(74, 6, 1, 5000, NULL, NULL),
(75, 5, 2, 2300, NULL, NULL),
(76, 1, 3, 2500, NULL, NULL),
(76, 5, 1, 2300, NULL, NULL),
(76, 6, 1, 5000, NULL, NULL),
(80, 1, 3, 2500, 'root@localhost', '2018-08-01 15:38:46'),
(80, 1, 1, 2500, 'root@localhost', '2018-08-01 15:39:54'),
(80, 2, 1, 2000, 'root@localhost', '2018-08-01 15:49:46'),
(80, 2, 2, 2000, 'root@localhost', '2018-08-01 15:49:50'),
(81, 1, 2, 2500, 'root@localhost', '2018-08-01 17:12:33'),
(81, 6, 2, 5000, 'root@localhost', '2018-08-01 17:12:51'),
(74, 1, 2, 2500, 'root@localhost', '2018-08-02 16:55:35'),
(75, 2, 2, 2000, 'root@localhost', '2018-08-02 16:58:31'),
(75, 2, 2, 2000, 'root@localhost', '2018-08-02 16:58:36'),
(78, 6, 1, 5000, 'root@localhost', '2018-08-10 17:07:24'),
(76, 1, 2, 2500, 'root@localhost', '2018-08-14 12:01:24');

DELIMITER $$

--
-- Definition for trigger consumosAI
--
CREATE 
	DEFINER = 'root'@'localhost'
TRIGGER consumosAI
	AFTER INSERT
	ON consumos
	FOR EACH ROW
BEGIN
  UPDATE ocupacion
    SET ValorConsumos = (SELECT sum(Cantidad * VlrUnit)*1 FROM consumos WHERE consumos.IdOcupacion = ocupacion.IdOcupacion);
  UPDATE ocupacion
    SET ValorConsumos = 0
    WHERE ValorConsumos IS NULL;
  UPDATE ocupacion
    SET ValorTotal = (ValorServicio + ValorExtra + ValorConsumos);   
END
$$

--
-- Definition for trigger consumosAU
--
CREATE 
	DEFINER = 'root'@'localhost'
TRIGGER consumosAU
	AFTER UPDATE
	ON consumos
	FOR EACH ROW
BEGIN         
  UPDATE ocupacion
    SET ValorConsumos = (SELECT sum(Cantidad * VlrUnit)*1 FROM consumos WHERE consumos.IdOcupacion = ocupacion.IdOcupacion);
  UPDATE ocupacion
    SET ValorConsumos = 0
    WHERE ValorConsumos IS NULL;
  UPDATE ocupacion
    SET ValorTotal = (ValorServicio + ValorExtra + ValorConsumos);
  
END
$$

DELIMITER ;

-- 
-- Enable foreign keys
-- 
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
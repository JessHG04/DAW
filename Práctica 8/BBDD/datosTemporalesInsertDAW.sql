/*INSERTAMOS DATOS TEMPORALES A LA BASE DE DATOS*/
-- Cargar los datos en este orden:

-- Primero cargar los ficheros (antes de este fichero):
/*PAISES*/
-- paisesInsertDAW.sql (porque he puesto la columna Continente)

/*ESTILOS*/
-- estilosInsertDAW.sql


/*USUARIOS*/
-- Se supone que el siguiente comando resetea el autoincremento pero no va, aun asi pues lo dejo ahi xD
-- ALTER TABLE usuarios AUTO_INCREMENT = 1;
INSERT INTO pibd.usuarios (NomUsuario, Clave, Email, Sexo, FNacimiento, Ciudad, Pais, Foto, FRegistro, Estilo) VALUES
('raquel', 'praquel', 'raquel@gmail.com', 1, '1998-02-16', 'Sevilla', 49, '"images/user.png"', '2018-02-14 15:30:17', 1),
('alex', 'palex', 'alex@gmail.com', 0, '1995-06-24', 'Nueva York', 16, '"images/user.png"', '2018-10-25 12:15:03', 2),
('luther', 'pluther', 'luther@gmail.com', 0, '1969-06-29', 'Dusseldorf', 37, '"images/user.png"', '2018-08-01 21:48:00', 3),
('sakura', 'psakura', 'sakura@gmail.com', 1, '1999-05-01', 'Tokyo', 152, '"images/user.png"', '2017-12-13 01:16:08', 4),
('ragnar', 'pragnar', 'ragnar@gmail.com', 0, '1972-03-15', 'Kattegat', 76, '"images/user.png"', '2014-04-09 23:59:25', 1),
('violette', 'pviolette', 'violette@gmail.com', 1, '1994-09-17', 'Paris', 52, '"images/user.png"', '2018-01-29 06:17:00', 2),
('lin', 'plin', 'lin@gmail.com', 0, '1984-06-19', 'Hong Kong', 142, '"images/user.png"', '2016-05-16 12:04:57', 3),
('batbayar', 'pbatbayar', 'batbayar@gmail.com', 0, '1956-09-23', 'Darjan', 160, '"images/user.png"', '2018-06-05 16:14:30', 4),
('ari', 'pari', 'ari@gmail.com', 1, '1949-10-26', 'Akranes', 56, '"images/user.png"', '2016-02-24 19:18:01', 1),
('anne', 'panne', 'anne@gmail.com', 1, '1991-12-16', 'Brujas', 40, '"images/user.png"', '2017-09-21 08:26:41', 2);

/*ÁLBUMES*/
-- Antes de hacer el insert, comprobar que los usuarios tienen ese id, sino, cambiarlo
INSERT INTO pibd.albumes (Titulo, Descripcion, Usuario) VALUES
('Animales', 'Las mejores fotos de animales', 1),
('Paisajes', 'Las fotos más bonitas de paisajes', 1),
('Otros', 'Fotos sin clasificar', 1),
('Animales', 'Las mejores fotos de animales', 2),
('Paisajes', 'Las fotos más bonitas de paisajes', 2),
('Otros', 'Fotos sin clasificar', 2),
('Animales', 'Las mejores fotos de animales', 3),
('Paisajes', 'Las fotos más bonitas de paisajes', 3),
('Otros', 'Fotos sin clasificar', 3),
('Animales', 'Las mejores fotos de animales', 4),
('Paisajes', 'Las fotos más bonitas de paisajes', 4),
('Otros', 'Fotos sin clasificar', 4),
('Animales', 'Las mejores fotos de animales', 5),
('Paisajes', 'Las fotos más bonitas de paisajes', 5),
('Otros', 'Fotos sin clasificar', 5),
('Animales', 'Las mejores fotos de animales', 6),
('Paisajes', 'Las fotos más bonitas de paisajes', 6),
('Otros', 'Fotos sin clasificar', 6),
('Animales', 'Las mejores fotos de animales', 7),
('Paisajes', 'Las fotos más bonitas de paisajes', 7),
('Otros', 'Fotos sin clasificar', 7),
('Animales', 'Las mejores fotos de animales', 8),
('Paisajes', 'Las fotos más bonitas de paisajes', 8),
('Otros', 'Fotos sin clasificar', 8),
('Animales', 'Las mejores fotos de animales', 9),
('Paisajes', 'Las fotos más bonitas de paisajes', 9),
('Otros', 'Fotos sin clasificar', 9),
('Animales', 'Las mejores fotos de animales', 10),
('Paisajes', 'Las fotos más bonitas de paisajes', 10),
('Otros', 'Fotos sin clasificar', 10);

/*FOTOS*/
-- Comprueba que el id de los álbumes sea el mismo en tu bbdd
INSERT INTO pibd.fotos (Titulo, Descripcion, Fecha, Pais, Album, Fichero, Alternativo, FRegistro) VALUES
('Paisaje estrellado de Noruega', 'Paisaje nocturno donde podemos observar le movimiento de las estrellas en Noruega', '2018-09-23', 67, 2, '"images/foto1.jpg"', 'Paisaje estrellado de Noruega', '2018-02-15 15:20:17'),
('Primer plano de búho', 'Primer plano de un búho con cara de enfadado', '2018-09-20', 193, 4, '"images/foto2.jpg"', 'Primer plano de búho', '2018-11-22 11:14:36'),
('Camada de gatitos', 'Camada de tres lindos gatitos', '2018-09-17', 49, 7, '"images/foto3.jpg"', 'Camada de gatitos', '2018-11-03 01:04:04'),
('Bombero apagando un gran fuego', 'Bombero intentando apagar un fuego muy extendido', '2018-09-14', 2, 11, '"images/foto4.jpg"', 'Bombero apagando un gran fuego', '2018-02-15 15:21:00'),
('Monitores para programar', 'Escritorio con dos monitores para programar', '2018-09-10', 152, 15, '"images/foto5.jpg"', 'Monitores', '2018-02-15 15:20:00'),
('Luces contiguas', 'Bombillas encendidas contiguas', '2017-02-15', 108, 18, '"images/foto6.jpg"', 'Luces contiguas', '2018-02-28 03:18:19'),
('Paisaje en las montañas', 'Paisaje que se observa desde la cima de una montaña', '2015-04-12', 16, 20, '"images/foto7.jpg"', 'Paisaje en las montañas', '2016-06-16 16:06:13'),
('Estampida de caballos', 'Caballos salvajes corriendo juntos', '2018-09-30', 23, 22, '"images/foto8.jpg"', 'Estampida de caballos', '2018-07-06 18:47:16'),
('Corazón hecho con un libro', 'Las hojas del libro están dobladas para que formen un corazón y así representar mi amor por la lectura', '2018-10-16', 49, 27, '"images/foto9.jpg"', 'Corazón hecho con un libro', '2017-09-18 10:11:00'),
('Ópera de Sídney', 'Atardecer en la ópera de Sídney', '2018-11-12', 174, 29, '"images/foto10.jpg"', 'Ópera de Sídney', '2017-12-21 23:59:54'),
('Desierto del Sahara', 'Dunas ertenecientes al desierto del Sahara', '2017-06-21', 87, 2, '"images/foto11.jpg"', 'Desierto del Sahara', '2018-02-10 13:26:00'),
('Bosque otoñal', 'Bosque frondoso en la época del otoño', '2018-12-01', 7, 2, '"images/foto12.jpg"', 'Bosque otoñal', '2018-03-13 17:39:05');

/*SOLICITUDES*/
-- Comprueba que los ids de album sean el mismo
INSERT INTO pibd.solicitudes (Album, Nombre, Titulo, Descripcion, Email, Calle, Numero, Puerta, CP, Localidad, Provincia, Pais, Color, Copias, Resolucion, Fecha, IColor, FRegistro, Coste) VALUES
(2, 'Raquel Fernández García', 'Lo mejor de Noruega', 'Esta foto es tan especial que el álbum sólo la contiene a ella', 'raquel@gmail.com', 'Cardenal LLuch', 47, '1ºA', 41005, 'Sevilla', 'Sevilla', 49, '#FFFFFF', 2, 900, '2018-12-14', 0, '2018-11-30 17:24:04', 0.17),
(4, 'Alex Simpson', 'El búho familiar', 'Mi padre falleció y quiero mantener los mejores recuerdos que tengo con él como cuando veíamos todos los días de Navidad a este búho cerca de nuestra casa del bosque', 'alex@gmail.com', 'Pintor Luis García', 1, '3ºC', 03400, 'Villena', 'Alicante', 16, '#000000', 1, 750, '2019-01-05', 1, '2018-12-23 12:26:00', 0.12);


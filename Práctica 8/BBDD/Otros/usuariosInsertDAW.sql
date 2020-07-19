-- Se supone que el siguiente comando resetea el autoincremento pero no va, aun asi pues lo dejo ahi xD
-- ALTER TABLE usuarios AUTO_INCREMENT = 1;

insert into pibd.usuarios (NomUsuario, Clave, Email, Sexo, FNacimiento, Ciudad, Pais, Foto, FRegistro, Estilo) values
('raquel', 'praquel', 'raquel@gmail.com', 2, '1998-02-16', 'Sevilla', 49, '"images/user.jpg"', '2018-02-14 15:30:00', 1),
('alex', 'palex', 'alex@gmail.com', 1, '1995-06-24', 'Nueva York', 16, '"images/user.jpg"', '2018-10-25 12:15:00', 2),
('luther', 'pluther', 'luther@gmail.com', 1, '1969-06-29', 'Dusseldorf', 37, '"images/user.jpg"', '2018-08-01 21:48:00', 3),
('sakura', 'psakura', 'sakura@gmail.com', 2, '1999-05-01', 'Tokyo', 152, '"images/user.jpg"', '2017-12-13 01:16:00', 4),
('ragnar', 'pragnar', 'ragnar@gmail.com', 1, '1972-03-15', 'Kattegat', 76, '"images/user.jpg"', '2014-04-09 23:59:00', 1),
('violette', 'pviolette', 'violette@gmail.com', 2, '1994-09-17', 'Paris', 52, '"images/user.jpg"', '2018-01-29 06:17:00', 2),
('lin', 'plin', 'lin@gmail.com', 1, '1984-06-19', 'Hong Kong', 142, '"images/user.jpg"', '2016-05-16 12:04:00', 3),
('batbayar', 'pbatbayar', 'batbayar@gmail.com', 1, '1956-09-23', 'Darjan', 160, '"images/user.jpg"', '2018-06-05 16:14:00', 4),
('ari', 'pari', 'ari@gmail.com', 2, '1949-10-26', 'Akranes', 56, '"images/user.jpg"', '2016-02-24 19:18:00', 1),
('anne', 'panne', 'anne@gmail.com', 2, '1991-12-16', 'Brujas', 40, '"images/user.jpg"', '2017-09-21 08:26:00', 2);
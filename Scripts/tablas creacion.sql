

create DATABASE proyecto

USE proyecto

CREATE TABLE tb_rol (
  id_rol int PRIMARY KEY NOT NULL,
  nombre_rol varchar(50) NOT NULL
)

--
-- Dumping data for table tb_rol
--

INSERT INTO tb_rol (id_rol, nombre_rol) VALUES
(1, 'SA'),
(2, 'ADMIN'),
(3, 'USER');

insert into tb_sa(username, password ) VALUES('sa', 'd57997f5371953309b32e7c58552d874ab23a0eb9b96c62d871d7b8f6da1e0bb')
delete from tb_sa
create TABLE tb_sa (
  id_usuario INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
  username VARCHAR(50) UNIQUE NOT NULL,
  password VARCHAR(255) NOT NULL,
  logueado BOOLEAN NOT NULL DEFAULT false,
  id_rol INT(11) NOT NULL DEFAULT 1,
  FOREIGN KEY (id_rol) REFERENCES tb_rol(id_rol)
);

call sp_inicio_sesion_sa('sa', 'd57997f5371953309b32e7c58552d874ab23a0eb9b96c62d871d7b8f6da1e0bb')
1ba586c0b89202f7307b61f1229330978a843afc98589ffc6a62f209225d3528
select *
from tb_sa

CREATE PROCEDURE sp_inicio_sesion_sa(IN p_username VARCHAR(255), IN p_password VARCHAR(255))
BEGIN

  DECLARE hashed_password VARCHAR(64);

  SET hashed_password = SHA2(p_password, 256);

  SELECT u.id_usuario, r.nombre_rol, u.logueado
  FROM tb_sa u
  INNER JOIN tb_rol r ON u.id_rol = r.id_rol
  WHERE u.username = p_username AND u.password = hashed_password;
END

call sp_cambiar_contrasena_sa('sa', 123)

CREATE PROCEDURE sp_cambiar_contrasena_sa(IN p_id_usuario INT, IN p_nueva_contrasena VARCHAR(255))
BEGIN
  DECLARE hashed_nueva_contrasena VARCHAR(64);

  SET hashed_nueva_contrasena = SHA2(p_nueva_contrasena, 256);

  UPDATE tb_sa s
  SET s.password = hashed_nueva_contrasena, logueado = 1
  WHERE s.id_usuario = p_id_usuario;

  SELECT 1 AS cambio;
END






select *
from tb_usuario



create TABLE tb_usuario (
  id_usuario INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
  username VARCHAR(50) UNIQUE NOT NULL,
  password VARCHAR(255) NOT NULL,
  activo BOOLEAN NOT NULL DEFAULT true,
  id_rol INT(11) NOT NULL,
  FOREIGN KEY (id_rol) REFERENCES tb_rol(id_rol)
);


insert into tb_usuario(username, password, id_rol ) VALUES('sa', '1f707cd9f1548819257c8f0b432af46955e4e351a7a61236388eb5bd27cdba7c', 1)

create TABLE tb_orden (
  id_orden INT AUTO_INCREMENT PRIMARY KEY,
  nombre_orden VARCHAR(255) UNIQUE NOT NULL
);

CREATE TABLE tb_familia (
  id_familia INT AUTO_INCREMENT PRIMARY KEY,
  nombre_familia VARCHAR(255) UNIQUE NOT NULL,
  id_orden INT NOT NULL,
  FOREIGN KEY (id_orden) REFERENCES tb_orden(id_orden)
);

CREATE TABLE tb_genero_familia (
  id_genero INT NOT NULL,
  id_familia INT NOT NULL,
  PRIMARY KEY(id_genero, id_familia),
  FOREIGN KEY (id_genero) REFERENCES tb_genero(id_genero),
  FOREIGN KEY (id_familia) REFERENCES tb_familia(id_familia)
);

CREATE TABLE tb_subfamilia (
  id_subfamilia INT AUTO_INCREMENT PRIMARY KEY,
  nombre_subfamilia VARCHAR(255) UNIQUE NOT NULL,
  id_familia INT NOT NULL,
  FOREIGN KEY (id_familia) REFERENCES tb_familia(id_familia)
);

CREATE TABLE tb_genero_subfamilia (
  id_genero INT NOT NULL,
  id_subfamilia INT NOT NULL,
  PRIMARY KEY(id_genero, id_subfamilia),
  FOREIGN KEY (id_genero) REFERENCES tb_genero(id_genero),
  FOREIGN KEY (id_subfamilia) REFERENCES tb_subfamilia(id_subfamilia)
);

CREATE TABLE tb_genero (
  id_genero INT AUTO_INCREMENT PRIMARY KEY,
  nombre_genero VARCHAR(255) UNIQUE NOT NULL
);

CREATE TABLE tb_especie (
  id_especie INT AUTO_INCREMENT PRIMARY KEY,
  nombre_especie VARCHAR(255) UNIQUE NOT NULL,
  id_genero INT NOT NULL,
  FOREIGN KEY (id_genero) REFERENCES tb_genero(id_genero)
);

-- Creación de la tabla "Especimen"
CREATE TABLE tb_especimen (
  id_especimen int AUTO_INCREMENT PRIMARY KEY,
  id_etiqueta INT,
  FOREIGN KEY (id_etiqueta) REFERENCES tb_etiqueta_recoleccion(id_etiqueta)
);

-- Creación de la tabla "Especimen"
CREATE TABLE tb_especimen_especie (
  id_especimen int,
  id_especie INT,
  PRIMARY KEY(id_especimen, id_especie),
  FOREIGN KEY (id_especimen) REFERENCES tb_especimen(id_especimen),
  FOREIGN KEY (id_especie) REFERENCES tb_especie(id_especie)
);

CREATE TABLE tb_especimen_imagen (
  id_especimen_imagen INT AUTO_INCREMENT PRIMARY KEY,
  id_especimen INT,
  ruta_imagen VARCHAR(255),
  FOREIGN KEY (id_especimen) REFERENCES tb_especimen (id_especimen)
);

-- Creación de la tabla "EtiquetaRecoleccion"
CREATE TABLE tb_etiqueta_recoleccion (
  id_etiqueta INT AUTO_INCREMENT PRIMARY KEY,
  id_recoleccion INT NOT NULL,
  id_recolector INT NOT NULL,
  id_genero INT NOT NULL,
  FOREIGN KEY (id_genero) REFERENCES tb_genero(id_genero),
  FOREIGN KEY (id_recoleccion) REFERENCES tb_recoleccion(id_recoleccion),
  FOREIGN KEY (id_recolector) REFERENCES tb_recolector(id_recolector)
);

-- Creación de la tabla "Recoleccion"
CREATE TABLE tb_recoleccion (
  id_recoleccion int AUTO_INCREMENT PRIMARY KEY,
  distrito INT NOT NULL,
  latitud VARCHAR(15) NOT NULL,
  longitud VARCHAR(15) NOT NULL,
  fecha_recoleccion DATE NOT NULL,
  FOREIGN KEY (distrito) REFERENCES tb_distrito(id_distrito)
);

-- Creación de la tabla "tb_pais"
CREATE TABLE tb_pais (
  id_pais INT AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(255) NOT NULL
);

-- Creación de la tabla "tb_provincia"
CREATE TABLE tb_provincia (
  id_provincia INT AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(255) NOT NULL,
  id_pais INT,
  FOREIGN KEY (id_pais) REFERENCES tb_pais(id_pais)
);

-- Creación de la tabla "tb_canton"
CREATE TABLE tb_canton (
  id_canton INT AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(255) NOT NULL,
  id_provincia INT,
  FOREIGN KEY (id_provincia) REFERENCES tb_provincia(id_provincia)
);

-- Creación de la tabla "tb_distrito"
CREATE TABLE tb_distrito (
  id_distrito INT AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(255) NOT NULL,
  id_canton INT,
  FOREIGN KEY (id_canton) REFERENCES tb_canton(id_canton)
);

-- Creación de la tabla "Recolector"
CREATE TABLE tb_recolector (
  id_recolector int AUTO_INCREMENT PRIMARY KEY,
  inicial_nombre CHAR(1) NOT NULL,
  primer_apellido VARCHAR(255) NOT NULL
);

CREATE TABLE tb_gabinete (
  id INT NOT NULL AUTO_INCREMENT,
  numero_gabinete INT NOT NULL,
  PRIMARY KEY (id),
  UNIQUE (numero_gabinete)
);

CREATE TABLE tb_gaveta (
  id INT NOT NULL AUTO_INCREMENT,
  numero_gaveta INT NOT NULL,
  id_gabinete INT NOT NULL,
  PRIMARY KEY (id),
  UNIQUE (numero_gaveta, id_gabinete),
  FOREIGN KEY (id_gabinete) REFERENCES tb_gabinete (id)
);

CREATE TABLE tb_caja (
  id INT NOT NULL AUTO_INCREMENT,
  numero_caja INT NOT NULL,
  PRIMARY KEY (id),
  UNIQUE (numero_caja)
);

CREATE TABLE tb_vial (
  id INT NOT NULL AUTO_INCREMENT,
  id_caja INT NOT NULL,
  numero_vial INT NOT NULL,
  PRIMARY KEY (id),
  FOREIGN KEY (id_caja) REFERENCES tb_caja (id),
  UNIQUE (numero_vial, id_caja)
);

CREATE TABLE tb_gaveta_especimen (
  id_gaveta INT NOT NULL,
  id_especimen INT NOT NULL,
  PRIMARY KEY (id_gaveta, id_especimen),
  FOREIGN KEY (id_gaveta) REFERENCES tb_gaveta (id),
  FOREIGN KEY (id_especimen) REFERENCES tb_especimen (id_especimen)
);

CREATE TABLE tb_vial_especimen (
  id_vial INT NOT NULL,
  id_especimen INT NOT NULL,
  PRIMARY KEY (id_vial, id_especimen),
  FOREIGN KEY (id_vial) REFERENCES tb_vial (id),
  FOREIGN KEY (id_especimen) REFERENCES tb_especimen (id_especimen)
);

CREATE TABLE tb_registro (
  id int(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
  id_usuario int(11) DEFAULT NULL,
  descripcion text DEFAULT NULL,
  fecha date DEFAULT curdate(),
  FOREIGN KEY (id_usuario) REFERENCES tb_usuario (id_usuario)
);


CREATE TABLE tb_visto_genero (
  id_usuario INT,
  id_genero INT,
  PRIMARY KEY (id_genero, id_usuario),
  FOREIGN KEY (id_usuario) REFERENCES tb_usuario (id_usuario),
  FOREIGN KEY (id_genero) REFERENCES tb_genero (id_genero)
);

CREATE TABLE tb_visto_especie (
  id_usuario INT,
  id_especie INT,
  PRIMARY KEY (id_especie, id_usuario),
  FOREIGN KEY (id_usuario) REFERENCES tb_usuario (id_usuario),
  FOREIGN KEY (id_especie) REFERENCES tb_especie (id_especie)
);

CREATE TABLE tb_carrito_genero (
  id_usuario INT,
  id_genero INT,
  PRIMARY KEY (id_genero, id_usuario),
  FOREIGN KEY (id_usuario) REFERENCES tb_usuario (id_usuario),
  FOREIGN KEY (id_genero) REFERENCES tb_genero (id_genero)
);

CREATE TABLE tb_carrito_especie (
  id_usuario INT,
  id_especie INT,
  PRIMARY KEY (id_especie, id_usuario),
  FOREIGN KEY (id_usuario) REFERENCES tb_usuario (id_usuario),
  FOREIGN KEY (id_especie) REFERENCES tb_especie (id_especie)
);


create TABLE tb_historial_especie (
  id int PRIMARY KEY AUTO_INCREMENT,
  id_usuario int(11) NOT NULL,
  id_especie int(11) NOT NULL,
  fecha datetime NOT NULL,
  FOREIGN KEY (id_usuario) REFERENCES tb_usuario (id_usuario),
  FOREIGN KEY (id_especie) REFERENCES tb_especie (id_especie)
);

create TABLE tb_historial_genero (
    id int PRIMARY KEY AUTO_INCREMENT,
  id_usuario int(11) NOT NULL,
  id_genero int(11) NOT NULL,
  fecha datetime NOT NULL,
  FOREIGN KEY (id_usuario) REFERENCES tb_usuario (id_usuario),
  FOREIGN KEY (id_genero) REFERENCES tb_genero (id_genero)
);

CREATE TABLE tb_planta (
  id_planta int(11) NOT NULL AUTO_INCREMENT,
  nombre VARCHAR(100) NOT NULL,
  PRIMARY KEY (id_planta)
);

CREATE TABLE tb_planta_genero (
  id_genero int(11) NOT NULL,
  id_planta int(11) NOT NULL,
  PRIMARY KEY (id_genero, id_planta),
  FOREIGN KEY (id_genero) REFERENCES tb_genero (id_genero),
  FOREIGN KEY (id_planta) REFERENCES tb_planta (id_planta)
);

CREATE TABLE tb_recomendaciones (
  id_usuario INT,
  id_especimen INT,
  PRIMARY KEY (id_usuario, id_especimen),
  FOREIGN KEY (id_usuario) REFERENCES tb_usuario(id_usuario),
  FOREIGN KEY (id_especimen) REFERENCES tb_especimen(id_especimen)
);

-- Inserts en la tabla "Orden"
INSERT INTO tb_orden (nombre_orden) VALUES ('Carnivora');
INSERT INTO tb_orden (nombre_orden) VALUES ('Primates');
INSERT INTO tb_orden (nombre_orden) VALUES ('Rodentia');

-- Inserts en la tabla "Familia"
INSERT INTO tb_familia (nombre_familia, id_orden) VALUES ('Felidae', 1);
INSERT INTO tb_familia (nombre_familia, id_orden) VALUES ('Canidae', 1);
INSERT INTO tb_familia (nombre_familia, id_orden) VALUES ('Hominidae', 2);
INSERT INTO tb_familia (nombre_familia, id_orden) VALUES ('Cercopithecidae', 2);
INSERT INTO tb_familia (nombre_familia, id_orden) VALUES ('Muridae', 3);

-- Inserts en la tabla "Subfamilia"
INSERT INTO tb_subfamilia (nombre_subfamilia, id_familia) VALUES ('Felinae', 1);
INSERT INTO tb_subfamilia (nombre_subfamilia, id_familia) VALUES ('Caninae', 2);
INSERT INTO tb_subfamilia (nombre_subfamilia, id_familia) VALUES ('Homininae', 3);
INSERT INTO tb_subfamilia (nombre_subfamilia, id_familia) VALUES ('Cercopithecinae', 4);

-- Inserts en la tabla "Genero"
INSERT INTO tb_genero (nombre_genero, id_familia, id_subfamilia) VALUES ('Panthera', 1, 1);
INSERT INTO tb_genero (nombre_genero, id_familia, id_subfamilia) VALUES ('Canis', 2, 2);
INSERT INTO tb_genero (nombre_genero, id_familia, id_subfamilia) VALUES ('Homo', 3, 3);
INSERT INTO tb_genero (nombre_genero, id_familia, id_subfamilia) VALUES ('Macaca', 4, 4);

-- Inserts en la tabla "Especie"
INSERT INTO tb_especie (nombre_especie, id_genero) VALUES ('leo', 1);
INSERT INTO tb_especie (nombre_especie, id_genero) VALUES ('tigris', 1);
INSERT INTO tb_especie (nombre_especie, id_genero) VALUES ('lupus', 2);
INSERT INTO tb_especie (nombre_especie, id_genero) VALUES ('familiaris', 2);
INSERT INTO tb_especie (nombre_especie, id_genero) VALUES ('sapiens', 3);
INSERT INTO tb_especie (nombre_especie, id_genero) VALUES ('mulatta', 4);
INSERT INTO tb_especie (nombre_especie, id_genero) VALUES ('fuscata', 4);


insert into tb_recolector(inicial_nombre, primer_apellido) value('s', 'Arias')


-- Inserción de datos en la tabla "tb_pais"
INSERT INTO tb_pais (nombre) VALUES ('Costa Rica');

-- Inserción de datos en la tabla "tb_provincia"
INSERT INTO tb_provincia (nombre, id_pais) VALUES ('San José', 1);
INSERT INTO tb_provincia (nombre, id_pais) VALUES ('Alajuela', 1);
INSERT INTO tb_provincia (nombre, id_pais) VALUES ('Cartago', 1);
-- Inserta más provincias según sea necesario, asegurándote de proporcionar el id del país correspondiente

-- Inserción de datos en la tabla "tb_canton"
INSERT INTO tb_canton (nombre, id_provincia) VALUES ('San José', 1);
INSERT INTO tb_canton (nombre, id_provincia) VALUES ('Escazú', 1);
INSERT INTO tb_canton (nombre, id_provincia) VALUES ('Desamparados', 1);
-- Inserta más cantones según sea necesario, asegurándote de proporcionar el id de la provincia correspondiente

-- Inserción de datos en la tabla "tb_distrito"
INSERT INTO tb_distrito (nombre, id_canton) VALUES ('Carmen', 1);
INSERT INTO tb_distrito (nombre, id_canton) VALUES ('Merced', 1);
INSERT INTO tb_distrito (nombre, id_canton) VALUES ('Hospital', 1);
-- Inserta más distritos según sea necesario, asegurándote de proporcionar el id del cantón correspondiente


--
-- Dumping data for table `tb_registro`
--

INSERT INTO tb_registro (id, id_usuario, descripcion, fecha) VALUES
(0, 1, 'Se registró el orden Orden 1', '2023-06-06'),
(0, 1, 'Se registró la familia Familia 1', '2023-06-06'),
(0, 1, 'Se registró la subfamilia Sub familia 1', '2023-06-06'),
(0, 1, 'Se registró el género Genero 1', '2023-06-06'),
(0, 1, 'Se registró le especimen 1', '2023-06-06'),
(0, 1, 'Se registró le especimen 1', '2023-06-06'),
(0, 1, 'Se registró le especimen 1', '2023-06-06'),
(0, 1, 'Se registró el género genero 2', '2023-06-06'),
(0, 1, 'Se registró le especimen 2', '2023-06-06'),
(0, 1, 'Se registró el orden orden x', '2023-06-06'),
(0, 1, 'Se registró la familia 2', '2023-06-11'),
(0, 1, 'Se registró la familia 3', '2023-06-11'),
(0, 1, 'Se registró la familia 4', '2023-06-11'),
(0, 1, 'Se registró la familia 1', '2023-06-11'),
(0, 1, 'Se registró la familia 2', '2023-06-11'),
(0, 1, 'Se registró la especie as', '2023-06-11'),
(0, 1, 'Se registró la especie dsd', '2023-06-11'),
(0, 1, 'Se registró la subfamilia 213123', '2023-06-11'),
(0, 1, 'Se registró la familia Familia 1', '2023-06-12'),
(0, 1, 'Se registró la familia Familia 2', '2023-06-12'),
(0, 1, 'Se registró la familia Familia 3', '2023-06-12'),
(0, 1, 'Se registró la familia Familia 1', '2023-06-12'),
(0, 1, 'Se registró la familia Familia 2', '2023-06-12'),
(0, 1, 'Se registró la subfamilia ASDASD', '2023-06-12'),
(0, 1, 'Se registró la subfamilia W', '2023-06-12'),
(0, 1, 'Se registró la subfamilia QW', '2023-06-12'),
(0, 1, 'Se registró la subfamilia RER', '2023-06-12'),
(0, 1, 'Se registró la familia Familia 2', '2023-06-12'),
(0, 1, 'Se registró la subfamilia RER', '2023-06-12'),
(0, 1, 'Se registró la subfamilia ASDASD', '2023-06-12'),
(0, 1, 'Se registró el género dfssd', '2023-06-12'),
(0, 1, 'Se registró el género dfssdd', '2023-06-12'),
(0, 1, 'Se registró la especie dfgdfg', '2023-06-12'),
(0, 1, 'Se registró la especie dfgdfg', '2023-06-12'),
(0, 1, 'Se registró el género s', '2023-06-12'),
(0, 1, 'Se registró el género sss', '2023-06-12'),
(0, 1, 'Se registró el género www', '2023-06-12'),
(0, 1, 'Se registró el género wwwjj', '2023-06-12');











CREATE PROCEDURE sp_buscar_orden_asc (IN busqueda VARCHAR(100), IN p_page_number INT)
BEGIN
  DECLARE p_offset INT;
  DECLARE p_limit INT;
  DECLARE total_pages INT;

  DECLARE EXIT HANDLER FOR SQLEXCEPTION
  BEGIN
    SELECT NULL AS username;
  END;

  SET p_limit = 5;
  SET p_offset = (p_page_number - 1) * p_limit;

  SELECT COUNT(*) INTO total_pages FROM tb_orden;

  IF p_offset >= total_pages THEN
    SELECT NULL AS username;
  ELSE
    SELECT o.nombre_orden AS orden,
        COUNT(DISTINCT f.id_familia) AS numero_familias,
        COUNT(DISTINCT sf.id_subfamilia) AS numero_subfamilias,
        COUNT(DISTINCT gf.id_genero) AS numero_generos,
        COUNT(DISTINCT e.id_especie) AS numero_especies,
        (COUNT(DISTINCT f.id_familia) + COUNT(DISTINCT sf.id_subfamilia) + COUNT(DISTINCT gf.id_genero) + COUNT(DISTINCT e.id_especie)) AS total
    FROM tb_orden o
    LEFT JOIN tb_familia f ON o.id_orden = f.id_orden
    LEFT JOIN tb_subfamilia sf ON sf.id_familia = f.id_familia
    LEFT JOIN tb_genero_familia gf ON gf.id_familia = f.id_familia
    LEFT JOIN tb_genero_subfamilia gs ON gs.id_subfamilia = sf.id_subfamilia
    LEFT JOIN tb_genero g ON g.id_genero = gf.id_genero OR g.id_genero = gs.id_genero
    LEFT JOIN tb_especie e ON e.id_genero = g.id_genero
    WHERE o.nombre_orden LIKE CONCAT('%', busqueda, '%')
    GROUP BY o.id_orden, o.nombre_orden
    ORDER BY total ASC
    LIMIT p_offset, p_limit;
  END IF;
END;

CREATE PROCEDURE sp_buscar_orden_desc (IN busqueda VARCHAR(100), IN p_page_number INT)
BEGIN
  DECLARE p_offset INT;
  DECLARE p_limit INT;
  DECLARE total_pages INT;

  DECLARE EXIT HANDLER FOR SQLEXCEPTION
  BEGIN
    SELECT NULL AS username;
  END;

  SET p_limit = 5;
  SET p_offset = (p_page_number - 1) * p_limit;

  SELECT COUNT(*) INTO total_pages FROM tb_orden;

  IF p_offset >= total_pages THEN
    SELECT NULL AS username;
  ELSE
    SELECT o.nombre_orden AS orden,
        COUNT(DISTINCT f.id_familia) AS numero_familias,
        COUNT(DISTINCT sf.id_subfamilia) AS numero_subfamilias,
        COUNT(DISTINCT gf.id_genero) AS numero_generos,
        COUNT(DISTINCT e.id_especie) AS numero_especies,
        (COUNT(DISTINCT f.id_familia) + COUNT(DISTINCT sf.id_subfamilia) + COUNT(DISTINCT gf.id_genero) + COUNT(DISTINCT e.id_especie)) AS total
    FROM tb_orden o
    LEFT JOIN tb_familia f ON o.id_orden = f.id_orden
    LEFT JOIN tb_subfamilia sf ON sf.id_familia = f.id_familia
    LEFT JOIN tb_genero_familia gf ON gf.id_familia = f.id_familia
    LEFT JOIN tb_genero_subfamilia gs ON gs.id_subfamilia = sf.id_subfamilia
    LEFT JOIN tb_genero g ON g.id_genero = gf.id_genero OR g.id_genero = gs.id_genero
    LEFT JOIN tb_especie e ON e.id_genero = g.id_genero
    WHERE o.nombre_orden LIKE CONCAT('%', busqueda, '%')
    GROUP BY o.id_orden, o.nombre_orden
    ORDER BY total DESC
    LIMIT p_offset, p_limit;
  END IF;
END;



CREATE PROCEDURE sp_buscar_familia_asc (IN busqueda VARCHAR(100), IN p_page_number INT)
BEGIN
  DECLARE p_offset INT;
  DECLARE p_limit INT;
  DECLARE total_pages INT;

  DECLARE EXIT HANDLER FOR SQLEXCEPTION
  BEGIN
    SELECT NULL AS username;
  END;

  SET p_limit = 5;
  SET p_offset = (p_page_number - 1) * p_limit;

  SELECT COUNT(*) INTO total_pages FROM tb_familia WHERE nombre_familia LIKE CONCAT('%', busqueda, '%');

  IF p_offset >= total_pages THEN
    SELECT NULL AS username;
  ELSE
    SELECT f.id_familia, f.nombre_familia AS familia, COUNT(DISTINCT sf.id_subfamilia) AS numero_subfamilias, COUNT(DISTINCT gf.id_genero) AS numero_generos, 
    COUNT(DISTINCT e.id_especie) AS numero_especies,
    (COUNT(DISTINCT sf.id_subfamilia) + COUNT(DISTINCT gf.id_genero) + COUNT(DISTINCT e.id_especie)) AS total
    FROM tb_familia f
    LEFT JOIN tb_subfamilia sf ON sf.id_familia = f.id_familia
    LEFT JOIN tb_genero_familia gf ON gf.id_familia = f.id_familia
    LEFT JOIN tb_genero_subfamilia gs ON gs.id_subfamilia = sf.id_subfamilia
    LEFT JOIN tb_genero g ON g.id_genero = gf.id_genero OR g.id_genero = gs.id_genero
    LEFT JOIN tb_especie e ON e.id_genero = g.id_genero
    WHERE f.nombre_familia LIKE CONCAT('%', busqueda, '%')
    GROUP BY f.id_familia, f.nombre_familia
    ORDER BY total ASC
    LIMIT p_offset, p_limit;
  END IF;
END;

CREATE PROCEDURE sp_buscar_familia_desc (IN busqueda VARCHAR(100), IN p_page_number INT)
BEGIN
  DECLARE p_offset INT;
  DECLARE p_limit INT;
  DECLARE total_pages INT;

  DECLARE EXIT HANDLER FOR SQLEXCEPTION
  BEGIN
    SELECT NULL AS username;
  END;

  SET p_limit = 5;
  SET p_offset = (p_page_number - 1) * p_limit;

  SELECT COUNT(*) INTO total_pages FROM tb_familia WHERE nombre_familia LIKE CONCAT('%', busqueda, '%');

  IF p_offset >= total_pages THEN
    SELECT NULL AS username;
  ELSE
    SELECT f.id_familia, f.nombre_familia AS familia, COUNT(DISTINCT sf.id_subfamilia) AS numero_subfamilias, COUNT(DISTINCT gf.id_genero) AS numero_generos, 
    COUNT(DISTINCT e.id_especie) AS numero_especies,
    (COUNT(DISTINCT sf.id_subfamilia) + COUNT(DISTINCT gf.id_genero) + COUNT(DISTINCT e.id_especie)) AS total
    FROM tb_familia f
    LEFT JOIN tb_subfamilia sf ON sf.id_familia = f.id_familia
    LEFT JOIN tb_genero_familia gf ON gf.id_familia = f.id_familia
    LEFT JOIN tb_genero_subfamilia gs ON gs.id_subfamilia = sf.id_subfamilia
    LEFT JOIN tb_genero g ON g.id_genero = gf.id_genero OR g.id_genero = gs.id_genero
    LEFT JOIN tb_especie e ON e.id_genero = g.id_genero
    WHERE f.nombre_familia LIKE CONCAT('%', busqueda, '%')
    GROUP BY f.id_familia, f.nombre_familia
    ORDER BY total DESC
    LIMIT p_offset, p_limit;
  END IF;
END;





































call sp_buscar_orden_desc('a', 2)
CREATE PROCEDURE sp_buscar_orden_desc (IN busqueda VARCHAR(100), IN p_page_number INT)
BEGIN
  DECLARE p_offset INT;
  DECLARE p_limit INT;
  DECLARE total_pages INT;

  DECLARE EXIT HANDLER FOR SQLEXCEPTION
  BEGIN
    SELECT NULL AS username;
  END;

  SET p_limit = 5;
  SET p_offset = (p_page_number - 1) * p_limit;

  SELECT COUNT(*) INTO total_pages FROM tb_orden;

  IF p_offset >= total_pages THEN
    SELECT NULL AS username;
  ELSE
    SELECT o.nombre AS orden,
        COUNT(DISTINCT f.id_familia) AS numero_familias,
        COUNT(DISTINCT sf.id_subfamilia) AS numero_subfamilias,
        COUNT(DISTINCT g.id_genero) AS numero_generos,
        COUNT(DISTINCT e.id_especie) AS numero_especies,
        (COUNT(DISTINCT f.id_familia) + COUNT(DISTINCT sf.id_subfamilia) + COUNT(DISTINCT g.id_genero) + COUNT(DISTINCT e.id_especie)) AS total
    FROM tb_orden o
    LEFT JOIN tb_familia f ON o.id_orden = f.orden
    LEFT JOIN tb_subfamilia sf ON sf.familia = f.id_familia
    LEFT JOIN tb_genero g ON sf.id_subfamilia = g.subfamilia
    LEFT JOIN tb_especie e ON g.id_genero = e.genero
    WHERE o.nombre LIKE CONCAT('%', busqueda, '%')
    GROUP BY o.id_orden, o.nombre
    ORDER BY total DESC
    LIMIT p_offset, p_limit;
  END IF;
END;











-- Procedimientos

create PROCEDURE sp_registrar_usuario (
  IN p_username VARCHAR(50),
  IN p_password VARCHAR(255),
  IN p_rol INT
)
BEGIN
  DECLARE hashed_password VARCHAR(64);
  DECLARE last_inserted_username VARCHAR(50);

  DECLARE EXIT HANDLER FOR SQLEXCEPTION
  BEGIN
    SELECT NULL AS username;
  END;
  
  SET hashed_password = SHA2(p_password, 256);
  
  INSERT INTO tb_usuario (username, password, id_rol)
  VALUES (p_username, hashed_password, p_rol);
  
  SELECT p_username AS username;
END



CREATE PROCEDURE sp_inicio_sesion_usuario(IN p_username VARCHAR(255), IN p_password VARCHAR(255))
BEGIN
  DECLARE hashed_password VARCHAR(64);
  
  SET hashed_password = SHA2(p_password, 256);
  
  SELECT u.id_usuario, r.nombre_rol
  FROM tb_usuario u
  INNER JOIN tb_rol r ON u.id_rol = r.id_rol
  WHERE u.username = p_username AND u.password = hashed_password;
END

CREATE PROCEDURE sp_listar_orden()
BEGIN
    SELECT id_orden, nombre_orden FROM tb_orden;
END

CREATE PROCEDURE sp_listar_familia_por_orden (IN orden INT)   BEGIN
    SELECT id_familia, nombre_familia FROM tb_familia WHERE id_orden = orden;
END

CREATE PROCEDURE sp_listar_subfamilias_por_familia (IN familia INT)   BEGIN
    SELECT id_subfamilia, nombre_subfamilia FROM tb_subfamilia WHERE id_familia = familia;
END

CREATE PROCEDURE sp_listar_genero_por_subfamilia (IN subfamilia INT)   BEGIN
    SELECT id_genero, nombre_genero FROM tb_genero WHERE id_subfamilia = subfamilia;
END

CREATE PROCEDURE sp_listar_genero_por_familia (IN familia INT)   BEGIN
    SELECT id_genero, nombre_genero FROM tb_genero WHERE id_familia = familia;
END


CREATE PROCEDURE sp_listar_genero_por_subfamilia (IN p_subfamilia INT)
BEGIN
  SELECT g.id_genero, g.nombre_genero
  FROM tb_genero g
  INNER JOIN tb_genero_subfamilia gs ON g.id_genero = gs.id_genero
  WHERE gs.id_subfamilia = p_subfamilia;
END

CREATE PROCEDURE sp_listar_genero_por_familia (IN p_familia INT)
BEGIN
  SELECT g.id_genero, g.nombre_genero
  FROM tb_genero g
  INNER JOIN tb_genero_familia gf ON g.id_genero = gf.id_genero
  WHERE gf.id_familia = p_familia;
END

CREATE PROCEDURE sp_listar_especies_por_genero (IN genero INT) 
BEGIN
select id_especie,nombre_especie
FROM tb_especie WHERE id_genero=genero;
END

call sp_listar_especies_por_genero(1)

select *
from tb_especie

call sp_listar_pais()
CREATE PROCEDURE sp_listar_pais()
BEGIN
    SELECT * FROM tb_pais;
END

call sp_provincia_por_pais(1)
CREATE PROCEDURE sp_provincia_por_pais(IN pais_id INT)
BEGIN
    SELECT id_provincia, nombre 
    FROM tb_provincia
    WHERE id_pais = pais_id;
END

call sp_canton_por_provincia(1)
CREATE PROCEDURE sp_canton_por_provincia(IN provincia_id INT)
BEGIN
    SELECT id_canton, nombre 
    FROM tb_canton
    WHERE id_provincia = provincia_id;
END

call sp_distrito_por_canton(1)
CREATE PROCEDURE sp_distrito_por_canton(IN canton_id INT)
BEGIN
    SELECT id_distrito, nombre 
    FROM tb_distrito
    WHERE id_canton = canton_id;
END


CALL sp_obtener_recolectores
CREATE PROCEDURE sp_obtener_recolectores()
BEGIN
    SELECT *
    FROM tb_recolector;
END




CREATE PROCEDURE sp_get_all_cajas ()   BEGIN
  SELECT *
  FROM tb_caja;
END

CREATE PROCEDURE sp_get_all_gabinetes ()   BEGIN
  SELECT *
  FROM tb_gabinete;
END

CREATE PROCEDURE sp_get_all_gavetas (IN p_id_gabinete INT)   BEGIN
  SELECT id, numero_gaveta
  FROM tb_gaveta
  WHERE id_gabinete = p_id_gabinete;
END

CREATE PROCEDURE sp_get_all_viales (IN p_id_caja INT)   BEGIN
  SELECT id, numero_vial
  FROM tb_vial
  WHERE id_caja = p_id_caja;
END



CREATE PROCEDURE BuscarRegistrosPorAnoPaginado (IN p_ano INT, IN p_page_number INT)   BEGIN
  DECLARE p_limit INT DEFAULT 5;
  DECLARE p_offset INT;
  DECLARE total_pages INT;
  DECLARE EXIT HANDLER FOR SQLEXCEPTION
  BEGIN
    SELECT NULL AS username;
  END;

  SET p_offset = (p_page_number - 1) * p_limit;

  SELECT COUNT(*) INTO total_pages
  FROM tb_registro r
  INNER JOIN tb_usuario u ON r.id_usuario = u.id_usuario
  WHERE YEAR(r.fecha) = p_ano;

  IF p_offset >= total_pages THEN
    SELECT NULL AS username;
  ELSE
    SELECT r.descripcion, r.fecha, u.username
    FROM tb_registro r
    INNER JOIN tb_usuario u ON r.id_usuario = u.id_usuario
    WHERE YEAR(r.fecha) = p_ano
    ORDER BY r.id
    LIMIT p_offset, p_limit;

  END IF;
END




CREATE PROCEDURE BuscarPorRangoFechasPaginado (IN fechaInicio DATE, IN fechaFin DATE, IN p_page_number INT)   BEGIN
  DECLARE p_limit INT DEFAULT 5;
  DECLARE p_offset INT;
  DECLARE total_pages INT;
  DECLARE EXIT HANDLER FOR SQLEXCEPTION
  BEGIN
    SELECT NULL AS username;
  END;

  SET p_offset = (p_page_number - 1) * p_limit;

  SELECT COUNT(*) INTO total_pages
  FROM tb_registro r
  INNER JOIN tb_usuario u ON r.id_usuario = u.id_usuario
  WHERE r.fecha >= fechaInicio AND r.fecha <= fechaFin;

  IF p_offset >= total_pages THEN
    SELECT NULL AS username;
  ELSE

    SELECT r.descripcion, r.fecha, u.username
    FROM tb_registro r
    INNER JOIN tb_usuario u ON r.id_usuario = u.id_usuario
    WHERE r.fecha >= fechaInicio AND r.fecha <= fechaFin
    ORDER BY r.id
    LIMIT p_offset, p_limit;

  END IF;
END

CREATE PROCEDURE sp_get_users_by_page (IN p_page_number INT)   BEGIN
  DECLARE p_offset INT;
  DECLARE p_limit INT;
  DECLARE total_pages INT;

  DECLARE EXIT HANDLER FOR SQLEXCEPTION
  BEGIN
    SELECT NULL AS username;
  END;

  SET p_limit = 5;
  SET p_offset = (p_page_number - 1) * p_limit;

  SELECT COUNT(*) INTO total_pages FROM tb_usuario;

  IF p_offset >= total_pages THEN
    SELECT NULL AS username;
  ELSE
    SELECT u.username, r.nombre_rol, u.activo
    FROM tb_usuario u
    JOIN tb_rol r ON u.id_rol = r.id_rol
    ORDER BY u.id_usuario
    LIMIT p_offset, p_limit;
  END IF;
END

select *
from tb_usuario



CREATE PROCEDURE sp_update_user_activo (IN p_username VARCHAR(50))   BEGIN
  DECLARE EXIT HANDLER FOR SQLEXCEPTION
  BEGIN
    SELECT NULL AS username;
  END;
  UPDATE tb_usuario
  SET activo = NOT activo
  WHERE username = p_username;
  SELECT p_username AS username;
END


CREATE PROCEDURE sp_insertar_orden (IN p_nombre VARCHAR(50), IN p_id_usuario INT)   BEGIN
  DECLARE EXIT HANDLER FOR SQLEXCEPTION
  BEGIN
    SELECT NULL AS nombre;
  END;
  INSERT INTO tb_registro (id_usuario, descripcion) VALUES (p_id_usuario, CONCAT('Se registró el orden ', p_nombre));
  INSERT INTO tb_orden (nombre_orden) VALUES (p_nombre);
  SELECT p_nombre as nombre;
END

CREATE PROCEDURE sp_insertar_familia (IN p_nombre VARCHAR(100), IN p_orden INT, IN p_id_usuario INT)   BEGIN
    DECLARE v_id_familia INT;
  DECLARE EXIT HANDLER FOR SQLEXCEPTION
  BEGIN
    select NULL AS nombre;
  END;
  INSERT INTO tb_registro (id_usuario, descripcion) VALUES (p_id_usuario, CONCAT('Se registró la familia ', p_nombre));
  INSERT INTO tb_familia (nombre_familia, id_orden) VALUES (p_nombre, p_orden);
 SELECT p_nombre AS nombre;
END



CREATE PROCEDURE sp_insertar_subfamilia (IN p_nombre VARCHAR(100), IN p_familia INT, IN p_id_usuario INT)   BEGIN
  DECLARE EXIT HANDLER FOR SQLEXCEPTION
  BEGIN
    select NULL AS nombre;
  END;
  INSERT INTO tb_registro (id_usuario, descripcion) VALUES (p_id_usuario, CONCAT('Se registró la subfamilia ', p_nombre));
  INSERT INTO tb_subfamilia (nombre_subfamilia, id_familia) VALUES (p_nombre, p_familia);
  select p_nombre AS nombre;
END


call sp_insertar_genero_subfamilia('subfamilia1', 1, 1)
create PROCEDURE sp_insertar_genero_subfamilia (IN p_nombre VARCHAR(100), IN p_subfamilia INT, IN p_id_usuario INT)   BEGIN
 DECLARE v_id_genero INT;
  DECLARE EXIT HANDLER FOR SQLEXCEPTION
  BEGIN
    select NULL AS nombre;
  END;
  INSERT INTO tb_registro (id_usuario, descripcion) VALUES (p_id_usuario, CONCAT('Se registró el género ', p_nombre));
  INSERT INTO tb_genero (nombre_genero, id_subfamilia) VALUES (p_nombre, p_subfamilia);
 select p_nombre AS nombre;
END

call sp_insertar_genero_familia('genero2', 1, 1)

create PROCEDURE sp_insertar_genero_familia (IN p_nombre VARCHAR(100), IN p_familia INT, IN p_id_usuario INT)   BEGIN
 DECLARE v_id_genero INT;
  DECLARE EXIT HANDLER FOR SQLEXCEPTION
  BEGIN
    select NULL AS nombre;
  END;
    INSERT INTO tb_genero (nombre_genero, id_familia) VALUES (p_nombre, p_familia);
  INSERT INTO tb_registro (id_usuario, descripcion) VALUES (p_id_usuario, CONCAT('Se registró el género ', p_nombre));

 select p_nombre AS nombre;
END

select *
from tb_genero




CREATE PROCEDURE sp_insertar_especie (IN p_nombre VARCHAR(100), IN p_genero INT, IN p_id_usuario INT)   BEGIN
  DECLARE EXIT HANDLER FOR SQLEXCEPTION
  BEGIN
    select NULL AS nombre;
  END;
  INSERT INTO tb_registro (id_usuario, descripcion) VALUES (p_id_usuario, CONCAT('Se registró la especie ', p_nombre));
  INSERT INTO tb_especie (nombre_especie, id_genero) VALUES (p_nombre, p_genero);
 select p_nombre AS nombre;
END









CREATE PROCEDURE sp_registrar_pais(
    IN nombre_pais VARCHAR(255)
)
BEGIN
    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
        SELECT NULL AS nombre_pais;
    END;
    
    INSERT INTO tb_pais (nombre) VALUES (nombre_pais);
    SELECT nombre_pais;
END

CREATE PROCEDURE sp_registrar_provincia(
    IN nombre_provincia VARCHAR(255),
    IN id_pais INT
)
BEGIN
    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
        SELECT NULL AS nombre_provincia;
    END;
    
    INSERT INTO tb_provincia (nombre, id_pais) VALUES (nombre_provincia, id_pais);
    SELECT nombre_provincia;
END

CREATE PROCEDURE sp_registrar_canton(
    IN nombre_canton VARCHAR(255),
    IN id_provincia INT
)
BEGIN
    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
        SELECT NULL AS nombre_canton;
    END;
    
    INSERT INTO tb_canton (nombre, id_provincia) VALUES (nombre_canton, id_provincia);
    SELECT nombre_canton;
END

CREATE PROCEDURE sp_registrar_distrito(
    IN nombre_distrito VARCHAR(255),
    IN id_canton INT
)
BEGIN
    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
        SELECT NULL AS nombre_distrito;
    END;
    
    INSERT INTO tb_distrito (nombre, id_canton) VALUES (nombre_distrito, id_canton);
    SELECT nombre_distrito;
END




CREATE PROCEDURE sp_insertar_recolector(
    IN p_inicial_nombre CHAR(1),
    IN p_primer_apellido VARCHAR(255)
)
BEGIN

    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
        SELECT NULL AS p_primer_apellido;
    END;

    INSERT INTO tb_recolector (inicial_nombre, primer_apellido)
    VALUES (p_inicial_nombre, p_primer_apellido);

    SELECT p_primer_apellido;
END




CREATE PROCEDURE sp_get_all_gavetas (IN p_id_gabinete INT)   BEGIN
  SELECT id, numero_gaveta
  FROM tb_gaveta
  WHERE id_gabinete = p_id_gabinete;
END

call sp_get_all_gavetas(1)


select *
from tb_gaveta

CREATE PROCEDURE sp_insertar_gabinete (IN p_numero_gabinete VARCHAR(100))   BEGIN
  DECLARE EXIT HANDLER FOR SQLEXCEPTION
  BEGIN
    SELECT null AS numero_gabinete;
  END;
  INSERT INTO tb_gabinete (numero_gabinete) VALUES (p_numero_gabinete);
  SELECT p_numero_gabinete as numero_gabinete;
END


CREATE PROCEDURE sp_insertar_gaveta (IN p_numero_gaveta INT, IN p_id_gabinete INT)   BEGIN
  DECLARE EXIT HANDLER FOR SQLEXCEPTION
  BEGIN
    SELECT NULL AS numero_gaveta;
  END;

  INSERT INTO tb_gaveta (numero_gaveta, id_gabinete) VALUES (p_numero_gaveta, p_id_gabinete);
  SELECT p_numero_gaveta AS numero_gaveta;
END

call sp_insertar_gaveta(3,1)

CREATE PROCEDURE sp_insertar_caja (IN p_numero_caja INT)   BEGIN
  DECLARE EXIT HANDLER FOR SQLEXCEPTION
  BEGIN
    SELECT null AS numero_caja;
  END;

  INSERT INTO tb_caja (numero_caja) VALUES (p_numero_caja);
  SELECT p_numero_caja AS numero_caja;
ENDc

call sp_insertar_caja(1)

CREATE PROCEDURE sp_insertar_vial (IN p_numero_vial INT, IN p_id_caja INT)   BEGIN
  DECLARE EXIT HANDLER FOR SQLEXCEPTION
  BEGIN
    SELECT NULL AS numero_vial;
  END;
  INSERT INTO tb_vial (numero_vial, id_caja) VALUES (p_numero_vial, p_id_caja);
  SELECT p_numero_vial AS numero_vial;
END

call sp_insertar_vial(1,1)







CREATE PROCEDURE sp_insertar_busqueda_en_carrito()
BEGIN

	DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
        SET codigo_error = 1;
        ROLLBACK;
    END;

	START TRANSACTION;


// mi codigo 

	IF codigo_error = 0 THEN
        COMMIT;
    ELSE
        ROLLBACK;
    END IF;
END;




CREATE PROCEDURE sp_insertar_genero_subfamilia(
  IN p_nombre_genero VARCHAR(255),
  IN p_id_subfamilia INT,
  IN p_id_usuario INT
)
BEGIN
  DECLARE p_id_genero INT;
  DECLARE EXIT HANDLER FOR SQLEXCEPTION
  BEGIN
    ROLLBACK;
    SELECT NULL AS nombre_genero;
  END;
  
  START TRANSACTION;
  
  INSERT INTO tb_genero (nombre_genero) VALUES (p_nombre_genero);
  SET p_id_genero = LAST_INSERT_ID();

  INSERT INTO tb_genero_subfamilia (id_genero, id_subfamilia) VALUES (p_id_genero, p_id_subfamilia);

  INSERT INTO tb_registro (id_usuario, descripcion) VALUES (p_id_usuario, CONCAT('Se registró el género ', p_nombre_genero));

  COMMIT;
  
  SELECT p_nombre_genero AS nombre_genero;
END


CREATE PROCEDURE sp_insertar_genero_familia(
  IN p_nombre_genero VARCHAR(255),
  IN p_id_familia INT,
  IN p_id_usuario INT
)
BEGIN
  DECLARE p_id_genero INT;
  DECLARE EXIT HANDLER FOR SQLEXCEPTION
  BEGIN
    ROLLBACK;
    SELECT NULL AS nombre_genero;
  END;
  
  START TRANSACTION;
  
  INSERT INTO tb_genero (nombre_genero) VALUES (p_nombre_genero);
  SET p_id_genero = LAST_INSERT_ID();

  INSERT INTO tb_genero_familia (id_genero, id_familia) VALUES (p_id_genero, p_id_familia);

  INSERT INTO tb_registro (id_usuario, descripcion) VALUES (p_id_usuario, CONCAT('Se registró el género ', p_nombre_genero));

  COMMIT;
  
  SELECT p_nombre_genero AS nombre_genero;
END




CREATE PROCEDURE sp_get_all_viales (IN p_id_caja INT)   BEGIN
  SELECT id, numero_vial
  FROM tb_vial
  WHERE id_caja = p_id_caja;
END


CREATE PROCEDURE sp_get_all_cajas ()   BEGIN
  SELECT *
  FROM tb_caja;
END



CREATE PROCEDURE sp_get_all_genero ()   BEGIN
  SELECT *
  FROM tb_genero;
END

CREATE PROCEDURE sp_get_especie (IN p_genero INT)   BEGIN
  SELECT id_especie, nombre_especie
  FROM tb_especie
  where id_genero = p_genero;
END




CREATE PROCEDURE sp_insertar_especimen_en_gaveta(
  IN p_id_especie INT,
  IN p_id_recolector INT,
  IN p_id_genero INT,
  IN p_distrito INT,
  IN p_latitud VARCHAR(15),
  IN p_longitud VARCHAR(15),
  IN p_fecha_recoleccion DATE,
  IN p_rutas_imagenes JSON,
  IN p_id_gaveta INT
)
BEGIN
  DECLARE i INT;

  DECLARE EXIT HANDLER FOR SQLEXCEPTION
  BEGIN
    ROLLBACK;
    SELECT NULL AS nombre_genero;
  END;

  SET i = 0;
  SET @num_images = JSON_LENGTH(p_rutas_imagenes);

  START TRANSACTION;

  INSERT INTO tb_recoleccion (distrito, latitud, longitud, fecha_recoleccion)
  VALUES (p_distrito, p_latitud, p_longitud, p_fecha_recoleccion);
  SET @id_recoleccion = LAST_INSERT_ID();

  INSERT INTO tb_etiqueta_recoleccion (id_recoleccion, id_recolector, id_genero)
  VALUES (@id_recoleccion, p_id_recolector, p_id_genero);
  SET @id_etiqueta = LAST_INSERT_ID();

  INSERT INTO tb_especimen (id_etiqueta)
  VALUES (@id_etiqueta);
  SET @id_especimen = LAST_INSERT_ID();

  WHILE i < @num_images DO
    INSERT INTO tb_especimen_imagen (id_especimen, ruta_imagen)
    VALUES (@id_especimen, JSON_EXTRACT(p_rutas_imagenes, CONCAT('$[', i, ']')));
    SET i = i + 1;
  END WHILE;

  IF EXISTS (SELECT * FROM tb_especie WHERE id_especie = p_id_especie) THEN
    INSERT INTO tb_especimen_especie (id_especimen, id_especie)
    VALUES (@id_especimen, p_id_especie);
  END IF;

  INSERT INTO tb_gaveta_especimen (id_gaveta, id_especimen)
  VALUES (p_id_gaveta, @id_especimen);

  COMMIT;

  SELECT p_id_especie AS nombre_genero;

END

select *
from tb_especimen

CREATE PROCEDURE sp_insertar_especimen_en_vial(
  IN p_id_especie INT,
  IN p_id_recolector INT,
  IN p_id_genero INT,
  IN p_distrito INT,
  IN p_latitud VARCHAR(15),
  IN p_longitud VARCHAR(15),
  IN p_fecha_recoleccion DATE,
  IN p_rutas_imagenes JSON,
  IN p_id_vial INT
)
BEGIN
  DECLARE i INT;

  DECLARE EXIT HANDLER FOR SQLEXCEPTION
  BEGIN
    ROLLBACK;
    SELECT NULL AS nombre_genero;
  END;

  SET i = 0;
  SET @num_images = JSON_LENGTH(p_rutas_imagenes);

  START TRANSACTION;

  INSERT INTO tb_recoleccion (distrito, latitud, longitud, fecha_recoleccion)
  VALUES (p_distrito, p_latitud, p_longitud, p_fecha_recoleccion);
  SET @id_recoleccion = LAST_INSERT_ID();

  INSERT INTO tb_etiqueta_recoleccion (id_recoleccion, id_recolector, id_genero)
  VALUES (@id_recoleccion, p_id_recolector, p_id_genero);
  SET @id_etiqueta = LAST_INSERT_ID();

  INSERT INTO tb_especimen (id_etiqueta)
  VALUES (@id_etiqueta);
  SET @id_especimen = LAST_INSERT_ID();

  WHILE i < @num_images DO
    INSERT INTO tb_especimen_imagen (id_especimen, ruta_imagen)
    VALUES (@id_especimen, JSON_EXTRACT(p_rutas_imagenes, CONCAT('$[', i, ']')));
    SET i = i + 1;
  END WHILE;

  IF EXISTS (SELECT * FROM tb_especie WHERE id_especie = p_id_especie) THEN
    INSERT INTO tb_especimen_especie (id_especimen, id_especie)
    VALUES (@id_especimen, p_id_especie);
  END IF;

  INSERT INTO tb_vial_especimen (id_vial, id_especimen)
  VALUES (p_id_vial, @id_especimen);

  COMMIT;

  SELECT p_id_especie AS nombre_genero;

END



select *
from tb_especimen


select *
from tb_especimen_especie


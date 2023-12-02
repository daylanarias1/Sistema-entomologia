

USE proyecto

-------------------------ORDEN------------------------
call sp_buscar_orden_asc('a', 1)
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



-------------------------FAMILIA------------------------


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

-------------------------SUBFAMILIA----------------------
call sp_buscar_subfamilia_asc('a', 1)

CREATE PROCEDURE sp_buscar_subfamilia_asc (
    IN busqueda VARCHAR(100),
    IN p_page_number INT
)
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

    SELECT COUNT(*) INTO total_pages FROM tb_subfamilia WHERE nombre_subfamilia LIKE CONCAT('%', busqueda, '%');

    IF p_offset >= total_pages THEN
        SELECT NULL AS username;
    ELSE
        SELECT sf.id_subfamilia, sf.nombre_subfamilia AS subfamilia, COUNT(DISTINCT gf.id_genero) AS numero_generos, COUNT(DISTINCT e.id_especie) AS numero_especies,
        COUNT(DISTINCT gf.id_genero) + COUNT(DISTINCT e.id_especie) AS total
        FROM tb_subfamilia sf
        LEFT JOIN tb_genero_subfamilia gs ON gs.id_subfamilia = sf.id_subfamilia
        LEFT JOIN tb_genero gf ON gf.id_genero = gs.id_genero
        LEFT JOIN tb_especie e ON e.id_genero = gf.id_genero
        WHERE sf.nombre_subfamilia LIKE CONCAT('%a%')
        GROUP BY sf.id_subfamilia, sf.nombre_subfamilia
        ORDER BY total ASC
        LIMIT p_offset, p_limit;
    END IF;
END;

CREATE PROCEDURE sp_buscar_subfamilia_desc (
    IN busqueda VARCHAR(100),
    IN p_page_number INT
)
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

    SELECT COUNT(*) INTO total_pages FROM tb_subfamilia WHERE nombre_subfamilia LIKE CONCAT('%', busqueda, '%');

    IF p_offset >= total_pages THEN
        SELECT NULL AS username;
    ELSE
        SELECT sf.id_subfamilia, sf.nombre_subfamilia AS subfamilia, COUNT(DISTINCT gf.id_genero) AS numero_generos, COUNT(DISTINCT e.id_especie) AS numero_especies,
        COUNT(DISTINCT gf.id_genero) + COUNT(DISTINCT e.id_especie) AS total
        FROM tb_subfamilia sf
        LEFT JOIN tb_genero_subfamilia gs ON gs.id_subfamilia = sf.id_subfamilia
        LEFT JOIN tb_genero gf ON gf.id_genero = gs.id_genero
        LEFT JOIN tb_especie e ON e.id_genero = gf.id_genero
        WHERE sf.nombre_subfamilia LIKE CONCAT('%a%')
        GROUP BY sf.id_subfamilia, sf.nombre_subfamilia
        ORDER BY total ASC
        LIMIT p_offset, p_limit;
    END IF;
END;

-------------------------------BUSQUEDA ESPECIFICA---------------------------


call sp_especies_page(1, 'a', 3)


select *
from tb_carrito_especie

insert into tb_carrito_especie values (3,5)

CREATE PROCEDURE sp_especies_page(
    IN p_page_number INT,
    IN p_busqueda VARCHAR(255),
    IN p_id_usuario INT
)
BEGIN
    DECLARE p_offset INT;
    DECLARE p_limit INT;
    DECLARE total_pages INT;
DECLARE especimen_id INT;

    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
        SELECT NULL AS username;
    END;

    SET p_limit = 5;
    SET p_offset = (p_page_number - 1) * p_limit;

    SELECT COUNT(*) INTO total_pages FROM tb_especie WHERE nombre_especie LIKE CONCAT('%', p_busqueda, '%');

    IF p_offset >= total_pages THEN
        SELECT NULL AS username;
    ELSE
           SELECT
           e.id_especie,
        e.nombre_especie,
        g.nombre_genero,
        COALESCE(sf.nombre_subfamilia, 'N/a') AS nombre_subfamilia,
        COALESCE(f.nombre_familia, 'N/a') AS nombre_familia,
        o.nombre_orden,
        COALESCE(ce.id_especie, 0) AS en_carrito_especie,
        COALESCE(ve.id_especie, 0) AS visto_especie
    FROM
        tb_especie e
    LEFT JOIN
        tb_genero g ON e.id_genero = g.id_genero
    LEFT JOIN
        tb_genero_subfamilia gs ON g.id_genero = gs.id_genero
    LEFT JOIN
        tb_subfamilia sf ON gs.id_subfamilia = sf.id_subfamilia
    LEFT JOIN
        tb_genero_familia gf ON g.id_genero = gf.id_genero
    LEFT JOIN
        tb_familia f ON (gf.id_familia IS NOT NULL AND f.id_familia = gf.id_familia) OR (gf.id_familia IS NULL AND f.id_familia = sf.id_familia)
    LEFT JOIN
        tb_orden o ON f.id_orden = o.id_orden
    LEFT JOIN
        tb_carrito_especie ce ON ce.id_especie = e.id_especie AND ce.id_usuario = p_id_usuario
    LEFT JOIN
        tb_visto_especie ve ON ve.id_especie = e.id_especie AND ve.id_usuario = p_id_usuario
    WHERE e.nombre_especie LIKE CONCAT('%', p_busqueda, '%')
        LIMIT p_offset, p_limit;




 SET especimen_id := NULL;

        SELECT e.id_especimen INTO especimen_id
        FROM tb_especimen e
        LEFT JOIN tb_especimen_especie ee on ee.id_especimen = e.id_especimen
        LEFT JOIN tb_especie es on ee.id_especie = es.id_especie
         WHERE es.nombre_especie LIKE CONCAT('%s%')
        ORDER BY RAND()
        LIMIT 1;

        IF especimen_id IS NOT NULL THEN
            IF NOT EXISTS (
                SELECT 1
                FROM tb_recomendaciones
                WHERE id_usuario = p_id_usuario AND id_especimen = especimen_id
            ) THEN
                INSERT INTO tb_recomendaciones (id_usuario, id_especimen)
                VALUES (p_id_usuario, especimen_id);
            END IF;
        END IF;
    

    END IF;
END;










call sp_especies_cliente(1, 'a')

CREATE PROCEDURE sp_especies_cliente(
    IN p_page_number INT,
    IN p_busqueda VARCHAR(255)
)
BEGIN
    DECLARE p_offset INT;
    DECLARE p_limit INT;
    DECLARE total_pages INT;
DECLARE especimen_id INT;

    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
        SELECT NULL AS username;
    END;

    SET p_limit = 5;
    SET p_offset = (p_page_number - 1) * p_limit;

    SELECT COUNT(*) INTO total_pages FROM tb_especie WHERE nombre_especie LIKE CONCAT('%', p_busqueda, '%');

    IF p_offset >= total_pages THEN
        SELECT NULL AS username;
    ELSE
           SELECT
           e.id_especie,
        e.nombre_especie,
        g.nombre_genero,
        COALESCE(sf.nombre_subfamilia, 'N/a') AS nombre_subfamilia,
        COALESCE(f.nombre_familia, 'N/a') AS nombre_familia,
        o.nombre_orden
    FROM
        tb_especie e
    LEFT JOIN
        tb_genero g ON e.id_genero = g.id_genero
    LEFT JOIN
        tb_genero_subfamilia gs ON g.id_genero = gs.id_genero
    LEFT JOIN
        tb_subfamilia sf ON gs.id_subfamilia = sf.id_subfamilia
    LEFT JOIN
        tb_genero_familia gf ON g.id_genero = gf.id_genero
    LEFT JOIN
        tb_familia f ON (gf.id_familia IS NOT NULL AND f.id_familia = gf.id_familia) OR (gf.id_familia IS NULL AND f.id_familia = sf.id_familia)
    LEFT JOIN
        tb_orden o ON f.id_orden = o.id_orden
    WHERE e.nombre_especie LIKE CONCAT('%', p_busqueda, '%')
        LIMIT p_offset, p_limit;

    END IF;
END;









select *
from tb_recomendaciones

--------------------------genero------------------

CREATE PROCEDURE sp_genero_page(
    IN p_page_number INT,
    IN p_busqueda VARCHAR(255),
    IN p_id_usuario INT
)
BEGIN
    DECLARE p_offset INT;
    DECLARE p_limit INT;
    DECLARE total_pages INT;
    DECLARE especimen_id INT;

    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
        SELECT NULL AS username;
    END;

    SET p_limit = 5;
    SET p_offset = (p_page_number - 1) * p_limit;

    SELECT COUNT(*) INTO total_pages FROM tb_genero WHERE nombre_genero LIKE CONCAT('%', p_busqueda, '%');

    IF p_offset >= total_pages THEN
        SELECT NULL AS username;
    ELSE
        SELECT g.nombre_genero, g.id_genero, COALESCE(sf.nombre_subfamilia, 'N/a') AS nombre_subfamilia,
            COALESCE(f.nombre_familia, 'N/a') AS nombre_familia, o.nombre_orden,
            COALESCE(cg.id_genero, 0) AS en_carrito,
            COALESCE(vg.id_genero, 0) AS visto
        FROM tb_genero g
        LEFT JOIN tb_genero_subfamilia gs ON g.id_genero = gs.id_genero
        LEFT JOIN tb_subfamilia sf ON gs.id_subfamilia = sf.id_subfamilia
        LEFT JOIN tb_genero_familia gf ON g.id_genero = gf.id_genero
        LEFT JOIN tb_familia f ON (gf.id_familia IS NOT NULL AND f.id_familia = gf.id_familia) OR (gf.id_familia IS NULL AND f.id_familia = sf.id_familia)
        LEFT JOIN tb_orden o ON f.id_orden = o.id_orden
        LEFT JOIN tb_carrito_genero cg ON cg.id_genero = g.id_genero AND cg.id_usuario = p_id_usuario
        LEFT JOIN tb_visto_genero vg ON vg.id_genero = g.id_genero AND vg.id_usuario = p_id_usuario
        WHERE g.nombre_genero LIKE CONCAT('%', p_busqueda, '%')
        LIMIT p_offset, p_limit;

        SET especimen_id := NULL;

        SELECT id_especimen INTO especimen_id
        FROM tb_especimen e
        INNER JOIN  tb_etiqueta_recoleccion er on er.id_etiqueta = e.id_etiqueta
        INNER JOIN  tb_genero g on g.id_genero = er.id_genero
        WHERE g.nombre_genero LIKE CONCAT('%', p_busqueda, '%')
        ORDER BY RAND()
        LIMIT 1;


        IF especimen_id IS NOT NULL THEN
            IF NOT EXISTS (
                SELECT 1
                FROM tb_recomendaciones
                WHERE id_usuario = p_id_usuario AND id_especimen = especimen_id
            ) THEN
                INSERT INTO tb_recomendaciones (id_usuario, id_especimen)
                VALUES (p_id_usuario, especimen_id);
            END IF;
        END IF;
    END IF;
END;





call sp_genero_cliente(1, 'a')

CREATE PROCEDURE sp_genero_cliente(
    IN p_page_number INT,
    IN p_busqueda VARCHAR(255)
)
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

    SELECT COUNT(*) INTO total_pages FROM tb_genero WHERE nombre_genero LIKE CONCAT('%', p_busqueda, '%');

    IF p_offset >= total_pages THEN
        SELECT NULL AS username;
    ELSE
        SELECT g.nombre_genero, g.id_genero, COALESCE(sf.nombre_subfamilia, 'N/a') AS nombre_subfamilia,
            COALESCE(f.nombre_familia, 'N/a') AS nombre_familia, o.nombre_orden
        FROM tb_genero g
        LEFT JOIN tb_genero_subfamilia gs ON g.id_genero = gs.id_genero
        LEFT JOIN tb_subfamilia sf ON gs.id_subfamilia = sf.id_subfamilia
        LEFT JOIN tb_genero_familia gf ON g.id_genero = gf.id_genero
        LEFT JOIN tb_familia f ON (gf.id_familia IS NOT NULL AND f.id_familia = gf.id_familia) OR (gf.id_familia IS NULL AND f.id_familia = sf.id_familia)
        LEFT JOIN tb_orden o ON f.id_orden = o.id_orden
        WHERE g.nombre_genero LIKE CONCAT('%', p_busqueda, '%')
        LIMIT p_offset, p_limit;
    END IF;
END;




-------------------PLANTA------------------------

call sp_planta_page(1,'c', 1);

create PROCEDURE sp_planta_page(
    IN p_page_number INT,
    IN p_busqueda VARCHAR(255),
    IN p_id_usuario INT
)
BEGIN
    DECLARE p_offset INT;
    DECLARE p_limit INT;
    DECLARE total_pages INT;
    DECLARE especimen_id INT;

    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
        SELECT NULL AS username;
    END;

    SET p_limit = 5;
    SET p_offset = (p_page_number - 1) * p_limit;


        SELECT COUNT(*) INTO total_pages
    FROM tb_genero g
    LEFT JOIN tb_planta_genero pg ON pg.id_genero = g.id_genero
    LEFT JOIN tb_planta p ON p.id_planta = pg.id_planta
    WHERE p.nombre LIKE CONCAT('%', p_busqueda, '%');


    IF p_offset >= total_pages THEN
        SELECT NULL AS username;
    ELSE
        SELECT DISTINCT g.nombre_genero, g.id_genero, COALESCE(sf.nombre_subfamilia, 'N/a') AS nombre_subfamilia,
            COALESCE(f.nombre_familia, 'N/a') AS nombre_familia, o.nombre_orden,
            COALESCE(cg.id_genero, 0) AS en_carrito,
            COALESCE(vg.id_genero, 0) AS visto
        FROM tb_genero g
        LEFT JOIN tb_genero_subfamilia gs ON g.id_genero = gs.id_genero
        LEFT JOIN tb_subfamilia sf ON gs.id_subfamilia = sf.id_subfamilia
        LEFT JOIN tb_genero_familia gf ON g.id_genero = gf.id_genero
        LEFT JOIN tb_familia f ON (gf.id_familia IS NOT NULL AND f.id_familia = gf.id_familia) OR (gf.id_familia IS NULL AND f.id_familia = sf.id_familia)
        LEFT JOIN tb_orden o ON f.id_orden = o.id_orden
        LEFT JOIN tb_carrito_genero cg ON cg.id_genero = g.id_genero AND cg.id_usuario = p_id_usuario
        LEFT JOIN tb_visto_genero vg ON vg.id_genero = g.id_genero AND vg.id_usuario = p_id_usuario
        LEFT JOIN tb_planta_genero pg ON pg.id_genero = g.id_genero
        LEFT JOIN tb_planta p ON p.id_planta = pg.id_planta
        WHERE p.nombre LIKE CONCAT('%', p_busqueda, '%')
        LIMIT p_offset, p_limit;




         SET especimen_id := NULL;

        SELECT id_especimen INTO especimen_id
        FROM tb_especimen e
        LEFT JOIN  tb_etiqueta_recoleccion er on er.id_etiqueta = e.id_etiqueta
        LEFT JOIN  tb_genero g on g.id_genero = er.id_genero
        LEFT JOIN tb_planta_genero pg ON pg.id_genero = g.id_genero
        LEFT JOIN tb_planta p ON p.id_planta = pg.id_planta
        WHERE p.nombre LIKE CONCAT('%', p_busqueda, '%')
        ORDER BY RAND()
        LIMIT 1;

        IF especimen_id IS NOT NULL THEN
            IF NOT EXISTS (
                SELECT 1
                FROM tb_recomendaciones
                WHERE id_usuario = p_id_usuario AND id_especimen = especimen_id
            ) THEN
                INSERT INTO tb_recomendaciones (id_usuario, id_especimen)
                VALUES (p_id_usuario, especimen_id);
            END IF;
        END IF;
    END IF;
END;



CREATE PROCEDURE sp_AgregarRegistro
    @id_usuario INT,
    @id_especie INT
AS
BEGIN

        INSERT INTO tb_visto_especie (id_usuario, id_especie)
        VALUES (@id_usuario, @id_especie)
        
 
END


    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
        SELECT NULL AS username;
    END;




CREATE PROCEDURE sp_agregar_visto_especie(
    IN p_id_usuario INT,
    IN p_id_especie INT
)
BEGIN
    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
        SELECT NULL AS especie;
    END;

    INSERT INTO tb_visto_especie (id_usuario, id_especie)
    VALUES (p_id_usuario, p_id_especie);

    SELECT 'Registro agregado correctamente.' AS especie;
END


CREATE PROCEDURE sp_eliminar_visto_especie(
    IN p_id_usuario INT,
    IN p_id_especie INT
)
BEGIN
    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
        SELECT NULL AS especie;
    END;

    DELETE FROM tb_visto_especie
    WHERE id_usuario = p_id_usuario AND id_especie = p_id_especie;

    SELECT 'Registro eliminado correctamente.' AS mensaje;
END

CREATE PROCEDURE sp_eliminar_visto_genero(
    IN p_id_usuario INT,
    IN p_id_genero INT
)
BEGIN
    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
        SELECT NULL AS mensaje;
    END;

    DELETE FROM tb_visto_genero
    WHERE id_usuario = p_id_usuario AND id_genero = p_id_genero;

    SELECT 'Registro eliminado correctamente.' AS mensaje;
END

CREATE PROCEDURE sp_agregar_visto_genero(
    IN p_id_usuario INT,
    IN p_id_genero INT
)
BEGIN
    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
        SELECT NULL AS mensaje;
    END;

    INSERT INTO tb_visto_genero (id_usuario, id_genero)
    VALUES (p_id_usuario, p_id_genero);

    SELECT 'Registro agregado correctamente.' AS mensaje;
END




--- carrito


CREATE PROCEDURE sp_eliminar_carrito_especie(
    IN p_id_usuario INT,
    IN p_id_especie INT
)
BEGIN
    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
        SELECT NULL AS mensaje;
    END;

    DELETE FROM tb_carrito_especie
    WHERE id_usuario = p_id_usuario AND id_especie = p_id_especie;

    SELECT 'Registro eliminado correctamente.' AS mensaje;
END


CREATE PROCEDURE sp_agregar_carrito_especie(
    IN p_id_usuario INT,
    IN p_id_especie INT
)
BEGIN
    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
        SELECT NULL AS mensaje;
    END;

    INSERT INTO tb_carrito_especie (id_usuario, id_especie)
    VALUES (p_id_usuario, p_id_especie);

    SELECT 'Registro agregado correctamente.' AS mensaje;
END


CREATE PROCEDURE sp_eliminar_carrito_genero(
    IN p_id_usuario INT,
    IN p_id_genero INT
)
BEGIN
    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
        SELECT NULL AS mensaje;
    END;

    DELETE FROM tb_carrito_genero
    WHERE id_usuario = p_id_usuario AND id_genero = p_id_genero;

    SELECT 'Registro eliminado correctamente.' AS mensaje;
END


CREATE PROCEDURE sp_agregar_carrito_genero(
    IN p_id_usuario INT,
    IN p_id_genero INT
)
BEGIN
    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
        SELECT NULL AS mensaje;
    END;

    INSERT INTO tb_carrito_genero (id_usuario, id_genero)
    VALUES (p_id_usuario, p_id_genero);

    SELECT 'Registro agregado correctamente.' AS mensaje;
END

call sp_numero_carrito(3)

CREATE PROCEDURE sp_numero_carrito(
    IN p_id_usuario INT
)
BEGIN
    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
        SELECT NULL AS total;
    END;

SELECT
  (SELECT COUNT(*) FROM tb_carrito_genero WHERE id_usuario = p_id_usuario) +
  (SELECT COUNT(*) FROM tb_carrito_especie WHERE id_usuario = p_id_usuario) AS total;

END


------------------------------DETALLES 

create PROCEDURE sp_especimen_especie(IN especie_id INT)
BEGIN
    SELECT 
        e.id_especimen,
        tr.fecha_recoleccion,
        d.nombre AS distrito,
        c.nombre AS canton,
        p.nombre AS provincia,
        pais.nombre AS pais,
        ei.ruta_imagen,
        tr.latitud,
        tr.longitud
    FROM tb_especimen_especie ee
    INNER JOIN tb_especimen e ON ee.id_especimen = e.id_especimen
    INNER JOIN tb_etiqueta_recoleccion er ON e.id_etiqueta = er.id_etiqueta
    INNER JOIN tb_recoleccion tr ON er.id_recoleccion = tr.id_recoleccion
    INNER JOIN tb_distrito d ON tr.distrito = d.id_distrito
    INNER JOIN tb_canton c ON d.id_canton = c.id_canton
    INNER JOIN tb_provincia p ON c.id_provincia = p.id_provincia
    INNER JOIN tb_pais pais ON p.id_pais = pais.id_pais
    LEFT JOIN (
        SELECT id_especimen, ruta_imagen
        FROM tb_especimen_imagen
        GROUP BY id_especimen
    ) ei ON e.id_especimen = ei.id_especimen
    WHERE ee.id_especie = especie_id;
END

create procedure sp_especimen_genero(
  in genero_id int
)
begin
    SELECT
        e.id_especimen,
        tr.fecha_recoleccion,
        d.nombre AS distrito,
        c.nombre AS canton,
        p.nombre AS provincia,
        pais.nombre AS pais,
        ei.ruta_imagen,
        tr.latitud,
        tr.longitud
    FROM tb_especimen e
    INNER JOIN tb_etiqueta_recoleccion er ON e.id_etiqueta = er.id_etiqueta
    INNER JOIN tb_recoleccion tr ON er.id_recoleccion = tr.id_recoleccion
    INNER JOIN tb_distrito d ON tr.distrito = d.id_distrito
    INNER JOIN tb_canton c ON d.id_canton = c.id_canton
    INNER JOIN tb_provincia p ON c.id_provincia = p.id_provincia
    INNER JOIN tb_pais pais ON p.id_pais = pais.id_pais
    LEFT JOIN (
        SELECT id_especimen, ruta_imagen
        FROM tb_especimen_imagen
        GROUP BY id_especimen
    ) ei ON e.id_especimen = ei.id_especimen
    WHERE er.id_genero = genero_id;
end


CREATE PROCEDURE sp_ver_carrito_genero (IN usuario_id INT)
BEGIN
  SELECT
    tb_carrito_genero.id_genero,
    tb_genero.nombre_genero
  FROM
    tb_carrito_genero
    INNER JOIN tb_genero ON tb_carrito_genero.id_genero = tb_genero.id_genero
    WHERE tb_carrito_genero.id_usuario = usuario_id;
END

CREATE PROCEDURE sp_ver_carrito_especie (IN usuario_id INT)
BEGIN
  SELECT
    tb_carrito_especie.id_especie,
    tb_especie.nombre_especie
  FROM
    tb_carrito_especie
    INNER JOIN tb_especie ON tb_carrito_especie.id_especie = tb_especie.id_especie
    WHERE tb_carrito_especie.id_usuario = usuario_id;
END

call sp_ver_carrito_genero(3)


------------------DETALLES ESPECIMEN------------

call sp_get_especimen(8)

CREATE PROCEDURE sp_get_especimen(IN idEspecimen INT)
BEGIN
  SELECT
    o.nombre_orden AS nombre_orden,
    IFNULL(f.nombre_familia, 'N/A') AS nombre_familia,
    IFNULL(sf.nombre_subfamilia, 'N/A') AS nombre_subfamilia,
    g.nombre_genero AS nombre_genero,
    IFNULL(es.nombre_especie, 'SP') AS nombre_especie,
    pa.nombre AS pais,
    prov.nombre AS provincia,
    can.nombre AS canton,
    d.nombre AS distrito,
    IFNULL(r.latitud, 'N/A') as latitud,
    IFNULL(r.longitud, 'N/A') as longitud,
    CASE
      WHEN v.id IS NOT NULL THEN CONCAT('Caja ', c.numero_caja, ', Vial ', v.numero_vial)
      ELSE CONCAT('Gabinete ', gab.numero_gabinete, ', Gaveta ', gav.numero_gaveta)
    END AS ubicacion_especimen,
    IFNULL(rec.inicial_nombre, 'N/A') AS recolector_inicial_nombre,
    IFNULL(rec.primer_apellido, 'N/A') AS recolector_primer_apellido,
    IFNULL(GROUP_CONCAT(DISTINCT p.nombre SEPARATOR ', '), 'N/A') AS plantas_asociadas,
    GROUP_CONCAT(DISTINCT ei.ruta_imagen SEPARATOR ', ') AS imagenes_especimen
  FROM tb_especimen e
  LEFT JOIN tb_etiqueta_recoleccion er ON er.id_etiqueta = e.id_etiqueta
  LEFT JOIN tb_especimen_especie ee ON e.id_especimen = ee.id_especimen
  LEFT JOIN tb_especie es ON ee.id_especie = es.id_especie
  LEFT JOIN tb_genero g ON er.id_genero = g.id_genero
  LEFT JOIN tb_genero_familia gf ON g.id_genero = gf.id_genero
  LEFT JOIN tb_genero_subfamilia gs ON g.id_genero = gs.id_genero
  LEFT JOIN tb_subfamilia sf ON gs.id_subfamilia = sf.id_subfamilia
  LEFT JOIN tb_familia f ON (gf.id_familia = f.id_familia OR sf.id_familia = f.id_familia)
  LEFT JOIN tb_orden o ON f.id_orden = o.id_orden
  LEFT JOIN tb_recoleccion r ON er.id_recoleccion = r.id_recoleccion
  LEFT JOIN tb_distrito d ON r.distrito = d.id_distrito
  LEFT JOIN tb_canton can ON d.id_canton = can.id_canton
  LEFT JOIN tb_provincia prov ON can.id_provincia = prov.id_provincia
  LEFT JOIN tb_pais pa ON prov.id_pais = pa.id_pais
  LEFT JOIN tb_vial_especimen ve ON e.id_especimen = ve.id_especimen
  LEFT JOIN tb_vial v ON ve.id_vial = v.id
  LEFT JOIN tb_caja c ON v.id_caja = c.id
  LEFT JOIN tb_gaveta_especimen ge ON e.id_especimen = ge.id_especimen
  LEFT JOIN tb_gaveta gav ON ge.id_gaveta = gav.id
  LEFT JOIN tb_gabinete gab ON gav.id_gabinete = gab.id
  LEFT JOIN tb_recolector rec ON er.id_recolector = rec.id_recolector
  LEFT JOIN tb_planta_genero pg ON g.id_genero = pg.id_genero
  LEFT JOIN tb_planta p ON pg.id_planta = p.id_planta
  LEFT JOIN tb_especimen_imagen ei ON e.id_especimen = ei.id_especimen
  WHERE e.id_especimen = idEspecimen
  GROUP BY e.id_especimen;
END

-----------loquera
call sp_ubicaciones_carrito(3)






call sp_genero_cliente(1, 'a')

CREATE PROCEDURE sp_genero_cliente(
    IN p_page_number INT,
    IN p_busqueda VARCHAR(255)
)
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

    SELECT COUNT(*) INTO total_pages FROM tb_genero WHERE nombre_genero LIKE CONCAT('%', p_busqueda, '%');

    IF p_offset >= total_pages THEN
        SELECT NULL AS username;
    ELSE
        SELECT g.nombre_genero, g.id_genero, COALESCE(sf.nombre_subfamilia, 'N/a') AS nombre_subfamilia,
            COALESCE(f.nombre_familia, 'N/a') AS nombre_familia, o.nombre_orden
        FROM tb_genero g
        LEFT JOIN tb_genero_subfamilia gs ON g.id_genero = gs.id_genero
        LEFT JOIN tb_subfamilia sf ON gs.id_subfamilia = sf.id_subfamilia
        LEFT JOIN tb_genero_familia gf ON g.id_genero = gf.id_genero
        LEFT JOIN tb_familia f ON (gf.id_familia IS NOT NULL AND f.id_familia = gf.id_familia) OR (gf.id_familia IS NULL AND f.id_familia = sf.id_familia)
        LEFT JOIN tb_orden o ON f.id_orden = o.id_orden
        WHERE g.nombre_genero LIKE CONCAT('%', p_busqueda, '%')
        LIMIT p_offset, p_limit;
    END IF;
END;


call sp_ubicaciones_carrito(3,2)






-- Declarar variable
SET @total_pages := (
    (SELECT COUNT(*) FROM tb_carrito_genero WHERE id_usuario = 3) +
    (SELECT COUNT(*) FROM tb_carrito_especie WHERE id_usuario = 3)
);

-- Utilizar la variable
SELECT @total_pages AS total_pages;





call sp_ubicaciones_carrito(3,3)

CREATE PROCEDURE sp_ubicaciones_carrito(IN usuario_id INT, IN p_page_number INT)
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

    SELECT COUNT(*) INTO total_pages FROM
            tb_especimen e
            INNER JOIN tb_etiqueta_recoleccion er ON e.id_etiqueta = er.id_etiqueta
            LEFT JOIN tb_carrito_genero cg ON cg.id_genero = er.id_genero
            LEFT JOIN tb_especimen_especie ee ON ee.id_especimen = e.id_especimen
            LEFT JOIN tb_carrito_especie cs ON cs.id_especie = ee.id_especie
        WHERE
            cg.id_usuario = usuario_id OR cs.id_usuario =usuario_id;

    IF p_offset >= total_pages THEN
        SELECT NULL AS username;
    ELSE
        SELECT DISTINCT
            e.id_especimen,
            ei.ruta_imagen,
            CASE
                WHEN v.id IS NOT NULL THEN CONCAT('Caja ', ca.numero_caja, ', Vial ', v.numero_vial)
                ELSE CONCAT('Gabinete ', gab.numero_gabinete, ', Gaveta ', gav.numero_gaveta)
            END AS ubicacion_especimen
        FROM
            tb_especimen e
            INNER JOIN tb_etiqueta_recoleccion er ON e.id_etiqueta = er.id_etiqueta
            LEFT JOIN tb_carrito_genero cg ON cg.id_genero = er.id_genero
            LEFT JOIN tb_especimen_especie ee ON ee.id_especimen = e.id_especimen
            LEFT JOIN tb_carrito_especie cs ON cs.id_especie = ee.id_especie
            LEFT JOIN (
                SELECT id_especimen, ruta_imagen
                FROM tb_especimen_imagen
                GROUP BY id_especimen
            ) ei ON e.id_especimen = ei.id_especimen
            LEFT JOIN tb_vial_especimen ve ON e.id_especimen = ve.id_especimen
            LEFT JOIN tb_vial v ON ve.id_vial = v.id
            LEFT JOIN tb_caja ca ON v.id_caja = ca.id
            LEFT JOIN tb_gaveta_especimen ge ON e.id_especimen = ge.id_especimen
            LEFT JOIN tb_gaveta gav ON ge.id_gaveta = gav.id
            LEFT JOIN tb_gabinete gab ON gav.id_gabinete = gab.id
        WHERE
            cg.id_usuario = usuario_id OR cs.id_usuario =usuario_id
        LIMIT p_offset, p_limit;
    END IF;
END;



call sp_limpiar_carrito (3)

create PROCEDURE sp_limpiar_carrito (IN usuario_id INT)
BEGIN

    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
        SELECT NULL AS total;
    END;

    SET @current_datetime := NOW();

    START TRANSACTION;

    INSERT INTO tb_historial_genero (id_usuario, id_genero, fecha)
    SELECT id_usuario, id_genero, @current_datetime
    FROM tb_carrito_genero
    WHERE id_usuario = 3;

    DELETE FROM tb_carrito_genero
    WHERE id_usuario = 3;

    INSERT INTO tb_historial_especie (id_usuario, id_especie, fecha)
    SELECT id_usuario, id_especie, @current_datetime
    FROM tb_carrito_especie
    WHERE id_usuario = 3;

    DELETE FROM tb_carrito_especie
    WHERE id_usuario = 3;

    SELECT 'Exito' AS total;

    COMMIT;
END




CREATE PROCEDURE sp_obtener_historial (IN usuario_id INT)   BEGIN
    SELECT fecha, GROUP_CONCAT(nombre SEPARATOR ', ') AS nombres
    FROM (
        SELECT fecha, nombre_genero AS nombre
        FROM tb_historial_genero
        INNER JOIN tb_genero ON tb_historial_genero.id_genero = tb_genero.id_genero
        WHERE id_usuario = usuario_id
UNION ALL
        SELECT fecha, nombre_especie AS nombre
        FROM tb_historial_especie
         INNER JOIN tb_especie ON tb_historial_especie.id_especie = tb_especie.id_especie
        WHERE id_usuario = usuario_id
) AS combined
    GROUP BY fecha;
END



create procedure sp_ubicaciones_carrito(IN usuario_id INT)
BEGIN
   
SELECT DISTINCT
  e.id_especimen,
  ei.ruta_imagen,
  CASE
    WHEN v.id IS NOT NULL THEN CONCAT('Caja ', ca.numero_caja, ', Vial ', v.numero_vial)
    ELSE CONCAT('Gabinete ', gab.numero_gabinete, ', Gaveta ', gav.numero_gaveta)
  END AS ubicacion_especimen
FROM
  tb_especimen e
  INNER JOIN tb_etiqueta_recoleccion er ON e.id_etiqueta = er.id_etiqueta
  LEFT JOIN tb_carrito_genero cg ON cg.id_genero = er.id_genero
  LEFT JOIN tb_especimen_especie ee ON ee.id_especimen = e.id_especimen
  LEFT JOIN tb_carrito_especie cs ON cs.id_especie = ee.id_especie
  LEFT JOIN (
    SELECT id_especimen, ruta_imagen
    FROM tb_especimen_imagen
    GROUP BY id_especimen
  ) ei ON e.id_especimen = ei.id_especimen
  LEFT JOIN tb_vial_especimen ve ON e.id_especimen = ve.id_especimen
  LEFT JOIN tb_vial v ON ve.id_vial = v.id
  LEFT JOIN tb_caja ca ON v.id_caja = ca.id
  LEFT JOIN tb_gaveta_especimen ge ON e.id_especimen = ge.id_especimen
  LEFT JOIN tb_gaveta gav ON ge.id_gaveta = gav.id
  LEFT JOIN tb_gabinete gab ON gav.id_gabinete = gab.id
WHERE
  cg.id_usuario = 3 OR cs.id_usuario = 3;
END

CREATE PROCEDURE sp_ubicaciones_historial(IN usuario_id INT, IN fecha_param DATETIME)
BEGIN
  SELECT DISTINCT
    e.id_especimen,
    ei.ruta_imagen,
    CASE
      WHEN v.id IS NOT NULL THEN CONCAT('Caja ', ca.numero_caja, ', Vial ', v.numero_vial)
      ELSE CONCAT('Gabinete ', gab.numero_gabinete, ', Gaveta ', gav.numero_gaveta)
    END AS ubicacion_especimen
  FROM
    tb_especimen e
    INNER JOIN tb_etiqueta_recoleccion er ON e.id_etiqueta = er.id_etiqueta
    LEFT JOIN tb_carrito_genero cg ON cg.id_genero = er.id_genero
    LEFT JOIN tb_especimen_especie ee ON ee.id_especimen = e.id_especimen
    LEFT JOIN tb_carrito_especie cs ON cs.id_especie = ee.id_especie
    LEFT JOIN (
      SELECT id_especimen, ruta_imagen
      FROM tb_especimen_imagen
      GROUP BY id_especimen
    ) ei ON e.id_especimen = ei.id_especimen
    LEFT JOIN tb_vial_especimen ve ON e.id_especimen = ve.id_especimen
    LEFT JOIN tb_vial v ON ve.id_vial = v.id
    LEFT JOIN tb_caja ca ON v.id_caja = ca.id
    LEFT JOIN tb_gaveta_especimen ge ON e.id_especimen = ge.id_especimen
    LEFT JOIN tb_gaveta gav ON ge.id_gaveta = gav.id
    LEFT JOIN tb_gabinete gab ON gav.id_gabinete = gab.id
  WHERE
    (cg.id_usuario = usuario_id OR cs.id_usuario = usuario_id)
    OR
    (e.id_especimen IN (SELECT id_especie FROM tb_historial_especie WHERE id_usuario = usuario_id AND fecha = fecha_param))
    OR
    (er.id_genero IN (SELECT id_genero FROM tb_historial_genero WHERE id_usuario = usuario_id AND fecha = fecha_param));
END


---------VISTOS---------

call vistosGenero(1,3)

CREATE PROCEDURE vistosGenero(
    IN p_page_number INT,
    IN p_id_usuario INT
)
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

    SELECT COUNT(*) INTO total_pages
    FROM tb_genero g
    LEFT JOIN tb_visto_genero vg ON vg.id_genero = g.id_genero
    where vg.id_usuario = p_id_usuario;

    IF p_offset >= total_pages THEN
        SELECT NULL AS username;
    ELSE
  SELECT g.nombre_genero, g.id_genero, COALESCE(sf.nombre_subfamilia, 'N/a') AS nombre_subfamilia,
        COALESCE(f.nombre_familia, 'N/a') AS nombre_familia, o.nombre_orden,
        COALESCE(vg.id_genero, 0) AS visto,
        COALESCE(cg.id_genero, 0) AS en_carrito
    FROM tb_genero g
    LEFT JOIN tb_genero_subfamilia gs ON g.id_genero = gs.id_genero
    LEFT JOIN tb_subfamilia sf ON gs.id_subfamilia = sf.id_subfamilia
    LEFT JOIN tb_genero_familia gf ON g.id_genero = gf.id_genero
    LEFT JOIN tb_familia f ON (gf.id_familia IS NOT NULL AND f.id_familia = gf.id_familia) OR (gf.id_familia IS NULL AND f.id_familia = sf.id_familia)
    LEFT JOIN tb_orden o ON f.id_orden = o.id_orden
    LEFT JOIN tb_visto_genero vg ON vg.id_genero = g.id_genero
    LEFT JOIN tb_carrito_genero cg ON cg.id_genero = g.id_genero AND cg.id_usuario = p_id_usuario
    where vg.id_usuario = p_id_usuario 
    LIMIT p_offset, p_limit;
    END IF;
END;

call vistosEspecie(1,3)
CREATE PROCEDURE vistosEspecie(
    IN p_page_number INT,
    IN p_id_usuario INT
)
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

    SELECT COUNT(*) INTO total_pages
    FROM tb_especie e
    LEFT JOIN tb_visto_especie ve ON ve.id_especie = e.id_especie
    WHERE ve.id_usuario = p_id_usuario;

    IF p_offset >= total_pages THEN
        SELECT NULL AS username;
    ELSE
        SELECT e.nombre_especie, e.id_especie, COALESCE(g.nombre_genero, 'N/a') AS nombre_genero,
            COALESCE(sf.nombre_subfamilia, 'N/a') AS nombre_subfamilia,
            COALESCE(f.nombre_familia, 'N/a') AS nombre_familia, o.nombre_orden,
            COALESCE(ve.id_especie, 0) AS visto,
            COALESCE(ce.id_especie, 0) AS en_carrito_especie
        FROM tb_especie e
        LEFT JOIN tb_genero g ON e.id_genero = g.id_genero
        LEFT JOIN tb_genero_subfamilia gs ON g.id_genero = gs.id_genero
        LEFT JOIN tb_subfamilia sf ON gs.id_subfamilia = sf.id_subfamilia
        LEFT JOIN tb_genero_familia gf ON g.id_genero = gf.id_genero
        LEFT JOIN tb_familia f ON (gf.id_familia IS NOT NULL AND f.id_familia = gf.id_familia) OR (gf.id_familia IS NULL AND f.id_familia = sf.id_familia)
        LEFT JOIN tb_orden o ON f.id_orden = o.id_orden
        LEFT JOIN tb_visto_especie ve ON ve.id_especie = e.id_especie
        LEFT JOIN tb_carrito_especie ce ON ce.id_especie = e.id_especie AND ce.id_usuario = p_id_usuario
        WHERE ve.id_usuario = p_id_usuario 
        LIMIT p_offset, p_limit;
    END IF;
END;


-----------------PLANTAS----------------
call sp_asociar_genero_planta(1,1)
CREATE PROCEDURE sp_asociar_genero_planta(
    IN p_id_genero INT,
    IN p_id_planta INT
)
BEGIN
 DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
        SELECT NULL AS planta;
    END;
    INSERT INTO tb_planta_genero (id_genero, id_planta)
    VALUES (p_id_genero, p_id_planta);
    select p_id_planta as planta;
END;
select *
from tb_planta_genero

CREATE PROCEDURE sp_plantas()
BEGIN
    SELECT id_planta, nombre
    FROM tb_planta;
END;


CREATE PROCEDURE sp_registrar_planta(
    IN p_nombre VARCHAR(100)
)
BEGIN
DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
        SELECT NULL AS planta;
    END;

    INSERT INTO tb_planta (nombre)
    VALUES (p_nombre);
    
    SELECT p_nombre AS planta;
END;





------------recomendaciones--------------
call sp_obtener_recomendaciones(3)

CREATE PROCEDURE sp_obtener_recomendaciones(
    IN p_id_usuario INT
)
BEGIN
    SELECT r.id_especimen, i.ruta_imagen
    FROM tb_recomendaciones r
    INNER JOIN tb_especimen_especie ee ON r.id_especimen = ee.id_especimen
    INNER JOIN tb_especimen_imagen i ON r.id_especimen = i.id_especimen
    WHERE r.id_usuario = p_id_usuario
    LIMIT 5;
END;


-------------PLANMTA


CREATE PROCEDURE eliminar_planta_genero (
  IN planta_id INT,
  IN genero_id INT
)
BEGIN
DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
        SELECT NULL AS planta;
    END;
  DELETE FROM tb_planta_genero
  WHERE id_planta = planta_id AND id_genero = genero_id;
      
    SELECT planta_id AS planta;
END



CREATE PROCEDURE actualizar_planta (
  IN planta_id INT,
  IN nuevo_nombre VARCHAR(100)
)
BEGIN
DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
        SELECT NULL AS planta;
    END;
  UPDATE tb_planta
  SET nombre = nuevo_nombre
  WHERE id_planta = planta_id;
  
SELECT nuevo_nombre AS planta;
END


select *
from tb_planta_genero

select *
from tb_genero

select *
from tb_planta




CREATE PROCEDURE actualizar_numero_gaveta (
  IN gaveta_id INT,
  IN nuevo_numero_gaveta INT
)
BEGIN
DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
        SELECT NULL AS gaveta;
    END;
  UPDATE tb_gaveta
  SET numero_gaveta = nuevo_numero_gaveta
  WHERE id = gaveta_id;
  sELECT nuevo_numero_gaveta AS gaveta;
END 



CREATE PROCEDURE actualizar_numero_gabinete (
  IN gabinete_id INT,
  IN nuevo_numero_gabinete INT
)
BEGIN
DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
        SELECT NULL AS gaveta;
    END;
  UPDATE tb_gabinete
  SET numero_gabinete = nuevo_numero_gabinete
  WHERE id = gabinete_id;
  sELECT nuevo_numero_gabinete AS gaveta;
END 




CREATE PROCEDURE actualizar_numero_caja (
  IN caja_id INT,
  IN nuevo_numero_caja INT
)
BEGIN
DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
        SELECT NULL AS gaveta;
    END;
  UPDATE tb_caja
  SET numero_caja = nuevo_numero_caja
  WHERE id = caja_id;
  SELECT nuevo_numero_caja AS gaveta;
END 


call actualizar_numero_vial(1,33343333)

CREATE PROCEDURE actualizar_numero_vial (
  IN vials_id INT,
  IN nuevo_numero_vial INT
)
BEGIN
DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
        SELECT NULL AS vial;
    END;
  UPDATE tb_vial
  SET numero_vial = nuevo_numero_vial
  WHERE id = vials_id;
  SELECT nuevo_numero_vial AS vial;
END 



select *

call elimina  (1)

CREATE PROCEDURE eliminar_especimen(IN especimen_id INT)
BEGIN
  DECLARE EXIT HANDLER FOR SQLEXCEPTION
  BEGIN
    ROLLBACK;
    SELECT null as mensaje;
  END;

  START TRANSACTION;

  -- Eliminar registros de tb_especimen_imagen relacionados con el especimen
  DELETE FROM tb_especimen_imagen
  WHERE id_especimen = especimen_id;

  -- Eliminar registros de tb_especimen_especie relacionados con el especimen
  DELETE FROM tb_especimen_especie
  WHERE id_especimen = especimen_id;

  -- Eliminar registros de tb_gaveta_especimen relacionados con el especimen
  DELETE FROM tb_gaveta_especimen
  WHERE id_especimen = especimen_id;

  -- Eliminar registros de tb_vial_especimen relacionados con el especimen
  DELETE FROM tb_vial_especimen
  WHERE id_especimen = especimen_id;

  DELETE FROM tb_recomendaciones
  WHERE id_especimen = especimen_id;

  -- Eliminar registro del especimen en la tabla tb_especimen
  DELETE FROM tb_especimen
  WHERE id_especimen = especimen_id;

  -- Eliminar registro de tb_etiqueta_recoleccion relacionado con el especimen
  DELETE FROM tb_etiqueta_recoleccion
  WHERE id_etiqueta = (SELECT id_etiqueta FROM tb_especimen WHERE id_especimen = especimen_id);

  COMMIT;

  SELECT 'La eliminación del especimen y sus registros relacionados fue exitosa.' as mensaje;
END




call sp_planta_cliente(1, 'c')
create PROCEDURE sp_planta_cliente(
    IN p_page_number INT,
    IN p_busqueda VARCHAR(255)
)
BEGIN
    DECLARE p_offset INT;
    DECLARE p_limit INT;
    DECLARE total_pages INT;
    DECLARE especimen_id INT;

    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
        SELECT NULL AS username;
    END;

    SET p_limit = 5;
    SET p_offset = (p_page_number - 1) * p_limit;


        SELECT COUNT(*) INTO total_pages
    FROM tb_genero g
    LEFT JOIN tb_planta_genero pg ON pg.id_genero = g.id_genero
    LEFT JOIN tb_planta p ON p.id_planta = pg.id_planta
    WHERE p.nombre LIKE CONCAT('%', p_busqueda, '%');


    IF p_offset >= total_pages THEN
        SELECT NULL AS username;
    ELSE
        SELECT DISTINCT g.nombre_genero, g.id_genero, COALESCE(sf.nombre_subfamilia, 'N/a') AS nombre_subfamilia,
            COALESCE(f.nombre_familia, 'N/a') AS nombre_familia, o.nombre_orden
        FROM tb_genero g
        LEFT JOIN tb_genero_subfamilia gs ON g.id_genero = gs.id_genero
        LEFT JOIN tb_subfamilia sf ON gs.id_subfamilia = sf.id_subfamilia
        LEFT JOIN tb_genero_familia gf ON g.id_genero = gf.id_genero
        LEFT JOIN tb_familia f ON (gf.id_familia IS NOT NULL AND f.id_familia = gf.id_familia) OR (gf.id_familia IS NULL AND f.id_familia = sf.id_familia)
        LEFT JOIN tb_orden o ON f.id_orden = o.id_orden
        LEFT JOIN tb_planta_genero pg ON pg.id_genero = g.id_genero
        LEFT JOIN tb_planta p ON p.id_planta = pg.id_planta
        WHERE p.nombre LIKE CONCAT('%c%')
        LIMIT p_offset, p_limit;
    END IF;
END;

select *
from tb_vial_especimen


call sp_actualizar_ubicacion_vial(8, 6)

CREATE PROCEDURE sp_actualizar_ubicacion_vial(
    IN p_id_especimen INT,
    IN p_id_vial_nuevo INT
)
BEGIN
    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
        SELECT NULL AS vial;
    END;

    -- Eliminar la asociación existente en tb_vial_especimen
    DELETE FROM tb_vial_especimen
    WHERE id_especimen = p_id_especimen;

    DELETE FROM tb_gaveta_especimen
    WHERE id_especimen = p_id_especimen;

    -- Asociar el especimen con el nuevo vial
    INSERT INTO tb_vial_especimen (id_vial, id_especimen)
    VALUES (p_id_vial_nuevo, p_id_especimen);

    SELECT p_id_vial_nuevo AS vial;
END


SELECT *
from tb_gaveta_especimen

select *
from tb_gaveta

call sp_actualizar_ubicacion_gaveta(5, 5)


CREATE PROCEDURE sp_actualizar_ubicacion_gaveta(
    IN p_id_especimen INT,
    IN p_id_gaveta_nueva INT
)
BEGIN
    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
        SELECT NULL AS vial;
    END;
    -- Eliminar la asociación existente en tb_gaveta_especimen
    DELETE FROM tb_vial_especimen
    WHERE id_especimen = p_id_especimen;

    DELETE FROM tb_gaveta_especimen
    WHERE id_especimen = p_id_especimen;

    -- Asociar el especimen con la nueva gaveta
    INSERT INTO tb_gaveta_especimen (id_gaveta, id_especimen)
    VALUES (p_id_gaveta_nueva, p_id_especimen);

    SELECT p_id_gaveta_nueva AS vial;
END


select *
from tb_distrito


call sp_actualizar_distrito_recoleccion(3, 7)


CREATE PROCEDURE sp_actualizar_distrito_recoleccion(
    IN p_id_distrito INT,
    IN p_id_especimen INT
)
BEGIN
    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
        SELECT NULL AS distrito;
    END;

    UPDATE tb_recoleccion
    SET distrito = p_id_distrito
    WHERE id_recoleccion = (
        SELECT id_recoleccion
        FROM tb_etiqueta_recoleccion
        WHERE id_etiqueta = (
            SELECT id_etiqueta
            FROM tb_especimen
            WHERE id_especimen = p_id_especimen
        )
    );
     SELECT p_id_distrito AS distrito;
END







----------------

CREATE PROCEDURE sp_actualizar_genero_especie(
    IN p_id_especimen INT,
    IN p_id_genero INT,
    IN p_id_especie INT
)
BEGIN
    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
        SELECT NULL AS especimen;
    END;

        -- Actualizar el género y la especie en tb_especimen_especie
        DELETE FROM tb_especimen_especie
        WHERE id_especimen = p_id_especimen;
        
    -- Actualizar el género en tb_etiqueta_recoleccion
    UPDATE tb_etiqueta_recoleccion
    SET id_genero = p_id_genero
    WHERE id_etiqueta = (
        SELECT id_etiqueta
        FROM tb_especimen
        WHERE id_especimen = p_id_especimen
    );

    -- Verificar si la especie existe en tb_especie
    IF EXISTS (SELECT * FROM tb_especie WHERE id_especie = p_id_especie) THEN
        INSERT INTO tb_especimen_especie (id_especimen, id_especie)
    VALUES (p_id_especimen, p_id_especie);
    END IF;

     SELECT p_id_especimen AS especimen;
END


34
call sp_actualizar_genero_especie(15, 1, 5)


select *
from tb_genero

select *
from tb_especimen_especie


select *
from tb_subfamilia





































CREATE PROCEDURE sp_obtener_historial (IN usuario_id INT)   BEGIN

SELECT COUNT(*) AS total
FROM (
    SELECT fecha, GROUP_CONCAT(nombre SEPARATOR ', ') AS nombres
    FROM (
        SELECT fecha, nombre_genero AS nombre
        FROM tb_historial_genero
        INNER JOIN tb_genero ON tb_historial_genero.id_genero = tb_genero.id_genero
        WHERE id_usuario = 3
    UNION ALL
        SELECT fecha, nombre_especie AS nombre
        FROM tb_historial_especie
        INNER JOIN tb_especie ON tb_historial_especie.id_especie = tb_especie.id_especie
        WHERE id_usuario = 3
    ) AS combined
    GROUP BY fecha
) AS subquery;



END



call sp_obtener_historial(3,1)

CREATE PROCEDURE sp_obtener_historial (IN usuario_id INT, IN p_page_number INT)   BEGIN
    DECLARE p_offset INT;
    DECLARE p_limit INT;
    DECLARE total_pages INT;

    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
        SELECT NULL AS username;
    END;





CREATE PROCEDURE sp_obtener_historial (IN usuario_id INT, IN p_page_number INT)   BEGIN

 DECLARE p_offset INT;
    DECLARE p_limit INT;
    DECLARE total_pages INT;

    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
        SELECT NULL AS username;
    END;

 SET p_limit = 5;
    SET p_offset = (p_page_number - 1) * p_limit;

    SELECT fecha, GROUP_CONCAT(nombre SEPARATOR ', ') AS nombres
    FROM (
        SELECT fecha, nombre_genero AS nombre
        FROM tb_historial_genero
        INNER JOIN tb_genero ON tb_historial_genero.id_genero = tb_genero.id_genero
        WHERE id_usuario = usuario_id
UNION ALL
        SELECT fecha, nombre_especie AS nombre
        FROM tb_historial_especie
         INNER JOIN tb_especie ON tb_historial_especie.id_especie = tb_especie.id_especie
        WHERE id_usuario = usuario_id
) AS combined
    GROUP BY fecha;
END




    SET p_limit = 5;
    SET p_offset = (p_page_number - 1) * p_limit;

    SELECT COUNT(*) INTO total_pages
    FROM (
        SELECT fecha, nombre_genero AS nombre
        FROM tb_historial_genero
        INNER JOIN tb_genero ON tb_historial_genero.id_genero = tb_genero.id_genero
        WHERE id_usuario = usuario_id
UNION ALL
        SELECT fecha, nombre_especie AS nombre
        FROM tb_historial_especie
         INNER JOIN tb_especie ON tb_historial_especie.id_especie = tb_especie.id_especie
        WHERE id_usuario = usuario_id
) AS combined
    GROUP BY fecha;

    IF p_offset >= total_pages THEN
        SELECT NULL AS username;
    ELSE

    SELECT fecha, GROUP_CONCAT(nombre SEPARATOR ', ') AS nombres
    FROM (
        SELECT fecha, nombre_genero AS nombre
        FROM tb_historial_genero
        INNER JOIN tb_genero ON tb_historial_genero.id_genero = tb_genero.id_genero
        WHERE id_usuario = usuario_id
UNION ALL
        SELECT fecha, nombre_especie AS nombre
        FROM tb_historial_especie
         INNER JOIN tb_especie ON tb_historial_especie.id_especie = tb_especie.id_especie
        WHERE id_usuario = usuario_id
) AS combined
    GROUP BY fecha
        LIMIT p_offset, p_limit;
    END IF;
END



call sp_obtener_historial(3,3)



CREATE PROCEDURE sp_obtener_historial (IN usuario_id INT, IN p_page_number INT)
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

    SELECT COUNT(*) INTO total_pages
FROM (
    SELECT fecha, GROUP_CONCAT(nombre SEPARATOR ', ') AS nombres
    FROM (
        SELECT fecha, nombre_genero AS nombre
        FROM tb_historial_genero
        INNER JOIN tb_genero ON tb_historial_genero.id_genero = tb_genero.id_genero
        WHERE id_usuario = 3
    UNION ALL
        SELECT fecha, nombre_especie AS nombre
        FROM tb_historial_especie
        INNER JOIN tb_especie ON tb_historial_especie.id_especie = tb_especie.id_especie
        WHERE id_usuario = 3
    ) AS combined
    GROUP BY fecha
) AS subquery;

    IF p_offset > total_pages THEN
        SELECT NULL AS username;
    ELSE
        SELECT fecha, GROUP_CONCAT(nombre SEPARATOR ', ') AS nombres
        FROM (
            SELECT fecha, nombre_genero AS nombre
            FROM tb_historial_genero
            INNER JOIN tb_genero ON tb_historial_genero.id_genero = tb_genero.id_genero
            WHERE id_usuario = usuario_id
            UNION ALL
            SELECT fecha, nombre_especie AS nombre
            FROM tb_historial_especie
            INNER JOIN tb_especie ON tb_historial_especie.id_especie = tb_especie.id_especie
            WHERE id_usuario = usuario_id
        ) AS combined
        GROUP BY fecha
        LIMIT p_offset, p_limit;
    END IF;
END;


select *
from tb_especie
call sp_actualizarGeneroEspecie(17, 1)
CREATE PROCEDURE sp_actualizarGeneroEspecie(
    IN p_id_especie INT,
    IN p_id_genero INT
)
BEGIN
 DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
        SELECT NULL AS especie;
    END;

    UPDATE tb_especie
    SET id_genero = p_id_genero
    WHERE id_especie = p_id_especie;

    SELECT p_id_especie AS especie; 
END












CREATE PROCEDURE ListarEspecimenesPorEspecie (IN especieNombre VARCHAR(255), IN p_page_number INT)   BEGIN

  DECLARE p_limit INT DEFAULT 5;
  DECLARE p_offset INT;
  DECLARE total_pages INT;
  DECLARE EXIT HANDLER FOR SQLEXCEPTION
  BEGIN
    SELECT NULL AS especimenes;
  END;

  SET p_offset = (p_page_number - 1) * p_limit;

  SELECT COUNT(*) INTO total_pages
  FROM tb_especimen e
  INNER JOIN tb_especimen_especie ee ON e.id_especimen = ee.id_especimen
  INNER JOIN tb_especie es ON ee.id_especie = es.id_especie
  WHERE es.nombre_especie LIKE CONCAT('%', especieNombre, '%');

  IF p_offset >= total_pages THEN
    SELECT NULL AS especimenes;
  ELSE

  SELECT e.id_especimen, e.id_etiqueta
  FROM tb_especimen e
  INNER JOIN tb_especimen_especie ee ON e.id_especimen = ee.id_especimen
  INNER JOIN tb_especie es ON ee.id_especie = es.id_especie
  WHERE es.nombre_especie LIKE CONCAT('%', especieNombre, '%')
    LIMIT p_offset, p_limit;
  END IF;
END




CREATE PROCEDURE ListarEspecimenesPorGenero (IN generoNombre VARCHAR(255), IN p_page_number INT)   BEGIN

  DECLARE p_limit INT DEFAULT 5;
  DECLARE p_offset INT;
  DECLARE total_pages INT;
  DECLARE EXIT HANDLER FOR SQLEXCEPTION
  BEGIN
    SELECT NULL AS especimenes;
  END;

  SET p_offset = (p_page_number - 1) * p_limit;

  SELECT COUNT(*) INTO total_pages
  FROM tb_especimen e
  INNER JOIN tb_especimen_especie ee ON e.id_especimen = ee.id_especimen
  INNER JOIN tb_especie es ON ee.id_especie = es.id_especie
  INNER JOIN tb_genero g ON es.id_genero = g.id_genero
  WHERE g.nombre_genero LIKE CONCAT('%', generoNombre, '%');

  IF p_offset >= total_pages THEN
    SELECT NULL AS especimenes;
  ELSE

   SELECT e.id_especimen, e.id_etiqueta
  FROM tb_especimen e
  INNER JOIN tb_especimen_especie ee ON e.id_especimen = ee.id_especimen
  INNER JOIN tb_especie es ON ee.id_especie = es.id_especie
  INNER JOIN tb_genero g ON es.id_genero = g.id_genero
  WHERE g.nombre_genero LIKE CONCAT('%', generoNombre, '%')
    LIMIT p_offset, p_limit;
  END IF;
END






-----iamegbnes



CREATE PROCEDURE ListarEspecimenesPorEspecie (IN especieNombre VARCHAR(255), IN p_page_number INT)
BEGIN
  DECLARE p_limit INT DEFAULT 5;
  DECLARE p_offset INT;
  DECLARE total_pages INT;
  DECLARE EXIT HANDLER FOR SQLEXCEPTION
  BEGIN
    SELECT NULL AS especimenes;
  END;

  SET p_offset = (p_page_number - 1) * p_limit;

  SELECT COUNT(*) INTO total_pages
  FROM tb_especimen e
  INNER JOIN tb_especimen_especie ee ON e.id_especimen = ee.id_especimen
  INNER JOIN tb_especie es ON ee.id_especie = es.id_especie
  WHERE es.nombre_especie LIKE CONCAT('%', especieNombre, '%');

  IF p_offset >= total_pages THEN
    SELECT NULL AS especimenes;
  ELSE


    SELECT e.id_especimen, e.id_etiqueta, ei.ruta_imagen
    FROM tb_especimen e
    INNER JOIN tb_especimen_especie ee ON e.id_especimen = ee.id_especimen
    INNER JOIN tb_especie es ON ee.id_especie = es.id_especie
    LEFT JOIN tb_especimen_imagen ei ON e.id_especimen = ei.id_especimen
    WHERE es.nombre_especie LIKE CONCAT('%a%')



    LIMIT p_offset, p_limit;
  END IF;
END

--SCRIPT PARA CREAR LATABLA FRAMEWORKS
-- RECUERDA DEBES CREAR UNA BASE LLAMADA tutoriales

CREATE TABLE frameworks (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100),
    lenguaje VARCHAR(50),
    version FLOAT,
    lanzamiento INT
);
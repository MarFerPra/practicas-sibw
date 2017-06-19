CREATE TABLE geekleaks_db.Usuarios (
    ID int NOT NULL AUTO_INCREMENT,
    Nombre varchar(100) NOT NULL,
    Password varchar(150) NOT NULL,
    Email varchar(100) NOT NULL,
    Rol varchar(255) NOT NULL,
    TokenAcceso varchar(200) NOT NULL,
    PRIMARY KEY (ID)
);

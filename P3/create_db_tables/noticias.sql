CREATE TABLE geekleaks_db.Noticias (
    ID int NOT NULL AUTO_INCREMENT,
    Titular varchar(255) NOT NULL,
    Subtitulo text,
    Entradilla text,
    Autor varchar(100),
    Cuerpo text,
    Fecha datetime,
    Principal boolean default false,
    Ultimas boolean default false,
    PRIMARY KEY (ID)
);

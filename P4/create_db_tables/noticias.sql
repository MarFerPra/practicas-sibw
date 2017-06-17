CREATE TABLE geekleaks_db.Noticias (
    ID int NOT NULL AUTO_INCREMENT,
    Titular varchar(255) NOT NULL,
    Subtitulo text,
    Entradilla text,
    Autor varchar(100),
    Cuerpo text,
    Fecha datetime,
    SeccionID int,
    Publicada boolean default false,
    Principal boolean default false,
    Ultimas boolean default false,
    FOREIGN KEY (SeccionID) REFERENCES Secciones(ID),
    PRIMARY KEY (ID)
);

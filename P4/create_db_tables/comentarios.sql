CREATE TABLE geekleaks_db.Comentarios (
    ID int NOT NULL AUTO_INCREMENT,
    NoticiaID int,
    DirIP varchar(39),
    Autor varchar(100),
    Email varchar(100),
    FechaHora datetime,
    Texto text,
    FOREIGN KEY (NoticiaID) REFERENCES Noticias(ID),
    PRIMARY KEY (ID)
);

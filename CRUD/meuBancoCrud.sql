CREATE DATABASE meuBancoCrud;
USE meuBancoCrud;

CREATE TABLE PESSOA(
	Id INT AUTO_INCREMENT,
    Nome VARCHAR(50) NOT NULL,
    Telefone VARCHAR(15) NOT NULL,
    Email VARCHAR(40) NOT NULL,
    PRIMARY KEY(id)
);

INSERT INTO PESSOA(Nome,Telefone,Email) VALUES("Pedro","8888-8888","pedro@gmail.com");
select * from PESSOA;
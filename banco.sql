CREATE DATABASE projetophp;

USE projetophp;

CREATE TABLE usuario(
    cod INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(50) NOT NULL,
    email VARCHAR(50) NOT NULL,
    login VARCHAR(50) UNIQUE NOT NULL,
    senha CHAR(32) NOT NULL,
    perfil ENUM ('adm','user') NOT NULL
);

INSERT INTO usuario VALUES(null, 'Lucas Pereira', 'lucas@gmail.com', 'lucas01', md5('123'), 'adm');

CREATE TABLE cliente(
    idCliente INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(50) NOT NULL,
    email VARCHAR(50) NOT NULL,
    dtNasc DATE NOT NULL,
    cpf CHAR(14) NOT NULL UNIQUE,
    dtCad DATETIME NOT NULL
);

CREATE TABLE endereco(
    idEnd INT PRIMARY KEY AUTO_INCREMENT,
    logradouro VARCHAR(50) NOT NULL,
    numero VARCHAR(20) NOT NULL,
    complemento VARCHAR(30) NOT NULL,
    cep CHAR(9) NOT NULL,
    bairro VARCHAR(30) NOT NULL,
    cidade VARCHAR(30) NOT NULL,
    uf CHAR(2) NOT NULL,
    idCliente INT  UNIQUE,
    FOREIGN KEY (idCliente) REFERENCES cliente (idCliente)
);

/*
dATE SÓ DATA, DATETIME -> DATA E HORA
DATE-> aaaa-mm-dd
*/
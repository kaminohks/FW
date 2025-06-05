CREATE DATABASE IF NOT EXISTS bibliotecafw;

USE bibliotecafw;

CREATE TABLE livros (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    autor VARCHAR(100) NOT NULL,
    genero VARCHAR(100),
    ano_publicacao INT,
    edicao VARCHAR(50)
);

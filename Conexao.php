<?php

class Conexao
{
    private $server = "localhost";
    private $banco = "bibliotecafw";
    private $usuario = "root";
    private $senha = "bancodedados";

    function conectar()
    {
        try {
            $con = new PDO("mysql:host=" . $this->server . ";dbname=" . $this->banco, $this->usuario, $this->senha);
            return $con;
        } catch (Exception $e) {
            print "Erro ao conectar com o banco de dados: " . $e->getMessage();
        }
    }
}

(new Conexao())->conectar();

<?php

/**
 * This is an example of open-close principle of SOLID, using strategy:
 * One class should not depend on each other and startegy use interfaces to 
 * usure every class can be implemented and expanded using interface to define a type
 */

interface Db
{
    public function connect($servidor, $nome, $usuario, $senha);
}

Class Mysql implements Db
{
    public function connect($servidor, $nome, $usuario, $senha)
    {
        echo 'conecta com mysql';
    }
}

class Connection
{
    public function __construct($servidor, $nome, $usuario, $senha)
    {
        $this->servidor = $servidor;
        $this->nome = $nome;
        $this->usuario = $usuario;
        $this->senha = $senha;
    }

    public function connect(Db $db)
    {
        $db->connect($this->servidor, $this->nome, $this->usuario, $this->senha);
    }
}

$conn = new Connection('localhost', 'curso_solid', 'root', '1234');
$conn->connect(new Mysql);
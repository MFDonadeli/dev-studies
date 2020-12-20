<?php

//Dependency inversion 
//Isso pode ser um problema para projetos muito grandes
//pois teria que instanciar ioc toda vez

class Database 
{
    public function __construct(\PDO $pdo)
    {
        $this->driver = $pdo;
    }
}

$ioc = [];
$ioc['db'] = function () {
    $pdo = new \PDO('dsn', 'user', '123');
    return new Database($pdo);
};

$ioc['db']();

//Dependency injection
//Agora eu tenho liberdade para trocar o Pdo por qualquer outro tipo de conexão

interface DatabaseDriver
{
    public function configure(array $config);
    public function connect();
}

class PdoDriver implements DatabaseDriver
{
    public function configure(array $config)
    {
        $this->config = $config;
    }

    public function connect()
    {
        $pdo = new \PDO('dsn', 'user', '123');
    }
}

class DatabaseJ 
{
    public function __construct(\PDO $pdo)
    {
        $this->driver = $pdo;
    }
}

$ioc = [];
$ioc['db'] = function () {
    $pdoDriver = new PdoDriver();
    $pdoDriver->configure(array());
    return new Database($pdo);
};

$ioc['db']();
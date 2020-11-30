<?php

class Db
{
    const TESTE = "oi";
}

class Singleton
{
    protected static $instance;
    protected static $config;

    //Para evitar o instanciamento da classe
    protected function __construct() {}
    protected function __clone() {}
    protected function __wakeup() {}

    public static function configure(array $config)
    {
        self::$config = $config;
        echo "Config";
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            $dsn = self::$config['dsn'] ?? '';
            $user = self::$config['user'] ?? '';
            $passwd = self::$config['passwd'] ?? '';
            $options = self::$config['options'] ?? [];

            //$pdo = new \PDO($dsn, $user, $passwd, $options);
            self::$instance = new Singleton();
        }
        return self::$instance;
    }
}

$db = Singleton::getInstance();
$db->configure(array("name" => "1"));
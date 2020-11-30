<?php

class ConcreteClass
{
    private $counter = 0;

    public function __construct()
    {
        var_dump('construiu');
    }

    public function __clone()
    {
        var_dump('clonada');
    }

    public function getCounter()
    {
        $this->counter ++;
        return $this->counter;
    }
}

class Singleton
{
    protected static $instance;

    protected function __construct() {}
    protected function __clone() {}

    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new ConcreteClass;
        }
        return self::$instance;
    }
}

$concrete_class = Singleton::getInstance();
var_dump($concrete_class->getCounter());
var_dump($concrete_class->getCounter());


$another_concrete_class = Singleton::getInstance();
var_dump($another_concrete_class->getCounter());

var_dump($concrete_class);
var_dump($another_concrete_class);

class Cliente
{
    public function __construct()
    {
        $instance = Singleton::getInstance();
        var_dump($instance);
        var_dump($instance->getCounter());
    }
}

new Cliente;
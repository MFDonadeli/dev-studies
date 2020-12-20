<?php

interface Interpreter
{
    public function interpret(int $mod = 0);
}

class Constitution implements Interpreter
{
    public $value;

    public function __construct(int $value)
    {
        $this->value = $value;
    }

    public function interpret(int $mod = 0)
    {
        return $this->value + $mod;
    }
}

class Force implements Interpreter
{
    public $value;

    public function __construct(int $value)
    {
        $this->value = $value;
    }

    public function interpret(int $mod = 0)
    {
        return $this->value + $mod;
    }
}

class Level implements Interpreter
{
    public $value;

    public function __construct(int $value)
    {
        $this->value = $value;
    }

    public function interpret(int $mod = 0)
    {
        return $this->value + $mod;
    }
}

class Life implements Interpreter
{
    private $fr;
    private $con;
    private $level;

    public function __construct(Interpreter $fr, Interpreter $con, Interpreter $level)
    {
        $this->fr = $fr;
        $this->con = $con;
        $this->level = $level;
    }

    public function interpret(int $mod = 0)
    {
        $result = $this->fr->interpret() + $this->con->interpret();
        $result = $result / 2;
        return ceil($result) + $this->level->interpret() + $mod;
    }
}

$fr = new Force(14);
$con = new Constitution(13);
$level = new Level(2);

// $life = (fr + con) / 2 + level - arredondar para cima
$life = new Life($fr, $con, $level);
var_dump($life->interpret());
var_dump($life->interpret(2));
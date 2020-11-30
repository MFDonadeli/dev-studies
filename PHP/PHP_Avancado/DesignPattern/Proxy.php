<?php

interface PersonInterface
{
    public function __construct($name, $age);
    public function getName() :string;
    public function getAge() :string;
}

class Person implements PersonInterface
{
    private $name;
    private $age;

    public function __construct($name, $age)
    {
        $this->name = $name;
        $this->age = $age;
    }

    public function getName() :string
    {
        return $this->name;
    }

    public function getAge() :string
    {
        return $this->age;
    }
}

class Proxy implements PersonInterface
{
    private $counter = 0;
    private $person;
    private $name;
    private $age;

    public function __construct($name, $age)
    {
        $this->name = $name;
        $this->age = $age;
    }

    public function getName() :string
    {
        $this->makePerson();
        return $this->person->getName();
    }

    public function getAge() :string
    {
        $this->makePerson();
        return $this->person->getAge();
    }

    public function getCounter()
    {
        return $this->counter;
    }

    public function makePerson()
    {
        if ($this->person == null) {
            var_dump('estou instanciando a classe agora');
            $this->person  = new Person($this->name, $this->age);
        }
        $this->counter ++;
        return $this->person;
    }
}

$person = new Proxy('Erik Figueiredo', 31);

var_dump($person->getName()); //até antes disso, o objeto Person, não existia
var_dump($person->getName());
var_dump($person->getAge());
var_dump($person->getCounter());
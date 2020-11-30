<?php

class FlywheightFactory
{
    private $soldiers = [];

    public function getSoldier(int $key)
    {
        if (empty($this->soldiers[$key])) {
            $this->soldiers[$key] = $this->makeSoldier();
        }
        return $this->soldiers[$key];
    }

    private function makeSoldier()
    {
        $names = [
            'Livius Aleksander',
            'Mason Hugubert',
            'Pat Longinus',
            'Tiborc Nikhil',
            'Quirino Anand',
        ];

        $name = array_rand($names, 1);
        $name = $names[$name];

        $ages = [
            19,
            21,
            27,
            32,
            38,
        ];

        $age = array_rand($ages, 1);
        $age = $ages[$age];

        return new Soldier($name, $age);
    }
}

class Soldier
{
    private $name;
    private $age;

    public function __construct($name, $age)
    {
        $this->name = $name;
        $this->age = $age;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getAge()
    {
        return $this->age;
    }
}

$factory = new FlywheightFactory;

$soldier1 = $factory->getSoldier(0);
$soldier2 = $factory->getSoldier(1);
$soldier3 = $factory->getSoldier(2);
$soldier4 = $factory->getSoldier(3);
$soldier5 = $factory->getSoldier(4);

$soldier6 = $factory->getSoldier(2);
$soldier7 = $factory->getSoldier(3);
$soldier8 = $factory->getSoldier(4);


var_dump($soldier1, $soldier2, $soldier3, $soldier4, $soldier5);
var_dump($soldier6, $soldier7, $soldier8);
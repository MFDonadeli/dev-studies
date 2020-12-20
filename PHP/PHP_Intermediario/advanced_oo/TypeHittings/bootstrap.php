<?php

require './vendor/autoload.php';
//require __DIR__ . './src/TypesHittings.php';
use PHP_Middle\TypesHittings;

//When you use namespace in the class declaration, this will be the name of class (\namespace\classname)
//$types = new \PHP_Middle\TypesHittings();

//In case of trying access a class that is not in this namespace I add \ in front of class name
//$type = new \Time();

$types = new TypesHittings();

echo $types->setName(1);
<?php

require __DIR__.'/ClassA.php';
require __DIR__.'/ClassB.php';

use Names\ClassA;

$a = new ClassA();
$b = new Names\ClassB();

$a->func1();
$b->func1();
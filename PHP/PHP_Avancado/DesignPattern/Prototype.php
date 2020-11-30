<?php

class ConcretePrototype
{
    public $title;
    public $author;
    public $counter;

    public function setTitle($title) {
        $this->title = $title;
    }

    public function setAuthor($author) {
        $this->author = $author;
    }

    public function __clone()
    {
        $this->counter++;

        if ($this->counter > 1) {
            throw new Exception("Você está indo longe demais meu filho...");
        }
    }
}

$original = new ConcretePrototype;

$original->setTitle('PHP Essencial');
$original->setAuthor('Erik Figueiredo');

var_dump($original);

$clone1 = clone $original;

$clone1->setTitle('Node.js para Noobies');

var_dump($clone1);

$clone2 = clone $original;

$clone2->setTitle('MongoDb bem basiquinho');

var_dump($clone2);

$clone3 = clone $clone1;

$clone3->setTitle('Laravel para artesãos');

var_dump($clone3);


$original1 = new SON\Prototype\ConcretePrototype;

$original1->setTitle('PHP Essencial');
$original1->setAuthor('Erik Figueiredo');

$reference = $original1;
$reference2 =& $original1;

$reference->setTitle('Livro errado');

var_dump($original1);
var_dump($reference);
var_dump($reference2);
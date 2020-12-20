<?php

class MyIterator implements \Iterator
{
    private $position = 0;
    private $array = [];

    public function __construct(array $data)
    {
        $this->array = $data;
    }

    function rewind()
    {
        var_dump(__METHOD__);
        $this->position = 0;
    }

    function current()
    {
        var_dump(__METHOD__);
        return $this->array[$this->position];
    }

    function key()
    {
        var_dump(__METHOD__);
        return $this->position;
    }

    function next()
    {
        var_dump(__METHOD__);
        ++$this->position;
    }

    function valid()
    {
        var_dump(__METHOD__);
        return isset($this->array[$this->position]);
    }
}

class MyIteratorTwo implements \Iterator
{
    private $position = 0;
    private $array = [];

    public function __construct(array $data)
    {
        $this->array = $data;
    }

    function rewind()
    {
        $this->position = 0;
    }

    function current()
    {
        return $this->array[$this->position];
    }

    function key()
    {
        return $this->position;
    }

    function next()
    {
        ++$this->position;
    }

    function valid()
    {
        return isset($this->array[$this->position]);
    }
}

$data = [
    "firstelement",
    "secondelement",
    "lastelement",
];

$iterator = new MyIterator($data); //com dump dos nomes dos metodos
$iterator_2 = new MyIteratorTwo($data); //sem dump dos nomes dos metodos

/*foreach($iterator_2 as $key => $value) {
    var_dump($key, $value);
    echo "\n";
}*/

while ($iterator_2->valid()) {
    var_dump($iterator_2->current());
    $iterator_2->next();
}
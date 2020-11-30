<?php
abstract class DB {
    public $var1;
    public function func1(){ //Essas outras aqui não são obrigados a serem implementados pelo filho
        echo "Essa classe veio de " . $this->var1;
    }
    abstract function connect(); //Todo filho vai ter que implementar esse método aqui
}

class MySQL extends DB{
    public function connect() {
        $this->var1 = "MySQL";
        echo "String conexão MySQL";
    }
}

class PostGre extends DB{
    public function connect() {
        $this->var1 = "PostGre";
        echo "String conexão PostGre";
    }
}

$db = new PostGre();
$db->connect();
$db->func1();
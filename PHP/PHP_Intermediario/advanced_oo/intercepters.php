<?php

trait Count {
    public function countChars($name)
    {
        echo strlen($name);
    }
}

class Intercepter {

    use Count;

    private $name;

    public function __toString() :string
    {
        return $this->name;
    }

    protected function setName($name)
    {
        $this->name = $name;
    }

    //Chama métodos não instanciados pela classe
    public function __call($method, $properties)
    {
        echo "Metodo";
        var_dump($method);

        echo "Propriedades";
        var_dump($properties);
    }

    public function __set($prop, $value)
    {
        $method = 'set' . ucfirst($prop);

        if(method_exists($this, $method))
            $this->$method($value);
        else
            $this->$prop = $value;
        
        $this->$prop = $value;
    }

    public function __get($prop)
    {
        echo "__get" . $prop;
        $method = 'get' . ucfirst($prop);
        
        if(method_exists($this, $method))
            return $this->$method();
        
        return $this->$prop;
    }


}



$aaa = new Intercepter();

$aaa->teste(1234);

$aaa->name = "afdafa";

echo "Thanks to __get: " . $aaa->name . PHP_EOL;

echo "Thanks to __toString: " . $aaa . PHP_EOL;

echo "Thanks to Trait: " . $aaa->countChars($aaa->name);


echo $aaa->name1;


<?php

namespace PHP_Middle;

class TypesHittings
{
    public function setName(string $name)
    {
        if(!is_string($name)){
            die("Not a string");
        }

        return $name;
    }
}
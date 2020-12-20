<?php

interface Strategy
{
    public function table(string $table) : Strategy;
}

class Sql implements Strategy
{
    public function table(string $table) : Strategy
    {
        $this->table = $table;
        return $this;
    }
}
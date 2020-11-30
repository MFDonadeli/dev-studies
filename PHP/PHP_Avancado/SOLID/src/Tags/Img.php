<?php

namespace Php_Adv\Solid\Tags;

class Img 
{
    public function render(string $src)
    {
        return '<img src="' . $src . '">';
    }
}
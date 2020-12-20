<?php

namespace Php_Adv\Solid\Tags;

class A 
{
    public function render(string $href, string $anchor)
    {
        return '<a href="' . $href . '">' . $anchor . '</a>';
    }
}
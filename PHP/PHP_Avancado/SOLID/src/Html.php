<?php

namespace Php_Adv\Solid;

/**
 * Se mais tags forem criadas aqui vai quebrar o O do SOLID, que é aberto para expansão e fechado para alteração e para isso 
 * eu crio classes ao redor
 */
class Html 
{
    //Essa função img vai ser criada em uma classe
    /*
    public function img(string $src)
    {
        return '<img src="' . $src . '">';
    }
    */

    public function __call(string $name, array $arguments)
    {
        $class = 'Php_Adv\Solid\Tags\\' . ucfirst($name);

        return call_user_func_array([new $class, 'render'], $arguments);
    }
}
<?php

namespace Php_Adv\Solid;

class HtmlTest extends \PHPUnit\Framework\TestCase
{
    public function testSimpleSample()
    {
        $html = new Html;
        $img = $html->img('images/photo.jpg');

        $this->assertEquals('<img src="images/photo.jpg">', $img);
    }
}
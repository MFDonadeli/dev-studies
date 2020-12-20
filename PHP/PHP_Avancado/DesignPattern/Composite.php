<?php

abstract class CategoriesAbstract
{
    protected $categories = [];

    public abstract function getName();

    public function addCategory(CategoriesAbstract $category)
    {
        $this->categories[] = $category;
    }

    public function removeCategory(CategoriesAbstract $category)
    {
        $this->categories = array_filter(function ($cat) use ($category) {
            return $cat === $category;
        });
    }

    public function getCategory(int $key)
    {
        return $this->categories[$key] ?? null;
    }
}

class FrameworksCategory extends CategoriesAbstract
{
    public function getName()
    {
        return 'Frameworks';
    }
}

class LaravelCategory extends CategoriesAbstract
{
    public function getName()
    {
        return 'Laravel';
    }
}

class PHPCategory extends CategoriesAbstract
{
    public function getName()
    {
        return 'PHP';
    }
}

class SolidCategory extends CategoriesAbstract
{
    public function getName()
    {
        return 'SOLID';
    }
}

$php = new PHPCategory;
$solid = new SolidCategory;
$framework = new FrameworksCategory;
$laravel = new LaravelCategory;


$solid->addCategory($laravel);
$php->addCategory($framework);
$php->addCategory($solid);

function categoriesList($category, $start = '__') {
    $i = 0;
    while ($category->getCategory($i) !== null) {
        $cat = $category->getCategory($i);
        if ($cat->getCategory(0) !== null) {
            categoriesList($cat, $start.'__');
        }
        echo $start . $cat->getName().PHP_EOL;
        $i++;
    }
}

categoriesList($php);
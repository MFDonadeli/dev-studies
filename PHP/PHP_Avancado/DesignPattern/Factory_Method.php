<?php

interface CreatorInterface
{
    public function factoryMethod(ProductInterface $product): ProductInterface;
}

interface ProductInterface
{
    public function setDirectory(string $directory);
    public function getImage();
}

class ConcreteCreator implements CreatorInterface
{
    public function factoryMethod(ProductInterface $product): ProductInterface
    {
        $product->setDirectory('images');
        return $product;
    }
}

class Circle implements ProductInterface
{
    private $directory;

    public function setDirectory(string $directory)
    {
        $this->directory = $directory;
    }

    public function getImage()
    {
        return $this->directory . '/circle.png';
    }
}

class Triangle implements ProductInterface
{
    private $directory = '/root/';

    public function setDirectory(string $directory)
    {
        $this->directory .= $directory;
    }
    public function getImage()
    {
        return $this->directory . '/tringle.png';
    }
}

class Client
{
    public function __construct()
    {
        $circle = (new ConcreteCreator)->factoryMethod(new Circle);
        echo $circle->getImage();

        echo PHP_EOL;

        $triangle = (new ConcreteCreator)->factoryMethod(new Triangle);
        echo $triangle->getImage();
    }
}

new Client;

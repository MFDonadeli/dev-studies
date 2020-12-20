<?php

interface Implementor
{
    public function showAuthor() :string;
    public function showTitle() :string;
}

class LowerImplementor implements Implementor
{
    private $author;
    private $title;

    public function __construct($author, $title)
    {
        $this->author = $author;
        $this->title = $title;
    }

    public function showAuthor() :string
    {
        return strtolower($this->author);
    }

    public function showTitle() :string
    {
        return strtolower($this->title);
    }
}

class UpperImplementor implements Implementor
{
    private $author;
    private $title;

    public function __construct($author, $title)
    {
        $this->author = $author;
        $this->title = $title;
    }

    public function showAuthor() :string
    {
        return strtoupper($this->author);
    }

    public function showTitle() :string
    {
        return strtoupper($this->title);
    }
}

abstract class BridgeBook
{
    public function __construct(string $author, string $title, string $implementor)
    {
        $this->implementor = new $implementor($author, $title);
        if (is_a($this->implementor, 'Implementor'));
    }

    public abstract function get():string;
}

class BookAuthorTitle extends BridgeBook
{
    public function get():string
    {
        return $this->implementor->showAuthor() . ' ' . $this->implementor->showTitle();
    }
}

class BookTitleAuthor extends BridgeBook
{
    public function get():string
    {
        return $this->implementor->showTitle() . ' ' . $this->implementor->showAuthor();
    }
}

$example1 = new BookAuthorTitle('Erik Figueiredo', 'Livro PHP 7.0', LowerImplementor::class);
var_dump($example1->get());

$example1 = new BookAuthorTitle('Erik Figueiredo', 'Livro PHP 7.0', UpperImplementor::class);
var_dump($example1->get());

$example1 = new BookTitleAuthor('Erik Figueiredo', 'Livro PHP 7.0', LowerImplementor::class);
var_dump($example1->get());

$example1 = new BookTitleAuthor('Erik Figueiredo', 'Livro PHP 7.0', UpperImplementor::class);
var_dump($example1->get());
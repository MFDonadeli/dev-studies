<?php

interface Booksinterface
{
    public function getAuthorAndTitle();
}

class PHPBook
{
    private $author;
    private $title;

    public function __construct(string $title, string $author)
    {
        $this->author = $author;
        $this->title = $title;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getAuthor()
    {
        return $this->author;
    }
}

//Classe adapter para se comunicar com a classe Books
class PHPBookAdapter implements Booksinterface
{
    private $book;

    public function __construct(string $title, string $author)
    {
        $this->book = new PHPBook($title, $author);
    }

    public function getAuthorAndTitle()
    {
        return  $this->book->getTitle(). ' by ' . $this->book->getAuthor();
    }
}

class RenderBook
{
    private $book;

    public function __construct(Booksinterface $book)
    {
        $this->book = $book;
    }

    public function renderTitleAndName()
    {
        return $this->book->getAuthorAndTitle();
    }
}

//O adapter vai cadastrar um novo book
$book = new PHPBookAdapter('Livro de PHP 7.0', 'Erik Figueiredo');

//Esse lê as informações através da interface
$render = new RenderBook($book);
echo $render->renderTitleAndName();
<?php
interface AbstractEditoraA {
    public function getTitle(): string;
    public function getAuthor(): string;
}

interface AbstractEditoraB {
    public function getTitle(): string;
    public function getAuthor(): string;
    public function getPages(): string;
}

interface AbstractFactory
{
    public function makeLivroLinguagem();
    public function makeLivroBanco();
}

//Editor vai ter um livro especificamente com uma linguagem e um banco. E isso pode ser trocado facilmente pois os livros possuem as estruturas
//já fixadas pela interface
class EditoraA implements AbstractFactory
{
    private $linguagem;
    private $banco;

    public function __construct()
    {
        $this->linguagem = new LivroPHP;
        $this->banco = new LivroMysql;
    }
    public function makeLivroLinguagem()
    {
        $this->linguagem->setTitle('PHP Essencial');
        $this->linguagem->setAuthor('Fulano de Tal');
        return $this->linguagem;
    }

    public function makeLivroBanco()
    {
        return $this->banco;
    }
}

class LivroMongoDb implements AbstractEditoraB {
    public function getTitle(): string
    {
        return 'MongoDb para iniciantes';
    }

    public function getAuthor(): string
    {
        return 'Erik Figueiredo';
    }

    public function getPages(): string
    {
        return '300 paginas';
    }

}

class LivroMysql implements AbstractEditoraA {
    public function getTitle(): string
    {
        return 'MySql para quem nunca ouviu falar';
    }

    public function getAuthor(): string
    {
        return 'João de Tal';
    }
}

class LivroPHP implements AbstractEditoraA {
    private $title = null;
    private $author = null;

    public function setTitle(string $title)
    {
        $this->title = $title;
    }

    public function setAuthor(string $author)
    {
        $this->author = $author;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getAuthor(): string
    {
        return $this->author;
    }
}



$abstract_factory = new EditoraA;

$livro_php = $abstract_factory->makeLivroLinguagem();

echo $livro_php->getTitle();
echo PHP_EOL;
echo $livro_php->getAuthor();
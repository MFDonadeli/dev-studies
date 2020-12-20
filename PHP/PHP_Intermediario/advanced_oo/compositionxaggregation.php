<?php

echo PHP_EOL."--COMPOSITION--".PHP_EOL;
class Author_Comp {
    private $name;
   
    public function __construct($name){
     $this->name = $name;
    }
   
    public function getName(){
     return $this->name;
    }
   }
   
   class Book_Comp {
    //using array to allow multiple authors
    private $authors = array();
    private $name;
   
    public function __construct($name){
     $this->name = $name;
    }
   
    public function getName(){
     return $this->name;
    }
   
    public function addAuthor($name){
     $this->authors[] = new Author_Comp($name);
    }
   
    public function getAuthors(){
     return $this->authors;
    }
   }
   
   $book = new Book_Comp('Book Name');
   $book -> addAuthor('Kelly');
   
   /* print book info */
   echo $book -> getName();
   
   /* print book's authors info */
   $authors = $book -> getAuthors(); //Array of authors
   foreach ($authors as $author) {
    echo $author -> getName();
   }


   echo PHP_EOL."--AGGREGATION--".PHP_EOL;
   class Author_Aggr {
    private $name;
   
    public function __construct($name) {
     $this->name = $name;
    }
    
    public function getName() {
     return $this->name;
    }
   }
   
   class Book_Aggr {
    private $authors;
    private $name;
   
    public function __construct($name,$author){
     $this->name = $name;
     $this->author = $author;
    }
   
    public function getName(){
     return $this->name;
    }
    public function getAuthor(){
     return $this->author;
    }
   }
   
   $author = new Author_Aggr('Kelly');
   $book = new Book_Aggr('Book Name',$author);
   
   echo $book->getName(); //Book Name
   echo $book->getAuthor() -> getName(); //Kelly
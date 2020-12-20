# Classes em PHP

O conceito de classes é igual para as linguagens, vou resumir um pouco aqui.

A orientação a objetos é feita em cinco pilares: Herança, Polimorfismo, Abstração, Encapsulamento e Associação

## Herança

Uma classe herda métodos e atributos de uma outra classe

## Polimorfismo

Uma classe pode ter várias formas, ou seja, herdando da classe pai uma variável que pode tomar várias formas diferentes,
ou seja, pode ser várias outras coisas. Ou seja, nesse exemplo DB é pai e os filhos podem ter formas de MySQL, PostGre, etc.

## Abstração

Uma classe que tem no pai é instanciado no filho

```
<?php>
<?php
abstract class DB {
    public $var1;
    public function func1(){ //Essas outras aqui não são obrigados a serem implementados pelo filho
        echo "Essa classe veio de " . $this->var1;
    }
    abstract function connect(); //Todo filho vai ter que implementar esse método aqui
}

class MySQL extends DB{
    public function connect() {
        $this->var1 = "MySQL";
        echo "String conexão MySQL";
    }
}

class PostGre extends DB{
    public function connect() {
        $this->var1 = "PostGre";
        echo "String conexão PostGre";
    }
}
```

## Encapsulamento

Posso escrever uma classe que encapsula MySQL e essa classe pode ser genérica e ser reescrita para PostGre


## Associação

Como os objetos se associam entre si. Pode ser de duas formas:

- Agregação: Pode ser usado em várias classes. A classe que encapsula sem ter a presença de DB. A associação é "tem uma" e é unidirecional. 
             "A USA B"
- Composição: Geralmente é usado num lugar só.  A classe que encapsula só com a presença de DB. A associação é "parte de". São dependentes.
              "A É DONO DE B"

Composição:
```
$book = new Book_Comp('Book Name');
$book -> addAuthor('Kelly');

addAuthor($name){
    $this->authors[] = new Author_Comp($name);
}
```

Agregação:
```
$author = new Author_Aggr('Kelly');
$book = new Book_Aggr('Book Name',$author);

__construct($name,$author){
    $this->name = $name;
    $this->author = $author;
}
```

# Classes call and instantiations

//When you use namespace in the class declaration, this will be the name of class (\namespace\classname)
```
$types = new \PHP_Middle\TypesHittings();
```

//In case of trying access a class that is not in this namespace I add \ in front of class name
```
$type = new \Time();
```

# Traits

Gera herança horizontal, ou seja, posso usar métodos genéricos que servem para muitos lugares diferentes dentro da aplicação.
Nâo tem tipo, não precisa herdar


# PHP-FIG

PHP Framework Interop Group - um conjunto de desenvolvedores que se juntaram e criaram algumas regras para melhorar o código
e o uso do PHP

# PSR

PHP - Php Standard Recomendation, boas práticas para tornar o código mais utilizável e mais bem escrito

3 categorias: Interface, code styles and autoload

Se eu uso a PSR-1 eu sou obrigado a usar a PSR-4 e se eu uso a PSR-2 sou obrigado a conhecer a PSR-1

PSR-4: Autoload: Nomes para namespace <Vendor>\\<nome>\\<pastas>, o vendor é o nome "configuravel", ou nome principal, nome é o nome do namespace geral e o restante é separado e configurado como organização de pastas.

PSR-1: Padrões de código para o PHP

- <?php echo "Mensagem" ?> é igual <?= "Mensagem"; ?>
- Arquivos tem que ter contexto separado. Classes tem que ter seu próprio arquivo. Constantes tem que ter seu proprio arquivo (arquivos que declaram e que causam efeitos)
- Classes no format FormatoDeClasse, seus métodos no formato formatoDoMetodo, constantes no formato FORMATO_CONSTANTE e propriedade no formato propriedade_classe


PSR-2: Estilo de código

No caso o estilo para deixar ele fácil de ler, para que o trabalho em grupo seja facilitado

- Deve seguir o PSR-1
- Linhas com 80 até 120 caracters
- Abertura e fechamento de chaves, sempre na outra linha
- Estruturas de controle as chaves ficam na mesma linha e tenha um espaço entre a palavra e o parentesis neste estilo:
  ```
  if ($a == $b) {
  } else if () {
  }
  ```
- Se tiver muitos argumentos a função, pode quebrar linha e no final você coloca } ao lado do parentesis: } (
- Quebra de linha sempre padrão Linux
- Tem que terminar uma linha em branco (VSCode já coloca)
- Linhas vazias não devem conter espaços
- Um comando por linha
- extends e implements na mesma linha a não ser se tem muitos implements

PHP_CodeSniff para checar se está dentro dos PSRs



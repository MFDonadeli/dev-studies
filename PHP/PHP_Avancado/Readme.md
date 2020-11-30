# PHP Avançado

## SOLID

### Single Responsability

Uma classe deve ter uma única responsabilidade, por exemplo, conectar no banco, salvar os dados, escrever o relatório

### Open-Close Principle

Uma classe deve estar aberta para expansão e fechada para modificação: Uma classe não pode depender da outra! Possíveis soluções:
- User interfaces (Strategy) e classes abstratas (Template Method) para definir um tipo

Geralmente esse padrão resolve S e D

### Liskov substitution

Subtipos devem ser substituídos pelos seus tipos base. Exemplo: um quadrado é um tipo de retângulo, mas não pode ser substituído por ele pois quebra o principio de Liskov.

Um bom exemplo é a classe Socialite do Laravel

### Interface segregation

Nenhum cliente deve ser forçado a depender de métodos que ele não use. Para isso podemos e devemos criar interfaces menores e mais simples, mesmo que com métodos duplicados

### Dependency Inversion

- Módulos de alto nível não deveriam depender de módulos de baixo nível. Ambos deveriam depender de abstrações (classes abstratas e interfaces):
  No exemplo do arquivo Db.php: a classe Connection não pode depender da classe MySql, ela depende da classe Db. Se eu declarasse MySQL dentro do connect de Connection iria criar uma forte dependência, por isso devo declarar fora:
  ```
  //Correto
  connect(new MySql);
  connect(Db $db) { //Db é interface que aceita várias acomplações

  }

  //Errado
  connect() {
      $db = new MySql();
  }
  ```
- Abstrações não deveriam depender de detalhes. Detalhes devem depender de abstrações.

## Injeção de dependência

É baseado no D do SOLID, em que faz a chamada de método através de um array.

Classes de Reflexão, são classes responsáveis por trazer informações sobre alguma coisa

## Design Patterns

Escopo de classe: Relacionamentos definidos nas classes
Escopo de objeto: Relacionamentos definidos nos objetos, em tempo de execução

### Padrões de criação: 

Ajuda a criar classes

- Abstract Factory: Agrupa objetos factories que tem um tema em comum. Criação de conjunto de objetos relacionados ou dependentes sem especificar suas classes concretas. O cliente da fábrica de abstração não precisa se preocupar como estes objetos são criados, ele só sabe obtê-los.
- Builder: Facilita a criação de objetos complexos, separando em mais interfaces. O padrão Builder pode ser utilizado em uma aplicação que converte o formato de texto RTF para uma série de outros formatos e que permite a inclusão de suporte para conversão para outros formatos, sem a alteração do código fonte do leitor de RTF.
- Factory Method: Cria objetos sem especificar a classe exata a ser criada. Definir uma interface para criar um objeto, mas deixar as subclasses decidirem que classe instanciar. O Factory Method permite adiar a instanciação para subclasses.
- Prototype: Cria objeto através da clonagem de objetos existentes. Especificar os tipos de objetos a serem criados usando uma instância-protótipo e criar novos objetos pela cópia desse protótipo.
- Singleton: Conhecido como anti-padrão, por ter forte acoplamento. Garante a existência de apenas uma instância de uma classe, mantendo um ponto global de acesso ao seu objeto.

### Padrões estruturais

- Adapter: Autoriza classes de tipos incompatíveis a trabalharem juntas através da criação de uma insterface que possibilitam isso. 
- Bridge: Desacopla uma abstração de sua implementação para que as duas possam variar independentemente. No exemplo há duas classes que recebem os mesmos valores no construtor: duas string e uma classe que vai executar uma ação (no caso lower ou upper case), as duas classes podem ser intercambiadas sem problemas na execução e o terceiro parâmetro recebe uma classe que implementa uma interface.
- Composite: Compõe zero ou mais objetos semelhantes para que possam ser manipulados como um objeto. No exemplo temos 4 classes todas extendendo a mesma classe abstrata. Essas classes tem um método cujo parametro é a classe abstrata. Isso, no exemplo, vai criar niveis hierarquicos, dependendo do modo que são instanciados.
- Decorator: Adiciona ou sobrescreve dinamicamente comportamentos em um objeto existente. No exemplo ele chamou um método não existente em uma classe, isso apontando para um comentário que estava no topo dessa classe. 
- Facade: Provê uma interface simplificada para um grande corpo de código. No exemplo ele passa uma string para um método de classe, essa string é transferida internamente para uma outra classe que retorna se o nome foi encontrado no bd.
- Flyweight: Reduz o custo de criação e manipulação de um grande número de objetos semelhantes. No exemplo ele usa só uma método para popular um array.
- Proxy: Fornece um espaço reservado para outro objeto para controlar o acesso, reduzir custos e reduzir a complexidade. No exemplo usa-se a classe Proxy que é uma ponte para preencher outra classe mais complexa.

### Padrões comportamentais

- Chain of responsability: Delega comandos para uma cadeia de objetos. No exemplo ele chama um método e no parâmetro coloca o próximo método a ser executado.
- Command: Cria objeto que encapsula ações e parametros. No exemplo ele recebe o parâmetro, traduz para o nome da classe e executa.
- Interpreter: Implementa uma linguagem especializada. No exemplo ele usa interface e as classes que implementam essas interfaces para ler diferentes classes e usar os mesmos métodos dessas classes (no caso soma mod() de qualquer classe)
- Iterator: Acessa o elemento de um objeto sequencialmente sem expor sua representação. O exemplo cria um iterator de um array, um array é passado para a classe e são acessados os itens com os métodos current, next, previous, etc.
- Mediator: Permite o acoplamento fraco entre classes por ser a única classe que possui conhecimento detalhado de seus métodos. No exemplo passa por parâmetro classes em um método e dentro desse método ele vai conseguir achar quais métodos vão executar tudo o que pediu, a partir de uma única chamada. A partir dessa única chamada os métodos estão encadeados entre as classes envolvidas.
- Memento: Provê a possibilidade de um objeto restaurar seu estado antigo. No exemplo isso é feito.
- Observer: Implementa um observador em um objeto para que eles vejam um evento. No exemplo tem um array que está dentro de uma classe, então é criado uma outra classe que adiciona e atualiza o array que está na primeira classe. Essas duas não tem nenhum contato a não ser o observer.
- State: Possibilita um objeto de alterar seu comportamento quando o estado interno muda. No exemplo ele faz exatamente essas mudanças de estado.
- Strategy: Define uma família ou tipo de classe de forma a reforçar, principalmente, os princípios Open/Closed e de Liskov do SOLID.
 Precisa de uma interface e uma classe concreta. Delega as responsabilidades adquiridas pelas entidades, atribuindo, portanto, o comportamento (exatamente o que faz uma interface, ela delega o que uma classe deve fazer e a classe só implementa). Implementa-se a interface e ela dita como as classes vão se comportar. Sendo assim muito fácil implantar novas classes e trocar.
- Template Method: Define um esqueleto de um algoritimo como uma classe abstrata, permitindo suas subclasses implementar comportamentos concretos. No exemplo tem uma classe abstrata que implementa alguns métodos e tem um método abstrato que é implementado pelas subclasses, são duas classes diferentes uma para receber o valor e outra pra diminuir o valor.
- Visitor: Separa um algoritimo de uma estrutura de objetos mudando a hierarquia de métodos dentro de um objeto. No exemplo é criado uma classe e nessa classe tem um método que tem um parâmetro qualquer classe que implementa determinada interface. Esse parâmetro vai executar uma função que altera uma string dessa primeira classe.

### MVC
<?php

/**
 * Todo builder constroi: 
 * 
 * director — constrói um objeto utilizando a interface do builder;
 * builder — especifica uma interface para um construtor de partes do objeto-produto;
 * concrete builder — define uma implementação da interface builder, mantém a representação que cria e fornece interface para recuperação do produto;
 * product — o objeto complexo acabado de construir. Inclui classes que definem as partes constituintes.
 * 
 */

//Base para construção dos projetos. especifica uma interface para um construtor de partes do objeto-produto
interface BuilderInterface
{
    public function setTable(string $table);
    public function getSqlAll() :string;
}

//Base para execução da tarefa. Constroi um objeto utilizando a interface do builder. 
interface DirectorInterface
{
    public function __construct(BuilderInterface $builder = null);
    public function getSqlAll() :string;
}

//define uma implementação da interface builder. Define os passos para o director
class SqlBuilder implements BuilderInterface
{
    protected $query;

    public function __construct()
    {
        $this->query = new Sql;
    }

    public function setTable(string $table)
    {
        $this->query->table($table);
    }

    public function getSqlAll() :string
    {
        return $this->query
            ->select()
            ->getQuery();
    }
}

//o objeto complexo acabado de construir. Inclui classes que definem as partes constituintes. Constrói o resultado
class UsersDirector implements DirectorInterface
{
    protected $builder;

    public function __construct(BuilderInterface $builder = null)
    {
        $this->builder = $builder;
    }

    public function getSqlAll() :string
    {
        $this->builder->setTable('users');
        return $this->builder->getSqlAll();
    }
}

$builder = new SqlBuilder;
$director = new UsersDirector($builder);

$sql = $builder->getSqlAll();

var_dump($sql);
<?php

/**
 * Decorator
 */
interface DecoratorInterface
{
    public function setEntity(EntityInterface $entity);
    public function operation() :string;
}

/**
 * Component
 */
interface EntityInterface
{
    public function getName() :string;
}

class MigrationDecorator implements DecoratorInterface
{
    protected $entity;

    public function setEntity(EntityInterface $entity)
    {
        $this->entity = $entity;
    }

    public function operation() :string
    {
        $name = get_class($this->entity);
        $name = explode('\\', $name);
        $name = array_pop($name);
        return strtolower($name) . 's migrated';
    }
}

class OrmDecorator implements DecoratorInterface
{
    protected $entity;

    public function setEntity(EntityInterface $entity)
    {
        $this->entity = $entity;
    }

    public function operation() :string
    {
        return $this->entity->getName() . ' finded in database';
    }
}

/**
 * @decorator Orm
 */
class User implements EntityInterface
{
    private $name;

    public function setName($name)
    {
        return $this->name = $name;
    }
    public function getName() :string
    {
        return $this->name;
    }
}

$user = new User;
$user->setName('Erik Figueiredo');

$orm = new OrmDecorator;
$orm->setEntity($user);
$result = $orm->operation();
var_dump($result);

$migration = new MigrationDecorator;
$migration->setEntity($user);
$result = $migration->operation();
var_dump($result);


$usermg = new User;
$usermg->setName('Erik Figueiredo');

$reflector = new ReflectionClass(User::class);
$comments = $reflector->getDocComment();

preg_match('/\@decorator\ ([0-9a-zA-Z]+)/', $comments, $matches);

if ($matches[1]) {
    $class = $matches[1] .'Decorator';
}

$ormmg = new $class;
$ormmg->setEntity($usermg);
$resultmg = $ormmg->operation(); //A classe usada no reflector é user, mas tinha um comentário opontando para OrmDecorator, então usou uma função da propria OrmDecorator
var_dump($resultmg);
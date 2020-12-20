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

class EntityFacade
{
    private static $entity;

    public function setEntity(EntityInterface $entity)
    {
        $this->entity = $entity;
    }

    public static function resolve($name)
    {
        if (self::$entity == null) {
            self::$entity = new User;
        }

        self::$entity->setName($name);

        $reflector = new \ReflectionClass(get_class(self::$entity));
        $comments = $reflector->getDocComment();

        preg_match('/\@decorator\ ([0-9a-zA-Z]+)/', $comments, $matches);

        if ($matches[1]) {
            $class = $matches[1] .'Decorator';
        }

        $orm = new $class;
        $orm->setEntity(self::$entity);
        return $orm->operation();
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

$facade = new EntityFacade;
$result = $facade->resolve('Erik Figueiredo');
//$result = EntityFacade::resolve('Erik Figueiredo');

var_dump($result);
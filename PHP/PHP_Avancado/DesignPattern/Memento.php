<?php

class Entity
{
    private $name;

    public function setName(string $name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }
}

class Memento
{
    private $obj;

    public function __construct(Entity $obj)
    {
        $this->obj = clone $obj;
    }

    public function getState()
    {
        return clone $this->obj;
    }
}

class Orm
{
    private $entity;
    private $memento;

    public function __construct(Entity $entity)
    {
        $this->entity = $entity;
    }

    public function save(string $name)
    {
        $this->backupToMemento();
        $this->entity->setName($name);
    }

    public function delete()
    {
        $this->backupToMemento();
        unset($this->entity);
    }

    public function find()
    {
        if (!empty($this->entity)) {
            return $this->entity->getName();
        }
        return 'no result';
    }

    public function undo()
    {
        $this->entity = $this->memento->getState();
    }

    protected function backupToMemento()
    {
        $this->memento = new Memento($this->entity);
    }
}

$user = new Entity;
$user->setName('Erik');

$orm = new Orm($user);
writeIn($orm->find());

writeIn('Update name');
$orm->save('Figueiredo');
writeIn($orm->find());

writeIn('restore with memento');
$orm->undo();
writeIn($orm->find());

writeIn('remove entity');
$orm->delete();
writeIn($orm->find());

writeIn('restore undo with memento');
$orm->undo();
writeIn($orm->find());

function writeIn(string $text)
{
    echo $text . PHP_EOL;
}
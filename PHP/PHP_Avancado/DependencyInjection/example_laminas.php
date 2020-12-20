<?php

require __DIR__ . '/vendor/autoload.php';

use Interop\Container\ContainerInterface;

use Laminas\ServiceManager\ServiceManager;
use Laminas\ServiceManager\Factory\InvokableFactory;
use Laminas\ServiceManager\Factory\FactoryInterface;


class TestAdapter
{
    public function __construct()
    {
        var_dump(TestAdapter::class.'::__construct');
    }

    public function runTest($message)
    {
        var_dump($message);
    }
}

class Tester
{
    public function __construct(TestAdapter $adapter)
    {
        $adapter->runTest("Rodou um teste");
    }
}


$serviceManager = new ServiceManager([
    'factories' => [
        stdClass::class => InvokableFactory::class
    ]
]);

$object = $serviceManager->get(stdClass::class);

var_dump($object);

//Mesmo efeito:

$serviceManager1 = new ServiceManager([
    'factories' => [
        'stdClass' => InvokableFactory::class
    ]
]);
$object1 = $serviceManager1->get('stdClass');

var_dump($object1);


//Com classe TestAdapater
$serviceManagerAdapter = new ServiceManager([
    'factories' => [
        'ta' => function (ContainerInterface $c) {
            return new TestAdapter;
        },
        'tester' => function(ContainerInterface $c) {
            return new Tester($c->get('ta'));
        }
    ]
]);


$object2 = $serviceManagerAdapter->get('tester');
$object2a = $serviceManagerAdapter->get('tester');
$object2b = $serviceManagerAdapter->build('tester'); //Para rodar instancia diferente

var_dump($object2, $object2a, $object2b);

//Exemplo com a classe TestAdapter, com classe ao invés de função anônima

class TesterFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        return new Tester($container->get('ta'));
    }
}

$serviceManagerAdapterClass = new ServiceManager([
    'factories' => [
        'ta' => function (ContainerInterface $c) {
            return new TestAdapter;
        },
        'tester' => TesterFactory::class
    ]
]);


$object3 = $serviceManagerAdapterClass->get('tester');

var_dump($object3);


$serviceManagerExp = new ServiceManager([
    'services' => [], //classes que trazem resultados de coisas mais elaboradas
    'factories' => [], //gera classes
    'abstract_factories' => [], //gera classe que segue determinados padrões
    'delegators' => [], //objetos em tempo de execução, adiciona outra responsabilidade ao objeto
    'shared' => [], //meu factory não traz uma nova estancia da classe
    'shared_by_default' => [] //meu factory não traz uma nova estancia da classe, e agora espalha para todas classes
]);





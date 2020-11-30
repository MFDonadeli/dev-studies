<?php

require __DIR__ . '/vendor/autoload.php';

use Pimple\Container;

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

$ioc = new Container;
$ioc['ta'] = function ($c) {
    return new TestAdapter;
};

$ioc['tester'] = function ($c) {
    return new Tester($c['ta']);
};

//Instancia a classe somente uma vez só
$tester = $ioc['tester'];
$tester2 = $ioc['tester'];
$tester3 = $ioc['tester'];

//Para instanciar a classe mais de uma vez
$iocnew = new Container;
$iocnew['ta'] = function ($c) {
    return new TestAdapter;
};

$iocnew['tester'] = $ioc->factory(function ($c) {
    return new Tester($c['ta']);
});

$testnew = $iocnew['tester'];
$testnew2 = $iocnew['tester'];

//Também da pra chamar usando closure
$ioc['multiplier'] = 10;
$ioc['sum'] = $ioc->protect(function ($a, $b) {
    return $a + $b;
});

echo $ioc['sum'](3, 4) * $ioc['multiplier'];
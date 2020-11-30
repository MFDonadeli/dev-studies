<?php

class After extends Handler
{
    protected function execute()
    {
        var_dump('depois');
    }
}

class Before extends Handler
{
    protected function execute()
    {
        var_dump('antes');
    }
}

abstract class Handler
{
    private $successor;

    protected abstract function execute();

    public function handlerRequest()
    {
        $this->execute();

        if ($this->successor) {
            $this->successor->handlerRequest();
        }
    }

    //opcional
    public function successor(Handler $successor)
    {
        $this->successor = $successor;
    }

    //minha implementação
    public function next()
    {
        return $this->successor;
    }
}

class Request extends Handler
{
    protected function execute()
    {
        var_dump('requisição');
    }
}

$before = new Before();
$request = new Request();
$after = new After();

$auth = new class extends Handler {
    protected function execute()
    {
        var_dump('autenticação');
    }
};

$auth->successor($before);
$before->successor($request);
$request->successor($after);

$auth->handlerRequest();
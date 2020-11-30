<?php

interface MediatorInterface
{
    public function sendResult($content);
    public function makeRequest();
    public function queryDb();
}

abstract class Colleague
{
    protected $mediator;

    public function setMediator(MediatorInterface $mediator)
    {
        $this->mediator = $mediator;
        return $this;
    }
}

class ClientColleague extends Colleague
{
    public function request()
    {
        $this->mediator->makeRequest();
    }

    public function output(string $context)
    {
        echo $context;
    }
}

class DatabaseColleague extends Colleague
{
    public function findData()
    {
        return 'World';
    }
}

class Mediator implements MediatorInterface
{
    public function __construct(ClientColleague $client, ServerColleague $server, DatabaseColleague $database)
    {
        $this->client = $client->setMediator($this);
        $this->server = $server->setMediator($this);
        $this->database = $database->setMediator($this);
    }

    public function sendResult($content)
    {
        $this->client->output($content);
    }

    public function makeRequest()
    {
        $this->server->process();
    }

    public function queryDb()
    {
        return $this->database->findData();
    }
}

class ServerColleague extends Colleague
{
    public function process()
    {
        $data = $this->mediator->queryDb();
        $this->mediator->sendResult("Hello " . $data);
    }
}


$client = new ClientColleague();
new Mediator($client, new ServerColleague(), new DatabaseColleague());

echo $client->request();
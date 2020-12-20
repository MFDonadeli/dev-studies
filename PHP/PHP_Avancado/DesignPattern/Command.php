<?php

interface Command
{
    public function execute();
}

class LampReceiver
{
    public function turnOn()
    {
        var_dump('Lamps on');
    }

    public function turnOff()
    {
        var_dump('Lamps off');
    }
}

class TurnOffCommand implements Command
{
    public function __construct(LampReceiver $receiver)
    {
        $this->receiver = $receiver;
    }

    public function execute()
    {
        $this->receiver->turnOff();
    }
}

class TurnOnCommand implements Command
{
    public function __construct(LampReceiver $receiver)
    {
        $this->receiver = $receiver;
    }

    public function execute()
    {
        $this->receiver->turnOn();
    }
}


function invoker(string $commandToExecute) {
    $commands = [
        TurnOnCommand::class,
        TurnOffCommand::class,
    ];

    $similar = 0;
    $finalCommand = null;
    foreach ($commands as $command) {
        similar_text($commandToExecute, $command, $percent);
        //var_dump($commandToExecute, $command, $percent);
        if ($percent > $similar and $percent > 20) {
            $similar = $percent;
            $finalCommand = $command;
        }
    }

    if (!$finalCommand) {
        throw new Exception("Command not found");
    }

    return (new $finalCommand(new LampReceiver))->execute();
}

if (empty($argv[1])) {
    throw new Exception("Command required");
}

//Cria objeto que encapsula ações e parametros. Uso: Command.php TurnOnCommand
try {
    invoker($argv[1]);
} catch (Exception $e) {
    echo $e->getMessage();
}
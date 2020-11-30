<?php

require __DIR__ . '/vendor/autoload.php';

use Log_Test\Logger\Logger;

$logger = new Logger(__DIR__ . '/logs');
$logger->log('info', 'Usuario {nome} acessou a aplicação', array("nome" => "eu"));


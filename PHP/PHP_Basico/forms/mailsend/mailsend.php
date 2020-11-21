<?php
    echo "<pre>";
    $nome = filter_input(INPUT_POST, 'nome');
    $email = filter_input(INPUT_POST, 'email');
    $descricao = filter_input(INPUT_POST, 'body');

    var_dump('--FORM DATA--', $nome, $email, $descricao);

    $json = file_get_contents("php://input");
    $json = json_decode($json, true);

    var_dump('--JSON--', $json);
    echo "</pre>";
?>
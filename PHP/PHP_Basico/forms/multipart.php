<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    echo "<pre>";
    echo '$_POST' . "<br>";
    var_dump($_POST);
    echo '$_FILES' . "<br>";
    var_dump($_FILES);
    

    echo 'Filtering' . "<br>";
    //If not email it returns false
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    var_dump($email);

    /**
     * isset => o campo existe?
     * empty => o campo está vazio?
     */

    if(isset($_POST['nome']))
        echo "Nome está definido" . "<br>";
      
    extract($_POST);

    echo 'After extract' . "<br>";
    var_dump($nome, $email);

    //Cria um array com essas variáveis
    $data = compact('nome', 'email', '_POST');

    echo 'After compact' . "<br>";
    var_dump($data);
    echo "</pre>";

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="multipart.php" method="post" enctype="multipart/form-data">
        <label for="name">Nome:</label>
        <input type="text" name="nome"> <br>

        <label for="email">e-mail:</label>
        <input type="email" name="email"><br>

        <label for="color">Cor:</label>
        <input type="color" name="color"><br>

        <label for="date">Data:</label>
        <input type="date" name="date"><br>

        <label for="datetime">Data/Hora:</label>
        <input type="datetime" name="datetime"><br>

        <label for="file">Arquivo:</label>
        <input type="file" name="file"><br>

        <label for="number">Número</label>
        <input type="number" name="number"><br>

        <label for="valor1">Valor 1</label>
        <input type="radio" name="radio" value="valor 1" id="valor1">
        <label for="valor2">Valor 2</label>
        <input type="radio" name="radio" value="valor 2" id="valor2">
        <label for="valor3">Valor 3</label>
        <input type="radio" name="radio" value="valor 3" id="valor3">

        <br>

        <label for="praia">Praia</label>
        <input type="checkbox" name="checkbox[]" value="praia" id="praia">
        <label for="praia">Montanha</label>
        <input type="checkbox" name="checkbox[]" value="montanha" id="montanha">
        <input type="submit" value="enviar">
    </form>
</body>
</html>
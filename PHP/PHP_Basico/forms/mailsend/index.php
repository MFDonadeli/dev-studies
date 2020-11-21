<?php 
    session_start();
    $_SESSION['csrf_token'] = rand(10000, 20000);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=600px, initial-scale=1.0">
    <title>Mail Send</title>
</head>
<body>
    <form action="mailsend.php" method="post">
        <p><label for="nome">Nome</label>
        <input type="text" name="nome" id="nome"></p>

        <p><label for="email">email</label>
        <input type="email" name="email" id="email"></p>

        <p><label for="body">Mensagem</label>
        <textarea name="body" id="body" cols="30" rows="10"></textarea></p>

        <input type="submit" value="Enviar">
    </form>   
</body>
</html>

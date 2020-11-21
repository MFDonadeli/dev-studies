<?php

require(__DIR__ . '/session.php');

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $_SESSION['user'] = [
        'email' => $_POST['email']
    ];
    header('location: index.php');
}

?>

<h1>Login</h1>

<form action="" method="post">
    <input type="email" name="email" id="email">
    <input type="submit" value="Login">
</form>
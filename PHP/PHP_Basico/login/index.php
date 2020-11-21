<?php

require(__DIR__ . '/session.php');

$user = $_SESSION['user'] ?? null;

if($user === null) {
    header('location: login.php');
    exit;
}
else {
    echo "<h1>Página desprotegida</h1>";
    exit;
}

?>

<h1>Página protegida</h1>
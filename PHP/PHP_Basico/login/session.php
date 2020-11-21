<?php
//Tem que chamar antes do session_start
//(tempo de expiração em segundos, qual pagina vai acessar, qual dominio (null meu dominio) , https?, only http?)
session_set_cookie_params(60, '/', null, false, false);

session_start();
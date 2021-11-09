<?php

//connexio a la base de dades
require_once __DIR__.'/../model/model_connectDB.php';
$connexio=connectDB();
require_once __DIR__.'/../controlador/controlador_PaginaLogin.php';

require_once __DIR__.'/../vista/vista_cabecera.php';
require_once __DIR__.'/../vista/vista_EnviarLogin.php';

$username=$_POST['usernameLogin'];
$password=$_POST['passwordLogin'];

var_dump($username);
var_dump($password);

//DUDA RAUL
//ENLAZAR $USERNAME Y PASSWORD CON LAS FUNCIONES DE LOS TEST
CheckUserEmpty($username,$password);
CheckSizeUserPass($username,$password);
CheckUsername($username);
CheckUsernamePassword($username,$password);




?>
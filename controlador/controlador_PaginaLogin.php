<?php

//connexio a la base de dades
require_once __DIR__.'/../model/model_connectDB.php';
$connexio=connectDB();
require_once __DIR__.'/../vista/vista_cabecera.php';
require_once __DIR__.'/../vista/vista_PaginaLogin.php';

class Usuario {
    var $user;
    var $password;

    function __construct($user,$password){
        $this->user=$user;
        $this->password=$password;
    }
}
?>
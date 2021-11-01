<?php

//connexio a la base de dades
require_once __DIR__.'/../model/model_connectDB.php';
$connexio=connectDB();
require_once __DIR__.'/../vista/vista_cabecera.php';
require_once __DIR__.'/../vista/vista_PaginaLogin.php';

class Usuario {
    public $user;
    private $password;

    function __construct($user,$password){
        $this->user=$user;
        $this->password=$password;
    }

    function getUser(){
        return $this->user;
    }

    function getPassword(){
        return $this->password;
    }

    function changePassword($oldPassword,$newPassword){
        if($this->password==$oldPassword){
            $this->password=$newPassword;
        }
    }
    

}

$usuario=new Usuario('raul','123'); //en la sesion[USER]
if(isset($usuario)){
    echo $usuario->getUser();

}

function checkUser($username,$password){

    
}


?>
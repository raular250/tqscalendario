<?php

//connexio a la base de dades
require_once __DIR__.'/../model/model_connectDB.php';
require_once __DIR__.'/../model/model_paginaLogin.php';
$connexio=connectDB();



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
// COOKIES // SESSIONES
// $usuario=new Usuario('raul','123'); //en la sesion[USER]
// if(isset($usuario)){
//     echo $usuario->getUser();
// }

function CheckUsername($username){    
    $users=getUserBDMock();
    
    if(array_key_exists($username,($users))){
        var_dump("El username introducido SÍ existe. ");
        return True;
    }
    else{
        var_dump("El username introducido NO existe. ");
        return False;
    }

    // if(in_array($username, key($users))){ //encuentra el $username introducido en la lista de usernames que ya existen en el MockObject
    //     echo("El username introducido sí existe. ");
    //     return True;
    // }
    // else{
    //     echo("El username introducido no existe. ");
    //     return False;
    // }

}

function CheckUsernamePassword($username,$password){
    $passwordsBDMock=getPasswordUserBDMock();
    if(CheckUsername($username)){
        $users=getUserBDMock();
        if($password == $passwordsBDMock){
            echo("Login con contraseña maestra correcto. ");
            return True;
        }
        else if($password==$users[$username]){
            echo("Login con usuario contraseña correcto. ");
            return True;
        }
        else{
            echo("Username correcto, password incorrecto. ");
            return False; //username correcto, password incorrecto
        }
    }
    else{
        echo("Username incorrecto.");
        return False; //username incorrecto
        }
}   
    


function CheckUserEmpty($username,$password){

    if($username=='' || $password ==''){
        if($username=='' && $password ==''){
            echo("Los 2 campos están vacíos. ");
            return False; //los 2 campos vacíos
        }
        else if($username==''){
            echo("El campo username está vacío. ");
            return False; //username vacío
        }
        else if($password==''){
            echo("El campo password está vacío. ");
            return False; //password vacío
        }
    }
    else{
        echo("Los campos no están vacíos. ");
        return True; //campos llenos
    }

}

function CheckSizeUserPass($username,$password){
    if(strlen($username)>=4 && strlen($username)<=20){
        if(strlen($password)>=6 && strlen($password)<=20){
            echo("Tamaños de Login correctos. ");
            return True; //login con tamaños correctos
        }
    }
    else{
        echo("Tamaños de Login incorrecto");
        echo("<--USERNAME--> Tamaño mínimo 4. Tamaño máximo 20. ");
        echo("<--PASSWORD--> Tamaño mínimo 6. Tamaño máximo 20. ");
        return False; //login con tamaños incorrectos
    }



function insertNewUser($username,$password){
    //cómo hago la estructura de $users
    //es decir, a qué atributo de qué classe le meto un usuario nuevo
    //tengo que hacer una variable global que sea el dict() de de $users con llave y valor??

}

}


require_once __DIR__.'/../vista/vista_cabecera.php';
require_once __DIR__.'/../vista/vista_PaginaLogin.php';


?>
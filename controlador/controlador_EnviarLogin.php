<?php

//connexio a la base de dades
require_once __DIR__.'/../model/model_connectDB.php';

$connexio=connectDB();
// require __DIR__.'/../controlador/controlador_PaginaLogin.php';


$username=$_POST['usernameLogin'];
$password=$_POST['passwordLogin'];
// echo("USERNAME");
// var_dump($username);
// echo("PASSWORD");
// var_dump($password);
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

function CheckUsername($username){    
    $users=getUserBDMock();
    
    if(array_key_exists($username,($users))){
        ?> <div class="mensajesCorrectosLogin"> El username introducido SÍ existe. </div> <?php
        // echo("El username introducido SÍ existe. ");?> <br> <?php
        return True;
    }
    else{
        ?> <div class="mensajesIncorrectosLogin"> El username introducido NO existe. </div> <?php
        // echo("El username introducido NO existe. ");?> <br> <?php
        return False; 
    }

}

function CheckUsernamePassword($username,$password){
    $passwordsBDMock=getPasswordALFABDMock();
    if(CheckUsername($username)){
        $users=getUserBDMock();
        if($password == $passwordsBDMock){
            ?> <div class="mensajesCorrectosLogin"> Login con contraseña maestra correcto. </div> <?php
            // echo("Login con contraseña maestra correcto. ");?> <br> <?php
            $_SESSION['username']=$username;
            $_SESSION['loged']=TRUE;
            return True;
        }
        else if($password==$users[$username]){
            ?> <div class="mensajesCorrectosLogin"> Login con usuario contraseña correcto.  </div> <?php
            // echo("Login con usuario contraseña correcto. ");?> <br> <?php
            $_SESSION['username']=$username;
            $_SESSION['loged']=TRUE;            
            return True;
            
        }
        else{
        ?> <div class="mensajesIncorrectosLogin"> Username correcto, password incorrecto. </div> <?php
            // echo("Username correcto, password incorrecto. ");?> <br> <?php
            $_SESSION['loged']=FALSE;
            return False; //username correcto, password incorrecto
        }
    }
    else{
        ?> <div class="mensajesIncorrectosLogin"> Username incorrecto. </div> <?php
        // echo("Username incorrecto.");?> <br> <?php
        $_SESSION['loged']=FALSE;
        return False; //username incorrecto
        }
}   
    
function CheckUserEmpty($username,$password){

    if($username=='' || $password ==''){
        if($username=='' && $password ==''){
        ?> <div class="mensajesIncorrectosLogin"> Los 2 campos están vacíos. </div> <?php
            // echo("Los 2 campos están vacíos. ");?> <br> <?php
            return False; //los 2 campos vacíos
        }
        else if($username==''){
        ?> <div class="mensajesIncorrectosLogin"> El campo username está vacío. </div> <?php
            // echo("El campo username está vacío. ");?> <br> <?php
            return False; //username vacío
        }
        else if($password==''){
        ?> <div class="mensajesIncorrectosLogin"> El campo password está vacío. </div> <?php
            // echo("El campo password está vacío. ");?> <br> <?php
            return False; //password vacío
        }
    }
    else{
        ?> <div class="mensajesCorrectosLogin"> Los campos no están vacíos. </div> <?php
        // echo("Los campos no están vacíos. ");?> <br> <?php
        return True; //campos llenos
    }
}

function CheckSizeUserPass($username,$password){

    if(strlen($username)>=4 && strlen($username)<=20){
        if(strlen($password)>=6 && strlen($password)<=20){
        ?> <div class="mensajesCorrectosLogin"> Tamaños de Login correctos. </div> <?php
            // echo("Tamaños de Login correctos. ");?> <br> <?php
            return True; //login con tamaños correctos
        }
        else{
            if(strlen($password)<6){
            ?>  <div class="mensajesIncorrectosLogin"> Password introducido con pocos carácteres </div> <?php
                // echo("Password introducido con pocos carácteres");
                // echo("<--PASSWORD--> Tamaño mínimo 6. Tamaño máximo 20. ");?> <br> <?php
            }
            else{
            ?>  <div class="mensajesIncorrectosLogin"> Password introducido con demasiados carácteres </div> <?php
                // echo("Password introducido con demasiados carácteres");
                // echo("<--PASSWORD--> Tamaño mínimo 6. Tamaño máximo 20. ");?> <br> <?php
            }
            ?> <div class="mensajeInfoLogin"> <--PASSWORD--> Tamaño mínimo 6. Tamaño máximo 20. </div> <?php
            return False;
        }
    }
    else{
        echo("Tamaños de Login incorrecto");
        if(strlen($username)<4){
            ?> <div class="mensajesIncorrectosLogin"> Username introducido con pocos carácteres </div>
            <div class="mensajeInfoLogin"> <--USERNAME--> Tamaño mínimo 4. Tamaño máximo 20. </div> <?php
            // echo("Username introducido con pocos carácteres");
            // echo("<--USERNAME--> Tamaño mínimo 4. Tamaño máximo 20. ");?> <br> <?php
        }
        else{
            ?> <div class="mensajesIncorrectosLogin"> Username introducido con demasiados carácteres </div>
            <div class="mensajeInfoLogin"> <--USERNAME--> Tamaño mínimo 4. Tamaño máximo 20. </div> <?php
            // echo("Username introducido con demasiados carácteres");
            // echo("<--USERNAME--> Tamaño mínimo 4. Tamaño máximo 20. ");?> <br> <?php
        }
        
        if(strlen($password)<6){
            ?> <div class="mensajesIncorrectosLogin"> Password introducido con pocos carácteres </div>
            <div class="mensajeInfoLogin"> <--PASSWORD--> Tamaño mínimo 6. Tamaño máximo 20. </div> <?php
            // echo("Password introducido con pocos carácteres");
            // echo("<--PASSWORD--> Tamaño mínimo 6. Tamaño máximo 20. ");?> <br> <?php
        }
        else{
            ?> <div class="mensajesIncorrectosLogin"> Password introducido con demasiados carácteres </div>
            <div class="mensajeInfoLogin"> <--PASSWORD--> Tamaño mínimo 6. Tamaño máximo 20. </div> <?php
            // echo("Password introducido con demasiados carácteres");
            // echo("<--PASSWORD--> Tamaño mínimo 6. Tamaño máximo 20. ");?> <br> <?php
        }

        return False; //login con tamaños incorrectos
    }

}


//ENLAZAR $USERNAME Y PASSWORD CON LAS FUNCIONES DE LOS TEST
CheckUserEmpty($username,$password);
CheckSizeUserPass($username,$password);

var_dump("ANTEaaaS", $_SESSION['loged']);?> <br> <?php 
$_SESSION['loged']=CheckUsernamePassword($username,$password);
// var_dump("NOMBRE USUARIO",$username);


var_dump("DESPUaaaES", $_SESSION['loged']);?> <br> <?php 


require __DIR__.'/../vista/vista_cabecera.php'; //no se actualiza el header no sé por qué //HEADER ABAJO
require __DIR__.'/../vista/vista_EnviarLogin.php';





?>
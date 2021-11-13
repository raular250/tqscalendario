<?php

//connexio a la base de dades
require_once __DIR__.'/../model/model_connectDB.php';
require_once __DIR__.'/../model/model_getUserID.php';
require_once __DIR__.'/../model/model_getUsers.php';



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

//Comprueba si un usuario existe en la base de datos
function CheckUsername($username){   
    $connexio=connectDB();
    $users=getUsers($connexio);
    $contador=0;
    $encontrado=false;
    global $mensaje;
    foreach($users as $usernameBD){
        if($usernameBD[1]==$username){
            array_push($mensaje,"<div class='mensajesCorrectosLogin'> El username introducido SÍ existe. </div>");
            return True;
        }
    }
    array_push($mensaje,"<div class='mensajesIncorrectosLogin'> El username introducido NO existe. </div>");
    return False;
}



function CheckUsernameMock($username){
    $users=getUserBDMock();
    global $mensaje;
    if(array_key_exists($username,($users))){
        array_push($mensaje,"<div class='mensajesCorrectosLogin'> El username introducido SÍ existe. </div>");
        return True;
    }
    else{
        array_push($mensaje,"<div class='mensajesIncorrectosLogin'> El username introducido NO existe. </div>");
        return False; 
    }
}


//Comprueba si el usuario y password introducido existe
function CheckUsernamePassword($username,$password){ 
    global $mensaje;
    $passwordsBDMock=getPasswordALFABDMock();
    if(CheckUsername($username)){
        $users=getUserBDMock();
        if($password == $passwordsBDMock){ //login con contraseña maestra
            array_push($mensaje,"<div class='mensajesCorrectosLogin'> Login con contraseña maestra correcto. </div>");
            $connexio=connectDB();
            $_SESSION['userId'] = getUserID($connexio,$username);
            $_SESSION['username']=$username;
            $_SESSION['loged']=TRUE;
            return True;
        }
        else if($password==$users[$username]){ //login con usuario contraseña correcto
            array_push($mensaje,"<div class='mensajesCorrectosLogin'> Login con usuario contraseña correcto. </div>");
            $connexio=connectDB();
            $_SESSION['userId'] = getUserID($connexio,$username);
            $_SESSION['username']=$username;
            $_SESSION['loged']=TRUE;
            return True; 
        }
        else{ //username correcto, password incorrecto
            array_push($mensaje,"<div class='mensajesIncorrectosLogin'> Username correcto, password incorrecto. </div>");
            unset($_SESSION['username']);
            $_SESSION['loged']=FALSE;
            return False; 
        }
    }
    else{ //username incorrecto
        array_push($mensaje,"<div class='mensajesIncorrectosLogin'> Username incorrecto. </div>");
        unset($_SESSION['username']);
        $_SESSION['loged']=FALSE;
        return False; 
        }
}   

//Comprueba que los campos del login no estén vacíos
function CheckUserEmpty($username,$password){ 
    global $mensaje;
    if($username=='' || $password ==''){
        if($username=='' && $password ==''){
            (isset($mensaje)?:$mensaje=array());
            array_push($mensaje,"<div class='mensajesIncorrectosLogin'> Los 2 campos están vacíos. </div>");
            return False; //los 2 campos vacíos
        }
        else if($username==''){
            array_push($mensaje,"<div class='mensajesIncorrectosLogin'> El campo username está vacío. </div>");
            return False; //username vacío
        }
        else if($password==''){
            array_push($mensaje,"<div class='mensajesIncorrectosLogin'> El campo password está vacío. </div>");
            return False; //password vacío
        }
    }
    else{
        array_push($mensaje,"<div class='mensajesCorrectosLogin'> Los campos no están vacíos. </div>");
        return True; //campos llenos
    }
}

//Comprueba la longitud de los valores introducidos en los campos username y password
function CheckSizeUserPass($username,$password){
    global $mensaje;
    if(strlen($username)>=4 && strlen($username)<=20){ //username con tamaño correcto? si/no
        if(strlen($password)>=6 && strlen($password)<=20){ //si, comprobamos tamaño de la contraseña
            array_push($mensaje,"<div class='mensajesCorrectosLogin'> Tamaños de Login correctos. </div>");
            return True; //correcto, campos username y password con tamaños correctos
        }
        else{
            if(strlen($password)<6){ //incorrecto, password tiene menos de 4 carácteres
            array_push($mensaje,"<div class='mensajesIncorrectosLogin'> Password introducido con menos de 6 carácteres. </div>");
            }
            else{ //incorrecto, password tiene más de 20 carácteres
            array_push($mensaje,"<div class='mensajesIncorrectosLogin'> Password introducido con más de 6 carácteres. </div>");
            }
            array_push($mensaje,"<div class='mensajeInfoLogin'> <--PASSWORD--> Tamaño mínimo 6. Tamaño máximo 20. </div>");
            return False;
        }
    }
    else{ //no, username con tamaño incorrectos
        echo("Tamaños de Login incorrecto");
        if(strlen($username)<4){
            if(strlen($password)<6){ //username y password con pocos carácteres
                array_push($mensaje,"<div class='mensajesIncorrectosLogin'> Username introducido con menos de 4 carácteres. </div>");
                array_push($mensaje,"<div class='mensajesIncorrectosLogin'> Password introducido con menos de 6 carácteres. </div>");
            }
            else{//username con pocos carácteres y password con muchos
                array_push($mensaje,"<div class='mensajesIncorrectosLogin'> Username introducido con menos de 4 carácteres. </div>");
                array_push($mensaje,"<div class='mensajesIncorrectosLogin'> Password introducido con más de 20 carácteres. </div>");
            }
            array_push($mensaje,"<div class='mensajeInfoLogin'> <--USERNAME--> Tamaño mínimo 4. Tamaño máximo 20. </div>");
            array_push($mensaje,"<div class='mensajeInfoLogin'> PASSWORD--> Tamaño mínimo 6. Tamaño máximo 20. </div>");
        } 
        else{
            if(strlen($password)<6){ //username con muchos carácteres y password con pocos
                array_push($mensaje,"<div class='mensajesIncorrectosLogin'> Username introducido con más de 20 carácteres. </div>");
                array_push($mensaje,"<div class='mensajesIncorrectosLogin'> Password introducido con menos de 6 carácteres. </div>");
            }               
            else{ //username y password con muchos carácteres
                array_push($mensaje,"<div class='mensajesIncorrectosLogin'> Username introducido con más de 20 carácteres. </div>");
                array_push($mensaje,"<div class='mensajesIncorrectosLogin'> Password introducido con más de 20 carácteres. </div>");
            }
            array_push($mensaje,"<div class='mensajesIncorrectosLogin'> Username introducido con más de 20 carácteres. </div>");
            array_push($mensaje,"<div class='mensajeInfoLogin'> <--USERNAME--> Tamaño mínimo 4. Tamaño máximo 20. </div>");
        }
        

        return False; //login con tamaños incorrectos
    }

}

$mensaje=array();

$connexio=connectDB();
require_once __DIR__.'/../model/model_paginaLogin.php';

if(isset($_POST['submit'])){
    $username=$_POST['usernameLogin'];
    $password=$_POST['passwordLogin'];

    
    CheckUserEmpty($username,$password);
    CheckSizeUserPass($username,$password);

    $_SESSION['loged']=CheckUsernamePassword($username,$password);
   
}
require __DIR__.'/../vista/vista_cabecera.php';
require __DIR__.'/../vista/vista_EnviarLogin.php';


?>
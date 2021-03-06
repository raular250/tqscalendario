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

//Comprueba si el nombre de usuario existe en el Mock Object
function CheckUsernameMock($username){
    $users=getUsersMockObject();
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

//Comprueba si el nombre de usuario existe en la base de datos
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



//Comprueba si el usuario y password introducido existe en el MockObject
function CheckUsernamePasswordMockObject($username,$password){ 
    if(!isset($_SESSION))$_SESSION=array();
    global $mensaje;
    $passwordsBDMock=getPasswordMaestraMockObject();
    if(CheckUsername($username)){
        $users=getUsersMockObject();
        if($password == $passwordsBDMock){ //login con password maestra
            array_push($mensaje,"<div class='mensajesCorrectosLogin'> Login con contraseña maestra correcto. </div>");
            $connexio=connectDB();
            $_SESSION['userId'] = getUserID($connexio,$username);
            $_SESSION['username']=$username;
            $_SESSION['loged']=TRUE;
            return True;
        }
        else if($password==$users[$username]){ //login con usuario password correcto
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


//Comprueba si el usuario y password introducido existe en la base de datos
function CheckUsernamePassword($username,$password){ 
    if(!isset($_SESSION))$_SESSION=array();
    global $mensaje;

    $passwordsBDMock=getPasswordMaestraMockObject();
    if(CheckUsername($username)){
        $connexio=connectDB();
        $users=getUsers($connexio);
        foreach($users as $usernameBD){ //busca la contraseña del username insertado
            if($usernameBD[1]==$username){
                $passwordUsuario=$usernameBD[2];
            }
        }

        if($password == $passwordsBDMock){ //login con contraseña maestra
            array_push($mensaje,"<div class='mensajesCorrectosLogin'> Login con contraseña maestra correcto. </div>");
            $connexio=connectDB();
            $_SESSION['userId'] = getUserID($connexio,$username);
            $_SESSION['username']=$username;
            $_SESSION['loged']=TRUE;
            return True;
        }
        else if($password==$passwordUsuario){ //login con usuario y contraseña correcto
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
    }
    return True; //campos llenos
}

//Comprueba la longitud de los valores introducidos en los campos username y password
function CheckSizeUserPass($username,$password){
    global $mensaje;
    if(strlen($username)>=4 && strlen($username)<=20){ //username con tamaño correcto? si/no
        array_push($mensaje,"<div class='mensajesCorrectosLogin'> Username introducido con longitud correcta. </div>");
        if(strlen($password)>=6 && strlen($password)<=20){ //si, comprobamos tamaño de la contraseña
            array_push($mensaje,"<div class='mensajesCorrectosLogin'> Tamaños de Login correctos. </div>");
            return True; //correcto, campos username y password con tamaños correctos
        }
        else{
            if(strlen($password)<6){ //password tiene menos de 4 carácteres
                array_push($mensaje,"<div class='mensajesIncorrectosLogin'> Password introducido con menos de 6 carácteres. </div>");
            }
            else{ //password tiene más de 20 carácteres
                array_push($mensaje,"<div class='mensajesIncorrectosLogin'> Password introducido con más de 20 carácteres. </div>");
            }
            array_push($mensaje,"<div class='mensajeInfoLogin'> <--PASSWORD--> Tamaño mínimo 6. Tamaño máximo 20. </div>");
            return False;
        }
    }
    else{ //no, username con tamaño incorrecto
        if(strlen($username)<4){ //username con pocos carácteres
            if(strlen($password)<6){ //password con pocos carácteres
                array_push($mensaje,"<div class='mensajesIncorrectosLogin'> Username introducido con menos de 4 carácteres. </div>");
                array_push($mensaje,"<div class='mensajesIncorrectosLogin'> Password introducido con menos de 6 carácteres. </div>");
            }
            else if(strlen($password)>20){ //y password con muchos carácteres
                array_push($mensaje,"<div class='mensajesIncorrectosLogin'> Username introducido con menos de 4 carácteres. </div>");
                array_push($mensaje,"<div class='mensajesIncorrectosLogin'> Password introducido con más de 20 carácteres. </div>");
            }
            else{ //password con tamaño correcto
                array_push($mensaje,"<div class='mensajesIncorrectosLogin'> Username introducido con menos de 4 carácteres. </div>");
                array_push($mensaje,"<div class='mensajesCorrectosLogin'> Password introducido con longitud correcta. </div>");
            }
            array_push($mensaje,"<div class='mensajeInfoLogin'> <--USERNAME--> Tamaño mínimo 4. Tamaño máximo 20. </div>");
            array_push($mensaje,"<div class='mensajeInfoLogin'> PASSWORD--> Tamaño mínimo 6. Tamaño máximo 20. </div>");
        } 
        else{ //username con muchos carácteres
            if(strlen($password)<6){ //password con pocos carácteres
                array_push($mensaje,"<div class='mensajesIncorrectosLogin'> Username introducido con más de 20 carácteres. </div>");
                array_push($mensaje,"<div class='mensajesIncorrectosLogin'> Password introducido con menos de 6 carácteres. </div>");
            }               
            else if(strlen($password)>20){ //password con muchos carácteres
                array_push($mensaje,"<div class='mensajesIncorrectosLogin'> Username introducido con más de 20 carácteres. </div>");
                array_push($mensaje,"<div class='mensajesIncorrectosLogin'> Password introducido con más de 20 carácteres. </div>");
            }
            else{ //password con tamaño correcto
                array_push($mensaje,"<div class='mensajesIncorrectosLogin'> Username introducido con más de 20 carácteres. </div>");
                array_push($mensaje,"<div class='mensajesCorrectosLogin'> Password introducido con longitud correcta. </div>");
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
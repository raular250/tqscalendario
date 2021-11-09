<?php
require_once __DIR__ .'/../controlador/controlador_PaginaLogin.php';

function getUserBD($connexio,$username){ //En la base de datos
    try{
        $consultaUser=$connexio->prepare("SELECT user FROM usuarios WHERE user = '$username' ");
        $consultaUser->execute();
        $resultatUser=$consultaUser->fetchAll(PDO::FETCH_ASSOC);

        return $resultatUser;
    }catch (PDOException $e){
        echo "ERROR: " . $e->getMessage();
    }
    $connexio=null;

}



function getUserBDMock(){
   //[llave,valor] de usuarios creados
//    $users= array(
//         'prueba1'  => 'PRUEBA1',
//         'prueba11'  => 'PRUEBA11',
//         'prueba22'  => 'PRUEBA22',
//         'prueba33'  => 'PRUEBA33',
//     ); 
    $users=[
        'prueba1'  => 'PRUEBA1',
        'prueba11'  => 'PRUEBA11',
        'prueba22'  => 'PRUEBA22',
        'prueba33'  => 'PRUEBA33',
    ];

    var_dump("USUARIOS", $users);
    return $users;
}

function getPasswordUserBDMock(){ //le pasamos le usuario para ver su contraseña, hay que hacerlo dinámico con un diccionario
    //devuelve la contraseña del usuario
    $password='llaveMaestra';
    return $password;
}


?>
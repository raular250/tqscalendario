<?php


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

    $users=[
        'Macananero2'  => '442445',
        'Frutesino5'  => 'bosque',
        'Maria'  => '123_456',
        'alejoHugo'  => '093284',
        'legendary'  => 'tekashi',
        'killshot122'  => 'scarce',
    ];

    // var_dump("USUARIOS", $users); //ver array de usuarios
    return $users;
}

function getPasswordALFABDMock(){ //le pasamos le usuario para ver su contraseña, hay que hacerlo dinámico con un diccionario
    //devuelve la contraseña del usuario
    $password='llaveMaestra';
    return $password;
}


?>
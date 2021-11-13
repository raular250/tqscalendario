<?php


//Mock Object creado para testear el login antes de tener la BBDD
function getUsersMockObject(){
   //[llave,valor] de usuarios creados
    $users=[
        'Macananero2'  => '442445',
        'Frutesino5'  => 'bosque',
        'Maria'  => '123_456',
        'alejoHugo'  => '093284',
        'legendary'  => 'tekashi',
        'killshot122'  => 'scarce',
    ];
    return $users;
}

//Devuelve la password maestra creada por nosotros
function getPasswordMaestraMockObject(){ 
    $password='llaveMaestra';
    return $password;
}


// Obtiene los usuarios de la BBDD
function getUserBD($connexio,$username){ 
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

?>
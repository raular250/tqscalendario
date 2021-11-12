<?php //obté el identificador amb la restricció que el mail sigui = al que es passa per paràmetre
function getUserID($connexio,$username){
    try{
        $consulta_id=$connexio->prepare("SELECT id FROM usuarios WHERE user = '".$username."'");
        $consulta_id->execute();
        $resultSet = $consulta_id->get_result();
        $resultat_id=$resultSet->fetch_all();

        return $resultat_id;
    }catch (PDOException $e){
        echo "ERROR: " . $e->getMessage();
    }
    $connexio=null;

}

?>
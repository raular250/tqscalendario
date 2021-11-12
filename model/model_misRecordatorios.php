<?php 
function getMisRecordatorios($connexio,$userID){
    try{
        $consultaRecordatorios=$connexio->prepare("SELECT * FROM recordatorios where user_id='$userID' ");
        $consultaRecordatorios->execute();
        $resultSet = $consultaRecordatorios->get_result();
        $resultat_id=$resultSet->fetch_all();

        return $resultat_id;
    }catch (PDOException $e){
        echo "ERROR: " . $e->getMessage();
    }
    $connexio=null;

}

?>
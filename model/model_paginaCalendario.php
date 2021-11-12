<?php 
function getRecordatoriosBD($connexio,$user_id){
    try{
        $consulta=$connexio->prepare("SELECT * FROM recordatorios where user_id='$user_id' ");
        $consulta->execute();
        $resultSet = $consulta->get_result();
        $resultat_id=$resultSet->fetch_all();

        return $resultat_id;
    }catch (PDOException $e){
        echo "ERROR: " . $e->getMessage();
    }
    $connexio=null;

}

?>
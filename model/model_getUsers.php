<?php 
function getUsers($connexio){
    try{
        $consulta=$connexio->prepare("SELECT * FROM usuarios ");
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
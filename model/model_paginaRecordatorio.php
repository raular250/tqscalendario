<?php 
function insertRecordatoriosBDmodel($connexio,$titulo,$inicio,$fin,$freq,$anterioridad,$descripcion,$user_id){
    try{
        $consulta_id=$connexio->prepare("INSERT INTO recordatorios (titulo,inicio,fin,frequencia,anterioridad,descripcion,user_id) VALUES ('$titulo','$inicio','$fin','$freq','$anterioridad','$descripcion','$user_id')");
        $consulta_id->execute();
        if($error=$consulta_id->error !=""){
            echo $error;
            return false;
        }
        echo "Recordatorio insertado!";
        return true;
    }catch (PDOException $e){
        echo "ERROR: " . $e->getMessage();
        return false;
    }
    $connexio=null;

}

?>
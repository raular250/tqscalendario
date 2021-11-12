<?php

//connexio a la base de dades
require_once __DIR__.'/../model/model_connectDB.php';
require_once __DIR__.'/../model/model_paginaCalendario.php';
$connexio=connectDB();
require_once __DIR__.'/../vista/vista_cabecera.php';

function getRecordatoriosMock($user_id){
    if($user_id==1){
        $recordatorios= array(
            '2021-02-26 10:30' => [['titulo1', 'desc1'], ['titulo2', 'desc2']] ,
            '2021-05-13 08:55' => [['titulo', 'desc']],
            '2021-07-01 23:55' => [['titulo3', 'desc3'], ['titulo4', 'desc4']] ,
            '2021-02-26 11:30' => [['titulo5', 'desc5']],
        );
        ksort($recordatorios);
    }else{
        $recordatorios=array();
    }
    return $recordatorios;
}
function nextRec($ini,$fin,$freq,$ant,$date){
    $nextRec="";
    return $nextRec;
}
function getRecordatorios($user_id,$connexio){
    $recordatorios=getRecordatoriosBD($connexio,$user_id);
    foreach($recordatorios as $r){
        $titulo=$r[1];
        $ini=$r[2];
        $fin=$r[3];
        $freq=$r[4];
        $ant=$r[5];
        $desc=$r[6];
        var_dump(date("Y-m-d H:i"));
        $nextRec=nextRec($ini,$fin,$freq,$ant,$date);
    }
    return $recordatorios;
}
$user_id=(isset($_SESSION['userId'])?$_SESSION['userId']:-1);
$recordatorios=getRecordatorios($user_id,$connexio);



require_once __DIR__.'/../vista/vista_PaginaCalendario.php';

?>
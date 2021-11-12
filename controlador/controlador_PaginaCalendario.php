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
function minusAnt($nextRec,$ant){
    //Restar a nextRec la anterioridad de $ant;
    return $nextRec;
}
function nextRec($ini,$fin,$freq,$ant,$date){
    switch($freq){//1D,2D,3D..,1M,2M,3M...,1A,2A,3A...,once,daily,L-V",annually
        case "once":
            if($ini<$date){
                $nextRec=false;
            }else{
                minusAnt($nextRec,$ant);
                $nextRec=date('Y-m-d H:i', strtotime($ini. ' - 5 days'));
            }
            break;
        case "daily":
            break;
        case "L-V":
            break;
        case "annually":
            break;
    }
    $nextRec=date('Y-m-d H:i', strtotime($date. ' + 5 days'));
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
        $date=date("Y-m-d H:i");
        $nextRec=nextRec($ini,$fin,$freq,$ant,$date);
    }
    $recordatorios=array();
    return $recordatorios;
}
$user_id=(isset($_SESSION['userId'])?$_SESSION['userId']:-1);
$recordatorios=getRecordatorios($user_id,$connexio);


require_once __DIR__.'/../vista/vista_PaginaCalendario.php';

?>
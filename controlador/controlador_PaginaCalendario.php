<?php

//connexio a la base de dades
require_once __DIR__.'/../model/model_connectDB.php';
$connexio=connectDB();

require_once __DIR__.'/../vista/vista_cabecera.php';


function getRecordatorios($user_id){
    //Devolverá un listado de recordatorios
}

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
$recordatorios=getRecordatoriosMock(1);



require_once __DIR__.'/../vista/vista_PaginaCalendario.php';

?>
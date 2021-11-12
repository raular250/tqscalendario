<?php

require_once __DIR__.'/../model/model_connectDB.php';
require_once __DIR__. '/../model/model_misRecordatorios.php';

$connexio=connectDB();

$misRecordatorios=getMisRecordatorios($connexio,$_SESSION['userId']);

require __DIR__.'/../vista/vista_cabecera.php';
require_once __DIR__.'/../vista/vista_paginaMisRecordatorios.php';



?>
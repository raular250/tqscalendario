<?php

$_SESSION['loged']=FALSE;
session_destroy (); //Al tancar la sessió s'elimina
session_start();
unset($_SESSION['loged']); 
$_SESSION['loged']=FALSE;

require __DIR__.'/../vista/vista_cabecera.php';
require_once __DIR__.'/../vista/vista_paginaLogout.php';



?>
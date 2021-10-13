
<meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="css/style.css">

<?php

$accio = $_GET['accio'] ?? null; 

switch($accio) {
    
    case 'paginaPrincipal':
        require __DIR__ . '/recurso_PaginaInicio.php';
        break;

    case 'paginaCalendario':
        require __DIR__ . '/recurso_PaginaCalendario.php';
        break;

    case 'paginaRecordatorio':
        require __DIR__ . '/recurso_PaginaRecordatorio.php';
        break;

    case 'paginaLogin':
        require __DIR__ . '/recurso_PaginaLogin.php';
        break;





    default:
        require_once __DIR__ . '/recurso_PaginaInicio.php';
        break;




}


?>
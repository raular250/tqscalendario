<?php session_start(); ?>
<meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="css/style.css">

<?php


// unset($_SESSION['loged']); 
$accio = $_GET['accio'] ?? null;

switch($accio) {
    
    case 'paginaPrincipal':
        require __DIR__ . '/recurso_PaginaInicio.php';
        break;

    case 'paginaCalendario':        
        if((isset($_SESSION['loged']) && $_SESSION['loged']==TRUE)){
            require __DIR__ . '/recurso_PaginaCalendario.php';
        }
        else {
            require __DIR__ . '/recurso_errorNoLoged.php';
        }
        break;

    case 'paginaRecordatorio':
        if((isset($_SESSION['loged']) && $_SESSION['loged']==TRUE)){
            require __DIR__ . '/recurso_PaginaRecordatorio.php';
        }
        else {
            require __DIR__ . '/recurso_errorNoLoged.php';
        }
        break;

    case 'paginaLogin':
        if((isset($_SESSION['loged']) && $_SESSION['loged']==FALSE)){
            require __DIR__ . '/recurso_PaginaLogin.php';
        }
        else {
            require __DIR__ . '/recurso_errorNoLoged.php';
        }
        break;

    case 'enviarLogin':
        if((isset($_SESSION['loged']) && $_SESSION['loged']==FALSE)){
            require __DIR__ . '/recurso_EnviarLogin.php';
        }
        else {
            require __DIR__ . '/recurso_errorNoLoged.php';
        }
        break;
        
    case 'paginaLogout':
        if((isset($_SESSION['loged']) && $_SESSION['loged']==TRUE)){
            require __DIR__ . '/recurso_paginaLogout.php';
        }
        else {
            require __DIR__ . '/recurso_errorNoLoged.php';
        }
        break;

    case 'crearRecordatorio':
        if((isset($_SESSION['loged']) && $_SESSION['loged']==TRUE)){
            require __DIR__ . '/recurso_PaginaRecordatorio.php';
        }
        else {
            require __DIR__ . '/recurso_errorNoLoged.php';
        }
        break;

    case 'paginaMisRecordatorios':
        if((isset($_SESSION['loged']) && $_SESSION['loged']==TRUE)){
            require __DIR__ . '/recurso_paginaMisRecordatorios.php';
        }
        else {
            require __DIR__ . '/recurso_errorNoLoged.php';
        }
        break;


    default:
        require_once __DIR__ . '/recurso_PaginaInicio.php';
        break;




}


?>
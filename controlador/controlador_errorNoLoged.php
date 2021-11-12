<?php
require_once __DIR__.'/../vista/vista_cabecera.php';
echo "<br>";

if(isset($_SESSION['loged'])){
    if($_SESSION['loged']==TRUE){
        $usuarioLogeado=True;
    }else{
        $usuarioLogeado=False;
    }
}

require_once __DIR__.'/../vista/vista_errorNoLoged.php';

?>
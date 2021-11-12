
<body class="center">

<?php


if($usuarioLogeado){ ?>
    <h2 class="errorLoged"> Ya estás logeado. </h2>
<?php }else{ ?>
    <h2 class="errorLoged"> No estás logeado </h2>
    <h2> Porfavor, inicie sesión </h2>
    <a class="volver" href="/tqscalendario/index.php?accio=paginaLogin"> Iniciar sesión</a>
<?php } ?>

</body>
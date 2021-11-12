<body class="center">


    <h2>CALENDARIO</h2>
    <br>
<?php
$contador=0;
        foreach(array_keys($recordatorios) as $key){ 
            $contador=$contador+1; ?>
            <h3>Recordatorio número <?php echo ($contador) ?>
            <div class="fechaCalendario"> FECHA: <?php print_r($key); ?> </div> <br> <?php

        foreach(array_values($recordatorios[$key]) as $valor ){ ?>
            <div class="tituloCalendario"> Título: <?php print_r($valor[0]); ?> </div> <br> 
            <div class="descripcionCalendario"> Descripción: <?php print_r($valor[1]); ?> </div> <br> <?php
            echo "<br>";
        }
        echo "<br>";echo "<br>";
    }
?>

</body>
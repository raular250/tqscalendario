<body class="center">

    <h2>MIS RECORDATORIOS </h2>
    <table class="recordatorios">
    <tr>
        <th>titulo</th>
        <th>fecha inicio</th>
        <th>fecha final</th>
        <th>frequencia</th>
        <th>anterioridad</th>
        <th>descripción</th>
    </tr>
    <?php

    foreach(array_keys($misRecordatorios) as $k){
        echo "<tr>";
        foreach(array_keys($misRecordatorios[$k]) as $v){
            if($v >=1 and $v<=5)
                echo '<td>'.$misRecordatorios[$k][$v]."</td> \n";
            if($v==6)
                echo "<td class='descriptionCol'>".$misRecordatorios[$k][$v]."</td> \n";
            
        }
        echo "</tr> \n\n";
    }
    ?>

    </table>
</body>
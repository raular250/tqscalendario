<body class="center">

    <h2>MIS RECORDATORIOS </h2>
    <table class="recordatorios">
    <tr class="descriptionTr">
        <th class="descriptionTh">titulo</th>
        <th class="descriptionTh">fecha inicio</th>
        <th class="descriptionTh">fecha final</th>
        <th class="descriptionTh">frequencia</th>
        <th class="descriptionTh">anterioridad</th>
        <th class="descriptionTh">descripción</th>
    </tr>
    <?php

    foreach(array_keys($misRecordatorios) as $k){
        echo "<tr class='descriptionTr'>";
        foreach(array_keys($misRecordatorios[$k]) as $v){
            if($v >=1 and $v<=5)
                echo '<td class="descriptionTd">'.$misRecordatorios[$k][$v]."</td> \n";
            if($v==6)
                echo "<td class='descriptionCol'>".$misRecordatorios[$k][$v]."</td> \n";
            
        }
        echo "</tr> \n\n";
    }
    ?>

    </table>
</body>
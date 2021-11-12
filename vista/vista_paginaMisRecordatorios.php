<body class="center">

    <h2>MIS RECORDATORIOS </h2>

    <?php

    foreach(array_keys($misRecordatorios) as $k){
        foreach(array_keys($misRecordatorios[$k]) as $v){
            echo($misRecordatorios[$k][$v]);
            
        }
    echo "<br>";echo "<br>";
    }
    ?>


</body>
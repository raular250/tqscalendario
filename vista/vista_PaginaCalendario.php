<body class="center">


    <h2>CALENDARIO</h2>
    <br>
    <table class='calendario'>
        <?php
            foreach(array_keys($recordatorios) as $key){
            ?>
            <tr>
                <th><?php print_r($key) ?></th>
                <th></th>
                <th></th>
                <th></th>
            </tr>
                <?php foreach(array_values($recordatorios[$key]) as $valor ){ ?>
                    <tr>
                        <th></th>
                        <th><?php print_r($valor[0]);?>
                        =>
                        <?php print_r($valor[1]);?></th>
                    </tr>
                <?php } ?>


                <tr>
                    <th><br></th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>

            <?php
            }
        ?>
    </table>
</body>
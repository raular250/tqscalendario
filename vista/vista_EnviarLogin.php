

<body class="center">


    <?php if(isset($_SESSION['loged']) && $_SESSION['loged']==TRUE){ ?>

        <h2> Bienvenid@ <?php print_r($_SESSION['username']) ?>, has iniciado sesión correctamente.</h2> <br>

    <?php
    }
    else{ ?>
        
        <h2>No se ha podido iniciar sesión correctamente</h2>

    <?php } ?>

    <?php
        foreach($mensaje as $m){
            echo $m;
        }
    ?>



</body>
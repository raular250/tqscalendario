

<body class="center">

    <?php if($_SESSION['loged']==TRUE){ ?>

            <h2>Has iniciado sesión correctamente</h2>
            
            <?php
                echo("Nombre de usuario→ ");
                echo($username);
            ?>
        

    <?php
    }
        else{ ?>
            <h2>No se ha podido iniciar sesión correctamente</h2>


    <?php } ?>





</body>
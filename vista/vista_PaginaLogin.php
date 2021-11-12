<!-- <body class="center">
    <section id="regisForm" class="textoForm cursorNormal center">

        <h2 class="titulo">INICIO SESIÓN</h2>

        <form class="formulario" method="post" target="_self" action="index.php?accio=enviarLogin">
            <a>Username: <input type="text" name="usernameLogin" minlength="4" maxlength="20" required><br /></a>
            <a>Password: <input type="password" name="passwordLogin" minlength="6" maxlength="20" required/><br /></a>
            
            <a><input type="reset" value="Borrar" style="margin-bottom: 5px;"></a>
            <a><input type="submit" value="Enviar"></a>
        </form>

    </section>

<body> -->



<body class="center">

    <h2>INICIO DE SESIÓN</h2>
    <br>

    <section id="regisForm" class="textoForm cursorNormal center">

        <form class="formulario" method="post" target="_self" action="index.php?accio=enviarLogin">
            <a>Username: <input type="text" name="usernameLogin" required><br /></a>
            <a>Password: <input type="password" name="passwordLogin" required/><br /></a>
            
            <a><input type="reset" value="Borrar" style="margin-bottom: 5px;"></a>
            <a><input type="submit" name="submit" value="Enviar"></a>
        </form>

    </section>

<body>
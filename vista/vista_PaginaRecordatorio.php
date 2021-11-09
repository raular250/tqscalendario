<body>


<div class="center">

    <h2 >Creación de un recordatorio:</h2>
    
    <form class="formulario" method="get" target="_self" action="index.php?accio=crear-recordatorio">
    <p>Título del recordatorio: <input type="text" name="titulo" required></p>
    <p>De: <input  type="datetime-local" name="inicio" required value="2020-01-01T00:00" min="2020-01-01T00:00" max="2999-12-31T23:59"></p>
    <p>A: <input type="datetime-local" name="fin" required value="2020-01-01T00:05" min="2020-01-01T00:00" max="2999-12-31T23:59"></p>
    <p>Repetir: <select name="freq" onchange="repeticionPersonalizada(this);">
            <option selected>1 sola vez </option>
            <option>Diariamente</option>
            <option>(Lun-Vie)</option>
            <option>Cada año</option>
            <option value="other">Personalizado</option>
        </select>
        <select name="ant">
            <option selected>5 minutos antes </option>
            <option>1 hora antes</option>
            <option>1 día antes</option>
            <option>1 semana antes</option>
        </select>
        <div id="ifYes" style="display: none;">
            <p>Cada: <input type="number" name="rep" min="1" max="365" placeholder="1">
                <select name="freqRep">
                    <option>Días</option>
                    <option>Meses</option>
                    <option>Años</option>
                </select>
            </p>
        </div>
        <script type="text/javascript">
            function repeticionPersonalizada(that) {
                if (that.value == "other") {
                    document.getElementById("ifYes").style.display = "block";
                } else {
                    document.getElementById("ifYes").style.display = "none";
                }
            }
        </script>

    </p>
    <p>Descripción:
        <textarea name="descripcion" rows="4" cols="50">
        </textarea>
    </p>
    <p>
        <input type="submit" value="Crear recordatorio">
        <input type="reset" value="Borrar">
    </p>
    </form>

</div>




</body>

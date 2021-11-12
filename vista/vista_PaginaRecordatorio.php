<body class="center">


<div>

    <h2 >Creación de un recordatorio:</h2>
    
    <form class="formulario" method="post" target="_self" action="index.php?accio=crearRecordatorio">
    <p>Título del recordatorio: <input type="text" name="titulo" required></p>
    <p>De: <input  type="datetime-local" name="inicio" required value="2020-01-01T00:00" min="2020-01-01T00:00" max="2999-12-31T23:59"></p>
    <p>A: <input type="datetime-local" name="fin" required value="2020-01-01T00:05" min="2020-01-01T00:00" max="2999-12-31T23:59"></p>
    <p>Repetir: <select name="freq" onchange="repeticionPersonalizada(this);">
            <option selected value="once">1 sola vez </option>
            <option value="daily">Diariamente</option>
            <option value="L-V">(Lun-Vie)</option>
            <option value="annually">Cada año</option>
            <option value="other">Personalizado</option>
        </select>
        <select name="ant">
            <option selected value="5m">5 minutos antes </option>
            <option value="1h">1 hora antes</option>
            <option value="1d">1 día antes</option>
            <option value="1s">1 semana antes</option>
        </select>
        <div id="ifYes" style="display: none;">
            <p>Cada: <input type="number" name="rep" min="1" max="365" placeholder="1">
                <select name="freqRep">
                    <option value='D'>Días</option>
                    <option value='M'>Meses</option>
                    <option value='A'>Años</option>
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
    <p>Descripción:</p><p>
        <textarea name="descripcion" rows="4" cols="50"></textarea>
    </p>
    <p>
        <input type="submit" name="submitRecordatorio" value="Crear recordatorio">
        <input type="reset" value="Borrar">
    </p>
    </form>

</div>




</body>

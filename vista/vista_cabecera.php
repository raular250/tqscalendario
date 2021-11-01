<h1> CABECERA WEB</h1>



<header id="cabecera">
    <!--
    <table>
        <tr>
        <td><strong><img class="tam_icon" onclick="iconChange(this)" src="/assets/img/icons/portada.png"><div> Inicio </div></strong></td>
        <td><strong><img class="tam_icon" onclick="iconChange(this)" src="/assets/img/icons/calendario.png"><div> Calendario </div></strong></td>
        <td><strong><img class="tam_icon" onclick="iconChange(this)" src="/assets/img/icons/recordatorio.png"><div> Recordatorio </div></strong></td>
        <td><strong><img class="tam_icon" onclick="iconChange(this)" src="/assets/img/icons/login.png"><div> Login </div></strong></td>  
        </tr>
    </table>
    -->

    <div class="icons_header">
    <ul class="nav">
        <li class="icon_inicio"><img src="./assets/img/icons/portada.png"> <a href="/tqscalendario/index.php?accio=paginaPrincipal"> Inicio </a></li>
        <li class="icon_calendario"><img src="./assets/img/icons/calendario.png"> <a href="/tqscalendario/index.php?accio=paginaCalendario"> Calendario </a></li>
        <li class="icon_recordatorio"><img src="./assets/img/icons/recordatorio.png"> 
            <a href="/tqscalendario/index.php?accio=paginaRecordatorio">Recordatorios</a>
            <ul>
                <li><a href="/tqscalendario/index.php?accio=paginaCrearRecordatorio">Crear recordatorio</a></li>
                <li><a href="/tqscalendario/index.php?accio=paginaVerRecordatorios">Mis recordatorios</a></li>
            </ul>
        </li>
        <li class="icon_login"><img src="./assets/img/icons/login.png"><a  href="/tqscalendario/index.php?accio=paginaLogin"> Login </a></li>
    </ul>
    </div>
</br>
</br>
</br>
</header>
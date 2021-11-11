
<h1 class="center"> WEB RECORDATORIOS TQS</h1>

<header id="cabecera">
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

        
        <?php if((isset($_SESSION['loged']) && $_SESSION['loged']==TRUE)){ ?>
            <li class="icon_login"><img src="./assets/img/icons/login.png">
                <a href="/tqscalendario/index.php?accio=paginaPrincipal"> <?php echo($_SESSION['username']); ?></a>
                <ul>
                    <li><a href="/tqscalendario/index.php?accio=paginaLogout">Logout</a></li>
                </ul>                 
            </li>           
        <?php }
        else { ?>
            <li class="icon_login"><img src="./assets/img/icons/login.png">
                <a  href="/tqscalendario/index.php?accio=paginaLogin"> Login </a>
            </li>
        <?php } 
   
        ?> 
                          
        
    </ul>
    </div>
</br>
</br>
</br>
</br>
</br>
</br>
</header>

<?php

//connexio a la base de dades
require_once __DIR__.'/../model/model_connectDB.php';
$connexio=connectDB();

require_once __DIR__.'/../vista/vista_cabecera.php';

require_once __DIR__.'/../vista/vista_PaginaRecordatorio.php';

class Recordatorio{
    public $titulo;
    public $inicio;
    public $fin;
    public $repeticion;
    public $anterioridad;
    public $descripcion;

    function __construct($titulo,$inicio,$fin,$repetiticion,$anterioridad,$descripcion=null){
        $this->titulo=$titulo;
        $this->inicio=$inicio;
        $this->fin=$fin;
        $this->repeticion=$repeticion;
        $this->anterioridad=$anterioridad;
        $this->descripcion=$descripcion;
    }
    function nextRecordatorio($dateNow){
        //Devuelve la fecha del siguiente recordatorio
    }
}

//get values and construct a Recordatorio
//show values
?>
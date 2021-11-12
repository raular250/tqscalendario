<?php

//connexio a la base de dades
require_once __DIR__.'/../model/model_connectDB.php';
require_once __DIR__.'/../model/model_paginaRecordatorio.php';

$connexio=connectDB();
require __DIR__.'/../vista/vista_cabecera.php';

require_once __DIR__.'/../vista/vista_PaginaRecordatorio.php';

class Recordatorio{
    public $titulo;
    public $inicio;
    public $fin;
    public $repeticion;
    public $anterioridad;
    public $descripcion;

    function __construct($titulo,$inicio,$fin,$repeticion,$anterioridad,$descripcion){
        $this->titulo=$titulo;
        $this->inicio=$inicio;
        $this->fin=$fin;
        $this->repeticion=$repeticion;
        $this->anterioridad=$anterioridad;
        $this->descripcion=$descripcion;
    }
}

//get values and construct a Recordatorio
function creaRecordatorio($titulo,$inicio,$fin,$freq,$anterioridad,$rep,$freqRep,$descripcion){
    $titulo=$titulo;
    //inicio
    $tmp=explode('T',$inicio);
    $inicio=$tmp[0];
    $inicio=$inicio.' '.$tmp[1];
    //fin
    $tmp=explode('T',$fin);
    $fin=$tmp[0];
    $fin=$fin.' '.$tmp[1];
    //freq
    if($freq!='other'){
        $freq=$freq;
    }else{
        if($rep=="") $rep=1;
        $freq=$rep.$freqRep;
    }
    $anterioridad=$anterioridad;
    $descripcion=$descripcion;
    $recordatorio=new Recordatorio($titulo,$inicio,$fin,$freq,$anterioridad,$descripcion);
    return $recordatorio;
}

function insertRecordatorioBD($recordatorio,$user_id,$connexio){
    $titulo=$recordatorio->titulo;
    $inicio=$recordatorio->inicio;
    $fin=$recordatorio->fin;
    $freq=$recordatorio->repeticion;
    $anterioridad=$recordatorio->anterioridad;
    $descripcion=$recordatorio->descripcion;
    return insertRecordatoriosBDmodel($connexio,$titulo,$inicio,$fin,$freq,$anterioridad,$descripcion,$user_id);
}
if(isset($_POST['submitRecordatorio'])){
    $titulo = $_POST['titulo'];
    $inicio = $_POST['inicio'];
    $fin = $_POST['fin'];
    $freq = $_POST['freq'];
    $anterioridad = $_POST['ant'];
    $rep = $_POST['rep'];
    $freqRep = $_POST['freqRep'];
    $descripcion = $_POST['descripcion'];

    $recordatorio=creaRecordatorio($titulo,$inicio,$fin,$freq,$anterioridad,$rep,$freqRep,$descripcion);
    insertRecordatorioBD($recordatorio,$_SESSION['userId'],$connexio);
}


?>
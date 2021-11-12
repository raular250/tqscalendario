<?php

//connexio a la base de dades
require_once __DIR__.'/../model/model_connectDB.php';
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
    function nextRecordatorio($dateNow){
        //Devuelve la fecha del siguiente recordatorio
    }
}

//get values and construct a Recordatorio
function creaRecordatorio($titulo,$inicio,$fin,$freq,$anterioridad,$rep,$freqRep,$descripcion){
    $titulo=$titulo;
    //inicio
    $tmp=explode('T',$inicio);
    $inicio=$tmp[0];
    $tmp=explode('%3A',$tmp[1]);
    $hora=$tmp[0];
    $min=$tmp[1];
    $inicio=$inicio.' '.$hora.'-'.$min;
    //fin
    $tmp=explode('T',$fin);
    $fin=$tmp[0];
    $tmp=explode('%3A',$tmp[1]);
    $hora=$tmp[0];
    $min=$tmp[1];
    $fin=$fin.' '.$hora.'-'.$min;
    //freq
    if($freq!='other'){
        $freq=$freq;
    }else{
        $freq=$rep.$freqRep;
    }
    $anterioridad=$anterioridad;
    $descripcion=$descripcion;
    $recordatorio=new Recordatorio($titulo,$inicio,$fin,$freq,$anterioridad,$descripcion);
    return $recordatorio;
}
//show values
?>
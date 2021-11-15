<?php

//connexio a la base de dades
require_once __DIR__.'/../model/model_connectDB.php';
require_once __DIR__.'/../model/model_paginaRecordatorio.php';

$connexio=connectDB();
require __DIR__.'/../vista/vista_cabecera.php';


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

function ComprobarCampos($titulo,$inicio,$fin,$freq,$anterioridad,$rep,$freqRep,$descripcion){
    if(strlen($titulo)>=1 && strlen($titulo)<=100 && $titulo!=''){
    }else{
        return False;
    }
    
    if(ctype_digit($inicio[0]) && ctype_digit($inicio[1]) && ctype_digit($inicio[2]) && ctype_digit($inicio[3]) && 
        $inicio[4]=='-' && ctype_digit($inicio[5]) && ctype_digit($inicio[6]) && $inicio[7]=='-' && ctype_digit($inicio[8]) && 
        ctype_digit($inicio[9]) && $inicio[10]=='T' && ctype_digit($inicio[11]) && ctype_digit($inicio[12]) &&
         $inicio[13]==':' && ctype_digit($inicio[14]) && ctype_digit($inicio[15]) && (bool)strtotime($inicio))
    {
    }else{
        return False;
    }

    if(ctype_digit($fin[0]) && ctype_digit($fin[1]) && ctype_digit($fin[2]) && ctype_digit($fin[3]) && 
        $fin[4]=='-' && ctype_digit($fin[5]) && ctype_digit($fin[6]) && $fin[7]=='-' && ctype_digit($fin[8]) && 
        ctype_digit($fin[9]) && $fin[10]=='T' && ctype_digit($fin[11]) && ctype_digit($fin[12]) &&
         $fin[13]==':' && ctype_digit($fin[14]) && ctype_digit($fin[15]) && (bool)strtotime($fin))
    {
    }else{
        return False;
    }
    if($freq == 'once' || $freq == 'daily' || $freq == 'L-V' || $freq == 'annually' || $freq== 'other' ){
    }else{
        return False;
    }
    if($anterioridad == '5m' || $anterioridad == '1h' || $anterioridad == '1d' || $anterioridad == '1s' ){
    }else{
        return False;
    }
    if($rep='false' || $rep='' || (ctype_digit($rep) && $rep>=1 && $rep<=365)){
    }else{
        var_dump($rep);
        return False;
    }
    if($freqRep == 'D' || $freqRep == 'M' || $freqRep == 'A' ){
    }else{
        return False;
    }
    if(strlen($descripcion)>=0 && strlen($descripcion)<=200){
    }else{
        return False;
    }

    return True;
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

    if(ComprobarCampos($titulo,$inicio,$fin,$freq,$anterioridad,$rep,$freqRep,$descripcion)){
        $recordatorio=creaRecordatorio($titulo,$inicio,$fin,$freq,$anterioridad,$rep,$freqRep,$descripcion);
        $result=insertRecordatorioBD($recordatorio,$_SESSION['userId'],$connexio);
    }
    else{
        $result=[false,'Hay datos introducidos incorrectos'];
    }
    
}

require_once __DIR__.'/../vista/vista_PaginaRecordatorio.php';

if(isset($result)){
    if($result[0]==false){
        echo "No se ha podido crear el recordatorio. <br>";
        echo $result[1];
    }else{
        echo "recordatorio creado!";
    }
}

?>
<?php



$folders=explode("\\", __DIR__);
$directorio="";
foreach(array_slice($folders, 0, -2) as $folder){
    $directorio.=$folder.'/';
}

require_once $directorio.'/controlador/controlador_PaginaCalendario.php';      //deberiamos usar __DIR__.'../\controlador\controlador_PaginaInicio.php'; pero no me funciona lo de subir 2 directorios con ..
require_once $directorio.'/model/model_connectDB.php';      //deberiamos usar __DIR__.'../model/model_connectDB.php'; pero no me funciona lo de subir 2 directorios con ..

class CalendarioTest extends PHPUnit\Framework\TestCase{

    public function testGetRecordatoriosMock0(){
        $rec=getRecordatoriosMock(0);
        $this->assertEquals($rec,array());
    }
    public function testGetRecordatoriosMock1(){
        $rec=getRecordatoriosMock(1);
        $rec_manual=array(
            '2021-02-26 10:30' => [['titulo1', 'desc1'], ['titulo2', 'desc2']] ,
            '2021-05-13 08:55' => [['titulo', 'desc']],
            '2021-07-01 23:55' => [['titulo3', 'desc3'], ['titulo4', 'desc4']] ,
            '2021-02-26 11:30' => [['titulo5', 'desc5']],
        );
        $this->assertEquals($rec,$rec_manual);
    }
    public function testGetRecordatoriosMock9999(){
        $rec=getRecordatoriosMock(9999);
        $this->assertEquals($rec,array());
    }
    public function testGetRecordatoriosMock_1(){
        $rec=getRecordatoriosMock(-1);
        $this->assertEquals($rec,array());
    }
    public function testNextRec1(){
        $ini="2020-01-01 10:00";
        $fin="2022-01-01 10:00";
        $freq="1D";       //1D,2D,3D..,1M,2M,3M...,1A,2A,3A...,once,daily,L-V",annually
        $ant="5m";        //5m,1h,1d,1s
        $date="2021-11-12 22:26";
        $nextRec=nextRec($ini,$fin,$freq,$ant,$date);
        $this->assertEquals("2021-11-13 09:55",$nextRec);
    }
}


?>
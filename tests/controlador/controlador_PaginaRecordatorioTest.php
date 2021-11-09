<?php
$folders=explode("\\", __DIR__);
$directorio="";
foreach(array_slice($folders, 0, -2) as $folder){
    $directorio.=$folder.'/';
}

require_once $directorio.'/controlador/controlador_PaginaRecordatorio.php';      //deberiamos usar __DIR__.'../\controlador\controlador_PaginaInicio.php'; pero no me funciona lo de subir 2 directorios con ..

class RecordatorioTest extends PHPUnit\Framework\TestCase{
    //funcion setUp para recordatorio
    //titulo=ghj
    //inicio=2020-01-01T00%3A00
    //fin=2020-01-01T00%3A05
    //freq=other            //Personalizada
    //ant=5+minutos+antes
    //rep=
    //freqRep=D%C3%ADas
    //descripcion=fghfdhdfgh
    //rep=&freqRep=D%C3%ADas&descripcion=++++++++
    //freq=other&ant=5+minutos+antes&rep=11&freqRep=D%C3%ADas&descripcion=++++++++
    //freq=1+sola+vez&ant=5+minutos+antes&rep=&freqRep=D%C3%ADas&descripcion=++++++++
    public function testRecordatorio1(){
        $rec=new Recordatorio("titulo","2020-01-01T00%3A00","2020-01-01T00%3A05",5,"dia");
        $this->assertEquals('titulo',$rec->titulo);
        $this->assertEquals("10-10-2010-00:00",$rec->inicio);
        $this->assertEquals("10-10-2010-00:00",$rec->fin);
        $this->assertEquals(5,$rec->repetiticion);
        $this->assertEquals('dia',$rec->anterioridad);
        $this->assertEquals(null,$rec->descripcion);
    }
    public function testRecordatorio2(){
        $rec=new Recordatorio("titulo","10-10-2010-00:00","10-10-2010-00:00",5,"dia","desc");
        $this->assertEquals('titulo',$rec->titulo);
        $this->assertEquals("10-10-2010-00:00",$rec->inicio);
        $this->assertEquals("10-10-2010-00:00",$rec->fin);
        $this->assertEquals(5,$rec->repetiticion);
        $this->assertEquals('dia',$rec->anterioridad);
        $this->assertEquals("desc",$rec->descripcion);
    }
    public function TestnextRecordatorio1(){
        //$recordatorio1=("titulo","05-11-2021-15:00","10-10-2022-00:00",5,"dia")
        $next_rec=$recordatorio1->nextRecordatorio("02-11-2021 11:11");
        $this->assertEquals("05-11-2021 14:55",$next_rec);
    }
    public function TestnextRecordatorio2(){
        //$recordatorio1=("titulo","05-11-2021-15:00","10-10-2022-00:00",5,"dia")
        $next_rec=$recordatorio1->nextRecordatorio("02-11-2021 11:11");
        $this->assertEquals("05-11-2021 14:55",$next_rec);
    }
}
?>
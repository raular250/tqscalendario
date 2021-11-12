<?php



$folders=explode("\\", __DIR__);
$directorio="";
foreach(array_slice($folders, 0, -2) as $folder){
    $directorio.=$folder.'/';
}

require_once $directorio.'/controlador/controlador_PaginaRecordatorio.php';      //deberiamos usar __DIR__.'../\controlador\controlador_PaginaInicio.php'; pero no me funciona lo de subir 2 directorios con ..

class RecordatorioTest extends PHPUnit\Framework\TestCase{

    public function testCreaRecordatorioTitulo(){
        $titulo="titulo";
        $inicio="2020-01-01T00%3A00";
        $fin="2020-01-01T00%3A05";
        $freq="once";
        $anterioridad="5m";
        $rep="";
        $freqRep="D";
        $descripcion="++++++++";
        $rec=creaRecordatorio($titulo,$inicio,$fin,$freq,$anterioridad,$rep,$freqRep,$descripcion);
        $this->assertEquals('titulo',$rec->titulo);
    }
    public function testCreaRecordatorioInicio(){
        $titulo="titulo";
        $inicio="2020-01-01T00%3A00";
        $fin="2020-01-01T00%3A05";
        $freq="once";
        $anterioridad="5m";
        $rep="";
        $freqRep="D";
        $descripcion="++++++++";
        $rec=creaRecordatorio($titulo,$inicio,$fin,$freq,$anterioridad,$rep,$freqRep,$descripcion);
        $this->assertEquals("2020-01-01 00:00",$rec->inicio);
    }
    public function testCreaRecordatorioFin(){
        $titulo="titulo";
        $inicio="2020-01-01T00%3A00";
        $fin="2020-01-01T00%3A05";
        $freq="once";
        $anterioridad="5m";
        $rep="";
        $freqRep="D";
        $descripcion="++++++++";
        $rec=creaRecordatorio($titulo,$inicio,$fin,$freq,$anterioridad,$rep,$freqRep,$descripcion);
        $this->assertEquals("2020-01-01 00:05",$rec->fin);
    }
    public function testCreaRecordatorioFrequency(){
        $titulo="titulo";
        $inicio="2020-01-01T00%3A00";
        $fin="2020-01-01T00%3A05";
        $freq="once";
        $anterioridad="5m";
        $rep="";
        $freqRep="D";
        $descripcion="++++++++";
        $rec=creaRecordatorio($titulo,$inicio,$fin,$freq,$anterioridad,$rep,$freqRep,$descripcion);
        $this->assertEquals("once",$frec->repeticion);
    }
    public function testCreaRecordatorioAnterioridad(){
        $titulo="titulo";
        $inicio="2020-01-01T00%3A00";
        $fin="2020-01-01T00%3A05";
        $freq="once";
        $anterioridad="5m";
        $rep="";
        $freqRep="D";
        $descripcion="++++++++";
        $rec=creaRecordatorio($titulo,$inicio,$fin,$freq,$anterioridad,$rep,$freqRep,$descripcion);
        $this->assertEquals('5m',$rec->anterioridad);
    }
    public function testCreaRecordatorioDescription(){
        $titulo="titulo";
        $inicio="2020-01-01T00%3A00";
        $fin="2020-01-01T00%3A05";
        $freq="once";
        $anterioridad="5m";
        $rep="";
        $freqRep="D";
        $descripcion="patata";
        $rec=creaRecordatorio($titulo,$inicio,$fin,$freq,$anterioridad,$rep,$freqRep,$descripcion);
        $this->assertEquals("patata",$rec->descripcion);
    }
    public function testCreaRecordatorioFreq1(){
        $titulo="titulo";
        $inicio="2020-01-01T00%3A00";
        $fin="2020-01-01T00%3A05";
        $freq="once";
        $anterioridad="5m";
        $rep="";
        $freqRep="D";
        $descripcion="++++++++";
        $rec=creaRecordatorio($titulo,$inicio,$fin,$freq,$anterioridad,$rep,$freqRep,$descripcion);
        $this->assertEquals("once",$rec->repeticion);
    }
    public function testCreaRecordatorioFreq2(){
        $titulo="titulo";
        $inicio="2020-01-01T00%3A00";
        $fin="2020-01-01T00%3A05";
        $freq="daily";
        $anterioridad="1h";
        $rep="";
        $freqRep="D";
        $descripcion="++++++++";
        $rec=creaRecordatorio($titulo,$inicio,$fin,$freq,$anterioridad,$rep,$freqRep,$descripcion);
        $this->assertEquals("daily",$rec->repeticion);
    }
    public function testCreaRecordatorioFreq3(){
        $titulo="titulo";
        $inicio="2020-01-01T00%3A00";
        $fin="2020-01-01T00%3A05";
        $freq="L-V";
        $anterioridad="1d";
        $rep="";
        $freqRep="D";
        $descripcion="++++++++";
        $rec=creaRecordatorio($titulo,$inicio,$fin,$freq,$anterioridad,$rep,$freqRep,$descripcion);
        $this->assertEquals("L-V",$rec->repeticion);
    }
    public function testCreaRecordatorioFreq4(){
        $titulo="titulo";
        $inicio="2020-01-01T00%3A00";
        $fin="2020-01-01T00%3A05";
        $freq="annually";
        $anterioridad="1s";
        $rep="";
        $freqRep="D";
        $descripcion="++++++++";
        $rec=creaRecordatorio($titulo,$inicio,$fin,$freq,$anterioridad,$rep,$freqRep,$descripcion);
        $this->assertEquals("annually",$rec->repeticion);
    }
    public function testCreaRecordatoriRep1(){
        $titulo="titulo";
        $inicio="2020-01-01T00%3A00";
        $fin="2020-01-01T00%3A05";
        $freq="other";
        $anterioridad="1s";
        $rep="";
        $freqRep="D";
        $descripcion="++++++++";
        $rec=creaRecordatorio($titulo,$inicio,$fin,$freq,$anterioridad,$rep,$freqRep,$descripcion);
        $this->assertEquals('1s',$rec->anterioridad);
    }
    public function testCreaRecordatoriRep2(){
        $titulo="titulo";
        $inicio="2020-01-01T00%3A00";
        $fin="2020-01-01T00%3A05";
        $freq="other";
        $anterioridad="1s";
        $rep="1";
        $freqRep="D";
        $descripcion="++++++++";
        $rec=creaRecordatorio($titulo,$inicio,$fin,$freq,$anterioridad,$rep,$freqRep,$descripcion);
        $this->assertEquals('titulo',$rec->titulo);
        $this->assertEquals("2020-01-01 00:00",$rec->inicio);
        $this->assertEquals("2020-01-01 00:05",$rec->fin);
        $this->assertEquals("1",$rec->repetiticion);
        $this->assertEquals('1s',$rec->anterioridad);
        $this->assertEquals("",$rec->descripcion);
    }
    public function testCreaRecordatoriRep3(){
        $titulo="titulo";
        $inicio="2020-01-01T00%3A00";
        $fin="2020-01-01T00%3A05";
        $freq="other";
        $anterioridad="1s";
        $rep="5";
        $freqRep="M";
        $descripcion="++++++++";
        $rec=creaRecordatorio($titulo,$inicio,$fin,$freq,$anterioridad,$rep,$freqRep,$descripcion);
        $this->assertEquals('titulo',$rec->titulo);
        $this->assertEquals("2020-01-01 00:00",$rec->inicio);
        $this->assertEquals("2020-01-01 00:05",$rec->fin);
        $this->assertEquals("1",$rec->repetiticion);
        $this->assertEquals('1s',$rec->anterioridad);
        $this->assertEquals("",$rec->descripcion);
    }
    public function testCreaRecordatoriRep4(){
        $titulo="titulo";
        $inicio="2020-01-01T00%3A00";
        $fin="2020-01-01T00%3A05";
        $freq="other";
        $anterioridad="1s";
        $rep="2";
        $freqRep="A";
        $descripcion="++++++++";
        $rec=creaRecordatorio($titulo,$inicio,$fin,$freq,$anterioridad,$rep,$freqRep,$descripcion);
        
        $this->assertEquals('titulo',$rec->titulo);
        $this->assertEquals("2020-01-01 00:00",$rec->inicio);
        $this->assertEquals("2020-01-01 00:05",$rec->fin);
        $this->assertEquals("1",$rec->repetiticion);
        $this->assertEquals('1s',$rec->anterioridad);
        $this->assertEquals("",$rec->descripcion);
    }
    public function testCreaRecordatoriDescription(){
        $titulo="titulo";
        $inicio="2020-01-01T00%3A00";
        $fin="2020-01-01T00%3A05";
        $freq="other";
        $anterioridad="1s";
        $rep="2";
        $freqRep="A";
        $descripcion="Hola esto es una descripcion";
        $rec=creaRecordatorio($titulo,$inicio,$fin,$freq,$anterioridad,$rep,$freqRep,$descripcion);
        $this->assertEquals('titulo',$rec->titulo);
        $this->assertEquals("2020-01-01 00:00",$rec->inicio);
        $this->assertEquals("2020-01-01 00:05",$rec->fin);
        $this->assertEquals("1",$rec->repetiticion);
        $this->assertEquals('1s',$rec->anterioridad);
        $this->assertEquals("",$rec->descripcion);
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
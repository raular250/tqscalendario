<?php



$folders=explode("\\", __DIR__);
$directorio="";
foreach(array_slice($folders, 0, -2) as $folder){
    $directorio.=$folder.'/';
}

require_once $directorio.'/controlador/controlador_PaginaRecordatorio.php';      //deberiamos usar __DIR__.'../\controlador\controlador_PaginaInicio.php'; pero no me funciona lo de subir 2 directorios con ..
require_once $directorio.'/model/model_connectDB.php';      //deberiamos usar __DIR__.'../model/model_connectDB.php'; pero no me funciona lo de subir 2 directorios con ..
/*
* @covers Recordatorio::
*/
class RecordatorioTest extends PHPUnit\Framework\TestCase{
    /**
    * @covers CreaRecordatorio
    */
    public function testCreaRecordatorioTitulo(){
        $titulo="titulo";
        $inicio="2020-01-01T00:00";
        $fin="2020-01-01T00:05";
        $freq="once";
        $anterioridad="5m";
        $rep="";
        $freqRep="D";
        $descripcion="++++++++";
        $rec=creaRecordatorio($titulo,$inicio,$fin,$freq,$anterioridad,$rep,$freqRep,$descripcion);
        $this->assertEquals('titulo',$rec->titulo);
    }
    /**
    * @covers CreaRecordatorio
    */
    public function testCreaRecordatorioInicio(){
        $titulo="titulo";
        $inicio="2020-01-01T00:00";
        $fin="2020-01-01T00:05";
        $freq="once";
        $anterioridad="5m";
        $rep="";
        $freqRep="D";
        $descripcion="++++++++";
        $rec=creaRecordatorio($titulo,$inicio,$fin,$freq,$anterioridad,$rep,$freqRep,$descripcion);
        $this->assertEquals("2020-01-01 00:00",$rec->inicio);
    }
    /**
    * @covers CreaRecordatorio
    */
    public function testCreaRecordatorioFin(){
        $titulo="titulo";
        $inicio="2020-01-01T00:00";
        $fin="2020-01-01T00:05";
        $freq="once";
        $anterioridad="5m";
        $rep="";
        $freqRep="D";
        $descripcion="++++++++";
        $rec=creaRecordatorio($titulo,$inicio,$fin,$freq,$anterioridad,$rep,$freqRep,$descripcion);
        $this->assertEquals("2020-01-01 00:05",$rec->fin);
    }
    /**
    * @covers CreaRecordatorio
    */
    public function testCreaRecordatorioFrequency(){
        $titulo="titulo";
        $inicio="2020-01-01T00:00";
        $fin="2020-01-01T00:05";
        $freq="once";
        $anterioridad="5m";
        $rep="";
        $freqRep="D";
        $descripcion="++++++++";
        $rec=creaRecordatorio($titulo,$inicio,$fin,$freq,$anterioridad,$rep,$freqRep,$descripcion);
        $this->assertEquals("once",$rec->repeticion);
    }
    /**
    * @covers CreaRecordatorio
    */
    public function testCreaRecordatorioAnterioridad(){
        $titulo="titulo";
        $inicio="2020-01-01T00:00";
        $fin="2020-01-01T00:05";
        $freq="once";
        $anterioridad="5m";
        $rep="";
        $freqRep="D";
        $descripcion="++++++++";
        $rec=creaRecordatorio($titulo,$inicio,$fin,$freq,$anterioridad,$rep,$freqRep,$descripcion);
        $this->assertEquals('5m',$rec->anterioridad);
    }
    /**
    * @covers CreaRecordatorio
    */
    public function testCreaRecordatorioDescription(){
        $titulo="titulo";
        $inicio="2020-01-01T00:00";
        $fin="2020-01-01T00:05";
        $freq="once";
        $anterioridad="5m";
        $rep="";
        $freqRep="D";
        $descripcion="patata";
        $rec=creaRecordatorio($titulo,$inicio,$fin,$freq,$anterioridad,$rep,$freqRep,$descripcion);
        $this->assertEquals("patata",$rec->descripcion);
    }
    /**
    * @covers CreaRecordatorio
    */
    public function testCreaRecordatorioFreq1(){
        $titulo="titulo";
        $inicio="2020-01-01T00:00";
        $fin="2020-01-01T00:05";
        $freq="once";
        $anterioridad="5m";
        $rep="";
        $freqRep="D";
        $descripcion="++++++++";
        $rec=creaRecordatorio($titulo,$inicio,$fin,$freq,$anterioridad,$rep,$freqRep,$descripcion);
        $this->assertEquals("once",$rec->repeticion);
    }
    /**
    * @covers CreaRecordatorio
    */
    public function testCreaRecordatorioFreq2(){
        $titulo="titulo";
        $inicio="2020-01-01T00:00";
        $fin="2020-01-01T00:05";
        $freq="daily";
        $anterioridad="1h";
        $rep="";
        $freqRep="D";
        $descripcion="++++++++";
        $rec=creaRecordatorio($titulo,$inicio,$fin,$freq,$anterioridad,$rep,$freqRep,$descripcion);
        $this->assertEquals("daily",$rec->repeticion);
    }
    /**
    * @covers CreaRecordatorio
    */
    public function testCreaRecordatorioFreq3(){
        $titulo="titulo";
        $inicio="2020-01-01T00:00";
        $fin="2020-01-01T00:05";
        $freq="L-V";
        $anterioridad="1d";
        $rep="";
        $freqRep="D";
        $descripcion="++++++++";
        $rec=creaRecordatorio($titulo,$inicio,$fin,$freq,$anterioridad,$rep,$freqRep,$descripcion);
        $this->assertEquals("L-V",$rec->repeticion);
    }
    /**
    * @covers CreaRecordatorio
    */
    public function testCreaRecordatorioFreq4(){
        $titulo="titulo";
        $inicio="2020-01-01T00:00";
        $fin="2020-01-01T00:05";
        $freq="annually";
        $anterioridad="1s";
        $rep="";
        $freqRep="D";
        $descripcion="++++++++";
        $rec=creaRecordatorio($titulo,$inicio,$fin,$freq,$anterioridad,$rep,$freqRep,$descripcion);
        $this->assertEquals("annually",$rec->repeticion);
    }
    /**
    * @covers CreaRecordatorio
    */
    public function testCreaRecordatorioRep1(){
        $titulo="titulo";
        $inicio="2020-01-01T00:00";
        $fin="2020-01-01T00:05";
        $freq="other";
        $anterioridad="1s";
        $rep="";
        $freqRep="D";
        $descripcion="++++++++";
        $rec=creaRecordatorio($titulo,$inicio,$fin,$freq,$anterioridad,$rep,$freqRep,$descripcion);
        $this->assertEquals('1s',$rec->anterioridad);
    }
    /**
    * @covers CreaRecordatorio
    */
    public function testCreaRecordatorioRep2(){
        $titulo="titulo";
        $inicio="2020-01-01T00:00";
        $fin="2020-01-01T00:05";
        $freq="other";
        $anterioridad="1s";
        $rep="1";
        $freqRep="D";
        $descripcion="";
        $rec=creaRecordatorio($titulo,$inicio,$fin,$freq,$anterioridad,$rep,$freqRep,$descripcion);
        $this->assertEquals('titulo',$rec->titulo);
        $this->assertEquals("2020-01-01 00:00",$rec->inicio);
        $this->assertEquals("2020-01-01 00:05",$rec->fin);
        $this->assertEquals("1D",$rec->repeticion);
        $this->assertEquals('1s',$rec->anterioridad);
        $this->assertEquals("",$rec->descripcion);
    }
    
    /**
    * @covers CreaRecordatorio
    */
    public function testCreaRecordatorioRep3(){
        $titulo="titulo";
        $inicio="2020-01-01T00:00";
        $fin="2020-01-01T00:05";
        $freq="other";
        $anterioridad="1s";
        $rep="5";
        $freqRep="M";
        $descripcion="";
        $rec=creaRecordatorio($titulo,$inicio,$fin,$freq,$anterioridad,$rep,$freqRep,$descripcion);
        $this->assertEquals('titulo',$rec->titulo);
        $this->assertEquals("2020-01-01 00:00",$rec->inicio);
        $this->assertEquals("2020-01-01 00:05",$rec->fin);
        $this->assertEquals("5M",$rec->repeticion);
        $this->assertEquals('1s',$rec->anterioridad);
        $this->assertEquals("",$rec->descripcion);
    }
    /**
    * @covers CreaRecordatorio
    */
    public function testCreaRecordatoriRep4(){
        $titulo="titulo";
        $inicio="2020-01-01T00:00";
        $fin="2020-01-01T00:05";
        $freq="other";
        $anterioridad="1s";
        $rep="";
        $freqRep="D";
        $descripcion="";
        $rec=creaRecordatorio($titulo,$inicio,$fin,$freq,$anterioridad,$rep,$freqRep,$descripcion);
        $this->assertEquals('titulo',$rec->titulo);
        $this->assertEquals("2020-01-01 00:00",$rec->inicio);
        $this->assertEquals("2020-01-01 00:05",$rec->fin);
        $this->assertEquals("1D",$rec->repeticion);
        $this->assertEquals('1s',$rec->anterioridad);
        $this->assertEquals("",$rec->descripcion);
    }
    /**
    * @covers CreaRecordatorio
    */
    public function testCreaRecordatoriRep5(){
        $titulo="titulo";
        $inicio="2020-01-01T00:00";
        $fin="2020-01-01T00:05";
        $freq="other";
        $anterioridad="1s";
        $rep="2";
        $freqRep="A";
        $descripcion="";
        $rec=creaRecordatorio($titulo,$inicio,$fin,$freq,$anterioridad,$rep,$freqRep,$descripcion);
        
        $this->assertEquals('titulo',$rec->titulo);
        $this->assertEquals("2020-01-01 00:00",$rec->inicio);
        $this->assertEquals("2020-01-01 00:05",$rec->fin);
        $this->assertEquals("2A",$rec->repeticion);
        $this->assertEquals('1s',$rec->anterioridad);
        $this->assertEquals("",$rec->descripcion);
    }
    /**
    * @covers CreaRecordatorio
    */
    public function testCreaRecordatoriDescription(){
        $titulo="titulo";
        $inicio="2020-01-01T00:00";
        $fin="2020-01-01T00:05";
        $freq="other";
        $anterioridad="1s";
        $rep="2";
        $freqRep="A";
        $descripcion="Hola esto es una descripcion";
        $rec=creaRecordatorio($titulo,$inicio,$fin,$freq,$anterioridad,$rep,$freqRep,$descripcion);
        $this->assertEquals('titulo',$rec->titulo);
        $this->assertEquals("2020-01-01 00:00",$rec->inicio);
        $this->assertEquals("2020-01-01 00:05",$rec->fin);
        $this->assertEquals("2A",$rec->repeticion);
        $this->assertEquals('1s',$rec->anterioridad);
        $this->assertEquals("Hola esto es una descripcion",$rec->descripcion);
    }
    /**
    * @covers CreaRecordatorio
    */
    public function testInsertRecordatorioBDTrue(){
        $titulo="titulo";
        $inicio="2020-01-01T00:00";
        $fin="2020-01-01T00:05";
        $freq="other";
        $anterioridad="1s";
        $rep="2";
        $freqRep="A";
        $descripcion="Hola esto es una descripcion";
        $rec=creaRecordatorio($titulo,$inicio,$fin,$freq,$anterioridad,$rep,$freqRep,$descripcion);
        $connexio=connectDB();
        $this->assertTrue(insertRecordatorioBD($rec,1,$connexio));
    }
    /**
    * @covers CreaRecordatorio
    */
    public function testInsertRecordatorioBDFalse(){
        $titulo="titulo";
        $inicio="2020-01-01T00:00";
        $fin="2020-01-01T00:05";
        $freq="other";
        $anterioridad="1s";
        $rep="2";
        $freqRep="A";
        $descripcion="Hola esto es una descripcion";
        $rec=creaRecordatorio($titulo,$inicio,$fin,$freq,$anterioridad,$rep,$freqRep,$descripcion);
        $connexio=connectDB();
        $this->assertFalse(insertRecordatorioBD($rec,'a',$connexio));
    }
}


?>
<?php



$folders=explode("\\", __DIR__);
$directorio="";
foreach(array_slice($folders, 0, -2) as $folder){
    $directorio.=$folder.'/';
}

require_once $directorio.'/controlador/controlador_PaginaRecordatorio.php';
require_once $directorio.'/model/model_connectDB.php';
/**
* @covers Recordatorio::
*/
class RecordatorioTest extends PHPUnit\Framework\TestCase{

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
     * @covers insertRecordatorioBD
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
        $this->assertTrue(insertRecordatorioBD($rec,1,$connexio)[0]);
    }
    /**
     * @covers insertRecordatorioBD
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
        $this->assertFalse(insertRecordatorioBD($rec,'a',$connexio)[0]);
    }
    
    //Test Titulo
    //Decision, valores límite, frontera y particiones equivalentes
    public function testComprobarTitulo(){ 
        $recordatorio=ComprobarCampos('titulo',"2020-01-01T00:00","2020-01-01T00:00","other","1s","2","A",'descripcion');
        $this->assertTrue($recordatorio);
    }
    public function testComprobarTitulo1(){        
        $recordatorio=ComprobarCampos('',"2020-01-01T00:00","2020-01-01T00:00","other","1s","2","A",'descripcion');
        $this->assertFalse($recordatorio);
    }
    public function testComprobarTitulo2(){        
        $recordatorio=ComprobarCampos('1',"2020-01-01T00:00","2020-01-01T00:00","other","1s","2","A",'descripcion');
        $this->assertTrue($recordatorio);
    }
    public function testComprobarTitulo3(){        
        $recordatorio=ComprobarCampos('12',"2020-01-01T00:00","2020-01-01T00:00","other","1s","2","A",'descripcion');
        $this->assertTrue($recordatorio);
    }
    public function testComprobarTitulo4(){        
        $recordatorio=ComprobarCampos('99caracteres99caracteres99caracteres99caracteres99caracteres99caracteres99caracteres99caracteres99c',"2020-01-01T00:00","2020-01-01T00:00","other","1s","2","A",'descripcion');
        $this->assertTrue($recordatorio);
    }
    public function testComprobarTitulo5(){        
        $recordatorio=ComprobarCampos('100caracteres100caracteres100caracteres100caracteres100caracteres100caracteres100caracteres100caract',"2020-01-01T00:00","2020-01-01T00:00","other","1s","2","A",'descripcion');
        $this->assertTrue($recordatorio);
    }
    public function testComprobarTitulo6(){        
        $recordatorio=ComprobarCampos('101caracteres101caracteres101caracteres101caracteres101caracteres101caracteres101caracteres101caracte',"2020-01-01T00:00","2020-01-01T00:00","other","1s","2","A",'descripcion');
        $this->assertFalse($recordatorio);
    }
    public function testComprobarTitulo7(){        
        $recordatorio=ComprobarCampos('50caracteres50caracteres50caracteres50caracteres50',"2020-01-01T00:00","2020-01-01T00:00","other","1s","2","A",'descripcion');
        $this->assertTrue($recordatorio);
    }
    public function testComprobarTitulo8(){        
        $recordatorio=ComprobarCampos('300caracteres300caracteres300caracteres300caracteres300caracteres300caracteres300caracteres300caracteres300caracteres300caracteres300caracteres300caracteres300caracteres300caracteres300caracteres300caracteres300caracteres300caracteres300caracteres300caracteres300caracteres300caracteres300caracteress',"2020-01-01T00:00","2020-01-01T00:00","other","1s","2","A",'descripcion');
        $this->assertFalse($recordatorio);
    }

    // Test inicio
    public function testComprobarInicio(){ 
        $recordatorio=ComprobarCampos('titulo',"2020-01-01T00:00","2020-01-01T00:00","once","5m","1","D",'descripcion');
        $this->assertTrue($recordatorio);
    }
    public function testComprobarInicio1(){ 
        $recordatorio=ComprobarCampos('titulo',"AAAA-01-01T00:00","2020-01-01T00:00","once","5m","1","D",'descripcion');
        $this->assertFalse($recordatorio);
    }
    public function testComprobarInicio2(){ 
        $recordatorio=ComprobarCampos('titulo',"2020/01-01T00:00","2020-01-01T00:00","once","5m","1","D",'descripcion');
        $this->assertFalse($recordatorio);
    }
    public function testComprobarInicio3(){ 
        $recordatorio=ComprobarCampos('titulo',"2020-01/01T00:00","2020-01-01T00:00","once","5m","1","D",'descripcion');
        $this->assertFalse($recordatorio);
    }
    public function testComprobarInicio4(){ 
        $recordatorio=ComprobarCampos('titulo',"2020-40-01T00:00","2020-01-01T00:00","once","5m","1","D",'descripcion');
        $this->assertFalse($recordatorio);
    }
    public function testComprobarInicio5(){ 
        $recordatorio=ComprobarCampos('titulo',"2020-01-40T00:00","2020-01-01T00:00","once","5m","1","D",'descripcion');
        $this->assertFalse($recordatorio);
    }
    public function testComprobarInicio6(){ 
        $recordatorio=ComprobarCampos('titulo',"2020-01-01T30:00","2020-01-01T00:00","once","5m","1","D",'descripcion');
        $this->assertFalse($recordatorio);
    }
    public function testComprobarInicio7(){ 
        $recordatorio=ComprobarCampos('titulo',"2020-01-01T12:20","2020-01-01T00:00","once","5m","1","D",'descripcion');
        $this->assertTrue($recordatorio);
    }

    // Test fin
    public function testComprobarFin(){ 
        $recordatorio=ComprobarCampos('titulo',"2020-01-01T00:00","2020-01-01T00:00","once","5m","1","D",'descripcion');
        $this->assertTrue($recordatorio);
    }
    public function testComprobarFin1(){ 
        $recordatorio=ComprobarCampos('titulo',"2020-01-01T00:00","AAAA-01-01T00:00","once","5m","1","D",'descripcion');
        $this->assertFalse($recordatorio);
    }
    public function testComprobarFin2(){ 
        $recordatorio=ComprobarCampos('titulo',"2020-01-01T00:00","2020/01-01T00:00","once","5m","1","D",'descripcion');
        $this->assertFalse($recordatorio);
    }
    public function testComprobarFin3(){ 
        $recordatorio=ComprobarCampos('titulo',"2020-01-01T00:00","2020-01/01T00:00","once","5m","1","D",'descripcion');
        $this->assertFalse($recordatorio);
    }
    public function testComprobarFin4(){ 
        $recordatorio=ComprobarCampos('titulo',"2020-01-01T00:00","2020-40-01T00:00","once","5m","1","D",'descripcion');
        $this->assertFalse($recordatorio);
    }
    public function testComprobarFin5(){ 
        $recordatorio=ComprobarCampos('titulo',"2020-01-01T00:00","2020-01-40T00:00","once","5m","1","D",'descripcion');
        $this->assertFalse($recordatorio);
    }
    public function testComprobarFin6(){ 
        $recordatorio=ComprobarCampos('titulo',"2020-01-01T00:00","2020-01-01T30:00","once","5m","1","D",'descripcion');
        $this->assertFalse($recordatorio);
    }
    public function testComprobarFin7(){ 
        $recordatorio=ComprobarCampos('titulo',"2020-01-01T00:00","2020-01-01T12:20","once","5m","1","D",'descripcion');
        $this->assertTrue($recordatorio);
    }

    // Test freq
    public function testComprobarFreq(){ 
        $recordatorio=ComprobarCampos('titulo',"2020-01-01T00:00","2020-01-01T00:00","once","5m","1","D",'descripcion');
        $this->assertTrue($recordatorio);
    }
    public function testComprobarFreq1(){ 
        $recordatorio=ComprobarCampos('titulo',"2020-01-01T00:00","2020-01-01T00:00","ONCE","5m","1","D",'descripcion');
        $this->assertFalse($recordatorio);
    }
    public function testComprobarFreq2(){ 
        $recordatorio=ComprobarCampos('titulo',"2020-01-01T00:00","2020-01-01T00:00","daily","5m","1","D",'descripcion');
        $this->assertTrue($recordatorio);
    }
    public function testComprobarFreq3(){ 
        $recordatorio=ComprobarCampos('titulo',"2020-01-01T00:00","2020-01-01T00:00","DAILY","5m","1","D",'descripcion');
        $this->assertFalse($recordatorio);
    }
    public function testComprobarFreq4(){ 
        $recordatorio=ComprobarCampos('titulo',"2020-01-01T00:00","2020-01-01T00:00","L-V","5m","1","D",'descripcion');
        $this->assertTrue($recordatorio);
    }
    public function testComprobarFreq5(){ 
        $recordatorio=ComprobarCampos('titulo',"2020-01-01T00:00","2020-01-01T00:00","l-v","5m","1","D",'descripcion');
        $this->assertFalse($recordatorio);
    }
    public function testComprobarFreq6(){ 
        $recordatorio=ComprobarCampos('titulo',"2020-01-01T00:00","2020-01-01T00:00","annually","5m","1","D",'descripcion');
        $this->assertTrue($recordatorio);
    }
    public function testComprobarFreq7(){ 
        $recordatorio=ComprobarCampos('titulo',"2020-01-01T00:00","2020-01-01T00:00","ANNUALLY","5m","1","D",'descripcion');
        $this->assertFalse($recordatorio);
    }
    public function testComprobarFreq8(){ 
        $recordatorio=ComprobarCampos('titulo',"2020-01-01T00:00","2020-01-01T00:00","other","5m","1","D",'descripcion');
        $this->assertTrue($recordatorio);
    }
    public function testComprobarFreq9(){ 
        $recordatorio=ComprobarCampos('titulo',"2020-01-01T00:00","2020-01-01T00:00","OTHER","5m","1","D",'descripcion');
        $this->assertFalse($recordatorio);
    }
    public function testComprobarFreq10(){ 
        $recordatorio=ComprobarCampos('titulo',"2020-01-01T00:00","2020-01-01T00:00","","5m","1","D",'descripcion');
        $this->assertFalse($recordatorio);
    }


    // Test anterioridad
    public function testComprobarAnterioridad(){ 
        $recordatorio=ComprobarCampos('titulo',"2020-01-01T00:00","2020-01-01T00:00","other","5m","1","D",'descripcion');
        $this->assertTrue($recordatorio);
    }
    public function testComprobarAnterioridad1(){ 
        $recordatorio=ComprobarCampos('titulo',"2020-01-01T00:00","2020-01-01T00:00","other","5M","1","D",'descripcion');
        $this->assertFalse($recordatorio);
    }
    public function testComprobarAnterioridad2(){ 
        $recordatorio=ComprobarCampos('titulo',"2020-01-01T00:00","2020-01-01T00:00","other","1h","1","D",'descripcion');
        $this->assertTrue($recordatorio);
    }
    public function testComprobarAnterioridad3(){ 
        $recordatorio=ComprobarCampos('titulo',"2020-01-01T00:00","2020-01-01T00:00","other","1H","1","D",'descripcion');
        $this->assertFalse($recordatorio);
    }
    public function testComprobarAnterioridad4(){ 
        $recordatorio=ComprobarCampos('titulo',"2020-01-01T00:00","2020-01-01T00:00","other","1d","1","D",'descripcion');
        $this->assertTrue($recordatorio);
    }
    public function testComprobarAnterioridad5(){ 
        $recordatorio=ComprobarCampos('titulo',"2020-01-01T00:00","2020-01-01T00:00","other","1D","1","D",'descripcion');
        $this->assertFalse($recordatorio);
    }
    public function testComprobarAnterioridad6(){ 
        $recordatorio=ComprobarCampos('titulo',"2020-01-01T00:00","2020-01-01T00:00","other","1s","1","D",'descripcion');
        $this->assertTrue($recordatorio);
    }
    public function testComprobarAnterioridad7(){ 
        $recordatorio=ComprobarCampos('titulo',"2020-01-01T00:00","2020-01-01T00:00","other","1S","1","D",'descripcion');
        $this->assertFalse($recordatorio);
    }
    public function testComprobarAnterioridad8(){ 
        $recordatorio=ComprobarCampos('titulo',"2020-01-01T00:00","2020-01-01T00:00","other","","1","D",'descripcion');
        $this->assertFalse($recordatorio);
    }
    public function testComprobarAnterioridad9(){ 
        $recordatorio=ComprobarCampos('titulo',"2020-01-01T00:00","2020-01-01T00:00","other","","1","D",'descripcion');
        $this->assertFalse($recordatorio);
    }

    // Test rep
    public function testComprobarRep(){ 
        $recordatorio=ComprobarCampos('titulo',"2020-01-01T00:00","2020-01-01T00:00","other","1s",0,"D",'descripcion');
        $this->assertTrue($recordatorio);
    }
    public function testComprobarRep1(){ 
        $recordatorio=ComprobarCampos('titulo',"2020-01-01T00:00","2020-01-01T00:00","other","1s",1,"D",'descripcion');
        $this->assertTrue($recordatorio);
    }
    public function testComprobarRep2(){ 
        $recordatorio=ComprobarCampos('titulo',"2020-01-01T00:00","2020-01-01T00:00","other","1s",2,"D",'descripcion');
        $this->assertTrue($recordatorio);
    }
    public function testComprobarRe3p(){ 
        $recordatorio=ComprobarCampos('titulo',"2020-01-01T00:00","2020-01-01T00:00","other","1s",364,"D",'descripcion');
        $this->assertTrue($recordatorio);
    }
    public function testComprobarRep4(){ 
        $recordatorio=ComprobarCampos('titulo',"2020-01-01T00:00","2020-01-01T00:00","other","1s",365,"D",'descripcion');
        $this->assertTrue($recordatorio);
    }
    public function testComprobarRep5(){ 
        $recordatorio=ComprobarCampos('titulo',"2020-01-01T00:00","2020-01-01T00:00","other","1s",366,"D",'descripcion');
        $this->assertTrue($recordatorio);
    }
    public function testComprobarRep6(){ 
        $recordatorio=ComprobarCampos('titulo',"2020-01-01T00:00","2020-01-01T00:00","other","1s","","D",'descripcion');
        $this->assertTrue($recordatorio);
    }
    public function testComprobarRep7(){ 
        $recordatorio=ComprobarCampos('titulo',"2020-01-01T00:00","2020-01-01T00:00","other","1s","false","D",'descripcion');
        $this->assertTrue($recordatorio);
    }
    public function testComprobarRep8(){ 
        $recordatorio=ComprobarCampos('titulo',"2020-01-01T00:00","2020-01-01T00:00","other","1s","true","D",'descripcion');
        $this->assertTrue($recordatorio);
    }
    public function testComprobarRep9(){ 
        $recordatorio=ComprobarCampos('titulo',"2020-01-01T00:00","2020-01-01T00:00","other","1s","3666","D",'descripcion');
        $this->assertTrue($recordatorio);
    }

    // Test freqRep
    public function testComprobarFreqRep(){ 
        $recordatorio=ComprobarCampos('titulo',"2020-01-01T00:00","2020-01-01T00:00","other","1s","2","D",'descripcion');
        $this->assertTrue($recordatorio);
    }
    public function testComprobarFreqRep1(){        
        $recordatorio=ComprobarCampos('titulo',"2020-01-01T00:00","2020-01-01T00:00","other","1s","2","d",'descripcion');
        $this->assertFalse($recordatorio);
    }
    public function testComprobarFreqRep2(){        
        $recordatorio=ComprobarCampos('titulo',"2020-01-01T00:00","2020-01-01T00:00","other","1s","2","M",'descripcion');
        $this->assertTrue($recordatorio);
    }
    public function testComprobarFreqRep3(){        
        $recordatorio=ComprobarCampos('titulo',"2020-01-01T00:00","2020-01-01T00:00","other","1s","2","m",'descripcion');
        $this->assertFalse($recordatorio);
    }
    public function testComprobarFreqRep4(){        
        $recordatorio=ComprobarCampos('titulo',"2020-01-01T00:00","2020-01-01T00:00","other","1s","2","D",'descripcion');
        $this->assertTrue($recordatorio);
    }
    public function testComprobarFreqRep5(){        
        $recordatorio=ComprobarCampos('titulo',"2020-01-01T00:00","2020-01-01T00:00","other","1s","2","d",'descripcion');
        $this->assertFalse($recordatorio);
    }
    public function testComprobarFreqRep6(){        
        $recordatorio=ComprobarCampos('titulo',"2020-01-01T00:00","2020-01-01T00:00","other","1s","2","F",'descripcion');
        $this->assertFalse($recordatorio);
    }
    public function testComprobarFreqRep7(){        
        $recordatorio=ComprobarCampos('titulo',"2020-01-01T00:00","2020-01-01T00:00","other","1s","2","",'descripcion');
        $this->assertFalse($recordatorio);
    }

    // Test descripción
    public function testComprobarDescripcion(){        
        $recordatorio=ComprobarCampos('titulo',"2020-01-01T00:00","2020-01-01T00:00","other","1s","2","A",'');
        $this->assertTrue($recordatorio);
    }
    public function testComprobarDescripcion1(){        
        $recordatorio=ComprobarCampos('titulo',"2020-01-01T00:00","2020-01-01T00:00","other","1s","2","A",'1');
        $this->assertTrue($recordatorio);
    }
    public function testComprobarDescripcion3(){        
        $recordatorio=ComprobarCampos('titulo',"2020-01-01T00:00","2020-01-01T00:00","other","1s","2","A",'200caracteres200caracteres200caracteres200caracteres200caracteres200caracteres200caracteres200caracteres200caracteres200caracteres200caracteres200caracteres200caracteres200caracteres200caracteressssss');
        $this->assertTrue($recordatorio);
    }
    public function testComprobarDescripcion4(){        
        $recordatorio=ComprobarCampos('titulo',"2020-01-01T00:00","2020-01-01T00:00","other","1s","2","A",'201caracteres201caracteres201caracteres201caracteres201caracteres201caracteres201caracteres201caracteres201caracteres201caracteres201caracteres201caracteres201caracteres201caracteres201caracteres201car');
        $this->assertFalse($recordatorio);
    }    
    public function testComprobarDescripcion5(){        
        $recordatorio=ComprobarCampos('titulo',"2020-01-01T00:00","2020-01-01T00:00","other","1s","2","A",'50caracteres50caracteres50caracteres50caracteres50');
        $this->assertTrue($recordatorio);
    }
    public function testComprobarDescripcion6(){        
        $recordatorio=ComprobarCampos('titulo',"2020-01-01T00:00","2020-01-01T00:00","other","1s","2","A",'300caracteres300caracteres300caracteres300caracteres300caracteres300caracteres300caracteres300caracteres300caracteres300caracteres300caracteres300caracteres300caracteres300caracteres300caracteres300caracteres300caracteres300caracteres300caracteres300caracteres300caracteres300caracteres300caracteress');
        $this->assertFalse($recordatorio);
    }
}


?>
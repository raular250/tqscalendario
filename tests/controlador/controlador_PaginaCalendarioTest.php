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
    public function testNextRecIni1(){
        $ini="1970-01-01 00:00";
        $fin="2022-01-01 10:00";
        $freq="1D";
        $ant="5m";
        $date="2021-11-12 22:26";
        $nextRec=nextRec($ini,$fin,$freq,$ant,$date);
        $this->assertEquals("2021-11-12 23:55",$nextRec);
    }
    public function testNextRecIni2(){
        $ini="2020-01 00:00";
        $fin="2022-01-01 10:00";
        $freq="1D";
        $ant="5m";
        $date="2021-11-12 22:26";
        $nextRec=nextRec($ini,$fin,$freq,$ant,$date);
        $this->assertEquals("2021-11-1223:55",$nextRec);
    }
    public function testNextRecIni3(){
        $ini="2021-01 00:00";
        $fin="2022-01-01 10:00";
        $freq="1D";
        $ant="5m";
        $date="2021-11-12 22:26";
        $nextRec=nextRec($ini,$fin,$freq,$ant,$date);
        $this->assertEquals("2021-11-12 23:55",$nextRec);
    }
    public function testNextRecIni4(){
        $ini="2021-11-11 00:00";
        $fin="2022-01-01 10:00";
        $freq="1D";
        $ant="5m";
        $date="2021-11-12 22:26";
        $nextRec=nextRec($ini,$fin,$freq,$ant,$date);
        $this->assertEquals("2021-11-12 23:55",$nextRec);
    }
    public function testNextRecIni5(){
        $ini="2021-11-12 22:26";
        $fin="2022-01-01 10:00";
        $freq="1D";
        $ant="5m";
        $date="2021-11-12 22:26";
        $nextRec=nextRec($ini,$fin,$freq,$ant,$date);
        $this->assertEquals("2021-11-12 23:55",$nextRec);
    }
    public function testNextRecIni6(){
        $ini="2021-11-12 22:26";
        $fin="2022-01-01 10:00";
        $freq="1D";
        $ant="5m";
        $date="2021-11-12 22:26";
        $nextRec=nextRec($ini,$fin,$freq,$ant,$date);
        $this->assertEquals("2021-11-13 22:21",$nextRec);
    }
    public function testNextRecIni7(){
        $ini="2021-11-12 22:26";
        $fin="2022-01-01 10:00";
        $freq="1D";
        $ant="5m";
        $date="2021-11-12 22:26";
        $nextRec=nextRec($ini,$fin,$freq,$ant,$date);
        $this->assertEquals("2021-11-13 22:21",$nextRec);
    }
    public function testNextRecIni8(){
        $ini="2022-01-01 10:00";
        $fin="2022-01-01 10:00";
        $freq="1D";
        $ant="5m";
        $date="2021-11-12 22:26";
        $nextRec=nextRec($ini,$fin,$freq,$ant,$date);
        $this->assertEquals("2021-11-13 09:55",$nextRec);
    }
    
    public function testNextRecIni9(){
        $ini="2025-01-01 10:00";
        $fin="2022-01-01 10:00";
        $freq="1D";
        $ant="5m";
        $date="2021-11-12 22:26";
        $nextRec=nextRec($ini,$fin,$freq,$ant,$date);
        $this->assertFalse($nextRec);
    }
    public function testNextRecFin1(){
        $ini="2020-01-01 10:00";
        $fin="1970-01-01 10:00";
        $freq="1D";
        $ant="5m";
        $date="2021-11-12 22:26";
        $nextRec=nextRec($ini,$fin,$freq,$ant,$date);
        $this->assertFalse($nextRec);
    }
    public function testNextRecFin2(){
        $ini="2020-01-01 10:00";
        $fin="2020-01-01 09:59";
        $freq="1D";
        $ant="5m";
        $date="2021-11-12 22:26";
        $nextRec=nextRec($ini,$fin,$freq,$ant,$date);
        $this->assertFalse($nextRec);
    }
    public function testNextRecFin3(){
        $ini="2020-01-01 10:00";
        $fin="2020-01-01 10:00";
        $freq="1D";
        $ant="5m";
        $date="2021-11-12 22:26";
        $nextRec=nextRec($ini,$fin,$freq,$ant,$date);
        $this->assertFalse($nextRec);
    }
    public function testNextRecFin4(){
        $ini="2020-01-01 10:00";
        $fin="2020-01-01 10:01";
        $freq="1D";
        $ant="5m";
        $date="2021-11-12 22:26";
        $nextRec=nextRec($ini,$fin,$freq,$ant,$date);
        $this->assertFalse($nextRec);
    }
    public function testNextRecFin5(){
        $ini="2020-01-01 10:00";
        $fin="2021-11-12 22:25";
        $freq="1D";
        $ant="5m";
        $date="2021-11-12 22:26";
        $nextRec=nextRec($ini,$fin,$freq,$ant,$date);
        $this->assertFalse($nextRec);
    }
    public function testNextRecFin6(){
        $ini="2020-01-01 10:00";
        $fin="2021-11-12 22:26";
        $freq="1D";
        $ant="5m";
        $date="2021-11-12 22:26";
        $nextRec=nextRec($ini,$fin,$freq,$ant,$date);
        $this->assertFalse($nextRec);
    }
    public function testNextRecFin7(){
        $ini="2020-01-01 10:00";
        $fin="2021-11-12 22:27";
        $freq="1D";
        $ant="5m";
        $date="2021-11-12 22:26";
        $nextRec=nextRec($ini,$fin,$freq,$ant,$date);
        $this->assertFalse($nextRec);
    }
    public function testNextRecFin8(){
        $ini="2020-01-01 10:00";
        $fin="2022-11-12 22:27";
        $freq="1D";
        $ant="5m";
        $date="2021-11-12 22:26";
        $nextRec=nextRec($ini,$fin,$freq,$ant,$date);
        $this->assertEquals("2021-11-13 09:55",$nextRec);
    }
    public function testNextRecFreq1(){
        $ini="2020-01-01 10:00";
        $fin="2022-11-12 22:27";
        $freq="2D"; //1D,2D,3D..,1M,2M,3M...,1A,2A,3A...,once,daily,L-V",annually
        $ant="5m";
        $date="2021-11-12 22:26";
        $nextRec=nextRec($ini,$fin,$freq,$ant,$date);
        $this->assertEquals("2021-11-13 09:55",$nextRec);
    }
    public function testNextRecFreq2(){
        $ini="2020-01-01 10:00";
        $fin="2022-11-12 22:27";
        $freq="1M";
        $ant="5m";
        $date="2021-11-12 22:26";
        $nextRec=nextRec($ini,$fin,$freq,$ant,$date);
        $this->assertEquals("2021-12-01 09:55",$nextRec);
    }
    
    public function testNextRecFreq3(){
        $ini="2020-01-01 10:00";
        $fin="2022-11-12 22:27";
        $freq="2M";
        $ant="5m";
        $date="2021-11-12 22:26";
        $nextRec=nextRec($ini,$fin,$freq,$ant,$date);
        $this->assertEquals("2022-01-01 09:55",$nextRec);
    }
    public function testNextRecFreq4(){
        $ini="2020-01-01 10:00";
        $fin="2022-11-12 22:27";
        $freq="1A";
        $ant="5m";
        $date="2021-11-12 22:26";
        $nextRec=nextRec($ini,$fin,$freq,$ant,$date);
        $this->assertEquals("2022-01-01 09:55",$nextRec);
    } 
    public function testNextRecFreq5(){
        $ini="2020-01-01 10:00";
        $fin="2022-11-12 22:27";
        $freq="once";
        $ant="5m";
        $date="2021-11-12 22:26";
        $nextRec=nextRec($ini,$fin,$freq,$ant,$date);
        $this->assertFalse($nextRec);
    } 
    public function testNextRecFreq6(){
        $ini="2020-01-01 10:00";
        $fin="2022-11-12 22:27";
        $freq="daily";
        $ant="5m";
        $date="2021-11-12 22:26";
        $nextRec=nextRec($ini,$fin,$freq,$ant,$date);
        $this->assertEquals("2021-11-13 09:55",$nextRec);
    } 
    public function testNextRecFreq7(){
        $ini="2020-01-01 10:00";
        $fin="2022-11-12 22:27";
        $freq="L-V";
        $ant="5m";
        $date="2021-11-12 22:26";
        $nextRec=nextRec($ini,$fin,$freq,$ant,$date);
        $this->assertEquals("2021-11-15 09:55",$nextRec);
    } 
    public function testNextRecFreq8(){
        $ini="2020-01-01 10:00";
        $fin="2022-11-12 22:27";
        $freq="annually";
        $ant="5m";
        $date="2021-11-12 22:26";
        $nextRec=nextRec($ini,$fin,$freq,$ant,$date);
        $this->assertEquals("2022-01-01 09:55",$nextRec);
    } 
    public function testNextRecAnt1(){
        $ini="2020-01-01 10:00";
        $fin="2022-11-12 22:27";
        $freq="1D";
        $ant="1h";
        $date="2021-11-12 22:26";
        $nextRec=nextRec($ini,$fin,$freq,$ant,$date);
        $this->assertEquals("2021-11-13 09:00",$nextRec);
    }
    public function testNextRecAnt2(){
        $ini="2020-01-01 10:00";
        $fin="2022-11-12 22:27";
        $freq="1D";
        $ant="1d";
        $date="2021-11-12 22:26";
        $nextRec=nextRec($ini,$fin,$freq,$ant,$date);
        $this->assertEquals("2021-11-13 10:00",$nextRec);
    }
    public function testNextRecAnt3(){
        $ini="2020-01-01 10:00";
        $fin="2022-11-12 22:27";
        $freq="once";
        $ant="1s";
        $date="2021-11-12 22:26";
        $nextRec=nextRec($ini,$fin,$freq,$ant,$date);
        $this->assertFalse($nextRec);
    }
    public function testNextDate1(){
        $ini="2020-01-01 10:00";
        $fin="2022-01-01 10:00";
        $freq="1D";       //1D,2D,3D..,1M,2M,3M...,1A,2A,3A...,once,daily,L-V",annually
        $ant="5m";        //5m,1h,1d,1s
        $date="1970-11-12 22:26";
        $nextRec=nextRec($ini,$fin,$freq,$ant,$date);
        $this->assertEquals("2020-01-01 09:55",$nextRec);
    }
    public function testNextDate2(){
        $ini="2020-01-01 10:00";
        $fin="2022-01-01 10:00";
        $freq="1D";       //1D,2D,3D..,1M,2M,3M...,1A,2A,3A...,once,daily,L-V",annually
        $ant="5m";        //5m,1h,1d,1s
        $date="2020-01-01 09:55";
        $nextRec=nextRec($ini,$fin,$freq,$ant,$date);
        $this->assertEquals("2020-01-02 09:55",$nextRec);
    }
    public function testNextDate3(){
        $ini="2020-01-01 10:00";
        $fin="2022-01-01 10:00";
        $freq="1D";       //1D,2D,3D..,1M,2M,3M...,1A,2A,3A...,once,daily,L-V",annually
        $ant="5m";        //5m,1h,1d,1s
        $date="2020-01-01 10:55";
        $nextRec=nextRec($ini,$fin,$freq,$ant,$date);
        $this->assertEquals("2020-01-02 09:55",$nextRec);
    }
    public function testNextDate4(){
        $ini="2020-01-01 10:00";
        $fin="2022-01-01 10:00";
        $freq="1D";       //1D,2D,3D..,1M,2M,3M...,1A,2A,3A...,once,daily,L-V",annually
        $ant="5m";        //5m,1h,1d,1s
        $date="2022-01-01 09:55";
        $nextRec=nextRec($ini,$fin,$freq,$ant,$date);
        $this->assertEquals("2022-01-01 09:55",$nextRec);
    }
    public function testNextDate5(){
        $ini="2020-01-01 10:00";
        $fin="2022-01-01 10:00";
        $freq="1D";       //1D,2D,3D..,1M,2M,3M...,1A,2A,3A...,once,daily,L-V",annually
        $ant="5m";        //5m,1h,1d,1s
        $date="2024-01-01 09:55";
        $nextRec=nextRec($ini,$fin,$freq,$ant,$date);
        $this->assertFalse($nextRec);
    }
    public function testMinusAnt1(){
        $date="2021-01-01 09:55";
        $ant='5m';
        $result=minusAnt($date,$ant);
        $this->assertEquals("2021-01-01 09:50",$result);
    }
    public function testMinusAnt2(){
        $date="2021-01-01 09:55";
        $ant='1h';
        $result=minusAnt($date,$ant);
        $this->assertEquals("2021-01-01 08:55",$result);
    }
    public function testMinusAnt3(){
        $date="2021-01-02 09:55";
        $ant='1d';
        $result=minusAnt($date,$ant);
        $this->assertEquals("2021-01-01 09:55",$result);
    }
    public function testMinusAnt4(){
        $date="2021-01-08 09:55";
        $ant='1s';
        $result=minusAnt($date,$ant);
        $this->assertEquals("2021-01-01 09:55",$result);
    }
    public function testMinusAnt5(){    //valores limite
        $date="2021-01-08 00:00";
        $ant='5m';
        $result=minusAnt($date,$ant);
        $this->assertEquals("2021-01-07 23:55",$result);
    }
    public function testMinusAnt6(){    //valores frontera
        $date="2021-01-08 00:01";
        $ant='5m';
        $result=minusAnt($date,$ant);
        $this->assertEquals("2021-01-07 23:56",$result);
    }
    public function testMinusAnt7(){    //valores frontera
        $date="2021-01-08 00:05";
        $ant='5m';
        $result=minusAnt($date,$ant);
        $this->assertEquals("2021-01-08 00:00",$result);
    }
    public function testMinusAnt8(){    //valores frontera
        $date="2021-01-08 23:59";
        $ant='5m';
        $result=minusAnt($date,$ant);
        $this->assertEquals("2021-01-08 23:54",$result);
    }
    public function testMinusAnt9(){    //valores limite
        $date="2021-11-01 00:00";
        $ant='5m';
        $result=minusAnt($date,$ant);
        $this->assertEquals("2021-10-31 23:55",$result);
    }
    public function testMinusAnt10(){    //valores frontera
        $date="2021-11-01 00:01";
        $ant='5m';
        $result=minusAnt($date,$ant);
        $this->assertEquals("2021-10-31 23:56",$result);
    }
    public function testMinusAnt11(){    //valores frontera
        $date="2021-11-01 23:59";
        $ant='5m';
        $result=minusAnt($date,$ant);
        $this->assertEquals("2021-11-01 23:54",$result);
    }
    public function testMinusAnt12(){    //valores limite
        $date="2021-01-01 00:00";
        $ant='5m';
        $result=minusAnt($date,$ant);
        $this->assertEquals("2020-12-31 23:55",$result);
    }
    public function testMinusAnt13(){    //valores frontera
        $date="2021-01-01 00:01";
        $ant='5m';
        $result=minusAnt($date,$ant);
        $this->assertEquals("2020-12-31 23:56",$result);
    }
    public function testMinusAnt14(){    //valores frontera
        $date="2021-01-01 23:59";
        $ant='5m';
        $result=minusAnt($date,$ant);
        $this->assertEquals("2021-01-01 23:54",$result);
    }
    
    public function testMinusAnt15(){    //valores frontera
        $date=false;
        $ant='5m';
        $result=minusAnt($date,$ant);
        $this->assertFalse($result);
    }
}


?>
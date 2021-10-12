<?php
$folders=explode("\\", __DIR__);
$directorio="";
foreach(array_slice($folders, 0, -2) as $folder){
    $directorio.=$folder.'/';
}

require_once $directorio.'/model/model_connectDB.php';      //deberiamos usar __DIR__.'../model/model_connectDB.php'; pero no me funciona lo de subir 2 directorios con ..

class connectDBTest extends PHPUnit\Framework\TestCase{

    public function testConnection1(){
        $connexion_errors=connectDB()->connect_error;
        $this->assertNull($connexion_errors);
    }

    public function testConnection2(){
        $connexion_errors=connectDB()->server_info;
        $this->assertNotNull($connexion_errors);
    }
    
    
    public function testCloseConnection(){
        $conn=connectDB();
        CloseCon($conn);
        $result=(isset($conn) && !isset($conn->server_info));
        $this->assertTrue($result);
    }

}

?>
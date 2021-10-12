<?php
require_once __DIR__.'/../model/model_connectDB.php';

class connectDBTest extends PHPUnit\Framework\TestCase{

    public function testConnection(){
        $connexion=connectDB();
        $this->assertTrue($connexion);
    }

}

?>
<?php
require_once __DIR__ .'/controlador/controlador_PaginaInicio.php';

class Usuario extends PHPUnit\Framework\TestCase{

    public function test(){
        $this->assertTrue(false);
    }
    protected function setUp(){
        $this->user=new User('raul','123');
    }
    public function testConstruct(){
        $usuario=new User('raul','123');
        $this->assertEquals($usuario,$this->user);
    }

}

?>
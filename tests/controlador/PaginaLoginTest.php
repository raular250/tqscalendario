<?php
$folders=explode("\\", __DIR__);
$directorio="";
foreach(array_slice($folders, 0, -2) as $folder){
    $directorio.=$folder.'/';
}

require_once $directorio.'/controlador/controlador_PaginaLogin.php';      //deberiamos usar __DIR__.'../\controlador\controlador_PaginaInicio.php'; pero no me funciona lo de subir 2 directorios con ..

class UsuarioTest extends PHPUnit\Framework\TestCase{

    public function testUser(){
        $usuario=new Usuario('raul','123');
        $this->assertEquals('raul',$usuario->user);
    }
    public function testPassword(){
        $usuario=new Usuario('raul','123');
        $this->assertEquals('123',$usuario->password);
    }

}

?>
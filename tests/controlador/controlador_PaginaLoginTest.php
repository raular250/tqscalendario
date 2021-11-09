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
    

    public function testGetUser(){
        $usuario=new Usuario('raul','123');
        $result=$usuario->getUser();
        $this->assertEquals('raul',$result);
    }

    public function testGetPasswordUser(){
        $usuario=new Usuario('raul','123');
        $result=$usuario->getPassword();
        $this->assertEquals('123',$result);
    }

    public function testChangeNewPassword(){
        $usuario=new Usuario('raul','123');
        $usuario->changePassword('123','456');
        $this->assertEquals('456',$usuario->getPassword());
    }

    public function testChangeBadPassword(){
        $usuario=new Usuario('raul','123');
        $usuario->changePassword('111','456');
        $this->assertEquals('123',$usuario->getPassword());
    }

    public function testChangeEqualPassword(){
        $usuario=new Usuario('raul','123');
        $usuario->getUser('123','123');
        $this->assertEquals('123',$usuario->getPassword());
    }

    public function testCheckUser(){
        $result=CheckUsername('prueba11');
        // var_dump($result);
        $this->assertTrue($result);
    }

    public function testCheckUserPassword(){ //hacer dinámico
        $login=CheckUsernamePassword('prueba22','PRUEBA22'); //el username debe existir
        var_dump($login);
        $this->assertTrue($login);
    }

    public function testCheckUserEmpty(){
        echo("EMPTY Login");
        $login=CheckUserEmpty('prueba2','123456');
        var_dump($login);
        $this->assertTrue($login);
    }
    
    public function testCheckSizeUserPass(){
        echo("SIZE Login");
        $size=CheckSizeUserPass('prueba2','123456');        
        var_dump($size);
        $this->assertTrue($size);
    }


    //VALORES FRONTERA
}



?>
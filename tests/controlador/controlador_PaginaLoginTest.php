<?php
$folders=explode("\\", __DIR__);
$directorio="";
foreach(array_slice($folders, 0, -2) as $folder){
    $directorio.=$folder.'/';
}

// require_once $directorio.'/controlador/controlador_PaginaLogin.php';      //deberiamos usar __DIR__.'../\controlador\controlador_PaginaInicio.php'; pero no me funciona lo de subir 2 directorios con ..
require_once $directorio.'/controlador/controlador_EnviarLogin.php'; 

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
    public function testCheckUserF(){
        $result=CheckUsername('noExistUser');
        // var_dump($result);
        $this->assertFalse($result);
    }

    public function testCheckUserPassword(){
        $login=CheckUsernamePassword('prueba22','llaveMaestra');
        var_dump("testCheckUserPassword",$login);
        $this->assertTrue($login);
    }

    public function testCheckUserPassword2(){
        $login=CheckUsernamePassword('prueba33','PRUEBA33');
        var_dump("testCheckUserPassword2",$login);
        $this->assertTrue($login);
    }

    public function testCheckUserPassword3(){
        $login=CheckUsernamePassword('prueba22','noCorrecto');
        var_dump("testCheckUserPassword3",$login);
        $this->assertFalse($login);
    }

    public function testCheckUserPassword4(){
        $login=CheckUsernamePassword('UsuarioRandom','PRUEBA22');
        var_dump("testCheckUserPassword4",$login);;
        $this->assertFalse($login);
    }
    //test vacíos empty
    public function testCheckUserEmpty(){
        echo("EMPTY Login");
        $login=CheckUserEmpty('','');
        var_dump("testCheckUserEmpty",$login);
        $this->assertFalse($login);
    }

    public function testCheckUserEmpty2(){
        echo("EMPTY Login2");
        $login=CheckUserEmpty('','123456');
        var_dump("testCheckUserEmpty2",$login);
        $this->assertFalse($login);
    }

    public function testCheckUserEmpty3(){
        echo("EMPTY Login3");
        $login=CheckUserEmpty('prueba2','');
        var_dump("testCheckUserEmpty3",$login);
        $this->assertFalse($login);
    }

    public function testCheckUserEmpty4(){
        echo("EMPTY Login4");
        $login=CheckUserEmpty('prueba2','123456');
        var_dump("testCheckUserEmpty4",$login);
        $this->assertTrue($login);
    }
    
    //FRONTERA USUARIO username
    public function testCheckSizeUserPass(){
        echo("SIZE Login");
        $size=CheckSizeUserPass('pru','123456');        
        var_dump("testCheckSizeUserPass",$size);
        $this->assertFalse($size);
    }
    public function testCheckSizeUserPass2(){
        echo("SIZE Login");
        $size=CheckSizeUserPass('prue','123456');        
        var_dump("testCheckSizeUserPass2",$size);
        $this->assertTrue($size);
    }
    public function testCheckSizeUserPass3(){
        echo("SIZE Login");
        $size=CheckSizeUserPass('prueba','123456');        
        var_dump("testCheckSizeUserPass3",$size);
        $this->assertTrue($size);
    }
    public function testCheckSizeUserPass4(){
        echo("SIZE Login");
        $size=CheckSizeUserPass('pruebapruebaprueb19','123456');        
        var_dump("testCheckSizeUserPass4",$size);
        $this->assertTrue($size);
    }
    public function testCheckSizeUserPass5(){
        echo("SIZE Login");
        $size=CheckSizeUserPass('pruebapruebaprueba20','123456');        
        var_dump("testCheckSizeUserPass5",$size);
        $this->assertTrue($size);
    }
    public function testCheckSizeUserPass6(){
        echo("SIZE Login");
        $size=CheckSizeUserPass('pruebapruebapruebas21','123456');        
        var_dump("testCheckSizeUserPass6",$size);
        $this->assertFalse($size);
    }
    //FRONTERA USUARIO password
    public function testCheckSizeUserPass7(){
        echo("SIZE Login");
        $size=CheckSizeUserPass('prueba2','12345');        
        var_dump("testCheckSizeUserPass7",$size);
        $this->assertFalse($size);
    }
    public function testCheckSizeUserPass8(){
        echo("SIZE Login");
        $size=CheckSizeUserPass('prueba2','123456');        
        var_dump("testCheckSizeUserPass8",$size);
        $this->assertTrue($size);
    }
    public function testCheckSizeUserPass9(){
        echo("SIZE Login");
        $size=CheckSizeUserPass('prueba2','1234567');        
        var_dump("testCheckSizeUserPass9",$size);
        $this->assertTrue($size);
    }
    public function testCheckSizeUserPass10(){
        echo("SIZE Login");
        $size=CheckSizeUserPass('prueba2','1234567891234567890'); //19
        var_dump("testCheckSizeUserPass10",$size);
        $this->assertTrue($size);
    }
    public function testCheckSizeUserPass11(){
        echo("SIZE Login");
        $size=CheckSizeUserPass('prueba2','12345678912345678900'); //20
        var_dump("testCheckSizeUserPass11",$size);
        $this->assertTrue($size);
    }
    public function testCheckSizeUserPass12(){
        echo("SIZE Login");
        $size=CheckSizeUserPass('prueba2','123456789123456789000'); //21
        var_dump("testCheckSizeUserPass12",$size);
        $this->assertFalse($size);
    }
    public function testCheckSizeUserPass13(){
        echo("SIZE Login");
        $size=CheckSizeUserPass('pr','3322333322222232323233332323');
        var_dump("testCheckSizeUserPass12",$size);
        $this->assertFalse($size);
    }
    public function testCheckSizeUserPass14(){
        echo("SIZE Login");
        $size=CheckSizeUserPass('3322333322222232323233332323','pr');
        var_dump("testCheckSizeUserPass12",$size);
        $this->assertFalse($size);
    }
    


    //VALORES FRONTERA
}



?>
<?php

$folders=explode("\\", __DIR__);
$directorio="";
foreach(array_slice($folders, 0, -2) as $folder){
    $directorio.=$folder.'/';
}

// require_once $directorio.'/controlador/controlador_PaginaLogin.php';      //deberiamos usar __DIR__.'../\controlador\controlador_PaginaInicio.php'; pero no me funciona lo de subir 2 directorios con ..
require_once $directorio.'/controlador/controlador_EnviarLogin.php';
    /**
    * @covers Usuario::
    * @covers CheckUsernamePassword
    */ 
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

    //Comprueba si el username existe en el Mock Object
    public function testCheckUserMockObject(){
        $result=CheckUsernameMock('Frutesino5'); //nombre usuario existe en el Mock Object
        // var_dump($result);
        $this->assertTrue($result);
    }
    public function testCheckUserMockObject1(){
        $result=CheckUsernameMock('noExistUser'); //nombre usuario no existe en el Mock Object
        // var_dump($result);
        $this->assertFalse($result);
    }

    //Comprueba si el username existe en la base de datos
    public function testCheckUser(){
        $result=CheckUsername('Frutesino5'); //nombre usuario existe en la bbdd
        // var_dump($result);
        $this->assertTrue($result);
    }
    public function testCheckUser1(){
        $result=CheckUsername('noExistUser'); //nombre usuario no existe en la bbdd
        // var_dump($result);
        $this->assertFalse($result);
    }

    //Comprueba si el username y password existe en el MockObject
    public function testCheckUserPasswordMockObject(){
        $login=CheckUsernamePasswordMockObject('alejoHugo','llaveMaestra'); //usuario existe y password con llave maestra, login correcto
      // var_dump("testCheckUserPasswordMockObject",$login);
        $this->assertTrue($login);
    }
    public function testCheckUserPasswordMockObject1(){
        $login=CheckUsernamePasswordMockObject('noexiste','llaveMaestra'); //usuario no existe y password con llave maestra, login incorrecto
      // var_dump("testCheckUserPasswordMockObject1",$login);
        $this->assertFalse($login);
    }
    //Comprueba si el username y password existe en la bbdd
    public function testCheckUserPasswordMockObject2(){
        $login=CheckUsernamePasswordMockObject('legendary','tekashi'); //login correcto, usuario y password existen
      // var_dump("testCheckUserPasswordMockObject2",$login);
        $this->assertTrue($login);
    }
    public function testCheckUserPasswordMockObject3(){
        $login=CheckUsernamePasswordMockObject('prueba22','noCorrecto'); //username no existe y password tampoco
      // var_dump("testCheckUserPasswordMockObject3",$login);
        $this->assertFalse($login);
    }
    public function testCheckUserPasswordMockObject4(){ //
        $login=CheckUsernamePasswordMockObject('Maria','PRUEBA22'); //username existe pero password no
      // var_dump("testCheckUserPasswordMockObject4",$login);;
        $this->assertFalse($login);
    }



    //Comprueba si el username y password existe en la bbdd
    public function testCheckUserPassword(){
        $login=CheckUsernamePassword('alejoHugo','llaveMaestra'); //usuario existe y password con llave maestra, login correcto
      // var_dump("testCheckUserPassword",$login);
        $this->assertTrue($login);
    }
    public function testCheckUserPassword1(){
        $login=CheckUsernamePassword('noexiste','llaveMaestra'); //usuario no existe y password con llave maestra, login incorrecto
      // var_dump("testCheckUserPassword1",$login);
        $this->assertFalse($login);
    }
    //Comprueba si el username y password existe en la bbdd
    public function testCheckUserPassword2(){
        $login=CheckUsernamePassword('legendary','tekashi'); //login correcto, usuario y password existen
      // var_dump("testCheckUserPassword2",$login);
        $this->assertTrue($login);
    }
    public function testCheckUserPassword3(){
        $login=CheckUsernamePassword('prueba22','noCorrecto'); //username no existe y password tampoco
      // var_dump("testCheckUserPassword3",$login);
        $this->assertFalse($login);
    }
    public function testCheckUserPassword4(){ //
        $login=CheckUsernamePassword('Maria','PRUEBA22'); //username existe pero password no
      // var_dump("testCheckUserPassword4",$login);;
        $this->assertFalse($login);
    }

    //Testea si la session se actualiza correctamente con el login correcto o incorrecto del usuario
    // public function testCheckUserPasswordSession1(){
    //     $login=CheckUsernamePassword('killshot122','scarce'); //login correcto
    //   // var_dump("testCheckUserPasswordSession1",$login);;
    //     $this->assertTrue($_SESSION['loged']);
    // }
    // public function testCheckUserPasswordSession2(){
    //     $login=CheckUsernamePassword('UsuarioRandom','PRUEBA22'); //login incorrecto
    //   // var_dump("testCheckUserPasswordSession2",$login);;
    //     $this->assertFalse($_SESSION['loged']);
    // }
    // public function testCheckUserPasswordSession3(){
    //     $login=CheckUsernamePassword('Frutesino5','bosque'); //test del username del login si se guarda bien en la sesion
    //   // var_dump("testCheckUserPasswordSession3",$login);;
    //     $this->assertEquals($_SESSION['username'],'Frutesino5');
    // }


    //Testea si los campos introducidos en el login se envian vacíos o no
    public function testCheckUserEmpty(){
        //echo("EMPTY Login");
        $login=CheckUserEmpty('',''); //dos campos vacíos
      // var_dump("testCheckUserEmpty",$login);
        $this->assertFalse($login);
    }
    public function testCheckUserEmpty2(){
        //echo("EMPTY Login2");
        $login=CheckUserEmpty('','123456'); //campo username vacío
      // var_dump("testCheckUserEmpty2",$login);
        $this->assertFalse($login);
    }
    public function testCheckUserEmpty3(){ //campos password vacío
        //echo("EMPTY Login3");
        $login=CheckUserEmpty('prueba2','');
      // var_dump("testCheckUserEmpty3",$login);
        $this->assertFalse($login);
    }
    public function testCheckUserEmpty4(){
        //echo("EMPTY Login4");
        $login=CheckUserEmpty('prueba2','123456'); //los dos campos llenos
      // var_dump("testCheckUserEmpty4",$login);
        $this->assertTrue($login);
    }
    public function testCheckUserEmpty5(){
        //echo("EMPTY Login4");
        $login=CheckUserEmpty('A','123456'); //los dos campos llenos + valor frontera, sólo 1 valor en username
      // var_dump("testCheckUserEmpty5",$login);
        $this->assertTrue($login);
    }
    public function testCheckUserEmpty6(){
        //echo("EMPTY Login4");
        $login=CheckUserEmpty('prueba2','1'); //los dos campos llenos + valor frontera, sólo 1 valor en password
      // var_dump("testCheckUserEmpty6",$login);
        $this->assertTrue($login);
    }
    public function testCheckUserEmpty7(){
        //echo("EMPTY Login4");
        $login=CheckUserEmpty('A','1'); //los dos campos llenos + valor frontera, sólo 1 valor en username y password
      // var_dump("testCheckUserEmpty7",$login);
        $this->assertTrue($login);
    }
    public function testCheckUserEmpty8(){
        //echo("EMPTY Login4");
        $login=CheckUserEmpty('A',''); //valores frontera, sólo 1 valor en username y password
      // var_dump("testCheckUserEmpty8",$login);
        $this->assertFalse($login);
    }
    public function testCheckUserEmpty9(){
        //echo("EMPTY Login4");
        $login=CheckUserEmpty('','1'); //valores frontera, sólo 1 valor en username y password
      // var_dump("testCheckUserEmpty9",$login);
        $this->assertFalse($login);
    }
    
    //Test para los tamaños del campo $username y password
    //Tests valores frontera y decision coverage
    //los comentarios con dos números son: el primer número indica el tamaño del username y el segundo el tamaño del password
    public function testCheckSizeUserPass(){
        ////echo("SIZE Login");
        $size=CheckSizeUserPass('pru','123456'); //3 y 6 (menos de 3 y 6)
      // var_dump("testCheckSizeUserPass",$size);
        $this->assertFalse($size);
    }
    public function testCheckSizeUserPass1(){
        //echo("SIZE Login");
        $size=CheckSizeUserPass('pru','123456'); //3 y 6 (menos de 3 y 6)
      // var_dump("testCheckSizeUserPass1",$size);
        $this->assertFalse($size);
    }
    public function testCheckSizeUserPass2(){
        //echo("SIZE Login");
        $size=CheckSizeUserPass('pru','123'); //3 y 3 (menos de 4 y menos de 6)       
      // var_dump("testCheckSizeUserPass2",$size);
        $this->assertFalse($size);
    }
    public function testCheckSizeUserPass3(){
        //echo("SIZE Login");
        $size=CheckSizeUserPass('prue','123456'); //4 y 6       
      // var_dump("testCheckSizeUserPass3",$size);
        $this->assertTrue($size);
    }
    public function testCheckSizeUserPass4(){
        //echo("SIZE Login");
        $size=CheckSizeUserPass('prueb','123456'); //5 y 6       
      // var_dump("testCheckSizeUserPass4",$size);
        $this->assertTrue($size);
    }
    public function testCheckSizeUserPass5(){
        //echo("SIZE Login");
        $size=CheckSizeUserPass('prueba','123456'); //6 y 6       
      // var_dump("testCheckSizeUserPass5",$size);
        $this->assertTrue($size);
    }
    public function testCheckSizeUserPass6(){
        //echo("SIZE Login");
        $size=CheckSizeUserPass('prueba2','12345'); //6 y 5       
      // var_dump("testCheckSizeUserPass6",$size);
        $this->assertFalse($size);
    }
    public function testCheckSizeUserPass7(){
        //echo("SIZE Login");
        $size=CheckSizeUserPass('prueba2','1234567'); //6 y 7       
      // var_dump("testCheckSizeUserPass7",$size);
        $this->assertTrue($size);
    }
    public function testCheckSizeUserPass8(){
        //echo("SIZE Login");
        $size=CheckSizeUserPass('prueba2','1234567891234567890'); //6 y 19
      // var_dump("testCheckSizeUserPass8",$size);
        $this->assertTrue($size);
    }
    public function testCheckSizeUserPass9(){
        //echo("SIZE Login");
        $size=CheckSizeUserPass('prueba2','12345678912345678900'); //6 y 20
      // var_dump("testCheckSizeUserPass9",$size);
        $this->assertTrue($size);
    }
    public function testCheckSizeUserPass10(){
        //echo("SIZE Login");
        $size=CheckSizeUserPass('prueba2','123456789123456789000'); //6 y 21
      // var_dump("testCheckSizeUserPass10",$size);
        $this->assertFalse($size);
    }
    public function testCheckSizeUserPass11(){
        //echo("SIZE Login");
        $size=CheckSizeUserPass('pr','3322333322222232323233332323'); //2 y 28
      // var_dump("testCheckSizeUserPass11",$size);
        $this->assertFalse($size);
    }
    public function testCheckSizeUserPass12(){
        //echo("SIZE Login");
        $size=CheckSizeUserPass('3322333322222232323233332323','pr'); //28 y 2
      // var_dump("testCheckSizeUserPass12",$size);
        $this->assertFalse($size);
    }
    public function testCheckSizeUserPass13(){
        //echo("SIZE Login");
        $size=CheckSizeUserPass('pruebapruebapruebas21','1234565646545656456456'); //21 y 22       
      // var_dump("testCheckSizeUserPass13",$size);
        $this->assertFalse($size);
    }
    public function testCheckSizeUserPass14(){
        //echo("SIZE Login");
        $size=CheckSizeUserPass('pruebapruebaprueba20','12312312312312312355'); //20 y 20       
      // var_dump("testCheckSizeUserPass14",$size);
        $this->assertTrue($size);
    }
    public function testCheckSizeUserPass15(){
        //echo("SIZE Login");
        $size=CheckSizeUserPass('pruebapruebaprueba20','12312312d312312312355'); //20 y 21
      // var_dump("testCheckSizeUserPass15",$size);
        $this->assertFalse($size);
    }
    public function testCheckSizeUserPass16(){
        //echo("SIZE Login");
        $size=CheckSizeUserPass('pruebapruebaprueb19','123456'); //19 y 6       
      // var_dump("testCheckSizeUserPass16",$size);
        $this->assertTrue($size);
    }
    public function testCheckSizeUserPass17(){
        //echo("SIZE Login");
        $size=CheckSizeUserPass('pruebapruebaprueba20','123456'); //20 y 6       
      // var_dump("testCheckSizeUserPass17",$size);
        $this->assertTrue($size);
    }
    public function testCheckSizeUserPass18(){
        //echo("SIZE Login");
        $size=CheckSizeUserPass('pruebapruebapruebas18','123456'); //21 y 6       
      // var_dump("testCheckSizeUserPass17",$size);
        $this->assertFalse($size);
    }
    public function testCheckSizeUserPass19(){
        //echo("SIZE Login");
        $size=CheckSizeUserPass('pruebapruebapruebas19','123456'); //21 y 3       
      // var_dump("testCheckSizeUserPass18",$size);
        $this->assertFalse($size);
    }


    
}



?>
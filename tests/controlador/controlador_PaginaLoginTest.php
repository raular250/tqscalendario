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



    //Testea si el username existe en el Mock Object
    //Decision y Path
    public function testCheckUserMockObject(){
        $result=CheckUsernameMock('Frutesino5'); //nombre usuario existe en el Mock Object
        $this->assertTrue($result);
    }
    public function testCheckUserMockObject1(){
        $result=CheckUsernameMock('noExistUser'); //nombre usuario no existe en el Mock Object
        $this->assertFalse($result);
    }

    //Testea si el username existe en la base de datos
    //Decision y Path
    public function testCheckUser(){
        $result=CheckUsername('Frutesino5'); //nombre usuario existe en la bbdd
        $this->assertTrue($result);
    }
    public function testCheckUser1(){
        $result=CheckUsername('noExistUser'); //nombre usuario no existe en la bbdd
        $this->assertFalse($result);
    }



    //Testea si el username y password existe en el MockObject
    //Decision y Path
    public function testCheckUserPasswordMockObject(){
        $login=CheckUsernamePasswordMockObject('alejoHugo','llaveMaestra'); //usuario existe y password con llave maestra, login correcto
        $this->assertTrue($login);
    }
    public function testCheckUserPasswordMockObject1(){
        $login=CheckUsernamePasswordMockObject('noexiste','llaveMaestra'); //usuario no existe y password con llave maestra, login incorrecto
        $this->assertFalse($login);
    }
    public function testCheckUserPasswordMockObject2(){
        $login=CheckUsernamePasswordMockObject('legendary','tekashi'); //login correcto, usuario y password existen
        $this->assertTrue($login);
    }
    public function testCheckUserPasswordMockObject3(){
        $login=CheckUsernamePasswordMockObject('prueba22','noCorrecto'); //username no existe y password tampoco
        $this->assertFalse($login);
    }
    public function testCheckUserPasswordMockObject4(){ //
        $login=CheckUsernamePasswordMockObject('Maria','PRUEBA22'); //username existe pero password no
        $this->assertFalse($login);
    }




    //Testea si el username y password existe en la bbdd
    //Decision y Path
    public function testCheckUserPassword(){
        $login=CheckUsernamePassword('alejoHugo','llaveMaestra'); //usuario existe y password con llave maestra, login correcto
        $this->assertTrue($login);
    }
    public function testCheckUserPassword1(){
        $login=CheckUsernamePassword('noexiste','llaveMaestra'); //usuario no existe y password con llave maestra, login incorrecto
        $this->assertFalse($login);
    }
    //Testea si el username y password existe en la bbdd
    public function testCheckUserPassword2(){
        $login=CheckUsernamePassword('legendary','tekashi'); //login correcto, usuario y password existen
        $this->assertTrue($login);
    }
    public function testCheckUserPassword3(){
        $login=CheckUsernamePassword('prueba22','noCorrecto'); //username no existe y password tampoco
        $this->assertFalse($login);
    }
    public function testCheckUserPassword4(){ //
        $login=CheckUsernamePassword('Maria','PRUEBA22'); //username existe pero password no
        $this->assertFalse($login);
    }



    //Testea si la session se actualiza correctamente con el login correcto o incorrecto del usuario
    public function testCheckUserPasswordSession1(){
        $login=CheckUsernamePassword('killshot122','scarce'); //login correcto
        $this->assertTrue($_SESSION['loged']);
    }
    public function testCheckUserPasswordSession2(){
        $login=CheckUsernamePassword('UsuarioRandom','PRUEBA22'); //login incorrecto
        $this->assertFalse($_SESSION['loged']);
    }
    public function testCheckUserPasswordSession3(){
        $login=CheckUsernamePassword('Frutesino5','bosque'); //test del username del login si se guarda bien en la sesion
        $this->assertEquals($_SESSION['username'],'Frutesino5');
    }



    //Testea si los campos introducidos en el login se envian vacíos o no
    //Decision, Condition y Path
    public function testCheckUserEmpty(){
        $login=CheckUserEmpty('',''); //dos campos vacíos
        $this->assertFalse($login);
    }
    public function testCheckUserEmpty2(){
        $login=CheckUserEmpty('','123456'); //campo username vacío
        $this->assertFalse($login);
    }
    public function testCheckUserEmpty3(){ //campos password vacío
        $login=CheckUserEmpty('prueba2','');
        $this->assertFalse($login);
    }
    public function testCheckUserEmpty4(){
        $login=CheckUserEmpty('prueba2','123456'); //los dos campos llenos
        $this->assertTrue($login);
    }
    public function testCheckUserEmpty5(){
        $login=CheckUserEmpty('A','123456'); //los dos campos llenos + valor frontera, sólo 1 valor en username
        $this->assertTrue($login);
    }
    public function testCheckUserEmpty6(){
        $login=CheckUserEmpty('prueba2','1'); //los dos campos llenos + valor frontera, sólo 1 valor en password
        $this->assertTrue($login);
    }
    public function testCheckUserEmpty7(){
        $login=CheckUserEmpty('A','1'); //los dos campos llenos + valor frontera, sólo 1 valor en username y password
        $this->assertTrue($login);
    }
    public function testCheckUserEmpty8(){
        $login=CheckUserEmpty('A',''); //valores frontera, sólo 1 valor en username y password
        $this->assertFalse($login);
    }
    public function testCheckUserEmpty9(){
        $login=CheckUserEmpty('','1'); //valores frontera, sólo 1 valor en username y password
        $this->assertFalse($login);
    }



    
    //Test para los tamaños del campo $username y password
    //Valores límite, frontera y particiones equivalentes
    //Decision, Condition y Path
    public function testCheckSizeUserPass(){// 3 y 6: el primer número indica el tamaño del username y el segundo el tamaño del password del test
        $size=CheckSizeUserPass('pru','123456'); //3 y 6
        $this->assertFalse($size);
    }
    public function testCheckSizeUserPass1(){
      $size=CheckSizeUserPass('pruebareal','1234567891'); //9 y 9
      $this->assertTrue($size);
  }
    public function testCheckSizeUserPass2(){
        $size=CheckSizeUserPass('pr','12'); //3 y 3
        $this->assertFalse($size);
    }
    public function testCheckSizeUserPass3(){
        $size=CheckSizeUserPass('prue','123456'); //4 y 6
        $this->assertTrue($size);
    }
    public function testCheckSizeUserPass4(){
        $size=CheckSizeUserPass('prueb','123456'); //5 y 6
        $this->assertTrue($size);
    }
    public function testCheckSizeUserPass5(){
        $size=CheckSizeUserPass('prueba','123456'); //6 y 6
        $this->assertTrue($size);
    }
    public function testCheckSizeUserPass6(){
        $size=CheckSizeUserPass('prueba','12345'); //5 y 5
        $this->assertFalse($size);
    }
    public function testCheckSizeUserPass8(){
        $size=CheckSizeUserPass('prueba2','1234567891234567890'); //6 y 19
        $this->assertTrue($size);
    }
    public function testCheckSizeUserPass9(){
        $size=CheckSizeUserPass('prueba2','12345678912345678900'); //6 y 20
        $this->assertTrue($size);
    }
    public function testCheckSizeUserPass10(){
        $size=CheckSizeUserPass('prueba2','123456789123456789000'); //6 y 21
        $this->assertFalse($size);
    }
    public function testCheckSizeUserPass11(){
        $size=CheckSizeUserPass('pr','3322333322222232323233332323'); //2 y 28
        $this->assertFalse($size);
    }
    public function testCheckSizeUserPass12(){
        $size=CheckSizeUserPass('3322333322222232323233332323','pr'); //28 y 2
        $this->assertFalse($size);
    }
    public function testCheckSizeUserPass13(){
        $size=CheckSizeUserPass('pruebapruebapruebas21','1234565646545656456456'); //21 y 22       
        $this->assertFalse($size);
    }
    public function testCheckSizeUserPass14(){
        $size=CheckSizeUserPass('pruebapruebaprueba20','12312312312312312355'); //20 y 20       
        $this->assertTrue($size);
    }
    public function testCheckSizeUserPass15(){
        $size=CheckSizeUserPass('pruebapruebaprueba20','12312312d312312312355'); //20 y 21
        $this->assertFalse($size);
    }
    public function testCheckSizeUserPass16(){
        $size=CheckSizeUserPass('pruebapruebaprueb19','123456'); //19 y 6       
        $this->assertTrue($size);
    }
    public function testCheckSizeUserPass17(){
        $size=CheckSizeUserPass('pruebapruebaprueba20','123456'); //20 y 6       
        $this->assertTrue($size);
    }
    public function testCheckSizeUserPass18(){
        $size=CheckSizeUserPass('pruebapruebapruebas18','123456'); //21 y 6       
        $this->assertFalse($size);
    }
    public function testCheckSizeUserPass19(){
        $size=CheckSizeUserPass('pruebapruebapruebas19','123456'); //21 y 3       
        $this->assertFalse($size);
    }


    
}



?>
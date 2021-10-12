<?php
function connectDB(){
    $servername="localhost";
    $username="root";
    $password=NULL;
    $db="webdb";
    
    $conn = new mysqli ($servername, $username, $password, $db) or die ("Conexión fallida: %s\n".$conn->error);
    return $conn;
}

function CloseCon($conn){
    $conn -> close();
}

?>
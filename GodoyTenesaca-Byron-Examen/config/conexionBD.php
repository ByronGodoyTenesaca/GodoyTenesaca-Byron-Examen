<?php

$db_servername = "localhost:3310";
$db_username = "root";
$db_password = "root";
$db_name = "pruebainterciclo";

$conn=new mysqli($db_servername, $db_username, $db_password, $db_name);

$conn->set_charset("utf8");
#probar la conexion
if($conn->connect_error){
    die("conexion fallida: ".$conn->connect_error);
}else{
}

?>
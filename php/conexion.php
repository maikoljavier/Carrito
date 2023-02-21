<?php 
    $servidor="localhost";
    $nombreDB="carrito";
    $usuario="root";
    $pass="";
    $conexion = new mysqli($servidor,$usuario, $pass, $nombreDB);
    if($conexion -> connect_error){
        die("No se puedo Conectar");
        
    }
?>
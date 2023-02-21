<?php 
session_start();
    include"./conexion.php";
    if(  isset($_POST['email']) && isset($_POST['password']) ){
            $resultado = $conexion ->query("select * from usuario where email='".$_POST['email']."' and password= '".sha1($_POST['password'])."'limit 1")or die($conexion->error);
            if(mysqli_num_rows($resultado)>0){
                $datos_usuarios = mysqli_fetch_row($resultado);
                $nombre = $datos_usuarios[1];
                $id_usuario = $datos_usuarios[0];
                $email = $datos_usuarios[3];
                $imagen_perfil = $datos_usuarios[5];
                $nivel = $datos_usuarios[6];
                $_SESSION['datos_login'] = array(
                    'nombre'=>$nombre,
                    'id_usuario'=>$id_usuario,
                    'email'=>$email,
                    'imagen'=>$imagen_perfil,
                    'nivel'=>$nivel
                );
                header("location: ../admin/");
            }else{
                header("location: ../login.php?error=Credenciales Incorrectas");
            }
    }else {
        header("../login.php");
    }


?>